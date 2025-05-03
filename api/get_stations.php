<?php
include_once "./db.php";

//先查詢所有站點資料
$stations=q("SELECT * FROM `station`");

//根據有無route_id參數來決定要查詢的資料
if(isset($_GET['id'])){
    //有route_id參數，則先查詢該路線的所有站點資料
    $route_stations=q("SELECT `station` .`name`,`route_station`.*
                        FROM `route_station`,`station` 
                        WHERE `route_station`.`station_id`=`station`.`id` && `route_id`='{$_GET['id']}'");
    
    //從stations中排除該路線已經選擇的站點
    foreach($route_stations as $route_station){
        foreach($stations as $key => $station){
            if($station['id']==$route_station['station_id']){
                unset($stations[$key]);
            }
        }
    }
}

$stations=array_values($stations); //重新索引陣列，避免索引不連續

//輸出JSON格式
if(isset($_GET['id'])){

    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(['stations'=>$stations,'route_stations'=>$route_stations],JSON_UNESCAPED_UNICODE);
}else{
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($stations,JSON_UNESCAPED_UNICODE);

}