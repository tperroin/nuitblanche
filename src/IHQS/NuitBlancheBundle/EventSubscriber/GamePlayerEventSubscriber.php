<?php

namespace IHQS\NuitBlancheBundle\EventSubscriber;

use IHQS\NuitBlancheBundle\Entity\GamePlayer;
use IHQS\NuitBlancheBundle\Entity\SC2Profile;

class GamePlayerEventSubscriber extends BaseEventSubscriber
{
    public function updateEntity($entity)
    {
		$name = $entity->getName();
		if(!$name)
		{
			return ;
		}

		$player = $this->em->getRepository('IHQS\NuitBlancheBundle\Entity\SC2Profile')->findOneBySc2Account($name);
		if($player)
		{
			$entity->setName($name);
			$entity->setPlayer($player);
			$this->em->persist($entity);
			$this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\GamePlayer'), $entity);
		}
    }
}