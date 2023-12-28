-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2023 at 10:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ropw3dte_ot`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_designation`
--

CREATE TABLE `emp_designation` (
  `id` int(20) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `OT_range1` int(11) NOT NULL,
  `OT_range2` int(11) NOT NULL,
  `OT_range3` int(11) NOT NULL,
  `institute_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute_code` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `main_institute` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `institute_code`, `institute`, `main_institute`, `created_at`, `updated_at`) VALUES
(1, 'NAICC', 'ජාතික කෘෂිකර්ම තොරතුරු හා සන්නිවේදන මධ්‍යස්ථානය', 0, NULL, '2022-12-16 06:46:26'),
(2, 'FCRDI', 'ක්ෂේත්‍ර බෝග පර්යේෂණ හා සංවර්ධන ආයතනය', 0, '2022-09-13 04:57:45', '2022-12-19 06:09:16'),
(3, 'HORDI', 'උද්‍යාන බෝග පර්යේෂණ හා සංවර්ධන ආයතනය', 0, '2022-09-13 04:58:01', '2022-09-14 22:00:48'),
(4, 'PGRC', 'පැළෑටි ජාන සම්පත් මධ්‍යස්ථානය', 0, '2022-09-13 04:58:13', '2022-09-14 22:03:46'),
(8, 'FRDI', 'පළතුරු පර්යේෂණ හා සංවර්ධන ආයතනය', 0, '2022-12-19 06:08:33', '2022-12-19 06:08:33'),
(9, 'A-park-Gannoruwa', 'කෘෂි තාක්ෂණ උද්‍යානය - ගන්නෝරුව', 1, '2022-12-21 05:45:41', '2022-12-21 06:00:14'),
(10, 'A-Park-Bataatha', 'චමල් රාජපක්ෂ කෘෂි තාක්ෂණ හා සංචාරක උද්‍යානය, බටඅත', 1, '2022-12-21 06:01:04', '2022-12-21 06:01:04'),
(11, 'GLORDC', 'මාෂ හා තෙල් බෝග පර්යේෂණ හා සංවර්ධන මධ්‍යස්ථානය - අගුණකොලපැලැස්ස', 2, '2022-12-21 06:02:31', '2022-12-21 06:02:31'),
(12, 'RARDC', 'ප්‍රාදේශීය කෘෂිකර්ම පර්යේෂණ හා සංවර්ධන මධ්‍යස්ථානය - අරලගංවිල', 2, '2022-12-21 06:04:26', '2022-12-21 06:04:26'),
(13, 'FCRDS', 'පළතුරු බෝග පර්යේෂණ සංවර්ධන ස්ථානය - පේරාදෙණිය', 8, '2022-12-21 06:07:15', '2022-12-21 06:07:15'),
(14, 'SCPPC', 'බීජ සහතික කිරිම හා පැළැටි සංරක්ෂණ මධ්‍යස්ථානය', 0, '2022-12-21 08:59:38', '2022-12-21 08:59:38'),
(15, 'APU', 'කෘෂි ප්‍රකාශන ඒකකය', 1, '2022-12-21 09:10:40', '2022-12-22 04:01:31'),
(23, 'PGRC', 'පැළෑටි ජාන සම්පත් මධ්‍යස්ථානය', 0, '2023-01-10 03:51:41', '2023-01-10 03:51:41'),
(28, 'SCS', 'බීජ සහතික කිරීමේ සේවය', 14, '2023-01-13 05:25:28', '2023-01-13 05:25:28'),
(29, 'ADMIN', 'Administrative Office', 0, '2023-03-29 06:26:59', '2023-03-29 06:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ot_list`
--

CREATE TABLE `ot_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ot_list_status`
--

CREATE TABLE `ot_list_status` (
  `id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `ot_range` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `L1` tinyint(1) NOT NULL DEFAULT 0,
  `L2` tinyint(1) NOT NULL DEFAULT 0,
  `L3` tinyint(1) NOT NULL DEFAULT 0,
  `L4` tinyint(1) NOT NULL DEFAULT 0,
  `L5` tinyint(1) NOT NULL DEFAULT 0,
  `L6` tinyint(1) NOT NULL DEFAULT 0,
  `L7` tinyint(1) NOT NULL DEFAULT 0,
  `L8` tinyint(1) NOT NULL DEFAULT 0,
  `L9` tinyint(1) NOT NULL DEFAULT 0,
  `L10` tinyint(1) NOT NULL DEFAULT 0,
  `L11` tinyint(1) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `test` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ot_records`
--

CREATE TABLE `ot_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `List_id` int(11) NOT NULL,
  `Emp_id` int(11) NOT NULL,
  `ot_range` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Nature_of_duties` text DEFAULT NULL,
  `suggest_ot_hour` int(11) DEFAULT NULL,
  `director_rec_ot_hour` int(11) DEFAULT NULL,
  `director_admin_rec_ot_hour` int(11) DEFAULT NULL,
  `previuos_approved_hours` int(11) NOT NULL DEFAULT 0,
  `mark` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `test` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1nS9JOYrMlBWRuqiQ9YkOpoH1SB26xkDUpJTexCK', 48, '103.11.33.250', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/112.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibEhTZzdOWnR4c3NkR3RtMjNIYlpmWXM4Y1d5RUUwT3psM0h0cHRZNyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwczovL3JvcC53M2R0ZWMubmV0L290bGlzdC8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDg7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkSFV3anFrUUZaVlpGRXZEaXppeDNTdTljU1FwWlRoR1ptU0NSVnRMRjMuZ1pXUTFMZ0YyQ1ciO3M6MTI6Im5vdGlmaWNhdGlvbiI7czoxOiIxIjt9', 1681964153),
('PFHdn8Zeyo1S3u6hl2u7DvcSI8Avi8L1azvuGfVR', 1, '124.43.17.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidEdiNXFHMWFNSjlxS1JqYjl0SmVBemlhQnh4T24zWmNRcVJBNXhlNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwczovL3JvcC53M2R0ZWMubmV0L21hbmFnZXVzZXIiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJHVqcUdtRlJuQU1XL2NBb2JvalVVVC4wOUxoOW1IUGZ3Tkc1VFgyN25zTzNxdU1tMlRoMzVtIjtzOjEyOiJub3RpZmljYXRpb24iO3M6MToiMSI7fQ==', 1681964940);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_chart`
--

INSERT INTO `temp_chart` (`id`, `month`, `value`, `created_at`, `updated_at`) VALUES
(1, 'January', 0, '2022-11-21 08:41:00', '2023-04-19 08:53:32'),
(2, 'February', 0, '2022-11-21 08:41:00', '2023-04-19 08:53:32'),
(3, 'March', 0, '2022-11-21 08:41:22', '2023-04-19 08:53:32'),
(4, 'April', 0, '2022-11-21 08:41:22', '2022-11-22 03:42:52'),
(5, 'May', 0, '2022-11-21 08:41:49', '2022-11-21 08:41:49'),
(6, 'June', 0, '2022-11-21 08:41:49', '2022-11-21 08:41:49'),
(7, 'July', 0, '2022-11-21 08:41:56', '2022-11-21 08:41:56'),
(8, 'August', 0, '2022-11-21 08:41:56', '2022-11-21 08:41:56'),
(9, 'September', 0, '2022-11-21 08:42:04', '2022-11-21 08:42:04'),
(10, 'October', 0, '2022-11-21 08:42:04', '2022-11-21 08:42:04'),
(11, 'November', 0, '2022-11-21 08:42:11', '2022-11-21 08:42:11'),
(12, 'December', 0, '2022-11-21 08:42:11', '2023-01-19 04:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `institute` int(11) NOT NULL DEFAULT 0,
  `signature` text DEFAULT NULL,
  `designation_id` int(11) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `institute`, `signature`, `designation_id`, `user_level`, `email`, `status`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 29, NULL, 8, 1, 'admin@gmail.com', 1, NULL, '$2y$10$ujqGmFRnAMW/cAobojUUT.09Lh9mHPfwNG5TX27nsO3quMm2Th35m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_designation`
--

CREATE TABLE `user_designation` (
  `id` int(11) NOT NULL,
  `designation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 'Chief Engineer '),
(8, 'Administrator'),
(9, 'Additional Director General'),
(10, 'Director - Admin'),
(11, 'Assistant Director');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_level` int(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
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
(7, 7, 'Administrative Officer / Chief Clerk (Director-Office)', NULL, NULL),
(8, 8, 'Subject Officer (Director-Office)', NULL, NULL),
(9, 9, 'AD/DD (Sub Institute)', NULL, NULL),
(10, 10, 'Administrative Officer / Chief Clerk (Sub Institute)', NULL, NULL),
(11, 11, 'Subject Officer (Sub Institute)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_employees`
--

CREATE TABLE `_employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_no` int(11) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` int(255) NOT NULL,
  `institute` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_designation`
--
ALTER TABLE `emp_designation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institute_id` (`institute_id`(191)),
  ADD KEY `institute_id_2` (`institute_id`(191));

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`(191),`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_chart`
--
ALTER TABLE `temp_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_designation`
--
ALTER TABLE `emp_designation`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `minutes`
--
ALTER TABLE `minutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_list`
--
ALTER TABLE `ot_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_list_status`
--
ALTER TABLE `ot_list_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_records`
--
ALTER TABLE `ot_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_designation`
--
ALTER TABLE `user_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `_employees`
--
ALTER TABLE `_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
