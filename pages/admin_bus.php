<?php include_once "../api/db.php";?>
<div class="list">
<h1 class="text-center my-3 border">接駁車管理</h1>
<button class="btn btn-success" onclick="load('add_bus.php')">新增</button>
<table class='table table-bordered text-center w-100' id='busTable'>
    <thead>
    <tr>
        <td>車牌</td>
        <td>已行駛時間</td>
        <td>操作</td>
    </tr>
    </thead>
    <tbody>
    <?php
        $rows=$pdo->query("SELECT * FROM `bus`")->fetchAll();

        foreach($rows as $row){
    ?>
    <tr data-id="<?=$row['id'];?>">
        <td><?=$row['name'];?></td>
        <td><?=$row['minute'];?>分鐘</td>
        <td>
            <button class="btn btn-warning" onclick="load('edit_bus.php?id=<?=$row['id'];?>')">編輯</button>
            <button class="btn btn-danger" onclick="del('bus',<?=$row['id'];?>)">刪除</button>
        </td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
</div>
