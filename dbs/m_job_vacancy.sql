-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2015 at 09:18 AM
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
-- Table structure for table `m_job_vacancy`
--

CREATE TABLE IF NOT EXISTS `m_job_vacancy` (
  `job_vacancy_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_vacancy_name` varchar(250) NOT NULL,
  `job_vacancy_city` varchar(50) NOT NULL,
  `job_vacancy_desc` text NOT NULL,
  `job_vacancy_brief` text NOT NULL,
  `job_vacancy_degree` varchar(25) NOT NULL,
  `job_vacancy_gender` varchar(6) DEFAULT NULL,
  `job_vacancy_agemax` varchar(2) DEFAULT NULL,
  `job_vacancy_marital` varchar(15) DEFAULT NULL,
  `job_vacancy_experience` varchar(2) DEFAULT NULL,
  `job_vacancy_type` varchar(25) NOT NULL,
  `job_vacancy_startdate` date NOT NULL,
  `job_vacancy_enddate` date NOT NULL,
  `job_vacancy_requestby` int(11) NOT NULL DEFAULT '0',
  `job_vacancy_minsalary` int(10) NOT NULL DEFAULT '0',
  `job_vacancy_maxsalary` int(10) NOT NULL DEFAULT '0',
  `job_vacancy_grade` varchar(5) DEFAULT NULL,
  `log_auth_id` int(11) NOT NULL,
  `job_vacancy_approver` int(11) NOT NULL,
  `status_id` varchar(10) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`job_vacancy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
