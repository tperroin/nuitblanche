<?php

namespace IHQS\TournamentBundle\RoundTypeManager;

use IHQS\TournamentBundle\Model\MatchInterface;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Collections\Collection;
use IHQS\TournamentBundle\Entity\RoundGroup;

class DoubleBracketManager extends SimpleBracketManager
{
	public function launch(Collection $roundPlayers)
	{
		$nb_phases = 0;
		while(pow(2, $nb_phases) < $this->round->getPlayerLimit())
		{
			$nb_phases++;
		}

		$lb_increment = 1;
		foreach(range(1, $nb_phases) as $i)
		{
			// winner bracket phase
			$nb_games = pow(2, $nb_phases - $i);

			$name = 'round 1/' . $nb_games;
			if($case == 1) { $name = "Finals"; }
			if($case == 2) { $name = "Semi-finals"; }

			$g = new RoundGroup();
			$g->setName($name);
			$g->setCode('WB-' . $nb_phases - $i);
			$g->setRound($this->round);

			$players = ($i == 1) ? $roundPlayers->toArray() : array();
			$this->buildGroupGames($g, $nb_games, $players);
			$this->om->persist($g);

			if($nb_phases !== $i)
			{
				// looser bracket phases
				$nb_looser_games = $nb_games / 2;
				foreach(range($lb_increment, $lb_increment+1) as $i)
				{
					$g = new RoundGroup();
					$g->setName('LB - Round ' . $i);
					$g->setCode('LB-' . $i);
					$g->setRound($this->round);
					$this->buildGroupGames($g, $nb_looser_games);
					$this->om->persist($g);
				}
				$lb_increment += 2;
			}
		}

		// finals
		$g = new RoundGroup();
		$g->setName('Grand Finals');
		$g->setCode('GF');
		$g->setRound($this->round);
		$this->buildGroupGames($g, 1);
		$this->om->persist($g);

		$this->om->flush();
	}

	public function close()
	{
		// it's necessary the final phase, nothing to do there
	}

	public function closeMatch(MatchInterface $match, $player1Score, $player2Score)
	{
		// adding score
		$winner = $player1Score > $player2Score ? 1 : 2;
		$looser = $player1Score < $player2Score ? 1 : 2;

		$match->setPlayer1Score($player1Score);
		$match->setPlayer2Score($player2Score);
		$match->setWinner($winner);

		$this->om->persist($match);

		// adding winner to next round of winner bracket
		list($groupType, $groupNumber) = explode('-', $match->getGroup()->getCode());
		$nextRoundGroup = $match->getGroup()->getRound()->getRoundGroup($groupType . '-' . ($groupNumber + 1));

		if(is_null($nextRoundGroup))
		{
			$nextRoundGroup = $match->getGroup()->getRound()->getRoundGroup('GF');
		}

		if(!is_null($nextWBRoundGroup))
		{
			$index = ceil($match->getOrder() / 2);
			$nextMatch = $nextRoundGroup->getMatch($index);

			if(!is_null($nextMatch))
			{
				$getWinner = "getPlayer" . $winner;
				$winner = $match->$getWinner();

				$playerIndex = ($groupType == 'LB') ? 2 : (($match->getOrder()+1) % 2) + 1;
				$setPlayer = "setPlayer" . $playerIndex;

				$nextMatch->$setPlayer($winner);
				$this->om->persist($nextMatch);
			}
		}

		// adding looser to looser bracket
		if($groupType != 'LB')
		{
			$code = ($groupNumber == 1)
				? 1
				: ($groupNumber * 2) - 2
			;
			$nextLBRoundGroup = $match->getGroup()->getRound()->getRoundGroup('LB-' . $code);

			if(!is_null($nextLBRoundGroup))
			{
				$index = ($groupNumber % 2) 
					? $nextLBRoundGroup->getMatches()->count() - $match->getOrder()
					: ceil($match->getOrder() / 2)
				;
				$lbMatch = $nextLBRoundGroup->getMatch($index);

				if(!is_null($nextMatch))
				{
					$getLooser = "getPlayer" . $looser;
					$looser = $match->$getLooser();

					$playerIndex = 1;
					$setPlayer = "setPlayer" . $playerIndex;

					$lbMatch->$setPlayer($looser);
					$this->om->persist($lbMatch);
				}
			}
		}

		// flushing
		$this->om->flush();
	}
}
