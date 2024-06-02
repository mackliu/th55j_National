<?php include_once "../api/db.php";?>
<div class="list">
    <h1 class="border p-3 text-center my-3">站點管理 
        <button class="btn btn-success" onclick="load('add_station.php')">新增</button>
    </h1>
    <table class="table table-bordered text-center">
    <tr>
        <td style="width:30%">站點名稱</td>
        <td style="width:20%">行駛時間(分鐘)</td>
        <td style="width:20%">停留時間(分鐘)</td>
        <td style="width:30%">操作</td>
    </tr>
    <?php 
    //取出所有站點資料並依照before欄位進行排序
    $sql="select * from `station` order by `before`";
    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $key => $row){
    ?>
    <tr>
        <td><?=$row['name'];?></td>
        <td><?=$row['minute'];?></td>
        <td><?=$row['waiting'];?></td>
        <td>
            <button class="btn btn-warning" onclick="load('edit_station.php?id=<?=$row['id'];?>')">編輯</button>
            <button class="btn btn-danger" onclick="del('station',<?=$row['id'];?>)">刪除</button>
        </td>
    </tr>    
    <?php 
    }
    ?>    
    </table>
</div>