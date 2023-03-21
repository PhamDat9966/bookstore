-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 04:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
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
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(10, 'test001', NULL, '2023-03-21', 'admin', '2023-03-21', 'manager', 1, 10),
(12, 'test002', NULL, '2023-03-21', 'manager', '2023-03-21', NULL, 1, 10),
(13, 'test003', NULL, '2023-03-21', 'manager', '2023-03-21', NULL, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `group`
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
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`) VALUES
(1, 'Admin', 1, '2022-10-18', 'admin', '2023-01-11', 'admin', '1', '11', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17'),
(2, 'Manager', 1, '2022-10-05', 'admin', '2022-10-13', 'nguyenvana', '1', '10', '1,2,3,4,6,7,8,9,10'),
(3, 'Member', 0, '2022-10-08', NULL, '2023-01-11', 'admin', '1', '11', '1'),
(4, 'Register', 0, '2022-10-08', NULL, '2023-03-11', 'admin', '1', '13', '');

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
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
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `group_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '12345', '2022-12-28 00:00:00', '1', '2023-03-11 08:37:20', '1', '2023-02-25 14:39:22', NULL, 1, 10, 1),
(2, 'manager', 'manager@gmail.com', 'Manager', '12345', '2022-12-28 02:55:00', '5', '2023-03-09 03:39:47', '5', '2023-02-25 14:39:22', NULL, 0, 10, 2),
(3, 'member', 'member@gmail.com', 'Member', '12345', '2022-12-28 08:55:00', '1', '2023-03-09 08:46:07', '1', '2023-02-25 14:39:22', NULL, 0, 10, 3),
(4, 'register', 'register@gmail.com', 'Register', '12345', '2022-12-28 10:04:00', '5', '2023-03-11 08:57:58', '5', '2023-02-25 14:39:22', NULL, 0, 10, 4),
(5, 'nguyenvana', 'nguyenvana@gmail.com', 'Nguyen Van A123', '12345', '2023-02-07 07:42:54', '1', '2023-03-11 08:52:17', '5', '2023-02-25 14:39:22', NULL, 1, 10, 4),
(35, 'nguyenvanb', 'nguyenvanb@gmail.com', 'Nguyen Van B', '12345', '2023-02-25 22:33:16', NULL, '2023-03-11 09:39:04', '1', '2023-02-25 16:02:16', '::1', 1, 10, 4),
(36, 'nguyenvanaa', 'nguyenvanaa123@gmail.com', 'Nguyen Van A', '12345', '2023-02-25 22:38:31', NULL, '2023-02-25 22:38:31', NULL, '2023-02-25 16:02:31', '::1', 0, 10, 0),
(41, 'fouder01', 'phamdat9966@gmail.com', 'admin123', '123456', '2023-03-18 08:12:00', '2', '2023-03-18 14:12:00', NULL, '2023-03-18 14:12:00', NULL, 0, 10, 4),
(42, 'fouder02', 'phamdat999666@gmail.com', 'admin123', '123456', '2023-03-18 08:12:00', '2', '2023-03-18 14:12:00', NULL, '2023-03-18 14:12:00', NULL, 0, 10, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
