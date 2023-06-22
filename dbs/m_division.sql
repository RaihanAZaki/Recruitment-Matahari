-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2015 at 02:44 PM
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
-- Table structure for table `m_division`
--

CREATE TABLE IF NOT EXISTS `m_division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `directorate_id` int(11) NOT NULL,
  `division_name` varchar(250) NOT NULL,
  `division_code` varchar(25) NOT NULL,
  `status_id` varchar(10) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`division_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `m_division`
--

INSERT INTO `m_division` (`division_id`, `directorate_id`, `division_name`, `division_code`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'Human Resource Information System', 'HRIS', 'active', 1, '2015-09-10 10:10:19', 1, '2015-09-10 03:10:21'),
(2, 2, 'Information Technology', 'IT', 'active', 1, '2015-10-12 09:22:34', 1, '2015-10-22 02:22:40'),
(3, 1, 'Recruitment', 'REC', 'active', 1, '2015-10-22 09:23:03', 1, '2015-10-22 02:23:04'),
(4, 1, 'Assessment', 'AST', 'active', 1, '2015-10-22 09:23:22', 1, '2015-10-22 02:23:23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
