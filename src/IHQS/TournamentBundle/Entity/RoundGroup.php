<?php

namespace IHQS\TournamentBundle\Entity;

use IHQS\TournamentBundle\Model\RoundGroup as BaseRoundGroup;

class RoundGroup extends BaseRoundGroup
{
    private $id;

	public function getId()
	{
		return $this->id;
	}
}