-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 09, 2024 lúc 10:04 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cds`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '2024-07-10 02:57:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblbanners`
--

CREATE TABLE `tblbanners` (
  `id` int(11) NOT NULL,
  `BannerTitle` varchar(150) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblbanners`
--

INSERT INTO `tblbanners` (`id`, `BannerTitle`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `CreateDate`, `UpdationDate`, `Status`) VALUES
(1, 'Banner image website', 'banner1_930x620.jpg', 'banner2_930x620.jpg', 'banner6_930x620.jpg', 'banner7_930x620.jpg', 'banner5_930x620.jpg', '2024-06-22 14:04:35', '2024-08-29 17:09:06', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblbookings`
--

CREATE TABLE `tblbookings` (
  `BookingID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `AwayTeam` int(11) DEFAULT NULL,
  `idfm` int(11) NOT NULL,
  `BookingDate` date DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblbookings`
--

INSERT INTO `tblbookings` (`BookingID`, `CustomerID`, `AwayTeam`, `idfm`, `BookingDate`, `Notes`, `Status`, `CreateDate`) VALUES
(49, 16, 17, 2, '2024-11-09', '', 4, '2024-11-09 22:47:13'),
(50, 18, 27, 17, '2024-11-12', '', 4, '2024-11-10 02:39:06'),
(51, 18, 22, 32, '2024-11-11', '', 4, '2024-11-10 02:40:03'),
(52, 18, NULL, 33, '2024-11-13', '', 1, '2024-11-10 02:40:57'),
(53, 18, 24, 14, '2024-11-12', '', 4, '2024-11-10 02:41:49'),
(54, 18, 22, 75, '2024-11-13', '', 4, '2024-11-10 02:42:23'),
(55, 22, 17, 2, '2024-11-12', '', 4, '2024-11-10 02:45:55'),
(56, 22, 24, 19, '2024-11-14', '', 4, '2024-11-10 02:46:31'),
(57, 22, 26, 29, '2024-11-13', '', 4, '2024-11-10 02:47:10'),
(58, 17, 27, 2, '2024-11-11', '', 4, '2024-11-10 02:48:42'),
(59, 17, 23, 3, '2024-11-13', '', 4, '2024-11-10 02:49:38'),
(60, 17, 23, 32, '2024-11-15', '', 4, '2024-11-10 02:50:11'),
(61, 17, 20, 75, '2024-11-15', '', 4, '2024-11-10 02:51:11'),
(62, 19, 23, 32, '2024-11-12', '', 4, '2024-11-10 02:51:51'),
(63, 19, 24, 2, '2024-11-13', '', 4, '2024-11-10 02:52:20'),
(64, 19, 23, 17, '2024-11-14', '', 4, '2024-11-10 02:53:01'),
(65, 19, 26, 3, '2024-11-15', '', 4, '2024-11-10 02:53:27'),
(66, 19, 23, 15, '2024-11-12', '', 4, '2024-11-10 02:53:51'),
(67, 27, 26, 29, '2024-11-14', '', 4, '2024-11-10 02:55:41'),
(68, 27, 16, 44, '2024-11-15', '', 4, '2024-11-10 02:56:09'),
(69, 27, 16, 76, '2024-11-15', '', 4, '2024-11-10 02:56:43'),
(70, 25, 24, 29, '2024-11-12', '', 4, '2024-11-10 02:58:05'),
(71, 25, 26, 3, '2024-11-14', '', 4, '2024-11-10 02:58:26'),
(72, 25, 26, 44, '2024-11-11', '', 4, '2024-11-10 02:58:55'),
(73, 25, 26, 14, '2024-11-13', '', 4, '2024-11-10 02:59:25'),
(74, 25, 24, 45, '2024-11-12', '', 4, '2024-11-10 02:59:57'),
(75, 20, NULL, 46, '2024-11-11', '', 1, '2024-11-10 03:17:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 'Thể Thao', 'Liên quan đến tin tức thể thao', '2024-01-11 18:30:00', '2024-06-23 05:43:16', 1),
(5, 'Giải trí', 'Tin tức liên quan đến giải trí', '2024-01-11 18:30:00', '2024-06-23 05:43:25', 1),
(6, 'Chính trị', 'Tin tức liên quan đến chính trị', '2024-01-11 18:30:00', '2024-06-23 13:30:05', 1),
(7, 'Kinh doanh', 'Tin tức liên quan đến Kinh doanh', '2024-01-11 18:30:00', '2024-06-23 05:43:25', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, '126 Nguy?n Thi?n Thành, Ph??ng 5, Trà Vinh', 'tvu@tvu.edu.vn', '0294.3.8559');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'Kunal ', 'kunal@gmail.com', '7977779798', 'I want to know you brach in Chandigarh?', '2024-06-04 09:34:51', 1),
(2, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:38:00', 1),
(3, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:38:52', NULL),
(4, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:39:24', NULL),
(5, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:39:51', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcountryalpha`
--

CREATE TABLE `tblcountryalpha` (
  `ID` int(11) NOT NULL,
  `Country` varchar(150) NOT NULL,
  `Alpha2` varchar(10) NOT NULL,
  `Alpha3` varchar(10) NOT NULL,
  `NumericAlpha` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerTypeID` int(50) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcustomers`
--

INSERT INTO `tblcustomers` (`CustomerID`, `CustomerName`, `CustomerTypeID`, `Address`, `Phone`, `Email`) VALUES
(16, 'Oanh Đi Lâm', 1, 'Ấp Giồng Tranh- Xã Tập Ngãi- huyện Tiểu Cần- Tỉnh Trà Vinh', '0967976564', 'oanhdii@gmail.com'),
(17, 'Ninh', 1, 'Ấp Giồng Tranh- Xã Tập Ngãi- huyện Tiểu Cần- Tỉnh Trà Vinh', '0967976564', 'ninh@gmail.com'),
(18, 'Oanh Đi', 1, 'Tiểu Cần - Trà Vinh', '0967976564', 'di@gmail.com'),
(19, 'Hoàng Phúc', 1, 'Phường 5 - Tp. Trà Vinh', '0486178132', 'phuc@gmail.com'),
(20, 'Tiểu Cần', 1, 'Tiểu Cần - Trà Vinh', '0897234891', 'tieucan@gmail.com'),
(21, 'Tiểu Cần', 1, 'Tiểu Cần - Trà Vinh', '0897234891', 'tieucan@gmail.com'),
(22, 'Cẩm Ly', 1, 'Cầu Kè - Trà Vinh', '0392781632', 'camly@gmail.com'),
(23, 'Cầu Kè', 1, 'Cầu Kè - Trà Vinh', '0918928289', 'cauke@gmail.com'),
(24, 'Cầu Ngang', 1, 'Cầu Ngang - Trà Vinh', '0819808116', 'caungang@gmail.com'),
(25, 'Khmer', 1, 'Trà Vinh', '0891812791', 'khmer@gmail.com'),
(26, 'Càng Long', 1, 'Càng Long - Trà Vinh', '0781456816', 'canglong@gmail.com'),
(27, 'Thanh Hiền', 1, 'Châu Thành - Trà Vinh', '0975448616', 'hien@gmail.com'),
(28, 'Tiểu Cần', 1, 'Tiểu Cần - Trà Vinh', '081896888', 'tieucan@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomertype`
--

CREATE TABLE `tblcustomertype` (
  `CustomerTypeID` int(11) NOT NULL,
  `CustomerTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcustomertype`
--

INSERT INTO `tblcustomertype` (`CustomerTypeID`, `CustomerTypeName`) VALUES
(1, 'Bình Thường'),
(2, 'VIP');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldiscount`
--

CREATE TABLE `tbldiscount` (
  `id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_last` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldiscount`
--

INSERT INTO `tbldiscount` (`id`, `value`, `description`, `create_by`, `create_date`, `update_last`) VALUES
(1, 5.00, '5%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(2, 10.00, '10%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(3, 15.00, '15%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(4, 20.00, '20%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(5, 25.00, '25%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(6, 30.00, '30%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(7, 35.00, '35%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(8, 40.00, '40%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(9, 45.00, '45%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(10, 50.00, '50%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(11, 55.00, '55%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(12, 60.00, '60%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(13, 65.00, '65%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(14, 70.00, '70%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(15, 75.00, '75%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(16, 80.00, '80%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(17, 85.00, '85%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(18, 90.00, '90%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(19, 95.00, '95%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(20, 100.00, '100%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldrink`
--

CREATE TABLE `tbldrink` (
  `DrinkID` int(11) NOT NULL,
  `DrinkName` varchar(150) NOT NULL,
  `PricePerUnit` decimal(10,0) NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldrink`
--

INSERT INTO `tbldrink` (`DrinkID`, `DrinkName`, `PricePerUnit`, `CreateDate`, `UpdateDate`) VALUES
(1, 'Sting', 15000, '2024-07-19 09:55:34', NULL),
(2, 'Chanh Muối', 15000, '2024-07-19 09:55:34', NULL),
(3, 'Trà Đường', 10000, '2024-07-19 09:55:34', NULL),
(4, 'Number 1', 10000, '2024-07-19 09:55:34', NULL),
(5, 'Cafe đá', 10000, '2024-07-19 09:55:34', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldrinkorder`
--

CREATE TABLE `tbldrinkorder` (
  `DrinkOrderID` int(11) NOT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldrinkorder`
--

INSERT INTO `tbldrinkorder` (`DrinkOrderID`, `TotalPrice`, `PaymentID`, `CreateDate`, `UpdateDate`) VALUES
(90, 90000.00, 93, '2024-11-10 03:47:05', '2024-11-10 03:47:05'),
(91, 300000.00, 94, '2024-11-10 03:47:31', '2024-11-10 03:47:31'),
(92, 100000.00, 95, '2024-11-10 03:47:52', '2024-11-10 03:47:52'),
(93, 0.00, 96, '2024-11-10 03:48:09', '2024-11-10 03:48:09'),
(94, 90000.00, 97, '2024-11-10 03:48:31', '2024-11-10 03:48:31'),
(95, 0.00, 98, '2024-11-10 03:48:43', '2024-11-10 03:48:43'),
(96, 45000.00, 99, '2024-11-10 03:48:57', '2024-11-10 03:48:57'),
(97, 60000.00, 100, '2024-11-10 03:49:16', '2024-11-10 03:49:16'),
(98, 65000.00, 101, '2024-11-10 03:49:39', '2024-11-10 03:49:39'),
(99, 150000.00, 102, '2024-11-10 03:49:58', '2024-11-10 03:49:58'),
(100, 0.00, 103, '2024-11-10 03:50:09', '2024-11-10 03:50:09'),
(101, 0.00, 104, '2024-11-10 03:50:20', '2024-11-10 03:50:20'),
(102, 0.00, 105, '2024-11-10 03:50:31', '2024-11-10 03:50:31'),
(103, 0.00, 106, '2024-11-10 03:50:43', '2024-11-10 03:50:43'),
(104, 30000.00, 107, '2024-11-10 03:51:04', '2024-11-10 03:51:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldrinkorderline`
--

CREATE TABLE `tbldrinkorderline` (
  `DrinkOrderLineID` int(11) NOT NULL,
  `DrinkOrderID` int(11) NOT NULL,
  `DrinkID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` decimal(10,0) NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldrinkorderline`
--

INSERT INTO `tbldrinkorderline` (`DrinkOrderLineID`, `DrinkOrderID`, `DrinkID`, `Quantity`, `TotalPrice`, `CreateDate`, `UpdateDate`) VALUES
(112, 90, 1, 3, 45000, '2024-11-10 03:47:05', NULL),
(113, 90, 2, 3, 45000, '2024-11-10 03:47:05', NULL),
(114, 91, 1, 10, 150000, '2024-11-10 03:47:31', NULL),
(115, 91, 2, 10, 150000, '2024-11-10 03:47:31', NULL),
(116, 92, 3, 5, 50000, '2024-11-10 03:47:52', NULL),
(117, 92, 4, 5, 50000, '2024-11-10 03:47:52', NULL),
(118, 94, 2, 6, 90000, '2024-11-10 03:48:31', NULL),
(119, 96, 2, 3, 45000, '2024-11-10 03:48:57', NULL),
(120, 97, 2, 4, 60000, '2024-11-10 03:49:16', NULL),
(121, 98, 2, 3, 45000, '2024-11-10 03:49:39', NULL),
(122, 98, 3, 2, 20000, '2024-11-10 03:49:39', NULL),
(123, 99, 1, 10, 150000, '2024-11-10 03:49:58', NULL),
(124, 104, 3, 3, 30000, '2024-11-10 03:51:04', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblemployees`
--

CREATE TABLE `tblemployees` (
  `EmployeeID` int(11) NOT NULL,
  `EmployeeName` varchar(100) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `PositionTypeID` int(11) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblemployees`
--

INSERT INTO `tblemployees` (`EmployeeID`, `EmployeeName`, `DateOfBirth`, `Gender`, `PositionTypeID`, `Salary`, `Address`, `Phone`, `Email`) VALUES
(1, 'Nguyễn Quang Vinh', NULL, NULL, 3, NULL, 'Châu Thành - Trà Vinh', '0123456789', ''),
(2, 'Trương Quốc Dũng', NULL, NULL, 3, NULL, 'TP. Trà Vinh', '0123456789', NULL),
(3, 'Võ Minh Trí', NULL, NULL, 3, NULL, 'TP. Trà Vinh', '0123456789', NULL),
(5, 'Lôi Cửu Thiên', '1996-11-12', 'Nam', 3, NULL, 'Trà Vinh', '0967976564', 'thienloi@gmail.com'),
(6, 'Kim Đô', '1994-06-24', 'Nam', 3, NULL, 'Tiểu Cần - Trà Vinh', '0969222555', 'dokim@gmail.com'),
(7, 'Kim Thị Cẩm Li', '2003-10-24', 'Nữ', 3, NULL, 'Cầu Kè - Trà Vinh', '0367976566', 'lyly@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfacility_inventory`
--

CREATE TABLE `tblfacility_inventory` (
  `id` int(11) NOT NULL,
  `facility_type_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `good_quantity` int(11) NOT NULL,
  `normal_quantity` int(11) NOT NULL,
  `deteriorated_quantity` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfacility_inventory`
--

INSERT INTO `tblfacility_inventory` (`id`, `facility_type_id`, `warehouse_id`, `quantity`, `good_quantity`, `normal_quantity`, `deteriorated_quantity`, `status_id`, `last_updated`) VALUES
(2, 2, 1, 10, 2, 2, 6, 2, '2024-07-23 14:04:23'),
(3, 1, 1, 50, 40, 5, 5, 1, '2024-07-23 14:03:12'),
(4, 3, 1, 8, 5, 2, 1, 1, '2024-07-23 14:27:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfacility_status`
--

CREATE TABLE `tblfacility_status` (
  `id` int(11) NOT NULL,
  `status_fac` varchar(150) NOT NULL,
  `Create_By` varchar(50) DEFAULT NULL,
  `Create_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfacility_status`
--

INSERT INTO `tblfacility_status` (`id`, `status_fac`, `Create_By`, `Create_Date`) VALUES
(1, 'Bình thường', NULL, '2024-07-22 11:48:48'),
(2, 'Cần Nâng Cấp', NULL, '2024-07-22 11:48:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfacility_types`
--

CREATE TABLE `tblfacility_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL,
  `Create_By` varchar(50) DEFAULT NULL,
  `Create_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Last_Update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfacility_types`
--

INSERT INTO `tblfacility_types` (`id`, `type_name`, `Create_By`, `Create_Date`, `Last_Update`) VALUES
(1, 'Trái bóng', NULL, '2024-07-22 11:48:25', '2024-07-22 14:16:42'),
(2, 'Đồng phục', NULL, '2024-07-22 11:48:25', NULL),
(3, 'Khung thành', NULL, '2024-07-22 11:48:25', NULL),
(4, 'Lưới bóng', NULL, '2024-07-22 11:48:25', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfieldmatch`
--

CREATE TABLE `tblfieldmatch` (
  `idfm` int(11) NOT NULL,
  `FieldID` int(11) NOT NULL,
  `idtm` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreateBy` varchar(50) NOT NULL,
  `CreateDate` date NOT NULL,
  `UpdateDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfieldmatch`
--

INSERT INTO `tblfieldmatch` (`idfm`, `FieldID`, `idtm`, `Price`, `Status`, `CreateBy`, `CreateDate`, `UpdateDate`) VALUES
(2, 1, 1, 150000, 1, '', '2024-06-24', 0),
(3, 1, 2, 150000, 1, '', '2024-06-24', 0),
(4, 1, 3, 150000, 1, '', '2024-06-24', 0),
(5, 1, 4, 150000, 1, '', '2024-06-24', 0),
(6, 1, 5, 150000, 1, '', '2024-06-24', 0),
(7, 1, 6, 150000, 1, '', '2024-06-24', 0),
(8, 1, 7, 170000, 1, '', '2024-06-24', 0),
(9, 1, 8, 170000, 1, '', '2024-06-24', 0),
(10, 1, 9, 170000, 1, '', '2024-06-24', 0),
(11, 1, 10, 200000, 1, '', '2024-06-24', 0),
(12, 1, 11, 200000, 1, '', '2024-06-24', 0),
(13, 1, 12, 200000, 1, '', '2024-06-24', 0),
(14, 1, 13, 200000, 1, '', '2024-06-24', 0),
(15, 1, 14, 200000, 1, '', '2024-06-24', 0),
(16, 1, 15, 200000, 1, '', '2024-06-24', 0),
(17, 2, 1, 150000, 1, '', '2024-06-24', 0),
(18, 2, 2, 150000, 1, '', '2024-06-24', 0),
(19, 2, 3, 150000, 1, '', '2024-06-24', 0),
(20, 2, 4, 150000, 1, '', '2024-06-24', 0),
(21, 2, 5, 150000, 1, '', '2024-06-24', 0),
(22, 2, 6, 150000, 1, '', '2024-06-24', 0),
(23, 2, 7, 170000, 1, '', '2024-06-24', 0),
(24, 2, 8, 170000, 1, '', '2024-06-24', 0),
(25, 2, 9, 170000, 1, '', '2024-06-24', 0),
(26, 2, 10, 200000, 1, '', '2024-06-24', 0),
(27, 2, 11, 200000, 1, '', '2024-06-24', 0),
(28, 2, 12, 200000, 1, '', '2024-06-24', 0),
(29, 2, 13, 200000, 1, '', '2024-06-24', 0),
(30, 2, 14, 200000, 1, '', '2024-06-24', 0),
(31, 2, 15, 200000, 1, '', '2024-06-24', 0),
(32, 3, 1, 150000, 1, '', '2024-06-24', 0),
(33, 3, 2, 150000, 1, '', '2024-06-24', 0),
(34, 3, 3, 150000, 1, '', '2024-06-24', 0),
(35, 3, 4, 150000, 1, '', '2024-06-24', 0),
(36, 3, 5, 150000, 1, '', '2024-06-24', 0),
(37, 3, 6, 150000, 1, '', '2024-06-24', 0),
(38, 3, 7, 170000, 1, '', '2024-06-24', 0),
(39, 3, 8, 170000, 1, '', '2024-06-24', 0),
(40, 3, 9, 170000, 0, '', '2024-06-24', 0),
(41, 3, 10, 200000, 1, '', '2024-06-24', 0),
(42, 3, 11, 200000, 1, '', '2024-06-24', 0),
(43, 3, 12, 200000, 1, '', '2024-06-24', 0),
(44, 3, 13, 200000, 1, '', '2024-06-24', 0),
(45, 3, 14, 200000, 1, '', '2024-06-24', 0),
(46, 3, 15, 200000, 1, '', '2024-06-24', 0),
(47, 4, 1, 150000, 1, '', '2024-06-24', 0),
(48, 4, 2, 150000, 1, '', '2024-06-24', 0),
(49, 4, 3, 150000, 1, '', '2024-06-24', 0),
(50, 4, 4, 150000, 1, '', '2024-06-24', 0),
(51, 4, 5, 150000, 1, '', '2024-06-24', 0),
(52, 4, 6, 150000, 1, '', '2024-06-24', 0),
(53, 4, 7, 170000, 1, '', '2024-06-24', 0),
(54, 4, 8, 170000, 1, '', '2024-06-24', 0),
(55, 4, 9, 170000, 0, '', '2024-06-24', 0),
(56, 4, 10, 200000, 1, '', '2024-06-24', 0),
(57, 4, 11, 200000, 1, '', '2024-06-24', 0),
(58, 4, 12, 200000, 1, '', '2024-06-24', 0),
(59, 4, 13, 200000, 1, '', '2024-06-24', 0),
(60, 4, 14, 200000, 1, '', '2024-06-24', 0),
(61, 4, 15, 200000, 1, '', '2024-06-24', 0),
(62, 5, 1, 200000, 1, '', '0000-00-00', 0),
(63, 5, 2, 200000, 1, '', '0000-00-00', 0),
(64, 5, 3, 200000, 1, '', '0000-00-00', 0),
(65, 5, 4, 200000, 1, '', '0000-00-00', 0),
(66, 5, 5, 200000, 1, '', '0000-00-00', 0),
(67, 5, 6, 200000, 1, '', '0000-00-00', 0),
(68, 5, 7, 200000, 1, '', '0000-00-00', 0),
(69, 5, 8, 200000, 1, '', '0000-00-00', 0),
(70, 5, 9, 200000, 1, '', '0000-00-00', 0),
(71, 5, 10, 200000, 1, '', '0000-00-00', 0),
(72, 5, 11, 250000, 1, '', '0000-00-00', 0),
(73, 5, 12, 250000, 1, '', '0000-00-00', 0),
(74, 5, 13, 250000, 1, '', '0000-00-00', 0),
(75, 5, 14, 300000, 1, '', '0000-00-00', 0),
(76, 5, 15, 300000, 1, '', '0000-00-00', 0),
(77, 7, 1, 150000, 1, '', '2024-09-26', 0),
(78, 7, 2, 150000, 1, '', '2024-09-26', 0),
(79, 7, 3, 150000, 1, '', '2024-09-26', 0),
(80, 7, 4, 150000, 1, '', '2024-09-26', 0),
(81, 7, 5, 150000, 1, '', '2024-09-26', 0),
(82, 7, 6, 150000, 1, '', '2024-09-26', 0),
(83, 7, 7, 170000, 1, '', '2024-09-26', 0),
(84, 7, 8, 170000, 1, '', '2024-09-26', 0),
(85, 7, 9, 170000, 1, '', '2024-09-26', 0),
(86, 7, 10, 200000, 1, '', '2024-09-26', 0),
(87, 7, 11, 200000, 1, '', '2024-09-26', 0),
(88, 7, 12, 200000, 1, '', '2024-09-26', 0),
(89, 7, 13, 200000, 1, '', '2024-09-26', 0),
(90, 7, 14, 200000, 1, '', '2024-09-26', 0),
(91, 7, 15, 200000, 1, '', '2024-09-26', 0),
(92, 8, 1, 150000, 1, '', '2024-09-26', 0),
(93, 8, 2, 150000, 1, '', '2024-09-26', 0),
(94, 8, 3, 150000, 1, '', '2024-09-26', 0),
(95, 8, 4, 150000, 1, '', '2024-09-26', 0),
(96, 8, 5, 150000, 1, '', '2024-09-26', 0),
(97, 8, 6, 150000, 1, '', '2024-09-26', 0),
(98, 8, 7, 170000, 1, '', '2024-09-26', 0),
(99, 8, 8, 170000, 1, '', '2024-09-26', 0),
(100, 8, 9, 170000, 1, '', '2024-09-26', 0),
(101, 8, 10, 200000, 1, '', '2024-09-26', 0),
(102, 8, 11, 200000, 1, '', '2024-09-26', 0),
(103, 8, 12, 200000, 1, '', '2024-09-26', 0),
(104, 8, 13, 200000, 1, '', '2024-09-26', 0),
(105, 8, 14, 200000, 1, '', '2024-09-26', 0),
(106, 8, 15, 200000, 1, '', '2024-09-26', 0),
(107, 9, 1, 150000, 1, '', '2024-09-26', 0),
(108, 9, 2, 150000, 1, '', '2024-09-26', 0),
(109, 9, 3, 150000, 1, '', '2024-09-26', 0),
(110, 9, 4, 150000, 1, '', '2024-09-26', 0),
(111, 9, 5, 150000, 1, '', '2024-09-26', 0),
(112, 9, 6, 150000, 1, '', '2024-09-26', 0),
(113, 9, 7, 170000, 1, '', '2024-09-26', 0),
(114, 9, 8, 170000, 1, '', '2024-09-26', 0),
(115, 9, 9, 170000, 0, '', '2024-09-26', 0),
(116, 9, 10, 200000, 1, '', '2024-09-26', 0),
(117, 9, 11, 200000, 1, '', '2024-09-26', 0),
(118, 9, 12, 200000, 1, '', '2024-09-26', 0),
(119, 9, 13, 200000, 1, '', '2024-09-26', 0),
(120, 9, 14, 200000, 1, '', '2024-09-26', 0),
(121, 9, 15, 200000, 1, '', '2024-09-26', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfields`
--

CREATE TABLE `tblfields` (
  `FieldID` int(11) NOT NULL,
  `FieldName` varchar(100) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `FieldTypeID` int(11) DEFAULT NULL,
  `Size` varchar(50) DEFAULT NULL,
  `MaxPlayers` int(11) DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `FieldGroup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfields`
--

INSERT INTO `tblfields` (`FieldID`, `FieldName`, `Address`, `FieldTypeID`, `Size`, `MaxPlayers`, `Notes`, `FieldGroup`) VALUES
(1, 'Sân 1', '', 1, '40M*20M', 10, 'Sân 1', 5),
(2, 'Sân 2', NULL, 1, '40M*20M', 10, 'Sân 2', 5),
(3, 'Sân 3', NULL, 1, '40M*20M', 10, 'Sân 3', 5),
(5, 'Sân 7(Sân Lớn)', NULL, 1, '25M*45M', 14, 'Sân 7', NULL),
(7, 'Sân 1', '', 2, '20M*15M', 4, 'Sân 1', NULL),
(8, 'Sân 2', '', 2, '20M*15M', 4, 'Sân 2', NULL),
(9, 'Sân 3', '', 2, '20M*15M', 4, 'Sân 3', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfieldtypes`
--

CREATE TABLE `tblfieldtypes` (
  `FieldTypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfieldtypes`
--

INSERT INTO `tblfieldtypes` (`FieldTypeID`, `TypeName`) VALUES
(1, 'Bóng Đá'),
(2, 'Cầu Lông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmatches`
--

CREATE TABLE `tblmatches` (
  `MatchID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Result` varchar(50) DEFAULT NULL,
  `Referee` varchar(50) DEFAULT NULL,
  `EmployeeID` int(11) NOT NULL,
  `HomeTeamID` int(11) NOT NULL,
  `AwayTeamID` int(11) DEFAULT NULL,
  `ScoreTeamHome` int(11) DEFAULT NULL,
  `ScoreTeamAway` int(11) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblmatches`
--

INSERT INTO `tblmatches` (`MatchID`, `BookingID`, `Status`, `Result`, `Referee`, `EmployeeID`, `HomeTeamID`, `AwayTeamID`, `ScoreTeamHome`, `ScoreTeamAway`, `CreateBy`, `CreateDate`) VALUES
(20, 49, 4, '16', NULL, 1, 16, 17, 3, 0, NULL, '2024-11-09 15:28:16'),
(21, 54, 4, '22', NULL, 1, 18, 22, 0, 3, NULL, '2024-11-09 20:18:58'),
(22, 53, 4, '18', NULL, 3, 18, 24, 5, 0, NULL, '2024-11-09 20:19:06'),
(23, 50, 4, '27', NULL, 7, 18, 27, 0, 2, NULL, '2024-11-09 20:19:10'),
(24, 51, 4, '22', NULL, 6, 18, 22, 0, 10, NULL, '2024-11-09 20:19:16'),
(25, 56, 4, '22', NULL, 1, 22, 24, 1, 0, NULL, '2024-11-09 20:19:38'),
(26, 57, 4, '22', NULL, 3, 22, 26, 4, 0, NULL, '2024-11-09 20:19:43'),
(27, 55, 4, '22', NULL, 2, 22, 17, 5, 2, NULL, '2024-11-09 20:19:47'),
(28, 59, 4, '17', NULL, 7, 17, 23, 4, 2, NULL, '2024-11-09 20:20:07'),
(29, 60, 4, '0', NULL, 6, 17, 23, 1, 1, NULL, '2024-11-09 20:20:10'),
(30, 61, 4, '0', NULL, 2, 17, 20, 3, 3, NULL, '2024-11-09 20:20:14'),
(31, 58, 4, '27', NULL, 5, 17, 27, 0, 2, NULL, '2024-11-09 20:20:32'),
(32, 65, 4, '0', NULL, 7, 19, 26, 2, 2, NULL, '2024-11-09 20:21:11'),
(33, 64, 4, '0', NULL, 2, 19, 23, 3, 3, NULL, '2024-11-09 20:21:16'),
(34, 63, 4, '19', NULL, 6, 19, 24, 5, 2, NULL, '2024-11-09 20:21:20'),
(35, 66, 4, '0', NULL, 1, 19, 23, 1, 1, NULL, '2024-11-09 20:21:23'),
(36, 62, 4, '23', NULL, 6, 19, 23, 1, 4, NULL, '2024-11-09 20:21:28'),
(37, 71, 4, '0', NULL, 5, 25, 26, 2, 2, NULL, '2024-11-09 20:22:31'),
(38, 73, 4, '26', NULL, 5, 25, 26, 0, 3, NULL, '2024-11-09 20:22:36'),
(39, 74, 4, '25', NULL, 2, 25, 24, 5, 4, NULL, '2024-11-09 20:22:40'),
(40, 70, 4, '24', NULL, 5, 25, 24, 1, 3, NULL, '2024-11-09 20:22:43'),
(41, 72, 4, '25', NULL, 7, 25, 26, 3, 0, NULL, '2024-11-09 20:22:47'),
(42, 67, 4, '27', NULL, 3, 27, 26, 3, 2, NULL, '2024-11-09 20:23:19'),
(43, 69, 4, '27', NULL, 1, 27, 16, 5, 2, NULL, '2024-11-09 20:26:07'),
(44, 68, 4, '0', NULL, 5, 27, 16, 4, 4, NULL, '2024-11-09 20:26:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmatchpayments`
--

CREATE TABLE `tblmatchpayments` (
  `PaymentID` int(11) NOT NULL,
  `MatchID` int(11) DEFAULT NULL,
  `FieldRent` decimal(10,0) NOT NULL,
  `ServiceCharges` decimal(10,0) NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `ExtraCharge` decimal(10,2) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblmatchpayments`
--

INSERT INTO `tblmatchpayments` (`PaymentID`, `MatchID`, `FieldRent`, `ServiceCharges`, `Amount`, `ExtraCharge`, `TotalAmount`, `Status`, `CreateDate`, `UpdateDate`) VALUES
(93, 31, 150000, 90000, 240000, 0.00, 240000.00, 1, '2024-11-10 03:47:05', '2024-11-10 03:47:05'),
(94, 24, 150000, 300000, 450000, 0.00, 450000.00, 1, '2024-11-10 03:47:31', '2024-11-10 03:47:31'),
(95, 41, 200000, 100000, 300000, 0.00, 300000.00, 1, '2024-11-10 03:47:52', '2024-11-10 03:47:52'),
(96, 27, 150000, 0, 150000, 0.00, 150000.00, 1, '2024-11-10 03:48:09', '2024-11-10 03:48:09'),
(97, 22, 200000, 90000, 290000, 0.00, 290000.00, 1, '2024-11-10 03:48:31', '2024-11-10 03:48:31'),
(98, 35, 200000, 0, 200000, 0.00, 200000.00, 1, '2024-11-10 03:48:43', '2024-11-10 03:48:43'),
(99, 23, 150000, 45000, 195000, 0.00, 195000.00, 1, '2024-11-10 03:48:57', '2024-11-10 03:48:57'),
(100, 40, 200000, 60000, 260000, 0.00, 260000.00, 1, '2024-11-10 03:49:16', '2024-11-10 03:49:16'),
(101, 36, 150000, 65000, 215000, 0.00, 215000.00, 1, '2024-11-10 03:49:39', '2024-11-10 03:49:39'),
(102, 39, 200000, 150000, 350000, 0.00, 350000.00, 1, '2024-11-10 03:49:58', '2024-11-10 03:49:58'),
(103, 34, 150000, 0, 150000, 0.00, 150000.00, 1, '2024-11-10 03:50:09', '2024-11-10 03:50:09'),
(104, 28, 150000, 0, 150000, 0.00, 150000.00, 1, '2024-11-10 03:50:20', '2024-11-10 03:50:20'),
(105, 38, 200000, 0, 200000, 0.00, 200000.00, 1, '2024-11-10 03:50:31', '2024-11-10 03:50:31'),
(106, 26, 200000, 0, 200000, 0.00, 200000.00, 1, '2024-11-10 03:50:43', '2024-11-10 03:50:43'),
(107, 21, 300000, 30000, 330000, 0.00, 330000.00, 1, '2024-11-10 03:51:04', '2024-11-10 03:51:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblorder`
--

CREATE TABLE `tblorder` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_price_product` decimal(10,0) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `promotion` decimal(10,2) DEFAULT NULL,
  `extra_charge` decimal(10,2) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblorder`
--

INSERT INTO `tblorder` (`id`, `customer_name`, `address`, `phone`, `order_date`, `total_price_product`, `total_amount`, `status`, `discount`, `promotion`, `extra_charge`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(3, 'Oanh Đi', 'Châu Thành - Trà Vinh', '0123456789', '2024-08-02', 7900000, 5526500.00, '1', 2368500.00, 15000.00, 10000.00, NULL, '2024-08-02 14:13:29', NULL, '2024-08-02 14:13:29'),
(4, 'Hiền', 'Trà Vinh', '0123456789', '2024-08-06', 3100000, 3100000.00, '1', 0.00, 0.00, 0.00, NULL, '2024-08-06 10:53:01', NULL, '2024-08-06 10:53:01'),
(5, 'Na', 'Trà Vinh', '0123456789', '2024-08-06', 6200000, 5566500.00, '1', 618500.00, 15000.00, 0.00, NULL, '2024-08-16 10:53:34', NULL, '2024-08-06 10:55:32'),
(6, 'Oanh', 'Trà Vinh', '0123456789', '2024-08-23', 8000000, 6384000.00, '1', 1596000.00, 20000.00, 0.00, NULL, '2024-08-23 10:54:17', NULL, '2024-08-06 10:56:27'),
(7, 'Hạnh', 'Trà Vinh', '0123456789', '2024-08-09', 1600000, 1600000.00, '1', 0.00, 0.00, 0.00, NULL, '2024-08-09 11:03:39', NULL, '2024-08-06 11:04:04'),
(8, 'Anh Vũ', 'Phương Thạnh - Càng Long', '0967976564', '2024-08-31', 1600000, 1615000.00, '1', 0.00, 0.00, 15000.00, NULL, '2024-08-31 13:21:56', NULL, '2024-08-31 13:21:56'),
(9, 'Oanh Đi', 'Tiểu Cần - Trà Vinh', '0967976564', '2024-11-10', 1550000, 1313250.00, '1', 231750.00, 5000.00, 0.00, NULL, '2024-11-10 03:52:08', NULL, '2024-11-10 03:52:08'),
(10, 'Nhựt Ninh', 'Càng Long - Trà Vinh', '093924656', '2024-11-10', 1500000, 1192000.00, '1', 298000.00, 10000.00, 0.00, NULL, '2024-11-10 03:52:59', NULL, '2024-11-10 03:52:59'),
(11, 'Hoàng Phúc', 'Phường 5 - Tp. Trà Vinh', '039325643', '2024-11-10', 1600000, 1351500.00, '1', 238500.00, 10000.00, 0.00, NULL, '2024-11-10 03:53:48', NULL, '2024-11-10 03:53:48'),
(12, 'Thanh Hiền', 'Châu Thành - Trà Vinh', '0787565424', '2024-11-10', 1600000, 1181250.00, '1', 393750.00, 25000.00, 0.00, NULL, '2024-11-10 03:54:34', NULL, '2024-11-10 03:54:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblorderdetails`
--

CREATE TABLE `tblorderdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblorderdetails`
--

INSERT INTO `tblorderdetails` (`id`, `order_id`, `product_id`, `size`, `quantity`, `price`, `total_price`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(3, 3, 1, '43', 3, 1600000.00, 4800000, NULL, '2024-08-02 14:13:29', NULL, NULL),
(4, 3, 3, '43', 2, 1550000.00, 3100000, NULL, '2024-08-02 14:13:29', NULL, NULL),
(5, 4, 1, '41', 1, 1600000.00, 1600000, NULL, '2024-08-06 10:53:01', NULL, '2024-08-06 10:57:01'),
(6, 4, 2, '41', 1, 1500000.00, 1500000, NULL, '2024-08-06 10:53:01', NULL, '2024-08-06 10:57:01'),
(7, 5, 3, '42', 4, 1550000.00, 6200000, NULL, '2024-08-16 10:53:34', NULL, '2024-08-06 10:55:51'),
(8, 6, 1, '42', 5, 1600000.00, 8000000, NULL, '2024-08-23 10:54:17', NULL, '2024-08-06 10:56:40'),
(9, 7, 1, '41', 1, 1600000.00, 1600000, NULL, '2024-08-09 11:03:39', NULL, '2024-08-06 11:04:14'),
(10, 8, 1, '', 1, 1600000.00, 1600000, NULL, '2024-08-31 13:21:56', NULL, NULL),
(11, 9, 3, '43', 1, 1550000.00, 1550000, NULL, '2024-11-10 03:52:08', NULL, NULL),
(12, 10, 2, '41', 1, 1500000.00, 1500000, NULL, '2024-11-10 03:52:59', NULL, NULL),
(13, 11, 1, '42', 1, 1600000.00, 1600000, NULL, '2024-11-10 03:53:48', NULL, NULL),
(14, 12, 1, '43', 1, 1600000.00, 1600000, NULL, '2024-11-10 03:54:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Điều Khoản Sử Dụng', 'terms', '																																	<div class=\"container\">\r\n        <p>Xin chào và cảm ơn bạn đã sử dụng dịch vụ của chúng tôi! Điều Khoản Sử Dụng này quy định các điều kiện và điều khoản mà bạn phải tuân thủ&nbsp;</p><p>khi truy cập và sử dụng trang web TVU Sport Center và các dịch vụ liên quan.</p>\r\n\r\n        <h4>Điều khoản chung</h4>\r\n        <p>Bằng cách truy cập hoặc sử dụng trang web của chúng tôi, bạn đồng ý tuân thủ các điều khoản và điều kiện sau đây. Nếu bạn không đồng ý với&nbsp;</p><p>bất kỳ phần nào trong các điều khoản này, xin vui lòng ngừng sử dụng trang web và các dịch vụ liên quan.</p>\r\n\r\n        <h4>Quyền sở hữu trí tuệ</h4>\r\n        <p>Các nội dung trên trang web bao gồm nhưng không giới hạn đến văn bản, đồ họa, biểu tượng, hình ảnh, video, mã nguồn và phần mềm đều thuộc quyền sở hữu trí tuệ của chúng tôi hoặc các bên sở hữu. Bạn không được sao chép, sửa đổi, phân phối hoặc tái sử dụng bất kỳ phần nào của trang web mà không có sự cho phép&nbsp;</p><p>bằng văn bản từ chúng tôi.</p>\r\n\r\n        <h4>Thay đổi dịch vụ</h4>\r\n        <p>Chúng tôi có quyền thay đổi hoặc ngừng cung cấp bất kỳ dịch vụ nào mà không cần thông báo trước. Chúng tôi không chịu trách nhiệm đối với&nbsp;</p><p>bất kỳ ai hoặc bất kỳ thực thể nào đối với bất kỳ sự thay đổi, tạm ngừng hoặc ngừng cung cấp dịch vụ nào.</p>\r\n\r\n        <h4>Bảo mật thông tin</h4>\r\n        <p>Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn theo Chính sách bảo mật của chúng tôi. Bằng cách sử dụng dịch vụ của chúng tôi, bạn đồng ý rằng thông tin cá nhân của bạn có thể được thu thập và sử dụng theo Chính sách bảo mật của chúng tôi.</p>\r\n\r\n        <h4>Liên hệ chúng tôi</h4>\r\n        <p>Nếu bạn có bất kỳ câu hỏi hoặc yêu cầu nào liên quan đến Điều Khoản Sử Dụng này, vui lòng liên hệ với chúng tôi qua email support@TVUSportCenter.com hoặc hotline 0294.3.855247.</p>\r\n\r\n        <p>Chúng tôi có thể cập nhật Điều Khoản Sử Dụng này từ thời gian này sang thời gian khác để phản ánh các thay đổi trong các hoạt động của chúng tôi.</p><p>&nbsp;Mọi thay đổi sẽ được đăng tải trên trang web này.</p>\r\n    </div>\r\n														\r\n															'),
(2, 'Chính Sách Bảo Mật', 'privacy', '																																																		<div class=\"container\">\r\n        <p>Bảo vệ thông tin cá nhân của người dùng là một trong những ưu tiên hàng đầu của chúng tôi tại FootballTVU.com.&nbsp;</p><p>Chính sách bảo mật này giải thích cách chúng tôi thu thập, sử dụng, bảo vệ và tiết lộ thông tin cá nhân của bạn khi bạn sử dụng dịch vụ của chúng tôi.</p>\r\n\r\n        <h4>Thông tin chúng tôi thu thập</h4>\r\n        <p>Chúng tôi có thể thu thập các thông tin cá nhân từ bạn khi bạn đăng ký tài khoản, đặt sân bóng, hoặc liên lạc với chúng tôi qua email.&nbsp;</p><p>Các thông tin này có thể bao gồm tên, địa chỉ email, số điện thoại.</p>\r\n\r\n        <h4>Việc sử dụng thông tin</h4>\r\n        <p>Chúng tôi sử dụng thông tin cá nhân của bạn để cung cấp dịch vụ đặt sân bóng, quản lý tài khoản của bạn, xử lý thanh toán, và liên lạc với bạn về các thông tin quan trọng liên quan đến đặt sân.</p>\r\n\r\n        <h4>Bảo vệ thông tin cá nhân</h4>\r\n        <p>Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn bằng cách sử dụng các biện pháp bảo mật vật lý và điện tử phù hợp.&nbsp;</p><p>Chúng tôi không bán, cho thuê hoặc chia sẻ thông tin cá nhân của bạn với bên thứ ba ngoài trừ trường hợp có yêu cầu pháp lý hoặc khi bạn đã đồng ý.</p>\r\n\r\n        <h4>Quyền lợi của bạn</h4>\r\n        <p>Bạn có quyền truy cập, sửa đổi và cập nhật thông tin cá nhân của mình bất kỳ lúc nào bằng cách đăng nhập vào tài khoản của bạn&nbsp;</p><p>trên FootballTVU.com. Bạn cũng có quyền yêu cầu xóa thông tin cá nhân của mình khỏi hệ thống của chúng tôi.</p>\r\n\r\n        <h4>Liên hệ chúng tôi</h4>\r\n        <p>Nếu bạn có bất kỳ câu hỏi nào về Chính sách bảo mật của chúng tôi, vui lòng liên hệ với chúng tôi qua email support@TVUSportCenter.com&nbsp;</p><p>hoặc hotline 0294.3.855247.</p>\r\n\r\n        <p>Chính sách bảo mật này có thể được cập nhật từ thời gian này sang thời gian khác. Mọi thay đổi sẽ được cập nhật trên trang web này.</p>\r\n    </div>\r\n														\r\n															\r\n															'),
(3, 'Về Với Chúng Tôi', 'aboutus', '																																	 <div class=\"container\">\r\n        <h4>Chào mừng bạn đến với TVU Sport Center</h4>\r\n        <p>Bạn yêu thích thể thao và đang tìm kiếm một địa điểm lý tưởng để cùng bạn bè thỏa mãn niềm đam mê? <strong>TVU Sport Center</strong> chính là sự lựa chọn&nbsp;</p><p>hoàn hảo dành cho bạn! Chúng tôi cung cấp dịch vụ đặt sân bóng&nbsp; với hệ thố, cầu lông, hồ bơi,... với sân bãi hiện đại, trang thiết bị đầy đủ, và dịch vụ hỗ trợ tận</p><p>&nbsp;tâm.</p>\r\n        \r\n        <h4>Tại sao chọn chúng tôi?</h4>\r\n        <ul class=\"list-group list-group-flush\">\r\n            <li class=\"list-group-item\"><strong>Sân bãi chất lượng cao:</strong> Các sân thể thao của chúng tôi đều đạt chuẩn, được bảo dưỡng thường xuyên để mang lại trải nghiệm chơi thể thao tốt nhất&nbsp;</li><li class=\"list-group-item\">cho bạn và đội của mình.</li>\r\n            <li class=\"list-group-item\"><strong>Dễ dàng đặt sân:</strong> Hệ thống đặt sân trực tuyến tiện lợi, cho phép bạn đặt sân nhanh chóng và dễ dàng chỉ với vài cú nhấp chuột.</li>\r\n            <li class=\"list-group-item\"><strong>Dịch vụ khách hàng:</strong> Đội ngũ hỗ trợ nhiệt tình, sẵn sàng giải đáp mọi thắc mắc và giúp bạn giải quyết mọi vấn đề liên quan đến việc đặt sân.</li>\r\n            <li class=\"list-group-item\"><strong>Giá cả hợp lý:</strong> Chúng tôi cam kết mang đến cho bạn mức giá cạnh tranh nhất, phù hợp với mọi đối tượng khách hàng.</li>\r\n            <li class=\"list-group-item\"><strong>Sự kiện và giải đấu:</strong> Thường xuyên tổ chức các sự kiện, giải đấu bóng đá hấp dẫn, giúp bạn có cơ hội giao lưu, học hỏi và thể hiện tài năng.</li>\r\n        </ul>\r\n\r\n        <h4>Cách thức đặt sân</h4>\r\n        <ol class=\"list-group list-group-flush\">\r\n            <li class=\"list-group-item\"><strong>Đăng ký tài khoản:</strong> Tạo tài khoản trên <span style=\"font-weight: 700;\">TVU Sport Center</span>&nbsp;để dễ dàng quản lý các lần đặt sân của bạn.</li>\r\n            <li class=\"list-group-item\"><strong>Chọn sân và thời gian:</strong> Truy cập vào mục \"Đặt sân\", chọn sân bóng và thời gian phù hợp với lịch trình của bạn.</li>\r\n            <li class=\"list-group-item\"><strong>Xác nhận và thanh toán:</strong> Kiểm tra lại thông tin đặt sân và tiến hành thanh toán qua các phương thức hỗ trợ.</li>\r\n            <li class=\"list-group-item\"><strong>Nhận xác nhận:</strong> Sau khi hoàn tất thanh toán, bạn sẽ nhận được email xác nhận đặt sân.</li>\r\n        </ol>\r\n\r\n        <h4>Liên hệ với chúng tôi</h4>\r\n        <p>Nếu bạn có bất kỳ câu hỏi hay cần hỗ trợ, đừng ngần ngại liên hệ với chúng tôi qua các kênh sau:</p>\r\n        <ul class=\"list-group list-group-flush\">\r\n            <li class=\"list-group-item\"><strong>Hotline:</strong> 0294.3.855247.</li>\r\n            <li class=\"list-group-item\"><strong>Email:</strong> support@TVUSportCenter.com</li>\r\n            <li class=\"list-group-item\"><strong>Địa chỉ:</strong> 126 Nguyễn Thiện Thành, Phường 5, Tp. Trà Vinh, Trà Vinh.</li>\r\n        </ul>\r\n\r\n        <p>Hãy đến với <strong>TVU Sport Center</strong> để trải nghiệm dịch vụ đặt sân bóng đá tốt nhất và cùng chúng tôi tận hưởng những trận cầu sôi động và đầy kịch tính!</p>\r\n    </div>\r\n														\r\n															'),
(11, 'Câu Hỏi Thường Gặp', 'faqs', '																																																															<div class=\"container\">\r\n        <div class=\"accordion\" id=\"faqAccordion\">\r\n            <div class=\"accordion-item\">\r\n                <h3 class=\"accordion-header\" id=\"faqHeadingOne\">\r\n                    <button class=\"accordion-button\" type=\"button\" data-toggle=\"collapse\" data-target=\"#faqCollapseOne\" aria-expanded=\"true\" aria-controls=\"faqCollapseOne\">\r\n                        Câu hỏi 1: Làm thế nào để đặt sân bóng đá trên trang web của bạn?\r\n                    </button>\r\n                </h3>\r\n                <div id=\"faqCollapseOne\" class=\"collapse in\" aria-labelledby=\"faqHeadingOne\" data-parent=\"#faqAccordion\" aria-expanded=\"true\" style=\"\">\r\n                    <div class=\"accordion-body\">\r\n                        Để đặt sân bóng đá, bạn cần đăng nhập vào tài khoản của mình, chọn sân bóng và thời gian phù hợp, sau đó tiến hành thanh toán để hoàn tất quy</div><div class=\"accordion-body\">&nbsp;trình đặt sân.\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"accordion-item\">\r\n                <h3 class=\"accordion-header\" id=\"faqHeadingTwo\">\r\n                    <button class=\"accordion-button\" type=\"button\" data-toggle=\"collapse\" data-target=\"#faqCollapseTwo\" aria-expanded=\"true\" aria-controls=\"faqCollapseTwo\">\r\n                        Câu hỏi 2: Tôi có thể hủy đặt sân như thế nào?\r\n                    </button>\r\n                </h3>\r\n                <div id=\"faqCollapseTwo\" class=\"collapse in\" aria-labelledby=\"faqHeadingTwo\" data-parent=\"#faqAccordion\" aria-expanded=\"true\" style=\"\">\r\n                    <div class=\"accordion-body\">\r\n                        Để hủy đặt sân, bạn cần đăng nhập vào tài khoản của mình, truy cập vào lịch sử đặt sân và chọn tùy chọn hủy bỏ. Vui lòng lưu ý thực hiện hủy đặt&nbsp;</div><div class=\"accordion-body\">sân trước thời gian quy định để nhận được hoàn trả phí một cách hợp lý.\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"accordion-item\">\r\n                <h3 class=\"accordion-header\" id=\"faqHeadingThree\">\r\n                    <button class=\"accordion-button\" type=\"button\" data-toggle=\"collapse\" data-target=\"#faqCollapseThree\" aria-expanded=\"true\" aria-controls=\"faqCollapseThree\">\r\n                        Câu hỏi 3: Tôi có thể liên hệ với đội ngũ hỗ trợ của bạn như thế nào?\r\n                    </button>\r\n                </h3>\r\n                <div id=\"faqCollapseThree\" class=\"collapse in\" aria-labelledby=\"faqHeadingThree\" data-parent=\"#faqAccordion\" aria-expanded=\"true\" style=\"\">\r\n                    <div class=\"accordion-body\">\r\n                        Bạn có thể liên hệ với đội ngũ hỗ trợ của chúng tôi qua hotline 0294.3.855247 hoặc gửi email đến địa chỉ support@TVUSportCenter.com.&nbsp;</div><div class=\"accordion-body\">Chúng tôi luôn sẵn sàng hỗ trợ bạn trong quá trình đặt sân và giải đáp mọi thắc mắc của bạn.\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n														\r\n															');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblplayers`
--

CREATE TABLE `tblplayers` (
  `PlayerID` int(11) NOT NULL,
  `PlayerName` varchar(100) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `TeamID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpositiontypes`
--

CREATE TABLE `tblpositiontypes` (
  `PositionTypeID` int(11) NOT NULL,
  `PositionName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblpositiontypes`
--

INSERT INTO `tblpositiontypes` (`PositionTypeID`, `PositionName`) VALUES
(1, 'Nhân Viên Phục Vụ'),
(2, 'Nhân Viên Thu Ngân'),
(3, 'Trọng Tài');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`, `Content`, `Likes`) VALUES
(7, 'Khánh thành sân bóng đá cỏ nhân tạo và giao lưu bóng đá tại Trường Đại học Trà Vinh', 3, 4, '<p><strong>Ng&agrave;y 24/06/2002, Ban Gi&aacute;m hiệu Trường Đại học Tr&agrave; Vinh tổ chức </strong><strong>Lễ&nbsp;</strong><strong>kh&aacute;nh th&agrave;nh v&agrave; đưa v&agrave;o sử dụng s&acirc;n b&oacute;ng đ&aacute; cỏ nh&acirc;n tạo tại khu I, T</strong><strong>rường</strong><strong>&nbsp;Đại học Tr&agrave; Vinh. Đồng thời, diễn ra giải b&oacute;ng đ&aacute; nam ch&agrave;o mừng Kỷ niệm 48 năm ng&agrave;y Giải ph&oacute;ng miền Nam thống nhất đất nước (30/4/1975 &ndash; 30/4/2023), kỷ niệm 137 năm Ng&agrave;y Quốc tế Lao động 01/5 (01/5/1886 &ndash; 01/5/2023) v&agrave; kỷ niệm 133 năm Ng&agrave;y sinh Chủ tịch Hồ Ch&iacute; Minh (19/5/1890 &ndash; 19/5/2023) kết hợp tư vấn tuyển sinh tại trường.</strong></p>\r\n<p>Đến dự c&oacute;, &Ocirc;ng Trần Văn &Uacute;t T&aacute;m, Ph&oacute; Gi&aacute;m đốc Sở Khoa học &amp; C&ocirc;ng nghệ; &Ocirc;ng Nguyễn Văn Đ&ocirc;, Chủ tịch C&ocirc;ng đo&agrave;n Cty Nhiệt điện Duy&ecirc;n Hải v&agrave; l&atilde;nh đạo, c&aacute;n bộ vi&ecirc;n chức của hai đơn vị Sở Khoa học &amp; C&ocirc;ng nghệ v&agrave; Nh&agrave; m&aacute;y Nhiệt điện Duy&ecirc;n Hải.</p>\r\n<p>Về ph&iacute;a Trường Đại học Tr&agrave; Vinh c&oacute;, TS. Thạch Thị D&acirc;n, Ph&oacute; Hiệu trưởng Nh&agrave; trường; &Ocirc;ng Phan Mai Bạch, Ph&oacute; Gi&aacute;m đốc Trung t&acirc;m Ngoại ngữ Tin học Victory, Cố vấn học tập lớp Bồi dưỡng tiếng Khmer c&ugrave;ng với l&atilde;nh đạo c&aacute;c đơn vị, đại diện c&aacute;n bộ vi&ecirc;n chức Nh&agrave; trường v&agrave; hơn 80 vận động vi&ecirc;n tranh t&agrave;i tại giải b&oacute;ng đ&aacute; tham dự.</p>\r\n<p>Dịp n&agrave;y, tại s&acirc;n b&oacute;ng đ&aacute; cỏ nh&acirc;n tạo Trường Đại học Tr&agrave; Vinh diễn ra giải b&oacute;ng đ&aacute; nam tranh c&uacute;p TVU ch&agrave;o mừng Kỷ niệm 48 năm ng&agrave;y Giải ph&oacute;ng miền Nam thống nhất đất nước (30/4/1975 &ndash; 30/4/2023), kỷ niệm 137 năm Ng&agrave;y Quốc tế Lao động 01/5 (01/5/1886 &ndash; 01/5/2023) v&agrave; kỷ niệm 133 năm Ng&agrave;y sinh Chủ tịch Hồ Ch&iacute; Minh (19/5/1890 &ndash; 19/5/2023) với sự tham gia thi đấu của bốn đội đến từ c&aacute;c đơn vị: Trường Đại học Tr&agrave; Vinh; Sở Khoa học v&agrave; C&ocirc;ng nghệ tỉnh Tr&agrave; Vinh; C&ocirc;ng ty Nhiệt điện Thị x&atilde; Duy&ecirc;n Hải, Học vi&ecirc;n l&agrave; c&aacute;n bộ lớp bồi dưỡng tiếng Khmer.</p>\r\n<p>Kết th&uacute;c giải đấu, tại trận chung kết đội trường Đại học Tr&agrave; Vinh chiến thắng với tỷ số 1-0 đến từ pha ghi b&agrave;n của ch&acirc;n s&uacute;t Trần Nam v&agrave; gi&agrave;nh ng&ocirc;i v&ocirc; địch tại giải đấu. Về Nh&igrave; l&agrave; đội đến từ đơn vị Sở Khoa học v&agrave; C&ocirc;ng nghệ tỉnh Tr&agrave; Vinh. Đội từ hai đơn vị C&ocirc;ng ty Nhiệt điện Thị x&atilde; Duy&ecirc;n Hải, Học vi&ecirc;n l&agrave; c&aacute;n bộ lớp bồi dưỡng tiếng Khmer lần lượt gi&agrave;nh giải ba v&agrave; v&agrave; giải khuyến kh&iacute;ch của giải đấu.</p>', '2024-01-15 18:30:00', '2024-09-25 03:07:18', 1, 'Jasprit-Bumrah-ruled-out-of-England-T20I-series-due-to-injury', 'khanhthanh.jpg', 24, 'admin', NULL, '<p>Ng&agrave;y <strong>28/4/2023</strong>, Ban Gi&aacute;m hiệu Trường Đại học Tr&agrave; Vinh tổ chức Lễ kh&aacute;nh th&agrave;nh v&agrave; đưa v&agrave;o sử dụng s&acirc;n b&oacute;ng đ&aacute; cỏ nh&acirc;n tạo tại khu I, Trường Đại học Tr&agrave; Vinh. Đồng thời, diễn ra giải b&oacute;ng đ&aacute; nam ch&agrave;o mừng Kỷ niệm 48 năm ng&agrave;y Giải ph&oacute;ng miền Nam thống nhất đất nước (30/4/1975 &ndash; 30/4/2023), kỷ niệm 137 năm Ng&agrave;y Quốc tế Lao động 01/5 (01/5/1886 &ndash; 01/5/2023) v&agrave; kỷ niệm 133 năm Ng&agrave;y sinh Chủ tịch Hồ Ch&iacute; Minh (19/5/1890 &ndash; 19/5/2023) kết hợp tư vấn tuyển sinh tại trường.</p>', 150),
(392, 'Vinicius lập hat-trick, giúp Real cắt mạch thua', 3, 5, '<p class=\"Normal\">Sau khi rời s&acirc;n ở ph&uacute;t 20, Rodrygo phải chườm đ&aacute; ở ch&acirc;n tr&aacute;i, &ocirc;m mặt v&agrave; gục xuống. &Iacute;t ph&uacute;t sau, Militao c&ograve;n rơi v&agrave;o t&igrave;nh trạng nghi&ecirc;m trọng hơn khi chấn thương đầu gối, &ocirc;m mặt kh&oacute;c v&agrave; phải rời s&acirc;n tr&ecirc;n c&aacute;ng. Tiếng h&eacute;t của trung vệ Brazil c&oacute; thể nghe thấy r&otilde; qua truyền h&igrave;nh.</p>\r\n<p class=\"Normal\">Mất hai cầu thủ Brazil v&igrave; chấn thương, người c&ograve;n lại thay đồng đội tỏa s&aacute;ng. Ph&uacute;t 33, Bellingham chuyền xuống b&ecirc;n tr&aacute;i cấm địa cho Vinicius qua người v&agrave; s&uacute;t về g&oacute;c gần, mở tỷ số. Ngay sau b&agrave;n thắng, Quả B&oacute;ng Bạc 2024 chạy tới &ocirc;m HLV Carlo Ancelotti ở ngo&agrave;i đường bi&ecirc;n.</p>\r\n<p class=\"Normal\">Ancelotti đ&atilde; nhiều lần c&ocirc;ng khai ủng hộ Vinicius, sau khi ng&ocirc;i sao 24 tuổi&nbsp;<a href=\"https://vnexpress.net/real-va-vinicius-bi-ho-o-qua-bong-vang-4809552.html\" rel=\"dofollow\" data-itm-source=\"#vn_source=Detail-TheThao_BongDa_LaLiga-4814203&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-TruotBongVang&amp;vn_term=Desktop&amp;vn_thumb=0\" data-itm-added=\"1\">trượt B&oacute;ng V&agrave;ng</a> v&agrave;o tay Rodri. Anh cũng thể hiện bản th&acirc;n quan trọng nhất của Real hiện tại, với ch&iacute;n b&agrave;n trong s&aacute;u trận gần nhất. B&agrave;n thắng của Vinicius cũng đồng nghĩa Bellingham c&oacute; đường kiến tạo đầu ti&ecirc;n m&ugrave;a n&agrave;y.</p>\r\n<p class=\"Normal\"><a href=\"https://vnexpress.net/chu-de/jude-bellingham-5376\" rel=\"dofollow\" data-itm-source=\"#vn_source=Detail-TheThao_BongDa_LaLiga-4814203&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-Bellingham&amp;vn_term=Desktop&amp;vn_thumb=0\" data-itm-added=\"1\">Bellingham&nbsp;</a>trải qua 12 trận đầu m&ugrave;a kh&ocirc;ng ghi b&agrave;n hay kiến tạo lần n&agrave;o, nhận phải nhiều lời ch&ecirc; tr&aacute;ch. Nhưng trận n&agrave;y, tiền vệ 21 tuổi giải tỏa được tất cả. Ph&uacute;t 42, trung vệ 21 tuổi Raul Asencio phất b&oacute;ng từ phần s&acirc;n nh&agrave; xuống cấm địa cho Bellingham t&acirc;ng b&oacute;ng qua đầu thủ m&ocirc;n, n&acirc;ng tỷ số l&ecirc;n 2-0.</p>\r\n<p class=\"Normal\">Asencio 21 tuổi, nhưng đ&acirc;y mới l&agrave; trận đấu chuy&ecirc;n nghiệp đầu ti&ecirc;n của anh, sau thời gian d&agrave;i chơi cho đội trẻ m&agrave; kh&ocirc;ng được sử dụng. Cơ hội đến với anh lần n&agrave;y cũng chỉ v&igrave; Militao chấn thương, rời s&acirc;n bất đắc dĩ.</p>\r\n<p class=\"Normal\">Một cầu thủ kh&aacute;c cũng chạm cột mốc đầu ti&ecirc;n l&agrave; Andriy Lunin, khi trở th&agrave;nh thủ m&ocirc;n đầu ti&ecirc;n của Real kiến tạo một b&agrave;n thắng tại La Liga trong thế kỷ 21. Ph&uacute;t 61, sau khi bắt b&oacute;ng từ quả phạt g&oacute;c của Osasuna, anh phất d&agrave;i l&ecirc;n cho Vinicius d&ugrave;ng tốc độ vượt qua hậu vệ lẫn thủ m&ocirc;n đội kh&aacute;ch trước khi đ&aacute; v&agrave;o lưới trống.</p>', '2024-11-09 17:00:00', NULL, 1, NULL, 'vinicius-3794-1731164053.jpg', NULL, NULL, NULL, '<p>Lần thứ hai m&ugrave;a n&agrave;y, Vinicius lập hat-trick cho Real, đều tr&ecirc;n s&acirc;n Bernabeu. Bellingham cũng ghi b&agrave;n đầu ti&ecirc;n tr&ecirc;n mọi đấu trường m&ugrave;a n&agrave;y, nhưng chiến thắng của thầy tr&ograve; Carlo Ancelotti kh&ocirc;ng trọn vẹn khi Rodrygo v&agrave; trung vệ Eder Militao chấn thương rời s&acirc;n ngay trong hiệp một.</p>', NULL),
(393, 'Indonesia sở hữu hung thần của Man United, ĐT Việt Nam toát mồ hôi ở AFF Cup 2024', 3, 5, '<p>Theo đ&oacute;, cầu thủ sinh năm 1996 đ&atilde; thực hiện lễ tuy&ecirc;n thệ nhập tịch tại Đại sứ qu&aacute;n Indonesia ở Copenhagen v&agrave;o ng&agrave;y 8/11, qua đ&oacute; ch&iacute;nh thức trở th&agrave;nh c&ocirc;ng d&acirc;n Indonesia v&agrave; đủ điều kiện kho&aacute;c &aacute;o ĐT quốc gia nước n&agrave;y. Đ&aacute;ng ch&uacute; &yacute;, giữa tuần qua th&igrave; Kevin Diks đ&atilde; c&ugrave;ng Copenhagen thi đấu tại UEFA Conference League.</p>\r\n<p>Sự g&oacute;p mặt của Kevin Diks sẽ bổ sung cho h&agrave;ng ph&ograve;ng ngự to&agrave;n sau của ĐT xứ Vạn đảo. Trước đ&oacute;, HLV Shin Tae-yong đ&atilde; c&oacute; sự phục vụ của loạt sao nhập tịch, bao gồm Jordi Amat, Justin Hubner, Jay Idzes hay mới nhất l&agrave; Mees Hilgers &ndash; cầu thủ của Twente mới ho&agrave;n tất thủ tục nhập tịch th&aacute;ng 9 vừa qua.</p>\r\n<p>Tuy nhi&ecirc;n, ĐT Indonesia sẽ chưa thể sử dụng Kevin Diks cho trận đấu với ĐT Nhật Bản sắp tới ở v&ograve;ng loại thứ 3 World Cup 2026, do qu&aacute; hạn đăng k&yacute;. D&ugrave; vậy ở trận tiếp theo, ng&ocirc;i sao của Copenhagen c&oacute; thể g&oacute;p mặt khi Indonesia chạm tr&aacute;n Saudi Arabia.</p>\r\n<p>M&ugrave;a giải năm ngo&aacute;i, Kevin Diks c&ugrave;ng FC Copenhagen chạm tr&aacute;n Man United tại v&ograve;ng bảng Champions League. Sau 2 lần chạm tr&aacute;n, Copenhagen gi&agrave;nh kết quả 1 thắng, 1 thua.</p>\r\n<p>Hiện tại chưa r&otilde; khả năng Kevin Diks c&oacute; thể tham dự AFF Cup 2024 diễn ra v&agrave;o cuối năm hay kh&ocirc;ng khi đ&acirc;y l&agrave; giải đấu kh&ocirc;ng nằm trong khu&ocirc;n khổ FIFA Days. HLV Shin Tae-yong cũng đ&atilde; tiết lộ &yacute; định sử dụng c&aacute;c cầu thủ trẻ ở giải đấu v&agrave;o cuối năm.</p>\r\n<p>Theo kết quả bốc thăm AFF Cup 2024, Indonesia nằm ở bảng B c&ugrave;ng với ĐT Việt Nam, Philippines, Myanmar v&agrave; L&agrave;o. Đo&agrave;n qu&acirc;n được dẫn dắt bởi HLV Kim Sang-sik đặt mục ti&ecirc;u v&agrave;o chơi ở trận Chung kết.</p>', '2024-11-09 17:00:00', NULL, 1, NULL, 'Indonesia-so-huu-hung-than-cua-Man-United-DT-Viet-Nam-toat-mo-hoi-o-AFF-Cup-2024_1.webp', NULL, NULL, NULL, '<p>Ngay trước thềm AFF Cup 2024 th&igrave; đội tuyển Indonesia tiếp tục c&oacute; một sự bổ sung rất chất lượng trong đội h&igrave;nh khi họ nhập tịch th&agrave;nh c&ocirc;ng trung vệ Kevin Diks, cầu thủ từng đối đầu với Manchester United.</p>', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproductcategory`
--

CREATE TABLE `tblproductcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblproductcategory`
--

INSERT INTO `tblproductcategory` (`id`, `name`, `description`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(1, 'Phụ kiện Bóng Đá', '', NULL, '2024-07-23 16:07:35', NULL, '2024-07-24 15:31:58'),
(2, 'Phụ kiện Cầu Lông', '', NULL, '2024-07-24 13:25:36', NULL, '2024-07-24 15:31:48'),
(3, 'Phụ Kiện Bóng Rổ', '', NULL, '2024-07-24 15:31:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` blob DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `name`, `description`, `price`, `quantity`, `category_id`, `image_url`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(1, 'Giày đá banh Nike M2', 'Size 39, 40, 41, 42, 43, 44', 1600000.00, NULL, 1, 'giaynk1.png', NULL, '2024-07-23 16:08:33', NULL, '2024-07-24 14:51:06'),
(2, 'Giày đá banh Nike ', 'Size 39, 40, 41, 42, 43, 44', 1500000.00, NULL, 1, 'giaynk2.png', NULL, '2024-07-24 13:54:41', NULL, '2024-07-24 14:50:29'),
(3, 'Giày đá banh Nike Sport N1', 'Size 39, 40, 41, 42, 43, 44', 1550000.00, NULL, 1, 'giaynk3.png', NULL, '2024-07-24 13:59:30', NULL, '2024-07-24 14:51:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblrejectmatch`
--

CREATE TABLE `tblrejectmatch` (
  `rejectid` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `HomeTeam` int(11) NOT NULL,
  `AwayTeam` int(11) NOT NULL,
  `idfm` int(11) NOT NULL,
  `BookingDate` date NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SubCatDescription` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 5, 'Bollywood ', 'Bollywood masala', '2024-01-14 18:30:00', '2024-01-31 05:48:30', 1),
(4, 3, 'Bóng gậy', 'Bóng gậy\r\n', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(5, 3, 'Bóng đá', 'Bóng đá', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(6, 5, 'Truyền hình', 'Truyền hình', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(7, 6, 'Trong nước', 'Trong nước', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(8, 6, 'Quốc tế', 'Quốc tế', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsubscribers`
--

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblsubscribers`
--

INSERT INTO `tblsubscribers` (`id`, `SubscriberEmail`, `PostingDate`) VALUES
(4, 'harish@gmail.com', '2024-06-01 09:26:21'),
(5, 'kunal@gmail.com', '2024-05-31 09:35:07'),
(6, 'sdfsdf@gmail.com', '2024-06-22 15:04:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblteams`
--

CREATE TABLE `tblteams` (
  `TeamID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TeamName` varchar(100) NOT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Rank` int(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `MemberCount` int(11) DEFAULT NULL,
  `FlagImage` varchar(100) DEFAULT NULL,
  `FlagName` varchar(100) DEFAULT NULL,
  `GroupTeam` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblteams`
--

INSERT INTO `tblteams` (`TeamID`, `CustomerID`, `TeamName`, `Country`, `Rank`, `Address`, `Phone`, `Email`, `MemberCount`, `FlagImage`, `FlagName`, `GroupTeam`) VALUES
(11, 16, 'Oanh Đi Lâm', NULL, 2, 'Ấp Giồng Tranh- Xã Tập Ngãi- huyện Tiểu Cần- Tỉnh Trà Vinh', '0967976564', 'oanhdii@gmail.com', NULL, 'https://flagcdn.com/60x45/ag.png', 'Antigua and Barbuda', NULL),
(12, 17, 'Ninh', NULL, 1, 'Ấp Giồng Tranh- Xã Tập Ngãi- huyện Tiểu Cần- Tỉnh Trà Vinh', '0967976564', 'ninh@gmail.com', NULL, 'https://flagcdn.com/60x45/ar.png', 'Argentina', NULL),
(13, 18, 'Oanh Đi', NULL, 2, 'Tiểu Cần - Trà Vinh', '0967976564', 'di@gmail.com', NULL, 'https://flagcdn.com/60x45/vn.png', 'Vietnam', NULL),
(14, 19, 'Hoàng Phúc', NULL, 2, 'Phường 5 - Tp. Trà Vinh', '0486178132', 'phuc@gmail.com', NULL, 'https://flagcdn.com/60x45/mf.png', 'Saint Martin', NULL),
(15, 20, 'Tiểu Cần', NULL, 1, 'Tiểu Cần - Trà Vinh', '0897234891', 'tieucan@gmail.com', NULL, 'https://flagcdn.com/60x45/cy.png', 'Cyprus', NULL),
(16, 20, 'Tiểu Cần', NULL, 1, 'Tiểu Cần - Trà Vinh', '0897234891', 'tieucan@gmail.com', NULL, 'https://flagcdn.com/60x45/cy.png', 'Cyprus', NULL),
(17, 22, 'Cẩm Ly', NULL, 5, 'Cầu Kè - Trà Vinh', '0392781632', 'camly@gmail.com', NULL, 'https://flagcdn.com/60x45/jp.png', 'Japan', NULL),
(18, 23, 'Cầu Kè', NULL, 2, 'Cầu Kè - Trà Vinh', '0918928289', 'cauke@gmail.com', NULL, 'https://flagcdn.com/60x45/ax.png', 'Åland Islands', NULL),
(19, 24, 'Cầu Ngang', NULL, 2, 'Cầu Ngang - Trà Vinh', '0819808116', 'caungang@gmail.com', NULL, 'https://flagcdn.com/60x45/gn.png', 'Guinea', NULL),
(20, 25, 'Khmer', NULL, 3, 'Trà Vinh', '0891812791', 'khmer@gmail.com', NULL, 'https://flagcdn.com/60x45/kh.png', 'Cambodia', NULL),
(21, 26, 'Càng Long', NULL, 1, 'Càng Long - Trà Vinh', '0781456816', 'canglong@gmail.com', NULL, 'https://flagcdn.com/60x45/fi.png', 'Finland', NULL),
(22, 27, 'Thanh Hiền', NULL, 5, 'Châu Thành - Trà Vinh', '0975448616', 'hien@gmail.com', NULL, 'https://flagcdn.com/60x45/pt.png', 'Portugal', NULL),
(23, 20, 'Tiểu Cần', NULL, 1, 'Tiểu Cần - Trà Vinh', '081896888', 'tieucan@gmail.com', NULL, 'https://flagcdn.com/60x45/us-il.png', 'Illinois', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Testimonial` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltestimonial`
--

INSERT INTO `tbltestimonial` (`id`, `UserEmail`, `Testimonial`, `PostingDate`, `status`) VALUES
(2, 'OanhDi@gmail.com', 'Oanh Đi - Sinh Viên Khoa KTCN', '2024-06-22 15:16:22', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltimematch`
--

CREATE TABLE `tbltimematch` (
  `idtm` int(11) NOT NULL,
  `NameMatch` varchar(50) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltimematch`
--

INSERT INTO `tbltimematch` (`idtm`, `NameMatch`, `StartTime`, `EndTime`) VALUES
(1, '7 Giờ', '07:00:00', '07:59:59'),
(2, '8 Giờ', '08:00:00', '08:59:59'),
(3, '9 Giờ', '09:00:00', '09:59:59'),
(4, '10 Giờ', '10:00:00', '10:59:59'),
(5, '11 Giờ ', '11:00:00', '11:59:59'),
(6, '12 Giờ ', '12:00:00', '12:59:59'),
(7, '13 Giờ', '13:00:00', '13:59:59'),
(8, '14 Giờ', '14:00:00', '14:59:59'),
(9, '15 Giờ', '15:00:00', '15:59:59'),
(10, '16 Giờ', '16:00:00', '16:59:00'),
(11, '17 Giờ', '17:00:00', '17:59:59'),
(12, '18 Giờ', '18:00:00', '18:59:59'),
(13, '19 Giờ', '19:00:00', '19:59:59'),
(14, '20 Giờ', '20:00:00', '20:59:59'),
(15, '21 Giờ', '21:00:00', '21:59:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `FullName` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailId` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ContactNo` char(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(100) CHARACTER SET utf16 COLLATE utf16_unicode_ci DEFAULT NULL,
  `Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblusers`
--

INSERT INTO `tblusers` (`id`, `CustomerID`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(13, 16, 'Oanh Đi Lâm', 'oanhdii@gmail.com', '202cb962ac59075b964b07152d234b70', '0967976564', NULL, NULL, NULL, NULL, '2024-11-09 15:23:15', NULL),
(14, 17, 'Ninh', 'ninh@gmail.com', '202cb962ac59075b964b07152d234b70', '0967976564', NULL, NULL, NULL, NULL, '2024-11-09 15:27:08', NULL),
(15, 18, 'Oanh Đi', 'di@gmail.com', '202cb962ac59075b964b07152d234b70', '0967976564', NULL, NULL, NULL, NULL, '2024-11-09 19:17:38', NULL),
(16, 19, 'Hoàng Phúc', 'phuc@gmail.com', '202cb962ac59075b964b07152d234b70', '0486178132', NULL, NULL, NULL, NULL, '2024-11-09 19:20:36', NULL),
(19, 22, 'Cẩm Ly', 'camly@gmail.com', '202cb962ac59075b964b07152d234b70', '0392781632', NULL, NULL, NULL, NULL, '2024-11-09 19:25:42', NULL),
(20, 23, 'Cầu Kè', 'cauke@gmail.com', '202cb962ac59075b964b07152d234b70', '0918928289', NULL, NULL, NULL, NULL, '2024-11-09 19:29:57', NULL),
(21, 24, 'Cầu Ngang', 'caungang@gmail.com', '202cb962ac59075b964b07152d234b70', '0819808116', NULL, NULL, NULL, NULL, '2024-11-09 19:30:48', NULL),
(22, 25, 'Khmer', 'khmer@gmail.com', '202cb962ac59075b964b07152d234b70', '0891812791', NULL, NULL, NULL, NULL, '2024-11-09 19:31:42', NULL),
(23, 26, 'Càng Long', 'canglong@gmail.com', '202cb962ac59075b964b07152d234b70', '0781456816', NULL, NULL, NULL, NULL, '2024-11-09 19:32:33', NULL),
(24, 27, 'Thanh Hiền', 'hien@gmail.com', '202cb962ac59075b964b07152d234b70', '0975448616', NULL, NULL, NULL, NULL, '2024-11-09 19:36:58', NULL),
(25, 20, 'Tiểu Cần', 'tieucan@gmail.com', '202cb962ac59075b964b07152d234b70', '081896888', NULL, NULL, NULL, NULL, '2024-11-09 20:14:28', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblwarehouses`
--

CREATE TABLE `tblwarehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblwarehouses`
--

INSERT INTO `tblwarehouses` (`id`, `name`, `location`, `create_by`, `create_date`, `last_update`) VALUES
(1, 'Kho Cơ Sở Vật Chất Khu I', 'Trường ĐHTV Khu 1', '', '2024-07-22 14:20:04', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblbanners`
--
ALTER TABLE `tblbanners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `tblbookings_ibfk_1` (`CustomerID`);

--
-- Chỉ mục cho bảng `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Chỉ mục cho bảng `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcountryalpha`
--
ALTER TABLE `tblcountryalpha`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `Email` (`Email`);

--
-- Chỉ mục cho bảng `tblcustomertype`
--
ALTER TABLE `tblcustomertype`
  ADD PRIMARY KEY (`CustomerTypeID`);

--
-- Chỉ mục cho bảng `tbldiscount`
--
ALTER TABLE `tbldiscount`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbldrink`
--
ALTER TABLE `tbldrink`
  ADD PRIMARY KEY (`DrinkID`);

--
-- Chỉ mục cho bảng `tbldrinkorder`
--
ALTER TABLE `tbldrinkorder`
  ADD PRIMARY KEY (`DrinkOrderID`);

--
-- Chỉ mục cho bảng `tbldrinkorderline`
--
ALTER TABLE `tbldrinkorderline`
  ADD PRIMARY KEY (`DrinkOrderLineID`),
  ADD KEY `frk_drinkorder_id` (`DrinkOrderID`),
  ADD KEY `frk_drink_id` (`DrinkID`);

--
-- Chỉ mục cho bảng `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `PositionTypeID` (`PositionTypeID`);

--
-- Chỉ mục cho bảng `tblfacility_inventory`
--
ALTER TABLE `tblfacility_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frk_facilytype_id` (`facility_type_id`),
  ADD KEY `frk_ware_id` (`warehouse_id`);

--
-- Chỉ mục cho bảng `tblfacility_status`
--
ALTER TABLE `tblfacility_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblfacility_types`
--
ALTER TABLE `tblfacility_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblfieldmatch`
--
ALTER TABLE `tblfieldmatch`
  ADD PRIMARY KEY (`idfm`);

--
-- Chỉ mục cho bảng `tblfields`
--
ALTER TABLE `tblfields`
  ADD PRIMARY KEY (`FieldID`),
  ADD KEY `FieldTypeID` (`FieldTypeID`);

--
-- Chỉ mục cho bảng `tblfieldtypes`
--
ALTER TABLE `tblfieldtypes`
  ADD PRIMARY KEY (`FieldTypeID`);

--
-- Chỉ mục cho bảng `tblmatches`
--
ALTER TABLE `tblmatches`
  ADD PRIMARY KEY (`MatchID`),
  ADD KEY `frk_bookk_id` (`BookingID`);

--
-- Chỉ mục cho bảng `tblmatchpayments`
--
ALTER TABLE `tblmatchpayments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `MatchID` (`MatchID`);

--
-- Chỉ mục cho bảng `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblorderdetails`
--
ALTER TABLE `tblorderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frk_oder_id` (`order_id`),
  ADD KEY `frk_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblplayers`
--
ALTER TABLE `tblplayers`
  ADD PRIMARY KEY (`PlayerID`),
  ADD KEY `TeamID` (`TeamID`);

--
-- Chỉ mục cho bảng `tblpositiontypes`
--
ALTER TABLE `tblpositiontypes`
  ADD PRIMARY KEY (`PositionTypeID`);

--
-- Chỉ mục cho bảng `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `postsucatid` (`SubCategoryId`),
  ADD KEY `subadmin` (`postedBy`);

--
-- Chỉ mục cho bảng `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblrejectmatch`
--
ALTER TABLE `tblrejectmatch`
  ADD PRIMARY KEY (`rejectid`),
  ADD KEY `fkr_book_id` (`BookingID`);

--
-- Chỉ mục cho bảng `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`),
  ADD KEY `catid` (`CategoryId`);

--
-- Chỉ mục cho bảng `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblteams`
--
ALTER TABLE `tblteams`
  ADD PRIMARY KEY (`TeamID`);

--
-- Chỉ mục cho bảng `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltimematch`
--
ALTER TABLE `tbltimematch`
  ADD PRIMARY KEY (`idtm`);

--
-- Chỉ mục cho bảng `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Chỉ mục cho bảng `tblwarehouses`
--
ALTER TABLE `tblwarehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblbanners`
--
ALTER TABLE `tblbanners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tblbookings`
--
ALTER TABLE `tblbookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT cho bảng `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tblcountryalpha`
--
ALTER TABLE `tblcountryalpha`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=581;

--
-- AUTO_INCREMENT cho bảng `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `tblcustomertype`
--
ALTER TABLE `tblcustomertype`
  MODIFY `CustomerTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbldiscount`
--
ALTER TABLE `tbldiscount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbldrink`
--
ALTER TABLE `tbldrink`
  MODIFY `DrinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbldrinkorder`
--
ALTER TABLE `tbldrinkorder`
  MODIFY `DrinkOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT cho bảng `tbldrinkorderline`
--
ALTER TABLE `tbldrinkorderline`
  MODIFY `DrinkOrderLineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT cho bảng `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tblfacility_inventory`
--
ALTER TABLE `tblfacility_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tblfacility_status`
--
ALTER TABLE `tblfacility_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblfacility_types`
--
ALTER TABLE `tblfacility_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tblfieldmatch`
--
ALTER TABLE `tblfieldmatch`
  MODIFY `idfm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT cho bảng `tblfields`
--
ALTER TABLE `tblfields`
  MODIFY `FieldID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tblfieldtypes`
--
ALTER TABLE `tblfieldtypes`
  MODIFY `FieldTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblmatches`
--
ALTER TABLE `tblmatches`
  MODIFY `MatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `tblmatchpayments`
--
ALTER TABLE `tblmatchpayments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT cho bảng `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tblorderdetails`
--
ALTER TABLE `tblorderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tblpositiontypes`
--
ALTER TABLE `tblpositiontypes`
  MODIFY `PositionTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT cho bảng `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tblrejectmatch`
--
ALTER TABLE `tblrejectmatch`
  MODIFY `rejectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tblteams`
--
ALTER TABLE `tblteams`
  MODIFY `TeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbltimematch`
--
ALTER TABLE `tbltimematch`
  MODIFY `idtm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `tblwarehouses`
--
ALTER TABLE `tblwarehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD CONSTRAINT `tblbookings_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `tblcustomers` (`CustomerID`);

--
-- Các ràng buộc cho bảng `tbldrinkorderline`
--
ALTER TABLE `tbldrinkorderline`
  ADD CONSTRAINT `frk_drink_id` FOREIGN KEY (`DrinkID`) REFERENCES `tbldrink` (`DrinkID`),
  ADD CONSTRAINT `frk_drinkorder_id` FOREIGN KEY (`DrinkOrderID`) REFERENCES `tbldrinkorder` (`DrinkOrderID`);

--
-- Các ràng buộc cho bảng `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD CONSTRAINT `tblemployees_ibfk_1` FOREIGN KEY (`PositionTypeID`) REFERENCES `tblpositiontypes` (`PositionTypeID`);

--
-- Các ràng buộc cho bảng `tblfacility_inventory`
--
ALTER TABLE `tblfacility_inventory`
  ADD CONSTRAINT `frk_facilytype_id` FOREIGN KEY (`facility_type_id`) REFERENCES `tblfacility_types` (`id`),
  ADD CONSTRAINT `frk_ware_id` FOREIGN KEY (`warehouse_id`) REFERENCES `tblwarehouses` (`id`);

--
-- Các ràng buộc cho bảng `tblfields`
--
ALTER TABLE `tblfields`
  ADD CONSTRAINT `tblfields_ibfk_1` FOREIGN KEY (`FieldTypeID`) REFERENCES `tblfieldtypes` (`FieldTypeID`);

--
-- Các ràng buộc cho bảng `tblmatches`
--
ALTER TABLE `tblmatches`
  ADD CONSTRAINT `frk_bookk_id` FOREIGN KEY (`BookingID`) REFERENCES `tblbookings` (`BookingID`);

--
-- Các ràng buộc cho bảng `tblmatchpayments`
--
ALTER TABLE `tblmatchpayments`
  ADD CONSTRAINT `tblmatchpayments_ibfk_1` FOREIGN KEY (`MatchID`) REFERENCES `tblmatches` (`MatchID`);

--
-- Các ràng buộc cho bảng `tblorderdetails`
--
ALTER TABLE `tblorderdetails`
  ADD CONSTRAINT `frk_oder_id` FOREIGN KEY (`order_id`) REFERENCES `tblorder` (`id`),
  ADD CONSTRAINT `frk_product_id` FOREIGN KEY (`product_id`) REFERENCES `tblproducts` (`id`);

--
-- Các ràng buộc cho bảng `tblplayers`
--
ALTER TABLE `tblplayers`
  ADD CONSTRAINT `tblplayers_ibfk_1` FOREIGN KEY (`TeamID`) REFERENCES `tblteams` (`TeamID`);

--
-- Các ràng buộc cho bảng `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `frk_category_id` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`),
  ADD CONSTRAINT `frk_subcate_id` FOREIGN KEY (`SubCategoryId`) REFERENCES `tblsubcategory` (`SubCategoryId`);

--
-- Các ràng buộc cho bảng `tblrejectmatch`
--
ALTER TABLE `tblrejectmatch`
  ADD CONSTRAINT `fkr_book_id` FOREIGN KEY (`BookingID`) REFERENCES `tblbookings` (`BookingID`);

--
-- Các ràng buộc cho bảng `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD CONSTRAINT `frk_cato_id` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`);

DELIMITER $$
--
-- Sự kiện
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old_bookings` ON SCHEDULE EVERY 15 MINUTE STARTS '2024-11-09 22:47:35' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM tblbookings
  WHERE DATE_ADD(CreateDate, INTERVAL 2 HOUR) > NOW()
    AND STATUS = 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
