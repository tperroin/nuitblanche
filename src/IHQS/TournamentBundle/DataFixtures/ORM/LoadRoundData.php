<?php

namespace IHQS\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use IHQS\TournamentBundle\Entity\Round;

class LoadRoundData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load($manager)
    {
        $r = new Round();
        $r->setType(Round::TYPE_POOLS);
		$r->setPlayerLimit(64);
		$r->setInfos('Some informations about this first pool phase');
		$r->setOrder(1);
		$r->setTournament($this->getReference('tournament'));

        $manager->persist($r);
		$this->addReference('round-1', $r);

        $r = new Round();
        $r->setType(Round::TYPE_DOUBLE_BRACKET);
		$r->setPlayerLimit(32);
		$r->setInfos('Some informations about this double bracket round');
		$r->setOrder(2);
		$r->setTournament($this->getReference('tournament'));

        $manager->persist($r);
		$this->addReference('round-2', $r);
		
		$manager->flush();
    }

	public function getOrder()
    {
        return 3;
    }
}