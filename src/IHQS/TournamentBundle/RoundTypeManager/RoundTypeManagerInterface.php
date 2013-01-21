<?php

namespace IHQS\TournamentBundle\RoundTypeManager;

use IHQS\TournamentBundle\Model\MatchInterface;
use IHQS\TournamentBundle\Model\RoundInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\Collection;

interface RoundTypeManagerInterface
{
	function __construct(RoundInterface $round, ObjectManager $objectManager);

	function launch(Collection $players);

	function close();

	function closeMatch(MatchInterface $match, $player1Score, $player2Score);
}
