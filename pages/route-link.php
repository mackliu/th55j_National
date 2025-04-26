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
                    <button class="btn btn-danger delete-route-button" data-route="${route.name}">刪除</button>
                </td>
            </tr>
        `)
    })
})

</script>