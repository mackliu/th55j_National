<?php include_once "../api/db.php";?>
<div class="list">
<h1 class="text-center my-3 border">接駁車管理</h1>
<button class="btn btn-success" onclick="$('.add').show();$('.list,.edit').hide()">新增</button>
<table class='table table-bordered text-center w-100'>
    <tr>
        <td>車牌</td>
        <td>已行駛時間</td>
        <td>操作</td>
    </tr>
    <?php
        $rows=$pdo->query("SELECT * FROM `bus`")->fetchAll();

        foreach($rows as $row){
    ?>
    <tr>
        <td><?=$row['name'];?></td>
        <td><?=$row['minute'];?></td>
        <td>
            <button class="btn btn-warning" onclick="$('.edit').show();$('.add,.list').hide()">編輯</button>
            <button class="btn btn-danger" onclick="del('bus',<?=$row['id'];?>)">刪除</button>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
</div>
<!--新增表單-->
<div class="add" style="display:none">
<h1 class="text-center my-3 border">新增接駁車</h1>
<form action="./api/add_bus.php" method="post">
    <div class="row w-100">
        <label for="" class="col-2">車牌</label>
        <input type="text" name='name' id='name' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <label for="" class="col-2">已行駛時間(分鐘)</label>
        <input type="number" min='0' step='1' required name='minute' id='addMinute' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <input type="submit" value="新增" class='btn btn-success my-1 col-12'>
    <input type="button" value="回上一頁" onclick="$('.list').show();$('.add,.edit').hide()" class='btn btn-secondary my-1 col-12'>
    </div>

</form>

</div>
<!--編輯表單-->
<div class="edit" style="display:none">
<h1 class="text-center my-3 border">修改接駁車</h1>
<form action="./api/edit_bus.php" method="post">
    <div class="row w-100">
    <label for="" class="col-2">已行駛時間(分鐘)</label>
        <input type="number" min='0' step='1' required name='minute' id='editMinute' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <input type="submit" value="新增" class='btn btn-success my-1 col-12'>
    <input type="button" value="回上一頁" onclick="$('.list').show();$('.add,.edit').hide()"  class='btn btn-secondary my-1 col-12'>
    </div>

</form>

</div>


