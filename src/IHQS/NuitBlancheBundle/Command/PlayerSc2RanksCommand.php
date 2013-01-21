<?php

namespace IHQS\NuitBlancheBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use IHQS\NuitBlancheBundle\Entity\SC2Profile;

class PlayerSc2RanksCommand extends ContainerAwareCommand
{
	protected $api;
	
    protected function configure()
    {
        $this
            ->setName('nb:player:ranks')
            ->setDescription('Updates player sc2 ranks.')
            ->setHelp(<<<EOT
The <info>nb:player:ranks</info> command updates members sc2 ranks by requesting sc2ranks.com api.

  <info>./app/console nb:player:ranks</info>
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('nb.entity_manager');
		$players = $this->getContainer()->get('nb.manager.sc2profile')->findAll();

		$ranks = new \SC2Ranks\SC2Ranks('clan-nuitblanche.org', '\SC2Ranks\Client\Curl');
		$this->api = $ranks->getApi('player');

		foreach($players as $player)
		{
			if(!$player->getSc2Id() && !$player->getSc2RanksId()) { continue; }

            $output->writeln(sprintf('<info>Importing sc2ranks data for</info> <comment>%s#%s</comment>', $player->getSc2Account(), $player->getSc2Id()));
			$this->importSc2Ranks($player);
			$em->persist($player);
		}

		$em->flush();
    }

	protected function importSc2Ranks(SC2Profile $player)
	{
		if($player->getSc2Id() && 0 !== $player->getSc2Id())
		{
			$this->api->setAccount($player->getSc2Account(), $player->getSc2Id());
		}

		// random teams and portraits
		$teams	= $this->api->baseTeams();
		if(!$player->getSc2Id() || isset($teams->error))
		{
			$this->api->setAccountById($player->getSc2Account(), $player->getSc2RanksId());
			$teams	= $this->api->baseTeams();
		}

		$sc2ranks = array();
		if(is_object($teams) && !isset($teams->error))
		{
			$sc2ranks['base'] = array();
			if(isset($teams->portrait))
			{
				$sc2ranks['portrait'] = $teams->portrait;
			}

			foreach($teams->teams as $team)
			{
				if(!$team->is_random && $team->bracket != 1) { continue; }

				$level = 1;
				if($team->division_rank < 50) { $level = 2; }
				if($team->division_rank < 16) { $level = 3; }
				if($team->division_rank < 8)  { $level = 4; }
				$team->leaguePic = 'bundles/ihqsnuitblanche/images/sc2ranks/' . $team->league . '-' . $level . '.png';
				$team->ratio = 100 * floatval($team->ratio);

				$sc2ranks['base'][$team->bracket] = $team;
			}
		}

		$league_levels = array_flip(\SC2Ranks\Api\Division::$levels);
		
		$teams = $this->api->charTeams(2);
		if(is_object($teams) && !isset($teams->error))
		{
			foreach($teams->teams as $team)
			{
				$level = 1;
				if($team->division_rank < 50) { $level = 2; }
				if($team->division_rank < 16) { $level = 3; }
				if($team->division_rank < 8)  { $level = 4; }
				$team->leaguePic = 'bundles/ihqsnuitblanche/images/sc2ranks/' . $team->league . '-' . $level . '.png';
				$team->ratio = 100 * floatval($team->ratio);
				$team->order = ($league_levels[$team->league] * 10000) + intval($team->points);
			}
			
			usort($teams->teams, function($a, $b) {
				if($a->order == $b->order)
				{
					return 0;
				}

				return $a->order < $b->order ? 1 : -1;
			});

			$sc2ranks['_2v2teams'] = $teams->teams;
		}

		$player->setSc2Ranks($sc2ranks);
	}
}
