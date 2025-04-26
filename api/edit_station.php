<?php
include_once "db.php";

//建立編輯資料用的SQL語法
q("UPDATE `station` SET `name`='{$_POST['name']}' WHERE `id`='{$_POST['id']}'");


