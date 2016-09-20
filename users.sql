-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2016 at 04:00 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zocial`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(16) unsigned NOT NULL,
  `email` varchar(64) NOT NULL,
  `xuid` bigint(32) NOT NULL,
  `zuid` varchar(36) NOT NULL,
  `zuneTag` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `status` varchar(60) NOT NULL,
  `bio` varchar(300) NOT NULL,
  `location` varchar(30) NOT NULL,
  `avatar` varchar(32) NOT NULL DEFAULT 'default/classicSmile.jpg',
  `background` varchar(32) NOT NULL DEFAULT 'default/lines.jpg',
  `password` varchar(45) NOT NULL,
  `salt` varchar(18) NOT NULL,
  `updated` varchar(30) NOT NULL,
  `playcount` int(12) NOT NULL DEFAULT '0',
  `terms` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `zuneTag` (`zuneTag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(16) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
