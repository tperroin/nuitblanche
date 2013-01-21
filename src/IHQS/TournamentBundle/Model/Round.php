<?php

namespace IHQS\TournamentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Round implements RoundInterface
{
	const TYPE_POOLS = 'pools';
	const TYPE_SIMPLE_BRACKET = 'simple_bracket';
	const TYPE_DOUBLE_BRACKET = 'double_bracket';

	static protected $_types = array(
		self::TYPE_POOLS => self::TYPE_POOLS,
		self::TYPE_SIMPLE_BRACKET => self::TYPE_SIMPLE_BRACKET,
		self::TYPE_DOUBLE_BRACKET => self::TYPE_DOUBLE_BRACKET,
	);

    protected $type;

	protected $playerLimit;

	protected $infos;

	protected $order;

	protected $tournament;
	
	protected $groups;
	
	public function __construct()
	{
		$this->playerLimit	= 0;
		$this->order		= 0;
		$this->groups		= new ArrayCollection();
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type)
	{
		if(!in_array($type, self::$_types))
		{
			throw new \InvalidArgumentException('Wrong type value for a round');
		}
		$this->type = $type;
	}

	static public function getAllowedTypes()
	{
		return self::$_types;
	}

	public function getPlayerLimit()
	{
		return $this->playerLimit;
	}

	public function setPlayerLimit($playerLimit)
	{
		$this->playerLimit = $playerLimit;
	}

	public function getInfos()
	{
		return $this->infos;
	}

	public function setInfos($infos)
	{
		$this->infos = $infos;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function setOrder($order)
	{
		$this->order = (int) $order;
	}

	public function getTournament()
	{
		return $this->tournament;
	}

	public function setTournament(TournamentInterface $tournament)
	{
		$this->tournament = $tournament;
	}

	public function getNextRound()
	{
		return $this->tournament->getRound($this->getOrder() + 1);
	}

	public function getGroups()
	{
		return $this->groups;
	}

	public function addGroup(RoundGroupInterface $group)
	{
		$this->groups->add($group);
	}

	public function removeGroup(RoundGroupInterface $group)
	{
		$this->groups->remove($group);
	}

	public function getRoundGroup($code)
	{
        foreach($this->groups as $group)
		{
			if($group->getCode() == $code) { return $group; }
		}

        return null;
	}
}