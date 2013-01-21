<?php

namespace IHQS\NuitBlancheBundle;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use IHQS\NuitBlancheBundle\Entity\User;

class ControllerListener
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType())
		{
			try {
				$token = $this->container->get('security.context')->getToken();
				if($token)
				{
					$user = $token->getUser();
					if($user instanceof User)
					{
						$user->setLastActivity(new \Datetime());
						$this->container->get('nb.entity_manager')->persist($user);
						$this->container->get('nb.entity_manager')->flush();
					}
				}
			} catch(\Exception $e) {
				return ;
			}
        }
    }
}
