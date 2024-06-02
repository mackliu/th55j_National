<?php 
//啟用session

session_start();

//清除session變數
unset($_SESSION['login']);

//登出後導向回首頁
header("location:../index.php");


