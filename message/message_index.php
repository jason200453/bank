<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';

$messages = $em->getRepository('Message2')->findAll();

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>留言板</title>
    </head>
    <body>
        <div>
            <ul>
                <a href="message_index.php">Home</a>
            </ul>
            <ul>
                <a href="admin.php"><button type="button">管理留言</button></a>
            </ul>
            <ul>
            <a href="write_message.php"><button type="button">我要留言</button></a>
            </ul>
        </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
<?php
foreach($messages as $message) {

?>
        <div>
            <table align="center">
                <tr>
                    <td><?php echo $message->getTitle()?></td>
                </tr>
                <tr>
                    <td width="25%">暱稱</td>
                    <td width="75%"><?php echo $message->getName()?></td>
                </tr>
                <tr>
                    <td>信箱</td>
                    <td><?php echo $message->getEmail()?></td>
                </tr>
                <tr>
                    <td>留言內容</td>
                    <td><?php echo $message->getContent()?></td>
                </tr>
                <HR>
                <tr>
                    <td>回覆</td>
                    <td><?php echo $message->getReply()?></td>
                </tr>
            </table>
        </div>
<?php
}

?>
    </body>
</html>