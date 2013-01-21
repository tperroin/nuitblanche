<?php

namespace IHQS\TournamentBundle\Entity;

use IHQS\TournamentBundle\Model\Round as BaseRound;

class Round extends BaseRound
{
    private $id;

	public function getId()
	{
		return $this->id;
	}
}