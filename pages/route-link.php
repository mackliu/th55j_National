
<div class="list">
<h1 class="text-center my-3 border">路線管理</h1>

<a class="btn btn-success" href='?page=add_route'>新增</a>
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
        location.href= '?page=edit_route&name=' + routeName
    })

    $(".delete-route-button").on("click", function () {
        let routeName = $(this).data("route")
        if (confirm(`確定要刪除${routeName}路線嗎?`)) {
            $.post("./api/del.php", {
                table: 'route',
                id:$(this).data('id')
            }, (res) => {
                //console.log(res)
                location.href= '?page=route-link'
            })
        }
    })
})

</script>
