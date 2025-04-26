<?php 
include_once "db.php";

/**
 * 關聯表查詢
 * 使用left join 來查詢路線及其對應的站點數量
 * 這裡使用了GROUP BY來統計每條路線的站點數量
 */
$routes=q("SELECT `route`.*, COUNT(`route_station`.`station_id`) as `station_count` 
            FROM `route` 
            LEFT JOIN `route_station` 
            ON `route`.`id`=`route_station`.`route_id` 
            GROUP BY `route`.`id`");


//輸出JSON格式
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($routes,JSON_UNESCAPED_UNICODE);
?>
