<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{
    public function selectAllMessage()
    {
        $allMessage = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m', 'e')
            ->from('AppBundle:Message2', 'm')
            ->join('m.messager', 'e')
            ->getQuery()
            ->getResult();

        return $allMessage;
    }

    public function deleteMessage($id)
    {
        $delete = $this->getEntityManager()
            ->createQueryBuilder()
            ->delete('AppBundle:Message2', 'm')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        return $delete;
    }

    public function selectMessage($id)
    {
        $message = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m', 'e')
            ->from('AppBundle:Message2', 'm')
            ->join('m.messager', 'e')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

        return $message;
    }

    public function alterMessage($id, $title, $content)
    {
        $alter = $this->getEntityManager()
            ->createQueryBuilder()
            ->update('AppBundle:Message2', 'm')
            ->set('m.title', ':title')
            ->set('m.content', ':content')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->setParameter('title', $title)
            ->setParameter('content', $content)
            ->getQuery()
            ->getResult();

        return $alter;
    }
}
