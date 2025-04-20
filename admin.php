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
    <a href="#" class='control btn btn-light active' id='route-link' onclick="load('route-link.php');setActive('route-link')">路線管理</a>
    <a href="#" class='control btn btn-light' id='bus-link' onclick="load('bus-link.php');setActive('bus-link')">車輛管理</a>
    <a href="#" class='control btn btn-light' id='station-link' onclick="load('station-link.php');setActive('station-link')">站點管理</a>
    <a href="#" class='control btn btn-light' id='form-link' onclick="load('form-link.php');setActive('form-link')">表單管理</a>
</div>
<div class="main">

</div>
</div>

<script src="./js/bootstrap.js"></script>
<script>
load('route-link.php');

/**
 * 設定選單按鈕的active class
 */
function setActive(id){
    $(".control").removeClass('active');
    $("#"+id).addClass("active");
}

/**
 * 設定表格可拖曳排序
 */
function setDragable(table){
    //代入要拖曳排序的表格id及tbody
    $(`#${table} tbody`).sortable({
    helper:function(e,ui){
        //將拖曳的元素設定為原本的寬度,避免拖曳時元素變形
        ui.children().each(function(){
            $(this).width($(this).width());
        })
        return ui;
    },
    placeholder:"ui-state-highlight", //拖曳時原本的位置會有一個空白的地方
    update:function(){ //當拖曳結束,排序變更時觸發
        let arr=[]; //建立一個空陣列

        //將拖曳目標區域內的tr元素逐一取出
        $(`#${table} tbody tr`).each(function(){

            //將每個tr元素的data-id屬性值依序存入arr陣列
            arr.push($(this).data("id"));
        })
        //透過ajax將排序後的id陣列傳送到update_rank.php進行更新
        $.post("./api/update_rank.php",{table,arr},function(){
            //重新載入站點管理頁面
            if(table="station"){
                load('admin_station.php')
            }
            
        })
    }

}).disableSelection();
}
</script>
</body>
</html>
