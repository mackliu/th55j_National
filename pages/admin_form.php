<?php include_once "../api/db.php";?>
<div class="list">
    <h1 class="border p-3 text-center my-3">表單管理 
        <button class="btn btn-success" onclick="load('add_user.php')">新增參與者email</button>
    </h1>
    <div class='d-flex justify-content-between align-items-center p-2'>
            <!-- 取得表單啟用狀態 -->
        <?php $active=$pdo->query("select `active` from `form` limit 1")->fetchColumn();?>
        <div>
            表單啟用狀態：<button class="btn btn-primary my-3" id="form_status" onclick="form_status()" data-status="<?=$active;?>"><?=$active==1?"開啟中":"關閉中";?></button>
        </div>
        <div>
            <!-- 取得接駁車人數 -->
            <?php $number=$pdo->query("select `number` from `number` limit 1")->fetchColumn();?>
            接駁車人數：<input type="number" name="number" id="number" value="<?=$number;?>" style='width:50px'>
            <button class='btn btn-primary btn-sm' onclick="updateNumber()">更新</button>
        </div>
        <div>
            <!-- 取得預計接駁車數量 -->
            <?php  $busNum=$pdo->query("select ceil(count(*)/$number) from `result`")->fetchColumn();?>
            預計接駁車數量：<?=$busNum;?><button class="btn btn-info" onclick="allocate()">分配接駁車</button>
        </div>
    </div>
    <table class="table table-bordered text-center" id='form'>
        <thead>
    <tr>
        <td style="width:20%">電子信箱</td>
        <td style="width:20%">姓名</td>
        <td style="width:20%">接駁車</td>
        <td style="width:30%">操作</td>
    </tr>
</thead>
    <tbody>
    <?php 
    //取出所有email資料並依照before欄位進行排序
    $sql="select * from `users`";
    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $key => $row){
    if($row['status']==0){
        echo "<tr>";
    }else if($row['status']==1){
        echo "<tr class='bg-success text-white'>";
    }else{
        echo "<tr class='bg-info'>";
    }
    ?>

    
        <td><?=$row['email'];?></td>
        <td><?=($row['name']=='')?'尚未回應':$row['name'];?></td>
        <td><?=($row['bus']=='')?'未分派':$row['bus'];?></td>
        <td>
            <button class="btn btn-warning" onclick="load('edit_user.php?id=<?=$row['id'];?>')">編輯</button>
            <button class="btn btn-danger" onclick="del('users',<?=$row['id'];?>)">刪除</button>
        </td>
    </tr>    
    <?php 
    }
    ?>    
    </tbody>
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
function allocate(){
    $.get("./api/allocate.php",()=>{
        alert("接駁車分配完畢")
        location.reload();
    })
}
function updateNumber(){
    $.post("./api/update_number.php",{number:$("#number").val()},()=>{
        alert("接駁車人數已更新");
    })
}
</script>