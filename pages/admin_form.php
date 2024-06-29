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
            <?php  //$busNum=$pdo->query("select ceil(count(*)/$number) from `users` where `status`='1'")->fetchColumn();?>
            預計接駁車數量：<button class="btn btn-info" onclick="allocate()">分配接駁車</button>
        </div>
    </div>
    <h2 class="text-center border-b pb-2">參與者清單</h2>
    <div id="users" class=" d-flex justify-content-between flex-wrap">
        <?php
        $users=$pdo->query("select * from `users`")->fetchAll();
        foreach($users as $user){
        ?>
        <div class="border d-flex justify-content-between align-items-center p-2 col-4">
            <div>
                <!-- 
                    1.增加checkbox 來決定是否參加
                    2.增加value來儲存使用者id
                    3.根據user中的join 欄位來判斷checked的狀態是空白還是打勾
                       空白代表未參加，打勾代表已參加
                 -->
                <input type="checkbox" name="join" id="join" value="<?=$user['id'];?>" <?=($user['join']==1)?'checked':'';?>>
                <?=$user['email'];?>
            </div>
            <div>
                <button class="btn btn-warning btn-sm" onclick="edit('users',<?=$user['id'];?>)">編輯</button>
                <button class="btn btn-danger btn-sm" onclick="del('users',<?=$user['id'];?>)">刪除</button>
            </div>
        </div>
        <?php
        }
        ?>
    
    </div>
</div>

<script>
function form_status(){
    let status=$("#form_status").data("status");
    $.post("api/form_status.php",{status},function(){
        //$("#form_status").data("status",status==1?0:1);
        //$("#form_status").text(status==1?"關閉中":"開啟中");
        load('admin_form.php');
        setActive('AdminForm')
    })
}
function allocate(){
    $.get("./api/allocate.php",()=>{
        alert("接駁車分配完畢")
        load('admin_form.php');
        setActive('AdminForm')
    })
}
function updateNumber(){
    $.post("./api/update_number.php",{number:$("#number").val()},()=>{
        alert("接駁車人數已更新");
    })
}
</script>