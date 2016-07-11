<?php
require 'connect.php';
$id=$_POST['writeid'];
$title=$_POST['writetitle'];
$name=$_POST['writename'];
$email=$_POST['writeemail'];
$gender=$_POST['writegender'];
$content=$_POST['writecontent'];
mysql_query("update message set title='$title',name='$name',email='$email',gender='$gender',content='$content' where id='$id'");
header("location:admin.php");
?>