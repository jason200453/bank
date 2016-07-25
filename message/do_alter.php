<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';

if (isset(
    $_POST['writeid'],
    $_POST['writetitle'],
    $_POST['writename'],
    $_POST['writeemail'],
    $_POST['writecontent'])
) {
    $id = $_POST['writeid'];
    $title = $_POST['writetitle'];
    $name = $_POST['writename'];
    $email = $_POST['writeemail'];
    $content = $_POST['writecontent'];
}
//$query = $em->createQuery("UPDATE message2 m SET m.title='$title', m.name='$name', ".
//    "m.email='$email', m.content='$content' WHERE m.id IN ($id)")->getResult();
$qb = $em->createQueryBuilder();
$qb ->update('message2', 'm')
    ->set('m.title', $qb->expr()->literal($title))
    ->set('m.name', $qb->expr()->literal($name))
    ->set('m.email', $qb->expr()->literal($email))
    ->set('m.content', $qb->expr()->literal($content))
    ->where($qb->expr()->eq('m.id', "'$id'"));
$qb->getQuery()->getResult();
header("location:admin.php");
