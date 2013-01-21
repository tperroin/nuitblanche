<?php

namespace IHQS\NuitBlancheBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;

abstract class BaseEventSubscriber implements EventSubscriber
{
	protected $em;
	protected $uow;

	public function onFlush(OnFlushEventArgs $eventArgs)
	{
            $this->em	= $eventArgs->getEntityManager();
            $this->uow	= $this->em->getUnitOfWork();

            foreach ($this->uow->getScheduledEntityInsertions() AS $entity)
            {
                $this->doUpdateEntity($entity);
            }

            foreach ($this->uow->getScheduledEntityUpdates() AS $entity)
            {
                $this->doUpdateEntity($entity);
            }
    }

	public function doUpdateEntity($entity)
	{
		$matches = array();
		preg_match('|([\w]+)EventSubscriber|', get_class($this), $matches);
		$class = 'IHQS\\NuitBlancheBundle\\Entity\\' . $matches[1];

		if(!$entity instanceof $class)
        { 
			return ;
		}

		return $this->updateEntity($entity);
	}
	
    abstract public function updateEntity($entity);

    public function getSubscribedEvents()
    {
        return array(
            Events::onFlush
        );
    }
}