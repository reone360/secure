-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2017 at 01:09 PM
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
  `timestamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `forum_name`, `forum_desc`, `sticky`, `timestamp`) VALUES
(1, 'sample forum', 'This is a sample forum description', 1, ''),
(2, 'sample 232333', 'This is a sample forum description', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(100) NOT NULL,
  `post_name` varchar(100) NOT NULL,
  `post-author` varchar(100) NOT NULL,
  `post_body` text NOT NULL,
  `forum_name` varchar(50) NOT NULL,
  `timestamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_name`, `post-author`, `post_body`, `forum_name`, `timestamp`) VALUES
(1, 'Sample Post', 'admin', 'This is a post to sample out the bs in this bisssssssssssssssssssssssssssssssssssssssssssh thank you', '', ''),
(2, 'Sample Post', 'admin', 'This is a post to sample out the bs in this bisssssssssssssssssssssssssssssssssssssssssssh thank you', 'sample 232333', '');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(100) NOT NULL,
  `reply_author` varchar(100) NOT NULL,
  `reply_body` text NOT NULL,
  `forum_name` varchar(50) NOT NULL,
  `post_name` varchar(50) NOT NULL,
  `timestamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `reply_author`, `reply_body`, `forum_name`, `post_name`, `timestamp`) VALUES
(1, 'jontest', 'this is just a reply to the bs that plagues us', '', '', ''),
(2, 'jontest', 'this is just a reply to the bs that plagues us', 'sample forum', 'Sample Post', '');

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
ALTER TABLE `post` ADD FULLTEXT KEY `post_name` (`post_name`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
