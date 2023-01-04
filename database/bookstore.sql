-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 04, 2023 lúc 08:50 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT 0,
  `created` date DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified` date DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(1, 'Admin', 0, '2022-10-18', 1, '2022-12-23', 10, '1', '11'),
(2, 'Manager', 1, '2022-10-05', NULL, '2022-10-13', NULL, '0', '8'),
(3, 'Member', 0, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(4, 'Register', 1, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(5, 'Manage 1', 0, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(6, 'Admin 1', 1, '2022-10-18', 1, '2022-10-13', 1, '0', '10'),
(7, 'Admin 2', 0, '2022-10-05', NULL, '2022-10-13', NULL, '0', '8'),
(8, 'Manage 1', 0, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(9, 'Manage 2', 1, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(10, 'Admin 1', 1, '2022-10-18', 1, '2022-10-13', 1, '1', '10'),
(56, 'Admin 2', 0, '2022-10-05', NULL, '2022-10-13', NULL, '1', '22'),
(57, 'Manage 1', 0, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(64, 'fouder 03', 1, '2022-12-22', 1, '2022-12-22', NULL, '1', '6'),
(65, 'fouder 03', 1, '2022-12-22', 1, '2022-12-22', NULL, '1', '10'),
(66, 'fouder 03', 1, '2022-12-23', 1, '2022-12-23', NULL, '1', NULL),
(67, 'fouder 01', 1, '2022-12-23', 1, '2022-12-23', 10, '0', '5'),
(68, 'fouder 03', 1, '2022-12-31', 1, '2022-12-31', NULL, '1', NULL),
(69, 'fouder 03', 1, '2022-12-31', 1, '2022-12-31', NULL, '1', NULL),
(70, 'fouder 05', 1, '2022-12-31', 1, '2022-12-31', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `group_id`) VALUES
(1, 'nva', 'nva@gmail.com', 'Nguyễn Văn A', '12345', '2022-12-28 10:04:00', 1, '2022-12-28 01:00:00', 2, 1, 10, 1),
(2, 'nvb', 'nvb@gmail.com', 'Nguyễn Văn B', '12345', '2022-12-28 02:55:00', 2, '2022-12-28 00:00:00', 1, 0, 10, 2),
(3, 'nvc', 'nvc@gmail.com', 'Nguyễn Văn C', '12345', '2022-12-28 08:55:00', 1, '2023-01-04 00:00:00', 10, 1, 10, 3),
(4, 'admin', 'admin@gmail.com', 'Admin', '12345', '2022-12-28 00:00:00', 2, '2022-12-28 00:00:00', 1, 0, 10, 4),
(5, 'nva01', 'nva@gmail.com', 'Nguyễn Văn A', '12345', '2022-12-28 10:04:00', 1, '2022-12-28 01:00:00', 2, 1, 10, 1),
(6, 'nvb01', 'nvb@gmail.com', 'Nguyễn Văn B', '12345', '2022-12-28 02:55:00', 2, '2022-12-28 00:00:00', 1, 0, 10, 2),
(7, 'nvc01', 'nvc@gmail.com', 'Nguyễn Văn C', '12345', '2022-12-28 08:55:00', 1, '2022-12-28 00:00:00', 2, 1, 10, 3),
(8, 'admin', 'admin@gmail.com', 'Admin', '12345', '2022-12-28 00:00:00', 2, '2022-12-28 00:00:00', 1, 0, 10, 4);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
