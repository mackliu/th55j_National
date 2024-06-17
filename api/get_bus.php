<?php 
include_once "db.php";
//取得前端傳來的站點id
$stationId=$_GET['stationId'];

//根據站點id取得站點資料
$station=$pdo->query("select * from `station` where `id`='$stationId'")->fetch();

//計算到前一站所需的總時間
$sql="select sum(`minute`+`waiting`) from `station` where `rank` < {$station['rank']}";
$prev=$pdo->query($sql)->fetchColumn();

//計算到此站的時間
$arrive=$prev+$station['minute'];

//計算離開此站的時間
$leave=$arrive+$station['waiting'];

//根據離開時間取得接下來的公車資料,並取前三筆
$busList=$pdo->query("select * from `bus` where `minute` <= '$leave' order by minute limit 3")->fetchAll(PDO::FETCH_ASSOC);

//如果沒有公車資料，則回傳-1
if(count($busList)==0){
    echo -1;
    exit();
}

//回傳公車資料
foreach($busList as $bus){
    //根據公車到站時間與離開時間比較，計算剩餘時間並顯示文字
    if($bus['minute']<$arrive){
        $time=$arrive-$bus['minute']."分鐘";
        echo "<div>";
    }else{
        $time="已到站";
        echo "<div style='color:red'>";
    }
    echo $bus['name'].":";
    echo $time;
    echo "</div>";
}
//echo json_encode($busList);


?>
