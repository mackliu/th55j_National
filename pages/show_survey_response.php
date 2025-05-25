<?php include_once "../api/db.php";?>

<h3>檢視回應</h3>
    <table id="response-table" class="table table-bolded">
        <tr>
            <th width="5%" class="bg-info text-white">#</th>
            <th class="bg-info text-white">名字</th>
            <th class="bg-info text-white">信箱</th>
            <th class="bg-info text-white">路線</th>
            <th class="bg-info text-white">寶貴意見</th>
            <th width="10%" class="bg-info text-white">操作</th>
        </tr>
        <?php 
            //$users=q("select * from survey_response");
            $users=q("SELECT `survey_response`.*,`route`.`name` as 'route' 
                        FROM `route`,`survey_response` 
                        WHERE `survey_response`.`route_id`=`route`.`id`");
            foreach($users as $idx => $user){
        ?>
        <tr>
            <td><?=$idx+1;?></td>
            <td class="response-name"><?=$user['name'];?></td>
            <td class="response-email"><?=$user['email'];?></td>
            <td class="response-route"><?=$user['route'];?></td>
            <td class="response-noet"><?=$user['note'];?></td>
            <td>
                <button class='btn btn-danger delete-button' data-email='<?=$user['email'];?>' data-id="<?=$user['id'];?>">刪除</button>
            </td>
        </tr>
        <?php 

        }
        ?>
    </table>