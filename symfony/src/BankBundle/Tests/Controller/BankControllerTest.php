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

    /*
     * 測試listAction列出交易名細-成功
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
        $this->assertCount(1, ['id']);
    }

    /*
     * 測試listAction列出交易名細-失敗
     */
    public function testListFail()
    {
        $client = static::createClient();
        $client->request('GET', '/bank/list', ['account_id' => 2]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('Failure', $output['STATUS']);
    }

    /*
     * 測試createAction新增帳戶-成功
     */
    public function testCreateSuccess()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/create', ['account' => '456987125', 'name' => 'overwatch', 'phone' => '0972654197']);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('456987125', $output['Account']);
        $this->assertEquals('overwatch', $output['Name']);
        $this->assertEquals('0972654197', $output['Phone']);
    }

    /*
     * 測試createAction新增帳戶-失敗
     */
    public function testCreateFail()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/create', ['account' => '1234567890', 'name' => 'jason', 'phone' => '0971568742']);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('Failure', $output['STATUS']);
    }

    /*
     * 測試deleteAction刪除帳戶-成功
     */
    public function testDeleteSuccess()
    {
        $client = static::createClient();
        $client->request('DELETE', '/bank/delete', ['account_id' => 1]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('Success', $output['STATUS']);
        $this->assertEquals('1234567890', $output['Account']);
    }

    /*
     * 測試deleteAction刪除帳戶-失敗
     */
    public function testDeleteFail()
    {
        $client = static::createClient();
        $client->request('DELETE', '/bank/delete', ['account_id' => 2]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('Failure', $output['STATUS']);
    }

    /**
     * 測試depositAction存錢
     */
    public function testDepositSuccess()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/deposit/1', ['amount' => 2000]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('Success', $output['STATUS']);
        $this->assertEquals(2000, $output['Amount']);
        $this->assertEquals('1234567890', $output['Account']);
        $this->assertEquals(4000, $output['Balance']);
    }

    /*
     * 測試withdrawAction領錢-成功
     */
    public function testWithdrawSuccess()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/withdraw/1', ['amount' => 2000]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('Success', $output['STATUS']);
        $this->assertEquals(-2000, $output['Amount']);
        $this->assertEquals('1234567890', $output['Account']);
        $this->assertEquals(0, $output['Balance']);
    }

    /*
     * 測試withdrawAction領錢-失敗
     */
    public function testWithdrawFail()
    {
        $client = static::createClient();
        $client->request('POST', '/bank/withdraw/1', ['amount' => 4000]);

        $json = $client->getResponse()->getContent();
        $output = json_decode($json, true);

        $this->assertEquals('Failure', $output['STATUS']);
    }
}
