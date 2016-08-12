<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MessagerRepository extends EntityRepository
{
    public function checkMessager($name, $email, $phone)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('e')
            ->from('AppBundle:Messager', 'e')
            ->where('e.name = :checkname AND e.email = :checkemail AND e.phone = :checkphone')
            ->setParameter('checkname', $name)
            ->setParameter('checkemail', $email)
            ->setParameter('checkphone', $phone)
            ->getQuery()
            ->getResult();
    }
}
