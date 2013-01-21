<?php

namespace IHQS\TournamentBundle\Entity;

use IHQS\TournamentBundle\Model\Seed as BaseSeed;

class Seed extends BaseSeed
{
    private $id;

	public function getId()
	{
		return $this->id;
	}
}