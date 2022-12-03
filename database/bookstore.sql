-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2022 at 01:46 PM
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
(1, 'Admin 1', 0, '2022-10-18', 1, '2022-10-13', 1, '0', '10'),
(2, 'Admin 2', 1, '2022-10-05', NULL, '2022-10-13', NULL, '0', '10'),
(3, 'Admin 3', 0, '2022-10-06', NULL, '2022-10-17', 1, '1', '10'),
(4, 'Admin 4', 0, '0000-00-00', NULL, '2022-10-18', NULL, '0', '10'),
(5, 'Admin 5', 0, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(6, 'Manage 1', 1, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(7, 'Manage 2', 0, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(8, 'Manage 3', 1, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10'),
(9, 'Manage 4', 0, '2022-10-08', NULL, '2022-10-18', NULL, '1', '10'),
(10, 'Manage 5', 1, '2022-10-08', NULL, '2022-10-18', NULL, '0', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
