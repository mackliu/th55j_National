<h1 class="border p-3 my-3 text-center">新增路線</h1>
<form>

    <div class="row w-100">
        <label for="" class="col-2">路線名稱</label>
        <input type="text" name="station" id="station" class='form-group form-control col-10'>
        <div class="row w-100">
            <div class="col-6">
                <div class="text-center">選擇站點</div>
                <div id="station-list" class="d-flex flex-wrap align-items-center"></div>
            </div>
            <div class="col-6">
                <div class="text-center">編輯站點</div>
                <div id="selected-stations" class="list-group">
                    <div class="d-flex justify-content-between align-items-center list-group-item" data-id="${stationId}">
                        <div class="d-flex col-10">
                            <div class="col-6 px-1">站點名稱</div>
                            <div class="col-3 px-1">行駛時間</div>
                            <div class="col-3 px-1">停留時間</div>
                        </div>
                        <div class="col-1">&nbsp</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row w-100">
        <input type="button" id="add-button" value="新增" class='col-12 btn btn-success my-1' onclick='save()'>
        <input type="button" id="back-button" value="回上頁" class='col-12 btn btn-secondary my-1' onclick="load('admin_station.php');setActive('AdminStation')">
    </div>
</form>
<script>
    function save() {
        $.post("./api/add_station.php",{
                name: $("#station").val(),
            } ,() => {
                load('station-link.php');
                setActive('station-link')
            })

    }

    $.get("./api/get_stations.php", (data) => {
        //取得所有站點資料並在站點選擇區域顯示
        data.forEach(station=>{
            $("#station-list").append(`
            <div class="col-4 p-1 ">
                <div class="d-flex justify-content-between align-items-center btn btn-info">
                    <span>${station.name}</span>
                    <button class="station-btn btn btn-primary btn-sm" data-station-name="${station.name}" data-station-id="${station.id}">+</button>
                </div>
            </div>
            `)
        })

        //為每個站點按鈕綁定點擊事件，將選擇的站點加入到編輯區域
        $("#station-list .btn-primary").click(function(){
            let stationName=$(this).data("station-name")
            let stationId=$(this).data("station-id")
            let rank=$(".selected-item").length+1

            $("#selected-stations").append(`
                <div class="selected-item d-flex justify-content-between align-items-center list-group-item" data-id="${stationId}">
                    <div class="d-flex col-10 align-items-center">
                        <div class="col-6 px-1">${stationName}</div>
                        <input type="number" class="col-3 p-1 form-control border-bottom" placeholder="行駛時間" min="0" value="0">
                        <input type="number" class="col-3 p-1 form-control border-bottom" placeholder="停留時間" min="0" value="0">
                    </div>
                    <div class="col-1 d-flex flex-column">
                        <div data-rank="${rank}" class="move-up" style="cursor:pointer;">&#x2BC5;</div>
                        <div data-rank="${rank}" class="move-down" style="cursor:pointer;">&#x2BC6;</div>
                    </div>
                    <button class="btn btn-danger col-1 btn-sm">-</button> 
                </div>
            `)
            $(this).parent().parent().remove()
            //為新增的站點按鈕綁定刪除事件，並將站點加回到選擇區域
            $("#selected-stations .btn-danger").click(function(){
                $(this).parent().remove()
                
            })
            //為新增的站點按鈕綁定上移事件
            $(".selected-item .move-up").click(function(){
                let rank=$(this).data("rank")
                let prevItem=$(this).parent().parent().prev()
                if(prevItem.length>0){
                    $(this).parent().parent().insertBefore(prevItem)
                    $(this).data("rank",rank-1)
                    prevItem.find(".move-up").data("rank",rank)
                }
            })
            //為新增的站點按鈕綁定下移事件
            $(".selected-item .move-down").click(function(){
                let rank=$(this).data("rank")
                let nextItem=$(this).parent().parent().next()
                if(nextItem.length>0){
                    $(this).parent().parent().insertAfter(nextItem)
                    $(this).data("rank",rank+1)
                    nextItem.find(".move-down").data("rank",rank)
                }
            })
        })
    });
</script>