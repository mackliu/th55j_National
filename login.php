<?php include_once "./api/db.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Transit Query System 大眾運輸查詢系統</title>
    <link rel="stylesheet" href="./css/bootstrap.css">

</head>
<body>
<?php include "header.php";?>
<div class="container">
    <h1 class="text-center">網站管理-登入</h1>
    <form action="./api/login.php" method="post">
    <?php 
        //根據網址的error參數，顯示不同的錯誤內容
        if(isset($_GET['error']) ){
            switch($_GET['error']){
                case 1:
                    echo "<div class='text-danger text-center my-3'>帳號或密碼錯誤</div>";
                break;
                case 2:
                    echo "<div class='text-danger text-center my-3'>驗證碼錯誤，請重新輸入</div>";
                break;
            }
        }


    ?>
    <div class="row w-100">
        <label for="" class="col-2">帳號</label>   
        <input  type="text" name="username"  class='form-group form-control col-10'>
    </div>
    <div class="row w-100">
        <label for="" class="col-2">密碼</label>   
        <input  type="password" name="password"  class='form-group form-control col-10'>
    </div>
    <div class="row w-100 align-items-center">
        <label for="" class="col-2">驗證碼</label>   
        <input  type="text" name="captcha"  class='form-group form-control col-5'>
                                                <!--驗證碼按鈕-->
        <div class="btn btn-primary btn-lg m-2" id="captcha"></div>
        <div class="btn btn-dark m-2" id="regenerate-captcha-button">重新產生驗證碼</div>
    </div>

    <div class="row w-100">
        <input  type="submit" value="登入" class='col-12 btn btn-success ' id="login-button">
    </div>

    </form>
</div>


<script src="./js/jquery.js"></script>
<script src="./js/bootstrap.js"></script>
</body>
</html>
<script>
getCode()

//重設驗證碼時，使用ajax向後端請求新的驗證碼，並更新至btnCode按鈕中
$("#regenerate-captcha-button").on('click',function(){
    getCode()
})


//將更新驗證碼的功能包裝成一個函式
function getCode(){
    $.get("./api/reset_code.php",(captcha)=>{
        $("#captcha").text(captcha)
    })
}
</script>