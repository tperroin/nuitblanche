<?php

namespace IHQS\TournamentBundle\RoundTypeManager;

use IHQS\TournamentBundle\Model\MatchInterface;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Collections\Collection;
use IHQS\TournamentBundle\Entity\RoundGroup;
use IHQS\TournamentBundle\Entity\Match;

class PoolManager extends AbstractRoundTypeManager implements RoundTypeManagerInterface
{
	public function launch(Collection $roundPlayers)
	{
		$nb_groups = ceil($roundPlayers->count() / $this->round->getPlayerLimit());

		foreach(range(1, $nb_groups) as $i)
		{
			$g = new RoundGroup();
			$g->setName('Pool ' . chr(64+$i));
			$g->setCode($i);
			$g->setRound($this->round);

			$players = $this->getGroupPlayers($roundPlayers, $nb_groups, $i - 1);

			$processedPlayers = array();
			
			foreach($players as $player)
			{
				$g->addPlayer($player);

				$order = 0;
				foreach($players as $opponent)
				{
					if($player->getId() == $opponent->getId()) { continue ; }
					$order++;
					if(isset($processedPlayers[$opponent->getId()])) { continue ; }
					
					$m = new Match();
					$m->setGroup($g);
					$m->setPlayer1($player);
					$m->setPlayer2($opponent);
					$m->setOrder($order);
					
					$g->addMatch($m);
					$this->om->persist($m);
				}

				$processedPlayers[$player->getId()] = true;
			}

			$this->om->persist($g);
		}

		$this->om->flush();
	}

	protected function getGroupPlayers(Collection $players, $nbGroups, $iteration)
	{
		// TODO add seeds considerations
		$separator = ceil($players->count() / $nbGroups);

		$begin = $iteration * $separator;
		$end = $begin + $separator;
		$selectedPlayers = array();
		foreach(range($begin, $end) as $i)
		{
			$player = $players->get($i);
			if($player)
			{
				array_push($selectedPlayers, $player);
			}
		}

		return $selectedPlayers;
	}

	public function close()
	{
		// TODO specify winners
		$winners = array();

		$nextRound = $this->round->getNextRound();
		if(!is_null($nextRound))
		{
			$this->om->getRepository(get_class($this->round))->launchRound($nextRound, $winners);
		} 
	}

	public function closeMatch(MatchInterface $match, $player1Score, $player2Score)
	{
		$winner = $player1Score > $player2Score ? 1 : 2;

		$match->setPlayer1Score($player1Score);
		$match->setPlayer2Score($player2Score);
		$match->setWinner($winner);

		$this->om->persist($match);
		$this->om->flush();
	}
}
