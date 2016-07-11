<?php 
session_start();
if($_SESSION['v']!="yes"){
 header("location:login.php");
}

require("connect.php");
$data=mysql_query('select * from message order by id desc')//讓資料由最新呈現到最舊
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理員頁面</title>
</head>

<body>
<div>
 <div class="container">
     <ul>
         <a href="message_index.php">Home</a>
    </ul>
    <ul>
          <a href="login.php">Log In</a>
    </ul>
     <ul>
         <a href="message_index.php">Log out</a>
    </ul>
    </div>
</div>
<div class="container">
  <h3>管理員頁面</h3>
</div>
      
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
for($i=1;$i<=mysql_num_rows($data);$i++){
 $message=mysql_fetch_assoc($data);
?>
<div>
    <div class="main">
      <table align="center">
            <tr>
              <td><?php echo $message['title']?></td>
            </tr>
            <tr>
              <td width="25%">暱稱</td>
              <td width="75%"><?php echo $message['name']?></td>
            </tr>
            <tr>
              <td>信箱</td>
              <td><?php echo $message['email']?></td>
            </tr>
            <tr>
              <td>性別</td>
              <td><?php echo $message['gender']?></td>
            </tr>
            <tr>
              <td>留言內容</td>
              <td><?php echo $message['content']?></td>
            </tr>
            <tr>
                <td><a href="delete.php?id=<?php echo $message['id']?>"> 刪除</a></td>
                <td><a href="alter.php?id=<?php echo $message['id']?>"> 修改</a></td>
            </tr>
        </table>
 </div>
</div>
<br />
<?php } ?>


</body>
</html>