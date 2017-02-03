-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2017 at 11:30 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frameusers`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `comment` tinytext NOT NULL,
  `timing` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `username`, `comment`, `timing`) VALUES
(1, 'admin', 'hi', ''),
(2, 'admin', 'how is everyone?', ''),
(3, 'admin', 'hopefully everyone is doing ok?', ''),
(4, 'admin', 'just refreshing?', ''),
(5, 'admin', 'will this work though?', ''),
(8, 'jontest', 'well does this actually allow for multiline commenting or is it gonna get the entire line out of the', ''),
(9, 'admin', 'does\r\nthis\r\ndo anything?', ''),
(10, 'admin', 'ouu shiny new color', ''),
(11, 'admin', 'just finished updating the comment page and all that shit, anyone here to critic?', ''),
(12, 'admin', 'hai!', ''),
(13, 'admin', 'anything else to add to the site before i set up account permissions?', ''),
(14, 'admin', 'might upload it to azure just to check what happens on another server', ''),
(15, 'admin', 'mmm azure is being a cheapskate on service and wants premium to work D:', ''),
(16, 'jontest', 'well fuck that >.>', ''),
(17, 'jontest', 'emm ok?', ''),
(18, 'jontest', ''''''''' ?', ''),
(19, 'jontest', 'I would say go work on UAC', ''),
(20, 'acper', 'new user with account permission controls successfully registered :D\r\n', ''),
(21, 'admin', 'testing', ''),
(22, 'admin', 'testing?', ''),
(23, 'admin', 'hai', ''),
(24, 'admin', 'hai', ''),
(25, 'admin', 'this is testing the sort', ''),
(26, 'admin', 'testin time', ''),
(27, 'admin', 'another one', '1485435038 = 2017-01-26 13:50:38'),
(28, 'admin', 'just testing time', '26-01-2017 13:52'),
(29, 'admin', 'timestamps added to comments guys\r\n', '26-01-2017 13:56'),
(33, 'admin', 'werwerrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr werwerwerew ewrwerwer', '26-01-2017 14:12'),
(36, 'admin', 'shall we begin the profile intergration?', '26-01-2017 14:43'),
(37, 'admin', 'but first upping to github', '26-01-2017 15:11'),
(38, 'admin', 'before that though some msg managements', '26-01-2017 15:13'),
(39, 'admin', 'and test', '26-01-2017 15:13'),
(40, 'admin', 'test', '26-01-2017 15:13'),
(45, 'admin', 'https://www.youtube.com/watch?v=T7k2pmKUXxI', '27-01-2017 08:34'),
(46, 'admin', 'ok gonna test another url', '27-01-2017 09:08'),
(47, 'admin', 'google.com', '27-01-2017 09:09'),
(48, 'admin', 'Link detection integration is complete!', '27-01-2017 09:15'),
(49, 'admin', 'just sum shaout', '03-02-2017 09:02');

-- --------------------------------------------------------

--
-- Table structure for table `uac`
--

CREATE TABLE `uac` (
  `pid` int(10) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uac`
--

INSERT INTO `uac` (`pid`, `description`) VALUES
(1, 'admin'),
(2, 'super-user'),
(3, 'moderator'),
(4, 'user'),
(5, 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(100) NOT NULL COMMENT 'unique user id',
  `pid` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `pid`, `username`, `password`) VALUES
(1, 1, 'admin', '$2a$09$tryingtoblowtheblowfie0e3XoSDwPAmajCpiQfMYcyTpitG8F3e'),
(2, 2, 'testredir', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(5, 4, 'testridir', '$2a$09$tryingtoblowtheblowfieQP/hPWu8EehAwzGWckL4uEPEdWzApLK'),
(6, 3, 'jontest', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(7, 1, 'admin2', '$2a$09$tryingtoblowtheblowfiemkvqz7cR1UN0RR9Nk/.9K6rt1r1L1LK'),
(8, 4, 'acper', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(18, 4, 'jotes', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(19, 4, 'newmodded', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(20, 4, 'somemorr', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(21, 4, 'another', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(22, 4, 'dsfs', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK'),
(23, 4, 'finaly', '$2a$09$tryingtoblowtheblowfiehFfR.QFQraiuGXU0pXXZJn/SYfRBRtK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `uac`
--
ALTER TABLE `uac`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `uac`
--
ALTER TABLE `uac`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT COMMENT 'unique user id', AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
