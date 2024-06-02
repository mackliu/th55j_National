<?php
include_once "db.php";

//建立編輯資料用的SQL語法
$sql="UPDATE `station` SET `minute`='{$_POST['minute']}',`waiting`='{$_POST['waiting']}' WHERE `id`='{$_POST['id']}'";

//執行SQL語法
$pdo->exec($sql);

//導向回到admin.php?pos=bus
//header("location:../admin.php?pos=bus");

