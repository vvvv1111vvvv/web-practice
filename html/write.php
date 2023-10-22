<?php
  require("lib/db.php");   //서버접속 : mysql -hlocalhost -uroot -p0000;
                           //DB선택 : mysql> use opentutorials;
  require("config/config.php");
  $conn= db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);  
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
              echo '<li><a href="http://localhost/html/index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li>'."\n";
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
      <form action="process.php" method="post">
        <p>
          제목 : <input type="text" name="title">
        </p>
        <p> 
          작성자 : <input type="text" name= "author">
        </p>
        <p>
          본문 : <textarea name="description"></textarea>
        </p>  
        <input type="submit" name="name">

      </form>
  </article>
</body>
</html>