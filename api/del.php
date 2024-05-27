<?php
//載入共用函式檔案
include_once "db.php";

//建立刪除資料用的SQL語法
$sql="DELETE FROM `{$_POST['table']}` WHERE `id`='{$_POST['id']}'";

//執行SQL語法
$pdo->exec($sql);

//導向回到admin.php?pos=bus,如果是使用ajax方式，則不需要導向
//header("location:../admin.php?pos={$_POST['pos']}");
?>