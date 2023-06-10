-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 10:37 AM
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
(1, 'Lập trình PHP', '                           simply dummy text of the printing and typesetting industry.\r\n                          ', '<h3><img alt=\"\" src=\"/ckfinder/userfiles/images/zpg6a0uw.jpg\" style=\"float:left; height:131px; margin-right:10px; width:100px\" /></h3>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English.</p>\r\n', '200000', 0, 10, 'v9buoni8.jpg', '2023-04-12 12:41:42', 'admin', '2023-05-11 10:17:30', '1', 1, 1, 25),
(3, 'Toán Lớp 12', '                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard\r\n                          ', '<p>toan12.jpg</p>\r\n', '10000', 0, 0, 's0xn1hem.jpg', '2023-04-12 12:43:32', NULL, '2023-05-14 03:13:11', '1', 1, 2, 25),
(12, 'UnrealScript Game Programming Cookbook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Designed for high-level game programming, UnrealScript is used in tandem with the Unreal Engine to provide a scripting language that is ideal for creating your very own unique gameplay experience. By learning how to replicate some of the advanced techniques used in today\'s modern games, you too can take your game to the next level and stand out from the crowd.\r\n\r\nBy providing a series of engaging and practical recipes, this \"UnrealScript Game Programming Cookbook\" will show you how to leverage the advanced functionality within UDK. You\'ll be shown how to implement a wide variety of practical features using the high-level scripting language ranging from designing your own HUD, creating your very own custom tailored weapons, to generating pathfinding solutions, and even meticulously crafting your own AI.', '25000', 1, 20, 'mj5oqp18.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-11 08:27:35', '1', 1, 3, 24),
(13, 'Functional Programming in Scala', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Functional programming (FP) is a programming style emphasizing functions that return consistent and predictable results regardless of a program\'s state. As a result, functional code is easier to test and reuse, simpler to parallelize, and less prone to bugs. Scala is an emerging JVM language that offers strong support for FP. Its familiar syntax and transparent interoperability with existing Java libraries make Scala a great place to start learning FP.\r\n\r\nFunctional Programming in Scala is a serious tutorial for programmers looking to learn FP and apply it to the everyday business of coding. The book guides readers from basic techniques to advanced topics in a logical, concise, and clear progression. In it, you\'ll find concrete examples and exercises that open up the world of functional programming.', '35000', 0, 3, '7kyub3oi.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-08 09:42:21', '1', 1, 3, 24),
(14, 'iOS 7 Programming Fundamentals', '                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard\r\n                          ', '<p>If you&#39;re getting started with iOS development, or want a firmer grasp of the basics, this practical guide provides a clear view of its fundamental building blocks&acirc;&euro;&rdquo;Objective-C, Xcode, and Cocoa Touch. You&#39;ll learn object-oriented concepts, understand how to use Apple&#39;s development tools, and discover how Cocoa provides the underlying functionality iOS apps need to have. Dozens of example projects are available at GitHub. Once you master the fundamentals, you&#39;ll be ready to tackle the details of iOS app development with author Matt Neuburg&#39;s companion guide.</p>\r\n', '45000', 1, 0, 't8u20xje.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-14 03:16:02', '1', 1, 2, 24),
(15, 'iOS 7 Programming Cookbook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Overcome the vexing issues you\'re likely to face when creating apps for the iPhone, iPad, or iPod touch. With new and thoroughly revised recipes in this updated cookbook, you\'ll quickly learn the steps necessary to work with the iOS 7 SDK, including solutions for bringing real-world physics and movement to your apps with UIKit Dynamics APIs.\r\n\r\nYou\'ll learn hundreds of techniques for storing and protecting data, sending and receiving notifications, enhancing and animating graphics, managing files and folders, and many other options. Each recipe includes sample code you can use right away.', '44000', 1, 30, 'qx5m9u6t.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-11 08:27:38', '1', 1, 3, 24),
(16, 'Advanced Programming in the UNIX Environment, 3rd Edition', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'For more than twenty years, serious C programmers have relied on one book for practical, in-depth knowledge of the programming interfaces that drive the UNIX and Linux kernels: W. Richard Stevens\' Advanced Programming in the UNIX Environment. Now, once again, Rich\'s colleague Steve Rago has thoroughly updated this classic work. The new third edition supports today\'s leading platforms, reflects new technical advances and best practices, and aligns with Version 4 of the Single UNIX Specification.\r\n\r\nSteve carefully retains the spirit and approach that have made this book so valuable. Building on Rich\'s pioneering work, he begins with files, directories, and processes, carefully laying the groundwork for more advanced techniques, such as signal handling and terminal I/O. He also thoroughly covers threads and multithreaded programming, and socket-based IPC.', '36000', 1, 25, '2yo48fgm.jpg', '2013-12-12 00:00:00', 'admin', '2023-05-11 09:27:02', '1', 1, 3, 24),
(17, 'jMonkeyEngine 3.0 Beginner', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'jMonkeyEngine 3.0 is a powerful set of free Java libraries that allows you to unlock your imagination, create 3D games and stunning graphics. Using jMonkeyEngine\'s library of time-tested methods, this book will allow you to unlock its potential and make the creation of beautiful interactive 3D environments a breeze.\r\n\r\njMonkeyEngine 3.0 Beginner\'s Guide teaches aspiring game developers how to build modern 3D games with Java. This primer on 3D programming is packed with best practices, tips and tricks and loads of example code. Progressing from elementary concepts to advanced effects, budding game developers will have their first game up and running by the end of this book.', '36000', 1, 12, 'cq7k0i4j.jpg', '2013-12-12 00:00:00', 'admin', '2013-12-12 00:00:00', 'admin', 1, 3, 2),
(18, 'Scala Cookbook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Save time and trouble when using Scala to build object-oriented, functional, and concurrent applications. With more than 250 ready-to-use recipes and 700 code examples, this comprehensive cookbook covers the most common problems you\'ll encounter when using the Scala language, libraries, and tools. It\'s ideal not only for experienced Scala developers, but also for programmers learning to use this JVM language.\r\n\r\nAuthor Alvin Alexander (creator of DevDaily.com) provides solutions based on his experience using Scala for highly scalable, component-based applications that support concurrency and distribution.', '46000', 1, 0, 'zpg6a0uw.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 10, 4),
(19, 'PostgreSQL Server Programming', '', 'Learn how to work with PostgreSQL as if you spent the last decade working on it. PostgreSQL is capable of providing you with all of the options that you have in your favourite development language and then extending that right on to the database server. With this knowledge in hand, you will be able to respond to the current demand for advanced PostgreSQL skills in a lucrative and booming market.\r\n\r\nPostgreSQL Server Programming will show you that PostgreSQL is so much more than a database server. In fact, it could even be seen as an application development framework, with the added bonuses of transaction support, massive data storage, journaling, recovery and a host of other features that the PostgreSQL engine provides.', '54000', 0, 15, 'x3et42jv.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 3, 2),
(20, 'Programming Drupal 7 Entities', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Writing code for manipulating Drupal data has never been easier! Learn to dice and serve your data as you slowly peel back the layers of the Drupal entity onion. Next, expose your legacy local and remote data to take full advantage of Drupal\'s vast solution space.\r\n\r\nProgramming Drupal 7 Entities is a practical, hands-on guide that provides you with a thorough knowledge of Drupal\'s entity paradigm and a number of clear step-by-step exercises, which will help you take advantage of the real power that is available when developing using entities.', '58000', 0, 40, 'zosatu07.jpg', '2013-12-12 00:00:00', 'admin', '2023-04-25 04:53:29', '1', 0, 3, 2),
(21, 'Moving from C to C++', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'The author says it best, I hope to move you, a little at a time,from understanding C to the point where C++ becomes your mindset. This remarkable book is designed to streamline the process of learning C++ in a way that discusses programming problems, why they exist, and the approach C++ has taken to solve such problems.\r\n\r\nYou can\'t just look at C++ as a collection of features; some of the features make no sense in isolation. You can only use the sum of the parts if you are thinking about design, not simply coding. To understand C++, you must understand the problems with C and with programming in general. This book discusses programming problems, why they are problems, and the approach C++ has taken to solve such problems. Thus, the set of features that I explain in each chapter will be based on the way that I see a particular type of problem being solved in C++.', '36000', 0, 3, '901wh8tx.jpg', '2013-12-12 00:00:00', '1', '2023-04-25 04:53:29', '1', 0, 3, 2),
(22, 'C Programming for Arduino', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'Physical computing allows us to build interactive physical systems by using software & hardware in order to sense and respond to the real world. C Programming for Arduino will show you how to harness powerful capabilities like sensing, feedbacks, programming and even wiring and developing your own autonomous systems.\r\n\r\nC Programming for Arduino contains everything you need to directly start wiring and coding your own electronic project. You\'ll learn C and how to code several types of firmware for your Arduino, and then move on to design small typical systems to understand how handling buttons, leds, LCD, network modules and much more.', '38000', 1, 0, 'siochmyg.jpg', '2013-12-12 00:00:00', '1', '2023-05-08 09:35:28', '1', 1, 2, 24),
(23, 'Advanced Network Programming - Principles and Techniques', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'The field of network programming is so large, and developing so rapidly, that it can appear almost overwhelming to those new to the discipline.\r\n\r\nAnswering the need for an accessible overview of the field, this text/reference presents a manageable introduction to both the theoretical and practical aspects of computer networks and network programming. Clearly structured and easy to follow, the book describes cutting-edge developments in network architectures, communication protocols, and programming techniques and models, supported by code examples for hands-on practice with creating network-based applications.', '43000', 1, 10, 'vradhky9.jpg', '2013-12-12 00:00:00', '1', '2023-04-25 04:53:29', '1', 0, 3, 3),
(24, 'Programming Logics', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard', 'This Festschrift volume, published in memory of Harald Ganzinger, contains 17 papers from colleagues all over the world and covers all the fields to which Harald Ganzinger dedicated his work during his academic career.\r\n\r\nThe volume begins with a complete account of Harald Ganzinger\'s work and then turns its focus to the research of his former colleagues, students, and friends who pay tribute to him through their writing. Their individual papers span a broad range of topics, including programming language semantics, analysis and verification, first-order and higher-order theorem proving, unification theory, non-classical logics, reasoning modulo theories, and applications of automated reasoning in biology.', '32000', 0, 1, 'sbx52yne.jpg', '2013-12-12 00:00:00', '1', '2023-05-08 09:35:32', '1', 1, 2, 24),
(25, 'Để con được ốm', 'Để con được ốm', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p><img alt=\"\" src=\"/ckfinder/userfiles/images/smartmath.jpg\" style=\"height:500px; width:391px\" /></p>\r\n', '50000', 1, 20, '8nkbif7j.jpg', '2023-04-25 09:29:58', '1', '2023-05-08 09:34:10', '1', 1, 10, 21),
(26, 'CNTT001', '                           \r\n                          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum', '<p><img alt=\"\" src=\"/ckfinder/userfiles/images/smartmath.jpg\" style=\"height:500px; width:391px\" />&nbsp;sdasdasdasd&aacute; asdasdasdasd dsdasdasdasd&nbsp; dsadasdasdas</p>\r\n', '200000', 0, 0, '9q73eiva.jpg', '2023-04-26 08:56:59', '1', '2023-04-27 01:56:59', NULL, 1, 10, 24),
(27, 'Nuôi con', '                           Nuôi Con\r\n                          ', '<p>Nu&ocirc;i Con</p>\r\n', '80000', 0, 20, 'i2v6o809.jpg', '2023-05-08 09:36:27', '1', '2023-05-08 09:37:06', '1', 1, 10, 21),
(28, 'Cẩm Nang Bà Mẹ Và Em Bé', '                           Cẩm Nang Bà Mẹ Và Em Bé\r\n                          ', '<p>Cẩm Nang B&agrave; Mẹ V&agrave; Em B&eacute;</p>\r\n', '50000', 0, 10, 'feqkru8o.jpg', '2023-05-08 09:40:44', '1', '2023-05-08 14:40:44', NULL, 1, 10, 21),
(29, 'Làm Mẹ Chưa Bao Giờ Muộn', '                           Làm Mẹ Chưa Bao Giờ Muộn\r\n                          ', '<p>L&agrave;m Mẹ Chưa Bao Giờ Muộn</p>\r\n', '100000', 0, 20, 'zfcad4pw.jpg', '2023-05-08 09:41:56', '1', '2023-05-24 05:08:20', '1', 1, 10, 21),
(30, 'English Streamline 1', '                           Streamline English là một trong những quyển sách học tiếng anh được sử dụng rộng rãi cho hầu hết các trường đại học trên toàn thế giới. Bộ tài liệu Streamline này sẽ giúp bạn học định hướng từ những bước đầu cơ bản nhất cho đến các bậc nâng cao mà không khiến bạn bị “ngợp”. Atlan.edu.vn hôm nay sẽ giới thiệu đến bạn đọc bộ Streamline English 4 quyển dưới đây.\r\n                          ', '<h3>Streamline English Departures:</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 1 c&oacute; 98 trang.</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Departures PDF.</li>\r\n	<li>Dạng &acirc;m thanh: mp3.</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"/ckfinder/userfiles/images/streamline-english-1.jpg\" style=\"float:left; height:320px; width:320px\" /><img alt=\"\" src=\"/ckfinder/userfiles/images/streamline-english-2.jpg\" style=\"float:left; height:320px; width:320px\" /><img alt=\"\" src=\"/ckfinder/userfiles/images/streamline-english-3.jpg\" style=\"float:left; height:320px; width:320px\" /><img alt=\"\" src=\"/ckfinder/userfiles/images/streamline-english-4a.jpg\" style=\"float:left; height:320px; width:320px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>S&aacute;ch Streamline English Departures | Nguồn ảnh: Internet</p>\r\n\r\n<p><strong>Streamline English</strong>&nbsp;l&agrave; được biết đến l&agrave; bộ gi&aacute;o tr&igrave;nh học tiếng anh giao tiếp với 4 quyển cơ bản như: Departures, Destinations , Connections v&agrave; Directions. Mỗi cuốn đều bao gồm c&oacute; file audio v&agrave; một ebook.</p>\r\n\r\n<p>Với&nbsp;<strong>bộ t&agrave;i liệu streamline 4 cuốn</strong>&nbsp;sẽ hướng dẫn v&agrave; cung cấp đến bạn học tiếng Anh đầy đủ những kiến thức về giao tiếp từ đơn giản nhất cho đến n&acirc;ng cao, bằng những b&agrave;i học với chủ đề đơn giản như Goodbye, Hello,&hellip; cho đến những chủ đề giao tiếp h&agrave;ng ng&agrave;y phức tạp như c&aacute;c bản tin, b&agrave;i b&aacute;o.</p>\r\n\r\n<p>Trong mỗi b&agrave;i học đều được tr&igrave;nh b&agrave;y cụ thể, c&oacute; hướng dẫn chi tiết, r&otilde; r&agrave;ng về cấu tr&uacute;c ngữ ph&aacute;p, c&acirc;u c&uacute; ph&ugrave; hợp với ngữ cảnh, c&aacute;ch sử dụng từ loại. Hơn hết, đi k&egrave;m theo đ&oacute; l&agrave; những v&iacute; dụ minh họa sinh động c&ugrave;ng file audio để người học c&oacute; thể được nghe chuẩn hơn.</p>\r\n\r\n<p><strong>Bộ s&aacute;ch Streamline English</strong>&nbsp;rất được c&aacute;c người học giao tiếp tiếng Anh h&agrave;i l&ograve;ng. Nếu luyện tập chăm chỉ theo đ&uacute;ng với t&agrave;i liệu n&agrave;y, người học sẽ nhanh ch&oacute;ng n&acirc;ng cao cũng như cải thiện được 4 kỹ năng cơ bản Nghe &ndash; Đọc &ndash; N&oacute;i &ndash; Viết.</p>\r\n', '100000', 0, 20, 'brzogdly.jpg', '2023-05-11 08:25:40', '1', '2023-05-13 08:06:29', '1', 1, 10, 23),
(31, 'english streamline 2', '                           \r\n                          Streamline English là một trong những quyển sách học tiếng anh được sử dụng rộng rãi cho hầu hết các trường đại học trên toàn thế giới. Bộ tài liệu Streamline này sẽ giúp bạn học định hướng từ những bước đầu cơ bản nhất cho đến các bậc nâng cao mà không khiến bạn bị “ngợp”. Atlan.edu.vn hôm nay sẽ giới thiệu đến bạn đọc bộ Streamline English 4 quyển dưới đây.', '<h2>Th&ocirc;ng tin cơ bản của 4 quyển Streamline English</h2>\r\n\r\n<h3>Streamline English Departures</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 1 c&oacute; 98 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Departures PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Departures\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-departures.jpg\" style=\"height:918px; width:650px\" /></p>\r\n\r\n<p>S&aacute;ch Streamline English Departures | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Connections</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 2 c&oacute; 102 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Connections PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Connections\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-connections.jpg\" style=\"height:913px; width:650px\" /></p>\r\n\r\n<p>Gi&aacute;o tr&igrave;nh Streamline English Connections | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Destinations</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 3 c&oacute; 103 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Destinations PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Destinations\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-destinations.jpg\" style=\"height:926px; width:650px\" /></p>\r\n\r\n<p>T&agrave;i liệu Streamline English Destinations | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Directions</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 4 c&oacute; 132 trang</li>\r\n	<li>Định dạng s&aacute;ch: Streamline English Directions PDF</li>\r\n	<li>Định dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Directions\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-directions.jpg\" style=\"height:1021px; width:650px\" /></p>\r\n\r\n<p>S&aacute;ch Streamline English Directions | Nguồn ảnh: Internet</p>\r\n\r\n<h2>S&aacute;ch tiếng anh&nbsp;Streamline English c&oacute; g&igrave; nổi bật?</h2>\r\n\r\n<p><strong>Streamline English</strong>&nbsp;l&agrave; được biết đến l&agrave; bộ gi&aacute;o tr&igrave;nh học tiếng anh giao tiếp với 4 quyển cơ bản như: Departures, Destinations , Connections v&agrave; Directions. Mỗi cuốn đều bao gồm c&oacute; file audio v&agrave; một ebook.</p>\r\n\r\n<p>Với&nbsp;<strong>bộ t&agrave;i liệu streamline 4 cuốn</strong>&nbsp;sẽ hướng dẫn v&agrave; cung cấp đến bạn học tiếng Anh đầy đủ những kiến thức về giao tiếp từ đơn giản nhất cho đến n&acirc;ng cao, bằng những b&agrave;i học với chủ đề đơn giản như Goodbye, Hello,&hellip; cho đến những chủ đề giao tiếp h&agrave;ng ng&agrave;y phức tạp như c&aacute;c bản tin, b&agrave;i b&aacute;o.</p>\r\n\r\n<p>Trong mỗi b&agrave;i học đều được tr&igrave;nh b&agrave;y cụ thể, c&oacute; hướng dẫn chi tiết, r&otilde; r&agrave;ng về cấu tr&uacute;c ngữ ph&aacute;p, c&acirc;u c&uacute; ph&ugrave; hợp với ngữ cảnh, c&aacute;ch sử dụng từ loại. Hơn hết, đi k&egrave;m theo đ&oacute; l&agrave; những v&iacute; dụ minh họa sinh động c&ugrave;ng file audio để người học c&oacute; thể được nghe chuẩn hơn.</p>\r\n\r\n<p><strong>Bộ s&aacute;ch Streamline English</strong>&nbsp;rất được c&aacute;c người học giao tiếp tiếng Anh h&agrave;i l&ograve;ng. Nếu luyện tập chăm chỉ theo đ&uacute;ng với t&agrave;i liệu n&agrave;y, người học sẽ nhanh ch&oacute;ng n&acirc;ng cao cũng như cải thiện được 4 kỹ năng cơ bản Nghe &ndash; Đọc &ndash; N&oacute;i &ndash; Viết.</p>\r\n', '100000', 0, 20, 'ustlo3z1.jpg', '2023-05-11 08:26:45', '1', '2023-05-11 13:26:45', NULL, 1, 10, 23),
(32, 'english streamline 3', '                           Streamline English là một trong những quyển sách học tiếng anh được sử dụng rộng rãi cho hầu hết các trường đại học trên toàn thế giới. Bộ tài liệu Streamline này sẽ giúp bạn học định hướng từ những bước đầu cơ bản nhất cho đến các bậc nâng cao mà không khiến bạn bị “ngợp”. Atlan.edu.vn hôm nay sẽ giới thiệu đến bạn đọc bộ Streamline English 4 quyển dưới đây.\r\n                          ', '<h2>Th&ocirc;ng tin cơ bản của 4 quyển Streamline English</h2>\r\n\r\n<h3>Streamline English Departures</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 1 c&oacute; 98 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Departures PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Departures\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-departures.jpg\" style=\"height:918px; width:650px\" /></p>\r\n\r\n<p>S&aacute;ch Streamline English Departures | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Connections</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 2 c&oacute; 102 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Connections PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Connections\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-connections.jpg\" style=\"height:913px; width:650px\" /></p>\r\n\r\n<p>Gi&aacute;o tr&igrave;nh Streamline English Connections | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Destinations</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 3 c&oacute; 103 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Destinations PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Destinations\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-destinations.jpg\" style=\"height:926px; width:650px\" /></p>\r\n\r\n<p>T&agrave;i liệu Streamline English Destinations | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Directions</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 4 c&oacute; 132 trang</li>\r\n	<li>Định dạng s&aacute;ch: Streamline English Directions PDF</li>\r\n	<li>Định dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Directions\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-directions.jpg\" style=\"height:1021px; width:650px\" /></p>\r\n\r\n<p>S&aacute;ch Streamline English Directions | Nguồn ảnh: Internet</p>\r\n\r\n<h2>S&aacute;ch tiếng anh&nbsp;Streamline English c&oacute; g&igrave; nổi bật?</h2>\r\n\r\n<p><strong>Streamline English</strong>&nbsp;l&agrave; được biết đến l&agrave; bộ gi&aacute;o tr&igrave;nh học tiếng anh giao tiếp với 4 quyển cơ bản như: Departures, Destinations , Connections v&agrave; Directions. Mỗi cuốn đều bao gồm c&oacute; file audio v&agrave; một ebook.</p>\r\n\r\n<p>Với&nbsp;<strong>bộ t&agrave;i liệu streamline 4 cuốn</strong>&nbsp;sẽ hướng dẫn v&agrave; cung cấp đến bạn học tiếng Anh đầy đủ những kiến thức về giao tiếp từ đơn giản nhất cho đến n&acirc;ng cao, bằng những b&agrave;i học với chủ đề đơn giản như Goodbye, Hello,&hellip; cho đến những chủ đề giao tiếp h&agrave;ng ng&agrave;y phức tạp như c&aacute;c bản tin, b&agrave;i b&aacute;o.</p>\r\n\r\n<p>Trong mỗi b&agrave;i học đều được tr&igrave;nh b&agrave;y cụ thể, c&oacute; hướng dẫn chi tiết, r&otilde; r&agrave;ng về cấu tr&uacute;c ngữ ph&aacute;p, c&acirc;u c&uacute; ph&ugrave; hợp với ngữ cảnh, c&aacute;ch sử dụng từ loại. Hơn hết, đi k&egrave;m theo đ&oacute; l&agrave; những v&iacute; dụ minh họa sinh động c&ugrave;ng file audio để người học c&oacute; thể được nghe chuẩn hơn.</p>\r\n\r\n<p><strong>Bộ s&aacute;ch Streamline English</strong>&nbsp;rất được c&aacute;c người học giao tiếp tiếng Anh h&agrave;i l&ograve;ng. Nếu luyện tập chăm chỉ theo đ&uacute;ng với t&agrave;i liệu n&agrave;y, người học sẽ nhanh ch&oacute;ng n&acirc;ng cao cũng như cải thiện được 4 kỹ năng cơ bản Nghe &ndash; Đọc &ndash; N&oacute;i &ndash; Viết.</p>\r\n', '100000', 0, 20, '85dx04sy.jpg', '2023-05-11 08:31:20', '1', '2023-05-11 13:31:20', NULL, 1, 10, 23),
(33, 'English Streamline 4', '                           \r\n                          Streamline English là một trong những quyển sách học tiếng anh được sử dụng rộng rãi cho hầu hết các trường đại học trên toàn thế giới. Bộ tài liệu Streamline này sẽ giúp bạn học định hướng từ những bước đầu cơ bản nhất cho đến các bậc nâng cao mà không khiến bạn bị “ngợp”. Atlan.edu.vn hôm nay sẽ giới thiệu đến bạn đọc bộ Streamline English 4 quyển dưới đây.', '<h2>Th&ocirc;ng tin cơ bản của 4 quyển Streamline English</h2>\r\n\r\n<h3>Streamline English Departures</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 1 c&oacute; 98 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Departures PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Departures\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-departures.jpg\" style=\"height:918px; width:650px\" /></p>\r\n\r\n<p>S&aacute;ch Streamline English Departures | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Connections</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 2 c&oacute; 102 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Connections PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Connections\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-connections.jpg\" style=\"height:913px; width:650px\" /></p>\r\n\r\n<p>Gi&aacute;o tr&igrave;nh Streamline English Connections | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Destinations</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 3 c&oacute; 103 trang</li>\r\n	<li>Dạng s&aacute;ch: Streamline English Destinations PDF</li>\r\n	<li>Dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Destinations\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-destinations.jpg\" style=\"height:926px; width:650px\" /></p>\r\n\r\n<p>T&agrave;i liệu Streamline English Destinations | Nguồn ảnh: Internet</p>\r\n\r\n<h3>Streamline English Directions</h3>\r\n\r\n<ul>\r\n	<li>Số trang: quyển 4 c&oacute; 132 trang</li>\r\n	<li>Định dạng s&aacute;ch: Streamline English Directions PDF</li>\r\n	<li>Định dạng &acirc;m thanh: mp3</li>\r\n</ul>\r\n\r\n<p><img alt=\"Steamline english Directions\" src=\"https://atlan.edu.vn/wp-content/uploads/2022/10/steamline-english-directions.jpg\" style=\"height:1021px; width:650px\" /></p>\r\n\r\n<p>S&aacute;ch Streamline English Directions | Nguồn ảnh: Internet</p>\r\n\r\n<h2>S&aacute;ch tiếng anh&nbsp;Streamline English c&oacute; g&igrave; nổi bật?</h2>\r\n\r\n<p><strong>Streamline English</strong>&nbsp;l&agrave; được biết đến l&agrave; bộ gi&aacute;o tr&igrave;nh học tiếng anh giao tiếp với 4 quyển cơ bản như: Departures, Destinations , Connections v&agrave; Directions. Mỗi cuốn đều bao gồm c&oacute; file audio v&agrave; một ebook.</p>\r\n\r\n<p>Với&nbsp;<strong>bộ t&agrave;i liệu streamline 4 cuốn</strong>&nbsp;sẽ hướng dẫn v&agrave; cung cấp đến bạn học tiếng Anh đầy đủ những kiến thức về giao tiếp từ đơn giản nhất cho đến n&acirc;ng cao, bằng những b&agrave;i học với chủ đề đơn giản như Goodbye, Hello,&hellip; cho đến những chủ đề giao tiếp h&agrave;ng ng&agrave;y phức tạp như c&aacute;c bản tin, b&agrave;i b&aacute;o.</p>\r\n\r\n<p>Trong mỗi b&agrave;i học đều được tr&igrave;nh b&agrave;y cụ thể, c&oacute; hướng dẫn chi tiết, r&otilde; r&agrave;ng về cấu tr&uacute;c ngữ ph&aacute;p, c&acirc;u c&uacute; ph&ugrave; hợp với ngữ cảnh, c&aacute;ch sử dụng từ loại. Hơn hết, đi k&egrave;m theo đ&oacute; l&agrave; những v&iacute; dụ minh họa sinh động c&ugrave;ng file audio để người học c&oacute; thể được nghe chuẩn hơn.</p>\r\n\r\n<p><strong>Bộ s&aacute;ch Streamline English</strong>&nbsp;rất được c&aacute;c người học giao tiếp tiếng Anh h&agrave;i l&ograve;ng. Nếu luyện tập chăm chỉ theo đ&uacute;ng với t&agrave;i liệu n&agrave;y, người học sẽ nhanh ch&oacute;ng n&acirc;ng cao cũng như cải thiện được 4 kỹ năng cơ bản Nghe &ndash; Đọc &ndash; N&oacute;i &ndash; Viết.</p>\r\n', '100000', 0, 20, 'a2wbh56j.jpg', '2023-05-11 08:34:22', '1', '2023-05-11 13:34:22', NULL, 1, 10, 23),
(34, 'Lịch Sử Việt Nam', '                           \r\n                         Lời Nhà xuất bản\r\n\r\nLời tái bản\r\n\r\nLời đầu sách\r\n\r\nBảng chữ tắt\r\n\r\n- Chế độ Công Xã Nguyên Thủy\r\n\r\n- Dưới sự áp bức của các triều đại Trung Quốc\r\n\r\n- Bước đầu của nhà nước phong kiến tự chủ\r\n\r\n- Nguy cơ của Nhà nước phong kiến ở thế kỷ XIV\r\n\r\n- Bước phát triển mới của nhà nước phong kiến tập quyền\r\n\r\n- Sự suy đốn của nhà nước phong kiến ở thế kỷ XVII - XVIII\r\n\r\n- Sự sụp đổ của các thế lực phong kiến cũ - nhà Tây Sơn\r\n\r\n- Sự phục hưng của nhà nước phong kiến thống nhất - Nhà Nguyễn\r\n\r\n- Bước suy vong của nhà nước phong kiến\r\n\r\nĐoạn kết\r\n\r\nNiên biểu đối chiếu\r\n\r\nMinh họa và địa đồ', '<p style=\"text-align:justify\"><img alt=\"\" src=\"/ckfinder/userfiles/images/lichsuvietnam.jpg\" style=\"float:left; height:320px; width:320px\" />Đ&acirc;y l&agrave; cuốn s&aacute;ch d&agrave;nh cho những ai muốn t&igrave;m hiểu về lịch sử Việt Nam một c&aacute;ch bao qu&aacute;t v&agrave; to&agrave;n diện nhất. Cuốn s&aacute;ch được t&aacute;c giả Đ&agrave;o Duy Anh tr&igrave;nh b&agrave;y một c&aacute;ch tỉ mỉ những nghi&ecirc;n cứu từ lịch sử, địa l&yacute; đến kinh tế, x&atilde; hội&hellip; của đất nước Việt Nam ta qua nhiều thời kỳ. Lịch sử Việt Nam từ nguồn gốc đến thế kỷ XIX được xuất bản lần đầu ti&ecirc;n v&agrave;o năm 1949 v&agrave; được sửa đổi, bổ sung v&agrave;o năm 1952 để mang đến cho độc giả những ấn phẩm chất lượng v&agrave; s&acirc;u sắc hơn phi&ecirc;n bản trước đ&oacute;.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nếu bạn muốn t&igrave;m hiểu s&acirc;u hơn về thời kỳ c&ocirc;ng x&atilde; nguy&ecirc;n thủy, thời kỳ nh&acirc;n d&acirc;n ta sống dưới sự &aacute;p bức của Trung Quốc, thời kỳ phong kiến&hellip; th&igrave; đ&acirc;y chắc chắn l&agrave; cuốn s&aacute;ch d&agrave;nh cho bạn. Đ&acirc;y kh&ocirc;ng phải l&agrave; một cuốn s&aacute;ch kh&ocirc; khan với những th&ocirc;ng tin kh&oacute; nhớ, đ&acirc;y l&agrave; một thước phim t&aacute;i hiện lịch sử với những cuộc đấu tranh kh&ocirc;ng ngừng nghỉ của nh&acirc;n d&acirc;n v&igrave; độc lập, tự do v&agrave; hạnh ph&uacute;c, để c&oacute; được cuộc sống sung t&uacute;c, ấm no.&nbsp;</p>\r\n\r\n<p>L&agrave; người Việt Nam mang trong m&igrave;nh d&ograve;ng m&aacute;u Lạc Hồng trong huyết quản c&oacute; ai trong ch&uacute;ng ta kh&ocirc;ng từng một lần th&aacute;n phục một vị anh h&ugrave;ng n&agrave;o đ&oacute; trong lịch sử? Những danh tướng ấy đi s&acirc;u v&agrave;o những c&acirc;u chuyện cổ t&iacute;ch mẹ kể, đi s&acirc;u v&agrave;o những giai điệu văn h&oacute;a d&acirc;n tộc. Cuốn s&aacute;ch n&agrave;y kể cho ta về những danh tướng đ&atilde; c&oacute; c&ocirc;ng gi&uacute;p nước, giải ph&oacute;ng giặc ngoại x&acirc;m.&nbsp;</p>\r\n\r\n<p>Từ danh tướng Nguyễn Bặc trung qu&acirc;n &aacute;i quốc đến danh tướng đ&acirc;m gi&aacute;o v&agrave;o đ&ugrave;i kh&ocirc;ng mảy may đau đớn như Phạm Ngũ L&atilde;o, từ danh tướng Yết Ki&ecirc;u với biệt t&agrave;i thủy chiến đến đại tướng V&otilde; Nguy&ecirc;n Gi&aacute;p với nhiều trận đ&aacute;nh &ldquo; lừng lẫy năm ch&acirc;u, chấn động địa cầu&rdquo;... Tất cả được t&aacute;i hiện trong cuốn s&aacute;ch Những danh tướng trong lịch sử Việt Nam. H&atilde;y thử &ldquo; tr&ograve; chuyện&rdquo; c&ugrave;ng những danh tướng ấy để học th&ecirc;m được nhiều b&agrave;i học qu&yacute; gi&aacute; bạn nh&eacute;!&nbsp;</p>\r\n', '118000', 0, 20, 'b6umqyfc.jpg', '2023-05-11 09:01:32', '1', '2023-05-11 14:01:32', NULL, 1, 10, 48),
(35, 'Napoleon\'s Waterloo Army: Uniforms and Equipment', '                           In just eight weeks, Napoleon assembled 128,000 soldiers in the French Army of the North and on 15 June moved into Belgium (then a part of the kingdom of the Netherlands). Before the large Russian and Austrian armies could invade France, Napoleon hoped to defeat two coalition armies, an Anglo-Dutch-Belgian-German force under the Duke of Wellington, and a Prussian army led by Prince von Blücher. He nearly succeeded.\r\n                          ', '<p>When Napoleon returned to Paris after exile on the Island of Elba, he appealed to the European heads of state to be allowed to rule France in peace. His appeal was rejected and the Emperor of the French knew he would have to fight to keep his throne.<br />\r\n<br />\r\nIn just eight weeks, Napoleon assembled 128,000 soldiers in the French Army of the North and on 15 June moved into Belgium (then a part of the kingdom of the Netherlands). Before the large Russian and Austrian armies could invade France, Napoleon hoped to defeat two coalition armies, an Anglo-Dutch-Belgian-German force under the Duke of Wellington, and a Prussian army led by Prince von Bl&uuml;cher. He nearly succeeded.<br />\r\n<br />\r\nPaul Dawson&rsquo;s examination of the troops who fought at Ligny, Quatre-Bras and Waterloo, is based on thousands of pages of French archival documents and translations. With hundreds of photographs of original artifacts, supplemented with scores of lavish color illustrations, and dozens of paintings by the renowned military artist Keith Rocco,&nbsp;Napoleon&rsquo;s Waterloo Army&nbsp;is the most comprehensive, and extensive, study ever made of the French field army of 1815, and its uniforms, arms and equipment.</p>\r\n', '120000', 0, 10, '0ghwp4lx.jpg', '2023-05-11 09:41:01', '1', '2023-05-11 11:24:48', '1', 1, 10, 48),
(37, 'Lịch Sử Của Sách', '                           \r\n                          adsdasssssssssssssss ', '<p>dsadasdsadasdsadsad đ&acirc;sdasdasdasd</p>\r\n', '200000', 0, 20, '3xb9w7z8.jpg', '2023-05-29 11:03:36', '1', '2023-05-30 04:03:36', NULL, 1, 10, 48);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `books` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `names` text NOT NULL,
  `pictures` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `username`, `books`, `prices`, `quantities`, `names`, `pictures`, `status`, `date`) VALUES
('IKRoiMc', 'admin', '[\"35\"]', '[\"108000\"]', '[\"1\"]', '[\"Napoleon\"]', '[\"0ghwp4lx.jpg\"]', 0, '2023-06-03 11:05:39'),
('OYV0qu3', 'admin', '[\"14\",\"17\",\"32\"]', '[\"45000\",\"31680\",\"80000\"]', '[\"3\",\"1\",\"3\"]', '[\"iOS 7 Programming Fundamentals\",\"jMonkeyEngine 3.0 Beginner\",\"english streamline 3\"]', '[\"t8u20xje.jpg\",\"cq7k0i4j.jpg\",\"85dx04sy.jpg\"]', 0, '2023-06-03 11:02:47'),
('SVr9YPF', 'admin', '[\"22\",\"12\",\"17\",\"33\"]', '[\"38000\",\"20000\",\"31680\",\"80000\"]', '[\"1\",\"3\",\"1\",\"3\"]', '[\"C Programming for Arduino\",\"UnrealScript Game Programming Cookbook\",\"jMonkeyEngine 3.0 Beginner\",\"English Streamline 4\"]', '[\"siochmyg.jpg\",\"mj5oqp18.jpg\",\"cq7k0i4j.jpg\",\"a2wbh56j.jpg\"]', 0, '2023-05-31 12:02:08'),
('UgA7v5T', 'nguyenvana', '[\"3\",\"14\",\"16\",\"35\"]', '[\"10000\",\"45000\",\"27000\",\"108000\"]', '[\"1\",\"2\",\"1\",\"2\"]', '[\"Tou00e1n Lu1edbp 12\",\"iOS 7 Programming Fundamentals\",\"Advanced Programming in the UNIX Environment, 3rd Edition\",\"Napoleon\"]', '[\"s0xn1hem.jpg\",\"t8u20xje.jpg\",\"2yo48fgm.jpg\",\"0ghwp4lx.jpg\"]', 0, '2023-06-06 09:09:18');

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
(21, 'Bà Mẹ - Em Bé', 'a7p5umvo.jpg', '2023-03-30', '1', '2023-05-24', '1', 0, 1, 1),
(22, 'Chính Trị - Pháp Luật', 'v9zusgh6.jpg', '2023-03-30', '5', '0000-00-00', '1', 1, 0, 3),
(23, 'Học Ngoại Ngữ', 'wqz91l0d.jpg', '2023-03-30', '1', '0000-00-00', '1', 1, 1, 4),
(24, 'Công Nghệ Thông Tin', '0uxgyp2q.jpg', '2023-03-30', '1', '2023-04-25', '1', 1, 1, 4),
(25, 'Giáo Khoa - Giáo Trình', 'so7gmbec.jpg', '2023-03-30', '1', '2023-05-10', '1', 1, 0, 5),
(26, 'Triếc Học', '08tgxj9s.png', '2023-03-30', '1', '2023-04-25', '1', 1, 0, 6),
(27, 'Self Help', 'n3o1p82j.jpg', '2023-03-31', '1', '2023-04-25', '1', 1, 0, 7),
(28, 'Tiểu Sử - Hồi ký', '7p15v6x4.jpg', '2023-03-31', '1', '2023-05-05', '1', 1, 0, 8),
(29, 'Kinh Tế', 'g9u8z3mj.jpg', '2023-03-31', '1', '2023-05-05', '1', 1, 0, 9),
(30, 'Tâm Lý - Kỹ Năng Sống', '4ouje3ln.jpg', '2023-03-31', '1', '2023-05-05', '1', 1, 0, 11),
(48, 'Lịch Sử', '07dbc5if.jpg', '2023-05-10', '1', '2023-05-10', '1', 1, 1, 4),
(49, 'Kiến Trúc Tổng Hợp', 'ur70ncg4.jpg', '2023-05-10', '1', '2023-05-10', NULL, 1, 0, 10),
(50, 'Y Học', 'myxaignf.jpg', '2023-05-10', '1', '2023-05-10', '1', 1, 0, 5);

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
(75, 'founder 01', 1, '2023-03-30', '', '2023-03-30', NULL, '1', 5, ''),
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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
