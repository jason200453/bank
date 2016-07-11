<?php
require 'connect.php';
$title=$_POST['writetitle'];
$name=$_POST['writename'];
$email=$_POST['writeemail'];
$gender=$_POST['writegender'];
$content=$_POST['writecontent'];

if(isset($name)){
$slq=mysql_query("insert into message value('$title','$name','$email','$gender','$content','')");
header("location:message_index.php");
}
?>

