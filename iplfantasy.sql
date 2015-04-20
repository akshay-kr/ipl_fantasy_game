-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2015 at 09:25 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iplfantasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `skill` varchar(20) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `skill`, `price`) VALUES
(1, 'MS Dhoni', 'wk', 17),
(2, 'Ravindra Jadej', 'all', 15),
(3, 'Ravichandran Ashwin', 'bow', 13.5),
(4, 'Dwayne Bravo', 'all', 14.5),
(5, 'Ashish Nehra', 'bow', 12),
(6, 'Shane Watson', 'all', 11),
(7, 'Ajinkya Rahane', 'bat', 12.5),
(8, 'Steven Smith', 'bat', 15),
(9, 'Iqbal Abdullah', 'bow', 8),
(10, 'Sagar Trivedi', 'bat', 8.5),
(11, 'Shikhar Dhawan', 'bat', 16),
(12, 'Kane Williamson', 'bat', 14.5),
(13, 'Naman Ojha', 'wk', 10),
(14, 'Trent Boult', 'bow', 13),
(15, 'Laxmi Ratan Shukla', 'all', 9),
(16, 'Lasith Malinga', 'bow', 13),
(17, 'Aiden Blizzard', 'bat', 7),
(18, 'Kieron Pollard', 'all', 14.5),
(19, 'Rohit Sharma', 'bat', 15),
(20, 'Corey Anderson', 'all', 10),
(21, 'Virat Kohli', 'bat', 16.5),
(22, 'Sean Abbott', 'bow', 6),
(23, 'Dinesh Karthik', 'wk', 14),
(24, 'David Wiese', 'all', 9.5),
(25, 'AB De Villiers', 'bat', 14.5),
(26, 'Gautam Gambhir', 'bat', 13.5),
(27, 'Morne Morkel', 'bow', 14),
(28, 'Brad Hogg', 'bow', 10.5),
(29, 'Shakib Al Hasan', 'all', 13.5),
(30, 'Sheldon Jackson', 'wk', 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `team` varchar(30) NOT NULL,
  `players` varchar(50) NOT NULL,
  `squad` tinyint(4) NOT NULL,
  `budget` float NOT NULL DEFAULT '100',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
