<?php

namespace BankBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class BalanceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('balance');
        $this->setDescription('Balance.');
        $this->setHelp("This command allows you to transmission balance.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $redis = $this->getContainer()->get('snc_redis.default');

        try {
            $accounts = $redis->smembers('account');

            for ($i = 0; $i < count($accounts); $i++) {
                $version = $redis->hget($accounts[$i], 'version');
                $balance = $redis->hget($accounts[$i], 'balance');

                $account = $em->find('BankBundle:Account', $accounts[$i]);

                $account->setBalance($balance);
                $account->setVersion($version);
                $em->flush();

                $redis->srem('account', $accounts[$i]);
            }

        } catch (Exception $e) {

            throw $e;
        }
    }
}