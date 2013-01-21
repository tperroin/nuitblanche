<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IHQS\NuitBlancheBundle\Model\SC2ProfileRepository;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\GamePlayerRepository")
 * @ORM\Table(name="gameplayer")
 * @ORM\HasLifecycleCallbacks
 */
class GamePlayer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game", cascade={"all"})
     */
    protected $game;

    /**
     * @ORM\ManyToOne(targetEntity="WarGame")
     */
    protected $warGame;

    /**
     * @ORM\ManyToOne(targetEntity="SC2Profile")
     */
    protected $player;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $race;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $color;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $apm;

    /**
     * @ORM\Column(type="integer")
     */
    protected $team;

    protected $playerRepo;

    public function getId() {
        return $this->id;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame(Game $game) {
        $this->game = $game;
    }

    public function getPlayer() {
        return $this->player;
    }

    public function setPlayer(SC2Profile $player) {
        $this->player = $player;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getRace() {
        return $this->race;
    }

    public function setRace($race) {
        if(!in_array($race, SC2Profile::$_sc2races))
        {
            throw new \InvalidArgumentException('Invalid race "' . $race . '" for StarCraft 2 Race');
        }
        $this->race = $race;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getApm() {
        return $this->apm;
    }

    public function setApm($apm) {
        $this->apm = $apm;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam($team) {
        $this->team = $team;
    }

    public function getWarGame()
    {
        return $this->warGame;
    }

    public function setWarGame(WarGame $warGame)
    {
        $this->warGame = $warGame;
    }

    public function setPlayerRepository(SC2ProfileRepository $playerRepo)
    {
        $this->playerRepo = $playerRepo;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if(is_null($this->playerRepo))
        {
            return;
        }

        $player = $this->playerRepo->findOneBySc2Account($this->getName());
        if($player instanceof SC2Profile)
        {
            $this->player = $player;
        }
    }

    public function __toString()
    {
        return $this->getName();
    }
}