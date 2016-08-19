<?php

namespace BankBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EntryRepository extends EntityRepository
{
    public function selectEntry($accountId)
    {
        $selectEntry = $this->getEntityManager()->createQueryBuilder();

        $selectEntry->select('e');
        $selectEntry->from('BankBundle:Entry', 'e');
        $selectEntry->where('e.account = :account');
        $selectEntry->setParameter('account', $accountId);

        return $selectEntry->getQuery()->getArrayResult();
    }
}
