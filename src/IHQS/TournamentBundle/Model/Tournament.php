<?php

namespace IHQS\TournamentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Tournament implements TournamentInterface
{
    protected $date;

	protected $name;

	protected $description;

	protected $admin;

	protected $rounds;

	protected $rules;

	protected $subscribers;

	protected $subscriptionsClosed;

	protected $hasSeeds;

	public function __construct()
	{
		$this->rounds		= new ArrayCollection();
		$this->subscribers	= new ArrayCollection();
		$this->subscriptionsClosed = false;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setDate(\DateTime $date)
	{
		$this->date = $date;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getAdmin()
	{
		return $this->admin;
	}

	public function setAdmin(PlayerInterface $admin)
	{
		$this->admin = $admin;
	}

	public function getRounds()
	{
		return $this->rounds;
	}

	public function addRound(RoundInterface $round)
	{
		$this->rounds->add($rounds);
	}

	public function removeRound(RoundInterface $round)
	{
		$this->rounds->remove($rounds);
	}

	public function getRound($i)
	{
        foreach($this->rounds as $round)
		{
			if($round->getOrder() == $i) { return $round; }
		}
		
        return null;
	}

	public function getRules()
	{
		return $this->rules;
	}

	public function setRules($rules)
	{
		$this->rules = $rules;
	}

	public function getSubscribers()
	{
		return $this->subscribers;
	}

	public function addSubscriber(PlayerInterface $subscriber)
	{
		$this->subscribers->add($subscriber);
	}

	public function removeSubscriber(PlayerInterface $subscriber)
	{
		$this->subscribers->remove($subscriber);
	}

	public function hasSeeds()
	{
		return ($this->hasSeeds);
	}

	public function setSeeds($hasSeeds)
	{
		$this->hasSeeds = ($hasSeeds);
	}

	public function areSubscriptionsClosed()
	{
		return $this->subscriptionsClosed;
	}

	public function setSubscriptionsClosed($subscriptionsClosed)
	{
		$this->subscriptionsClosed = ($subscriptionsClosed);
	}
}