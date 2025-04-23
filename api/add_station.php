<?php
include_once "db.php";

//建立新增資料用的SQL語法
q("INSERT INTO `station` (`name` ) VALUES ('{$_POST['name']}')");



