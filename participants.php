<?php include_once "./api/db.php";

//取得參與者清單，並回傳json格式
$users=$pdo->query("select * from `users`")->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($users,JSON_UNESCAPED_UNICODE);
