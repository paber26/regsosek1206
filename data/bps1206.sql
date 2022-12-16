-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 06:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bps1206`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'paber26', NULL, '2022-12-14 19:38:01', 0),
(2, '::1', 'bernaldo.stis@gmail.com', NULL, '2022-12-14 19:38:08', 0),
(3, '::1', 'paber26', NULL, '2022-12-14 19:39:33', 0),
(4, '::1', 'bernaldo.stis@gmail.com', 1, '2022-12-14 19:39:58', 1),
(5, '::1', 'bernaldo.stis@gmail.com', 1, '2022-12-15 16:29:24', 1),
(6, '::1', 'bernaldo.stis@gmail.com', 1, '2022-12-15 21:44:02', 1),
(7, '::1', 'bernaldo.n70@gmail.com', NULL, '2022-12-15 21:57:55', 0),
(8, '::1', 'bernaldo.n70@gmail.com', NULL, '2022-12-15 21:58:08', 0),
(9, '::1', 'bernaldo.n70@gmail.com', NULL, '2022-12-15 22:00:37', 0),
(10, '::1', 'paber26', NULL, '2022-12-15 22:00:59', 0),
(11, '::1', 'paber26', NULL, '2022-12-15 22:01:18', 0),
(12, '::1', 'paber26', NULL, '2022-12-15 22:01:20', 0),
(13, '::1', 'paber26', NULL, '2022-12-15 22:05:36', 0),
(14, '::1', 'paber26', NULL, '2022-12-15 22:05:42', 0),
(15, '::1', 'imutpororo77@gmail.com', 3, '2022-12-15 22:07:03', 1),
(16, '::1', 'pororo', NULL, '2022-12-15 22:08:07', 0),
(17, '::1', 'pororo', NULL, '2022-12-15 22:10:29', 0),
(18, '::1', 'pororo', NULL, '2022-12-15 22:10:34', 0),
(19, '::1', 'pororo', NULL, '2022-12-15 22:10:55', 0),
(20, '::1', 'pororo', NULL, '2022-12-15 22:17:39', 0),
(21, '::1', 'pororo', NULL, '2022-12-15 22:18:03', 0),
(22, '::1', 'pororo', NULL, '2022-12-15 22:18:31', 0),
(23, '::1', '221810213@stis.ac.id', 4, '2022-12-15 22:18:56', 1),
(24, '::1', 'imutpororo77@gmail.com', 3, '2022-12-15 22:20:46', 1),
(25, '::1', 'bernaldo.n@gmail.com', 6, '2022-12-15 22:37:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1671059784, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `email` varchar(100) NOT NULL,
  `rekening` varchar(25) NOT NULL,
  `nomor_rekening` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `wa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'bernaldo.stis@gmail.com', 'paber26', '$2y$10$oUQWAgdNlVZ5ZEdlYIZCZedWVy6L5KIe7FLm4WS2.zvDc/ZBg5lji', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-12-14 19:39:56', '2022-12-14 19:39:56', NULL),
(2, 'bernaldo.n70@gmail.com', 'bernaldo.n70@gmail.com', '$2y$10$WT/YNj0Cwf9HX1Q8yM9kvOCDW9.eagDL6CZs93ChaIFxXzQuTmsrC', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(3, 'imutpororo77@gmail.com', 'pororo', '$2y$10$prRs9ey35.dZOy.yX2qDMePcnTsFEIE587ygA7fsz/NBQZWLytvSK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-12-15 22:06:57', '2022-12-15 22:06:57', NULL),
(4, '221810213@stis.ac.id', '2213', '$2y$10$E7qypaSqdCzX9MMTT05iDuKJ5eZRSrsDR.mGU.OixTKte5PH/gFkq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-12-15 22:18:52', '2022-12-15 22:18:52', NULL),
(6, 'bernaldo.n@gmail.com', 'bernaldo.n@gmail.com', '$2y$10$bokYfoqdtvlZ2uqUvV2FmuK.eCzVmbhRqs8z37t14GtK76JpKuNFG', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
