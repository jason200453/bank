<?php
require'connect.php';
if (isset(
    $_POST['writetitle'],
    $_POST['writename'],
    $_POST['writeemail'],
    $_POST['writegender'],
    $_POST['writecontent'])
) {
    $title=$_POST['writetitle'];
    $name = $_POST['writename'];
    $email = $_POST['writeemail'];
    $gender = $_POST['writegender'];
    $content = $_POST['writecontent'];
    if (isset($name)) {
        $query = mysql_query("INSERT INTO message VALUE('$title', '$name', ".
            "'$email', '$gender', '$content', '')");
        header("location:message_index.php");
    } else {
        header("location:write_message.php");
    }
}
