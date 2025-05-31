<?php include_once "db.php";

// 刪除指定的問卷回應
q("delete from survey_response where id='{$_POST['id']}'");