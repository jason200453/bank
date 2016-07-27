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
    ->set('m.title', $qb->expr()->literal($title))
    ->set('m.content', $qb->expr()->literal($content))
    ->where($qb->expr()->eq('m.id', "'$id'"));
$qb->getQuery()->getResult();
header("location:admin.php");
