<?php

namespace BankBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
    public function checkAccount($account, $name, $phone)
    {
        $ckeckAccount = $this->getEntityManager()->createQueryBuilder();

        $ckeckAccount->select('a');
        $ckeckAccount->from('BankBundle:Account', 'a');
        $ckeckAccount->where('a.account = :checkaccount');
        $ckeckAccount->andwhere('a.name = :checkname');
        $ckeckAccount->andwhere('a.phone = :checkphone');
        $ckeckAccount->setParameter('checkaccount', $account);
        $ckeckAccount->setParameter('checkname', $name);
        $ckeckAccount->setParameter('checkphone', $phone);

        return $ckeckAccount->getQuery()->getOneOrNullResult();
    }

    public function selectAccount($id)
    {
        $selectAccount = $this->getEntityManager()->createQueryBuilder();

        $selectAccount->select('a');
        $selectAccount->from('BankBundle:Account', 'a');
        $selectAccount->where('a.id = :checkid');
        $selectAccount->setParameter('checkid', $id);

        return $selectAccount->getQuery()->getOneOrNullResult();
    }

    public function alterBalance($balance, $id)
    {
        $alterBalance = $this->getEntityManager()->createQueryBuilder();

        $alterBalance->update('BankBundle:Account', 'a');
        $alterBalance->set('a.balance', ':balance');
        $alterBalance->where('a.id = :id');
        $alterBalance->setParameter('id', $id);
        $alterBalance->setParameter('balance', $balance);

        return $alterBalance->getQuery()->getOneOrNullResult();
    }
}

