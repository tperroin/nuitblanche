<?php

namespace IHQS\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load($manager)
    {
		$class = $this->container->getParameter('ihqs_tournament.model.user.class');

        $admin = new $class();
        $admin->setUsername('admin');
        $admin->setFirstName('admin');
        $admin->setLastName('admin');
		$admin->setPassword('password');
		$admin->setEmail('admin@clan-nuitblanche.org');
		$admin->setCountry('FR');

        $manager->persist($admin);
		$this->addReference('user-admin', $admin);

		foreach(range(1,64) as $i)
		{
			$name = 'user-' . $i;

			$user = new $class();
			$user->setUsername($name);
			$user->setFirstName('FirstName');
			$user->setLastName('LastName');
			$user->setPassword('password');
			$user->setCountry('FR');
			$user->setEmail($name . '@clan-nuitblanche.org');

			$manager->persist($user);
			$this->addReference($name, $user);
		}
		
		$manager->flush();
    }

	public function getOrder()
    {
        return 1;
    }
}