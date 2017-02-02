-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2017 at 03:18 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `forum_id` int(10) NOT NULL,
  `forum_name` varchar(100) NOT NULL,
  `forum_desc` text NOT NULL,
  `sticky` int(1) NOT NULL,
  `timin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `forum_name`, `forum_desc`, `sticky`, `timin`) VALUES
(1, 'sample forum', 'This is a sample forum description', 1, ''),
(2, 'sample 232333', 'This is a sample forum description', 1, ''),
(3, 'das ist forum', 'das ist blod', 0, '02-02-2017 10:53'),
(4, 'will this forum work?', 'will this work doe?', 0, '02-02-2017 10:55'),
(5, 'this allows for sticky', 'Will the stick work?', 1, '02-02-2017 11:03'),
(6, 'just making more shit posts', 'hahahahahahahaha', 1, '02-02-2017 14:54'),
(7, 'more shit', 'wwqewqewqewqe', 0, '02-02-2017 14:54'),
(8, 'adasd', 'qweqwe', 0, '02-02-2017 14:55'),
(9, 'qweqwe', 'qweqwe', 0, '02-02-2017 14:55'),
(10, 'qwewqe', 'qwewqe', 0, '02-02-2017 14:56'),
(11, 'qwewqewqewqe', 'wqewqewqeq', 0, '02-02-2017 14:56');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(100) NOT NULL,
  `post_author` varchar(100) NOT NULL,
  `post_body` text NOT NULL,
  `forum_name` varchar(50) NOT NULL,
  `timin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_author`, `post_body`, `forum_name`, `timin`) VALUES
(1, 'admin', 'This is a post to sample out the bs in this bisssssssssssssssssssssssssssssssssssssssssssh thank you', 'sample forum', ''),
(2, 'admin', 'This is a post to sample out the bs in this bisssssssssssssssssssssssssssssssssssssssssssh thank you', 'sample 232333', ''),
(3, 'admin', 'a fucking dash >>', 'this allows for sticky', '02-02-2017 11:38'),
(4, 'admin', 'asdsadsad', 'this allows for sticky', '02-02-2017 11:48'),
(5, 'admin', 'well wow this works', 'das ist forum', '02-02-2017 11:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`);
ALTER TABLE `forum` ADD FULLTEXT KEY `forum_name` (`forum_name`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
