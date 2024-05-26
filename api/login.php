<?php include_once "db.php";

if($_POST['code']!=$_SESSION['code']){
    header("location:../login.php?error=2");
}

/* $admin=$pdo->query("SELECT count(*) 
                    FROM admin 
                    WHERE acc='{$_POST['acc']}' && `pw`='{$_POST['pw']}'")
            ->fetchColumn();
if($admin==1){
    $_SESSION['login']=1;
    header("location:../admin.php");
}else{
    header("location:../login.php?error=1");
} */

if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
    $_SESSION['login']=1;
    header("location:../admin.php");
}else{
    header("location:../login.php?error=1");
}

