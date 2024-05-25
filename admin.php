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
</head>
<body>
<?php include "header.php";?>   
<div class="container mt-5">

</div>

<script src="./js/jquery.js"></script>
<script src="./js/bootstrap.js"></script>
<script src="js.js"></script>
</body>
</html>