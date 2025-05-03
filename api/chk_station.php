<?php include_once "db.php";

echo q("SELECT count(*) as 'count' FROM `station` WHERE name='{$_GET['name']}'")[0]['count'];