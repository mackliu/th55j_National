<?php include_once "db.php";

$routes=q("select * from route");


header('Content-Type: application/json; charset=utf-8');
echo json_encode($routes);