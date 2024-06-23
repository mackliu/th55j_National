<?php include_once "./api/db.php";


$users=$pdo->query("select `id`,`email` from `users`")->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($users,JSON_UNESCAPED_UNICODE);
