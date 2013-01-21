<?php

namespace IHQS\TournamentBundle\Entity;

use Doctrine\ORM\EntityRepository;
use IHQS\TournamentBundle\Model\TournamentInterface;

class TournamentRepository extends EntityRepository
{
	public function launchTournament(TournamentInterface $tournament)
	{
		$this->closeTournament($tournament);
		$firstRound = $tournament->getRound(1);
		
		try {
			$this->_em->getRepository('\IHQS\TournamentBundle\Entity\Round')->launchRound($firstRound, $tournament->getSubscribers());
		} catch(\LogicException $e) {
			throw new \LogicException('This tournament has already been launched');
		}
	}

	public function closeTournament(TournamentInterface $tournament)
	{
		$tournament->setSubscriptionsClosed(true);
		$this->_em->persist($tournament);
		$this->_em->flush();
	}
}