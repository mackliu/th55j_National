<h1 class="text-center my-3 border">修改接駁車</h1>
<form action="./api/edit_bus.php" method="post">
    <div class="row w-100">
    <label for="" class="col-2">已行駛時間(分鐘)</label>
        <input type="number" min='0' step='1' required name='minute' id='editMinute' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <input type="submit" value="修改" class='btn btn-success my-1 col-12'>
    <input type="button" value="回上一頁" onclick="load('admin_bus.php');setActive('AdminBus')"  class='btn btn-secondary my-1 col-12'>
    </div>

</form>