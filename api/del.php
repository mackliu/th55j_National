<?php
//載入共用函式檔案
include_once "db.php";

//建立刪除資料用的SQL語法
$sql=q("DELETE FROM `{$_POST['table']}` WHERE `id`='{$_POST['id']}'");

//如果刪除的是路線資料，則也要刪除該路線(route_station)及路線車輛(bus)的所有資料
if($_POST['table']=='route'){
    
    q("DELETE FROM `route_station`  WHERE `route_id`='{$_POST['id']}'");
    q("DELETE FROM `bus`  WHERE `route_id`='{$_POST['id']}'");
}

?>