-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2019 at 08:56 AM
-- Server version: 10.2.29-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `megmp_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks_translations`
--

CREATE TABLE `banks_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `created_at`, `updated_at`, `image`, `category_id`, `publish`) VALUES
(1, '2019-12-05 21:57:16', '2019-12-05 21:57:16', '/uploads/blog/1/1575590236.jpeg', 1, 1),
(2, '2019-12-05 21:58:13', '2019-12-05 21:58:13', '/uploads/blog/2/1575590293.jpeg', 1, 2);

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

--
-- Dumping data for table `blogs_tags`
--

INSERT INTO `blogs_tags` (`id`, `created_at`, `updated_at`, `tag_id`, `blog_id`) VALUES
(2, '2019-12-06 06:50:26', '2019-12-06 06:50:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `created_at`, `updated_at`) VALUES
(1, '2019-12-05 21:56:06', '2019-12-05 21:56:06');

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

--
-- Dumping data for table `blog_categories_translations`
--

INSERT INTO `blog_categories_translations` (`id`, `created_at`, `updated_at`, `blog_category_id`, `title`, `locale`) VALUES
(1, NULL, NULL, 1, 'اخر الاخبار', 'ar'),
(2, NULL, NULL, 1, 'new news', 'en');

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

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `created_at`, `updated_at`, `blog_id`, `title`, `content`, `locale`) VALUES
(1, NULL, NULL, 1, 'تست مقاله', '<p>تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست&nbsp;</p>', 'ar'),
(2, NULL, NULL, 1, 'test', '<p>test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test&nbsp;</p>', 'en'),
(3, NULL, NULL, 2, 'تست مقاله', '<p>تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست تست&nbsp;</p>', 'ar'),
(4, NULL, NULL, 2, 'test', '<p>test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test&nbsp;</p>', 'en');

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
(1, '2019-12-05 07:40:25', '2019-12-05 07:40:25', NULL, 1),
(2, '2019-12-05 21:40:42', '2019-12-05 21:40:42', NULL, 1),
(3, '2019-12-05 21:42:22', '2019-12-05 21:42:22', NULL, 1);

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
(1, NULL, NULL, 1, 'فورتنايت', NULL, 'ar'),
(2, NULL, NULL, 1, 'Fortnite', NULL, 'en'),
(3, NULL, NULL, 2, 'اكس بوكس', 'اكس بوكس', 'ar'),
(4, NULL, NULL, 2, 'xbox', 'xbox', 'en'),
(5, NULL, NULL, 3, 'بلاستيشن', 'بلاستيشن', 'ar'),
(6, NULL, NULL, 3, 'playstation', NULL, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `content_sections`
--

CREATE TABLE `content_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint(4) NOT NULL,
  `columns` tinyint(4) NOT NULL,
  `type` enum('home','footer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_sections`
--

INSERT INTO `content_sections` (`id`, `title`, `order`, `columns`, `type`, `created_at`, `updated_at`) VALUES
(2, 'روابط سريعه', 4, 3, 'footer', '2019-12-05 21:29:27', '2019-12-05 21:29:27'),
(3, 'اخر المنتجات', 1, 1, 'home', '2019-12-05 21:32:26', '2019-12-08 04:56:13');

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

--
-- Dumping data for table `content_sections_products`
--

INSERT INTO `content_sections_products` (`id`, `created_at`, `updated_at`, `content_section_id`, `product_id`) VALUES
(5, '2019-12-06 06:19:06', '2019-12-06 06:19:06', 3, 1),
(6, '2019-12-06 06:19:06', '2019-12-06 06:19:06', 3, 2),
(7, '2019-12-06 06:19:06', '2019-12-06 06:19:06', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `content_sections_translations`
--

CREATE TABLE `content_sections_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_section_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_sections_translations`
--

INSERT INTO `content_sections_translations` (`id`, `content_section_id`, `content`, `locale`, `created_at`, `updated_at`) VALUES
(3, 2, '<p>تست ١</p>', 'ar', '2019-12-05 21:29:27', '2019-12-05 21:29:27'),
(4, 2, '<p>تست ٢</p>', 'ar', '2019-12-05 21:29:27', '2019-12-05 21:29:27'),
(5, 2, '<p>تست ٣</p>', 'ar', '2019-12-05 21:29:27', '2019-12-05 21:29:27'),
(7, 3, '<p>اخر المنتجات</p>', 'ar', '2019-12-08 04:56:13', '2019-12-08 04:56:13'),
(8, 3, '<p>Last Products</p>', 'en', '2019-12-08 04:56:13', '2019-12-08 04:56:13');

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
(1, '/uploads/country/1/1575481360.png', 'eg', '2019-12-04 15:42:40', '2019-12-04 15:42:40'),
(2, '/uploads/country/2/1575587654.png', '966', '2019-12-05 21:14:14', '2019-12-05 21:14:14');

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
(1, '2019-12-04 15:42:40', '2019-12-04 15:42:40', 1, 'مصر', 'ar'),
(2, '2019-12-04 15:42:40', '2019-12-04 15:42:40', 1, 'Egypt', 'en'),
(3, '2019-12-05 21:14:14', '2019-12-05 21:14:14', 2, 'السعودية', 'ar'),
(4, '2019-12-05 21:14:14', '2019-12-05 21:14:14', 2, 'saudi', 'en');

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
(1, '2019-12-04 15:44:08', '2019-12-04 15:44:08', 1),
(2, '2019-12-05 21:17:44', '2019-12-05 21:17:44', 2);

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
(1, '2019-12-04 15:44:08', '2019-12-04 15:44:08', 'جنيه مصري', 'ج.م', 1, 'ar'),
(2, '2019-12-04 15:44:08', '2019-12-04 15:44:08', 'Egyptian Pound', 'EGP', 1, 'en'),
(3, '2019-12-05 21:17:44', '2019-12-05 21:17:44', 'ريال سعودي', 'ريال', 2, 'ar'),
(4, '2019-12-05 21:17:44', '2019-12-05 21:17:44', 'sar', 'sar', 2, 'en');

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
(1, 'eg', 16.19, NULL, '2019-12-04 15:44:08', '2019-12-04 15:44:08'),
(2, '966', 2, NULL, '2019-12-05 21:17:44', '2019-12-05 21:17:44');

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
(1, '/uploads/products/2/1575554318sMggOp35Xv2GXnCAYZL6MuCK5WTMfBKPRTReDohzYGw_1920x1080_1x-0.jpeg', 0, '1575554318sMggOp35Xv2GXnCAYZL6MuCK5WTMfBKPRTReDohzYGw_1920x1080_1x-0.jpeg', 2, 'App\\Models\\Product', '2019-12-05 11:58:38', '2019-12-05 11:58:38'),
(2, '/uploads/products/2/1575554318MsY-YrLB7EZftF8FZy-RhTrCR_hjgrrG01SbmMTxvhA_1920x1080_1x-0.jpeg', 0, '1575554318MsY-YrLB7EZftF8FZy-RhTrCR_hjgrrG01SbmMTxvhA_1920x1080_1x-0.jpeg', 2, 'App\\Models\\Product', '2019-12-05 11:58:38', '2019-12-05 11:58:38'),
(3, '/uploads/products/2/1575554335xyIX0HT_1920x1080_1x-0.jpg', 0, '1575554335xyIX0HT_1920x1080_1x-0.jpg', 2, 'App\\Models\\Product', '2019-12-05 11:58:55', '2019-12-05 11:58:55'),
(4, '/uploads/products/2/1575554335DBX9dAH_1920x1080_1x-0.jpg', 0, '1575554335DBX9dAH_1920x1080_1x-0.jpg', 2, 'App\\Models\\Product', '2019-12-05 11:58:55', '2019-12-05 11:58:55'),
(5, '/uploads/products/2/1575554347cDt7rOj_1920x1080_1x-0.jpg', 0, '1575554347cDt7rOj_1920x1080_1x-0.jpg', 2, 'App\\Models\\Product', '2019-12-05 11:59:07', '2019-12-05 11:59:07'),
(8, '/uploads/products/3/1575567457V0G9UVitoGqMy1AAjgIauLFMYj4g98mDn0Ryz0KNIcU_390x400_1x-0.jpg', 0, '1575567457V0G9UVitoGqMy1AAjgIauLFMYj4g98mDn0Ryz0KNIcU_390x400_1x-0.jpg', 3, 'App\\Models\\Product', '2019-12-05 15:37:37', '2019-12-05 15:37:37'),
(9, '/uploads/products/4/1575589796iconfinder_Untitled-2-01_3253478.png', 0, '1575589796iconfinder_Untitled-2-01_3253478.png', 4, 'App\\Models\\Product', '2019-12-05 21:49:56', '2019-12-05 21:49:56'),
(10, '/uploads/products/4/1575589796iconfinder_Flag_of_Saudi_Arabia_96262.png', 0, '1575589796iconfinder_Flag_of_Saudi_Arabia_96262.png', 4, 'App\\Models\\Product', '2019-12-05 21:49:56', '2019-12-05 21:49:56'),
(11, '/uploads/products/1/15756213398HiPhH2YbnPlE7YI5bkkH2lIy4cbBu8x6esuL43I.jpeg', 0, '15756213398HiPhH2YbnPlE7YI5bkkH2lIy4cbBu8x6esuL43I.jpeg', 1, 'App\\Models\\Product', '2019-12-06 06:35:39', '2019-12-06 06:35:39');

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
(1, '2019-12-05 21:45:56', '2019-12-05 21:45:56', '/uploads/game_details/1/1575589556.png');

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
(1, '2019-12-05 21:45:56', '2019-12-05 21:45:56', 1, 'يبيب', 'ar'),
(2, '2019-12-05 21:45:56', '2019-12-05 21:45:56', 1, 'dfdf', 'en');

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
(1, '2019-12-05 21:43:17', '2019-12-05 21:43:17');

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

--
-- Dumping data for table `genres_products`
--

INSERT INTO `genres_products` (`id`, `created_at`, `updated_at`, `genre_id`, `product_id`) VALUES
(1, '2019-12-05 21:51:21', '2019-12-05 21:51:21', 1, 4);

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
(1, '2019-12-05 21:43:17', '2019-12-05 21:43:17', 'اكس بوك', 'ar', 1),
(2, '2019-12-05 21:43:17', '2019-12-05 21:43:17', 'xbox', 'en', 1);

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
(1, '2019-12-05 21:46:21', '2019-12-05 21:46:21');

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
(1, '2019-12-05 21:46:21', '2019-12-05 21:46:21', 'عربي', 1, 'ar'),
(2, '2019-12-05 21:46:21', '2019-12-05 21:46:21', 'ar', 1, 'en');

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
(55, '2019_11_26_115307_create__products__codes_table', 1),
(56, '2019_12_02_105011_create_banks_table', 1),
(57, '2019_12_02_105210_create_banks_translations_table', 1),
(58, '2019_12_02_131359_create_orders_table', 1),
(59, '2019_12_02_131904_create_order_items_table', 1),
(60, '2019_12_02_132124_create_transactions_table', 1),
(61, '2019_11_20_081032_create_permission_tables', 2);

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
(60, 'App\\Admin', 1),
(61, 'App\\Admin', 1),
(62, 'App\\Admin', 1),
(63, 'App\\Admin', 1),
(64, 'App\\Admin', 1),
(65, 'App\\Admin', 1),
(66, 'App\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\User', 6);

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

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `created_at`, `updated_at`, `email`) VALUES
(1, '2019-12-05 22:01:44', '2019-12-05 22:01:44', 'ea2@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `orderNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('wait','refused','accepted','shipped','complete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'wait',
  `total` double NOT NULL,
  `code_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, 'Permission-Add', 'admin', 'إضافة صلاحية', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(2, 'Permission-Edit', 'admin', 'تعديل صلاحية', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(3, 'Permission-Delete', 'admin', 'حذف صلاحية', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(4, 'Role-Add', 'admin', 'اضافه مجموعه مستخدمين', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(5, 'Role-Edit', 'admin', 'تعديل مجموعه مستخدمين', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(6, 'Role-Delete', 'admin', 'حذف مجموعه مستخدمين', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(7, 'Show-Adminpanel', 'admin', 'عرض لوحة التحكم', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(8, 'AdminUser-Add', 'admin', 'اضافه ادمن', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(9, 'AdminUser-Edit', 'admin', 'تعديل ادمن', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(10, 'AdminUser-Delete', 'admin', 'حذف ادمن', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(11, 'FrontUser-Add', 'admin', 'اضافه مستخدم', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(12, 'FrontUser-Edit', 'admin', 'تعديل مستخدم', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(13, 'FrontUser-Delete', 'admin', 'حذف مستخدم', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(14, 'NewsLetter-Add', 'admin', 'إضافة مستخدم للنشرة الإخبارية', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(15, 'SiteSetting-Add', 'admin', 'إضافة إعدادات الموقع', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(16, 'SiteLanguage-Add', 'admin', 'إضافة لغة للموقع', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(17, 'SiteLanguage-Edit', 'admin', 'تعديل لغة للموقع', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(18, 'SiteLanguage-Delete', 'admin', 'حذف لغة للموقع', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(19, 'Country-Add', 'admin', 'إضافة دولة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(20, 'Country-Edit', 'admin', 'تعديل دولة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(21, 'Country-Delete', 'admin', 'حذف دولة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(22, 'Currency-Add', 'admin', 'إضافة عملة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(23, 'Currency-Edit', 'admin', 'تعديل عملة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(24, 'Currency-Delete', 'admin', 'حذف عملة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(25, 'GameLanguage-Add', 'admin', 'إضافة لغة للعبة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(26, 'GameLanguage-Edit', 'admin', 'تعديل لغة للعبة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(27, 'GameLanguage-Delete', 'admin', 'حذف لغة للعبة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(28, 'GameDetails-Add', 'admin', 'إضافة تفاصيل للعبة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(29, 'GameDetails-Edit', 'admin', 'تعديل تفاصيل للعبة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(30, 'GameDetails-Delete', 'admin', 'حذف تفاصيل للعبة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(31, 'Slider-Add', 'admin', 'إضافة سليدر', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(32, 'Slider-Edit', 'admin', 'تعديل سليدر', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(33, 'Slider-Delete', 'admin', 'حذف سليدر', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(34, 'Region-Add', 'admin', 'إضافة منطقة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(35, 'Region-Edit', 'admin', 'تعديل منطقة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(36, 'Region-Delete', 'admin', 'حذف منطقة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(37, 'Genres-Add', 'admin', 'إضافة نوع', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(38, 'Genres-Edit', 'admin', 'تعديل نوع', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(39, 'Genres-Delete', 'admin', 'حذف نوع', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(40, 'PlatForm-Add', 'admin', 'إضافة منصة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(41, 'PlatForm-Edit', 'admin', 'تعديل منصة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(42, 'PlatForm-Delete', 'admin', 'حذف منصة', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(43, 'ProductCategory-Add', 'admin', 'إضافة قسم للمنتجات', '2019-12-06 06:44:47', '2019-12-06 06:44:47'),
(44, 'ProductCategory-Edit', 'admin', 'تعديل قسم للمنتجات', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(45, 'ProductCategory-Delete', 'admin', 'حذف قسم للمنتجات', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(46, 'Product-Add', 'admin', 'إضافة منتج', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(47, 'Product-Edit', 'admin', 'تعديل منتج', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(48, 'Product-Delete', 'admin', 'حذف منتج', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(49, 'WorkOn-Add', 'admin', 'إضافة العمل علي', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(50, 'WorkOn-Edit', 'admin', 'تعديل العمل علي', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(51, 'WorkOn-Delete', 'admin', 'حذف العمل علي', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(52, 'Tag-Add', 'admin', 'إضافة تاج', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(53, 'Tag-Edit', 'admin', 'تعديل تاج', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(54, 'Tag-Delete', 'admin', 'حذف تاج', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(55, 'BlogCategory-Add', 'admin', 'إضافة قسم للمدونة', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(56, 'BlogCategory-Edit', 'admin', 'تعديل قسم للمدونة', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(57, 'BlogCategory-Delete', 'admin', 'حذف قسم للمدونة', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(58, 'Blog-Add', 'admin', 'إضافة مدونة', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(59, 'Blog-Edit', 'admin', 'تعديل مدونة', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(60, 'Blog-Delete', 'admin', 'حذف مدونة', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(61, 'Payment-Add', 'admin', 'إضافة وسيلة دفع', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(62, 'Payment-Edit', 'admin', 'تعديل وسيلة دفع', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(63, 'Payment-Delete', 'admin', 'حذف وسيلة دفع', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(64, 'Order-Show', 'admin', 'عرض اوردر', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(65, 'Order-Delete', 'admin', 'حذف اوردر', '2019-12-06 06:44:48', '2019-12-06 06:44:48'),
(66, 'Report-Show', 'admin', 'عرض التقرير', '2019-12-06 06:44:49', '2019-12-06 06:44:49');

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

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `created_at`, `updated_at`, `phone`, `phoneable_id`, `phoneable_type`) VALUES
(2, '2019-12-05 21:09:38', '2019-12-05 21:09:38', '01288863631', 1, 'App\\Models\\Setting');

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
(1, '2019-12-05 07:36:58', '2019-12-05 07:36:58', '/uploads/platform/1/1575538618.png'),
(2, '2019-12-05 21:44:07', '2019-12-05 21:44:07', '/uploads/platform/2/1575589447.png');

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
(1, '2019-12-05 07:36:58', '2019-12-05 07:36:58', 1, 'EpicGames', 'ar'),
(2, '2019-12-05 07:36:58', '2019-12-05 07:36:58', 1, 'EpicGames', 'en'),
(3, '2019-12-05 21:44:07', '2019-12-05 21:44:07', 2, 'EpicGames', 'ar'),
(4, '2019-12-05 21:44:07', '2019-12-05 21:44:07', 2, 'EpicGames', 'en');

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
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `main_image`, `quantity`, `price`, `video`, `release_date`, `developers`, `publishers`, `works_on_id`, `platform_id`, `region_id`) VALUES
(1, '2019-12-05 07:41:11', '2019-12-06 06:35:19', '/uploads/products/1/WfrRbvoNbqWWNLPN6OwyiBII3CZ26nWfjp3JhgYy.jpeg', 4, 120.00, 'https://www.youtube.com/watch?v=SXvQ1nK4oxk', '1111-11-11', 'EpicGames', 'EpicGames', 1, 1, 1),
(2, '2019-12-05 11:53:56', '2019-12-05 11:58:18', '/uploads/products/2/9xNX28KFZ2PjWCMV112IDpF02KSuzHErFzmklqWA.jpeg', 10, 59.99, 'https://www.youtube.com/watch?v=SXvQ1nK4oxk', '2019-10-24', 'Rockstar Games', 'Rockstar Games', 1, 1, 1),
(3, '2019-12-05 15:36:52', '2019-12-05 15:36:52', NULL, 4, 220.00, NULL, '1111-11-11', 'EpicGames', 'EpicGames', 1, 1, 1),
(4, '2019-12-05 21:48:38', '2019-12-05 21:48:38', NULL, 10, 5.00, NULL, '2019-01-01', 'sdsd', 'sdsd', 2, 1, 2);

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
(3, 2, 1),
(4, 3, 1),
(5, 4, 3),
(8, 1, 1);

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

--
-- Dumping data for table `products_codes`
--

INSERT INTO `products_codes` (`id`, `product_id`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '---------------------', 0, NULL, NULL),
(5, 4, 'sdfdsfsdf89o2j34234', 0, NULL, NULL),
(6, 4, 'dfsdfsdfsdfsdfsd', 0, NULL, NULL),
(7, 4, 'fsdfsdfsfs', 0, NULL, NULL);

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
(1, '2019-12-05 07:41:11', '2019-12-05 07:41:11', 1, 'فأس الهالوين', 'فأس الهالوين', NULL, 'ar'),
(2, '2019-12-05 07:41:11', '2019-12-05 07:41:11', 1, 'Minty Axe', 'Minty Axe', NULL, 'en'),
(3, '2019-12-05 11:53:56', '2019-12-05 11:57:17', 2, 'ريد ديد ريدمبشن 2', 'ريد ديد ريدمبشن 2', '<p><strong>أقل متطلبات تشغيل:</strong></p><ul><li>OS: Windows 7 – Service Pack 1 (6.1.7601)</li><li>Processor: Intel Core i5-2500K / AMD FX-6300</li><li>Memory: 8GB</li><li>Graphics Card: Nvidia GeForce GTX 770 2GB / AMD Radeon R9 280 3GB</li><li>HDD Space: 150GB</li><li>Sound Card: DirectX compatible</li></ul><p><strong>متطلبات التشغيل الموصى بها</strong>:</p><ul><li>OS: Windows 10 – April 2018 Update (v1803)</li><li>Processor: Intel Core i7-4770K / AMD Ryzen 5 1500X</li><li>Memory: 12GB</li><li>Graphics Card: Nvidia GeForce GTX 1060 6GB / AMD Radeon RX 480 4GB</li><li>HDD Space: 150GB</li><li>Sound Card: DirectX compatible</li></ul>', 'ar'),
(4, '2019-12-05 11:53:56', '2019-12-05 11:57:17', 2, 'red dead redemption 2', 'red dead redemption 2', '<h3>Minimum Specifications:</h3><ul><li>OS: Windows 7 - Service Pack 1 (6.1.7601)</li><li>Processor: Intel Core i5-2500K / AMD FX-6300</li><li>Memory: 8GB</li><li>Graphics Card: Nvidia GeForce GTX 770 2GB / AMD Radeon R9 280 3GB</li><li>HDD Space: 150GB</li><li>Sound Card: DirectX compatible</li></ul><h3>Recommended Specifications:</h3><ul><li>OS: Windows 10 - April 2018 Update (v1803)</li><li>Processor: Intel Core i7-4770K / AMD Ryzen 5 1500X</li><li>Memory: 12GB</li><li>Graphics Card: Nvidia GeForce GTX 1060 6GB / AMD Radeon RX 480 4GB</li><li>HDD Space: 150GB</li><li>Sound Card: DirectX compatible</li></ul>', 'en'),
(5, '2019-12-05 15:36:52', '2019-12-05 15:36:52', 3, 'سكن الووندر (ميكاسا)', 'سكن الووندر (ميكاسا)', NULL, 'ar'),
(6, '2019-12-05 15:36:52', '2019-12-05 15:36:52', 3, 'Wonder Skin', 'Wonder Skin', NULL, 'en'),
(7, '2019-12-05 21:48:38', '2019-12-05 21:50:42', 4, 'بيس', 'dsfsdfsdf', '<p>تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت تست تست تيت&nbsp;</p>', 'ar'),
(8, '2019-12-05 21:48:38', '2019-12-05 21:50:42', 4, 'pes', 'sdsdfsdf', '<p>test test test test test test test test test test test test test test test test test test test test test test test test test test&nbsp;</p>', 'en');

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
(1, '2019-12-05 07:36:10', '2019-12-05 07:36:10', '1'),
(2, '2019-12-05 21:44:48', '2019-12-05 21:44:48', 'eg'),
(3, '2019-12-05 21:45:09', '2019-12-05 21:45:09', 'sa');

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
(1, '2019-12-05 07:36:10', '2019-12-05 07:36:10', 1, 'جميع العالم', 'ar'),
(2, '2019-12-05 07:36:10', '2019-12-05 07:36:10', 1, 'Global', 'en'),
(3, '2019-12-05 21:44:48', '2019-12-05 21:44:48', 2, 'مصر', 'ar'),
(4, '2019-12-05 21:44:48', '2019-12-05 21:44:48', 2, 'egypt', 'en'),
(5, '2019-12-05 21:45:09', '2019-12-05 21:45:09', 3, 'السعوديه', 'ar'),
(6, '2019-12-05 21:45:09', '2019-12-05 21:45:09', 3, 'saudia', 'en');

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
(1, 'super-admin', 'admin', '2019-12-06 06:44:46', '2019-12-06 06:44:46'),
(2, 'registered-users', 'web', '2019-12-06 06:44:49', '2019-12-06 06:44:49');

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
(66, 1);

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

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `email`, `logo`, `footer_logo`, `work_time`) VALUES
(1, '2019-12-05 21:08:32', '2019-12-05 21:09:38', 'admin@serv5.com', '/uploads/setting/1/1575587378.png', '/uploads/setting/1/1575587378.png', '12:59:00');

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

--
-- Dumping data for table `settings_translations`
--

INSERT INTO `settings_translations` (`id`, `created_at`, `updated_at`, `setting_id`, `title`, `address`, `description`, `locale`) VALUES
(1, NULL, NULL, 1, 'سوق ألعاب الشرق الأوسط', NULL, NULL, 'ar'),
(2, NULL, NULL, 1, 'Middle East Games Marketplace', NULL, NULL, 'en');

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
(1, '2019-12-04 15:35:24', '2019-12-04 15:35:24', 'Arabic', '/uploads/site_languages/1/1575480924.png', 'ar'),
(2, '2019-12-04 15:35:38', '2019-12-04 15:35:38', 'English', '/uploads/site_languages/2/1575480938.png', 'en');

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

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `created_at`, `updated_at`, `image`, `url`, `publish`) VALUES
(1, '2019-12-05 04:14:53', '2019-12-05 04:14:53', '/uploads/slider/1/1575526493.png', 'http://megmp.com/beta/public/', 1),
(2, '2019-12-05 04:16:40', '2019-12-05 04:16:40', '/uploads/slider/2/1575526600.png', 'http://megmp.com/beta/public/', 1),
(4, '2019-12-08 04:47:27', '2019-12-08 04:47:27', '/uploads/slider/4/1575787647.png', 'http://megmp.com/beta/public/product/2', 1);

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

--
-- Dumping data for table `sliders_translations`
--

INSERT INTO `sliders_translations` (`id`, `created_at`, `updated_at`, `slider_id`, `title`, `description`, `locale`) VALUES
(1, '2019-12-05 04:14:55', '2019-12-05 04:14:55', 1, 'العاب حرب', 'العاب حرب', 'ar'),
(2, '2019-12-05 04:14:55', '2019-12-05 04:14:55', 1, 'Battle Games', 'Battle Games', 'en'),
(3, '2019-12-05 04:16:40', '2019-12-05 04:16:40', 2, 'العاب مغامرة', 'العاب مغامرة', 'ar'),
(4, '2019-12-05 04:16:40', '2019-12-05 04:16:40', 2, 'action games', 'action games', 'en'),
(7, '2019-12-08 04:47:27', '2019-12-08 04:47:27', 4, 'سلايدر 3', NULL, 'ar'),
(8, '2019-12-08 04:47:27', '2019-12-08 04:47:27', 4, 'slider 3', NULL, 'en');

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

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `created_at`, `updated_at`) VALUES
(1, '2019-12-06 06:50:13', '2019-12-06 06:50:13');

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

--
-- Dumping data for table `tag_translations`
--

INSERT INTO `tag_translations` (`id`, `created_at`, `updated_at`, `tag_id`, `title`, `locale`) VALUES
(1, NULL, NULL, 1, 'تيست', 'ar'),
(2, NULL, NULL, 1, 'تيست', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','paid','refused') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_transactions_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_cvc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_expire` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2019-12-04 15:23:41', '2019-12-04 15:23:41', 'admin', 'admin', 'admin@admin.com', NULL, NULL, 'admin', NULL, '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, NULL, NULL, 'pZgBHA3T9njOJrTY5sPceV7ASi6Vjz6hPueOEMYBGHoX1afAU0AKMQzGRrx2'),
(2, '2019-12-05 07:32:28', '2019-12-05 21:37:35', 'XG', 'CARDS', 'obesoop@gmail.com', NULL, NULL, 'web', '0581237084', '$2y$10$Wy3Og6sR/sB9q7TxtlnxyOp8YPMA0D7aiH7kNSG53vAIVobAv1WU.', 1, 1, NULL, NULL, NULL),
(3, '2019-12-05 15:22:48', '2019-12-05 15:22:48', NULL, NULL, 'besps4kh@gmail.com', NULL, NULL, 'web', NULL, '$2y$10$o2ZdPFVLO1qb5iJHJvuy..3HRLA9xAeswE3bvBVR51wpzdtXHPw5u', NULL, NULL, NULL, NULL, NULL),
(4, '2019-12-05 15:38:58', '2019-12-05 15:38:58', NULL, NULL, '1besskrill@gmail.com', NULL, NULL, 'web', NULL, '$2y$10$XeZJ4wnlWjp0tzCJjsncMue91kmDxU7rJzTyqXEbWsVKOjam2aECS', NULL, NULL, NULL, NULL, NULL),
(5, '2019-12-05 22:01:44', '2019-12-05 22:01:44', 'ahmed', 'mohamed', 'ea2@hotmail.com', NULL, NULL, 'web', NULL, '$2y$10$pv4RU50yGcbNvfGr6ZE4hOQSx6bidY1MkEP2q5eiAMhXay7f7MpQW', NULL, NULL, NULL, NULL, NULL),
(6, '2019-12-07 11:22:05', '2019-12-07 11:22:05', NULL, NULL, 'ksadkaskd@gmail.com', NULL, NULL, 'web', NULL, '$2y$10$szFWTJP9rz4.nGCO34S9I.RbnO2W6/fg4DNJHLVa9XuSEBvSh71dK', NULL, NULL, NULL, NULL, NULL);

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
(1, '2019-12-05 07:39:11', '2019-12-05 07:39:11', NULL, 'EpicGames'),
(2, '2019-12-05 21:46:47', '2019-12-05 21:46:47', NULL, 'playstation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks_translations`
--
ALTER TABLE `banks_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banks_translations_bank_id_foreign` (`bank_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `transactions_bank_id_foreign` (`bank_id`);

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
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks_translations`
--
ALTER TABLE `banks_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blogs_products`
--
ALTER TABLE `blogs_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs_tags`
--
ALTER TABLE `blogs_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories_translations`
--
ALTER TABLE `blog_categories_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories_translations`
--
ALTER TABLE `categories_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `content_sections`
--
ALTER TABLE `content_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `content_sections_translations`
--
ALTER TABLE `content_sections_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries_regions`
--
ALTER TABLE `countries_regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries_translations`
--
ALTER TABLE `countries_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gamedetails_products`
--
ALTER TABLE `gamedetails_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_details`
--
ALTER TABLE `game_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `game_details_translations`
--
ALTER TABLE `game_details_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genres_products`
--
ALTER TABLE `genres_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genre_translations`
--
ALTER TABLE `genre_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages_products`
--
ALTER TABLE `languages_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages_translations`
--
ALTER TABLE `languages_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `platforms_translations`
--
ALTER TABLE `platforms_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products_codes`
--
ALTER TABLE `products_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_translations`
--
ALTER TABLE `products_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regions_translations`
--
ALTER TABLE `regions_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings_translations`
--
ALTER TABLE `settings_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_languages`
--
ALTER TABLE `site_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tag_translations`
--
ALTER TABLE `tag_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_ratings`
--
ALTER TABLE `users_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `works_on`
--
ALTER TABLE `works_on`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banks_translations`
--
ALTER TABLE `banks_translations`
  ADD CONSTRAINT `banks_translations_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
