<?php
require_once "bootstrap.php";
require_once 'src/message2.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$query = $em->createQuery("DELETE FROM message2 m WHERE m.id = '$id'")->getResult();
header("location:admin.php");
