<?php

namespace IHQS\NuitBlancheBundle\Entity\Base;

abstract class Game
{
    const RESULT_WIN    = "win";
    const RESULT_LOSS   = "loss";
    const RESULT_DRAW   = "draw";

    static public $_results = array(
        self::RESULT_WIN	=> self::RESULT_WIN,
        self::RESULT_LOSS	=> self::RESULT_LOSS,
        self::RESULT_DRAW	=> self::RESULT_DRAW
    );
	
    protected function getTeam($team_id)
    {
        $result = array();
        foreach($this->players as $player)
        {
            if($player->getTeam() == $team_id)
            {
                array_push($result, $player);
            }
        }

        return $result;
    }

    public function getTeam1()
    {
        return $this->getTeam(1);
    }

    public function getTeam2()
    {
        return $this->getTeam(2);
    }

    public function getTeamRace($team_id)
    {
        $races = array();
        foreach($this->getTeam($team_id) as $player)
        {
            array_push($races, $player->getRace());
        }

        return implode('', $races);
    }

    public function getTeam1Race()
    {
        return $this->getTeamRace(1);
    }

    public function getTeam2Race()
    {
        return $this->getTeamRace(2);
    }

    public function getTeamName($team_id)
    {
        $races = array();
        foreach($this->getTeam($team_id) as $player)
        {
            array_push($races, $player->getName());
        }

        return implode(' ', $races);
    }

    public function getTeam1Name()
    {
        return $this->getTeamName(1);
    }

    public function getTeam2Name()
    {
        return $this->getTeamName(2);
    }

    public function getTeam1Result()
    {
        return ($this->getTeam1Score() == $this->getTeam2Score())
			? self::RESULT_DRAW
			: ($this->getTeam1Score() > $this->getTeam2Score())
				? self::RESULT_WIN
				: self::RESULT_LOSS;
    }

    public function getTeam2Result()
    {
        return ($this->getTeam1Score() == $this->getTeam2Score())
			? self::RESULT_DRAW
			: ($this->getTeam1Score() < $this->getTeam2Score())
				? self::RESULT_WIN
				: self::RESULT_LOSS;
    }
}
