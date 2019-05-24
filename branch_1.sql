-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 24, 2019 lúc 07:03 PM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `branch_1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `type`, `point`) VALUES
(19, 'sinbadkhang', '12312', 'manager', 1),
(22, 'sinbadkhang1', '12', 'manager', 2);

--
-- Bẫy `account`
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
-- Cấu trúc bảng cho bảng `account_log`
--

CREATE TABLE `account_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
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
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`id`, `bill_code`, `bill_info`, `created_date`, `total_price`, `total_point`, `customer_name`, `cashier_name`) VALUES
(14, 'bq231', '[{\"product_name\":\"coca cola\",\"quantity\":\"123\"}]', '0000-00-00 00:00:00', 222, 12312, 'khang', 'awda'),
(23, '6969', '\"[{\\\"product_name\\\":\\\"coca cola\\\",\\\"quantity\\\":\\\"123\\\"}]\"', '0000-00-00 00:00:00', 222, 12312, 'test api update', 'awda');

--
-- Bẫy `bill`
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
-- Cấu trúc bảng cho bảng `bill_log`
--

CREATE TABLE `bill_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `category_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `category_code`, `category_name`) VALUES
(7, 123, 'drink');

--
-- Bẫy `category`
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
-- Cấu trúc bảng cho bảng `category_log`
--

CREATE TABLE `category_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
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
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `product_code`, `product_name`, `category_id`, `quantity`, `price`) VALUES
(4, '1234', 'string 2', 7, 1, 2);

--
-- Bẫy `product`
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
-- Cấu trúc bảng cho bảng `product_log`
--

CREATE TABLE `product_log` (
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `operation` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sync_log`
--

CREATE TABLE `sync_log` (
  `server_version` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sync_log`
--

INSERT INTO `sync_log` (`server_version`, `id`) VALUES
(0, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `account_log`
--
ALTER TABLE `account_log`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_code` (`bill_code`);

--
-- Chỉ mục cho bảng `bill_log`
--
ALTER TABLE `bill_log`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_code` (`category_code`),
  ADD KEY `category_id` (`category_code`);

--
-- Chỉ mục cho bảng `category_log`
--
ALTER TABLE `category_log`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `category_code` (`category_id`);

--
-- Chỉ mục cho bảng `product_log`
--
ALTER TABLE `product_log`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sync_log`
--
ALTER TABLE `sync_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `account_log`
--
ALTER TABLE `account_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `bill_log`
--
ALTER TABLE `bill_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `category_log`
--
ALTER TABLE `category_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `product_log`
--
ALTER TABLE `product_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `sync_log`
--
ALTER TABLE `sync_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
