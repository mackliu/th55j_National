<?php
//載入共用函式檔案
include_once "db.php";

//建立刪除資料用的SQL語法
$sql=q("DELETE FROM `{$_POST['table']}` WHERE `id`='{$_POST['id']}'");

?>