<?php
include_once "db.php";

$sql="INSERT INTO `bus` (`name`, `minute`) 
 VALUES ('{$_POST['name']}', '{$_POST['minute']}')";

$pdo->exec($sql);
header("location:../admin.php?pos=bus");


