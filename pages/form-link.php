<?php include_once "../api/db.php";?>
<div class="list">
    <h1 class="border p-3 text-center my-3">表單管理 
        <button class="btn btn-success" onclick="load('add_user.php')">新增參與者email</button>
    </h1>
    <div class='d-flex justify-content-between align-items-top p-2'>
      <div id="form-sidebar" class="col-2 border-right">
        <div id="basic-setting-link" class="link-btn m-1 text-center px-3 py-2 bg-light border">基本設定</div>
        <div id="responses-setting-link" class="link-btn m-1 text-center px-3 py-2 border">
            檢視回應
            <div class="badge badge-primary p-1">
                <?=q("select count(*) as 'sum' from survey_response")[0]['sum'];?>
            </div>
        </div>
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

        </div>
        <div class='block' id="stastic" style="display:none">
            <h3>統計資料</h3>
            <?php
                $result=q("SELECT `route`.`name` as 'route',
                                 count(*) as 'amount' 
                            FROM `survey_response`,`route` 
                           WHERE `survey_response`.`route_id`=`route`.`id` 
                        GROUP BY `route_id`");
                $filename='export.json';
                /* csv匯出
                $filename='export.csv';
                $file=fopen($filename,'w');
                fwrite($file, "\xEF\xBB\xBF");
                fputcsv($file,['Route','Amount']);
                foreach($result as $row){
                    fputcsv($file,$row);
                    fclose($file)
                } */
               //json匯出
                $jsondata=json_encode($result,JSON_UNESCAPED_UNICODE);
                file_put_contents($filename,$jsondata)

            ?>
            <table class="table table-bordered">
                <tr>
                    <th>路線</th>
                    <th>人數</th>
                </tr>
                <?php
                    foreach($result as $row){
                        echo "<tr>";
                        echo "<td>{$row['route']}</td>";
                        echo "<td>{$row['amount']}</td>";
                        echo "</tr>";
                ?>

                <?php
                    }
                ?>
            </table>
            <a href="<?=$filename;?>" class="btn btn-primary" download>匯出</a>            
        </div>
      </div>
    </div>
</div>

<script>
$(".link-btn").on("click",function(){
    let target=$(this).attr('id').split("-")[0]
    $(".block").hide();
    switch(target){
        case 'responses':
            //location.reload()
            //以ajax載入檢視回應
            loadResponse()
            $(`#${target}`).show();
        break;
        default:
            $(`#${target}`).show();

    }
})

function loadResponse(){
    $("#responses").load("./pages/show_survey_response.php",()=>{
        //載入檢視回應後註冊刪除按鈕事件
            $(".delete-button").on("click",function(){
                let id=$(this).data('id');
                //let email=$(this).data('email');
                $.post("./api/delete_response.php",{id},()=>{
                loadResponse();      
            })
        })        
    })
}

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

    //console.log(data)
    $.post("./api/save_settings.php",data,(res)=>{
        //console.log(res)
        alert("儲存成功")
    })
}
</script>