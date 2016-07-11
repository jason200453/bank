<?php 
session_start();
if($_SESSION['v']!="yes"){
 header("location:login.php");
}
require("connect.php");
$id=$_GET['id'];
mysql_query("delete from message where id = '$id'");
header("location:admin.php");
?>