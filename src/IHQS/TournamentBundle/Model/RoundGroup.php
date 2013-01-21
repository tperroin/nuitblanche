<?php

namespace IHQS\TournamentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class RoundGroup implements RoundGroupInterface
{
    protected $round;

	protected $name;

	protected $code;

	protected $matches;

	protected $players;

	public function __construct()
	{
		$this->matches = new ArrayCollection();
		$this->players = new ArrayCollection();
	}

	public function getRound()
	{
		return $this->round;
	}

	public function setRound(RoundInterface $round)
	{
		$this->round = $round;
	}
	
	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function setCode($code)
	{
		$this->code = $code;
	}

	public function getMatches()
	{
		return $this->matches;
	}

	public function getOrderedMatches()
	{
		$matches = $this->matches->toArray();

		usort($matches, function($a, $b)
		{
			return $a->getOrder() > $b->getOrder() ? 1 : -1;
		});

		return $matches;
	}

	public function addMatch(MatchInterface $match)
	{
		$this->matches->add($match);
	}

	public function removeMatch(MatchInterface $match)
	{
		$this->matches->remove($match);
	}

	public function getMatch($i)
	{
        foreach($this->matches as $match)
		{
			if($match->getOrder() == $i) { return $match; }
		}

        return null;
	}

	public function getPlayers()
	{
		return $this->players;
	}

	public function addPlayer(PlayerInterface $player)
	{
		$this->players->add($player);
	}

	public function removePlayer(PlayerInterface $player)
	{
		$this->players->remove($player);
	}

	protected $stats = array();
	protected $statsInitialized = false;

	protected function buildStats()
	{
		if($this->statsInitialized) { return ; }

		// init
		foreach($this->players as $player)
		{
			$this->stats[$player->getId()] = array(
				'wins'		=> 0,
				'losses'	=> 0,
				'ratio'		=> 0,
				'gameswon'	=> 0,
				'gameslost'	=> 0,
			);
		}

		// matches scores
		foreach($this->matches as $match)
		{
			if(!$match->getWinner()) { continue ; }
			
			$this->stats[$match->getWinnerPlayer()]['wins']++;
			$this->stats[$match->getWinnerPlayer()]['gameswon']		+= $match->getWinnerScore();
			$this->stats[$match->getWinnerPlayer()]['gameslost']	+= $match->getLooserScore();
			
			$this->stats[$match->getLooserPlayer()]['losses']++;
			$this->stats[$match->getLooserPlayer()]['gameswon']		+= $match->getLooserScore();
			$this->stats[$match->getLooserPlayer()]['gameslost']	+= $match->getWinnerScore();
		}

		foreach($this->stats as $id => $data)
		{
			$played_matches = $data['gameswon'] + $data['gameslost'];
			if($played_matches == 0) { continue ; }

			$this->stats[$id]['ratio'] = number_format($data['gameswon'] / $played_matches, 3);
		}

		$this->statsInitialized = true;
	}

	public function getWins(PlayerInterface $player)
	{
		$this->buildStats();
		return $this->stats[$player->getId()]['wins'];
	}

	public function getLosses(PlayerInterface $player)
	{
		$this->buildStats();
		return $this->stats[$player->getId()]['losses'];
	}

	public function geRatio(PlayerInterface $player)
	{
		$this->buildStats();
		return $this->stats[$player->getId()]['ratio'];
	}
}