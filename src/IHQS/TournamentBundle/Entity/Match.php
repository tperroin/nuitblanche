<?php

namespace IHQS\TournamentBundle\Entity;

use IHQS\TournamentBundle\Model\Match as BaseMatch;

class Match extends BaseMatch
{
    private $id;
	
	public function getId()
	{
		return $this->id;
	}
}