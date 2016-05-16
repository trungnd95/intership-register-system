-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2016 at 04:58 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `regis_internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$rdvbUGy0efD09v5DRuj.CuNJVDMIws/kR1qdw..WYY1x8ZszG8J/.', 'admin@gmail.com', '3wSamMWk7HWukUK8UUzCQPxTDUxownUMk6qmWl1RtYij3HNedIhoGr46C6xm', NULL, '2016-04-14 20:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `admin_configurations`
--

CREATE TABLE IF NOT EXISTS `admin_configurations` (
  `id` int(10) unsigned NOT NULL,
  `time_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_register` int(11) NOT NULL,
  `send_notify_student` tinyint(1) NOT NULL,
  `send_notify_teacher` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_configurations`
--

INSERT INTO `admin_configurations` (`id`, `time_start`, `time_end`, `max_register`, `send_notify_student`, `send_notify_teacher`, `created_at`, `updated_at`) VALUES
(1, '05/20/2016 12:00 AM', '05/30/2016 12:00 AM', 5, 0, 0, '2016-05-11 16:16:46', '2016-05-12 02:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `avatar_src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('student','teacher') COLLATE utf8_unicode_ci NOT NULL,
  `report_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `comment`, `avatar_src`, `role`, `report_id`, `created_at`, `updated_at`) VALUES
(1, 'trungnd', 'đhgfh', 'http://internship.dev/public/public/upload/images/students/581928_1670129466594140_8209382342078513355_n.jpg', 'student', 1, '2016-05-13 03:16:05', '2016-05-13 03:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `recruitment_amount` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `services` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `contact`, `recruitment_amount`, `description`, `services`, `created_at`, `updated_at`) VALUES
(1, 'Fsof', 'Toa nha Fsof ,Duy Tan, Cau Giay , Ha Noi', 'hr@fsorf.com.vn', 10, 'Fsoft la 1 cong ty phan m?m  s? 1 vi?t nam .M?ng ch', 'Web app ', '2016-04-12 20:46:34', '2016-04-12 20:46:34'),
(2, 'Framgia', 'Toa nha KangNam, Pham HUng,Ha Noi', 'hr@framgia.com.vn', 20, 'Framgia la 1 cong ty co 100% von dau tu cua nhat ban', 'Web app với ruby on rails', '2016-04-12 23:56:06', '2016-04-12 23:56:06'),
(3, 'Savycom', 'Duy Tan, Cau Giay , Ha Noi', 'hr@savvycom.com.vn', 5, 'Savycom la 1 cong ty tre moi thanh lap nhung da khang dinh duoc vi the cua minh', 'NodeJs', '2016-04-13 10:52:30', '2016-04-13 10:52:30'),
(4, 'Viettel', 'Tay Ho, Ha Noi', 'hr@viettel.com.vn', 50, 'Tap doan vien thong quan doi Viettel', 'Công nghệ nhúng vs Java', '2016-04-13 13:04:34', '2016-04-13 13:04:34'),
(6, 'ViétSofware', '<p>Tầng 6, t&ograve;a nh&agrave; Toyota, 15 Phamhj H&ugrave;ng , từ li&ecirc;m, H&agrave; Nội</p>\r\n', '<p>MsXuaan/Ms, L&yacute; chuy&ecirc;n vi&ecirc;n ph&ograve;ng nh&acirc;n sự</p>\r\n', 45, 'Tuyển 15 thực tập sinh Java\r\nTuyển 15 thực tập sinh php \r\n..........', '<p>Web application với php, java, .NET</p>\r\n\r\n<p>Ph&acirc;n t&iacute;ch hệ thống database</p>\r\n\r\n<p>Quản trị mạng</p>\r\n', '2016-04-21 09:40:09', '2016-04-21 10:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE IF NOT EXISTS `cvs` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personal_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_selfintro` text COLLATE utf8_unicode_ci NOT NULL,
  `education` longtext COLLATE utf8_unicode_ci NOT NULL,
  `skills` longtext COLLATE utf8_unicode_ci NOT NULL,
  `technical` text COLLATE utf8_unicode_ci NOT NULL,
  `experiences` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hobbies` longtext COLLATE utf8_unicode_ci NOT NULL,
  `others` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cvs`
--

INSERT INTO `cvs` (`id`, `name`, `image`, `student_code`, `class`, `phone_number`, `email`, `email1`, `address`, `personal_website`, `short_selfintro`, `education`, `skills`, `technical`, `experiences`, `hobbies`, `others`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'fdffdfd12345', '1970599_698535993546934_2775003922343183766_n.jpg', '13020461', 'QH2013I/CQ', '0974555629', 'abc@vnu.edu.vn', 'abcd@gmail.com', 'Thai Binh', '', '<p>fdfdfdfdfdfdfdfdfd</p>\r\n', '2013-2017\r\nĐại học Công nghệ - Đại học Quốc Gia Hà Nội\r\n', '<p>gagfagas</p>\r\n', '<p>gdgadfgdghd</p>\r\n', '<p>gdgd</p>\r\n', '<p>gdgdg</p>\r\n', '', 12, '2016-04-10 11:09:18', '2016-05-13 01:35:59'),
(7, 'Trung Manucian', '5c669d9af291d880d2f5e598247b0759.jpg', '12020462', 'QH2013ICQ', '09755555555', 'trung@vnu.edu.vn', '', 'thái bình', '', '<p>fafafasfasfasfasfasfasf</p>\r\n', '<p>fafafasfasfasfasfasfasf</p>\r\n', '<p>fafafasfasfasfasfasfasf</p>\r\n', '<p>fafafasfasfasfasfasfasf</p>\r\n', '<p>fafafasfasfasfasfasfasf</p>\r\n', '<p>fafafasfasfasfasfasfasf</p>\r\n', '<p>fafafasfasfasfasfasfasf</p>\r\n', 34, '2016-05-07 10:16:30', '2016-05-07 10:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(10) unsigned NOT NULL,
  `guest_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reply_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `guest_name`, `email`, `content`, `reply_status`, `created_at`, `updated_at`) VALUES
(1, '', 'ndt8895@gmail.com', 'Hệ thống cần hoàn thiện thêm về giao diện trải nghiệm người dùng ...', 0, '2016-05-06 06:37:40', '2016-05-06 21:08:17'),
(5, '', 'abc@vnu.edu.vn', 'ffljkljaklfjdaskfljdlfkkjdasfkklfj', 0, '2016-05-06 21:15:28', '2016-05-06 21:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE IF NOT EXISTS `infos` (
  `id` int(10) unsigned NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE IF NOT EXISTS `instructions` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2016_03_27_032927_create_teachers_table', 1),
('2016_03_27_032930_create_users_table', 2),
('2016_03_27_033003_create_admins_table', 2),
('2016_03_27_033129_create_instructions_table', 2),
('2016_03_27_033457_create_infos_tables', 2),
('2016_03_27_033604_create_slides_table', 2),
('2016_03_27_033749_create_feedbacks_table', 2),
('2016_03_27_033920_create_companies_table', 2),
('2016_03_27_034238_create_topics_table', 3),
('2016_03_27_034510_create_schoolyears_table', 3),
('2016_03_27_034520_create_news_table', 4),
('2016_03_27_034743_create_statuses_table', 5),
('2016_03_27_034840_create_reports_table', 5),
('2016_03_27_034929_create_comments_table', 5),
('2016_03_27_035812_create_cvs_table', 5),
('2016_04_06_064442_create_notify_teacher_acceptances_table', 6),
('2016_04_23_160509_create_notification_admins_table', 7),
('2016_05_04_153507_create_student_notifications_table', 8),
('2016_05_05_094322_create_teacher_notifications_table', 9),
('2016_05_06_061516_create_partners_table', 10),
('2016_05_11_034059_create_register_times_table', 11),
('2016_05_11_081136_create_admin_configurations_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `short_des` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schoolyear_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `short_des`, `slug`, `schoolyear_id`, `created_at`, `updated_at`) VALUES
(2, 'Ngày hội việc làm công nghệ', 'Ngày hội diễn ra vào thứ 7 với sự tham gia góp mặt của rất nhiều công ty lớn nhỏ\r\nKhoa yêu cầu sinh viên k58 có mặt đầy đủ, vì đây là cơ hội để sinh viên có thể thực tập tại các công ty', 'Ngày hội diễn ra vào thứ 7 với sự tham gia góp mặt của rất nhiều công ty lớn nhỏ', 'ngay-hoi-viec-lam-cong-nghe', 1, '2016-04-02 04:21:10', NULL),
(9, 'Công ty AI tuyển dụng', '<p style="text-align:justify">C&ocirc;ng ty TNHH AI Việt Nam được th&agrave;nh lập ng&agrave;y 24/10/2003 với mục ti&ecirc;u trở th&agrave;nh&nbsp;<img alt="AI" class="alignright wp-image-2998" src="http://fit.uet.vnu.edu.vn/wp-content/uploads/2016/04/AI.png" style="display:inline; float:right; height:auto; margin-bottom:1.625em; margin-left:30px; max-width:100%; vertical-align:top; width:109px" />Doanh nghiệp h&agrave;ng đầu về Lĩnh vực C&ocirc;ng nghệ th&ocirc;ng tin (CNTT) v&agrave; truyền th&ocirc;ng, cung cấp c&aacute;c dịch vụ tư vấn mang t&iacute;nh chiến lược, c&aacute;c sản phẩm, giải ph&aacute;p ứng dụng CNTT cho c&aacute;c bộ, ng&agrave;nh, địa phương v&agrave; doanh nghiệp, tổ chức c&oacute; nhu cầu.</p>\r\n\r\n<p style="text-align:justify">C&ocirc;ng ty đang c&oacute; nhu cầu tuyển dụng lập tr&igrave;nh vi&ecirc;n. Th&ocirc;ng tin chi tiết như sau.</p>\r\n\r\n<p style="text-align:justify">C&ocirc;ng ty TNHH AI Việt Nam được th&agrave;nh lập ng&agrave;y 24/10/2003 với mục ti&ecirc;u trở th&agrave;nh&nbsp;<img alt="AI" class="alignright wp-image-2998" src="http://fit.uet.vnu.edu.vn/wp-content/uploads/2016/04/AI.png" style="display:inline; float:right; height:auto; margin-bottom:1.625em; margin-left:30px; max-width:100%; vertical-align:top; width:109px" />Doanh nghiệp h&agrave;ng đầu về Lĩnh vực C&ocirc;ng nghệ th&ocirc;ng tin (CNTT) v&agrave; truyền th&ocirc;ng, cung cấp c&aacute;c dịch vụ tư vấn mang t&iacute;nh chiến lược, c&aacute;c sản phẩm, giải ph&aacute;p ứng dụng CNTT cho c&aacute;c bộ, ng&agrave;nh, địa phương v&agrave; doanh nghiệp, tổ chức c&oacute; nhu cầu.</p>\r\n\r\n<p style="text-align:justify">C&ocirc;ng ty đang c&oacute; nhu cầu tuyển dụng lập tr&igrave;nh vi&ecirc;n. Th&ocirc;ng tin chi tiết như sau.</p>\r\n', '<p style="text-align:justify">C&ocirc;ng ty TNHH AI Việt Nam được th&agrave;nh lập ng&agrave;y 24/10/2003 với mục ti&ecirc;u trở th&agrave;nh&nbsp;<img alt="AI" class="alignright wp-image-2998" src="http://fit.uet.vnu.edu.vn/wp-content/uploads/2016/04/AI.png" style="display:inline; float:right; height:auto; margin-bottom:1.625em; margin-left:30px; max-width:100%; vertical-align:top; width:109px" />Doanh nghiệp h&agrave;ng đầu về Lĩnh vực C&ocirc;ng nghệ th&ocirc;ng tin (CNTT) v&agrave; truyền th&ocirc;ng, cung cấp c&aacute;c dịch vụ tư vấn mang t&iacute;nh chiến lược, c&aacute;c sản phẩm, giải ph&aacute;p ứng dụng CNTT cho c&aacute;c bộ, ng&agrave;nh, địa phương v&agrave; doanh nghiệp, tổ chức c&oacute; nhu cầu</p>\r\n', 'cong-ty-ai-tuyen-dung', 1, '2016-04-21 06:04:15', '2016-04-21 06:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `notification_admins`
--

CREATE TABLE IF NOT EXISTS `notification_admins` (
  `id` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notify_teacher_acceptances`
--

CREATE TABLE IF NOT EXISTS `notify_teacher_acceptances` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `teacher_id` int(10) unsigned NOT NULL,
  `acceptance` enum('pending','success','failure') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `image`, `link`, `created_at`, `updated_at`) VALUES
(6, '/public/upload/images/ckfinder/images/partners/microsoft1%20(1).png', '', '2016-05-12 03:04:57', '2016-05-12 03:04:57'),
(7, '/public/upload/images/ckfinder/images/partners/rikkeisoft.png', '', '2016-05-12 03:05:16', '2016-05-12 03:05:16'),
(8, '/public/upload/images/ckfinder/images/partners/Framgia2.png', '', '2016-05-12 03:05:53', '2016-05-12 03:05:53'),
(9, '/public/upload/images/ckfinder/images/partners/foobla.png', '', '2016-05-12 03:06:15', '2016-05-12 03:06:15'),
(10, '/public/upload/images/ckfinder/images/partners/Gameloft-logo.png', '', '2016-05-12 03:06:39', '2016-05-12 03:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('abc@vnu.edu.vn', '21860728778435637a8393727a91bcdbf00e5ffad2eb289fea7081682e25d5a9', '2016-04-02 21:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `register_times`
--

CREATE TABLE IF NOT EXISTS `register_times` (
  `id` int(10) unsigned NOT NULL,
  `time_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `register_times`
--

INSERT INTO `register_times` (`id`, `time_start`, `time_end`, `created_at`, `updated_at`) VALUES
(1, '05/15/2016 12:00 AM', '05/18/2016 12:00 AM', '2016-05-11 00:00:29', '2016-05-11 00:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `title`, `content`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Bao cao 1', '<p>Bao cao 1Bao cao 1Bao cao 1Bao cao 1Bao cao 1Bao cao 1Bao cao 1Bao cao 1Bao cao 1Bao cao 1Bao cao 1</p>\r\n', '2016-04-18 07:47:02', '2016-04-18 07:47:02', 12),
(2, 'Bao cao 2', '<p>&nbsp;bao cao 2</p>\r\n', '2016-04-18 08:06:55', '2016-04-18 08:06:55', 12),
(3, 'Báo cáo 3', '<p>B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3B&aacute;o c&aacute;o 3</p>\r\n', '2016-04-20 09:25:33', '2016-04-20 09:25:33', 12);

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE IF NOT EXISTS `schoolyears` (
  `id` int(10) unsigned NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schoolyears`
--

INSERT INTO `schoolyears` (`id`, `full_name`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 'QH2013ICQ', 'K58', NULL, NULL),
(2, 'QH2014/ICQ', 'K59', '2016-05-06 02:38:05', '2016-05-06 02:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `image`, `description`, `link`, `created_at`, `updated_at`) VALUES
(9, '/public/upload/images/ckfinder/images/Untitled1.png', 'uetmail.vnu.edu.vn', '', '2016-05-12 01:56:28', '2016-05-12 02:14:00'),
(10, '/public/upload/images/ckfinder/images/Untitled.png', 'vnu.edu.vn', '', '2016-05-12 01:58:49', '2016-05-12 02:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(100) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `contacted` tinyint(1) NOT NULL,
  `acceptance` enum('success','failure','pending') COLLATE utf8_unicode_ci NOT NULL,
  `choosen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `user_id`, `company_id`, `contacted`, `acceptance`, `choosen`, `created_at`, `updated_at`) VALUES
(135, 12, 1, 1, 'failure', 0, '2016-05-05 02:33:43', '2016-05-13 02:17:19'),
(138, 34, 1, 1, 'pending', 0, '2016-05-07 05:41:56', '2016-05-07 05:46:13'),
(139, 12, 4, 1, 'pending', 0, '2016-05-08 21:42:37', '2016-05-08 21:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_notifications`
--

CREATE TABLE IF NOT EXISTS `student_notifications` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_notifications`
--

INSERT INTO `student_notifications` (`id`, `user_id`, `message`, `seen`, `created_at`, `updated_at`) VALUES
(92, 5, 'Thông báo: Thầy Võ Đình Hiếu sẽ hướng dẫn bạn làm báo cáo trong đợt thực tập hè này. Thân!', 0, '2016-05-11 18:03:47', '2016-05-11 18:03:47'),
(93, 34, 'Thông báo: Thầy Võ Đình Hiếu sẽ hướng dẫn bạn làm báo cáo trong đợt thực tập hè này. Thân!', 0, '2016-05-11 18:03:48', '2016-05-11 18:03:48'),
(94, 34, 'Công ty Fsof không chấp nhận bạn vào thực tập tại công ty', 0, '2016-05-11 18:03:48', '2016-05-11 18:03:48'),
(100, 5, 'Thông báo: Thầy Võ Đình Hiếu sẽ hướng dẫn bạn làm báo cáo trong đợt thực tập hè này. Thân!', 0, '2016-05-11 18:04:38', '2016-05-11 18:04:38'),
(101, 34, 'Thông báo: Thầy Võ Đình Hiếu sẽ hướng dẫn bạn làm báo cáo trong đợt thực tập hè này. Thân!', 0, '2016-05-11 18:04:39', '2016-05-11 18:04:39'),
(102, 34, 'Công ty Fsof không chấp nhận bạn vào thực tập tại công ty', 0, '2016-05-11 18:04:39', '2016-05-11 18:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `degree` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `strong_point` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `email`, `password`, `full_name`, `degree`, `phone_number`, `avatar`, `strong_point`, `confirmed`, `confirmation_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Trung Nguyen 12', 'trung12@vnu.edu.vn', '$2y$10$nCm2Tj0JrwSk12fjNarhfOKHot0vTeDqTZGwbnueCNrjBT6tCtLB6', 'Nguyễn Đức Trung', 'Tiến sĩ', '0974555629', '1.jpg', 'Các ứng dụng web real time, các ứng dụng web app single one page, lập trình mạng socket .....', 1, '', 'k8fpUtR8nGypjtQbTIdvyqkKnpktcX9x859NIutBhG3WIVOOR4vFFhBTHM7u', '2016-04-03 03:41:42', '2016-05-13 02:17:43'),
(9, 'hieuvd', 'hieuvd1@vnu.edu.vn', '$2y$10$o.yR1hCGsCIZcfXBqx9DG.U3jSgX3mqk/w0h4ADBEqJBoJ98iID/u', 'Võ Đình Hiếu', '', '1462930078', '', '', 1, '', '', '2016-05-10 18:27:58', '2016-05-10 18:27:58'),
(10, 'abcde', 'abcde@vnu.edu.vn', '$2y$10$AdmkCI3cMhCyqRyvyd1stuo3SRQRHfYlVfoQvCA7hntgbBvHA13ga', 'Trung Manucian', '', '1463131087', '', '', 1, '', 'GDKjePNPPb4fMuSM7jkjxpzZ98DdUi8OeRZt7pazK7W2GQRMWd3HLK1RwEQI', '2016-05-13 02:18:07', '2016-05-13 02:21:55'),
(11, 'abcdef', 'abcdef@vnu.edu.vn', '$2y$10$8vkNhZ5fk9xeIvY6xJkjdObTTRrfGrmYv8OeAyslnpM/50fhs8DNS', 'ABCDEF', '', '1463131342', '', '', 0, 'UeAPWl1w', '', '2016-05-13 02:22:22', '2016-05-13 02:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_notifications`
--

CREATE TABLE IF NOT EXISTS `teacher_notifications` (
  `id` int(10) unsigned NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher_notifications`
--

INSERT INTO `teacher_notifications` (`id`, `teacher_id`, `user_id`, `message`, `seen`, `created_at`, `updated_at`) VALUES
(30, 4, 12, 'Thầy/cô được phân công phụ trách hướng dẫn sinh viên <a href="http://internship.dev/giang-vien/xem/sinh-vien/12/cv" style="color:#01a4e1" target="_blank">Nguyễn Trung trong đợt thực tập hè này', 1, '2016-05-10 19:21:01', '2016-05-10 19:24:11'),
(31, 9, 12, 'Thầy/cô được phân công phụ trách hướng dẫn sinh viên <a href="http://internship.dev/giang-vien/xem/sinh-vien/12/cv" style="color:#01a4e1" target="_blank">Nguyễn Trung trong đợt thực tập hè này', 0, '2016-05-10 19:21:49', '2016-05-10 19:21:49'),
(32, 4, 12, 'Thầy/cô được phân công phụ trách hướng dẫn sinh viên <a href="http://internship.dev/giang-vien/xem/sinh-vien/12/cv" style="color:#01a4e1" target="_blank">Nguyễn Trung</a> trong đợt thực tập hè này', 1, '2016-05-10 19:25:42', '2016-05-10 19:38:02'),
(33, 9, 12, 'Thầy/cô được phân công phụ trách hướng dẫn sinh viên <a href="http://internship.dev/giang-vien/xem/sinh-vien/12/cv" style="color:#01a4e1" target="_blank">Nguyễn Trung</a> trong đợt thực tập hè này', 0, '2016-05-11 00:19:16', '2016-05-11 00:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_des` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `short_des`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'fhfhfhf', 'fgfhjgjjkjgjjkk', 12, '2016-04-14 21:23:39', '2016-04-14 21:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_code` int(11) NOT NULL,
  `class_name` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `birth_day` date NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_acceptance` enum('','pending','accepted','ignore') COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `full_name`, `email`, `password`, `student_code`, `class_name`, `birth_day`, `phone_number`, `avatar`, `confirmed`, `confirmation_code`, `teacher_acceptance`, `teacher_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'trungnd1', 'ABCDEF', 'trungnd_581@vnu.edu.vn', '$2y$10$oLyZi9U6U.AdFIZ3wikdp.DCpmjsXKOB3bbu90FufQl.pIN2cRA1C', 54311, 'K58CD', '0000-00-00', '0974555629', '', 1, 'IfNBHtM7Dx', 'accepted', 9, 'cdKBsSVWmNrbMaRSfPal9WIJPjwYcuoaMynEtDj1WI6CtDNGuuRvcWEvdnt9', '2016-04-02 04:24:35', '2016-05-10 19:04:12'),
(12, 'trungnd', 'Nguyễn Trung', 'abc@vnu.edu.vn', '$2y$10$BvAPOy.1uz5wi5Dd3rThA.IJQB/rxrsfqxRSIAevGS2pAf91n9A4e', 13020461, 'K58cd', '1994-09-08', '0974555629', '581928_1670129466594140_8209382342078513355_n.jpg', 1, 'EAJ1ikbUPC', 'ignore', 4, 'IldJgbj0pwc0WSYZuNsV6dPXi9ZzmizpiSB3ynQb9M6LAry63XpOJ452PEJa', '2016-04-02 04:49:46', '2016-05-13 07:57:07'),
(34, 'trungnd12', '', 'trung@vnu.edu.vn', '$2y$10$LFVMFfJF/kHl8Fyz7lQcuuV6u6IdlubSmlyprPaMsVMmq/PCNVJ0C', 1462624632, '', '0000-00-00', '1462624633', '', 1, '', '', 9, NULL, '2016-05-07 05:37:12', '2016-05-10 19:04:27'),
(51, 'trungnd95', '', 'trungnd_58@vnu.edu.vn', '$2y$10$PnEMnVdidbYFC9c258wFsOdvWBZ0ialPDzywGofYr1w69w351yxRu', 1463033223, '', '0000-00-00', '1463033224', '', 1, '', '', 10, 'fyhzMSBRgsQO1CpxTmleQiv5xzVFLD8eAr2YqVm02F1GMqxs7SZgsJMB3zWO', '2016-05-11 23:07:03', '2016-05-13 02:19:01'),
(52, 'hoangnd', '', 'hoangnh_58@vnu.edu.vn', '$2y$10$6gkN8ABYtpWC4uHSyA4pG..6dF0wNw1AjpTa.IPeWpUTz6id/As4u', 1463052666, '', '0000-00-00', '1463052667', '', 0, 'jUJAGtIRMi', '', NULL, NULL, '2016-05-12 04:31:06', '2016-05-12 04:31:06'),
(53, 'abcd', '', 'abcd@vnu.edu.vn', '$2y$10$KJ2jCiSmhLkcaM5erJJcm.hVac1n5jKASxCezzOnCk1x5abPiknuG', 1463109049, '', '0000-00-00', '1463109050', '', 1, '', '', 4, 'aZNk8VX3jA7t7SQVVMXYo3K0V1y8INdrn31qVvbIWYfThY21mNnQbOQCBFGi', '2016-05-12 20:10:49', '2016-05-13 06:16:55'),
(54, 'abcdef', '', 'abcdef@vnu.edu.vn', '$2y$10$XBJYnt47mQ1xoQCZwwJUSO1Px1agI9NogglRYepw5W/oALHvUM8xO', 1463133964, '', '0000-00-00', '1463133965', '', 0, 'TBUtMiiTaT', '', NULL, NULL, '2016-05-13 03:06:04', '2016-05-13 03:06:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_configurations`
--
ALTER TABLE `admin_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`), ADD KEY `comments_report_id_foreign` (`report_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `cvs_email_unique` (`email`), ADD KEY `cvs_user_id_foreign` (`user_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`), ADD KEY `news_schoolyear_id_foreign` (`schoolyear_id`);

--
-- Indexes for table `notification_admins`
--
ALTER TABLE `notification_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_teacher_acceptances`
--
ALTER TABLE `notify_teacher_acceptances`
  ADD PRIMARY KEY (`id`), ADD KEY `notify_teacher_acceptances_user_id_foreign` (`user_id`), ADD KEY `notify_teacher_acceptances_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `register_times`
--
ALTER TABLE `register_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`), ADD KEY `reports_user_id_foreign_idx` (`user_id`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`), ADD KEY `statuses_user_id_foreign` (`user_id`), ADD KEY `statuses_company_id_foreign` (`company_id`);

--
-- Indexes for table `student_notifications`
--
ALTER TABLE `student_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `teachers_email_unique` (`email`), ADD UNIQUE KEY `teachers_phone_number_unique` (`phone_number`);

--
-- Indexes for table `teacher_notifications`
--
ALTER TABLE `teacher_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD UNIQUE KEY `users_student_code_unique` (`student_code`), ADD KEY `users_teacher_id_foreign` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_configurations`
--
ALTER TABLE `admin_configurations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `notification_admins`
--
ALTER TABLE `notification_admins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notify_teacher_acceptances`
--
ALTER TABLE `notify_teacher_acceptances`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `register_times`
--
ALTER TABLE `register_times`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `student_notifications`
--
ALTER TABLE `student_notifications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `teacher_notifications`
--
ALTER TABLE `teacher_notifications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cvs`
--
ALTER TABLE `cvs`
ADD CONSTRAINT `cvs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `news_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `schoolyears` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notify_teacher_acceptances`
--
ALTER TABLE `notify_teacher_acceptances`
ADD CONSTRAINT `notify_teacher_acceptances_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `notify_teacher_acceptances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `statuses`
--
ALTER TABLE `statuses`
ADD CONSTRAINT `statuses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
