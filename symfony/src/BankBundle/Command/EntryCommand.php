<?php

namespace BankBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use BankBundle\Entity\Entry;

class EntryCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('entry');
        $this->setDescription('Entry.');
        $this->setHelp("This command allows you to transmission entry.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $redis = $this->getContainer()->get('snc_redis.default');

        try {
            $countEntry = $redis->llen('entry');
            $batchSize = 20;

            for ($i = 0; $i < $countEntry; $i++) {
                $entryDetail = $redis->lpop('entry');
                $detail = json_decode($entryDetail);

                $accountId = $detail->account_id;
                $entryId = $detail->entry_id;
                $datetime = $detail->datetime;
                $amount = $detail->amount;
                $balance = $detail->balance;

                $account = $em->find('BankBundle:Account', $accountId);

                $entry = new Entry();
                $entry->setId($entryId);
                $entry->setAccount($account);
                $entry->setDatetime(\DateTime::createFromFormat('Y-m-d H:i:s', $datetime));
                $entry->setBalance($balance);
                $entry->setAmount($amount);
                $em->persist($entry);

                if (($i % $batchSize) == 0) {
                    $em->flush();
                    $em->clear();
                }

            }

            $em->flush();
            $em->clear();

        } catch (Exception $e) {

            throw $e;
        }
    }
}

