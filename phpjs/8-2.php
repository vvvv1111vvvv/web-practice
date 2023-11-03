<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
  <?php
    $password = $_GET["password"]; /*$_GET:사용자가 입력한 정보*/
    if($password=="1111"){
      echo "주인님 환영합니다.";
    }
    else{
      echo "입력 에러입니다.";
    }
  ?>
</body>
</html>
