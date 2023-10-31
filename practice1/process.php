<?php
//db 접속
require('conn.php');
$author = mysqli_real_escape_string($conn, $_POST['author']);
$sql="SELECT * FROM `user` WHERE `name` = '".$author."'";
//$sql="SELECT * FROM `user` WHERE `name` = '{$author}'";
//echo $sql;
$result = mysqli_query($conn, $sql);
//var_dump($result);
if ($result ->num_rows> 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id=$row["id"];
}
else{
    $sql="INSERT INTO user (id, name) VALUES (NULL, '{$author}')";
    $result = mysqli_query($conn, $sql);
    $user_id=mysqli_insert_id($conn);//직전에 insert된 쿼리의 id값을 반환
}
$title = mysqli_real_escape_string($conn,$_POST["title"]);
$description = mysqli_real_escape_string($conn,$_POST["description"]);
$author = mysqli_real_escape_string($conn,$user_id);
$sql="INSERT INTO `topic` 
(`id`,`title`, `description`, `author`, `created`) 
VALUES (NULL,'{$title}', '{$description}', '{$author}', now())";
//저자가 user 테이블에 존해하는지 여부 체크
$result = mysqli_query($conn, $sql);  //조회 : mysql>SELECT * FROM topic

header('Location: http://localhost/practice1/index.php'); //redirection

?>