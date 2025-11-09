-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2025 at 10:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_management_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'HR', NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11'),
(2, 'Finance', NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11'),
(3, 'Engineering', NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11'),
(4, 'Marketing', NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11'),
(5, 'Support', NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `department_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Camryn', 'O\'Connell', 'aileen06@example.net', 3, 1, NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11'),
(2, 'Conrad', 'Gaylord', 'lizeth.barton@example.net', 4, 1, NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11'),
(3, 'Kamryn', 'Ritchie', 'maximus52@example.org', 2, 1, NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11'),
(4, 'Oleta', 'Kling', 'sokuneva@example.net', 2, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(5, 'Tressie', 'Ferry', 'eloy15@example.net', 2, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(6, 'Mazie', 'Stroman', 'claud51@example.com', 2, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(7, 'Loyal', 'Gulgowski', 'lauretta39@example.net', 5, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(8, 'Halie', 'Grant', 'farrell.moses@example.com', 4, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(9, 'Horace', 'Reichert', 'bklocko@example.net', 4, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(10, 'Ellsworth', 'Brakus', 'magdalen54@example.net', 2, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(11, 'Ransom', 'Boyer', 'jackson.schuster@example.org', 1, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(12, 'Danial', 'Erdman', 'olebsack@example.net', 1, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(13, 'Norberto', 'Collins', 'afton.gutkowski@example.net', 3, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(14, 'Allen', 'Romaguera', 'rusty.cormier@example.com', 4, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(15, 'Gillian', 'Braun', 'werner77@example.net', 5, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(16, 'Miracle', 'Becker', 'granville.ullrich@example.org', 4, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(17, 'Arielle', 'Lueilwitz', 'lubowitz.fiona@example.net', 4, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(18, 'Elnora', 'Emmerich', 'witting.price@example.org', 3, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(19, 'Evangeline', 'Murazik', 'bogisich.lamar@example.com', 5, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(20, 'Mervin', 'Anderson', 'uokeefe@example.com', 1, 1, NULL, '2025-11-09 03:33:12', '2025-11-09 03:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `employee_addresses`
--

CREATE TABLE `employee_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `address_line` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(60) NOT NULL,
  `pincode` varchar(10) NOT NULL COMMENT 'Postal or ZIP code',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_addresses`
--

INSERT INTO `employee_addresses` (`id`, `employee_id`, `address_line`, `city`, `state`, `pincode`, `created_at`, `updated_at`) VALUES
(1, 1, '934 Gutmann Branch', 'New Willie', 'Delaware', '353176', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(2, 1, '82333 Kemmer Burg', 'New Jerrodland', 'Connecticut', '591842', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(3, 2, '582 Emery Freeway', 'Skilesside', 'District of Columbia', '772898', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(4, 3, '842 Franz Parks Apt. 606', 'Lake Della', 'Minnesota', '204628', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(5, 3, '62344 Balistreri Falls', 'Lake Alvertaport', 'Louisiana', '736241', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(6, 4, '71585 Watsica Spring Suite 830', 'Labadieberg', 'New Mexico', '038734', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(7, 4, '99355 Henry Haven', 'North Eliane', 'North Dakota', '229591', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(8, 5, '520 Feest Lake', 'East Jettie', 'Delaware', '679484', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(9, 5, '399 Zemlak Dam Apt. 719', 'Janieborough', 'Alabama', '978759', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(10, 6, '340 Marquardt Mission', 'South Valentin', 'Minnesota', '486345', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(11, 7, '38713 Cullen Glens', 'Port Maribel', 'Arkansas', '118427', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(12, 8, '4541 Brianne Lodge', 'West Bret', 'South Dakota', '709876', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(13, 8, '73338 Elsa Gardens Suite 026', 'Valentinfurt', 'Kentucky', '273472', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(14, 9, '66044 Sierra Locks Suite 532', 'North Bennie', 'Michigan', '380973', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(15, 10, '982 Alycia Stravenue', 'Trantowport', 'Massachusetts', '571418', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(16, 11, '4078 Elvie Greens', 'Corkeryhaven', 'Oklahoma', '776681', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(17, 12, '556 Klein Green Suite 338', 'North Gustborough', 'Vermont', '512790', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(18, 13, '59751 Alba Ferry Suite 600', 'Lednerfurt', 'Illinois', '600658', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(19, 14, '2127 Bruce Loop Suite 710', 'Faheyland', 'Kentucky', '920046', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(20, 15, '22542 Stephania Prairie Suite 831', 'Madgeside', 'New Hampshire', '366468', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(21, 15, '91485 Borer Station Suite 513', 'North Rachel', 'Iowa', '037838', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(22, 16, '682 Anahi Drive Apt. 563', 'Turcotteborough', 'New Hampshire', '621337', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(23, 17, '86434 Nicola Junction Suite 425', 'Ramiromouth', 'California', '988479', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(24, 18, '32317 Block Plain Suite 046', 'Elroyfurt', 'Massachusetts', '757605', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(25, 18, '640 Cummings Courts Apt. 334', 'Lake Kraigmouth', 'Nevada', '387044', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(26, 19, '26975 Schimmel Point Apt. 902', 'Lake Candace', 'Missouri', '764203', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(27, 19, '81853 Kaleigh Walks', 'South Victorview', 'Rhode Island', '405342', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(28, 20, '9677 Kyla Islands Apt. 673', 'North Laney', 'Montana', '161713', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(29, 20, '25483 Ayana Stream', 'Jerdeton', 'Rhode Island', '021573', '2025-11-09 03:33:12', '2025-11-09 03:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `employee_contacts`
--

CREATE TABLE `employee_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `contact_number` varchar(15) NOT NULL COMMENT 'Employee contact number including country code if applicable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_contacts`
--

INSERT INTO `employee_contacts` (`id`, `employee_id`, `contact_number`, `created_at`, `updated_at`) VALUES
(1, 1, '+912363469204', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(2, 1, '+915405212704', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(3, 2, '+910110243194', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(4, 3, '+915669988959', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(5, 4, '+918902734849', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(6, 4, '+915622452456', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(7, 5, '+911834454555', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(8, 5, '+910507537408', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(9, 6, '+910707906257', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(10, 6, '+913439949528', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(11, 6, '+919239093274', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(12, 7, '+914679480134', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(13, 7, '+912103759312', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(14, 7, '+914008355094', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(15, 8, '+918697585241', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(16, 8, '+914280096147', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(17, 8, '+911450221906', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(18, 9, '+913977187271', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(19, 9, '+910162157180', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(20, 9, '+916939271867', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(21, 10, '+916681133413', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(22, 10, '+911831257649', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(23, 11, '+918307866011', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(24, 11, '+912343570457', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(25, 12, '+916481247855', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(26, 12, '+918667001397', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(27, 12, '+917837812996', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(28, 13, '+916290877090', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(29, 14, '+916798389322', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(30, 14, '+917017529098', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(31, 15, '+919948834003', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(32, 16, '+915343795276', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(33, 16, '+919451342471', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(34, 16, '+917376820379', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(35, 17, '+919344926372', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(36, 17, '+912165780354', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(37, 17, '+916465114695', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(38, 18, '+919905342221', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(39, 19, '+918765901687', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(40, 19, '+915515144775', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(41, 19, '+917179355509', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(42, 20, '+911869256732', '2025-11-09 03:33:12', '2025-11-09 03:33:12'),
(43, 20, '+910124387176', '2025-11-09 03:33:12', '2025-11-09 03:33:12');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_08_163828_create_departments_table', 1),
(5, '2025_11_08_163843_create_employees_table', 1),
(6, '2025_11_08_163851_create_employee_contacts_table', 1),
(7, '2025_11_08_163902_create_employee_addresses_table', 1),
(8, '2025_11_08_173535_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dummy User', 'test@gmail.com', NULL, '$2y$12$hNHFDXmXUy4Rogh5LnkBZeQ5ueC3SrgX4ABRYeztUZAWytTrAGPP.', NULL, '2025-11-09 03:33:11', '2025-11-09 03:33:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_user_id_foreign` (`user_id`),
  ADD KEY `employees_first_name_index` (`first_name`),
  ADD KEY `employees_last_name_index` (`last_name`);

--
-- Indexes for table `employee_addresses`
--
ALTER TABLE `employee_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_addresses_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_addresses_city_index` (`city`),
  ADD KEY `employee_addresses_state_index` (`state`),
  ADD KEY `employee_addresses_pincode_index` (`pincode`);

--
-- Indexes for table `employee_contacts`
--
ALTER TABLE `employee_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_contacts_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_contacts_contact_number_index` (`contact_number`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee_addresses`
--
ALTER TABLE `employee_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee_contacts`
--
ALTER TABLE `employee_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_addresses`
--
ALTER TABLE `employee_addresses`
  ADD CONSTRAINT `employee_addresses_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_contacts`
--
ALTER TABLE `employee_contacts`
  ADD CONSTRAINT `employee_contacts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
