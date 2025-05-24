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
<?php include "header.php";?>   
<div class="container mt-5">


<div class="main">
<h1 class="border p-3 my-3 text-center">搭乘意願調查</h1>
<form>

    <div class="row w-100">
        <label for="" class="col-2">路線</label>
        <select name="route" id="route" class='form-group form-control col-10'  required>
            <option value="1">台北-台中</option>
            <option value="2">台北-高雄</option>
            <option value="3">台北-花蓮</option>
            <option value="4">台北-台東</option>
        </select>
    </div>
    <div class="row w-100">
        <label for="" class="col-2">姓名</label>
        <input type="text" name="name" id="name" class='form-group form-control col-10'>
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
