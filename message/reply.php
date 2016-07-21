<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

?>
<html>
    <head>
        <title>我要回覆</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form id="form" name="form" method="post" action="do_reply.php">
            <input type="hidden" name="writeid" id="writeid" value="<?php echo $id?>" readonly/><br>
            <label>暱稱:</label>
            <input type="text"  name="writename" id="writename" rows="6"/><br>
            <label>回覆:</label>
            <input type="text"  name="writereply" id="writereply" rows="10"/><br>
            <input type="submit" name="button" id="button" value="回覆"/>
            <a href="message_index.php"><button type="button">不回覆了</button></a>
        </form>
    </body>
</html>