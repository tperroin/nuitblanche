<?php

namespace IHQS\TournamentBundle\Model;

abstract class Match implements MatchInterface
{
    protected $group;

	protected $player1;

	protected $player2;

	protected $player1Score;

	protected $player2Score;

	protected $winner;

	protected $order;

	public function __construct()
	{
		$this->order = 0;
		$this->player1Score = 0;
		$this->player2Score = 0;
	}

	public function getGroup()
	{
		return $this->group;
	}

	public function setGroup(RoundGroupInterface $group)
	{
		$this->group = $group;
	}

	public function getPlayer1()
	{
		return $this->player1;
	}

	public function setPlayer1(PlayerInterface $player1)
	{
		$this->player1 = $player1;
	}

	public function getPlayer2()
	{
		return $this->player2;
	}

	public function setPlayer2(PlayerInterface $player2)
	{
		$this->player2 = $player2;
	}

	public function getPlayer1Score()
	{
		return $this->player1Score;
	}

	public function setPlayer1Score($player1Score)
	{
		$this->player1Score = $player1Score;
	}

	public function getPlayer2Score()
	{
		return $this->player2Score;
	}

	public function setPlayer2Score($player2Score)
	{
		$this->player2Score = $player2Score;
	}

	public function getWinner()
	{
		return $this->winner;
	}

	public function setWinner($winner)
	{
		if($winner != 1 && $winner != 2)
		{
			throw new \InvalidArgumentException('The winner value can only take the "1" or "2" values');
		}
		$this->winner = $winner;
	}

	public function getWinnerPlayer()
	{
		if(!$this->winner) { return null; }
		return $this->{"player" . $this->winner};
	}

	public function getLooserPlayer()
	{
		if(!$this->winner) { return null; }
		$looser = ($winner == 1) ? 2 : 1;
		return $this->{"player" . $looser};
	}

	public function getWinnerScore()
	{
		if(!$this->winner) { return 0; }
		return $this->{"player" . $this->winner . "Score"};
	}

	public function getLooserScore()
	{
		if(!$this->winner) { return 0; }
		$looser = ($winner == 1) ? 2 : 1;
		return $this->{"player" . $looser . "Score"};
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function setOrder($order)
	{
		$this->order = (int) $order;
	}
}