<header class="shadow-sm p-3 d-flex w-100" style="height:100px">
<div class="col-6">
    <img src="" alt="" style="width:60px;height:60px;">
   <a href="index.php">Public Transit Query System 大眾運輸查詢系統</a>
</div>
<div class="col-6 row align-items-center justify-content-end">
    <a href="admin.php" class="mx-2">系統管理</a>
    <?php
    if(isset($_SESSION['login'])){
        echo "<a href='./api/logout.php'  class='mx-2' id='logout-button'>登出</a>";

    }

?>

</div>
</header>