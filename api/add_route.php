<?php
include_once "db.php";

//建立新增路線資料用的SQL語法
q("insert into `route` (`name`)  values ('{$_POST['routeName']}')");

//取得剛新增的路線ID
$route_id=q("select `id` from `route` where `name`='{$_POST['routeName']}'")[0]['id']; //取得剛新增的路線ID

//先將$_POST['stations']中的資料依seq 由小到大排序
usort($_POST['stations'], function($a, $b) {
    return $a['seq'] <=> $b['seq'];
});

//建立新增路線站點關聯表的SQL語法
foreach($_POST['stations'] as $station){
    q("insert into `route_station` (`route_id`, `station_id`, `arriving_time`, `staying_time`, `seq`) 
        values ('{$route_id}', '{$station['stationId']}', '{$station['arrivingTime']}', '{$station['stayingTime']}', '{$station['seq']}')");
}
