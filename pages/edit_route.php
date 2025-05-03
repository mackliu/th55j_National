<?php 
include_once "../api/db.php";

$route=q("select * from `route` where `name`='{$_GET['name']}'")[0];


?>

<h1 class="border p-3 my-3 text-center">編輯<?=$_GET['name'];?>路線</h1>

    <div class="row w-100">
        <label for="" class="col-2">路線名稱</label>
        <input type="text" name="route" id="route" class='form-group form-control col-10' value="<?=$route['name'];?>">
        <div class="row w-100">
            <div class="col-10 m-auto">
                <div class="text-center">選擇站點</div>
                <div id="station-list">

                </div>
            </div>
            
        </div>
    </div>
    <div class="row w-100">
        <input type="button" id="edit-button" value="編輯" class='col-12 btn btn-success my-1'>
        <input type="button" id="back-button" value="回上頁" class='col-12 btn btn-secondary my-1'>
    </div>

<script>
    //將整段程式包在jquery的ready事件中，確保DOM元素已經載入完成
    //同時解決stations 及 selectedStations變數的作用域問題
    $(function(){
        let stations=[];
        let selectedStations=[];

    //當按下編輯路線按鈕時，將路線名稱及選擇的站點資料傳送到api/add_route.php
    $("#edit-button").on("click",function(){
        
        selectedStations.length=0;

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
        if($("#route").val()!="" && selectedStations.length>1){

            $.post("./api/edit_route.php",{
                    routeName: $("#route").val(),
                    id:<?=$route['id'];?>,
                    stations:selectedStations
                } ,(res) => {
                    console.log(res)
                    load('route-link.php');
                    setActive('route-link')
                })
        }else{
            alert("請輸入路線名稱並確認至少選擇兩個站點");
        }
    })

    //回上頁按鈕
    $("#back-button").on("click",function(){
        load('route-link.php');
        setActive('route-link')
    })

    //載入所有站點
    $.get("./api/get_stations.php",{id:<?=$route['id'];?>}, (data) => {
        stations.length=0;   //先清空陣列

        console.log(data)
        //將ajax取得的資料放入全域變數stations中
        data.route_stations.forEach(station => {
            stations.push(station);
        });
        data.stations.forEach(station=>{
            stations.push(station)
        })
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
            console.log(station.route_id)
            if(typeof(station.route_id)=='undefined'){

                $("#station-list").append(`
                <div class="station-select col-12 p-1  d-flex ">
                    <input type='checkbox' class="station-chk" data-station-name="${station.name}" data-station-id="${station.id}" />
                    <span>${station.name}</span>
                </div>
                `)
            }else{
                $("#station-list").append(`
                <div class="station-select col-12 p-1  d-flex ">
                    <input type='checkbox' class="station-chk" data-station-name="${station.name}" data-station-id="${station.station_id}" checked />
                    <span>${station.name}</span>
                    <input type='number' class='arriving-time form-control mx-1 col-3' placeholder="行駛時間" name='arriving_time'  value='${station.arriving_time}'>
                    <input type='number' class='staying-time form-control mx-1 col-3' placeholder="停留時間" name='staying_time'  value='${station.staying_time}'>
                    <input type='number' class='seq form-control mx-1 col-3' placeholder='順序' name='seq'  value='${station.seq}'>
                </div>
                `)

            }
        })

        $(".station-chk").on("click",function(){

            if($(this).prop('checked')){

                $(this).parent().append(
                    `
                    <input type='number' class='arriving-time form-control mx-1 col-3' placeholder="行駛時間" name='arriving_time'  value=''>
                    <input type='number' class='staying-time form-control mx-1 col-3' placeholder="停留時間" name='staying_time'  value=''>
                    <input type='number' class='seq form-control mx-1 col-3' placeholder='順序' name='seq'  value=''>
                    `
                )
            }else{
                $(this).siblings('.arriving-time').remove()
                $(this).siblings('.staying-time').remove()
                $(this).siblings('.seq').remove()
            }

        })

    }

    })
    
</script>