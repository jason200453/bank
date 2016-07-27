<?php
require_once 'bootstrap.php';
require_once 'src/message2.php';
require_once 'src/reply.php';
require_once 'src/messager.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$qb = $em->createQueryBuilder();
$qb->select('m', 'e')
    ->from('message2', 'm')
    ->join('m.messager', 'e')
    ->where("m.id = '$id'");
$querys = $qb->getQuery()->getResult();
foreach($querys as $query) {
    $title = $query->getTitle();
    $content = $query->getContent();
}

?>
<html>
    <head>
        <title>管理留言</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form id="form" name="form" method="post" action="do_alter.php">
            <input type="hidden" name="writeid" id="writeid" value="<?php echo $id?>" readonly/><br>
            <label>標題:</label>
            <input type="text" name="writetitle" id="writetitle" value="<?php echo $title?>"/><br>
            <label>留言內容:</label>
            <input type="text"  name="writecontent" id="writecontent" rows="10" value="<?php echo $content?>"/><br>
            <input type="submit" name="button" id="button" value="確認修改&回覆"/>
            <a href="admin.php"><button type="button">不修改了</button></a>
        </form>
    </body>
</html>
