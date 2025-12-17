-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Dec 17, 2025 at 12:31 PM
-- Server version: 8.0.32
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatives`
--

CREATE TABLE `alternatives` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('matic','maxi series','classy','sport','offroad','moped') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'matic',
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` year DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatives`
--

INSERT INTO `alternatives` (`id`, `code`, `type`, `name`, `model`, `year`, `description`, `created_at`, `updated_at`) VALUES
(1, 'A1', 'maxi series', 'Yamaha NMAX', '\"TURBO\" TECH MAX Ultimate', '2025', 'Yamaha NMAX variant \"TURBO\" TECH MAX Ultimate', '2025-12-17 11:57:55', '2025-12-17 11:57:55'),
(2, 'A2', 'maxi series', 'Yamaha NMAX', '\"TURBO\" TECH MAX', '2025', 'Yamaha NMAX varian \"TURBO\" TECH MAX', '2025-12-17 12:12:01', '2025-12-17 12:12:01'),
(3, 'A3', 'maxi series', 'Yamaha NMAX', 'Turbo', '2025', 'Yamaha NMAX varian Turbo', '2025-12-17 12:13:29', '2025-12-17 12:13:29'),
(4, 'A4', 'maxi series', 'Yamaha NMAX', 'Neo S Version', '2025', 'Yamaha NMAX varian Neo S Version', '2025-12-17 12:14:24', '2025-12-17 12:14:24'),
(5, 'A5', 'maxi series', 'Yamaha NMAX', 'Neo Version', '2025', 'Yamaha NMAX varian Neo Version', '2025-12-17 12:15:08', '2025-12-17 12:15:08'),
(6, 'A6', 'maxi series', 'Yamaha Aerox', 'TURBO Ultimate', '2025', 'Yamaha Aerox varian TURBO Ultimate', '2025-12-17 12:16:49', '2025-12-17 12:16:49'),
(7, 'A7', 'maxi series', 'Yamaha Aerox', 'TURBO', '2025', 'Yamaha Aerox varian TURBO', '2025-12-17 12:18:02', '2025-12-17 12:18:02'),
(8, 'A8', 'maxi series', 'Yamaha Aerox', 'CyberCity', '2025', 'Yamaha Aerox varian CyberCity', '2025-12-17 12:18:59', '2025-12-17 12:18:59'),
(9, 'A9', 'maxi series', 'Yamaha Aerox', 'Standard', '2025', 'Yamaha Aerox varian Standard', '2025-12-17 12:19:47', '2025-12-17 12:19:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatives`
--
ALTER TABLE `alternatives`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alternatives_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatives`
--
ALTER TABLE `alternatives`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
