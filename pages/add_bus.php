<h1 class="text-center my-3 border">新增接駁車</h1>
<form>
    <div class="row w-100">
        <label for="" class="col-2">車牌</label>
        <input type="text" name='name' id='name' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <label for="" class="col-2">已行駛時間(分鐘)</label>
        <input type="number" min='0' step='1' required name='minute' id='minute' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <input type="button" value="新增" class='btn btn-success my-1 col-12' onclick="save()">
    <input type="button" value="回上一頁" onclick="load('admin_bus.php');setActive('AdminBus')" class='btn btn-secondary my-1 col-12'>
    </div>

</form>

<script>
function save(){
let data={name:$("#name").val(),
          minute:$("#minute").val()
        }
 $.post("./api/add_bus.php",data,()=>{
    load('admin_bus.php');
    setActive('AdminBus')
 })     
}    
</script>