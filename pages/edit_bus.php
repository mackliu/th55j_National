<?php include_once "../api/db.php";
$bus=q("SELECT `bus`.*,`route`.`name` as `route_name` 
        FROM `bus`,`route` 
        WHERE `bus`.`route_id`=`route`.`id` 
        AND `plate`='{$_GET['plate']}'")[0];

?>
<h1 class="text-center my-3 border">修改 <?=$bus['route_name'];?> 路線「<span id="bus-plate"><?=$bus['plate'];?></span>」車輛</h1>
    <div class="row w-100">
    <label for="runtime" class="col-2">已行駛時間(分鐘)</label>
        <input type="number" min='1' step='1' required value="<?=$bus['runtime'];?>" name='runtime' id='runtime' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <input type="button" value="修改" data-id="<?=$bus['id'];?>" id="edit-button" class='btn btn-success my-1 col-12' >
    <input type="button" value="回上一頁" id="back-button"  class='btn btn-secondary my-1 col-12'>
    </div>
<script>


$("#edit-button").on("click",function(){
    let data={
        runtime:$("#runtime").val(),
        id:$(this).data('id')
    }
    $.post("./api/edit_bus.php",data,()=>{
        load('bus-link.php');
        setActive('bus-link')
    })
})

$("#back-button").on("click",function(){
    load('bus-link.php');
    setActive('bus-link')
})
</script>