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
}

