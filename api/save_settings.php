<?php include_once "db.php";

//更新表單設定
$result=q("update `form_settings` set `enabled`='{$_POST['enabled']}',
                              `start_at`='{$_POST['start_at']}',
                              `end_at`='{$_POST['end_at']}' 
                        where `id`=1");

