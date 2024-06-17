<h1 class="border p-3 my-3 text-center">新增參與者</h1>
<form>

    <div class="row w-100">
        <label for="" class="col-2">電子信箱</label>
        <input type="text" name="email" id="email" class='form-group form-control col-10'>
    </div>
    <div class="row w-100">
        <input type="button" value="新增" class='col-12 btn btn-success my-1' onclick='save()'>
        <input type="button" value="回上頁" class='col-12 btn btn-secondary my-1' onclick="load('admin_form.php');setActive('AdminForm')">
    </div>
</form>
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
</script>