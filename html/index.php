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
          echo file_get_contents("list.txt");
          ?>
        </ol>
    </nav>
  <div id="control">
    <input type="button" value="white" id= "white_btn"/>
    <input type="button" value="black" id= "black_btn"/>
  <script src = "http://localhost/script.js"></script>
  <article>
    <?php
    if (empty($_GET['id'])==false){
      echo file_get_contents($_GET['id'].".txt");
    }
    ?>
  </article>
</body>
</html>