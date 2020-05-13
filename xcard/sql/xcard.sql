-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 02:45 PM
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
-- Database: `xcard`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs_products`
--

CREATE TABLE `blogs_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blog_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs_tags`
--

CREATE TABLE `blogs_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag_id` int(10) UNSIGNED DEFAULT NULL,
  `blog_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories_translations`
--

CREATE TABLE `blog_categories_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blog_category_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blog_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `main_menu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `parent_id`, `main_menu`) VALUES
(1, '2019-11-28 05:31:32', '2019-11-28 05:31:32', NULL, 1),
(2, '2019-11-28 05:32:20', '2019-11-28 05:32:20', NULL, 1),
(3, '2019-11-28 05:32:53', '2019-11-28 05:32:53', NULL, 1),
(4, '2019-11-28 05:33:30', '2019-11-28 05:33:30', NULL, 1),
(5, '2019-11-28 05:35:14', '2019-11-28 05:35:14', NULL, 1),
(6, '2019-11-28 05:38:10', '2019-11-28 05:38:10', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories_translations`
--

CREATE TABLE `categories_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories_translations`
--

INSERT INTO `categories_translations` (`id`, `created_at`, `updated_at`, `category_id`, `title`, `description`, `locale`) VALUES
(1, NULL, NULL, 1, 'العاب', 'العاب', 'ar'),
(2, NULL, NULL, 1, 'games', 'Games', 'en'),
(3, NULL, NULL, 2, 'بطاقات هدايا', 'بطاقات هدايا', 'ar'),
(4, NULL, NULL, 2, 'Gift Cards', 'Gift Cards', 'en'),
(5, NULL, NULL, 3, 'نقاط العاب', 'نقاط العاب', 'ar'),
(6, NULL, NULL, 3, 'Game Points', 'Game Points', 'en'),
(7, NULL, NULL, 4, 'اكس بوكس', 'اكس بوكس', 'ar'),
(8, NULL, NULL, 4, 'Xbox', 'Xbox', 'en'),
(9, NULL, NULL, 5, 'بلاي ستيشن', 'بلاي ستيشن', 'ar'),
(10, NULL, NULL, 5, 'PSN', 'PSN', 'en'),
(11, NULL, NULL, 6, 'نينتيندو', 'نينتيندو', 'ar'),
(12, NULL, NULL, 6, 'Nintendo', 'Nintendo', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `content_sections`
--

CREATE TABLE `content_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` tinyint(4) NOT NULL,
  `columns` tinyint(4) NOT NULL,
  `type` enum('home','footer') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_sections_products`
--

CREATE TABLE `content_sections_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content_section_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_sections_translations`
--

CREATE TABLE `content_sections_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content_section_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `logo`, `code`, `created_at`, `updated_at`) VALUES
(1, '/uploads/country/1/1574941441.png', 'eg', '2019-11-28 09:44:01', '2019-11-28 09:44:01'),
(2, '/uploads/country/2/1574941472.png', 'ksa', '2019-11-28 09:44:32', '2019-11-28 09:44:32'),
(3, '/uploads/country/3/1574941496.png', 'usa', '2019-11-28 09:44:56', '2019-11-28 09:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `countries_regions`
--

CREATE TABLE `countries_regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries_translations`
--

CREATE TABLE `countries_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries_translations`
--

INSERT INTO `countries_translations` (`id`, `created_at`, `updated_at`, `country_id`, `title`, `locale`) VALUES
(1, '2019-11-28 09:44:01', '2019-11-28 09:44:01', 1, 'مصر', 'ar'),
(2, '2019-11-28 09:44:01', '2019-11-28 09:44:01', 1, 'Egypt', 'en'),
(3, '2019-11-28 09:44:32', '2019-11-28 09:44:32', 2, 'السعودية', 'ar'),
(4, '2019-11-28 09:44:32', '2019-11-28 09:44:32', 2, 'Saudi Arabia', 'en'),
(5, '2019-11-28 09:44:56', '2019-11-28 09:44:56', 3, 'الولايات المتحده', 'ar'),
(6, '2019-11-28 09:44:56', '2019-11-28 09:44:56', 3, 'United Status', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `created_at`, `updated_at`, `country_id`) VALUES
(1, '2019-11-28 09:48:03', '2019-11-28 09:48:03', 1),
(2, '2019-11-28 09:50:15', '2019-11-28 09:50:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `currencies_translation`
--

CREATE TABLE `currencies_translation` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies_translation`
--

INSERT INTO `currencies_translation` (`id`, `created_at`, `updated_at`, `title`, `code`, `currency_id`, `locale`) VALUES
(1, '2019-11-28 09:48:03', '2019-11-28 09:48:03', 'جنيه مصري', 'ج.م', 1, 'ar'),
(2, '2019-11-28 09:48:03', '2019-11-28 09:48:03', 'Egyptian Pound', 'EGP', 1, 'en'),
(3, '2019-11-28 09:50:15', '2019-11-28 09:50:15', 'ريال سعودي', 'ر.س', 2, 'ar'),
(4, '2019-11-28 09:50:15', '2019-11-28 09:50:15', 'Saudi Arabian Riyal', 'SAR', 2, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `currency_convertor`
--

CREATE TABLE `currency_convertor` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_convertor`
--

INSERT INTO `currency_convertor` (`id`, `code`, `rate`, `last_update`, `created_at`, `updated_at`) VALUES
(1, 'eg', 16.19, NULL, '2019-11-28 09:48:03', '2019-11-28 09:48:03'),
(2, 'ksa', 3.75, NULL, '2019-11-28 09:50:15', '2019-11-28 09:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double DEFAULT NULL,
  `count` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main` tinyint(4) NOT NULL DEFAULT 0,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fileable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `image`, `main`, `tag`, `fileable_id`, `fileable_type`, `created_at`, `updated_at`) VALUES
(1, '/uploads/products/1/1574936880Ld1NrkzKkv6z60GYLHxvCFdPt8mhXgHvrVo391W1qMM_1920x1080_1x-0.jpeg', 0, '1574936880Ld1NrkzKkv6z60GYLHxvCFdPt8mhXgHvrVo391W1qMM_1920x1080_1x-0.jpeg', 1, 'App\\Models\\Product', '2019-11-28 08:28:00', '2019-11-28 08:28:00'),
(2, '/uploads/products/1/157493688092I4YDzuleMqaJZliXlik4tCWp9bS2hU7f2H3vTfUVg_1920x1080_1x-0.jpeg', 0, '157493688092I4YDzuleMqaJZliXlik4tCWp9bS2hU7f2H3vTfUVg_1920x1080_1x-0.jpeg', 1, 'App\\Models\\Product', '2019-11-28 08:28:00', '2019-11-28 08:28:00'),
(3, '/uploads/products/1/1574936880sMggOp35Xv2GXnCAYZL6MuCK5WTMfBKPRTReDohzYGw_1920x1080_1x-0.jpeg', 0, '1574936880sMggOp35Xv2GXnCAYZL6MuCK5WTMfBKPRTReDohzYGw_1920x1080_1x-0.jpeg', 1, 'App\\Models\\Product', '2019-11-28 08:28:00', '2019-11-28 08:28:00'),
(4, '/uploads/products/1/1574936880MsY-YrLB7EZftF8FZy-RhTrCR_hjgrrG01SbmMTxvhA_1920x1080_1x-0.jpeg', 0, '1574936880MsY-YrLB7EZftF8FZy-RhTrCR_hjgrrG01SbmMTxvhA_1920x1080_1x-0.jpeg', 1, 'App\\Models\\Product', '2019-11-28 08:28:00', '2019-11-28 08:28:00'),
(5, '/uploads/products/1/1574936881xyIX0HT_1920x1080_1x-0.jpg', 0, '1574936881xyIX0HT_1920x1080_1x-0.jpg', 1, 'App\\Models\\Product', '2019-11-28 08:28:01', '2019-11-28 08:28:01'),
(6, '/uploads/products/1/1574936881DBX9dAH_1920x1080_1x-0.jpg', 0, '1574936881DBX9dAH_1920x1080_1x-0.jpg', 1, 'App\\Models\\Product', '2019-11-28 08:28:01', '2019-11-28 08:28:01'),
(9, '/uploads/products/1/1574939699Buy Red Dead Redemption 2 PC Rockstar Launcher key! - ENEBA.mkv', 1, '1574939699Buy Red Dead Redemption 2 PC Rockstar Launcher key! - ENEBA.mkv', 1, 'App\\Models\\Product', '2019-11-28 09:14:59', '2019-11-28 09:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `gamedetails_products`
--

CREATE TABLE `gamedetails_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `game_detail_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_details`
--

CREATE TABLE `game_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_details`
--

INSERT INTO `game_details` (`id`, `created_at`, `updated_at`, `image`) VALUES
(1, '2019-11-28 06:01:31', '2019-11-28 06:01:31', '/uploads/game_details/1/1574928091.svg'),
(2, '2019-11-28 06:08:40', '2019-11-28 06:08:40', '/uploads/game_details/2/1574928520.svg'),
(3, '2019-11-28 06:09:19', '2019-11-28 06:09:19', '/uploads/game_details/3/1574928559.svg'),
(4, '2019-11-28 06:09:39', '2019-11-28 06:09:39', '/uploads/game_details/4/1574928579.svg'),
(5, '2019-11-28 06:10:43', '2019-11-28 06:10:43', '/uploads/game_details/5/1574928643.svg'),
(6, '2019-11-28 06:11:13', '2019-11-28 06:11:13', '/uploads/game_details/6/1574928673.svg');

-- --------------------------------------------------------

--
-- Table structure for table `game_details_translations`
--

CREATE TABLE `game_details_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `game_detail_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game_details_translations`
--

INSERT INTO `game_details_translations` (`id`, `created_at`, `updated_at`, `game_detail_id`, `title`, `locale`) VALUES
(1, '2019-11-28 06:01:31', '2019-11-28 06:01:31', 1, 'Rates 18+ (Mature)', 'ar'),
(2, '2019-11-28 06:01:32', '2019-11-28 06:01:32', 1, 'Rates 18+ (Mature)', 'en'),
(3, '2019-11-28 06:08:40', '2019-11-28 06:08:40', 2, 'لاعب واحد', 'ar'),
(4, '2019-11-28 06:08:40', '2019-11-28 06:08:40', 2, 'Single-player', 'en'),
(5, '2019-11-28 06:09:19', '2019-11-28 06:09:19', 3, 'نتعدد', 'ar'),
(6, '2019-11-28 06:09:19', '2019-11-28 06:09:19', 3, 'Multiplayer', 'en'),
(7, '2019-11-28 06:09:39', '2019-11-28 06:09:39', 4, 'تعاون', 'ar'),
(8, '2019-11-28 06:09:39', '2019-11-28 06:09:39', 4, 'Co-op', 'en'),
(9, '2019-11-28 06:10:43', '2019-11-28 06:10:43', 5, 'منظور الشخص الثالث', 'ar'),
(10, '2019-11-28 06:10:43', '2019-11-28 06:10:43', 5, 'Third-person', 'en'),
(11, '2019-11-28 06:11:13', '2019-11-28 06:11:13', 6, 'منظور الشخص الاول', 'ar'),
(12, '2019-11-28 06:11:13', '2019-11-28 06:11:13', 6, 'First-person', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `created_at`, `updated_at`) VALUES
(1, '2019-11-28 05:43:25', '2019-11-28 05:43:25'),
(2, '2019-11-28 05:43:53', '2019-11-28 05:43:53'),
(3, '2019-11-28 05:44:13', '2019-11-28 05:44:13'),
(4, '2019-11-28 05:45:02', '2019-11-28 05:45:02'),
(5, '2019-11-28 05:45:23', '2019-11-28 05:45:23'),
(6, '2019-11-28 05:46:20', '2019-11-28 05:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `genres_products`
--

CREATE TABLE `genres_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre_translations`
--

CREATE TABLE `genre_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre_translations`
--

INSERT INTO `genre_translations` (`id`, `created_at`, `updated_at`, `title`, `locale`, `genre_id`) VALUES
(1, '2019-11-28 05:43:25', '2019-11-28 05:43:25', 'سبورت', 'ar', 1),
(2, '2019-11-28 05:43:25', '2019-11-28 05:43:25', 'Sport', 'en', 1),
(3, '2019-11-28 05:43:53', '2019-11-28 05:43:54', 'سميولشن', 'ar', 2),
(4, '2019-11-28 05:43:54', '2019-11-28 05:43:54', 'Simulation', 'en', 2),
(5, '2019-11-28 05:44:13', '2019-11-28 05:44:13', 'اكشن', 'ar', 3),
(6, '2019-11-28 05:44:13', '2019-11-28 05:44:13', 'Action', 'en', 3),
(7, '2019-11-28 05:45:02', '2019-11-28 05:45:02', 'مغامرة', 'ar', 4),
(8, '2019-11-28 05:45:02', '2019-11-28 05:45:02', 'Adventure', 'en', 4),
(9, '2019-11-28 05:45:23', '2019-11-28 05:45:23', 'FPS / TPS', 'ar', 5),
(10, '2019-11-28 05:45:23', '2019-11-28 05:45:23', 'FPS / TPS', 'en', 5),
(11, '2019-11-28 05:46:20', '2019-11-28 05:46:20', 'استراتيجي', 'ar', 6),
(12, '2019-11-28 05:46:20', '2019-11-28 05:46:21', 'Strategy', 'en', 6);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `created_at`, `updated_at`) VALUES
(1, '2019-11-28 06:11:46', '2019-11-28 06:11:46'),
(2, '2019-11-28 06:12:02', '2019-11-28 06:12:02'),
(3, '2019-11-28 06:12:23', '2019-11-28 06:12:23'),
(4, '2019-11-28 06:12:39', '2019-11-28 06:12:39'),
(5, '2019-11-28 06:12:58', '2019-11-28 06:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `languages_products`
--

CREATE TABLE `languages_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages_translations`
--

CREATE TABLE `languages_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages_translations`
--

INSERT INTO `languages_translations` (`id`, `created_at`, `updated_at`, `title`, `language_id`, `locale`) VALUES
(1, '2019-11-28 06:11:46', '2019-11-28 06:11:46', 'عربي', 1, 'ar'),
(2, '2019-11-28 06:11:46', '2019-11-28 06:11:46', 'Arabic', 1, 'en'),
(3, '2019-11-28 06:12:02', '2019-11-28 06:12:02', 'انجليزي', 2, 'ar'),
(4, '2019-11-28 06:12:02', '2019-11-28 06:12:02', 'English', 2, 'en'),
(5, '2019-11-28 06:12:23', '2019-11-28 06:12:23', 'فرنسي', 3, 'ar'),
(6, '2019-11-28 06:12:23', '2019-11-28 06:12:23', 'French', 3, 'en'),
(7, '2019-11-28 06:12:39', '2019-11-28 06:12:39', 'ايطالي', 4, 'ar'),
(8, '2019-11-28 06:12:39', '2019-11-28 06:12:39', 'Italian', 4, 'en'),
(9, '2019-11-28 06:12:58', '2019-11-28 06:12:58', 'روسي', 5, 'ar'),
(10, '2019-11-28 06:12:58', '2019-11-28 06:12:58', 'Russian', 5, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_11_20_081032_create_permission_tables', 1),
(3, '2019_11_21_0072242_create_products_categories_table', 1),
(4, '2019_11_21_072242_create_Game_details_table', 1),
(5, '2019_11_21_072242_create_Products_Images_table', 1),
(6, '2019_11_21_072242_create_Social_links_table', 1),
(7, '2019_11_21_072242_create_blog_categories_table', 1),
(8, '2019_11_21_072242_create_blog_categories_translations_table', 1),
(9, '2019_11_21_072242_create_blog_translations_table', 1),
(10, '2019_11_21_072242_create_blogs_products_table', 1),
(11, '2019_11_21_072242_create_blogs_table', 1),
(12, '2019_11_21_072242_create_blogs_tags_table', 1),
(13, '2019_11_21_072242_create_categories_table', 1),
(14, '2019_11_21_072242_create_categories_translations_table', 1),
(15, '2019_11_21_072242_create_content_sections_products_table', 1),
(16, '2019_11_21_072242_create_content_sections_table', 1),
(17, '2019_11_21_072242_create_content_sections_translations_table', 1),
(18, '2019_11_21_072242_create_countries_regions_table', 1),
(19, '2019_11_21_072242_create_countries_table', 1),
(20, '2019_11_21_072242_create_countries_translations_table', 1),
(21, '2019_11_21_072242_create_currencies_table', 1),
(22, '2019_11_21_072242_create_currencies_translation_table', 1),
(23, '2019_11_21_072242_create_discount_codes_table', 1),
(24, '2019_11_21_072242_create_gameDetails_products_table', 1),
(25, '2019_11_21_072242_create_game_details_translations_table', 1),
(26, '2019_11_21_072242_create_genre_table', 1),
(27, '2019_11_21_072242_create_genre_translations_table', 1),
(28, '2019_11_21_072242_create_genres_products_table', 1),
(29, '2019_11_21_072242_create_languages_products_table', 1),
(30, '2019_11_21_072242_create_languages_table', 1),
(31, '2019_11_21_072242_create_languages_translations_table', 1),
(32, '2019_11_21_072242_create_newsletters_table', 1),
(33, '2019_11_21_072242_create_phones_table', 1),
(34, '2019_11_21_072242_create_platforms_table', 1),
(35, '2019_11_21_072242_create_platforms_translations_table', 1),
(36, '2019_11_21_072242_create_products_table', 1),
(37, '2019_11_21_072242_create_products_translations_table', 1),
(38, '2019_11_21_072242_create_ratings_table', 1),
(39, '2019_11_21_072242_create_regions_table', 1),
(40, '2019_11_21_072242_create_regions_translations_table', 1),
(41, '2019_11_21_072242_create_related_products_table', 1),
(42, '2019_11_21_072242_create_settings_table', 1),
(43, '2019_11_21_072242_create_settings_translations_table', 1),
(44, '2019_11_21_072242_create_site_languages_table', 1),
(45, '2019_11_21_072242_create_sliders_table', 1),
(46, '2019_11_21_072242_create_sliders_translations_table', 1),
(47, '2019_11_21_072242_create_tag_translations_table', 1),
(48, '2019_11_21_072242_create_tags_table', 1),
(49, '2019_11_21_072242_create_users_ratings_table', 1),
(50, '2019_11_21_072242_create_users_table', 1),
(51, '2019_11_21_072242_create_works_on_table', 1),
(52, '2019_11_21_072252_create_foreign_keys', 1),
(53, '2019_11_25_075757_create_files_table', 1),
(54, '2019_11_25_181531_create_currency_convertor_table', 1),
(55, '2019_11_26_115307_create__products__codes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Admin', 1),
(2, 'App\\Admin', 1),
(3, 'App\\Admin', 1),
(4, 'App\\Admin', 1),
(5, 'App\\Admin', 1),
(6, 'App\\Admin', 1),
(7, 'App\\Admin', 1),
(8, 'App\\Admin', 1),
(9, 'App\\Admin', 1),
(10, 'App\\Admin', 1),
(11, 'App\\Admin', 1),
(12, 'App\\Admin', 1),
(13, 'App\\Admin', 1),
(14, 'App\\Admin', 1),
(15, 'App\\Admin', 1),
(16, 'App\\Admin', 1),
(17, 'App\\Admin', 1),
(18, 'App\\Admin', 1),
(19, 'App\\Admin', 1),
(20, 'App\\Admin', 1),
(21, 'App\\Admin', 1),
(22, 'App\\Admin', 1),
(23, 'App\\Admin', 1),
(24, 'App\\Admin', 1),
(25, 'App\\Admin', 1),
(26, 'App\\Admin', 1),
(27, 'App\\Admin', 1),
(28, 'App\\Admin', 1),
(29, 'App\\Admin', 1),
(30, 'App\\Admin', 1),
(31, 'App\\Admin', 1),
(32, 'App\\Admin', 1),
(33, 'App\\Admin', 1),
(34, 'App\\Admin', 1),
(35, 'App\\Admin', 1),
(36, 'App\\Admin', 1),
(37, 'App\\Admin', 1),
(38, 'App\\Admin', 1),
(39, 'App\\Admin', 1),
(40, 'App\\Admin', 1),
(41, 'App\\Admin', 1),
(42, 'App\\Admin', 1),
(43, 'App\\Admin', 1),
(44, 'App\\Admin', 1),
(45, 'App\\Admin', 1),
(46, 'App\\Admin', 1),
(47, 'App\\Admin', 1),
(48, 'App\\Admin', 1),
(49, 'App\\Admin', 1),
(50, 'App\\Admin', 1),
(51, 'App\\Admin', 1),
(52, 'App\\Admin', 1),
(53, 'App\\Admin', 1),
(54, 'App\\Admin', 1),
(55, 'App\\Admin', 1),
(56, 'App\\Admin', 1),
(57, 'App\\Admin', 1),
(58, 'App\\Admin', 1),
(59, 'App\\Admin', 1),
(60, 'App\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Permission-Add', 'admin', 'إضافة صلاحية', '2019-11-28 05:25:50', '2019-11-28 05:25:50'),
(2, 'Permission-Edit', 'admin', 'تعديل صلاحية', '2019-11-28 05:25:51', '2019-11-28 05:25:51'),
(3, 'Permission-Delete', 'admin', 'حذف صلاحية', '2019-11-28 05:25:51', '2019-11-28 05:25:51'),
(4, 'Role-Add', 'admin', 'اضافه مجموعه مستخدمين', '2019-11-28 05:25:51', '2019-11-28 05:25:51'),
(5, 'Role-Edit', 'admin', 'تعديل مجموعه مستخدمين', '2019-11-28 05:25:52', '2019-11-28 05:25:52'),
(6, 'Role-Delete', 'admin', 'حذف مجموعه مستخدمين', '2019-11-28 05:25:52', '2019-11-28 05:25:52'),
(7, 'Show-Adminpanel', 'admin', 'عرض لوحة التحكم', '2019-11-28 05:25:52', '2019-11-28 05:25:52'),
(8, 'AdminUser-Add', 'admin', 'اضافه ادمن', '2019-11-28 05:25:52', '2019-11-28 05:25:52'),
(9, 'AdminUser-Edit', 'admin', 'تعديل ادمن', '2019-11-28 05:25:53', '2019-11-28 05:25:53'),
(10, 'AdminUser-Delete', 'admin', 'حذف ادمن', '2019-11-28 05:25:53', '2019-11-28 05:25:53'),
(11, 'FrontUser-Add', 'admin', 'اضافه مستخدم', '2019-11-28 05:25:53', '2019-11-28 05:25:53'),
(12, 'FrontUser-Edit', 'admin', 'تعديل مستخدم', '2019-11-28 05:25:53', '2019-11-28 05:25:53'),
(13, 'FrontUser-Delete', 'admin', 'حذف مستخدم', '2019-11-28 05:25:54', '2019-11-28 05:25:54'),
(14, 'NewsLetter-Add', 'admin', 'إضافة مستخدم للنشرة الإخبارية', '2019-11-28 05:25:54', '2019-11-28 05:25:54'),
(15, 'SiteSetting-Add', 'admin', 'إضافة إعدادات الموقع', '2019-11-28 05:25:54', '2019-11-28 05:25:54'),
(16, 'SiteLanguage-Add', 'admin', 'إضافة لغة للموقع', '2019-11-28 05:25:54', '2019-11-28 05:25:54'),
(17, 'SiteLanguage-Edit', 'admin', 'تعديل لغة للموقع', '2019-11-28 05:25:54', '2019-11-28 05:25:54'),
(18, 'SiteLanguage-Delete', 'admin', 'حذف لغة للموقع', '2019-11-28 05:25:55', '2019-11-28 05:25:55'),
(19, 'Country-Add', 'admin', 'إضافة دولة', '2019-11-28 05:25:55', '2019-11-28 05:25:55'),
(20, 'Country-Edit', 'admin', 'تعديل دولة', '2019-11-28 05:25:55', '2019-11-28 05:25:55'),
(21, 'Country-Delete', 'admin', 'حذف دولة', '2019-11-28 05:25:55', '2019-11-28 05:25:55'),
(22, 'Currency-Add', 'admin', 'إضافة عملة', '2019-11-28 05:25:55', '2019-11-28 05:25:55'),
(23, 'Currency-Edit', 'admin', 'تعديل عملة', '2019-11-28 05:25:55', '2019-11-28 05:25:55'),
(24, 'Currency-Delete', 'admin', 'حذف عملة', '2019-11-28 05:25:56', '2019-11-28 05:25:56'),
(25, 'GameLanguage-Add', 'admin', 'إضافة لغة للعبة', '2019-11-28 05:25:56', '2019-11-28 05:25:56'),
(26, 'GameLanguage-Edit', 'admin', 'تعديل لغة للعبة', '2019-11-28 05:25:56', '2019-11-28 05:25:56'),
(27, 'GameLanguage-Delete', 'admin', 'حذف لغة للعبة', '2019-11-28 05:25:56', '2019-11-28 05:25:56'),
(28, 'GameDetails-Add', 'admin', 'إضافة تفاصيل للعبة', '2019-11-28 05:25:56', '2019-11-28 05:25:56'),
(29, 'GameDetails-Edit', 'admin', 'تعديل تفاصيل للعبة', '2019-11-28 05:25:57', '2019-11-28 05:25:57'),
(30, 'GameDetails-Delete', 'admin', 'حذف تفاصيل للعبة', '2019-11-28 05:25:57', '2019-11-28 05:25:57'),
(31, 'Slider-Add', 'admin', 'إضافة سليدر', '2019-11-28 05:25:57', '2019-11-28 05:25:57'),
(32, 'Slider-Edit', 'admin', 'تعديل سليدر', '2019-11-28 05:25:57', '2019-11-28 05:25:57'),
(33, 'Slider-Delete', 'admin', 'حذف سليدر', '2019-11-28 05:25:57', '2019-11-28 05:25:57'),
(34, 'Region-Add', 'admin', 'إضافة منطقة', '2019-11-28 05:25:58', '2019-11-28 05:25:58'),
(35, 'Region-Edit', 'admin', 'تعديل منطقة', '2019-11-28 05:25:58', '2019-11-28 05:25:58'),
(36, 'Region-Delete', 'admin', 'حذف منطقة', '2019-11-28 05:25:58', '2019-11-28 05:25:58'),
(37, 'Genres-Add', 'admin', 'إضافة نوع', '2019-11-28 05:25:58', '2019-11-28 05:25:58'),
(38, 'Genres-Edit', 'admin', 'تعديل نوع', '2019-11-28 05:25:58', '2019-11-28 05:25:58'),
(39, 'Genres-Delete', 'admin', 'حذف نوع', '2019-11-28 05:25:59', '2019-11-28 05:25:59'),
(40, 'PlatForm-Add', 'admin', 'إضافة منصة', '2019-11-28 05:25:59', '2019-11-28 05:25:59'),
(41, 'PlatForm-Edit', 'admin', 'تعديل منصة', '2019-11-28 05:25:59', '2019-11-28 05:25:59'),
(42, 'PlatForm-Delete', 'admin', 'حذف منصة', '2019-11-28 05:25:59', '2019-11-28 05:25:59'),
(43, 'ProductCategory-Add', 'admin', 'إضافة قسم للمنتجات', '2019-11-28 05:25:59', '2019-11-28 05:25:59'),
(44, 'ProductCategory-Edit', 'admin', 'تعديل قسم للمنتجات', '2019-11-28 05:26:00', '2019-11-28 05:26:00'),
(45, 'ProductCategory-Delete', 'admin', 'حذف قسم للمنتجات', '2019-11-28 05:26:00', '2019-11-28 05:26:00'),
(46, 'Product-Add', 'admin', 'إضافة منتج', '2019-11-28 05:26:00', '2019-11-28 05:26:00'),
(47, 'Product-Edit', 'admin', 'تعديل منتج', '2019-11-28 05:26:00', '2019-11-28 05:26:00'),
(48, 'Product-Delete', 'admin', 'حذف منتج', '2019-11-28 05:26:01', '2019-11-28 05:26:01'),
(49, 'WorkOn-Add', 'admin', 'إضافة العمل علي', '2019-11-28 05:26:01', '2019-11-28 05:26:01'),
(50, 'WorkOn-Edit', 'admin', 'تعديل العمل علي', '2019-11-28 05:26:01', '2019-11-28 05:26:01'),
(51, 'WorkOn-Delete', 'admin', 'حذف العمل علي', '2019-11-28 05:26:01', '2019-11-28 05:26:01'),
(52, 'Tag-Add', 'admin', 'إضافة تاج', '2019-11-28 05:26:02', '2019-11-28 05:26:02'),
(53, 'Tag-Edit', 'admin', 'تعديل تاج', '2019-11-28 05:26:02', '2019-11-28 05:26:02'),
(54, 'Tag-Delete', 'admin', 'حذف تاج', '2019-11-28 05:26:02', '2019-11-28 05:26:02'),
(55, 'BlogCategory-Add', 'admin', 'إضافة قسم للمدونة', '2019-11-28 05:26:02', '2019-11-28 05:26:02'),
(56, 'BlogCategory-Edit', 'admin', 'تعديل قسم للمدونة', '2019-11-28 05:26:02', '2019-11-28 05:26:02'),
(57, 'BlogCategory-Delete', 'admin', 'حذف قسم للمدونة', '2019-11-28 05:26:03', '2019-11-28 05:26:03'),
(58, 'Blog-Add', 'admin', 'إضافة مدونة', '2019-11-28 05:26:03', '2019-11-28 05:26:03'),
(59, 'Blog-Edit', 'admin', 'تعديل مدونة', '2019-11-28 05:26:03', '2019-11-28 05:26:03'),
(60, 'Blog-Delete', 'admin', 'حذف مدونة', '2019-11-28 05:26:03', '2019-11-28 05:26:03');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneable_id` int(10) UNSIGNED DEFAULT NULL,
  `phoneable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `created_at`, `updated_at`, `image`) VALUES
(1, '2019-11-28 05:47:27', '2019-11-28 05:47:27', '/uploads/platform/1/1574927247.png'),
(2, '2019-11-28 05:54:47', '2019-11-28 05:54:48', '/uploads/platform/2/1574927688.png'),
(3, '2019-11-28 05:58:43', '2019-11-28 05:58:43', '/uploads/platform/3/1574927923.png');

-- --------------------------------------------------------

--
-- Table structure for table `platforms_translations`
--

CREATE TABLE `platforms_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `platform_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platforms_translations`
--

INSERT INTO `platforms_translations` (`id`, `created_at`, `updated_at`, `platform_id`, `title`, `locale`) VALUES
(1, '2019-11-28 05:47:27', '2019-11-28 05:47:27', 1, 'ستيم', 'ar'),
(2, '2019-11-28 05:47:27', '2019-11-28 05:47:27', 1, 'Steam', 'en'),
(3, '2019-11-28 05:54:48', '2019-11-28 05:54:48', 2, 'روك ستار', 'ar'),
(4, '2019-11-28 05:54:48', '2019-11-28 05:54:48', 2, 'Rockstar Games Launcher', 'en'),
(5, '2019-11-28 05:58:43', '2019-11-28 05:58:43', 3, 'اورجين', 'ar'),
(6, '2019-11-28 05:58:43', '2019-11-28 05:58:43', 3, 'Origin', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `main_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `developers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publishers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `works_on_id` int(10) UNSIGNED DEFAULT NULL,
  `platform_id` int(10) UNSIGNED DEFAULT NULL,
  `region_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `main_image`, `quantity`, `price`, `release_date`, `developers`, `publishers`, `works_on_id`, `platform_id`, `region_id`) VALUES
(1, '2019-11-28 06:24:54', '2019-11-28 08:57:17', '/uploads/products/1/bGeW1LsmssqOC8LuM7LGp63rHWLTTumF0lbI8f4b.jpeg', 10, '45.00', '2019-11-05', 'Rockstar Games', 'Rockstar Games', 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `product_id`, `category_id`) VALUES
(33, 1, 1),
(34, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products_codes`
--

CREATE TABLE `products_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_translations`
--

CREATE TABLE `products_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `System_requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_translations`
--

INSERT INTO `products_translations` (`id`, `created_at`, `updated_at`, `product_id`, `title`, `description`, `System_requirements`, `locale`) VALUES
(1, '2019-11-28 06:24:54', '2019-11-28 06:24:54', 1, 'ريد ديد ريدمبشن 2', 'ريد ديد ريدمبشن 2 هي لعبة فيديو من نوع عالم مفتوح وأكشن–مغامرات من تطوير ونشر روكستار جيمز. اللعبة هي بادئة لسابقتها ريد ديد ريدمبشن والثالثة ضمن سلسلة ريد ديد. أحداثها تقع في عام 1899، وتتبع الخارج عن القانون آرثر مورغان، وهو عضو في عصابة دوتش فان دير ليند. صدرت اللعبة على بلاي ستيشن 4 وإكس بوكس ون في 26 أكتوبر', NULL, 'ar'),
(2, '2019-11-28 06:24:54', '2019-11-28 06:24:54', 1, 'Red Dead Redemption 2', 'Developed by Rockstar Games, Red Dead Redemption 2 is a sequel to a western-themed open-world game of the same name first released back in 2010. Buy Red Dead Redemption 2 PC key and engage in another Rockstar provided gaming experience of an epic scale that is definitive for the contemporary decade of the gaming industry. As Red Dead Redemption 2 is coming from consoles to the PC platform it will introduce various changes and additions that expand upon an already jaw-dropping installment of this amazing Wild West franchise.', NULL, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `created_at`, `updated_at`, `code`) VALUES
(1, '2019-11-28 05:59:21', '2019-11-28 05:59:21', 'GB'),
(2, '2019-11-28 06:00:03', '2019-11-28 06:00:03', 'EU');

-- --------------------------------------------------------

--
-- Table structure for table `regions_translations`
--

CREATE TABLE `regions_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `region_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions_translations`
--

INSERT INTO `regions_translations` (`id`, `created_at`, `updated_at`, `region_id`, `title`, `locale`) VALUES
(1, '2019-11-28 05:59:21', '2019-11-28 05:59:21', 1, 'جلوبال', 'ar'),
(2, '2019-11-28 05:59:21', '2019-11-28 05:59:21', 1, 'Global', 'en'),
(3, '2019-11-28 06:00:03', '2019-11-28 06:00:03', 2, 'اوروبا', 'ar'),
(4, '2019-11-28 06:00:03', '2019-11-28 06:00:03', 2, 'Europe', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `related_products`
--

CREATE TABLE `related_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `related_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'admin', '2019-11-28 05:25:50', '2019-11-28 05:25:50'),
(2, 'registered-users', 'web', '2019-11-28 05:26:03', '2019-11-28 05:26:03');

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
(60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings_translations`
--

CREATE TABLE `settings_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `setting_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_languages`
--

CREATE TABLE `site_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_languages`
--

INSERT INTO `site_languages` (`id`, `created_at`, `updated_at`, `title`, `flag`, `locale`) VALUES
(1, '2019-11-28 05:29:25', '2019-11-28 05:29:25', 'Arabic', '/uploads/site_languages/1/1574926165.png', 'ar'),
(2, '2019-11-28 05:29:38', '2019-11-28 05:29:38', 'English', '/uploads/site_languages/2/1574926178.png', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders_translations`
--

CREATE TABLE `sliders_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slider_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_translations`
--

CREATE TABLE `tag_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `site_language_id` int(10) UNSIGNED DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `first_name`, `last_name`, `email`, `email_verified_at`, `image`, `guard`, `mobile`, `password`, `country_id`, `site_language_id`, `provider`, `provider_id`, `remember_token`) VALUES
(1, '2019-11-28 05:25:51', '2019-11-28 05:25:51', 'admin', 'admin', 'admin@admin.com', NULL, NULL, 'admin', NULL, '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_ratings`
--

CREATE TABLE `users_ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve` tinyint(4) DEFAULT 0,
  `ra_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `works_on`
--

CREATE TABLE `works_on` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `works_on`
--

INSERT INTO `works_on` (`id`, `created_at`, `updated_at`, `icon`, `title`) VALUES
(1, '2019-11-28 06:13:52', '2019-11-28 06:13:52', '/uploads/works_on/1/1574928832.png', 'Windows'),
(2, '2019-11-28 06:16:26', '2019-11-28 06:16:26', '/uploads/works_on/2/1574928986.png', 'Mac'),
(3, '2019-11-28 06:16:43', '2019-11-28 06:16:43', '/uploads/works_on/3/1574929003.png', 'PlayStaion'),
(4, '2019-11-28 06:16:56', '2019-11-28 06:16:56', '/uploads/works_on/4/1574929016.png', 'Xbox');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `blogs_products`
--
ALTER TABLE `blogs_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_products_blog_id_foreign` (`blog_id`),
  ADD KEY `blogs_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `blogs_tags`
--
ALTER TABLE `blogs_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_tags_tag_id_foreign` (`tag_id`),
  ADD KEY `blogs_tags_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories_translations`
--
ALTER TABLE `blog_categories_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_categories_translations_blog_category_id_foreign` (`blog_category_id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_translations_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `categories_translations`
--
ALTER TABLE `categories_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_translations_category_id_foreign` (`category_id`);

--
-- Indexes for table `content_sections`
--
ALTER TABLE `content_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_sections_products_content_section_id_foreign` (`content_section_id`),
  ADD KEY `content_sections_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `content_sections_translations`
--
ALTER TABLE `content_sections_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_sections_translations_content_section_id_foreign` (`content_section_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries_regions`
--
ALTER TABLE `countries_regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_regions_country_id_foreign` (`country_id`),
  ADD KEY `countries_regions_region_id_foreign` (`region_id`);

--
-- Indexes for table `countries_translations`
--
ALTER TABLE `countries_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_translations_country_id_foreign` (`country_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_country_id_index` (`country_id`);

--
-- Indexes for table `currencies_translation`
--
ALTER TABLE `currencies_translation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_translation_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `currency_convertor`
--
ALTER TABLE `currency_convertor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gamedetails_products`
--
ALTER TABLE `gamedetails_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gamedetails_products_game_detail_id_foreign` (`game_detail_id`),
  ADD KEY `gamedetails_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `game_details`
--
ALTER TABLE `game_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_details_translations`
--
ALTER TABLE `game_details_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_details_translations_game_detail_id_foreign` (`game_detail_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres_products`
--
ALTER TABLE `genres_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genres_products_genre_id_foreign` (`genre_id`),
  ADD KEY `genres_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `genre_translations`
--
ALTER TABLE `genre_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_translations_genre_id_foreign` (`genre_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages_products`
--
ALTER TABLE `languages_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `languages_products_language_id_foreign` (`language_id`),
  ADD KEY `languages_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `languages_translations`
--
ALTER TABLE `languages_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `languages_translations_language_id_foreign` (`language_id`);

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
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platforms_translations`
--
ALTER TABLE `platforms_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `platforms_translations_platform_id_foreign` (`platform_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_works_on_id_foreign` (`works_on_id`),
  ADD KEY `products_platform_id_foreign` (`platform_id`),
  ADD KEY `products_region_id_foreign` (`region_id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_categories_product_id_foreign` (`product_id`),
  ADD KEY `products_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `products_codes`
--
ALTER TABLE `products_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_codes_product_id_foreign` (`product_id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `products_translations`
--
ALTER TABLE `products_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_translations_product_id_foreign` (`product_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions_translations`
--
ALTER TABLE `regions_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_translations_region_id_foreign` (`region_id`);

--
-- Indexes for table `related_products`
--
ALTER TABLE `related_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_products_product_id_foreign` (`product_id`),
  ADD KEY `related_products_related_id_foreign` (`related_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_translations`
--
ALTER TABLE `settings_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_translations_setting_id_foreign` (`setting_id`);

--
-- Indexes for table `site_languages`
--
ALTER TABLE `site_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_translations_slider_id_foreign` (`slider_id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_links_setting_id_foreign` (`setting_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_translations`
--
ALTER TABLE `tag_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_translations_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_site_language_id_foreign` (`site_language_id`);

--
-- Indexes for table `users_ratings`
--
ALTER TABLE `users_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ratings_user_id_foreign` (`user_id`),
  ADD KEY `users_ratings_ra_id_foreign` (`ra_id`);

--
-- Indexes for table `works_on`
--
ALTER TABLE `works_on`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs_products`
--
ALTER TABLE `blogs_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs_tags`
--
ALTER TABLE `blogs_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories_translations`
--
ALTER TABLE `blog_categories_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories_translations`
--
ALTER TABLE `categories_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `content_sections`
--
ALTER TABLE `content_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_sections_translations`
--
ALTER TABLE `content_sections_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries_regions`
--
ALTER TABLE `countries_regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries_translations`
--
ALTER TABLE `countries_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies_translation`
--
ALTER TABLE `currencies_translation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currency_convertor`
--
ALTER TABLE `currency_convertor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gamedetails_products`
--
ALTER TABLE `gamedetails_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_details`
--
ALTER TABLE `game_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `game_details_translations`
--
ALTER TABLE `game_details_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genres_products`
--
ALTER TABLE `genres_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre_translations`
--
ALTER TABLE `genre_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `languages_products`
--
ALTER TABLE `languages_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages_translations`
--
ALTER TABLE `languages_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `platforms_translations`
--
ALTER TABLE `platforms_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products_codes`
--
ALTER TABLE `products_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_translations`
--
ALTER TABLE `products_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions_translations`
--
ALTER TABLE `regions_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `related_products`
--
ALTER TABLE `related_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings_translations`
--
ALTER TABLE `settings_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_languages`
--
ALTER TABLE `site_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag_translations`
--
ALTER TABLE `tag_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_ratings`
--
ALTER TABLE `users_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `works_on`
--
ALTER TABLE `works_on`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogs_products`
--
ALTER TABLE `blogs_products`
  ADD CONSTRAINT `blogs_products_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogs_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogs_tags`
--
ALTER TABLE `blogs_tags`
  ADD CONSTRAINT `blogs_tags_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogs_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_categories_translations`
--
ALTER TABLE `blog_categories_translations`
  ADD CONSTRAINT `blog_categories_translations_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD CONSTRAINT `blog_translations_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories_translations`
--
ALTER TABLE `categories_translations`
  ADD CONSTRAINT `categories_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  ADD CONSTRAINT `content_sections_products_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_sections_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_sections_translations`
--
ALTER TABLE `content_sections_translations`
  ADD CONSTRAINT `content_sections_translations_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `countries_regions`
--
ALTER TABLE `countries_regions`
  ADD CONSTRAINT `countries_regions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `countries_regions_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `countries_translations`
--
ALTER TABLE `countries_translations`
  ADD CONSTRAINT `countries_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `currencies_translation`
--
ALTER TABLE `currencies_translation`
  ADD CONSTRAINT `currencies_translation_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gamedetails_products`
--
ALTER TABLE `gamedetails_products`
  ADD CONSTRAINT `gamedetails_products_game_detail_id_foreign` FOREIGN KEY (`game_detail_id`) REFERENCES `game_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gamedetails_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `game_details_translations`
--
ALTER TABLE `game_details_translations`
  ADD CONSTRAINT `game_details_translations_game_detail_id_foreign` FOREIGN KEY (`game_detail_id`) REFERENCES `game_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genres_products`
--
ALTER TABLE `genres_products`
  ADD CONSTRAINT `genres_products_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genres_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genre_translations`
--
ALTER TABLE `genre_translations`
  ADD CONSTRAINT `genre_translations_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `languages_products`
--
ALTER TABLE `languages_products`
  ADD CONSTRAINT `languages_products_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `languages_translations`
--
ALTER TABLE `languages_translations`
  ADD CONSTRAINT `languages_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `platforms_translations`
--
ALTER TABLE `platforms_translations`
  ADD CONSTRAINT `platforms_translations_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_works_on_id_foreign` FOREIGN KEY (`works_on_id`) REFERENCES `works_on` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `products_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_codes`
--
ALTER TABLE `products_codes`
  ADD CONSTRAINT `products_codes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_translations`
--
ALTER TABLE `products_translations`
  ADD CONSTRAINT `products_translations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions_translations`
--
ALTER TABLE `regions_translations`
  ADD CONSTRAINT `regions_translations_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `related_products`
--
ALTER TABLE `related_products`
  ADD CONSTRAINT `related_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `related_products_related_id_foreign` FOREIGN KEY (`related_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings_translations`
--
ALTER TABLE `settings_translations`
  ADD CONSTRAINT `settings_translations_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  ADD CONSTRAINT `sliders_translations_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_links`
--
ALTER TABLE `social_links`
  ADD CONSTRAINT `social_links_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag_translations`
--
ALTER TABLE `tag_translations`
  ADD CONSTRAINT `tag_translations_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_site_language_id_foreign` FOREIGN KEY (`site_language_id`) REFERENCES `site_languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_ratings`
--
ALTER TABLE `users_ratings`
  ADD CONSTRAINT `users_ratings_ra_id_foreign` FOREIGN KEY (`ra_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
