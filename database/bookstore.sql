-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 08, 2023 lúc 09:43 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

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
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`id`, `name`, `shortDescription`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(1, 'Lập trình \"PHP\"', '                           simply dummy text of the printing and typesetting industry.\r\n                          ', '<h3><img alt=\"\" src=\"/ckfinder/userfiles/images/zpg6a0uw.jpg\" style=\"float:left; height:131px; margin-right:10px; width:100px\" /></h3>\n\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>\n\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>\n', '200000', 1, 10, '1uft0x5z.png', '2023-04-12 12:41:42', 'admin', '2023-05-03 09:17:53', '1', 1, 1, 25),
(3, 'Toán Lớp 12', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'toan12.jpg', '10000', 1, 0, 'toan12.jpg', '2023-04-12 12:43:32', NULL, '2023-05-08 09:35:23', '1', 1, 2, 25),
(12, 'UnrealScript Game Programming Cookbook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Designed for high-level game programming, UnrealScript is used in tandem with the Unreal Engine to provide a scripting language that is ideal for creating your very own unique gameplay experience. By learning how to replicate some of the advanced techniques used in today\'s modern games, you too can take your game to the next level and stand out from the crowd.\r\n\r\nBy providing a series of engaging and practical recipes, this \"UnrealScript Game Programming Cookbook\" will show you how to leverage the advanced functionality within UDK. You\'ll be shown how to implement a wide variety of practical features using the high-level scripting language ranging from designing your own HUD, creating your very own custom tailored weapons, to generating pathfinding solutions, and even meticulously crafting your own AI.', '25000', 0, 20, 'mj5oqp18.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-14 08:42:28', '1', 1, 3, 23),
(13, 'Functional Programming in Scala', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Functional programming (FP) is a programming style emphasizing functions that return consistent and predictable results regardless of a program\'s state. As a result, functional code is easier to test and reuse, simpler to parallelize, and less prone to bugs. Scala is an emerging JVM language that offers strong support for FP. Its familiar syntax and transparent interoperability with existing Java libraries make Scala a great place to start learning FP.\r\n\r\nFunctional Programming in Scala is a serious tutorial for programmers looking to learn FP and apply it to the everyday business of coding. The book guides readers from basic techniques to advanced topics in a logical, concise, and clear progression. In it, you\'ll find concrete examples and exercises that open up the world of functional programming.', '35000', 0, 3, '7kyub3oi.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-08 09:42:21', '1', 1, 3, 24),
(14, 'iOS 7 Programming Fundamentals', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'If you\'re getting started with iOS development, or want a firmer grasp of the basics, this practical guide provides a clear view of its fundamental building blocksâ€”Objective-C, Xcode, and Cocoa Touch. You\'ll learn object-oriented concepts, understand how to use Apple\'s development tools, and discover how Cocoa provides the underlying functionality iOS apps need to have. Dozens of example projects are available at GitHub.\r\n\r\nOnce you master the fundamentals, you\'ll be ready to tackle the details of iOS app development with author Matt Neuburg\'s companion guide.', '45000', 1, 0, 'm3brd79l.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-08 09:35:18', '1', 1, 2, 24),
(15, 'iOS 7 Programming Cookbook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Overcome the vexing issues you\'re likely to face when creating apps for the iPhone, iPad, or iPod touch. With new and thoroughly revised recipes in this updated cookbook, you\'ll quickly learn the steps necessary to work with the iOS 7 SDK, including solutions for bringing real-world physics and movement to your apps with UIKit Dynamics APIs.\r\n\r\nYou\'ll learn hundreds of techniques for storing and protecting data, sending and receiving notifications, enhancing and animating graphics, managing files and folders, and many other options. Each recipe includes sample code you can use right away.', '44000', 1, 30, 'qx5m9u6t.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-15 09:19:00', '1', 1, 3, 23),
(16, 'Advanced Programming in the UNIX Environment, 3rd Edition', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'For more than twenty years, serious C programmers have relied on one book for practical, in-depth knowledge of the programming interfaces that drive the UNIX and Linux kernels: W. Richard Stevens\' Advanced Programming in the UNIX Environment. Now, once again, Rich\'s colleague Steve Rago has thoroughly updated this classic work. The new third edition supports today\'s leading platforms, reflects new technical advances and best practices, and aligns with Version 4 of the Single UNIX Specification.\r\n\r\nSteve carefully retains the spirit and approach that have made this book so valuable. Building on Rich\'s pioneering work, he begins with files, directories, and processes, carefully laying the groundwork for more advanced techniques, such as signal handling and terminal I/O. He also thoroughly covers threads and multithreaded programming, and socket-based IPC.', '36000', 1, 25, '2yo48fgm.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-13 00:00:00', 'admin', 1, 3, 3),
(17, 'jMonkeyEngine 3.0 Beginner', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'jMonkeyEngine 3.0 is a powerful set of free Java libraries that allows you to unlock your imagination, create 3D games and stunning graphics. Using jMonkeyEngine\'s library of time-tested methods, this book will allow you to unlock its potential and make the creation of beautiful interactive 3D environments a breeze.\r\n\r\njMonkeyEngine 3.0 Beginner\'s Guide teaches aspiring game developers how to build modern 3D games with Java. This primer on 3D programming is packed with best practices, tips and tricks and loads of example code. Progressing from elementary concepts to advanced effects, budding game developers will have their first game up and running by the end of this book.', '36000', 1, 12, 'cq7k0i4j.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-12 00:00:00', 'admin', 1, 3, 2),
(18, 'Scala Cookbook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Save time and trouble when using Scala to build object-oriented, functional, and concurrent applications. With more than 250 ready-to-use recipes and 700 code examples, this comprehensive cookbook covers the most common problems you\'ll encounter when using the Scala language, libraries, and tools. It\'s ideal not only for experienced Scala developers, but also for programmers learning to use this JVM language.\r\n\r\nAuthor Alvin Alexander (creator of DevDaily.com) provides solutions based on his experience using Scala for highly scalable, component-based applications that support concurrency and distribution.', '46000', 1, 0, 'zpg6a0uw.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 10, 4),
(19, 'PostgreSQL Server Programming', '', 'Learn how to work with PostgreSQL as if you spent the last decade working on it. PostgreSQL is capable of providing you with all of the options that you have in your favourite development language and then extending that right on to the database server. With this knowledge in hand, you will be able to respond to the current demand for advanced PostgreSQL skills in a lucrative and booming market.\r\n\r\nPostgreSQL Server Programming will show you that PostgreSQL is so much more than a database server. In fact, it could even be seen as an application development framework, with the added bonuses of transaction support, massive data storage, journaling, recovery and a host of other features that the PostgreSQL engine provides.', '54000', 0, 15, 'x3et42jv.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 3, 2),
(20, 'Programming Drupal 7 Entities', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Writing code for manipulating Drupal data has never been easier! Learn to dice and serve your data as you slowly peel back the layers of the Drupal entity onion. Next, expose your legacy local and remote data to take full advantage of Drupal\'s vast solution space.\r\n\r\nProgramming Drupal 7 Entities is a practical, hands-on guide that provides you with a thorough knowledge of Drupal\'s entity paradigm and a number of clear step-by-step exercises, which will help you take advantage of the real power that is available when developing using entities.', '58000', 0, 40, 'zosatu07.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 3, 2),
(21, 'Moving from C to C++', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'The author says it best, I hope to move you, a little at a time,from understanding C to the point where C++ becomes your mindset. This remarkable book is designed to streamline the process of learning C++ in a way that discusses programming problems, why they exist, and the approach C++ has taken to solve such problems.\r\n\r\nYou can\'t just look at C++ as a collection of features; some of the features make no sense in isolation. You can only use the sum of the parts if you are thinking about design, not simply coding. To understand C++, you must understand the problems with C and with programming in general. This book discusses programming problems, why they are problems, and the approach C++ has taken to solve such problems. Thus, the set of features that I explain in each chapter will be based on the way that I see a particular type of problem being solved in C++.', '36000', 0, 3, '901wh8tx.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 3, 2),
(22, 'C Programming for Arduino', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Physical computing allows us to build interactive physical systems by using software & hardware in order to sense and respond to the real world. C Programming for Arduino will show you how to harness powerful capabilities like sensing, feedbacks, programming and even wiring and developing your own autonomous systems.\r\n\r\nC Programming for Arduino contains everything you need to directly start wiring and coding your own electronic project. You\'ll learn C and how to code several types of firmware for your Arduino, and then move on to design small typical systems to understand how handling buttons, leds, LCD, network modules and much more.', '38000', 1, 0, 'siochmyg.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-08 09:35:28', '1', 1, 2, 24),
(23, 'Advanced Network Programming - Principles and Techniques', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'The field of network programming is so large, and developing so rapidly, that it can appear almost overwhelming to those new to the discipline.\r\n\r\nAnswering the need for an accessible overview of the field, this text/reference presents a manageable introduction to both the theoretical and practical aspects of computer networks and network programming. Clearly structured and easy to follow, the book describes cutting-edge developments in network architectures, communication protocols, and programming techniques and models, supported by code examples for hands-on practice with creating network-based applications.', '43000', 1, 10, 'vradhky9.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 3, 3),
(24, 'Programming Logics', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'This Festschrift volume, published in memory of Harald Ganzinger, contains 17 papers from colleagues all over the world and covers all the fields to which Harald Ganzinger dedicated his work during his academic career.\r\n\r\nThe volume begins with a complete account of Harald Ganzinger\'s work and then turns its focus to the research of his former colleagues, students, and friends who pay tribute to him through their writing. Their individual papers span a broad range of topics, including programming language semantics, analysis and verification, first-order and higher-order theorem proving, unification theory, non-classical logics, reasoning modulo theories, and applications of automated reasoning in biology.', '32000', 0, 1, 'sbx52yne.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-08 09:35:32', '1', 1, 2, 24),
(25, 'Để con được ốm', '                           Lorem Ipsum is simply dummy text of the printing and typesetting industry\r\n                          ', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p><img alt=\"\" src=\"/ckfinder/userfiles/images/smartmath.jpg\" style=\"height:500px; width:391px\" /></p>\r\n', '50000', 0, 20, '8nkbif7j.jpg', '2023-04-25 09:29:58', '1', '2023-05-08 09:34:10', '1', 1, 10, 21),
(26, 'CNTT001', '                           \r\n                          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', '<p><img alt=\"\" src=\"/ckfinder/userfiles/images/smartmath.jpg\" style=\"height:500px; width:391px\" />&nbsp;sdasdasdasd&aacute; asdasdasdasd dsdasdasdasd&nbsp; dsadasdasdas</p>\r\n', '200000', 0, 0, '9q73eiva.jpg', '2023-04-26 08:56:59', '1', '2023-04-27 01:56:59', NULL, 1, 10, 24),
(27, 'Nuôi con', '                           Nuôi Con\r\n                          ', '<p>Nu&ocirc;i Con</p>\r\n', '80000', 0, 20, 'i2v6o809.jpg', '2023-05-08 09:36:27', '1', '2023-05-08 09:37:06', '1', 1, 10, 21),
(28, 'Cẩm Nang Bà Mẹ Và Em Bé', '                           Cẩm Nang Bà Mẹ Và Em Bé\r\n                          ', '<p>Cẩm Nang B&agrave; Mẹ V&agrave; Em B&eacute;</p>\r\n', '50000', 0, 10, 'feqkru8o.jpg', '2023-05-08 09:40:44', '1', '2023-05-08 14:40:44', NULL, 1, 10, 21),
(29, 'Làm Mẹ Chưa Bao Giờ Muộn', '                           \r\n                          Làm Mẹ Chưa Bao Giờ Muộn', '<p>L&agrave;m Mẹ Chưa Bao Giờ Muộn</p>\r\n', '100000', 0, 20, '4bi2v96g.jpg', '2023-05-08 09:41:56', '1', '2023-05-08 14:41:56', NULL, 1, 10, 21);

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
  `showhome` tinyint(1) NOT NULL,
  `ordering` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `showhome`, `ordering`) VALUES
(21, 'Bà Mẹ - Em Bé', 'a7p5umvo.jpg', '2023-03-30', '1', '2023-04-25', '1', 1, 1, 2),
(22, 'Chính Trị - Pháp Luật', 'v9zusgh6.jpg', '2023-03-30', '5', '0000-00-00', '1', 1, 0, 3),
(23, 'Học Ngoại Ngữ', 'wqz91l0d.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 0, 4),
(24, 'Công Nghệ Thông Tin', '0uxgyp2q.jpg', '2023-03-30', '1', '2023-04-25', '1', 1, 1, 4),
(25, 'Giáo Khoa - Giáo Trình', 'so7gmbec.jpg', '2023-03-30', '1', '2023-04-24', '1', 1, 1, 4),
(26, 'Triếc Học', '08tgxj9s.png', '2023-03-30', '1', '2023-04-25', '1', 1, 0, 6),
(27, 'Self Help', 'n3o1p82j.jpg', '2023-03-31', '1', '2023-04-25', '1', 1, 1, 7),
(28, 'Tiểu Sử - Hồi ký', '7p15v6x4.jpg', '2023-03-31', '1', '2023-05-05', '1', 1, 0, 8),
(29, 'Kinh Tế', 'g9u8z3mj.jpg', '2023-03-31', '1', '2023-05-05', '1', 1, 0, 9),
(30, 'Tâm Lý - Kỹ Năng Sống', '4ouje3ln.jpg', '2023-03-31', '1', '2023-05-05', '1', 1, 0, 11);

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
  `ordering` int(11) DEFAULT NULL,
  `privilege_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `group`
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
-- Cấu trúc bảng cho bảng `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT cho bảng `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
