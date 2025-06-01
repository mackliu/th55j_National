-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2025 年 06 月 01 日 01:51
-- 伺服器版本： 10.6.4-MariaDB
-- PHP 版本： 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `th55j_national`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pw` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `acc`, `pw`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- 資料表結構 `bus`
--

CREATE TABLE `bus` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `plate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `runtime` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `bus`
--

INSERT INTO `bus` (`id`, `route_id`, `plate`, `runtime`) VALUES
(1, 5, 'A1233', 13),
(2, 2, 'B3421', 20),
(3, 3, 'A4521', 18),
(4, 5, 'A6321', 8),
(5, 5, 'A2135', 17);

-- --------------------------------------------------------

--
-- 資料表結構 `form_settings`
--

CREATE TABLE `form_settings` (
  `id` int(1) UNSIGNED NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `start_at` datetime NOT NULL COMMENT '開始時間',
  `end_at` datetime NOT NULL COMMENT '結束時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `form_settings`
--

INSERT INTO `form_settings` (`id`, `enabled`, `start_at`, `end_at`) VALUES
(1, 1, '2025-05-25 11:15:00', '2025-05-25 14:30:00');

-- --------------------------------------------------------

--
-- 資料表結構 `route`
--

CREATE TABLE `route` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `route`
--

INSERT INTO `route` (`id`, `name`) VALUES
(2, '台北普通線'),
(3, '北區高速專線'),
(5, '新北特快直達');

-- --------------------------------------------------------

--
-- 資料表結構 `route_station`
--

CREATE TABLE `route_station` (
  `id` int(10) NOT NULL COMMENT 'id',
  `route_id` int(10) NOT NULL COMMENT '路線id',
  `station_id` int(10) NOT NULL COMMENT '站點id',
  `seq` int(10) NOT NULL COMMENT '順序',
  `arriving_time` int(10) NOT NULL COMMENT '行駛時間',
  `staying_time` int(10) NOT NULL COMMENT '停留時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `route_station`
--

INSERT INTO `route_station` (`id`, `route_id`, `station_id`, `seq`, `arriving_time`, `staying_time`) VALUES
(7, 2, 1, 1, 5, 2),
(9, 2, 3, 2, 9, 3),
(14, 3, 2, 1, 4, 2),
(16, 3, 6, 3, 5, 2),
(18, 3, 9, 5, 6, 3),
(25, 2, 17, 7, 10, 2),
(27, 2, 15, 6, 1, 1),
(28, 3, 15, 4, 1, 1),
(30, 3, 17, 5, 1, 1),
(31, 3, 16, 6, 1, 1),
(32, 5, 1, 1, 0, 4),
(33, 5, 6, 2, 4, 2),
(34, 5, 12, 3, 7, 3),
(35, 5, 15, 4, 8, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `station`
--

CREATE TABLE `station` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `station`
--

INSERT INTO `station` (`id`, `name`) VALUES
(1, '台北車站'),
(2, '台北醫院'),
(3, '中正紀念堂'),
(5, '大安森林公園'),
(6, '大安村'),
(7, '信義安和'),
(8, '台北101'),
(9, '蘆洲站'),
(10, '和平路口'),
(11, '蘆洲監理站(中正路)'),
(12, '蘆洲國小'),
(13, '中原公寓'),
(14, '空中大學'),
(15, '王爺廟口'),
(16, '民族路口'),
(17, '捷運蘆洲站');

-- --------------------------------------------------------

--
-- 資料表結構 `survey_response`
--

CREATE TABLE `survey_response` (
  `id` int(10) NOT NULL,
  `route_id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `survey_response`
--

INSERT INTO `survey_response` (`id`, `route_id`, `name`, `email`, `note`, `created_at`) VALUES
(1, 1, '王小明', 'xiaoming.wang32@example.com', '希望班次可以更密集', '2025-05-25 05:05:37'),
(2, 2, 'Emily Chen', 'emily.chen87@example.com', 'Very convenient, thank you!', '2025-05-25 05:05:37'),
(3, 3, '李大仁', 'daren.li21@example.com', NULL, '2025-05-25 05:05:37'),
(4, 1, 'John Smith', 'john.smith99@example.com', 'Can you add more morning buses?', '2025-05-25 05:05:37'),
(5, 2, '陳美麗', 'meili.chen45@example.com', '車子很乾淨，讚！', '2025-05-25 05:05:37'),
(6, 3, 'Sophia Liu', 'sophia.liu73@example.com', '', '2025-05-25 05:05:37'),
(7, 1, '林志強', 'zhiqiang.lin16@example.com', '時間稍微不準確，建議改善', '2025-05-25 05:05:37'),
(8, 2, 'Grace Wu', 'gracewu51@example.com', NULL, '2025-05-25 05:05:37'),
(9, 3, '張偉', 'zhangwei83@example.com', '方便又準時，會再搭乘', '2025-05-25 05:05:37'),
(10, 1, 'Kevin Lin', 'kevin.lin26@example.com', 'Great service overall!', '2025-05-25 05:05:37'),
(11, 2, '黃秋霞', 'qiuxia.huang99@example.com', '希望有夜間公車', '2025-05-25 05:05:37'),
(12, 3, 'Amy Wang', 'amy.wang34@example.com', '常常滿座，建議增加班次', '2025-05-25 05:05:37'),
(13, 1, '周玉婷', 'yuting.zhou11@example.com', '', '2025-05-25 05:05:37'),
(14, 2, 'Michael Lee', 'michael.lee77@example.com', 'Please improve air conditioning', '2025-05-25 05:05:37'),
(15, 3, '徐佳怡', 'jiayi.xu68@example.com', NULL, '2025-05-25 05:05:37'),
(16, 1, 'David Chang', 'david.chang30@example.com', '司機很親切，值得讚賞', '2025-05-25 05:05:37'),
(17, 2, '林依婷', 'yiting.lin54@example.com', '希望增加停靠站', '2025-05-25 05:05:37'),
(18, 3, 'James Ho', 'james.ho59@example.com', 'Could use real-time arrival info', '2025-05-25 05:05:37'),
(19, 1, '蔡佩珊', 'peishan.tsai12@example.com', '', '2025-05-25 05:05:37'),
(20, 2, 'Jenny Huang', 'jenny.huang40@example.com', 'Love this bus route!', '2025-05-25 05:05:37'),
(21, 3, '張欣怡', 'xinyi.zhang66@example.com', '路線設計很合理，感謝！', '2025-05-25 05:05:37');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `form_settings`
--
ALTER TABLE `form_settings`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `route_station`
--
ALTER TABLE `route_station`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `survey_response`
--
ALTER TABLE `survey_response`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `form_settings`
--
ALTER TABLE `form_settings`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route`
--
ALTER TABLE `route`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route_station`
--
ALTER TABLE `route_station`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=36;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `station`
--
ALTER TABLE `station`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `survey_response`
--
ALTER TABLE `survey_response`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
