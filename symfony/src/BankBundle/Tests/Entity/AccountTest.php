<?php
namespace BankBundle\Tests\Entity;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class AccountTest extends WebTestCase implements ContainerAwareInterface
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
     * 測試Account Entity
     */
    public function testEntry()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $account = $em->find('BankBundle:Account', 1);

        $this->assertEquals(1, $account->getId());
        $this->assertEquals(0, $account->getVersion());
        $this->assertEquals('jason', $account->getName());
        $this->assertEquals('0971568742', $account->getPhone());
        $this->assertEquals(2000, $account->getBalance());
    }
}
