-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 11:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortDescription` text NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `shortDescription`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(1, 'Lập trình PHP', '', 'laptrinhphp.png', '300000', 1, 0, 'laptrinhphp.png', '2023-04-12 12:41:42', 'admin', '2023-04-15 10:11:17', '1', 1, 1, 24),
(3, 'Toán Lớp 12', '', 'toan12.jpg', '10000', 0, 0, 'toan12.jpg', '2023-04-12 12:43:32', NULL, '2023-04-15 10:11:17', '1', 1, 2, 21),
(12, 'UnrealScript Game Programming Cookbook', '', 'Designed for high-level game programming, UnrealScript is used in tandem with the Unreal Engine to provide a scripting language that is ideal for creating your very own unique gameplay experience. By learning how to replicate some of the advanced techniques used in today\'s modern games, you too can take your game to the next level and stand out from the crowd.\r\n\r\nBy providing a series of engaging and practical recipes, this \"UnrealScript Game Programming Cookbook\" will show you how to leverage the advanced functionality within UDK. You\'ll be shown how to implement a wide variety of practical features using the high-level scripting language ranging from designing your own HUD, creating your very own custom tailored weapons, to generating pathfinding solutions, and even meticulously crafting your own AI.', '25000', 0, 20, 'mj5oqp18.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-14 08:42:28', '1', 1, 3, 23),
(13, 'Functional Programming in Scala', '', 'Functional programming (FP) is a programming style emphasizing functions that return consistent and predictable results regardless of a program\'s state. As a result, functional code is easier to test and reuse, simpler to parallelize, and less prone to bugs. Scala is an emerging JVM language that offers strong support for FP. Its familiar syntax and transparent interoperability with existing Java libraries make Scala a great place to start learning FP.\r\n\r\nFunctional Programming in Scala is a serious tutorial for programmers looking to learn FP and apply it to the everyday business of coding. The book guides readers from basic techniques to advanced topics in a logical, concise, and clear progression. In it, you\'ll find concrete examples and exercises that open up the world of functional programming.', '35000', 0, 3, '7kyub3oi.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-15 09:31:19', '1', 1, 3, 21),
(14, 'iOS 7 Programming Fundamentals', '', 'If you\'re getting started with iOS development, or want a firmer grasp of the basics, this practical guide provides a clear view of its fundamental building blocksâ€”Objective-C, Xcode, and Cocoa Touch. You\'ll learn object-oriented concepts, understand how to use Apple\'s development tools, and discover how Cocoa provides the underlying functionality iOS apps need to have. Dozens of example projects are available at GitHub.\r\n\r\nOnce you master the fundamentals, you\'ll be ready to tackle the details of iOS app development with author Matt Neuburg\'s companion guide.', '45000', 1, 0, 'm3brd79l.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-15 10:11:17', '1', 1, 2, 21),
(15, 'iOS 7 Programming Cookbook', '', 'Overcome the vexing issues you\'re likely to face when creating apps for the iPhone, iPad, or iPod touch. With new and thoroughly revised recipes in this updated cookbook, you\'ll quickly learn the steps necessary to work with the iOS 7 SDK, including solutions for bringing real-world physics and movement to your apps with UIKit Dynamics APIs.\r\n\r\nYou\'ll learn hundreds of techniques for storing and protecting data, sending and receiving notifications, enhancing and animating graphics, managing files and folders, and many other options. Each recipe includes sample code you can use right away.', '44000', 1, 0, 'qx5m9u6t.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-15 09:19:00', '1', 1, 3, 23),
(16, 'Advanced Programming in the UNIX Environment, 3rd Edition', '', 'For more than twenty years, serious C programmers have relied on one book for practical, in-depth knowledge of the programming interfaces that drive the UNIX and Linux kernels: W. Richard Stevens\' Advanced Programming in the UNIX Environment. Now, once again, Rich\'s colleague Steve Rago has thoroughly updated this classic work. The new third edition supports today\'s leading platforms, reflects new technical advances and best practices, and aligns with Version 4 of the Single UNIX Specification.\r\n\r\nSteve carefully retains the spirit and approach that have made this book so valuable. Building on Rich\'s pioneering work, he begins with files, directories, and processes, carefully laying the groundwork for more advanced techniques, such as signal handling and terminal I/O. He also thoroughly covers threads and multithreaded programming, and socket-based IPC.', '36000', 1, 2, '2yo48fgm.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-13 00:00:00', 'admin', 1, 3, 3),
(17, 'jMonkeyEngine 3.0 Beginner', '', 'jMonkeyEngine 3.0 is a powerful set of free Java libraries that allows you to unlock your imagination, create 3D games and stunning graphics. Using jMonkeyEngine\'s library of time-tested methods, this book will allow you to unlock its potential and make the creation of beautiful interactive 3D environments a breeze.\r\n\r\njMonkeyEngine 3.0 Beginner\'s Guide teaches aspiring game developers how to build modern 3D games with Java. This primer on 3D programming is packed with best practices, tips and tricks and loads of example code. Progressing from elementary concepts to advanced effects, budding game developers will have their first game up and running by the end of this book.', '36000', 0, 12, 'cq7k0i4j.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-12 00:00:00', 'admin', 1, 3, 2),
(18, 'Scala Cookbook', '', 'Save time and trouble when using Scala to build object-oriented, functional, and concurrent applications. With more than 250 ready-to-use recipes and 700 code examples, this comprehensive cookbook covers the most common problems you\'ll encounter when using the Scala language, libraries, and tools. It\'s ideal not only for experienced Scala developers, but also for programmers learning to use this JVM language.\r\n\r\nAuthor Alvin Alexander (creator of DevDaily.com) provides solutions based on his experience using Scala for highly scalable, component-based applications that support concurrency and distribution.', '46000', 0, 0, 'zpg6a0uw.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-12 00:00:00', 'admin', 1, 10, 4),
(19, 'PostgreSQL Server Programming', '', 'Learn how to work with PostgreSQL as if you spent the last decade working on it. PostgreSQL is capable of providing you with all of the options that you have in your favourite development language and then extending that right on to the database server. With this knowledge in hand, you will be able to respond to the current demand for advanced PostgreSQL skills in a lucrative and booming market.\r\n\r\nPostgreSQL Server Programming will show you that PostgreSQL is so much more than a database server. In fact, it could even be seen as an application development framework, with the added bonuses of transaction support, massive data storage, journaling, recovery and a host of other features that the PostgreSQL engine provides.', '54000', 0, 5, 'x3et42jv.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-12 00:00:00', 'admin', 1, 3, 2),
(20, 'Programming Drupal 7 Entities', '', 'Writing code for manipulating Drupal data has never been easier! Learn to dice and serve your data as you slowly peel back the layers of the Drupal entity onion. Next, expose your legacy local and remote data to take full advantage of Drupal\'s vast solution space.\r\n\r\nProgramming Drupal 7 Entities is a practical, hands-on guide that provides you with a thorough knowledge of Drupal\'s entity paradigm and a number of clear step-by-step exercises, which will help you take advantage of the real power that is available when developing using entities.', '58000', 0, 4, 'zosatu07.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-12 00:00:00', 'admin', 1, 3, 2),
(21, 'Moving from C to C++', '', 'The author says it best, I hope to move you, a little at a time,from understanding C to the point where C++ becomes your mindset. This remarkable book is designed to streamline the process of learning C++ in a way that discusses programming problems, why they exist, and the approach C++ has taken to solve such problems.\r\n\r\nYou can\'t just look at C++ as a collection of features; some of the features make no sense in isolation. You can only use the sum of the parts if you are thinking about design, not simply coding. To understand C++, you must understand the problems with C and with programming in general. This book discusses programming problems, why they are problems, and the approach C++ has taken to solve such problems. Thus, the set of features that I explain in each chapter will be based on the way that I see a particular type of problem being solved in C++.', '36000', 0, 3, '901wh8tx.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-12 00:00:00', 'admin', 1, 3, 2),
(22, 'C Programming for Arduino', '', 'Physical computing allows us to build interactive physical systems by using software & hardware in order to sense and respond to the real world. C Programming for Arduino will show you how to harness powerful capabilities like sensing, feedbacks, programming and even wiring and developing your own autonomous systems.\r\n\r\nC Programming for Arduino contains everything you need to directly start wiring and coding your own electronic project. You\'ll learn C and how to code several types of firmware for your Arduino, and then move on to design small typical systems to understand how handling buttons, leds, LCD, network modules and much more.', '38000', 0, 0, 'siochmyg.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-15 10:15:00', '1', 0, 2, 3),
(23, 'Advanced Network Programming - Principles and Techniques', '', 'The field of network programming is so large, and developing so rapidly, that it can appear almost overwhelming to those new to the discipline.\r\n\r\nAnswering the need for an accessible overview of the field, this text/reference presents a manageable introduction to both the theoretical and practical aspects of computer networks and network programming. Clearly structured and easy to follow, the book describes cutting-edge developments in network architectures, communication protocols, and programming techniques and models, supported by code examples for hands-on practice with creating network-based applications.', '43000', 1, 20, 'vradhky9.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-13 00:00:00', 'admin', 1, 3, 3),
(24, 'Programming Logics', '', 'This Festschrift volume, published in memory of Harald Ganzinger, contains 17 papers from colleagues all over the world and covers all the fields to which Harald Ganzinger dedicated his work during his academic career.\r\n\r\nThe volume begins with a complete account of Harald Ganzinger\'s work and then turns its focus to the research of his former colleagues, students, and friends who pay tribute to him through their writing. Their individual papers span a broad range of topics, including programming language semantics, analysis and verification, first-order and higher-order theorem proving, unification theory, non-classical logics, reasoning modulo theories, and applications of automated reasoning in biology.', '32000', 0, 1, 'sbx52yne.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-15 10:11:17', '1', 1, 2, 4);

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
  `showhome` tinyint(1) NOT NULL,
  `ordering` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `showhome`, `ordering`) VALUES
(21, 'Bà Mẹ - Em Bé', 'fd8bvqwt.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 0, 1),
(22, 'Chính Trị - Pháp Luật', 'v9zusgh6.jpg', '2023-03-30', '5', '0000-00-00', '1', 1, 0, 3),
(23, 'Học Ngoại Ngữ', 'wqz91l0d.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 0, 4),
(24, 'Công Nghệ Thông Tin', 'buo4dk2t.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 0, 4),
(25, 'Giáo Khoa - Giáo Trình', 'g1arq6h5.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 0, 4),
(26, 'Triếc Học', '08tgxj9s.png', '2023-03-30', '1', '2023-04-10', '1', 0, 0, 6),
(27, 'Self Help', 'n3o1p82j.jpg', '2023-03-31', '1', '2023-03-31', NULL, 1, 0, 7),
(28, 'Tiểu Sử - Hồi ký', '7p15v6x4.jpg', '2023-03-31', '1', '2023-03-31', NULL, 1, 0, 8),
(29, 'Kinh Tế', 'g9u8z3mj.jpg', '2023-03-31', '1', '2023-03-31', '1', 1, 0, 9),
(30, 'Tâm Lý - Kỹ Năng Sống', '4ouje3ln.jpg', '2023-03-31', '1', '2023-03-31', '1', 1, 0, 11);

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
  `ordering` int(11) DEFAULT NULL,
  `privilege_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`) VALUES
(1, 'Admin', 1, '2022-10-18', '1', '2023-01-11', '1', '1', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17'),
(2, 'Manager', 1, '2022-10-05', '1', '2023-03-30', '', '1', 2, '1,2,3,4,6,7,8,9,10'),
(3, 'Member', 1, '2022-10-08', NULL, '2023-01-11', '1', '0', 3, '1'),
(4, 'Register', 0, '2022-10-08', NULL, '2023-03-30', '1', '1', 4, ''),
(75, 'founder 01', 1, '2023-03-30', '', '2023-03-30', NULL, '1', 6, ''),
(76, 'founder 02', 0, '2023-03-30', '1', '2023-03-30', NULL, '0', 9, ''),
(77, 'founder 03', 1, '2023-04-04', '1', '2023-04-04', NULL, '0', 9, ''),
(78, 'founder 04', 1, '2023-04-04', '1', '2023-04-04', NULL, '0', 9, ''),
(79, 'founder 05', 1, '2023-03-30', '', '2023-03-30', NULL, '0', 9, ''),
(80, 'founder 06', 0, '2023-03-30', '1', '2023-03-30', NULL, '0', 9, ''),
(81, 'founder 07', 1, '2023-04-04', '1', '2023-04-04', NULL, '0', 9, ''),
(82, 'founder 08', 1, '2023-04-04', '1', '2023-04-04', NULL, '0', 9, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `group_id`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '12345', '2022-12-28 00:00:00', '1', '2023-04-15 10:00:49', '1', '2023-02-25 14:39:22', NULL, 1, 10, 1),
(2, 'manager', 'manager@gmail.com', 'Manager', '12345', '2022-12-28 02:55:00', '5', '2023-03-09 03:39:47', '5', '2023-02-25 14:39:22', NULL, 0, 10, 2),
(3, 'member', 'member@gmail.com', 'Member', '12345', '2022-12-28 08:55:00', '1', '2023-04-15 09:59:08', '1', '2023-02-25 14:39:22', NULL, 1, 10, 3),
(4, 'register', 'register@gmail.com', 'Register', '12345', '2022-12-28 10:04:00', '5', '2023-04-03 12:10:08', '1', '2023-02-25 14:39:22', NULL, 0, 10, 4),
(5, 'nguyenvana', 'nguyenvana@gmail.com', 'Nguyen Van A123', '12345', '2023-02-07 07:42:54', '1', '2023-03-21 09:37:02', '1', '2023-02-25 14:39:22', NULL, 1, 10, 1),
(35, 'nguyenvanb', 'nguyenvanb@gmail.com', 'Nguyen Van B', '12345', '2023-02-25 22:33:16', NULL, '2023-03-11 09:39:04', '1', '2023-02-25 16:02:16', '::1', 1, 10, 4),
(36, 'nguyenvanaa', 'nguyenvanaa123@gmail.com', 'Nguyen Van A', '12345', '2023-02-25 22:38:31', NULL, '2023-02-25 22:38:31', NULL, '2023-02-25 16:02:31', '::1', 0, 10, 4),
(41, 'fouder01', 'phamdat9966@gmail.com', 'admin123', '123456', '2023-03-18 08:12:00', '2', '2023-03-18 14:12:00', NULL, '2023-03-18 14:12:00', NULL, 0, 10, 4),
(42, 'fouder02', 'phamdat999666@gmail.com', 'admin123', '123456', '2023-03-18 08:12:00', '2', '2023-03-18 14:12:00', NULL, '2023-03-18 14:12:00', NULL, 0, 10, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
