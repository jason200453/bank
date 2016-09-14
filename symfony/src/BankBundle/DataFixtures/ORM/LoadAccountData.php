<?php

namespace BankBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use BankBundle\Entity\Account;

class LoadAccountData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $account = new Account();
        $account->setAccount('1234567890');
        $account->setName('jason');
        $account->setPhone('0971568742');
        $account->setBalance(2000);
        $account->setVersion(0);

        $manager->persist($account);
        $manager->flush();

        $this->addReference('jason', $account);
    }
}
