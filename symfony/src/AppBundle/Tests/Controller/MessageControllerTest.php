<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Controller\MessageController;

class DefaultControllerTest extends WebTestCase
{
    public function testSelect()
    {
        $client = static::createClient();
        $client->request('GET', '/message');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testCheck()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/message/check');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }    
}
