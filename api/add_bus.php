<?php
include_once "db.php";

//建立新增資料用的SQL語法
$sql=q("INSERT INTO `bus` (`route_id`, `plate`, `runtime`) 
        VALUES ('{$_POST['route_id']}', '{$_POST['plate']}', '{$_POST['runtime']}')");

