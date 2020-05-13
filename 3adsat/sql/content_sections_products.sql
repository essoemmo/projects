-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 09:06 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3adsat`
--

-- --------------------------------------------------------

--
-- Table structure for table `content_sections_products`
--

CREATE TABLE `content_sections_products` (
  `id` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_sections_products`
--

INSERT INTO `content_sections_products` (`id`, `product_id`, `section_id`) VALUES
(21, 142, 1),
(22, 154, 1),
(23, 155, 1),
(24, 156, 1),
(25, 157, 1),
(31, 148, 2),
(32, 149, 2),
(33, 150, 2),
(34, 152, 3),
(35, 153, 3),
(36, 156, 3),
(37, 160, 3),
(38, 185, 3),
(39, 187, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_fk` (`product_id`),
  ADD KEY `section_id_fk` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  ADD CONSTRAINT `product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `section_id_fk` FOREIGN KEY (`section_id`) REFERENCES `content_sections` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
