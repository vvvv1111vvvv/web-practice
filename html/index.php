<?php
  $conn = mysqli_connect('localhost','root','0000');    //서버접속 : mysql -hlocalhost -uroot -p0000;
  mysqli_select_db($conn, 'opentutorials');           //DB선택 : mysql> use opentutorials;
  $result = mysqli_query($conn, "SELECT *FROM topic");  //조회 : mysql>SELECT * FROM topic

?>  
<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="http://localhost/style.css">
</head>
<body id="target">
    <header>
        <h1><a href="http://localhost/html/index.php">JavaScript</a></h1>
    </header>
    <nav>
        <ol>
          <?php
            while($row = mysqli_fetch_assoc($result) ){ //출력 (연관배열의 형식), row는 조회돈 데이터의 첫번째 row의 데이터만 가져온다
              echo '<li><a href="http://localhost/html/index.php?id='.$row['id'].'">'.$row['title'].'</a></li>'."\n";
              
            }
          ?>
        </ol>
    </nav>
  <div id="control">
    <input type="button" value="white" id= "white_btn"/>
    <input type="button" value="black" id= "black_btn"/>
    <a href="http://localhost/html/write.php">쓰기</a>
  <script src = "http://localhost/script.js"></script>
  </div>
  <article>
    <?php
    if(empty($_GET['id'])=== false){
      $sql='SELECT * FROM topic WHERE id='.$_GET['id'];
      $result = mysqli_query($conn, $sql); //조회
      $row = mysqli_fetch_assoc($result);
      echo '<h2>'.$row['title'].'</h2>';
      echo $row['description'];
      }
    ?>
  </article>
</body>
</html>