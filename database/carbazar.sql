-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2015 at 03:09 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carbazar`
--

-- --------------------------------------------------------

--
-- Table structure for table `scb_common_attributes`
--

CREATE TABLE IF NOT EXISTS `scb_common_attributes` (
  `id` int(10) unsigned NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type` enum('product','page','brand','model','varient','feature_category','feature') COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '1001',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '1001',
  `depth` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scb_migrations`
--

CREATE TABLE IF NOT EXISTS `scb_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scb_password_resets`
--

CREATE TABLE IF NOT EXISTS `scb_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scb_users`
--

CREATE TABLE IF NOT EXISTS `scb_users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scb_vehicle`
--

CREATE TABLE IF NOT EXISTS `scb_vehicle` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `varient_id` int(10) unsigned NOT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_by` int(10) unsigned NOT NULL DEFAULT '1001',
  `updated_by` int(10) unsigned NOT NULL DEFAULT '1001',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scb_common_attributes`
--
ALTER TABLE `scb_common_attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `common_attributes_name_unique` (`name`,`parent_id`) USING BTREE,
  ADD KEY `common_attributes_parent_id_index` (`parent_id`),
  ADD KEY `common_attributes_lft_index` (`lft`),
  ADD KEY `common_attributes_rgt_index` (`rgt`);

--
-- Indexes for table `scb_password_resets`
--
ALTER TABLE `scb_password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `scb_users`
--
ALTER TABLE `scb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `scb_vehicle`
--
ALTER TABLE `scb_vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_varient_id_foreign` (`varient_id`),
  ADD KEY `vehicle_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scb_common_attributes`
--
ALTER TABLE `scb_common_attributes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scb_users`
--
ALTER TABLE `scb_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scb_vehicle`
--
ALTER TABLE `scb_vehicle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `scb_vehicle`
--
ALTER TABLE `scb_vehicle`
  ADD CONSTRAINT `vehicle_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `scb_common_attributes` (`id`),
  ADD CONSTRAINT `vehicle_varient_id_foreign` FOREIGN KEY (`varient_id`) REFERENCES `scb_common_attributes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
