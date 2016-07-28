<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
require_once 'src/messager.php';

if (isset(
    $_POST['writeid'],
    $_POST['writetitle'],
    $_POST['writecontent'])
) {
    $id = $_POST['writeid'];
    $title = $_POST['writetitle'];
    $content = $_POST['writecontent'];
}
$qb = $em->createQueryBuilder();
$qb ->update('message2', 'm')
    ->set('m.title', ':title')
    ->set('m.content', ':content')
    ->where('m.id = :id')
    ->setParameter('id', $id)
    ->setParameter('title', $title)
    ->setParameter('content', $content);
$qb->getQuery()->getResult();
header("location:admin.php");
