-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2019 at 03:02 PM
-- Server version: 10.3.16-MariaDB
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
-- Database: `xcodenew`
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
(2, '/uploads/country/2/1574756918.png', 'eg', '2019-11-26 06:28:38', '2019-11-26 06:28:38'),
(3, '/uploads/country/3/1574757486.png', 'su', '2019-11-26 06:38:06', '2019-11-27 06:35:01');

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
(4, '2019-11-26 06:28:38', '2019-11-26 06:28:38', 2, 'مصر', 'ar'),
(5, '2019-11-26 06:28:38', '2019-11-26 06:28:38', 2, 'egypt', 'en'),
(6, '2019-11-26 06:28:38', '2019-11-26 06:28:38', 2, 'egypt french', 'fr'),
(7, '2019-11-26 06:38:06', '2019-11-26 06:38:06', 3, 'السودان', 'ar'),
(8, '2019-11-26 06:38:06', '2019-11-26 06:38:06', 3, 'sudan', 'en'),
(9, '2019-11-26 06:38:06', '2019-11-26 06:38:06', 3, 'sudan french', 'fr');

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
(2, 'su', 44, NULL, '2019-11-26 07:17:58', '2019-11-26 08:55:43');

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

-- --------------------------------------------------------

--
-- Table structure for table `gamedetails_products`
--

CREATE TABLE `gamedetails_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `game_detail_id` int(10) UNSIGNED NOT NULL,
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
(2, '2019-11-27 06:37:40', '2019-11-27 06:37:40', '/uploads/game_details/2/1574843860.png');

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
(4, '2019-11-27 06:37:40', '2019-11-27 06:37:40', 2, 'weew', 'ar'),
(5, '2019-11-27 06:37:40', '2019-11-27 06:37:40', 2, '4333', 'en'),
(6, '2019-11-27 06:37:40', '2019-11-27 06:37:40', 2, '3443443', 'fr');

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
(1, '2019-11-25 08:57:45', '2019-11-25 08:57:45'),
(2, '2019-11-25 09:22:33', '2019-11-25 09:22:33'),
(3, '2019-11-25 09:25:55', '2019-11-25 09:25:55'),
(4, '2019-11-25 09:26:46', '2019-11-25 09:26:46'),
(6, '2019-11-25 09:41:47', '2019-11-25 09:41:47'),
(10, '2019-11-26 10:13:52', '2019-11-26 10:13:52'),
(11, '2019-11-26 10:14:55', '2019-11-26 10:14:55');

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
(1, '2019-11-25 08:57:45', '2019-11-25 10:01:25', '7777', 'ar', 1),
(2, '2019-11-25 08:57:45', '2019-11-25 10:01:25', '767676', 'en', 1),
(3, '2019-11-25 08:57:46', '2019-11-25 10:01:25', '7676', 'fr', 1),
(4, '2019-11-25 09:22:34', '2019-11-25 09:22:34', 'genre 2 arabic', 'ar', 2),
(5, '2019-11-25 09:22:34', '2019-11-25 09:22:34', 'genre 2 english', 'en', 2),
(6, '2019-11-25 09:22:34', '2019-11-25 09:22:34', 'genre 2 french', 'fr', 2),
(7, '2019-11-25 09:25:55', '2019-11-25 09:25:55', '432323', 'ar', 3),
(8, '2019-11-25 09:25:55', '2019-11-25 09:25:55', '3232233', 'en', 3),
(9, '2019-11-25 09:25:55', '2019-11-25 09:25:55', '23322', 'fr', 3),
(10, '2019-11-25 09:26:46', '2019-11-25 09:26:46', '3w334', 'ar', 4),
(11, '2019-11-25 09:26:46', '2019-11-25 09:26:46', '44334', 'en', 4),
(12, '2019-11-25 09:26:46', '2019-11-25 09:26:46', '43433434', 'fr', 4),
(16, '2019-11-25 09:41:47', '2019-11-25 10:21:17', 'genere arabic', 'ar', 6),
(17, '2019-11-25 09:41:47', '2019-11-25 10:21:17', 'genere  english', 'en', 6),
(18, '2019-11-25 09:41:47', '2019-11-25 10:21:18', 'genere  french', 'fr', 6),
(28, '2019-11-26 10:13:52', '2019-11-26 10:15:03', 'dsdssd', 'ar', 10),
(29, '2019-11-26 10:13:52', '2019-11-26 10:15:03', 'dsdssd', 'en', 10),
(30, '2019-11-26 10:13:52', '2019-11-26 10:15:03', 'sddssd', 'fr', 10),
(31, '2019-11-26 10:14:55', '2019-11-26 10:14:55', '34t4', 'ar', 11),
(32, '2019-11-26 10:14:55', '2019-11-26 10:14:55', 'gggggggggggg', 'en', 11),
(33, '2019-11-26 10:14:55', '2019-11-26 10:14:55', 'rreerre', 'fr', 11);

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
(1, '2019-11-26 10:10:03', '2019-11-26 10:10:03'),
(2, '2019-11-26 10:14:20', '2019-11-26 10:14:20'),
(4, '2019-11-26 10:41:05', '2019-11-26 10:41:05');

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
(1, '2019-11-26 10:10:03', '2019-11-26 10:11:21', 'game lang 1 ar', 1, 'ar'),
(2, '2019-11-26 10:10:03', '2019-11-26 10:11:21', 'game lang 1 en', 1, 'en'),
(3, '2019-11-26 10:10:03', '2019-11-26 10:11:21', 'game lang 1 fr', 1, 'fr'),
(4, '2019-11-26 10:14:20', '2019-11-26 10:14:20', 'asasa', 2, 'ar'),
(5, '2019-11-26 10:14:21', '2019-11-26 10:14:21', 'ssasa', 2, 'en'),
(6, '2019-11-26 10:14:21', '2019-11-26 10:14:21', 'saass', 2, 'fr'),
(10, '2019-11-26 10:41:05', '2019-11-26 10:41:05', 'rtgtrere', 4, 'ar'),
(11, '2019-11-26 10:41:05', '2019-11-26 10:41:11', 'eeeeeeeeeeeee', 4, 'en'),
(12, '2019-11-26 10:41:05', '2019-11-26 10:41:05', 'rere', 4, 'fr');

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
(3, '2019_11_21_072242_create_Game_details_table', 1),
(4, '2019_11_21_072242_create_Products_Images_table', 1),
(5, '2019_11_21_072242_create_Social_links_table', 1),
(6, '2019_11_21_072242_create_blog_categories_table', 1),
(7, '2019_11_21_072242_create_blog_categories_translations_table', 1),
(8, '2019_11_21_072242_create_blog_translations_table', 1),
(9, '2019_11_21_072242_create_blogs_products_table', 1),
(10, '2019_11_21_072242_create_blogs_table', 1),
(11, '2019_11_21_072242_create_blogs_tags_table', 1),
(12, '2019_11_21_072242_create_categories_table', 1),
(13, '2019_11_21_072242_create_categories_translations_table', 1),
(14, '2019_11_21_072242_create_content_sections_products_table', 1),
(15, '2019_11_21_072242_create_content_sections_table', 1),
(16, '2019_11_21_072242_create_content_sections_translations_table', 1),
(17, '2019_11_21_072242_create_countries_regions_table', 1),
(18, '2019_11_21_072242_create_countries_table', 1),
(19, '2019_11_21_072242_create_countries_translations_table', 1),
(20, '2019_11_21_072242_create_currencies_table', 1),
(21, '2019_11_21_072242_create_currencies_translation_table', 1),
(22, '2019_11_21_072242_create_discount_codes_table', 1),
(23, '2019_11_21_072242_create_gameDetails_products_table', 1),
(24, '2019_11_21_072242_create_game_details_translations_table', 1),
(25, '2019_11_21_072242_create_genre_table', 1),
(26, '2019_11_21_072242_create_genre_translations_table', 1),
(27, '2019_11_21_072242_create_genres_products_table', 1),
(28, '2019_11_21_072242_create_languages_products_table', 1),
(29, '2019_11_21_072242_create_languages_table', 1),
(30, '2019_11_21_072242_create_languages_translations_table', 1),
(31, '2019_11_21_072242_create_newsletters_table', 1),
(32, '2019_11_21_072242_create_phones_table', 1),
(33, '2019_11_21_072242_create_platforms_table', 1),
(34, '2019_11_21_072242_create_platforms_translations_table', 1),
(35, '2019_11_21_072242_create_products_table', 1),
(36, '2019_11_21_072242_create_products_translations_table', 1),
(37, '2019_11_21_072242_create_ratings_table', 1),
(38, '2019_11_21_072242_create_regions_table', 1),
(39, '2019_11_21_072242_create_regions_translations_table', 1),
(40, '2019_11_21_072242_create_related_products_table', 1),
(41, '2019_11_21_072242_create_settings_table', 1),
(42, '2019_11_21_072242_create_settings_translations_table', 1),
(43, '2019_11_21_072242_create_site_languages_table', 1),
(44, '2019_11_21_072242_create_sliders_table', 1),
(45, '2019_11_21_072242_create_sliders_translations_table', 1),
(46, '2019_11_21_072242_create_tag_translations_table', 1),
(47, '2019_11_21_072242_create_tags_table', 1),
(48, '2019_11_21_072242_create_users_ratings_table', 1),
(49, '2019_11_21_072242_create_users_table', 1),
(50, '2019_11_21_072242_create_works_on_table', 1),
(51, '2019_11_21_072252_create_foreign_keys', 1),
(52, '2019_11_21_0072242_create_products_categories_table', 2),
(53, '2019_11_25_075757_create_files_table', 2),
(54, '2019_11_25_181531_create_currency_convertor_table', 3);

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
(1, 'App\\Admin', 2),
(2, 'App\\Admin', 1),
(2, 'App\\Admin', 2),
(3, 'App\\Admin', 1),
(3, 'App\\Admin', 2),
(4, 'App\\Admin', 1),
(4, 'App\\Admin', 2),
(5, 'App\\Admin', 1),
(5, 'App\\Admin', 2),
(6, 'App\\Admin', 1),
(7, 'App\\Admin', 1),
(7, 'App\\Admin', 2),
(8, 'App\\Admin', 1),
(8, 'App\\Admin', 2),
(9, 'App\\Admin', 1),
(9, 'App\\Admin', 2),
(10, 'App\\Admin', 1),
(10, 'App\\Admin', 2),
(11, 'App\\Admin', 1),
(11, 'App\\Admin', 2),
(12, 'App\\Admin', 1),
(12, 'App\\Admin', 2),
(13, 'App\\Admin', 1),
(13, 'App\\Admin', 2),
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
(63, 'App\\Admin', 1);

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
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(2, 'App\\User', 4);

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
(1, '2019-11-26 11:52:38', '2019-11-26 11:52:38', 'folla@yahoo.com');

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
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Permission-Add', 'admin', 'إضافة صلاحية', '2019-11-24 09:44:03', '2019-11-24 09:44:03'),
(2, 'Permission-Edit', 'admin', 'تعديل صلاحية', '2019-11-24 09:44:03', '2019-11-24 09:44:03'),
(3, 'Permission-Delete', 'admin', 'حذف صلاحية', '2019-11-24 09:44:03', '2019-11-24 09:44:03'),
(4, 'Role-Add', 'admin', 'اضافه مجموعه مستخدمين', '2019-11-24 09:44:04', '2019-11-24 09:44:04'),
(5, 'Role-Edit', 'admin', 'تعديل مجموعه مستخدمين', '2019-11-24 09:44:04', '2019-11-24 09:44:04'),
(6, 'Role-Delete', 'admin', 'حذف مجموعه مستخدمين', '2019-11-27 09:53:09', '2019-11-27 09:53:09'),
(7, 'Show-Adminpanel', 'admin', 'عرض لوحة التحكم', '2019-11-24 09:44:04', '2019-11-27 09:53:09'),
(8, 'AdminUser-Add', 'admin', 'اضافه ادمن', '2019-11-24 09:44:04', '2019-11-27 09:53:09'),
(9, 'AdminUser-Edit', 'admin', 'تعديل ادمن', '2019-11-24 09:44:04', '2019-11-27 09:53:09'),
(10, 'AdminUser-Delete', 'admin', 'حذف ادمن', '2019-11-24 09:44:04', '2019-11-27 09:53:09'),
(11, 'FrontUser-Add', 'admin', 'اضافه مستخدم', '2019-11-24 09:44:04', '2019-11-27 09:53:10'),
(12, 'FrontUser-Edit', 'admin', 'تعديل مستخدم', '2019-11-24 09:44:04', '2019-11-27 09:53:10'),
(13, 'FrontUser-Delete', 'admin', 'حذف مستخدم', '2019-11-24 09:44:05', '2019-11-27 09:53:10'),
(15, 'SiteSetting-Add', 'admin', 'إضافة إعدادات الموقع', '2019-11-27 10:10:08', '2019-11-27 10:10:08'),
(16, 'SiteLanguage-Add', 'admin', 'إضافة لغة للموقع', '2019-11-27 10:10:09', '2019-11-27 10:10:09'),
(17, 'SiteLanguage-Edit', 'admin', 'تعديل لغة للموقع', '2019-11-27 10:10:09', '2019-11-27 10:10:09'),
(18, 'SiteLanguage-Delete', 'admin', 'حذف لغة للموقع', '2019-11-27 10:10:09', '2019-11-27 10:10:09'),
(19, 'Country-Add', 'admin', 'إضافة دولة', '2019-11-27 10:10:09', '2019-11-27 10:10:09'),
(20, 'Country-Edit', 'admin', 'تعديل دولة', '2019-11-27 10:10:09', '2019-11-27 10:10:09'),
(21, 'Country-Delete', 'admin', 'حذف دولة', '2019-11-27 10:10:09', '2019-11-27 10:10:09'),
(22, 'Currency-Add', 'admin', 'إضافة عملة', '2019-11-27 10:10:10', '2019-11-27 10:10:10'),
(23, 'Currency-Edit', 'admin', 'تعديل عملة', '2019-11-27 10:10:10', '2019-11-27 10:10:10'),
(24, 'Currency-Delete', 'admin', 'حذف عملة', '2019-11-27 10:10:10', '2019-11-27 10:10:10'),
(25, 'GameLanguage-Add', 'admin', 'إضافة لغة للعبة', '2019-11-27 10:10:10', '2019-11-27 10:10:10'),
(26, 'GameLanguage-Edit', 'admin', 'تعديل لغة للعبة', '2019-11-27 10:10:10', '2019-11-27 10:10:10'),
(27, 'GameLanguage-Delete', 'admin', 'حذف لغة للعبة', '2019-11-27 10:10:10', '2019-11-27 10:10:10'),
(28, 'GameDetails-Add', 'admin', 'إضافة تفاصيل للعبة', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(29, 'GameDetails-Edit', 'admin', 'تعديل تفاصيل للعبة', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(30, 'GameDetails-Delete', 'admin', 'حذف تفاصيل للعبة', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(31, 'Slider-Add', 'admin', 'إضافة سليدر', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(32, 'Slider-Edit', 'admin', 'تعديل سليدر', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(33, 'Slider-Delete', 'admin', 'حذف سليدر', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(34, 'Region-Add', 'admin', 'إضافة منطقة', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(35, 'Region-Edit', 'admin', 'تعديل منطقة', '2019-11-27 10:10:11', '2019-11-27 10:10:11'),
(36, 'Region-Delete', 'admin', 'حذف منطقة', '2019-11-27 10:10:12', '2019-11-27 10:10:12'),
(37, 'Genres-Add', 'admin', 'إضافة نوع', '2019-11-27 10:10:12', '2019-11-27 10:10:12'),
(38, 'Genres-Edit', 'admin', 'تعديل نوع', '2019-11-27 10:10:12', '2019-11-27 10:10:12'),
(39, 'Genres-Delete', 'admin', 'حذف نوع', '2019-11-27 10:10:12', '2019-11-27 10:10:12'),
(40, 'PlatForm-Add', 'admin', 'إضافة منصة', '2019-11-27 10:10:12', '2019-11-27 10:10:12'),
(41, 'PlatForm-Edit', 'admin', 'تعديل منصة', '2019-11-27 10:10:12', '2019-11-27 10:10:12'),
(42, 'PlatForm-Delete', 'admin', 'حذف منصة', '2019-11-27 10:10:12', '2019-11-27 10:10:12'),
(43, 'ProductCategory-Add', 'admin', 'إضافة قسم للمنتجات', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(44, 'ProductCategory-Edit', 'admin', 'تعديل قسم للمنتجات', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(45, 'ProductCategory-Delete', 'admin', 'حذف قسم للمنتجات', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(46, 'Product-Add', 'admin', 'إضافة منتج', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(47, 'Product-Edit', 'admin', 'تعديل منتج', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(48, 'Product-Delete', 'admin', 'حذف منتج', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(49, 'WorkOn-Add', 'admin', 'إضافة العمل علي', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(50, 'WorkOn-Edit', 'admin', 'تعديل العمل علي', '2019-11-27 10:10:13', '2019-11-27 10:10:13'),
(51, 'WorkOn-Delete', 'admin', 'حذف العمل علي', '2019-11-27 10:10:14', '2019-11-27 10:10:14'),
(52, 'Tag-Add', 'admin', 'إضافة تاج', '2019-11-27 10:10:14', '2019-11-27 10:10:14'),
(53, 'Tag-Edit', 'admin', 'تعديل تاج', '2019-11-27 10:10:14', '2019-11-27 10:10:14'),
(54, 'Tag-Delete', 'admin', 'حذف تاج', '2019-11-27 10:10:14', '2019-11-27 10:10:14'),
(55, 'BlogCategory-Add', 'admin', 'إضافة قسم للمدونة', '2019-11-27 10:10:14', '2019-11-27 10:10:14'),
(56, 'BlogCategory-Edit', 'admin', 'تعديل قسم للمدونة', '2019-11-27 10:10:15', '2019-11-27 10:10:15'),
(57, 'BlogCategory-Delete', 'admin', 'حذف قسم للمدونة', '2019-11-27 10:10:15', '2019-11-27 10:10:15'),
(58, 'Blog-Add', 'admin', 'إضافة مدونة', '2019-11-27 10:10:15', '2019-11-27 10:10:15'),
(59, 'Blog-Edit', 'admin', 'تعديل مدونة', '2019-11-27 10:10:15', '2019-11-27 10:10:15'),
(60, 'Blog-Delete', 'admin', 'حذف مدونة', '2019-11-27 10:10:15', '2019-11-27 10:10:15'),
(61, 'SiteSetting-Add', 'admin', NULL, '2019-11-27 10:09:42', '2019-11-27 10:09:42'),
(62, 'NewsLetter-Add', 'admin', NULL, '2019-11-27 10:14:07', '2019-11-27 10:14:07'),
(63, 'ShowAdminPanel', 'admin', NULL, '2019-11-27 11:52:51', '2019-11-27 11:52:51');

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
(2, '2019-11-25 11:19:28', '2019-11-25 12:36:31', '/uploads/platform/2/1574692591.png'),
(3, '2019-11-25 11:22:56', '2019-11-25 12:36:23', '/uploads/platform/3/1574692583.png'),
(4, '2019-11-25 12:34:27', '2019-11-25 12:34:27', '/uploads/platform/4/1574692467.png'),
(5, '2019-11-25 12:36:08', '2019-11-25 12:36:08', '/uploads/platform/5/1574692568.png'),
(6, '2019-11-26 05:18:54', '2019-11-26 05:18:54', '/uploads/platform/6/1574752734.png');

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
(4, '2019-11-25 11:19:28', '2019-11-25 12:36:31', 2, 'plat form 156 ar', 'ar'),
(5, '2019-11-25 11:19:28', '2019-11-25 12:20:17', 2, 'plat form 1 en', 'en'),
(6, '2019-11-25 11:19:28', '2019-11-25 12:20:17', 2, 'plat form 1 fr', 'fr'),
(7, '2019-11-25 11:22:56', '2019-11-25 12:36:23', 3, 'www65656', 'ar'),
(8, '2019-11-25 11:22:56', '2019-11-25 11:22:56', 3, 'ewew', 'en'),
(9, '2019-11-25 11:22:57', '2019-11-25 11:22:57', 3, 'eeew', 'fr'),
(10, '2019-11-25 12:34:27', '2019-11-25 12:35:54', 4, 'rrereer565656', 'ar'),
(11, '2019-11-25 12:34:27', '2019-11-25 12:34:27', 4, 'eeer', 'en'),
(12, '2019-11-25 12:34:27', '2019-11-25 12:34:27', 4, 'wewee', 'fr'),
(13, '2019-11-25 12:36:08', '2019-11-25 12:36:08', 5, '3423232', 'ar'),
(14, '2019-11-25 12:36:08', '2019-11-25 12:36:08', 5, '323232', 'en'),
(15, '2019-11-25 12:36:08', '2019-11-25 12:36:08', 5, '3223321', 'fr'),
(16, '2019-11-26 05:18:54', '2019-11-26 05:18:55', 6, 'dsdsds', 'ar'),
(17, '2019-11-26 05:18:55', '2019-11-26 05:18:55', 6, 'dsdds', 'en'),
(18, '2019-11-26 05:18:55', '2019-11-26 05:18:55', 6, 'ffddf', 'fr');

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
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `developers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publishers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `works_on_id` int(10) UNSIGNED DEFAULT NULL,
  `platform_id` int(10) UNSIGNED DEFAULT NULL,
  `region_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL
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
  `System_requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2019-11-25 06:26:20', '2019-11-25 06:26:20', 'errr22'),
(4, '2019-11-25 06:33:03', '2019-11-25 06:33:03', 'ereee'),
(5, '2019-11-25 06:35:18', '2019-11-25 06:35:18', 'eeer');

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
(1, '2019-11-25 06:33:03', '2019-11-25 06:33:03', 4, 'region 2 arabic', 'ar'),
(2, '2019-11-25 06:33:03', '2019-11-25 06:33:03', 4, 'region 2  english', 'en'),
(3, '2019-11-25 06:33:03', '2019-11-25 06:33:03', 4, 'region 2  french', 'fr'),
(4, '2019-11-25 06:35:18', '2019-11-25 06:35:18', 5, 'region 3 arabic', 'ar'),
(5, '2019-11-25 06:35:18', '2019-11-25 06:35:18', 5, 'region 3 english', 'en'),
(6, '2019-11-25 06:35:19', '2019-11-25 06:35:19', 5, 'region 3 french', 'fr');

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
(1, 'super-admin', 'admin', '2019-11-24 09:44:03', '2019-11-24 09:44:03'),
(2, 'registered-users', 'web', '2019-11-24 09:44:05', '2019-11-24 09:44:05');

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
(63, 1);

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
(1, '2019-11-24 09:44:57', '2019-11-24 09:44:57', 'arabic', '/uploads/site_languages/1/1574595897.png', 'ar'),
(2, '2019-11-24 09:45:12', '2019-11-24 09:45:12', 'english', '/uploads/site_languages/2/1574595912.png', 'en'),
(3, '2019-11-24 09:45:41', '2019-11-24 09:45:41', 'french', '/uploads/site_languages/3/1574595941.png', 'fr');

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
(1, '2019-11-24 09:46:44', '2019-11-25 05:51:34', '/uploads/slider/1/1574596004.png', 'http://127.0.0.1:8000/home', 1),
(2, '2019-11-24 09:47:34', '2019-11-24 09:47:34', '/uploads/slider/2/1574596054.png', 'http://127.0.0.1:8000/home', 1),
(3, '2019-11-24 09:51:29', '2019-11-24 09:51:29', '/uploads/slider/3/1574596289.png', 'http://127.0.0.1:8000/home', 1),
(4, '2019-11-24 09:52:46', '2019-11-24 09:52:46', '/uploads/slider/4/1574596366.png', 'http://127.0.0.1:8000/home', 1),
(5, '2019-11-24 09:54:03', '2019-11-24 09:54:03', '/uploads/slider/5/1574596443.png', 'http://127.0.0.1:8000/home', 1),
(6, '2019-11-24 09:56:43', '2019-11-24 09:56:43', '/uploads/slider/6/1574596603.png', 'http://127.0.0.1:8000/home', 1);

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
(1, '2019-11-24 09:46:44', '2019-11-24 09:58:52', 1, NULL, NULL, 'ar'),
(2, '2019-11-24 09:46:44', '2019-11-24 09:58:52', 1, NULL, NULL, 'en'),
(3, '2019-11-24 09:46:44', '2019-11-24 09:46:44', 1, 'french slider1', 'french slider1', 'fr'),
(4, '2019-11-24 09:47:34', '2019-11-24 09:47:34', 2, 'arabic slider 2', 'arabic slider 2', 'ar'),
(5, '2019-11-24 09:47:34', '2019-11-24 09:47:34', 2, 'english slider 2', 'english slider 2', 'en'),
(6, '2019-11-24 09:47:35', '2019-11-24 09:47:35', 2, 'french slider 2', 'french slider 2', 'fr'),
(7, '2019-11-24 09:51:29', '2019-11-24 09:51:29', 3, 'arabic slider 3', 'arabic slider 3', 'ar'),
(8, '2019-11-24 09:51:29', '2019-11-24 09:51:29', 3, 'english slider 3', 'english slider 3', 'en'),
(9, '2019-11-24 09:51:29', '2019-11-24 09:51:29', 3, 'french slider 3', 'french slider 3', 'fr'),
(10, '2019-11-24 09:52:46', '2019-11-24 09:52:46', 4, 'arabic slider 4', 'arabic slider 4', 'ar'),
(11, '2019-11-24 09:52:46', '2019-11-24 09:52:46', 4, 'english slider 4', 'english slider 4', 'en'),
(12, '2019-11-24 09:52:46', '2019-11-24 09:52:46', 4, 'french slider4', 'french slider4', 'fr'),
(13, '2019-11-24 09:54:03', '2019-11-24 09:54:03', 5, 'arabic slider5', 'arabic slider5', 'ar'),
(14, '2019-11-24 09:54:03', '2019-11-24 09:54:03', 5, 'english slider5', 'english slider5', 'en'),
(15, '2019-11-24 09:54:03', '2019-11-24 09:54:03', 5, 'french slider5', 'french slider5', 'fr'),
(16, '2019-11-24 09:56:43', '2019-11-24 09:56:43', 6, 'arabic slider 6', 'arabic slider 6', 'ar'),
(17, '2019-11-24 09:56:43', '2019-11-24 09:56:43', 6, 'english slider 6', 'english slider 6', 'en'),
(18, '2019-11-24 09:56:43', '2019-11-24 09:56:43', 6, 'french slider 6', 'french slider 6', 'fr');

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
  `guard` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'web',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `first_name`, `last_name`, `email`, `guard`, `email_verified_at`, `image`, `mobile`, `password`, `country_id`, `site_language_id`, `provider`, `provider_id`, `remember_token`) VALUES
(1, NULL, '2019-11-27 07:34:31', 'admin', 'admona', 'admin@admin.com', 'admin', NULL, NULL, '1234543', '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, NULL, NULL, NULL),
(2, '2019-11-26 11:43:16', '2019-11-27 07:39:44', 'shimaa', 'ahmed', 'shimaa@yahoo.com', 'admin', NULL, NULL, '435445', '$2y$10$ZuPg1Gr31ows.BJhgEJG0.AkUNhPf4ww6geaAL2Y0qwy5p5xyuZcy', NULL, NULL, NULL, NULL, NULL),
(3, '2019-11-26 11:44:18', '2019-11-26 11:44:18', 'shimaa', 'ahmed', 'shimaa1@yahoo.com', 'web', NULL, NULL, NULL, '$2y$10$rzjm.DoLLY94Y0egBAW20uBBqlxcJ.iwy.8Z3FxyTJkLjfK9HxzeO', NULL, NULL, NULL, NULL, NULL),
(4, '2019-11-26 11:52:38', '2019-11-26 11:52:38', 'folla', 'ahmed', 'folla@yahoo.com', 'web', NULL, NULL, NULL, '$2y$10$5nopxJ0f0DpHA2KcAXdwI.U37Kg6PABNTDlx1WdYU3/t5hEW9ZAfG', NULL, NULL, NULL, NULL, NULL),
(5, '2019-11-27 07:10:27', '2019-11-27 07:15:51', 'shimaa', 'naga', 'shimaa_naga@yahoo.com', 'web', NULL, NULL, NULL, '$2y$10$d.EH5tDgIoZ2938RkTwqOuo./CZFsFgrXPUPnC6PCOGsi3h2nA.v2', NULL, NULL, NULL, NULL, NULL),
(6, '2019-11-27 07:27:07', '2019-11-27 07:27:07', 'user', 'xcard', 'user_one@xcard.com', 'web', NULL, NULL, NULL, '$2y$10$bEbxG5sVQYIA67SIRALZXOvlXcP0eY/h7yK4faf1fWWngR4X98WJW', NULL, NULL, NULL, NULL, NULL),
(7, '2019-11-27 08:04:30', '2019-11-27 08:04:30', 'test', 'test last', 'test@test.com', 'web', NULL, NULL, '5455656', '$2y$10$L1TxaTm19wvdzW9Q1osRF.OdvXC71I3zgw6GLEFdWol5E7xPo3.iS', NULL, NULL, NULL, NULL, NULL);

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
(6, '2019-11-24 12:37:55', '2019-11-26 04:52:03', '/uploads/works_on/6/1574751123.png', '455454'),
(8, '2019-11-24 12:39:53', '2019-11-24 12:39:53', NULL, 'icon'),
(9, '2019-11-24 12:39:58', '2019-11-25 04:56:05', NULL, 'iconfcff'),
(11, '2019-11-24 12:41:23', '2019-11-24 12:41:23', NULL, 'rrrr'),
(12, '2019-11-24 12:43:48', '2019-11-24 12:43:48', NULL, 'ttt'),
(13, '2019-11-24 12:43:57', '2019-11-24 12:43:57', NULL, 'tttdfdd'),
(17, '2019-11-24 12:46:09', '2019-11-24 12:46:09', NULL, 'errer'),
(18, '2019-11-24 12:49:11', '2019-11-24 12:49:11', '/uploads/works_on/18/1574606951.png', 'tttr'),
(20, '2019-11-25 04:59:52', '2019-11-25 04:59:52', '/uploads/works_on/20/1574665192.png', 'ytyyyytyyyttttttttt');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories_translations`
--
ALTER TABLE `categories_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currencies_translation`
--
ALTER TABLE `currencies_translation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currency_convertor`
--
ALTER TABLE `currency_convertor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gamedetails_products`
--
ALTER TABLE `gamedetails_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_details`
--
ALTER TABLE `game_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `game_details_translations`
--
ALTER TABLE `game_details_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `genres_products`
--
ALTER TABLE `genres_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre_translations`
--
ALTER TABLE `genre_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `languages_products`
--
ALTER TABLE `languages_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages_translations`
--
ALTER TABLE `languages_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `platforms_translations`
--
ALTER TABLE `platforms_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `regions_translations`
--
ALTER TABLE `regions_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_ratings`
--
ALTER TABLE `users_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `works_on`
--
ALTER TABLE `works_on`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
