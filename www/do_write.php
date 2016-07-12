<?php
require 'connect.php';
if (isset($_POST['writetitle'], $_POST['writename'], $_POST['writeemail'], $_POST['writegender'], $_POST['writecontent'])) {
    $messageTitle=$_POST['writetitle'];
    $messageName=$_POST['writename'];
    $messageEmail=$_POST['writeemail'];
    $messageGender=$_POST['writegender'];
    $messageContent=$_POST['writecontent'];
    if (isset($messageName)) {
        $query=mysql_query("INSERT INTO message VALUE('$messageTitle','$messageName','$messageEmail','$messageGender','$messageContent','')");
        header("location:message_index.php");
    }
}
