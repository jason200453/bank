<?php

namespace BankBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class UpdateBalanceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('update-balance');
        $this->setDescription('Update Balance to mysql.');
        $this->setHelp("This command allows you to update balance from redis to mysql.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $redis = $this->getContainer()->get('snc_redis.default');

        $logger = $this->getContainer()->get('logger');

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
            $logger->error($e->getMessage());

            throw $e;
        }

        $output->writeln('['.date('Y-m-d H:i:s').']'.'UpdateBalance執行成功，執行筆數:'.count($accounts));
    }
}