<?php 
include_once "db.php";

//取得前端傳來的資料，包含姓名、電子信箱
$name=$_POST['name'];
$email=$_POST['email'];

//檢查調查回應表單是否開放填寫
$active=$pdo->query('select `active` from `form` limit 1')->fetchColumn();
if(!$active){
    echo 3;  //回傳3代表表單已關閉
    exit();
}
//檢查email是否已在email列表中
$exist=$pdo->query("select count(*) from `users` where `email`='$email'")->fetchColumn();
if(!$exist){
    echo 2; //回傳2代表email不在email列表中
    exit();
}

//檢查是否已填寫過表單
$feeback=$pdo->query("select count(*) from `survey` where email='$email'")->fetchColumn();
if($feeback){
    echo 1;  //回傳1代表已回應或已填寫過表單
    exit();
}

//通過以上的檢查，則將使用者資料新增到survey資料表中
$pdo->exec("insert into `survey` (`name`,`email`) values ('$name','$email')");
