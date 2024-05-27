<?php
include_once "db.php";

//啟用session，並使用rand()函式產生四位數驗證碼
echo $_SESSION['code']=rand(1000,9999);

?>