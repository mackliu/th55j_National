<?php
//建立資料庫連線所需參數
//$dsn="mysql:host=localhost;charset=utf8;dbname=db03";
$dsn="mysql:host=localhost;charset=utf8;dbname=th54j_national";
//建立PDO物件
$pdo=new PDO($dsn,'root','');

//啟用session
session_start();

?>