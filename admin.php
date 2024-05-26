<?php include_once "./api/db.php";?>
<?php

//判斷$_SESSION['login']這個變數是否存在
if(!isset($_SESSION['login'])){

    //如果$_SESSION['login']不存在，表示管理者未登入，
    //將使用者導回登入頁
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南港展覽館接駁專車-系統管理</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/js.js"></script>
</head>
<body>
<?php include "header.php";?>   
<div class="container mt-5">
<?php $pos=$_GET['pos']??'bus';?>
<div class="border p-3">
    <a href="admin.php?pos=bus" class='btn btn-light <?=($pos=='bus')?'active':'';?>'>接駁車管理</a>
    <a href="admin.php?pos=station" class='btn btn-light <?=($pos=='station')?'active':'';?>'>站點管理</a>
    <a href="admin.php?pos=form" class='btn btn-light <?=($pos=='form')?'active':'';?>'>表單管理</a>
</div>

<?php 
    $file='admin_'.$pos.".php";
    
    //include $file;
    //判斷檔案是否存在，如果存在就載入，不存在就載入admin_bus.php
    if(file_exists($file)){
        include $file;
    }else{
        include "admin_bus.php";
    }

    /* 使用switch case來切換要載入的檔案
        switch($pos){
            case 'bus':
                include 'admin_bus.php';
            break;
            case 'station':
                include 'admin_station.php';
            break;
            case 'form':
                include 'admin_form.php';
            break;
        } 
    */


?>

</div>

<script src="./js/bootstrap.js"></script>

</body>
</html>