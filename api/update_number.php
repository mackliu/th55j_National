<?php
include_once 'db.php';

//更新接駁車可分配人數
$pdo->exec("update `number` set `number`='{$_POST['number']} '");
