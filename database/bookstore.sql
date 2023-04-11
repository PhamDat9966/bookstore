-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 11, 2023 lúc 06:01 PM
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
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `sale_off` int(3) DEFAULT 0,
  `picture` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT current_timestamp(),
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `created` date DEFAULT current_timestamp(),
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date DEFAULT current_timestamp(),
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(21, 'Bà Mẹ - Em Bé', 'fd8bvqwt.jpg', '2023-03-30', '1', '2023-04-11', '1', 1, 1),
(22, 'Chính Trị - Pháp Luật', 'v9zusgh6.jpg', '2023-03-30', '5', '0000-00-00', '1', 1, 2),
(23, 'Học Ngoại Ngữ', 'wqz91l0d.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 3),
(24, 'Công Nghệ Thông Tin', 'buo4dk2t.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 4),
(25, 'Giáo Khoa - Giáo Trình', 'g1arq6h5.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 5),
(26, 'Triếc Học', '08tgxj9s.png', '2023-03-30', '1', '2023-03-30', NULL, 1, 6),
(27, 'Self Help', 'n3o1p82j.jpg', '2023-03-31', '1', '2023-04-11', '1', 0, 7),
(28, 'Tiểu Sử - Hồi ký', '7p15v6x4.jpg', '2023-03-31', '1', '2023-03-31', NULL, 1, 8),
(29, 'Kinh Tế', 'g9u8z3mj.jpg', '2023-03-31', '1', '0000-00-00', '1', 1, 9),
(30, 'Tâm Lý - Kỹ Năng Sống', '4ouje3ln.jpg', '2023-03-31', '1', '0000-00-00', '1', 1, 10),
(31, 'test001', 'sbxngarw.jpg', '2023-04-11', '1', '0000-00-00', '1', 1, 11),
(32, 'test002', 'dr9ivkhb.jpg', '2023-04-11', '1', '2023-04-11', NULL, 1, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT 0,
  `created` date DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modified` date DEFAULT current_timestamp(),
  `modified_by` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `ordering` varchar(45) DEFAULT NULL,
  `privilege_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`) VALUES
(1, 'Admin', 1, '2022-10-18', '1', '2023-01-11', '1', '1', '11', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17'),
(2, 'Manager', 1, '2022-10-05', '1', '2023-03-30', '', '1', '10', '1,2,3,4,6,7,8,9,10'),
(3, 'Member', 1, '2022-10-08', NULL, '2023-01-11', '1', '0', '11', '1'),
(4, 'Register', 0, '2022-10-08', NULL, '2023-03-30', '1', '1', '13', ''),
(75, 'founder 01', 1, '2023-03-30', '', '2023-03-30', NULL, '1', NULL, ''),
(76, 'founder 02', 0, '2023-03-30', '1', '2023-03-30', NULL, '0', NULL, ''),
(77, 'founder 03', 1, '2023-04-04', '1', '2023-04-04', NULL, '1', NULL, ''),
(78, 'founder 04', 1, '2023-04-04', '1', '2023-04-04', NULL, '1', NULL, ''),
(79, 'founder 05', 1, '2023-03-30', '', '2023-03-30', NULL, '1', NULL, ''),
(80, 'founder 06', 0, '2023-03-30', '1', '2023-03-30', NULL, '0', NULL, ''),
(81, 'founder 07', 1, '2023-04-04', '1', '2023-04-04', NULL, '1', NULL, ''),
(82, 'founder 08', 1, '2023-04-04', '1', '2023-04-04', NULL, '1', NULL, ''),
(83, 'fouder 9999', 1, '2023-04-11', '1', '2023-04-11', NULL, '1', NULL, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách người dùng', 'backend', 'user', 'list'),
(2, 'Thay đổi status của người dùng', 'backend', 'user', 'status'),
(3, 'Cập nhật thông tin người dùng', 'backend', 'user', 'form'),
(4, 'Thay đổi status của người dùng sử dụng Ajax', 'backend', 'user', 'ajaxUserStatus'),
(5, 'Xoá một hoặc nhiều người dùng', 'backend', 'user', 'delete'),
(6, 'Thay đổi vị trí hiển thị của các người dùng', 'backend', 'user', 'ordering'),
(7, 'Truy cập menu Admin Control Panel', 'backend', 'index', 'index'),
(8, 'Đăng nhập Admin Control Panel', 'backend', 'index', 'login'),
(9, 'Đăng xuất Admin Control Panel', 'backend', 'index', 'logout'),
(10, 'Cập nhật thông tin tài khoảng quản trị', 'backend', 'index', 'profile'),
(11, 'Xoá một hoặc nhiều người dùng với Bulk', 'backend', 'user', 'deleteMult'),
(12, 'Chọn Group cho User thông qua selectBox', 'backend', 'user', 'selectGroupForUser'),
(13, 'Hiển thị danh sách group', 'backend', 'group', 'list'),
(14, 'Cập nhật thông tin group', 'backend', 'group', 'form'),
(15, 'Xoá một group', 'backend', 'group', 'delete'),
(16, 'Thay đổi status của group sử dụng Ajax', 'backend', 'group', 'ajaxStatus'),
(17, 'Thay đổi groupACP của group sử dụng Ajax', 'backend', 'group', 'ajaxGroupACP');

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
  `created_by` varchar(25) DEFAULT NULL,
  `modified` datetime DEFAULT current_timestamp(),
  `modified_by` varchar(25) DEFAULT NULL,
  `register_date` datetime DEFAULT current_timestamp(),
  `register_ip` varchar(25) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `group_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '12345', '2022-12-28 00:00:00', '1', '2023-03-21 09:44:19', '1', '2023-02-25 14:39:22', NULL, 1, 10, 1),
(2, 'manager', 'manager@gmail.com', 'Manager', '12345', '2022-12-28 02:55:00', '5', '2023-03-09 03:39:47', '5', '2023-02-25 14:39:22', NULL, 0, 10, 2),
(3, 'member', 'member@gmail.com', 'Member', '12345', '2022-12-28 08:55:00', '1', '2023-03-09 08:46:07', '1', '2023-02-25 14:39:22', NULL, 0, 10, 3),
(4, 'register', 'register@gmail.com', 'Register', '12345', '2022-12-28 10:04:00', '5', '2023-04-03 12:10:08', '1', '2023-02-25 14:39:22', NULL, 0, 10, 4),
(5, 'nguyenvana', 'nguyenvana@gmail.com', 'Nguyen Van A123', '12345', '2023-02-07 07:42:54', '1', '2023-03-21 09:37:02', '1', '2023-02-25 14:39:22', NULL, 1, 10, 1),
(35, 'nguyenvanb', 'nguyenvanb@gmail.com', 'Nguyen Van B', '12345', '2023-02-25 22:33:16', NULL, '2023-03-11 09:39:04', '1', '2023-02-25 16:02:16', '::1', 1, 10, 4),
(36, 'nguyenvanaa', 'nguyenvanaa123@gmail.com', 'Nguyen Van A', '12345', '2023-02-25 22:38:31', NULL, '2023-02-25 22:38:31', NULL, '2023-02-25 16:02:31', '::1', 0, 10, 4),
(41, 'fouder01', 'phamdat9966@gmail.com', 'admin123', '123456', '2023-03-18 08:12:00', '2', '2023-03-18 14:12:00', NULL, '2023-03-18 14:12:00', NULL, 0, 10, 4),
(42, 'fouder02', 'phamdat999666@gmail.com', 'admin123', '123456', '2023-03-18 08:12:00', '2', '2023-03-18 14:12:00', NULL, '2023-03-18 14:12:00', NULL, 0, 10, 3),
(49, 'nguyenvana1234', 'phamdat9999966666@gmail.com', 'PhamDat', '123456', '2023-04-11 05:54:32', '1', '2023-04-11 22:54:32', NULL, '2023-04-11 22:54:32', NULL, 1, 10, 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `privilege`
--
ALTER TABLE `privilege`
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
-- AUTO_INCREMENT cho bảng `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
