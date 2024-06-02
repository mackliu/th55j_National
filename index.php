<?php include_once "./api/db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南港展覽館接駁專車-路網圖</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
/*
 * 建立一個站點的基本外框
 */
.block{
    width:300px;
    height:200px;
    /* border:1px solid #ccc; */
    display: flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    position:relative;
}

.block-top,.block-bottom{
    height:calc( ( 100% - 25px ) / 2); /* */
    display:flex;
    text-align: center;
    padding:5px 0;
}
.block-top{
    align-items:flex-end;
}

/**建立站點的外型圓點 */
.point{
    width:25px;
    height:25px;
    border-radius:50%;
    background-color:skyblue;
    display: flex;
    justify-content:center;
    align-items:center;
    position:relative;
    z-index:10;
}

/**使用::before特性來建立圓點中的白圈 */
.point::before{
    content:"";
    width:20px;
    height:20px;
    border:3px solid white;
    border-radius:50%;
}

/**設定畫直線三個class的共同設定
 * 包含背景顏色及定位方式
 */
.right::after,
.left::after,
.line::after{
    content:"";
    background-color:skyblue;
    position:absolute;
}

/**建立一個只畫右邊直線的class */
.right::after{
    width:50%;
    height:8px;
    right:0;
}

/**建立一個只畫左邊直線的class */
.left::after{
    width:50%;
    height:8px;
    left:0;
}

/**建立一個畫左右直線的class */
.line::after{
    width:100%;
    height:8px;
    left:0;
}

/**建立一個畫垂直線的class */
.connect{
    width:8px;
    height:200px;
    background:skyblue;
    top:50%;
}

/**建立一個讓直線靠右邊放置的class */
.connect-right{
    position:absolute;
    right:0;
}

/**建立一個讓直線靠左邊放置的class */
.connect-left{
    position:absolute;
    left:0;
}

/**
 * 彈出視窗: 
 * 預設不顯示，滑鼠移進站點時才顯示
 * 背景設為白色用來遮住底層的資訊,營造彈出視窗在上層的感覺
 * position:absolute為絕對定位，位置為.block中的位置
 * z-index:垂直位置，
 */
.block .bus-info{
    display:none;
    position:absolute;
    top:1px;
    padding:8px;
    background:white;
    box-shadow:2px 2px 10px #999;
    z-index:100;
    border-radius:5px;

}

/**已到站的文字以紅色顯示 */
.arrive{
    color:red;
}

/**未發車的文字以灰色顯示 */
.nobus{
    color:#666;
}

/**站點數量按鈕，做成圓形的 */
.station-num{
    width:25px;
    height:25px;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    border:1px solid #555;
    border-radius:50%;
    margin:5px;
    cursor: pointer;
}

/**使用在站點數量切換上，當前的站點數量會以背景藍，字白的方式呈現 */
.active{
    background:blue;
    color:white;
    font-weight:bold;
}
</style>
</head>
<body>
<?php include "header.php";?>
<div class="container mt-5">

<!--路網圖區塊-->
<div class="d-flex flex-wrap my-4 mx-auto shadow p-5" style='width:min-content' id="map">

</div>
</div>
<script src="./js/jquery.js"></script>
<script src="./js/bootstrap.js"></script>
<script>
let size=3;

getStations()

/**
 * 取得所有站點的資料
 */
function getStations(){
    $.get("./api/get_stations.php",(res)=>{
        //console.log(res)
        let row=0;
        let stations=JSON.parse(res)
       //console.log(stations)
        let map='';
        stations.forEach((station,idx)=>{

            if(idx%size==0){
                if(row%2==1){
                    map+=`<div class='d-flex w-100 position-relative flex-row-reverse'>`
                }else{
                    map+=`<div class='d-flex w-100 position-relative'>`

                }
            }
            map+=`<div class='block line'>
                     <div class='block-top'>`
            if(station.time=='未發車'){
                map+=`<span class='text-secondary'>${station.closest_bus}<br>${station.time}</span>`
            }else if(station.time=='已到站'){
                map+=`<span class='text-danger'>${station.closest_bus}<br>${station.time}</span>`
            }else{

                map+=`${station.closest_bus}<br>${station.time}`
            }
            map+=`</div>
                     <div class='point'></div>
                     <div class='block-bottom'>${station.name}</div>
                   </div>`
            
            if(idx%size==size-1){
                map+=`</div>`
                row++;
            }

        })
        $("#map").html(map)
    })
}
</script>
</body>
</html>