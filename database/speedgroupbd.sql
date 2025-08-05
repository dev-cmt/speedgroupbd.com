-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 08:52 PM
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
-- Database: `speedgroupbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `url_slug` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('published','draft') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_shares`
--

CREATE TABLE `blog_shares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shared_to` varchar(255) NOT NULL,
  `shared_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_views`
--

CREATE TABLE `blog_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `view_count` int(11) NOT NULL,
  `last_viewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
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
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cover` text DEFAULT NULL,
  `drive_url` varchar(255) DEFAULT NULL,
  `public` tinyint(1) DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_08_27_075954_create_sessions_table', 1),
(7, '2022_09_08_043923_create_permission_tables', 1),
(8, '2023_06_01_100000_create_contacts_table', 1),
(9, '2023_08_09_100001_create_galleries_table', 1),
(10, '2023_08_09_100002_create_gallery_images_table', 1),
(11, '2024_08_13_062049_create_blog_posts_table', 1),
(12, '2024_08_13_062126_create_blog_comments_table', 1),
(13, '2024_08_13_062211_create_blog_views_table', 1),
(14, '2024_08_13_062245_create_blog_shares_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Member menu access', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(2, 'Payment menu access', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(3, 'Post menu access', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(4, 'Setting menu access', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(5, 'Member access', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(6, 'Member edit', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(7, 'Member view', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(8, 'Member delete', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55'),
(9, 'Member approve access', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(10, 'Member approved', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(11, 'Member approve record', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(12, 'CommitteeType access', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(13, 'CommitteeType create', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(14, 'CommitteeType edit', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(15, 'CommitteeType view', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(16, 'CommitteeType delete', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(17, 'MemberType access', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(18, 'MemberType create', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(19, 'MemberType edit', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(20, 'MemberType view', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(21, 'MemberType delete', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(22, 'Qualification access', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(23, 'Qualification create', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(24, 'Qualification edit', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(25, 'Qualification view', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(26, 'Qualification delete', 'web', '2025-08-05 11:48:56', '2025-08-05 11:48:56'),
(27, 'Annual fees access', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(28, 'Annual fees approved', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(29, 'Annual fees record', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(30, 'Event fees access', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(31, 'Event fees approved', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(32, 'Event fees record', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(33, 'Membership fees access', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(34, 'Membership fees approved', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(35, 'Membership fees record', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(36, 'Pyment number access', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(37, 'Pyment number create', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(38, 'Pyment number edit', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(39, 'Pyment number view', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(40, 'Pyment number delete', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(41, 'Pyment fees access', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(42, 'Pyment annual fees', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(43, 'Pyment membership fees', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(44, 'Past access', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(45, 'Past create', 'web', '2025-08-05 11:48:57', '2025-08-05 11:48:57'),
(46, 'Past edit', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(47, 'Past delete', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(48, 'Past member access', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(49, 'Renew member access', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(50, 'Gallery access', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(51, 'Gallery create', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(52, 'Gallery edit', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(53, 'Gallery delete', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(54, 'Blog access', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(55, 'Blog create', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(56, 'Blog edit', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(57, 'Blog delete', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(58, 'Event access', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(59, 'Event create', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(60, 'Event edit', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(61, 'Event delete', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(62, 'Contact access', 'web', '2025-08-05 11:48:58', '2025-08-05 11:48:58'),
(63, 'Contact reply', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(64, 'Contact delete', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(65, 'Role access', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(66, 'Role create', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(67, 'Role edit', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(68, 'Role delete', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(69, 'User access', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(70, 'User create', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(71, 'User edit', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(72, 'User delete', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(73, 'Super-Admin', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(74, 'Admin', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(75, 'Member', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(76, 'Data Setting', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(77, 'Student Member', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(78, 'Candidate Member', 'web', '2025-08-05 11:48:59', '2025-08-05 11:48:59'),
(79, 'Professional Member', 'web', '2025-08-05 11:49:00', '2025-08-05 11:49:00'),
(80, 'Associate Member', 'web', '2025-08-05 11:49:00', '2025-08-05 11:49:00'),
(81, 'Trade Member', 'web', '2025-08-05 11:49:00', '2025-08-05 11:49:00'),
(82, 'Corporate Member', 'web', '2025-08-05 11:49:00', '2025-08-05 11:49:00');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 'web', '2025-08-05 11:48:55', '2025-08-05 11:48:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1);

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
('Jg9PQX5sZEQT9EtTsva5b4oZy2eagLzgT9m5kUgX', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjFqNk5FTTR3VWJvSVdSam9GQmtIMkdZcDBRNkxubHVkdUdYUkZtRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLXNwZWVkZ3JvdXBiZC9wYWNrYWdlLWRldGFpbHMtbXVsdGljaXR5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1754419702);

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
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `index` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `profile_photo_path`, `status`, `is_admin`, `index`, `created_at`, `updated_at`) VALUES
(1, 'BAFIITA', 'Admin', '2025-08-05 11:48:55', '$2y$12$GBGNLOdB4J5WSdHqIO/XveF8hF/O8rveXsDEDiTK.00Cr8wwvDX0i', NULL, NULL, NULL, NULL, 'fix/admin.jpg', 1, 1, NULL, '2025-08-05 11:48:55', '2025-08-05 11:48:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comments_blog_post_id_foreign` (`blog_post_id`),
  ADD KEY `blog_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_url_slug_unique` (`url_slug`),
  ADD KEY `blog_posts_author_id_index` (`author_id`),
  ADD KEY `blog_posts_title_index` (`title`);

--
-- Indexes for table `blog_shares`
--
ALTER TABLE `blog_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_shares_blog_post_id_foreign` (`blog_post_id`),
  ADD KEY `blog_shares_user_id_foreign` (`user_id`);

--
-- Indexes for table `blog_views`
--
ALTER TABLE `blog_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_views_blog_post_id_foreign` (`blog_post_id`),
  ADD KEY `blog_views_user_id_foreign` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_user_id_foreign` (`user_id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_shares`
--
ALTER TABLE `blog_shares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_views`
--
ALTER TABLE `blog_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_blog_post_id_foreign` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_posts` (`id`),
  ADD CONSTRAINT `blog_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_shares`
--
ALTER TABLE `blog_shares`
  ADD CONSTRAINT `blog_shares_blog_post_id_foreign` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_posts` (`id`),
  ADD CONSTRAINT `blog_shares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `blog_views`
--
ALTER TABLE `blog_views`
  ADD CONSTRAINT `blog_views_blog_post_id_foreign` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_posts` (`id`),
  ADD CONSTRAINT `blog_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
