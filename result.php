<?php include_once "./api/db.php";

$bus=$pdo->query("select `bus` from `users` where `status`='2' group by `bus`")->fetchAll(PDO::FETCH_ASSOC);
$result=[];

foreach($bus as $b){
    $participants=$pdo->query("select `id`,`name`,`email` from `users` where `bus`='{$b['bus']}'")->fetchAll(PDO::FETCH_ASSOC);
    $result[]=['bus'=>$b['bus'],
                'participants'=>$participants];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result,JSON_UNESCAPED_UNICODE);