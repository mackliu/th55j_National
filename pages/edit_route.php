<?php include_once "./api/db.php"; 
$route=q("SELECT * FROM `route` WHERE `name`='{$_GET['name']}'")[0];
?>
<h1 class="border p-3 my-3 text-center">修改「<span id='title'><?=$route['name'];?></span>」路線</h1>
<div class="row w-100">
    <label for="" class="col-2">路線名稱</label>   
    <input  type="text" name="route" id="route" value="<?=$route['name'];?>" class='form-group form-control col-10'
             required>
</div>
<div class="row w-100">
            <div class="col-6">
                <div class="text-center">選擇站點</div>
                <div id="station-list" class="d-flex flex-wrap align-items-center"></div>
            </div>
            <div class="col-6">
                <div class="text-center">編輯站點</div>
                <div class="list-group">
                    <div class="d-flex justify-content-between align-items-center list-group-item" data-id="${stationId}">
                        <div class="d-flex col-10">
                            <div class="col-6 px-1">站點名稱</div>
                            <div class="col-3 px-1">行駛時間</div>
                            <div class="col-3 px-1">停留時間</div>
                        </div>
                        <div class="col-1">&nbsp</div>
                    </div>
                </div>
                <div id="selected-stations" class="list-group">

                </div>

            </div>
        </div>

<div class="row w-100">
    <input  type="button" id="edit-button" data-id="<?=$route['id'];?>" value="修改" class='col-12 btn btn-success my-1'>
    <input  type="button" id="back-button" value="回上頁" class='col-12 btn btn-secondary my-1'>
</div>
<script>
    //將整段程式包在jquery的ready事件中，確保DOM元素已經載入完成
    //同時解決stations 及 selectedStations變數的作用域問題
    $(function(){
        //定義全域變數stations及selectedStations
        let stations=[];
        let selectedStations=[];

    //當按下修改路線按鈕時，將路線名稱及選擇的站點資料傳送到api/edit_route.php
    $("#edit-button").on("click",function(){
    $.post("./api/edit_route.php",{
                name: $("#route").val(),
                id:$(this).data('id'),
                stations:selectedStations
            } ,(res) => {
            location.href= '?page=route-link'
        })
})

    //回上頁按鈕
    $("#back-button").on("click",function(){
        location.href= '?page=route-link'
    })

    //取得所有該路線站點資料並在編輯站點區域顯示
    $.get("./api/get_route_stations.php",{id:<?=$route['id'];?>}, (data) => {
        //console.log(data)
        selectedStations.length=0;   //先清空陣列

        //將ajax取得的資料放入全域變數selectedStations中
        data.forEach(station => {
            selectedStations.push(station);
        });
        //console.log(selectedStations)
        //列出站點
        listSelectedStations(selectedStations);
    });

    //取得所有未被選取的站點資料並在站點選擇區域顯示
    $.get("./api/get_stations.php",{id:<?=$route['id'];?>}, (data) => {
        //console.log(data)
        stations.length=0;   //先清空陣列

        //將ajax取得的資料放入全域變數stations中
        data.forEach(station => {
            stations.push(station);
        });

        //列出站點
        listStations(stations);
        //將要加入路線的站點資料加入到selectedStations陣列中，並在編輯區域顯示
        $("#station-list").on("click",".btn-primary",function(){
            //取得站點資料
            let stationName=$(this).data("station-name")
            let stationId=$(this).data("station-id")
            //找出selectedStations中最大的seq值+1來做為新站點的seq值
            //如果selectedStations中還沒有資料，則seq=1
            let seq=0;
            if(selectedStations.length==0){
                seq=1
            }else{
                seq=Math.max(...selectedStations.map(station=>station.seq))+1
            }
           //站點資料加入到selectedStations陣列中
            selectedStations.push({
                station_id: stationId,
                station_name: stationName,
                arriving_time: 1,
                staying_time: 1,
                seq: seq
            })
            //在stations陣列中移除已選擇的站點
            stations=stations.filter(station=>station.id!=stationId)

            //移除站點
            $(this).parent().parent().remove()

            //將選擇的站點資料顯示在編輯區域
            listSelectedStations(selectedStations)
            //console.log(stations,selectedStations)
        })

        $("#selected-stations")
            .on("click",".move-up",function(){ //綁定上移事件
                let seq=$(this).parents(".selected-item").data("seq")
                let prevItem=$(this).parents(".selected-item").prev()
                if(prevItem.length>0){
                    $(this).parents(".selected-item").insertBefore(prevItem)
                    $(this).parents(".selected-item").data("seq",seq-1)
                    $(prevItem).data("seq",seq)
                    //更新selelctedStations陣列中的seq值
                    //取得目前站點的在selectedStations中的index值
                    let index=selectedStations.findIndex(station=>station.station_id==$(this).parents(".selected-item").data("id"))
                    selectedStations[index].seq=seq-1

                    //取得上移的站點在selectedStations中的index值
                    index=selectedStations.findIndex(station=>station.station_id==$(prevItem).data("id"))
                    selectedStations[index].seq=seq
                }
                //console.log(selectedStations)
        })
        .on("click",".move-down",function(){  //綁定下移事件
            let seq=$(this).parents(".selected-item").data("seq")
                let nextItem=$(this).parents(".selected-item").next()
                if(nextItem.length>0){
                    $(this).parents(".selected-item").insertAfter(nextItem)
                    $(this).parents(".selected-item").data("seq",seq+1)
                    $(nextItem).data("seq",seq)
                    //更新selelctedStations陣列中的seq值
                    //取得目前站點的在selectedStations中的index值
                    let index=selectedStations.findIndex(station=>station.station_id==$(this).parents(".selected-item").data("id"))
                    selectedStations[index].seq=seq+1
                    //取得下移的站點在selectedStations中的index值
                    index=selectedStations.findIndex(station=>station.station_id==$(nextItem).data("id"))
                    selectedStations[index].seq=seq
                }
               // console.log(selectedStations)
        })
        .on("click",".btn-danger",function(){  //綁定刪除事件
            let id=$(this).parents(".selected-item").data("id")
            let name=$(this).parent().find(".col-6").text()
            let index=selectedStations.findIndex(station=>station.station_id==id)
            //將刪除的站點資料從selectedStations陣列中移除
            selectedStations.splice(index,1)
            //重新列表選擇的站點資料
            listSelectedStations(selectedStations)
            
            //將刪除的站點重新加入到stations陣列中
            stations.push({
                id: id,
                name: name
            })
            //更新選擇的站點資料顯示
            listStations(stations)
        })
        .on("change","input",function(){  //綁定輸入框變更事件
            let id=$(this).parents(".selected-item").data("id")
            let name=$(this).parents(".selected-item").data("name")
            let index=selectedStations.findIndex(station=>station.station_id==id)

            //將輸入框(行駛時間及停留時間)的值存入selectedStations陣列中
            selectedStations[index][$(this).attr("name")]=$(this).val()
        })
    });


    function listStations(stations){
        //先清空站點選擇區域的內容
        $("#station-list").empty()

        //取得所有站點資料並在站點選擇區域顯示
        stations.forEach(station=>{
            $("#station-list").append(`
            <div class="col-4 p-1 ">
                <div class="d-flex justify-content-between align-items-center btn btn-info">
                    <span>${station.name}</span>
                    <button class="station-btn btn btn-primary btn-sm" data-station-name="${station.name}" data-station-id="${station.id}">+</button>
                </div>
            </div>
            `)
        })
    }

    function listSelectedStations(selectedStations){
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
    }
    })

</script>