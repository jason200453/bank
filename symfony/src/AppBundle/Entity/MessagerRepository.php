<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MessagerRepository extends EntityRepository
{
    public function checkMessager($name, $email, $phone)
    {
        $ckeckMessager = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('e')
            ->from('AppBundle:Messager', 'e')
            ->where('e.name = :checkname')
            ->andwhere('e.email = :checkemail')
            ->andwhere('e.phone = :checkphone')
            ->setParameter('checkname', $name)
            ->setParameter('checkemail', $email)
            ->setParameter('checkphone', $phone)
            ->getQuery()
            ->getOneOrNullResult();

        return $ckeckMessager;
    }
}
