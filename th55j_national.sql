-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-04-26 05:36:00
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 8.2.12

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
(1, '新蘆快線'),
(2, '台北普通線'),
(3, '北區專線'),
(4, '北和線');

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
(1, 1, 5, 1, 3, 4),
(2, 1, 12, 2, 6, 3),
(3, 1, 4, 3, 5, 2),
(4, 1, 14, 4, 18, 3),
(5, 1, 11, 5, 12, 4),
(6, 1, 17, 6, 9, 2),
(7, 2, 1, 1, 5, 2),
(8, 2, 2, 2, 6, 3),
(9, 2, 3, 3, 9, 3),
(10, 2, 5, 4, 6, 2),
(11, 2, 4, 5, 12, 3),
(12, 2, 7, 6, 9, 3),
(13, 2, 6, 7, 8, 2),
(14, 3, 2, 1, 4, 2),
(15, 3, 13, 2, 7, 3),
(16, 3, 6, 3, 5, 2),
(17, 3, 16, 4, 8, 2),
(18, 3, 9, 5, 6, 3),
(19, 4, 1, 1, 3, 2),
(20, 4, 2, 2, 4, 2),
(21, 4, 6, 3, 6, 2),
(22, 4, 8, 4, 2, 2),
(23, 4, 9, 5, 3, 2),
(24, 4, 10, 6, 4, 2);

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
(4, '東門'),
(5, '大安森林公園'),
(6, '大安'),
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
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `form_settings`
--
ALTER TABLE `form_settings`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route`
--
ALTER TABLE `route`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route_station`
--
ALTER TABLE `route_station`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=25;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `station`
--
ALTER TABLE `station`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `survey_response`
--
ALTER TABLE `survey_response`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
