<?php

namespace BankBundle\Tests\Entity;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use BankBundle\Entity\Account;

class AccountTest extends WebTestCase
{
    /**
     * 測試Account Entity
     */
    public function testEntry()
    {
        $account = new Account();

        $account->setAccount('1234567890');
        $account->setBalance(2000);
        $account->setName('jason');
        $account->setPhone('0971568742');
        $account->setVersion(0);

        $this->assertNull($account->getId());
        $this->assertEquals(0, $account->getVersion());
        $this->assertEquals('1234567890', $account->getAccount());
        $this->assertEquals('jason', $account->getName());
        $this->assertEquals('0971568742', $account->getPhone());
        $this->assertEquals(2000, $account->getBalance());
    }
}
