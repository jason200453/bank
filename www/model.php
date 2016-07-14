<?php
function openDataBaseConnection()
{
    $con = mysql_connect("192.168.121.130","jason","MA6LzTwehLUvdPBZ");
    return $con;
}

function getAllMessage()
{
    $con = openDataBaseConnection();
    $result = $con->query('SELECT * FROM message ORDER BY id desc');
    for ($i = 1; $i <=mysql_num_rows($result); $i++) {
        $message = mysql_fetch_assoc($result);
        return $message;
    }
}

function deleteMessage($id)
{
    $con = openDataBaseConnection();
    $result = $con->query("'DELETE FROM message WHERE id = '$id'");
    header("location:admin.php");
}
