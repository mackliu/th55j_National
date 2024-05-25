$("#addMinute,#editMinute,#addWaiting,#editWaiting").on("invalid",function(){
    this.setCustomValidity("行駛時間或停留時間不應小於0")
})
$("#addMinute,#editMinute,#addWaiting,#editWaiting").on("input",function(){
    this.setCustomValidity("")
})


$(".sw").on("click",function(){
        let ids=$(this).data('id').split("-")
        console.log(ids)
        $.post("./api/sw.php",{ids},function(res){
            //console.log(res)
            location.reload();
        })
})

function del(table,id){
    $.post("./api/del.php",{table,id},()=>{
        location.reload();
    })
}

    //前端編輯資料用的函式
    function edit(table,id){
        let api;
        switch(table){
            case 'bus':
                api="api/get_bus.php";
            break;
            case 'station':
                api="api/get_station.php";

            break;
        }
        //使用getJSON向後端api get_bus.php發出取得資料的請求
        $.getJSON(api,{id},(data)=>{
            //api 回傳的資料會是一個json格式的物件
            //console.log(data)
            //將station物件中的name資料寫入到頁面上id為title的tag中
            $("#title").html(data.name);

            //將station物件中的minute資料寫入到頁面上id為editMinute的input欄位的值
            $("#editMinute").val(data.minute);

            if(table=='station'){
                //將station物件中的waiting資料寫入到頁面上id為editMinute的input欄位的值
                $("#editWaiting").val(data.waiting);
            }

            //將station物件中的id資料寫入到頁面上id為editId的input欄位的值
            $("#editId").val(data.id);
        })
    }
