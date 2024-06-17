<?php include_once "db.php";
//取得一部接駁車可分配的人數
$num=$pdo->query("select `number` from `number` limit 1")->fetchColumn();

//取得調查人數/一部接駁車可分配的人數=>計算接駁車數量
$count=$pdo->query("select count(*)/$num from `result`")->fetchColumn();

//透過迴圈來分配接駁車
for($i=0;$i<$count;$i++){
    $start=$i*$num;
    #$bus_num="AUTO-".rand(1000,9999) //rand(1000,9999) 產生四位數隨機數字
    $bus_num="AUTO-".sprintf("%04d",rand(1,9999));  //sprintf("%04d",rand(1,9999)) 產生可以補零的四位數隨機數字
    
    //取得有回應調查分配的人數
    $users=$pdo->query("select * from `result` limit $start,$num")->fetchAll();

    //使用迴圈將人員分配至接駁車並更新至資料表
    foreach($users as $user){
        $sql="update `result` set `bus`='$bus_num' where `id`='{$user['id']}'";
        $pdo->exec($sql);
    }
}


?>