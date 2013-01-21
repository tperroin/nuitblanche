<?php

namespace IHQS\NuitBlancheBundle\EventSubscriber;

use IHQS\NuitBlancheBundle\Entity\Game;

class GameEventSubscriber extends BaseEventSubscriber
{
    public function updateEntity($entity)
    {
		// war game update
        $warGame = $entity->getWarGame();
        if(!$warGame) { return ; }

		$warGame->updateTeamScores();
		$this->em->persist($warGame);
		$this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\WarGame'), $warGame);

		// war update
		$war = $warGame->getWar();
        if(!$war) {  return ; }

		$war->updateTeamScores();
		$this->em->persist($war);
		$this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\War'), $war);

		// season update
		$season = $war->getSeason();
        if(!$season) {  return ; }
		$this->em->persist($season);
		$this->uow->computeChangeSet($this->em->getClassMetadata('IHQS\NuitBlancheBundle\Entity\Season'), $season);

	}
}