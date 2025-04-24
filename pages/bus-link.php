<?php include_once "../api/db.php";?>
<div class="list">
<h1 class="text-center my-3 border">車輛管理</h1>
<button class="btn btn-success" id="add-bus-button" onclick="load('add_bus.php')">新增</button>
<table class='table table-bordered text-center w-100' id='bus'>
    <thead>
    <tr>
        <td>路線</td>
        <td>車牌</td>
        <td>已行駛時間</td>
        <td>操作</td>
    </tr>
    </thead>
    <tbody>
    <?php
        $rows=q("SELECT * FROM `bus`");

        foreach($rows as $row){
    ?>
    <tr data-id="">
        <td class="bus-route"><?=$row['route_id'];?></td>
        <td class="bus-plate"><?=$row['plate'];?></td>
        <td class="bus-runtime"><?=$row['runtime'];?>分鐘</td>
        <td>
            <button class="btn btn-warning edit-bus-button" data-bus-plate="<?=$row['plate'];?>" onclick="">編輯</button>
            <button class="btn btn-danger delete-bus-button" data-bus-plate="<?=$row['plate'];?>" onclick="">刪除</button>
        </td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>
</div>
