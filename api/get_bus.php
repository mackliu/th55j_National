<?php 
include_once "db.php";

//根據站點id及路線id，從route_station 資料表中取得站點資料
$station=q("SELECT * FROM `route_station` WHERE `route_id`='{$_GET['routeId']}' && `station_id`='{$_GET['stationId']}'")[0];

//print_r($station);
//計算到前一站所需的總時間
$prev=q("SELECT sum(`arriving_time`+`staying_time`) as 'prev_time' 
         FROM `route_station` 
         WHERE `route_id`='{$_GET['routeId']}' && `seq` < {$station['seq']} 
         ORDER by `seq` asc")[0]['prev_time'];


//計算到此站的時間
$arrive=$prev+$station['arriving_time'];

//計算離開此站的時間
$leave=$arrive+$station['staying_time'];

//根據離開時間取得接下來的公車資料,並取前三筆
$busList=q("select * from `bus` where `route_id`='{$_GET['routeId']}' && `runtime` <= '$leave' order by runtime limit 3");

//如果沒有公車資料，則回傳-1
if(count($busList)==0){
    echo -1;
    exit();
}

//回傳公車資料
foreach($busList as $bus){
    //根據公車到站時間與離開時間比較，計算剩餘時間並顯示文字
    if($bus['runtime']<$arrive){
        $remaining_time=$arrive-$bus['runtime']."分鐘";
        echo "<div>";
    }else{
        $remaining_time="已到站";
        echo "<div style='color:red'>";
    }
    echo $bus['plate'].":";
    echo $remaining_time;
    echo "</div>";
}

//echo json_encode($busList);


?>
