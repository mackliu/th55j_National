<?php include_once "../api/db.php";?>
<div class="list">
<h1 class="text-center my-3 border">路線管理</h1>
<button class="btn btn-success" onclick="load('add_route.php')">新增</button>
<table class='table table-bordered text-center w-100' id='routes-table'>
    <thead>
    <tr class="bg-info text-white">
        <td>路線名稱</td>
        <td>站點數量</td>
        <td>操作</td>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>
<script>
$.get("./api/get_routes.php", (routes) => {
    //console.log(routes)
    routes.forEach(route => {
        $("#routes-table tbody").append(`
            <tr data-id="${route.id}">
                <td>${route.name}</td>
                <td>${route.station_count}</td>
                <td>
                    <button class="btn btn-warning edit-route-button" data-route="${route.name}">編輯</button>
                    <button class="btn btn-danger delete-route-button" data-route="${route.name}"  data-id="${route.id}">刪除</button>
                </td>
            </tr>
        `)
    })

    //綁定編輯和刪除按鈕的事件
    $(".edit-route-button").on("click", function () {
        let routeName = $(this).data("route")
        load('edit_route.php?name=' + routeName)
        setActive('route-link')
    })

    $(".delete-route-button").on("click", function () {
        let routeName = $(this).data("route")
        if (confirm(`確定要刪除${routeName}路線嗎?`)) {
            $.post("./api/del.php", {
                table: 'route',
                id:$(this).data('id')
            }, (res) => {
                //console.log(res)
                load('route-link.php')
                setActive('route-link')
            })
        }
    })
})

</script>
