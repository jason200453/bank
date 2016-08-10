<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{
    public function selectAllMessage()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m', 'e')
            ->from('AppBundle:Message2', 'm')
            ->join('m.messager', 'e')
            ->getQuery()
            ->getResult();
    }
    
    public function deleteMessage($id)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->delete('AppBundle:Message2', 'm')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    
    public function selectMessage($id)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('m', 'e')
            ->from('AppBundle:Message2', 'm')
            ->join('m.messager', 'e')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    
    public function alterMessage($id, $title, $content)
    {
        return $this->getEntityManager()
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
    }
}
