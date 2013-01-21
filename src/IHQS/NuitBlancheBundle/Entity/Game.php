<?php

namespace IHQS\NuitBlancheBundle\Entity;
use IHQS\NuitBlancheBundle\Entity\Base\Game as BaseGame;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\GameRepository")
 * @ORM\Table(name="game")
 * @ORM\HasLifecycleCallbacks
 */
class Game extends BaseGame
{
    const TYPE_1v1 = "1v1";
    const TYPE_2v2 = "2v2";
    const TYPE_3v3 = "3v3";
    const TYPE_4v4 = "4v4";

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\OneToMany(targetEntity="GamePlayer", mappedBy="game", cascade={"persist"})
     */
    protected $players;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $winner;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $map;
    
    /**
     * @ORM\ManyToOne(targetEntity="WarGame", inversedBy="games", cascade={"all"})
	 * @ORM\JoinColumn(name="warGame_id", nullable=true)
     */
    protected $warGame;

    /**
     * @ORM\OneToOne(targetEntity="Replay", mappedBy="game")
     */
    protected $replay;

	public function __construct()
	{
		$this->players = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	public function __clone()
	{
		if(is_object($this->players))
		{
			$clones = new \Doctrine\Common\Collections\ArrayCollection();

			foreach($this->players as $player)
			{
				$clone = clone $player;
				$clone->setGame($this);
				$clones->add($clone);
			}

			$this->players = $clones;
		}
	}

	public function __toString()
	{
		$name = array();
		$name[] = '#' . $this->getId();
		$name[] = $this->getDate()->format('Y-m-d');
		$name[] = $this->getTeamName(1) . ' vs ' . $this->getTeamName(2);
		$name[] = $this->getMap();

		return implode(' - ', $name);
	}

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getWar() {
        return $this->war;
    }

    public function setWar(War $war) {
        $this->war = $war;
    }

    public function getPlayers() {
		return $this->players;
    }

    public function setPlayers($players) {
        $this->players = $players;
    }

	public function addPlayer(GamePlayer $player) {
		$this->getPlayers()->add($player);
	}

	public function removePlayer(GamePlayer $player) {
		$this->getPlayers()->remove($player);
	}

    public function getWinner() {
        return $this->winner;
    }

    public function setWinner($winner) {
        $this->winner = $winner;
    }

    public function getMap() {
        return $this->map;
    }

    public function setMap($map) {
        $this->map = $map;
    }

    public function getReplay() {
        return $this->replay;
    }

    public function setReplay(Replay $replay) {
        $this->replay = $replay;
    }

	public function getWarGame()
	{
		return $this->warGame;
	}

	public function setWarGame(WarGame $warGame)
	{
		$this->warGame = $warGame;
		$this->setWar($warGame->getWar());
	}


	public function getType()
	{
        switch(count($this->players))
        {
            case 0: return 0;
            case 2: return Game::TYPE_1v1;
            case 4: return Game::TYPE_2v2;
            case 6: return Game::TYPE_3v3;
            case 8: return Game::TYPE_4v4;
        }

        throw new \RuntimeException('Invalid number of players for a game : ' . count($this->players));
	}

    public function getTeam1Score()
    {
        return ($this->winner == 1) ? 1: 0;
    }

    public function getTeam2Score()
    {
        return ($this->winner == 2) ? 1 : 0;
    }
}
