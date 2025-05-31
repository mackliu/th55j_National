<?php 
include_once "db.php";

// 取得所有問卷資料
$surveys=$pdo->query("select * from `survey`")->fetchAll(PDO::FETCH_ASSOC);

// 以json格式輸出
header('Content-Type: application/json; charset=utf-8');
echo json_encode($surveys,JSON_UNESCAPED_UNICODE);