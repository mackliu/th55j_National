<?php 
include_once "db.php";

$surveys=$pdo->query("select * from `survey`")->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($surveys,JSON_UNESCAPED_UNICODE);