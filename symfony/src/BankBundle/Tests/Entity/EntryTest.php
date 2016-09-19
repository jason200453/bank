<?php

namespace BankBundle\Tests\Entity;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use BankBundle\Entity\Entry;
use BankBundle\Entity\Account;

class EntryTest extends WebTestCase
{
    /**
     * 測試Entry Entity
     */
    public function testEntry()
    {
        $entry = new Entry();
        $account = new Account();

        $entry->setId(1);
        $entry->setAccount($account);
        $entry->setAmount(2000);
        $entry->setBalance(2000);
        $createTime = new \DateTime('2016-09-06 14:34:15');
        $entry->setDatetime($createTime);

        $this->assertEquals(1, $entry->getId());
        $this->assertEquals(2000, $entry->getAmount());
        $this->assertEquals(2000, $entry->getBalance());
        $this->assertEquals('2016-09-06 14:34:15', date_format($entry->getDatetime(), 'Y-m-d H:i:s'));
        $this->assertEquals($account , $entry->getAccount());
    }
}
