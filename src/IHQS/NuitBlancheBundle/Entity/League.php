<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\LeagueRepository")
 * @ORM\Table(name="league")
 */
class League
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="Season", mappedBy="league")
     */
    protected $seasons;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getSeasons() {
        return $this->seasons;
    }

	public function getLastSeason() {
		return $this->seasons->last();
	}

	public function __toString()
	{
		return $this->name;
	}
}