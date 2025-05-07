<?php 
//載入資料庫連線檔案
include_once "./api/db.php";

//根據網址參數決定要載入的頁面
$page=$_GET['page']??'route-link';
?>
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
    <title>Public Transit Query System 大眾運輸查詢系統</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./js/jquery-ui.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/jquery-ui.js"></script>
    <script src="./js/js.js"></script>
    <style>
        .ui-sortable-helper {
            background-color: #00f9f9;
        }
        .ui-state-highlight{
            background-color:white;
        }
    </style>
</head>
<body>
<?php include "header.php";?>   
<div class="container mt-5">

<div class="border p-3">
    <!-- 根據網址參數決定要讓那個連結按鈕為active的狀態 -->
    <a href="?page=route-link" class='control btn btn-light <?=($page=='route-link')?'active':'';?>' id='route-link'>路線管理</a>
    <a href="?page=bus-link" class='control btn btn-light <?=($page=='bus-link')?'active':'';?>'  id='bus-link' >車輛管理</a>
    <a href="?page=station-link" class='control btn btn-light <?=($page=='station-link')?'active':'';?>'  id='station-link' >站點管理</a>
    <a href="?page=form-link" class='control btn btn-light <?=($page=='form-link')?'active':'';?>' id='form-link' >表單管理</a>
</div>
<div class="main">
<?php 
// 根據網址參數建立要載入的檔案名稱
$file="./pages/".$page.".php";

// 判斷檔案是否存在
if(file_exists($file)){

    //如果檔案存在，則載入該檔案
    include $file;

}else{

    //如果檔案不存在，則載入預設的路線管理頁面
    include "./pages/route-link.php";
}

?>
</div>
</div>

<script src="./js/bootstrap.js"></script>
</body>
</html>
