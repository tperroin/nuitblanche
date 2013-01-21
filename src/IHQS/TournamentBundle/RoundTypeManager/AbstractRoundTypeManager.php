<?php

namespace IHQS\TournamentBundle\RoundTypeManager;

use IHQS\TournamentBundle\Model\MatchInterface;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Persistence\ObjectManager;

abstract class AbstractRoundTypeManager implements RoundTypeManagerInterface
{
	protected $round;
	protected $om;

	function __construct(RoundInterface $round, ObjectManager $objectManager)
	{
		$this->round = $round;
		$this->om = $objectManager;
	}
}
