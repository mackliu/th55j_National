<?php include_once "../api/db.php";?>
<div class="list">
<h1 class="text-center my-3 border">車輛管理</h1>
<button class="btn btn-success" id="add-bus-button" onclick="load('add_bus.php')">新增</button>
<table class='table table-bordered text-center w-100' id='bus-list'>
    <thead>
    <tr>
        <td>路線</td>
        <td>車牌</td>
        <td>已行駛時間</td>
        <td>操作</td>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
<script>
$.get("./api/get_bus_list.php", (data) => {
    console.log(data);
    //使用迴圈將路線資料加入到下拉選單(#route)中
    data.forEach(bus => {
        $("#bus-list tbody").append(`
        <tr>
            <td class="bus-route">${bus.route_name}</td>
            <td class="bus-plate">${bus.plate}</td>
            <td class="bus-runtime">${bus.runtime}分鐘</td>
            <td>
                <button class="btn btn-warning edit-bus-button" data-bus-plate="${bus.plate}">編輯</button>
                <button class="btn btn-danger delete-bus-button" data-bus-plate="${bus.plate}" data-id="${bus.id}">刪除</button>
            </td>
        </tr>
    `)
    });

    //綁定編輯和刪除按鈕的事件
    $(".edit-bus-button").on("click", function () {
        let busPlate = $(this).data("bus-plate");
        load('edit_bus.php?plate=' + busPlate);
        setActive('bus-link')
    })

    $(".delete-bus-button").on("click", function () {
        let busPlate = $(this).data("bus-plate")
        if (confirm(`確定要刪除${busPlate}嗎?`)) {
            $.post("./api/del.php", {
                plate: busPlate,
                table: 'bus',
                id:$(this).data('id')
            }, (res) => {
                //console.log(res)
                load('bus-link.php')
                setActive('bus-link')
            })
        }
    })
})
</script>

