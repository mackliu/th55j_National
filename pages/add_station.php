<h1 class="border p-3 my-3 text-center">新增站點</h1>
<form>

    <div class="row w-100">
        <label for="" class="col-2">站點名稱</label>
        <input type="text" name="station" id="station" class='form-group form-control col-10'>
    </div>
    <div class="row w-100">
        <input type="button" id="add-button" value="新增" class='col-12 btn btn-success my-1'>
        <input type="button" id="back-button" value="回上頁" class='col-12 btn btn-secondary my-1' onclick="load('admin_station.php');setActive('AdminStation')">
    </div>
</form>
<script>
$("#add-button").on('click',function(){

    if($("#station").val()!=""){
        $.get("./api/chk_station.php",{name:$("#station").val()},function(chked){
            if(parseInt(chked)==1){
                alert(`${$("#station").val()}已經被使用了，請取其它站名`)
            }else{
                $.post("./api/add_station.php",{
                        name: $("#station").val(),
                    } ,() => {
                        load('station-link.php');
                        setActive('station-link')
                    })
            }
        })
    }else{
        alert("請輸入站點名稱,站點名稱不可為空白")
    }
})


</script>