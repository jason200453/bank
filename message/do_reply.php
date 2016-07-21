<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';

$reply = new Reply();
if (isset(
    $_POST['writeid'],
    $_POST['writereply'],
    $_POST['writename'])
) {
    $id = $_POST['writeid'];
    $inreply = $_POST['writereply'];
    $name = $_POST['writename'];
    if (isset($name)) {
        $newid = $em->find("Message2",$id);
        $reply->setMessage($newid);
        $reply->setName($name);
        $reply->setReply($inreply);
        $em->persist($reply);
        $em->flush();
        header("location:message_index.php");
    } else {
        header("location:reply.php");
    }
}
