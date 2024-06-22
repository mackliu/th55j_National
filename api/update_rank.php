<?php
include_once 'db.php';

//取得所有站點的id與排序
$stations=$pdo->query("select `id`,`rank` from `station`")->fetchAll();

//取得前端傳來的排序陣列
$ranks=$_POST['arr'];

//逐一取出所有站點的id與排序，並更新資料庫
foreach($stations as $station){
    //使用array_search()函式找出該站點id在排序陣列中的索引值，並加1
    $newRank=array_search($station['id'],$ranks)+1;
    
    //更新站點的rank值
    $pdo->exec("update `station` set `rank`='{$newRank}' where `id`='{$station['id']}'");
}