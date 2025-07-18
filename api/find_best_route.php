<?php
include_once "./db.php";

function findBestRoute($start_station_id, $end_station_id) {
    // 如果出發站和目的站相同，直接返回
    if ($start_station_id == $end_station_id) {
        return ['error' => '出發站和目的站不能相同'];
    }
    
    // 查找直達路線
    $direct_routes = findDirectRoutes($start_station_id, $end_station_id);
    
    // 查找轉乘路線
    $transfer_routes = findTransferRoutes($start_station_id, $end_station_id);
    
    // 合併所有路線方案
    $all_routes = array_merge($direct_routes, $transfer_routes);
    
    if (empty($all_routes)) {
        return ['error' => '找不到可行的路線'];
    }
    
    // 根據站點數量和時間排序
    usort($all_routes, function($a, $b) {
        // 首先比較站點數量（越少越好）
        $station_diff = $a['total_stations'] - $b['total_stations'];
        if ($station_diff != 0) {
            return $station_diff;
        }
        // 如果站點數量相同，比較總時間（越短越好）
        return $a['total_time'] - $b['total_time'];
    });
    
    // 返回最佳路線
    return $all_routes[0];
}

function findDirectRoutes($start_station_id, $end_station_id) {
    $routes = [];
    
    // 查找包含兩個站點的所有路線
    $sql = "SELECT r.id as route_id, r.name as route_name,
                   rs1.seq as start_seq, rs1.arriving_time as start_time,
                   rs2.seq as end_seq, rs2.arriving_time as end_time,
                   rs1.staying_time as start_staying_time,
                   rs2.staying_time as end_staying_time
            FROM route r
            JOIN route_station rs1 ON r.id = rs1.route_id AND rs1.station_id = $start_station_id
            JOIN route_station rs2 ON r.id = rs2.route_id AND rs2.station_id = $end_station_id
            WHERE rs1.seq < rs2.seq"; // 確保出發站在目的站之前
    
    $direct_routes = q($sql);
    
    foreach ($direct_routes as $route) {
        $stations_between = $route['end_seq'] - $route['start_seq'] + 1;
        $travel_time = $route['end_time'] - $route['start_time'] + $route['start_staying_time'];
        
        $routes[] = [
            'type' => 'direct',
            'routes' => [
                [
                    'route_id' => $route['route_id'],
                    'route_name' => $route['route_name'],
                    'start_station_id' => $start_station_id,
                    'end_station_id' => $end_station_id,
                    'stations_count' => $stations_between,
                    'travel_time' => $travel_time
                ]
            ],
            'total_stations' => $stations_between,
            'total_time' => $travel_time,
            'description' => "搭乘 {$route['route_name']} 直達"
        ];
    }
    
    return $routes;
}

function findTransferRoutes($start_station_id, $end_station_id) {
    $routes = [];
    
    // 查找轉乘點（同時服務於兩條不同路線的站點）
    $sql = "SELECT DISTINCT 
                r1.id as route1_id, r1.name as route1_name,
                r2.id as route2_id, r2.name as route2_name,
                rs_transfer.station_id as transfer_station_id,
                s_transfer.name as transfer_station_name,
                rs1.seq as start_seq, rs1.arriving_time as start_time, rs1.staying_time as start_staying_time,
                rs_transfer1.seq as transfer_seq1, rs_transfer1.arriving_time as transfer_time1,
                rs_transfer2.seq as transfer_seq2, rs_transfer2.arriving_time as transfer_time2, rs_transfer2.staying_time as transfer_staying_time,
                rs2.seq as end_seq, rs2.arriving_time as end_time
            FROM route r1
            JOIN route_station rs1 ON r1.id = rs1.route_id AND rs1.station_id = $start_station_id
            JOIN route_station rs_transfer1 ON r1.id = rs_transfer1.route_id
            JOIN route_station rs_transfer ON rs_transfer1.station_id = rs_transfer.station_id
            JOIN route_station rs_transfer2 ON rs_transfer.station_id = rs_transfer2.station_id
            JOIN route r2 ON rs_transfer2.route_id = r2.id AND r2.id != r1.id
            JOIN route_station rs2 ON r2.id = rs2.route_id AND rs2.station_id = $end_station_id
            JOIN station s_transfer ON rs_transfer.station_id = s_transfer.id
            WHERE rs1.seq < rs_transfer1.seq 
            AND rs_transfer2.seq < rs2.seq
            LIMIT 5"; // 限制結果數量避免過多選項
    
    $transfer_routes = q($sql);
    
    foreach ($transfer_routes as $route) {
        $first_leg_stations = $route['transfer_seq1'] - $route['start_seq'] + 1;
        $second_leg_stations = $route['end_seq'] - $route['transfer_seq2'] + 1;
        $total_stations = $first_leg_stations + $second_leg_stations;
        
        $first_leg_time = $route['transfer_time1'] - $route['start_time'] + $route['start_staying_time'];
        $second_leg_time = $route['end_time'] - $route['transfer_time2'] + $route['transfer_staying_time'];
        $total_time = $first_leg_time + $second_leg_time + 3; // 假設轉乘等待時間為3分鐘
        
        $routes[] = [
            'type' => 'transfer',
            'routes' => [
                [
                    'route_id' => $route['route1_id'],
                    'route_name' => $route['route1_name'],
                    'start_station_id' => $start_station_id,
                    'end_station_id' => $route['transfer_station_id'],
                    'stations_count' => $first_leg_stations,
                    'travel_time' => $first_leg_time
                ],
                [
                    'route_id' => $route['route2_id'],
                    'route_name' => $route['route2_name'],
                    'start_station_id' => $route['transfer_station_id'],
                    'end_station_id' => $end_station_id,
                    'stations_count' => $second_leg_stations,
                    'travel_time' => $second_leg_time
                ]
            ],
            'total_stations' => $total_stations,
            'total_time' => $total_time,
            'transfer_station' => $route['transfer_station_name'],
            'description' => "搭乘 {$route['route1_name']} 到 {$route['transfer_station_name']} 轉乘 {$route['route2_name']}"
        ];
    }
    
    return $routes;
}

// 處理API請求
if (isset($_GET['start_station_id']) && isset($_GET['end_station_id'])) {
    $start_station_id = intval($_GET['start_station_id']);
    $end_station_id = intval($_GET['end_station_id']);
    
    $result = findBestRoute($start_station_id, $end_station_id);
    
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
} else {
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(['error' => '請提供出發站和目的站ID'], JSON_UNESCAPED_UNICODE);
}
?>