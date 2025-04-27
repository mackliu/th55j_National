<?php
//建立資料庫連線所需參數
//$dsn="mysql:host=localhost;charset=utf8;dbname=db03";
$dsn="mysql:host=localhost;charset=utf8;dbname=th55j_national";
//建立PDO物件
$pdo=new PDO($dsn,'root','mack1007');

//啟用session
session_start();

/**
 * 建立一個函式可以快速執行SQL語法
 * @param string $sql SQL語法
 * @return array 執行後的結果
 * @example q("SELECT * FROM `member` WHERE `id`='1'")
 */
function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>