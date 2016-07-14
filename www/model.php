<?php
function open_Database_Connection()
{
    $con = mysql_connect("192.168.121.130","jason","MA6LzTwehLUvdPBZ");
    return $con;
}

function get_All_Message()
{
    $con = open_Database_Connection();
    $result = $con->query('SELECT * FROM message ORDER BY id desc');
    for ($i = 1; $i <=mysql_num_rows($result); $i++) {
        $message = mysql_fetch_assoc($result);
        return $message;
    }
}

function delete_Message($id)
{
    $con = open_Database_Connection();
    $result = $con->query("'DELETE FROM message WHERE id = '$id'");
    header("location:admin.php");
}
