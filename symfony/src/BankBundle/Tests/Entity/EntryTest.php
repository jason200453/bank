<?php
namespace BankBundle\Tests\Entity;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class EntryTest extends WebTestCase implements ContainerAwareInterface
{
    public function setUp()
    {
        $classes = [
            'BankBundle\DataFixtures\ORM\LoadAccountData',
            'BankBundle\DataFixtures\ORM\LoadEntryData',
        ];

        $this->loadFixtures($classes);
    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * 測試Entry Entity
     */
    public function testEntry()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $entry = $em->find('BankBundle:Entry', 1);
        $account = $entry->getAccount();

        $this->assertEquals(1, $entry->getId());
        $this->assertEquals(2000, $entry->getAmount());
        $this->assertEquals(2000, $entry->getBalance());
        $this->assertEquals('2016-09-06 14:34:15', date_format($entry->getDatetime(), 'Y-m-d H:i:s'));
        $this->assertEquals($account, $entry->getAccount());
    }
}
