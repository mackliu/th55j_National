<?php include_once "../api/db.php";?>
<div class="list">
    <h1 class="border p-3 text-center my-3">表單管理 
        <button class="btn btn-success" onclick="load('add_user.php')">新增參與者email</button>
    </h1>
    <div class='d-flex justify-content-between align-items-top p-2'>
      <div id="form-sidebar" class="col-2 border-right">
        <div id="basic-setting-link" class="m-1 text-center px-3 py-2 bg-light border">基本設定</div>
        <div id="responses-setting-link" class="m-1 text-center px-3 py-2 border">檢視回應</div>
        <div id="stastic-seeting-link" class="m-1 text-center px-3 py-2 border">統計資料</div>
      </div>
      <div id="form-page" class="col-10">
        <div>
            <h3>基本設定</h3>
            <div class="d-flex">
                <span>啟用表單</span>
                <div class="custom-control custom-switch mx-1">
                    <input type="checkbox" name="enable" class="custom-control-input" id="active-form" checked>
                    <label class="custom-control-label" for="active-form">啟用</label>
                </div>
            </div>
            <label for="">起始時間</label>
            <input type="datetime-local" name="start-at" id="start-at" class="form-control">
            <label for="">結束時間</label>
            <input type="datetime-local" name="end-at" id="end-at" class="form-control">

            
            <button class="w-100 btn btn-primary m-2" id="save-button">儲存</button>
        </div>
        <div>
            <h3>檢視回應</h3>
        </div>
        <div>
            <h3>統計資料</h3>
        </div>
      </div>      
        
     


    </div>
</div>

<script>

</script>