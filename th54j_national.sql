-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-30 06:30:37
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
-- 資料庫： `th54j_national`
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
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `minute` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `bus`
--

INSERT INTO `bus` (`id`, `name`, `minute`) VALUES
(1, 'A12345', 31),
(2, 'B12345', 24),
(4, 'C12345', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `form`
--

CREATE TABLE `form` (
  `id` int(1) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `form`
--

INSERT INTO `form` (`id`, `active`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `number`
--

CREATE TABLE `number` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `number`
--

INSERT INTO `number` (`id`, `number`) VALUES
(1, 50);

-- --------------------------------------------------------

--
-- 資料表結構 `result`
--

CREATE TABLE `result` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `result`
--

INSERT INTO `result` (`id`, `name`, `email`, `bus`) VALUES
(1, '凯倫', 'karen79@aol.com', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `station`
--

CREATE TABLE `station` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int(10) UNSIGNED NOT NULL,
  `minute` int(10) NOT NULL,
  `waiting` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `station`
--

INSERT INTO `station` (`id`, `name`, `rank`, `minute`, `waiting`) VALUES
(1, '台北火車站', 1, 0, 5),
(2, '台大醫院', 2, 2, 3),
(3, '中正紀念堂', 3, 2, 3),
(4, '東門', 4, 3, 5),
(5, '大安森林公園', 5, 2, 3),
(6, '大安', 6, 1, 5),
(7, '信義安和', 7, 3, 3),
(8, '台北101', 8, 2, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `survey`
--

CREATE TABLE `survey` (
  `id` int(10) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `email`) VALUES
(4, 'donna26@aol.com'),
(5, 'elizabeth24@yahoo.com'),
(6, 'timothy74@example.com'),
(7, 'john75@gmail.com'),
(8, 'edward05@gmail.com'),
(9, 'donald31@aol.com'),
(10, 'lisa33@yahoo.com'),
(11, 'kenneth36@example.com'),
(12, 'kevin10@hinet.net'),
(13, 'barbara29@hinet.net'),
(14, 'sarah46@test.com'),
(15, 'ronald35@hinet.net'),
(16, 'betty30@example.com'),
(17, 'donna12@test.com'),
(18, 'donald31@aol.com'),
(19, 'margaret40@gmail.com'),
(20, 'karen84@gmail.com'),
(21, 'robert26@hinet.net'),
(22, 'john77@yahoo.com'),
(23, 'patricia81@hinet.net'),
(24, 'jason51@aol.com'),
(26, 'brian55@gmail.com'),
(27, 'paul16@yahoo.com'),
(28, 'kenneth41@aol.com'),
(29, 'timothy55@test.com'),
(30, 'barbara12@aol.com'),
(31, 'jane31@yahoo.com'),
(32, 'lisa74@aol.com'),
(33, 'linda54@yahoo.com'),
(34, 'james52@gmail.com'),
(35, 'lisa84@gmail.com'),
(36, 'margaret06@gmail.com'),
(37, 'donald15@yahoo.com'),
(38, 'barbara83@yahoo.com'),
(39, 'steven63@yahoo.com'),
(40, 'betty26@aol.com'),
(41, 'ronald03@test.com'),
(42, 'jane40@test.com'),
(43, 'john78@gmail.com'),
(44, 'jennifer96@gmail.com'),
(45, 'steven58@hotmail.com'),
(46, 'laura56@aol.com'),
(47, 'susan58@example.com'),
(48, 'timothy03@test.com'),
(49, 'john14@aol.com'),
(50, 'paul42@test.com'),
(51, 'jane17@aol.com'),
(52, 'robert78@example.com'),
(53, 'betty64@hinet.net'),
(54, 'charles39@yahoo.com'),
(55, 'margaret12@hotmail.com'),
(56, 'ronald11@hinet.net'),
(57, 'edward24@hotmail.com'),
(58, 'jason91@yahoo.com'),
(59, 'laura40@test.com'),
(60, 'sarah86@example.com'),
(61, 'karen07@gmail.com'),
(62, 'david46@aol.com'),
(63, 'paul52@test.com'),
(64, 'nancy26@example.com'),
(65, 'john18@gmail.com'),
(66, 'margaret02@aol.com'),
(67, 'nancy49@test.com'),
(68, 'thomas26@hinet.net'),
(69, 'charles98@hinet.net'),
(70, 'helen41@hinet.net'),
(71, 'nancy73@gmail.com'),
(72, 'donna76@hotmail.com'),
(73, 'barbara65@aol.com'),
(74, 'nancy18@hinet.net'),
(75, 'helen39@test.com'),
(76, 'elizabeth56@yahoo.com'),
(77, 'kevin87@aol.com'),
(78, 'donna81@test.com'),
(79, 'karen72@hotmail.com'),
(80, 'barbara20@hotmail.com'),
(81, 'kenneth58@hotmail.com'),
(82, 'margaret70@test.com'),
(83, 'edward90@yahoo.com'),
(84, 'john44@aol.com'),
(85, 'margaret28@test.com'),
(86, 'margaret09@hotmail.com'),
(87, 'robert40@aol.com'),
(88, 'timothy28@test.com'),
(89, 'donald93@gmail.com'),
(90, 'laura85@hotmail.com'),
(91, 'kenneth66@example.com'),
(92, 'mary37@hinet.net'),
(93, 'anthony45@hinet.net'),
(94, 'betty34@hotmail.com'),
(95, 'jason97@test.com'),
(96, 'mary38@example.com'),
(97, 'edward12@gmail.com'),
(98, 'elizabeth36@test.com'),
(99, 'linda00@hotmail.com'),
(100, 'mary87@hinet.net'),
(101, 'betty52@yahoo.com'),
(102, 'steven64@test.com'),
(103, 'mark96@hinet.net'),
(104, 'karen38@example.com'),
(105, 'robert93@hinet.net'),
(106, 'charles00@yahoo.com'),
(107, 'dorothy78@example.com'),
(108, 'mary02@gmail.com'),
(109, 'jason28@gmail.com'),
(110, 'elizabeth58@yahoo.com'),
(111, 'john20@hinet.net'),
(112, 'sandra49@hotmail.com'),
(113, 'david21@hotmail.com'),
(114, 'patricia33@aol.com'),
(115, 'brian99@example.com'),
(116, 'anthony18@hotmail.com'),
(117, 'patricia44@gmail.com'),
(118, 'linda05@example.com'),
(119, 'steven49@test.com'),
(120, 'thomas56@yahoo.com'),
(121, '123123@dfsdf'),
(122, 'sandra49@hinet.net'),
(123, 'george32@aol.com'),
(124, 'john85@gmail.com'),
(125, 'dorothy75@hotmail.com'),
(126, 'mark56@example.com'),
(127, 'patricia79@example.com'),
(128, 'mark21@yahoo.com'),
(129, 'sandra07@aol.com'),
(130, 'ronald07@hotmail.com'),
(131, 'linda53@gmail.com'),
(132, 'betty86@hotmail.com'),
(133, 'timothy86@test.com'),
(134, 'mark07@hinet.net'),
(135, 'patricia27@hinet.net'),
(136, 'maria93@gmail.com'),
(137, 'patricia81@gmail.com'),
(138, 'david16@gmail.com'),
(139, 'james70@test.com'),
(140, 'dorothy57@gmail.com'),
(141, 'jane65@test.com'),
(142, 'jennifer78@example.com'),
(143, 'steven43@example.com'),
(144, 'sandra45@aol.com'),
(145, 'maria16@hinet.net'),
(146, 'jennifer91@example.com'),
(147, 'john15@example.com'),
(148, 'betty52@hinet.net'),
(149, 'mark05@aol.com'),
(150, 'george86@hinet.net'),
(151, 'steven64@hotmail.com'),
(152, 'donna58@aol.com'),
(153, 'michael73@aol.com'),
(154, 'linda37@example.com'),
(155, 'nancy62@example.com'),
(156, 'jason50@example.com'),
(157, 'kenneth64@hotmail.com'),
(158, 'jennifer19@yahoo.com'),
(159, 'jane52@gmail.com'),
(160, 'david76@gmail.com'),
(161, 'donna33@hotmail.com'),
(162, 'lisa73@example.com'),
(163, 'anthony33@hotmail.com'),
(164, 'mark43@gmail.com'),
(165, 'sandra99@hotmail.com'),
(166, 'betty61@example.com'),
(167, 'helen52@hotmail.com'),
(168, 'lisa05@hinet.net'),
(169, 'jennifer96@test.com'),
(170, 'nancy93@test.com'),
(171, 'margaret02@aol.com'),
(172, 'steven43@yahoo.com'),
(173, 'karen59@yahoo.com'),
(174, 'patricia53@test.com'),
(175, 'ronald43@hotmail.com'),
(176, 'maria90@yahoo.com'),
(177, 'brian63@aol.com'),
(178, 'elizabeth50@hinet.net'),
(179, 'kevin10@example.com'),
(180, 'brian40@hinet.net'),
(181, 'charles33@aol.com'),
(182, 'james52@hinet.net'),
(183, 'kenneth38@yahoo.com'),
(184, 'patricia21@example.com'),
(185, 'ronald19@gmail.com'),
(186, 'robert49@test.com'),
(187, 'steven24@yahoo.com'),
(188, 'edward65@test.com'),
(189, 'david10@hinet.net'),
(190, 'robert79@hotmail.com'),
(191, 'helen42@example.com\n');

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
-- 資料表索引 `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `number`
--
ALTER TABLE `number`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `form`
--
ALTER TABLE `form`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `number`
--
ALTER TABLE `number`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `result`
--
ALTER TABLE `result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `station`
--
ALTER TABLE `station`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
