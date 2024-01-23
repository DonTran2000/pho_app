-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2024 年 1 月 22 日 15:01
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `pho_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(3, 'Tran Do', 'do', '$2y$10$sdcNZyZ7uVvJATPZvc.3RO.64qrO3GT/AeyjoNeY0/t6CYX.SBOdu'),
(4, 'Tran Viet', 'tranviet', '$2y$10$xqu8qxzdqITkL2OEYXmmGuYysYexNZseoWzcchaogBN47Di/ueQrq'),
(5, 'Le Thi Tien', 'lethitien', '$2y$10$.zUgZVhl1ZAdZPugrARv6O0wpKtw2wNV9IHrx0L9Foud3bambnRBm'),
(8, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(5, 'Phở', 'Food_Category_193.jpg', 'Yes', 'Yes'),
(6, 'Bún', 'Food_Category_830.jpeg', 'Yes', 'Yes'),
(7, 'Hủ Tiếu', 'Food_Category_131.jpeg', 'Yes', 'Yes'),
(8, 'Miến', '', 'No', 'No'),
(9, 'test', '', 'No', 'No');

-- --------------------------------------------------------

--
-- テーブルの構造 `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `food`
--

INSERT INTO `food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(2, 'Phở Bò', '', 30.000, 'Food-Name-847.webp', 5, 'Yes', 'Yes'),
(3, 'Bún Bò', '', 25.000, 'Food-name-2013.jpeg', 6, 'Yes', 'Yes'),
(4, 'Hủ Tiếu', '', 25.000, 'Food-name-5707.jpeg', 7, 'Yes', 'Yes'),
(5, 'Phở Đặc Biệt', '', 35.000, '', 5, 'No', 'Yes');

-- --------------------------------------------------------

--
-- テーブルの構造 `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(50) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,3) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `cases` varchar(20) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(150) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `orders`
--

INSERT INTO `orders` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `cases`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Hủ Tiếu', 25.000, 5, 125.000, '2024-01-22 20:01:20', 'Chưa xong', 'Mang Về', 'Test', NULL, NULL, NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
