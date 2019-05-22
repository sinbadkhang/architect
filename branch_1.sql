-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 08:05 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `branch_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `type`, `point`) VALUES
(1, 'test trg', '1234', 'manaawdge', 0),
(3, 'test add', '123', 'manaawdge', 0),
(18, 'test add', '1243', '1', 12);

--
-- Triggers `account`
--
DELIMITER $$
CREATE TRIGGER `trg_acc_del` AFTER DELETE ON `account` FOR EACH ROW INSERT INTO account_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), OLD.id, 'delete')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_acc_ins` AFTER INSERT ON `account` FOR EACH ROW INSERT INTO account_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'insert')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_acc_upd` AFTER UPDATE ON `account` FOR EACH ROW INSERT INTO account_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'update')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_log`
--

CREATE TABLE `account_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_log`
--

INSERT INTO `account_log` (`id`, `version`, `account_id`, `operation`) VALUES
(1, 0, 3, 'insert'),
(2, 0, 12, 'insert'),
(3, 0, 12, 'delete'),
(4, 0, 1, 'update'),
(5, 1, 18, 'insert');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `bill_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bill_info` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `total_price` int(11) NOT NULL,
  `total_point` int(11) NOT NULL,
  `customer_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cashier_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `bill_code`, `bill_info`, `created_date`, `total_price`, `total_point`, `customer_name`, `cashier_name`) VALUES
(14, 'bq231', '[{\"product_name\":\"coca cola\",\"quantity\":\"123\"}]', '0000-00-00 00:00:00', 222, 12312, 'khang', 'awda'),
(15, 'bq231', '[{\"product_name\":\"coca cola\",\"quantity\":\"123\"}]', '0000-00-00 00:00:00', 111111, 12312, 'khang', 'awda'),
(19, 'bq231', '[{\"product_name\":\"coca cola\",\"quantity\":\"132123\"}]', '0000-00-00 00:00:00', 111111, 12312, 'khang', 'awda'),
(21, 'bq231', '[{\"product_name\":\"coca cola\",\"quantity\":\"132123\"}]', '0000-00-00 00:00:00', 111111, 12312, 'khang', 'awda'),
(22, 'bq231', '[{\"product_name\":\"coca\",\"quantity\":\"132123\"}]', '0000-00-00 00:00:00', 111111, 12312, 'khang', 'awda'),
(23, '6969', '\"[{\\\"product_name\\\":\\\"coca cola\\\",\\\"quantity\\\":\\\"123\\\"}]\"', '0000-00-00 00:00:00', 222, 12312, 'test api update', 'awda');

--
-- Triggers `bill`
--
DELIMITER $$
CREATE TRIGGER `trg_bill_del` AFTER DELETE ON `bill` FOR EACH ROW INSERT INTO bill_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), OLD.id, 'delete')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_bill_ins` AFTER INSERT ON `bill` FOR EACH ROW INSERT INTO bill_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'insert')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_bill_upd` AFTER UPDATE ON `bill` FOR EACH ROW INSERT INTO bill_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'update')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bill_log`
--

CREATE TABLE `bill_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bill_log`
--

INSERT INTO `bill_log` (`id`, `version`, `bill_id`, `operation`) VALUES
(1, 1, 18, 'delete'),
(2, 1, 14, 'update'),
(3, 1, 23, 'insert'),
(4, 1, 23, 'update'),
(5, 1, 20, 'delete');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `category_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_code`, `category_name`) VALUES
(1, 123, 'drink'),
(2, 135, 'suka'),
(3, 159, 'test trigger');

--
-- Triggers `category`
--
DELIMITER $$
CREATE TRIGGER `trg_cate_del` AFTER DELETE ON `category` FOR EACH ROW INSERT INTO category_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), OLD.id, 'delete')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_cate_ins` AFTER INSERT ON `category` FOR EACH ROW INSERT INTO category_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'insert')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_cate_upd` AFTER UPDATE ON `category` FOR EACH ROW INSERT INTO category_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'update')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category_log`
--

CREATE TABLE `category_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_log`
--

INSERT INTO `category_log` (`id`, `version`, `category_id`, `operation`) VALUES
(1, 1, 3, 'insert'),
(2, 1, 2, 'update');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `product_name`, `category_id`, `quantity`, `price`) VALUES
(1, '123', 'coca cola', 123, 5000, 8000),
(2, 'trg upd', 'test trg', 135, 1, 2);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `trg_pro_del` AFTER DELETE ON `product` FOR EACH ROW INSERT INTO product_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), OLD.id, 'delete')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_pro_ins` AFTER INSERT ON `product` FOR EACH ROW INSERT INTO product_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'insert')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_pro_upd` AFTER UPDATE ON `product` FOR EACH ROW INSERT INTO product_log VALUES(null,(SELECT server_version FROM sync_log ORDER BY id DESC LIMIT 1), NEW.id, 'update')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_log`
--

CREATE TABLE `product_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_log`
--

INSERT INTO `product_log` (`id`, `version`, `product_id`, `operation`) VALUES
(1, 1, 2, 'insert'),
(2, 1, 2, 'update');

-- --------------------------------------------------------

--
-- Table structure for table `sync_log`
--

CREATE TABLE `sync_log` (
  `server_version` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sync_log`
--

INSERT INTO `sync_log` (`server_version`, `id`) VALUES
(0, 1),
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_log`
--
ALTER TABLE `account_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_log`
--
ALTER TABLE `bill_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_code`);

--
-- Indexes for table `category_log`
--
ALTER TABLE `category_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_log`
--
ALTER TABLE `product_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sync_log`
--
ALTER TABLE `sync_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `account_log`
--
ALTER TABLE `account_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bill_log`
--
ALTER TABLE `bill_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_log`
--
ALTER TABLE `category_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_log`
--
ALTER TABLE `product_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sync_log`
--
ALTER TABLE `sync_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
