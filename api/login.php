<?php include_once "db.php";

if($_POST['code']!=$_SESSION['code']){
    header("location:../login.php?error=2");
    
    //增加exit()來終止程式，避免繼續執行後面的帳密判斷
    exit();
}

/*
//題目如果要求登入需透過資料庫比對帳密，可使用以下方式
//使用計算符合條件的筆數，如果有一筆以上，則代表帳密正確
$admin=$pdo->query("SELECT count(*) 
                    FROM admin 
                    WHERE acc='{$_POST['acc']}' && `pw`='{$_POST['pw']}'")
            ->fetchColumn();
if($admin==1){
    $_SESSION['login']=1;
    header("location:../admin.php");
}else{
    header("location:../login.php?error=1");
} */

//簡易登入方式
if($_POST['acc']=='admin' && $_POST['pw']=='1234'){

    //帳密正確時，將$_SESSION['login']設為1
    $_SESSION['login']=1;

    //導回後台
    header("location:../admin.php");
}else{

    //帳密錯誤時，導回登入頁面,並帶入error參數
    header("location:../login.php?error=1");
}

