<?php include_once "../api/db.php";?>
<div class="list">
    <h1 class="border p-3 text-center my-3">表單管理 
        <button class="btn btn-success" onclick="load('add_user.php')">新增參與者email</button>
    </h1>
    <div class='d-flex justify-content-between align-items-center p-2'>
            <!-- 取得表單啟用狀態 -->
        
        <div>
            表單啟用狀態：<button class="btn btn-primary my-3" id="form_status" onclick="" data-status=""></button>
        </div>
        <div>
            <!-- 取得接駁車人數 -->
            
            
        </div>
        <div>
            <!-- 取得預計接駁車數量 -->
            
            預計接駁車數量：<button class="btn btn-success font-weight-border"></button>
            <button class="btn btn-info ml-3" onclick="">分配接駁車</button>
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

</script>