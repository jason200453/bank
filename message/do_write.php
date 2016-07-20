<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
$message2 = new Message2();
if (isset(
    $_POST['writetitle'],
    $_POST['writename'],
    $_POST['writeemail'],
    $_POST['writecontent'])
) {
    $title=$_POST['writetitle'];
    $name = $_POST['writename'];
    $email = $_POST['writeemail'];
    $content = $_POST['writecontent'];
    if (isset($name)) {
        $message2->setName($name);
        $message2->setTitle($title);
        $message2->setEmail($email);
        $message2->setContent($content);
        $em->persist($message2);
        $em->flush();
        header("location:message_index.php");
    } else {
        header("location:write_message.php");
    }
}
