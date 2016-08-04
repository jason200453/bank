<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Reply;
use AppBundle\Entity\Message2;
use AppBundle\Entity\Messager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{

    /**
            * @Route("/message", name="index")
            */
    public function selectAction()
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilderMessage = $em->createQueryBuilder();
        $queryBuilderMessage->select('m', 'e')
            ->from('AppBundle:Message2', 'm')
            ->join('m.messager', 'e');
        $messages = $queryBuilderMessage->getQuery()->getResult();
   
        $queryReply = $em->createquery("SELECT r, m, e FROM AppBundle:Reply r JOIN r.message m JOIN r.messager e");
        $querys = $queryReply->getResult();

        return $this->render('message/message.html.php', array(
        'messages' => $messages, 'querys' => $querys
        ));
    }

    /**
            * @Route("/message/check", name="check")
            */
    public function checkMessagerAction(Request $request)
    {
        $messager = new Messager();
        
        $form = $this->createFormBuilder($messager)      
            ->add('name', 'text')
            ->add('email', 'text')
            ->add('phone', 'text')
            ->add('leave', 'submit', array('label' => 'I want leave message'))
            ->add('reply', 'submit', array('label' => 'I want reply'))
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->get('leave')->isClicked() && $form->isValid()) {
            $messager = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $queryBuilderCheck = $em->createQueryBuilder();
            $queryBuilderCheck->select('e')
               ->from('AppBundle:Messager', 'e')
               ->where('e.name = :checkname AND e.email = :checkemail AND e.phone = :checkphone')
               ->setParameter('checkname', $messager->getName())
               ->setParameter('checkemail', $messager->getEmail())
               ->setParameter('checkphone', $messager->getPhone());
            $checkMessagersQuery = $queryBuilderCheck->getQuery()->getResult();
            if (!$checkMessagersQuery) {
                $em->persist($messager);
                $em->flush();
            } else {
                foreach ($checkMessagersQuery as $messagerQuery) {
                    $messagerQueryId = $messagerQuery->getId();
                }
                return $this->redirectToRoute('write', array('messager_id' => $messagerQueryId));
            }
            return $this->redirectToRoute('write', array('messager_id' => $messager->getId()));
        }
        if ($form->get('reply')->isClicked() && $form->isValid()) {
            $id = $request->query->get('id');
            $messager = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $queryBuilderCheck = $em->createQueryBuilder();
            $queryBuilderCheck->select('e')
               ->from('AppBundle:Messager', 'e')
               ->where('e.name = :checkname AND e.email = :checkemail AND e.phone = :checkphone')
               ->setParameter('checkname', $messager->getName())
               ->setParameter('checkemail', $messager->getEmail())
               ->setParameter('checkphone', $messager->getPhone());
            $checkMessagersQuery = $queryBuilderCheck->getQuery()->getResult();
            if (!$checkMessagersQuery) {
                $em->persist($messager);
                $em->flush();
            } else {
                foreach ($checkMessagersQuery as $messagerQuery) {
                    $messagerQueryId = $messagerQuery->getId();
                }
                return $this->redirectToRoute('reply', array('messager_id' => $messagerQueryId, 'message_id' => $id));
            }
            return $this->redirectToRoute('reply', array('messager_id' => $messager->getId(), 'message_id' => $id));
        }
        return $this->render('message/check_messager.html.php', array(
        'form' => $form->createView()
        ));
    }

    /**
            * @Route("/message/write", name="write")
            */
    public function writeMessageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $message = new Message2();
        $messager_id = $request->query->get('messager_id');
        $messagerId = $em->find("AppBundle:Messager", $messager_id);

        $form = $this->createFormBuilder($message)          
            ->add('title', 'text')
            ->add('content', 'text')
            ->add('save', 'submit', array('label' => 'Leave Message'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageForm = $form->getData();
            $message->setTitle($messageForm->getTitle());
            $message->setContent($messageForm->getContent());
            $message->setMessager($messagerId);
            $em->persist($message);
            $em->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('message/write_message.html.php', array(
        'form' => $form->createView()
        ));
    }

    /**
            * @Route("/message/delete", name="delete")
            */
    public function deleteAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $queryBuilderDelete = $em->createQueryBuilder();
        $queryBuilderDelete ->delete('AppBundle:Message2', 'm')
            ->where('m.id = :id')
            ->setParameter('id', $id);
        $queryBuilderDelete->getQuery()->getResult();

        return $this->redirectToRoute('index');
    }

    /**
            * @Route("/message/alter", name="alter")
            */
    public function alterAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $queryBuilderMessage = $em->createQueryBuilder();
        $queryBuilderMessage->select('m', 'e')
           ->from('AppBundle:Message2', 'm')
           ->join('m.messager', 'e')
           ->where('m.id = :id')
           ->setParameter('id', $id);
        $querys = $queryBuilderMessage->getQuery()->getResult();
        foreach($querys as $query) {
            $title = $query->getTitle();
            $content = $query->getContent();
        }

        $message = new Message2();
        $message->setTitle($title);
        $message->setContent($content);
        $form = $this->createFormBuilder($message)
            ->add('title', 'text')
            ->add('content', 'text')
            ->add('save', 'submit', array('label' => 'Alter Message'))
            ->getForm();

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $messageForm = $form->getData();
            $queryBuilderUpdate = $em->createQueryBuilder();
            $queryBuilderUpdate ->update('AppBundle:Message2', 'm')
                      ->set('m.title', ':title')
                      ->set('m.content', ':content')
                      ->where('m.id = :id')
                      ->setParameter('id', $id)
                      ->setParameter('title', $messageForm->getTitle())
                      ->setParameter('content', $messageForm->getContent());
            $queryBuilderUpdate->getQuery()->getResult();
            
            return $this->redirectToRoute('index');
        }
 
        return $this->render('message/alter.html.php', array(
        'form' => $form->createView()
        ));   
    }

    /**
            * @Route("/message/reply", name="reply")
            */
    public function replyAction(Request $request)
    {
        $message_id = $request->query->get('message_id');
        $messager_id = $request->query->get('messager_id');
        $em = $this->getDoctrine()->getManager();
        $messagerId = $em->find("AppBundle:Messager", $messager_id);
        $messageId = $em->find("AppBundle:Message2", $message_id);

        $reply = new Reply();
        $form = $this->createFormBuilder($reply)
            ->add('reply', 'text')
            ->add('save', 'submit', array('label' => 'Reply'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $replyForm = $form->getData();
            $reply->setReply($replyForm->getReply());
            $reply->setMessage($messageId);
            $reply->setMessager($messagerId);
            $em->persist($reply);
            $em->flush();
            return $this->redirectToRoute('index');
        }
        return $this->render('message/reply.html.php', array(
        'form' => $form->createView()
        ));
    }
}
