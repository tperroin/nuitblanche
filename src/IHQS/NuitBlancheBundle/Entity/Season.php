<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\SeasonRepository")
 * @ORM\Table(name="season")
 */
class Season
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="League")
     */
    protected $league;

    /**
     * @ORM\Column(type="integer")
     */
    protected $number;

    /**
     * @ORM\Column()
     */
    protected $division;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $endDate;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $ended;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $wins;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $draws;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $losses;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\OneToMany(targetEntity="War", mappedBy="season")
     */
    protected $wars;

    public function getId() {
        return $this->id;
    }

    public function getLeague() {
        return $this->league;
    }

    public function setLeague(League $league) {
        $this->league = $league;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getDivision() {
        return $this->division;
    }

    public function setDivision($division) {
        $this->division = $division;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    public function getEnded() {
        return $this->ended;
    }

    public function setEnded($ended) {
        $this->ended = $ended;
    }

    public function getWins() {
        return $this->wins ?: 0;
    }

    public function setWins($wins) {
        $this->wins = $wins;
    }

    public function incrWins($count = 1)
    {
        $this->wins += intval($count);
    }

    public function getDraws() {
        return $this->draws ?: 0;
    }

    public function setDraws($draws) {
        $this->draws = $draws;
    }

    public function incrDraws($count = 1)
    {
        $this->draws += intval($count);
    }

    public function getLosses() {
        return $this->losses ?: 0;
    }

    public function setLosses($losses) {
        $this->losses = $losses;
    }

    public function incrLosses($count = 1)
    {
        $this->losses += intval($count);
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function getWars() {
        return $this->wars;
    }

    public function getNextWar()
    {
        $nextWar = false;
        foreach($this->wars as $war)
        {
            if($war->getDate()->getTimestamp() > time())
            {
                $nextWar = $war;
                break;
            }
        }

        return $nextWar;
    }

    public function __toString()
    {
        return $this->league->__toString() . ' - Season #' . $this->number;
    }
}
