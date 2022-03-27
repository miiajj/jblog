-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2022 at 01:17 PM
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
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id_bin`, `username`, `email`, `phone`, `password`, `fname`, `lname`, `gender`, `dob`, `avatar`, `cover_img`, `isClosed`, `token`) VALUES
(0x7d84ca4eadcc11eca1d854e1ada32565, 'hahaha01', 'quangnguyen1238912@gmail.com', NULL, '1b9069a96c93050095901164a51b5292', 'Nguyen', 'Hung', 1, '2000-02-03', NULL, NULL, 0, 'user_62405d9fc2e2a9.82556840'),
(0x98eb9c66a93a11ec9f2454e1ada32565, 'nguyenvana', 'nguyevana@gmail.com', NULL, '42bd73e712e446c6a3236a4bdb15808f', 'Văn A', 'Nguyen', 0, '2019-12-01', NULL, NULL, 0, 'user_624045a6478057.18821464'),
(0xa17f72cdac5b11ecbfb454e1ada32565, 'changtrainhobe', 'changtrainhobe@gmail.com', NULL, '7b301777dab0e5615c4e589b2731f262', 'Huy', 'Vẫn Là', 1, '2010-12-27', NULL, NULL, 0, NULL),
(0xe60dad92ab7911ec9b1654e1ada32565, 'nguyenvanz', 'nguyenvanz@gmail.com', NULL, '4bbaad6265e8f14633f049eea1985004', 'Zét', 'Nguyễn Văn', 0, '2005-06-15', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `account_id` binary(16) NOT NULL,
  `title` varchar(150) NOT NULL,
  `title_photo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `photos` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id_bin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
