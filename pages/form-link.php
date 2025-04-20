<?php include_once "../api/db.php";?>
<div class="list">
    <h1 class="border p-3 text-center my-3">表單管理 
        <button class="btn btn-success" onclick="load('add_user.php')">新增參與者email</button>
    </h1>
    <div class='d-flex justify-content-between align-items-center p-2'>
            <!-- 取得表單啟用狀態 -->
        <?php $active=$pdo->query("select `active` from `form` limit 1")->fetchColumn();?>
        <div>
            表單啟用狀態：<button class="btn btn-primary my-3" id="form_status" onclick="form_status()" data-status="<?=$active;?>"><?=$active==1?"開啟中":"關閉中";?></button>
        </div>
        <div>
            <!-- 取得接駁車人數 -->
            <?php $number=$pdo->query("select `number` from `number` limit 1")->fetchColumn();?>
            接駁車人數：<input type="number" name="number" id="number" value="<?=$number;?>" style='width:50px'>
            <button class='btn btn-primary btn-sm' onclick="updateNumber()">更新</button>
        </div>
        <div>
            <!-- 取得預計接駁車數量 -->
            <?php  $busNum=$pdo->query("select ceil(count(*)/$number) from `survey` ")->fetchColumn();?>
            預計接駁車數量：<button class="btn btn-success font-weight-border"><?=$busNum;?></button>
            <button class="btn btn-info ml-3" onclick="allocateBus()">分配接駁車</button>
        </div>
    </div>
    <h2 class="text-center border-bottom pb-2 mt-2">參與者清單</h2>
    <!-- 參與者清單區塊，使用overflow屬性來建立一個有高度限制的區域放置參與者清單-->
    <div id="users" class=" d-flex align-items-start align-content-start flex-wrap w-100" style='overflow:auto;height:25rem'>
            
    </div>

    <h2 class="text-center border-bottom pb-2 mt-2">意願調查結果</h2>
    <!-- 意願調查結果區塊 -->
    <div id="surveys" class="d-flex align-items-start align-content-start flex-wrap w-100" style='overflow:auto;height:25rem'>

    </div>

    <h2 class="text-center border-bottom pb-2 mt-2">接駁車分派結果</h2>
    <!-- 意願調查結果區塊 -->
    <div id="busses" class="d-flex align-items-start align-content-start flex-wrap w-100" style='overflow:auto;height:25rem'>
        <h3 class="text-center w-100">尚未分派接駁車</h3>
    </div>
</div>

<script>
//在頁面載入時，呼叫一次get_participants()，取得參與者清單
get_participants();

//在頁面載入時，呼叫一次get_surveys()，取得意願調查結果
get_surveys()

//在頁面載入時，呼叫一次get_result()，用來查看接駁車分派的結果
get_result()

//建立一個function get_participants()，用來透過api的json資料取得參與者清單
function get_participants(){
    //呼叫api/participants.php，取得參與者清單
    $.get("./participants.php",function(users){
        //若參與者清單為空，則不做任何動作
        if(users.length==0){
            $("#users").html("<h3 class='text-center w-100'>尚無參與者</h3>")
            return;
        }
        //清空參與者清單區塊內容
        $("#users").empty();
        //將參與者清單逐一顯示在畫面上
        users.forEach(user => {
            
            $("#users").append(`
            <div class="border d-flex justify-content-between align-items-center p-2 col-4">
                <div>
                    ${user.email}
                </div>
                <div>
                    <button class="btn btn-warning btn-sm" onclick="edit('users',${user.id})">編輯</button>
                    <button class="btn btn-danger btn-sm" onclick="del('users',${user.id})">刪除</button>
                </div>
            </div>
            `)
        });
    })
}

//建立一個function get_surveys()，用來透過api的json資料取得意願調查結果
function get_surveys(){
    $.get("./api/get_surveys.php",function(results){
        //如果目前沒有任何人回覆意見調查，則顯示尚無回覆的提示文字
        if(results.length==0){
            $("#surveys").html("<h3 class='text-center w-100'>目前尚無意願調查結果</h3>")
            return;
        }

        //清空區塊內容
        $("#surveys").empty();

        //將有回覆意見調查的參與者顯示在區塊內
        results.forEach(result => {
            $("#surveys").append(`
            <div class="border d-flex justify-content-between align-items-center p-2 col-4">
                <div>
                    ${result.email}
                </div>
                <div>
                    <button class="btn btn-warning btn-sm" onclick="edit('survey',${result.id})">編輯</button>
                    <button class="btn btn-danger btn-sm" onclick="del('survey',${result.id})">刪除</button>
                </div>
            </div>
            `)
        });
    })
}

//建立一個function get_result()，用來取得接駁車分派的結果
function get_result(){
    $.get("result.php",(busses)=>{
        console.log(busses)
        if(busses.length==0){
            $("#busses").html("<h3 class='text-center w-100'>尚未分派接駁車</h3>")
            return;
        }
        
        //清空區塊內容
        $("#busses").empty();

        //將有回覆意見調查的參與者顯示在區塊內
        busses.forEach(bus => {
            let users=''
            bus.participants.forEach(part=>{
                users+=`<div class='d-flex justify-content-between col-6 p-2 rounded border'>
                            <div>${part.name}</div>
                            <div>${part.email}</div>
                        </div>`
            })
            $("#busses").append(`
            <div class="border p-2 col-6">
                <div class='border-bottom pb-2 mb-2 font-weight-bolder'>
                    ${bus.bus}
                </div>
                <div class='d-flex flex-wrap'>
                    ${users}
                </div>
            </div>
            `)
        });
    })
}

//建立一個function form_status()，用來控制表單的啟用狀態
function form_status(){
    let status=$("#form_status").data("status");
    $.post("api/form_status.php",{status},function(){
        //$("#form_status").data("status",status==1?0:1);
        //$("#form_status").text(status==1?"關閉中":"開啟中");
        load('admin_form.php');
        setActive('AdminForm')
    })
}
function allocateBus(){
    $.get("./api/allocate_bus.php",()=>{
        alert("接駁車分配完畢")
        load('admin_form.php');
        setActive('AdminForm')
    })
}
function updateNumber(){
    $.post("./api/update_number.php",{number:$("#number").val()},()=>{
        alert("接駁車人數已更新");
        load('admin_form.php');
        setActive('AdminForm')
    })
}
</script>