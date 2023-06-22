-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2015 at 02:41 PM
-- Server version: 5.5.16
-- PHP Version: 5.4.43

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mpprecruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_directorate`
--

CREATE TABLE IF NOT EXISTS `m_directorate` (
  `directorate_id` int(11) NOT NULL AUTO_INCREMENT,
  `directorate_name` varchar(250) NOT NULL,
  `directorate_code` varchar(50) NOT NULL,
  `status_id` varchar(10) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`directorate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `m_directorate`
--

INSERT INTO `m_directorate` (`directorate_id`, `directorate_name`, `directorate_code`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 'HUMAN CAPITAL', 'HC', 'active', 1, '2015-09-10 10:09:41', 1, '2015-09-10 03:09:45'),
(2, 'INFORMATION TECHNOLOGY', 'IT', 'active', 1, '2015-10-22 09:21:33', 1, '2015-10-22 02:21:35'),
(3, 'RISK MANAGEMENT', 'RM', 'active', 1, '2015-10-22 09:21:56', 1, '2015-10-22 02:21:58');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
