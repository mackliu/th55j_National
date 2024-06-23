-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-23 05:29:43
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db03`
--

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `email` text NOT NULL,
  `bus` text DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `bus`, `status`) VALUES
(2, NULL, 'karen79@aol.com', NULL, 0),
(3, NULL, 'helen38@hinet.net', NULL, 0),
(4, NULL, 'donna26@aol.com', NULL, 0),
(5, NULL, 'elizabeth24@yahoo.com', NULL, 0),
(6, NULL, 'timothy74@example.com', NULL, 0),
(7, NULL, 'john75@gmail.com', NULL, 0),
(8, NULL, 'edward05@gmail.com', NULL, 0),
(9, NULL, 'donald31@aol.com', NULL, 0),
(10, NULL, 'lisa33@yahoo.com', NULL, 0),
(11, NULL, 'kenneth36@example.com', NULL, 0),
(12, NULL, 'kevin10@hinet.net', NULL, 0),
(13, NULL, 'barbara29@hinet.net', NULL, 0),
(14, NULL, 'sarah46@test.com', NULL, 0),
(15, NULL, 'ronald35@hinet.net', NULL, 0),
(16, NULL, 'betty30@example.com', NULL, 0),
(17, NULL, 'donna12@test.com', NULL, 0),
(18, NULL, 'donald31@aol.com', NULL, 0),
(19, NULL, 'margaret40@gmail.com', NULL, 0),
(20, NULL, 'karen84@gmail.com', NULL, 0),
(21, NULL, 'robert26@hinet.net', NULL, 0),
(22, NULL, 'john77@yahoo.com', NULL, 0),
(23, NULL, 'patricia81@hinet.net', NULL, 0),
(24, NULL, 'jason51@aol.com', NULL, 0),
(25, NULL, 'paul17@hinet.net', NULL, 0),
(26, NULL, 'brian55@gmail.com', NULL, 0),
(27, NULL, 'paul16@yahoo.com', NULL, 0),
(28, NULL, 'kenneth41@aol.com', NULL, 0),
(29, NULL, 'timothy55@test.com', NULL, 0),
(30, NULL, 'barbara12@aol.com', NULL, 0),
(31, NULL, 'jane31@yahoo.com', NULL, 0),
(32, NULL, 'lisa74@aol.com', NULL, 0),
(33, NULL, 'linda54@yahoo.com', NULL, 0),
(34, NULL, 'james52@gmail.com', NULL, 0),
(35, NULL, 'lisa84@gmail.com', NULL, 0),
(36, NULL, 'margaret06@gmail.com', NULL, 0),
(37, NULL, 'donald15@yahoo.com', NULL, 0),
(38, NULL, 'barbara83@yahoo.com', NULL, 0),
(39, NULL, 'steven63@yahoo.com', NULL, 0),
(40, NULL, 'betty26@aol.com', NULL, 0),
(41, NULL, 'ronald03@test.com', NULL, 0),
(42, NULL, 'jane40@test.com', NULL, 0),
(43, NULL, 'john78@gmail.com', NULL, 0),
(44, NULL, 'jennifer96@gmail.com', NULL, 0),
(45, NULL, 'steven58@hotmail.com', NULL, 0),
(46, NULL, 'laura56@aol.com', NULL, 0),
(47, NULL, 'susan58@example.com', NULL, 0),
(48, NULL, 'timothy03@test.com', NULL, 0),
(49, NULL, 'john14@aol.com', NULL, 0),
(50, NULL, 'paul42@test.com', NULL, 0),
(51, NULL, 'jane17@aol.com', NULL, 0),
(52, NULL, 'robert78@example.com', NULL, 0),
(53, NULL, 'betty64@hinet.net', NULL, 0),
(54, NULL, 'charles39@yahoo.com', NULL, 0),
(55, NULL, 'margaret12@hotmail.com', NULL, 0),
(56, NULL, 'ronald11@hinet.net', NULL, 0),
(57, NULL, 'edward24@hotmail.com', NULL, 0),
(58, NULL, 'jason91@yahoo.com', NULL, 0),
(59, NULL, 'laura40@test.com', NULL, 0),
(60, NULL, 'sarah86@example.com', NULL, 0),
(61, NULL, 'karen07@gmail.com', NULL, 0),
(62, NULL, 'david46@aol.com', NULL, 0),
(63, NULL, 'paul52@test.com', NULL, 0),
(64, NULL, 'nancy26@example.com', NULL, 0),
(65, NULL, 'john18@gmail.com', NULL, 0),
(66, NULL, 'margaret02@aol.com', NULL, 0),
(67, NULL, 'nancy49@test.com', NULL, 0),
(68, NULL, 'thomas26@hinet.net', NULL, 0),
(69, NULL, 'charles98@hinet.net', NULL, 0),
(70, NULL, 'helen41@hinet.net', NULL, 0),
(71, NULL, 'nancy73@gmail.com', NULL, 0),
(72, NULL, 'donna76@hotmail.com', NULL, 0),
(73, NULL, 'barbara65@aol.com', NULL, 0),
(74, NULL, 'nancy18@hinet.net', NULL, 0),
(75, NULL, 'helen39@test.com', NULL, 0),
(76, NULL, 'elizabeth56@yahoo.com', NULL, 0),
(77, NULL, 'kevin87@aol.com', NULL, 0),
(78, NULL, 'donna81@test.com', NULL, 0),
(79, NULL, 'karen72@hotmail.com', NULL, 0),
(80, NULL, 'barbara20@hotmail.com', NULL, 0),
(81, NULL, 'kenneth58@hotmail.com', NULL, 0),
(82, NULL, 'margaret70@test.com', NULL, 0),
(83, NULL, 'edward90@yahoo.com', NULL, 0),
(84, NULL, 'john44@aol.com', NULL, 0),
(85, NULL, 'margaret28@test.com', NULL, 0),
(86, NULL, 'margaret09@hotmail.com', NULL, 0),
(87, NULL, 'robert40@aol.com', NULL, 0),
(88, NULL, 'timothy28@test.com', NULL, 0),
(89, NULL, 'donald93@gmail.com', NULL, 0),
(90, NULL, 'laura85@hotmail.com', NULL, 0),
(91, NULL, 'kenneth66@example.com', NULL, 0),
(92, NULL, 'mary37@hinet.net', NULL, 0),
(93, NULL, 'anthony45@hinet.net', NULL, 0),
(94, NULL, 'betty34@hotmail.com', NULL, 0),
(95, NULL, 'jason97@test.com', NULL, 0),
(96, NULL, 'mary38@example.com', NULL, 0),
(97, NULL, 'edward12@gmail.com', NULL, 0),
(98, NULL, 'elizabeth36@test.com', NULL, 0),
(99, NULL, 'linda00@hotmail.com', NULL, 0),
(100, NULL, 'mary87@hinet.net', NULL, 0),
(101, NULL, 'betty52@yahoo.com', NULL, 0),
(102, NULL, 'steven64@test.com', NULL, 0),
(103, NULL, 'mark96@hinet.net', NULL, 0),
(104, NULL, 'karen38@example.com', NULL, 0),
(105, NULL, 'robert93@hinet.net', NULL, 0),
(106, NULL, 'charles00@yahoo.com', NULL, 0),
(107, NULL, 'dorothy78@example.com', NULL, 0),
(108, NULL, 'mary02@gmail.com', NULL, 0),
(109, NULL, 'jason28@gmail.com', NULL, 0),
(110, NULL, 'elizabeth58@yahoo.com', NULL, 0),
(111, NULL, 'john20@hinet.net', NULL, 0),
(112, NULL, 'sandra49@hotmail.com', NULL, 0),
(113, NULL, 'david21@hotmail.com', NULL, 0),
(114, NULL, 'patricia33@aol.com', NULL, 0),
(115, NULL, 'brian99@example.com', NULL, 0),
(116, NULL, 'anthony18@hotmail.com', NULL, 0),
(117, NULL, 'patricia44@gmail.com', NULL, 0),
(118, NULL, 'linda05@example.com', NULL, 0),
(119, NULL, 'steven49@test.com', NULL, 0),
(120, NULL, 'thomas56@yahoo.com', NULL, 0),
(121, NULL, '123123@dfsdf', NULL, 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
