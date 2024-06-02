<?php
include_once "db.php";

//建立新增資料用的SQL語法
$sql="UPDATE `bus` SET `minute`='{$_POST['minute']}' WHERE `id` = '{$_POST['id']}'";

//執行SQL語法
$pdo->exec($sql);

//導向回到admin.php?pos=bus
//header("location:../admin.php?pos=bus");


