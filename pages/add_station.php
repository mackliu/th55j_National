<h1 class="border p-3 my-3 text-center">新增站點</h1>
<form>

    <div class="row w-100">
        <label for="" class="col-2">站點名稱</label>
        <input type="text" name="station" id="station" class='form-group form-control col-10'>
    </div>
    <div class="row w-100">
        <input type="button" id="add-button" value="新增" class='col-12 btn btn-success my-1' onclick='save()'>
        <input type="button" id="back-button" value="回上頁" class='col-12 btn btn-secondary my-1' onclick="load('admin_station.php');setActive('AdminStation')">
    </div>
</form>
<script>
    function save() {
        let data={
                name: $("#name").val(),
                minute: $("#minute").val(),
                waiting: $("#waiting").val()
            }
        $.post("./api/add_station.php",data ,() => {
                load('admin_station.php');
                setActive('AdminStation')
            })

    }
</script>