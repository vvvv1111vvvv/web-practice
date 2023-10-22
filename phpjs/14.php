<?php
  $conn = mysqli_connect('localhost','root','0000');    //서버접속 : mysql -hlocalhost -uroot -p0000;
  mysqli_select_db($conn, 'opentutorials');           //DB선택 : mysql> use opentutorials;
  $name= mysqli_real_escape_string($conn, $_GET['name']); // sql명령문에 사용되는 문자열에서 특수문자를 회피
  $password= mysqli_real_escape_string($conn, $_GET['password']);

  $sql = "SELECT * FROM user WHERE name ='".$name."' AND 
  password='".$password."'";
  echo $sql;
  $result = mysqli_query($conn, $sql);  //조회 : mysql>SELECT * FROM topic

?>  
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
  <?php
    //$password = $_GET["password"]; /*$_GET:사용자가 입력한 정보*/
    if($result->num_rows=="0"){
      echo "입력 에러입니다.";

    }
    else{
      echo "환영합니다.";
    }
  ?>
</body>
</html>
