<?php
require('conn.php');

$result = mysqli_query($conn, "SELECT *FROM topic"); //조회 : mysql>SELECT * FROM topic
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="body" class="">
    <header>
        <h1><a href="/practice1/index.php">생활코딩 JavaScript</a></h1>
    </header>
    <nav>
        <ol>
            <?php
            while ($row = mysqli_fetch_assoc($result)) { //출력 (연관배열의 형식), row는 조회돈 데이터의 첫번째 row의 데이터만 가져온다
                echo '<li><a href="index.php?id=' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a></li>';
                //htmlspecialchars : 문자열에서 특정한 특수문자를 HTML 엔티티로 변환한다. ex) <scirpt> -> &lt;script&gt;
                //php.net script tags
            }
            ?>
        </ol>
    </nav>
    <div id="content">
        <article>
            <h2>
                <?php
                if (empty($_GET['id'])){
                    echo "Welcome";
                }
                else{
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = "SELECT topic.id, topic.title, topic.description, user.name, topic.created FROM `topic` LEFT JOIN `user` ON topic.author = user.id WHERE topic.id =" . $id;
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                <h2>
                    <?= htmlspecialchars($row['title']) ?>
                </h2>
                <div>
                    <?= $row['created'] ?>|
                    <?= $row['name'] ?>
                </div>
                <div>
                    <?= htmlspecialchars($row['description']) ?>
                </div>
                <?php
                }
                ?>
            </h2>
        </article>
        <input type="button" name="name" value="White" onclick="document.getElementById('body').className=''">
        <input type="button" name="name" value="Black"onclick="document.getElementById('body').className='black'">
        <a href="write.php">쓰기</a>
    </div>
</body>

</html>