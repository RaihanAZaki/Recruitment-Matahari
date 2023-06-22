-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2015 at 05:34 PM
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
-- Table structure for table `log_auth`
--

CREATE TABLE IF NOT EXISTS `log_auth` (
  `log_auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `log_auth_name` varchar(250) NOT NULL,
  `log_auth_passwd` varchar(250) NOT NULL,
  `log_auth_role` varchar(25) NOT NULL,
  `log_auth_lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_auth_lastip` varchar(200) NOT NULL,
  `register_id` int(11) NOT NULL DEFAULT '0',
  `register_date` datetime NOT NULL,
  `register_activation_code` text NOT NULL,
  `register_activation_date` date DEFAULT NULL,
  `status_id` varchar(10) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`log_auth_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `log_auth`
--

INSERT INTO `log_auth` (`log_auth_id`, `employee_id`, `log_auth_name`, `log_auth_passwd`, `log_auth_role`, `log_auth_lastlogin`, `log_auth_lastip`, `register_id`, `register_date`, `register_activation_code`, `register_activation_date`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'shakti.santoso@hypermart.co.id', 'E/Pe9Q/bKhPyeTuIifQm8/KqNJzFmUW217G5qXxLcM6', 'admin', '2015-11-17 08:37:04', 'TimothyGabrielB / 127.0.0.1', 0, '2015-09-10 10:18:37', 'activationcode', NULL, 'active', 1, '2015-09-10 10:19:06', 1, '2015-11-04 16:01:22'),
(2, 2, 'hris.msm@hypermart.co.id', 'kZyJHzr7.4k52vXKLo1HrPs8G.jqFtAbsWc7iV.5cd6', 'hrd', '2015-09-10 03:40:53', '172.0.0.1', 0, '2015-09-10 10:41:08', 'activationcode', NULL, 'inactive', 1, '2015-09-10 10:41:22', 1, '2015-11-04 16:52:32'),
(3, 3, 'matius.lim@hypermart.co.id', 'tCZKGELTovkXt6ZGIn..CLt22.Edx1x92E1aSxSC/.D', 'pic', '2015-11-04 09:57:01', 'TimothyGabrielB / 127.0.0.1', 0, '2015-09-10 10:48:38', 'activationcode', NULL, 'inactive', 1, '2015-09-10 10:48:47', 1, '2015-11-04 16:52:37'),
(4, 0, 'shakti_santoso@yahoo.com', 'NedhoPZKYRsn90FqLo/iKlA5RDx0c9NwTjZU0NLRHPA', 'candid', '2015-11-16 09:31:43', 'TimothyGabrielB / 127.0.0.1', 1, '2015-09-14 00:00:00', 'actcode', '2015-10-08', 'active', 1, '2015-09-14 00:00:00', 1, '2015-09-14 01:54:18'),
(10, 0, 'shaktisantoso@gmail.com', '/b92ZyTTxgb6.dBPFiMSJn1zzrk7IGropNP9RvbKcZ5', 'candid', '2015-10-27 01:55:57', 'TimothyGabrielB / 127.0.0.1', 5, '2015-10-26 11:37:47', '$5$rounds=5000$8d813f7cde0b7f9c$rKFcaoOmG5KIiEacZw9F3eYOzDXIGTq.soOJRmT1Ul5', '2015-10-26', 'active', 0, '2015-10-26 11:55:19', 0, '2015-10-26 11:55:19'),
(6, 0, 'lindi@yahoo.com', '3Fk6Q095.ExsTnvjZGUDAeli944cKP6rdIgKynCZGc5', 'candid', '2015-11-09 02:17:10', 'TimothyGabrielB / 127.0.0.1', 2, '2015-10-08 12:17:35', '$5$rounds=5000$8d813f7cde0b7f9c$a6sRhp/ui1LZpY1R4tXnURS6Ws8PR08IOzbtRv3FN46', '2015-10-08', 'active', 0, '2015-10-08 13:39:34', 0, '2015-10-08 13:39:34'),
(7, 0, 'chrisbintari.deta@yahoo.com', '8JYw8yVH88GO4muQlByU3g4okGfD/HfAxdQBPkFJ0v5', 'candid', '2015-10-16 02:17:08', 'TimothyGabrielB / 127.0.0.1', 3, '2015-10-15 16:36:35', '$5$rounds=5000$8d813f7cde0b7f9c$ntCbU0.4ZPOhnax8kFncfaAKs/rAmHZJqwugEM9HbA2', '2015-10-15', 'active', 0, '2015-10-15 16:36:56', 0, '2015-10-15 16:36:56'),
(8, 4, 'debbie.suryatenggara@hypermart.co.id', '6N.0ibeB/N3dPl/Plwng6Q/XB.f2g5gVXqN8x80Eu3/', 'pic', '2015-11-16 02:05:58', 'TimothyGabrielB / 127.0.0.1', 0, '2015-10-22 16:04:45', 'activationcode', '2015-10-22', 'active', 1, '2015-10-22 16:04:13', 1, '2015-10-22 16:04:15'),
(9, 5, 'theresia.histi@hypermart.co.id', 'DF3dW9Y1jkXPXL3uRCQkrBPMIgzpPee2yuHqPmn7Jl6', 'hrd', '2015-10-22 10:05:23', '172.0.0.1', 0, '2015-10-22 17:05:39', 'activationcode', '2015-10-22', 'active', 1, '2015-10-22 17:05:48', 1, '2015-10-22 17:05:51'),
(11, 0, 'suckteas@gmail.com', 'j6ZZ9tNnMoCHI3XJHgRxEy/0NRK0sqQJLfxeQFQ.KG.', 'candid', '2015-11-11 04:46:49', 'TimothyGabrielB / 127.0.0.1', 6, '2015-10-30 15:18:01', '$5$rounds=5000$8d813f7cde0b7f9c$x06HqRovh5vC26CVYUMu22nZHSJwnVG6S5qU31/5wi8', '2015-10-30', 'active', 8, '2015-10-30 15:18:01', 8, '2015-10-30 15:18:01'),
(12, 6, 'skolastikametawedika@hypermart.co.id', 'BY5YSBfKMrp1BN4nYfNNYy7VCcCSY.HpOhdfywlekG5', 'pic', '2015-11-04 08:48:06', 'TimothyGabrielB / 127.0.0.1', 0, '2015-11-04 14:35:49', 'activationcode', '2015-11-04', 'active', 1, '2015-11-04 14:35:49', 1, '2015-11-04 15:45:32'),
(13, 7, 'lidya.dessyana@hypermart.co.id', '.2Cl35Iy.uBKos/B4qhDnDjNf.BFDpBV4pX6PNBdou6', 'pic', '2015-11-04 09:09:33', 'TimothyGabrielB / 127.0.0.1', 0, '2015-11-04 16:08:01', 'activationcode', '2015-11-04', 'active', 1, '2015-11-04 16:08:01', 1, '2015-11-05 08:43:16'),
(14, 0, 'laurensia.lindi@gmail.com', 'RzEPicPNvnSwvLRkBIvzbiZveb0xdpNTX8a1KU7kvT2', 'candid', '2015-11-16 08:28:55', '127.0.0.1', 8, '2015-11-12 14:26:10', '$5$rounds=5000$8d813f7cde0b7f9c$V.UJagSgDezI0MB.O6/kS.LsJGU2xYhFQ3JtW6K33KA', '2015-11-16', 'active', 8, '2015-11-16 15:28:55', 8, '2015-11-16 15:28:55'),
(15, 0, 'christfolma@gmail.com', 'vWB4CROY1LNjJBn3V2.nR8POdtveg/tiRO0CH/pLh01', 'candid', '2015-11-17 08:39:52', '127.0.0.1', 9, '2015-11-17 15:39:52', '$5$rounds=5000$8d813f7cde0b7f9c$Ox12l1VRb5YgJEd5Ne1dAKyLkehuIjF4D0wtqn//QX9', '2015-11-17', 'active', 1, '2015-11-17 15:39:52', 1, '2015-11-17 15:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate`
--

CREATE TABLE IF NOT EXISTS `m_candidate` (
  `candidate_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_auth_id` int(11) NOT NULL,
  `candidate_name` varchar(100) NOT NULL,
  `candidate_email` varchar(100) NOT NULL,
  `candidate_gender` varchar(6) NOT NULL,
  `candidate_religion` varchar(15) DEFAULT NULL,
  `candidate_birthplace` varchar(100) NOT NULL,
  `candidate_birthdate` date NOT NULL,
  `candidate_race` varchar(25) DEFAULT NULL,
  `candidate_nationality` varchar(3) DEFAULT NULL,
  `candidate_country` varchar(25) DEFAULT NULL,
  `candidate_idtype` varchar(8) NOT NULL,
  `candidate_idcard` varchar(16) NOT NULL,
  `candidate_marital` varchar(8) DEFAULT NULL,
  `candidate_bodyheight` decimal(5,2) DEFAULT NULL,
  `candidate_bodyweight` decimal(5,2) DEFAULT NULL,
  `candidate_bloodtype` varchar(3) DEFAULT NULL,
  `candidate_sim_a` varchar(12) DEFAULT NULL,
  `candidate_sim_c` varchar(12) DEFAULT NULL,
  `candidate_npwp` varchar(20) DEFAULT NULL,
  `candidate_p_address` text,
  `candidate_p_city` varchar(50) DEFAULT NULL,
  `candidate_p_postcode` varchar(5) DEFAULT NULL,
  `candidate_c_address` text,
  `candidate_c_city` varchar(50) DEFAULT NULL,
  `candidate_c_postcode` varchar(50) DEFAULT NULL,
  `candidate_hp1` varchar(25) NOT NULL,
  `candidate_hp2` varchar(25) NOT NULL,
  `candidate_phone` varchar(25) DEFAULT NULL,
  `candidate_cp_name1` varchar(50) DEFAULT NULL,
  `candidate_cp_relation1` varchar(20) DEFAULT NULL,
  `candidate_cp_phone1` varchar(25) DEFAULT NULL,
  `candidate_cp_name2` varchar(50) DEFAULT NULL,
  `candidate_cp_relation2` varchar(20) DEFAULT NULL,
  `candidate_cp_phone2` varchar(25) DEFAULT NULL,
  `candidate_ref_name` varchar(50) DEFAULT NULL,
  `candidate_ref_division` varchar(50) DEFAULT NULL,
  `candidate_ref_position` varchar(50) DEFAULT NULL,
  `candidate_expected_salary` varchar(15) DEFAULT NULL,
  `candidate_hobby` text,
  `status_id` varchar(10) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `m_candidate`
--

INSERT INTO `m_candidate` (`candidate_id`, `log_auth_id`, `candidate_name`, `candidate_email`, `candidate_gender`, `candidate_religion`, `candidate_birthplace`, `candidate_birthdate`, `candidate_race`, `candidate_nationality`, `candidate_country`, `candidate_idtype`, `candidate_idcard`, `candidate_marital`, `candidate_bodyheight`, `candidate_bodyweight`, `candidate_bloodtype`, `candidate_sim_a`, `candidate_sim_c`, `candidate_npwp`, `candidate_p_address`, `candidate_p_city`, `candidate_p_postcode`, `candidate_c_address`, `candidate_c_city`, `candidate_c_postcode`, `candidate_hp1`, `candidate_hp2`, `candidate_phone`, `candidate_cp_name1`, `candidate_cp_relation1`, `candidate_cp_phone1`, `candidate_cp_name2`, `candidate_cp_relation2`, `candidate_cp_phone2`, `candidate_ref_name`, `candidate_ref_division`, `candidate_ref_position`, `candidate_expected_salary`, `candidate_hobby`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 4, 'Shakti Candidates', 'shakti_santoso@yahoo.com', 'male', 'Roman Catholic', 'Yogyakarta', '1981-04-12', 'Jawa Tionghoa', 'wni', 'Indonesia', 'KTP', '1234567890123456', 'Married', '165.00', '70.00', 'O', '123456789111', '123456789222', '123456789012345', 'Kumetiran Kidul GT 2 No. 774\\r\\nYogyakarta', 'Kota Yogyakarta', '55272', 'Sukamandiri\\r\\nNo. 29', 'Kota Tangerang Selatan', '', '085647848573', '083877750802', '', 'Lindi', 'Wife', '083871186400', 'Lian Sien', 'Mother', '081915533774', 'Matius Lim', 'Human Capital/ HRIS', 'General Manager', '30000000', 'makan\\r\\ntidur\\r\\njajan', 'active', 4, '2015-09-14 10:14:27', 4, '2015-11-06 07:57:25'),
(6, 11, 'Suckteas Gmail', 'suckteas@gmail.com', 'male', NULL, 'Kota Kupang', '1989-04-21', NULL, 'wni', 'Indonesia', 'KTP', '1234567890123459', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085647848577', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', 8, '2015-10-30 15:18:01', 8, '2015-10-30 08:18:01'),
(3, 6, 'Lindi Params', 'lindi@yahoo.com', 'female', 'Roman Catholic', 'Kota Tangerang Selatan', '1984-09-07', 'Jawa', 'wna', 'Timor Leste', 'Passport', '9989876512', 'Married', '153.00', '60.00', 'B+', '', '', '', 'Pamulang', 'Kota Tangerang Selatan', '', 'Ciputat', 'Kota Tangerang Selatan', '', '083871186400', '', '', 'Lian Sien', 'Relatives', '081915533774', '', '', '', '', '', '', '', 'rolling rollings', 'active', 6, '2015-10-08 13:39:34', 8, '2015-10-28 02:28:08'),
(4, 7, 'Deta Chris Bintari', 'chrisbintari.deta@yahoo.com', 'female', 'Roman Catholic', 'Kab. Muara Enim', '1986-12-31', '', 'wni', 'Indonesia', 'KTP', '1234567890123455', 'Married', '0.00', '0.00', '', '', '', '', 'alamat tetap deta', 'Kab. Muara Enim', '', 'ubud', 'Kota Tangerang', '', '085966343321', '', '', 'contact nya deta', 'Husband', '0898873222', '', '', '', NULL, NULL, NULL, NULL, '', 'active', 7, '2015-10-15 16:36:56', 7, '2015-10-16 02:46:46'),
(5, 10, 'Shakti Gmail', 'shaktisantoso@gmail.com', 'male', NULL, 'Kota Yogyakarta', '1982-05-13', NULL, 'wni', 'Indonesia', 'KTP', '1234567890123457', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '085647848572', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', 10, '2015-10-26 11:55:19', 10, '2015-10-26 04:55:19'),
(7, 14, 'Laurensia Lindi', 'laurensia.lindi@gmail.com', 'female', NULL, 'Jakarta Selatan', '1984-09-07', NULL, 'wni', 'Indonesia', 'KTP', '1234567890123458', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '083871186402', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', 8, '2015-11-16 15:28:55', 8, '2015-11-16 08:28:55'),
(8, 15, 'Christ Folma DIo', 'christfolma@gmail.com', 'male', 'Roman Catholic', 'Jakarta Barat', '1993-11-24', '', 'wni', 'Indonesia', 'KTP', '', 'Single', '0.00', '0.00', '', '', '', '', 'alamat tetap', 'Jakarta Barat', '', 'alamat surat', 'Jakarta Barat', '', '0821123455633', '', '', 'bapak', 'Father', '02122222', '', '', '', '', '', '', '', '', 'active', 1, '2015-11-17 15:39:52', 1, '2015-11-17 09:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_edu`
--

CREATE TABLE IF NOT EXISTS `m_candidate_edu` (
  `candidate_edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_edu_degree` varchar(25) NOT NULL,
  `candidate_edu_institution` varchar(100) NOT NULL,
  `candidate_edu_major` varchar(100) NOT NULL,
  `candidate_edu_gpa` varchar(4) NOT NULL,
  `candidate_edu_city` varchar(50) NOT NULL,
  `candidate_edu_start` int(4) NOT NULL,
  `candidate_edu_end` int(4) NOT NULL,
  `candidate_edu_notes` text NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_edu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `m_candidate_edu`
--

INSERT INTO `m_candidate_edu` (`candidate_edu_id`, `candidate_id`, `candidate_edu_degree`, `candidate_edu_institution`, `candidate_edu_major`, `candidate_edu_gpa`, `candidate_edu_city`, `candidate_edu_start`, `candidate_edu_end`, `candidate_edu_notes`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'Bachelor - S1', 'Universitas Sanata Dharma', 'Information Technology Informatics Engineering', '3.56', 'Yogyakarta', 1999, 2004, 'Graduated', 4, '2015-09-20 00:00:00', 4, '2015-11-06 10:02:34'),
(2, 1, 'Diploma', 'Universitas Sanata Dharma', 'English Literature', '3.24', 'Yogyakarta', 2001, 2004, 'Graduated', 4, '2015-09-20 00:00:00', 4, '2015-11-06 10:02:34'),
(3, 1, 'Highschool - SMA', 'SMU Negeri 10', '', '1.00', 'Kota Yogyakarta', 1996, 1999, 'Graduated', 4, '2015-09-20 00:00:00', 4, '2015-11-06 10:02:34'),
(4, 1, 'Junior Highschool - SMP', 'SMP Negeri 7', '', '1.00', 'Kota Yogyakarta', 1993, 1996, 'lulus aduhai', 4, '2015-10-02 10:48:18', 4, '2015-11-06 10:02:34'),
(5, 1, 'Master - S2', 'Univ. Mercu Buana Mereuya Selatan', 'HR and Knowledge Management', '3.90', 'Jakarta Barat', 2015, 2015, 'belum lulus', 4, '2015-10-02 10:54:53', 4, '2015-11-06 10:02:34'),
(7, 3, 'Bachelor - S1', 'Univ. Atma Jaya jakarta', 'Psychology', '3.23', 'Jakarta Selatan', 2003, 2007, 'luluss', 6, '2015-10-08 13:42:43', 6, '2015-10-08 09:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_family`
--

CREATE TABLE IF NOT EXISTS `m_candidate_family` (
  `candidate_family_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_family_relation` varchar(20) NOT NULL,
  `candidate_family_name` varchar(100) NOT NULL,
  `candidate_family_birthplace` varchar(100) NOT NULL,
  `candidate_family_birthdate` date NOT NULL,
  `candidate_family_lastedu` varchar(25) DEFAULT NULL,
  `candidate_family_lastjob` varchar(50) DEFAULT NULL,
  `candidate_family_company` varchar(100) DEFAULT NULL,
  `candidate_family_rip` varchar(5) DEFAULT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_family_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `m_candidate_family`
--

INSERT INTO `m_candidate_family` (`candidate_family_id`, `candidate_id`, `candidate_family_relation`, `candidate_family_name`, `candidate_family_birthplace`, `candidate_family_birthdate`, `candidate_family_lastedu`, `candidate_family_lastjob`, `candidate_family_company`, `candidate_family_rip`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(4, 1, 'Son', 'Pradipto Wiro Seno', 'Kota Tangerang Selatan', '2015-06-13', '', 'Baby', 'family', 'Alive', 4, '2015-10-01 11:19:53', 8, '2015-11-02 02:42:16'),
(3, 1, 'Mother', 'Tri Nurdhayati DS', 'Kota Yogyakarta', '1952-09-29', 'Highschool - SMA', 'Housewife', 'family', 'Alive', 4, '2015-10-01 11:19:53', 8, '2015-11-02 02:42:16'),
(2, 1, 'Spouse', 'Laurensia Lindi P', 'Jakarta Timur', '1984-09-07', 'Master Degree - S2', 'Konselor', 'UMN', 'Alive', 4, '2015-10-01 11:19:53', 8, '2015-11-02 02:42:16'),
(1, 1, 'Father', 'Moh. Santoso', 'Kota Yogyakarta', '1948-12-19', 'Highschool - SMA', 'Wiraswasta', 'AU', 'Alive', 4, '2015-10-01 11:19:53', 8, '2015-11-02 02:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_file`
--

CREATE TABLE IF NOT EXISTS `m_candidate_file` (
  `candidate_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_file_name` varchar(200) NOT NULL,
  `candidate_file_type` varchar(20) NOT NULL,
  `candidate_file_notes` varchar(250) DEFAULT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `m_candidate_file`
--

INSERT INTO `m_candidate_file` (`candidate_file_id`, `candidate_id`, `candidate_file_name`, `candidate_file_type`, `candidate_file_notes`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'passphoto20151102112338_1.jpg', 'passphoto', NULL, 4, '2015-09-27 13:48:45', 4, '2015-11-02 04:23:38'),
(2, 1, 'coverletter20151005001801_1.pdf', 'coverletter', NULL, 4, '2015-09-29 12:02:40', 4, '2015-10-04 17:18:01'),
(3, 1, 'ijazah20151102110852_1.pdf', 'ijazah', NULL, 4, '2015-09-29 12:38:09', 4, '2015-11-02 04:08:52'),
(4, 1, 'transcript20150929124548_1.pdf', 'transcript', NULL, 4, '2015-09-29 12:44:52', 4, '2015-09-29 05:45:48'),
(5, 1, 'idcard20151102110716_1.jpg', 'idcard', NULL, 4, '2015-09-29 12:52:13', 4, '2015-11-02 04:07:16'),
(6, 3, 'passphoto20151014225656_3.jpg', 'passphoto', NULL, 6, '2015-10-14 22:56:56', 6, '2015-10-14 15:56:56'),
(7, 3, 'coverletter20151014225800_3.pdf', 'coverletter', NULL, 6, '2015-10-14 22:58:00', 6, '2015-10-14 15:58:00'),
(8, 3, 'ijazah20151014225853_3.pdf', 'ijazah', NULL, 6, '2015-10-14 22:58:53', 6, '2015-10-14 15:58:53'),
(9, 3, 'transcript20151014225938_3.pdf', 'transcript', NULL, 6, '2015-10-14 22:59:38', 6, '2015-10-14 15:59:38'),
(10, 3, 'idcard20151014230004_3.jpg', 'idcard', NULL, 6, '2015-10-14 23:00:04', 6, '2015-10-14 16:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_fileothers`
--

CREATE TABLE IF NOT EXISTS `m_candidate_fileothers` (
  `candidate_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_file_name` varchar(200) NOT NULL,
  `candidate_file_notes` varchar(250) DEFAULT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `m_candidate_fileothers`
--

INSERT INTO `m_candidate_fileothers` (`candidate_file_id`, `candidate_id`, `candidate_file_name`, `candidate_file_notes`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'others20151020143104_1.pdf', 'tiket semarang', 4, '2015-10-20 14:31:05', 4, '2015-10-20 07:31:05'),
(5, 1, 'others20151102112201_1.pdf', 'brosur', 8, '2015-11-02 11:22:01', 8, '2015-11-02 04:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_jobexp`
--

CREATE TABLE IF NOT EXISTS `m_candidate_jobexp` (
  `candidate_jobexp_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_jobexp_company` varchar(100) NOT NULL,
  `candidate_jobexp_address` varchar(250) DEFAULT NULL,
  `candidate_jobexp_phone` varchar(25) DEFAULT NULL,
  `candidate_jobexp_lob` varchar(100) DEFAULT NULL,
  `candidate_jobexp_numemployee` int(11) DEFAULT '0',
  `candidate_jobexp_position` varchar(50) NOT NULL,
  `candidate_jobexp_start` date NOT NULL,
  `candidate_jobexp_end` date NOT NULL,
  `candidate_jobexp_desc` text,
  `candidate_jobexp_salary` int(11) DEFAULT '0',
  `candidate_jobexp_spvname` varchar(25) DEFAULT NULL,
  `candidate_jobexp_spvposition` varchar(50) DEFAULT NULL,
  `candidate_jobexp_subposition` varchar(50) DEFAULT NULL,
  `candidate_jobexp_subnumber` int(11) DEFAULT '0',
  `candidate_jobexp_leaving` varchar(250) DEFAULT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_jobexp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `m_candidate_jobexp`
--

INSERT INTO `m_candidate_jobexp` (`candidate_jobexp_id`, `candidate_id`, `candidate_jobexp_company`, `candidate_jobexp_address`, `candidate_jobexp_phone`, `candidate_jobexp_lob`, `candidate_jobexp_numemployee`, `candidate_jobexp_position`, `candidate_jobexp_start`, `candidate_jobexp_end`, `candidate_jobexp_desc`, `candidate_jobexp_salary`, `candidate_jobexp_spvname`, `candidate_jobexp_spvposition`, `candidate_jobexp_subposition`, `candidate_jobexp_subnumber`, `candidate_jobexp_leaving`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(4, 1, 'Hurray Company', '', '', 'Consulting (Human Resource, Business and Management)', 80, 'Senior Engineer Level 4', '2011-03-01', '2015-08-01', 'developing system\\r\\ndesigning interface', 10000000, 'Cuk', 'Manajer', 'Engineer', 2, 'better worklife balance', 4, '2015-10-02 15:33:47', 8, '2015-11-02 02:05:54'),
(5, 1, 'Megah Abadi', 'Kumetiran', '', 'Printing / Publishing', 1, 'Web Developer', '2006-04-01', '2011-02-01', 'developing web', 0, '', '', '', 0, 'bankrupt', 4, '2015-10-02 16:15:51', 8, '2015-11-02 02:05:54'),
(6, 1, 'ABC', 'Jl. Wahidin', '', 'Computer / Information Technology (Software)', 5, 'Programmer', '2005-01-01', '2006-01-01', 'Creating Web', 0, '', '', '', 0, '', 8, '2015-11-02 09:05:22', 8, '2015-11-02 02:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_language`
--

CREATE TABLE IF NOT EXISTS `m_candidate_language` (
  `candidate_language_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_language_name` varchar(50) NOT NULL,
  `candidate_language_read` varchar(20) NOT NULL,
  `candidate_language_write` varchar(20) NOT NULL,
  `candidate_language_conversation` varchar(20) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_language_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `m_candidate_language`
--

INSERT INTO `m_candidate_language` (`candidate_language_id`, `candidate_id`, `candidate_language_name`, `candidate_language_read`, `candidate_language_write`, `candidate_language_conversation`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'English', 'Advance', 'Advance', 'Intermediate', 4, '2015-10-01 09:48:35', 8, '2015-11-02 02:41:29'),
(3, 1, 'Jawa', 'Elementary', 'Elementary', 'Master', 4, '2015-10-01 11:25:26', 8, '2015-11-02 02:41:29'),
(4, 1, 'Indonesia', 'Master', 'Master', 'Master', 8, '2015-11-02 09:41:29', 8, '2015-11-02 02:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_organization`
--

CREATE TABLE IF NOT EXISTS `m_candidate_organization` (
  `candidate_organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_organization_name` varchar(250) NOT NULL,
  `candidate_organization_role` varchar(25) NOT NULL,
  `candidate_organization_start` varchar(4) NOT NULL,
  `candidate_organization_end` varchar(6) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_organization_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `m_candidate_organization`
--

INSERT INTO `m_candidate_organization` (`candidate_organization_id`, `candidate_id`, `candidate_organization_name`, `candidate_organization_role`, `candidate_organization_start`, `candidate_organization_end`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(2, 1, 'Gregorius Caecilia Choir', 'Officer', '2001', '2013', 4, '2015-09-25 08:59:25', 8, '2015-11-02 02:15:34'),
(1, 1, 'Toastmasters International', 'Vice President', '2011', '2015', 4, '2015-09-30 17:30:26', 8, '2015-11-02 02:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_skill`
--

CREATE TABLE IF NOT EXISTS `m_candidate_skill` (
  `candidate_skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_skill_name` varchar(25) NOT NULL,
  `candidate_skill_level` varchar(20) NOT NULL,
  `candidate_skill_notes` text NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_skill_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `m_candidate_skill`
--

INSERT INTO `m_candidate_skill` (`candidate_skill_id`, `candidate_id`, `candidate_skill_name`, `candidate_skill_level`, `candidate_skill_notes`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'Debus Banten', 'Advance', 'Belajar debus dengan ceria dan gembira.\\r\\nDilatih langsung sama Limbad.', 4, '2015-09-25 10:35:50', 8, '2015-11-02 02:33:14'),
(3, 1, 'Totok wajah', 'Beginner', 'notok wajah sekali langsung cakep\\r\\n\\r\\nkeren kans', 4, '2015-10-01 09:14:05', 8, '2015-11-02 02:33:14'),
(4, 1, 'Barongsay', 'Beginner', '', 4, '2015-10-16 16:45:41', 8, '2015-11-02 02:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `m_candidate_training`
--

CREATE TABLE IF NOT EXISTS `m_candidate_training` (
  `candidate_training_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_training_name` varchar(100) NOT NULL,
  `candidate_training_institution` varchar(100) NOT NULL,
  `candidate_training_city` varchar(50) NOT NULL,
  `candidate_training_year` int(4) NOT NULL,
  `candidate_training_duration` varchar(10) NOT NULL,
  `candidate_training_sponsor` varchar(50) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_training_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `m_candidate_training`
--

INSERT INTO `m_candidate_training` (`candidate_training_id`, `candidate_id`, `candidate_training_name`, `candidate_training_institution`, `candidate_training_city`, `candidate_training_year`, `candidate_training_duration`, `candidate_training_sponsor`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(5, 1, 'CNAP', 'NetCampus', 'Jakarta Timur', 2013, '3 bulan', 'Pribadi juga', 4, '2015-10-02 09:47:34', 8, '2015-11-02 02:24:02'),
(6, 1, 'Leaderships', 'Kopassus', 'Kota Bekasi', 2012, '5 hari', 'Perusahaan', 4, '2015-10-02 09:47:34', 8, '2015-11-02 02:24:02'),
(7, 1, 'Menghias kueh', 'Bogasari', 'Kota Yogyakarta', 2015, '3 hari', 'tabungan pribadi', 4, '2015-10-02 09:47:34', 8, '2015-11-02 02:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `m_city`
--

CREATE TABLE IF NOT EXISTS `m_city` (
  `city_id` int(3) DEFAULT NULL,
  `city_province` varchar(25) DEFAULT NULL,
  `city_name` varchar(29) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_city`
--

INSERT INTO `m_city` (`city_id`, `city_province`, `city_name`) VALUES
(1, 'Nanggroe Aceh Darusalam', 'Kota Banda Aceh'),
(2, 'Nanggroe Aceh Darusalam', 'Kota Subulussalam'),
(3, 'Nanggroe Aceh Darusalam', 'Kota Langsa'),
(4, 'Nanggroe Aceh Darusalam', 'Kota Lhokseumawe'),
(5, 'Nanggroe Aceh Darusalam', 'Kota Sabang'),
(6, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Barat'),
(7, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Barat Daya'),
(8, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Besar'),
(9, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Jaya'),
(10, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Selatan'),
(11, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Singkil'),
(12, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Tamiang'),
(13, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Tengah'),
(14, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Tenggara'),
(15, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Timur'),
(16, 'Nanggroe Aceh Darusalam', 'Kab. Aceh Utara'),
(17, 'Nanggroe Aceh Darusalam', 'Kab. Bener Meriah'),
(18, 'Nanggroe Aceh Darusalam', 'Kab. Bireun'),
(19, 'Nanggroe Aceh Darusalam', 'Kab. Gayo Lues'),
(20, 'Nanggroe Aceh Darusalam', 'Kab. Nagan Raya'),
(21, 'Nanggroe Aceh Darusalam', 'Kab. Pidie'),
(22, 'Nanggroe Aceh Darusalam', 'Kab. Pidie Jaya'),
(23, 'Nanggroe Aceh Darusalam', 'Kab. Simeulue'),
(24, 'Sumatera Utara', 'Kota Medan'),
(25, 'Sumatera Utara', 'Kota Binjai'),
(26, 'Sumatera Utara', 'Kota Padang Sidempuan'),
(27, 'Sumatera Utara', 'Kota Pematang Siantar'),
(28, 'Sumatera Utara', 'Kota Sibolga'),
(29, 'Sumatera Utara', 'Kota Tanjung Balai'),
(30, 'Sumatera Utara', 'Kota Tebing Tinggi'),
(31, 'Sumatera Utara', 'Kab. Asahan'),
(32, 'Sumatera Utara', 'Kab. Batubara'),
(33, 'Sumatera Utara', 'Kab. Dairi'),
(34, 'Sumatera Utara', 'Kab. Deliserdang'),
(35, 'Sumatera Utara', 'Kab. Humbang Hasundutan'),
(36, 'Sumatera Utara', 'Kab. Karo'),
(37, 'Sumatera Utara', 'Kab. Labuhanbatu'),
(38, 'Sumatera Utara', 'Kab. Langkat'),
(39, 'Sumatera Utara', 'Kab. Mandailing Natal'),
(40, 'Sumatera Utara', 'Kab. Nias'),
(41, 'Sumatera Utara', 'Kab. Nias Selatan'),
(42, 'Sumatera Utara', 'Kab. Pakpak Bharat'),
(43, 'Sumatera Utara', 'Kab. Samosir'),
(44, 'Sumatera Utara', 'Kab. Serdang Bedagai'),
(45, 'Sumatera Utara', 'Kab. Simalungun'),
(46, 'Sumatera Utara', 'Kab. Tapanuli Selatan'),
(47, 'Sumatera Utara', 'Kab. Tapanuli Tengah'),
(48, 'Sumatera Utara', 'Kab. Tapanuli Utara'),
(49, 'Sumatera Utara', 'Kab. Toba Samosir'),
(50, 'Sumatera Utara', 'Kab. Padang Lawas Utara'),
(51, 'Sumatera Utara', 'Kab. Padang Lawas'),
(52, 'Sumatera Utara', 'Kab. Labuhanbatu Utara'),
(53, 'Sumatera Utara', 'Kab. Labuhanbatu Selatan'),
(54, 'Sumatera Utara', 'Kab. Nias Barat'),
(55, 'Sumatera Utara', 'Kab. Nias Utara'),
(56, 'Sumatera Utara', 'Kab. Gunung Sitoli'),
(57, 'Sumatera Barat', 'Kota Padang'),
(58, 'Sumatera Barat', 'Kota Bukit Tinggi'),
(59, 'Sumatera Barat', 'Kota Pandang Panjang'),
(60, 'Sumatera Barat', 'Kota Pariaman'),
(61, 'Sumatera Barat', 'Kota Payakumbuh'),
(62, 'Sumatera Barat', 'Kota Sawahlunto'),
(63, 'Sumatera Barat', 'Kota Solok'),
(64, 'Sumatera Barat', 'Kab. Agam'),
(65, 'Sumatera Barat', 'Kab. Dharmasraya'),
(66, 'Sumatera Barat', 'Kab. Limapuluhkota'),
(67, 'Sumatera Barat', 'Kab. Kep. Mentawai'),
(68, 'Sumatera Barat', 'Kab. Padang Pariaman'),
(69, 'Sumatera Barat', 'Kab. Pasaman'),
(70, 'Sumatera Barat', 'Kab. Pasaman Barat'),
(71, 'Sumatera Barat', 'Kab. Pesisir Selatan'),
(72, 'Sumatera Barat', 'Kab. Sawahlunto Sijunjung'),
(73, 'Sumatera Barat', 'Kab. Solok'),
(74, 'Sumatera Barat', 'Kab. Solok Selatan'),
(75, 'Sumatera Barat', 'Kab. Tanah Datar'),
(76, 'Riau', 'Kota Pekanbaru'),
(77, 'Riau', 'Kota Dumai'),
(78, 'Riau', 'Kab. Bengkalis'),
(79, 'Riau', 'Kab. Indragiri Hilir'),
(80, 'Riau', 'Kab. Indragiri Hulu'),
(81, 'Riau', 'Kab. Kampar'),
(82, 'Riau', 'Kab. Kuantan Singingi'),
(83, 'Riau', 'Kab. Pelalawan'),
(84, 'Riau', 'Kab. Rokan Hulu'),
(85, 'Riau', 'Kab. Rokan Hilir'),
(86, 'Riau', 'Kab. Siak'),
(87, 'Riau', 'Kab. Kep. Meranti'),
(88, 'Jambi', 'Kota Jambi'),
(89, 'Jambi', 'Kota Sungai Penuh'),
(90, 'Jambi', 'Kab. Batanghari'),
(91, 'Jambi', 'Kab. Bungo'),
(92, 'Jambi', 'Kab. Kerinci'),
(93, 'Jambi', 'Kab. Merangin'),
(94, 'Jambi', 'Kab. Muaro Jambi'),
(95, 'Jambi', 'Kab. Sarolangun'),
(96, 'Jambi', 'Kab. Tanjung Jabung Barat'),
(97, 'Jambi', 'Kab. Tanjung Jabung Timur'),
(98, 'Jambi', 'Kab. Tebo'),
(99, 'Sumatera Selatan', 'Kota Palembang'),
(100, 'Sumatera Selatan', 'Kota Lubuk Linggau'),
(101, 'Sumatera Selatan', 'Kota Pagar Alam'),
(102, 'Sumatera Selatan', 'Kota Prabumulih'),
(103, 'Sumatera Selatan', 'Kab. Banyuasin'),
(104, 'Sumatera Selatan', 'Kab. Lahat'),
(105, 'Sumatera Selatan', 'Kab. Empat Lawang'),
(106, 'Sumatera Selatan', 'Kab. Muara Enim'),
(107, 'Sumatera Selatan', 'Kab. Musi Banyuasin'),
(108, 'Sumatera Selatan', 'Kab. Musi Rawas'),
(109, 'Sumatera Selatan', 'Kab. Ogan Ilir'),
(110, 'Sumatera Selatan', 'Kab. OKI'),
(111, 'Sumatera Selatan', 'Kab. OKU'),
(112, 'Sumatera Selatan', 'Kab. OKU Selatan'),
(113, 'Sumatera Selatan', 'Kab. OKU Timur'),
(114, 'Bengkulu', 'Kota Bengkulu'),
(115, 'Bengkulu', 'Kab. Bengkulu Selatan'),
(116, 'Bengkulu', 'Kab. Bengkulu Utara'),
(117, 'Bengkulu', 'Kab. Kaur'),
(118, 'Bengkulu', 'Kab. Kepahiang'),
(119, 'Bengkulu', 'Kab. Lebong'),
(120, 'Bengkulu', 'Kab. Muko-Muko'),
(121, 'Bengkulu', 'Kab. Rejang Lebong'),
(122, 'Bengkulu', 'Kab. Seluma'),
(123, 'Bengkulu', 'Kab. Bengkulu Tengah'),
(124, 'Lampung', 'Kota Bandarlampung'),
(125, 'Lampung', 'Kota Metro'),
(126, 'Lampung', 'Kab. Lampung Barat'),
(127, 'Lampung', 'Kab. Lampung Selatan'),
(128, 'Lampung', 'Kab. Lampung Tengah'),
(129, 'Lampung', 'Kab. Lampung Timur'),
(130, 'Lampung', 'Kab. Lampung Utara'),
(131, 'Lampung', 'Kab. Tanggamus'),
(132, 'Lampung', 'Kab. Tulang Bawang'),
(133, 'Lampung', 'Kab. Way Kanan'),
(134, 'Lampung', 'Kab. Pesawaran'),
(135, 'Lampung', 'Kab. Pringsewu'),
(136, 'Lampung', 'Kab. Mesuji'),
(137, 'Lampung', 'Kab. Tulang Bawang Barat'),
(138, 'Kepulauan Bangka Belitung', 'Kota Pangkalpinang'),
(139, 'Kepulauan Bangka Belitung', 'Kab. Bangka'),
(140, 'Kepulauan Bangka Belitung', 'Kab. Bangka Barat'),
(141, 'Kepulauan Bangka Belitung', 'Kab. Bangka Selatan'),
(142, 'Kepulauan Bangka Belitung', 'Kab. Bangka Tengah'),
(143, 'Kepulauan Bangka Belitung', 'Kab. Belitung'),
(144, 'Kepulauan Bangka Belitung', 'Kab. Belitung Timur'),
(145, 'Kepulauan Riau', 'Kota Tanjungpinang'),
(146, 'Kepulauan Riau', 'Kota Batam'),
(147, 'Kepulauan Riau', 'Kab. Karimun'),
(148, 'Kepulauan Riau', 'Kab. Bintan (Kep. Riau)'),
(149, 'Kepulauan Riau', 'Kab. Lingga'),
(150, 'Kepulauan Riau', 'Kab. Natuna'),
(151, 'Kepulauan Riau', 'Kab. Kep. Anambas'),
(152, 'DKI Jakarta', 'Jakarta Barat'),
(153, 'DKI Jakarta', 'Jakarta Pusat'),
(154, 'DKI Jakarta', 'Jakarta Selatan'),
(155, 'DKI Jakarta', 'Jakarta Timur'),
(156, 'DKI Jakarta', 'Jakarta Utara'),
(157, 'DKI Jakarta', 'Kab. Kepulauan Seribu'),
(158, 'Jawa Barat', 'Kota Bandung'),
(159, 'Jawa Barat', 'Kota Banjar'),
(160, 'Jawa Barat', 'Kota Bekasi'),
(161, 'Jawa Barat', 'Kota Bogor'),
(162, 'Jawa Barat', 'Kota Cimahi'),
(163, 'Jawa Barat', 'Kota Cirebon'),
(164, 'Jawa Barat', 'Kota Depok'),
(165, 'Jawa Barat', 'Kota Sukabumi'),
(166, 'Jawa Barat', 'Kota Tasikmalaya'),
(167, 'Jawa Barat', 'Kab. Bandung'),
(168, 'Jawa Barat', 'Kab. Bandung Barat'),
(169, 'Jawa Barat', 'Kab. Bekasi'),
(170, 'Jawa Barat', 'Kab. Bogor'),
(171, 'Jawa Barat', 'Kab. Ciamis'),
(172, 'Jawa Barat', 'Kab. Cianjur'),
(173, 'Jawa Barat', 'Kab. Cirebon'),
(174, 'Jawa Barat', 'Kab. Garut'),
(175, 'Jawa Barat', 'Kab. Indramayu'),
(176, 'Jawa Barat', 'Kab. Karawang'),
(177, 'Jawa Barat', 'Kab. Kuningan'),
(178, 'Jawa Barat', 'Kab. Majalengka'),
(179, 'Jawa Barat', 'Kab. Purwakarta'),
(180, 'Jawa Barat', 'Kab. Subang'),
(181, 'Jawa Barat', 'Kab. Sukabumi'),
(182, 'Jawa Barat', 'Kab. Sumedang'),
(183, 'Jawa Barat', 'Kab. Tasikmalaya'),
(184, 'Jawa Tengah', 'Kota Semarang'),
(185, 'Jawa Tengah', 'Kota Magelang'),
(186, 'Jawa Tengah', 'Kota Pekalongan'),
(187, 'Jawa Tengah', 'Kota Salatiga'),
(188, 'Jawa Tengah', 'Kota Surakarta'),
(189, 'Jawa Tengah', 'Kota Tegal'),
(190, 'Jawa Tengah', 'Kab. Banjarnegara'),
(191, 'Jawa Tengah', 'Kab. Banyumas'),
(192, 'Jawa Tengah', 'Kab. Batang'),
(193, 'Jawa Tengah', 'Kab. Blora'),
(194, 'Jawa Tengah', 'Kab. Boyolali'),
(195, 'Jawa Tengah', 'Kab. Brebes'),
(196, 'Jawa Tengah', 'Kab. Cilacap'),
(197, 'Jawa Tengah', 'Kab. Demak'),
(198, 'Jawa Tengah', 'Kab. Grobogan'),
(199, 'Jawa Tengah', 'Kab. Jepara'),
(200, 'Jawa Tengah', 'Kab. Karanganyar'),
(201, 'Jawa Tengah', 'Kab. Kebumen'),
(202, 'Jawa Tengah', 'Kab. Kendal'),
(203, 'Jawa Tengah', 'Kab. Klaten'),
(204, 'Jawa Tengah', 'Kab. Kudus'),
(205, 'Jawa Tengah', 'Kab. Magelang'),
(206, 'Jawa Tengah', 'Kab. Pati'),
(207, 'Jawa Tengah', 'Kab. Pekalongan'),
(208, 'Jawa Tengah', 'Kab. Pemalang'),
(209, 'Jawa Tengah', 'Kab. Purbalingga'),
(210, 'Jawa Tengah', 'Kab. Purworejo'),
(211, 'Jawa Tengah', 'Kab. Rembang'),
(212, 'Jawa Tengah', 'Kab. Semarang'),
(213, 'Jawa Tengah', 'Kab. Sragen'),
(214, 'Jawa Tengah', 'Kab. Sukoharjo'),
(215, 'Jawa Tengah', 'Kab. Tegal'),
(216, 'Jawa Tengah', 'Kab. Temanggung'),
(217, 'Jawa Tengah', 'Kab. Wonogiri'),
(218, 'Jawa Tengah', 'Kab. Wonosobo'),
(219, 'Banten', 'Kota Tangerang'),
(220, 'Banten', 'Kota Cilegon'),
(221, 'Banten', 'Kota Serang'),
(222, 'Banten', 'Kota Tangerang Selatan'),
(223, 'Banten', 'Kab. Lebak'),
(224, 'Banten', 'Kab. Pandeglang'),
(225, 'Banten', 'Kab. Serang'),
(226, 'Banten', 'Kab. Tangerang'),
(227, 'Jawa Timur', 'Kota Surabaya'),
(228, 'Jawa Timur', 'Kota Batu'),
(229, 'Jawa Timur', 'Kota Blitar'),
(230, 'Jawa Timur', 'Kota Kediri'),
(231, 'Jawa Timur', 'Kota Madiun'),
(232, 'Jawa Timur', 'Kota Malang'),
(233, 'Jawa Timur', 'Kota Mojokerto'),
(234, 'Jawa Timur', 'Kota Pasuruan'),
(235, 'Jawa Timur', 'Kota Probolinggo'),
(236, 'Jawa Timur', 'Kab. Bangkalan'),
(237, 'Jawa Timur', 'Kab. Banyuwangi'),
(238, 'Jawa Timur', 'Kab. Blitar'),
(239, 'Jawa Timur', 'Kab. Bojonegoro'),
(240, 'Jawa Timur', 'Kab. Bondowoso'),
(241, 'Jawa Timur', 'Kab. Gresik'),
(242, 'Jawa Timur', 'Kab. Jember'),
(243, 'Jawa Timur', 'Kab. Jombang'),
(244, 'Jawa Timur', 'Kab. Kediri'),
(245, 'Jawa Timur', 'Kab. Lamongan'),
(246, 'Jawa Timur', 'Kab. Lumajang'),
(247, 'Jawa Timur', 'Kab. Madiun'),
(248, 'Jawa Timur', 'Kab. Magetan'),
(249, 'Jawa Timur', 'Kab. Malang'),
(250, 'Jawa Timur', 'Kab. Mojokerto'),
(251, 'Jawa Timur', 'Kab. Nganjuk'),
(252, 'Jawa Timur', 'Kab. Ngawi'),
(253, 'Jawa Timur', 'Kab. Pacitan'),
(254, 'Jawa Timur', 'Kab. Pamekasan'),
(255, 'Jawa Timur', 'Kab. Pasuruan'),
(256, 'Jawa Timur', 'Kab. Ponorogo'),
(257, 'Jawa Timur', 'Kab. Probolinggo'),
(258, 'Jawa Timur', 'Kab. Sampang'),
(259, 'Jawa Timur', 'Kab. Sidoarjo'),
(260, 'Jawa Timur', 'Kab. Situbondo'),
(261, 'Jawa Timur', 'Kab. Sumenep'),
(262, 'Jawa Timur', 'Kab. Trenggalek'),
(263, 'Jawa Timur', 'Kab. Tulungagung'),
(264, 'Jawa Timur', 'Kab. Tuban'),
(265, 'DI Yogyakarta', 'Kota Yogyakarta'),
(266, 'DI Yogyakarta', 'Kab. Bantul'),
(267, 'DI Yogyakarta', 'Kab. Gunung Kidul'),
(268, 'DI Yogyakarta', 'Kab. Kulon Progo'),
(269, 'DI Yogyakarta', 'Kab. Sleman'),
(270, 'Bali', 'Kota Denpasar'),
(271, 'Bali', 'Kab. Badung'),
(272, 'Bali', 'Kab. Bangli'),
(273, 'Bali', 'Kab. Buleleng'),
(274, 'Bali', 'Kab. Gianyar'),
(275, 'Bali', 'Kab. Jembrana'),
(276, 'Bali', 'Kab. Karang Asem'),
(277, 'Bali', 'Kab. Klungkung'),
(278, 'Bali', 'Kab. Tabanan'),
(279, 'Nusa Tenggara Barat', 'Kota Mataram'),
(280, 'Nusa Tenggara Barat', 'Kota Bima'),
(281, 'Nusa Tenggara Barat', 'Kab. Bima'),
(282, 'Nusa Tenggara Barat', 'Kab. Dompu'),
(283, 'Nusa Tenggara Barat', 'Kab. Lombok Barat'),
(284, 'Nusa Tenggara Barat', 'Kab. Lombok Tengah'),
(285, 'Nusa Tenggara Barat', 'Kab. Lombok Timur'),
(286, 'Nusa Tenggara Barat', 'Kab. Sumbawa'),
(287, 'Nusa Tenggara Barat', 'Kab. Sumbawa Barat'),
(288, 'Nusa Tenggara Barat', 'Kab. Lombok Utara'),
(289, 'Nusa Tenggara Timur', 'Kota Kupang'),
(290, 'Nusa Tenggara Timur', 'Kab. Alor'),
(291, 'Nusa Tenggara Timur', 'Kab. Belu'),
(292, 'Nusa Tenggara Timur', 'Keb. Ende'),
(293, 'Nusa Tenggara Timur', 'Kab. Flores Timur'),
(294, 'Nusa Tenggara Timur', 'Kab. Kupang'),
(295, 'Nusa Tenggara Timur', 'Kab. Lembata'),
(296, 'Nusa Tenggara Timur', 'Kab. Manggarai'),
(297, 'Nusa Tenggara Timur', 'Kab. Manggarai Barat'),
(298, 'Nusa Tenggara Timur', 'Kab. Ngada'),
(299, 'Nusa Tenggara Timur', 'Kab. Nagekeo'),
(300, 'Nusa Tenggara Timur', 'Kab. Rote Ndao'),
(301, 'Nusa Tenggara Timur', 'Kab. Sikka'),
(302, 'Nusa Tenggara Timur', 'Kab. Sumba Barat'),
(303, 'Nusa Tenggara Timur', 'Kab. Sumba Barat Daya'),
(304, 'Nusa Tenggara Timur', 'Kab. Sumba Tengah'),
(305, 'Nusa Tenggara Timur', 'Kab. Manggarai Timur'),
(306, 'Nusa Tenggara Timur', 'Kab. Sumba Timur'),
(307, 'Nusa Tenggara Timur', 'Kab. Timor Tengah Selatan'),
(308, 'Nusa Tenggara Timur', 'Kab. Timor Tengah Utara'),
(309, 'Nusa Tenggara Timur', 'Kab. Sabu Raijua'),
(310, 'Kalimantan Barat', 'Kota Pontianak'),
(311, 'Kalimantan Barat', 'Kota Singkawang'),
(312, 'Kalimantan Barat', 'Kab. Bengkayang'),
(313, 'Kalimantan Barat', 'Kab. Kapuas Hulu'),
(314, 'Kalimantan Barat', 'Kab. Ketapang'),
(315, 'Kalimantan Barat', 'Kab. Kayong Utara'),
(316, 'Kalimantan Barat', 'Kab. Kubu Raya'),
(317, 'Kalimantan Barat', 'Kab. Landak'),
(318, 'Kalimantan Barat', 'Kab. Melawi'),
(319, 'Kalimantan Barat', 'Kab. Pontianak'),
(320, 'Kalimantan Barat', 'Kab. Sambas'),
(321, 'Kalimantan Barat', 'Kab. Sanggau'),
(322, 'Kalimantan Barat', 'Kab. Sintang'),
(323, 'Kalimantan Barat', 'Kab. Sekadau'),
(324, 'Kalimantan Tengah', 'Kota Palangkaraya'),
(325, 'Kalimantan Tengah', 'Kab. Barito Selatan'),
(326, 'Kalimantan Tengah', 'Kab. Barito Timur'),
(327, 'Kalimantan Tengah', 'Kab. Barito Utara'),
(328, 'Kalimantan Tengah', 'Kab. Gunung Mas'),
(329, 'Kalimantan Tengah', 'Kab. Kapuas'),
(330, 'Kalimantan Tengah', 'Kab. Katingan'),
(331, 'Kalimantan Tengah', 'Kab. Kotawaringin Barat'),
(332, 'Kalimantan Tengah', 'Kab. Kotawaringin Timur'),
(333, 'Kalimantan Tengah', 'Kab. Lamandau'),
(334, 'Kalimantan Tengah', 'Kab. Murung Raya'),
(335, 'Kalimantan Tengah', 'Kab. Pulang Pisau'),
(336, 'Kalimantan Tengah', 'Kab. Seruyan'),
(337, 'Kalimantan Tengah', 'Kab. Sukamara'),
(338, 'Kalimantan Selatan', 'Kota Banjarmasin'),
(339, 'Kalimantan Selatan', 'Kota Banjar Baru'),
(340, 'Kalimantan Selatan', 'Kab. Balangan'),
(341, 'Kalimantan Selatan', 'Kab. Banjar'),
(342, 'Kalimantan Selatan', 'Kab. Barito Kuala'),
(343, 'Kalimantan Selatan', 'Kab. Hulu Sungai Selatan'),
(344, 'Kalimantan Selatan', 'Kab. Hulu Sungai Tengah'),
(345, 'Kalimantan Selatan', 'Kab. Hulu Sungai Utara'),
(346, 'Kalimantan Selatan', 'Kab. Kotabaru'),
(347, 'Kalimantan Selatan', 'Kab. Tabalong'),
(348, 'Kalimantan Selatan', 'Kab. Tanah Bumbu'),
(349, 'Kalimantan Selatan', 'Kab. Tanah Laut'),
(350, 'Kalimantan Selatan', 'Kab. Tapin'),
(351, 'Kalimantan Timur', 'Kota Samarinda'),
(352, 'Kalimantan Timur', 'Kota Balikpapan'),
(353, 'Kalimantan Timur', 'Kota Bontang'),
(354, 'Kalimantan Timur', 'Kota Tarakan'),
(355, 'Kalimantan Timur', 'Kab. Berau'),
(356, 'Kalimantan Timur', 'Kab. Bulungan'),
(357, 'Kalimantan Timur', 'Kab. Tanah Tidung'),
(358, 'Kalimantan Timur', 'Kab. Kutai Barat'),
(359, 'Kalimantan Timur', 'Kab. Kutai Kertanegara'),
(360, 'Kalimantan Timur', 'Kab. Kutai Timur'),
(361, 'Kalimantan Timur', 'Kab. Malinau'),
(362, 'Kalimantan Timur', 'Kab. Nunukan'),
(363, 'Kalimantan Timur', 'Kab. Penajam Paser Utara'),
(364, 'Kalimantan Timur', 'Kab. Pasir'),
(365, 'Sulawesi Utara', 'Kota Manado'),
(366, 'Sulawesi Utara', 'Kota Kotamobagu'),
(367, 'Sulawesi Utara', 'Kota Bitung'),
(368, 'Sulawesi Utara', 'Kota Tomohon'),
(369, 'Sulawesi Utara', 'Kab. Bolaangmongondow'),
(370, 'Sulawesi Utara', 'Kab. Bolaangmongondow Utara'),
(371, 'Sulawesi Utara', 'Kab. Minahasa'),
(372, 'Sulawesi Utara', 'Kab. Mitra'),
(373, 'Sulawesi Utara', 'Kab. Minahasa Selatan'),
(374, 'Sulawesi Utara', 'Kab. Minahasa Utara'),
(375, 'Sulawesi Utara', 'Kab. Sangihe Talaud'),
(376, 'Sulawesi Utara', 'Kab. Kep. Talaud'),
(377, 'Sulawesi Utara', 'Kab. Kep. Sitaro'),
(378, 'Sulawesi Utara', 'Kab. Bolaangmongondow Timur'),
(379, 'Sulawesi Utara', 'Kab. Bolaangmongondow Selatan'),
(380, 'Sulawesi Tengah', 'Kota Palu'),
(381, 'Sulawesi Tengah', 'Kab. Banggai'),
(382, 'Sulawesi Tengah', 'Kab. Banggai Kepulauan'),
(383, 'Sulawesi Tengah', 'Kab. Buol'),
(384, 'Sulawesi Tengah', 'Kab. Donggala'),
(385, 'Sulawesi Tengah', 'Kab. Morowali'),
(386, 'Sulawesi Tengah', 'Kab. Parigi Mountong'),
(387, 'Sulawesi Tengah', 'Kab. Poso'),
(388, 'Sulawesi Tengah', 'Kab. Tojo Una-Una'),
(389, 'Sulawesi Tengah', 'Kab. Toli-Toli'),
(390, 'Sulawesi Tengah', 'Kab. Sigi'),
(391, 'Sulawesi Selatan', 'Kota Makasar'),
(392, 'Sulawesi Selatan', 'Kota Pare-Pare'),
(393, 'Sulawesi Selatan', 'Kota Palopo'),
(394, 'Sulawesi Selatan', 'Kab. Selayar'),
(395, 'Sulawesi Selatan', 'Kab. Bantaeng'),
(396, 'Sulawesi Selatan', 'Kab. Barru'),
(397, 'Sulawesi Selatan', 'Kab. Bone'),
(398, 'Sulawesi Selatan', 'Kab. Bulukumba'),
(399, 'Sulawesi Selatan', 'Kab. Enrekang'),
(400, 'Sulawesi Selatan', 'Kab. Gowa'),
(401, 'Sulawesi Selatan', 'Kab. Jeneponto'),
(402, 'Sulawesi Selatan', 'Kab. Luwu'),
(403, 'Sulawesi Selatan', 'Kab. Luwu Timur'),
(404, 'Sulawesi Selatan', 'Kab. Luwu Utara'),
(405, 'Sulawesi Selatan', 'Kab. Maros'),
(406, 'Sulawesi Selatan', 'Kab. Pangkep'),
(407, 'Sulawesi Selatan', 'Kab. Pinrang'),
(408, 'Sulawesi Selatan', 'Kab. Sidenreng Rappang'),
(409, 'Sulawesi Selatan', 'Kab. Sinjai'),
(410, 'Sulawesi Selatan', 'Kab. Soppeng'),
(411, 'Sulawesi Selatan', 'Kab. Takalar'),
(412, 'Sulawesi Selatan', 'Kab. Tanatoraja'),
(413, 'Sulawesi Selatan', 'Kab. Wajo'),
(414, 'Sulawesi Selatan', 'Kab. Toraja Utara'),
(415, 'Sulawesi Tenggara', 'Kota Kendari'),
(416, 'Sulawesi Tenggara', 'Kota Bau-Bau'),
(417, 'Sulawesi Tenggara', 'Kab. Bombana'),
(418, 'Sulawesi Tenggara', 'Kab. Buton'),
(419, 'Sulawesi Tenggara', 'Kab. Kendari (Kab. Konawe)'),
(420, 'Sulawesi Tenggara', 'Kab. Kolaka'),
(421, 'Sulawesi Tenggara', 'Kab. Kolaka Utara'),
(422, 'Sulawesi Tenggara', 'Kab. Konawe Selatan'),
(423, 'Sulawesi Tenggara', 'Kab. Muna'),
(424, 'Sulawesi Tenggara', 'Kab. Wakatobi'),
(425, 'Sulawesi Tenggara', 'Kab. Konawe Utara'),
(426, 'Sulawesi Tenggara', 'Kab. Buton Utara'),
(427, 'Gorontalo', 'Kota Gorontalo'),
(428, 'Gorontalo', 'Kab. Boalemo'),
(429, 'Gorontalo', 'Kab. Bone Bolango'),
(430, 'Gorontalo', 'Kab. Gorontalo'),
(431, 'Gorontalo', 'Kab. Gorontalo Utara'),
(432, 'Gorontalo', 'Kab. Pohuwato'),
(433, 'Sulawesi Barat', 'Kab. Mamaju'),
(434, 'Sulawesi Barat', 'Kab. Majene'),
(435, 'Sulawesi Barat', 'Kab. Mamuju Utara'),
(436, 'Sulawesi Barat', 'Kab. Mamasa'),
(437, 'Sulawesi Barat', 'Kab. Polewali Mamasa'),
(438, 'Maluku', 'Kota Ambon'),
(439, 'Maluku', 'Kota Tual'),
(440, 'Maluku', 'Kab. Buru'),
(441, 'Maluku', 'Kab. Kep. Aru'),
(442, 'Maluku', 'Kab. Seram Bagian Barat'),
(443, 'Maluku', 'Kab. Seram Bagian Timur'),
(444, 'Maluku', 'Kab. Maluku Tengah'),
(445, 'Maluku', 'Kab. Maluku Tenggara'),
(446, 'Maluku', 'Kab. MalukuTenggara Barat'),
(447, 'Maluku', 'Kab. Maluku Barat Daya'),
(448, 'Maluku', 'Kab. Buru Selatan'),
(449, 'Maluku Utara', 'Kota Ternate'),
(450, 'Maluku Utara', 'Kota Tidore Kepulauan'),
(451, 'Maluku Utara', 'Kab. Halmahera Barat'),
(452, 'Maluku Utara', 'Kab. Halmahera Selatan'),
(453, 'Maluku Utara', 'Kab. Halmahera Tengah'),
(454, 'Maluku Utara', 'Kab. Halmahera Timur'),
(455, 'Maluku Utara', 'Kab. Halmahera Utara'),
(456, 'Maluku Utara', 'Kab. Kep. Sula'),
(457, 'Maluku Utara', 'Kab. Morotai'),
(458, 'Papua', 'Kota Jayapura'),
(459, 'Papua', 'Kab. Asmat'),
(460, 'Papua', 'Kab. Biak Numfor'),
(461, 'Papua', 'Kab. Boven Digoel'),
(462, 'Papua', 'Kab. Jayapura'),
(463, 'Papua', 'Kab. Jayawijaya'),
(464, 'Papua', 'Kab. Keerom'),
(465, 'Papua', 'Kab. Mappi'),
(466, 'Papua', 'Kab. Merauke'),
(467, 'Papua', 'Kab. Mimika'),
(468, 'Papua', 'Kab. Paniai'),
(469, 'Papua', 'Kab. Pegunungan Bintang'),
(470, 'Papua', 'Kab. Puncak Jaya'),
(471, 'Papua', 'Kab. Sarmi'),
(472, 'Papua', 'Kab. Memberamo Raya'),
(473, 'Papua', 'Kab. Supiori'),
(474, 'Papua', 'Kab. Tolikara'),
(475, 'Papua', 'Kab. Yahukimo'),
(476, 'Papua', 'Kab. YapenWaropen'),
(477, 'Papua', 'Kab. Waropen'),
(478, 'Papua', 'Kab. Nabire'),
(479, 'Papua', 'Kab. Memberano Tengah'),
(480, 'Papua', 'Kab. Yalimo'),
(481, 'Papua', 'Kab. Lanny Jaya'),
(482, 'Papua', 'Kab. Nduga'),
(483, 'Papua', 'Kab. Puncak'),
(484, 'Papua', 'Kab. Dogiyai'),
(485, 'Papua', 'Kab. Deiyai'),
(486, 'Papua', 'Kab. Intan Jaya'),
(487, 'Papua Barat', 'Kota Sorong'),
(488, 'Papua Barat', 'Kab. Fak-Fak'),
(489, 'Papua Barat', 'Kab. Kaimana'),
(490, 'Papua Barat', 'Kab. Kep. Raja Ampat'),
(491, 'Papua Barat', 'Kab. Manokwari'),
(492, 'Papua Barat', 'Kab. Sorong Selatan'),
(493, 'Papua Barat', 'Kab. Teluk Bintuni'),
(494, 'Papua Barat', 'Kab. Sorong'),
(495, 'Papua Barat', 'Kab. Teluk Wondama'),
(496, 'Papua Barat', 'Kab. Tambrauw'),
(497, 'Papua Barat', 'Kab. Maibrat');

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

-- --------------------------------------------------------

--
-- Table structure for table `m_employee`
--

CREATE TABLE IF NOT EXISTS `m_employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `division_id` int(11) NOT NULL,
  `employee_name` varchar(250) NOT NULL,
  `employee_nik` varchar(30) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `status_id` varchar(10) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `m_employee`
--

INSERT INTO `m_employee` (`employee_id`, `division_id`, `employee_name`, `employee_nik`, `employee_email`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'Shakti Santoso', '90079', 'shakti.santoso@hypermart.co.id', 'active', 1, '2015-09-10 10:14:43', 1, '2015-11-04 09:01:22'),
(2, 1, 'Julius Stevan', '80641', 'hris.msm@hypermart.co.id', 'inactive', 1, '2015-09-10 10:39:04', 1, '2015-11-04 09:52:32'),
(3, 1, 'Matius Lim', '90001', 'matius.lim@hypermart.co.id', 'inactive', 1, '2015-09-10 10:47:01', 1, '2015-11-04 09:52:37'),
(4, 3, 'Debbie Suryatenggara', '90002', 'debbie.suryatenggara@hypermart.co.id', 'active', 1, '2015-10-22 16:06:11', 1, '2015-10-22 09:06:13'),
(5, 3, 'Theresia Histi', '90003', 'theresia.histi@hypermart.co.id', 'active', 1, '2015-10-22 17:04:05', 1, '2015-10-22 10:04:07'),
(6, 3, 'Skolastika Meta Wedika', '90004', 'skolastikametawedika@hypermart.co.id', 'active', 1, '2015-11-04 14:35:49', 1, '2015-11-04 08:45:32'),
(7, 3, 'Lydia Dessyana', '90005', 'lidya.dessyana@hypermart.co.id', 'active', 1, '2015-11-04 16:08:01', 1, '2015-11-05 01:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `m_faq`
--

CREATE TABLE IF NOT EXISTS `m_faq` (
  `faq_id` int(2) NOT NULL AUTO_INCREMENT,
  `faq_question` varchar(250) NOT NULL,
  `faq_answer` text NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `m_faq`
--

INSERT INTO `m_faq` (`faq_id`, `faq_question`, `faq_answer`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 'question 1', 'answer 1, description answer 1 ada di sini', 1, '2015-09-08 00:00:00', 1, '2015-09-08 05:08:09'),
(2, 'question 2', '<p>answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here</p> <p>answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here</p> <p>answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here</p> <p>answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here</p> <p>answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here answer for question 2. described here</p> ', 1, '2015-09-08 00:00:00', 1, '2015-09-08 06:27:50'),
(3, 'question 3', 'here is the answer for question 3 here is the answer for question 3 here is the answer for question 3 here is the answer for question 3 here is the answer for question 3 here is the answer for question 3 here is the answer for question 3 ', 1, '2015-09-08 00:00:00', 1, '2015-09-08 06:18:26'),
(4, 'question 4', 'here is the answer for question 4 here is the answer for question 4 here is the answer for question 4 here is the answer for question 4 here is the answer for question 4 here is the answer for question 4 here is the answer for question 4 ', 1, '2015-09-08 00:00:00', 1, '2015-09-08 06:18:26'),
(5, 'question 5', 'here is the answer for question 4 here is the answer for question 5 here is the answer for question 5 here is the answer for question 5 here is the answer for question 5 here is the answer for question 5 here is the answer for question 5 ', 1, '2015-09-08 00:00:00', 1, '2015-09-08 06:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `m_howto`
--

CREATE TABLE IF NOT EXISTS `m_howto` (
  `howto_id` int(1) NOT NULL AUTO_INCREMENT,
  `howto_desc` text NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`howto_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `m_howto`
--

INSERT INTO `m_howto` (`howto_id`, `howto_desc`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, '<p>How to get full benefit from this online recruitment?<br>Welcome to mpprecruitment.com, simply create a candidateâ€™s account, apply for vacancies, and be recruited. <br><br>01 Registration<br>Account registration is easy.<br>1.&nbsp;&nbsp; &nbsp;Go to www.mpprecruitment.co.id<br>2.&nbsp;&nbsp; &nbsp;Click on the orange â€œStart Here !â€&nbsp; upper right menu.<br>3.&nbsp;&nbsp; &nbsp;Click on the â€œRegistrationâ€ menu<br>4.&nbsp;&nbsp; &nbsp;Fill in all required fields, and then click on â€œRegisterâ€ button.<br>5.&nbsp;&nbsp; &nbsp;Notes you need to remember:<br>â€¢&nbsp;&nbsp; &nbsp;Make sure to input all data correctly. Once submitted, the information you fill in this registration form is not editable.<br>â€¢&nbsp;&nbsp; &nbsp;Ensure that the email address is correct and accessible so that account activation is possible.<br>6.&nbsp;&nbsp; &nbsp;You will receive an activation email in your registered email. Use the given link to activate your account not later than 2 weeks since the activation email has been issued.<br><br>02 Account Activation<br>You just registered for an account. The system automatically sends an activation email to your email address. This step is needed to make sure that your email address is correct so that all emails from our online recruitment system will reach you.<br>To activate your account:<br>1.&nbsp;&nbsp; &nbsp;Look for an email from recruitment@mpprecruitment.co.id with the subject â€œ[PT. Matahari Putra Prima] Email Activationâ€.<br>2.&nbsp;&nbsp; &nbsp;Click on the given link in the email.<br>3.&nbsp;&nbsp; &nbsp;Once your account has been activated, you may login to your account.<br>If you accidentally deleted the activation email, you can prompt the system to resend an activation email:<br>â€¢&nbsp;&nbsp; &nbsp;Click on the orange â€œStart Here !â€&nbsp; upper right menu.<br>â€¢&nbsp;&nbsp; &nbsp;Click on the â€œResend Activation Emailâ€ menu.<br>â€¢&nbsp;&nbsp; &nbsp;Enter your registered email address, then click â€œResend Activation Emailâ€ button.<br>â€¢&nbsp;&nbsp; &nbsp;You will receive an activation email in your registered email. <br>â€¢&nbsp;&nbsp; &nbsp;Use the given link to activate your account not later than 2 weeks since the activation email has been issued.<br><br>03 Create Resume<br>Now, letâ€™s work on your resume. This is a crucial step and will directly influence your chances of being short-listed for series of selection stages.<br>To create your Resume for the first time:<br>1.&nbsp;&nbsp; &nbsp;Login to your mpprecruitment.com account.<br>2.&nbsp;&nbsp; &nbsp;Click on your email button (upper right pink button).<br>3.&nbsp;&nbsp; &nbsp;Click on â€œPersonal Dataâ€.<br>4.&nbsp;&nbsp; &nbsp;Fill in the form as completely as possible.<br>5.&nbsp;&nbsp; &nbsp;There will be a sidebar menu on the left. Each menu will direct you to the corresponding editor form.<br>6.&nbsp;&nbsp; &nbsp;Kindly read each captions and notes in the forms. Follow the instruction presented on each form thoroughly to minimize possible warning.<br>7.&nbsp;&nbsp; &nbsp;Please make sure that you fill up all the necessary fields.<br>To edit your Resume:<br>1.&nbsp;&nbsp; &nbsp;Login to your mpprecruitment.com account.<br>2.&nbsp;&nbsp; &nbsp;Click on the upper right pink button with your email address on it.<br>3.&nbsp;&nbsp; &nbsp;Click on â€œPersonal Dataâ€.<br>4.&nbsp;&nbsp; &nbsp;On the left menu, select the section you would like to edit.<br>5.&nbsp;&nbsp; &nbsp;Make sure to click the â€œSave and Nextâ€ button to save the change you have made before moving on to the next section.<br><br>04 Apply for Jobs<br>Before you apply, please ensure that you have completed all mandatory form and upload the mandatory documents (Resume, Educational Background, Questionaire, Passphoto, Ijazah, Transcript, and ID Card).<br>1.&nbsp;&nbsp; &nbsp;Make sure that you are logged in to your mpprecruitment.com account.<br>2.&nbsp;&nbsp; &nbsp;Click on the â€œJob Vacancyâ€ menu to open our lists of open vacancies.<br>3.&nbsp;&nbsp; &nbsp;Click on the name of vacant position.<br>4.&nbsp;&nbsp; &nbsp;You will be directed to the detail page of the vacant position.<br>5.&nbsp;&nbsp; &nbsp;Click on the â€œApply for this positionâ€ button under the detail description.<br>6.&nbsp;&nbsp; &nbsp;Notice that you may apply for 3 open positions. Use your choice wisely since once you apply for a position, you may not cancel it till the whole recruitment process is completed.<br>As soon as you apply for an open position, we will contact you directly if you are shortlisted for an interview. Do look out for phone calls, emails and interview requests from our recruiter.<br><br><br>05 Check Your Application Status<br>All applications you made via your mpprecruitment.com account can be seen in your member area homepage. Once you have logged on to your account, you will see different application status on the homepage.<br>What does each status meant?<br>ON GOING : Your application is in progress<br>PENDING : Your application has been reviewed and still waiting for further process.<br>REJECT : Thank you for applying for the position. However, this is the end of your application process.<br>JOIN : Congratulation, Succeed candidate.<br><br>06 Having trouble?<br><br>Login Trouble<br>If you forgot your login password, you may reset your password by clicking â€œForgot Passwordâ€ button under the login form. Follow the given steps and you will receive an email with the password-reset link. If you did not receive any email, please check your Spam or Junk folder.<br>If you no longer have access to the email associated with your mpprecruitment.com account, please contact us&nbsp; with the following information for verification purpose:<br>â€¢&nbsp;&nbsp; &nbsp;The email address registered with mpprecruitment.com<br>â€¢&nbsp;&nbsp; &nbsp;An active email address so that we can reach you<br>â€¢&nbsp;&nbsp; &nbsp;Your full name and identification number <br><br>Troubleshoot<br>If you come across any problem when accessing mpprecruitment.com, please perform the following troubleshooting steps.<br>1.&nbsp;&nbsp; &nbsp;Kindly make sure that you are using the latest browser and your Internet connection is stable.<br>2.&nbsp;&nbsp; &nbsp;Try again on a different browser or another computer.<br>3.&nbsp;&nbsp; &nbsp;Configure your browser as below:<br>â€¢&nbsp;&nbsp; &nbsp;Clear your internet browser cookies and cache.<br>â€¢&nbsp;&nbsp; &nbsp;Enable JavaScript (Instructions)<br>If the problem persists, please contact us.<br></p>', 1, '2015-09-08 00:00:00', 8, '2015-11-11 10:39:05');

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

--
-- Dumping data for table `m_job_vacancy`
--

INSERT INTO `m_job_vacancy` (`job_vacancy_id`, `job_vacancy_name`, `job_vacancy_city`, `job_vacancy_desc`, `job_vacancy_brief`, `job_vacancy_degree`, `job_vacancy_gender`, `job_vacancy_agemax`, `job_vacancy_marital`, `job_vacancy_experience`, `job_vacancy_type`, `job_vacancy_startdate`, `job_vacancy_enddate`, `job_vacancy_requestby`, `job_vacancy_minsalary`, `job_vacancy_maxsalary`, `job_vacancy_grade`, `log_auth_id`, `job_vacancy_approver`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 'HRIS Specialist', 'Tangerang', '<p>Designing and building Human Resource Information System in collaboration with IT team and external vendor.\r\n</p><ul><li>\r\nCandidate must possess at least a Bachelor Degree, Master Degree / Post Graduate Degree, Computer Science/Information Technology, Human Resource Management or equivalent.\r\n</li><li>At least 3 year(s) of working experience in the related field is required for this position.\r\n</li><li>Applicants must be willing to work in BANTEN.\r\n</li><li>Preferably Manager / Assistant Managers specializing in Human Resources or equivalent.\r\n</li><li>Full-Time position(s) available.\r\n</li><li>Basic Programming\r\n</li><li>Understand HR System and procedure\r\n</li><li>Basic Database (SQL Server)\r\n</li><li>Support HRIS\r\n</li><li>Able to act as Project Manager\r\n</li><li>Have good communication skill\r\n</li><li>Willing to learn a new thing related to HR System</li></ul><p>Ini deskripsi panjang tulisannya jadi aneh bingiiittt, moga ga brantakan deh kalo gini caranyaa. huhuhuhuhu\r\n</p>', '<ul><li>Designing and building Human Resource Information System.</li><li><span style="line-height: 2;">In collaboration with IT team and external vendor.</span></li></ul>', 'Bachelor - S1', '', '', '', '', 'Permanent', '2015-09-15', '2015-11-30', 1, 0, 0, '', 3, 2, 'open', 1, '2015-09-15 10:27:27', 1, '2015-11-17 02:09:49'),
(2, 'Staff Gudang', 'Jakarta', 'Staff gudang description is here Staff gudang description is here Staff gudang description is here Staff gudang description is here Staff gudang description is here Staff gudang description is here Staff gudang description is here Staff gudang description is here ', 'Staff gudang description is here ', 'Highschool - SMA', '', '', '', '', 'Contract', '2015-09-15', '2015-11-30', 3, 0, 0, '', 8, 9, 'open', 1, '2015-09-15 10:31:22', 1, '2015-11-17 02:09:51'),
(4, 'Head Manager', 'Bandung', '<ul><li>Head Manager desc is needed to blah blah blah Head Manager desc is needed to blah blah blah Head Manager desc is needed to blah blah blah Head Manager desc is needed to blah blah blah Head </li><li>Manager desc is needed to blah blah blah Head Manager desc is needed to blah blah blah Head Manager desc is needed to </li><li>blah blah blah Head Manager desc is needed to blah blah blah Head Manager desc is needed to blah blah blah </li></ul>', 'Head Manager desc is needed.', 'Bachelor - S1', '', '', '', '', 'Permanent', '2015-09-15', '2015-11-30', 1, 0, 0, '', 8, 9, 'open', 1, '2015-09-15 10:36:12', 9, '2015-11-17 02:09:53'),
(5, 'Warehouse Staff', 'Surabaya', 'Staff gudang is currently needed in order to keep blah blah blah Staff gudang is currently needed in order to keep blah blah blah Staff gudang is currently needed in order to keep blah blah blah Staff gudang is currently needed in order to keep blah blah blah Staff gudang is currently needed in order to keep blah blah blah Staff gudang is currently needed in order to keep blah blah blah Staff gudang is currently needed in order to keep blah blah blah ', 'Staff gudang is currently needed in order to keep blah blah blah ', 'Highschool - SMA', NULL, NULL, NULL, NULL, 'Daily Worker', '2015-09-15', '2015-11-30', 0, 0, 0, NULL, 8, 2, 'open', 1, '2015-09-15 10:37:11', 1, '2015-11-17 02:09:55'),
(6, 'Retail Manager', 'Tangerang', 'Retail manager is responsible for all retail process in his/ her retail area. make it longer here and bla bla bla Retail manager is responsible for all retail process in his/ her retail area. make it longer here and bla bla bla Retail manager is responsible for all retail process in his/ her retail area. make it longer here and bla bla bla Retail manager is responsible for all retail process in his/ her retail area. make it longer here and bla bla bla Retail manager is responsible for all retail process in his/ her retail area. make it longer here and bla bla bla ', 'Retail manager is responsible for all retail process in his/ her retail area.', 'Bachelor - S1', '', '', '', '', 'Contract', '2015-10-19', '2015-10-19', 1, 0, 0, '', 8, 9, 'closed', 1, '2015-10-19 14:04:50', 1, '2015-11-17 02:12:57'),
(7, 'Posisi percobaan', 'Kab. Merauke', 'Ini posisi percobaan duank', 'briefnya', 'Bachelor - S1', 'male', '28', 'Single', '1', 'Contract', '2015-10-01', '2015-11-01', 1, 5000000, 6000000, '2C', 8, 9, 'closed', 3, '2015-10-23 16:31:57', 8, '2015-11-13 09:00:52'),
(8, 'Personalia Toko', 'Kab. Kendal', 'Menjadi personalia toko di daerah daerah Menjadi personalia toko di daerah daerah Menjadi personalia toko di daerah daerah Menjadi personalia toko di daerah daerah Menjadi personalia toko di daerah daerah Menjadi personalia toko di daerah daerah \\r\\n\\r\\nMenjadi personalia toko di daerah daerah Menjadi personalia toko di daerah daerah Menjadi personalia toko di daerah daerah ', 'brief personalia toko', 'Bachelor - S1', '', '35', '', '3', 'Permanent', '2015-10-25', '2015-11-30', 3, 7000000, 8000000, '3A', 8, 9, 'open', 3, '2015-10-23 17:29:07', 3, '2015-11-17 02:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `m_lob`
--

CREATE TABLE IF NOT EXISTS `m_lob` (
  `lob_id` int(2) DEFAULT NULL,
  `lob_name` varchar(52) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_lob`
--

INSERT INTO `m_lob` (`lob_id`, `lob_name`) VALUES
(1, 'Accounting / Audit / Tax Services'),
(2, 'Advertising / Marketing / Promotion / PR'),
(3, 'Aerospace / Aviation / Airline'),
(4, 'Agricultural / Plantation / Poultry / Fisheries'),
(5, 'Apparel'),
(6, 'Architectural Services / Interior Designing'),
(7, 'Arts / Design / Fashion'),
(8, 'Automobile / Automotive Ancillary / Vehicle'),
(9, 'Banking / Financial Services'),
(10, 'BioTechnology / Pharmaceutical / Clinical research'),
(11, 'Call Center / IT-Enabled Services / BPO'),
(12, 'Chemical / Fertilizers / Pesticides'),
(13, 'Computer / Information Technology (Hardware)'),
(14, 'Computer / Information Technology (Software)'),
(15, 'Construction / Building / Engineering'),
(16, 'Consulting (Human Resource, Business and Management)'),
(17, 'Consulting (IT, Science, Engineering and Technical)'),
(18, 'Consumer Products / FMCG'),
(19, 'Education'),
(20, 'Electrical and Electronics'),
(21, 'Entertainment / Media'),
(22, 'Environment / Health / Safety'),
(23, 'Exhibitions / Event management / MICE'),
(24, 'Food and Beverage / Catering / Restaurant'),
(25, 'Gems / Jewellery'),
(26, 'General and Wholesale Trading'),
(27, 'Government / Defence'),
(28, 'Grooming / Beauty / Fitness'),
(29, 'Healthcare / Medical'),
(30, 'Heavy Industrial / Machinery / Equipment'),
(31, 'Hotel / Hospitality'),
(32, 'Human Resources Management / Consulting'),
(33, 'Insurance'),
(34, 'Journalism'),
(35, 'Law / Legal'),
(36, 'Library / Museum'),
(37, 'Manufacturing / Production'),
(38, 'Marine / Aquaculture'),
(39, 'Mining'),
(40, 'Non-Profit Organisation / Social Services / NGO'),
(41, 'Oil / Gas / Petroleum'),
(42, 'Polymer / Plastic / Rubber / Tyres'),
(43, 'Printing / Publishing'),
(44, 'Property / Real Estate'),
(45, 'Research and Development'),
(46, 'Repair and Maintenance Services'),
(47, 'Retail / Merchandise'),
(48, 'Science and Technology'),
(49, 'Security / Law Enforcement'),
(50, 'Semiconductor / Wafer Fabrication'),
(51, 'Sports'),
(52, 'Stockbroking / Securities'),
(53, 'Telecommunication'),
(54, 'Textiles / Garment'),
(55, 'Tobacco'),
(56, 'Transportation / Logistics'),
(57, 'Travel / Tourism'),
(58, 'Utilities / Power'),
(59, 'Wood / Fibre / Paper');

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

CREATE TABLE IF NOT EXISTS `m_menu` (
  `menu_id` int(3) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `menu_title` varchar(50) NOT NULL,
  `menu_text` text,
  `menu_filename` varchar(50) NOT NULL,
  `menu_home` varchar(1) NOT NULL,
  `menu_type` varchar(20) NOT NULL,
  `menu_show` varchar(1) NOT NULL,
  `menu_order` int(2) NOT NULL,
  `menu_parent_id` int(3) NOT NULL DEFAULT '0',
  `menu_icon` varchar(50) NOT NULL,
  `menu_color` varchar(15) NOT NULL,
  `menu_module` varchar(25) DEFAULT NULL,
  `menu_show_inner` varchar(1) DEFAULT NULL,
  `status_id` varchar(10) NOT NULL,
  `user_insert` int(11) NOT NULL DEFAULT '1',
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL DEFAULT '1',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`menu_id`, `menu_name`, `menu_title`, `menu_text`, `menu_filename`, `menu_home`, `menu_type`, `menu_show`, `menu_order`, `menu_parent_id`, `menu_icon`, `menu_color`, `menu_module`, `menu_show_inner`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 'home', 'HOME', '', 'ds.home.php', 'y', 'primary', 'y', 1, 0, 'fa-home', 'kuning', '', 'n', 'active', 1, '2015-09-07 00:00:00', 1, '2015-09-14 02:34:14'),
(2, 'vacancy', 'Job Vacancy', '', 'ds.vacancy.php', 'n', 'primary', 'y', 2, 0, 'fa-bookmark', 'kuning', '', 'n', 'active', 1, '2015-09-07 00:00:00', 1, '2015-09-14 02:34:15'),
(3, 'detail', 'Detail Job Vacancy', NULL, 'ds.vacancydetail.php', 'n', 'primary', 'n', 11, 0, 'fa-bookmark', 'kuning', NULL, 'n', 'active', 1, '2015-09-15 13:28:16', 1, '2015-10-12 11:11:10'),
(4, 'changepasswd', 'Change Password', NULL, 'ds.changepasswd.php', 'n', 'inner', 'n', 10, 0, 'fa-unlock-alt', 'grey', NULL, 'n', 'inactive', 1, '2015-09-15 09:06:52', 1, '2015-10-12 11:11:12'),
(5, 'howtoapply', 'How to Apply', '', 'ds.howto.php', 'n', 'primary', 'y', 3, 0, 'fa-check', 'kuning', '', 'n', 'active', 1, '2015-09-07 00:00:00', 1, '2015-10-12 11:11:14'),
(6, 'faq', 'Frequently Asked Question', '', 'ds.faq.php', 'n', 'primary', 'n', 4, 0, 'fa-question-circle', 'kuning', '', 'n', 'inactive', 1, '2015-09-07 00:00:00', 1, '2015-11-09 02:15:04'),
(7, 'contactus', 'Contact Us', '', 'ds.contactus.php', 'n', 'primary', 'y', 5, 0, 'fa-envelope', 'kuning', '', 'n', 'active', 1, '2015-09-07 00:00:00', 1, '2015-10-12 11:11:18'),
(8, 'register', 'Registration', '', 'ds.register.php', 'n', 'upperight', 'y', 1, 0, 'fa-user', 'orange', '', 'n', 'active', 1, '2015-09-09 14:41:29', 1, '2015-10-12 11:11:20'),
(9, 'resendactivation', 'Resend Activation Email', '', 'ds.resendactivation.php', 'n', 'upperight', 'y', 2, 0, 'fa-paper-plane', 'orange', NULL, 'n', 'active', 1, '2015-09-10 11:39:15', 1, '2015-10-12 11:11:22'),
(10, 'forgotpwd', 'Forgot Password', NULL, 'ds.forgotpwd.php', 'n', 'upperight', 'y', 3, 0, 'fa-lightbulb-o', 'orange', NULL, 'n', 'active', 1, '2015-09-10 11:42:36', 1, '2015-10-12 11:11:31'),
(12, 'login', 'Login', NULL, 'ds.loginfrm.php', 'n', 'upperight', 'y', 4, 0, 'fa-lock', 'orange', NULL, 'n', 'active', 1, '2015-09-10 11:51:50', 1, '2015-10-08 07:15:02'),
(13, 'resume', 'Personal Data', NULL, 'ds.resume.php', 'n', 'inner', 'y', 1, 0, 'fa-user', 'grey', NULL, 'y', 'active', 1, '2015-09-10 11:53:07', 1, '2015-09-15 06:31:36'),
(14, 'education', 'Educational Background', NULL, 'ds.education.php', 'n', 'inner', 'y', 2, 0, 'fa-graduation-cap', 'grey', NULL, 'y', 'active', 1, '2015-09-10 11:56:45', 1, '2015-09-15 06:31:34'),
(15, 'workingexp', 'Working Experiences', NULL, 'ds.workingexp.php', 'n', 'inner', 'y', 3, 0, 'fa-briefcase', 'grey', NULL, 'y', 'active', 1, '2015-09-10 11:59:15', 1, '2015-09-15 06:31:31'),
(16, 'organization', 'Organizational Experiences', NULL, 'ds.org.php', 'n', 'inner', 'y', 4, 0, 'fa-sitemap', 'grey', NULL, 'y', 'active', 1, '2015-09-10 12:02:23', 1, '2015-09-23 08:10:26'),
(17, 'training', 'Training and Certification', NULL, 'ds.training.php', 'n', 'inner', 'y', 5, 0, 'fa-certificate', 'grey', NULL, 'y', 'active', 1, '2015-09-10 12:04:01', 1, '2015-09-15 06:31:25'),
(18, 'skills', 'Skills', NULL, 'ds.skills.php', 'n', 'inner', 'y', 6, 0, 'fa-trophy', 'grey', NULL, 'y', 'active', 1, '2015-09-10 12:07:13', 1, '2015-09-15 06:31:22'),
(19, 'language', 'Language Proficiency', NULL, 'ds.language.php', 'n', 'inner', 'y', 7, 0, 'fa-language', 'grey', NULL, 'y', 'active', 1, '2015-09-10 12:08:18', 1, '2015-10-28 03:28:05'),
(21, 'documents', 'Upload Document', NULL, 'ds.documents.php', 'n', 'inner', 'y', 9, 0, 'fa fa-upload', 'grey', NULL, 'y', 'active', 1, '2015-09-10 12:15:41', 1, '2015-09-23 04:33:58'),
(23, 'logout', 'Logout', NULL, 'logout.php', 'n', 'inner', 'n', 11, 0, 'fa fa-sign-out', 'grey', NULL, 'n', 'active', 1, '2015-09-14 14:11:46', 1, '2015-10-02 10:32:11'),
(24, 'admlogin', 'Login Admin', NULL, 'adm.login.php', 'n', 'admprimary', 'n', 1, 0, 'fa-lock', 'grey', '', 'n', 'active', 1, '2015-09-10 14:11:10', 1, '2015-10-13 03:00:45'),
(25, 'admhome', 'Dashboard', NULL, 'adm.home.php', 'n', 'admprimary', 'y', 2, 0, 'fa-tachometer', 'grey', '', 'n', 'active', 1, '2015-09-10 13:52:39', 1, '2015-10-13 03:38:26'),
(27, 'screening', 'Candidate Screening', NULL, 'adm.screening.php', 'n', 'admprimary', 'y', 11, 0, 'fa-filter', 'grey', '', 'n', 'active', 1, '2015-09-10 13:54:43', 1, '2015-11-12 03:15:08'),
(20, 'family', 'Family Background', NULL, 'ds.fam.php', 'n', 'inner', 'y', 8, 0, 'fa-users', 'grey', NULL, 'y', 'active', 1, '2015-09-23 11:32:51', 1, '2015-09-23 04:33:39'),
(22, 'questionaire', 'Questionaire', NULL, 'ds.question.php', 'n', 'inner', 'y', 10, 0, 'fa-pencil-square-o', 'grey', NULL, 'y', 'active', 1, '2015-10-02 17:31:10', 1, '2015-10-02 10:31:56'),
(11, 'rstpwd', 'Reset Password', NULL, 'ds.resetpasswd.php', 'n', 'upperight', 'n', 4, 0, 'fa-refresh', 'orange', NULL, 'n', 'active', 1, '2015-10-12 18:10:36', 1, '2015-10-12 11:13:00'),
(26, 'jobadv', 'Job Advertisement', NULL, 'adm.jobadv.php', 'n', 'admprimary', 'y', 3, 0, 'fa-bookmark', 'grey', NULL, 'n', 'active', 1, '2015-10-13 15:53:20', 1, '2015-10-13 09:33:24'),
(30, 'applicants', 'List of Candidate', NULL, 'adm.applicants.php', 'n', 'admprimary', 'y', 5, 0, 'fa-users', 'grey', NULL, 'n', 'active', 1, '2015-10-14 22:39:24', 1, '2015-11-13 02:05:04'),
(31, 'listperstage', 'List per Stage', NULL, 'adm.list_per_stage.php', 'n', 'admprimary', 'n', 6, 0, 'fa-users', 'grey', NULL, 'n', 'active', 1, '2015-10-15 09:36:38', 1, '2015-10-15 02:36:39'),
(32, 'updateadv', 'Update Job Advertisement', NULL, 'adm.upd_adv.php', 'n', 'admprimary', 'n', 7, 0, 'fa-pencil', 'grey', NULL, 'n', 'active', 1, '2015-10-15 13:27:13', 1, '2015-10-15 06:27:14'),
(33, 'detailcandidate', 'Detail Candidate', NULL, 'adm.detail_candidate.php', 'n', 'admprimary', 'n', 8, 0, 'fa-users', 'grey', NULL, 'n', 'active', 1, '2015-10-26 16:42:43', 1, '2015-10-26 09:42:44'),
(34, 'personaldata', 'Personal Data', NULL, 'adm.candidate_resume.php', 'n', 'admtab', 'y', 1, 0, 'fa-users', 'grey', NULL, 'n', 'active', 1, '2015-10-27 10:16:52', 1, '2015-10-27 03:16:54'),
(35, 'personaledu', 'Education', NULL, 'adm.candidate_edu.php', 'n', 'admtab', 'y', 2, 0, 'fa-graduation-cap', 'grey', NULL, 'n', 'active', 1, '2015-10-27 10:18:22', 1, '2015-10-28 03:31:06'),
(36, 'personalexp', 'Experiences', NULL, 'adm.candidate_exp.php', 'n', 'admtab', 'y', 3, 0, 'fa-briefcase', 'grey', NULL, 'n', 'active', 1, '2015-10-27 10:19:25', 1, '2015-10-28 03:31:12'),
(37, 'personalorg', 'Organization', NULL, 'adm.candidate_org.php', 'n', 'admtab', 'y', 4, 0, 'fa-sitemap', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:20:39', 1, '2015-10-28 03:31:17'),
(38, 'personaltraining', 'Training', NULL, 'adm.candidate_training.php', 'n', 'admtab', 'y', 5, 0, 'fa-certificate', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:21:47', 1, '2015-10-28 03:31:22'),
(39, 'personalskills', 'Skills', NULL, 'adm.candidate_skills.php', 'n', 'admtab', 'y', 6, 0, 'fa-trophy', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:22:42', 1, '2015-10-28 03:22:44'),
(40, 'personallanguage', 'Languages', NULL, 'adm.candidate_language.php', 'n', 'admtab', 'y', 7, 0, 'fa-language', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:23:50', 1, '2015-10-28 03:31:25'),
(41, 'personalfamily', 'Family', NULL, 'adm.candidate_family.php', 'n', 'admtab', 'y', 8, 0, 'fa-users', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:25:15', 1, '2015-10-28 03:31:30'),
(42, 'personaldoc', 'Document', NULL, 'adm.candidate_doc.php', 'n', 'admtab', 'y', 9, 0, 'fa fa-upload', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:26:41', 1, '2015-10-28 03:31:33'),
(44, 'historycandidate', 'Candidate History', NULL, 'adm.candidate_history.php', 'n', 'admprimary', 'n', 9, 0, 'fa-clock-o', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:52:24', 1, '2015-10-28 03:52:25'),
(43, 'personalquestionaire', 'Questionaire', NULL, 'adm.candidate_questionaire.php', 'n', 'admtab', 'y', 10, 0, 'fa-pencil-square-o', 'grey', NULL, 'n', 'active', 1, '2015-10-28 10:29:34', 1, '2015-10-28 03:29:35'),
(45, 'processingcandidate', 'Processing Status', NULL, 'adm.candidate_processing_status.php', 'n', 'admprimary', 'n', 10, 0, 'fa fa-gavel', 'grey', NULL, 'n', 'active', 1, '2015-10-28 11:12:41', 1, '2015-10-28 04:12:42'),
(46, 'registeringcandidate', 'Add New Candidate', NULL, 'adm.candidate_registration.php', 'n', 'admprimary', 'n', 12, 0, 'fa fa-user', 'grey', NULL, 'n', 'active', 1, '2015-10-29 15:02:09', 1, '2015-10-30 04:11:57'),
(47, 'candidatebyrecruiter', 'Candidate by Recruiter', NULL, 'adm.candidate_byrecruiter.php', 'n', 'admprimary', 'y', 4, 0, 'fa-user-plus', 'grey', NULL, 'n', 'active', 1, '2015-10-30 10:34:38', 1, '2015-11-13 03:35:18'),
(48, 'adminmgmt', 'Admin Management', NULL, 'adm.admin_management.php', 'n', 'superadm', 'y', 1, 0, 'fa-cogs', 'grey', NULL, 'n', 'active', 1, '2015-11-03 10:34:18', 1, '2015-11-03 03:34:19'),
(49, 'admprivilege', 'Privilege', NULL, 'adm.admin_privilege.php', 'n', 'superadm', 'y', 2, 0, 'fa-key', 'grey', NULL, 'n', 'active', 1, '2015-11-03 10:36:49', 1, '2015-11-03 03:36:50'),
(50, 'updateuser', 'Update User', NULL, 'adm.admin_update.php', 'n', 'superadm', 'n', 3, 0, 'fa-user', 'grey', NULL, 'n', 'active', 1, '2015-11-03 15:09:03', 1, '2015-11-03 08:09:04'),
(51, 'admchangepwd', 'Change Password', NULL, 'adm.change_password.php', 'n', 'admprimary', 'n', 13, 0, 'fa-unlock-alt', 'orange', NULL, 'n', 'active', 1, '2015-11-05 09:12:34', 1, '2015-11-05 02:14:29'),
(52, 'admhowto', 'Edit How To Page', NULL, 'adm.howto.php', 'n', 'admprimary', 'y', 14, 0, 'fa-question-circle', 'grey', NULL, 'n', 'active', 1, '2015-11-11 13:56:11', 1, '2015-11-11 06:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `m_question`
--

CREATE TABLE IF NOT EXISTS `m_question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_chapter` int(1) NOT NULL DEFAULT '0',
  `question_desc` varchar(250) NOT NULL,
  `question_deskripsi` varchar(250) NOT NULL,
  `question_type` varchar(20) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_required` varchar(1) NOT NULL DEFAULT 'y',
  `status_id` varchar(8) NOT NULL DEFAULT 'active',
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `m_question`
--

INSERT INTO `m_question` (`question_id`, `question_chapter`, `question_desc`, `question_deskripsi`, `question_type`, `question_order`, `question_required`, `status_id`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 'Own a house?', 'MEMILIKI RUMAH ?', 'yn_desc', 1, 'y', 'active', 1, '2015-10-02 16:32:53', 1, '2015-10-02 09:36:40'),
(2, 1, 'Own a plot of land ?', 'MEMILIKI SEBIDANG TANAH ?', 'yn_desc', 2, 'y', 'active', 1, '2015-10-02 16:35:50', 1, '2015-10-02 09:36:45'),
(3, 1, 'Own a car?', 'MEMILIKI MOBIL?', 'yn_desc', 3, 'y', 'active', 1, '2015-10-02 16:37:23', 1, '2015-10-02 09:37:25'),
(4, 1, 'Own a motorcycle?', 'MEMILIKI SEPEDA MOTOR?', 'yn_desc', 4, 'y', 'active', 1, '2015-10-02 16:38:10', 1, '2015-10-02 09:38:12'),
(5, 1, 'Rent a house?', 'MENYEWA RUMAH?', 'yn_desc', 5, 'y', 'active', 1, '2015-10-02 16:38:47', 1, '2015-10-02 09:38:49'),
(6, 1, 'Reside in a house owned by company?', 'TINGGAL DI RUMAH MILIK PERUSAHAAN', 'yn_desc', 6, 'y', 'active', 1, '2015-10-02 16:39:36', 1, '2015-10-02 09:39:37'),
(7, 1, 'Use a car/ motorcycle owned by company?', 'MENGGUNAKAN MOBIL/ MOTOR MILIK PERUSAHAAN', 'yn_desc', 7, 'y', 'active', 1, '2015-10-02 16:40:29', 1, '2015-10-02 09:40:31'),
(8, 2, 'Have you previously applied to our company? If so, when and what position?', 'APAKAH ANDA PERNAH MELAMAR PADA PERUSAHAAN INI SEBELUMNYA? BILAMANA DAN SEBAGAI APA?', 'yn_desc', 1, 'y', 'active', 1, '2015-10-02 16:45:52', 1, '2015-10-02 09:45:53'),
(9, 2, 'Are you also applying to other companies? If yes, please mention what companies and position applied.', 'SELAIN DI SINI, DI PERUSAHAAN MANA LAGI ANDA MELAMAR SAAT SEBELUMNYA? BILAMANA DAN SEBAGAI APA?', 'yn_desc', 2, 'y', 'active', 1, '2015-10-02 16:47:41', 1, '2015-10-02 09:47:43'),
(10, 2, 'Are you under any contract agreement with other companies?', 'APAKAH ANDA TERIKAT KONTRAK DENGAN PERUSAHAAN TEMPAT KERJA SAAT INI?', 'yn_desc', 3, 'y', 'active', 1, '2015-10-02 16:48:45', 1, '2015-10-02 09:50:41'),
(11, 2, 'Do you have any part-time job? Specify the name of the company and position mentioned.', 'APAKAH ANDA MEMPUNYAI PEKERJAAN SAMPINGAN/ PART TIME? DI MANA DAN SEBAGAI APA?', 'yn_desc', 4, 'y', 'active', 1, '2015-10-02 16:50:32', 1, '2015-10-02 09:50:34'),
(12, 2, 'Do you have any objections if we contact your previous employer for reference checking? Please mention name and cellular number your reference', 'APAKAH ANDA BERKEBERATAN BILA KAMI MINTA REFERENSI PADA PERUSAHAAN TEMPAT ANDA PERNAH BEKERJA? SEBUTKAN NAMA YANG DAPAT MENJADI REFERENSI ANDA.', 'yn_desc', 5, 'y', 'active', 1, '2015-10-02 16:52:32', 1, '2015-10-02 09:52:41'),
(13, 2, 'Do you have any acquaintance(s) or relative(s) employed by our company? Please, mention name and your relationship.', 'APAKAH ANDA MEMPUNYAI TEMAN/ SANAK SAUDARA YANG BEKERJA PADA PERUSAHAAN INI? SEBUTKAN NAMA DAN HUBUNGAN ANDA.', 'yn_desc', 6, 'y', 'active', 1, '2015-10-02 16:55:36', 1, '2015-10-02 09:55:39'),
(14, 2, 'What serious illness/ surgeries/ accidents have you ever had?', 'APAKAH ANDA PERNAH MENDERITA SAKIT KERAS/ KRONIS/ KECELAKAAN BERAT/ OPERASI? BILAMANA DAN MACAM APA? JELASKAN.', 'yn_desc', 7, 'y', 'active', 1, '2015-10-02 16:57:05', 1, '2015-10-02 09:57:07'),
(15, 2, 'Have you ever undergone any psychological tests before? If so, when, where, and for what purpose?', 'APAKAH ANDA PERNAH MENJALANI PEMERIKSAAN PSIKOLOGIS/ PSIKOTES? BILAMA, DI MANA, DAN UNTUK TUJUAN APA?', 'yn_desc', 8, 'y', 'active', 1, '2015-10-02 17:04:56', 1, '2015-10-02 10:04:58'),
(16, 2, 'Have you ever been involved in any administrative, civil, or criminal case?', 'APAKAH ANDA PERNAH BERURUSAN DENGAN POLISI KARENA TINDAK KEJAHATAN?', 'yn_desc', 9, 'y', 'active', 1, '2015-10-02 17:06:26', 1, '2015-10-02 10:06:28'),
(17, 2, 'If accepted, do you agree to out to Jakarta assignment?', 'BILA DITERIMA, BERSEDIAKAH ANDA BERTUGAS KE LUAR KOTA?', 'yn_desc', 10, 'y', 'active', 1, '2015-10-02 17:07:43', 1, '2015-10-02 10:07:44'),
(18, 2, 'If accepted, do you agree to be located anywhere in Indonesia? Please mention prefered cities of region.', 'BILA DITERIMA, BERSEDIAKAH ANDA DITEMPATKAN DI SELURUH DAERAH DI INDONESIA? SEBUTKAN NAMA KOTA DAN DAERAH YANG LEBIH DISUKAI.', 'yn_desc', 11, 'y', 'active', 1, '2015-10-02 17:10:05', 1, '2015-10-04 12:31:20'),
(19, 2, 'Describe any kind of jobs that are in line with your career plan.', 'MACAM PEKERJAAN/ JABATAN APAKAH YANG SESUAI DENGAN CITA-CITA ANDA?', 'txt_area', 12, 'y', 'active', 1, '2015-10-02 17:13:59', 1, '2015-10-02 10:14:01'),
(20, 2, 'Describe any kind of jobs that you don''t like.', 'MACAM PEKERJAAN/ BAGAIMANAKAH YANG TIDAK ANDA SUKAI?', 'txt_area', 13, 'y', 'active', 1, '2015-10-02 17:15:48', 1, '2015-10-04 16:23:25'),
(21, 2, 'Please state your current monthly income.', 'BERAPA BESARKAH PENGHASILAN ANDA SEBULAN?', 'txt_box_cur', 14, 'y', 'active', 1, '2015-10-02 17:16:56', 1, '2015-11-16 10:18:03'),
(25, 2, 'State facilities you desired.', 'BILA DITERIMA, FASILITAS APA YANG ANDA HARAPKAN?', 'txt_area', 17, 'y', 'active', 1, '2015-10-02 17:18:13', 1, '2015-11-16 09:21:04'),
(22, 2, 'State salary you expect to receive.', 'BILA DITERIMA, BERAPA GAJI YANG ANDA HARAPKAN?', 'txt_box_cur', 16, 'y', 'active', 1, '2015-10-02 17:18:13', 1, '2015-11-16 10:18:07'),
(23, 2, 'If accepted, when you can start working?', 'BILA DITERIMA, KAPAN ANDA DAPAT MULAI BEKERJA?', 'txt_area', 18, 'y', 'active', 1, '2015-10-02 17:19:21', 1, '2015-11-16 09:33:00'),
(24, 2, 'Please state your current monthly facilities.', 'FASILITAS APA SAJA YANG ANDA PEROLEH DARI POSISI SAAT INI?', 'txt_area', 15, 'y', 'active', 1, '2015-10-02 17:16:56', 1, '2015-11-16 09:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `m_register`
--

CREATE TABLE IF NOT EXISTS `m_register` (
  `register_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(100) NOT NULL,
  `candidate_email` varchar(250) NOT NULL,
  `candidate_passwd` varchar(250) NOT NULL,
  `candidate_birthplace` varchar(100) NOT NULL,
  `candidate_birthdate` date NOT NULL,
  `candidate_gender` varchar(6) NOT NULL,
  `candidate_nationality` varchar(3) NOT NULL,
  `candidate_country` varchar(25) NOT NULL,
  `candidate_idtype` varchar(8) NOT NULL,
  `candidate_idcard` varchar(16) NOT NULL,
  `candidate_hp1` varchar(25) NOT NULL,
  `candidate_hp2` varchar(25) DEFAULT NULL,
  `candidate_phone` varchar(25) DEFAULT NULL,
  `register_date` datetime NOT NULL,
  `register_expiry_date` datetime NOT NULL,
  `register_activation_code` varchar(250) NOT NULL,
  PRIMARY KEY (`register_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_required`
--

CREATE TABLE IF NOT EXISTS `m_required` (
  `required_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `required_name` varchar(100) NOT NULL,
  `status_id` tinyint(1) unsigned NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  PRIMARY KEY (`required_id`),
  UNIQUE KEY `required_name` (`required_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `m_required`
--

INSERT INTO `m_required` (`required_id`, `required_name`, `status_id`, `date_insert`, `user_insert`, `date_update`, `user_update`) VALUES
(2, 'education', 1, '2015-04-21 00:00:00', 1, '2015-04-21 00:00:00', 1),
(3, 'workingexp', 0, '2015-04-21 00:00:00', 1, '2015-04-21 06:45:06', 1),
(8, 'family', 0, '2015-04-21 00:00:00', 1, '2015-04-21 00:00:00', 1),
(5, 'language', 0, '2015-04-21 00:00:00', 1, '2015-04-21 00:00:00', 1),
(6, 'organization', 0, '2015-04-21 00:00:00', 1, '2015-04-21 00:00:00', 1),
(4, 'training', 0, '2015-04-21 00:00:00', 1, '2015-04-21 00:00:00', 1),
(7, 'skills', 0, '0000-00-00 00:00:00', 1, NULL, 1),
(9, 'passphoto', 1, '0000-00-00 00:00:00', 1, NULL, 1),
(11, 'transcript', 1, '0000-00-00 00:00:00', 1, NULL, 1),
(12, 'ijazah', 1, '0000-00-00 00:00:00', 1, NULL, 1),
(1, 'resume', 1, '0000-00-00 00:00:00', 1, NULL, 1),
(13, 'coverletter', 0, '2015-10-08 17:39:51', 1, '2015-10-08 17:39:53', 1),
(10, 'idcard', 1, '2015-10-08 17:40:08', 1, '2015-10-08 17:40:09', 1),
(30, 'questionaire', 1, '2015-10-20 09:59:44', 1, '2015-10-20 09:59:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_answer`
--

CREATE TABLE IF NOT EXISTS `t_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_yn` varchar(1) NOT NULL,
  `answer_desc` text NOT NULL,
  `answer_date` datetime NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`),
  UNIQUE KEY `unique_input` (`candidate_id`,`question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `t_answer`
--

INSERT INTO `t_answer` (`answer_id`, `candidate_id`, `question_id`, `answer_yn`, `answer_desc`, `answer_date`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(1, 1, 1, 'y', 'new house', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(2, 1, 2, 'n', 'no land', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(34, 1, 10, 'n', 'no contract lah', '2015-10-05 11:40:20', 4, '2015-10-05 11:40:20', 1, '2015-11-17 08:13:06'),
(4, 1, 4, 'y', 'supra', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(5, 1, 5, 'y', 'rent house', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(30, 1, 20, '', 'dc', '2015-10-05 11:38:13', 4, '2015-10-05 11:38:13', 1, '2015-11-17 08:13:06'),
(8, 1, 8, 'n', 'never applied', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(9, 1, 9, 'n', 'no other comp', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(11, 1, 11, 'n', 'dont have time', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(12, 1, 12, 'y', 'sure lah', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(13, 1, 13, 'n', 'no relatives', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(26, 1, 21, '', '20000000', '2015-10-05 11:27:14', 4, '2015-10-05 11:27:14', 1, '2015-11-17 08:13:06'),
(15, 1, 15, 'y', 'job interview', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(16, 1, 16, 'n', 'good civilian', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(17, 1, 17, 'y', 'love travelling', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(18, 1, 18, 'y', 'love indonesia', '2015-10-05 09:29:10', 4, '2015-10-05 09:29:10', 1, '2015-11-17 08:13:06'),
(31, 1, 23, '', 'today', '2015-10-05 11:38:13', 4, '2015-10-05 11:38:13', 1, '2015-11-17 08:13:06'),
(25, 1, 14, 'n', 'healthy as hell', '2015-10-05 11:27:14', 4, '2015-10-05 11:27:14', 1, '2015-11-17 08:13:06'),
(24, 1, 7, 'n', 'blon tetep', '2015-10-05 11:27:14', 4, '2015-10-05 11:27:14', 1, '2015-11-17 08:13:06'),
(33, 1, 6, 'n', 'no company house', '2015-10-05 11:40:20', 4, '2015-10-05 11:40:20', 1, '2015-11-17 08:13:06'),
(32, 1, 3, 'n', 'no car', '2015-10-05 11:40:20', 4, '2015-10-05 11:40:20', 1, '2015-11-17 08:13:06'),
(29, 1, 19, '', 'artists', '2015-10-05 11:38:13', 4, '2015-10-05 11:38:13', 1, '2015-11-17 08:13:06'),
(28, 1, 22, '', '30000000', '2015-10-05 11:35:41', 4, '2015-10-05 11:35:41', 1, '2015-11-17 08:13:06'),
(82, 2, 3, 'n', '', '2015-10-21 16:40:20', 5, '2015-10-21 16:40:20', 5, '2015-10-21 09:43:42'),
(83, 2, 4, 'y', '', '2015-10-21 16:40:20', 5, '2015-10-21 16:40:20', 5, '2015-10-21 09:43:42'),
(84, 2, 9, 'n', '', '2015-10-21 16:40:20', 5, '2015-10-21 16:40:20', 5, '2015-10-21 09:43:42'),
(85, 2, 10, 'n', '', '2015-10-21 16:40:20', 5, '2015-10-21 16:40:20', 5, '2015-10-21 09:43:42'),
(86, 2, 20, '', 'sales', '2015-10-21 16:40:20', 5, '2015-10-21 16:40:20', 5, '2015-10-21 09:43:42'),
(87, 2, 1, 'y', 'masi kredit sih', '2015-10-21 16:42:01', 5, '2015-10-21 16:42:01', 5, '2015-10-21 09:43:42'),
(88, 2, 19, '', 'hrd', '2015-10-21 16:42:01', 5, '2015-10-21 16:42:01', 5, '2015-10-21 09:43:42'),
(89, 2, 5, 'y', '', '2015-10-21 16:42:31', 5, '2015-10-21 16:42:31', 5, '2015-10-21 09:43:42'),
(90, 2, 6, 'n', 'blon dapat jatah', '2015-10-21 16:42:31', 5, '2015-10-21 16:42:31', 5, '2015-10-21 09:43:42'),
(91, 2, 7, 'n', 'masih anak baru', '2015-10-21 16:42:31', 5, '2015-10-21 16:42:31', 5, '2015-10-21 09:43:42'),
(92, 2, 8, 'n', '', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(93, 2, 11, 'n', 'ga da waktu', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(94, 2, 12, 'y', 'personal matter ini', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(95, 2, 13, 'n', '', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(96, 2, 14, 'n', '', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(97, 2, 15, 'y', 'penjurusan jaman skulah', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(98, 2, 16, 'n', '', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(99, 2, 17, 'y', '', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(100, 2, 18, 'n', 'jabodetabek', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(81, 2, 2, 'n', '', '2015-10-21 16:40:20', 5, '2015-10-21 16:40:20', 5, '2015-10-21 09:43:42'),
(101, 2, 21, '', '20000000', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(104, 1, 24, '', 'health care, gym, movie, annual trip, life insurance, etc', '2015-11-16 16:44:00', 4, '2015-11-16 16:44:00', 1, '2015-11-17 08:13:06'),
(103, 2, 23, '', 'asap', '2015-10-21 16:43:42', 5, '2015-10-21 16:43:42', 5, '2015-10-21 09:43:42'),
(105, 1, 25, '', 'better than before for sure', '2015-11-16 16:44:00', 4, '2015-11-16 16:44:00', 1, '2015-11-17 08:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `t_apply_history`
--

CREATE TABLE IF NOT EXISTS `t_apply_history` (
  `apply_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_email` varchar(100) NOT NULL,
  `job_vacancy_id` int(11) NOT NULL,
  `apply_history_date` datetime NOT NULL,
  `apply_history_stage` varchar(25) NOT NULL,
  `apply_history_status` varchar(20) NOT NULL,
  `apply_history_notes` varchar(250) DEFAULT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`apply_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `t_apply_history`
--

INSERT INTO `t_apply_history` (`apply_history_id`, `candidate_id`, `candidate_email`, `job_vacancy_id`, `apply_history_date`, `apply_history_stage`, `apply_history_status`, `apply_history_notes`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(9, 1, 'shakti_santoso@yahoo.com', 4, '2015-10-28 17:50:12', 'cv-screening', 'reject', 'Masih menunggu proses selanjutnya.', 8, '2015-10-28 17:50:12', 8, '2015-11-02 08:48:42'),
(2, 1, 'shakti_santoso@yahoo.com', 1, '2015-10-09 13:55:16', 'cv-screening', 'pass', '', 4, '2015-10-09 13:55:16', 8, '2015-11-02 08:46:09'),
(3, 1, 'shakti_santoso@yahoo.com', 5, '2015-10-09 16:30:22', 'cv-screening', 'pass', '', 4, '2015-10-09 16:30:22', 8, '2015-11-02 08:49:48'),
(34, 1, 'shakti_santoso@yahoo.com', 1, '2015-11-03 09:34:12', 'offering', 'ongoing', 'test n interviu ok, tinggal tunggu offering', 8, '2015-11-03 09:34:12', 8, '2015-11-03 02:34:12'),
(5, 3, 'lindi@yahoo.com', 1, '2015-10-14 23:00:13', 'cv-screening', 'pass', '', 6, '2015-10-14 23:00:13', 8, '2015-11-03 02:30:38'),
(8, 1, 'shakti_santoso@yahoo.com', 4, '2015-10-28 14:40:25', 'cv-screening', 'reject', 'ini notes', 4, '2015-10-28 14:40:25', 8, '2015-11-02 08:48:42'),
(7, 3, 'lindi@yahoo.com', 4, '2015-10-15 12:01:18', 'cv-screening', 'ongoing', '', 6, '2015-10-15 12:01:18', 6, '2015-10-15 05:01:18'),
(10, 3, 'lindi@yahoo.com', 4, '2015-10-29 10:57:00', 'cv-screening', 'pending', 'sementara dipending dulu karena ada libur panjang.', 8, '2015-10-29 10:57:00', 8, '2015-10-29 03:57:00'),
(33, 3, 'lindi@yahoo.com', 1, '2015-11-03 09:30:38', 'psychotest', 'ongoing', 'qualified dari cv-nya', 8, '2015-11-03 09:30:38', 8, '2015-11-03 02:30:38'),
(32, 6, 'suckteas@gmail.com', 1, '2015-11-02 17:56:19', 'cv-screening', 'ongoing', 'saingan baru buat Shakti Candidate', 8, '2015-11-02 17:56:19', 8, '2015-11-02 10:56:19'),
(31, 1, 'shakti_santoso@yahoo.com', 2, '2015-11-02 15:56:36', 'cv-screening', 'ongoing', '', 4, '2015-11-02 15:56:36', 4, '2015-11-02 08:56:36'),
(30, 1, 'shakti_santoso@yahoo.com', 5, '2015-11-02 15:50:32', 'hr-interview', 'reject', 'ternyata minatnya di hris', 8, '2015-11-02 15:50:32', 8, '2015-11-02 08:50:32'),
(29, 1, 'shakti_santoso@yahoo.com', 5, '2015-11-02 15:50:18', 'hr-interview', 'reject', 'tergantung ntar di interview-nya', 8, '2015-11-02 15:50:18', 8, '2015-11-02 08:50:32'),
(28, 1, 'shakti_santoso@yahoo.com', 5, '2015-11-02 15:49:48', 'psychotest', 'pass', 'prospektif untuk hris', 8, '2015-11-02 15:49:48', 8, '2015-11-02 08:50:18'),
(27, 1, 'shakti_santoso@yahoo.com', 4, '2015-11-02 15:48:42', 'cv-screening', 'reject', 'lebih cocok untuk di HRIS', 8, '2015-11-02 15:48:42', 8, '2015-11-02 08:48:42'),
(26, 1, 'shakti_santoso@yahoo.com', 1, '2015-11-02 15:47:37', 'user-interview', 'pass', 'lolos interview hr, skarang ke user', 8, '2015-11-02 15:47:37', 8, '2015-11-03 02:34:12'),
(24, 1, 'shakti_santoso@yahoo.com', 1, '2015-11-02 15:46:09', 'psychotest', 'pass', 'lolos screening cv', 8, '2015-11-02 15:46:09', 8, '2015-11-02 08:47:13'),
(25, 1, 'shakti_santoso@yahoo.com', 1, '2015-11-02 15:47:13', 'hr-interview', 'pass', 'lolos psikotes, trus ke interview hr', 8, '2015-11-02 15:47:13', 8, '2015-11-02 08:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `t_candidate_apply`
--

CREATE TABLE IF NOT EXISTS `t_candidate_apply` (
  `candidate_apply_id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_email` varchar(100) NOT NULL,
  `job_vacancy_id` int(11) NOT NULL,
  `candidate_apply_date` datetime NOT NULL,
  `candidate_apply_stage` varchar(25) NOT NULL,
  `candidate_apply_status` varchar(20) NOT NULL,
  `user_insert` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`candidate_apply_id`),
  UNIQUE KEY `apply_once` (`candidate_id`,`job_vacancy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `t_candidate_apply`
--

INSERT INTO `t_candidate_apply` (`candidate_apply_id`, `candidate_id`, `candidate_email`, `job_vacancy_id`, `candidate_apply_date`, `candidate_apply_stage`, `candidate_apply_status`, `user_insert`, `date_insert`, `user_update`, `date_update`) VALUES
(2, 1, 'shakti_santoso@yahoo.com', 1, '2015-10-09 13:55:16', 'offering', 'ongoing', 4, '2015-10-09 13:55:16', 8, '2015-11-03 02:34:12'),
(3, 1, 'shakti_santoso@yahoo.com', 5, '2015-10-09 16:30:22', 'hr-interview', 'reject', 4, '2015-10-09 16:30:22', 8, '2015-11-02 08:50:32'),
(4, 3, 'lindi@yahoo.com', 1, '2015-10-14 23:00:13', 'psychotest', 'ongoing', 6, '2015-10-14 23:00:13', 8, '2015-11-03 02:30:38'),
(7, 1, 'shakti_santoso@yahoo.com', 4, '2015-10-28 14:40:25', 'cv-screening', 'reject', 4, '2015-10-28 14:40:25', 8, '2015-11-02 08:48:42'),
(6, 3, 'lindi@yahoo.com', 4, '2015-10-15 12:01:18', 'cv-screening', 'ongoing', 6, '2015-10-15 12:01:18', 8, '2015-11-02 08:02:57'),
(8, 1, 'shakti_santoso@yahoo.com', 2, '2015-11-02 15:56:36', 'cv-screening', 'ongoing', 4, '2015-11-02 15:56:36', 4, '2015-11-02 08:56:36'),
(9, 6, 'suckteas@gmail.com', 1, '2015-11-02 17:56:19', 'cv-screening', 'ongoing', 8, '2015-11-02 17:56:19', 8, '2015-11-02 10:56:19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
