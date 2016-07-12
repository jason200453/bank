<?php
require 'connect.php';
$id=$_GET['id'];
$query = mysql_query("SELECT * FROM message WHERE id='$id'");
for ($i = 1; $i <= mysql_num_rows($query); $i++) {
    $message=mysql_fetch_assoc($query);
    
?>
<html>
    <head>
        <title>我要留言</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form id="form" name="form" method="post" action="do_alter.php">
           
           <input type="hidden" name="writeid" id="writeid" value="<?php echo $message['id']?>" readonly/><br>
           <label>標題:</label>
           <input type="text" name="writetitle" id="writetitle" value="<?php echo $message['title']?>"/><br>
           <label>暱稱:</label>
           <input type="text" name="writename" id="writename" value="<?php echo $message['name']?>"/><br>
           <label>E-mail:</label>
           <input type="text" name="writeemail" id="writeemail" value="<?php echo $message['email']?>"/><br>
           <label>性別:</label>           
           <input type="radio" name="writegender" id="radio" value="男" <?php if($message['gender'] =="男") echo 'checked';?> />男                      
           <input type="radio" name="writegender" id="radio2" value="女" <?php if($message['gender'] =="女") echo 'checked';?> />女<br>  
           <label>內容:</label>
           <input type="text"  name="writecontent" id="writecontent" rows="5" value="<?php echo $message['content']?>"/><br> 
            <input type="submit" name="button" id="button" value="確認修改"/>
            <a href="admin.php"><button type="button">不修改了</button></a>
        </form>
    </body>
</html>
<?php 
}

?>