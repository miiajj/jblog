-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2022 at 11:26 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id_bin` binary(16) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `dob` date NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `cover_img` varchar(255) DEFAULT NULL,
  `isClosed` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(32) DEFAULT NULL,
  `role` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id_bin`, `username`, `email`, `phone`, `password`, `fname`, `lname`, `gender`, `dob`, `avatar`, `cover_img`, `isClosed`, `token`, `role`) VALUES
(0x7d84ca4eadcc11eca1d854e1ada32565, 'hahaha01', 'quangnguyen1238912@gmail.com', NULL, '1b9069a96c93050095901164a51b5292', 'Nguyen', 'Hung', 1, '2000-02-03', NULL, NULL, 0, 'user_62405d9fc2e2a9.82556840', 0),
(0x98eb9c66a93a11ec9f2454e1ada32565, 'nguyenvana', 'nguyevana@gmail.com', NULL, '42bd73e712e446c6a3236a4bdb15808f', 'Văn A', 'Nguyen', 0, '2019-12-01', NULL, NULL, 0, 'user_62447e916bf839.38496025', 1),
(0xae42eb3eb8e111ec8d7a54e1ada32565, 'nguyenabc', 'huynn.ved@gmail.com', NULL, '0f458941ad5cb309b14de32db452e76f', 'Nguyễn Văn', 'Abc', 0, '2022-04-06', NULL, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(0, 'Không có'),
(1, 'Tâm sự'),
(2, 'Sách'),
(3, 'Truyền cảm hứng'),
(4, 'Khoa học'),
(5, 'Phượt'),
(6, 'Lập trình');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `account_id` binary(16) NOT NULL,
  `title` varchar(150) NOT NULL,
  `title_photo` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `photos` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` bit(1) NOT NULL DEFAULT b'0',
  `point` smallint(6) NOT NULL DEFAULT '0',
  `categories_id` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `account_id`, `title`, `title_photo`, `content`, `photos`, `created_date`, `isDeleted`, `point`, `categories_id`) VALUES
(4, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Thành công là quá khứ, thất bại là tương lai', 'photos/nguyenvana/1648809303.jpg', 'đây là barcode moi nua', NULL, '2022-03-30 16:29:23', b'1', 0, 5),
(5, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Đây là một cái title cực dài để test css thôi, nếu ai quan tâm thì ấn thử xem nó sẽ như thế nào nhé', 'photos/nguyenvana/1648802832.jpg', 'content này cũng sẽ thật dài để test xem nó hiển thị như thế nào, chắc cái này cũng tầm tải km. Một ba hai bốn bảy tám mười ba hello pro141dá54d ád4á4d ád8a7sd s87dq2wd2 qedưqs.', NULL, '2022-04-01 08:47:12', b'1', 0, 1),
(6, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Title mới cực dài khôgng chỉ có một chữu mà là rất nhiều chữ luôn đấy thêm vài chữ', 'photos/nguyenvana/1648809605.jpg', 'ảnh mới luôn này cái này cung sẽ thành hai dòng mà mình cố tình viết để test vài thứ gì đó thôi hihi. thêm', NULL, '2022-04-01 08:55:10', b'1', 0, 4),
(7, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Thành công là quá khứ, thất bại là tương lai của hôm nay', 'photos/nguyenvana/1648806574.jpg', 'đây là barcode đã sửa và sẽ viết thêm dài ơi là dài để kiểm tra xem nó hiển thị như thế nào, có bug hay không, có tràn block hay không,... Nếu nó có bug thì sẽ fix, không có bug thì đỡ phải fix và coder được phép tạm nghỉ vài tiếng.', NULL, '2022-04-01 09:49:34', b'0', 5, 0),
(8, 0x98eb9c66a93a11ec9f2454e1ada32565, 'helloviết thêm vài chữ để lên 2 dòng thôi nhìn cho nó đẹp, adasddalo 123 4 alalodso vài chữ nữa hiha', 'photos/nguyenvana/1648812955.jpg', 'lllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll', NULL, '2022-04-01 11:35:55', b'0', 0, 0),
(9, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Một ngày như hôm nay...', 'photos/nguyenvana/1648822064.jpg', 'Một chiều mưa bụi, gió lay. Ngỡ rằng từ hạ sang thu mất rồi!', NULL, '2022-04-01 14:07:44', b'0', 0, 0),
(10, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Ngày 01 tháng 04 năm 2022, hạ', '', '', NULL, '2022-04-01 14:17:30', b'1', 0, 0),
(11, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Gió mới', '', 'ngày tàn', NULL, '2022-04-01 14:18:01', b'0', 0, 0),
(12, 0x98eb9c66a93a11ec9f2454e1ada32565, 'Thu qua', '', 'Đông tới', NULL, '2022-04-01 14:34:58', b'0', 0, 0),
(13, 0x98eb9c66a93a11ec9f2454e1ada32565, 'ảnh bị null', '', 'sad', NULL, '2022-04-01 14:40:03', b'1', 0, 0),
(14, 0x98eb9c66a93a11ec9f2454e1ada32565, 'ảnh null tiếp', '', 'sád', NULL, '2022-04-01 14:41:29', b'1', 0, 0),
(15, 0x98eb9c66a93a11ec9f2454e1ada32565, 'ảnh vẫn null', '', 'null', NULL, '2022-04-01 14:42:09', b'1', 0, 0),
(16, 0xae42eb3eb8e111ec8d7a54e1ada32565, 'Hello mấy thằng ngu  sad sađưq ce crg sádqưd 2 448dư 1w8 1d8wd d', 'photos/nguyenabc/1649604076.jpg', 'Đây là bài viết đầu tiên của tôi tại jblog abc hahah zxsa..', NULL, '2022-04-10 15:21:16', b'0', 0, 0),
(17, 0xae42eb3eb8e111ec8d7a54e1ada32565, 'Lại một bài viết nữa nhảm nhí', '', 'bài viết này không có ảnh đâu', NULL, '2022-04-10 15:21:42', b'1', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id_bin`),
  ADD UNIQUE KEY `username` (`username`,`email`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`categories_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id_bin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
