<?php
include_once "./db.php";

//將站點按前一站的id資訊由小到大排序並取出
$stations =$pdo->query("select * from `station` order by `rank`")->fetchAll(PDO::FETCH_ASSOC);
foreach($stations as $key => $station){
    $prev=$pdo->query("select sum(`minute`+`waiting`) from `station` where `rank` < {$station['rank']}")->fetchColumn();
    $arrive=$prev+$station['minute'];
    $leave=$arrive+$station['waiting'];
    $bus=$pdo->query("select * from `bus` where `minute` <= $leave order by `minute` desc ")->fetch();
    if(!empty($bus)){
        $station['closest_bus']=$bus['name'];
        if($bus['minute'] < $arrive){
            $station['time']="約".($arrive-$bus['minute'])."分鐘";
        }else{
            $station['time']="已到站";
        }
    }else{
        $station['closest_bus']='';
        $station['time']='未發車';
    }

    $stations[$key]=$station;
}



echo json_encode($stations,JSON_UNESCAPED_UNICODE);