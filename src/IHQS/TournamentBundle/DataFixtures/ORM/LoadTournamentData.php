<?php

namespace IHQS\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use IHQS\TournamentBundle\Entity\Tournament;

class LoadTournamentData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load($manager)
    {
        $t = new Tournament();
        $t->setDate(new \Datetime());
        $t->setName('Test tournament');
        $t->setDescription('A first tournament created on data fixtures');
        $t->setRules('Every one\'s invited !');

		foreach(range(1,64) as $i)
		{
			$t->addSubscriber($this->getReference('user-' . $i));
		}

        $manager->persist($t);
		$this->addReference('tournament', $t);
		
		$manager->flush();
    }

	public function getOrder()
    {
        return 2;
    }
}