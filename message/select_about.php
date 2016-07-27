<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
require_once 'src/messager.php';

if (isset(
    $_POST['writeemail'],
    $_POST['writephone'])
) {
    $email = $_POST['writeemail'];
    $phone = $_POST['writephone'];
    $qbMessagerId = $em->createQueryBuilder();
    $qbMessagerId->select('e')
                 ->from('messager', 'e')
                 ->where("e.email = '$email' AND e.phone = '$phone'");
    $messagerIds =$qbMessagerId->getQuery()->getResult();
    foreach($messagerIds as $messagerID) {
        $id = $messagerID->getId();
    }
    $qbAll = $em->createQueryBuilder();
    $qbAll->select('m', 'e')
          ->from('message2', 'm')
          ->join('m.messager', 'e')
          ->where("m.messager = '$id'");
    $messages = $qbAll->getQuery()->getResult();
}

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>查詢頁面</title>
    </head>
    <body>
        <div>
            <ul>
                <a href="message_index.php">Home</a>
            </ul>
        </div>
        <div>
            <h3>查詢頁面</h3>
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
            </table>
        </div>
<?php
}

?>
    </body>
</html>
