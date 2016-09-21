<?php

namespace BankBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class BankControllerTest extends WebTestCase
{
    public function setUp()
    {
        $classes = [
            'BankBundle\DataFixtures\ORM\LoadAccountData',
            'BankBundle\DataFixtures\ORM\LoadEntryData',
        ];

        $this->loadFixtures($classes);
    }

    /**
     * 測試listAction列出交易名細成功
     *
     * @group list
     */
    public function testListSuccess()
    {
        $client = static::createClient();
        $client->request('GET', '/bank/list');

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals(1, $output[0]['id']);
        $this->assertEquals(2000, $output[0]['amount']);
        $this->assertEquals(1, $output[0]['account']['id']);
        $this->assertEquals(2000, $output[0]['balance']);
        $this->assertCount(1, $output);
    }

    /**
     * 測試listAction列出單張交易名細
     *
     * @group list
     */
    public function testListEntrySuccess()
    {
        $client = static::createClient();
        $client->request('GET', '/bank/list?entry_id=1');

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals(1, $output[0]['id']);
        $this->assertEquals(2000, $output[0]['amount']);
        $this->assertEquals(1, $output[0]['account']['id']);
        $this->assertEquals(2000, $output[0]['balance']);
    }

    /**
     * 測試listAction列出交易名細失敗
     *
     * @group list
     */
    public function testListFail()
    {
        $client = static::createClient();
        $client->request('GET', '/bank/list', ['account_id' => 2]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('failure', $output['status']);
    }

    /**
     * 測試createAction新增帳戶成功
     *
     * @group create
     */
    public function testCreateSuccess()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/create', ['account' => '456987125', 'name' => 'overwatch', 'phone' => '0972654197']);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('456987125', $output['account']);
        $this->assertEquals('overwatch', $output['name']);
        $this->assertEquals('0972654197', $output['phone']);
    }

    /**
     * 測試createAction新增帳戶失敗
     *
     * @group create
     */
    public function testCreateFail()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/create', ['account' => '1234567890', 'name' => 'jason', 'phone' => '0971568742']);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('failure', $output['status']);
    }

    /**
     * 測試deleteAction刪除帳戶成功
     *
     * @group delete
     */
    public function testDeleteSuccess()
    {
        $client = static::createClient();
        $client->request('DELETE', '/bank/delete', ['account_id' => 1]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('success', $output['status']);
        $this->assertEquals('1234567890', $output['account']);

        $client->request('DELETE', '/bank/delete', ['account_id' => 1]);

        $jsonCheck = $client->getResponse()->getContent();
        $outputCheck = json_decode($jsonCheck, true);

        $this->assertEquals('failure', $outputCheck['status']);
    }

    /**
     * 測試deleteAction刪除帳戶失敗
     *
     * @group delete
     */
    public function testDeleteFail()
    {
        $client = static::createClient();
        $client->request('DELETE', '/bank/delete', ['account_id' => 2]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('failure', $output['status']);
    }

    /**
     * 測試depositAction存錢
     *
     * @group deposit
     */
    public function testDepositSuccess()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/deposit/1', ['amount' => 2000]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('success', $output['status']);
        $this->assertEquals(2000, $output['amount']);
        $this->assertEquals('1234567890', $output['account']);
        $this->assertEquals(2000, $output['balance']);

        $client->request('GET', '/bank/list', ['account_id' => 1]);

        $jsonCheck = $client->getResponse()->getContent();
        $outputCheck = json_decode($jsonCheck, true);

    }

    /**
     * 測試withdrawAction領錢成功
     *
     * @group withdraw
     */
    public function testWithdrawSuccess()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/withdraw/1', ['amount' => 2000]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('success', $output['status']);
        $this->assertEquals(-2000, $output['amount']);
        $this->assertEquals('1234567890', $output['account']);
        $this->assertEquals(0, $output['balance']);

        $client->request('GET', '/bank/list', ['account_id' => 1]);

        $jsonCheck = $client->getResponse()->getContent();
        $outputCheck = json_decode($jsonCheck, true);

    }

    /**
     * 測試withdrawAction領錢失敗
     *
     * @group withdraw
     */
    public function testWithdrawFail()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/withdraw/1', ['amount' => 4000]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('failure', $output['status']);
    }

    /**
     * 測試withdrawAction領錢例外
     *
     * @group withdraw
     */
    public function testWithdrawException()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/withdraw/999', ['amount' => 1000]);

        $output = $client->getResponse()->getContent();

        $this->assertContains('Something went wrong!', $output);
    }

    /**
     * 測試depositAction存錢例外
     *
     * @group deposit
     */
    public function testDepositException()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/deposit/999', ['amount' => 1000]);

        $output = $client->getResponse()->getContent();

        $this->assertContains('Something went wrong!', $output);
    }
}
