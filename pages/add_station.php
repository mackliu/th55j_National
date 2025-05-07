<h1 class="border p-3 my-3 text-center">新增站點</h1>
    <div class="row w-100">
        <label for="" class="col-2">站點名稱</label>
        <input type="text" name="station" id="station" class='form-group form-control col-10'>
    </div>
    <div class="row w-100">
        <button id="add-button" class='col-12 btn btn-success my-1'>新增</button>
        <button id="back-button" class='col-12 btn btn-secondary my-1'>回上頁</button>
    </div>
<script>
$("#add-button").on("click",function(){
    $.post("./api/add_station.php",{
            name: $("#station").val(),
        } ,() => {
            location.href='?page=station-link';
        })    
})
$("#back-button").on("click",function(){
    location.href='?page=station-link';
})
</script>