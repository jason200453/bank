<?php
namespace BankBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class BankControllerTest extends WebTestCase
{
    public function setUp()
    {
        $classes = array(
            'BankBundle\DataFixtures\ORM\LoadAccountData',
            'BankBundle\DataFixtures\ORM\LoadEntryData',
        );
        $this->loadFixtures($classes);
    }

    /*
     * 測試listAction列出交易名細
     */
    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/bank/list');
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertContains('jason', $client->getResponse()->getContent());

        $client->request('GET', '/bank/list', ['account_id' => 2]);
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertContains('Fail', $client->getResponse()->getContent());
    }

    /*
     * 測試createAction新增帳戶
     */
    public function testCreate()
    {
        $client = static::createClient();

        $client->request('POST', '/bank/create', ['account' => '456987125', 'name' => 'overwatch', 'phone' => '0972654197']);
        $this->assertContains('Success', $client->getResponse()->getContent());

        $client->request('POST', '/bank/create', ['account' => '456987125', 'name' => 'overwatch', 'phone' => '0972654197']);
        $this->assertContains('Fail', $client->getResponse()->getContent());
    }

    /*
     * 測試deleteAction刪除帳戶
     */
    public function testDelete()
    {
        $client = static::createClient();

        $client->request('DELETE', '/bank/delete', ['account_id' => 2]);
        $this->assertContains('Fail', $client->getResponse()->getContent());

        $client->request('DELETE', '/bank/delete', ['account_id' => 1]);
        $this->assertContains('Success', $client->getResponse()->getContent());
    }

    /**
     * 測試depositAction存錢
     */
    public function testDeposit()
    {
        $client = static::createClient();

        $client->request('POST', '/bank/deposit/1', ['amount' => 2000]);
        $this->assertContains('Success', $client->getResponse()->getContent());
    }

    /*
     * 測試withdrawAction領錢
     */
    public function testWithdraw()
    {
        $client = static::createClient();

        $client->request('POST', '/bank/withdraw/1', ['amount' => 2000]);
        $this->assertContains('Success', $client->getResponse()->getContent());

        $client->request('POST', '/bank/withdraw/1', ['amount' => 2000]);
        $this->assertContains('Fail', $client->getResponse()->getContent());
    }
}
