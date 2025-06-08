
* 分支main的新增路線為前端技術為主，以左右兩視窗點選交換來決定該路線分配的站點
* 分支page和route的新增路線採用checkbox的方式，以點選與否來決定該路線分配的站點
* 分支page的頁面切換採用include的方式
* 分支route的頁面切換採js函式


## 後台製作順序
1. 站點管理 - 需先有站點資料，後續的路線及車輛管理才有依據
2. 路線管理 - 需先有兩個以上站點才能建立路線
3. 車輛管理 - 需先有路線資料才能新增車輛
4. 表單管理 - 需先有路線資料才能新增調查表單
 
## api呼叫關係

### 前台頁面

### index.php
* ./api/get_routes.php - 用來取得目前系統中的路線資料並顯示在路線下拉選單中
* ./api/get_route_stations.php - 用來取得該路線的所有站點，需傳入該路線的id
* ./api/get_bus.php - 用來取得hover站點的公車資訊，需傳入路線id及站點id

### form.php
* ./api/get_routes.php - 使用ajax取得路線下拉選單資料.
* ./api/feeback.php - 使用者送出填寫資料後，檢查表單狀態並回應提示給使用者，如果都符合，則儲存表單資料到資料表中。

### login.php
* ./api/reset_code.php - 重整驗證碼

### header.php
* ./api/logout.php - 登出用

### 後台頁面
### station-link.php
* ./api/get_stations.php - 取得所有站點資料,用來產生站點列表
* ./api/del.php - 用來刪除指定table的資料,需傳入table名稱及資料id

### bus-link.php
* ./api/get_bus_list.php - 取得所有公車資料,用來產生公車列表
* ./api/del.php - 用來刪除指定table的資料,需傳入table名稱及資料id

### route-link.php

* ./api/get_routes.php -  用來取得目前系統中的路線資料並顯示在路線列表中
* ./api/del.php - 刪除table的資料，需傳入table名及資料id

### form-link.php
* ./pages/show_survey_response.php - 用來載入使用者填寫調查表的結果頁面
* ./api/delete_response.php - 用來刪除調查回應用,需傳入id
* ./api/save_settings.php - 儲存表單時間的設定

### 後台子功能頁面
### ./pages/add_station.php
* ./api/add_station.php - 將輸入的站點傳到資料表儲存

### ./pages/edit_station.php
* ./api/edit_station.php - 用來更新站點資料,需傳入車輛id,及要更新的站點名稱(name)


### ./pages/add_route.php
* ./api/get_stations.php - 取得目前所有可選的站點資料
* ./api/add_route.php - 將路線設定新增至資料表中,包含選中的站點及站點的順序

### ./pages/edit_route.php
* ./api/edit_route.php - 用來更新路線資料,需要傳入路線id,及路線名稱及路線站點陣列
* ./api/get_route_stations.php - 取得該路線的所有站點資料,用來製作路線站點列表
* ./api/get_stations.php - 取得所有站點資料，但是如果有傳路線id的話,此api會篩選出該路線沒有的站點,用來製作待選站點列表.


### ./pages/add_bus.php
* ./api/get_routes.php - 取得所有的路線資料,用來產生路線下拉選單
* ./api/add_bus.php - 將輸入的車輛資料新增至資料表中,需傳入車牌資料、行駛時間及路線id

### ./pages/edit_bus.php
* ./api/edit_bus.php - 用來更新車輛資料,需傳入車輛id及要更新的車輛行駛時間
