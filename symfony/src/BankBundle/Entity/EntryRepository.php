<?php

namespace BankBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EntryRepository extends EntityRepository
{
    public function selectEntry($accountId, $offset, $limit)
    {
        $selectEntry = $this->getEntityManager()->createQueryBuilder();

        $selectEntry->select('e, a');
        $selectEntry->from('BankBundle:Entry', 'e');
        $selectEntry->join('e.account', 'a');
        $selectEntry->where('e.account = :account');
        $selectEntry->orderBy('e.datetime', 'DESC');
        $selectEntry->setParameter('account', $accountId);
        $selectEntry->setFirstResult($offset);
        $selectEntry->setMaxResults($limit);

        return $selectEntry->getQuery()->getArrayResult();
    }

    public function allEntry($offset, $limit)
    {
        $selectEntry = $this->getEntityManager()->createQueryBuilder();

        $selectEntry->select('e, a');
        $selectEntry->from('BankBundle:Entry', 'e');
        $selectEntry->join('e.account', 'a');
        $selectEntry->orderBy('e.datetime', 'DESC');
        $selectEntry->setFirstResult($offset);
        $selectEntry->setMaxResults($limit);

        return $selectEntry->getQuery()->getArrayResult();
    }
}
