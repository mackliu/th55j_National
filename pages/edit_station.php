<?php include_once "../api/db.php"; 
$station=q("SELECT * FROM `station` WHERE `name`='{$_GET['name']}'")[0];
?>
<h1 class="border p-3 my-3 text-center">修改「<span id='title'><?=$station['name'];?></span>」</h1>
<div class="row w-100">
    <label for="" class="col-2">站點名稱</label>   
    <input  type="text" name="station-name" id="station-name" value="<?=$station['name'];?>" class='form-group form-control col-10'
             required>
</div>
<div class="row w-100">
    <input  type="button" id="edit-button" data-id="<?=$station['id'];?>" value="修改" class='col-12 btn btn-success my-1'>
    <input  type="button" id="back-button" value="回上頁" class='col-12 btn btn-secondary my-1'>
</div>
<script>
//當按下修改按鈕時，將路線名稱及選擇的站點資料傳送到api/edit_station.php
$("#edit-button").on("click",function(){
    $.post("./api/edit_station.php",{
                name: $("#station-name").val(),
                id:$(this).data('id')
            } ,(res) => {
            //console.log(res)
            load('station-link.php');
            setActive('station-link')
        })
})
//回上頁按鈕
$("#back-button").on("click",function(){
    load('station-link.php');
    setActive('station-link')
})
</script>