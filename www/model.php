<?php
function open_database_connection()
{
    $con = mysql_connect("192.168.121.130","jason","MA6LzTwehLUvdPBZ");
    return $con;
}
function get_all_message()
{
    $con = open_database_connection();
    $result = $con->query('SELECT * FROM message ORDER BY id desc');
    for ($i = 1; $i <=mysql_num_rows($result); $i++) {
        $message = mysql_fetch_assoc($result);
        close_database_connection($con);
        return $message;
    }
}
function delete_message($id)
{
    $con = open_database_connection();
    $result = $con->query("'DELETE FROM message WHERE id = '$id'");
    header("location:admin.php");
}
