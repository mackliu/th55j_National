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

/*
 * 建立站點的上下區塊
 */
.block-top,.block-bottom{
    height:calc( ( 100% - 25px ) / 2); 
    display:flex;
    text-align: center;
    padding:5px 0;
}

/*
 * 設定站點的上方的區塊為向下對齊
 */
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

//設定每一列的站點數量
let size=3;

//畫面載入時執行getStations來取得所有站點資料
getStations()

/**
 * 取得所有站點的資料
 */
function getStations(){
    //使用ajax來取得所有站點資料
    $.get("./api/get_stations.php",(res)=>{
        //建立一個變數來計算目前列數
        let row=0;

        //將取得的站點資料轉換為JSON格式
        let stations=JSON.parse(res)
        //計算總共有幾列
        let totalRows=Math.floor(stations.length/size);

        //建立一個變數map來儲存路網圖的HTML內容
        let map='';

        //使用迴圈來逐一取得站點資料
        stations.forEach((station,idx)=>{

            //建立一個變數來判斷是否要反轉站點的排列方式，預設為空值
            let reverse='';

            //建立一個變數來判斷是否要畫連接線及連接線的位置在左邊還是右邊，預設為空值
            let connect='';
            
            //使用餘數來判斷是否為每一列的第一個站點
            if(idx%size==0){

                //判斷是否為奇數列，如果是奇數列則反轉站點排列方式
                if(row%2==1){

                    //加入反轉站點排列方式的class
                    reverse='flex-row-reverse';

                    //如果是奇數列，而且還沒到最後一列，則連接線的位置在左邊
                    connect=(row<totalRows)?'connect connect-left':'';
                }else{

                    //如果是偶數列，而且還沒到最後一列，則連接線的位置在右邊
                    connect=(row<totalRows)?'connect connect-right':'';
                }

                //將變數reverse及connect加入到map變數中
                map+=`<div class='d-flex w-100 position-relative ${reverse}'>
                        <div class='${connect}'></div>
                        `
            }

            //建立一個變數line來判斷站點連線的型態，預設為line，表示左右都有連線
            let line='line';
            if(idx==0){
                //如果是第一個站點，也就是起始站，則只畫右邊的直線
                line='right';
            }else if(idx==stations.length-1){
                //如果是最後一個站點，則只畫左邊的直線
                line='left';
            }

            //將連線的型態加入到map變數中，同時根據api建立的站點資料來設定站點的顏色及文字
            map+=`<div class='block ${line}'>
                     <div class='block-top ${station.status}'>
                        ${station.closest_bus}<br>
                        ${station.time}
                     </div>
                     <div class='point'></div>
                     <div class='block-bottom'>${station.name}</div>
                   </div>`
            
            //如果是每一列的最後一個站點，則加入</div>來結束這一列
            if(idx%size==size-1){
                map+=`</div>`

                //列數加1
                row++;
            }

        })

        //將map變數的內容加入到id為map的HTML元素中
        $("#map").html(map)
    })
}
</script>
</body>
</html>