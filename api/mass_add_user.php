<?php include_once "db.php";


//取代特殊字元如換行符號、多餘空白等
$_POST['emails']=str_replace(['\r\n','\n','\r',' '],"",$_POST['emails']);

//以,來分割字串,如果資料提供使用其它符號則將','改為該符號，explode的結果會是陣列
$users=explode(",",$_POST['emails']);

//設定計數器
$count=0;
foreach($users as $user){
    //如果字串長度為0，表示該位置無資料，則跳過不處理
    if(strlen($user)==0) continue;

    //將使用者資料寫入資料庫
    $pdo->exec("INSERT INTO users (`email`) VALUES ('{$user}')");

    //新增成功則計數器+1
    $count++;
}

echo "成功新增{$count}筆資料";

