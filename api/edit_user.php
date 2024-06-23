<?php
include_once "db.php";

//建立編輯資料用的SQL語法
if((empty($_POST['bus']) || $_POST['bus']=='') && ($_POST['name']=="" || empty($_POST['name']))){
    $status=0;
}else if($_POST['name']!='' && (empty($_POST['bus']) || $_POST['bus']=='')){
    $status=1;
}else{
    $status=2;
}

$sql="UPDATE `users` SET `name`='{$_POST['name']}',`bus`='{$_POST['bus']}',`status`='$status' WHERE `id`='{$_POST['id']}'";

//執行SQL語法
$pdo->exec($sql);

//導向回到admin.php?pos=bus
//header("location:../admin.php?pos=bus");

