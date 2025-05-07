<?php include_once "./api/db.php"; 
$user=$pdo->query("SELECT * FROM `users` WHERE `id`='{$_GET['id']}'")->fetch();
?>
<h1 class="border p-3 my-3 text-center">修改「<span id='title'><?=$user['email'];?></span>」</h1>
    <div class="row w-100">
        <label for="" class="col-2">姓名</label>   
        <input  type="text" name="name" id="name" value="<?=$user['name'];?>" class='form-group form-control col-10'>
    </div>
    <div class="row w-100">
        <label for="" class="col-2">接駁車</label>   
        <input  type="text" name="bus" id="bus" value="<?=$user['bus'];?>" class='form-group form-control col-10'
                >
    </div>
    <div class="row w-100">
        <button class='col-12 btn btn-success my-1'>修改</button>
        <input  type="button" value="修改" onclick="save()">
        <input  type="button" value="回上頁" onclick="load('admin_form.php');setActive('AdminForm')">
        <button class='col-12 btn btn-secondary my-1'>回上頁</button>
    </div>
<script>
function save(){

    let data={name:$("#name").val(),
              bus:$("#bus").val(),
              id:<?=$user['id'];?>
        }

    $.post("./api/edit_user.php",data,()=>{
        location.href='?page=admin-form';
    })
}
</script>