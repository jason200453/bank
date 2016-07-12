<?php 
session_start();
if ($_SESSION['v']!="yes") {
    header("location:login.php");
}
require("connect.php");
$id=$_GET['id'];
$query=mysql_query("DELETE FROM message WHERE id = '$id'");
header("location:admin.php");
