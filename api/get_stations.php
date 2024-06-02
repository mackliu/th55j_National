<?php
include_once "./db.php";

//將站點按rank欄位由小到大排序並取出
$stations =$pdo->query("select * from `station` order by `rank`")->fetchAll(PDO::FETCH_ASSOC);

//使用迴圈逐一取出各站點的資料進行處理
foreach($stations as $key => $station){

    //先計算到前一站為止所需的行駛總時間，使用rank來判斷前面的站點
    $prev=$pdo->query("select sum(`minute`+`waiting`) from `station` where `rank` < {$station['rank']}")->fetchColumn();

    //計算到達此站的時間
    $arrive=$prev+$station['minute'];

    //計算離開此站的時間
    $leave=$arrive+$station['waiting'];

    //透取得最接近離開時間的公車資料
    $bus=$pdo->query("select * from `bus` where `minute` <= $leave order by `minute` desc ")->fetch();

    //判斷是否有找到最接近離開時間的公車資料
    if(!empty($bus)){

        //將公車資料存入站點資料中
        $station['closest_bus']=$bus['name'];

        if($bus['minute'] < $arrive){

            //如果公車未到站，計算公車還有多少時間到站
            $station['time']="約".($arrive-$bus['minute'])."分鐘";

            //將未到站的文字class設為空值
            $station['status']='';
        }else{

            //如果公車已經到站，顯示已到站
            $station['time']="已到站";

            //將已到站的文字class設為紅色
            $station['status']='text-danger';
        }
    }else{

        //如果沒有找到最接近離開時間的公車資料，則將公車資料設為空值
        $station['closest_bus']='';

        //將時間設為未發車
        $station['time']='未發車';

        //將未發車的文字class設為灰色
        $station['status']='text-secondary';
    }

    //將修改後的站點資料存回陣列中
    $stations[$key]=$station;
}

//輸出JSON格式
echo json_encode($stations,JSON_UNESCAPED_UNICODE);