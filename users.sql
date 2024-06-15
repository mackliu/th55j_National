-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-06-15 17:57:55
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
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, NULL, 'mary20@example.com'),
(2, NULL, 'karen79@aol.com'),
(3, NULL, 'helen38@hinet.net'),
(4, NULL, 'donna26@aol.com'),
(5, NULL, 'elizabeth24@yahoo.com'),
(6, NULL, 'timothy74@example.com'),
(7, NULL, 'john75@gmail.com'),
(8, NULL, 'edward05@gmail.com'),
(9, NULL, 'donald31@aol.com'),
(10, NULL, 'lisa33@yahoo.com'),
(11, NULL, 'kenneth36@example.com'),
(12, NULL, 'kevin10@hinet.net'),
(13, NULL, 'barbara29@hinet.net'),
(14, NULL, 'sarah46@test.com'),
(15, NULL, 'ronald35@hinet.net'),
(16, NULL, 'betty30@example.com'),
(17, NULL, 'donna12@test.com'),
(18, NULL, 'donald31@aol.com'),
(19, NULL, 'margaret40@gmail.com'),
(20, NULL, 'karen84@gmail.com'),
(21, NULL, 'robert26@hinet.net'),
(22, NULL, 'john77@yahoo.com'),
(23, NULL, 'patricia81@hinet.net'),
(24, NULL, 'jason51@aol.com'),
(25, NULL, 'paul17@hinet.net'),
(26, NULL, 'brian55@gmail.com'),
(27, NULL, 'paul16@yahoo.com'),
(28, NULL, 'kenneth41@aol.com'),
(29, NULL, 'timothy55@test.com'),
(30, NULL, 'barbara12@aol.com'),
(31, NULL, 'jane31@yahoo.com'),
(32, NULL, 'lisa74@aol.com'),
(33, NULL, 'linda54@yahoo.com'),
(34, NULL, 'james52@gmail.com'),
(35, NULL, 'lisa84@gmail.com'),
(36, NULL, 'margaret06@gmail.com'),
(37, NULL, 'donald15@yahoo.com'),
(38, NULL, 'barbara83@yahoo.com'),
(39, NULL, 'steven63@yahoo.com'),
(40, NULL, 'betty26@aol.com'),
(41, NULL, 'ronald03@test.com'),
(42, NULL, 'jane40@test.com'),
(43, NULL, 'john78@gmail.com'),
(44, NULL, 'jennifer96@gmail.com'),
(45, NULL, 'steven58@hotmail.com'),
(46, NULL, 'laura56@aol.com'),
(47, NULL, 'susan58@example.com'),
(48, NULL, 'timothy03@test.com'),
(49, NULL, 'john14@aol.com'),
(50, NULL, 'paul42@test.com'),
(51, NULL, 'jane17@aol.com'),
(52, NULL, 'robert78@example.com'),
(53, NULL, 'betty64@hinet.net'),
(54, NULL, 'charles39@yahoo.com'),
(55, NULL, 'margaret12@hotmail.com'),
(56, NULL, 'ronald11@hinet.net'),
(57, NULL, 'edward24@hotmail.com'),
(58, NULL, 'jason91@yahoo.com'),
(59, NULL, 'laura40@test.com'),
(60, NULL, 'sarah86@example.com'),
(61, NULL, 'karen07@gmail.com'),
(62, NULL, 'david46@aol.com'),
(63, NULL, 'paul52@test.com'),
(64, NULL, 'nancy26@example.com'),
(65, NULL, 'john18@gmail.com'),
(66, NULL, 'margaret02@aol.com'),
(67, NULL, 'nancy49@test.com'),
(68, NULL, 'thomas26@hinet.net'),
(69, NULL, 'charles98@hinet.net'),
(70, NULL, 'helen41@hinet.net'),
(71, NULL, 'nancy73@gmail.com'),
(72, NULL, 'donna76@hotmail.com'),
(73, NULL, 'barbara65@aol.com'),
(74, NULL, 'nancy18@hinet.net'),
(75, NULL, 'helen39@test.com'),
(76, NULL, 'elizabeth56@yahoo.com'),
(77, NULL, 'kevin87@aol.com'),
(78, NULL, 'donna81@test.com'),
(79, NULL, 'karen72@hotmail.com'),
(80, NULL, 'barbara20@hotmail.com'),
(81, NULL, 'kenneth58@hotmail.com'),
(82, NULL, 'margaret70@test.com'),
(83, NULL, 'edward90@yahoo.com'),
(84, NULL, 'john44@aol.com'),
(85, NULL, 'margaret28@test.com'),
(86, NULL, 'margaret09@hotmail.com'),
(87, NULL, 'robert40@aol.com'),
(88, NULL, 'timothy28@test.com'),
(89, NULL, 'donald93@gmail.com'),
(90, NULL, 'laura85@hotmail.com'),
(91, NULL, 'kenneth66@example.com'),
(92, NULL, 'mary37@hinet.net'),
(93, NULL, 'anthony45@hinet.net'),
(94, NULL, 'betty34@hotmail.com'),
(95, NULL, 'jason97@test.com'),
(96, NULL, 'mary38@example.com'),
(97, NULL, 'edward12@gmail.com'),
(98, NULL, 'elizabeth36@test.com'),
(99, NULL, 'linda00@hotmail.com'),
(100, NULL, 'mary87@hinet.net'),
(101, NULL, 'betty52@yahoo.com'),
(102, NULL, 'steven64@test.com'),
(103, NULL, 'mark96@hinet.net'),
(104, NULL, 'karen38@example.com'),
(105, NULL, 'robert93@hinet.net'),
(106, NULL, 'charles00@yahoo.com'),
(107, NULL, 'dorothy78@example.com'),
(108, NULL, 'mary02@gmail.com'),
(109, NULL, 'jason28@gmail.com'),
(110, NULL, 'elizabeth58@yahoo.com'),
(111, NULL, 'john20@hinet.net'),
(112, NULL, 'sandra49@hotmail.com'),
(113, NULL, 'david21@hotmail.com'),
(114, NULL, 'patricia33@aol.com'),
(115, NULL, 'brian99@example.com'),
(116, NULL, 'anthony18@hotmail.com'),
(117, NULL, 'patricia44@gmail.com'),
(118, NULL, 'linda05@example.com'),
(119, NULL, 'steven49@test.com'),
(120, NULL, 'thomas56@yahoo.com');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
