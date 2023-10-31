<?php
function db_init($host,$duser, $dpw, $dname){
    $conn = mysqli_connect($host,$duser,$dpw);    //서버접속 : mysql -hlocalhost -uroot -p0000;
    mysqli_select_db($conn, $dname);           //DB선택 : mysql> use opentutorials;
    return $conn;
}
?>