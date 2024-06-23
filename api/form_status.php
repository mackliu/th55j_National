<?php 
include_once "db.php";

$active=($_POST['status']+1)%2;
$row=$pdo->exec("update `form` set `active`={$active}");

$pdo->exec("update `users` set `name`='',`bus`='',`status`='0' ");

