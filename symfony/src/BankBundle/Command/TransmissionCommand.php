<?php
namespace BankBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class TransmissionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('transmission');
        $this->setDescription('Transmission.');
        $this->setHelp("This command allows you to transmission balance.");
        $this->addArgument('accountId', InputArgument::REQUIRED, 'The accountId.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $output->writeln('AccountId: '.$input->getArgument('accountId'));
        $redis = $this->getContainer()->get('snc_redis.default');

        $balance = $redis->hget($input->getArgument('accountId'), 'balance');
        //$version = $redis->hget($input->getArgument('accountId'), 'version');

        $account = $em->find('BankBundle:Account', $input->getArgument('accountId'));
        $account->setBalance($balance);
        $em->flush();

        $output->writeln('Success');
    }
}