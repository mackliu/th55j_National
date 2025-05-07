<h1 class="border p-3 my-3 text-center">新增參與者</h1>
<form class="d-flex w-100 align-items-center justify-content-between form-group">
    <div class="row col-8 align-items-center">
        <label for="" class="col-2">電子信箱</label>
        <input type="text" name="email" id="email" class='form-control col-10'>
    </div>
    <div class="row col-4 align-items-center">
        <input type="button" value="新增" class=' w-100 btn btn-success' onclick='save()'>
    </div>
    
</form>
<hr>
<h3 class="p-1 my-3 text-center">批量新增參與者</h3>
<div class="d-flex w-100 align-items-center">
    <label for="" class="col-2">電子信箱</label>
    <textarea name="emails" id="emails" class="col-10 form-control" style="height:8rem"></textarea>
</div>
<div class="text-center">
    <button class="btn btn-primary col-12 my-3" onclick='massAdd()'>大量新增</button>
</div>

<input type="button" value="回上頁" class='col-12 btn btn-secondary my-1' onclick="load('admin_form.php');setActive('AdminForm')">
<script>
function save() {
    let data={
            email: $("#email").val(),
        }
    //使用ajax來增加使用者，增加成功後重新載入admin_form.php
    $.post("./api/add_user.php",data ,() => {
            load('admin_form.php');
            setActive('AdminForm')
        })
}
function massAdd() {
    let data={
            emails: $("#emails").val(),
        }
    //使用ajax來增加使用者，增加成功後重新載入admin_form.php
    $.post("./api/mass_add_user.php",data ,(res) => {
            alert(res)
            load('admin_form.php');
            setActive('AdminForm')
        })
}   
</script>