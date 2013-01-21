<?php

namespace IHQS\NuitBlancheBundle\Processor;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\EntityManager;
use IHQS\NuitBlancheBundle\Entity\Replay;
use IHQS\NuitBlancheBundle\Entity\Game;
use IHQS\NuitBlancheBundle\Entity\GamePlayer;
use SC2Chart\SC2Chart;
use SC2Chart\Replay\ReplayInterface;

class ReplayProcessor
{
    static protected $is_init = false;
    static protected $lib_dir;
    static protected $replay_dir;

    protected $em;

    public function __construct(EntityManager $em, $analyzerClass = '\SC2Chart\Bridge\SC2Replay\Analyzer', $charterClass = '\SC2Chart\Charter\GDCharter')
    {
        $this->em = $em;

        $analyzer = new $analyzerClass();
        $charter  = new $charterClass();
        $sc2chart = new SC2Chart($analyzer, $charter);
        $this->sc2chart = $sc2chart;
    }

    static public function init()
    {
        if(!self::$is_init)
        {
            $rootDir = __DIR__.'/../../../../';
            self::$lib_dir		= $rootDir . '/vendor/sc2replays/';
            self::$replay_dir	= $rootDir . '/web';

            require_once(self::$lib_dir . 'sc2replay.php');
            require_once(self::$lib_dir . 'mpqfile.php');
            self::$is_init = true;
        }
    }

    public function updateFile(Replay $replay, UploadedFile $file)
    {
        self::init();

        $file  = $this->moveFile($file);
        $chart = $this->buildChart($replay, $file);
        $sc2replay = $this->sc2chart->getReplay();

        $this->updateGame($replay->getGame(), $sc2replay);

        $stats = stat($file);
        $replay->doSetFile($file);
        $replay->setSize(round($stats['size'] / 1024));
        $replay->setLength($sc2replay->getLength());
        $replay->setRealm($sc2replay->getRealm());
        $replay->setVersion($sc2replay->getVersion() . '.' . $sc2replay->getBuild());
        $replay->setChatLog($sc2replay->getMessages());

        $obs = array();
        foreach($sc2replay->getPlayers() as $player)
        {
            if($player->isObs())
            {
                $obs[] = $player->getName();
            }
        }
        $replay->setObs($obs);
    }

    protected function moveFile(UploadedFile $file)
    {
        $dir = self::$replay_dir . '/upload/replay';
        $file->move($dir);
        $movedFile = $dir . '/' . $file->getBasename();

        return $movedFile;
    }

    protected function buildChart(Replay $replay, $file)
    {
        $chart = '/upload/chart/' . basename($file) . '.png';
        $this->sc2chart->populate($file, self::$replay_dir . $chart);

        $replay->setChart($chart);
    }

    public function updateGame(Game $game, ReplayInterface $sc2replay)
    {
        $game->setMap($sc2replay->getMap());
        $game->setDate($sc2replay->getCtime());

        foreach($sc2replay->getPlayers() as $player)
        {
            if($player->isObs())
            {
                continue;
            }

            $actions = array_sum($player->getActions());
            $apm = round(60 * $actions / $sc2replay->getLength());

            $name = $player->getName();
            $db_player = $this->em->getRepository('IHQS\NuitBlancheBundle\Entity\SC2Profile')->findOneBySc2Account($name);

			// looking for an existing game player
			$gp = null;
			foreach($game->getPlayers() as $gameplayer)
			{
				if($gameplayer->getName() === $name)
				{
					$gp = $gameplayer;
					break;
				}
			}

			// creating a new one if need
			if(!$gp)
			{
				$gp = new GamePlayer();
				$gp->setGame($game);
				$gp->setName($name);
				$gp->setTeam($player->getTeam());
				if(!is_null($db_player)) { $gp->setPlayer($db_player); }

				// binding war games
				$wg = $game->getWarGame();
				if($wg instanceof WarGame)
				{
					$gp->setWarGame($wg);
				}
				$game->addPlayer($gp);

				if($player->isWinner())
				{
					$game->setWinner($player->getTeam());
				}
			}

			$gp->setRace(strtolower($player->getRace()));
			$gp->setColor($player->getColor());
			$gp->setApm($apm);
        }
    }
}
