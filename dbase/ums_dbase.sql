-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2012 at 11:21 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ums_dbase`
--
CREATE DATABASE IF NOT EXISTS `ums_dbase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ums_dbase`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `token_expire` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `active`, `token`, `token_expire`) VALUES
('andre', 'testing', 1, '69cda5070b4761adbcd486156b005870', '2012-11-21 16:45:06'),
('testing', 'testing', 1, 'd7a2e45462de9fcd5cd7dab1c3c72976', '2012-11-20 17:42:21'),
('アンドレ', 'testing', 1, 'e0b6a8619ee104fcfac038f3aa425601', '2012-11-22 18:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_email`
--

DROP TABLE IF EXISTS `user_email`;
CREATE TABLE IF NOT EXISTS `user_email` (
  `email` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_email`
--

INSERT INTO `user_email` (`email`, `user_id`) VALUES
('abc@abc.co.id', 'testing'),
('abc@abc.com', 'andre'),
('abc@gotandadenshi.jp', 'andre'),
('abz@gotandadenshi.jp', 'アンドレ'),
('chocolate@chocolate.co.jp', 'testing'),
('chocolate@chocolate.jp', 'andre'),
('elek@elek.com', 'andre'),
('sinta@sinta.co.jp', 'testing'),
('testing@testing.com', 'testing');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
