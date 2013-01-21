<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\TeamRepository")
 * @ORM\Table(name="team")
 */
class Team
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
    protected $icon;

    /**
     * @ORM\Column(type="string")
     */
    protected $tag;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="teams")
     * @ORM\JoinTable()
     */
    protected $players;

    /**
     * @ORM\OneToMany(targetEntity="War", mappedBy="team")
     */
    protected $wars;

    /**
     * @ORM\ManyToOne(targetEntity="TeamGame")
     */
    protected $teamGame;

    protected $statsInit = false;
    protected $stats;

    public function __construct()
    {
        $this->wars	= new \Doctrine\Common\Collections\ArrayCollection();
        $this->players	= new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon($icon) {
        $this->icon = $icon;
    }

    public function getTag() {
        return $this->tag;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }

    public function getTeamGame() {
        return $this->teamGame;
    }

    public function setTeamGame(TeamGame $teamGame) {
        $this->teamGame = $teamGame;
    }

    public function getWars() {
        return $this->wars;
    }

    public function getPlayers() {
        return $this->players;
    }

    public function addPlayer(User $user)
    {
        $this->players->add($user);
    }

    public function removePlayer(User $user)
    {
        $this->players->remove($user);
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getStats()
    {
        if($this->statsInit) { return $this->stats; }

        $this->initStatsVariables();

        foreach($this->getWars() as $war)
        {
            switch($war->getResult())
            {
                case Game::RESULT_WIN:
                    $this->stats['wars']['wins']++;
                    break;
                case Game::RESULT_LOSS:
                    $this->stats['wars']['losses']++;
                    break;
                default:
                case Game::RESULT_DRAW:
                    $this->stats['wars']['draws']++;
                    break;
            }

            foreach($war->getGames() as $game)
            {
                if($game->getGames()->count() === 0
                || $game->getType() === 0)
                {
                    continue;
                }
                $type = "_" . $game->getType();

                if($game->getTeam1Result() == Game::RESULT_WIN)     { $this->stats[$type]["wins"]++; }
                if($game->getTeam1Result() == Game::RESULT_LOSS)    { $this->stats[$type]["losses"]++; }
            }
        }

        foreach($this->stats as $type => $data)
        {
            $this->stats[$type]["ratio"] = (($data["losses"] + $data["wins"]) == 0)
                ? 0
                : round(100 * $data["wins"] / ($data["losses"] + $data["wins"]));
        }

        $this->statsInit = true;
        return $this->stats;
    }

    public function initStatsVariables()
    {
        $this->stats = array(
            "_1v1" => array(),
            "_2v2" => array(),
            "wars" => array(),
        );

        foreach($this->stats as $type => $data)
        {
            $this->stats[$type] = array(
                "wins"      => 0,
                "losses"    => 0,
                "ratio"     => 0
            );
        }

        $this->stats['wars']['draws'] = 0;
    }
}