<h1 class="border p-3 my-3 text-center">新增路線</h1>

    <div class="row w-100">
        <label for="" class="col-2">路線名稱</label>
        <input type="text" name="route" id="route" class='form-group form-control col-10'>
        <div class="row w-100">
            <div class="col-10 m-auto">
                <div class="text-center">選擇站點</div>
                <div id="station-list">

                </div>
            </div>
            
        </div>
    </div>
    <div class="row w-100">
        <input type="button" id="add-button" value="新增" class='col-12 btn btn-success my-1'>
        <input type="button" id="back-button" value="回上頁" class='col-12 btn btn-secondary my-1'>
    </div>

<script>
    //將整段程式包在jquery的ready事件中，確保DOM元素已經載入完成
    //同時解決stations 及 selectedStations變數的作用域問題
    $(function(){
        let stations=[];
        let selectedStations=[];

    //當按下新增路線按鈕時，將路線名稱及選擇的站點資料傳送到api/add_route.php
    $("#add-button").on("click",function(){
        $(".station-chk:checked").each(function(){
            
            let station={
                stationId:$(this).data('station-id'),
                stationName:$(this).data('station-name'),
                arrivingTime:$(this).siblings('.arriving-time').val(),
                stayingTime:$(this).siblings('.staying-time').val(),
                seq:$(this).siblings('.seq').val()
            }

            selectedStations.push(station)
        })

        //console.log(selectedStations);

        $.post("./api/add_route.php",{
                routeName: $("#route").val(),
                stations:selectedStations
            } ,(res) => {
                //console.log(res)
                load('route-link.php');
                setActive('route-link')
            })
    })

    //回上頁按鈕
    $("#back-button").on("click",function(){
        load('route-link.php');
        setActive('route-link')
    })

    //載入所有站點
    $.get("./api/get_stations.php", (data) => {
        stations.length=0;   //先清空陣列

        //將ajax取得的資料放入全域變數stations中
        data.forEach(station => {
            stations.push(station);
        });

        //列出站點
        listStations(stations);
        

        
    });

    /**
     * 列出所有站點
     */
    function listStations(stations){
        //先清空站點選擇區域的內容
        $("#station-list").empty()

        //取得所有站點資料並在站點選擇區域顯示
        stations.forEach(station=>{
            $("#station-list").append(`
            <div class="station-select col-12 p-1  d-flex ">
                <input type='checkbox' class="station-chk" data-station-name="${station.name}" data-station-id="${station.id}" />
                <span>${station.name}</span>
                

            </div>
            `)
        })

        $(".station-chk").on("click",function(){
            $(this).parent().append(
                `
                <input type='number' class='arriving-time form-control mx-1 col-3' placeholder="行駛時間" name='arriving_time'  value=''>
                <input type='number' class='staying-time form-control mx-1 col-3' placeholder="停留時間" name='staying_time'  value=''>
                <input type='number' class='seq form-control mx-1 col-3' placeholder='順序' name='seq'  value=''>
                `
            )
        })

    }

   /*  function listSelectedStations(selectedStations){
        //先清空編輯區域的內容
        $("#selected-stations").empty()

        //列表顯示前先將selectedStations陣列中的資料依seq 由小到大排序
        selectedStations.sort((a,b)=>a.seq-b.seq)

        //將選擇的站點資料顯示在編輯區域
        selectedStations.forEach(station=>{
            $("#selected-stations").append(`
                <div class="selected-item d-flex justify-content-between align-items-center list-group-item" data-id="${station.station_id}" data-name="${station.station_name}" data-seq="${station.seq}">
                    <div class="d-flex col-10 align-items-center">
                        <div class="col-6 px-1">${station.station_name}</div>
                        <input type="number" class="col-3 p-1 form-control" name="arriving_time" min="0" value="${station.arriving_time}">
                        <input type="number" class="col-3 p-1 form-control" name="staying_time" min="0" value="${station.staying_time}">
                    </div>
                    <div class="col-1 d-flex flex-column">
                        <div  class="move-up" style="cursor:pointer;">&#x2BC5;</div>
                        <div  class="move-down" style="cursor:pointer;">&#x2BC6;</div>
                    </div>
                    <button class="btn btn-danger col-1 btn-sm">-</button>
                </div>
            `)
        })
    } */
    })
    
</script>