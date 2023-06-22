-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2015 at 01:33 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
