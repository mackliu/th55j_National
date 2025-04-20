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
<h1 class="border p-3 my-3 text-center">接駁車查詢</h1>
<div id="result" style="font-size:26px;color:gold"></div>
<form>
    <div class="row w-100">
        <label for="" class="col-2">信箱</label>
        <input type="text" name="email" id="email" class='form-group form-control col-10'  required>
    </div>
    <div class="row w-100">
        <input type="button" value="查詢" class='col-12 btn btn-success my-1' onclick='search()'>
    </div>
</form>
<script>
    function search() {
        let data={
                email: $("#email").val()
            }
        //使用ajax來取得查詢的結果，並依據回應結果顯示不同的訊息
        $.post("./api/search.php",data ,(res) => {
                console.log(res)
                switch(parseInt(res)){
                    case 1:
                        alert("您不在參與者名單中");
                    break;
                    case 2:
                        alert("您還沒填寫意願調查表單");
                    break;
                    case 3:
                        alert("目前尚未分配接駁車");
                    break;
                    default:
                        $("#result").text(`你的接駁車班次為${res}`)
                        //location.href="index.php";
                }
            })

    }
</script>
</div>
</div>
<script src="./js/bootstrap.js"></script>

</body>
</html>
