<?php include_once "./api/db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南港展覽館接駁專車-系統管理</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/js.js"></script>
</head>
<body>
<?php include "header.php";?>   
<div class="container mt-5">


<div class="main">
<h1 class="border p-3 my-3 text-center">接駁意願調查</h1>
<form>

    <div class="row w-100">
        <label for="" class="col-2">姓名</label>
        <input type="text" name="name" id="name" class='form-group form-control col-10'>
    </div>
    <div class="row w-100">
        <label for="" class="col-2">信箱</label>
        <input type="text" name="email" id="email" class='form-group form-control col-10' min='0' step="1" required>
    </div>
    <div class="row w-100">
        <input type="button" value="送出" class='col-12 btn btn-success my-1' onclick='save()'>
        <input type="button" value="不參與調查" class='col-12 btn btn-secondary my-1' onclick="location.href='index.php'">
    </div>
</form>
<script>
    function save() {
        let data={
                name: $("#name").val(),
                email: $("#email").val(),
            }
    if(data.name==''){
        alert("如要搭乘接駁車，姓名欄位不可為空白")
        return 
    }
        //使用ajax來取得回應，並依據回應結果顯示不同的訊息
        $.post("./api/feeback.php",data ,(res) => {
                //console.log(res)
                switch(parseInt(res)){
                    case 1:
                        alert("你已經參與過意見調查");
                    break;
                    case 2:
                        alert("您不在參與者名單中");
                    break;
                    case 3:
                        alert("該表單目前不接受回應");
                    break;
                    default:
                        alert("感謝回覆調查");
                        //完成回覆調查後導回首頁
                        location.href="index.php";
                }            
            })

    }
</script>
</div>
</div>
<script src="./js/bootstrap.js"></script>

</body>
</html>
