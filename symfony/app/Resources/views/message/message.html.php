<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>留言板</title>
    </head>
    <body>
        <div>
            <ul>
                <a href="<?php echo $view['router']->path('index')?>"><button type="button">Home</button></a>
            </ul>
            <ul>
                <a href="<?php echo $view['router']->path('check')?>"><button type="button">我要留言</button></a>
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
                    <td><a href="<?php echo $view['router']->path('check', ['id' => $message->getId()]) ?>"><button type="button"> 回覆</button></a></td>
                    <td><a href="<?php echo $view['router']->path('delete', ['id' => $message->getId()]) ?>"><button type="button"> 刪除</button></a></td>
                    <td><a href="<?php echo $view['router']->path('alter', ['id' => $message->getId()]) ?>"><button type="button">修改</button></a></td>
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
                    foreach($querys as $reply) {
                        if ($reply->getMessage()->getId() == $message->getId()) {
                            echo $reply->getMessager()->getName().":".$reply->getReply()."\n";
                        }
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