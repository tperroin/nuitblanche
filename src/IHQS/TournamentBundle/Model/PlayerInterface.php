<?php

namespace IHQS\TournamentBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface PlayerInterface extends UserInterface
{
	function getEmail();
	
	function getCountry();
}