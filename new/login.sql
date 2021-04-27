-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 14, 2019 at 03:28 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'a'),
(20, 'hasitha', 'hesoyam', 'a'),
(18, 'hasi', 'hasi', 'a'),
(19, 'saman', '123', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(5) NOT NULL,
  `address` varchar(70) NOT NULL,
  `speciality` varchar(20) NOT NULL,
  `is_deleted` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `username`, `password`, `user_type`, `address`, `speciality`, `is_deleted`) VALUES
(8, 'Dr.samaranayaka', 'qwe', 'd', 'nuwaraeliya', 'consaltan physian', 0),
(9, 'Dr.kulathunga', 'tharu', 'd', 'kandy', 'Allergists', 1),
(10, 'Dr.wijethunga', '1203', 'd', 'colombo 3', 'Cardiologists', 0),
(19, 'Dr.samanmai', '7898', 'd', 'kandy road,katugastota', 'Endocrinologists', 1),
(20, 'bcvbc', 'cvb', 'd', 'cvb', 'cvb', 1),
(21, 'hasitha', 'rwr', 'd', 'werwr', 'werwr', 1),
(22, 'Dr.rammandala', 'hasitha', 'd', 'colombo5', 'Mental', 0),
(23, 'Dr.karunapala', 'krra', 'd', '16 milestone,anuradhapura', 'Dental', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(2) NOT NULL,
  `telephone` int(10) NOT NULL,
  `address` varchar(70) NOT NULL,
  `is_deleted` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `username`, `password`, `user_type`, `telephone`, `address`, `is_deleted`) VALUES
(2, 'hasitha', 'qqww', 'p', 758888888, 'nuwara eliya', 0),
(3, 'anurada', '789', 'p', 717854212, 'gampaha', 0),
(4, 'banuka', 'sdhf', 'p', 785326478, 'katukithula', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
