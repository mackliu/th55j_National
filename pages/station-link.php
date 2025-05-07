
<div class="list">
    <h1 class="border p-3 text-center my-3">站點管理 
        <button class="btn btn-success" id="add-station-button" onclick="load('add_station.php')">新增</button>
    </h1>
    <table class="table table-bordered text-center" id='station'>
        <thead>
    <tr>
        <td style="width:30%">站點名稱</td>
        <td style="width:30%">操作</td>
    </tr>
        </thead>    
    <tbody>
      
    </tbody>
    </table>
</div>
<script>


$.get("./api/get_stations.php",(stations)=>{
    $("#station tbody").empty()
    stations.forEach(station => {
        $("#station tbody").append(`
            <tr>
                <td>${station.name}</td>
                <td>
                    <button class="btn btn-warning edit-station-button" data-station="${station.name}">編輯</button>
                    <button class="btn btn-danger delete-station-button" data-station="${station.name}" data-id="${station.id}">刪除</button>
                </td>
            </tr>
        `)
    })
    
//綁定編輯和刪除按鈕的事件
$(".edit-station-button").on("click",function(){
        let stationName=$(this).data("station");
        load('edit_station.php?name='+stationName);
        setActive('station-link')
    })

 $(".delete-station-button").on("click",function(){
    let stationName=$(this).data("station")
    if(confirm(`確定要刪除${stationName}嗎?`)){
        $.post("./api/del.php",{
            name:stationName,
            id:$(this).data('id'),
            table:'station'
        },(res)=>{
            //console.log(res)
            load('station-link.php')
            setActive('station-link')
        })
    }
 })
})


</script>