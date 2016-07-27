<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
require_once 'src/messager.php';

$reply = new Reply();
if (isset(
    $_POST['writeid'],
    $_POST['writereply'],
    $_POST['writename'])
) {
    $id = $_POST['writeid'];
    $replycontent = $_POST['writereply'];
    $name = $_POST['writename'];
    if (isset($name)) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')
           ->from('messager', 'e');
        $messagers = $qb->getQuery()->getResult();
        foreach($messagers as $messager) {
            if ($messager->getName() == $name) {
                $messageId = $em->find("Message2", $id);
                $messagerId = $em->find("Messager", $messager->getId());
                $reply->setReply($replycontent);
                $reply->setMessage($messageId);
                $reply->setMessager($messagerId);
                $em->persist($reply);
                $em->flush();
                header("location:message_index.php");
                exit();
            }
        }
        echo "<script>alert('You are not messager!!')</script>";
        echo "<script>window.location.href = 'message_index.php'</script>";
    } else {
        header("location:reply.php");
    }
}
