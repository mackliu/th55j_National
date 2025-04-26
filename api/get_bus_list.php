<?php 
include_once "db.php";
$busList=q("SELECT `bus`.*,`route`.`name` as 'route_name'
            FROM `bus` 
            LEFT JOIN `route` 
            ON `bus`.`route_id`=`route`.`id`");

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($busList, JSON_UNESCAPED_UNICODE);


?>
