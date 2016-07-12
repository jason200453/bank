<?php
session_start();
if (isset($_POST['usr'])) {
    require 'connect.php';
    $username=$_POST['usr'];
    $password=$_POST['pwd'];
    $query=mysql_query("SELECT * FROM  account WHERE username = '$username' and password = '$password'");
    if (!$query) {
        die('Could not connect: ' . mysql_error());
    }
    if (mysql_num_rows($query) >= 1) {
        header("location:admin.php");
        $_SESSION['v']="yes";
    } else {
        header("location:login.php");
    }
}

?>
<html>
    <head>
        <title>登入</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form id="form" name="form" method="post" action="">
           <label>帳號:</label>
           <input type="text" name="usr" id="writetitle"/><br>
           <label>密碼:</label>
           <input type="text" name="pwd" id="writename"/><br>
            <input type="submit" name="button" id="button" value="登入"/>
            <a href="message_index.php"><button type="button">回留言板</button></a>
        </form>
    </body>
</html>
