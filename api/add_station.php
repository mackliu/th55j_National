<?php
include_once "db.php";

//使用SQL語法取得目前資料表中最大的id值，做為新增站點的前一個站點
$rank=$pdo->query("SELECT max(`id`) FROM `station`")->fetchColumn()+1;

//建立新增資料用的SQL語法
$sql="INSERT INTO `station` (`name`, `rank`,`minute`,`waiting`) 
 VALUES ('{$_POST['name']}','$rank', '{$_POST['minute']}', '{$_POST['waiting']}')";

//執行SQL語法
$pdo->exec($sql);

//導向回到admin.php?pos=bus
//header("location:../admin.php?pos=bus");

