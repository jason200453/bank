<html>
    <head>
        <title>我要留言</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form id="form" name="form" method="post" action="do_write.php">
            <label>標題:</label>
            <input type="text" name="writetitle" id="writetitle"/><br>
            <label>暱稱:</label>
            <input type="text" name="writename" id="writename"/><br>
            <label>E-mail:</label>
            <input type="text" name="writeemail" id="writeemail"><br>
            <label>內容:</label>
            <input type="text"  name="writecontent" id="writecontent"/><br>
            <label>電話:</label>
            <input type="text"  name="writephone" id="writephone"/><br>
            <input type="submit" name="button" id="button" value="送出"/>
            <a href="message_index.php"><button type="button">不留言了</button></a>
        </form>
    </body>
</html>