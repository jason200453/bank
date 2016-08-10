<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ReplyRepository extends EntityRepository
{
    public function selectAllReply()
    {
        return $this->getEntityManager()
            ->createquery("SELECT r, m, e FROM AppBundle:Reply r JOIN r.message m JOIN r.messager e")
            ->getResult();
    }
}
