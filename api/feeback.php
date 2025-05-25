<?php 
include_once "db.php";

//取得前端傳來的資料，包含姓名、電子信箱、路線、意見
$name=$_POST['name'];
$email=$_POST['email'];
$route=$_POST['route'];
$note=$_POST['note'];

//檢查調查回應表單是否開放填寫
$active=q("select * from form_settings where id=1")[0];
if($active['enabled']!=1){
    echo 3;  //回傳3代表表單已關閉
    exit();
}
//檢查時間是否是在可填寫的時間區段中
$now=strtotime("now");
$start_time=strtotime($active['start_at']);
$end_time=strtotime($active['end_at']);
if($now<$start_time or $now > $end_time ){
    echo 2; //回傳2代表email不在email列表中
    exit();
}


//通過以上的檢查，則將使用者資料新增到survey資料表中
q("insert into `survey_response` (`route_id`,`name`,`email`,`note`) values ('$route','$name','$email','$note')");
