<?php
include_once "db.php";

//建立新增資料用的SQL語法
q("UPDATE `bus` SET `runtime`='{$_POST['runtime']}' WHERE `id` = '{$_POST['id']}'");




