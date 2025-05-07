<h1 class="text-center my-3 border">新增車輛</h1>
    <div class="row w-100">
        <label for="" class="col-2">路線</label>
        <select name="route" id="route" class="form-group form-control col-10">
            <option value="">請選擇路線</option>
        </select>
    </div>
    <div class="row w-100">
        <label for="" class="col-2">車牌</label>
        <input type="text" name='plate' id='plate' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <label for="" class="col-2">已行駛時間(分鐘)</label>
        <input type="number" min='1' step='1' required name='runtime' id='runtime' class="form-group form-control col-10">
    </div>
    <div class="row w-100">
    <button id="add-button" class='btn btn-success my-1 col-12'>新增</button>
    <button id="back-button" class='btn btn-secondary my-1 col-12'>回上一頁</button>    
</div>
<script>
   
// 取得路線資料
$.get("./api/get_routes.php", (data) => {
    //使用迴圈將路線資料加入到下拉選單(#route)中
    data.forEach(route => {
        $("#route").append(`<option value="${route.id}">${route.name}(${route.station_count}站)</option>`)
    });
})
    //當按下新增路線按鈕時，將路線名稱及選擇的站點資料傳送到api/add_route.php
    $("#add-button").on("click",function(){
        $.post("./api/add_bus.php",{
                route_id: $("#route").val(),
                plate: $("#plate").val(),
                runtime: $("#runtime").val()
            } ,(res) => {
                //console.log(res)
                location.href= '?page=bus-link'
            })
    })

    //回上頁按鈕
    $("#back-button").on("click",function(){
        location.href= '?page=bus-link'
    })
</script>