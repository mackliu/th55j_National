<?php include_once "db.php";

q("delete from survey_response where id='{$_POST['id']}'");
