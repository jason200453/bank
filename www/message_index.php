<?php 
require 'connect.php';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言板</title>
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
    </div>
</div>
<div class="container">
 <a href="write_message.php"><button type="button">我要留言</button></a>
</div>     
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
$data=mysql_query("select * from message");
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
        </table>
 </div>
</div>
<br />
<?php } ?>


</body>
</html>