-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Dec 17, 2025 at 01:46 PM
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
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('benefit','cost') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cost',
  `unit` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `code`, `name`, `type`, `unit`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'C1', 'Harga OTR Jakarta', 'cost', 'Rp', 'Harga On The Road di Jakarta (semakin rendah semakin baik)', 1, '2025-12-17 11:20:33', '2025-12-17 11:20:33'),
(2, 'C2', 'Daya Maksimum', 'benefit', 'kW', 'Daya maksimum mesin (semakin tinggi semakin baik)', 1, '2025-12-17 11:20:33', '2025-12-17 11:20:33'),
(3, 'C3', 'Torsi Maksimum', 'benefit', 'Nm', 'Torsi puncak mesin (semakin tinggi semakin baik)', 1, '2025-12-17 11:20:33', '2025-12-17 11:20:33'),
(4, 'C4', 'Berat Isi', 'cost', 'kg', 'Berat kendaraan (semakin ringan semakin baik)', 1, '2025-12-17 11:20:33', '2025-12-17 11:20:33'),
(5, 'C5', 'Kapasitas Tangki', 'benefit', 'L', 'Kapasitas tangki bensin (semakin besar semakin baik)', 1, '2025-12-17 11:20:33', '2025-12-17 11:20:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `criteria_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
