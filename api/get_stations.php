<?php
include_once "./db.php";

//將站點按前一站的id資訊由小到大排序並取出
$stations =$pdo->query("select * from `station` order by `rank`")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($stations,JSON_UNESCAPED_UNICODE);