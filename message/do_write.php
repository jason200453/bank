<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
require_once 'src/messager.php';

$message2 = new Message2();
$messager = new Messager();
if (isset(
    $_POST['writetitle'],
    $_POST['writename'],
    $_POST['writeemail'],
    $_POST['writecontent'],
    $_POST['writephone'])
) {
    $title=$_POST['writetitle'];
    $name = $_POST['writename'];
    $email = $_POST['writeemail'];
    $content = $_POST['writecontent'];
    $phone = $_POST['writephone'];
    if (isset($name)) {
        $qb = $em->createQueryBuilder();
        $qb->select('e')
           ->from('messager', 'e');
        $messagers = $qb->getQuery()->getResult();
        foreach($messagers as $messagerQuery) {
            if ($messagerQuery->getName() == $name
                and $messagerQuery->getEmail() == $email
                and $messagerQuery->getPhone() == $phone
            ) {
                $messagerId1 = $em->find("Messager", $messagerQuery->getId());
                $message2->setTitle($title);
                $message2->setContent($content);
                $message2->setMessager($messagerId1);
                $em->persist($message2);
                $em->flush();
                break;
            } else {
                $messager->setName($name);
                $messager->setEmail($email);
                $messager->setPhone($phone);
                $em->persist($messager);
                $em->flush();
                $qb1 = $em->createQueryBuilder();
                $qb1->select('e')
                    ->from('messager', 'e')
                    ->where($qb1->expr()->eq('e.name', "'$name'"));
                $qb1Outs = $qb1->getQuery()->getResult();
                foreach($qb1Outs as $qb1Out) {
                    $message2->setTitle($title);
                    $message2->setContent($content);
                    $messagerId2 = $em->find("Messager", $qb1Out->getId());
                    $message2->setMessager($messagerId2);
                    $em->persist($message2);
                    $em->flush();
                    break;
                }
            }
        }
        header("location:message_index.php");
    } else {
        header("location:write_message.php");
    }
}
