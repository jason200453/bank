<?php

namespace BankBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EntryRepository extends EntityRepository
{
    public function selectEntry($entryId, $accountId, $offset, $limit)
    {
        $selectEntry = $this->getEntityManager()->createQueryBuilder();


        $selectEntry->select('e, a');
        $selectEntry->from('BankBundle:Entry', 'e');
        $selectEntry->join('e.account', 'a');

        if (isset($entryId)) {
            $selectEntry->where('e.id = :id');
            $selectEntry->setParameter('id', $entryId);
        }

        if (isset($accountId)) {
            $selectEntry->where('e.account = :account');
            $selectEntry->setParameter('account', $accountId);
        }

        $selectEntry->orderBy('e.id', 'DESC');
        $selectEntry->setFirstResult($offset);
        $selectEntry->setMaxResults($limit);

        return $selectEntry->getQuery()->getArrayResult();
    }
}
