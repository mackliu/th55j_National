<?php
include_once "./db.php";

//有route_id參數，則先查詢該路線的所有站點資料
//合併`station`表格和`route_station`表格，並根據路線ID查詢所有站點資料
$route_stations=q("SELECT `route_station`.* ,`station`.`name` as 'station_name' 
                    FROM `route_station`,`station` 
                    WHERE `route_station`.`station_id`=`station`.`id` && `route_id`='{$_GET['id']}'");



//輸出JSON格式
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($route_stations,JSON_UNESCAPED_UNICODE);