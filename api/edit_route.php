<?php
include_once "db.php";

//建立編輯路線資料用的SQL語法
q("UPDATE `route` SET `name`='{$_POST['name']}' WHERE `id`='{$_POST['id']}'");

//$_POST['stations']中的資料分為兩種，一種是新增的資料，一種是更新的資料(有id的資料)
//先將$_POST['stations']中的資料依seq 由小到大排序
usort($_POST['stations'], function($a, $b) {
    return $a['seq'] <=> $b['seq'];
});


//取得該路線的所有站點資料
$route_stations=q("SELECT `id`,`station_id` FROM `route_station` WHERE `route_id`='{$_POST['id']}'");



foreach($_POST['stations'] as $station){

    //檢查$route_stations中是否有這筆station_id，有則刪除
    foreach($route_stations as $idx =>  $route_station){
        if($station['station_id']==$route_station['station_id']){
            unset($route_stations[$idx]); //刪除已經存在的資料
        }
    }

    //如果有id，則是更新資料
    if(isset($station['id'])){
        q("UPDATE `route_station` SET `arriving_time`='{$station['arriving_time']}', `staying_time`='{$station['staying_time']}', `seq`='{$station['seq']}' WHERE `id`='{$station['id']}'");

    }else{ //否則是新增資料
        q("INSERT INTO `route_station` (`route_id`, `station_id`, `arriving_time`, `staying_time`, `seq`) 
            VALUES ('{$_POST['id']}', '{$station['station_id']}', '{$station['arriving_time']}', '{$station['staying_time']}', '{$station['seq']}')");
    }
}

//如果$route_stations中還有資料，則刪除這些資料
if(count($route_stations)>0){
   
    foreach($route_stations as $route_station){
        q("DELETE FROM `route_station` WHERE `id`='{$route_station['id']}'");
    }
}


