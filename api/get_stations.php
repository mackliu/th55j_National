<?php
include_once "./db.php";

$stations=q("SELECT * FROM `station`");

//輸出JSON格式
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($stations,JSON_UNESCAPED_UNICODE);