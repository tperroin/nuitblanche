<?php

namespace IHQS\TournamentBundle\Entity;

use IHQS\TournamentBundle\Model\Tournament as BaseTournament;

class Tournament extends BaseTournament
{
    private $id;

	public function getId()
	{
		return $this->id;
	}
}