<?php
  require("lib/db.php");
  require("config/config.php");
  $conn= db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
  $result = mysqli_query($conn, "SELECT *FROM topic");  //조회 : mysql>SELECT * FROM topic

?>  
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="http://localhost/style.css">
  <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="target">
  <div class="container-fluid">
    <header class="jumbotron text-center">
        <h1><a href="http://localhost/html/index.php">JavaScript</a></h1>
    </header>
    <div class="row">
      <nav class="col-md-3">
         <ol>
            <?php
              while($row = mysqli_fetch_assoc($result) ){ //출력 (연관배열의 형식), row는 조회돈 데이터의 첫번째 row의 데이터만 가져온다
              echo '<li><a href="http://localhost/html/index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li>'."\n";
              //htmlspecialchars : 문자열에서 특정한 특수문자를 HTML 엔티티로 변환한다. ex) <scirpt> -> &lt;script&gt;
              //php.net script tags
            }
          ?>
        </ol>
      </nav>
      <div class="col-md-9">
        <div id="control">
          <input type="button" value="white" id= "white_btn" class="btn btn-default"/>
          <input type="button" value="black" id= "black_btn" class="btn btn-default"/>
          <a href="http://localhost/html/write.php">쓰기</a>
          <script src = "http://localhost/script.js"></script>
        </div>
        <article>
          <?php
            if(empty($_GET['id'])=== false){
            //$sql='SELECT * FROM topic WHERE id='.$_GET['id'];
            $sql="SELECT topic.id, title, name ,description, password FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id=".$_GET['id'];
            $result = mysqli_query($conn, $sql); //조회
            $row = mysqli_fetch_assoc($result);
            echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
            echo '<p>'.htmlspecialchars($row['name']).'</p>';
            echo strip_tags($row['description'], '<a><h1><h2><h3><h4><h5><ul><ol><il>');//escaping: html 해석에서 제외
            }
          ?>
        </article>
      </div>
    </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </div>
</body>
</html>