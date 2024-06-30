<?php 
include_once "db.php";

/***
 * 利用餘數原理來改變表單的開關狀態
 * (1+1)%2 = 0  => 表示表單由開啟轉為關閉
 * (0+1)%2 = 1  => 表示表單由關閉轉為開啟
 ***/
$active=($_POST['status']+1)%2;

//更新資料表中的表單開關狀態
$row=$pdo->exec("update `form` set `active`={$active}");

if($active){
    //如果表單由關閉轉為開啟，表示要重新做意願調查及接駁車分派
    //那麼就要確定清空survey和result兩張資料表
    $pdo->exec("TRUNCATE TABLE `survey`");
    $pdo->exec("TRUNCATE TABLE `result`");
}

/**
 * 如果表單由開啟轉關閉，則不做任何動作，因為可能只是想先暫時停止調查
 */