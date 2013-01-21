<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\WarRepository")
 * @ORM\Table(name="war")
 * @ORM\HasLifecycleCallbacks
 */
class War
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $maps;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="wars", cascade={"persist"})
     */
    protected $team;

    /**
     * @ORM\ManyToOne(targetEntity="Season", inversedBy="wars")
     */
    protected $season;

    /**
     * @ORM\Column(type="integer")
     */
    protected $teamScore;

    /**
     * @ORM\Column(type="string")
     */
    protected $opponentName;

    /**
     * @ORM\Column(type="integer")
     */
    protected $opponentScore;

    /**
     * @ORM\Column(type="string")
     */
    protected $opponentCountry;

    /**
     * @ORM\Column(type="string")
     */
    protected $result;

    /**
     * @ORM\OneToMany(targetEntity="WarGame", mappedBy="war", cascade={"persist", "refresh", "remove"})
     */
    protected $games;

    public function __construct()
    {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

	/**
	 * @ORM\PrePersist
	 * @ORM\PreUpdate
	 */
	public function updateTeamScores()
	{
		$prev = $this->getResult();
		
		// result
		if($this->teamScore > $this->opponentScore)		{ $this->setResult(WarGame::RESULT_WIN); }
		if($this->teamScore < $this->opponentScore)		{ $this->setResult(WarGame::RESULT_LOSS); }
		if($this->teamScore == $this->opponentScore)	{ $this->setResult(WarGame::RESULT_DRAW); }

		$next = $this->getResult();

		// season scores
		if($this->season && $next != $prev)
		{
			if($prev == WarGame::RESULT_WIN)	{ $this->season->incrWins(-1); }
			if($prev == WarGame::RESULT_LOSS)	{ $this->season->incrLosses(-1); }
			if($prev == WarGame::RESULT_DRAW)	{ $this->season->incrDraws(-1); }

			if($next == WarGame::RESULT_WIN)	{ $this->season->incrWins(); }
			if($next == WarGame::RESULT_LOSS)	{ $this->season->incrLosses(); }
			if($next == WarGame::RESULT_DRAW)	{ $this->season->incrDraws(); }
		}

		// game dates
		foreach($this->games as $warGame)
		{
			foreach($warGame->getGames() as $game)
			{
				$game->setDate($this->getDate());
			}
		}
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

    public function getMaps() {
        return $this->maps;
    }

    public function setMaps($maps) {
        $this->maps = $maps;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam(Team $team) {
        $this->team = $team;
    }

    public function getSeason() {
        return $this->season;
    }

    public function setSeason(Season $season) {
        $this->season = $season;
    }

    public function getTeamScore() {
        return $this->teamScore;
    }

    public function incrTeamScore($count = 1) {
        $this->teamScore += intval($count);
    }

    public function setTeamScore($teamScore) {
        $this->teamScore = $teamScore;
    }

    public function getOpponentName() {
        return $this->opponentName;
    }

    public function setOpponentName($opponentName) {
        $this->opponentName = $opponentName;
    }

    public function getOpponentScore() {
        return $this->opponentScore;
    }

    public function incrOpponentScore($count = 1) {
        $this->opponentScore += intval($count);
    }

    public function setOpponentScore($opponentScore) {
        $this->opponentScore = $opponentScore;
    }

    public function getOpponentCountry() {
        return $this->opponentCountry;
    }

    public function setOpponentCountry($opponentCountry) {
        $this->opponentCountry = $opponentCountry;
    }

    public function getResult() {
        return $this->result;
    }

    public function setResult($result) {
        if(!in_array($result, WarGame::$_results))
        {
            throw new \InvalidArgumentException('Invalid parameter for team result');
        }
        $this->result = $result;
    }

	public function getOpponentResult()
	{
		switch($this->result)
		{
			case WarGame::RESULT_DRAW: return WarGame::RESULT_DRAW;
			case WarGame::RESULT_WIN: return WarGame::RESULT_LOSS;
			case WarGame::RESULT_LOSS: return WarGame::RESULT_WIN;
		}
	}

    public function getGames() {
        return $this->games;
    }
	
	public function addGame(WarGame $warGame)
	{
		$this->games->add($warGame);
	}

	public function removeGame(WarGame $warGame)
	{
		$this->games->remove($warGame);
	}

	public function setGames(\Doctrine\Common\Collections\ArrayCollection $games)
	{
		$this->games = $games;
	}

	public function getReplays()
	{
		$replays = array();
		foreach($this->getGames() as $wg)
		{
			foreach($wg->getGames() as $game)
			{
				$replay = $game->getReplay();
				if($replay instanceof Replay)
				{
					array_push($replays, $game);
				}
			}
		}

		return $replays;
	}

	protected function setNumberOfGames($number, $type)
	{
		foreach(range(1, $number) as $i)
		{
			$warGame = new WarGame();
			$warGame->setWar($this);
			$warGame->setTeam1Score(0);
			$warGame->setTeam2Score(0);

			$game = new Game();
			$game->setWarGame($warGame);
			$game->setDate($this->getDate());

			foreach(range(1, 3) as $i)
			{
				$clone = clone $game;
				foreach(range(1, $type*2) as $i)
				{
					$gamePlayer = new GamePlayer();
					$gamePlayer->setGame($clone);
					$gamePlayer->setWarGame($warGame);
					$gamePlayer->setRace(SC2Profile::SC2RACE_RANDOM);
					$gamePlayer->setTeam(round($i / $type));
					$clone->addPlayer($gamePlayer);
				}

				$warGame->addGame($clone);
			}

			$this->games->add($warGame);
		}
	}

	public function getNumberOf1on1Games()
	{
		$count = 0;
		foreach($this->games as $game)
		{
			if($game->getType() == Game::TYPE_1v1)
			{
				$count++;
			}
		}

		return $count;
	}

	public function setNumberOf1on1Games($number)
	{
		return $this->setNumberOfGames($number, 1);
	}

	public function getNumberOf2on2Games()
	{
		$count = 0;
		foreach($this->games as $game)
		{
			if($game->getType() == Game::TYPE_2v2)
			{
				$count++;
			}
		}

		return $count;
	}

	public function setNumberOf2on2Games($number)
	{
		return $this->setNumberOfGames($number, 2);
	}
}
