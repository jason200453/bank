<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
require_once 'src/messager.php';

$qbm = $em->createQueryBuilder();
$qbm->select('m', 'e')
    ->from('message2', 'm')
    ->join('m.messager', 'e');
$messages = $qbm->getQuery()->getResult();

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
                    <td><a href="reply.php?id=<?php echo $message->getId()?>"><button type="button"> 回覆</button></a></td>
                </tr>
                <tr>
                    <td width="25%">暱稱</td>
                    <td width="75%"><?php echo $message->getMessager()->getName()?></td>
                </tr>
                <tr>
                    <td>信箱</td>
                    <td><?php echo $message->getMessager()->getEmail()?></td>
                </tr>
                <tr>
                    <td>留言內容</td>
                    <td><?php echo $message->getContent()?></td>
                </tr>
                <tr>
                    <td>回覆內容</td>
                    <td>
                    <?php
                    $id = $message->getId();
                    $queryReply = $em->createQueryBuilder();
                    $queryReply->select('m', 'e', 'r')
                               ->from('reply', 'r')
                               ->join('r.message', 'm')
                               ->join('r.messager', 'e')
                               ->where($queryReply->expr()->eq('m.id', "'$id'"));
                    $querys = $queryReply->getQuery()->getResult();
                    foreach($querys as $reply) {
                        echo $reply->getMessager()->getName().":".$reply->getReply()."\n";
                    }

                    ?>
                    </td>
                </tr>
                <HR>
            </table>
        </div>
<?php
}

?>
    </body>
</html>