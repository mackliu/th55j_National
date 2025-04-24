<h1 class="text-center my-3 border">新增車輛</h1>
<form>
    <div class="row w-100">
        <label for="" class="col-2">路線</label>
        <input type="text" name='route' id='route' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
        <label for="" class="col-2">車牌</label>
        <input type="text" name='plate' id='plate' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <label for="" class="col-2">已行駛時間(分鐘)</label>
        <input type="number" min='0' step='1' required name='runtime' id='runtime' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <input type="button" value="新增" id="add-button" class='btn btn-success my-1 col-12' onclick="save()">
    <input type="button" value="回上一頁" id="back-button" onclick="load('admin_bus.php');setActive('AdminBus')" class='btn btn-secondary my-1 col-12'>
    </div>

</form>

<script>
function save(){
let data={ 
            route:$("#route").val(),
            plate:$("#plate").val(),
            runtime:$("#runtime").val()
        }
 $.post("./api/add_bus.php",data,()=>{
    load('bus-link.php');
    setActive('bus-link')
 })     
}    
</script>