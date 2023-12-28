-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2022 at 09:57 AM
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_OT_hours` int(11) NOT NULL DEFAULT 0,
  `institute_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emp_designation`
--

INSERT INTO `emp_designation` (`id`, `designation`, `approved_OT_hours`, `institute_id`, `created_at`, `updated_at`) VALUES
(18, 'Development Officer', 50, '19', '2022-09-02 03:45:29', '2022-09-07 00:52:26'),
(19, 'ICTA', 0, '19', '2022-09-02 03:45:36', '2022-09-02 03:45:36'),
(20, 'asd', 0, '19', '2022-09-02 04:17:42', '2022-09-02 04:17:42'),
(21, 'test 123', 0, '20', '2022-09-05 01:13:31', '2022-09-05 01:13:31'),
(22, 'තො.හා.සන්.තා.සහකාර fsd ef ef seef d e', 0, '19', '2022-09-06 00:38:46', '2022-09-06 00:48:25'),
(23, '123123', 0, '19', '2022-09-07 00:47:30', '2022-09-07 00:47:30');

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
(19, 'NAICC', 'ජාතික කෘෂිකර්ම තොරතුරු හා සන්නිවේදන මධ්‍යස්ථානය', '2022-09-02 03:42:08', '2022-09-02 03:42:08'),
(20, '1111111111111', '11111111111111111111', '2022-09-02 04:17:14', '2022-09-05 01:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_08_22_091954_create_sessions_table', 1),
(7, '2022_08_22_093347_create_posts_table', 2),
(8, '2022_08_26_055407_create__employees_table', 3),
(10, '2022_08_29_054438_create_emp_designation_table', 4),
(11, '2022_08_29_070755_create__o_t_list_table', 5),
(13, '2022_08_29_070816_create__o_t_records_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `ot_list`
--

CREATE TABLE `ot_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute_id` int(11) NOT NULL,
  `Status1` tinyint(1) NOT NULL DEFAULT 0,
  `Created_by1` int(255) DEFAULT NULL,
  `Status2` tinyint(1) NOT NULL DEFAULT 0,
  `Created_by2` int(255) DEFAULT NULL,
  `Status3` tinyint(1) NOT NULL DEFAULT 0,
  `Created_by3` int(255) DEFAULT NULL,
  `Status4` tinyint(1) NOT NULL DEFAULT 0,
  `Created_by4` int(255) DEFAULT NULL,
  `Status5` tinyint(1) NOT NULL DEFAULT 0,
  `Created_by5` int(11) DEFAULT NULL,
  `Status6` tinyint(1) NOT NULL DEFAULT 0,
  `Created_by6` int(11) DEFAULT NULL,
  `Status7` tinyint(1) NOT NULL DEFAULT 0,
  `Created_by7` int(11) DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ot_list`
--

INSERT INTO `ot_list` (`id`, `year`, `month`, `institute_id`, `Status1`, `Created_by1`, `Status2`, `Created_by2`, `Status3`, `Created_by3`, `Status4`, `Created_by4`, `Status5`, `Created_by5`, `Status6`, `Created_by6`, `Status7`, `Created_by7`, `completed`, `created_at`, `updated_at`) VALUES
(22, 2022, 'January', 19, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, 34, 1, '2022-09-02 03:45:57', '2022-09-05 01:45:02'),
(24, 2023, 'March', 19, 1, 34, 1, 34, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, '2022-09-02 04:34:36', '2022-09-06 04:27:53'),
(25, 2023, 'June', 19, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, '2022-09-04 22:31:47', '2022-09-04 22:31:47'),
(26, 2022, 'January', 20, 1, 36, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, '2022-09-05 01:13:52', '2022-09-05 01:13:54'),
(27, 2023, 'February', 19, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, '2022-09-06 23:09:06', '2022-09-06 23:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `ot_records`
--

CREATE TABLE `ot_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `List_id` int(11) NOT NULL,
  `Emp_id` int(11) NOT NULL,
  `Nature_of_duties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggest_ot_hour` int(11) DEFAULT NULL,
  `director_rec_ot_hour` int(11) DEFAULT NULL,
  `director_admin_rec_ot_hour` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ot_records`
--

INSERT INTO `ot_records` (`id`, `List_id`, `Emp_id`, `Nature_of_duties`, `suggest_ot_hour`, `director_rec_ot_hour`, `director_admin_rec_ot_hour`, `created_at`, `updated_at`) VALUES
(1, 2, 13, 'hjhlhlh lhl hh lhhlh\r\nf kfjsdf sdlf \r\nfsd fsdkfjk f f sf \r\n ahjhajh lafh ', NULL, NULL, NULL, NULL, NULL),
(2, 1, 14, 'asd', NULL, NULL, NULL, '2022-08-31 02:51:15', '2022-08-31 02:51:15'),
(3, 2, 14, 'dasd', NULL, NULL, NULL, '2022-08-31 02:52:31', '2022-08-31 02:52:31'),
(4, 2, 16, 'dsadwdfwawd', NULL, NULL, NULL, '2022-08-31 02:52:46', '2022-08-31 02:52:46'),
(5, 2, 15, 'asdasdasdww a klkasl las as asldk laklw k flakf \n eflefl klaekf lalekf lkef ', NULL, NULL, NULL, '2022-08-31 02:53:09', '2022-08-31 02:53:09'),
(6, 3, 16, 'sdfe se fe ', NULL, NULL, NULL, '2022-08-31 02:54:48', '2022-08-31 02:54:48'),
(7, 3, 25, 'fe e fees fesf esf ef ', NULL, NULL, NULL, '2022-08-31 02:54:57', '2022-08-31 02:54:57'),
(8, 3, 25, 'sdasdwwd', NULL, NULL, NULL, '2022-08-31 03:08:26', '2022-08-31 03:08:26'),
(9, 2, 13, 'fffffffffffffffffffffffffffffffff', NULL, NULL, NULL, '2022-08-31 03:18:28', '2022-08-31 03:41:21'),
(10, 4, 17, '්ිා්ිාටරා', NULL, NULL, NULL, '2022-08-31 03:21:33', '2022-08-31 03:21:33'),
(12, 2, 16, 'r4erwerwerwer wrw 3wr w', NULL, NULL, NULL, '2022-08-31 03:49:36', '2022-08-31 03:49:36'),
(13, 2, 15, 'etrer ert ert ', NULL, NULL, NULL, '2022-08-31 03:50:05', '2022-08-31 03:50:05'),
(14, 2, 14, 'sdfsdf', NULL, NULL, NULL, '2022-08-31 03:51:08', '2022-08-31 03:51:08'),
(15, 3, 26, 'fg dfg dfgr dgrd drrgd dr dr drg \n\n e \ngesgr sg\ns \ngsr s\nrg \nsrg srgsgs rgsr ', NULL, NULL, NULL, '2022-08-31 04:55:39', '2022-08-31 04:55:39'),
(16, 1, 25, 'gghgk', NULL, NULL, NULL, '2022-09-01 01:36:45', '2022-09-01 01:36:45'),
(17, 9, 16, 'gt rhthrth rt trh ', NULL, NULL, NULL, '2022-09-01 03:53:09', '2022-09-01 03:53:09'),
(18, 5, 17, 'asadasd asd asd', NULL, NULL, NULL, '2022-09-01 04:15:36', '2022-09-01 04:15:36'),
(19, 4, 28, 'dsad wda dwee faef ef ', NULL, NULL, NULL, '2022-09-01 05:09:15', '2022-09-01 05:09:15'),
(20, 12, 31, 'test datas d asd', NULL, NULL, NULL, '2022-09-02 01:59:14', '2022-09-02 02:08:06'),
(22, 12, 32, ' qwd qwd qwd qwd asd asdasd asd\nas dawq 1223\n awd\n aw\n\n aw\ndasd awdw awd awd awd ', 1, NULL, NULL, '2022-09-02 02:09:55', '2022-09-02 02:10:46'),
(23, 22, 35, 'dfdsf sergrg', NULL, NULL, NULL, '2022-09-02 03:46:06', '2022-09-02 03:46:06'),
(25, 22, 37, 'awerqwr wr ', NULL, NULL, NULL, '2022-09-02 04:18:34', '2022-09-02 04:18:34'),
(26, 22, 36, 'adwd dfq fqf qfqwfqopwi dsf fe wefwef wewrwrg wweg we  asd w fa ef ae faef aef eaf ef aef ', NULL, NULL, NULL, '2022-09-02 04:18:41', '2022-09-02 04:43:46'),
(28, 22, 39, 'වයෛවය ානො වනයායක ාකදයසදඑයචහවකයත යවතටෙ චඑත කතෙටක චරඑත තෙට', NULL, NULL, NULL, '2022-09-04 22:40:58', '2022-09-04 23:03:14'),
(30, 24, 39, 'dfgsrgrg', 60, 60, 60, '2022-09-05 01:49:51', '2022-09-06 04:12:06'),
(31, 24, 36, 'dfewf', 12, 30, 30, '2022-09-05 01:52:03', '2022-09-06 04:47:26'),
(32, 24, 39, 'effwef t h kjkjk jkjgkjglk jlsakgjl skjgkljskgj kfjghkhgjkadhfgl alkrjglkwjergtrqweigeghjerhgjkl reqgqergqerghqeghqerghqergeqrgerg qwd qw qw qweqweqwe qweqwe qw sdkj asd asd kaskd aksd kjaks kaskda kasdk asdkkaskdj kajskd kakkaskdj kakskdkasdk kkakkskdj akksdk asd ', 1, 10, 10, '2022-09-05 01:52:09', '2022-09-06 04:49:58'),
(33, 24, 38, 'wqefewf', NULL, NULL, NULL, '2022-09-05 01:52:14', '2022-09-05 01:52:14'),
(34, 24, 36, 'efefadf ef wef', 50, 60, 60, '2022-09-05 01:52:22', '2022-09-06 04:31:18'),
(35, 24, 35, 'aesf ef ae', NULL, NULL, NULL, '2022-09-05 01:52:29', '2022-09-05 01:52:29'),
(36, 25, 41, 'ෆ්ඩ්ෆ්ෆ්ඩ්ග්ඩ් ර්ග් ජ්ජ්ජ්ක්ෆ්ග්ෆ් ක්ඩ්ෆ්ඝ්;පොඵ්ක්ඩ්ක්ඩ්ක්ෆ්ග් ජ්ඩ්ක්ෆ්ග්‍රග්ඩ්', 1, 1, 1, '2022-09-06 00:39:48', '2022-09-06 23:01:03'),
(37, 24, 36, 'awef', 120, 100, 100, '2022-09-06 04:00:05', '2022-09-06 04:31:43'),
(38, 24, 35, 'wewewe', 50, 60, 60, '2022-09-06 04:35:59', '2022-09-06 04:36:20'),
(39, 25, 36, 'wrw4', 50, 50, 50, '2022-09-07 01:15:59', '2022-09-07 01:15:59');

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

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `body`, `created_at`, `updated_at`) VALUES
(19, '123', 'public/posts/LQw05oWoBB6RlYeNkwB2EvYezvJwzlyj4El3TBRy.jpg', '123123', '2022-08-24 00:04:41', '2022-08-24 00:04:41'),
(20, '444', 'public/posts/OT0NRPNEbSCWrI5fry1l8folE30wP1BgpVnbNnHl.jpg', '3434', '2022-08-24 00:21:00', '2022-08-26 05:07:18');

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
('0lltY3YBoMcfjmfS8yMOvQ73qIIFvWqTgpeU1ne3', 34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaTlZZG1FOFhqNENreDNDRnIxRzVvYnJyRHJ6TzNvTmFYV3BsWWVVSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vdHJlY29yZHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozNDtzOjg6InJlY29yZElEIjtpOjI1O30=', 1662537374),
('CynIxCFON9qqduDjVlBgOpHHLz7LTm02sZxIUWKe', 34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36 Edg/105.0.1343.27', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZkhia1RzcldmQUE1UzJMVlJFa3BZYm93MG42ZXlyQ2RmdW5yNXFOaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vdGRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM0O3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJGpEdy55b0ZIekpyNFZRVno5UVJ1U2UwSXFjLmNEYThpVGFMM05ySkpHdDZsSS51bzdwcHppIjtzOjg6InJlY29yZElEIjtpOjI1O30=', 1662531142);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute` int(11) NOT NULL DEFAULT 0,
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

INSERT INTO `users` (`id`, `name`, `institute`, `user_level`, `email`, `status`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(33, 'Administrator', 19, 7, 'admin@gmail.com', 0, NULL, '$2y$10$YpOPrG83K6XSRKbG30fBcumY6hum6wdF/erJmpIjKgAveEpcLCgMW', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-02 03:43:09', '2022-09-06 04:24:58'),
(34, 'clark', 19, 12, 'clark@gmail.com', 0, NULL, '$2y$10$jDw.yoFHzJr4VQVz9QRuSe0Iqc.cDa8iTaL3NrJJGt6lI.uo7ppzi', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-02 03:43:41', '2022-09-07 00:21:26'),
(35, 'Admin Officer', 19, 9, 'ao@gmail.com', 0, NULL, '$2y$10$5H6ZugePpx9d.jQP0ee/OOStFPPM/slJpT9d42Wtb4B4zGOkseVZ2', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-02 03:44:23', '2022-09-02 03:44:23'),
(36, 'GAYAN PRADEEP', 20, 12, 'gayan.prdp1@gmail.com', 0, NULL, '$2y$10$ev.Y/ZqYrbXM9DgBtJDMtOTqrXlhBM9OySM7jIHpM9ZqE7Y/jM1P6', NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-05 01:06:50', '2022-09-05 01:06:50');

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
(4, 4, 'Administrative Officer (Admin)', NULL, NULL),
(5, 5, 'Chief Clerk  (Admin)', NULL, NULL),
(6, 6, 'Subject Clerk (Admin)', NULL, NULL),
(7, 7, 'Director ', NULL, NULL),
(8, 8, 'Chief Engineer ', NULL, NULL),
(9, 9, 'Chief Accountant', NULL, NULL),
(10, 10, 'Administrative Officer ', NULL, NULL),
(11, 11, 'Chief Clerk ', NULL, NULL),
(12, 12, 'Subject Clerk', NULL, NULL);

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
(35, 'kandy', 'kandy', 19, 19, '2022-09-02 03:45:47', '2022-09-02 03:45:47'),
(36, 'gayan', 'gayan', 18, 19, '2022-09-02 04:02:03', '2022-09-02 04:02:03'),
(37, 'asdas', 'asdas', 18, 19, '2022-09-02 04:14:48', '2022-09-02 04:14:48'),
(39, 'E G GAYAN PRADEEP KUMARA', 'E G GAYAN PRADEEP KUMARA', 19, 19, '2022-09-04 22:40:34', '2022-09-04 22:40:34'),
(40, 'kan', 'kan', 21, 20, '2022-09-05 01:13:45', '2022-09-05 01:13:45'),
(41, 'ගයාන් ප්‍රදීප්', 'ගයාන් ප්‍රදීප්', 22, 19, '2022-09-06 00:39:05', '2022-09-06 00:39:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_designation`
--
ALTER TABLE `emp_designation`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ot_list`
--
ALTER TABLE `ot_list`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_employees`
--
ALTER TABLE `_employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ot_list`
--
ALTER TABLE `ot_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ot_records`
--
ALTER TABLE `ot_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `_employees`
--
ALTER TABLE `_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
