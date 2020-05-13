-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 12:56 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezwag`
--

-- --------------------------------------------------------

--
-- Table structure for table `album_categories`
--

CREATE TABLE `album_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(11) UNSIGNED DEFAULT NULL,
  `published` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album_categories`
--

INSERT INTO `album_categories` (`id`, `user_id`, `published`, `block`, `created_at`, `updated_at`) VALUES
(9, 74, 'true', 'false', '2019-12-17 06:15:25', '2019-12-17 06:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `album_category_data`
--

CREATE TABLE `album_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `album_category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album_category_data`
--

INSERT INTO `album_category_data` (`id`, `category`, `lang_id`, `album_category_id`, `created_at`, `updated_at`) VALUES
(17, 'ar name', 1, 9, '2019-12-17 06:15:26', '2019-12-17 06:24:55'),
(18, 'en name', 2, 9, '2019-12-17 06:15:26', '2019-12-17 06:24:55'),
(19, 'fr name', 5, 9, '2019-12-17 06:15:26', '2019-12-17 06:24:55'),
(20, 'po name', 6, 9, '2019-12-17 06:15:26', '2019-12-17 06:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `artcl_categories`
--

CREATE TABLE `artcl_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artcl_categories`
--

INSERT INTO `artcl_categories` (`id`, `source_id`, `lang_id`, `title`, `img_url`, `created_at`, `updated_at`) VALUES
(11, NULL, 1, 'مقال جديد', '8DBVp3GF6nIdkB3d5WEm5jKmjWZRcl19EWhhK74D.png', '2019-10-13 08:29:42', '2019-10-13 08:29:42'),
(12, NULL, 1, 'مقال جديد جديد', '77Mi2GYd4P73tigwSRuWEoVjbwTOXLyL7uYr3T5t.jpeg', '2019-10-13 08:30:13', '2019-10-13 08:30:13'),
(13, 11, 2, 'new article', '8DBVp3GF6nIdkB3d5WEm5jKmjWZRcl19EWhhK74D.png', '2019-10-13 08:10:06', '2019-10-13 08:10:06'),
(14, 12, 2, 'new article new', '77Mi2GYd4P73tigwSRuWEoVjbwTOXLyL7uYr3T5t.jpeg', '2019-10-13 08:10:06', '2019-10-13 08:10:06'),
(15, NULL, 1, 'جديد جديد', 'oFGvbEqhkUvisIXx9JOMcKelftnVk8tpjDDx7Rh7.png', '2019-10-13 09:14:23', '2019-10-13 09:14:23'),
(16, 15, 2, 'newsssssssssssss', 'oFGvbEqhkUvisIXx9JOMcKelftnVk8tpjDDx7Rh7.png', '2019-10-13 11:10:42', '2019-10-13 11:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `img_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publishe` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `lang_id`, `source_id`, `img_url`, `publishe`, `created`) VALUES
(20, 11, 1, NULL, 'BKUTLswpmpePejXkbG3BSqILAY1s9UbaQCl6SVua.jpeg', 'false', '2019-10-15 00:00:00'),
(21, 12, 1, NULL, 'FrvQtdd5vITxVve7yL6Wk2cGbYtc3bYFkIS7KjuC.jpeg', 'true', '2019-10-23 00:00:00'),
(22, 11, 1, NULL, 'RxMQnfXVtioe6TFwZgoW3AYQ40S9Sdnp511KvwEB.png', 'true', '2019-10-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `category_id`, `article_id`, `created_at`, `updated_at`) VALUES
(10, 11, 20, NULL, NULL),
(11, 11, 21, NULL, NULL),
(12, 15, 22, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_datas`
--

CREATE TABLE `article_datas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_datas`
--

INSERT INTO `article_datas` (`id`, `source_id`, `lang_id`, `title`, `content`, `article_id`, `created`, `created_at`, `updated_at`) VALUES
(17, NULL, 1, 'مقال جديد جديد جديد', '<p>بلللللللللللللل يبريبري</p>', 20, '2019-10-15 00:00:00', NULL, NULL),
(18, NULL, 1, 'جديد جديد جديد', '<p>بليبلبيلبي</p>', 21, '2019-10-23 00:00:00', NULL, NULL),
(19, 17, 2, 'new new new article', 'asdasdddaaaasasd', 20, '2019-10-15 00:00:00', '2019-10-13 08:10:33', '2019-10-13 08:10:33'),
(20, 18, 2, 'new new new', 'asdadasd', 21, '2019-10-23 00:00:00', '2019-10-13 08:10:33', '2019-10-13 08:10:33'),
(21, NULL, 1, 'يسبسيبسيبسيبسيبسي', 'سيبيسبيسسبسبييسب', 22, '2019-10-22 00:00:00', NULL, NULL),
(22, 21, 2, 'asassssssssssssssssssssssssssss', 'ssssssssssssssssssssssss', 22, '2019-10-22 00:00:00', '2019-10-13 11:10:16', '2019-10-13 11:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `image`, `code`, `created_at`, `updated_at`) VALUES
(7, 's83zXabTPHBEy45PPjTVKvMhheznaVWmRJq4AlIg.png', 21312312, '2019-12-13 05:35:50', '2019-12-13 05:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `bank_data`
--

CREATE TABLE `bank_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_data`
--

INSERT INTO `bank_data` (`id`, `name`, `created_at`, `updated_at`, `bank_id`, `lang_id`, `source_id`) VALUES
(5, 'البنك الاهلي', '2019-12-13 05:35:50', '2019-12-13 05:35:50', 7, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `section_id`, `start_date`, `end_date`, `image`, `created_at`, `updated_at`) VALUES
(10, 15, '2019-12-13', '2019-12-20', 'tNNxRv3WokZk9Y4TUsS5qOjBfHNzqqLqBHXspjQW.png', '2019-12-12 04:06:58', '2019-12-17 06:30:39'),
(13, 16, '2019-12-19', '2019-12-27', 'iJOGtL3OZxClET0UILOE9m8ekB3ndrDVJx11k99m.png', '2019-12-17 00:13:00', '2019-12-17 00:13:00'),
(14, 16, '2019-12-26', '2019-12-27', '1UjKvDuQHL6Rm0PCDPmFzFc8EkJn7rQO0JDtsU18.png', '2019-12-17 00:13:50', '2019-12-17 00:13:50'),
(15, 15, '2019-12-20', '2019-12-20', 'HJvrBP1htVwAelixEsNISWCQAMcW20rZL7oE3Ydl.png', '2019-12-17 00:14:22', '2019-12-17 00:14:22'),
(16, 15, '2019-12-20', '2019-12-27', 'g38Xe6eCm1GmQkpqfJiN03GXAtOPy0zCBDfronMh.png', '2019-12-17 00:14:56', '2019-12-17 00:14:56'),
(17, 16, '2019-12-19', '2019-12-28', 'edlLWkDxiEmIuaCT27QGUBqJyfoWNYwbTM5WcVxp.png', '2019-12-17 00:15:33', '2019-12-17 00:15:33'),
(18, 16, '2019-12-18', '2019-12-28', 'cJRE7J9n3NgOQQ53zgFliYVmDtFDadABGwfc8gFB.png', '2019-12-17 00:19:39', '2019-12-17 01:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `banner_data`
--

CREATE TABLE `banner_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(11) UNSIGNED NOT NULL,
  `source_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_data`
--

INSERT INTO `banner_data` (`id`, `banner_id`, `title`, `description`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(9, 10, 'sadf', '<p>asdfasdf</p>', 1, NULL, '2019-12-12 04:06:58', '2019-12-17 06:30:40'),
(12, 13, 'asdasd', '<p>asdasdasd</p>', 1, NULL, '2019-12-17 00:13:00', '2019-12-17 00:13:00'),
(13, 14, 'ds', '<p>dsfdsfdsafsdsd</p>', 1, NULL, '2019-12-17 00:13:50', '2019-12-17 00:13:50'),
(14, 15, 'asda', '<p>assasdasd</p>', 1, NULL, '2019-12-17 00:14:22', '2019-12-17 00:14:22'),
(15, 16, 'sadsaasd', '<p>sadsadsadasd</p>', 2, NULL, '2019-12-17 00:14:56', '2019-12-17 00:14:56'),
(16, 17, 'asadasd', '<p>sadsa</p>', 1, NULL, '2019-12-17 00:15:33', '2019-12-17 00:15:33'),
(17, 18, 'sadasdsadasd', '<p>asdsadsadsad</p>', 5, NULL, '2019-12-17 00:19:39', '2019-12-17 01:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `lang_id`, `created_at`, `updated_at`, `source_id`) VALUES
(1, 'onecat', 1, '2019-09-06 03:42:31', '2019-09-06 04:41:37', NULL),
(3, 'catTwo', 1, '2019-09-09 01:07:34', '2019-09-09 01:07:34', NULL),
(4, 'asdasd', 1, '2019-09-15 04:21:57', '2019-09-15 04:21:57', NULL),
(5, 'department 1', 2, '2019-09-16 23:09:52', '2019-10-04 16:30:02', 1),
(6, 'department 2', 2, '2019-09-16 23:09:08', '2019-10-04 16:30:10', 3),
(7, 'department 3', 2, '2019-09-16 23:09:08', '2019-10-04 16:30:23', 4),
(8, 'asda', 1, '2019-09-16 23:09:33', '2019-09-16 23:09:33', 1),
(9, 'sdfsad', 2, '2019-10-05 06:57:44', '2019-10-05 06:57:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalty_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `code`, `nationalty_id`, `created_at`, `updated_at`) VALUES
(5, NULL, 290, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities_data`
--

CREATE TABLE `cities_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities_data`
--

INSERT INTO `cities_data` (`id`, `name`, `city_id`, `lang_id`, `created_at`, `updated_at`) VALUES
(2, 'Berenice', 5, 1, NULL, NULL),
(3, 'Beni Mazar', 5, 1, NULL, NULL),
(4, 'Samalut', 5, 1, NULL, NULL),
(5, 'El Mansura', 5, 1, NULL, NULL),
(6, 'Mallawi', 5, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `title`, `content`, `created_at`, `updated_at`) VALUES
(3, 'ahmed@ahmed.com', 'edfsdsf', 'dsfsdfsdfds', '2019-09-26 04:38:54', '2019-09-26 04:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `content_section`
--

CREATE TABLE `content_section` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `columns` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `system_type` enum('main','single') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_section`
--

INSERT INTO `content_section` (`id`, `title`, `columns`, `order`, `system_type`, `created_at`, `updated_at`, `type`) VALUES
(15, 'sadfsadfdsaf', 1, 3, 'main', '2019-12-12 00:48:56', '2019-12-12 00:53:56', 'home'),
(16, 'sdafsadfasdfasd', 2, 2, 'main', '2019-12-12 00:49:07', '2019-12-12 00:53:56', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `content_section_data`
--

CREATE TABLE `content_section_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_section_data`
--

INSERT INTO `content_section_data` (`id`, `section_id`, `lang_id`, `source_id`, `content`, `created_at`, `updated_at`) VALUES
(17, 15, 1, NULL, '<p>dsfsdafsdafasdfasdf</p>', '2019-12-12 00:48:56', '2019-12-12 00:48:56'),
(18, 16, 5, NULL, '<p>asdfasf</p>', '2019-12-12 00:49:08', '2019-12-12 00:49:08'),
(19, 16, 5, NULL, '<p>sdafsdf</p>', '2019-12-12 00:49:08', '2019-12-12 00:49:08');

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
(33, '/uploads/banner/18/1576516472Screenshot (7).png', 0, '1576516472Screenshot (7).png', 18, 'App\\Models\\Banner', '2019-12-17 01:14:32', '2019-12-17 01:14:32'),
(34, '/uploads/banner/18/1576516515Screenshot (25).png', 0, '1576516515Screenshot (25).png', 18, 'App\\Models\\Banner', '2019-12-17 01:15:15', '2019-12-17 01:15:15'),
(44, '/uploads/users/74/1576522169Screenshot (21).png', 0, '1576522169Screenshot (21).png', 74, 'App\\Models\\User', '2019-12-17 02:49:29', '2019-12-17 02:49:29'),
(47, '/uploads/users/74/1576522815Screenshot (26).png', 0, '1576522815Screenshot (26).png', 74, 'App\\Models\\User', '2019-12-17 03:00:15', '2019-12-17 03:00:15'),
(48, '/uploads/users/74/1576522815Screenshot (27).png', 0, '1576522815Screenshot (27).png', 74, 'App\\Models\\User', '2019-12-17 03:00:15', '2019-12-17 03:00:15'),
(49, '/uploads/users/74/1576525735Screenshot (26).png', 0, '1576525735Screenshot (26).png', 74, 'App\\Models\\User', '2019-12-17 03:48:55', '2019-12-17 03:48:55'),
(51, '/uploads/banner/10/1576535349Screenshot (2).png', 0, '1576535349Screenshot (2).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:09', '2019-12-17 06:29:09'),
(52, '/uploads/banner/10/1576535350Screenshot (3).png', 0, '1576535350Screenshot (3).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:10', '2019-12-17 06:29:10'),
(53, '/uploads/banner/10/1576535350Screenshot (4).png', 0, '1576535350Screenshot (4).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:10', '2019-12-17 06:29:10'),
(54, '/uploads/banner/10/1576535351Screenshot (5).png', 0, '1576535351Screenshot (5).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:11', '2019-12-17 06:29:11'),
(55, '/uploads/banner/10/1576535352Screenshot (6).png', 0, '1576535352Screenshot (6).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:12', '2019-12-17 06:29:12'),
(56, '/uploads/banner/10/1576535352Screenshot (7).png', 0, '1576535352Screenshot (7).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:12', '2019-12-17 06:29:12'),
(57, '/uploads/banner/10/1576535353Screenshot (8).png', 0, '1576535353Screenshot (8).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:13', '2019-12-17 06:29:13'),
(58, '/uploads/banner/10/1576535353Screenshot (9).png', 0, '1576535353Screenshot (9).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:13', '2019-12-17 06:29:13'),
(59, '/uploads/banner/10/1576535354Screenshot (11).png', 0, '1576535354Screenshot (11).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:14', '2019-12-17 06:29:14'),
(60, '/uploads/banner/10/1576535354Screenshot (12).png', 0, '1576535354Screenshot (12).png', 10, 'App\\Models\\Banner', '2019-12-17 06:29:14', '2019-12-17 06:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ar', 'ar', NULL, NULL),
(2, 'en', 'en', NULL, NULL),
(5, 'fr', 'française', NULL, NULL),
(6, 'po', 'bosanski', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_status`
--

CREATE TABLE `material_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gender` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_status`
--

INSERT INTO `material_status` (`id`, `name`, `lang_id`, `source_id`, `gender`, `created_at`, `updated_at`) VALUES
(21, 'اعزب', 1, NULL, 'male', '2019-10-13 07:18:10', '2019-10-13 07:43:27'),
(22, 'مطلق', 1, NULL, 'male', '2019-10-13 07:18:31', '2019-10-13 07:18:31'),
(23, 'انسة', 1, NULL, 'female', '2019-10-13 07:18:47', '2019-10-13 07:18:47'),
(24, 'مطلقة', 1, NULL, 'female', '2019-10-13 07:18:55', '2019-10-13 07:18:55'),
(25, 'single', 2, 21, 'male', '2019-10-13 07:10:01', '2019-10-13 07:10:01'),
(26, 'verg', 2, 23, 'female', '2019-10-13 07:10:01', '2019-10-13 07:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'USD',
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `name`, `cost`, `years`, `currency`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(7, 'member2', '22', '2', 'USD', 1, NULL, '2019-09-06 02:46:31', '2019-09-09 00:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `membership_data_types`
--

CREATE TABLE `membership_data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `memberShip_type_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_data_types`
--

INSERT INTO `membership_data_types` (`id`, `memberShip_type_id`, `name`, `description`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(4, 5, 'العضوية الذهبية', '<p>asddasas</p>', 1, NULL, '2019-12-12 05:27:15', '2019-12-13 02:00:19'),
(8, 9, 'العضوة البرونزية', '<p>شسشسيشسي</p>', 1, NULL, '2019-12-13 02:00:38', '2019-12-13 02:10:28'),
(9, 10, 'العضوية الفضية', '<p>سيسشبشسبسشبشسيشسشسيبيس</p>', 1, NULL, '2019-12-13 02:09:36', '2019-12-13 02:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `membership_options`
--

CREATE TABLE `membership_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `membership_type_id` int(10) UNSIGNED NOT NULL,
  `options` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_options`
--

INSERT INTO `membership_options` (`id`, `created_at`, `updated_at`, `membership_type_id`, `options`) VALUES
(30, '2019-12-13 02:00:19', '2019-12-13 02:00:19', 5, 'asdasd'),
(31, '2019-12-13 02:00:19', '2019-12-13 02:00:19', 5, 'asdsadasdsa'),
(32, '2019-12-13 02:00:19', '2019-12-13 02:00:19', 5, 'ghfjgjghjgfh'),
(33, '2019-12-13 02:00:19', '2019-12-13 02:00:19', 5, 'asasdas'),
(34, '2019-12-13 02:10:28', '2019-12-13 02:10:28', 9, 'شسيسشي'),
(35, '2019-12-13 02:10:28', '2019-12-13 02:10:28', 9, 'شسشسيسشي'),
(36, '2019-12-13 02:10:28', '2019-12-13 02:10:28', 9, 'شيشسيسشيشس'),
(40, '2019-12-13 02:12:59', '2019-12-13 02:12:59', 10, 'سيبشسيبسيشبشسبيشسي'),
(41, '2019-12-13 02:12:59', '2019-12-13 02:12:59', 10, 'سيبليبل'),
(42, '2019-12-13 02:12:59', '2019-12-13 02:12:59', 10, 'شسيشسيشسيش');

-- --------------------------------------------------------

--
-- Table structure for table `membership_types`
--

CREATE TABLE `membership_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_types`
--

INSERT INTO `membership_types` (`id`, `image`, `created_at`, `updated_at`, `type`, `price`, `expire_date`) VALUES
(5, 'bada6NOdUMcZEkaJVYsqbSsQztMPcVDzUYx6Jw6j.jpeg', '2019-12-12 05:27:15', '2019-12-13 01:54:28', 'male', 260, '2019-12-14'),
(9, '0lcj49pIwIRK1mS1KWooZWO5rgGAXCylaYPFUrOD.png', '2019-12-13 02:00:38', '2019-12-13 02:10:28', 'male', 250, '2019-12-21'),
(10, 'dZ9P0G6EjPOZfl0HgztpZ0yPiod4mgueuURLNy8B.jpeg', '2019-12-13 02:09:36', '2019-12-13 02:11:37', 'female', 50, '2019-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `massege_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_id`, `to_id`, `message`, `massege_id`, `created_at`, `updated_at`) VALUES
(152, 65, 2, 'sdsdfsdf', 151, NULL, NULL),
(153, 2, 65, 'sadasdasdasdsa', NULL, '2019-10-13 10:31:10', '2019-10-13 10:31:10'),
(154, 65, 2, 'sasaasdassaddddddddddddddd', 153, '2019-10-13 10:32:15', '2019-10-13 10:32:15'),
(155, 65, 2, 'saasdasd', 153, '2019-10-13 10:32:25', '2019-10-13 10:32:25'),
(156, 66, 65, 'sadasdasdasa', NULL, '2019-10-13 10:35:53', '2019-10-13 10:35:53'),
(157, 65, 66, 'sdsdfsfssdf', 156, '2019-10-13 10:37:05', '2019-10-13 10:37:05');

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
(2, '2019_08_09_093149_create_admins_table', 1),
(3, '2019_09_02_202149_create_nationalties_table', 1),
(4, '2019_09_02_203202_create_languages_table', 1),
(5, '2019_09_02_203532_create_cities_table', 1),
(6, '2019_09_02_204853_create_cities_data_table', 1),
(7, '2019_09_02_205119_create_nationalies_data_table', 1),
(8, '2019_09_02_205653_create_categories_table', 1),
(9, '2019_09_02_213706_create_material_status_table', 1),
(10, '2019_09_02_214014_create_memberships_table', 1),
(11, '2019_09_02_215151_create_option_groups_table', 1),
(12, '2019_09_02_215348_create_options_table', 1),
(13, '2019_09_02_215607_create_option_values_table', 1),
(14, '2019_09_02_221104_create_newletters_table', 1),
(15, '2019_09_02_222020_create_users_table', 1),
(16, '2019_09_02_222159_create_user_activity_table', 1),
(17, '2019_09_02_222617_create_user_category_table', 1),
(18, '2019_09_02_222745_create_stories_table', 1),
(19, '2019_09_02_222904_create_user_action_table', 1),
(20, '2019_09_02_223023_create_messages_table', 1),
(21, '2019_09_02_223302_create_user_membership_table', 1),
(22, '2019_09_02_223359_create_user_options_table', 1),
(23, '2019_09_02_223503_create_user_favourite_options_table', 1),
(24, '2019_09_03_173249_create_permission_tables', 1),
(25, '2019_09_05_163735_create_settings_table', 2),
(26, '2019_09_11_170347_create_artcl_categories_table', 3),
(27, '2019_09_11_170744_create_articles_table', 3),
(28, '2019_09_11_171215_create_article_datas_table', 3),
(29, '2019_09_11_171514_create_article_category_table', 3),
(30, '2019_09_11_113542_add_source_id_to_categories', 4),
(31, '2019_09_12_095038_add_age_to_users', 5),
(32, '2019_09_25_172041_create_notifications_table', 6),
(33, '2019_09_25_204649_create_contacts_table', 7),
(34, '2019_09_29_184505_create_sliders_table', 8),
(35, '2019_10_06_171634_create_user_statuses_table', 9),
(36, '2019_10_06_171808_create_user_histories_table', 9),
(37, '2019_12_10_134953_create_banner_table', 10),
(38, '2019_12_10_134953_create_contact_section_table', 10),
(39, '2019_12_10_134953_create_content_section_data_table', 10),
(40, '2019_12_10_134954_create_bank_data_table', 10),
(41, '2019_12_10_134954_create_banks_table', 10),
(42, '2019_12_10_134954_create_banner_data_table', 10),
(43, '2019_12_10_134954_create_membership_data_types_table', 10),
(44, '2019_12_10_134954_create_membership_options_table', 10),
(45, '2019_12_10_134954_create_membership_types_table', 10),
(46, '2019_12_10_134954_create_permissions_memberships_table', 10),
(47, '2019_12_10_134954_create_transactions_table', 10),
(48, '2019_12_10_134954_create_user_story_table', 10),
(49, '2019_12_10_135004_create_foreign_keys', 10),
(50, '2019_12_10_230736_add_user_story_table', 11),
(51, '2019_12_11_160950_add_type_column', 12),
(52, '2019_12_12_184328_add_bank_data_forginkey', 13),
(53, '2019_12_16_160301_create_banner_images_table', 14),
(58, '2019_12_16_164235_create_files_table', 16),
(59, '2019_12_16_162141_create_album_categories_table', 17),
(60, '2019_12_16_162156_create_album_category_data_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 2),
(6, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 2),
(7, 'App\\Models\\User', 1),
(7, 'App\\Models\\User', 2),
(8, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 2),
(9, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 2),
(10, 'App\\Models\\User', 1),
(10, 'App\\Models\\User', 2),
(11, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 2),
(12, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 2),
(13, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 2),
(14, 'App\\Models\\User', 1),
(14, 'App\\Models\\User', 2),
(15, 'App\\Models\\User', 1),
(15, 'App\\Models\\User', 2),
(16, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 2),
(17, 'App\\Models\\User', 1),
(17, 'App\\Models\\User', 2),
(18, 'App\\Models\\User', 1),
(18, 'App\\Models\\User', 2),
(19, 'App\\Models\\User', 1),
(19, 'App\\Models\\User', 2),
(20, 'App\\Models\\User', 1),
(20, 'App\\Models\\User', 2),
(21, 'App\\Models\\User', 1),
(21, 'App\\Models\\User', 2),
(22, 'App\\Models\\User', 1),
(22, 'App\\Models\\User', 2),
(23, 'App\\Models\\User', 1),
(23, 'App\\Models\\User', 2),
(24, 'App\\Models\\User', 1),
(24, 'App\\Models\\User', 2),
(25, 'App\\Models\\User', 1),
(25, 'App\\Models\\User', 2),
(26, 'App\\Models\\User', 1),
(26, 'App\\Models\\User', 2),
(27, 'App\\Models\\User', 1),
(27, 'App\\Models\\User', 2),
(28, 'App\\Models\\User', 1),
(28, 'App\\Models\\User', 2),
(29, 'App\\Models\\User', 1),
(29, 'App\\Models\\User', 2),
(30, 'App\\Models\\User', 1),
(30, 'App\\Models\\User', 2),
(31, 'App\\Models\\User', 1),
(31, 'App\\Models\\User', 2),
(32, 'App\\Models\\User', 1),
(32, 'App\\Models\\User', 2),
(33, 'App\\Models\\User', 1),
(33, 'App\\Models\\User', 2),
(49, 'App\\Models\\User', 2),
(50, 'App\\Models\\User', 2),
(51, 'App\\Models\\User', 2),
(54, 'App\\Models\\User', 2),
(55, 'App\\Models\\User', 2),
(56, 'App\\Models\\User', 2),
(57, 'App\\Models\\User', 2),
(58, 'App\\Models\\User', 2),
(59, 'App\\Models\\User', 2),
(60, 'App\\Models\\User', 2),
(61, 'App\\Models\\User', 2),
(62, 'App\\Models\\User', 2),
(63, 'App\\Models\\User', 2),
(64, 'App\\Models\\User', 2),
(65, 'App\\Models\\User', 2),
(66, 'App\\Models\\User', 2),
(67, 'App\\Models\\User', 2),
(68, 'App\\Models\\User', 2),
(69, 'App\\Models\\User', 2),
(70, 'App\\Models\\User', 2),
(71, 'App\\Models\\User', 2),
(72, 'App\\Models\\User', 2),
(73, 'App\\Models\\User', 2),
(74, 'App\\Models\\User', 2),
(75, 'App\\Models\\User', 2),
(77, 'App\\Models\\User', 2),
(78, 'App\\Models\\User', 2),
(79, 'App\\Models\\User', 2),
(80, 'App\\Models\\User', 2),
(81, 'App\\Models\\User', 2),
(82, 'App\\Models\\User', 2),
(83, 'App\\Models\\User', 2),
(84, 'App\\Models\\User', 2),
(86, 'App\\Models\\User', 2),
(87, 'App\\Models\\User', 2),
(88, 'App\\Models\\User', 2),
(89, 'App\\Models\\User', 2),
(90, 'App\\Models\\User', 2),
(90, 'App\\Models\\User', 68),
(91, 'App\\Models\\User', 2),
(92, 'App\\Models\\User', 2),
(93, 'App\\Models\\User', 2),
(93, 'App\\Models\\User', 68),
(94, 'App\\Models\\User', 2),
(95, 'App\\Models\\User', 2),
(96, 'App\\Models\\User', 2),
(97, 'App\\Models\\User', 2),
(98, 'App\\Models\\User', 2),
(99, 'App\\Models\\User', 2),
(100, 'App\\Models\\User', 2),
(101, 'App\\Models\\User', 2),
(102, 'App\\Models\\User', 2),
(103, 'App\\Models\\User', 2),
(104, 'App\\Models\\User', 2),
(105, 'App\\Models\\User', 2),
(106, 'App\\Models\\User', 2),
(107, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 2),
(8, 'App\\Models\\User', 68),
(10, 'App\\Models\\User', 63),
(10, 'App\\Models\\User', 64),
(10, 'App\\Models\\User', 65),
(10, 'App\\Models\\User', 66),
(10, 'App\\Models\\User', 67),
(10, 'App\\Models\\User', 69),
(10, 'App\\Models\\User', 70);

-- --------------------------------------------------------

--
-- Table structure for table `nationalies_data`
--

CREATE TABLE `nationalies_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalty_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalies_data`
--

INSERT INTO `nationalies_data` (`id`, `name`, `county_name`, `nationalty_id`, `lang_id`, `created_at`, `updated_at`) VALUES
(5, 'Andorian', 'Andorra', 250, 1, NULL, NULL),
(7, 'Afghani', 'Afghanistan', 252, 1, NULL, NULL),
(8, 'Anguillan', 'Anguilla', 253, 1, NULL, NULL),
(9, 'Armenian', 'Armenia', 254, 1, NULL, NULL),
(10, 'Angolian', 'Angola', 255, 1, NULL, NULL),
(11, 'Antarctic', 'Antarctica', 256, 1, NULL, NULL),
(12, 'Argentine', 'Argentina', 257, 1, NULL, NULL),
(13, 'Austrian', 'Austria', 258, 1, NULL, NULL),
(14, 'Australian', 'Australia', 259, 1, NULL, NULL),
(15, 'Arubian', 'Aruba', 260, 1, NULL, NULL),
(16, 'Bangladeshi', 'Bangladesh', 261, 1, NULL, NULL),
(17, 'Barbadian', 'Barbados', 262, 1, NULL, NULL),
(18, 'Belgian', 'Belgium', 263, 1, NULL, NULL),
(19, 'Bahrainian', 'Bahrain', 264, 1, NULL, NULL),
(20, 'Bermuda', 'Bermuda', 265, 1, NULL, NULL),
(21, 'Bolivian', 'Bolivia', 266, 1, NULL, NULL),
(22, 'Brazilian', 'Brazil', 267, 1, NULL, NULL),
(23, 'Bahameese', 'Bahamas', 268, 1, NULL, NULL),
(24, 'Bhutanese', 'Bhutan', 269, 1, NULL, NULL),
(25, 'Bulgarian', 'Bulgaria', 270, 1, NULL, NULL),
(26, 'Belarusian', 'Belarus', 271, 1, NULL, NULL),
(27, 'Belizean', 'Belize', 272, 1, NULL, NULL),
(28, 'Canadian', 'Canada', 273, 1, NULL, NULL),
(29, 'Congolese', 'Congo', 274, 1, NULL, NULL),
(30, 'Chinese', 'China', 275, 1, NULL, NULL),
(31, 'Swiss', 'Switzerland', 276, 1, NULL, NULL),
(32, 'Chilean', 'Chile', 277, 1, NULL, NULL),
(33, 'Cambodian', 'Cambodia', 278, 1, NULL, NULL),
(34, 'Cameroonian', 'Cameroon', 279, 1, NULL, NULL),
(35, 'Columbian', 'Columbia', 280, 1, NULL, NULL),
(36, 'Czech', 'Czech Republic', 281, 1, NULL, NULL),
(37, '\"Costa Rican\"', 'Costa Rica', 282, 1, NULL, NULL),
(38, 'Cuban', 'Cuba', 283, 1, NULL, NULL),
(39, 'Cypriot', 'Cyprus', 284, 1, NULL, NULL),
(40, 'German', 'Germany', 285, 1, NULL, NULL),
(41, 'Danish', 'Denmark', 286, 1, NULL, NULL),
(42, 'Dominican', 'Dominica', 287, 1, NULL, NULL),
(43, 'Ecuadorean', 'Ecuador', 288, 1, NULL, NULL),
(44, 'Estonian', 'Estonia', 289, 1, NULL, NULL),
(45, 'Egyptian', 'Egypt', 290, 1, NULL, NULL),
(46, 'Ethiopian', 'Ethiopia', 291, 1, NULL, NULL),
(47, 'Finnish', 'Finland', 292, 1, NULL, NULL),
(48, 'Fijian', 'Fiji', 293, 1, NULL, NULL),
(49, 'French', 'France', 294, 1, NULL, NULL),
(50, 'British', 'United Kingdom', 295, 1, NULL, NULL),
(51, 'Georgian', 'Georgia', 296, 1, NULL, NULL),
(52, 'Ghanaian', 'Ghana', 297, 1, NULL, NULL),
(53, 'Guinean', 'Guinea', 298, 1, NULL, NULL),
(54, 'Greek', 'Greece', 299, 1, NULL, NULL),
(55, 'Guyanese', 'Guyana', 300, 1, NULL, NULL),
(56, 'Chinese', 'Hong Kong', 301, 1, NULL, NULL),
(57, 'Croatian', 'Croatia', 302, 1, NULL, NULL),
(58, 'Hungarian', 'Hungary', 303, 1, NULL, NULL),
(59, 'Indonesian', 'Indonesia', 304, 1, NULL, NULL),
(60, 'Irish', 'Ireland', 305, 1, NULL, NULL),
(61, 'Indian', 'India', 306, 1, NULL, NULL),
(62, 'Iraqi', 'Iraq', 307, 1, NULL, NULL),
(63, 'Iranian', 'Iran', 308, 1, NULL, NULL),
(64, 'Israeli', 'Israel', 309, 1, NULL, NULL),
(65, 'Icelander', 'Iceland', 310, 1, NULL, NULL),
(66, 'Italian', 'Italy', 311, 1, NULL, NULL),
(67, 'Jamaican', 'Jamaica', 312, 1, NULL, NULL),
(68, 'Jordanian', 'Jordan', 313, 1, NULL, NULL),
(69, 'Japanese', 'Japan', 314, 1, NULL, NULL),
(70, 'Kenyan', 'Kenya', 315, 1, NULL, NULL),
(71, 'Korean', 'Korea', 316, 1, NULL, NULL),
(72, 'Kuwaiti', 'Kuwait', 317, 1, NULL, NULL),
(73, 'Kazakhstani', 'Kazakhstan', 318, 1, NULL, NULL),
(74, 'Kazakhstani', 'Kazakhstan', 319, 1, NULL, NULL),
(75, 'Lebanese', 'Lebanon', 320, 1, NULL, NULL),
(76, '\"Sri Lankan\"', 'Sri Lanka', 321, 1, NULL, NULL),
(77, 'Lithuanian', 'Lithuania', 322, 1, NULL, NULL),
(78, 'Luxembourger', 'Luxembourg', 323, 1, NULL, NULL),
(79, 'Moroccan', 'Morocco', 324, 1, NULL, NULL),
(80, 'Monacan', 'Monaco', 325, 1, NULL, NULL),
(81, 'Mexican', 'Mexico', 326, 1, NULL, NULL),
(82, 'Mayanmarese', 'Myanmar', 327, 1, NULL, NULL),
(83, 'Mongolian', 'Mongolia', 328, 1, NULL, NULL),
(84, 'Macau', 'Macau', 329, 1, NULL, NULL),
(85, 'Mauritian', 'Mauritius', 330, 1, NULL, NULL),
(86, 'Maldivan', 'Maldives', 331, 1, NULL, NULL),
(87, 'Malaysian', 'Malaysia', 332, 1, NULL, NULL),
(88, 'Namibian', 'Namibia', 333, 1, NULL, NULL),
(89, 'Nigerian', 'Nigeria', 334, 1, NULL, NULL),
(90, 'Dutch', 'Netherland', 335, 1, NULL, NULL),
(91, 'Norwegian', 'Norway', 336, 1, NULL, NULL),
(92, 'Nepalese', 'Nepal', 337, 1, NULL, NULL),
(93, '\"New Zealander\"', 'New Zealand', 338, 1, NULL, NULL),
(94, 'Omani', 'Oman', 339, 1, NULL, NULL),
(95, 'Panamanian', 'Panama', 340, 1, NULL, NULL),
(96, 'Peruvian', 'Peru', 341, 1, NULL, NULL),
(97, 'Filipino', 'Philippines', 342, 1, NULL, NULL),
(98, 'Pakistani', 'Pakistan', 343, 1, NULL, NULL),
(99, 'Polish', 'Poland', 344, 1, NULL, NULL),
(100, 'Portugees', 'Portugal', 345, 1, NULL, NULL),
(101, 'Paraguayan', 'Paraguay', 346, 1, NULL, NULL),
(102, 'Qatari', 'Qatar', 347, 1, NULL, NULL),
(103, 'Romanian', 'Romania', 348, 1, NULL, NULL),
(104, 'Russian', 'Russia', 349, 1, NULL, NULL),
(105, '\"Saudi Arabian\"', 'Saudi Arabia', 350, 1, NULL, NULL),
(106, 'Seychellois', 'Seychelles', 351, 1, NULL, NULL),
(107, 'Swedish', 'Sweden', 352, 1, NULL, NULL),
(108, 'Singaporean', 'Singapore', 353, 1, NULL, NULL),
(109, 'Slovakian', 'Slovakia', 354, 1, NULL, NULL),
(110, 'Senegalese', 'Senegal', 355, 1, NULL, NULL),
(111, 'Somali', 'Somalia', 356, 1, NULL, NULL),
(112, 'Spanish', 'Spain', 357, 1, NULL, NULL),
(113, 'Thai', 'Thailand', 358, 1, NULL, NULL),
(114, 'Tunisian', 'Tunisia', 359, 1, NULL, NULL),
(115, 'Turkish', 'Turkey', 360, 1, NULL, NULL),
(116, 'Taiwanese', 'Taiwan', 361, 1, NULL, NULL),
(117, 'Tanzanian', 'Tanzania', 362, 1, NULL, NULL),
(118, 'Ukrainian', 'Ukraine', 363, 1, NULL, NULL),
(119, 'Ugandan', 'Uganda', 364, 1, NULL, NULL),
(120, 'American', 'United States of America', 365, 1, NULL, NULL),
(121, 'Uruguayan', 'Uruguay', 366, 1, NULL, NULL),
(122, 'Uzbekistani', 'Uzbekistan', 367, 1, NULL, NULL),
(123, 'Venezuelan', 'Venezuela', 368, 1, NULL, NULL),
(124, 'Vietnamese', 'Vietnam', 369, 1, NULL, NULL),
(125, 'Yemeni', 'Yemen', 370, 1, NULL, NULL),
(126, '\"South African\"', 'South Africa', 371, 1, NULL, NULL),
(127, 'Zambian', 'Zambia', 372, 1, NULL, NULL),
(128, 'Zimbabwean', 'Zimbabwe', 373, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nationalties`
--

CREATE TABLE `nationalties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalties`
--

INSERT INTO `nationalties` (`id`, `code`, `created_at`, `updated_at`) VALUES
(250, 'AD', NULL, NULL),
(251, 'AE', NULL, NULL),
(252, 'AF', NULL, NULL),
(253, 'AI', NULL, NULL),
(254, 'AM', NULL, NULL),
(255, 'AO', NULL, NULL),
(256, 'AQ', NULL, NULL),
(257, 'AR', NULL, NULL),
(258, 'AS', NULL, NULL),
(259, 'AU', NULL, NULL),
(260, 'AW', NULL, NULL),
(261, 'BA', NULL, NULL),
(262, 'BB', NULL, NULL),
(263, 'BE', NULL, NULL),
(264, 'BH', NULL, NULL),
(265, 'BM', NULL, NULL),
(266, 'BO', NULL, NULL),
(267, 'BR', NULL, NULL),
(268, 'BS', NULL, NULL),
(269, 'BT', NULL, NULL),
(270, 'BU', NULL, NULL),
(271, 'BY', NULL, NULL),
(272, 'BZ', NULL, NULL),
(273, 'CA', NULL, NULL),
(274, 'CG', NULL, NULL),
(275, 'CH', NULL, NULL),
(276, 'CH', NULL, NULL),
(277, 'CL', NULL, NULL),
(278, 'CM', NULL, NULL),
(279, 'CM', NULL, NULL),
(280, 'CO', NULL, NULL),
(281, 'CR', NULL, NULL),
(282, 'CR', NULL, NULL),
(283, 'CU', NULL, NULL),
(284, 'CY', NULL, NULL),
(285, 'DE', NULL, NULL),
(286, 'DK', NULL, NULL),
(287, 'DM', NULL, NULL),
(288, 'EC', NULL, NULL),
(289, 'EE', NULL, NULL),
(290, 'EG', NULL, NULL),
(291, 'ET', NULL, NULL),
(292, 'FI', NULL, NULL),
(293, 'FJ', NULL, NULL),
(294, 'FR', NULL, NULL),
(295, 'GB', NULL, NULL),
(296, 'GE', NULL, NULL),
(297, 'GH', NULL, NULL),
(298, 'GN', NULL, NULL),
(299, 'GR', NULL, NULL),
(300, 'GY', NULL, NULL),
(301, 'HK', NULL, NULL),
(302, 'HR', NULL, NULL),
(303, 'HU', NULL, NULL),
(304, 'ID', NULL, NULL),
(305, 'IE', NULL, NULL),
(306, 'IN', NULL, NULL),
(307, 'IQ', NULL, NULL),
(308, 'IR', NULL, NULL),
(309, 'IS', NULL, NULL),
(310, 'IS', NULL, NULL),
(311, 'IT', NULL, NULL),
(312, 'JM', NULL, NULL),
(313, 'JO', NULL, NULL),
(314, 'JP', NULL, NULL),
(315, 'KE', NULL, NULL),
(316, 'KO', NULL, NULL),
(317, 'KW', NULL, NULL),
(318, 'KZ', NULL, NULL),
(319, 'KZ', NULL, NULL),
(320, 'LB', NULL, NULL),
(321, 'LK', NULL, NULL),
(322, 'LT', NULL, NULL),
(323, 'LU', NULL, NULL),
(324, 'MA', NULL, NULL),
(325, 'MC', NULL, NULL),
(326, 'ME', NULL, NULL),
(327, 'MM', NULL, NULL),
(328, 'MN', NULL, NULL),
(329, 'MO', NULL, NULL),
(330, 'MU', NULL, NULL),
(331, 'MV', NULL, NULL),
(332, 'MY', NULL, NULL),
(333, 'NA', NULL, NULL),
(334, 'NG', NULL, NULL),
(335, 'NL', NULL, NULL),
(336, 'NO', NULL, NULL),
(337, 'NP', NULL, NULL),
(338, 'NZ', NULL, NULL),
(339, 'OM', NULL, NULL),
(340, 'PA', NULL, NULL),
(341, 'PE', NULL, NULL),
(342, 'PH', NULL, NULL),
(343, 'PK', NULL, NULL),
(344, 'PO', NULL, NULL),
(345, 'PT', NULL, NULL),
(346, 'PY', NULL, NULL),
(347, 'QA', NULL, NULL),
(348, 'RO', NULL, NULL),
(349, 'RU', NULL, NULL),
(350, 'SA', NULL, NULL),
(351, 'SC', NULL, NULL),
(352, 'SE', NULL, NULL),
(353, 'SG', NULL, NULL),
(354, 'SK', NULL, NULL),
(355, 'SN', NULL, NULL),
(356, 'SO', NULL, NULL),
(357, 'SP', NULL, NULL),
(358, 'TH', NULL, NULL),
(359, 'TN', NULL, NULL),
(360, 'TR', NULL, NULL),
(361, 'TW', NULL, NULL),
(362, 'TZ', NULL, NULL),
(363, 'UA', NULL, NULL),
(364, 'UG', NULL, NULL),
(365, 'US', NULL, NULL),
(366, 'UY', NULL, NULL),
(367, 'UZ', NULL, NULL),
(368, 'VE', NULL, NULL),
(369, 'VN', NULL, NULL),
(370, 'YE', NULL, NULL),
(371, 'ZA', NULL, NULL),
(372, 'ZM', NULL, NULL),
(373, 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newletters`
--

CREATE TABLE `newletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newletters`
--

INSERT INTO `newletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(4, 'store@store.com', '2019-10-08 04:27:39', '2019-10-08 04:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0fc16a27-abb4-43f4-878c-d1bb0eda22b0', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 59, '{\"id\":\"2\",\"name\":\"admin\",\"body\":\"\\u0644\\u062f\\u064a\\u0643  \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\"}', NULL, '2019-10-09 03:22:04', '2019-10-09 03:22:04'),
('2a3b15fc-5f3a-4211-b82e-61c415ddd82a', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 65, '{\"id\":\"2\",\"name\":\"admin\",\"body\":\"\\u0644\\u062f\\u064a\\u0643  \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\"}', NULL, '2019-10-13 10:31:10', '2019-10-13 10:31:10'),
('2b7b58bd-fbb6-47df-b5f7-a61d882b24b4', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 59, '{\"id\":\"60\",\"name\":\"ahmed\",\"body\":\"You have Massege from \"}', NULL, '2019-09-26 06:13:50', '2019-09-26 06:13:50'),
('2d0a9901-1b1d-4e0f-9e30-872380c03a2e', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 60, '{\"id\":\"59\",\"name\":\"serv5\",\"body\":\"You have Massege from \"}', NULL, '2019-09-29 02:47:05', '2019-09-29 02:47:05'),
('2e615aa9-255b-4edf-8fcb-057dac7d4579', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 59, '{\"id\":\"62\",\"name\":\"fz@test.com\",\"body\":\"\\u0644\\u062f\\u064a\\u0643  \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\"}', NULL, '2019-10-04 18:19:24', '2019-10-04 18:19:24'),
('4b3fb1b8-a50e-4b1d-906b-f75e9f757972', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 60, '{\"id\":\"2\",\"name\":\"admin\",\"body\":\"\\u0644\\u062f\\u064a\\u0643  \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\"}', NULL, '2019-10-07 05:09:37', '2019-10-07 05:09:37'),
('6b3a9d2d-6f97-4f49-a7c6-67860c804a84', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 60, '{\"id\":\"59\",\"name\":\"serv5\",\"body\":\"You have Massege from \"}', NULL, '2019-09-27 03:49:02', '2019-09-27 03:49:02'),
('8b7d54dc-b3ac-475b-9242-1a7d816a4684', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 65, '{\"id\":\"66\",\"name\":\"ahmed\",\"body\":\"\\u0644\\u062f\\u064a\\u0643  \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\"}', NULL, '2019-10-13 10:35:53', '2019-10-13 10:35:53'),
('8d60c0ec-4e9b-4a05-a55b-4350f8c46a7f', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 59, '{\"id\":\"60\",\"name\":\"ahmed\",\"body\":\"You have Massege from \"}', NULL, '2019-10-10 02:15:36', '2019-10-10 02:15:36'),
('9df1a43c-03d4-4c6f-a9ae-65c6229b913a', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 59, '{\"id\":\"60\",\"name\":\"ahmed\",\"body\":\"You have Massege from \"}', NULL, '2019-09-29 04:10:17', '2019-09-29 04:10:17'),
('ab0c068e-4110-454b-89a8-4c6dbaea06af', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 59, '{\"id\":\"2\",\"name\":\"admin\",\"body\":\"\\u0644\\u062f\\u064a\\u0643  \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\"}', NULL, '2019-10-07 05:54:50', '2019-10-07 05:54:50'),
('cf95956a-b509-427b-819c-83db250b8f00', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 61, '{\"id\":\"62\",\"name\":\"fz@test.com\",\"body\":\"You have Massege from \"}', NULL, '2019-10-04 18:29:52', '2019-10-04 18:29:52'),
('d5d72355-089a-4473-8730-1c66280e9b20', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 61, '{\"id\":\"62\",\"name\":\"fz@test.com\",\"body\":\"\\u0644\\u062f\\u064a\\u0643  \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\"}', NULL, '2019-10-04 18:23:03', '2019-10-04 18:23:03'),
('e56a7594-617f-41b7-b04f-5eedb2147222', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 62, '{\"id\":\"59\",\"name\":\"serv5\",\"body\":\"You have Massege from \"}', NULL, '2019-10-07 03:27:54', '2019-10-07 03:27:54'),
('fecb352d-5b3a-48d1-be39-a914ab6e4b35', 'App\\Notifications\\profilenotifcation', 'App\\Models\\User', 59, '{\"id\":\"60\",\"name\":\"ahmed\",\"body\":\"You have Massege from \"}', NULL, '2019-10-07 04:30:05', '2019-10-07 04:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `require` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'bool',
  `type` enum('select','text') COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `title`, `require`, `type`, `group_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(27, 'نوع الزواج', 'bool', 'select', 40, 1, NULL, '2019-10-04 16:16:32', '2019-10-04 16:16:32'),
(28, 'Marriage Type', 'bool', 'select', 40, 2, 27, '2019-10-04 17:10:19', '2019-10-04 17:10:19'),
(29, 'الوزن', 'bool', 'select', 43, 1, NULL, '2019-10-04 17:30:27', '2019-10-04 17:30:27'),
(30, 'Weight', 'bool', 'select', 43, 2, 29, '2019-10-04 17:10:21', '2019-10-04 17:10:21'),
(31, 'weight', 'bool', 'select', 44, 2, NULL, '2019-10-05 05:29:25', '2019-10-05 05:29:25'),
(32, 'جديد جديد', 'bool', 'select', 40, 1, NULL, '2019-10-13 12:16:38', '2019-10-13 12:16:38'),
(33, 'Weight', 'bool', 'select', 44, 2, 31, '2019-10-13 12:10:39', '2019-10-13 12:10:39'),
(34, 'newnew', 'bool', 'select', 40, 2, 32, '2019-10-13 12:10:39', '2019-10-13 12:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `option_groups`
--

CREATE TABLE `option_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `option_groups`
--

INSERT INTO `option_groups` (`id`, `title`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(40, 'الحالة الإجتماعية', 1, NULL, '2019-10-04 16:15:43', '2019-10-04 16:15:43'),
(42, 'Material Status', 2, 40, '2019-10-04 17:10:47', '2019-10-04 17:10:47'),
(43, 'مواصفاتك', 1, NULL, '2019-10-04 17:27:00', '2019-10-04 17:27:00'),
(44, 'Your specifications', 2, 43, '2019-10-04 17:10:46', '2019-10-04 17:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `option_values`
--

CREATE TABLE `option_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `option_values`
--

INSERT INTO `option_values` (`id`, `title`, `option_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(94, 'زوجه اولي', 27, 1, NULL, '2019-10-04 16:16:32', '2019-10-04 16:16:32'),
(95, 'زوجه ثانيه', 27, 1, NULL, '2019-10-04 16:16:52', '2019-10-04 16:16:52'),
(96, 'First Wife', 27, 2, 94, '2019-10-04 17:10:16', '2019-10-04 17:10:16'),
(97, 'Second Wife', 27, 2, 95, '2019-10-04 17:10:16', '2019-10-04 17:10:16'),
(98, '30', 29, 1, NULL, '2019-10-04 17:30:27', '2019-10-04 17:30:27'),
(99, '40', 29, 1, NULL, '2019-10-04 17:30:27', '2019-10-04 17:30:27'),
(100, '50', 29, 1, NULL, '2019-10-04 17:30:27', '2019-10-04 17:30:27'),
(101, '60', 29, 1, NULL, '2019-10-04 17:30:27', '2019-10-04 17:30:27'),
(102, '70', 29, 1, NULL, '2019-10-04 17:30:27', '2019-10-04 17:30:27'),
(103, 'goofd', 31, 2, NULL, '2019-10-05 05:29:25', '2019-10-05 05:29:25'),
(104, '50', 31, 2, NULL, '2019-10-05 05:29:25', '2019-10-05 05:29:25'),
(105, 'جدبد', 32, 1, NULL, '2019-10-13 12:16:38', '2019-10-13 12:16:38'),
(106, 'جديد جديد', 32, 1, NULL, '2019-10-13 12:16:38', '2019-10-13 12:16:38'),
(107, '30', 29, 2, 98, '2019-10-13 12:10:21', '2019-10-13 12:10:21'),
(108, '40', 29, 2, 99, '2019-10-13 12:10:21', '2019-10-13 12:10:21'),
(109, '50', 29, 2, 100, '2019-10-13 12:10:21', '2019-10-13 12:10:21'),
(110, '60', 29, 2, 101, '2019-10-13 12:10:21', '2019-10-13 12:10:21'),
(111, '70', 29, 2, 102, '2019-10-13 12:10:21', '2019-10-13 12:10:21'),
(112, 'has', 31, 2, 103, '2019-10-13 12:10:21', '2019-10-13 12:10:21'),
(113, '50', 31, 2, 104, '2019-10-13 12:10:21', '2019-10-13 12:10:21'),
(114, 'new', 32, 2, 105, '2019-10-13 12:10:21', '2019-10-13 12:10:21');

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Permission-Add', 'web', '2019-09-05 02:50:31', '2019-09-05 02:50:31'),
(2, 'Permission-Edit', 'web', '2019-09-05 02:50:31', '2019-09-05 02:50:31'),
(3, 'Permission-Delete', 'web', '2019-09-05 02:50:32', '2019-09-05 02:50:32'),
(4, 'Role-Add', 'web', '2019-09-05 02:50:32', '2019-09-05 02:50:32'),
(5, 'Role-Edit', 'web', '2019-09-05 02:50:32', '2019-09-05 02:50:32'),
(6, 'Role-Delete', 'web', '2019-09-05 02:50:33', '2019-09-05 02:50:33'),
(7, 'Membership-Add', 'web', '2019-09-05 02:50:33', '2019-09-09 00:54:00'),
(8, 'Membership-Edit', 'web', '2019-09-05 02:50:33', '2019-09-05 02:50:33'),
(9, 'Membership-Delete', 'web', '2019-09-05 02:50:34', '2019-09-05 02:50:34'),
(10, 'UserMembership-Add', 'web', '2019-09-05 02:50:34', '2019-09-05 02:50:34'),
(11, 'UserMembership-Edit', 'web', '2019-09-05 02:50:35', '2019-09-05 02:50:35'),
(12, 'UserMembership-Delete', 'web', '2019-09-05 02:50:35', '2019-09-05 02:50:35'),
(13, 'MembershipPermissions-Add', 'web', '2019-09-05 02:50:36', '2019-09-05 02:50:36'),
(14, 'MembershipPermissions-Edit', 'web', '2019-09-05 02:50:36', '2019-09-05 02:50:36'),
(15, 'MembershipPermissions-Delete', 'web', '2019-09-05 02:50:37', '2019-09-05 02:50:37'),
(16, 'Language-Add', 'web', '2019-09-05 02:50:37', '2019-09-05 02:50:37'),
(17, 'Language-Edit', 'web', '2019-09-05 02:50:37', '2019-09-05 02:50:37'),
(18, 'Language-Delete', 'web', '2019-09-05 02:50:37', '2019-09-05 02:50:37'),
(19, 'Article-Add', 'web', '2019-09-05 02:50:38', '2019-09-05 02:50:38'),
(20, 'Article-Edit', 'web', '2019-09-05 02:50:38', '2019-09-05 02:50:38'),
(21, 'Article-Delete', 'web', '2019-09-05 02:50:38', '2019-09-05 02:50:38'),
(22, 'ArticleCategory-Add', 'web', '2019-09-05 02:50:38', '2019-09-05 02:50:38'),
(23, 'ArticleCategory-Edit', 'web', '2019-09-05 02:50:39', '2019-09-05 02:50:39'),
(24, 'ArticleCategory-Delete', 'web', '2019-09-05 02:50:39', '2019-09-05 02:50:39'),
(25, 'Feature-Add', 'web', '2019-09-05 02:50:39', '2019-09-05 02:50:39'),
(26, 'Feature-Edit', 'web', '2019-09-05 02:50:39', '2019-09-05 02:50:39'),
(27, 'Feature-Delete', 'web', '2019-09-05 02:50:39', '2019-09-05 02:50:39'),
(28, 'Country-Add', 'web', '2019-09-05 02:50:40', '2019-09-05 02:50:40'),
(29, 'Country-Edit', 'web', '2019-09-05 02:50:40', '2019-09-05 02:50:40'),
(30, 'Country-Delete', 'web', '2019-09-05 02:50:40', '2019-09-05 02:50:40'),
(31, 'City-Add', 'web', '2019-09-05 02:50:40', '2019-09-05 02:50:40'),
(32, 'City-Edit', 'web', '2019-09-05 02:50:41', '2019-09-05 02:50:41'),
(33, 'City-Delete', 'web', '2019-09-05 02:50:41', '2019-09-05 02:50:41'),
(49, 'category-add', 'web', '2019-09-09 00:31:41', '2019-09-09 00:31:41'),
(50, 'category-edit', 'web', '2019-09-09 00:31:49', '2019-09-09 00:31:49'),
(51, 'category-delete', 'web', '2019-09-09 00:31:54', '2019-09-09 00:31:54'),
(54, 'materialStatus-Add', 'web', '2019-09-09 01:47:33', '2019-09-09 01:47:33'),
(55, 'materialStatus-Edit', 'web', '2019-09-09 01:47:42', '2019-09-09 01:47:42'),
(56, 'materialStatus-Delete', 'web', '2019-09-09 01:47:52', '2019-09-09 01:47:52'),
(57, 'option-add', 'web', '2019-09-09 01:50:53', '2019-09-09 01:50:53'),
(58, 'option-edit', 'web', '2019-09-09 01:50:59', '2019-09-09 01:50:59'),
(59, 'option-delete', 'web', '2019-09-09 01:51:06', '2019-09-09 01:51:06'),
(60, 'member-Add', 'web', '2019-09-09 01:55:30', '2019-09-09 01:55:30'),
(61, 'member-Edit', 'web', '2019-09-09 01:55:38', '2019-09-09 01:55:38'),
(62, 'member-Delete', 'web', '2019-09-09 01:55:47', '2019-09-09 01:55:47'),
(63, 'stories-add', 'web', '2019-09-10 00:39:22', '2019-09-10 00:39:22'),
(64, 'stories-edit', 'web', '2019-09-10 00:39:32', '2019-09-10 00:39:32'),
(65, 'stories-delete', 'web', '2019-09-10 00:39:42', '2019-09-10 00:39:42'),
(66, 'slider-add', 'web', '2019-09-30 02:53:23', '2019-09-30 02:53:23'),
(67, 'slider-edit', 'web', '2019-09-30 02:53:34', '2019-09-30 02:53:34'),
(68, 'slider-delete', 'web', '2019-09-30 02:53:42', '2019-09-30 02:53:42'),
(69, 'add-admin', 'web', '2019-10-14 05:56:50', '2019-10-14 05:56:50'),
(70, 'delete-admin', 'web', '2019-10-14 05:57:05', '2019-10-14 05:57:05'),
(71, 'update-admin', 'web', '2019-10-14 05:57:14', '2019-10-14 05:57:14'),
(72, 'newsLetter-export', 'web', '2019-10-14 06:00:56', '2019-10-14 06:00:56'),
(73, 'newsLetter-Delete', 'web', '2019-10-14 06:01:02', '2019-10-14 06:01:02'),
(74, 'show-converstions', 'web', '2019-10-14 06:03:29', '2019-10-14 06:03:29'),
(75, 'delete-converstions', 'web', '2019-10-14 06:03:38', '2019-10-14 06:03:38'),
(77, 'add-active-member', 'web', '2019-10-14 06:10:53', '2019-10-14 06:10:53'),
(78, 'update-active-member', 'web', '2019-10-14 06:11:20', '2019-10-14 06:11:20'),
(79, 'add-best-member', 'web', '2019-10-14 06:12:27', '2019-10-14 06:12:27'),
(80, 'update-best-member', 'web', '2019-10-14 06:12:39', '2019-10-14 06:12:39'),
(81, 'remove-contact', 'web', '2019-10-14 06:14:03', '2019-10-14 06:14:03'),
(82, 'show-setting', 'web', '2019-10-14 06:16:25', '2019-10-14 06:16:25'),
(83, 'update-setting', 'web', '2019-10-14 06:16:33', '2019-10-14 06:16:33'),
(84, 'show-security', 'web', '2019-10-14 06:21:27', '2019-10-14 06:21:27'),
(86, 'show-generalsetting', 'web', '2019-10-14 06:23:47', '2019-10-14 06:23:47'),
(87, 'show-memberships', 'web', '2019-10-14 06:25:17', '2019-10-14 06:25:17'),
(88, 'show-categories', 'web', '2019-10-14 06:25:52', '2019-10-14 06:25:52'),
(89, 'show-material_status', 'web', '2019-10-14 06:26:40', '2019-10-14 06:26:40'),
(90, 'show-Features', 'web', '2019-10-14 06:27:47', '2019-10-14 06:27:47'),
(91, 'show-members', 'web', '2019-10-14 06:28:37', '2019-10-14 06:28:37'),
(92, 'show-message-member', 'web', '2019-10-14 06:29:49', '2019-10-14 06:29:49'),
(93, 'show-stories', 'web', '2019-10-14 06:30:39', '2019-10-14 06:30:39'),
(94, 'show-categoryArticle', 'web', '2019-10-14 06:31:51', '2019-10-14 06:31:51'),
(95, 'show-Bestmember', 'web', '2019-10-14 06:32:47', '2019-10-14 06:32:47'),
(96, 'show-ActiveMember', 'web', '2019-10-14 06:33:34', '2019-10-14 06:33:34'),
(97, 'show-massege-user', 'web', '2019-10-14 06:34:12', '2019-10-14 06:34:12'),
(98, 'show-subscriped', 'web', '2019-10-14 06:35:02', '2019-10-14 06:35:02'),
(99, 'show-optionGroup', 'web', '2019-10-14 07:21:36', '2019-10-14 07:21:36'),
(100, 'show-option', 'web', '2019-10-14 07:22:38', '2019-10-14 07:22:38'),
(101, 'show_massege_member', 'web', '2019-10-14 07:36:08', '2019-10-14 07:36:08'),
(102, 'send_massege_member', 'web', '2019-10-14 07:37:54', '2019-10-14 07:37:54'),
(103, 'active-member', 'web', '2019-10-14 07:40:56', '2019-10-14 07:40:56'),
(104, 'slider-show', 'web', '2019-10-14 09:11:42', '2019-10-14 09:11:42'),
(105, 'show-content_management', 'web', '2019-12-11 07:21:55', '2019-12-11 07:22:22'),
(106, 'show-banner', 'web', '2019-12-12 01:04:38', '2019-12-12 01:04:38'),
(107, 'show-banks', 'web', '2019-12-13 02:56:10', '2019-12-13 02:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `permissions_memberships`
--

CREATE TABLE `permissions_memberships` (
  `id` int(10) UNSIGNED NOT NULL,
  `permision_id` int(10) UNSIGNED NOT NULL,
  `memberShip_type_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions_memberships`
--

INSERT INTO `permissions_memberships` (`id`, `permision_id`, `memberShip_type_id`, `created_at`, `updated_at`) VALUES
(44, 1, 5, '2019-12-13 02:00:19', '2019-12-13 02:00:19'),
(45, 2, 5, '2019-12-13 02:00:19', '2019-12-13 02:00:19'),
(46, 3, 5, '2019-12-13 02:00:19', '2019-12-13 02:00:19'),
(47, 4, 5, '2019-12-13 02:00:19', '2019-12-13 02:00:19'),
(48, 3, 9, '2019-12-13 02:10:28', '2019-12-13 02:10:28'),
(49, 4, 9, '2019-12-13 02:10:28', '2019-12-13 02:10:28'),
(50, 5, 9, '2019-12-13 02:10:28', '2019-12-13 02:10:28'),
(51, 6, 9, '2019-12-13 02:10:28', '2019-12-13 02:10:28'),
(52, 7, 9, '2019-12-13 02:10:28', '2019-12-13 02:10:28'),
(53, 8, 9, '2019-12-13 02:10:28', '2019-12-13 02:10:28'),
(64, 7, 10, '2019-12-13 02:12:58', '2019-12-13 02:12:58'),
(65, 8, 10, '2019-12-13 02:12:59', '2019-12-13 02:12:59'),
(66, 9, 10, '2019-12-13 02:12:59', '2019-12-13 02:12:59'),
(67, 13, 10, '2019-12-13 02:12:59', '2019-12-13 02:12:59'),
(68, 14, 10, '2019-12-13 02:12:59', '2019-12-13 02:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'web', 'web', NULL, NULL),
(4, 'super-admin', 'web', '2019-09-05 02:50:31', '2019-09-05 02:50:31'),
(7, 'web', 'web', NULL, NULL),
(8, 'admin', 'web', '2019-09-09 01:42:16', '2019-09-09 01:42:16'),
(10, 'registered-user', 'web', '2019-10-08 03:06:11', '2019-10-08 03:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 4),
(1, 10),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(49, 4),
(50, 4),
(51, 4),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 4),
(64, 4),
(65, 4),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(70, 4),
(71, 4),
(72, 4),
(73, 4),
(74, 4),
(75, 4),
(77, 4),
(78, 4),
(79, 4),
(80, 4),
(81, 4),
(82, 4),
(83, 4),
(84, 4),
(86, 4),
(87, 4),
(88, 4),
(89, 4),
(90, 4),
(90, 8),
(91, 4),
(92, 4),
(93, 4),
(93, 8),
(94, 4),
(95, 4),
(96, 4),
(97, 4),
(98, 4),
(99, 4),
(100, 4),
(101, 4),
(102, 4),
(103, 4),
(104, 4),
(105, 4),
(106, 4),
(107, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mantance` int(11) NOT NULL DEFAULT 1,
  `TitleTopSearch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptionOnSearch` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Titleactivemember` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descrptionactivemember` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Titleactivemember2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descrptionactivemember2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_msg` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `email`, `loge`, `lang_id`, `source_id`, `facebook_url`, `instagram_url`, `twitter_url`, `phone1`, `address`, `description`, `mantance`, `TitleTopSearch`, `descriptionOnSearch`, `Titleactivemember`, `descrptionactivemember`, `Titleactivemember2`, `descrptionactivemember2`, `register_msg`, `created_at`, `updated_at`) VALUES
(3, 'EUZAWAAJ', 'elzawag@com', 'oWHVf0P61NIJSq6RpqaDQ39p1tqhYIiu1GPd2gMh.png', 1, 3, 'facebook', 'instgram', 'twiiter', '0038762391179', 'BOSNIA', '<p>asdasdasd</p>', 1, 'ابحث عن شريك حياتك', '<p>من فضلك أقسم بهذا القسم قبل التسجيل أقسم بالله العظيم أنني لم أدخل هذا الموقع إلا لغرض الزواج الشرعي وفق كتاب الله وسنة رسوله وليس لأي هدف آخر. وأتعهد لله وأعدك بألا أضيع إرهاق الموقع ، وأنني لا أخدع الأعضاء وأن أكون أمينًا مع الله ومن ثم مع نفسي ، وأن أتقيد بشروط الموقع ، شروط المراسلات ، ربي يكتب لي الخير في هذا المكان. الله خير</p>', 'أنشط الاعضاء', '<p>من فضلك أقسم بهذا القسم قبل التسجيل أقسم بالله العظيم أنني لم أدخل هذا الموقع إلا لغرض الزواج الشرعي وفق كتاب الله وسنة رسوله وليس لأي هدف آخر. وأتعهد لله وأعدك بألا أضيع إرهاق الموقع ، وأنني لا أخدع الأعضاء وأن أكون أمينًا مع الله ومن ثم مع نفسي ، وأن أتقيد بشروط الموقع ، شروط المراسلات ، ربي يكتب لي الخير في هذا المكان. الله خير</p>', 'أنشط الاعضاء', '<p>من فضلك أقسم بهذا القسم قبل التسجيل أقسم بالله العظيم أنني لم أدخل هذا الموقع إلا لغرض الزواج الشرعي وفق كتاب الله وسنة رسوله وليس لأي هدف آخر. وأتعهد لله وأعدك بألا أضيع إرهاق الموقع ، وأنني لا أخدع الأعضاء وأن أكون أمينًا مع الله ومن ثم مع نفسي ، وأن أتقيد بشروط الموقع ، شروط المراسلات ، ربي يكتب لي الخير في هذا المكان. الله خير</p>', '<p>(هذا الموقع مخصص للمسلمين فقط) من فضلك أقسم بهذا القسم قبل التسجيل أقسم بالله العظيم أنني لم أدخل هذا الموقع إلا لغرض الزواج الشرعي وفق كتاب الله وسنة رسوله وليس لأي هدف آخر. وأتعهد لله وأعدك بألا أضيع إرهاق الموقع ، وأنني لا أخدع الأعضاء وأن أكون أمينًا مع الله ومن ثم مع نفسي ، وأن أتقيد بشروط الموقع ، شروط المراسلات ، ربي يكتب لي الخير في هذا المكان. الله خير</p>', '2019-09-10 04:22:00', '2019-12-12 04:45:04'),
(4, 'Elzawage', 'elzawag@com', 'Z0a2pRVyYgqOPZAoc2gPAme6wvhRfyMd1XRRU3Zh.png', 2, 4, 'facebook', 'instgram', 'twiiter', '0151202065', 'asdasd', '<p>asdasdasd</p>', 1, 'Look for your life partner', '<p>( Please swear by this section before registration I swear by God Almighty that I did not enter this site only for the purpose of legal marriage according to the book of God and the year of His Messenger</p>', 'أنشط الاعضاء', '<p>( Please swear by this section before registration I swear by God Almighty that I did not enter this site only for the purpose of legal marriage according to the book of God and the year of His Messenger</p>', 'أنشط الاعضاء', '<p>( Please swear by this section before registration I swear by God Almighty that I did not enter this site only for the purpose of legal marriage according to the book of God and the year of His Messenger, and not for any other goal</p>', '<p>(This site is for Muslims only) Please swear by this section before registration I swear by God Almighty that I did not enter this site only for the purpose of legal marriage according to the book of God and the year of His Messenger, and not for any other goal. And I promise to God and I promise you that I will not waste the fatigue of the site, and that I do not fool members and to be honest with God and then with myself, and to abide by the terms of the site, and the conditions of correspondence, may my Lord write me good in this place. God is good</p>', '2019-10-07 00:10:42', '2019-12-09 09:44:19'),
(6, 'Elzawage', 'elzawag@com', 'YsJRgqUFsco1ZoWq3OjJRlvIq2Ub5fegv1WtEO1A.png', 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Cherchez votre partenaire de vie', 'Veuillez jurer par cette section avant l\'inscription. Je jure par Dieu tout-puissant que je ne suis pas entré sur ce site, sauf à des fins de mariage légal, conformément au Livre d\'Allah et à la Sunna de son messager, et à aucune autre fin.', NULL, 'Veuillez jurer par cette section avant l\'inscription. Je jure par Dieu tout-puissant que je ne suis pas entré sur ce site, sauf à des fins de mariage légal, conformément au Livre d\'Allah et à la Sunna de son messager, et à aucune autre fin.', NULL, 'Veuillez jurer par cette section avant l\'inscription. Je jure par Dieu tout-puissant que je ne suis pas entré sur ce site, sauf à des fins de mariage légal, conformément au Livre d\'Allah et à la Sunna de son messager, et à aucune autre fin.', '(Ce site est réservé aux musulmans) Veuillez jurer par cette section avant l\'inscription. Je jure par Dieu tout-puissant que je ne suis pas entré sur ce site, sauf à des fins de mariage légal, conformément au Livre d\'Allah et à la Sunna de son messager, et à aucune autre fin. Je m\'engage à Dieu et je promets de ne pas gaspiller la fatigue du site, de ne pas duper les membres et d\'être honnête avec Dieu, puis avec moi-même, et de respecter les conditions du site, les conditions de correspondance, mon Seigneur m\'écrit bien en ce lieu. Dieu est bon', NULL, NULL),
(7, 'Elzawage', NULL, 'YsJRgqUFsco1ZoWq3OjJRlvIq2Ub5fegv1WtEO1A.png', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `desc`, `image`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(5, 'موقع زواج', 'حياتك الاسرية تبدء', '4fxt0phbjpGZN3yfIVQPxGsAjdIe5DuE0wEw9Yy4.png', 1, NULL, '2019-09-30 03:50:09', '2019-10-02 07:19:40'),
(6, 'موقع زواج', 'موقع زواج', 'ZE7Lya8OFuWbbRlFNHn8hJ6jfw7IKn1KQrypNIfO.png', 1, NULL, '2019-09-30 04:00:50', '2019-09-30 04:02:49'),
(7, 'zawag website', 'lige beginer now', '4fxt0phbjpGZN3yfIVQPxGsAjdIe5DuE0wEw9Yy4.png', 2, 5, '2019-10-09 05:10:31', '2019-10-09 05:10:31'),
(8, 'zawag website', 'lige beginer now', 'ZE7Lya8OFuWbbRlFNHn8hJ6jfw7IKn1KQrypNIfO.png', 2, 6, '2019-10-09 05:10:31', '2019-10-09 05:10:31'),
(9, 'Site de mariage', 'Site de mariage', '4fxt0phbjpGZN3yfIVQPxGsAjdIe5DuE0wEw9Yy4.png', 5, 5, '2019-10-12 10:10:40', '2019-10-12 10:10:40'),
(10, 'Site de mariage', 'Site de mariage', 'ZE7Lya8OFuWbbRlFNHn8hJ6jfw7IKn1KQrypNIfO.png', 5, 6, '2019-10-12 10:10:40', '2019-10-12 10:10:40'),
(11, 'Mjesto za brak', 'Mjesto za brak', '4fxt0phbjpGZN3yfIVQPxGsAjdIe5DuE0wEw9Yy4.png', 6, 5, '2019-10-12 10:10:54', '2019-10-12 10:10:54'),
(12, 'Mjesto za brak', 'Mjesto za brak', 'ZE7Lya8OFuWbbRlFNHn8hJ6jfw7IKn1KQrypNIfO.png', 6, 6, '2019-10-12 10:10:54', '2019-10-12 10:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `content`, `published`, `user_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(31, 'قصة جيددة', 'قصة جديدة جديدة جديدة', 'true', 65, 1, NULL, '2019-10-13 12:59:50', '2019-10-13 12:59:50'),
(32, 'sad', 'شسسشسششس', 'true', 66, 1, NULL, '2019-10-13 13:00:59', '2019-10-13 13:00:59'),
(33, 'شسششسشسش', 'سششسءشسءشءشء', 'true', 65, 1, NULL, '2019-10-13 13:01:21', '2019-10-13 13:01:21'),
(34, 'سيبشسي', 'سشيبسسيسييب', 'true', 65, 1, NULL, '2019-10-13 13:01:43', '2019-10-13 13:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','paid','refused') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `bank_transactions_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_cvc` int(11) DEFAULT NULL,
  `holder_expire` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_db_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_cols` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cols_as` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_system` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `table_db_name`, `trans_cols`, `cols_as`, `is_system`) VALUES
(1, 'categories', 'categories', 'name', 'name', 0),
(2, 'material_status', 'material_status', 'name', 'name', 0),
(3, 'options', 'options', 'title', 'title', 0),
(4, 'option_groups', 'option_groups', 'title', 'title', 0),
(5, 'option_values', 'option_values', 'title', 'title', 0),
(6, 'stories', 'stories', 'title|content', 'title|content', 0),
(8, 'artcl_categories', 'artcl_categories', 'title', 'title', 0),
(11, 'settings', 'settings', 'register_msg|title|TitleTopSearch|descriptionOnSearch|descrptionactivemember2', 'register_msg|title|TitleTopSearch|descriptionOnSearch|descrptionactivemember2', 0),
(12, 'article_datas', 'article_datas', 'title|content', 'title|content', 0),
(13, 'sliders', 'sliders', 'title|desc', 'title|desc', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tages` enum('featured','show_in_feature_list','not_display_status') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DOB` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'date',
  `guard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partener_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userlog` int(11) NOT NULL DEFAULT 1,
  `nationalty_id` bigint(20) UNSIGNED DEFAULT NULL,
  `resident_country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `material_status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `mobile`, `gender`, `tages`, `email`, `password`, `address`, `DOB`, `guard`, `photo`, `age`, `about_me`, `partener_info`, `userlog`, `nationalty_id`, `resident_country_id`, `material_status_id`, `city_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin', '00000', 'male', NULL, 'admin@admin.com', '$2y$10$6V1tekmQDDYjz.mE6SkRleSPJQdattvr/U6b7Tbkoyvl7Kf3sRdkO', 'admin.com', 'date', 'admin', 'n9ACxH3UOljXmmuJA4nqNG2GZbxwBSHI1zhe7lB5.png', '25', 'asdasdsadas', 'sadadasdsadas', 1, 350, 105, 22, NULL, 'vNNXh7TpxILGPKr2tSaefS7m5B5layCybIBlMldMWe9LCgQUgiUBqe59X0dy', '2019-09-05 06:44:55', '2019-10-13 16:55:31'),
(65, 'serv5', 'ahmed moahmed', '1005851101', 'male', NULL, 'serv5@gmail.com', '$2y$10$h5Mh.BJmQbaB4ti6bUCLf.2TGWIv2VWa1GuubVwJLCIdQ.FkHO3QS', 'kanal elswis 49 St', 'date', 'web', NULL, '23', 'fasdfasdfasdfsadfasd', 'sdfssdfsad', 0, 290, 45, 22, 2, 'mpMojlAIYM9JbQhFruH8N2bvAG3r2e9GyH1zaGvI4C0PJDT7cLzq6sh65LZU', '2019-10-13 06:33:24', '2019-10-14 07:41:55'),
(66, 'ahmed', 'hoserv', '1005851101', 'male', NULL, 'ahmed@ahmed.com', '$2y$10$Wy5CvXF2pXdVWRu.I3j/dOuBLMwoNoyBDbEHT7shXb/kpKiIuFi4G', 'asasdasdasd', 'date', 'web', NULL, '35', 'sadfasdfsadfsad', 'asdfsadfda', 1, 269, 44, 21, NULL, NULL, '2019-10-13 10:34:35', '2019-10-13 10:34:35'),
(67, 'ahemd', 'asasd', '1005851101', 'male', NULL, 'samer@samer.com', '$2y$10$Had6QAu2vbItHIjTqLe8DO/5NFLgz2ZQvdE3O1yqh27oX/x7zqfne', 'asdasdadasdass', 'date', 'web', NULL, '20', 'asdasdasdasdas', 'asdasasdasdasda', 1, 268, 20, 25, NULL, NULL, '2019-10-13 12:25:26', '2019-10-13 12:25:26'),
(69, 'osam', 'ousama', '0038766789758', 'male', NULL, 'oussama16v@gmail.com', '$2y$10$fPdH9GYd683ZQvq5fAHB2.3I9BAc5xUEZY5oN/5gIsd5xTxkF4IIy', 'dddfggd', 'date', 'web', NULL, '27', 'ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', 'ddddddddddddddddddd', 1, 250, 10, 21, NULL, NULL, '2019-11-11 10:28:19', '2019-11-11 10:28:19'),
(70, 'samerabooda', 'samer', '42423423423', 'male', NULL, 'samerabdelmonem96@gmail.com', '$2y$10$UbzOixi414KyllZnJRtm8.yvnz3NXKUIhUBK.0WNmW1yHGPI6Q9qK', 'mit taher\r\nmansoura', 'date', 'web', NULL, '15', 'asdasdasdas', 'sadadsaas', 1, 290, 45, 25, 2, NULL, '2019-11-28 12:24:52', '2019-12-13 07:39:37'),
(73, 'samerabooda', NULL, NULL, 'male', NULL, 'serv5group.com@gmail.comsadsadas', '$2y$10$IAmCCV6Shj9xv7soyVzKkeVLx4lgRwTmlesKCxlf8R3Q6HSFV19xG', 'kanal elswis 49 St', 'date', 'web', 'nbU0fwHymSR0f6g8EVihuCzbRGDS7YVxmJC7BlSi.png', '12', '<p>asdsadasd</p>', '<p>asdasdasd</p>', 1, 268, 45, 22, 4, NULL, '2019-12-17 01:41:53', '2019-12-17 01:41:53'),
(74, 'asdasdasd', NULL, NULL, 'male', NULL, 'samerasdsadsadsa@gmail.com', '$2y$10$oLmWblxr0C9PeCyKkJ/dYuZLrBLt6A4J8I7An6QfkSBTk27qfuBy.', 'mit taher\r\nmansoura', 'date', 'web', 'g9TqtFsW9zL3cei3YlB7LQ85PSmfBYP8yZpBJzmV.png', '25', '<p>sdfads</p>', '<p>fssdfdf</p>', 1, 265, 45, 22, 4, NULL, '2019-12-17 01:47:39', '2019-12-17 03:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_action`
--

CREATE TABLE `user_action` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` enum('like','dislike','block') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_action`
--

INSERT INTO `user_action` (`id`, `status`, `action`, `from_id`, `to_id`, `created`, `created_at`, `updated_at`) VALUES
(111, 'pending', NULL, 65, 2, NULL, NULL, NULL),
(112, 'pending', 'like', 2, 65, '2019-10-13 10:30:38', NULL, NULL),
(113, 'pending', NULL, 65, 66, NULL, NULL, NULL),
(114, 'pending', 'like', 2, 69, '2019-11-13 12:27:11', NULL, NULL),
(115, 'pending', 'like', 2, 67, '2019-11-13 12:27:14', NULL, NULL),
(116, 'pending', 'like', 70, 66, '2019-11-28 12:25:37', NULL, NULL),
(117, 'pending', 'dislike', 70, 65, '2019-11-28 12:26:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('login','logout','online') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'login',
  `created` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `status`, `login`, `created`, `created_at`, `updated_at`) VALUES
(1, 2, 'online', 'login', '2019-12-10 23:15:14', NULL, NULL),
(34, 65, 'logout', 'login', '2019-10-13 19:23:01', NULL, NULL),
(35, 66, 'logout', 'login', '2019-10-13 12:36:16', NULL, NULL),
(36, 67, 'logout', 'login', '2019-10-13 14:36:12', NULL, NULL),
(37, 70, 'online', 'login', '2019-11-28 14:26:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(32, 65, 3, NULL, NULL),
(33, 66, 3, NULL, NULL),
(34, 67, 3, NULL, NULL),
(35, 70, 3, NULL, NULL),
(37, 73, 3, NULL, NULL),
(38, 74, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_favourite_options`
--

CREATE TABLE `user_favourite_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `option_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_favourite_options`
--

INSERT INTO `user_favourite_options` (`id`, `user_id`, `option_value_id`, `created_at`, `updated_at`) VALUES
(31, 2, 94, NULL, NULL),
(32, 2, 99, NULL, NULL),
(33, 67, 96, NULL, NULL),
(34, 67, 114, NULL, NULL),
(35, 67, 107, NULL, NULL),
(36, 65, 94, NULL, NULL),
(37, 65, 105, NULL, NULL),
(38, 65, 98, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_histories`
--

CREATE TABLE `user_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` enum('like','dislike','block','login','logout','search','send_message') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_histories`
--

INSERT INTO `user_histories` (`id`, `user_id`, `action`, `created`, `created_at`, `updated_at`) VALUES
(12, 2, 'login', '2019-12-10', NULL, NULL),
(13, 2, 'send_message', '2019-10-13', NULL, NULL),
(14, 2, 'logout', '2019-11-13', NULL, NULL),
(15, 2, 'dislike', '2019-10-08', NULL, NULL),
(16, 2, 'like', '2019-11-13', NULL, NULL),
(19, 2, 'search', '2019-10-09', NULL, NULL),
(24, 65, 'login', '2019-10-13', NULL, NULL),
(25, 65, 'logout', '2019-10-13', NULL, NULL),
(26, 66, 'login', '2019-10-13', NULL, NULL),
(27, 66, 'send_message', '2019-10-13', NULL, NULL),
(28, 66, 'logout', '2019-10-13', NULL, NULL),
(29, 67, 'login', '2019-10-13', NULL, NULL),
(30, 67, 'logout', '2019-10-13', NULL, NULL),
(31, 70, 'login', '2019-11-28', NULL, NULL),
(32, 70, 'like', '2019-11-28', NULL, NULL),
(33, 70, 'dislike', '2019-11-28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_membership`
--

CREATE TABLE `user_membership` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `membership_id` int(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_membership`
--

INSERT INTO `user_membership` (`id`, `cost`, `expire`, `user_id`, `membership_id`, `created_at`, `updated_at`) VALUES
(41, '260', '2019-12-14', 73, 5, NULL, NULL),
(42, NULL, '1970-01-01 00:00:00', 74, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_options`
--

CREATE TABLE `user_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `option_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_options`
--

INSERT INTO `user_options` (`id`, `user_id`, `option_value_id`, `created_at`, `updated_at`) VALUES
(372, 65, 94, NULL, NULL),
(373, 65, 98, NULL, NULL),
(374, 66, 94, NULL, NULL),
(375, 66, 98, NULL, NULL),
(379, 67, 97, NULL, NULL),
(380, 67, 114, NULL, NULL),
(381, 67, 108, NULL, NULL),
(382, 70, 96, NULL, NULL),
(383, 70, 114, NULL, NULL),
(384, 70, 107, NULL, NULL),
(388, 73, 94, NULL, NULL),
(389, 73, 105, NULL, NULL),
(390, 73, 98, NULL, NULL),
(406, 74, 95, NULL, NULL),
(407, 74, 105, NULL, NULL),
(408, 74, 98, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE `user_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('active','best') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_statuses`
--

INSERT INTO `user_statuses` (`id`, `user_id`, `type`, `created`, `created_at`, `updated_at`) VALUES
(40, 65, 'best', '2019-10-13', '2019-10-13 10:40:53', '2019-10-13 10:40:53'),
(41, 65, 'active', '2019-10-13', '2019-10-13 10:41:04', '2019-10-13 10:41:04'),
(42, 66, 'active', '2019-10-13', '2019-10-13 10:41:20', '2019-10-13 10:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_story`
--

CREATE TABLE `user_story` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `Partner_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album_categories`
--
ALTER TABLE `album_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `album_category_data`
--
ALTER TABLE `album_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_category_data_lang_id_foreign` (`lang_id`),
  ADD KEY `album_category_data_album_category_id_foreign` (`album_category_id`);

--
-- Indexes for table `artcl_categories`
--
ALTER TABLE `artcl_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artcl_categories_lang_id_foreign` (`lang_id`),
  ADD KEY `artcl_categories_source_id_foreign` (`source_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_category_id_foreign` (`category_id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `source_id` (`source_id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_category_category_id_foreign` (`category_id`),
  ADD KEY `article_category_article_id_foreign` (`article_id`);

--
-- Indexes for table `article_datas`
--
ALTER TABLE `article_datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_datas_lang_id_foreign` (`lang_id`),
  ADD KEY `article_datas_source_id_foreign` (`source_id`),
  ADD KEY `article_datas_ibfk_1` (`article_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_data`
--
ALTER TABLE `bank_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_data_bank_id_foreign` (`bank_id`),
  ADD KEY `bank_data_lang_id_foreign` (`lang_id`),
  ADD KEY `bank_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banner_section_id_foreign` (`section_id`);

--
-- Indexes for table `banner_data`
--
ALTER TABLE `banner_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banner_data_banner_id_foreign` (`banner_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_lang_id_foreign` (`lang_id`),
  ADD KEY `categories_source_id_foreign` (`source_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_nationalty_id_foreign` (`nationalty_id`);

--
-- Indexes for table `cities_data`
--
ALTER TABLE `cities_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_data_city_id_foreign` (`city_id`),
  ADD KEY `cities_data_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_section`
--
ALTER TABLE `content_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_section_data`
--
ALTER TABLE `content_section_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_section_data_section_id_foreign` (`section_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_status`
--
ALTER TABLE `material_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_status_lang_id_foreign` (`lang_id`),
  ADD KEY `material_status_source_id_foreign` (`source_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberships_lang_id_foreign` (`lang_id`),
  ADD KEY `memberships_source_id_foreign` (`source_id`);

--
-- Indexes for table `membership_data_types`
--
ALTER TABLE `membership_data_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_data_types_membership_type_id_foreign` (`memberShip_type_id`);

--
-- Indexes for table `membership_options`
--
ALTER TABLE `membership_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_options_membership_type_id_foreign` (`membership_type_id`);

--
-- Indexes for table `membership_types`
--
ALTER TABLE `membership_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_from_id_foreign` (`from_id`),
  ADD KEY `messages_to_id_foreign` (`to_id`);

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
-- Indexes for table `nationalies_data`
--
ALTER TABLE `nationalies_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nationalies_data_nationalty_id_foreign` (`nationalty_id`),
  ADD KEY `nationalies_data_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `nationalties`
--
ALTER TABLE `nationalties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newletters`
--
ALTER TABLE `newletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_group_id_foreign` (`group_id`),
  ADD KEY `options_lang_id_foreign` (`lang_id`),
  ADD KEY `options_source_id_foreign` (`source_id`);

--
-- Indexes for table `option_groups`
--
ALTER TABLE `option_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_groups_lang_id_foreign` (`lang_id`),
  ADD KEY `option_groups_source_id_foreign` (`source_id`);

--
-- Indexes for table `option_values`
--
ALTER TABLE `option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_values_option_id_foreign` (`option_id`),
  ADD KEY `option_values_lang_id_foreign` (`lang_id`),
  ADD KEY `option_values_source_id_foreign` (`source_id`);

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
-- Indexes for table `permissions_memberships`
--
ALTER TABLE `permissions_memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_memberships_permision_id_foreign` (`permision_id`),
  ADD KEY `permissions_memberships_membership_type_id_foreign` (`memberShip_type_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_id` (`source_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `sliders_ibfk_2` (`source_id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stories_user_id_foreign` (`user_id`),
  ADD KEY `stories_lang_id_foreign` (`lang_id`),
  ADD KEY `stories_source_id_foreign` (`source_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_nationalty_id_foreign` (`nationalty_id`),
  ADD KEY `users_material_status_id_foreign` (`material_status_id`),
  ADD KEY `users_resident_country_id_foreign` (`resident_country_id`),
  ADD KEY `users_city_id_foreign` (`city_id`);

--
-- Indexes for table `user_action`
--
ALTER TABLE `user_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_action_from_id_foreign` (`from_id`),
  ADD KEY `user_action_to_id_foreign` (`to_id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activity_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_category_user_id_foreign` (`user_id`),
  ADD KEY `user_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `user_favourite_options`
--
ALTER TABLE `user_favourite_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_favourite_options_user_id_foreign` (`user_id`),
  ADD KEY `user_favourite_options_option_value_id_foreign` (`option_value_id`);

--
-- Indexes for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_membership`
--
ALTER TABLE `user_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_membership_user_id_foreign` (`user_id`),
  ADD KEY `user_membership_membership_id_foreign` (`membership_id`);

--
-- Indexes for table `user_options`
--
ALTER TABLE `user_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_options_user_id_foreign` (`user_id`),
  ADD KEY `user_options_option_value_id_foreign` (`option_value_id`);

--
-- Indexes for table `user_statuses`
--
ALTER TABLE `user_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_statuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_story`
--
ALTER TABLE `user_story`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_story_user_id_foreign` (`user_id`),
  ADD KEY `user_story_store_id_foreign` (`store_id`),
  ADD KEY `user_story_partner_id_foreign` (`Partner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album_categories`
--
ALTER TABLE `album_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `album_category_data`
--
ALTER TABLE `album_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `artcl_categories`
--
ALTER TABLE `artcl_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `article_datas`
--
ALTER TABLE `article_datas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bank_data`
--
ALTER TABLE `bank_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `banner_data`
--
ALTER TABLE `banner_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities_data`
--
ALTER TABLE `cities_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `content_section`
--
ALTER TABLE `content_section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `content_section_data`
--
ALTER TABLE `content_section_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material_status`
--
ALTER TABLE `material_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `membership_data_types`
--
ALTER TABLE `membership_data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `membership_options`
--
ALTER TABLE `membership_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `membership_types`
--
ALTER TABLE `membership_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `nationalies_data`
--
ALTER TABLE `nationalies_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `nationalties`
--
ALTER TABLE `nationalties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- AUTO_INCREMENT for table `newletters`
--
ALTER TABLE `newletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `option_groups`
--
ALTER TABLE `option_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `option_values`
--
ALTER TABLE `option_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `permissions_memberships`
--
ALTER TABLE `permissions_memberships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `user_action`
--
ALTER TABLE `user_action`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_favourite_options`
--
ALTER TABLE `user_favourite_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_histories`
--
ALTER TABLE `user_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_membership`
--
ALTER TABLE `user_membership`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_options`
--
ALTER TABLE `user_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `user_statuses`
--
ALTER TABLE `user_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_story`
--
ALTER TABLE `user_story`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_categories`
--
ALTER TABLE `album_categories`
  ADD CONSTRAINT `album_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `album_category_data`
--
ALTER TABLE `album_category_data`
  ADD CONSTRAINT `album_category_data_album_category_id_foreign` FOREIGN KEY (`album_category_id`) REFERENCES `album_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_category_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `artcl_categories`
--
ALTER TABLE `artcl_categories`
  ADD CONSTRAINT `artcl_categories_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artcl_categories_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `artcl_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `artcl_categories` (`id`),
  ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`source_id`) REFERENCES `articles` (`id`);

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `artcl_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_category_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_datas`
--
ALTER TABLE `article_datas`
  ADD CONSTRAINT `article_datas_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_datas_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_datas_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `article_datas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_data`
--
ALTER TABLE `bank_data`
  ADD CONSTRAINT `bank_data_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `bank_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `banner_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `content_section` (`id`);

--
-- Constraints for table `banner_data`
--
ALTER TABLE `banner_data`
  ADD CONSTRAINT `banner_data_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_nationalty_id_foreign` FOREIGN KEY (`nationalty_id`) REFERENCES `nationalties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities_data`
--
ALTER TABLE `cities_data`
  ADD CONSTRAINT `cities_data_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cities_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_section_data`
--
ALTER TABLE `content_section_data`
  ADD CONSTRAINT `content_section_data_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `content_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material_status`
--
ALTER TABLE `material_status`
  ADD CONSTRAINT `material_status_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `material_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_status_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `memberships_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `memberships_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership_data_types`
--
ALTER TABLE `membership_data_types`
  ADD CONSTRAINT `membership_data_types_membership_type_id_foreign` FOREIGN KEY (`memberShip_type_id`) REFERENCES `membership_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership_options`
--
ALTER TABLE `membership_options`
  ADD CONSTRAINT `membership_options_membership_type_id_foreign` FOREIGN KEY (`membership_type_id`) REFERENCES `membership_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `nationalies_data`
--
ALTER TABLE `nationalies_data`
  ADD CONSTRAINT `nationalies_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nationalies_data_nationalty_id_foreign` FOREIGN KEY (`nationalty_id`) REFERENCES `nationalties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `option_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `option_groups`
--
ALTER TABLE `option_groups`
  ADD CONSTRAINT `option_groups_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `option_groups_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `option_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `option_values`
--
ALTER TABLE `option_values`
  ADD CONSTRAINT `option_values_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `option_values_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `option_values_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `option_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions_memberships`
--
ALTER TABLE `permissions_memberships`
  ADD CONSTRAINT `permissions_memberships_membership_type_id_foreign` FOREIGN KEY (`memberShip_type_id`) REFERENCES `membership_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permissions_memberships_permision_id_foreign` FOREIGN KEY (`permision_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `settings` (`id`),
  ADD CONSTRAINT `settings_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `sliders_ibfk_2` FOREIGN KEY (`source_id`) REFERENCES `sliders` (`id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stories_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities_data` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_material_status_id_foreign` FOREIGN KEY (`material_status_id`) REFERENCES `material_status` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_nationalty_id_foreign` FOREIGN KEY (`nationalty_id`) REFERENCES `nationalties` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_resident_country_id_foreign` FOREIGN KEY (`resident_country_id`) REFERENCES `nationalies_data` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `user_action`
--
ALTER TABLE `user_action`
  ADD CONSTRAINT `user_action_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_action_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_category`
--
ALTER TABLE `user_category`
  ADD CONSTRAINT `user_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_category_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_favourite_options`
--
ALTER TABLE `user_favourite_options`
  ADD CONSTRAINT `user_favourite_options_option_value_id_foreign` FOREIGN KEY (`option_value_id`) REFERENCES `option_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_favourite_options_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD CONSTRAINT `user_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_membership`
--
ALTER TABLE `user_membership`
  ADD CONSTRAINT `user_membership_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `membership_types` (`id`),
  ADD CONSTRAINT `user_membership_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_options`
--
ALTER TABLE `user_options`
  ADD CONSTRAINT `user_options_option_value_id_foreign` FOREIGN KEY (`option_value_id`) REFERENCES `option_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_options_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_statuses`
--
ALTER TABLE `user_statuses`
  ADD CONSTRAINT `user_statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_story`
--
ALTER TABLE `user_story`
  ADD CONSTRAINT `user_story_partner_id_foreign` FOREIGN KEY (`Partner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_story_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_story_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
