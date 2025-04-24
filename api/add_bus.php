<?php
include_once "db.php";

//建立新增資料用的SQL語法
$sql=q("INSERT INTO `bus` (`route`, `plate`, `runtime`) 
        VALUES ('{$_POST['route']}', '{$_POST['plate']}', '{$_POST['runtime']}')");

