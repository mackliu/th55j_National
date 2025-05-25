<?php include_once "./api/db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Transit Query System 大眾運輸查詢系統</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/js.js"></script>
</head>
<body>
<header class="shadow-sm p-3 d-flex w-100" style="height:100px">
<div class="col-6">
    <img src="" alt="" style="width:60px;height:60px;">
   <a href="index.php">Public Transit Query System 大眾運輸查詢系統</a>
</div>
<!--此頁不include header.php，同時另外拿掉系統管理和登入，因為此頁只給一般使用者使用
    因此不需要管理及登入功能-->
<div class="col-6 row align-items-center justify-content-end"></div>
</header> 
<div class="container mt-5">


<div class="main">
<h1 class="border p-3 my-3 text-center">搭乘意願調查</h1>
<form>

    <div class="row w-100">
        <label for="" class="col-2">路線</label>
        <select name="route" id="route" class='form-group form-control col-10'  required>
            <?php
                $routes=q("select * from route");
                foreach($routes as $route){
                    echo "<option value='{$route['id']}'>{$route['name']}</option>";
                }
            ?>
        </select>
    </div>
    <div class="row w-100">
        <label for="" class="col-2">姓名</label>
        <input type="text" name="name" id="name" class='form-group form-control col-10'  required>
    </div>
    <div class="row w-100">
        <label for="" class="col-2">信箱</label>
        <input type="text" name="email" id="email" class='form-group form-control col-10' min='0' step="1" required>
    </div>
    
    <div class="row w-100">
        <label for="" class="col-2">寶貴意見</label>

        <textarea name="note" id="note" class='form-group form-control col-10'  rows="8" cols="30"></textarea>
    </div>

    <div class="row w-100">
        <input type="button" value="送出" class='col-12 btn btn-success my-1' onclick='save()'>
        <input type="button" value="取消" class='col-12 btn btn-secondary my-1' onclick="location.href='index.php'">
    </div>
</form>
<script>

    /* $.get("./api/get_route_list.php",(list)=>{
        //console.log(list);
        list.forEach((route)=>{
            $("#route").append(`<option value='${route.id}'>${route.name}</option>`)
        })
    }) */


    function save() {
        let data={
                name: $("#name").val(),
                email: $("#email").val(),
                route: $("#route").val(),
                note: $("#note").val(),
            }
    if(data.name==''){
        alert("如要搭乘接駁車，姓名欄位不可為空白")
        return 
    }
        //使用ajax來取得回應，並依據回應結果顯示不同的訊息
        $.post("./api/feeback.php",data ,(res) => {
                console.log(res)
                switch(parseInt(res)){
                    case 1:
                        alert("已送出回應")
                        //完成回覆調查後導回首頁
                        location.href="index.php";
                    break;
                    case 2:
                        alert("該表單目前不在回應時間內");
                    break;
                    case 3:
                        alert("該表單目前不接受回應");
                    break;
                    default:
                        alert("未知的錯誤，請洽系統管理員");
                        
                }            
            })

    }
</script>
</div>
</div>
<script src="./js/bootstrap.js"></script>

</body>
</html>
