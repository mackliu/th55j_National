
<div class="list">
    <h1 class="border p-3 text-center my-3">表單管理 
        <button class="btn btn-success" onclick="load('add_user.php')">新增參與者email</button>
    </h1>
    <div class='d-flex justify-content-between align-items-top p-2'>
      <div id="form-sidebar" class="col-2 border-right">
        <div id="basic-setting-link" class="link-btn m-1 text-center px-3 py-2 bg-light border">基本設定</div>
        <div id="responses-setting-link" class="link-btn m-1 text-center px-3 py-2 border">檢視回應</div>
        <div id="stastic-seeting-link" class="link-btn m-1 text-center px-3 py-2 border">統計資料</div>
      </div>
      <div id="form-page" class="col-10">
        <div class='block' id="basic">
            <h3>基本設定</h3>
            <div class="d-flex">
                <span>啟用表單</span>
                <div class="custom-control custom-switch mx-1">
                    <?php 
                        $chkactive=q("select * from form_settings where id=1")[0];
                    ?>
                    <input type="checkbox" name="enable" class="custom-control-input" id="active-form" <?=($chkactive['enabled']==1)?'checked':'';?>>
                    <label class="custom-control-label" for="active-form">啟用</label>
                </div>
            </div>
            <label for="">起始時間</label>
            <input type="datetime-local" name="start-at" id="start-at" class="form-control" value="<?=$chkactive['start_at'];?>">
            <label for="">結束時間</label>
            <input type="datetime-local" name="end-at" id="end-at" class="form-control" value="<?=$chkactive['end_at'];?>">
            <button class="w-100 btn btn-primary m-2" id="save-button" onclick="save()">儲存</button>
        </div>
        <div class='block' id="responses" style="display:none">
            <h3>檢視回應</h3>
            <table id="response-table" class="table table-bolded">
                <tr>
                    <th width="10%" class="bg-info text-white">#</th>
                    <th class="bg-info text-white">名字</th>
                    <th class="bg-info text-white">信箱</th>
                    <th class="bg-info text-white">路線</th>
                    <th class="bg-info text-white">寶貴意見</th>
                    <th class="bg-info text-white">操作</th>
                </tr>
            </table>
        </div>
        <div class='block' id="stastic" style="display:none">
            <h3>統計資料</h3>
            <a href="#" class="btn btn-primary">匯出</a>
        </div>
      </div>      
    </div>
</div>

<script>
$(".link-btn").on("click",function(){
    let target=$(this).attr('id').split("-")[0]
    $(".block").hide();
    $(`#${target}`).show();
})

function save(){
    let data={
        start_at:$("#start-at").val(),
        end_at:$("#end-at").val(),        
    }

    if($("#active-form").prop('checked')){
        data.enabled=1;
    }else{
        data.enabled=0;
    }

console.log(data)
    $.post("./api/save_settings.php",data,(res)=>{
        console.log(res)
        alert("儲存成功")
    })
}
</script>