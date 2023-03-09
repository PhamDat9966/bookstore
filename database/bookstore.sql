-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 08:49 AM
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
-- Table structure for table `group`
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
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(1, 'Admin', 1, '2022-10-18', 1, '2023-01-11', 10, '1', '11'),
(2, 'Manager', 1, '2022-10-05', NULL, '2022-10-13', NULL, '1', '10'),
(3, 'Member', 0, '2022-10-08', NULL, '2023-01-11', 10, '1', '11'),
(4, 'Register', 0, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(5, 'Manage 1', 0, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(6, 'Admin 1', 1, '2022-10-18', 1, '2022-10-13', 1, '0', '10'),
(7, 'Admin 2', 1, '2022-10-05', NULL, '2022-10-13', NULL, '0', '8'),
(8, 'Manage 1', 0, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(9, 'Manage 2', 0, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(10, 'Admin 1', 0, '2022-10-18', 1, '2022-10-13', 1, '1', '10'),
(56, 'Admin123', 1, '2022-10-05', NULL, '2023-02-06', 10, '0', '22'),
(57, 'Manage 1', 0, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(64, 'fouder 03', 0, '2022-12-22', 1, '2022-12-22', NULL, '0', '6'),
(65, 'fouder 03', 1, '2022-12-22', 1, '2022-12-22', NULL, '1', '10');

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
(1, 'admin', 'admin@gmail.com', 'admin', '12345', '2022-12-28 00:00:00', '1', '2023-03-09 07:57:13', '1', '2023-02-25 14:39:22', NULL, 1, 10, 1),
(2, 'nvb', 'nvb@gmail.com', 'PhamDat', '12345', '2022-12-28 02:55:00', '5', '2023-03-09 03:39:47', '1', '2023-02-25 14:39:22', NULL, 0, 10, 4),
(3, 'nvc', 'nvc@gmail.com', 'PhamDat', '12345', '2022-12-28 08:55:00', '1', '2023-03-09 08:46:07', '5', '2023-02-25 14:39:22', NULL, 1, 10, 3),
(4, 'nva', 'nva@gmail.com', 'Nguyễn Văn A', '12345', '2022-12-28 10:04:00', '1', '2023-03-09 08:20:43', '5', '2023-02-25 14:39:22', NULL, 0, 10, 3),
(5, 'nguyenvana', 'nguyenvana@gmail.com', 'Nguyen Van A123', '12345', '2023-02-07 07:42:54', '5', '2023-03-09 03:41:00', '5', '2023-02-25 14:39:22', NULL, 1, 10, 1),
(35, 'nguyenvanb', 'nguyenvanb@gmail.com', 'Nguyen Van B', '12345', '2023-02-25 22:33:16', NULL, '2023-02-25 22:33:16', NULL, '2023-02-25 16:02:16', '::1', 0, 10, 0),
(36, 'nguyenvanaa', 'nguyenvanaa@gmail.com', 'Nguyen Van A', '12345', '2023-02-25 22:38:31', NULL, '2023-02-25 22:38:31', NULL, '2023-02-25 16:02:31', '::1', 0, 10, 0),
(37, 'nguyenvana1', 'nguyenvana1@gmail.com', 'Nguyen Van A1', '12345', '2023-02-25 22:44:13', NULL, '2023-02-25 22:44:13', NULL, '2023-02-25 16:02:13', '::1', 0, 10, 0),
(38, 'admin123123123', 'phamdat9966@gmail.com', 'PhamDat22222', 'dasdsadas', '2023-02-25 23:34:00', NULL, '2023-02-25 23:34:00', NULL, '2023-02-25 17:02:00', '::1', 0, 10, 0),
(39, 'admin1231231236666', 'phamdat9966666@gmail.com', 'Nguyen Van A', 'dasdsadsad', '2023-02-25 23:55:05', NULL, '2023-02-25 23:55:05', NULL, '2023-02-25 17:02:05', '::1', 0, 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group`
--
ALTER TABLE `group`
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
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
