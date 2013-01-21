<?php

namespace IHQS\TournamentBundle\Entity;

use Doctrine\ORM\EntityRepository;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Collections\Collection;

class RoundRepository extends EntityRepository
{
	public function getRoundTypeManager(RoundInterface $round)
	{
		switch($round->getType())
		{
			case Round::TYPE_POOLS:
				$class = "\IHQS\TournamentBundle\RoundTypeManager\PoolManager";
				break;
			case Round::TYPE_SIMPLE_BRACKET:
				$class = "\IHQS\TournamentBundle\RoundTypeManager\SimpleBracketManager";
				break;
			case Round::TYPE_DOUBLE_BRACKET:
				$class = "\IHQS\TournamentBundle\RoundTypeManager\DoubleBracketManager";
				break;
			default:
				throw new \RuntimeException('Invalid parameter "type" for this round');
		}

		$manager = new $class($round, $this->_em);
		return $manager;
	}
	
	public function launchRound(RoundInterface $round, Collection $players)
	{
		$manager = $this->getRoundTypeManager($round);
		
		if($round->getGroups()->count() > 0)
		{
			throw new \LogicException('This round has already been launched');
		}

		$manager = $this->getRoundTypeManager($round);
		$manager->launch($players);
	}
}