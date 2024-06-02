<?php include_once 'db.php';
$station=$pdo->query("select * from `station` where `id`='{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);

$prev=$pdo->query("select sum(`minute`+`waiting`) from `station` where `rank` < {$station['rank']}")->fetchColumn();
$arrive=$prev+$station['minute'];
$leave=$arrive+$station['waiting'];

$bus=$pdo->query("select * from `bus` where `minute` <= $leave order by `minute` desc ")->fetch();

echo json_encode($bus,JSON_UNESCAPED_UNICODE);

