-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 10:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_designation`
--

CREATE TABLE `emp_designation` (
  `id` int(20) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OT_range1` int(11) NOT NULL,
  `OT_range2` int(11) NOT NULL,
  `OT_range3` int(11) NOT NULL,
  `institute_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emp_designation`
--

INSERT INTO `emp_designation` (`id`, `designation`, `OT_range1`, `OT_range2`, `OT_range3`, `institute_id`, `created_at`, `updated_at`) VALUES
(1, 'ICTO', 60, 100, 200, '1', '2022-09-13 04:58:47', '2022-11-09 09:24:52'),
(2, 'DO', 100, 200, 300, '1', '2022-09-13 04:58:58', '2022-11-09 10:02:06'),
(3, 'ICTA', 0, 22, 0, '1', '2022-09-13 04:59:11', '2022-11-09 09:31:27'),
(5, 'test', 0, 100, 200, '1', '2022-09-14 01:32:23', '2022-11-09 09:32:23'),
(10, 'DO', 0, 22, 0, '2', '2022-10-06 01:47:24', '2022-11-09 09:28:33'),
(13, 'X', 100, 200, 300, '1', '2022-10-28 04:57:42', '2022-11-09 10:00:56'),
(14, 't', 0, 0, 0, '1', '2022-10-31 05:43:57', '2022-10-31 05:43:57'),
(15, 'tes2', 60, 100, 200, '1', '2022-11-09 09:12:41', '2022-11-09 09:33:00'),
(16, 'tes2', 2, 3, 4, '1', '2022-11-09 09:16:11', '2022-11-09 09:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `institute_code`, `institute`, `created_at`, `updated_at`) VALUES
(1, 'NAICC', 'ජාතික කෘෂිකර්ම තොරතුරු හා සන්නිවේදන මධ්‍යස්ථානය', NULL, '2022-09-14 21:59:26'),
(2, 'FCRDI', 'ක්ෂේත්‍ර බෝග පර්යේෂණ හා සංවර්ධන ආයතනය', '2022-09-13 04:57:45', '2022-09-14 22:00:03'),
(3, 'HORDI', 'උද්‍යාන බෝග පර්යේෂණ හා සංවර්ධන ආයතනය', '2022-09-13 04:58:01', '2022-09-14 22:00:48'),
(4, 'PGRC', 'පැළෑටි ජාන සම්පත් මධ්‍යස්ථානය', '2022-09-13 04:58:13', '2022-09-14 22:03:46'),
(5, 'GLORDC', 'මාෂ හා තෙල් බෝග පර්යේෂණ හා සංවර්ධන මධ්‍යස්ථානය', '2022-09-13 04:58:23', '2022-09-14 22:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minutes`
--

CREATE TABLE `minutes` (
  `id` int(11) NOT NULL,
  `ot_list_number` int(11) NOT NULL,
  `minute` varchar(600) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `submit_level` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `minutes`
--

INSERT INTO `minutes` (`id`, `ot_list_number`, `minute`, `type`, `submit_level`, `user`, `updated_at`, `created_at`) VALUES
(329, 87, NULL, 'F', 8, 15, '2022-11-23 05:56:17', '2022-11-23'),
(330, 88, NULL, 'F', 8, 15, '2022-11-23 05:56:25', '2022-11-23'),
(331, 89, NULL, 'F', 8, 15, '2022-11-23 05:56:31', '2022-11-23'),
(332, 87, NULL, 'F', 7, 16, '2022-11-23 05:59:09', '2022-11-23'),
(333, 88, NULL, 'F', 7, 16, '2022-11-23 05:59:25', '2022-11-23'),
(334, 89, NULL, 'F', 7, 16, '2022-11-23 05:59:34', '2022-11-23'),
(338, 87, NULL, 'A', 6, 17, '2022-11-23 06:13:39', '2022-11-23'),
(339, 88, NULL, 'F', 6, 17, '2022-11-23 06:14:31', '2022-11-23'),
(340, 89, NULL, 'F', 6, 17, '2022-11-23 06:14:45', '2022-11-23'),
(341, 88, NULL, 'F', 5, 18, '2022-11-23 06:18:41', '2022-11-23'),
(342, 89, NULL, 'F', 5, 18, '2022-11-23 06:18:48', '2022-11-23'),
(343, 88, NULL, 'F', 4, 19, '2022-11-23 06:22:14', '2022-11-23'),
(344, 89, NULL, 'F', 4, 19, '2022-11-23 06:22:23', '2022-11-23'),
(345, 88, NULL, 'A', 3, 20, '2022-11-23 06:27:48', '2022-11-23'),
(346, 89, NULL, 'F', 3, 20, '2022-11-23 06:28:11', '2022-11-23'),
(347, 89, NULL, 'F', 2, 1, '2022-11-23 06:31:31', '2022-11-23'),
(348, 90, NULL, 'F', 8, 15, '2022-11-23 06:33:57', '2022-11-23'),
(349, 91, NULL, 'F', 8, 15, '2022-11-23 06:34:04', '2022-11-23'),
(350, 90, 'reasdad', 'B', 7, 16, '2022-11-23 06:53:41', '2022-11-23'),
(351, 90, NULL, 'F', 8, 15, '2022-11-23 07:00:01', '2022-11-23'),
(352, 90, 'rewrwer', 'B', 7, 16, '2022-11-23 07:01:07', '2022-11-23'),
(353, 90, NULL, 'F', 8, 15, '2022-11-23 07:02:14', '2022-11-23'),
(354, 90, NULL, 'F', 7, 16, '2022-11-23 07:02:44', '2022-11-23'),
(355, 90, 'wefwe', 'B', 6, 17, '2022-11-23 07:13:13', '2022-11-23'),
(356, 90, NULL, 'F', 7, 16, '2022-11-23 07:14:02', '2022-11-23'),
(357, 91, NULL, 'F', 7, 16, '2022-11-23 07:14:16', '2022-11-23'),
(358, 90, NULL, 'A', 6, 17, '2022-11-23 07:14:39', '2022-11-23'),
(359, 91, NULL, 'F', 6, 17, '2022-11-23 07:15:06', '2022-11-23'),
(360, 91, 'fef', 'B', 5, 18, '2022-11-23 07:15:36', '2022-11-23'),
(361, 91, NULL, 'F', 6, 17, '2022-11-23 07:16:07', '2022-11-23'),
(362, 91, NULL, 'F', 5, 18, '2022-11-23 07:16:33', '2022-11-23'),
(363, 91, 'sfefg', 'B', 4, 19, '2022-11-23 07:17:29', '2022-11-23'),
(364, 91, NULL, 'F', 5, 18, '2022-11-23 07:23:48', '2022-11-23'),
(365, 93, NULL, 'F', 8, 15, '2022-11-29 03:58:44', '2022-11-29'),
(366, 94, NULL, 'F', 8, 15, '2022-11-29 03:58:54', '2022-11-29'),
(367, 95, NULL, 'F', 8, 15, '2022-11-29 03:59:02', '2022-11-29'),
(368, 93, 'test check', 'B', 7, 16, '2022-11-29 04:01:06', '2022-11-29'),
(369, 94, 'test2', 'B', 7, 16, '2022-11-29 04:20:25', '2022-11-29'),
(370, 95, 'test3', 'B', 7, 16, '2022-11-29 04:24:08', '2022-11-29'),
(371, 93, NULL, 'F', 8, 15, '2022-11-29 04:27:20', '2022-11-29'),
(372, 93, 'sdsdsd', 'B', 7, 16, '2022-11-29 04:27:40', '2022-11-29'),
(373, 93, NULL, 'F', 8, 15, '2022-11-29 04:55:04', '2022-11-29'),
(374, 94, NULL, 'F', 8, 15, '2022-11-29 04:55:20', '2022-11-29'),
(375, 95, NULL, 'F', 8, 15, '2022-11-29 04:55:41', '2022-11-29'),
(376, 93, NULL, 'F', 7, 16, '2022-11-29 04:56:25', '2022-11-29'),
(377, 94, NULL, 'F', 7, 16, '2022-11-29 04:56:35', '2022-11-29'),
(378, 95, NULL, 'F', 7, 16, '2022-11-29 04:56:41', '2022-11-29'),
(379, 93, 'tttt', 'B', 6, 17, '2022-11-29 05:00:14', '2022-11-29'),
(380, 94, 'yyyy', 'B', 6, 17, '2022-11-29 05:00:31', '2022-11-29'),
(381, 95, 'erererr', 'B', 6, 17, '2022-11-29 05:00:47', '2022-11-29'),
(382, 93, NULL, 'F', 7, 16, '2022-11-29 05:01:20', '2022-11-29'),
(383, 94, NULL, 'F', 7, 16, '2022-11-29 05:01:34', '2022-11-29'),
(384, 95, NULL, 'F', 7, 16, '2022-11-29 05:01:47', '2022-11-29'),
(385, 93, NULL, 'A', 6, 17, '2022-11-29 05:03:07', '2022-11-29'),
(386, 94, NULL, 'F', 6, 17, '2022-11-29 05:03:46', '2022-11-29'),
(387, 95, NULL, 'F', 6, 17, '2022-11-29 05:03:53', '2022-11-29'),
(388, 94, NULL, 'F', 5, 18, '2022-11-29 05:10:22', '2022-11-29'),
(389, 95, NULL, 'F', 5, 18, '2022-11-29 05:10:32', '2022-11-29'),
(390, 94, NULL, 'F', 4, 19, '2022-11-29 05:12:23', '2022-11-29'),
(391, 95, NULL, 'F', 4, 19, '2022-11-29 05:12:40', '2022-11-29'),
(392, 94, 'ssssss', 'B', 3, 20, '2022-11-29 05:17:40', '2022-11-29'),
(393, 95, 'rtrtyyyyyy', 'B', 3, 20, '2022-11-29 05:18:11', '2022-11-29'),
(394, 94, NULL, 'F', 6, 17, '2022-11-29 05:21:59', '2022-11-29'),
(395, 95, NULL, 'F', 6, 17, '2022-11-29 05:22:11', '2022-11-29'),
(396, 94, NULL, 'F', 5, 18, '2022-11-29 05:22:38', '2022-11-29'),
(397, 95, NULL, 'F', 5, 18, '2022-11-29 05:22:45', '2022-11-29'),
(398, 94, NULL, 'F', 4, 19, '2022-11-29 05:23:15', '2022-11-29'),
(399, 95, NULL, 'F', 4, 19, '2022-11-29 05:23:21', '2022-11-29'),
(400, 94, NULL, 'A', 3, 20, '2022-11-29 05:23:48', '2022-11-29'),
(401, 95, NULL, 'F', 3, 20, '2022-11-29 05:24:03', '2022-11-29'),
(402, 95, 'uyuy', 'B', 2, 1, '2022-11-29 05:24:57', '2022-11-29'),
(403, 95, NULL, 'F', 3, 20, '2022-11-29 05:44:32', '2022-11-29'),
(404, 95, NULL, 'F', 2, 1, '2022-11-29 05:44:53', '2022-11-29'),
(405, 91, NULL, 'F', 4, 19, '2022-11-29 05:49:27', '2022-11-29'),
(406, 91, '1\n2\n3\n4\n', 'B', 3, 20, '2022-11-29 05:53:30', '2022-11-29'),
(407, 91, 'sd asdasdw awd\nawd adwd\n02 asd\nw\nd', 'F', 6, 17, '2022-11-29 06:27:19', '2022-11-29'),
(408, 91, NULL, 'F', 5, 18, '2022-11-29 06:27:40', '2022-11-29'),
(409, 91, NULL, 'F', 4, 19, '2022-11-29 06:28:17', '2022-11-29'),
(410, 91, NULL, 'A', 3, 20, '2022-11-29 06:28:45', '2022-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `ot_list`
--

CREATE TABLE `ot_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ot_list`
--

INSERT INTO `ot_list` (`id`, `year`, `month`, `institute_id`, `created_at`, `updated_at`) VALUES
(137, 2022, 'January', 1, '2022-11-23 05:55:00', '2022-11-23 05:55:00'),
(138, 2022, 'February', 1, '2022-11-23 06:32:53', '2022-11-23 06:32:53'),
(139, 2022, 'March', 1, '2022-11-28 06:37:27', '2022-11-28 06:37:27'),
(140, 2022, 'April', 1, '2022-11-29 08:43:46', '2022-11-29 08:43:46'),
(141, 2022, 'May', 1, '2022-11-29 08:59:24', '2022-11-29 08:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `ot_list_status`
--

CREATE TABLE `ot_list_status` (
  `id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `ot_range` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `L1` tinyint(1) NOT NULL DEFAULT 0,
  `L2` tinyint(1) NOT NULL DEFAULT 0,
  `L3` tinyint(1) NOT NULL DEFAULT 0,
  `L4` tinyint(1) NOT NULL DEFAULT 0,
  `L5` tinyint(1) NOT NULL DEFAULT 0,
  `L6` tinyint(1) NOT NULL DEFAULT 0,
  `L7` tinyint(1) NOT NULL DEFAULT 0,
  `L8` tinyint(1) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `test` varchar(11) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ot_list_status`
--

INSERT INTO `ot_list_status` (`id`, `list_id`, `ot_range`, `L1`, `L2`, `L3`, `L4`, `L5`, `L6`, `L7`, `L8`, `completed`, `created_at`, `updated_at`, `test`) VALUES
(87, 137, 'r1', 0, 0, 0, 0, 0, 1, 1, 1, 1, '2022-11-23 06:13:39', '2022-11-23 06:13:39', ''),
(88, 137, 'r2', 0, 0, 1, 1, 1, 1, 1, 1, 1, '2022-11-23 06:27:48', '2022-11-23 06:27:48', ''),
(89, 137, 'r3', 0, 1, 1, 1, 1, 1, 1, 1, 1, '2022-11-23 06:31:31', '2022-11-23 06:31:31', ''),
(90, 138, 'r1', 0, 0, 0, 0, 0, 1, 1, 1, 1, '2022-11-23 07:14:39', '2022-11-23 07:14:39', ''),
(91, 138, 'r2', 0, 0, 1, 1, 1, 1, 1, 1, 1, '2022-11-29 06:28:45', '2022-11-29 06:28:45', ''),
(92, 138, 'r3', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-11-23 06:32:53', '2022-11-23 06:32:53', ''),
(93, 139, 'r1', 0, 0, 0, 0, 0, 1, 1, 1, 1, '2022-11-29 05:03:07', '2022-11-29 05:03:07', ''),
(94, 139, 'r2', 0, 0, 1, 1, 1, 1, 1, 1, 1, '2022-11-29 05:23:48', '2022-11-29 05:23:48', ''),
(95, 139, 'r3', 0, 1, 1, 1, 1, 1, 1, 1, 1, '2022-11-29 05:44:53', '2022-11-29 05:44:53', ''),
(96, 140, 'r1', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-11-29 08:43:46', '2022-11-29 08:43:46', ''),
(97, 140, 'r2', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-11-29 08:43:46', '2022-11-29 08:43:46', ''),
(98, 140, 'r3', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-11-29 08:43:46', '2022-11-29 08:43:46', ''),
(99, 141, 'r1', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-11-29 08:59:24', '2022-11-29 08:59:24', ''),
(100, 141, 'r2', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-11-29 08:59:24', '2022-11-29 08:59:24', ''),
(101, 141, 'r3', 0, 0, 0, 0, 0, 0, 0, 0, 0, '2022-11-29 08:59:24', '2022-11-29 08:59:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `ot_records`
--

CREATE TABLE `ot_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `List_id` int(11) NOT NULL,
  `Emp_id` int(11) NOT NULL,
  `ot_range` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `Nature_of_duties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggest_ot_hour` int(11) DEFAULT NULL,
  `director_rec_ot_hour` int(11) DEFAULT NULL,
  `director_admin_rec_ot_hour` int(11) DEFAULT NULL,
  `mark` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `test` varchar(11) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ot_records`
--

INSERT INTO `ot_records` (`id`, `List_id`, `Emp_id`, `ot_range`, `Nature_of_duties`, `suggest_ot_hour`, `director_rec_ot_hour`, `director_admin_rec_ot_hour`, `mark`, `created_at`, `updated_at`, `test`) VALUES
(141, 137, 11, 'r1', '11111', 50, 50, 50, 0, '2022-11-23 05:55:25', '2022-11-23 06:12:06', ''),
(142, 137, 10, 'r1', 'dawe', 60, 60, 60, 0, '2022-11-23 05:55:33', '2022-11-23 05:55:33', ''),
(143, 137, 1, 'r3', 'wfawf', 220, 220, 220, 0, '2022-11-23 05:55:45', '2022-11-23 06:31:28', ''),
(144, 137, 2, 'r2', 'asdfafw', 150, 150, 150, 0, '2022-11-23 05:55:53', '2022-11-23 06:24:22', ''),
(145, 138, 11, 'r1', 'rwwer', 30, 30, 30, 0, '2022-11-23 06:33:19', '2022-11-23 07:14:36', ''),
(146, 138, 10, 'r1', 'yrty', 50, 50, 50, 0, '2022-11-23 06:33:30', '2022-11-23 07:07:05', ''),
(147, 138, 4, 'r2', 'yy ', 120, 120, 120, 0, '2022-11-23 06:33:41', '2022-11-29 06:11:33', ''),
(148, 139, 11, 'r1', 'aff', 20, 20, 20, 0, '2022-11-28 06:37:51', '2022-11-29 05:01:09', ''),
(149, 139, 1, 'r1', 'aefr', 20, 20, 20, 0, '2022-11-28 06:38:36', '2022-11-28 06:38:36', ''),
(150, 139, 10, 'r2', 'asd', 120, 120, 120, 0, '2022-11-28 06:40:35', '2022-11-29 05:21:52', ''),
(151, 139, 12, 'r3', 'sdfsdf', 220, 220, 220, 0, '2022-11-29 03:58:28', '2022-11-29 05:44:26', ''),
(152, 140, 11, 'r1', 'fsdfsdfef fwef sfs defesff sfg r srg srg srgs d sfesfsf srg srg srg sdgfs egsgseg rg sg srg sdf sefgse sgsrg sgrsgsdg sdfes dfsesef dsdf sdf sdfesfsefs dfsdf sefsdfsdf sfesf sdfsefsdf sef sdf sef sdf sef ', 90, 90, 90, 0, '2022-11-29 08:44:16', '2022-11-29 10:37:12', ''),
(153, 140, 10, 'r1', 'efewf weawg awg weg w wk wekgha gawjgk hawegfa kwe alwe awkwal awe; ;asd hshdfh sdfeufunvbzxj skdjf dmfnamsd naksjdf dfbm sdf asdjf sdfhhggalkdf kjsdfiieurn jskfio kkfoo kdfusdf  ksdfkjsk skdfksdfieufjskdf ksdfieifkjksdf ksdfijiefksdjfksd skdfjiwejf skdf ', 90, 90, 90, 0, '2022-11-29 08:45:05', '2022-11-29 10:36:20', ''),
(154, 140, 1, 'r1', 'sdfs ef sef sef srggh yj yj tyj tyj tyj tyj dfg vbtbr bdgfbtrg s sdfs e sdf tr gh y tyh rh dfg dfg dfg sfas asd fr rg rg rsdfs dfasd asc fg fhth tht htdefg sdsef sdf rg thtyh dth dghdgh', 60, 60, 60, 0, '2022-11-29 08:45:42', '2022-11-29 10:36:30', ''),
(155, 140, 6, 'r1', 'sdf sef sdf sefs dfsdf sef sdf sdf sef fggfh yhjrth eerg weg sdf sef sgfrg sdfg sdf sef srg rtht d dg dth dth djdfg sdf srg rgsrg srg sdfsdf sdf serfs gh tyhjth dtthdth dth dth dth dfgdfgsdf sdfs rgg rsg sg r', 90, 90, 90, 0, '2022-11-29 08:46:55', '2022-11-29 09:41:09', ''),
(156, 140, 2, 'r2', 'fv ergwe gerg weg5tg55 wg4 wg 5gg fgtg fbf sfvsfvs sfd ht sthhyh sh sths thsthtsh sth sh sdfg st htsh shdfg srg gf sfs gs th', 120, 120, 120, 0, '2022-11-29 08:50:46', '2022-11-29 08:50:46', ''),
(157, 140, 4, 'r2', 'fwe f qeq wqwt qrt qwe tgw45 wqefrq 4q3 f334f 3fq3fqwf 4 wef 34f q3f ', 150, 150, 150, 0, '2022-11-29 08:52:37', '2022-11-29 08:52:37', ''),
(158, 140, 12, 'r3', 'ew qf q pogpop gopqor pqopwofp opofpoqwpofp ghokgoqrgpo opgqopop opqopgo rpqog oqpogp oqpgopqogpoqpogp oqpgop qogpo qpogp oqpgo pqogp ', 220, 220, 220, 0, '2022-11-29 08:52:55', '2022-11-29 08:52:55', '');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('wFiMEKRY0uvPfXE7hamO5BT92ppR5pPmMNpuCAt4', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOWZCZDBOOENmbVJNQXkzSUd6R0FNZzV5ZkUwcG1USzZLNHBHOVVEOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vdGxpc3Rfc3RhdHVzLzEvQyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE1O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJHVJd1lpRGdJWTVQM2NRUW1iRDlldHVBTzBTMEc2TkNzbkplVkFnTUJJUUxVU3V6UlBDY1BPIjtzOjEyOiJub3RpZmljYXRpb24iO3M6MToiMSI7fQ==', 1669718632);

-- --------------------------------------------------------

--
-- Table structure for table `temp_chart`
--

CREATE TABLE `temp_chart` (
  `id` int(11) NOT NULL,
  `month` char(10) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_chart`
--

INSERT INTO `temp_chart` (`id`, `month`, `value`, `created_at`, `updated_at`) VALUES
(1, 'January', 480, '2022-11-21 08:41:00', '2022-11-29 10:43:45'),
(2, 'February', 200, '2022-11-21 08:41:00', '2022-11-29 10:43:45'),
(3, 'March', 380, '2022-11-21 08:41:22', '2022-11-29 10:43:45'),
(4, 'April', 0, '2022-11-21 08:41:22', '2022-11-22 03:42:52'),
(5, 'May', 0, '2022-11-21 08:41:49', '2022-11-21 08:41:49'),
(6, 'June', 0, '2022-11-21 08:41:49', '2022-11-21 08:41:49'),
(7, 'July', 0, '2022-11-21 08:41:56', '2022-11-21 08:41:56'),
(8, 'August', 0, '2022-11-21 08:41:56', '2022-11-21 08:41:56'),
(9, 'September', 0, '2022-11-21 08:42:04', '2022-11-21 08:42:04'),
(10, 'October', 0, '2022-11-21 08:42:04', '2022-11-21 08:42:04'),
(11, 'November', 0, '2022-11-21 08:42:11', '2022-11-21 08:42:11'),
(12, 'December', 0, '2022-11-21 08:42:11', '2022-11-21 08:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute` int(11) NOT NULL DEFAULT 0,
  `designation_id` int(11) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `institute`, `designation_id`, `user_level`, `email`, `status`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'GAYAN ', 1, 2, 2, 'gayan.prdp@gmail.com', 0, NULL, '$2y$10$ujqGmFRnAMW/cAobojUUT.09Lh9mHPfwNG5TX27nsO3quMm2Th35m', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-13 04:53:15', '2022-11-21 10:07:58'),
(15, 'Ruwan', 1, 5, 8, 'clark@gmail.com', 0, NULL, '$2y$10$uIwYiDgIY5P3cQQmbD9etuAO0S0G6NCsnJeVAgMBIQLUSuzRPCcPO', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09 05:23:36', '2022-11-22 04:33:49'),
(16, 'Lakmal ', 1, 2, 7, 'ao@gmail.com', 0, NULL, '$2y$10$KgTCYg6aRhu8vfrBWL1v1eJilGWSieBpx.6jqnK4BBjd7wCQOW5mG', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09 05:55:44', '2022-11-22 04:34:20'),
(17, 'Test User', 1, 4, 6, 'director@gmail.com', 0, NULL, '$2y$10$pjcqdzBxK9vIOdhA3xrha.ixAQ/3RY/A3y.tC.44vVVhQfsClZilm', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-09 07:49:54', '2022-11-09 07:49:54'),
(18, 'Chandana', 1, 5, 5, 'clarka@gmail.com', 0, NULL, '$2y$10$YyN2tNjseR2M/3aUMYCn9O.p344CnZOEwst3UJpbC1QC.DHnagNeS', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 09:45:32', '2022-11-17 09:45:32'),
(19, 'Nimal', 1, 2, 4, 'aoa@gmail.com', 0, NULL, '$2y$10$AjkUAaJb6/WLDonuSemkL.g8Gx5Xh6/lI4i1TBcDH7NAYK73DW5tm', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 09:52:51', '2022-11-17 09:52:51'),
(20, 'test user 2', 2, 4, 3, 'directora@gmail.com', 0, NULL, '$2y$10$XF.nlWUlzcA11PJPUOj33.6PXm/JjIQAUvtaswNuIimrAl1mNUfMu', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-17 09:55:06', '2022-11-22 05:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_designation`
--

CREATE TABLE `user_designation` (
  `id` int(11) NOT NULL,
  `designation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_designation`
--

INSERT INTO `user_designation` (`id`, `designation`) VALUES
(1, 'Development Officer'),
(2, 'Administrative Officer'),
(3, 'Chief Clark  '),
(4, 'Director '),
(5, 'Management Assistant '),
(6, 'Chief Accountant '),
(7, 'Chief Engineer ');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_level` int(255) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `user_level`, `designation`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrator', NULL, NULL),
(2, 2, 'Additional Director General (Admin)', NULL, NULL),
(3, 3, 'Director(Admin)', NULL, NULL),
(4, 4, 'Administrative Officer / Chief Clerk (Admin)', NULL, NULL),
(5, 5, 'Subject Officer (Admin)', NULL, NULL),
(6, 6, 'Director / Chief Engineer / Chief Accountant', NULL, NULL),
(7, 7, 'Administrative Officer / Chief Clerk ', NULL, NULL),
(8, 8, 'Subject Officer ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_employees`
--

CREATE TABLE `_employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` int(255) NOT NULL,
  `institute` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_employees`
--

INSERT INTO `_employees` (`id`, `nic`, `name`, `designation`, `institute`, `created_at`, `updated_at`) VALUES
(1, 'GAYAN PRADEEP', 'GAYAN PRADEEP', 2, 1, '2022-09-13 05:00:09', '2022-11-16 03:14:38'),
(2, 'Ruwan', 'Ruwan', 2, 1, '2022-09-13 05:00:16', '2022-09-13 05:00:16'),
(3, 'Pradeep', 'Pradeep', 2, 1, '2022-09-13 05:00:30', '2022-11-16 03:14:48'),
(4, 'test', 'test', 2, 1, '2022-09-14 04:03:40', '2022-11-16 03:14:56'),
(5, 'test2', 'test2', 2, 1, '2022-09-14 04:16:44', '2022-09-14 04:16:44'),
(6, 'kan', 'kan', 2, 1, '2022-09-26 04:07:27', '2022-11-16 03:14:43'),
(7, 'Kumara', 'Kumara', 13, 2, '2022-10-06 01:47:45', '2022-11-22 05:16:49'),
(9, 'trtrtrtrtrtrt', 'trtrtrtrtrtrt', 2, 1, '2022-10-12 09:31:43', '2022-11-16 03:15:02'),
(10, 'gayan', 'gayan', 2, 1, '2022-10-12 09:35:27', '2022-10-12 09:35:27'),
(11, 'abc', 'abc', 2, 1, '2022-10-28 04:58:30', '2022-11-16 03:14:32'),
(12, 'tttt', 'tttt', 2, 1, '2022-10-31 05:44:12', '2022-11-16 03:15:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_designation`
--
ALTER TABLE `emp_designation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institute_id` (`institute_id`),
  ADD KEY `institute_id_2` (`institute_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minutes`
--
ALTER TABLE `minutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_list`
--
ALTER TABLE `ot_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`,`month`,`institute_id`);

--
-- Indexes for table `ot_list_status`
--
ALTER TABLE `ot_list_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot_records`
--
ALTER TABLE `ot_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `temp_chart`
--
ALTER TABLE `temp_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_designation`
--
ALTER TABLE `user_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_employees`
--
ALTER TABLE `_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designation` (`designation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `minutes`
--
ALTER TABLE `minutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- AUTO_INCREMENT for table `ot_list`
--
ALTER TABLE `ot_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `ot_list_status`
--
ALTER TABLE `ot_list_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `ot_records`
--
ALTER TABLE `ot_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_designation`
--
ALTER TABLE `user_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `_employees`
--
ALTER TABLE `_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
