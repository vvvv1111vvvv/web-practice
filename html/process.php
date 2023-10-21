<?php
    $sql="INSERT INTO topic(title, description, author, created) VALUES('".$_POST['title']."','". $_POST['description']."','". $_POST['author']."', now())";
    $conn = mysqli_connect('localhost','root','0000');    //서버접속 : mysql -hlocalhost -uroot -p0000;
    mysqli_select_db($conn, 'opentutorials');           //DB선택 : mysql> use opentutorials;
    $result = mysqli_query($conn, $sql);  //조회 : mysql>SELECT * FROM topic
    header('Location: http://localhost/html/index.php'); //redirection
?>