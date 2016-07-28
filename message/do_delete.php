<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
require_once 'src/messager.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$qb = $em->createQueryBuilder();
$qb ->delete('message2', 'm')
    ->where('m.id = :id')
    ->setParameter('id', $id);
$qb->getQuery()->getResult();
header("location:admin.php");
