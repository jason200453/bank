<?php

namespace BankBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use BankBundle\Entity\Entry;

class UpdateEntryCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('update-entry');
        $this->setDescription('Update entry to mysql.');
        $this->setHelp("This command allows you to update entry from redis to mysql.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $redis = $this->getContainer()->get('snc_redis.default');

        $logger = $this->getContainer()->get('logger');

        try {

            for ($i = 0; $i < 1000; $i++) {
                $entryDetail = $redis->lpop('entry');
                $detail = json_decode($entryDetail, true);

                if (!$entryDetail) {
                    break;
                }

                $entries[] = $detail;

                $accountId = $detail['account_id'];
                $entryId = $detail['entry_id'];
                $datetime = $detail['datetime'];
                $amount = $detail['amount'];
                $balance = $detail['balance'];

                $account = $em->find('BankBundle:Account', $accountId);

                $entry = new Entry();
                $entry->setId($entryId);
                $entry->setAccount($account);
                $entry->setDatetime(\DateTime::createFromFormat('Y-m-d H:i:s', $datetime));
                $entry->setBalance($balance);
                $entry->setAmount($amount);
                $em->persist($entry);
            }

            $em->flush();
            $em->clear();

        } catch (\Exception $e) {
            krsort($entries);

            foreach ($entries as $entry) {
                $redis->lpush('entry', json_encode($entry));
            }

            $output->writeln('['.date('Y-m-d H:i:s').']'.'UpdateEntry執行失敗，redis已回推');
            $logger->error($e->getMessage());

            throw $e;
        }

        $output->writeln('['.date('Y-m-d H:i:s').']'.'UpdateEntry執行成功');
    }
}
