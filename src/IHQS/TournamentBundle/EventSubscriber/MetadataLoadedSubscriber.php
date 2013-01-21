<?php

namespace IHQS\TournamentBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Events;

class MetadataLoadedSubscriber implements EventSubscriber
{
	protected $playerClass;

	protected $dynamicMapping = array();

	public function __construct($playerClass)
	{
		$this->dynamicMapping = array(
			'IHQS\TournamentBundle\Entity\Tournament' => array(
				'admin' => array(
					'type'			=> 'ManyToOne',
					'targetEntity'	=> $playerClass,
				),
				'subscribers' => array(
					'type'			=> 'ManyToMany',
					'targetEntity'	=> $playerClass,
					'joinTable'		=> array(
						'name'	=> 'tournament_tournament_subscribers'
					),
				),
			),
			'IHQS\TournamentBundle\Entity\RoundGroup' => array(
				'players' => array(
					'type'			=> 'ManyToMany',
					'targetEntity'	=> $playerClass,
					'joinTable'		=> array(
						'name'	=> 'tournament_round_group_players'
					),
				),
			),
			'IHQS\TournamentBundle\Entity\Match' => array(
				'player1' => array(
					'type'			=> 'ManyToOne',
					'targetEntity'	=> $playerClass,
				),
				'player2' => array(
					'type'			=> 'ManyToOne',
					'targetEntity'	=> $playerClass,
				),
			),
		);
	}

	public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
	{
		$classMetadata = $eventArgs->getClassMetadata();

		$class = $classMetadata->getName();
		if(!isset($this->dynamicMapping[$class]))
		{
			return;
		}

		foreach((array) $this->dynamicMapping[$class] as $name => $fieldMapping)
		{
			$fieldMapping['fieldName'] = $name;
			$method = 'map' . $fieldMapping['type'];
			$classMetadata->$method($fieldMapping);
		}
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata
        );
    }
}