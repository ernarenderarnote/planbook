-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 07:09 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starts_on` date DEFAULT NULL,
  `ends_on` date DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `standards` text COLLATE utf8mb4_unicode_ci,
  `attachments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `class_id`, `user_id`, `unit_id`, `type_id`, `title`, `starts_on`, `ends_on`, `total_points`, `description`, `standards`, `attachments`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, NULL, 'Assessment for Maths class', '2017-05-01', '2017-05-01', 100, '4th hyhj j6ry7jk6j jjk6', NULL, NULL, '2017-05-16 11:05:27', '2017-05-16 11:05:27'),
(2, 7, 3, 3, NULL, 'gfdd', '2017-07-05', '2017-07-27', 10, '<p><br /><img style="width: 200px; max-width: 100%; height: 200px;" src="../../uploads/myfiles/1498026995-b16NsY-3.1.jpg" /></p>', NULL, NULL, '2017-07-05 15:26:52', '2017-08-02 16:22:54'),
(3, 9, 3, 3, NULL, 'thidfdf', '2017-07-31', '2017-07-31', 50, NULL, NULL, NULL, '2017-08-01 15:49:26', '2017-08-02 15:44:54'),
(4, 7, 3, 3, NULL, 'This is dempp', '2017-08-09', '2017-08-15', 50, '<p>This is demi</p>\r\n<p>&nbsp;</p>', NULL, NULL, '2017-08-01 16:00:03', '2017-08-02 16:13:26'),
(8, 9, 3, 3, NULL, 'bvbbcv', '2017-07-31', '2017-08-08', 50, '<p>jkhjhhjjhklhkjh fffffff</p>', NULL, NULL, '2017-08-02 15:47:02', '2017-08-02 16:12:33'),
(6, 14, 3, 7, NULL, 'jjhj', '2017-08-07', '2017-08-08', 30, '<p>gfgfdfsdgffggsgfsdgsdg</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><br /><img style="width: 200px; max-width: 100%; height: 200px;" src="../../uploads/myfiles/1498026995-b16NsY-3.1.jpg" /><br /><img style="width: 200px; max-width: 100%; height: 200px;" src="../../uploads/myfiles/1498026975-f6dWfG-1.2.jpg" /><br /><br /></p>', NULL, NULL, '2017-08-02 12:24:10', '2017-08-02 16:10:35'),
(7, 11, 3, 7, NULL, 'Thisi', '2017-08-01', '2017-08-02', 20, NULL, NULL, NULL, '2017-08-02 14:59:46', '2017-08-02 15:58:27'),
(10, 7, 3, 3, NULL, 'Thisis', '2017-08-01', '2017-08-01', 10, '<p>Thisis</p>', NULL, NULL, '2017-08-03 08:52:42', '2017-08-03 08:52:42'),
(11, 7, 3, 3, NULL, 'Hello', '2017-10-02', '2017-10-04', 10, '<p>hello</p>', NULL, NULL, '2017-10-24 23:38:02', '2017-10-24 23:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starts_on` date DEFAULT NULL,
  `ends_on` date DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `standards` text COLLATE utf8mb4_unicode_ci,
  `attachments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `class_id`, `user_id`, `unit_id`, `type_id`, `title`, `starts_on`, `ends_on`, `total_points`, `description`, `standards`, `attachments`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, 'English Assignment', '2017-05-01', '2017-05-01', 100, 'asdxdewc 4f34g 45g4', NULL, NULL, '2017-05-16 11:03:31', '2017-05-16 11:03:31'),
(2, 7, 3, 4, NULL, 'Done fast', '2017-06-01', '2017-06-26', 35, '<p>This is for demo for now</p>', NULL, NULL, '2017-06-05 01:09:53', '2017-08-03 11:00:34'),
(3, 17, 7, 8, NULL, 'sddsfsdfds', '2017-07-01', '2017-07-12', 100, 'zscfxzfczxcvxzcxzc', NULL, NULL, '2017-07-28 15:17:18', '2017-07-28 15:17:18'),
(4, 9, 3, 5, NULL, 'Thisis demo assignment', '2017-08-01', '2017-08-02', 35, '<p>This is language arts assignment.</p>', NULL, NULL, '2017-08-03 10:17:18', '2017-08-03 11:01:18'),
(5, 10, 3, 5, NULL, 'This is demo', '2017-08-02', '2017-08-02', 35, '<p><br /><img style="width: 200px; max-width: 100%; height: 200px;" src="../../uploads/myfiles/1498027496-hJ0nQD-Koala.jpg" /><br /><img style="width: 200px; max-width: 100%; height: 200px;" src="../../uploads/myfiles/1498027003-xFwFkx-6.2.jpg" /><br /><br /></p>', NULL, NULL, '2017-08-03 14:12:33', '2017-08-03 14:12:33'),
(6, 7, 3, 5, NULL, 'This is demo', '2017-08-16', '2017-08-16', 35, '<p>fdsdsf</p>', NULL, NULL, '2017-08-03 15:53:10', '2017-08-03 15:53:10'),
(7, 14, 3, 7, NULL, 'mnkjhhfnkl', '2017-07-31', '2017-08-02', 12, '<p>gfjhfdsklmnmhvfcfdl;l.</p>', NULL, NULL, '2017-08-07 06:12:29', '2017-08-07 06:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `attachment_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_assigned`
--

CREATE TABLE `class_assigned` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `year_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_assigned`
--

INSERT INTO `class_assigned` (`id`, `student_id`, `teacher_id`, `class_id`, `year_name`, `created_at`, `updated_at`) VALUES
(10, 6, 3, 9, NULL, '2017-10-31 05:51:09', '2017-10-31 05:51:09'),
(11, 7, 3, 9, NULL, '2017-10-31 05:51:09', '2017-10-31 05:51:09'),
(12, 9, 3, 9, NULL, '2017-10-31 05:51:09', '2017-10-31 05:51:09'),
(13, 10, 3, 9, NULL, '2017-10-31 05:51:09', '2017-10-31 05:51:09'),
(14, 6, 3, 10, NULL, '2017-10-31 06:03:30', '2017-10-31 06:03:30'),
(15, 7, 3, 10, NULL, '2017-10-31 06:03:30', '2017-10-31 06:03:30'),
(16, 9, 3, 10, NULL, '2017-10-31 06:03:30', '2017-10-31 06:03:30'),
(17, 10, 3, 10, NULL, '2017-10-31 06:03:30', '2017-10-31 06:03:30'),
(26, 6, 3, 7, NULL, '2017-11-01 04:46:30', '2017-11-01 04:46:30'),
(29, 8, 3, 7, NULL, '2017-11-03 01:32:08', '2017-11-03 01:32:08'),
(36, 8, 3, 7, NULL, '2017-11-06 23:56:31', '2017-11-06 23:56:31'),
(37, 8, 3, 7, NULL, '2017-11-06 23:56:32', '2017-11-06 23:56:32'),
(40, 6, 3, 7, NULL, '2017-11-06 23:56:36', '2017-11-06 23:56:36'),
(41, 8, 3, 7, NULL, '2017-11-06 23:56:37', '2017-11-06 23:56:37'),
(42, 6, 3, 7, NULL, '2017-11-06 23:56:40', '2017-11-06 23:56:40'),
(43, 6, 3, 7, NULL, '2017-11-06 23:56:42', '2017-11-06 23:56:42'),
(47, 10, 3, 7, NULL, '2017-11-07 00:23:01', '2017-11-07 00:23:01'),
(50, 6, 3, 7, NULL, '2017-11-07 00:23:31', '2017-11-07 00:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `class_lessons`
--

CREATE TABLE `class_lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lesson_date` date DEFAULT NULL,
  `lesson_start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_text` varchar(12896) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homework` varchar(1118) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` mediumtext COLLATE utf8mb4_unicode_ci,
  `standards` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lock_lesson_to_date` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_lessons`
--

INSERT INTO `class_lessons` (`id`, `class_id`, `user_id`, `lesson_date`, `lesson_start_time`, `lesson_end_time`, `unit`, `lesson_title`, `lesson_text`, `homework`, `notes`, `standards`, `attachments`, `lock_lesson_to_date`, `created_at`, `updated_at`) VALUES
(131, 7, 3, '2017-06-22', '08:00 AM', '09:00 AM', '3', 'xvdfdg', NULL, NULL, NULL, NULL, '1498027548-2Dt1oC-Lighthouse.jpg,1498027496-hJ0nQD-Koala.jpg', NULL, '2017-06-21 05:59:49', '2017-06-24 17:44:29'),
(132, 7, 3, '2017-06-20', '09:00 AM', '10:00 AM', '3', 'ddfsdfdsfds', NULL, NULL, NULL, NULL, '1498027003-xFwFkx-6.2.jpg,1498026995-b16NsY-3.1.jpg', NULL, '2017-06-21 06:08:43', '2017-06-24 17:44:18'),
(133, 7, 3, '2017-07-22', '08:30 AM', '09:00 AM', '4', 'xvdfdg', NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-22 04:32:43', '2017-06-24 17:44:18'),
(134, 11, 3, '2017-07-03', NULL, NULL, NULL, 'gsdfdsfs', '<p>fdsgsdfgdfgfds</p>', NULL, NULL, NULL, NULL, NULL, '2017-06-30 17:31:26', '2017-06-30 17:35:53'),
(135, 11, 3, '2017-06-28', NULL, NULL, NULL, 'weweweewe', '<p>esfsdfdsfdsf</p>', NULL, NULL, NULL, NULL, NULL, '2017-06-30 17:36:23', '2017-06-30 17:36:43'),
(136, 10, 3, '2017-07-03', NULL, NULL, NULL, 'g fgfddf', '<p>dfgdfgfdds</p>', NULL, NULL, NULL, NULL, NULL, '2017-07-05 17:23:32', '2017-07-05 17:23:32'),
(137, 10, 3, '2017-07-07', NULL, NULL, NULL, 'erere', '<p>fddfdffd</p>', NULL, NULL, NULL, NULL, NULL, '2017-07-05 17:24:00', '2017-07-05 17:24:00'),
(138, 7, 3, '2017-07-03', NULL, NULL, '4', 'This is demo class', '<p>This is lesson</p>', '<p>This is homework</p>', '<p>These are notes</p>', NULL, '1498027496-hJ0nQD-Koala.jpg', NULL, '2017-07-05 17:31:00', '2017-07-05 17:31:00'),
(139, 7, 3, '2017-07-11', '2', '2', '3', 'narender', '<p>fff</p>', '<p>cbxbcbxxbc</p>', '<p>bcbcx</p>', NULL, NULL, NULL, '2017-07-11 12:28:33', '2017-07-11 12:28:33'),
(140, 12, 5, '2017-07-07', '13:01', NULL, NULL, NULL, '<p>qwxqwcecew wcw</p>', NULL, NULL, NULL, NULL, NULL, '2017-07-14 10:33:15', '2017-07-14 10:33:15'),
(141, 9, 3, '2017-07-04', '08:01', '21:00', NULL, 'XXXX', '<p>vdfhgj</p>', '<p>ghfgh</p>', '<p>sdfhsdfsd</p>', NULL, NULL, 1, '2017-07-24 08:07:52', '2017-07-24 08:07:52'),
(142, 7, 3, '2017-07-25', NULL, NULL, '4', 'dd', '<p>n bhmhg</p>', NULL, NULL, NULL, NULL, NULL, '2017-07-28 13:58:21', '2017-07-28 13:58:21'),
(143, 9, 3, '2017-08-04', NULL, NULL, NULL, 'fgfdgfdg', '<p>bvbvcbcb</p>', NULL, NULL, NULL, NULL, NULL, '2017-08-02 15:28:47', '2017-09-18 00:01:19'),
(144, 13, 5, '2017-08-09', NULL, NULL, NULL, 'dfsdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, '2017-08-14 00:57:13', '2017-08-14 00:58:03'),
(145, 10, 3, '2017-09-01', '01:00', '02:00', '6', 'This is dummy', '<p>dsfdsfdsf</p>', NULL, NULL, NULL, NULL, NULL, '2017-09-18 01:29:59', '2017-09-18 01:29:59'),
(146, 10, 3, '2017-10-06', '03:00', '04:00', '6', 'Demo for student', '<p>Hii this is demo...</p>', NULL, NULL, NULL, '1498027548-2Dt1oC-Lighthouse.jpg,1498027496-hJ0nQD-Koala.jpg', 1, '2017-10-11 00:38:36', '2017-10-11 00:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedules`
--

CREATE TABLE `class_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `day_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_checked` tinyint(3) UNSIGNED NOT NULL,
  `schedule_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repeat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remove_day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `private_event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `start_date`, `end_date`, `start_time`, `end_time`, `repeat`, `school_day`, `event_title`, `event_text`, `attachment`, `add_day`, `remove_day`, `private_event`, `created_at`, `updated_at`) VALUES
(11, 2, '2017-10-24', '2017-10-24 05:44:33', '08:00 AM', '08:00 AM', 'weekly', NULL, 'This is dummy', '<p>thsi sissss</p>', 'N;', 'N;', 'N;', NULL, '2017-10-04 00:14:33', '2017-10-04 00:14:33'),
(12, 2, '2017-10-24', '2017-10-17 05:48:11', '08:00 AM', '08:00 AM', 'weekly', NULL, 'gfdgdf', NULL, 'N;', 'N;', 'N;', NULL, '2017-10-04 00:18:11', '2017-10-04 00:18:11'),
(13, 2, '2017-10-24', '2017-11-01 05:53:26', '08:00 AM', '07:30 AM', 'weekly', 'Y', 'sds', NULL, 'N;', 'N;', 'N;', NULL, '2017-10-04 00:23:26', '2017-10-04 00:23:26'),
(14, 2, '2017-10-16', '2017-09-27 06:04:40', '08:30 AM', '08:00 AM', 'daily', NULL, 'This is dummy', NULL, 'N;', 'N;', 'N;', NULL, '2017-10-04 00:34:40', '2017-10-04 00:34:40'),
(15, 2, '2017-10-31', '2017-09-25 06:05:58', '08:30 AM', '08:30 AM', 'daily', NULL, 'This is dummy', NULL, 'N;', 'N;', 'N;', NULL, '2017-10-04 00:35:58', '2017-10-04 00:35:58'),
(16, 2, '2017-09-26', '2017-09-25 06:08:06', '08:00 AM', '08:30 AM', 'daily', NULL, 'This is dummy123', NULL, 'a:1:{i:0;s:30:"1507097191-Do4bnd-Planbook.com";}', 'N;', 'N;', NULL, '2017-10-04 00:38:06', '2017-10-04 00:38:06'),
(29, 3, '2017-10-24', '2017-10-24 05:44:33', '08:00 AM', '08:00 AM', 'weekly', NULL, 'This is dummy', '<p>thsi sissss</p>', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 3, '2017-10-24', '2017-10-17 05:48:11', '08:00 AM', '08:00 AM', 'weekly', NULL, 'gfdgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 3, '2017-10-24', '2017-11-01 05:53:26', '08:00 AM', '07:30 AM', 'weekly', 'Y', 'sds', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 3, '2017-10-16', '2017-09-27 06:04:40', '08:30 AM', '08:00 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 3, '2017-10-31', '2017-09-25 06:05:58', '08:30 AM', '08:30 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 3, '2017-09-26', '2017-09-25 06:08:06', '08:00 AM', '08:30 AM', 'daily', NULL, 'This is dummy123', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 3, '2017-10-24', '2017-10-24 05:44:33', '08:00 AM', '08:00 AM', 'weekly', NULL, 'This is dummy', '<p>thsi sissss</p>', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 3, '2017-10-24', '2017-10-17 05:48:11', '08:00 AM', '08:00 AM', 'weekly', NULL, 'gfdgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 3, '2017-10-24', '2017-11-01 05:53:26', '08:00 AM', '07:30 AM', 'weekly', 'Y', 'sds', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 3, '2017-10-16', '2017-09-27 06:04:40', '08:30 AM', '08:00 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 3, '2017-10-31', '2017-09-25 06:05:58', '08:30 AM', '08:30 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 3, '2017-09-26', '2017-09-25 06:08:06', '08:00 AM', '08:30 AM', 'daily', NULL, 'This is dummy123', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 3, '2017-10-24', '2017-10-24 05:44:33', '08:00 AM', '08:00 AM', 'weekly', NULL, 'This is dummy', '<p>thsi sissss</p>', NULL, NULL, NULL, NULL, NULL, NULL),
(42, 3, '2017-10-24', '2017-10-17 05:48:11', '08:00 AM', '08:00 AM', 'weekly', NULL, 'gfdgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 3, '2017-10-24', '2017-11-01 05:53:26', '08:00 AM', '07:30 AM', 'weekly', 'Y', 'sds', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 3, '2017-10-16', '2017-09-27 06:04:40', '08:30 AM', '08:00 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 3, '2017-10-31', '2017-09-25 06:05:58', '08:30 AM', '08:30 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 3, '2017-09-26', '2017-09-25 06:08:06', '08:00 AM', '08:30 AM', 'daily', NULL, 'This is dummy123', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 3, '2017-10-24', '2017-10-24 05:44:33', '08:00 AM', '08:00 AM', 'weekly', NULL, 'This is dummy', '<p>thsi sissss</p>', NULL, NULL, NULL, NULL, NULL, NULL),
(48, 3, '2017-10-24', '2017-10-17 05:48:11', '08:00 AM', '08:00 AM', 'weekly', NULL, 'gfdgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 3, '2017-10-24', '2017-11-01 05:53:26', '08:00 AM', '07:30 AM', 'weekly', 'Y', 'sds', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 3, '2017-10-16', '2017-09-27 06:04:40', '08:30 AM', '08:00 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 3, '2017-10-31', '2017-09-25 06:05:58', '08:30 AM', '08:30 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 3, '2017-09-26', '2017-09-25 06:08:06', '08:00 AM', '08:30 AM', 'daily', NULL, 'This is dummy123', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 3, '2017-10-24', '2017-10-24 05:44:33', '08:00 AM', '08:00 AM', 'weekly', NULL, 'This is dummy', '<p>thsi sissss</p>', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 3, '2017-10-24', '2017-10-17 05:48:11', '08:00 AM', '08:00 AM', 'weekly', NULL, 'gfdgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 3, '2017-10-24', '2017-11-01 05:53:26', '08:00 AM', '07:30 AM', 'weekly', 'Y', 'sds', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 3, '2017-10-16', '2017-09-27 06:04:40', '08:30 AM', '08:00 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 3, '2017-10-31', '2017-09-25 06:05:58', '08:30 AM', '08:30 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 3, '2017-09-26', '2017-09-25 06:08:06', '08:00 AM', '08:30 AM', 'daily', NULL, 'This is dummy123', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 3, '2017-10-24', '2017-10-24 05:44:33', '08:00 AM', '08:00 AM', 'weekly', NULL, 'This is dummy', '<p>thsi sissss</p>', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 3, '2017-10-24', '2017-10-17 05:48:11', '08:00 AM', '08:00 AM', 'weekly', NULL, 'gfdgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 3, '2017-10-24', '2017-11-01 05:53:26', '08:00 AM', '07:30 AM', 'weekly', 'Y', 'sds', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 3, '2017-10-16', '2017-09-27 06:04:40', '08:30 AM', '08:00 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 3, '2017-10-31', '2017-09-25 06:05:58', '08:30 AM', '08:30 AM', 'daily', NULL, 'This is dummy', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 3, '2017-09-26', '2017-09-25 06:08:06', '08:00 AM', '08:30 AM', 'daily', NULL, 'This is dummy123', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_section_layouts`
--

CREATE TABLE `lesson_section_layouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `layout_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_lesson_sections` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(68, '2014_10_12_000000_create_users_table', 1),
(69, '2014_10_12_100000_create_password_resets_table', 1),
(70, '2017_04_11_103744_entrust_setup_tables', 1),
(71, '2017_04_18_111018_create_school_years_table', 1),
(72, '2017_04_20_081826_create_lesson_section_layouts_table', 1),
(73, '2017_04_20_103012_create_user_lesson_section_layouts_table', 1),
(74, '2017_04_20_123910_create_user_classes_table', 1),
(75, '2017_04_25_114426_create_class_schedules_table', 1),
(76, '2017_05_08_054502_create_class_lessons_table', 1),
(77, '2017_05_08_063915_create_units_table', 1),
(78, '2017_05_09_124329_create_myfiles_table', 1),
(79, '2017_05_10_060709_create_assignments_table', 1),
(80, '2017_05_10_094807_create_assessment_table', 1),
(81, '2017_06_15_051318_create_attachments_table', 2),
(82, '2017_07_25_103343_create_score_weightings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `myfiles`
--

CREATE TABLE `myfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_changeable_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploadSize` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `myfiles`
--

INSERT INTO `myfiles` (`id`, `user_id`, `file_name`, `file_changeable_name`, `uploadSize`, `created_at`, `updated_at`) VALUES
(27, 3, '1498027548-2Dt1oC-Lighthouse.jpg', 'Lighthouse.jpg', 548.12, '2017-06-21 01:15:48', '2017-06-21 01:15:48'),
(26, 3, '1498027496-hJ0nQD-Koala.jpg', 'Koala.jpg', 762.53, '2017-06-21 01:14:56', '2017-06-21 01:14:56'),
(25, 3, '1498027003-xFwFkx-6.2.jpg', '6.2.jpg', 2.79, '2017-06-21 01:06:43', '2017-06-21 01:06:43'),
(24, 3, '1498026995-b16NsY-3.1.jpg', '3.1.jpg', 3.99, '2017-06-21 01:06:35', '2017-06-21 01:06:35'),
(23, 3, '1498026975-f6dWfG-1.2.jpg', '1.2.jpg', 3.05, '2017-06-21 01:06:15', '2017-06-21 01:06:15'),
(28, 3, '1500873483-uU0mnw-Chrysanthemum.jpg', 'Chrysanthemum.jpg', 858.78, '2017-07-24 09:18:03', '2017-07-24 09:18:03'),
(29, 3, '1505986788-YA0UX1-Planbook.com  .png', 'Planbook.com  .png', 88.29, '2017-09-21 04:09:48', '2017-09-21 04:09:48'),
(30, 3, '1505986812-MPzrUP-Planbook.com   (2).png', 'Planbook.com   (2).png', 101.07, '2017-09-21 04:10:12', '2017-09-21 04:10:12'),
(31, 2, '1507097191-Do4bnd-Planbook.com   (2).png', 'Planbook.com   (2).png', 101.07, '2017-10-04 00:36:31', '2017-10-04 00:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `my_lists`
--

CREATE TABLE `my_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `list_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedyear` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_lists`
--

INSERT INTO `my_lists` (`id`, `user_id`, `list_id`, `description`, `addedyear`, `created_at`, `updated_at`) VALUES
(1, 3, '1', '<p>hey</p>', NULL, '2017-11-03 02:20:38', '2017-11-03 02:20:38'),
(2, 3, '2', '<p>hello here</p>', NULL, '2017-11-03 02:27:01', '2017-11-06 00:19:03'),
(3, 3, '3', '<p>hekkk</p>', NULL, '2017-11-03 04:01:39', '2017-11-03 04:01:39'),
(4, 3, '1', '<p>hey edit function running fine</p>', NULL, '2017-11-06 00:07:53', '2017-11-06 00:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `my_strategies`
--

CREATE TABLE `my_strategies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `strategies_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addedyear` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_strategies`
--

INSERT INTO `my_strategies` (`id`, `user_id`, `strategies_id`, `title`, `description`, `addedyear`, `created_at`, `updated_at`) VALUES
(2, 3, '1', 'First Data', '<p>Hey am working fine edit</p>', NULL, '2017-11-06 01:12:49', '2017-11-06 01:40:47'),
(3, 3, '12', 'Type', '<p>eererererere</p>', NULL, '2017-11-06 01:41:59', '2017-11-06 01:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'User Administrator', 'admin is allowed to manage all data', '2017-05-16 10:01:20', '2017-05-16 10:01:20'),
(2, 'teacher', 'teacher', 'teacher can access teacher permission', '2017-05-16 10:01:20', '2017-05-16 10:01:20'),
(3, 'student', 'student', 'student can access student permission', '2017-05-16 10:01:20', '2017-05-16 10:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 2),
(3, 2),
(4, 3),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `year_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_day` date DEFAULT NULL,
  `last_day` date DEFAULT NULL,
  `class_schedule_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_schedule` text COLLATE utf8mb4_unicode_ci,
  `cycle_days` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `user_id`, `year_name`, `first_day`, `last_day`, `class_schedule_type`, `class_schedule`, `cycle_days`, `created_at`, `updated_at`) VALUES
(1, 2, '2017', '2017-05-01', '2017-05-30', 'one_week', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":"","end_time":""}]', '2', '2017-05-16 10:08:11', '2017-05-16 10:08:11'),
(2, 3, '2017-2018', '2017-05-01', '2017-07-01', 'one_week', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":"","end_time":""}]', '2', '2017-05-26 00:05:45', '2017-05-26 00:05:45'),
(3, 5, '2017-2018', '2017-07-01', '2017-12-31', 'one_week', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":"","end_time":""}]', '2', '2017-07-14 10:30:53', '2017-07-14 10:30:53'),
(4, 7, '2017', '2017-08-01', '2016-02-12', 'two_week', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":"","end_time":""},{"text":"Sunday","name":"sundayCheck2","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck2","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck2","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck2","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck2","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck2","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck2","day_no":"7","is_class":"0","start_time":"","end_time":""}]', '2', '2017-07-28 15:04:05', '2017-07-28 15:04:05'),
(5, 8, '2017-2018', '2017-07-01', '2022-02-28', 'one_week', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":"","end_time":""}]', '5', '2017-07-29 10:06:42', '2017-07-29 10:06:42'),
(6, 9, '2017-2018', '2017-08-01', '2017-09-09', 'one_week', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":"","end_time":""}]', '2', '2017-08-30 13:19:10', '2017-08-30 13:19:10'),
(7, 1, '2016-2017', '2017-08-28', '2018-01-01', 'one_week', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"","end_time":""},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"","end_time":""},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"","end_time":""},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"","end_time":""},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"","end_time":""},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"","end_time":""},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":"","end_time":""}]', '2', '2017-09-26 02:27:53', '2017-09-26 02:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `score_weightings`
--

CREATE TABLE `score_weightings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `assessment_data` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentID` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentID`, `teacher_id`, `class_id`, `name`, `first_name`, `middle_name`, `last_name`, `grade_level`, `email`, `parent_email`, `phone_number`, `birthdate`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, '13', 3, 0, 'Narender', NULL, 'Kumar', 'Arnote', '12', 'narender@techsparksit.com', 'parent@gmail.com', '9876543210', '13/04/2014', '$2y$10$UlGumTZsVaimu56w7BsIDuXNdXlLY.LbGAYglSgsMXUzV5kKxnx.C', NULL, '2017-10-24 00:33:11', '2017-10-24 00:33:11'),
(7, '143', 3, 0, 'jonny', NULL, 'kumar', 'insaan', '4', 'jonny@techsparksit.com', 'sandeep@gmail.com', '9876543210', '15/10/2014', '$2y$10$G2m1bk5CaifX9LlqN0vy8.AJFu0gA/mUECWwmO6yZIKBBtE6KGEO6', NULL, '2017-10-24 04:25:07', '2017-10-24 04:25:07'),
(8, '12', 3, 0, 'jonny', NULL, 'kumar', 'insaan', '4', 'jonny123@techsparksit.com', 'sandeep@gmail.com', '9876543210', '15/10/2014', '$2y$10$dH/IvspssM4G4bLAv3qf7eNPse29RT3gj0kvvqt.y5ykFireG8H46', NULL, '2017-10-24 04:25:54', '2017-10-24 04:25:54'),
(9, '12', 3, 0, 'jitendar', NULL, 'kumar', 'sharma', '2', 'jitu@gmail.com', 'pitu@gmail.com', '9876543210', '12/01/2000', '$2y$10$3hhSHyzxBzyJT8a2P7ut6.0QK0E8PUw5wr95m8uykGTVfcp4NFKqG', NULL, '2017-10-30 04:20:57', '2017-10-30 04:20:57'),
(10, '10', 3, 0, 'vari', NULL, 'ju', 'singh', '3', 'vari@gmail.com', 'bari@gmail.com', '9876543210', '10/10/2012', '$2y$10$FHHM5eaDRDYrxg5fc0wYI..v4r.WmV2.rqFe9FjXt.1PPUaHa.6ge', NULL, '2017-10-30 04:26:45', '2017-10-30 04:26:45'),
(11, '15', 3, 0, 'Ritesh', NULL, 'Kumar', 'Deshmukh', '3', 'ritesh@gmail.com', 'pitesh@gmail.com', '9876543210', '13/04/2014', '$2y$10$mcszsr.Rxqcrm3DUTTbJAe1TasM8QuJ0htz3xKFDXl2T0Z9vYG5Oi', NULL, '2017-11-06 02:42:52', '2017-11-06 02:42:52'),
(12, '54', 3, 0, 'abcdef', NULL, 'fsdaf', 'afsdafs', '3', 'sfsa@acb.com', 'sfsa@acb.com', '9876543210', '12/04/2014', '$2y$10$bX6oMH5gahPYVeFDWur3ze206LWkMwRaawHC997ZQXPwY2R4Z.NcS', NULL, '2017-11-06 02:47:01', '2017-11-06 05:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `starts_on` date DEFAULT NULL,
  `ends_on` date DEFAULT NULL,
  `unit_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `user_id`, `class_id`, `starts_on`, `ends_on`, `unit_id`, `unit_title`, `unit_description`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2017-05-01', '2017-05-31', '1313', 'Test unit for english class', 'Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description Unit Detail Description', '2017-05-16 11:01:59', '2017-05-16 11:01:59'),
(2, 2, 2, '2017-05-01', '2017-05-31', '1212', 'Test unit For maths class', 'Test unit Description Test unit Description Test unit Description Test unit Description Test unit Description Test unit Description Test unit Description Test unit Description', '2017-05-16 11:02:53', '2017-05-16 11:02:53'),
(3, 3, 7, '2017-06-01', '2017-06-28', '12', 'Networking', 'this is demo', '2017-06-05 01:09:00', '2017-06-05 01:09:00'),
(4, 3, 7, '2017-06-01', '2017-06-30', '12', 'Algebra', 'This is for demo', '2017-06-05 05:20:17', '2017-07-27 09:59:22'),
(5, 3, 9, '2017-06-01', '2017-06-30', '09', 'Optics', 'This is demo', '2017-06-05 05:20:50', '2017-06-05 05:20:50'),
(6, 3, 10, '2017-06-01', '2017-06-30', '36', 'Relation', 'This is demo', '2017-06-05 05:21:24', '2017-06-05 05:21:24'),
(7, 3, 14, '2017-07-18', '2017-07-28', '144502', 'Ssss', 'sfds', '2017-07-24 09:20:58', '2017-07-24 09:20:58'),
(8, 7, 17, '2017-08-01', '2017-07-08', '1', 'Biography of Alexander', 'sdfsdfdsfdsfdsfdsfdsfd', '2017-07-28 15:11:58', '2017-07-28 15:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotional_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_step_completed` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_selected_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `display_name`, `school_district`, `school_name`, `promotional_code`, `signup_step_completed`, `email`, `current_selected_year`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'narender', 'arnote', 'arnote', 'mandi', 'mandi', '1254', '5', 'admin@gmail.com', '7', '$2y$10$I8tgNXsk8oDEOQkxdpfTAeAKm2LNHYnw5xgB1OnGlbqeybS.YoYPy', 'GBC2G957rRwm7SiSBe6rOTYZ4eUpnly1BGc51wfVlsINTwaQMVPfiKXq4qBE', '2017-05-16 10:01:20', '2017-09-26 02:27:59'),
(2, 'Teacher', 'gurinder', 'singh', 'Mr Tester', 'mohali', 'sdfd', '12345', '5', 'teacher@gmail.com', '1', '$2y$10$SuHLaH/m1dL4K8dpZ0BCaO/byftDZLucKv5ookyFATVpFhhHwPu9u', 'mdRDhrJIBaVeqRXGTpiet08CaEKC1f4d4woiQQm5Zzo4qyKD3THhZOSM2YRf', '2017-05-16 10:01:20', '2017-05-16 10:08:28'),
(3, 'Narender', 'narender', 'arnote', 'narender', 'Sholinganallur', 'Hunami', '1458', '5', 'narender@techsparksit.com', '2', '$2y$10$4cLYKkNV5HGbZwpLAK0SzejLmyHo3vK80TBZ6A8eW2grrX4s9p1bm', 'odGNCbaR8liemGgpb351aaYKl7VFpKM9ZYFeQH2ZYHahvrNT0PkHtabXqLUr', '2017-05-16 10:01:21', '2017-05-26 00:06:15'),
(4, 'Student', NULL, NULL, NULL, NULL, NULL, NULL, '0', 'student@gmail.com', NULL, '$2y$10$dM7UFZs3jsubkg6TNxsxC.1dPuibMal7xJJ31LiMDmKypGu14DFxK', 'sMlW7OweRvwFOH4xuhcvQnFr3ynDM61RvfcSRVy1mGDj1IlQkZ6MUwXh7Tov', '2017-05-16 10:01:21', '2017-05-16 10:01:21'),
(5, NULL, 'Baylee', 'Selby', 'mr Baylee', 'Baylee', 'Baylee', '432567', '5', 'admin@admin.com', '3', '$2y$10$D8.jGY3344A1XZWGPpn34ex8jfIZKyMWrKZcFrjX0Qq0Wtr3dZorm', 'zM9fxft0o1G4EKCp7dc9WzuReRI0DGYZxlPyJyxacnsPlu3BRZ4lg3JfEQBg', '2017-07-14 10:30:04', '2017-07-14 10:31:17'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'jitender@techsparksit.com', NULL, '$2y$10$KzaQguRm0a2XaQwOhCm.GeauOSqIkAUg4w2cqCQ/RmkUay3Gkactu', NULL, '2017-07-18 16:10:17', '2017-07-18 16:10:17'),
(7, NULL, 'Rinkesh', 'Thakur', 'Rinkesh', 'gss punjab', 'A.B.V.M', '123', '5', 'rinkesh@techsparksit.com', '4', '$2y$10$6TR87CT.06zu8So5Ox9vuOrwCUttLQI.S.P.SHu6/nFDFYm8zdSr6', NULL, '2017-07-28 15:00:43', '2017-07-28 15:04:41'),
(8, NULL, 'Josephine', 'Padilla', 'Epay', 'Santiago City, Isabela', 'xxx', 'xxx', '5', 'epay2595@yahoo.com', '5', '$2y$10$sDGiL.caiQrsTwLBgju5NucNK9DaGmwmv.8RoGv8/Nim8phgZik7u', '0TWNjH3vjXwCIR3FYoGOmaI1Q9vMJUFuAlp1mLWP4MIrUWCn3SKTqOSkuZGw', '2017-07-29 10:05:39', '2017-07-29 10:07:27'),
(9, NULL, 'Rachel', 'Reed', 'mr', 'frr', 'rtrt', '343', '5', 'tester@gmail.com', '6', '$2y$10$OQ2Q8gKY7X1IOJVgV9ETqeSVAhFXFU2YUCdioP38Vg.kv8FHNYLdm', 'xCNxfiJMLfQB7NB0ogE92Wo1YMMeV8CqJ2eeu8NAM5GYpYD7GTXoqHvSLhhd', '2017-08-30 13:18:29', '2017-08-30 13:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_classes`
--

CREATE TABLE `user_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `class_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collaborate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_schedule` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_classes`
--

INSERT INTO `user_classes` (`id`, `user_id`, `year_id`, `class_name`, `start_date`, `start_time`, `end_date`, `end_time`, `class_color`, `collaborate`, `class_schedule`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'English', '2017-05-01', NULL, '2017-05-30', NULL, '#008000', NULL, '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-16 10:08:26', '2017-05-16 10:08:26'),
(2, 2, 1, 'Maths', '2017-05-16', NULL, '2017-05-24', NULL, '#4745ce', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-16 10:10:56', '2017-05-16 10:19:05'),
(3, 2, 1, 'science', '2017-05-18', NULL, '2017-05-30', NULL, '#df2f4f', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-16 10:20:41', '2017-05-16 10:20:41'),
(4, 2, 1, 'Science', '2017-05-01', NULL, '2017-05-30', NULL, '#008000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"08:00 AM","end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"08:00 AM","end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"09:30 AM","end_time":"09:30 AM"},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-22 18:03:14', '2017-05-22 18:03:14'),
(5, 2, 1, 'Science', '2017-05-01', NULL, '2017-05-30', NULL, '#008000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"08:00 AM","end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"08:00 AM","end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"09:30 AM","end_time":"09:30 AM"},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-22 18:03:15', '2017-05-22 18:03:15'),
(6, 2, 1, 'Science', '2017-05-01', NULL, '2017-05-30', NULL, '#008000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":"08:00 AM","end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"08:00 AM","end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"09:30 AM","end_time":"09:30 AM"},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-22 18:03:15', '2017-05-22 18:03:15'),
(7, 3, 2, 'Mathematics', '2017-07-01', NULL, '2017-08-01', NULL, '#008000', '2', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"08:00 AM","end_time":"09:00 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"08:30 AM","end_time":"09:00 AM"},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"09:00 AM","end_time":"10:00 AM"},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"09:00 AM","end_time":"10:00 AM"},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"10:00 AM","end_time":"11:00 AM"},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-26 00:06:15', '2017-09-07 09:08:57'),
(9, 3, 2, 'Language Arts', '2017-07-01', NULL, '2017-09-01', NULL, '#0000a0', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"0","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-26 23:32:44', '2017-07-05 17:28:12'),
(10, 3, 2, 'Physics', '2017-07-01', NULL, '2017-10-18', NULL, '#00ffff', '4', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"0","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"0","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-05-31 05:58:48', '2017-08-17 07:50:28'),
(11, 3, 2, 'Reading', '2017-05-01', NULL, '2017-07-01', NULL, '#408080', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"07:30 AM","end_time":"08:00 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"0","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"08:30 AM","end_time":"09:00 AM"},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"09:30 AM","end_time":"10:00 AM"},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-06-07 23:43:05', '2017-07-05 17:29:46'),
(12, 5, 3, 'english', '2017-07-01', NULL, '2017-12-31', NULL, '#ff80ff', NULL, '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"0","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"0","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-07-14 10:31:16', '2017-07-14 10:44:59'),
(13, 5, 3, 'maths', '2017-07-01', NULL, '2017-12-31', NULL, '#008000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"0","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"0","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-07-14 10:44:40', '2017-07-14 10:44:40'),
(14, 3, 2, 'Chemistry', '2017-05-01', NULL, '2017-07-01', NULL, '#344b48', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-07-24 09:16:49', '2017-07-24 09:16:49'),
(15, 3, 2, 'Arts', '2017-05-01', NULL, '2017-07-01', NULL, '#1d057a', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"07:30 AM","end_time":"09:30 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"0","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"0","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"0","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-07-28 09:30:54', '2017-07-28 09:30:54'),
(16, 7, 4, 'HINDI', '2017-08-01', NULL, '2016-02-12', NULL, '#400000', NULL, '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"1","start_time":null,"end_time":null},{"text":"Sunday","name":"sundayCheck2","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck2","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck2","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck2","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck2","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck2","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck2","day_no":"7","is_class":"1","start_time":null,"end_time":null}]', '2017-07-28 15:04:40', '2017-07-28 15:04:40'),
(17, 7, 4, '11th standard', '2017-08-01', NULL, '2016-02-12', NULL, '#008000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null},{"text":"Sunday","name":"sundayCheck2","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck2","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck2","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck2","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck2","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck2","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck2","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-07-28 15:09:59', '2017-07-28 15:09:59'),
(18, 8, 5, 'Math', '2017-07-01', NULL, '2022-02-28', NULL, '#008000', NULL, '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-07-29 10:07:26', '2017-07-29 10:07:26'),
(19, 3, 2, 'science', '2017-05-01', NULL, '2017-07-01', NULL, '#ff0000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"07:30 AM","end_time":"08:00 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"07:30 AM","end_time":"08:00 AM"},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"07:30 AM","end_time":"08:00 AM"},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"07:30 AM","end_time":"08:00 AM"},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"07:30 AM","end_time":"08:00 AM"},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-08-01 12:08:57', '2017-08-01 12:08:57'),
(20, 3, 2, 'science', '2017-08-01', NULL, '2017-08-10', NULL, '#ff0000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"07:30 AM","end_time":"08:30 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"08:30 AM","end_time":"09:00 AM"},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"09:30 AM","end_time":"10:00 AM"},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"09:30 AM","end_time":"10:00 AM"},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"09:30 AM","end_time":"10:00 AM"},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-08-01 12:09:58', '2017-08-01 12:09:58'),
(21, 3, 2, 'science', '2017-08-01', NULL, '2017-08-10', NULL, '#ff0000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"07:30 AM","end_time":"08:30 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":"08:30 AM","end_time":"09:00 AM"},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"09:30 AM","end_time":"10:00 AM"},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":"09:30 AM","end_time":"10:00 AM"},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"09:30 AM","end_time":"10:00 AM"},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-08-01 12:09:59', '2017-08-01 12:09:59'),
(22, 3, 2, 'History', '2017-05-26', NULL, '2017-07-01', NULL, '#000040', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"07:30 AM","end_time":"09:30 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"0","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":"07:30 AM","end_time":"09:30 AM"},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"07:30 AM","end_time":"08:30 AM"},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-08-17 07:44:59', '2017-08-17 07:44:59'),
(23, 9, 6, 'test', '2017-08-01', NULL, '2017-09-09', NULL, '#008000', NULL, '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-08-30 13:19:33', '2017-08-30 13:19:33'),
(24, 9, 6, 'wedw', '2017-08-01', NULL, '2017-09-09', NULL, '#008000', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"08:30 AM","end_time":"08:30 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-08-30 13:20:20', '2017-08-30 13:20:20'),
(25, 1, 7, 'maths', '2017-08-28', NULL, '2018-01-01', NULL, '#008000', NULL, '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":null,"end_time":null},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"1","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"1","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"1","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":null,"end_time":null},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-09-26 02:27:59', '2017-09-26 02:27:59'),
(26, 3, 2, 'Demo', '2017-11-01', NULL, '2017-12-07', NULL, '#384338', '1', '[{"text":"Sunday","name":"sundayCheck","day_no":"1","is_class":"0","start_time":null,"end_time":null},{"text":"Monday","name":"mondayCheck","day_no":"2","is_class":"1","start_time":"08:00 AM","end_time":"08:30 AM"},{"text":"Tuesday","name":"tuesdayCheck","day_no":"3","is_class":"0","start_time":null,"end_time":null},{"text":"Wednesday","name":"wednesdayCheck","day_no":"4","is_class":"0","start_time":null,"end_time":null},{"text":"Thursday","name":"thursdayCheck","day_no":"5","is_class":"0","start_time":null,"end_time":null},{"text":"Friday","name":"fridayCheck","day_no":"6","is_class":"1","start_time":"09:30 AM","end_time":"09:30 AM"},{"text":"Saturday","name":"saturdayCheck","day_no":"7","is_class":"0","start_time":null,"end_time":null}]', '2017-11-03 02:25:27', '2017-11-03 02:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_lesson_section_layouts`
--

CREATE TABLE `user_lesson_section_layouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `layout_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson_sections` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_lesson_section_layouts`
--

INSERT INTO `user_lesson_section_layouts` (`id`, `user_id`, `layout_name`, `lesson_sections`, `created_at`, `updated_at`) VALUES
(1, 2, 'basic', '[{"section_name":"Lesson","section_type":"Text 1","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}},{"section_name":"Homework","section_type":"Text 2","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}}]', '2017-05-16 10:08:15', '2017-05-16 10:08:15'),
(2, 3, 'basic', '[{"section_name":"Lesson","section_type":"Text 1","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}},{"section_name":"Homework","section_type":"Text 2","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}}]', '2017-05-26 00:05:49', '2017-05-26 00:05:49'),
(3, 5, 'instructional', '[{"section_name":"Lesson","section_type":"Text 1","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}},{"section_name":"Homework","section_type":"Text 2","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}}]', '2017-07-14 10:30:58', '2017-07-14 10:30:58'),
(4, 7, 'basic', '[{"section_name":"Lesson","section_type":"Text 1","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}},{"section_name":"Homework","section_type":"Text 2","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}}]', '2017-07-28 15:04:09', '2017-07-28 15:04:09'),
(5, 8, 'detailed', '[{"section_name":"Lesson","section_type":"Text 1","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}},{"section_name":"Homework","section_type":"Text 2","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}}]', '2017-07-29 10:07:17', '2017-07-29 10:07:17'),
(6, 9, 'basic', '[{"section_name":"Lesson","section_type":"Text 1","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}},{"section_name":"Homework","section_type":"Text 2","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}}]', '2017-08-30 13:19:15', '2017-08-30 13:19:15'),
(7, 1, 'detailed', '[{"section_name":"Lesson","section_type":"Text 1","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}},{"section_name":"Homework","section_type":"Text 2","section_enable":1,"format":{"title_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"},"body_format":{"font":"Arial","font_size":"11pt","font_bold":1,"font_italic":1,"font_underline":1,"text_color":"#000000","text_fill":"#FFFFFF"}}}]', '2017-09-26 02:27:55', '2017-09-26 02:27:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_assigned`
--
ALTER TABLE `class_assigned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `class_lessons`
--
ALTER TABLE `class_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_schedules`
--
ALTER TABLE `class_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_section_layouts`
--
ALTER TABLE `lesson_section_layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myfiles`
--
ALTER TABLE `myfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_lists`
--
ALTER TABLE `my_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_strategies`
--
ALTER TABLE `my_strategies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score_weightings`
--
ALTER TABLE `score_weightings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_classes`
--
ALTER TABLE `user_classes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_assigned`
--
ALTER TABLE `class_assigned`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `my_lists`
--
ALTER TABLE `my_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `my_strategies`
--
ALTER TABLE `my_strategies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_classes`
--
ALTER TABLE `user_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
