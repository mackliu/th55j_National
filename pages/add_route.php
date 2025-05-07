<h1 class="border p-3 my-3 text-center">新增路線</h1>
    <div class="row w-100">
        <label for="" class="col-2">路線名稱</label>
        <input type="text" name="route" id="route" class='form-group form-control col-10'>
        <div class="row w-100">
            <div class="col-6">
                <div class="text-center">選擇站點</div>
                <div id="station-list"></div>
            </div>
        </div>
    </div>
    <div class="row w-100">
        <button id="add-button" class='col-12 btn btn-success my-1'>新增</button>
        <button id="back-button" class='col-12 btn btn-secondary my-1'>回上頁</button>
    </div>
<script>
//將整段程式包在jquery的ready事件中，確保DOM元素已經載入完成
//同時解決stations 及 selectedStations變數的作用域問題
$(function(){
    let stations=[];
    let selectedStations=[]; //用來存放選擇的站點資料
//當按下新增路線按鈕時，將路線名稱及選擇的站點資料傳送到api/add_route.php
$("#add-button").on("click",function(){

    $(".station-select .station-chk:checked").each(function(){
        let stationId=$(this).data("station-id");
        let stationName=$(this).val();
        let arriving_time=$(this).siblings("input[name='arriving_time']").val();
        let staying_time=$(this).siblings("input[name='staying_time']").val();
        let seq=$(this).siblings("input[name='seq']").val();

        selectedStations.push({
            station_id:stationId,
            name:stationName,
            arriving_time:arriving_time,
            staying_time:staying_time,
            seq:seq
        })
    })

    $.post("./api/add_route.php",{
            name: $("#route").val(),
            stations:selectedStations
        } ,(res) => {
            location.href= '?page=route-link'
        })
})

//回上頁按鈕
$("#back-button").on("click",function(){
    location.href= '?page=route-link'
})

$.get("./api/get_stations.php", (data) => {
    stations.length=0;   //先清空陣列

    //將ajax取得的資料放入全域變數stations中
    data.forEach(station => {
        stations.push(station);
    });

    //列出站點
    listStations(stations);
});

function listStations(stations){
    //先清空站點選擇區域的內容
    $("#station-list").empty()

    //取得所有站點資料並在站點選擇區域顯示
    stations.forEach(station=>{
        $("#station-list").append(`
        <div class="station-select col-12 p-1 d-flex">
                <input type=checkbox class='station-chk' data-station-id="${station.id}"   name="station" value="${station.name}" />
                <span>${station.name}</span>
        </div>
        `)
    })

    $(".station-chk").on("click",function(){
        //console.log($(this).val())
        $(this).parent().append(
            `
            <input type="number" class=" form-control col-3" name="arriving_time" placeholder="行駛時間" value="" min="0">分
            <input type="number" class=" form-control col-3" name="staying_time" placeholder="停留時間" value="" min="0">分
            <input type="number" class=" form-control col-3" name="seq" placeholder="順序" value="">
            `
        )
    })
}
})
</script>