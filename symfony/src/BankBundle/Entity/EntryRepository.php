<?php

namespace BankBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EntryRepository extends EntityRepository
{
    public function selectEntry($id)
    {
        $alterBalance = $this->getEntityManager()->createQueryBuilder();

        $alterBalance->select('e', 'a');
        $alterBalance->from('BankBundle:Entry', 'e');
        $alterBalance->join('e.account', 'a');
        $alterBalance->where('e.id = :id');
        $alterBalance->setParameter('id', $id);

        return $alterBalance->getQuery()->getOneOrNullResult();
    }
}
