<?php
require 'connect.php';
$messageTitle=$_POST['writetitle'];
$messageName=$_POST['writename'];
$messageEmail=$_POST['writeemail'];
$messageGender=$_POST['writegender'];
$messageContent=$_POST['writecontent'];
if (isset($messageName)) {
    $query=mysql_query("INSERT INTO message value('$messageTitle','$messageName','$messageEmail','$messageGender','$messageContent','')");
    header("location:message_index.php");
}
