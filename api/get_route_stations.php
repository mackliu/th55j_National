<?php
include_once "./db.php";

//有route_id參數，則先查詢該路線的所有站點資料
//合併`station`表格和`route_station`表格，並根據路線ID查詢所有站點資料
$route_stations=q("SELECT `route_station`.* ,`station`.`name` as 'station_name' 
                    FROM `route_station`,`station` 
                    WHERE `route_station`.`station_id`=`station`.`id` && `route_id`='{$_GET['id']}'
                    ORDER BY `route_station`.`seq` asc");

//逐一取出站點資料進行時間計算
foreach($route_stations as $idx => $station){
    //先計算到前一站為止所需的行駛總時間，使用seq來判斷前面的站點
    $prev=q("SELECT sum(`arriving_time`+`staying_time`) as 'prev_time' 
                FROM `route_station` 
                WHERE `route_id`='{$_GET['id']}' && `seq` < {$station['seq']} 
                ORDER BY `route_station`.`seq` asc")[0]['prev_time'];

    //計算到達此站的時間
    $arrive=$prev+$station['arriving_time'];

    //計算離開此站的時間
    $leave=$arrive+$station['staying_time'];

    //透取得最接近離開時間的公車資料
    $bus=q("select * from `bus` where `route_id`='{$_GET['id']}' &&  `runtime` <= $leave order by `runtime` desc ");

        //判斷是否有找到最接近離開時間的公車資料
        if(!empty($bus)){
            $bus=$bus[0];
            //將公車資料存入站點資料中
            $station['closest_bus']=$bus['plate'];
    
            if($bus['runtime'] < $arrive){
    
                //如果公車未到站，計算公車還有多少時間到站
                $station['remaining_time']="約".($arrive-$bus['runtime'])."分鐘";
    
                //將未到站的文字class設為空值
                $station['status']='';
            }else{
    
                //如果公車已經到站，顯示已到站
                $station['remaining_time']="已到站";
    
                //將已到站的文字class設為紅色
                $station['status']='text-danger';
            }
        }else{
    
            //如果沒有找到最接近離開時間的公車資料，則將公車資料設為空值
            $station['closest_bus']='';
    
            //將時間設為未發車
            $station['remaining_time']='未發車';
    
            //將未發車的文字class設為灰色
            $station['status']='text-secondary';
        }
    
        //將修改後的站點資料存回陣列中
        $route_stations[$idx]=$station;

}

//輸出JSON格式
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($route_stations,JSON_UNESCAPED_UNICODE);