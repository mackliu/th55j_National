<?php include_once "db.php";
//取得一部接駁車可分配的人數
$num=$pdo->query("select `number` from `number` limit 1")->fetchColumn();

//計算接駁車數量 => ceil(調查人數/一部接駁車可分配的人數) 使用ceil()來取得無條件進位的數值
$count=$pdo->query("select ceil(count(*)/$num) from `survey`")->fetchColumn();

//取得有回應調查分配的參與者
$users=$pdo->query("select *  from `survey`")->fetchAll();

//透過迴圈來分配接駁車
for($i=0;$i<$count;$i++){

    //產生接駁車編號
    //$bus_num="AUTO-".rand(1000,9999) //rand(1000,9999) 產生四位數隨機數字
    $bus_num="AUTO-".sprintf("%04d",rand(1,9999));  //sprintf("%04d",rand(1,9999)) 產生可以補零的四位數隨機數字
    
    for($j=0;$j<$num;$j++){

        //取得參與者資料，使用array_shift()來取得陣列的最前面第一個元素，並將其由陣列中移除
        $user=array_shift($users);

        //將接駁車編號及參與者資料新增到result資料表中
        $pdo->exec("insert into `result` (`name`,`email`,`bus`) values ('{$user['name']}','{$user['email']}','$bus_num')");
    }

}

?>