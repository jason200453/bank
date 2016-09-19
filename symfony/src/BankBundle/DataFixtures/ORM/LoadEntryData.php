<?php

namespace BankBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BankBundle\Entity\Entry;

class LoadEntryData extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entry = new Entry();
        $entry->setId(1);
        $entry->setAccount($this->getReference('jason'));
        $entry->setamount(2000);
        $createTime = new \DateTime('2016-09-06 14:34:15');
        $entry->setDatetime($createTime);
        $entry->setBalance(2000);

        $manager->persist($entry);
        $manager->flush();
    }

    public function getDependencies()
    {
        return ['BankBundle\DataFixtures\ORM\LoadAccountData'];
    }
}
