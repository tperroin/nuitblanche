<?php

namespace IHQS\TournamentBundle\RoundTypeManager;

use IHQS\TournamentBundle\Model\MatchInterface;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Collections\Collection;
use IHQS\TournamentBundle\Entity\RoundGroup;
use IHQS\TournamentBundle\Entity\Match;

class SimpleBracketManager extends AbstractRoundTypeManager implements RoundTypeManagerInterface
{
	public function launch(Collection $roundPlayers)
	{
		$nb_phases = 0;
		while(pow(2, $nb_phases) < $this->round->getPlayerLimit())
		{
			$nb_phases++;
		}

		$players = $roundPlayers->toArray();
		
		foreach(range(1, $nb_phases) as $i)
		{
			$nb_games = pow(2, $nb_phases - $i);

			$name = 'round 1/' . $nb_games;
			if($case == 1) { $name = "Finals"; }
			if($case == 2) { $name = "Semi-finals"; }

			$g = new RoundGroup();
			$g->setName($name);
			$g->setCode($nb_phases - $i);
			$g->setRound($this->round);

			$players = ($i == 1) ? $roundPlayers->toArray() : array();
			$this->buildGroupGames($g, $nb_games, $players);

			$this->om->persist($g);
		}

		$this->om->flush();
	}

	public function buildGroupGames(Group $group, $nbGames, array $players = array())
	{
		foreach(range(1, $nbGames) as $j)
		{
			$m = new Match();
			$m->setGroup($group);
			$m->setOrder($j);

			if(count($players) > 0)
			{
				$p1 = array_shift($players);
				$p2 = array_pop($players);

				$order = $this->getRoundNumber($j, $nbGames);
				$m->setOrder($order);
				$m->setPlayer1($p1);
				$m->setPlayer2($p2);
			}

			$group->addMatch($m);
			$this->om->persist($m);
		}
	}

	public function getRoundNumber($i, $nbGames)
	{
		$matchOrder = $this->getMatchOrder($nbGames);
		return $matchOrder[$i];
	}

	static protected $matchOrder = array(
		2 => array(
			1 => 1,
			2 => 2
		)
	);
	public function getMatchOrder($nbGames, $iteration = 2)
	{
		if(!isset(self::$matchOrder[$nbGames]))
		{
			$next = $iteration * 2;

			$tempOrder = array();
			$games = range(1, $next);
			foreach(self::$matchOrder[$iteration] as $key => $order)
			{
				$index = $order * 2;
				$tempOrder[$index-2] = array_shift($games);
				$tempOrder[$index-1] = array_pop($games);
			}

			$tempOrder = array_flip($tempOrder);
			ksort($tempOrder);
			foreach($tempOrder as $key => $value)
			{
				self::$matchOrder[$next][$key] = $value + 1;
			}

			return $this->getMatchOrder($nbGames, $next);
		}
		else
		{
			return self::$matchOrder[$nbGames];
		}

	}

	public function close()
	{
		// it's necessary the final phase, nothing to do there
	}

	public function closeMatch(MatchInterface $match, $player1Score, $player2Score)
	{
		// adding score
		$winner = $player1Score > $player2Score ? 1 : 2;

		$match->setPlayer1Score($player1Score);
		$match->setPlayer2Score($player2Score);
		$match->setWinner($winner);

		$this->om->persist($match);

		// adding winner to next round
		$nextRoundGroup = $match->getGroup()->getRound()->getRoundGroup($match->getGroup()->getCode() + 1);

		if(!is_null($nextRoundGroup))
		{
			$index = ceil($match->getOrder() / 2);
			$nextMatch = $nextRoundGroup->getMatch($index);

			if(!is_null($nextMatch))
			{
				$getWinner = "getPlayer" . $winner;
				$winner = $match->$getWinner();

				$playerIndex = (($match->getOrder()+1) % 2) + 1;
				$setPlayer = "setPlayer" . $playerIndex;

				$nextMatch->$setPlayer($winner);
				$this->om->persist($nextMatch);
			}
		}
		
		// flushing
		$this->om->flush();
	}
}
