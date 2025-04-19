<?php include_once "./api/db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Transit Query System 大眾運輸查詢系統</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
#route-map{
    width:768px;
    background-color:white;
    position:relative;
}

/*
 * 建立一個站點的基本外框
 */
.station{
    width:300px;
    height:200px;
    /* border:1px solid #ccc; */
    display: flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    position:relative;
    z-index:9;
}

/*
 * 建立站點的上下區塊
 */
.station-status,.station-name{
    height:calc( ( 100% - 25px ) / 2); 
    display:flex;
    text-align: center;
    padding:5px 0;
    position:relative;
    z-index:10;
}

/*
 * 設定站點的上方的區塊為向下對齊
 */
.station-status{
    align-items:flex-end;
}

/**建立站點的外型圓點 */
.station-point{
    width:25px;
    height:25px;
    border-radius:50%;
    background-color:#22d3ee;
    display: flex;
    justify-content:center;
    align-items:center;
    position:relative;
    z-index:10;
}

/**使用::before特性來建立圓點中的白圈 */
.station-point::before{
    content:"";
    width:20px;
    height:20px;
    border:3px solid white;
    border-radius:50%;
    position:relative;
}

/**
 * 彈出視窗: 
 * 預設不顯示，滑鼠移進站點時才顯示
 * 背景設為白色用來遮住底層的資訊,營造彈出視窗在上層的感覺
 * position:absolute為絕對定位，位置為.block中的位置
 * z-index:垂直位置，
 */
.station .bus-info{
    display:none;
    position:absolute;
    top:1px;
    padding:8px;
    background:white;
    box-shadow:2px 2px 10px #999;
    z-index:100;
    border-radius:5px;

}
.station .bus-list{
    min-width:100px;
    padding:10px;
    border:1px solid #ccc;
    position:absolute;
    top:120px;
    background-color: #fff;
    box-shadow:0 0 10px #ccc;
    z-index:99;
    border-radius:10px 0 10px 0;
}
/**已到站的文字以紅色顯示 */
.arrive{
    color:red;
}

/**未發車的文字以灰色顯示 */
.nobus{
    color:#666;
}


</style>
</head>
<body>
<?php include "header.php";?>
<div class="container mt-5">

<!--路網圖區塊-->
<div class="d-flex flex-wrap my-4 mx-auto shadow p-5" style='width:min-content' id="route-map">

</div>
</div>
<script src="./js/jquery.js"></script>
<script src="./js/bootstrap.js"></script>
<script>

//設定每一列的站點數量
let PointsPerRow=3;

//畫面載入時執行getStations來取得所有站點資料
getStations()


/**
 * 取得所有站點的資料
 */
function getStations(){
    //使用ajax來取得所有站點資料
    $.get("./api/get_stations.php",(stations)=>{
        console.log(stations)
        //建立一個變數來計算目前列數
        let row=0;

        //計算總共有幾列
        let totalRows=Math.floor(stations.length/PointsPerRow);

        //建立一個變數map來儲存路網圖的HTML內容
        let map='';

        //使用迴圈來逐一取得站點資料
        stations.forEach((station,idx)=>{

            //建立一個變數來判斷是否要反轉站點的排列方式，預設為空值
            let reverse='';
            
            //使用餘數來判斷是否為每一列的第一個站點
            if(idx%PointsPerRow==0){

                //判斷是否為奇數列，如果是奇數列則反轉站點排列方式
                if(row%2==1){

                    //加入反轉站點排列方式的class
                    reverse='flex-row-reverse';
                }

                //將變數reverse加入到map變數中
                map+=`<div class='d-flex w-100 position-relative ${reverse}'>`
            }
            //將連線的型態加入到map變數中，同時根據api建立的站點資料來設定站點的顏色及文字
            map+=`<div class='station'>
                     <div class='station-status ${station.status}'>
                        ${station.closest_bus}<br>
                        ${station.time}
                     </div>
                     <div class='station-point' data-id="${station.id}"></div>
                     <div class='station-name'>${station.name}</div>
                   </div>`
            
            //如果是每一列的最後一個站點，則加入</div>來結束這一列
            if(idx%PointsPerRow==PointsPerRow-1){
                map+=`</div>`

                //列數加1
                row++;
            }
        })

        //將map變數的內容加入到id為map的HTML元素中
        $("#route-map").html(map)

        //將路網圖的SVG加入到id為route-map的HTML元素中
        //使用position:absolute來讓SVG圖形可以覆蓋在路網圖上
        $("#route-map").append(`
            <svg class="route-svg" height="100%" width="100%" style="position:absolute;top:0;left:0;z-index:1">
            <path id="route-path" stroke="#22d3ee" stroke-width="8" fill="none" d="" />
    </svg>
        `)
        drawPath() //呼叫畫路徑的函式來畫出路徑


        //在路網圖載入完成後，對路網圖中的站點進行hover事件的設定
        $(".station-point").hover(
            //滑鼠移進站點時，取得站點的id，並使用ajax來取得公車資訊
            function (){

                //取得站點id
                let stationId=$(this).data('id')
                let busInfo=''  //建立一個變數來儲存公車資訊
                $.get("./api/get_bus.php",{stationId},(busList)=>{

                    if(busList!='-1'){ //如果有公車資訊，則將資訊加入到busInfo變數中
                        $(this).after(`<div class='bus-list'>${busList}</div>`)
                    }
                })
            },
            //滑鼠移出站點時，將公車資訊的div移除
            function(){
                $(".station .bus-list").remove()
            }
            )
    })
}

function drawPath(){
    //取得所有的站點
    let points=$(".station-point")

    //取得單一站點區塊的寬高
    let stationWidth=$(".station").width()
    let stationHeight=$(".station").height()

    //取得路網圖的區塊資訊(包含位置及大小)
    routeMapRect=$("#route-map").get(0).getBoundingClientRect()

    //建立一個變數來儲存路徑的字串
    let path='M'
    
    //使用迴圈來逐一取得每一個站點的座標
    points.each(function(idx,point){
        /**
         * 判斷需要計算座標的站點
         * 起點
         * 終點
         * 每一列的最後一個站點(判斷轉彎點)
         */
        let rect=$(point).get(0).getBoundingClientRect()
        let x,y,x1,y1
        if(idx==0){
            //如果是第一個站點，計算圓點中心的x,y座標點
            x=rect.left + rect.width / 2 - routeMapRect.left
            y=rect.top + rect.height / 2 - routeMapRect.top
            path+=` ${x} ${y}`
        }else if(idx==points.length-1){
            //如果是最後一個站點，計算圓點中心的x,y座標點
            x=rect.left + rect.width / 2 - routeMapRect.left
            y=rect.top + rect.height / 2 - routeMapRect.top
            path+=`L ${x} ${y} `
        }else if(idx%PointsPerRow==PointsPerRow-1){
            //如果是每一列的最後一個站點

            if((Math.floor(idx/PointsPerRow))%2==0){
                //如果是偶數列(包含第0列)，則計算出向右延伸一半寬度的x座標點
                x=rect.left + rect.width / 2 - routeMapRect.left + stationWidth/2
            }else{
                //如果是奇數列，則計算出向左延伸一半寬度的x座標點
                x=rect.left + rect.width / 2 - routeMapRect.left - stationWidth/2
            }
                y=rect.top + rect.height / 2 - routeMapRect.top //計算y座標點
                x1=x  //計算向下延伸的x座標點
                y1=rect.top + rect.height / 2 - routeMapRect.top + stationHeight //計算下一行的y座標點

                //將直角轉彎的兩個座標點加入到路徑字串中
                path+=`L ${x} ${y} L ${x1} ${y1} `
        }        

    })
    //將路徑字串加入到SVG的path中
    $("#route-path").attr("d",path)
}
</script>
</body>
</html>