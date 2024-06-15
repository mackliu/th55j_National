<?php include_once "../api/db.php";?>
<div class="list">
    <h1 class="border p-3 text-center my-3">表單管理 
        <button class="btn btn-success" onclick="load('add_user.php')">新增參與者email</button>
    </h1>
    <div class='d-flex justify-content-between align-items-center p-2'>

        <?php $active=$pdo->query("select `active` from `form` limit 1")->fetchColumn();?>
        <div>
            表單啟用狀態：<button class="btn btn-primary my-3" id="form_status" onclick="form_status()" data-status="<?=$active;?>"><?=$active==1?"開啟中":"關閉中";?></button>
        </div>
        <div>
            <?php $busNum=$pdo->query("select ceil(count(*)/50) from `users`")->fetchColumn();?>
            預計接駁車數量：<?=$busNum;?><button class="btn btn-info">分配接駁車</button>
        </div>
    </div>
    <table class="table table-bordered text-center">
    <tr>
        <td style="width:30%">姓名</td>
        <td style="width:20%">電子信箱</td>
        <td style="width:30%">操作</td>
    </tr>
    <?php 
    //取出所有站點資料並依照before欄位進行排序
    $sql="select * from `users`";
    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $key => $row){
    ?>
    <tr>
        <td><?=$row['name'];?></td>
        <td><?=$row['email'];?></td>
        <td>
            <button class="btn btn-warning" onclick="load('edit_user.php?id=<?=$row['id'];?>')">編輯</button>
            <button class="btn btn-danger" onclick="del('users',<?=$row['id'];?>)">刪除</button>
        </td>
    </tr>    
    <?php 
    }
    ?>    
    </table>
</div>

<script>
function form_status(){
    let status=$("#form_status").data("status");
    $.post("api/form_status.php",{status},function(){
        $("#form_status").data("status",status==1?0:1);
        $("#form_status").text(status==1?"關閉中":"開啟中");
    })
}
</script>