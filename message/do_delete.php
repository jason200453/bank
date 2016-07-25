<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$qb = $em->createQueryBuilder();
$qb ->delete('message2', 'm')
    ->where($qb->expr()->eq('m.id', "'$id'"));    
    //->where("m.id = '$id'");
$qb->getQuery()->getResult();
//$query = $em->createQuery("DELETE message2 m WHERE m.id = '$id'")->getResult();
header("location:admin.php");
