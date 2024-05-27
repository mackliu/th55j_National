<?php
include_once "db.php";

//建立新增資料用的SQL語法
$sql="INSERT INTO `bus` (`name`, `minute`) 
 VALUES ('{$_POST['name']}', '{$_POST['minute']}')";

//執行SQL語法
$pdo->exec($sql);

//導向回到admin.php?pos=bus
header("location:../admin.php?pos=bus");


