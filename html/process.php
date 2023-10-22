<?php
    
    require("lib/db.php");    //서버접속 : mysql -hlocalhost -uroot -p0000;
                               //DB선택 : mysql> use opentutorials;
    require("config/config.php");
    
    $conn= db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
    $sql = "SELECT * FROM user WHERE name ='".$_POST['author']."'";
    $result = mysqli_query($conn, $sql);                //조회 : mysql>SELECT * FROM topic
    if($result ->num_rows==0){                          // var_dump($result)에서, sql조회결과 $result의 해당하는 rows의 number가 0이면
        $sql = "INSERT INTO user (name, password) VALUES ('".$_POST['author']."' , '111111')";// ..: 문자결합
        mysqli_query($conn, $sql);                      //데이터 베이스에 전송
        $user_id= mysqli_insert_id($conn);                        // 내장함수: 직전에 추가된 행의 id값을 알아낸다
    }
    else{ 
        $row = mysqli_fetch_assoc($result);             // 레코드를 1개씩 리턴, 리턴값은 연관배열
        $user_id=$row['id'];
    }
    //var_dump($row); //row의 정보를 상세히 보여주는 내장함수

    $sql="INSERT INTO topic(title, description, author, created) VALUES('".$_POST['title']."','". $_POST['description']."','".$user_id."', now())";
    $result = mysqli_query($conn, $sql);  //조회 : mysql>SELECT * FROM topic
    header('Location: http://localhost/html/index.php'); //redirection
?>