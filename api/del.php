<?php

include_once "db.php";
$_POST['table'];
$_POST['id'];
$sql="DELETE FROM `{$_POST['table']}` WHERE `id`='{$_POST['id']}'";
$pdo->exec($sql);

?>