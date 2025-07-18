# 最佳路徑查詢功能開發文件

## 功能概述

在公車路線查詢系統中新增最佳路徑查詢功能，使用者可以選擇出發站和目的站，系統會計算出經過站點最少、行駛時間最短的路徑組合，並提供直達或轉乘建議。

## 開發步驟

### 1. 分析現有資料庫結構
- 研究 `route`、`station`、`route_station` 表的關係
- 理解路線和站點的關聯方式
- 確認時間計算所需的欄位（`arriving_time`、`staying_time`）

### 2. 創建後端API
- 利用現有的 `api/get_stations.php` 獲取所有站點資料
- 新建 `api/find_best_route.php` 處理路徑計算邏輯

### 3. 前端UI開發
- 在首頁新增出發站和目的站下拉選單
- 新增「最佳路線」查詢按鈕
- 新增路徑查詢結果顯示區域

### 4. 前端功能實現
- 載入所有站點到下拉選單
- 實現路徑查詢的AJAX請求
- 結果顯示和錯誤處理

### 5. 測試和優化
- 測試各種路徑組合
- 優化UI顯示效果
- 調整CSS樣式（移除過窄的width限制）

## 開發思路

### 核心概念
1. **直達路線**：同一條路線上的兩個站點，無需轉乘
2. **轉乘路線**：需要在中間站點換乘其他路線
3. **最佳化標準**：
   - 優先考慮經過站點數量最少
   - 其次考慮總行駛時間最短

### 演算法邏輯
1. **輸入驗證**：檢查出發站和目的站是否有效且不相同
2. **直達路線搜尋**：查找包含兩個站點的路線
3. **轉乘路線搜尋**：查找需要轉乘的路線組合
4. **結果排序**：依據站點數量和時間進行排序
5. **返回最佳方案**：選擇最優的路徑組合

## 重點演算法

### 直達路線查詢演算法
```php
function findDirectRoutes($start_station_id, $end_station_id) {
    // 查找同時包含出發站和目的站的路線
    // 確保出發站在目的站之前（seq順序）
    // 計算經過的站點數量和行駛時間
    return $routes;
}
```

### 轉乘路線查詢演算法
```php
function findTransferRoutes($start_station_id, $end_station_id) {
    // 查找轉乘點（同時服務於兩條不同路線的站點）
    // 計算第一段路線（出發站到轉乘站）
    // 計算第二段路線（轉乘站到目的站）
    // 加入轉乘等待時間
    return $routes;
}
```

### 路徑優化演算法
```php
// 排序邏輯：站點數量優先，時間次之
usort($all_routes, function($a, $b) {
    $station_diff = $a['total_stations'] - $b['total_stations'];
    if ($station_diff != 0) {
        return $station_diff;
    }
    return $a['total_time'] - $b['total_time'];
});
```

## 核心SQL語法

### 1. 直達路線查詢
```sql
SELECT r.id as route_id, r.name as route_name,
       rs1.seq as start_seq, rs1.arriving_time as start_time,
       rs2.seq as end_seq, rs2.arriving_time as end_time,
       rs1.staying_time as start_staying_time,
       rs2.staying_time as end_staying_time
FROM route r
JOIN route_station rs1 ON r.id = rs1.route_id AND rs1.station_id = $start_station_id
JOIN route_station rs2 ON r.id = rs2.route_id AND rs2.station_id = $end_station_id
WHERE rs1.seq < rs2.seq
```

### 2. 轉乘路線查詢
```sql
SELECT DISTINCT 
    r1.id as route1_id, r1.name as route1_name,
    r2.id as route2_id, r2.name as route2_name,
    rs_transfer.station_id as transfer_station_id,
    s_transfer.name as transfer_station_name,
    rs1.seq as start_seq, rs1.arriving_time as start_time, rs1.staying_time as start_staying_time,
    rs_transfer1.seq as transfer_seq1, rs_transfer1.arriving_time as transfer_time1,
    rs_transfer2.seq as transfer_seq2, rs_transfer2.arriving_time as transfer_time2, rs_transfer2.staying_time as transfer_staying_time,
    rs2.seq as end_seq, rs2.arriving_time as end_time
FROM route r1
JOIN route_station rs1 ON r1.id = rs1.route_id AND rs1.station_id = $start_station_id
JOIN route_station rs_transfer1 ON r1.id = rs_transfer1.route_id
JOIN route_station rs_transfer ON rs_transfer1.station_id = rs_transfer.station_id
JOIN route_station rs_transfer2 ON rs_transfer.station_id = rs_transfer2.station_id
JOIN route r2 ON rs_transfer2.route_id = r2.id AND r2.id != r1.id
JOIN route_station rs2 ON r2.id = rs2.route_id AND rs2.station_id = $end_station_id
JOIN station s_transfer ON rs_transfer.station_id = s_transfer.id
WHERE rs1.seq < rs_transfer1.seq 
AND rs_transfer2.seq < rs2.seq
LIMIT 5
```

### 3. 取得所有站點
```sql
SELECT * FROM station
```

## 時間計算邏輯

### 直達路線時間計算
```php
$travel_time = $route['end_time'] - $route['start_time'] + $route['start_staying_time'];
```

### 轉乘路線時間計算
```php
$first_leg_time = $route['transfer_time1'] - $route['start_time'] + $route['start_staying_time'];
$second_leg_time = $route['end_time'] - $route['transfer_time2'] + $route['transfer_staying_time'];
$total_time = $first_leg_time + $second_leg_time + 3; // 轉乘等待時間3分鐘
```

## 前端實現重點

### 1. 動態載入站點
```javascript
function loadAllStations() {
    $.get("./api/get_stations.php", (stations) => {
        stations.forEach(station => {
            const option = `<option value="${station.id}">${station.name}</option>`;
            $("#start-station-select").append(option);
            $("#end-station-select").append(option);
        });
    });
}
```

### 2. 路徑查詢AJAX
```javascript
function findBestRoute() {
    $.get("./api/find_best_route.php", {
        start_station_id: startStationId,
        end_station_id: endStationId
    }, (result) => {
        if (result.error) {
            // 顯示錯誤訊息
        } else {
            displayRouteResult(result);
        }
    });
}
```

### 3. 結果顯示
```javascript
function displayRouteResult(result) {
    // 根據路線類型（直達/轉乘）顯示不同的結果格式
    // 包含總站數、預估時間、路線詳情
}
```

## 檔案結構

```
/api/
  ├── find_best_route.php    # 新增：最佳路徑計算API
  └── get_stations.php       # 現有：取得所有站點API

/index.php                   # 修改：新增路徑查詢UI和功能
```

## 使用說明

1. 在首頁選擇出發站和目的站
2. 點擊「最佳路線」按鈕
3. 系統會顯示推薦的路線方案
4. 包含直達路線或轉乘路線的詳細資訊

## 擴展性考慮

- 可以加入更多轉乘層級（目前支持一次轉乘）
- 可以考慮班次頻率和等車時間
- 可以加入票價計算
- 可以支持多個目的站的路徑規劃