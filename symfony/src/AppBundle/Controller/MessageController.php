<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Reply;
use AppBundle\Entity\Message2;
use AppBundle\Entity\Messager;
use AppBundle\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class MessageController extends Controller
{
    /**
            * @Route("/message", name="index")
            */
    public function selectAction()
    {
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('AppBundle:Message2')->selectAllMessage();
        $querys = $em->getRepository('AppBundle:Reply')->selectAllReply();

        return $this->render('message/message.html.php', array('messages' => $messages, 'querys' => $querys));
    }

    /**
            * @Route("/message/check", name="check")
            */
    public function checkMessagerAction(Request $request)
    {
        $messager = new Messager();
        $form = $this->createForm(Form\CheckType::class, $messager);

        $form->handleRequest($request);

        if ($form->get('leave')->isClicked() && $form->isValid()) {
            $messager = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $checkMessagersQuery = $em->getRepository('AppBundle:Messager')
                ->checkMessager($messager->getName(), $messager->getEmail(), $messager->getPhone());

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
            if ($request->query->get('id') == NULL) {
                return $this->redirectToRoute('index');
            }
            $id = $request->query->get('id');
            $messager = $form->getData();
            $em = $this->getDoctrine()->getManager();

             $checkMessagersQuery = $em->getRepository('AppBundle:Messager')
                ->checkMessager($messager->getName(), $messager->getEmail(), $messager->getPhone());

            if (!$checkMessagersQuery) {
                $em->persist($messager);
                $em->flush();
                return $this->redirectToRoute('reply', array('messager_id' => $messager->getId(), 'message_id' => $id));
            } else {
                foreach ($checkMessagersQuery as $messagerQuery) {
                    $messagerQueryId = $messagerQuery->getId();
                }
                return $this->redirectToRoute('reply', array('messager_id' => $messagerQueryId, 'message_id' => $id));
            }
        }
        return $this->render('message/check_messager.html.php', array('form' => $form->createView()));
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
        $form = $this->createForm(Form\LeaveMessageType::class, $message);

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
        return $this->render('message/write_message.html.php', array('form' => $form->createView()));
    }

    /**
            * @Route("/message/delete", name="delete")
            */
    public function deleteAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Message2')->deleteMessage($id);

        return $this->redirectToRoute('index');
    }

    /**
            * @Route("/message/alter", name="alter")
            */
    public function alterAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();

        $querys = $em->getRepository('AppBundle:Message2')->selectMessage($id);
        foreach($querys as $query) {
            $title = $query->getTitle();
            $content = $query->getContent();
        }

        $message = new Message2();
        $message->setTitle($title);
        $message->setContent($content);

        $form = $this->createForm(Form\AlterMessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageForm = $form->getData();
            $em->getRepository('AppBundle:Message2')
               ->alterMessage($id, $messageForm->getTitle(), $messageForm->getContent());

            return $this->redirectToRoute('index');
        }
        return $this->render('message/alter.html.php', array('form' => $form->createView()));
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
        $form = $this->createForm(Form\ReplyType::class, $reply);

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
        return $this->render('message/reply.html.php', array('form' => $form->createView()));
    }
}
