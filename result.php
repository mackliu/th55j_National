<?php include_once "./api/db.php";

//使用group by bus取得所有result資料表中的接駁車名稱
$busses=$pdo->query("select `bus` from `result` group by `bus`")->fetchAll(PDO::FETCH_ASSOC);

//若接駁車名稱為空，則回傳0，並結束程式
if(empty($busses)){
    echo 0;
    exit();
}

//建立一個空陣列$result，用來存放接駁車名稱及參與者資料
$result=[];

foreach($busses as $bus){
    //透過bus欄位取得result資料表中該bus的所有有填寫意願調查的參與者資料
    $participants=$pdo->query("select `id`,`name`,`email` from `result` where `bus`='{$bus['bus']}'")->fetchAll(PDO::FETCH_ASSOC);
    $result[]=['bus'=>$bus['bus'],
               'participants'=>$participants];
}

//回傳json格式的$result
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result,JSON_UNESCAPED_UNICODE);