-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Dec 17, 2025 at 01:47 PM
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
-- Table structure for table `alternative_values`
--

CREATE TABLE `alternative_values` (
  `id` bigint UNSIGNED NOT NULL,
  `alternative_id` bigint UNSIGNED NOT NULL,
  `criteria_id` bigint UNSIGNED NOT NULL,
  `value` decimal(20,6) NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternative_values`
--

INSERT INTO `alternative_values` (`id`, `alternative_id`, `criteria_id`, `value`, `notes`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 46095000.000000, 'Harga OTR Jakarta', '2025-12-17 12:38:02', '2025-12-17 12:38:02'),
(3, 1, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:38:02', '2025-12-17 12:38:02'),
(4, 1, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:38:02', '2025-12-17 12:38:02'),
(5, 1, 4, 135.000000, 'Berat isi kendaraan', '2025-12-17 12:38:02', '2025-12-17 12:38:02'),
(6, 1, 5, 7.100000, 'Kapasitas tangki bensin', '2025-12-17 12:38:02', '2025-12-17 12:38:02'),
(7, 2, 1, 44115000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(8, 2, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(9, 2, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(10, 2, 4, 135.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(11, 2, 5, 7.100000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(12, 3, 1, 38615000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(13, 3, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(14, 3, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(15, 3, 4, 135.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(16, 3, 5, 7.100000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(17, 4, 1, 34405000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(18, 4, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(19, 4, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(20, 4, 4, 135.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(21, 4, 5, 7.100000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(22, 5, 1, 33415000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(23, 5, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(24, 5, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(25, 5, 4, 135.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(26, 5, 5, 7.100000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(27, 6, 1, 41730000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(28, 6, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(29, 6, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(30, 6, 4, 130.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(31, 6, 5, 5.500000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(32, 7, 1, 39550000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(33, 7, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(34, 7, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(35, 7, 4, 130.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(36, 7, 5, 5.500000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(37, 8, 1, 33990000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(38, 8, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(39, 8, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(40, 8, 4, 130.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(41, 8, 5, 5.500000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(42, 9, 1, 29900000.000000, 'Harga OTR Jakarta', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(43, 9, 2, 11.300000, 'Daya maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(44, 9, 3, 14.200000, 'Torsi maksimum mesin', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(45, 9, 4, 130.000000, 'Berat isi kendaraan', '2025-12-17 12:39:23', '2025-12-17 12:39:23'),
(46, 9, 5, 5.500000, 'Kapasitas tangki bensin', '2025-12-17 12:39:23', '2025-12-17 12:39:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternative_values`
--
ALTER TABLE `alternative_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alt_crit_unique` (`alternative_id`,`criteria_id`),
  ADD KEY `alternative_values_criteria_id_index` (`criteria_id`),
  ADD KEY `alternative_values_alternative_id_index` (`alternative_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternative_values`
--
ALTER TABLE `alternative_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternative_values`
--
ALTER TABLE `alternative_values`
  ADD CONSTRAINT `alternative_values_alternative_id_foreign` FOREIGN KEY (`alternative_id`) REFERENCES `alternatives` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alternative_values_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criteria` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
