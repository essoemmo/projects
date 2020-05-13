-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2020 at 10:02 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salla`
--

-- --------------------------------------------------------

--
-- Table structure for table `abandoned_carts`
--

CREATE TABLE `abandoned_carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `published` tinyint(1) DEFAULT '0',
  `img_url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `store_id`, `category_id`, `published`, `img_url`, `created`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, '/uploads/articles/1/1582492148.jpg', '2020-02-22', '2020-02-23 19:09:08', '2020-02-23 19:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `articles_data`
--

CREATE TABLE `articles_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles_data`
--

INSERT INTO `articles_data` (`id`, `article_id`, `lang_id`, `source_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'كيف تضاعف ارباح متجرك', '<p>كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;كيف تضاعف ارباح متجرك&nbsp;</p>', '2020-02-23 19:09:08', '2020-02-23 19:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  `img_url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `store_id`, `published`, `img_url`, `created`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, '/uploads/artcl_category/1/1582492082.jpg', '2020-02-23', '2020-02-23 19:08:01', '2020-02-23 19:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `article_category_data`
--

CREATE TABLE `article_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category_data`
--

INSERT INTO `article_category_data` (`id`, `category_id`, `lang_id`, `source_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'التجارة الإلكترونية', '2020-02-23 19:08:02', '2020-02-23 19:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfers`
--

CREATE TABLE `bank_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_number` int(11) NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_transfers`
--

INSERT INTO `bank_transfers` (`id`, `store_id`, `title`, `holder_name`, `iban`, `holder_number`, `logo`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(2, 17, 'wqddq', 'dwqwdqwd', '3253453435345', 453453465, '/uploads/bank/158140233274794.png', NULL, NULL, '2020-02-11 04:25:32', '2020-02-11 04:25:32');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `published`, `sort_order`, `link`, `image`, `created_at`, `updated_at`, `store_id`) VALUES
(1, 1, 1, 'https://abarhail.net/beta/details/22', 'download.jpeg', '2019-12-29 20:26:07', '2019-12-29 20:26:07', 3),
(5, 1, 2, 'https://abarhail.net/beta/details/22', 'كروت-فودافون.png', '2020-03-05 05:40:30', '2020-03-06 13:29:25', 17),
(6, 1, 13, 'https://abarhail.net/beta/details/22', 'bracelets-casual-clothes-934063.png', '2020-03-05 06:36:58', '2020-03-06 13:48:31', 17);

-- --------------------------------------------------------

--
-- Table structure for table `banners_data`
--

CREATE TABLE `banners_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners_data`
--

INSERT INTO `banners_data` (`id`, `banner_id`, `lang_id`, `source_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, NULL, 'vodafone', '<p>Try</p>', '2020-03-05 05:40:30', '2020-03-06 14:16:20'),
(2, 6, NULL, NULL, 'معا', '<p>خصم 10% ع المنتجات</p>', '2020-03-05 06:36:58', '2020-03-06 13:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands_data`
--

CREATE TABLE `brands_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `number` smallint(6) NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `number`, `store_id`, `parent_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(177, 'رجالي', NULL, 1, 3, NULL, 2, NULL, '2019-12-26 03:28:18', '2019-12-30 07:39:51'),
(185, 'نسائي', NULL, 2, 3, NULL, 2, NULL, '2019-12-26 03:35:36', '2019-12-30 07:39:51'),
(192, 'اطفال', NULL, 3, 3, NULL, 2, NULL, '2019-12-26 04:00:59', '2019-12-30 07:39:51'),
(193, 'تنورة', NULL, 0, 3, 185, 2, NULL, '2019-12-26 06:30:15', '2019-12-30 07:39:51'),
(194, 'بلوزة', NULL, 1, 3, 185, 2, NULL, '2019-12-30 07:39:51', '2019-12-30 07:39:51'),
(195, 'ملابس', NULL, 1, 17, NULL, 2, NULL, '2019-12-30 20:18:05', '2019-12-30 20:18:05'),
(196, 'اكسسوارات', NULL, 2, 17, NULL, 2, NULL, '2019-12-30 20:18:05', '2019-12-30 20:18:05'),
(197, 'قمصان', NULL, 0, 3, 177, 2, NULL, '2019-12-30 23:58:36', '2019-12-30 23:58:36'),
(198, 'بناطيل', NULL, 1, 3, 177, 2, NULL, '2019-12-30 23:58:36', '2019-12-30 23:58:36'),
(199, 'تحت 3 سنوات', NULL, 0, 3, 192, 2, NULL, '2019-12-30 23:58:36', '2019-12-30 23:58:36'),
(200, 'من 3 اي 6', NULL, 1, 3, 192, 2, NULL, '2019-12-30 23:58:36', '2019-12-30 23:58:36'),
(203, 'رجالي', NULL, 0, 17, 195, 2, NULL, '2019-12-31 14:18:24', '2019-12-31 14:18:24'),
(204, 'حريمي', NULL, 1, 17, 195, 2, NULL, '2019-12-31 14:18:24', '2019-12-31 14:18:24'),
(205, 'مطبخ', NULL, 0, 17, 196, 2, NULL, '2019-12-31 14:18:24', '2019-12-31 14:18:24'),
(211, 'ملابس', NULL, 1, NULL, NULL, 2, NULL, '2020-02-26 07:39:07', '2020-02-26 08:38:51'),
(213, 'أجهزة الكترونيه', NULL, 2, NULL, NULL, 2, NULL, '2020-02-26 08:38:51', '2020-02-26 08:38:51'),
(214, 'جولات', NULL, 0, NULL, 213, 2, NULL, '2020-02-26 08:38:52', '2020-02-26 08:38:52'),
(215, 'اجهزة لوحيه', NULL, 1, NULL, 213, 2, NULL, '2020-02-26 08:38:52', '2020-02-26 08:38:52'),
(216, 'رجالي', NULL, 0, NULL, 211, 2, NULL, '2020-02-26 08:38:52', '2020-02-26 08:38:52'),
(217, 'حريمي', NULL, 1, NULL, 211, 2, NULL, '2020-02-26 08:38:52', '2020-02-26 08:38:52'),
(218, 'أولاد', NULL, 2, NULL, 211, 2, NULL, '2020-02-26 08:38:52', '2020-02-26 08:38:52'),
(219, 'بنات', NULL, 3, NULL, 211, 2, NULL, '2020-02-26 08:38:52', '2020-02-26 08:38:52'),
(284, 'أجهزة الكترونيه', NULL, 2, 17, NULL, 2, NULL, NULL, NULL),
(285, 'ملابس', NULL, 1, 18, NULL, 2, NULL, NULL, NULL),
(286, 'أجهزة الكترونيه', NULL, 2, 18, NULL, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories_products`
--

CREATE TABLE `categories_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories_products`
--

INSERT INTO `categories_products` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(54, 37, 177, NULL, NULL),
(58, 39, 192, NULL, NULL),
(62, 41, 185, NULL, NULL),
(63, 41, 193, NULL, NULL),
(64, 42, 195, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `celebrates`
--

CREATE TABLE `celebrates` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created` date NOT NULL,
  `status` enum('pending','active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 1, NULL, NULL),
(3, 1, NULL, NULL),
(4, 1, NULL, NULL),
(5, 1, NULL, NULL),
(6, 1, NULL, NULL),
(7, 1, NULL, NULL),
(8, 1, NULL, NULL),
(9, 1, NULL, NULL),
(10, 1, NULL, NULL),
(11, 1, NULL, NULL),
(12, 1, NULL, NULL),
(13, 1, NULL, NULL),
(14, 1, NULL, NULL),
(15, 1, NULL, NULL),
(16, 1, NULL, NULL),
(17, 1, NULL, NULL),
(18, 1, NULL, NULL),
(19, 1, NULL, NULL),
(20, 1, NULL, NULL),
(21, 1, NULL, NULL),
(22, 1, NULL, NULL),
(23, 1, NULL, NULL),
(24, 1, NULL, NULL),
(25, 1, NULL, NULL),
(26, 1, NULL, NULL),
(27, 1, NULL, NULL),
(28, 2, NULL, NULL),
(29, 2, NULL, NULL),
(30, 2, NULL, NULL),
(31, 2, NULL, NULL),
(32, 2, NULL, NULL),
(33, 2, NULL, NULL),
(34, 2, NULL, NULL),
(35, 2, NULL, NULL),
(36, 2, NULL, NULL),
(37, 2, NULL, NULL),
(38, 2, NULL, NULL),
(39, 2, NULL, NULL),
(40, 2, NULL, NULL),
(41, 2, NULL, NULL),
(42, 2, NULL, NULL),
(43, 3, NULL, NULL),
(44, 3, NULL, NULL),
(45, 3, NULL, NULL),
(46, 3, NULL, NULL),
(47, 3, NULL, NULL),
(48, 3, NULL, NULL),
(49, 3, NULL, NULL),
(50, 3, NULL, NULL),
(51, 3, NULL, NULL),
(52, 3, NULL, NULL),
(53, 3, NULL, NULL),
(54, 3, NULL, NULL),
(55, 3, NULL, NULL),
(56, 3, NULL, NULL),
(57, 3, NULL, NULL),
(58, 3, NULL, NULL),
(59, 3, NULL, NULL),
(60, 3, NULL, NULL),
(61, 3, NULL, NULL),
(62, 4, NULL, NULL),
(63, 4, NULL, NULL),
(64, 4, NULL, NULL),
(65, 4, NULL, NULL),
(66, 4, NULL, NULL),
(67, 4, NULL, NULL),
(68, 4, NULL, NULL),
(69, 4, NULL, NULL),
(70, 4, NULL, NULL),
(71, 4, NULL, NULL),
(72, 4, NULL, NULL),
(73, 4, NULL, NULL),
(74, 4, NULL, NULL),
(75, 4, NULL, NULL),
(76, 5, NULL, NULL),
(77, 5, NULL, NULL),
(78, 5, NULL, NULL),
(79, 5, NULL, NULL),
(80, 5, NULL, NULL),
(81, 5, NULL, NULL),
(82, 5, NULL, NULL),
(83, 5, NULL, NULL),
(84, 6, NULL, NULL),
(85, 6, NULL, NULL),
(86, 6, NULL, NULL),
(87, 6, NULL, NULL),
(88, 6, NULL, NULL),
(89, 6, NULL, NULL),
(90, 6, NULL, NULL),
(91, 6, NULL, NULL),
(92, 6, NULL, NULL),
(93, 6, NULL, NULL),
(94, 6, NULL, NULL),
(95, 6, NULL, NULL),
(96, 7, NULL, NULL),
(97, 7, NULL, NULL),
(98, 7, NULL, NULL),
(99, 7, NULL, NULL),
(100, 7, NULL, NULL),
(101, 7, NULL, NULL),
(102, 7, NULL, NULL),
(103, 7, NULL, NULL),
(104, 7, NULL, NULL),
(105, 7, NULL, NULL),
(106, 7, NULL, NULL),
(107, 7, NULL, NULL),
(108, 7, NULL, NULL),
(109, 7, NULL, NULL),
(110, 7, NULL, NULL),
(111, 7, NULL, NULL),
(112, 7, NULL, NULL),
(113, 7, NULL, NULL),
(114, 7, NULL, NULL),
(115, 8, NULL, NULL),
(116, 8, NULL, NULL),
(117, 8, NULL, NULL),
(118, 8, NULL, NULL),
(119, 8, NULL, NULL),
(120, 8, NULL, NULL),
(121, 8, NULL, NULL),
(122, 8, NULL, NULL),
(123, 8, NULL, NULL),
(124, 8, NULL, NULL),
(125, 8, NULL, NULL),
(126, 8, NULL, NULL),
(127, 8, NULL, NULL),
(128, 8, NULL, NULL),
(129, 8, NULL, NULL),
(130, 8, NULL, NULL),
(131, 8, NULL, NULL),
(132, 8, NULL, NULL),
(133, 8, NULL, NULL),
(134, 8, NULL, NULL),
(135, 8, NULL, NULL),
(136, 8, NULL, NULL),
(137, 9, NULL, NULL),
(138, 9, NULL, NULL),
(139, 9, NULL, NULL),
(140, 9, NULL, NULL),
(141, 9, NULL, NULL),
(142, 9, NULL, NULL),
(143, 9, NULL, NULL),
(144, 9, NULL, NULL),
(145, 9, NULL, NULL),
(146, 9, NULL, NULL),
(147, 9, NULL, NULL),
(148, 9, NULL, NULL),
(149, 9, NULL, NULL),
(150, 9, NULL, NULL),
(151, 10, NULL, NULL),
(152, 10, NULL, NULL),
(153, 10, NULL, NULL),
(154, 10, NULL, NULL),
(155, 10, NULL, NULL),
(156, 10, NULL, NULL),
(157, 10, NULL, NULL),
(158, 10, NULL, NULL),
(159, 10, NULL, NULL),
(160, 10, NULL, NULL),
(161, 10, NULL, NULL),
(162, 10, NULL, NULL),
(163, 10, NULL, NULL),
(164, 10, NULL, NULL),
(165, 10, NULL, NULL),
(166, 10, NULL, NULL),
(167, 10, NULL, NULL),
(168, 10, NULL, NULL),
(169, 10, NULL, NULL),
(170, 10, NULL, NULL),
(171, 10, NULL, NULL),
(172, 10, NULL, NULL),
(173, 10, NULL, NULL),
(174, 10, NULL, NULL),
(175, 11, NULL, NULL),
(176, 11, NULL, NULL),
(177, 11, NULL, NULL),
(178, 11, NULL, NULL),
(179, 11, NULL, NULL),
(180, 11, NULL, NULL),
(181, 12, NULL, NULL),
(182, 12, NULL, NULL),
(183, 12, NULL, NULL),
(184, 12, NULL, NULL),
(185, 12, NULL, NULL),
(186, 12, NULL, NULL),
(187, 12, NULL, NULL),
(188, 12, NULL, NULL),
(189, 12, NULL, NULL),
(190, 12, NULL, NULL),
(191, 12, NULL, NULL),
(192, 12, NULL, NULL),
(193, 12, NULL, NULL),
(194, 12, NULL, NULL),
(195, 12, NULL, NULL),
(196, 12, NULL, NULL),
(197, 12, NULL, NULL),
(198, 12, NULL, NULL),
(199, 12, NULL, NULL),
(200, 12, NULL, NULL),
(201, 12, NULL, NULL),
(202, 12, NULL, NULL),
(203, 12, NULL, NULL),
(204, 12, NULL, NULL),
(205, 12, NULL, NULL),
(206, 12, NULL, NULL),
(207, 12, NULL, NULL),
(208, 12, NULL, NULL),
(209, 12, NULL, NULL),
(210, 12, NULL, NULL),
(211, 12, NULL, NULL),
(212, 12, NULL, NULL),
(213, 12, NULL, NULL),
(214, 12, NULL, NULL),
(215, 12, NULL, NULL),
(216, 12, NULL, NULL),
(217, 12, NULL, NULL),
(218, 12, NULL, NULL),
(219, 12, NULL, NULL),
(220, 12, NULL, NULL),
(221, 12, NULL, NULL),
(222, 12, NULL, NULL),
(223, 12, NULL, NULL),
(224, 13, NULL, NULL),
(225, 13, NULL, NULL),
(226, 13, NULL, NULL),
(227, 13, NULL, NULL),
(228, 14, NULL, NULL),
(229, 14, NULL, NULL),
(230, 14, NULL, NULL),
(231, 14, NULL, NULL),
(232, 14, NULL, NULL),
(233, 14, NULL, NULL),
(234, 14, NULL, NULL),
(235, 15, NULL, NULL),
(236, 15, NULL, NULL),
(237, 15, NULL, NULL),
(238, 15, NULL, NULL),
(239, 15, NULL, NULL),
(240, 15, NULL, NULL),
(241, 15, NULL, NULL),
(242, 15, NULL, NULL),
(243, 15, NULL, NULL),
(244, 15, NULL, NULL),
(245, 16, NULL, NULL),
(246, 16, NULL, NULL),
(247, 16, NULL, NULL),
(248, 16, NULL, NULL),
(249, 16, NULL, NULL),
(250, 16, NULL, NULL),
(251, 16, NULL, NULL),
(252, 16, NULL, NULL),
(253, 16, NULL, NULL),
(254, 16, NULL, NULL),
(255, 16, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities_shipping_options`
--

CREATE TABLE `cities_shipping_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `shipping_option_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city_datas`
--

CREATE TABLE `city_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_datas`
--

INSERT INTO `city_datas` (`id`, `title`, `lang_id`, `source_id`, `created_at`, `updated_at`, `city_id`) VALUES
(1, 'الإسكندرية', 2, NULL, NULL, NULL, 1),
(2, 'أسوان', 2, NULL, NULL, NULL, 2),
(3, 'أسيوط', 2, NULL, NULL, NULL, 3),
(4, 'البحيرة', 2, NULL, NULL, NULL, 4),
(5, 'بني سويف', 2, NULL, NULL, NULL, 5),
(6, '	القاهرة', 2, NULL, NULL, NULL, 6),
(7, 'الدقهلية', 2, NULL, NULL, NULL, 7),
(8, 'دمياط', 2, NULL, NULL, NULL, 8),
(9, 'الفيوم', 2, NULL, NULL, NULL, 9),
(10, 'الغربية', 2, NULL, NULL, NULL, 10),
(11, 'الجيزة', 2, NULL, NULL, NULL, 11),
(12, 'الإسماعيلية', 2, NULL, NULL, NULL, 12),
(13, 'كفر الشيخ', 2, NULL, NULL, NULL, 13),
(14, 'الأقصر', 2, NULL, NULL, NULL, 14),
(15, 'مطروح', 2, NULL, NULL, NULL, 15),
(16, 'المنيا', 2, NULL, NULL, NULL, 16),
(17, 'المنوفية', 2, NULL, NULL, NULL, 17),
(18, 'الوادي الجديد', 2, NULL, NULL, NULL, 18),
(19, 'شمال سيناء', 2, NULL, NULL, NULL, 19),
(20, 'بورسعيد', 2, NULL, NULL, NULL, 20),
(21, 'القليوبية', 2, NULL, NULL, NULL, 21),
(22, 'قنا', 2, NULL, NULL, NULL, 22),
(23, 'البحر الأحمر', 2, NULL, NULL, NULL, 23),
(24, 'الشرقية', 2, NULL, NULL, NULL, 24),
(25, 'سوهاج', 2, NULL, NULL, NULL, 25),
(26, 'جنوب سيناء', 2, NULL, NULL, NULL, 26),
(27, 'السويس', 2, NULL, NULL, NULL, 27),
(28, 'الرياض', 2, NULL, NULL, NULL, 28),
(29, 'مكة المكرمة', 2, NULL, NULL, NULL, 29),
(30, 'المدينة المنورة', 2, NULL, NULL, NULL, 30),
(31, 'القصيم', 2, NULL, NULL, NULL, 31),
(32, 'جدة', 2, NULL, NULL, NULL, 32),
(33, 'الطائف', 2, NULL, NULL, NULL, 33),
(34, 'تبوك', 2, NULL, NULL, NULL, 34),
(35, 'حائل', 2, NULL, NULL, NULL, 35),
(36, 'ينبع', 2, NULL, NULL, NULL, 36),
(37, 'جازان', 2, NULL, NULL, NULL, 37),
(38, 'نجران', 2, NULL, NULL, NULL, 38),
(39, 'الدمام', 2, NULL, NULL, NULL, 39),
(40, 'الخبر', 2, NULL, NULL, NULL, 40),
(41, 'ابها', 2, NULL, NULL, NULL, 41),
(42, 'الباحة', 2, NULL, NULL, NULL, 42),
(43, '	أربيل', 2, NULL, NULL, NULL, 43),
(44, 'الأنبار', 2, NULL, NULL, NULL, 44),
(45, 'بابل', 2, NULL, NULL, NULL, 45),
(46, 'بغداد', 2, NULL, NULL, NULL, 46),
(47, 'البصرة', 2, NULL, NULL, NULL, 47),
(48, 'حلبجة', 2, NULL, NULL, NULL, 48),
(49, 'دهوك', 2, NULL, NULL, NULL, 49),
(50, 'القادسية', 2, NULL, NULL, NULL, 50),
(51, 'ديالى', 2, NULL, NULL, NULL, 51),
(52, 'ذي قار', 2, NULL, NULL, NULL, 52),
(53, 'السليمانية', 2, NULL, NULL, NULL, 53),
(54, 'صلاح الدين', 2, NULL, NULL, NULL, 54),
(55, 'كركوك', 2, NULL, NULL, NULL, 55),
(56, 'كربلاء', 2, NULL, NULL, NULL, 56),
(57, 'المثنى', 2, NULL, NULL, NULL, 57),
(58, 'ميسان', 2, NULL, NULL, NULL, 58),
(59, 'النجف', 2, NULL, NULL, NULL, 59),
(60, 'نينوى', 2, NULL, NULL, NULL, 60),
(61, 'واسط', 2, NULL, NULL, NULL, 61),
(62, 'درعا', 2, NULL, NULL, NULL, 62),
(63, 'دير الزور', 2, NULL, NULL, NULL, 63),
(64, 'حلب', 2, NULL, NULL, NULL, 64),
(65, 'حماة', 2, NULL, NULL, NULL, 65),
(66, 'الحسكة', 2, NULL, NULL, NULL, 66),
(67, 'حمص', 2, NULL, NULL, NULL, 67),
(68, 'ادلب', 2, NULL, NULL, NULL, 68),
(69, 'القنيطرة', 2, NULL, NULL, NULL, 69),
(70, 'اللاذقية', 2, NULL, NULL, NULL, 70),
(71, 'الرقة', 2, NULL, NULL, NULL, 71),
(72, 'ريف دمشق', 2, NULL, NULL, NULL, 72),
(73, 'السويداء', 2, NULL, NULL, NULL, 73),
(74, 'دمشق', 2, NULL, NULL, NULL, 74),
(75, 'طرطوس', 2, NULL, NULL, NULL, 75),
(76, 'بيروت', 2, NULL, NULL, NULL, 76),
(77, 'جبل لبنان', 2, NULL, NULL, NULL, 77),
(78, 'لبنان الشمالى', 2, NULL, NULL, NULL, 78),
(79, 'لبنان الجنوبى', 2, NULL, NULL, NULL, 79),
(80, 'البقاع', 2, NULL, NULL, NULL, 80),
(81, 'النبطية', 2, NULL, NULL, NULL, 81),
(82, 'بعلبك الهرمل', 2, NULL, NULL, NULL, 82),
(83, 'عكار', 2, NULL, NULL, NULL, 83),
(84, 'إربد', 2, NULL, NULL, NULL, 84),
(85, 'البلقاء', 2, NULL, NULL, NULL, 85),
(86, 'جرش', 2, NULL, NULL, NULL, 86),
(87, 'الزرقاء', 2, NULL, NULL, NULL, 87),
(88, 'الطفيلة', 2, NULL, NULL, NULL, 88),
(89, 'عجلون', 2, NULL, NULL, NULL, 89),
(90, 'العقبة', 2, NULL, NULL, NULL, 90),
(91, 'عمان', 2, NULL, NULL, NULL, 91),
(92, 'الكرك', 2, NULL, NULL, NULL, 92),
(93, 'مادبا', 2, NULL, NULL, NULL, 93),
(94, 'معان', 2, NULL, NULL, NULL, 94),
(95, 'المفرق', 2, NULL, NULL, NULL, 95),
(96, 'عمران', 2, NULL, NULL, NULL, 96),
(97, 'البيضاء', 2, NULL, NULL, NULL, 97),
(98, 'الحديدة', 2, NULL, NULL, NULL, 98),
(99, 'الجوف', 2, NULL, NULL, NULL, 99),
(100, 'المحويت', 2, NULL, NULL, NULL, 100),
(101, 'صنعاء', 2, NULL, NULL, NULL, 101),
(102, 'ذمار', 2, NULL, NULL, NULL, 102),
(103, 'حجة', 2, NULL, NULL, NULL, 103),
(104, 'إب', 2, NULL, NULL, NULL, 104),
(105, 'مأرب', 2, NULL, NULL, NULL, 105),
(106, 'ريمة', 2, NULL, NULL, NULL, 106),
(107, 'صعدة', 2, NULL, NULL, NULL, 107),
(108, 'صنعاء', 2, NULL, NULL, NULL, 108),
(109, 'تعز', 2, NULL, NULL, NULL, 109),
(110, 'عدن', 2, NULL, NULL, NULL, 110),
(111, 'أبين', 2, NULL, NULL, NULL, 111),
(112, 'الضالع', 2, NULL, NULL, NULL, 112),
(113, 'المهرة', 2, NULL, NULL, NULL, 113),
(114, 'حضرموت', 2, NULL, NULL, NULL, 114),
(115, 'البطنان', 2, NULL, NULL, NULL, 115),
(116, 'درنة', 2, NULL, NULL, NULL, 116),
(117, 'الجبل الأخضر', 2, NULL, NULL, NULL, 117),
(118, 'المرج', 2, NULL, NULL, NULL, 118),
(119, 'بنغازي', 2, NULL, NULL, NULL, 119),
(120, 'الواحات', 2, NULL, NULL, NULL, 120),
(121, 'الكفرة', 2, NULL, NULL, NULL, 121),
(122, 'سرت', 2, NULL, NULL, NULL, 122),
(123, 'الجفرة', 2, NULL, NULL, NULL, 123),
(124, 'مصراتة', 2, NULL, NULL, NULL, 124),
(125, 'المرقب', 2, NULL, NULL, NULL, 125),
(126, 'طرابلس', 2, NULL, NULL, NULL, 126),
(127, 'الجفارة', 2, NULL, NULL, NULL, 127),
(128, 'الزاوية', 2, NULL, NULL, NULL, 128),
(129, 'زوارة', 2, NULL, NULL, NULL, 129),
(130, 'الجبل الغربي', 2, NULL, NULL, NULL, 130),
(131, 'نالوت', 2, NULL, NULL, NULL, 131),
(132, 'سبها', 2, NULL, NULL, NULL, 132),
(133, 'وادي الشاطئ', 2, NULL, NULL, NULL, 133),
(134, 'مرزق', 2, NULL, NULL, NULL, 134),
(135, 'وادي الحياة', 2, NULL, NULL, NULL, 135),
(136, 'غات', 2, NULL, NULL, NULL, 136),
(137, 'طنجة', 2, NULL, NULL, NULL, 137),
(138, 'تطوان', 2, NULL, NULL, NULL, 138),
(139, 'القصر الكبير', 2, NULL, NULL, NULL, 139),
(140, 'العرائش', 2, NULL, NULL, NULL, 140),
(141, 'الفنيدق', 2, NULL, NULL, NULL, 141),
(142, 'مارتيل', 2, NULL, NULL, NULL, 142),
(143, 'وزان', 2, NULL, NULL, NULL, 143),
(144, 'الحسيمة', 2, NULL, NULL, NULL, 144),
(145, 'المضيق', 2, NULL, NULL, NULL, 145),
(146, 'شفشاون', 2, NULL, NULL, NULL, 146),
(147, 'إمزورن', 2, NULL, NULL, NULL, 147),
(148, 'أصيلة', 2, NULL, NULL, NULL, 148),
(149, 'كزناية', 2, NULL, NULL, NULL, 149),
(150, 'بني بوعياش', 2, NULL, NULL, NULL, 150),
(151, 'أريانة', 2, NULL, NULL, NULL, 151),
(152, 'باجة', 2, NULL, NULL, NULL, 152),
(153, 'بنزرت', 2, NULL, NULL, NULL, 153),
(154, 'بن عروس', 2, NULL, NULL, NULL, 154),
(155, 'تطاوين', 2, NULL, NULL, NULL, 155),
(156, 'توزر', 2, NULL, NULL, NULL, 156),
(157, 'تونس', 2, NULL, NULL, NULL, 157),
(158, 'جندوبة', 2, NULL, NULL, NULL, 158),
(159, 'زغوان', 2, NULL, NULL, NULL, 159),
(160, 'سليانة', 2, NULL, NULL, NULL, 160),
(161, 'سوسة', 2, NULL, NULL, NULL, 161),
(162, 'سيدي بوزيد', 2, NULL, NULL, NULL, 162),
(163, 'صفاقس', 2, NULL, NULL, NULL, 163),
(164, 'قابس', 2, NULL, NULL, NULL, 164),
(165, 'قبلي', 2, NULL, NULL, NULL, 165),
(166, 'القصرين', 2, NULL, NULL, NULL, 166),
(167, 'قفصة', 2, NULL, NULL, NULL, 167),
(168, 'القيروان', 2, NULL, NULL, NULL, 168),
(169, 'الكاف', 2, NULL, NULL, NULL, 169),
(170, 'مدنين', 2, NULL, NULL, NULL, 170),
(171, 'المنستير', 2, NULL, NULL, NULL, 171),
(172, 'منوبة', 2, NULL, NULL, NULL, 172),
(173, 'المهدية', 2, NULL, NULL, NULL, 173),
(174, 'نابل', 2, NULL, NULL, NULL, 174),
(175, 'العاصمة', 2, NULL, NULL, NULL, 175),
(176, 'الأحمدي', 2, NULL, NULL, NULL, 176),
(177, 'الفروانية', 2, NULL, NULL, NULL, 177),
(178, 'الجهراء', 2, NULL, NULL, NULL, 178),
(179, 'حولي', 2, NULL, NULL, NULL, 179),
(180, 'مبارك الكبير', 2, NULL, NULL, NULL, 180),
(181, '	الجزائر', 2, NULL, NULL, NULL, 181),
(182, 'وهران', 2, NULL, NULL, NULL, 182),
(183, 'عنابة', 2, NULL, NULL, NULL, 183),
(184, 'قالمة', 2, NULL, NULL, NULL, 184),
(185, 'البليدة', 2, NULL, NULL, NULL, 185),
(186, 'سطيف', 2, NULL, NULL, NULL, 186),
(187, 'باتنة', 2, NULL, NULL, NULL, 187),
(188, 'الجلفة', 2, NULL, NULL, NULL, 188),
(189, 'الشلف', 2, NULL, NULL, NULL, 189),
(190, 'بسكرة', 2, NULL, NULL, NULL, 190),
(191, 'تبسة', 2, NULL, NULL, NULL, 191),
(192, 'تيارت', 2, NULL, NULL, NULL, 192),
(193, 'ورقلة', 2, NULL, NULL, NULL, 193),
(194, 'بجاية', 2, NULL, NULL, NULL, 194),
(195, 'سكيكدة', 2, NULL, NULL, NULL, 195),
(196, 'تلمسان', 2, NULL, NULL, NULL, 196),
(197, 'هيليوبوليس', 2, NULL, NULL, NULL, 197),
(198, 'بشار', 2, NULL, NULL, NULL, 198),
(199, 'المدية', 2, NULL, NULL, NULL, 199),
(200, 'تقورت', 2, NULL, NULL, NULL, 200),
(201, 'سيدي عمار', 2, NULL, NULL, NULL, 201),
(202, 'جيجل', 2, NULL, NULL, NULL, 202),
(203, 'سوق اهراس', 2, NULL, NULL, NULL, 203),
(204, 'مستغانم', 2, NULL, NULL, NULL, 204),
(205, 'المسيلة', 2, NULL, NULL, NULL, 205),
(206, 'العلمة', 2, NULL, NULL, NULL, 206),
(207, 'خنشلة', 2, NULL, NULL, NULL, 207),
(208, 'سعيدة', 2, NULL, NULL, NULL, 208),
(209, 'سدراتة', 2, NULL, NULL, NULL, 209),
(210, 'الوادي', 2, NULL, NULL, NULL, 210),
(211, 'برج بوعريريج', 2, NULL, NULL, NULL, 211),
(212, 'غرداية', 2, NULL, NULL, NULL, 212),
(213, 'غليزان', 2, NULL, NULL, NULL, 213),
(214, 'الأغواط', 2, NULL, NULL, NULL, 214),
(215, 'البوني', 2, NULL, NULL, NULL, 215),
(216, 'برج الكيفان', 2, NULL, NULL, NULL, 216),
(217, 'بوسعادة', 2, NULL, NULL, NULL, 217),
(218, 'باب الزوار', 2, NULL, NULL, NULL, 218),
(219, 'البرواقية', 2, NULL, NULL, NULL, 219),
(220, 'بريكة', 2, NULL, NULL, NULL, 220),
(221, 'عين البيضاء', 2, NULL, NULL, NULL, 221),
(222, 'مسعد', 2, NULL, NULL, NULL, 222),
(223, 'براقي', 2, NULL, NULL, NULL, 223),
(224, 'العاصمة', 2, NULL, NULL, NULL, 224),
(225, 'المحرق', 2, NULL, NULL, NULL, 225),
(226, 'الشمالية', 2, NULL, NULL, NULL, 226),
(227, 'الجنوبية', 2, NULL, NULL, NULL, 227),
(228, 'الريان', 2, NULL, NULL, NULL, 228),
(229, 'الدوحة', 2, NULL, NULL, NULL, 229),
(230, 'الخور', 2, NULL, NULL, NULL, 230),
(231, 'الوكرة', 2, NULL, NULL, NULL, 231),
(232, 'الشمال', 2, NULL, NULL, NULL, 232),
(233, 'أم صلال', 2, NULL, NULL, NULL, 233),
(234, 'الضعاين', 2, NULL, NULL, NULL, 234),
(235, 'دبي', 2, NULL, NULL, NULL, 235),
(236, 'أبوظبي', 2, NULL, NULL, NULL, 236),
(237, 'الشارقة', 2, NULL, NULL, NULL, 237),
(238, 'العين', 2, NULL, NULL, NULL, 238),
(239, 'رأس الخيمة', 2, NULL, NULL, NULL, 239),
(240, 'عجمان', 2, NULL, NULL, NULL, 240),
(241, 'الفجيرة', 2, NULL, NULL, NULL, 241),
(242, 'أم القيوين', 2, NULL, NULL, NULL, 242),
(243, 'خورفكان', 2, NULL, NULL, NULL, 243),
(244, 'دبا الحصن', 2, NULL, NULL, NULL, 244),
(245, 'الداخلية', 2, NULL, NULL, NULL, 245),
(246, 'الظاهرة', 2, NULL, NULL, NULL, 246),
(247, 'شمال الباطنة', 2, NULL, NULL, NULL, 247),
(248, 'جنوب الباطنة', 2, NULL, NULL, NULL, 248),
(249, 'البريمي', 2, NULL, NULL, NULL, 249),
(250, 'الوسطى', 2, NULL, NULL, NULL, 250),
(251, 'شمال الشرقية', 2, NULL, NULL, NULL, 251),
(252, 'جنوب الشرقية', 2, NULL, NULL, NULL, 252),
(253, 'ظفار', 2, NULL, NULL, NULL, 253),
(254, 'مسقط', 2, NULL, NULL, NULL, 254),
(255, 'مسندم', 2, NULL, NULL, NULL, 255),
(256, 'Alexandria', 1, NULL, NULL, NULL, 1),
(257, 'Aswan', 1, NULL, NULL, NULL, 2),
(258, 'Asyawt', 1, NULL, NULL, NULL, 3),
(259, 'Behaira', 1, NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` tinytext NOT NULL,
  `published` tinyint(1) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `products_id` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `country_id`, `message`, `created_at`, `updated_at`, `store_id`) VALUES
(1, 'Ghunaim Almuwaizri', 'trlyoon@gmail.com', NULL, NULL, 'تجربة الارسال', '2019-10-29 20:39:11', '2019-10-29 20:39:11', NULL),
(2, 'Eric Jones', 'eric@talkwithcustomer.com', '416-385-3200', 13, 'Hey,\r\n\r\nYou have a website sallatk.com, right?\r\n\r\nOf course you do. I am looking at your website now.\r\n\r\nIt gets traffic every day – that you’re probably spending $2 / $4 / $10 or more a click to get.  Not including all of the work you put into creating social media, videos, blog posts, emails, and so on.\r\n\r\nSo you’re investing seriously in getting people to that site.\r\n\r\nBut how’s it working?  Great? Okay?  Not so much?\r\n\r\nIf that answer could be better, then it’s likely you’re putting a lot of time, effort, and money into an approach that’s not paying off like it should.\r\n\r\nNow… imagine doubling your lead conversion in just minutes… In fact, I’ll go even better.\r\n \r\nYou could actually get up to 100X more conversions!\r\n\r\nI’m not making this up.  As Chris Smith, best-selling author of The Conversion Code says: Speed is essential - there is a 100x decrease in Leads when a Lead is contacted within 14 minutes vs being contacted within 5 minutes.\r\n\r\nHe’s backed up by a study at MIT that found the odds of contacting a lead will increase by 100 times if attempted in 5 minutes or less.\r\n\r\nAgain, out of the 100s of visitors to your website, how many actually call to become clients?\r\n\r\nWell, you can significantly increase the number of calls you get – with ZERO extra effort.\r\n\r\nTalkWithCustomer makes it easy, simple, and fast – in fact, you can start getting more calls today… and at absolutely no charge to you.\r\n\r\nCLICK HERE http://www.talkwithcustomer.com now to take a free, 14-day test drive to find out how.\r\n\r\nSincerely,\r\nEric\r\n\r\nPS: Don’t just take my word for it, TalkWithCustomer works:\r\nEMA has been looking for ways to reach out to an audience. TalkWithCustomer so far is the most direct call of action. It has produced above average closing ratios and we are thrilled. Thank you for providing a real and effective tool to generate REAL leads. - P MontesDeOca.\r\nBest of all, act now to get a no-cost 14-Day Test Drive – our gift to you just for giving TalkWithCustomer a try. \r\nCLICK HERE http://www.talkwithcustomer.com to start converting up to 100X more leads today!\r\n\r\nIf you\'d like to unsubscribe click here http://liveserveronline.com/talkwithcustomer.aspx?d=sallatk.com', '2019-11-18 11:36:35', '2019-11-18 11:36:35', NULL),
(3, 'Ryan C', 'ryanc@pjnmail.com', '000-000-0000', 3, 'Are you hiring?\r\n\r\nIf so, we can help you hire the right person, fast.\r\n\r\n- Top job sites with one submission\r\n- All candidates in one place\r\n- No charge for TWO WEEKS\r\n\r\nPost Jobs Now for FREE for Two Weeks:\r\n\r\nhttp://www.TryProJob.com\r\n\r\n* Use offer code 987FREE -- Expires Soon. *\r\n\r\nPro Job Network \r\n10451 Twin Rivers Rd #279 \r\nColumbia, MD 21044 \r\n\r\nTo OPT OUT, please email ryanc@pjnmail.com with \"REMOVE sallatk.com\" in the subject line.', '2019-11-24 04:18:39', '2019-11-24 04:18:39', NULL),
(4, 'fawzia Mohammed', 'computerstar2002@yahoo.com', '11111111', 2, 'jjjjjjjjjj', '2019-12-29 15:43:06', '2019-12-29 15:43:06', NULL),
(6, 'fawzia Mohammed', 'computerstar2002@yahoo.com', '768789899722', 1, 'dqwq cqcq dqwd', '2020-01-25 12:52:17', '2020-01-25 12:52:17', 17),
(7, 'fawzia Moh', 'computerstar2002@yahoo.com', '11111111', NULL, 'dqdwq dqwdq qwd', '2020-02-24 04:00:33', '2020-02-24 04:00:33', NULL),
(8, 'dsf', 'computerstar2002@yahoo.com', '11111111', 1, 'wefw vwqvwevw', '2020-02-24 04:01:09', '2020-02-24 04:01:09', 17),
(9, 'fawzia Moh', 'computerstar2002@yahoo.com', NULL, NULL, 'ضيض ضصيضصي ضصيضيص', '2020-02-24 04:06:01', '2020-02-24 04:06:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content_sections`
--

CREATE TABLE `content_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL,
  `columns` tinyint(4) NOT NULL,
  `type` enum('home','footer') COLLATE utf8mb4_unicode_ci DEFAULT 'home',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_sections`
--

INSERT INTO `content_sections` (`id`, `title`, `order`, `columns`, `type`, `created_at`, `updated_at`, `store_id`, `lang_id`) VALUES
(16, 'no title', 3, 1, 'home', '2020-03-06 14:44:23', '2020-03-06 15:00:33', 17, 1),
(17, 'latest products', 1, 1, 'home', '2020-03-06 14:45:15', '2020-03-06 15:03:10', 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `content_sections_data`
--

CREATE TABLE `content_sections_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_sections_products`
--

CREATE TABLE `content_sections_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_section_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_sections_products`
--

INSERT INTO `content_sections_products` (`id`, `content_section_id`, `product_id`, `created_at`, `updated_at`) VALUES
(6, 17, 42, '2020-03-06 15:03:27', '2020-03-06 15:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `content_section_banners`
--

CREATE TABLE `content_section_banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_section_id` int(10) UNSIGNED NOT NULL,
  `banner_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_section_banners`
--

INSERT INTO `content_section_banners` (`id`, `content_section_id`, `banner_id`, `created_at`, `updated_at`) VALUES
(10, 17, 6, '2020-03-06 14:45:55', '2020-03-06 14:45:55'),
(11, 16, 6, '2020-03-06 15:02:48', '2020-03-06 15:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `content_section_products`
--

CREATE TABLE `content_section_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content_section_titles`
--

CREATE TABLE `content_section_titles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT '1',
  `section_id` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `source_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_section_titles`
--

INSERT INTO `content_section_titles` (`id`, `title`, `lang_id`, `section_id`, `updated_at`, `created_at`, `source_id`) VALUES
(12, 'latest products', 1, 17, '2020-03-06 15:03:10', '2020-03-06 14:45:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

CREATE TABLE `counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `icon`, `title`, `counter`, `created_at`, `updated_at`) VALUES
(1, 'fa-shopping-basket', 'عدد الطلبات للمتاجر', 999, NULL, NULL),
(2, 'fa-money', 'عدد الطلبات للمتاجر', 999, NULL, NULL),
(3, 'fa-bar-chart', 'عدد الطلبات للمتاجر', 999, NULL, NULL),
(4, 'slider-img-Sallatk-insta.png', 'اتصل بنا', 965566555, '2019-10-29 20:54:15', '2019-10-29 20:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `logo`, `created_at`, `updated_at`, `lang_id`) VALUES
(1, '0020', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(2, '‎00966', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(3, '00964', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(4, '‎00963', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(5, '00961', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(6, '00962', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(7, '00967', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(8, '00218', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(9, '00212', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(10, '00216', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(11, '00965', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(12, '‎00966', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(13, '00973', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(14, '00974', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(15, '00971', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(16, '00968', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', NULL, NULL, 0),
(17, '0020', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', '2019-09-05 10:09:36', '2019-09-05 10:09:36', 0),
(18, '‎00966', 'https://banner2.kisspng.com/20180811/oe/kisspng-flag-of-egypt-egypt-national-football-team-nationa-5b6ef0d5b28077.0485587915339972697312.jpg', '2019-09-05 10:09:36', '2019-09-05 10:09:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `countries_data`
--

CREATE TABLE `countries_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries_data`
--

INSERT INTO `countries_data` (`id`, `title`, `lang_id`, `created_at`, `updated_at`, `country_id`) VALUES
(1, 'مصر', 2, NULL, NULL, 1),
(2, 'السعودية', 2, NULL, NULL, 2),
(3, 'العراق', 2, NULL, NULL, 3),
(4, 'سوريا', 2, NULL, NULL, 4),
(5, 'لبنان', 2, NULL, NULL, 5),
(6, 'الاردن', 2, NULL, NULL, 6),
(7, 'اليمن', 2, NULL, NULL, 7),
(8, 'ليبيا', 2, NULL, NULL, 8),
(9, 'المغرب', 2, NULL, NULL, 9),
(10, 'تونس', 2, NULL, NULL, 10),
(11, 'الكويت', 2, NULL, NULL, 11),
(12, 'الجزائر', 2, NULL, NULL, 12),
(13, 'البحرين', 2, NULL, NULL, 13),
(14, 'قطر', 2, NULL, NULL, 14),
(15, 'الإمارات العربية المتحدة', 2, NULL, NULL, 15),
(16, 'سلطنة عمان', 2, NULL, NULL, 16),
(17, 'Egypt', 1, '2019-09-05 10:09:36', '2019-09-05 10:09:36', 1),
(18, 'Saudi Arabia', 1, '2019-09-05 10:09:36', '2019-09-05 10:09:36', 2),
(19, 'Oman', 1, NULL, NULL, 16),
(20, 'UAE', 1, NULL, NULL, 15),
(21, 'Qatar', 1, NULL, NULL, 14),
(22, 'Bahrain', 1, NULL, NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show` int(11) NOT NULL DEFAULT '0',
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency_data`
--

CREATE TABLE `currency_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_design_options`
--

CREATE TABLE `custom_design_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `option_type` enum('custom_list','custom_design') COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `integer_value` tinyint(4) DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `count` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type` enum('perc','fixed','item') COLLATE utf8mb4_unicode_ci NOT NULL,
  `items_count` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `code`, `discount`, `store_id`, `lang_id`, `source_id`, `created_at`, `updated_at`, `expire_date`, `count`, `status`, `type`, `items_count`) VALUES
(1, '76', 1.00, 17, NULL, NULL, '2020-02-18 16:16:14', '2020-02-18 16:16:14', '2020-02-20', 3, '1', 'perc', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes_data`
--

CREATE TABLE `discount_codes_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `discount_code_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes_items`
--

CREATE TABLE `discount_codes_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `discount_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('category','product','user_group') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `include_all` tinyint(1) DEFAULT '0',
  `item_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_codes_items`
--

INSERT INTO `discount_codes_items` (`id`, `discount_id`, `type`, `include_all`, `item_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'category', 0, 195, '2020-02-18 16:16:14', '2020-02-18 16:16:14'),
(2, 1, 'product', 0, 42, '2020-02-18 16:16:14', '2020-02-18 16:16:14'),
(3, 1, 'product', 0, 43, '2020-02-18 16:16:14', '2020-02-18 16:16:14'),
(4, 1, 'user_group', 0, 72, '2020-02-18 16:16:15', '2020-02-18 16:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes_target`
--

CREATE TABLE `discount_codes_target` (
  `id` int(10) UNSIGNED NOT NULL,
  `discount_id` int(10) UNSIGNED DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `model_type` enum('products','category') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(10) UNSIGNED NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','sent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `favoriteable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favoriteable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `favoriteable_type`, `favoriteable_id`, `created_at`, `updated_at`) VALUES
(24, 'App\\Models\\product\\products', 1, '2019-10-06 05:33:13', '2019-10-06 05:33:13'),
(24, 'App\\Models\\product\\products', 4, '2019-10-06 05:33:08', '2019-10-06 05:33:08'),
(72, 'App\\Models\\product\\products', 42, '2020-03-07 16:48:23', '2020-03-07 16:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `created_at`, `updated_at`, `product_id`) VALUES
(1, '2020-03-04 06:22:59', '2020-03-04 06:22:59', 42);

-- --------------------------------------------------------

--
-- Table structure for table `features_data`
--

CREATE TABLE `features_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `feature_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features_data`
--

INSERT INTO `features_data` (`id`, `feature_id`, `title`, `lang_id`, `source_id`) VALUES
(1, 1, 'color', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feature_options`
--

CREATE TABLE `feature_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `feature_id` int(10) UNSIGNED DEFAULT NULL,
  `price` double(8,2) DEFAULT '0.00',
  `count` int(11) DEFAULT NULL,
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature_options`
--

INSERT INTO `feature_options` (`id`, `feature_id`, `price`, `count`, `multiple`, `created_at`, `updated_at`) VALUES
(1, 1, 2.00, 22, 0, '2020-03-04 06:22:59', '2020-03-04 06:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `feature_options_data`
--

CREATE TABLE `feature_options_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `feature_option_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature_options_data`
--

INSERT INTO `feature_options_data` (`id`, `feature_option_id`, `title`, `lang_id`, `source_id`) VALUES
(1, 1, 'red', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `footers`
--

CREATE TABLE `footers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footers`
--

INSERT INTO `footers` (`id`, `title`, `link`, `category_id`, `lang_id`, `source_id`, `store_id`, `created_at`, `updated_at`) VALUES
(2, 'أيفون', 'http://sallatk.com', 3, 1, NULL, NULL, NULL, NULL),
(3, 'أندرويد', 'http://sallatk.com', 3, 1, NULL, NULL, NULL, NULL),
(4, 'ويب', 'http://sallatk.com', 3, 1, NULL, NULL, NULL, NULL),
(5, 'سياسة الخصوصيه', 'http://sallatk.com', 4, 1, NULL, NULL, NULL, NULL),
(9, 'شروط الاستخدام', 'http://sallatk.com', 4, 1, NULL, NULL, '2019-10-29 20:19:41', '2019-10-29 20:19:41'),
(10, 'الأسئلة المتكررة', 'http://sallatk.com', 4, 1, NULL, NULL, '2019-10-29 20:20:09', '2019-10-29 20:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `footer_category`
--

CREATE TABLE `footer_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_category`
--

INSERT INTO `footer_category` (`id`, `title`, `lang_id`, `source_id`, `store_id`, `created_at`, `updated_at`) VALUES
(3, 'تجدنا علي', 1, NULL, NULL, NULL, NULL),
(4, 'روابط تهمك', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `icon`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 'vip', '/uploads/groups/1/1581245684.jpeg', 17, '2020-02-09 08:54:44', '2020-02-09 08:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

CREATE TABLE `groups_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups_users`
--

INSERT INTO `groups_users` (`id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 72, '2020-02-09 08:54:44', '2020-02-09 08:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`, `code`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'en.png', NULL, NULL, NULL),
(2, 'العربية', 'ar', 'ar.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lock_domain`
--

CREATE TABLE `lock_domain` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lock_domain`
--

INSERT INTO `lock_domain` (`id`, `name`, `created_at`) VALUES
(6, 'abc', '2020-02-08 21:47:03'),
(7, 'abc2', '2020-02-08 22:24:18'),
(8, 'devdd', '2020-02-08 22:39:57'),
(9, 'qwdqwdqdwqwd', '2020-02-08 22:41:21'),
(10, 'wdqqwdqdwqdq', '2020-02-08 22:44:15'),
(11, 'dddddddddd', '2020-02-08 22:58:18'),
(12, 'abcd', '2020-02-09 07:48:13'),
(13, 'devqwdqD', '2020-02-09 07:53:50'),
(14, 'qdwqdwqdwqdwqwdq', '2020-02-09 07:58:49'),
(15, 'qdwqdwq', '2020-02-09 07:59:22'),
(16, 'wqddqdqdq', '2020-02-09 07:59:57'),
(17, 'ffffffffffffffffffffffff', '2020-02-09 08:15:58'),
(18, 'DDDDDDDDDDDDD', '2020-02-09 08:17:36'),
(19, 'DDD444', '2020-02-09 08:23:09'),
(20, 'joud1', '2020-02-09 20:07:24'),
(21, 'zzzzzzzzz', '2020-02-09 20:23:51'),
(22, 'zzzzzzzzzzz', '2020-02-09 20:28:47'),
(23, 'failure', '2020-02-10 05:17:41'),
(24, 'fai3', '2020-02-10 05:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `marketing`
--

CREATE TABLE `marketing` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `url_item` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('store','product','category','offers') COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_all_conditions` tinyint(4) NOT NULL DEFAULT '1',
  `campaign_target` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_target_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_time` time DEFAULT NULL,
  `campaign_date` date DEFAULT NULL,
  `is_draft` tinyint(4) NOT NULL DEFAULT '0',
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_users`
--

CREATE TABLE `marketing_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `marketing_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_samples`
--

CREATE TABLE `master_samples` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `img_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_samples`
--

INSERT INTO `master_samples` (`id`, `store_id`, `img_url`, `description`, `created_at`, `updated_at`) VALUES
(9, 3, 'download-app.png', '<p>uuiuol kill</p>', '2020-01-25 08:30:20', '2020-01-25 08:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `price` double(8,2) NOT NULL,
  `duration` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `is_active`, `price`, `duration`, `created_at`, `updated_at`, `currency_code`) VALUES
(22, 1, 0.00, 1, '2019-09-30 06:54:47', '2020-01-31 06:11:39', 'kwd'),
(24, 1, 40.00, 3, '2019-09-30 06:55:42', '2019-09-30 06:55:42', 'kwd');

-- --------------------------------------------------------

--
-- Table structure for table `memberships_data`
--

CREATE TABLE `memberships_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `membership_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `info` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberships_data`
--

INSERT INTO `memberships_data` (`id`, `title`, `lang_id`, `source_id`, `created_at`, `updated_at`, `membership_id`, `description`, `info`) VALUES
(44, 'الاساسيه', 2, NULL, NULL, '2020-02-07 08:04:42', 22, 'المحدوده', '<p>عدد لا محدود من المنتجات<br />\r\nعدد لا محدود من الطلبات<br />\r\nعدد لا محدود من العملاء<br />\r\nعدد لا محدود من كوبونات التخفيض<br />\r\nاستقبال اسئلة وتقييمات العملاء</p>'),
(45, 'المتقدمه', 2, NULL, NULL, '2020-02-07 08:07:08', 24, 'غير محدوده', '<p>جميع مميزات الباقة المحدودة<br />\r\nأدوات تسويقية<br />\r\nدعم جميع أنواع المنتجات<br />\r\nتقارير متقدمة<br />\r\nالتحكم بتصميم المتجر</p>'),
(46, 'basic', 1, 44, '2020-02-07 08:08:18', '2020-02-07 08:09:19', 22, 'basic membership', '<p>Unlimited number of products<br />\r\nUnlimited number of requests<br />\r\nUnlimited number of clients<br />\r\nUnlimited discount coupons<br />\r\nReceive questions and customer reviews</p>'),
(47, 'advanced', 1, 45, '2020-02-07 08:10:02', '2020-02-07 08:11:00', 24, 'un limited membership', '<p>All the advantages of limited<br />\r\nMarketing tools<br />\r\nSupport all kinds of products<br />\r\nAdvanced reports<br />\r\nControl the design of the store</p>');

-- --------------------------------------------------------

--
-- Table structure for table `membership_options`
--

CREATE TABLE `membership_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `membership_id` int(10) UNSIGNED NOT NULL,
  `option_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_options`
--

INSERT INTO `membership_options` (`id`, `membership_id`, `option_id`) VALUES
(254, 22, 14),
(255, 22, 27),
(256, 22, 28),
(257, 22, 29),
(258, 22, 30),
(259, 22, 31),
(260, 22, 32),
(261, 22, 15),
(262, 22, 8),
(263, 24, 5),
(264, 24, 11),
(265, 24, 12),
(266, 24, 14),
(267, 24, 26),
(268, 24, 27),
(269, 24, 28),
(270, 24, 29),
(271, 24, 30),
(272, 24, 31),
(273, 24, 32),
(274, 24, 65),
(275, 24, 6),
(276, 24, 15),
(277, 24, 7),
(278, 24, 8),
(279, 24, 16),
(280, 24, 17),
(281, 24, 33),
(282, 24, 34),
(283, 24, 35),
(284, 24, 36),
(285, 24, 13),
(286, 24, 9),
(287, 24, 18),
(288, 24, 19),
(289, 24, 20),
(290, 24, 21),
(291, 24, 22),
(292, 24, 23),
(293, 24, 24),
(294, 24, 25),
(295, 24, 37),
(296, 24, 38),
(297, 24, 39),
(298, 24, 40),
(299, 24, 41),
(300, 24, 42),
(301, 24, 43),
(302, 24, 44),
(303, 24, 45),
(304, 24, 46),
(305, 24, 47),
(306, 24, 48),
(307, 24, 49),
(308, 24, 50),
(309, 24, 51),
(310, 24, 52),
(311, 24, 53),
(312, 24, 54),
(313, 24, 55),
(314, 24, 56),
(315, 24, 57),
(316, 24, 58),
(317, 24, 59),
(318, 24, 60),
(319, 24, 61),
(320, 24, 62),
(321, 24, 63),
(322, 24, 64);

-- --------------------------------------------------------

--
-- Table structure for table `membership_options_category`
--

CREATE TABLE `membership_options_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_options_category`
--

INSERT INTO `membership_options_category` (`id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL),
(5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `membership_options_category_data`
--

CREATE TABLE `membership_options_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_options_category_data`
--

INSERT INTO `membership_options_category_data` (`id`, `lang_id`, `category_id`, `title`) VALUES
(1, 1, 1, 'Basic Features'),
(2, 1, 2, 'Payment Method'),
(3, 1, 3, 'Shipping & Delivery Options'),
(4, 1, 4, 'Marketing'),
(5, 1, 5, 'Advanced Features'),
(6, 2, 1, 'المميزات الأساسية'),
(7, 2, 2, 'طرق الدفع'),
(8, 2, 3, 'خيارات الشحن والتوصيل'),
(9, 2, 4, 'التسويق'),
(10, 2, 5, 'المميزات المتقدمة');

-- --------------------------------------------------------

--
-- Table structure for table `membership_options_data`
--

CREATE TABLE `membership_options_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `option_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_options_data`
--

INSERT INTO `membership_options_data` (`id`, `created_at`, `updated_at`, `option_id`, `title`, `lang_id`) VALUES
(1, NULL, NULL, 5, 'رابط خاص (دومين)', 2),
(2, NULL, NULL, 11, 'الدفع الالكتروني', 2),
(3, NULL, NULL, 12, 'الربط مع شركات الشحن', 2),
(4, NULL, NULL, 13, 'فريق العمل', 2),
(5, NULL, NULL, 14, 'منتجات لا محدودة', 2),
(6, NULL, NULL, 6, 'التحويل البنكي', 2),
(7, NULL, NULL, 15, 'الدفع عند الاستلام', 2),
(8, NULL, NULL, 7, 'إضافة طريقة شحن', 2),
(9, NULL, NULL, 8, 'كوبونات التخفيض', 2),
(10, NULL, NULL, 16, 'الحملات التسويقية لعملاء المتجر	', 2),
(11, NULL, NULL, 17, 'السلّات المتروكة', 2),
(19, NULL, NULL, 9, 'التقارير المتقدمة', 2),
(20, NULL, NULL, 18, 'تجهيز الطلبات للعملاء	', 2),
(21, NULL, NULL, 19, 'تعديل تصميم المتجر', 2),
(22, NULL, NULL, 20, 'حجز اسم SMS خاص', 2),
(23, NULL, NULL, 21, 'دعم جميع أنواع المنتجات', 2),
(24, NULL, NULL, 22, 'الصفحات التعريفية', 2),
(25, NULL, NULL, 23, 'جرد المنتجات', 2),
(26, NULL, NULL, 24, 'تعديل بنرات المتجر', 2),
(27, NULL, NULL, 25, 'خيارات الشحن', 2),
(28, NULL, NULL, 26, 'عدد المستخدمين', 2),
(29, NULL, NULL, 27, 'طلبات لا محدودة', 2),
(30, NULL, NULL, 28, 'الاسئلة والتقييمات', 2),
(31, NULL, NULL, 29, 'شهادة SSL مجانية	', 2),
(32, NULL, NULL, 30, 'خدمة عملاء على مدار اليوم', 2),
(33, NULL, NULL, 31, 'عمولة المبيعات', 2),
(34, NULL, NULL, 32, 'عملاء لا محدودين', 2),
(35, NULL, NULL, 33, 'العروض الخاصة', 2),
(36, NULL, NULL, 34, 'التسويق مع المشاهير', 2),
(37, NULL, NULL, 35, 'تحسين محركات البحث SEO', 2),
(38, NULL, NULL, 36, 'الكوبون التسويقي', 2),
(39, NULL, NULL, 37, 'مجموعات العملاء', 2),
(40, NULL, NULL, 38, 'ضريبة القيمة المضافة', 2),
(41, NULL, NULL, 39, 'الربط مع الخدمات الاعلانية', 2),
(42, NULL, NULL, 40, 'التحكم بالتصميم بواسطة Custom CSS', 2),
(43, NULL, NULL, 41, 'التحكم فى تاجات جوجل', 2),
(44, NULL, NULL, 42, 'مشاركة رابط الدفع للطلبات من خارج المتجر', 2),
(45, NULL, NULL, 43, 'استعادة البيانات المحذوفة	', 2),
(46, NULL, NULL, 44, 'العنوان الفرعي والترويجي للمنتج', 2),
(47, NULL, NULL, 45, 'تصدير المنتجات', 2),
(48, NULL, NULL, 46, 'تحديث المنتجات بواسطة الاكسل', 2),
(50, NULL, NULL, 47, 'استيراد المنتجات', 2),
(51, NULL, NULL, 48, 'احصائيات المنتج', 2),
(52, NULL, NULL, 49, 'دعم الخيارات المتعددة للمنتجات	', 2),
(53, NULL, NULL, 50, 'تحديد أوقات استقبال الطلبات', 2),
(54, NULL, NULL, 51, 'ارسال رابط تتبع الشحنة للمشتري', 2),
(55, NULL, NULL, 52, 'طباعة قائمة تجهيز الطلب', 2),
(56, NULL, NULL, 53, 'إرسال الطلب كهدية', 2),
(57, NULL, NULL, 54, 'مؤشر الشحن المجاني', 2),
(58, NULL, NULL, 55, 'وضع الصيانة', 2),
(59, NULL, NULL, 56, 'شريط الاعلان أعلى المتجر', 2),
(60, NULL, NULL, 57, 'الربط مع الخدمات الاحصائية والمحادثات', 2),
(61, NULL, NULL, 58, 'الكوبونات المتقدمة	', 2),
(62, NULL, NULL, 59, 'إقرار العميل قبل الشراء	', 2),
(63, NULL, NULL, 60, 'الشحن حسب الوزن', 2),
(64, NULL, NULL, 61, 'تصدير الطلبات', 2),
(65, NULL, NULL, 62, 'الحد الأدنى للطلب', 2),
(66, NULL, NULL, 63, 'مراسلة العملاء', 2),
(67, NULL, NULL, 64, 'الربط مع الخدمات الاحصائية', 2),
(68, NULL, NULL, 5, 'Private link (domain)', 1),
(69, NULL, NULL, 11, 'Online payment', 1),
(70, NULL, NULL, 12, 'Connect with shipping companies', 1),
(71, NULL, NULL, 13, 'Staff', 1),
(72, NULL, NULL, 14, 'Unlimited products', 1),
(73, NULL, NULL, 6, 'Bank transfer', 1),
(74, NULL, NULL, 15, 'Paiement when recieving', 1),
(75, NULL, NULL, 7, 'Add a shipping method', 1),
(76, NULL, NULL, 8, 'Reducing coupons', 1),
(77, NULL, NULL, 16, 'Marketing campaigns for store customers', 1),
(78, NULL, NULL, 17, 'Abandoned baskets', 1),
(79, NULL, NULL, 9, 'Advanced reports', 1),
(80, NULL, NULL, 18, 'Processing orders for clients', 1),
(81, NULL, NULL, 19, 'Modify store design', 1),
(82, NULL, NULL, 20, 'Reserve a private SMS name', 1),
(83, NULL, NULL, 21, 'Support all kinds of products', 1),
(84, NULL, NULL, 22, 'Introductory pages', 1),
(85, NULL, NULL, 23, 'Inventory of products', 1),
(86, NULL, NULL, 24, 'Adjustment of store banners', 1),
(87, NULL, NULL, 25, 'Shipping options', 1),
(88, NULL, NULL, 26, 'users number', 1),
(89, NULL, NULL, 27, 'Unlimited Orders\r\n', 1),
(90, NULL, NULL, 28, 'Questions and reviews', 1),
(91, NULL, NULL, 29, 'Free SSL certificate', 1),
(92, NULL, NULL, 30, 'Customer service throughout the day', 1),
(93, NULL, NULL, 31, 'Sales commission', 1),
(94, NULL, NULL, 32, 'Unlimited customers', 1),
(95, NULL, NULL, 33, 'Specials Offers', 1),
(96, NULL, NULL, 34, 'Celebrity Marketing', 1),
(97, NULL, NULL, 35, 'search engine optimization', 1),
(98, NULL, NULL, 36, 'Marketing coupon', 1),
(99, NULL, NULL, 37, 'Customer groups', 1),
(100, NULL, NULL, 38, 'VAT', 1),
(101, NULL, NULL, 39, 'Link with advertising services', 1),
(102, NULL, NULL, 40, 'Design control with Custom CSS', 1),
(103, NULL, NULL, 41, 'Google Tag Manager	', 1),
(104, NULL, NULL, 42, 'Share the payment link for orders outside the store', 1),
(105, NULL, NULL, 43, 'Recover deleted data', 1),
(106, NULL, NULL, 44, 'The subtitle and promotional product', 1),
(107, NULL, NULL, 45, 'Exporting products', 1),
(108, NULL, NULL, 46, 'Update products by excel', 1),
(109, NULL, NULL, 47, 'Importing products', 1),
(110, NULL, NULL, 48, 'Product stats', 1),
(111, NULL, NULL, 49, 'Support multiple product options', 1),
(112, NULL, NULL, 50, 'Determine the times for receiving requests', 1),
(113, NULL, NULL, 51, 'Send the shipment tracking link to the buyer', 1),
(114, NULL, NULL, 52, 'Print order processing list', 1),
(115, NULL, NULL, 53, 'Send the order as a gift', 1),
(116, NULL, NULL, 54, 'Free shipping indicator\r\n', 1),
(117, NULL, NULL, 55, 'Maintenance mode', 1),
(118, NULL, NULL, 56, 'Ads bar above the store', 1),
(119, NULL, NULL, 57, 'Connecting with statistical services and conversations', 1),
(120, NULL, NULL, 58, 'Advanced coupons', 1),
(121, NULL, NULL, 59, 'Customer recognition before purchase', 1),
(122, NULL, NULL, 60, 'Shipping by weight', 1),
(123, NULL, NULL, 61, 'Export orders', 1),
(124, NULL, NULL, 62, 'Minimum order', 1),
(125, NULL, NULL, 63, 'Email clients', 1),
(126, NULL, NULL, 64, 'Link with statistical services', 1),
(127, NULL, NULL, 65, 'اضافه مستخدمين', 2),
(128, NULL, NULL, 65, 'Add users', 1),
(129, NULL, NULL, 66, 'التحكم بمحتوي الصفحه الرئيسيه', 2),
(130, NULL, NULL, 66, 'Manage home page content', 1);

-- --------------------------------------------------------

--
-- Table structure for table `membership_options_master`
--

CREATE TABLE `membership_options_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_options_master`
--

INSERT INTO `membership_options_master` (`id`, `created_at`, `updated_at`, `category_id`) VALUES
(5, NULL, NULL, 1),
(6, NULL, NULL, 2),
(7, NULL, NULL, 3),
(8, NULL, NULL, 4),
(9, NULL, NULL, 5),
(10, NULL, NULL, 1),
(11, NULL, NULL, 1),
(12, NULL, NULL, 1),
(13, NULL, NULL, 5),
(14, NULL, NULL, 1),
(15, NULL, NULL, 2),
(16, NULL, NULL, 4),
(17, NULL, NULL, 4),
(18, NULL, NULL, 5),
(19, NULL, NULL, 5),
(20, NULL, NULL, 5),
(21, NULL, NULL, 5),
(22, NULL, NULL, 5),
(23, NULL, NULL, 5),
(24, NULL, NULL, 5),
(25, NULL, NULL, 5),
(26, NULL, NULL, 1),
(27, NULL, NULL, 1),
(28, NULL, NULL, 1),
(29, NULL, NULL, 1),
(30, NULL, NULL, 1),
(31, NULL, NULL, 1),
(32, NULL, NULL, 1),
(33, NULL, NULL, 4),
(34, NULL, NULL, 4),
(35, NULL, NULL, 4),
(36, NULL, NULL, 4),
(37, NULL, NULL, 5),
(38, NULL, NULL, 5),
(39, NULL, NULL, 5),
(40, NULL, NULL, 5),
(41, NULL, NULL, 5),
(42, NULL, NULL, 5),
(43, NULL, NULL, 5),
(44, NULL, NULL, 5),
(45, NULL, NULL, 5),
(46, NULL, NULL, 5),
(47, NULL, NULL, 5),
(48, NULL, NULL, 5),
(49, NULL, NULL, 5),
(50, NULL, NULL, 5),
(51, NULL, NULL, 5),
(52, NULL, NULL, 5),
(53, NULL, NULL, 5),
(54, NULL, NULL, 5),
(55, NULL, NULL, 5),
(56, NULL, NULL, 5),
(57, NULL, NULL, 5),
(58, NULL, NULL, 5),
(59, NULL, NULL, 5),
(60, NULL, NULL, 5),
(61, NULL, NULL, 5),
(62, NULL, NULL, 5),
(63, NULL, NULL, 5),
(64, NULL, NULL, 5),
(65, NULL, NULL, 1),
(66, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `membership_option_perms`
--

CREATE TABLE `membership_option_perms` (
  `id` int(10) UNSIGNED NOT NULL,
  `perm_id` int(10) UNSIGNED DEFAULT NULL,
  `option_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_option_perms`
--

INSERT INTO `membership_option_perms` (`id`, `perm_id`, `option_id`) VALUES
(1, 58, 11),
(2, 60, 11),
(3, 59, 11),
(4, 61, 7),
(5, 63, 7),
(6, 62, 7),
(7, 55, 25),
(8, 57, 25),
(9, 56, 25),
(10, 7, 13),
(11, 9, 13),
(12, 8, 13),
(13, 46, 14),
(14, 48, 14),
(15, 47, 14),
(16, 49, 21),
(17, 51, 21),
(18, 50, 21),
(19, 43, 49),
(20, 45, 49),
(21, 44, 49),
(22, 40, 6),
(23, 42, 6),
(24, 41, 6),
(27, 147, 19),
(28, 64, 27),
(29, 66, 27),
(30, 65, 27),
(31, 7, 65),
(32, 9, 65),
(33, 8, 65),
(34, 13, 22),
(35, 14, 22),
(36, 15, 22),
(40, 34, 24),
(41, 36, 24),
(42, 35, 24),
(43, 136, 26),
(44, 135, 32),
(45, 141, 32),
(46, 140, 32),
(47, 142, 17),
(48, 82, 28),
(49, 102, 28),
(50, 103, 28),
(51, 143, 45),
(52, 144, 37),
(53, 145, 40),
(54, 148, 5),
(55, 149, 8),
(56, 150, 16),
(57, 151, 9),
(58, 152, 33),
(59, 10, 66),
(60, 11, 66),
(61, 12, 66),
(62, 52, 14),
(63, 53, 14),
(64, 54, 14);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(10) UNSIGNED DEFAULT NULL,
  `to` int(10) UNSIGNED DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from`, `to`, `read`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 0, 'Odio illo dolores consectetur et placeat.', '2019-09-05 10:05:49', '2019-09-05 10:05:49'),
(2, 1, 6, 0, 'Vitae earum eos vel repellendus accusantium unde.', '2019-09-05 10:05:49', '2019-09-05 10:05:49'),
(3, 1, 3, 1, 'Molestiae qui quisquam accusantium sit sit.', '2019-09-05 10:05:49', '2019-10-13 09:29:11'),
(4, 1, 13, 0, 'Dolorum illo dolorem ut tenetur.', '2019-09-05 10:05:49', '2019-09-05 10:05:49'),
(5, 1, 7, 0, 'Sint qui laborum omnis rerum neque deserunt aut.', '2019-09-05 10:05:49', '2019-09-05 10:05:49'),
(6, 1, 11, 0, 'Magni aut eius sequi excepturi sequi animi.', '2019-09-05 10:05:49', '2019-09-05 10:05:49'),
(7, 1, 14, 0, 'Consequatur voluptate cupiditate reiciendis sint possimus quas modi.', '2019-09-05 10:05:49', '2019-09-05 10:05:49'),
(8, 1, 4, 0, 'Rerum omnis optio blanditiis fugit nemo.', '2019-09-05 10:05:49', '2019-09-05 10:05:49'),
(9, 1, 14, 0, 'Nesciunt soluta aut accusantium vel quos pariatur distinctio et.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(10, 1, 14, 0, 'Dolores sed sunt sunt.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(11, 1, 13, 0, 'Non sint ut ut.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(12, 1, 14, 0, 'Blanditiis aperiam ut sunt aut in dolores.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(13, 1, 15, 0, 'Voluptas sunt sapiente pariatur molestias quo incidunt ut.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(14, 1, 8, 0, 'Itaque dolores vel et dolor consequatur ab et.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(15, 1, 2, 1, 'Qui nihil quidem aut consequatur ex.', '2019-09-05 10:05:50', '2019-11-20 05:55:53'),
(16, 1, 8, 0, 'Dolores aut alias molestias tenetur nihil maxime repellat.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(17, 1, 6, 0, 'Eveniet distinctio est quo fuga asperiores sit.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(18, 1, 16, 0, 'Praesentium placeat eaque sit voluptatem dolore.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(19, 1, 2, 1, 'Tenetur et vel modi cumque.', '2019-09-05 10:05:50', '2019-11-20 05:55:53'),
(20, 1, 4, 0, 'Ipsa molestias voluptate praesentium dolorem rerum distinctio.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(21, 1, 2, 1, 'Libero quibusdam optio tenetur et soluta qui expedita.', '2019-09-05 10:05:50', '2019-11-20 05:55:53'),
(22, 1, 16, 0, 'Rerum ut tempore architecto nisi totam distinctio.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(23, 1, 6, 0, 'Ullam voluptatem odio sit.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(24, 1, 19, 0, 'Deleniti voluptas alias est omnis voluptates.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(25, 1, 15, 0, 'Doloremque fuga earum non ipsam dolores qui.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(26, 1, 7, 0, 'Sint quod velit est est.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(27, 1, 2, 1, 'Qui dolores sint autem incidunt iste.', '2019-09-05 10:05:50', '2019-11-20 05:55:53'),
(28, 1, 1, 0, 'Explicabo nisi vel eveniet maiores.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(29, 1, 13, 0, 'Est soluta aut quo fuga quae exercitationem doloribus.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(30, 1, 18, 0, 'Nihil et quo velit dolorem qui commodi.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(31, 1, 14, 0, 'In provident explicabo alias rerum aut.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(32, 1, 17, 0, 'Ducimus veritatis cum non inventore ut.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(33, 1, 11, 0, 'Temporibus quaerat ut tempore est.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(34, 1, 2, 1, 'Voluptas minus commodi quo sed dolorum ut rerum.', '2019-09-05 10:05:50', '2019-11-20 05:55:53'),
(35, 1, 1, 0, 'Nobis dignissimos labore qui ipsam dolorem sed.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(36, 1, 6, 0, 'Neque beatae et quidem.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(37, 1, 5, 0, 'Soluta accusamus aliquam ut.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(38, 1, 2, 1, 'Reiciendis culpa aspernatur est cumque laudantium omnis et.', '2019-09-05 10:05:50', '2019-11-20 05:55:53'),
(39, 1, 7, 0, 'Provident laboriosam id ducimus dicta fugit animi.', '2019-09-05 10:05:50', '2019-09-05 10:05:50'),
(40, 1, 17, 0, 'Ipsam maiores est qui debitis eveniet.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(41, 1, 11, 0, 'Voluptatem necessitatibus error nobis natus architecto.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(42, 1, 13, 0, 'Temporibus asperiores molestiae nobis deserunt perferendis.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(43, 1, 12, 0, 'Ut possimus temporibus fugiat velit inventore.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(44, 1, 2, 1, 'Reprehenderit dolore recusandae dolores ipsa iusto.', '2019-09-05 10:05:51', '2019-11-20 05:55:53'),
(45, 1, 9, 0, 'Esse sint nesciunt qui repellat.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(46, 1, 19, 0, 'Tenetur voluptates dolores velit debitis tempore id fugiat recusandae.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(47, 1, 14, 0, 'Ea ad ut provident labore sunt perspiciatis est incidunt.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(48, 1, 8, 0, 'Voluptas voluptatum praesentium nemo facere deleniti odio est.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(49, 1, 16, 0, 'Doloribus libero aut atque eveniet autem magnam.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(50, 1, 17, 0, 'Eos laboriosam sit ad numquam quos placeat.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(51, 1, 5, 0, 'Ut optio veritatis omnis incidunt esse et eaque.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(52, 1, 3, 1, 'Rem dolorem aut ut repudiandae aut et quas quia.', '2019-09-05 10:05:51', '2019-10-13 09:29:11'),
(53, 1, 8, 0, 'Officiis et libero aperiam quo similique exercitationem neque.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(54, 1, 19, 0, 'Vel nihil est commodi nulla.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(55, 1, 1, 0, 'Nesciunt numquam quisquam sed odit laboriosam.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(56, 1, 4, 0, 'Corporis consequuntur culpa at corporis ratione quas et quis.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(57, 1, 7, 0, 'Et non omnis sed quo eos exercitationem est cupiditate.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(58, 1, 17, 0, 'Fugiat quo dignissimos aut perspiciatis porro impedit laudantium voluptatem.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(59, 1, 6, 0, 'Quis debitis distinctio sit.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(60, 1, 11, 0, 'Est aspernatur eveniet itaque.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(61, 1, 1, 0, 'Exercitationem officia suscipit non et beatae rerum.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(62, 1, 15, 0, 'Sit est libero illum vel omnis.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(63, 1, 7, 0, 'Ratione quaerat enim illum vitae rem odit ea.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(64, 1, 6, 0, 'Ipsum quo quia consequatur veritatis earum soluta.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(65, 1, 3, 1, 'Aut non iusto molestias quam vitae molestiae.', '2019-09-05 10:05:51', '2019-10-13 09:29:11'),
(66, 1, 6, 0, 'Occaecati occaecati rem ut sunt dolorem recusandae.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(67, 1, 15, 0, 'Dolore beatae saepe doloribus eligendi cumque.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(68, 1, 9, 0, 'Et in soluta at et.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(69, 1, 9, 0, 'Quia et sit quam vero incidunt.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(70, 1, 2, 1, 'Explicabo velit quaerat cumque soluta culpa quidem beatae.', '2019-09-05 10:05:51', '2019-11-20 05:55:53'),
(71, 1, 4, 0, 'Et qui fuga vitae labore.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(72, 1, 16, 0, 'Excepturi sit sunt et magni alias totam debitis.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(73, 1, 11, 0, 'Assumenda itaque dicta officia.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(74, 1, 16, 0, 'Sint fugiat aut perspiciatis sunt fugiat totam et.', '2019-09-05 10:05:51', '2019-09-05 10:05:51'),
(75, 1, 2, 1, 'In nostrum reiciendis omnis eaque quia.', '2019-09-05 10:05:51', '2019-11-20 05:55:53'),
(76, 1, 15, 0, 'Eos nulla ex dolorem explicabo sunt ea.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(77, 1, 6, 0, 'Velit ut dolore quasi itaque dolorum.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(78, 1, 9, 0, 'Quis hic incidunt inventore eos.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(79, 1, 5, 0, 'Assumenda ea molestiae in iure.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(80, 1, 12, 0, 'Consequatur reprehenderit porro earum qui.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(81, 1, 18, 0, 'Et consequatur dignissimos neque rerum architecto nihil soluta.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(82, 1, 3, 1, 'Recusandae voluptas perspiciatis fugiat eum quo eligendi.', '2019-09-05 10:05:52', '2019-10-13 09:29:11'),
(83, 1, 1, 0, 'Incidunt a qui aliquid odit laboriosam.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(84, 1, 14, 0, 'Rerum omnis et numquam nostrum non quisquam id.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(85, 1, 2, 1, 'Et eos blanditiis nihil maxime ut voluptatem.', '2019-09-05 10:05:52', '2019-11-20 05:55:53'),
(86, 1, 12, 0, 'Dignissimos qui non accusantium velit.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(87, 1, 1, 0, 'Facere architecto perspiciatis numquam aut dolores aut facilis.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(88, 1, 16, 0, 'Et aut possimus numquam et illum odio ipsa.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(89, 1, 17, 0, 'Quo ipsam doloremque nemo maxime consequatur aspernatur non.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(90, 1, 2, 1, 'Libero perspiciatis optio corrupti reiciendis.', '2019-09-05 10:05:52', '2019-11-20 05:55:53'),
(91, 1, 8, 0, 'Et eum libero dolores aliquid placeat libero totam.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(92, 1, 18, 0, 'Harum maiores ipsam culpa illo odio optio aliquid eos.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(93, 1, 7, 0, 'Dolor dolores pariatur est nesciunt molestias.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(94, 1, 19, 0, 'Et voluptatem maxime inventore quis tenetur.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(95, 1, 6, 0, 'Velit aut ratione nisi.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(96, 1, 18, 0, 'Maxime omnis doloribus mollitia corporis ipsa.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(97, 1, 15, 0, 'Soluta velit architecto ducimus.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(98, 1, 5, 0, 'Praesentium itaque eius recusandae architecto dicta.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(99, 1, 7, 0, 'Atque magni odit ipsum et eos aut nemo porro.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(100, 1, 7, 0, 'Nam quae consectetur eveniet sed odio iure.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(101, 1, 1, 0, 'Voluptatem autem at sunt dolorum est corporis.', '2019-09-05 10:05:52', '2019-09-05 10:05:52'),
(102, 1, 8, 0, 'Sunt aliquam doloremque unde provident sunt eius quam.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(103, 1, 11, 0, 'Et rerum autem perferendis eveniet nihil sint.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(104, 1, 4, 0, 'Error aliquid ab sunt quia necessitatibus earum non.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(105, 1, 2, 1, 'Debitis amet voluptatem possimus excepturi.', '2019-09-05 10:05:53', '2019-11-20 05:55:53'),
(106, 1, 8, 0, 'Maxime consectetur veritatis enim provident et exercitationem quo et.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(107, 1, 12, 0, 'Suscipit eos voluptas dicta quia dolor consequatur culpa.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(108, 1, 11, 0, 'Occaecati et aut sint amet ipsam at.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(109, 1, 6, 0, 'Laudantium et omnis veniam et aut nemo ea.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(110, 1, 8, 0, 'Autem nisi voluptas est et corporis eius nihil.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(111, 1, 6, 0, 'Voluptas atque id voluptatem sint.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(112, 1, 18, 0, 'Dolores placeat suscipit sed.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(113, 1, 14, 0, 'Quo et optio voluptas.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(114, 1, 4, 0, 'Qui voluptas quo perferendis voluptatibus dolorem officiis sint cumque.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(115, 1, 14, 0, 'Ad omnis suscipit temporibus adipisci qui et.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(116, 1, 7, 0, 'Qui velit ut a sint.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(117, 1, 16, 0, 'Incidunt id rerum laborum incidunt.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(118, 1, 17, 0, 'Numquam nihil quam molestiae ea quis accusantium.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(119, 1, 17, 0, 'Amet molestias sit temporibus.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(120, 1, 18, 0, 'Iste non itaque libero tenetur error voluptas.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(121, 1, 18, 0, 'Ex quis omnis nemo non sit vitae.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(122, 1, 17, 0, 'Illum ut sequi et aut error aliquid.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(123, 1, 12, 0, 'Earum error itaque facere qui voluptatem voluptatem aut.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(124, 1, 1, 0, 'Delectus et consequatur eum nisi.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(125, 1, 11, 0, 'Ipsam eos perferendis assumenda saepe nam iure.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(126, 1, 14, 0, 'Atque et porro sit sed.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(127, 1, 19, 0, 'Tempore exercitationem sit voluptatem.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(128, 1, 7, 0, 'Perspiciatis sapiente eaque nesciunt tenetur excepturi.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(129, 1, 12, 0, 'Incidunt cumque atque ea omnis.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(130, 1, 14, 0, 'Omnis et quisquam distinctio enim fugiat corrupti.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(131, 1, 14, 0, 'Nulla in ipsa sunt fuga et totam nemo eum.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(132, 1, 1, 0, 'Enim sit atque pariatur sunt occaecati voluptatem quibusdam.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(133, 1, 6, 0, 'Voluptatem et aliquid quaerat et error est illo.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(134, 1, 5, 0, 'Maxime tempora aspernatur corporis consectetur dignissimos dolores dolorum.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(135, 1, 12, 0, 'Reiciendis dolorem illo distinctio ratione odit eius in.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(136, 1, 2, 1, 'Rerum vero ex culpa occaecati.', '2019-09-05 10:05:53', '2019-11-20 05:55:53'),
(137, 1, 1, 0, 'Delectus qui repellendus inventore.', '2019-09-05 10:05:53', '2019-09-05 10:05:53'),
(138, 1, 19, 0, 'Rem assumenda reprehenderit id rem repellat.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(139, 1, 15, 0, 'Quas error tempora et dolores excepturi.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(140, 1, 13, 0, 'Dignissimos quae natus dicta aut rerum optio.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(141, 1, 9, 0, 'Delectus ipsa inventore recusandae sed iusto autem consequuntur.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(142, 1, 1, 0, 'Dolor voluptas facere ut repellat id temporibus.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(143, 1, 9, 0, 'Tenetur illo et ipsam esse cumque molestiae.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(144, 1, 1, 0, 'Deleniti consequatur omnis officiis voluptatum nihil qui.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(145, 1, 7, 0, 'Qui quis voluptas itaque dolorem illum blanditiis recusandae vel.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(146, 1, 15, 0, 'Pariatur a voluptas quia voluptate eius quod autem.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(147, 1, 16, 0, 'Pariatur expedita ipsum delectus debitis.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(148, 1, 14, 0, 'Quisquam eligendi voluptatum eum omnis ut eius perspiciatis.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(149, 1, 4, 0, 'Inventore neque qui at suscipit exercitationem.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(150, 1, 19, 0, 'Nulla ut eius consequatur qui blanditiis eum.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(151, 1, 5, 0, 'Quis odio autem blanditiis repudiandae et nulla.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(152, 1, 4, 0, 'Ullam quia illum voluptate.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(153, 1, 19, 0, 'Eos eum voluptatum qui deleniti labore quisquam.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(154, 1, 12, 0, 'Autem iusto assumenda cum eveniet eum.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(155, 1, 11, 0, 'Eum provident libero quod omnis dolores.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(156, 1, 11, 0, 'Nam aut qui vel.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(157, 1, 14, 0, 'Ut sit consequatur sed totam repudiandae vero perferendis.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(158, 1, 17, 0, 'Rerum fugit qui et ipsam cumque et.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(159, 1, 15, 0, 'Et ducimus doloribus qui est voluptas.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(160, 1, 6, 0, 'Qui atque quaerat enim consequuntur voluptas et.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(161, 1, 2, 1, 'Doloribus ut magni nulla.', '2019-09-05 10:05:54', '2019-11-20 05:55:53'),
(162, 1, 10, 0, 'Saepe quia velit optio libero.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(163, 1, 14, 0, 'Omnis nostrum eum nihil at.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(164, 1, 4, 0, 'Fugiat aperiam saepe et error accusamus corrupti expedita.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(165, 1, 2, 1, 'Voluptas et labore aut labore.', '2019-09-05 10:05:54', '2019-11-20 05:55:53'),
(166, 1, 10, 0, 'Magnam dolorem est sunt.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(167, 1, 10, 0, 'In perspiciatis laboriosam ab repellat provident.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(168, 1, 16, 0, 'Earum rerum voluptatem id vel.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(169, 1, 18, 0, 'Est tempora perspiciatis esse officiis itaque corporis.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(170, 1, 14, 0, 'Voluptas laudantium pariatur sed deserunt sequi sint.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(171, 1, 16, 0, 'Officia cum quis consectetur distinctio recusandae at eius quasi.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(172, 1, 8, 0, 'Et exercitationem ut dolorem suscipit.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(173, 1, 13, 0, 'Nesciunt culpa perspiciatis voluptatibus ut est qui.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(174, 1, 1, 0, 'Officia ipsam dolorum aliquid consequatur quaerat illum natus.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(175, 1, 9, 0, 'Repellendus perferendis dolor illo quaerat.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(176, 1, 9, 0, 'Est dolores occaecati sint quia vero.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(177, 1, 4, 0, 'Quo quisquam temporibus adipisci quos.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(178, 1, 19, 0, 'Rerum est ullam quae necessitatibus et ut facere.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(179, 1, 5, 0, 'Ducimus quo eaque pariatur et eveniet.', '2019-09-05 10:05:54', '2019-09-05 10:05:54'),
(180, 1, 2, 1, 'Neque enim et velit eligendi.', '2019-09-05 10:05:55', '2019-11-20 05:55:53'),
(181, 1, 18, 0, 'Animi laudantium commodi eligendi quia esse dicta neque.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(182, 1, 5, 0, 'Sed eveniet eos est harum iste quod quia.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(183, 1, 9, 0, 'Dicta quas repellat non.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(184, 1, 12, 0, 'Ea eos rem minima amet suscipit tempore maxime accusantium.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(185, 1, 6, 0, 'Officia ut perspiciatis debitis magnam nemo doloremque facilis.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(186, 1, 12, 0, 'Nesciunt et quo eum temporibus nihil ex quos ab.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(187, 1, 11, 0, 'Corporis voluptatem illum cumque voluptatem voluptatem aut.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(188, 1, 10, 0, 'Debitis earum non maxime officiis qui vel ipsum corrupti.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(189, 1, 13, 0, 'Aliquam tenetur adipisci dolorem ipsa nihil.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(190, 1, 12, 0, 'Aliquam quos minus veniam voluptas rem voluptate est.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(191, 1, 13, 0, 'Est et optio aliquid aut.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(192, 1, 15, 0, 'Nihil sit fuga voluptatum ipsam culpa architecto quas.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(193, 1, 11, 0, 'Sapiente ad nulla aliquid consequatur.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(194, 1, 2, 1, 'Nesciunt dignissimos repudiandae incidunt dolores aliquid rerum molestiae.', '2019-09-05 10:05:55', '2019-11-20 05:55:53'),
(195, 1, 13, 0, 'Est voluptas adipisci error velit.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(196, 1, 6, 0, 'Quas optio odio fugiat quis.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(197, 1, 12, 0, 'Quo eos illum excepturi libero rerum.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(198, 1, 16, 0, 'Et quaerat quia ab illo.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(199, 1, 5, 0, 'Odio recusandae nesciunt eius suscipit enim eligendi fugit.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(200, 1, 8, 0, 'Sapiente eaque id ducimus sed expedita dolor voluptatem.', '2019-09-05 10:05:55', '2019-09-05 10:05:55'),
(201, 2, 1, 1, 'dcvsdsdvsdds', '2019-09-05 11:08:53', '2019-10-25 00:25:53'),
(221, 2, 3, 1, 'dfvdv', '2019-10-13 09:29:32', '2019-10-14 06:02:40'),
(222, 3, 2, 1, 'dcddcd', '2019-10-13 09:29:40', '2019-10-14 05:48:02'),
(223, 2, 3, 1, 'fvvff', '2019-10-13 09:29:54', '2019-10-14 06:02:40'),
(224, 3, 2, 1, 'ikukvdfkbvkjd', '2019-10-13 09:30:19', '2019-10-14 05:48:02'),
(225, 3, 2, 1, 'fvkndfkvjbdfkjv', '2019-10-13 09:30:24', '2019-10-14 05:48:02'),
(226, 2, 3, 1, 'bgvghjh', '2019-10-13 09:34:02', '2019-10-14 06:02:40'),
(227, 2, 3, 1, 'bgfbfbff', '2019-10-13 09:37:16', '2019-10-14 06:02:40'),
(228, 2, 3, 1, 'gvbfgbgbb', '2019-10-13 09:38:19', '2019-10-14 06:02:40'),
(229, 3, 2, 1, 'fdgfgfdg', '2019-10-13 09:39:35', '2019-10-14 05:48:02'),
(230, 2, 3, 1, 'fgvdfgvbdfg', '2019-10-13 09:39:42', '2019-10-14 06:02:40'),
(231, 3, 2, 1, 'fvdfvdfv', '2019-10-13 09:42:03', '2019-10-14 05:48:02'),
(233, 3, 2, 1, 'gdbdbdfb', '2019-10-13 09:52:41', '2019-10-14 05:48:02'),
(234, 3, 2, 1, 'fvdfv', '2019-10-13 09:53:08', '2019-10-14 05:48:02'),
(235, 2, 3, 1, 'vbbcb', '2019-10-13 09:53:30', '2019-10-14 06:02:40'),
(236, 2, 3, 1, 'dvvfv', '2019-10-13 09:54:07', '2019-10-14 06:02:40'),
(237, 2, 3, 1, 'dsfdfdsf', '2019-10-13 09:56:15', '2019-10-14 06:02:40'),
(238, 3, 2, 1, 'fvgfvb', '2019-10-13 09:56:21', '2019-10-14 05:48:02'),
(239, 2, 3, 1, 'gbbgbg', '2019-10-13 09:56:31', '2019-10-14 06:02:40'),
(240, 3, 2, 1, 'gbbnvbg', '2019-10-13 09:59:38', '2019-10-14 05:48:02'),
(241, 3, 2, 1, 'gffgfghfhfgh', '2019-10-13 09:59:43', '2019-10-14 05:48:02'),
(242, 2, 3, 1, 'fbvgbhghgh', '2019-10-13 09:59:47', '2019-10-14 06:02:40'),
(243, 3, 2, 1, 'hkhkjl', '2019-10-13 10:01:10', '2019-10-14 05:48:02'),
(244, 2, 3, 1, 'mhhmkhmhmhmhm', '2019-10-13 10:01:14', '2019-10-14 06:02:40'),
(245, 2, 3, 1, 'dfgffgfg', '2019-10-13 10:05:37', '2019-10-14 06:02:40'),
(246, 3, 2, 1, 'bf', '2019-10-13 10:05:44', '2019-10-14 05:48:02'),
(247, 2, 3, 1, 'kmkmk', '2019-10-13 10:08:14', '2019-10-14 06:02:40'),
(248, 2, 3, 1, 'dfgdfgdf', '2019-10-13 10:16:23', '2019-10-14 06:02:40'),
(249, 3, 2, 1, 'hnjhgg', '2019-10-13 10:16:48', '2019-10-14 05:48:02'),
(250, 3, 2, 1, 'fghjhg', '2019-10-13 10:20:32', '2019-10-14 05:48:02'),
(251, 2, 3, 1, 'gffghfh', '2019-10-13 10:20:34', '2019-10-14 06:02:40'),
(252, 2, 3, 1, 'asdasdasdsad', '2019-10-13 10:26:02', '2019-10-14 06:02:40'),
(253, 3, 2, 1, 'aaaaaaaaaaaaaaaaaaaaaaa', '2019-10-13 10:26:09', '2019-10-14 05:48:02'),
(254, 3, 2, 1, 'gergergergerg', '2019-10-13 10:28:30', '2019-10-14 05:48:02'),
(255, 3, 2, 1, 'asdasd', '2019-10-13 10:28:57', '2019-10-14 05:48:02'),
(256, 2, 3, 1, 'asdasdasdasdasdasdasd', '2019-10-13 10:33:22', '2019-10-14 06:02:40'),
(257, 3, 2, 1, '1111111111111111111111', '2019-10-13 10:33:36', '2019-10-14 05:48:02'),
(258, 2, 3, 1, 'gfgf', '2019-10-13 10:56:07', '2019-10-14 06:02:40'),
(259, 3, 2, 1, 'dgghg', '2019-10-13 10:57:26', '2019-10-14 05:48:02'),
(260, 2, 3, 1, 'hffghf', '2019-10-13 10:57:45', '2019-10-14 06:02:40'),
(261, 2, 3, 1, 'gvfhbgbgf', '2019-10-13 10:57:46', '2019-10-14 06:02:40'),
(262, 3, 2, 1, 'dfgdrgdfgdf', '2019-10-13 10:57:47', '2019-10-14 05:48:02'),
(263, 2, 3, 1, 'gfdfg', '2019-10-13 10:57:53', '2019-10-14 06:02:40'),
(264, 3, 2, 1, 'ghnghng', '2019-10-13 10:58:01', '2019-10-14 05:48:02'),
(265, 2, 3, 1, 'gfghhjgh', '2019-10-13 11:00:43', '2019-10-14 06:02:40'),
(266, 3, 2, 1, 'gfhfgbhg', '2019-10-13 11:02:19', '2019-10-14 05:48:02'),
(267, 2, 3, 1, 'tggtggg', '2019-10-13 11:02:33', '2019-10-14 06:02:40'),
(268, 2, 3, 1, 'fghfyhgfh', '2019-10-13 11:04:23', '2019-10-14 06:02:40'),
(269, 3, 2, 1, 'k,ml;,l,', '2019-10-13 11:41:23', '2019-10-14 05:48:02'),
(270, 2, 3, 1, 'oklol', '2019-10-13 11:45:01', '2019-10-14 06:02:40'),
(271, 2, 3, 1, ',l,l,', '2019-10-13 11:47:19', '2019-10-14 06:02:40'),
(272, 2, 3, 1, 'jkkikm', '2019-10-13 11:48:19', '2019-10-14 06:02:40'),
(273, 3, 2, 1, 'kmkmkm', '2019-10-13 11:48:37', '2019-10-14 05:48:02'),
(274, 2, 3, 1, 'kujhkjhbkj]', '2019-10-13 11:49:14', '2019-10-14 06:02:40'),
(275, 3, 2, 1, 'dcdscvsd', '2019-10-13 11:51:35', '2019-10-14 05:48:02'),
(278, 3, 2, 1, 'bhgdhfh', '2019-10-13 12:03:08', '2019-10-14 05:48:02'),
(279, 3, 2, 1, 'kkjkko', '2019-10-13 12:03:16', '2019-10-14 05:48:02'),
(280, 2, 3, 1, 'cvnncvn', '2019-10-13 12:03:41', '2019-10-14 06:02:40'),
(281, 3, 2, 1, 'bgvdfdfh', '2019-10-13 12:03:51', '2019-10-14 05:48:02'),
(282, 2, 3, 1, 'fvhgghgh', '2019-10-13 12:06:16', '2019-10-14 06:02:40'),
(283, 3, 2, 1, 'jiouio', '2019-10-13 12:06:50', '2019-10-14 05:48:02'),
(284, 2, 3, 1, 'jhg', '2019-10-13 12:06:55', '2019-10-14 06:02:40'),
(285, 2, 3, 1, 'fghfghfgh', '2019-10-13 12:25:46', '2019-10-14 06:02:40'),
(286, 2, 3, 1, 'fghfgh', '2019-10-13 12:26:31', '2019-10-14 06:02:40'),
(287, 2, 3, 1, 'hfhfghf', '2019-10-13 12:26:36', '2019-10-14 06:02:40'),
(288, 2, 3, 1, 'fvdfvdf', '2019-10-13 12:29:28', '2019-10-14 06:02:40'),
(289, 2, 3, 1, 'fghfgh', '2019-10-13 12:29:32', '2019-10-14 06:02:40'),
(290, 2, 3, 1, 'dfdfgdfgdf', '2019-10-13 12:29:54', '2019-10-14 06:02:40'),
(291, 2, 3, 1, 'mhjmhjmhjmhj,hjk,jk,jkl,jk', '2019-10-13 12:30:01', '2019-10-14 06:02:40'),
(292, 2, 3, 1, 'ghkjhkmhjkjhkmhjmhjjhm', '2019-10-13 12:30:08', '2019-10-14 06:02:40'),
(293, 2, 3, 1, 'gghjghjghjghjghjghjghjgh', '2019-10-13 12:30:13', '2019-10-14 06:02:40'),
(294, 2, 3, 1, 'gfghfghfg', '2019-10-13 12:32:15', '2019-10-14 06:02:40'),
(295, 3, 2, 1, 'jghjghj', '2019-10-13 12:32:20', '2019-10-14 05:48:02'),
(296, 2, 3, 1, 'bfbhfgbhfgbh', '2019-10-13 12:32:41', '2019-10-14 06:02:40'),
(297, 2, 3, 1, 'vvxcvxcvxcvvvvvvvvvvv', '2019-10-13 12:33:41', '2019-10-14 06:02:40'),
(298, 3, 2, 1, 'vvvvvvvvvvvvvvvvvvvv', '2019-10-13 12:33:45', '2019-10-14 05:48:02'),
(299, 2, 3, 1, 'bggfbfgb', '2019-10-13 12:34:43', '2019-10-14 06:02:40'),
(300, 2, 3, 1, 'hgfghfg', '2019-10-13 12:36:59', '2019-10-14 06:02:40'),
(301, 2, 3, 1, 'bdfdfgb', '2019-10-13 12:37:15', '2019-10-14 06:02:40'),
(302, 3, 2, 1, 'fgbfgbfggbffgb', '2019-10-13 12:37:22', '2019-10-14 05:48:02'),
(303, 2, 3, 1, 'cdsdcsd', '2019-10-13 12:39:31', '2019-10-14 06:02:40'),
(304, 3, 2, 1, 'gggggggggggggggggggggggggggg', '2019-10-13 12:39:46', '2019-10-14 05:48:02'),
(305, 3, 2, 1, 'vfbgvcb', '2019-10-13 12:42:53', '2019-10-14 05:48:02'),
(306, 2, 3, 1, 'fcgdfgdfghdf', '2019-10-13 12:46:34', '2019-10-14 06:02:40'),
(307, 3, 2, 1, 'gffgfgggg', '2019-10-13 12:46:40', '2019-10-14 05:48:02'),
(308, 2, 3, 1, 'fdvfdfvdf', '2019-10-13 12:48:32', '2019-10-14 06:02:40'),
(309, 2, 3, 1, 'vbbgvcbcvb', '2019-10-13 12:48:35', '2019-10-14 06:02:40'),
(310, 2, 3, 1, 'gvbcvbcvbc', '2019-10-13 12:48:51', '2019-10-14 06:02:40'),
(311, 2, 3, 1, 'ghhfhj', '2019-10-13 12:49:15', '2019-10-14 06:02:40'),
(312, 2, 3, 1, 'fvdfv', '2019-10-13 12:50:13', '2019-10-14 06:02:40'),
(313, 2, 3, 1, 'kj,jk,jk', '2019-10-13 12:50:29', '2019-10-14 06:02:40'),
(314, 2, 3, 1, 'hgnmghnmg', '2019-10-13 12:52:07', '2019-10-14 06:02:40'),
(315, 2, 3, 1, 'fgbfgbfg', '2019-10-13 12:54:57', '2019-10-14 06:02:40'),
(316, 3, 2, 1, 'jjghjngj', '2019-10-13 12:55:04', '2019-10-14 05:48:02'),
(317, 2, 3, 1, 'gbfgbfgbfg', '2019-10-13 12:55:55', '2019-10-14 06:02:40'),
(318, 2, 3, 1, 'bnmbhmbn', '2019-10-13 12:57:22', '2019-10-14 06:02:40'),
(319, 2, 3, 1, 'jhmjh', '2019-10-13 12:57:47', '2019-10-14 06:02:40'),
(320, 2, 3, 1, 'k,jh,hj', '2019-10-13 12:58:20', '2019-10-14 06:02:40'),
(321, 3, 2, 1, 'gfhfghfgh', '2019-10-13 12:58:53', '2019-10-14 05:48:02'),
(322, 2, 3, 1, 'ghjhkjk', '2019-10-13 12:58:57', '2019-10-14 06:02:40'),
(323, 3, 2, 1, 'jhjghjgh', '2019-10-13 13:00:17', '2019-10-14 05:48:02'),
(324, 2, 3, 1, 'jnhgghmgh', '2019-10-13 13:00:20', '2019-10-14 06:02:40'),
(325, 3, 2, 1, 'cv xcvxc', '2019-10-14 05:42:47', '2019-10-14 05:48:02'),
(326, 2, 3, 1, 'gfghfg', '2019-10-14 05:48:15', '2019-10-14 06:02:40');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_18_103255_create_permission_tables', 1),
(4, '2019_07_11_070629_create_ticket_categories_table', 1),
(5, '2019_07_11_070704_create_ticket_category_users_table', 1),
(6, '2019_07_11_070755_create_ticket_priorities_table', 1),
(7, '2019_07_11_080348_create_tickets_table', 1),
(8, '2019_07_11_080449_create_ticket_comments_table', 1),
(9, '2019_07_13_144956_create_memberships_table', 1),
(10, '2019_07_13_144958_create_membership_perms_table', 1),
(11, '2019_07_13_144959_create_user_membership_table', 1),
(12, '2019_07_14_092724_create_languages_table', 1),
(13, '2019_07_14_125831_create_messages_table', 1),
(14, '2019_07_24_142921_create_countries_table', 1),
(15, '2019_07_24_143026_create_cities_table', 1),
(16, '2019_07_25_090354_create_stores_table', 1),
(17, '2019_07_25_090364_create_categories_table', 1),
(18, '2019_07_25_094414_create_product_types_table', 1),
(19, '2019_07_25_120059_create_products_table', 1),
(20, '2019_07_25_120154_create_product_details_table', 1),
(21, '2019_07_25_120334_create_product_photos_table', 1),
(22, '2019_07_25_120416_create_features_table', 1),
(23, '2019_07_25_120417_create_product_features_table', 1),
(24, '2019_07_25_120443_create_feature_options_table', 1),
(25, '2019_07_25_120849_create_store_users_table', 1),
(26, '2019_07_25_121005_create_store_languages_table', 1),
(27, '2019_07_25_121025_create_currencies_table', 1),
(28, '2019_07_25_121025_create_currency_data_table', 1),
(29, '2019_07_25_121026_create_store_currencies_table', 1),
(30, '2019_07_25_121047_create_bank_transfers_table', 1),
(33, '2019_07_25_121252_create_discount_codes_table', 1),
(35, '2019_07_25_133316_create_cities_countries_shipping_options_table', 1),
(36, '2019_07_25_141110_create_orders_table', 1),
(37, '2019_07_25_141111_create_order_products_table', 1),
(38, '2019_07_25_141143_create_order_feature_options_table', 1),
(42, '2019_07_31_092841_create_articles_table', 1),
(43, '2019_07_31_092842_create_artcl_categories_table', 1),
(44, '2019_07_31_092842_create_article_category_table', 1),
(45, '2019_07_31_092842_create_article_data_table', 1),
(46, '2019_07_31_105202_add_article_foreign_key', 1),
(47, '2019_08_05_124424_make_pivot_table_products_categories', 1),
(48, '2019_08_08_111649_create_permission_data_table', 1),
(49, '2019_08_08_111649_create_settings_table', 1),
(50, '2019_08_08_111649_create_sliders_table', 1),
(51, '2019_08_31_200321_create_abouts_table', 1),
(52, '2019_08_28_140519_create_contacts_table', 2),
(53, '2019_07_10_092724_create_languages_table', 3),
(54, '2019_07_25_090355_create_store_languages_table', 4),
(55, '2019_08_28_100211_create_banners_table', 4),
(56, '2019_08_28_105737_create_brands_table', 4),
(57, '2019_08_28_120937_create_ratings_table', 4),
(58, '2019_08_28_121924_add_product_rating_pivot_table', 4),
(59, '2019_09_29_125358_create_favorites_table', 4),
(64, '2019_10_02_120930_add_to_settings_table', 6),
(65, '2019_10_02_122008_add_to_sliders_table', 6),
(66, '2019_10_02_122046_add_to_banners_table', 6),
(67, '2019_10_02_140412_add_to_currencies_table', 7),
(68, '2019_10_02_143725_add_category_to_banners_table', 8),
(69, '2019_10_03_074231_add_to_brands_table', 9),
(70, '2019_10_05_125321_add_to_users_table', 10),
(71, '2019_09_07_122243_create_footer_category_table', 11),
(72, '2019_09_09_1738595_create_footers_table', 11),
(73, '2019_07_25_151204_create_transaction_types_table', 12),
(74, '2019_07_25_151205_create_transactions_table', 12),
(75, '2019_07_25_121100_create_shipping_companies_table', 13),
(76, '2019_07_25_121100_create_shipping_options_table', 13),
(77, '2019_07_25_133313_create_shipping_type_table', 13),
(78, '2019_07_25_143315_create_shippings_address_table', 13),
(79, '2019_10_08_092133_add_store_homepage_table', 14),
(80, '2019_10_13_133603_create_websockets_statistics_entries_table', 15),
(81, '2019_12_18_174022_create_Membership_options_data_table', 16),
(82, '2019_12_18_174022_create_membership_option_perms_table', 16),
(83, '2019_12_18_174022_create_membership_options_category_data_table', 16),
(84, '2019_12_18_174022_create_membership_options_category_table', 16),
(85, '2019_12_18_174022_create_membership_options_master_table', 16),
(86, '2019_12_18_174022_create_membership_options_table', 16),
(87, '2019_12_18_174032_create_foreign_keys', 16),
(88, '2019_12_10_060916_create_visitor_table', 17),
(89, '2020_01_09_105605_create_shipping_requires_table', 18),
(90, '2020_01_09_105729_create_shipping_require_datas_table', 18),
(91, '2020_01_12_082603_create_notifications_table', 18),
(92, '2020_01_14_090809_create_master_sample_table', 18),
(93, '2020_01_14_113504_create_discount_codes_data_table', 18),
(94, '2020_01_15_084942_create_role_store_table', 18),
(95, '2020_01_15_120046_add_desc_to_permissions_table', 18),
(96, '2020_01_16_083107_add_desc_to_order_products_table', 18),
(97, '2020_01_8_072242_create_content_sections_products_table', 19),
(98, '2020_01_29_125736_create_abandoned_carts_table', 20),
(99, '2020_02_03_141239_create_templates_table', 21),
(100, '2020_02_03_141318_create_template_data_table', 21),
(101, '2020_02_05_092841_create_groups_table', 22),
(102, '2020_02_05_092902_create_groups_users_table', 22),
(103, '2020_02_11_113844_add_columns_to_transactions_table', 23),
(104, '2020_02_11_202413_create_pending_orders_table', 23),
(105, '2020_02_16_070735_create_article_category_table', 23),
(106, '2020_02_16_070736_create_article_category_data_table', 23),
(107, '2020_02_16_070737_create_articles_table', 24),
(108, '2020_02_16_071018_create_articles_data_table', 24),
(109, '2020_02_17_055957_create_page_table', 24),
(110, '2020_02_17_060817_create_page_data_table', 24),
(111, '2020_02_17_115655_add_column_to_discount_codes_table', 24),
(112, '2020_02_17_120452_create_discount_codes_items_table', 24),
(113, '2020_02_04_112448_create_sms_table', 25),
(114, '2020_02_18_143133_create_product_types_code_table', 26),
(115, '2020_02_18_143208_create_product_types_cod_data_table', 26),
(116, '2020_02_18_143217_remove_column_from_product_types_table', 27),
(117, '2020_02_18_144819_create_product_types_data_table', 27),
(118, '2020_02_18_215846_create_product_cards_table', 27),
(119, '2020_02_18_215942_create_product_digitals_table', 27),
(120, '2020_02_18_220019_create_product_donations_table', 27),
(121, '2020_02_19_070829_add_discount_id_to_orders_table', 28),
(122, '2020_02_19_075355_remove_column_to_discount_codes_table', 28),
(123, '2020_02_19_082714_add_columns_to_discount_codes_table', 28),
(124, '2020_02_19_083446_create_discount_codes_target_table', 28),
(125, '2020_02_19_102239_add_fixed_hidden_to_product_table', 28),
(126, '2020_02_20_073329_create_order_product_items_table', 28),
(127, '2020_02_20_214510_create_order_statuses_table', 29),
(128, '2020_02_20_214559_create_order_status_datas_table', 29),
(129, '2020_02_23_011834_create_gender_table', 29),
(130, '2020_02_20_212624_create_order_tracks_table', 30),
(131, '2020_02_24_080125_create_marketing_table', 31),
(132, '2020_02_24_110353_create_marketing_users_table', 31),
(133, '2020_02_24_192127_create_celebrates_table', 31),
(134, '2020_02_27_141635_create_design_options_table', 31),
(135, '2020_02_27_143539_create_custom_design_options_table', 31),
(136, '2020_03_1_141635_create_design_options_table', 32),
(137, '2020_03_1_143539_create_custom_design_options_table', 33),
(138, '2020_03_02_130432_create_email_table', 34),
(139, '2020_03_03_075821_create_banner_data_table', 35),
(140, '2020_03_03_120421_create_slider_data_table', 35),
(141, '2020_03_03_123534_add_columns_to_settings_table', 35),
(142, '2020_03_04_103852_create_content_section_banners_table', 35),
(143, '2020_03_04_134636_create_brand_data_table', 35);

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
(85, 'App\\Admin', 1),
(86, 'App\\Admin', 1),
(87, 'App\\Admin', 1),
(88, 'App\\Admin', 1),
(89, 'App\\Admin', 1),
(90, 'App\\Admin', 1),
(91, 'App\\Admin', 1),
(92, 'App\\Admin', 1),
(93, 'App\\Admin', 1),
(94, 'App\\Admin', 1),
(4, 'App\\User', 1),
(5, 'App\\User', 1),
(6, 'App\\User', 1),
(16, 'App\\User', 1),
(17, 'App\\User', 1),
(18, 'App\\User', 1),
(28, 'App\\User', 1),
(29, 'App\\User', 1),
(30, 'App\\User', 1),
(31, 'App\\User', 1),
(32, 'App\\User', 1),
(33, 'App\\User', 1),
(34, 'App\\User', 1),
(35, 'App\\User', 1),
(36, 'App\\User', 1),
(40, 'App\\User', 1),
(41, 'App\\User', 1),
(42, 'App\\User', 1),
(43, 'App\\User', 1),
(44, 'App\\User', 1),
(45, 'App\\User', 1),
(46, 'App\\User', 1),
(47, 'App\\User', 1),
(48, 'App\\User', 1),
(49, 'App\\User', 1),
(50, 'App\\User', 1),
(51, 'App\\User', 1),
(52, 'App\\User', 1),
(53, 'App\\User', 1),
(54, 'App\\User', 1),
(58, 'App\\User', 1),
(59, 'App\\User', 1),
(60, 'App\\User', 1),
(61, 'App\\User', 1),
(62, 'App\\User', 1),
(63, 'App\\User', 1),
(64, 'App\\User', 1),
(65, 'App\\User', 1),
(66, 'App\\User', 1),
(67, 'App\\User', 1),
(68, 'App\\User', 1),
(75, 'App\\User', 1),
(76, 'App\\User', 1),
(77, 'App\\User', 1),
(78, 'App\\User', 1),
(79, 'App\\User', 1),
(80, 'App\\User', 1),
(81, 'App\\User', 1),
(82, 'App\\User', 1),
(83, 'App\\User', 1),
(84, 'App\\User', 1),
(85, 'App\\User', 1),
(86, 'App\\User', 1),
(87, 'App\\User', 1),
(88, 'App\\User', 1),
(89, 'App\\User', 1),
(90, 'App\\User', 1),
(91, 'App\\User', 1),
(92, 'App\\User', 1),
(93, 'App\\User', 1),
(94, 'App\\User', 1),
(28, 'App\\User', 2),
(29, 'App\\User', 2),
(30, 'App\\User', 2),
(31, 'App\\User', 2),
(32, 'App\\User', 2),
(33, 'App\\User', 2),
(51, 'App\\User', 2),
(52, 'App\\User', 2),
(53, 'App\\User', 2),
(54, 'App\\User', 2),
(58, 'App\\User', 2),
(59, 'App\\User', 2),
(60, 'App\\User', 2),
(61, 'App\\User', 2),
(62, 'App\\User', 2),
(79, 'App\\User', 2),
(80, 'App\\User', 2),
(81, 'App\\User', 2),
(82, 'App\\User', 2),
(83, 'App\\User', 2),
(84, 'App\\User', 2),
(85, 'App\\User', 2),
(86, 'App\\User', 2),
(87, 'App\\User', 2),
(88, 'App\\User', 2),
(89, 'App\\User', 2),
(90, 'App\\User', 2),
(91, 'App\\User', 2),
(92, 'App\\User', 2),
(93, 'App\\User', 2),
(94, 'App\\User', 2),
(28, 'App\\User', 3),
(29, 'App\\User', 3),
(30, 'App\\User', 3),
(31, 'App\\User', 3),
(32, 'App\\User', 3),
(33, 'App\\User', 3),
(51, 'App\\User', 3),
(52, 'App\\User', 3),
(53, 'App\\User', 3),
(54, 'App\\User', 3),
(58, 'App\\User', 3),
(59, 'App\\User', 3),
(60, 'App\\User', 3),
(61, 'App\\User', 3),
(62, 'App\\User', 3),
(79, 'App\\User', 3),
(80, 'App\\User', 3),
(81, 'App\\User', 3),
(82, 'App\\User', 3),
(83, 'App\\User', 3),
(84, 'App\\User', 3),
(85, 'App\\User', 3),
(86, 'App\\User', 3),
(87, 'App\\User', 3),
(88, 'App\\User', 3),
(89, 'App\\User', 3),
(90, 'App\\User', 3),
(91, 'App\\User', 3),
(92, 'App\\User', 3),
(93, 'App\\User', 3),
(94, 'App\\User', 3),
(68, 'App\\User', 24),
(75, 'App\\User', 24),
(76, 'App\\User', 24),
(77, 'App\\User', 24),
(78, 'App\\User', 24),
(4, 'App\\StoreUser', 33),
(5, 'App\\StoreUser', 33),
(6, 'App\\StoreUser', 33),
(7, 'App\\StoreUser', 33),
(8, 'App\\StoreUser', 33),
(9, 'App\\StoreUser', 33),
(10, 'App\\StoreUser', 33),
(11, 'App\\StoreUser', 33),
(12, 'App\\StoreUser', 33),
(13, 'App\\StoreUser', 33),
(14, 'App\\StoreUser', 33),
(15, 'App\\StoreUser', 33),
(16, 'App\\StoreUser', 33),
(17, 'App\\StoreUser', 33),
(18, 'App\\StoreUser', 33),
(28, 'App\\StoreUser', 33),
(29, 'App\\StoreUser', 33),
(30, 'App\\StoreUser', 33),
(31, 'App\\StoreUser', 33),
(32, 'App\\StoreUser', 33),
(33, 'App\\StoreUser', 33),
(34, 'App\\StoreUser', 33),
(35, 'App\\StoreUser', 33),
(36, 'App\\StoreUser', 33),
(37, 'App\\StoreUser', 33),
(38, 'App\\StoreUser', 33),
(39, 'App\\StoreUser', 33),
(40, 'App\\StoreUser', 33),
(41, 'App\\StoreUser', 33),
(42, 'App\\StoreUser', 33),
(43, 'App\\StoreUser', 33),
(44, 'App\\StoreUser', 33),
(45, 'App\\StoreUser', 33),
(46, 'App\\StoreUser', 33),
(47, 'App\\StoreUser', 33),
(48, 'App\\StoreUser', 33),
(49, 'App\\StoreUser', 33),
(50, 'App\\StoreUser', 33),
(51, 'App\\StoreUser', 33),
(52, 'App\\StoreUser', 33),
(53, 'App\\StoreUser', 33),
(54, 'App\\StoreUser', 33),
(55, 'App\\StoreUser', 33),
(56, 'App\\StoreUser', 33),
(57, 'App\\StoreUser', 33),
(58, 'App\\StoreUser', 33),
(59, 'App\\StoreUser', 33),
(60, 'App\\StoreUser', 33),
(61, 'App\\StoreUser', 33),
(62, 'App\\StoreUser', 33),
(63, 'App\\StoreUser', 33),
(64, 'App\\StoreUser', 33),
(65, 'App\\StoreUser', 33),
(66, 'App\\StoreUser', 33),
(67, 'App\\StoreUser', 33),
(68, 'App\\StoreUser', 33),
(69, 'App\\StoreUser', 33),
(70, 'App\\StoreUser', 33),
(71, 'App\\StoreUser', 33),
(72, 'App\\StoreUser', 33),
(73, 'App\\StoreUser', 33),
(74, 'App\\StoreUser', 33),
(75, 'App\\StoreUser', 33),
(76, 'App\\StoreUser', 33),
(77, 'App\\StoreUser', 33),
(78, 'App\\StoreUser', 33),
(79, 'App\\StoreUser', 33),
(80, 'App\\StoreUser', 33),
(81, 'App\\StoreUser', 33),
(82, 'App\\StoreUser', 33),
(83, 'App\\StoreUser', 33),
(84, 'App\\StoreUser', 33),
(102, 'App\\StoreUser', 33),
(103, 'App\\StoreUser', 33),
(109, 'App\\StoreUser', 33),
(110, 'App\\StoreUser', 33),
(111, 'App\\StoreUser', 33),
(135, 'App\\StoreUser', 33),
(136, 'App\\StoreUser', 33),
(137, 'App\\StoreUser', 33),
(138, 'App\\StoreUser', 33),
(139, 'App\\StoreUser', 33),
(140, 'App\\StoreUser', 33),
(141, 'App\\StoreUser', 33),
(142, 'App\\StoreUser', 33),
(143, 'App\\StoreUser', 33),
(144, 'App\\StoreUser', 33),
(145, 'App\\StoreUser', 33),
(146, 'App\\StoreUser', 33),
(147, 'App\\StoreUser', 33),
(148, 'App\\StoreUser', 33),
(149, 'App\\StoreUser', 33),
(150, 'App\\StoreUser', 33),
(151, 'App\\StoreUser', 33),
(152, 'App\\StoreUser', 33),
(153, 'App\\StoreUser', 33),
(154, 'App\\StoreUser', 33),
(155, 'App\\StoreUser', 33),
(4, 'App\\StoreUser', 54),
(5, 'App\\StoreUser', 54),
(6, 'App\\StoreUser', 54),
(7, 'App\\StoreUser', 54),
(8, 'App\\StoreUser', 54),
(9, 'App\\StoreUser', 54),
(10, 'App\\StoreUser', 54),
(11, 'App\\StoreUser', 54),
(12, 'App\\StoreUser', 54),
(13, 'App\\StoreUser', 54),
(14, 'App\\StoreUser', 54),
(15, 'App\\StoreUser', 54),
(16, 'App\\StoreUser', 54),
(17, 'App\\StoreUser', 54),
(18, 'App\\StoreUser', 54),
(28, 'App\\StoreUser', 54),
(29, 'App\\StoreUser', 54),
(30, 'App\\StoreUser', 54),
(31, 'App\\StoreUser', 54),
(32, 'App\\StoreUser', 54),
(33, 'App\\StoreUser', 54),
(34, 'App\\StoreUser', 54),
(35, 'App\\StoreUser', 54),
(36, 'App\\StoreUser', 54),
(37, 'App\\StoreUser', 54),
(38, 'App\\StoreUser', 54),
(39, 'App\\StoreUser', 54),
(40, 'App\\StoreUser', 54),
(41, 'App\\StoreUser', 54),
(42, 'App\\StoreUser', 54),
(43, 'App\\StoreUser', 54),
(44, 'App\\StoreUser', 54),
(45, 'App\\StoreUser', 54),
(46, 'App\\StoreUser', 54),
(47, 'App\\StoreUser', 54),
(48, 'App\\StoreUser', 54),
(49, 'App\\StoreUser', 54),
(50, 'App\\StoreUser', 54),
(51, 'App\\StoreUser', 54),
(52, 'App\\StoreUser', 54),
(53, 'App\\StoreUser', 54),
(54, 'App\\StoreUser', 54),
(55, 'App\\StoreUser', 54),
(56, 'App\\StoreUser', 54),
(57, 'App\\StoreUser', 54),
(58, 'App\\StoreUser', 54),
(59, 'App\\StoreUser', 54),
(60, 'App\\StoreUser', 54),
(61, 'App\\StoreUser', 54),
(62, 'App\\StoreUser', 54),
(63, 'App\\StoreUser', 54),
(64, 'App\\StoreUser', 54),
(65, 'App\\StoreUser', 54),
(66, 'App\\StoreUser', 54),
(67, 'App\\StoreUser', 54),
(68, 'App\\StoreUser', 54),
(69, 'App\\StoreUser', 54),
(70, 'App\\StoreUser', 54),
(71, 'App\\StoreUser', 54),
(72, 'App\\StoreUser', 54),
(73, 'App\\StoreUser', 54),
(74, 'App\\StoreUser', 54),
(75, 'App\\StoreUser', 54),
(76, 'App\\StoreUser', 54),
(77, 'App\\StoreUser', 54),
(78, 'App\\StoreUser', 54),
(79, 'App\\StoreUser', 54),
(80, 'App\\StoreUser', 54),
(81, 'App\\StoreUser', 54),
(82, 'App\\StoreUser', 54),
(83, 'App\\StoreUser', 54),
(84, 'App\\StoreUser', 54),
(102, 'App\\StoreUser', 54),
(103, 'App\\StoreUser', 54),
(109, 'App\\StoreUser', 54),
(110, 'App\\StoreUser', 54),
(111, 'App\\StoreUser', 54),
(135, 'App\\StoreUser', 54),
(136, 'App\\StoreUser', 54),
(137, 'App\\StoreUser', 54),
(138, 'App\\StoreUser', 54),
(139, 'App\\StoreUser', 54),
(140, 'App\\StoreUser', 54),
(141, 'App\\StoreUser', 54),
(142, 'App\\StoreUser', 54),
(143, 'App\\StoreUser', 54),
(144, 'App\\StoreUser', 54),
(145, 'App\\StoreUser', 54),
(146, 'App\\StoreUser', 54),
(147, 'App\\StoreUser', 54),
(148, 'App\\StoreUser', 54),
(149, 'App\\StoreUser', 54),
(150, 'App\\StoreUser', 54),
(151, 'App\\StoreUser', 54),
(152, 'App\\StoreUser', 54),
(153, 'App\\StoreUser', 54),
(154, 'App\\StoreUser', 54),
(155, 'App\\StoreUser', 54),
(46, 'App\\StoreUser', 65),
(47, 'App\\StoreUser', 65),
(48, 'App\\StoreUser', 65),
(64, 'App\\StoreUser', 65),
(65, 'App\\StoreUser', 65),
(66, 'App\\StoreUser', 65),
(135, 'App\\StoreUser', 65),
(140, 'App\\StoreUser', 65),
(141, 'App\\StoreUser', 65),
(7, 'App\\StoreUser', 66),
(8, 'App\\StoreUser', 66),
(9, 'App\\StoreUser', 66),
(13, 'App\\StoreUser', 66),
(14, 'App\\StoreUser', 66),
(15, 'App\\StoreUser', 66),
(16, 'App\\StoreUser', 66),
(17, 'App\\StoreUser', 66),
(18, 'App\\StoreUser', 66),
(31, 'App\\StoreUser', 66),
(32, 'App\\StoreUser', 66),
(33, 'App\\StoreUser', 66),
(34, 'App\\StoreUser', 66),
(35, 'App\\StoreUser', 66),
(36, 'App\\StoreUser', 66),
(40, 'App\\StoreUser', 66),
(41, 'App\\StoreUser', 66),
(42, 'App\\StoreUser', 66),
(43, 'App\\StoreUser', 66),
(44, 'App\\StoreUser', 66),
(45, 'App\\StoreUser', 66),
(46, 'App\\StoreUser', 66),
(47, 'App\\StoreUser', 66),
(48, 'App\\StoreUser', 66),
(49, 'App\\StoreUser', 66),
(50, 'App\\StoreUser', 66),
(51, 'App\\StoreUser', 66),
(55, 'App\\StoreUser', 66),
(56, 'App\\StoreUser', 66),
(57, 'App\\StoreUser', 66),
(58, 'App\\StoreUser', 66),
(59, 'App\\StoreUser', 66),
(60, 'App\\StoreUser', 66),
(61, 'App\\StoreUser', 66),
(62, 'App\\StoreUser', 66),
(63, 'App\\StoreUser', 66),
(64, 'App\\StoreUser', 66),
(65, 'App\\StoreUser', 66),
(66, 'App\\StoreUser', 66),
(135, 'App\\StoreUser', 66),
(136, 'App\\StoreUser', 66),
(140, 'App\\StoreUser', 66),
(141, 'App\\StoreUser', 66),
(7, 'App\\StoreUser', 67),
(8, 'App\\StoreUser', 67),
(9, 'App\\StoreUser', 67),
(13, 'App\\StoreUser', 67),
(14, 'App\\StoreUser', 67),
(15, 'App\\StoreUser', 67),
(16, 'App\\StoreUser', 67),
(17, 'App\\StoreUser', 67),
(18, 'App\\StoreUser', 67),
(31, 'App\\StoreUser', 67),
(32, 'App\\StoreUser', 67),
(33, 'App\\StoreUser', 67),
(34, 'App\\StoreUser', 67),
(35, 'App\\StoreUser', 67),
(36, 'App\\StoreUser', 67),
(40, 'App\\StoreUser', 67),
(41, 'App\\StoreUser', 67),
(42, 'App\\StoreUser', 67),
(43, 'App\\StoreUser', 67),
(44, 'App\\StoreUser', 67),
(45, 'App\\StoreUser', 67),
(46, 'App\\StoreUser', 67),
(47, 'App\\StoreUser', 67),
(48, 'App\\StoreUser', 67),
(49, 'App\\StoreUser', 67),
(50, 'App\\StoreUser', 67),
(51, 'App\\StoreUser', 67),
(55, 'App\\StoreUser', 67),
(56, 'App\\StoreUser', 67),
(57, 'App\\StoreUser', 67),
(58, 'App\\StoreUser', 67),
(59, 'App\\StoreUser', 67),
(60, 'App\\StoreUser', 67),
(61, 'App\\StoreUser', 67),
(62, 'App\\StoreUser', 67),
(63, 'App\\StoreUser', 67),
(64, 'App\\StoreUser', 67),
(65, 'App\\StoreUser', 67),
(66, 'App\\StoreUser', 67),
(135, 'App\\StoreUser', 67),
(136, 'App\\StoreUser', 67),
(140, 'App\\StoreUser', 67),
(141, 'App\\StoreUser', 67),
(7, 'App\\StoreUser', 69),
(8, 'App\\StoreUser', 69),
(9, 'App\\StoreUser', 69),
(13, 'App\\StoreUser', 69),
(14, 'App\\StoreUser', 69),
(15, 'App\\StoreUser', 69),
(16, 'App\\StoreUser', 69),
(17, 'App\\StoreUser', 69),
(18, 'App\\StoreUser', 69),
(31, 'App\\StoreUser', 69),
(32, 'App\\StoreUser', 69),
(33, 'App\\StoreUser', 69),
(34, 'App\\StoreUser', 69),
(35, 'App\\StoreUser', 69),
(36, 'App\\StoreUser', 69),
(40, 'App\\StoreUser', 69),
(41, 'App\\StoreUser', 69),
(42, 'App\\StoreUser', 69),
(43, 'App\\StoreUser', 69),
(44, 'App\\StoreUser', 69),
(45, 'App\\StoreUser', 69),
(46, 'App\\StoreUser', 69),
(47, 'App\\StoreUser', 69),
(48, 'App\\StoreUser', 69),
(49, 'App\\StoreUser', 69),
(50, 'App\\StoreUser', 69),
(51, 'App\\StoreUser', 69),
(55, 'App\\StoreUser', 69),
(56, 'App\\StoreUser', 69),
(57, 'App\\StoreUser', 69),
(58, 'App\\StoreUser', 69),
(59, 'App\\StoreUser', 69),
(60, 'App\\StoreUser', 69),
(61, 'App\\StoreUser', 69),
(62, 'App\\StoreUser', 69),
(63, 'App\\StoreUser', 69),
(64, 'App\\StoreUser', 69),
(65, 'App\\StoreUser', 69),
(66, 'App\\StoreUser', 69),
(135, 'App\\StoreUser', 69),
(136, 'App\\StoreUser', 69),
(140, 'App\\StoreUser', 69),
(141, 'App\\StoreUser', 69),
(7, 'App\\StoreUser', 71),
(8, 'App\\StoreUser', 71),
(9, 'App\\StoreUser', 71),
(13, 'App\\StoreUser', 71),
(14, 'App\\StoreUser', 71),
(15, 'App\\StoreUser', 71),
(16, 'App\\StoreUser', 71),
(17, 'App\\StoreUser', 71),
(18, 'App\\StoreUser', 71),
(31, 'App\\StoreUser', 71),
(32, 'App\\StoreUser', 71),
(33, 'App\\StoreUser', 71),
(34, 'App\\StoreUser', 71),
(35, 'App\\StoreUser', 71),
(36, 'App\\StoreUser', 71),
(40, 'App\\StoreUser', 71),
(41, 'App\\StoreUser', 71),
(42, 'App\\StoreUser', 71),
(43, 'App\\StoreUser', 71),
(44, 'App\\StoreUser', 71),
(45, 'App\\StoreUser', 71),
(46, 'App\\StoreUser', 71),
(47, 'App\\StoreUser', 71),
(48, 'App\\StoreUser', 71),
(49, 'App\\StoreUser', 71),
(50, 'App\\StoreUser', 71),
(51, 'App\\StoreUser', 71),
(55, 'App\\StoreUser', 71),
(56, 'App\\StoreUser', 71),
(57, 'App\\StoreUser', 71),
(58, 'App\\StoreUser', 71),
(59, 'App\\StoreUser', 71),
(60, 'App\\StoreUser', 71),
(61, 'App\\StoreUser', 71),
(62, 'App\\StoreUser', 71),
(63, 'App\\StoreUser', 71),
(64, 'App\\StoreUser', 71),
(65, 'App\\StoreUser', 71),
(66, 'App\\StoreUser', 71),
(135, 'App\\StoreUser', 71),
(136, 'App\\StoreUser', 71),
(140, 'App\\StoreUser', 71),
(141, 'App\\StoreUser', 71),
(7, 'App\\StoreUser', 74),
(8, 'App\\StoreUser', 74),
(9, 'App\\StoreUser', 74),
(13, 'App\\StoreUser', 74),
(14, 'App\\StoreUser', 74),
(15, 'App\\StoreUser', 74),
(16, 'App\\StoreUser', 74),
(17, 'App\\StoreUser', 74),
(18, 'App\\StoreUser', 74),
(31, 'App\\StoreUser', 74),
(32, 'App\\StoreUser', 74),
(33, 'App\\StoreUser', 74),
(34, 'App\\StoreUser', 74),
(35, 'App\\StoreUser', 74),
(36, 'App\\StoreUser', 74),
(40, 'App\\StoreUser', 74),
(41, 'App\\StoreUser', 74),
(42, 'App\\StoreUser', 74),
(43, 'App\\StoreUser', 74),
(44, 'App\\StoreUser', 74),
(45, 'App\\StoreUser', 74),
(46, 'App\\StoreUser', 74),
(47, 'App\\StoreUser', 74),
(48, 'App\\StoreUser', 74),
(49, 'App\\StoreUser', 74),
(50, 'App\\StoreUser', 74),
(51, 'App\\StoreUser', 74),
(55, 'App\\StoreUser', 74),
(56, 'App\\StoreUser', 74),
(57, 'App\\StoreUser', 74),
(58, 'App\\StoreUser', 74),
(59, 'App\\StoreUser', 74),
(60, 'App\\StoreUser', 74),
(61, 'App\\StoreUser', 74),
(62, 'App\\StoreUser', 74),
(63, 'App\\StoreUser', 74),
(64, 'App\\StoreUser', 74),
(65, 'App\\StoreUser', 74),
(66, 'App\\StoreUser', 74),
(135, 'App\\StoreUser', 74),
(136, 'App\\StoreUser', 74),
(140, 'App\\StoreUser', 74),
(141, 'App\\StoreUser', 74),
(46, 'App\\StoreUser', 75),
(47, 'App\\StoreUser', 75),
(48, 'App\\StoreUser', 75),
(64, 'App\\StoreUser', 75),
(65, 'App\\StoreUser', 75),
(66, 'App\\StoreUser', 75),
(82, 'App\\StoreUser', 75),
(102, 'App\\StoreUser', 75),
(103, 'App\\StoreUser', 75),
(135, 'App\\StoreUser', 75),
(140, 'App\\StoreUser', 75),
(141, 'App\\StoreUser', 75),
(46, 'App\\StoreUser', 76),
(47, 'App\\StoreUser', 76),
(48, 'App\\StoreUser', 76),
(64, 'App\\StoreUser', 76),
(65, 'App\\StoreUser', 76),
(66, 'App\\StoreUser', 76),
(82, 'App\\StoreUser', 76),
(102, 'App\\StoreUser', 76),
(103, 'App\\StoreUser', 76),
(135, 'App\\StoreUser', 76),
(140, 'App\\StoreUser', 76),
(141, 'App\\StoreUser', 76),
(46, 'App\\StoreUser', 78),
(47, 'App\\StoreUser', 78),
(48, 'App\\StoreUser', 78),
(64, 'App\\StoreUser', 78),
(65, 'App\\StoreUser', 78),
(66, 'App\\StoreUser', 78),
(82, 'App\\StoreUser', 78),
(102, 'App\\StoreUser', 78),
(103, 'App\\StoreUser', 78),
(135, 'App\\StoreUser', 78),
(140, 'App\\StoreUser', 78),
(141, 'App\\StoreUser', 78),
(46, 'App\\StoreUser', 79),
(47, 'App\\StoreUser', 79),
(48, 'App\\StoreUser', 79),
(64, 'App\\StoreUser', 79),
(65, 'App\\StoreUser', 79),
(66, 'App\\StoreUser', 79),
(82, 'App\\StoreUser', 79),
(102, 'App\\StoreUser', 79),
(103, 'App\\StoreUser', 79),
(135, 'App\\StoreUser', 79),
(140, 'App\\StoreUser', 79),
(141, 'App\\StoreUser', 79),
(46, 'App\\StoreUser', 85),
(47, 'App\\StoreUser', 85),
(48, 'App\\StoreUser', 85),
(64, 'App\\StoreUser', 85),
(65, 'App\\StoreUser', 85),
(66, 'App\\StoreUser', 85),
(82, 'App\\StoreUser', 85),
(102, 'App\\StoreUser', 85),
(103, 'App\\StoreUser', 85),
(135, 'App\\StoreUser', 85),
(140, 'App\\StoreUser', 85),
(141, 'App\\StoreUser', 85),
(46, 'App\\StoreUser', 87),
(47, 'App\\StoreUser', 87),
(48, 'App\\StoreUser', 87),
(64, 'App\\StoreUser', 87),
(65, 'App\\StoreUser', 87),
(66, 'App\\StoreUser', 87),
(82, 'App\\StoreUser', 87),
(102, 'App\\StoreUser', 87),
(103, 'App\\StoreUser', 87),
(135, 'App\\StoreUser', 87),
(140, 'App\\StoreUser', 87),
(141, 'App\\StoreUser', 87),
(46, 'App\\StoreUser', 88),
(47, 'App\\StoreUser', 88),
(48, 'App\\StoreUser', 88),
(52, 'App\\StoreUser', 88),
(53, 'App\\StoreUser', 88),
(54, 'App\\StoreUser', 88),
(64, 'App\\StoreUser', 88),
(65, 'App\\StoreUser', 88),
(66, 'App\\StoreUser', 88),
(82, 'App\\StoreUser', 88),
(102, 'App\\StoreUser', 88),
(103, 'App\\StoreUser', 88),
(135, 'App\\StoreUser', 88),
(140, 'App\\StoreUser', 88),
(141, 'App\\StoreUser', 88),
(149, 'App\\StoreUser', 88),
(4, 'App\\StoreUser', 89),
(5, 'App\\StoreUser', 89),
(6, 'App\\StoreUser', 89),
(31, 'App\\StoreUser', 89),
(32, 'App\\StoreUser', 89),
(33, 'App\\StoreUser', 89),
(46, 'App\\StoreUser', 89),
(47, 'App\\StoreUser', 89),
(48, 'App\\StoreUser', 89),
(52, 'App\\StoreUser', 89),
(53, 'App\\StoreUser', 89),
(54, 'App\\StoreUser', 89),
(64, 'App\\StoreUser', 89),
(65, 'App\\StoreUser', 89),
(66, 'App\\StoreUser', 89),
(80, 'App\\StoreUser', 89),
(82, 'App\\StoreUser', 89),
(83, 'App\\StoreUser', 89),
(102, 'App\\StoreUser', 89),
(103, 'App\\StoreUser', 89),
(109, 'App\\StoreUser', 89),
(110, 'App\\StoreUser', 89),
(111, 'App\\StoreUser', 89),
(135, 'App\\StoreUser', 89),
(137, 'App\\StoreUser', 89),
(138, 'App\\StoreUser', 89),
(139, 'App\\StoreUser', 89),
(140, 'App\\StoreUser', 89),
(141, 'App\\StoreUser', 89),
(149, 'App\\StoreUser', 89),
(4, 'App\\StoreUser', 90),
(5, 'App\\StoreUser', 90),
(6, 'App\\StoreUser', 90),
(31, 'App\\StoreUser', 90),
(32, 'App\\StoreUser', 90),
(33, 'App\\StoreUser', 90),
(46, 'App\\StoreUser', 90),
(47, 'App\\StoreUser', 90),
(48, 'App\\StoreUser', 90),
(52, 'App\\StoreUser', 90),
(53, 'App\\StoreUser', 90),
(54, 'App\\StoreUser', 90),
(64, 'App\\StoreUser', 90),
(65, 'App\\StoreUser', 90),
(66, 'App\\StoreUser', 90),
(80, 'App\\StoreUser', 90),
(82, 'App\\StoreUser', 90),
(83, 'App\\StoreUser', 90),
(102, 'App\\StoreUser', 90),
(103, 'App\\StoreUser', 90),
(109, 'App\\StoreUser', 90),
(110, 'App\\StoreUser', 90),
(111, 'App\\StoreUser', 90),
(135, 'App\\StoreUser', 90),
(137, 'App\\StoreUser', 90),
(138, 'App\\StoreUser', 90),
(139, 'App\\StoreUser', 90),
(140, 'App\\StoreUser', 90),
(141, 'App\\StoreUser', 90),
(149, 'App\\StoreUser', 90);

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
(7, 'App\\Admin', 1),
(7, 'App\\User', 1),
(8, 'App\\StoreUser', 33);

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
('23ba773a-ee2c-4aed-bd9b-904212f514f3', 'App\\Notifications\\AdminNotification', 'App\\StoreUser', 33, '{\"product_id\":42,\"title\":\"\\u0628\\u0646\\u0637\\u0644\\u0648\\u0646 \\u0623\\u0633\\u0648\\u062f\",\"action\":\"Add\",\"storename\":\"fz\"}', NULL, '2020-01-31 08:02:15', '2020-01-31 08:02:15'),
('263f8a57-90b0-46fb-a415-6a3847a68f5e', 'App\\Notifications\\ReviweNotification', 'App\\User', 33, '{\"comment_id\":1,\"comment\":\"\\u064a\\u0636\\u0636\\u064a\\u0636\\u064a\",\"username\":\"Visitor\"}', NULL, '2020-02-10 11:42:30', '2020-02-10 11:42:30'),
('26b79260-edd2-4877-8bad-d52a7479b05e', 'App\\Notifications\\AdminNotification', 'App\\StoreUser', 33, '{\"product_id\":43,\"title\":\"\\u0645\\u0637\\u0628\\u062e\",\"action\":\"Add\",\"storename\":\"fz\"}', NULL, '2020-02-01 05:24:53', '2020-02-01 05:24:53'),
('637fec74-124e-4816-8cd3-2d84a3714b0c', 'App\\Notifications\\AdminNotification', 'App\\StoreUser', 33, '{\"product_id\":42,\"title\":\"\\u0628\\u0646\\u0637\\u0644\\u0648\\u0646 \\u0623\\u0633\\u0648\\u062f\",\"action\":\"Add\",\"storename\":\"fz\"}', NULL, '2020-02-18 14:08:07', '2020-02-18 14:08:07'),
('bfba6398-89ae-4c9e-9394-d895cc691351', 'App\\Notifications\\AdminNotification', 'App\\StoreUser', 33, '{\"product_id\":44,\"title\":\"\\u0635\\u062b\\u064a\\u0635\",\"action\":\"Add\",\"storename\":\"fz\"}', NULL, '2020-02-01 05:30:45', '2020-02-01 05:30:45'),
('df60b9fc-4123-4f8e-9bf1-703995c9862e', 'App\\Notifications\\ReviweNotification', 'App\\User', 33, '{\"comment_id\":2,\"comment\":\"good\",\"username\":{\"id\":72,\"name\":\"user test\",\"lastname\":\"dddddd\",\"phone\":\"01006922590\",\"email\":\"fz_user@test.com\",\"email_verified_at\":\"2020-02-27 00:00:00\",\"provider\":null,\"provider_id\":null,\"ticket_agent\":0,\"guard\":\"web\",\"country_id\":1,\"image\":\"5934.png\",\"address\":null,\"code\":null,\"pin_code\":null,\"created_at\":\"2020-02-09 10:51:24\",\"updated_at\":\"2020-02-09 11:08:06\",\"store_id\":17,\"is_active\":1}}', NULL, '2020-02-11 21:37:29', '2020-02-11 21:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `shipping_option_id` int(10) UNSIGNED DEFAULT NULL,
  `shipping_cost` double(8,2) DEFAULT NULL,
  `ordernumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('wait','refused','accepted','shipped','complete') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` float NOT NULL DEFAULT '0',
  `discount_id` int(10) UNSIGNED DEFAULT NULL,
  `discount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_feature_options`
--

CREATE TABLE `order_feature_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `feature_option_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `price` double(8,2) DEFAULT NULL,
  `attach_url` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_product_items`
--

CREATE TABLE `order_product_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_product_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `product_type_code` enum('product','service','food','digital_product','cards','donation','multi_products') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` enum('wait','refused','canceled','review','processing','shipped','return','completed','shipping') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'wait', NULL, NULL),
(2, 'refused', NULL, NULL),
(3, 'canceled', NULL, NULL),
(4, 'review', NULL, NULL),
(5, 'processing', NULL, NULL),
(6, 'shipped', NULL, NULL),
(7, 'return', NULL, NULL),
(8, 'completed', NULL, NULL),
(9, 'shipping', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status_datas`
--

CREATE TABLE `order_status_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_status_datas`
--

INSERT INTO `order_status_datas` (`id`, `status_id`, `title`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'انتظار المراجعه', 2, NULL, NULL),
(2, 2, 'تم الرفض', 2, NULL, NULL),
(3, 3, 'ملغي', 2, NULL, NULL),
(4, 4, 'قيد المراجعه', 2, NULL, NULL),
(5, 5, 'جاري التحضير', 2, NULL, NULL),
(6, 6, 'تم الشحن', 2, NULL, NULL),
(7, 7, 'استرجاع', 2, NULL, NULL),
(8, 8, 'اكتمل', 2, NULL, NULL),
(9, 9, 'جاري الشحن', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_tracks`
--

CREATE TABLE `order_tracks` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `store_id`, `published`, `created_at`, `updated_at`) VALUES
(1, 17, 1, '2020-02-23 19:22:52', '2020-02-23 19:22:52'),
(2, 17, 1, '2020-03-04 06:22:22', '2020-03-04 06:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `pages_data`
--

CREATE TABLE `pages_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages_data`
--

INSERT INTO `pages_data` (`id`, `page_id`, `lang_id`, `source_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'من نحن', '<p>من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;من نحن&nbsp;</p>', '2020-02-23 19:22:52', '2020-02-23 19:22:52'),
(2, 2, 1, NULL, 'About us', '<p>About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;About us&nbsp;</p>', '2020-03-04 06:22:22', '2020-03-04 06:22:22');

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
-- Table structure for table `pending_orders`
--

CREATE TABLE `pending_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, 'Role-Add', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(5, 'Role-Edit', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(6, 'Role-Delete', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(7, 'AdminUser-Add', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(8, 'AdminUser-Edit', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(9, 'AdminUser-Delete', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(10, 'Content-Add', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(11, 'Content-Edit', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(12, 'Content-Delete', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(13, 'Page-Add', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(14, 'Page-Edit', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(15, 'Page-Delete', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(16, 'ArticleCategory-Add', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(17, 'ArticleCategory-Edit', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(18, 'ArticleCategory-Delete', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(28, 'Currency-Add', 'store', '2020-01-14 09:59:52', '2020-01-14 09:59:52'),
(29, 'Currency-Edit', 'store', '2020-01-14 09:59:52', '2020-01-14 09:59:52'),
(30, 'Currency-Delete', 'store', '2020-01-14 09:59:52', '2020-01-14 09:59:52'),
(31, 'Slider-Add', 'store', '2020-01-14 09:59:52', '2020-01-14 09:59:52'),
(32, 'Slider-Edit', 'store', '2020-01-14 09:59:52', '2020-01-14 09:59:52'),
(33, 'Slider-Delete', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(34, 'Banner-Add', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(35, 'Banner-Edit', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(36, 'Banner-Delete', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(37, 'translation-Add', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(38, 'translation-Edit', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(39, 'translation-Delete', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(40, 'BankTransfer-Add', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(41, 'BankTransfer-Edit', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(42, 'BankTransfer-Delete', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(43, 'Feature-Add', 'store', '2020-01-14 09:59:53', '2020-01-14 09:59:53'),
(44, 'Feature-Edit', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(45, 'Feature-Delete', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(46, 'Product-Add', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(47, 'Product-Edit', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(48, 'Product-Delete', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(49, 'ProductType-Add', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(50, 'ProductType-Edit', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(51, 'ProductType-Delete', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(52, 'ProductCategory-Add', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(53, 'ProductCategory-Edit', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(54, 'ProductCategory-Delete', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(55, 'ShippingOption-Add', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(56, 'ShippingOption-Edit', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(57, 'ShippingOption-Delete', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(58, 'TransactionType-Add', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(59, 'TransactionType-Edit', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(60, 'TransactionType-Delete', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(61, 'ShippingCompany-Add', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(62, 'ShippingCompany-Edit', 'store', '2020-01-14 09:59:55', '2020-01-14 09:59:55'),
(63, 'ShippingCompany-Delete', 'store', '2020-01-14 09:59:56', '2020-01-14 09:59:56'),
(64, 'Order-Add', 'store', '2020-01-14 09:59:56', '2020-01-14 09:59:56'),
(65, 'Order-Edit', 'store', '2020-01-14 09:59:56', '2020-01-14 09:59:56'),
(66, 'Order-Delete', 'store', '2020-01-14 09:59:56', '2020-01-14 09:59:56'),
(67, 'Ticket-Add', 'store', '2020-01-14 09:59:56', '2020-01-14 09:59:56'),
(68, 'Ticket-Edit', 'store', '2020-01-14 09:59:56', '2020-01-14 09:59:56'),
(69, 'Ticket-Delete', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(70, 'TicketCategory-Add', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(71, 'TicketCategory-Edit', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(72, 'TicketCategory-Delete', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(73, 'TicketPriority-Add', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(74, 'TicketPriority-Edit', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(75, 'TicketPriority-Delete', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(76, 'TicketAgent-Add', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(77, 'TicketAgent-Edit', 'store', '2020-01-14 09:59:57', '2020-01-14 09:59:57'),
(78, 'TicketAgent-Delete', 'store', '2020-01-14 09:59:58', '2020-01-14 09:59:58'),
(79, 'Show-Adminpanel', 'store', '2020-01-14 09:59:58', '2020-01-14 09:59:58'),
(80, 'Settings-Add', 'store', '2020-01-14 09:59:58', '2020-01-14 09:59:58'),
(81, 'Stores-Show', 'store', '2020-01-14 09:59:58', '2020-01-14 09:59:58'),
(82, 'Comment-Show', 'store', '2020-01-14 09:59:58', '2020-01-14 09:59:58'),
(83, 'Contact-Show', 'store', '2020-01-14 09:59:58', '2020-01-14 09:59:58'),
(84, 'Chat-Show', 'store', '2020-01-14 09:59:58', '2020-01-14 09:59:58'),
(85, 'MasterPermission-Add', 'admin', '2020-01-14 10:31:01', '2020-01-14 10:31:59'),
(86, 'MasterPermission-Edit', 'admin', '2020-01-14 10:32:44', '2020-01-14 10:32:44'),
(87, 'MasterPermission-Delete', 'admin', '2020-01-14 10:32:44', '2020-01-14 10:32:44'),
(88, 'MasterRole-Add', 'admin', '2020-01-14 10:32:44', '2020-01-14 10:32:44'),
(89, 'MasterRole-Edit', 'admin', '2020-01-14 10:32:44', '2020-01-14 10:32:44'),
(90, 'MasterRole-Delete', 'admin', '2020-01-14 10:32:44', '2020-01-14 10:32:44'),
(91, 'MasterUser-Add', 'admin', '2020-01-14 10:32:45', '2020-01-14 10:32:45'),
(92, 'MasterUser-Edit', 'admin', '2020-01-14 10:32:45', '2020-01-14 10:32:45'),
(93, 'MasterUser-Delete', 'admin', '2020-01-14 10:32:45', '2020-01-14 10:32:45'),
(94, 'MasterStore-Show', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(102, 'Comments-Edit', 'store', NULL, NULL),
(103, 'Comments-Delete', 'store', NULL, NULL),
(109, 'Brand-Add', 'store', NULL, NULL),
(110, 'Brand-Edit', 'store', NULL, NULL),
(111, 'Brand-Delete', 'store', NULL, NULL),
(135, 'StoreUser-Add', 'store', '2020-01-15 04:30:40', '2020-01-15 04:30:40'),
(136, 'AdminUser-max-numb', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(137, 'Contact-Add', 'store', '2019-09-30 03:34:58', '2019-10-13 02:05:49'),
(138, 'Contact-Edit', 'store', '2019-09-30 03:35:17', '2019-10-13 02:05:49'),
(139, 'Contact-Delete', 'store', '2019-09-30 03:35:24', '2019-10-13 02:05:49'),
(140, 'StoreUser-Edit', 'store', '2019-10-02 05:00:13', '2019-10-13 02:05:50'),
(141, 'StoreUser-Delete', 'store', '2019-10-02 07:45:04', '2019-10-13 02:05:50'),
(142, 'Abandon-Cart', 'store', NULL, NULL),
(143, 'Product-Export', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(144, 'Users-Group', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(145, 'Design-css', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(146, 'Transactions-Show', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(147, 'Design', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(148, 'domain', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(149, 'Discount', 'store', '2020-01-14 09:59:54', '2020-01-14 09:59:54'),
(150, 'campaign', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(151, 'reports', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(152, 'offers', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(153, 'Article-Add', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(154, 'Article-Edit', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(155, 'Article-Delete', 'store', '2020-01-14 09:59:51', '2020-01-14 09:59:51'),
(156, 'GroupFilter', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(157, 'GinderFilter', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(158, 'CityFilter', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(159, 'PurchaseFilter', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(160, 'createGroup', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(161, 'Controll-Users', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(162, 'Controll-Invoices', 'store', '2020-01-14 09:59:50', '2020-01-14 09:59:50'),
(163, 'MasterSiteSetting-Add', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(164, 'MasterLanguage-Controll', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(165, 'MasterCountry-Controll', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(166, 'MasterCity-Controll', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(167, 'MasterCelebrates-Show', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(168, 'MasterMembership-Add', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(169, 'MasterMembership-Edit', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(170, 'MasterMembership-Delete', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(171, 'MasterContent-Edit', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(172, 'MasterContent-Add', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(173, 'MasterContent-Delete', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(174, 'MasterContact-Show', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(175, 'MasterSamples-Controll', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(176, 'MasterArticles-Controll', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46'),
(177, 'MasterArticlesCategory-Controll', 'admin', '2020-01-14 10:32:46', '2020-01-14 10:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `permission_data`
--

CREATE TABLE `permission_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_data`
--

INSERT INTO `permission_data` (`id`, `title`, `lang_id`, `permission_id`, `source_id`, `created_at`, `updated_at`) VALUES
(419, 'Role-Add', 1, 4, NULL, NULL, NULL),
(420, 'Role-Edit', 1, 5, NULL, NULL, NULL),
(421, 'Role-Delete', 1, 6, NULL, NULL, NULL),
(422, 'AdminUser-Add', 1, 7, NULL, NULL, NULL),
(423, 'AdminUser-Edit', 1, 8, NULL, NULL, NULL),
(424, 'AdminUser-Delete', 1, 9, NULL, NULL, NULL),
(425, 'Content-Add', 1, 10, NULL, NULL, NULL),
(426, 'Content-Edit', 1, 11, NULL, NULL, NULL),
(427, 'Content-Delete', 1, 12, NULL, NULL, NULL),
(428, 'Page-Add', 1, 13, NULL, NULL, NULL),
(429, 'Page-Edit', 1, 14, NULL, NULL, NULL),
(430, 'Page-Delete', 1, 15, NULL, NULL, NULL),
(431, 'ArticleCategory-Add', 1, 16, NULL, NULL, NULL),
(432, 'ArticleCategory-Edit', 1, 17, NULL, NULL, NULL),
(433, 'ArticleCategory-Delete', 1, 18, NULL, NULL, NULL),
(434, 'Currency-Add', 1, 28, NULL, NULL, NULL),
(435, 'Currency-Edit', 1, 29, NULL, NULL, NULL),
(436, 'Currency-Delete', 1, 30, NULL, NULL, NULL),
(437, 'Slider-Add', 1, 31, NULL, NULL, NULL),
(438, 'Slider-Edit', 1, 32, NULL, NULL, NULL),
(439, 'Slider-Delete', 1, 33, NULL, NULL, NULL),
(440, 'Banner-Add', 1, 34, NULL, NULL, NULL),
(441, 'Banner-Edit', 1, 35, NULL, NULL, NULL),
(442, 'Banner-Delete', 1, 36, NULL, NULL, NULL),
(443, 'translation-Add', 1, 37, NULL, NULL, NULL),
(444, 'translation-Edit', 1, 38, NULL, NULL, NULL),
(445, 'translation-Delete', 1, 39, NULL, NULL, NULL),
(446, 'BankTransfer-Add', 1, 40, NULL, NULL, NULL),
(447, 'BankTransfer-Edit', 1, 41, NULL, NULL, NULL),
(448, 'BankTransfer-Delete', 1, 42, NULL, NULL, NULL),
(449, 'Feature-Add', 1, 43, NULL, NULL, NULL),
(450, 'Feature-Edit', 1, 44, NULL, NULL, NULL),
(451, 'Feature-Delete', 1, 45, NULL, NULL, NULL),
(452, 'Product-Add', 1, 46, NULL, NULL, NULL),
(453, 'Product-Edit', 1, 47, NULL, NULL, NULL),
(454, 'Product-Delete', 1, 48, NULL, NULL, NULL),
(455, 'ProductType-Add', 1, 49, NULL, NULL, NULL),
(456, 'ProductType-Edit', 1, 50, NULL, NULL, NULL),
(457, 'ProductType-Delete', 1, 51, NULL, NULL, NULL),
(458, 'ProductCategory-Add', 1, 52, NULL, NULL, NULL),
(459, 'ProductCategory-Edit', 1, 53, NULL, NULL, NULL),
(460, 'ProductCategory-Delete', 1, 54, NULL, NULL, NULL),
(461, 'ShippingOption-Add', 1, 55, NULL, NULL, NULL),
(462, 'ShippingOption-Edit', 1, 56, NULL, NULL, NULL),
(463, 'ShippingOption-Delete', 1, 57, NULL, NULL, NULL),
(464, 'TransactionType-Add', 1, 58, NULL, NULL, NULL),
(465, 'TransactionType-Edit', 1, 59, NULL, NULL, NULL),
(466, 'TransactionType-Delete', 1, 60, NULL, NULL, NULL),
(467, 'ShippingCompany-Add', 1, 61, NULL, NULL, NULL),
(468, 'ShippingCompany-Edit', 1, 62, NULL, NULL, NULL),
(469, 'ShippingCompany-Delete', 1, 63, NULL, NULL, NULL),
(470, 'Order-Add', 1, 64, NULL, NULL, NULL),
(471, 'Order-Edit', 1, 65, NULL, NULL, NULL),
(472, 'Order-Delete', 1, 66, NULL, NULL, NULL),
(473, 'Ticket-Add', 1, 67, NULL, NULL, NULL),
(474, 'Ticket-Edit', 1, 68, NULL, NULL, NULL),
(475, 'Ticket-Delete', 1, 69, NULL, NULL, NULL),
(476, 'TicketCategory-Add', 1, 70, NULL, NULL, NULL),
(477, 'TicketCategory-Edit', 1, 71, NULL, NULL, NULL),
(478, 'TicketCategory-Delete', 1, 72, NULL, NULL, NULL),
(479, 'TicketPriority-Add', 1, 73, NULL, NULL, NULL),
(480, 'TicketPriority-Edit', 1, 74, NULL, NULL, NULL),
(481, 'TicketPriority-Delete', 1, 75, NULL, NULL, NULL),
(482, 'TicketAgent-Add', 1, 76, NULL, NULL, NULL),
(483, 'TicketAgent-Edit', 1, 77, NULL, NULL, NULL),
(484, 'TicketAgent-Delete', 1, 78, NULL, NULL, NULL),
(485, 'Show-Adminpanel', 1, 79, NULL, NULL, NULL),
(486, 'Settings-Add', 1, 80, NULL, NULL, NULL),
(487, 'Stores-Show', 1, 81, NULL, NULL, NULL),
(488, 'Comment-Show', 1, 82, NULL, NULL, NULL),
(489, 'Contact-Show', 1, 83, NULL, NULL, NULL),
(490, 'Chat-Show', 1, 84, NULL, NULL, NULL),
(491, 'MasterPermission-Add', 1, 85, NULL, NULL, NULL),
(492, 'MasterPermission-Edit', 1, 86, NULL, NULL, NULL),
(493, 'MasterPermission-Delete', 1, 87, NULL, NULL, NULL),
(494, 'MasterRole-Add', 1, 88, NULL, NULL, NULL),
(495, 'MasterRole-Edit', 1, 89, NULL, NULL, NULL),
(496, 'MasterRole-Delete', 1, 90, NULL, NULL, NULL),
(497, 'MasterUser-Add', 1, 91, NULL, NULL, NULL),
(498, 'MasterUser-Edit', 1, 92, NULL, NULL, NULL),
(499, 'MasterUser-Delete', 1, 93, NULL, NULL, NULL),
(500, 'MasterStore-Show', 1, 94, NULL, NULL, NULL),
(501, 'Comments-Edit', 1, 102, NULL, NULL, NULL),
(502, 'Comments-Delete', 1, 103, NULL, NULL, NULL),
(503, 'Brand-Add', 1, 109, NULL, NULL, NULL),
(504, 'Brand-Edit', 1, 110, NULL, NULL, NULL),
(505, 'Brand-Delete', 1, 111, NULL, NULL, NULL),
(506, 'StoreUser-Add', 1, 135, NULL, NULL, NULL),
(507, 'AdminUser-max-numb', 1, 136, NULL, NULL, NULL),
(508, 'Contact-Add', 1, 137, NULL, NULL, NULL),
(509, 'Contact-Edit', 1, 138, NULL, NULL, NULL),
(510, 'Contact-Delete', 1, 139, NULL, NULL, NULL),
(511, 'StoreUser-Edit', 1, 140, NULL, NULL, NULL),
(512, 'StoreUser-Delete', 1, 141, NULL, NULL, NULL),
(513, 'Abandon-Cart', 1, 142, NULL, NULL, NULL),
(514, 'Product-Export', 1, 143, NULL, NULL, NULL),
(515, 'Users-Group', 1, 144, NULL, NULL, NULL),
(516, 'Design-css', 1, 145, NULL, NULL, NULL),
(517, 'Transactions-Show', 1, 146, NULL, NULL, NULL),
(518, 'Design', 1, 147, NULL, NULL, NULL),
(519, 'domain', 1, 148, NULL, NULL, NULL),
(520, 'Discount', 1, 149, NULL, NULL, NULL),
(521, 'campaign', 1, 150, NULL, NULL, NULL),
(522, 'reports', 1, 151, NULL, NULL, NULL),
(523, 'offers', 1, 152, NULL, NULL, NULL),
(524, 'Article-Add', 1, 153, NULL, NULL, NULL),
(525, 'Article-Edit', 1, 154, NULL, NULL, NULL),
(526, 'Article-Delete', 1, 155, NULL, NULL, NULL),
(527, 'GroupFilter', 1, 156, NULL, NULL, NULL),
(528, 'GinderFilter', 1, 157, NULL, NULL, NULL),
(529, 'CityFilter', 1, 158, NULL, NULL, NULL),
(530, 'PurchaseFilter', 1, 159, NULL, NULL, NULL),
(531, 'createGroup', 1, 160, NULL, NULL, NULL),
(532, 'Controll-Users', 1, 161, NULL, NULL, NULL),
(533, 'Controll-Invoices', 1, 162, NULL, NULL, NULL),
(534, 'MasterSiteSetting-Add', 1, 163, NULL, NULL, NULL),
(535, 'MasterLanguage-Controll', 1, 164, NULL, NULL, NULL),
(536, 'MasterCountry-Controll', 1, 165, NULL, NULL, NULL),
(537, 'MasterCity-Controll', 1, 166, NULL, NULL, NULL),
(538, 'MasterCelebrates-Show', 1, 167, NULL, NULL, NULL),
(539, 'MasterMembership-Add', 1, 168, NULL, NULL, NULL),
(540, 'MasterMembership-Edit', 1, 169, NULL, NULL, NULL),
(541, 'MasterMembership-Delete', 1, 170, NULL, NULL, NULL),
(542, 'MasterContent-Edit', 1, 171, NULL, NULL, NULL),
(543, 'MasterContent-Add', 1, 172, NULL, NULL, NULL),
(544, 'MasterContent-Delete', 1, 173, NULL, NULL, NULL),
(545, 'MasterContact-Show', 1, 174, NULL, NULL, NULL),
(546, 'MasterSamples-Controll', 1, 175, NULL, NULL, NULL),
(547, 'MasterArticles-Controll', 1, 176, NULL, NULL, NULL),
(548, 'MasterArticlesCategory-Controll', 1, 177, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_count` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `net` double(8,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `discount_type` int(11) DEFAULT NULL,
  `delivary` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `product_type` int(10) UNSIGNED DEFAULT NULL,
  `fixed` tinyint(1) DEFAULT '1',
  `hidden` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `currency_code`, `sku`, `max_count`, `weight`, `price`, `net`, `stock`, `discount`, `discount_type`, `delivary`, `created_at`, `updated_at`, `store_id`, `product_type`, `fixed`, `hidden`) VALUES
(12, NULL, NULL, 5, NULL, 3.00, NULL, NULL, NULL, NULL, 0, '2019-12-26 04:29:48', '2019-12-26 04:29:48', NULL, NULL, 1, 1),
(37, NULL, NULL, 100, 20, 60.00, 3.00, 100, NULL, NULL, 0, '2019-12-26 22:00:00', '2019-12-31 00:12:42', 3, 1, 1, 1),
(39, NULL, NULL, 5, NULL, 100.00, NULL, NULL, NULL, NULL, 0, '2019-12-31 06:00:02', '2019-12-31 06:00:02', 3, 1, 1, 1),
(41, NULL, NULL, 44, NULL, 20.00, NULL, NULL, NULL, NULL, 0, '2020-01-01 07:46:29', '2020-01-01 07:46:29', 3, 1, 1, 1),
(42, 'kwd', NULL, 3, NULL, 20.00, NULL, NULL, NULL, NULL, 0, '2020-03-04 06:19:41', '2020-03-09 05:54:51', 17, 53, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_cards`
--

CREATE TABLE `product_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `title`, `description`, `product_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(11, 'ddddddd', NULL, 12, 1, NULL, '2019-12-26 04:29:48', '2019-12-26 04:29:48'),
(36, 'بنطلون اسود', NULL, 37, 1, NULL, '2019-12-27 17:50:13', '2019-12-31 00:12:42'),
(38, 'فستان بناتي', NULL, 39, 1, NULL, '2019-12-31 06:00:02', '2019-12-31 06:00:02'),
(40, 'ffffffffffff', NULL, 41, 1, NULL, '2020-01-01 07:46:29', '2020-01-01 07:46:29'),
(41, 'dqq', NULL, 42, 2, NULL, '2020-03-04 06:19:41', '2020-03-04 06:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_digitals`
--

CREATE TABLE `product_digitals` (
  `id` int(10) UNSIGNED NOT NULL,
  `file` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `source` longblob,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_donations`
--

CREATE TABLE `product_donations` (
  `id` int(10) UNSIGNED NOT NULL,
  `min_price` int(11) NOT NULL,
  `max_price` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `feature_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `lang_id`, `source_id`, `tag`, `photo`, `description`, `main`, `created_at`, `updated_at`) VALUES
(32, 37, NULL, NULL, '157775832180843.jpg', '/uploads/products/37/157775832180843.jpg', '157775832180843.jpg', 1, '2019-12-27 17:54:38', '2019-12-31 00:12:01'),
(52, NULL, NULL, NULL, '157769749140846', '/uploads/products//157769749140846.png', '157769749140846', 0, '2019-12-30 07:18:11', '2019-12-30 07:18:11'),
(53, NULL, NULL, NULL, '157769749294243', '/uploads/products//157769749294243.png', '157769749294243', 0, '2019-12-30 07:18:12', '2019-12-30 07:18:12'),
(54, NULL, NULL, NULL, '157769755349546', '/uploads/products//157769755349546.jpeg', '157769755349546', 0, '2019-12-30 07:19:13', '2019-12-30 07:19:13'),
(68, 39, NULL, NULL, '157777921347200.jpg', '/uploads/products/39/157777921347200.jpg', '157777921347200.jpg', 1, '2019-12-31 06:00:13', '2019-12-31 06:00:13'),
(72, 39, NULL, NULL, '157780626336344', '/uploads/products/39/157780626336344.jpg', '157780626336344', 0, '2019-12-31 13:31:03', '2019-12-31 13:31:03'),
(77, 39, NULL, NULL, '157780734096112', '/uploads/products/39/157780734096112.jpg', '157780734096112', 0, '2019-12-31 13:49:00', '2019-12-31 13:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_code` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `store_id`, `created_at`, `updated_at`, `type_code`) VALUES
(1, 3, '2019-09-05 10:06:02', '2019-12-31 00:05:48', 1),
(10, 3, '2019-11-28 04:42:47', '2019-12-31 00:06:05', 2),
(12, 3, '2019-12-25 10:40:39', '2019-12-31 00:06:16', 3),
(13, 3, '2019-12-25 11:06:53', '2019-12-31 00:06:25', 4),
(15, 3, '2020-01-05 19:27:25', '2020-01-05 19:27:25', 5),
(18, 17, '2020-01-31 07:59:45', '2020-01-31 07:59:45', 2),
(49, 17, '2020-03-02 16:58:48', '2020-03-02 16:58:48', 1),
(50, 17, '2020-03-02 16:58:48', '2020-03-02 16:58:48', 2),
(51, 17, '2020-03-02 16:58:49', '2020-03-02 16:58:49', 3),
(52, 17, '2020-03-02 16:58:49', '2020-03-02 16:58:49', 4),
(53, 17, '2020-03-02 16:58:49', '2020-03-02 16:58:49', 5),
(54, 17, '2020-03-02 16:58:49', '2020-03-02 16:58:49', 6),
(55, 17, '2020-03-02 16:58:49', '2020-03-02 16:58:49', 7),
(56, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 1),
(57, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 2),
(58, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 3),
(59, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 4),
(60, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 5),
(61, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 6),
(62, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 7);

-- --------------------------------------------------------

--
-- Table structure for table `product_types_code`
--

CREATE TABLE `product_types_code` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` enum('product','service','food','digital_product','cards','donation','multi_products') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types_code`
--

INSERT INTO `product_types_code` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'product', NULL, NULL),
(2, 'service', NULL, NULL),
(3, 'food', NULL, NULL),
(4, 'digital_product', NULL, NULL),
(5, 'cards', NULL, NULL),
(6, 'donation', NULL, NULL),
(7, 'multi_products', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_types_code_data`
--

CREATE TABLE `product_types_code_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_types_cod_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types_code_data`
--

INSERT INTO `product_types_code_data` (`id`, `product_types_cod_id`, `lang_id`, `source_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 'منتج جاهز', 'المنتجات الملموسة والقابلة للشحن', NULL, NULL),
(2, 2, 2, NULL, 'خدمة حسب الطلب', 'التصميم، الطباعة، الحجوزات', NULL, NULL),
(3, 3, 2, NULL, 'أكل', 'المأكولات والمشروبات التي تتطلب شحن خاص', NULL, NULL),
(4, 4, 2, NULL, 'منج رقمي', 'الكتب الالكترونية، الدورات، ملفات للتحميل', NULL, NULL),
(5, 5, 2, NULL, 'بطاقة رقمية', 'بطاقات شحن، حسابات للبيع', NULL, NULL),
(6, 6, 2, NULL, 'تبرع', 'زكاة، صدقة، دعم', NULL, NULL),
(7, 7, 2, NULL, 'مجموعة منتجات', 'اكثر من منتج في منتج واحد', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_types_data`
--

CREATE TABLE `product_types_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_types_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types_data`
--

INSERT INTO `product_types_data` (`id`, `product_types_id`, `lang_id`, `source_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(30, 49, 2, NULL, 'منتج جاهز', 'المنتجات الملموسة والقابلة للشحن', '2020-03-02 16:58:48', '2020-03-02 16:58:48'),
(31, 50, 2, NULL, 'خدمة حسب الطلب', 'التصميم، الطباعة، الحجوزات', '2020-03-02 16:58:49', '2020-03-02 16:58:49'),
(32, 51, 2, NULL, 'أكل', 'المأكولات والمشروبات التي تتطلب شحن خاص', '2020-03-02 16:58:49', '2020-03-02 16:58:49'),
(33, 52, 2, NULL, 'منج رقمي', 'الكتب الالكترونية، الدورات، ملفات للتحميل', '2020-03-02 16:58:49', '2020-03-02 16:58:49'),
(34, 53, 2, NULL, 'بطاقة رقمية', 'بطاقات شحن، حسابات للبيع', '2020-03-02 16:58:49', '2020-03-02 16:58:49'),
(35, 54, 2, NULL, 'تبرع', 'زكاة، صدقة، دعم', '2020-03-02 16:58:49', '2020-03-02 16:58:49'),
(36, 55, 2, NULL, 'مجموعة منتجات', 'اكثر من منتج في منتج واحد', '2020-03-02 16:58:49', '2020-03-02 16:58:49'),
(37, 56, 2, NULL, 'منتج جاهز', 'المنتجات الملموسة والقابلة للشحن', '2020-03-07 14:42:27', '2020-03-07 14:42:27'),
(38, 57, 2, NULL, 'خدمة حسب الطلب', 'التصميم، الطباعة، الحجوزات', '2020-03-07 14:42:27', '2020-03-07 14:42:27'),
(39, 58, 2, NULL, 'أكل', 'المأكولات والمشروبات التي تتطلب شحن خاص', '2020-03-07 14:42:27', '2020-03-07 14:42:27'),
(40, 59, 2, NULL, 'منج رقمي', 'الكتب الالكترونية، الدورات، ملفات للتحميل', '2020-03-07 14:42:27', '2020-03-07 14:42:27'),
(41, 60, 2, NULL, 'بطاقة رقمية', 'بطاقات شحن، حسابات للبيع', '2020-03-07 14:42:27', '2020-03-07 14:42:27'),
(42, 61, 2, NULL, 'تبرع', 'زكاة، صدقة، دعم', '2020-03-07 14:42:27', '2020-03-07 14:42:27'),
(43, 62, 2, NULL, 'مجموعة منتجات', 'اكثر من منتج في منتج واحد', '2020-03-07 14:42:27', '2020-03-07 14:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'super', 'web', '2019-09-05 10:05:35', '2019-09-05 10:05:35'),
(7, 'super', 'admin', '2020-01-25 07:50:47', '2020-01-25 07:50:47'),
(8, 'super', 'store', '2020-01-29 13:07:05', '2020-01-29 13:07:05'),
(9, 'test role', 'store', '2020-03-06 17:54:15', '2020-03-06 17:54:15');

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
(4, 1),
(5, 1),
(6, 1),
(16, 1),
(17, 1),
(18, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
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
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(85, 7),
(86, 7),
(87, 7),
(88, 7),
(89, 7),
(90, 7),
(91, 7),
(92, 7),
(93, 7),
(94, 7),
(4, 8),
(5, 8),
(6, 8),
(16, 8),
(17, 8),
(18, 8),
(28, 8),
(29, 8),
(30, 8),
(31, 8),
(32, 8),
(33, 8),
(34, 8),
(35, 8),
(36, 8),
(40, 8),
(41, 8),
(42, 8),
(43, 8),
(44, 8),
(45, 8),
(46, 8),
(47, 8),
(48, 8),
(49, 8),
(50, 8),
(51, 8),
(52, 8),
(53, 8),
(54, 8),
(58, 8),
(59, 8),
(60, 8),
(61, 8),
(62, 8),
(63, 8),
(64, 8),
(65, 8),
(66, 8),
(67, 8),
(68, 8),
(75, 8),
(76, 8),
(77, 8),
(78, 8),
(79, 8),
(80, 8),
(81, 8),
(82, 8),
(83, 8),
(84, 8),
(102, 8),
(103, 8),
(109, 8),
(110, 8),
(111, 8),
(5, 9),
(9, 9),
(13, 9),
(17, 9),
(54, 9),
(58, 9);

-- --------------------------------------------------------

--
-- Table structure for table `role_store`
--

CREATE TABLE `role_store` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_store`
--

INSERT INTO `role_store` (`id`, `role_id`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 9, 17, '2020-03-06 17:54:16', '2020-03-06 17:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_time` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `template_id` int(10) UNSIGNED DEFAULT NULL,
  `show_all_button` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `logo`, `facebook_url`, `instagram_url`, `twitter_url`, `phone1`, `phone2`, `work_time`, `address`, `description`, `created_at`, `updated_at`, `store_id`, `template_id`, `show_all_button`) VALUES
(2, 'computerstar2002@yahoo.com', '/uploads/settings/site_settings/2/1579946612.png', NULL, NULL, NULL, '11111111111', '22222222222', NULL, 'egypt', NULL, '2019-10-24 07:19:58', '2020-01-25 08:06:33', NULL, NULL, 0),
(6, 'computerstar2002@yahoo.com', 'demo-product.png', 'http://www.facebook.com', 'instagram.com', NULL, '11111111111', '22222222222', NULL, NULL, 'qdwdqd', '2020-01-25 12:49:58', '2020-03-06 14:12:26', 17, 4, 1),
(7, 'jana@yahoo.com', NULL, NULL, NULL, NULL, '01006922590', NULL, NULL, NULL, NULL, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 18, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings_data`
--

CREATE TABLE `settings_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `setting_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings_data`
--

INSERT INTO `settings_data` (`id`, `title`, `created_at`, `updated_at`, `lang_id`, `source_id`, `setting_id`, `description`) VALUES
(4, 'fz', '2020-01-25 12:49:58', '2020-03-04 06:27:36', 1, NULL, 6, 'qdwdqd'),
(11, 'Sallatk', '2020-02-07 08:41:21', '2020-02-07 08:44:26', 1, 2, 2, NULL),
(12, 'jana', '2020-03-07 14:42:27', '2020-03-07 14:42:27', 1, NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shippings_address`
--

CREATE TABLE `shippings_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `Neighborhood` mediumtext COLLATE utf8mb4_unicode_ci,
  `street` mediumtext COLLATE utf8mb4_unicode_ci,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `code` int(11) DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_companies`
--

CREATE TABLE `shipping_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_companies`
--

INSERT INTO `shipping_companies` (`id`, `title`, `description`, `logo`, `lang_id`, `source_id`, `store_id`, `created_at`, `updated_at`) VALUES
(3, 'sasas', '<p>sasasas</p>', 'uploads/shippingCompany/157278466790598.png', NULL, NULL, NULL, '2019-11-03 10:37:47', '2019-11-03 10:37:47'),
(4, 'شركه الطير المهاجر', 'شركه شحن داخليه', 'uploads/shippingCompany/158057876578380.jpeg', NULL, NULL, 17, '2020-02-01 15:17:04', '2020-02-01 15:39:25'),
(5, 'شركة الطير المهاجر 2', 'شركة الطير المهاجر 2', 'uploads/shippingCompany/158146024580831.jpeg', NULL, NULL, 17, '2020-02-11 20:30:45', '2020-02-11 20:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_options`
--

CREATE TABLE `shipping_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `delay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` double(8,2) DEFAULT NULL,
  `cash_delivery_commission` decimal(8,2) DEFAULT NULL,
  `company_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_require`
--

CREATE TABLE `shipping_require` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_require_data`
--

CREATE TABLE `shipping_require_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang_id` int(11) NOT NULL,
  `shipping_require_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_types`
--

CREATE TABLE `shipping_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `shipping_option_id` int(10) UNSIGNED DEFAULT NULL,
  `no_kg` tinyint(4) NOT NULL,
  `cost_no_kg` double NOT NULL,
  `cost_increase` double DEFAULT NULL,
  `kg_increase` tinyint(4) DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `status`, `url`, `published`, `image`, `logo`, `created_at`, `updated_at`, `store_id`) VALUES
(3, 1, '7ouor.com', 1, 'shop-spanshot.jpg', 'shop.png', '2019-10-03 06:51:11', '2019-10-03 06:51:11', NULL),
(8, 0, 'https://www.sallatk.com', 1, 'slider-img-Sallatk-03.png', 'Sallatk-2019-30-10.png', '2019-10-24 06:43:53', '2019-10-31 01:13:58', NULL),
(11, NULL, 'https://www.alemirinsurance.com/anasayfa', 1, 'slider-img.jpg', NULL, '2019-12-30 02:55:26', '2019-12-30 02:55:26', 3),
(12, NULL, 'https://soundcloud.com/loma-soliman-secrit-bliss/mp3', 1, 'images (3).jpeg', NULL, '2019-12-30 02:57:28', '2019-12-30 02:57:28', 3),
(13, NULL, 'https://www.alemirinsurance.com/anasayfa', 1, 'slider-img.jpg', NULL, '2020-02-03 06:37:41', '2020-02-04 04:20:17', 17),
(14, NULL, 'https://www.alemirinsurance.com/anasayfa', 1, 'apparel-assortment-boutique-1336873.png', NULL, '2020-02-04 04:21:37', '2020-02-04 04:21:37', 17),
(15, NULL, 'https://www.alemirinsurance.com/anasayfa', 1, 'advertisement-advertising-bargain-2529787.png', NULL, '2020-02-04 04:25:15', '2020-02-04 04:25:15', 17);

-- --------------------------------------------------------

--
-- Table structure for table `sliders_data`
--

CREATE TABLE `sliders_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `slider_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(10) UNSIGNED NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','sent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `owner_id` int(10) UNSIGNED DEFAULT NULL,
  `membership_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `title`, `domain`, `image`, `lang_id`, `source_id`, `owner_id`, `membership_id`, `created_at`, `updated_at`, `is_active`) VALUES
(3, 'demo', 'demo', NULL, 1, NULL, 54, 22, '2019-09-05 10:06:02', '2020-01-29 13:07:45', 1),
(17, 'fz', 'fz', NULL, 1, NULL, 33, 22, '2019-12-23 18:28:48', '2020-03-04 06:27:36', 1),
(18, 'jana', 'jana', NULL, 1, NULL, 90, NULL, '2020-03-07 14:42:27', '2020-03-07 14:42:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_currencies`
--

CREATE TABLE `store_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_homepages`
--

CREATE TABLE `store_homepages` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `template` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_homepages`
--

INSERT INTO `store_homepages` (`id`, `store_id`, `category_id`, `sort`, `template`, `created_at`, `updated_at`) VALUES
(1, 17, 195, 1, 0, '2020-01-07 18:14:36', '2020-01-07 18:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `store_languages`
--

CREATE TABLE `store_languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_payments`
--

CREATE TABLE `store_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `contactName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countryCode` int(11) DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_code` bigint(20) DEFAULT NULL,
  `account_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` bigint(20) DEFAULT NULL,
  `iban` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_users`
--

CREATE TABLE `store_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_users`
--

INSERT INTO `store_users` (`id`, `user_id`, `store_id`, `created_at`, `updated_at`) VALUES
(7, 33, 17, '2019-12-23 18:28:48', '2019-12-23 18:28:48'),
(8, 33, 3, NULL, NULL),
(35, 72, 17, '2020-02-09 08:51:24', '2020-02-09 08:51:24'),
(36, 90, 18, '2020-03-07 14:42:27', '2020-03-07 14:42:27'),
(37, 72, 18, '2020-03-07 15:02:47', '2020-03-07 15:02:47'),
(38, 72, 18, '2020-03-07 15:03:10', '2020-03-07 15:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `code`, `img`, `created_at`, `updated_at`) VALUES
(1, 'default', 'uploads/screen/default.png', NULL, NULL),
(2, 'red', 'uploads/screen/red.png', NULL, NULL),
(3, 'blue', 'uploads/screen/blue.png', NULL, NULL),
(4, 'purple', 'uploads/screen/purple.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_data`
--

CREATE TABLE `template_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_data`
--

INSERT INTO `template_data` (`id`, `title`, `template_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 'default', 1, 1, NULL, NULL, NULL),
(2, 'Red', 2, 1, NULL, NULL, NULL),
(3, 'Blue', 3, 1, NULL, NULL, NULL),
(4, 'Purple', 4, 1, NULL, NULL, NULL),
(5, 'بنفسج', 4, 2, NULL, NULL, NULL),
(6, 'افتراضي', 1, 2, NULL, NULL, NULL),
(7, 'سماوي', 3, 2, NULL, NULL, NULL),
(8, 'جذاب', 2, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` enum('1','2','3') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `priority_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `content`, `status`, `admin_id`, `lang_id`, `source_id`, `agent_id`, `category_id`, `priority_id`, `created_at`, `updated_at`) VALUES
(1, 'موقع مدرسة العطارين بفاس', 'تم الانتهاء من انشاء الموقع', '1', 1, NULL, NULL, 5, 1, 1, '2019-09-05 10:56:02', '2019-09-05 10:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `name`, `color`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 'category test', '#000000', NULL, NULL, '2019-09-05 10:50:39', '2019-09-05 10:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_category_users`
--

CREATE TABLE `ticket_category_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ticket_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `res_comment` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_comments`
--

INSERT INTO `ticket_comments` (`id`, `admin_id`, `user_id`, `ticket_id`, `content`, `res_comment`, `created_at`, `updated_at`) VALUES
(2, 2, 5, 1, 'اذا اردت التعديل عليها يمكنك الدخول باستخدام admin@admin.com ونفس الباسوورد', 1, '2019-09-05 11:06:10', '2019-09-05 11:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_priorities`
--

CREATE TABLE `ticket_priorities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_priorities`
--

INSERT INTO `ticket_priorities` (`id`, `name`, `color`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 'priority test', '#000000', NULL, NULL, '2019-09-05 10:51:06', '2019-09-05 10:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('pending','paid','refused') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_cvc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_expire` datetime DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('online','offline','delivery','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_transactions_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('bank','paypal','without') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `title`, `code`, `main`, `status`, `lang_id`, `source_id`, `store_id`, `created_at`, `updated_at`) VALUES
(2, 'My fatoorah', '6667', '1', '', NULL, NULL, 17, NULL, NULL),
(3, 'Paypal', 'paypal', '0', 'paypal', NULL, NULL, 17, NULL, NULL),
(4, 'Paypal', 'paypal', '0', 'paypal', 1, NULL, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_agent` tinyint(4) NOT NULL DEFAULT '0',
  `guard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `country_id` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `code` int(10) DEFAULT NULL,
  `pin_code` int(10) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `phone`, `email`, `email_verified_at`, `password`, `provider`, `provider_id`, `ticket_agent`, `guard`, `country_id`, `image`, `address`, `code`, `pin_code`, `remember_token`, `created_at`, `updated_at`, `store_id`, `is_active`) VALUES
(1, 'admin', NULL, NULL, 'admin@admin.com', NULL, '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, 0, 'admin', NULL, NULL, NULL, NULL, NULL, 'Fi1ISrzGZ1xvStro11vzVbJOC1b57izIQrTTGDNOSfiavEAWVa4niI7PJJzf', '2019-09-05 10:05:35', '2019-09-05 10:05:35', NULL, 1),
(2, 'store', NULL, NULL, 'store@store.com', NULL, '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'JCYgfApABRwFKU4wQzjOOnxsMuZsCPuPI9yaHzktAmVItIJ5mJZCMKv4pdQ8', '2019-09-05 10:05:35', '2019-09-05 10:05:35', NULL, 1),
(3, 'Elwin Armstrong', NULL, NULL, 'virgil.robel@example.com', '2019-09-05 10:05:48', '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'GKsnM3nLTkkrEiarzel376TqWrdDcuipaEUjNMmRFdcEO9X40TDeef8D8OLY', '2019-09-05 10:05:48', '2019-09-05 10:05:48', NULL, 1),
(4, 'Mrs. Sheila Bernier', NULL, NULL, 'bogan.buddy@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 1, 'web', NULL, NULL, NULL, NULL, NULL, '9vbV8ROasf', '2019-09-05 10:05:48', '2019-09-05 10:51:27', NULL, 1),
(5, 'Nya King', NULL, NULL, 'corkery.dashawn@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 1, 'store', NULL, NULL, NULL, NULL, NULL, 'pZIT8NWktU', '2019-09-05 10:05:49', '2019-09-05 10:51:27', NULL, 1),
(6, 'Toby Klocko', NULL, NULL, 'keara.hermiston@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 1, 'web', NULL, NULL, NULL, NULL, NULL, 'FSaiN6e7pf', '2019-09-05 10:05:49', '2019-09-05 10:51:27', NULL, 1),
(7, 'Marcus Ferry', NULL, NULL, 'lucius.cole@example.com', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 1, 'web', NULL, NULL, NULL, NULL, NULL, 'hSx4ENXOHP', '2019-09-05 10:05:49', '2019-09-05 10:51:27', NULL, 1),
(8, 'Ms. Viva Kulas', NULL, NULL, 'hermiston.german@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'VdLwfrs48f', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(9, 'Miss Vivien Bernier DVM', NULL, NULL, 'kareem08@example.org', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, 'PNdubWMmZk', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(10, 'Rubie Kunze', NULL, NULL, 'karson85@example.org', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'vuogvpR8dV', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(11, 'Elinor Becker', NULL, NULL, 'kylie.bradtke@example.org', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'GpLI4b70vD', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(12, 'Richard Weber V', NULL, NULL, 'shaun17@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'ChX9SJ4RuI', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(13, 'Kirk Zieme DDS', NULL, NULL, 'willms.susana@example.com', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'quwv4JCjUH', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(14, 'Vito Mosciski V', NULL, NULL, 'madonna15@example.org', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'O9rUmXazDh', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(15, 'Mr. Jerrell Jakubowski DVM', NULL, NULL, 'corkery.hester@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'X50LytOuf5', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(16, 'Mrs. Carrie Ferry', NULL, NULL, 'funk.augusta@example.org', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'mm2y65VmXS', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(17, 'Mr. Maurice Huel IV', NULL, NULL, 'tracy35@example.org', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, '0s4Dnoy7lW', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(18, 'Derick Hahn V', NULL, NULL, 'fzemlak@example.org', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'h96GYHMyUb', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(19, 'Kennedi Runolfsson', NULL, NULL, 'kvandervort@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'Hse34igHFs', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(20, 'Kobe Wolf', NULL, NULL, 'lennie77@example.net', '2019-09-05 10:05:48', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'KgByZ7Qand', '2019-09-05 10:05:49', '2019-09-05 10:05:49', NULL, 1),
(25, 'fawzia', 'Mohammed', '11111001', 'computerstar2002@yahoo.com', NULL, '$2y$10$RD/rHKeznQoTGW.sDo31a.UbdGOTHiiEvCMgxc34JUlxwPPUNZEfy', NULL, NULL, 0, 'store', 1, NULL, NULL, NULL, NULL, 'TQWd8KL8uxYJ6nCHSvP3vOh3zeYSFErylM9mfNPHdXqC0RRbufMDNnpTIQnx', '2019-12-19 01:52:52', '2019-12-19 01:52:52', NULL, 1),
(26, 'fawzia Mohammed', 'Mohammed', NULL, '4computerstar2002@yahoo.com', NULL, '$2y$10$3St8secFPHkg.JPCVt/ABuiDXDm8zhA86cnAbsCVhDBXFMvWs8ewW', NULL, NULL, 0, 'store', 1, NULL, NULL, NULL, NULL, NULL, '2019-12-19 02:04:04', '2019-12-19 02:04:04', NULL, 1),
(27, '111111111', '2222222222', '11111111', 'coderstar2002@yahoo.com', NULL, '$2y$10$1kbvz6sKMnzCTYWjphI0yuOvFLaMAeKowebFUXMAX3I68q1dLja5m', NULL, NULL, 0, 'store', 1, NULL, NULL, NULL, NULL, 'M5EcQFSlm2Qd5XHR4qV6ANZQpHSXpaS4xj8qMNfegfdpnLOJmxSfMpOvCWmp', '2019-12-19 02:08:13', '2019-12-19 02:08:13', NULL, 1),
(28, 'fawzia Mohammed', 'Mohammed', NULL, 'computerstar2002@hoo.com', NULL, '$2y$10$pkFPbXUiYF3YqDMd7aS8Luv8KjFJO/lqGJbefPENvfhgta8et6brW', NULL, NULL, 0, 'store', 2, NULL, NULL, NULL, NULL, NULL, '2019-12-19 02:10:14', '2019-12-19 02:10:14', NULL, 1),
(29, 'fawzia Mohammed', 'Mohammed', '11111111', 'computerstdev002@yahoo.com', NULL, '$2y$10$1YrZOxL9wm.jKhxAMZyoAediHmCJl82SziFJoI8I9HRP1.mbs/tYa', NULL, NULL, 0, 'store', 1, NULL, NULL, NULL, NULL, 'rYKfGay1bY33p60uvAx0yOIgp1HW4lmhywWiO6CfpB0kkvP6uQmGYqg0cmPQ', '2019-12-19 02:13:06', '2019-12-19 02:13:06', NULL, 1),
(30, 'fawzia Mohammed', 'Mohammed', '55555555', 'computerstarfed2002@yahoo.com', NULL, '$2y$10$stcP.YIL3o0arHZ0nTUqnu5RmMJC6VD.zWmTs7YNI/lYrykS3fnYK', NULL, NULL, 0, 'store', 2, NULL, NULL, NULL, NULL, 'IzFxGa0g2suutUc9Ul8fHI0BoubymswbPUdvf9aIqKjs6m0lOmCK4FRd96OA', '2019-12-19 02:48:00', '2019-12-19 02:48:00', NULL, 1),
(31, 'fawzia Mohammed', 'Mohammed', NULL, 'computerstar@yahoo.com', '2020-02-18 22:00:00', '$2y$10$.dU58Z7qJO72572K.H04AumNs44gL/gDe1WWa76MnBqg09ztHLi0O', NULL, NULL, 0, 'store', 2, NULL, NULL, NULL, NULL, NULL, '2019-12-19 20:28:51', '2019-12-19 20:28:51', NULL, 1),
(32, 'fawzia Mohammed', 'Mohammed', '11111111', 'computerstar2@yahoo.co', NULL, '$2y$10$NNVmhaiiDIKW1y2ArDJDleRcumDQU8ovVutoqA5xiLUZKPmhUeamK', NULL, NULL, 0, 'store', 2, NULL, NULL, NULL, NULL, 'RdP6WVhzntns140CjwFGxRUM6tNJNfqH5DYfW3Nh5gQsV6EEki8t5ijADp9i', '2019-12-19 20:30:44', '2019-12-19 20:30:44', NULL, 1),
(33, 'fawzia Mohammed', 'Mohammed', '11111111', 'fz@yahoo.com', '2020-02-27 22:00:00', '$2y$10$eHbBFk5UiwDoRoXI8RJo7.iFLrUG0Ugi4HwbyDSYqFOotmmLIaRRm', NULL, NULL, 0, 'store', 2, NULL, NULL, NULL, NULL, 'JztDErOdLd6cw4aOpYWdYMrnGrBZesODIweyN93shRcLiWQMfVttYa9CQz21', '2019-12-23 18:28:48', '2019-12-23 18:28:48', NULL, 1),
(35, 'fawzia Mohammed', 'Mohammed', '11111111', 'dev@yahoo.com', '2019-05-02 05:00:00', '$2y$10$Yy/5/Oeobl3/9t8JUwiynubz6wX1gZhWP2bCxC9YGeRYs75dOzXpW', NULL, NULL, 0, 'store', 1, NULL, NULL, NULL, NULL, '56Fn6C2BpMjLbOkt9hk0uWdoqdRPg2HhZRqetztiQcNjhRJIBtQp7XyAqip0', '2019-12-27 18:46:03', '2019-12-27 18:46:03', NULL, 1),
(36, 'fawzia', NULL, '11111111', 'mm@yahoo.com', NULL, '$2y$10$RM/Pn6hrlR9kzt4CblAtReURaEbE8hXvK2cTOsLGigsRkyEI8NC0a', NULL, NULL, 0, 'web', 1, NULL, NULL, NULL, NULL, NULL, '2020-01-08 04:29:58', '2020-01-08 04:29:58', 3, 1),
(37, 'fawzia', NULL, '11111111', 'rr@yahoo.com', NULL, '$2y$10$GrBKx80CtAmPoq8X.Ogbfu0xCHAwJNwGGByTOqRbD5uipcfwbnqd.', NULL, NULL, 0, 'web', 2, NULL, NULL, NULL, NULL, NULL, '2020-01-08 04:46:33', '2020-01-08 04:46:33', 3, 1),
(38, 'fawzia', 'Mohammed', '6611111111', 'computrrerstd002@yahoo.com', NULL, '$2y$10$bPWSUnFXYR2FedJAB.NXgub09DqKyHPokj7kwtEILTVPTyIlDVWLe', NULL, NULL, 0, 'web', 2, NULL, NULL, NULL, NULL, NULL, '2020-01-08 17:25:47', '2020-01-08 17:25:47', NULL, 1),
(39, 'fawzia', 'Mohammed', '11111111', 'computerddstar2002@yahoo.com', NULL, '$2y$10$rMXi1GkpmREtQiOBzNiJJeYRm6aIYr0e/m0/gz9SZ59ge0h8J1jH6', NULL, NULL, 0, 'web', 2, NULL, NULL, NULL, NULL, NULL, '2020-01-08 17:30:07', '2020-01-08 17:30:07', NULL, 1),
(40, 'fawzia', 'Mohammed', '11111111', 'computerdddddstar2002@yahoo.com', NULL, '$2y$10$5jRtWJkXlWYcNfvyvnFgAeHcdJrNIAR/uQPiS5GxwwNjg7kN1hmzW', NULL, NULL, 0, 'web', 2, NULL, NULL, NULL, NULL, NULL, '2020-01-08 17:31:40', '2020-01-08 17:31:40', NULL, 1),
(41, 'fawzia', 'Mohammed', '11111111', 'computerd42@yahoo.com', NULL, '$2y$10$i7QmtI.LlI0eE.N3SVNy.OA8sQExrE0.2gQvZvHYUvPkJBKV3R3ui', NULL, NULL, 0, 'web', 2, NULL, NULL, NULL, NULL, NULL, '2020-01-08 17:34:31', '2020-01-08 17:34:31', NULL, 1),
(42, 'fawzia', 'Mohammed', '11111111', 'computersf02@yahoo.com', NULL, '$2y$10$BMQtVUj9QnulDGaBhePqz.N4EqUVnEGAZlpnLxaGYTDXWQp.zae5q', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-09 03:28:45', '2020-01-09 03:28:45', NULL, 1),
(43, 'fawzia Mohammed', 'Mohammed', '43646464', 'gg@yahoo.com', NULL, '$2y$10$iwotiUIWs5x3HPePvcrz5.wEQZuPCMmGMwV8Fs8YvewyrI0NR5q/i', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-09 06:13:15', '2020-01-09 06:13:15', NULL, 1),
(44, 'fawzia Mohammed', 'Mohammed', '45345345354', 'dd@yahoo.com', NULL, '$2y$10$qUFPwpyOu1qwee/N8dTAPegM5ndrbBmvO.FRVl9N/FPf2Hlc9yCyG', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-09 06:20:06', '2020-01-09 06:20:06', NULL, 1),
(45, 'fawzia Mohammed', 'Mohammed', '45345345354', 'dd2@yahoo.com', NULL, '$2y$10$NrGhTnw2T0pyrsmZprjsiOskNG.p6yPhplWNoJ.ovbvP82LWnWgz.', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-09 06:21:34', '2020-01-09 06:21:34', NULL, 1),
(46, 'fawzia Mohammed', 'Mohammed', '45345345354', 'sss@yahoo.com', NULL, '$2y$10$dABbkGgNfb1snohhMg0vK.E8gxitriN4cpoBgVJ7uUzWe0qfPr1TS', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-09 06:32:40', '2020-01-09 06:32:40', NULL, 1),
(47, 'fawzia Mohammed', 'Mohammed', '45345345354', 'adas@yahoo.com', NULL, '$2y$10$j2Q29WfQAXSczAJxXEOQyeWesD.mxi7PMPt9.MzHDVSawtW1mg5aW', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-09 06:34:41', '2020-01-09 06:34:41', NULL, 1),
(52, 'test', NULL, NULL, 'teacher@yahoo.com', NULL, '$2y$10$UIT.Kc3aBXeMiABcBsFvxuX/OPorDux3eIoB0AryKF5L0qOjDz18K', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-14 18:31:32', '2020-01-14 18:31:32', NULL, 1),
(53, 'fawzia Mohammed', 'Mohammed', '89898988787', 'bussiness@test.com', NULL, '$2y$10$FVT86Gm/EToOwGj68ZtIMeTSMmLlg9LkPcD27HuqEbK4zbSiMK/mG', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-29 05:05:56', '2020-01-29 05:05:56', NULL, 1),
(54, 'demo', 'demo', NULL, 'demo@demo.com', '2020-01-29 13:07:05', '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, '2oZryW1zBgrefPcammCzU9DBTMfqn6G5aCeX7YA4hSIUxUPW0h0GmBwx71WX', '2020-01-29 13:07:05', '2020-01-29 13:07:05', NULL, 1),
(57, 'fawzia Mohammed', 'Mohammed', '11111111', 'cofftar2002@yahoo.com', NULL, '$2y$10$A0UVPR/D5zOFLfpOtL2/oOJIWvBS/itJPgWa/ngEi91wutuikh3mi', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-31 06:17:35', '2020-01-31 06:17:35', NULL, 1),
(58, 'fawzia Mohammed', 'Mohammed', '11111111', 'cddddd002@yahoo.com', NULL, '$2y$10$6CQmtrJXgO7hHrg/hKWU0exbh22lOte1AycijjZklULyeAJrFlPUO', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-31 06:19:28', '2020-01-31 06:19:28', NULL, 1),
(71, 'fawzia Mohammed', 'Mohammed', '11111111', 'compute4402@yahoo.com', NULL, '$2y$10$QX6gD82nzkkCSRMTzXC8F.p38dnCn05EAlQ1QtMISIMmGLrSQHfEK', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-09 06:27:29', '2020-02-09 06:27:29', NULL, 1),
(72, 'user test', 'dddddd', '01006922590', 'fz_user@test.com', '2020-02-26 22:00:00', '$2y$10$mQhWBLutLhFW6TdJ0.ahq.N2NXUe2JyH1o39psNE.k05S2Q.VQKFa', NULL, NULL, 0, 'web', 1, '5934.png', NULL, NULL, NULL, NULL, '2020-02-09 08:51:24', '2020-02-09 09:08:06', 17, 1),
(73, 'loly', 'pop', NULL, 'lol@yahoo.com', NULL, '$2y$10$FXYak07AdLp1y7PAq57jjOFHET2K.ywV5omN0cCRPGzCGsUQj8Khq', NULL, NULL, 0, 'web', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-09 17:42:17', '2020-02-09 17:42:17', 17, 1),
(74, 'fawzia Mohammed', 'Mohammed', '01006922590', 'zzzzzzzzz@yahoo.com', NULL, '$2y$10$wUTK4mcaWD70mkA4KZQNrun1D0U2Ke2vP5tMie1yE3wIUOagw5sge', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-09 18:30:34', '2020-02-09 18:30:34', NULL, 1),
(75, 'fawzia Mohammed', 'Mohammed', '768789899722', 'free_web@yahoo.com', '2020-02-11 22:00:00', '$2y$10$VUrLehxoZkRvRc46gEtMo.6R7iIuzF3jdaqK/gng7doDdpc1h2.qC', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-11 21:51:33', '2020-02-11 21:51:33', NULL, 1),
(76, 'fawzia Mohammed', 'Mohammed', '768789899722', 'joudy@yahoo.com', NULL, '$2y$10$Jp7M2WEueS/ZuAEo5IqO0eZBYi1RLGBSYHdIUmltyRaZTwI57igHS', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-16 06:06:50', '2020-02-16 06:06:50', NULL, 1),
(77, 'fawzia Mohammed', 'Mohammed', '11111111', 'abcd@yahoo.com', NULL, '$2y$10$5WQ6mruR0x0rb8i5/fYT.e11D.mqEbv6TzCSrN8xdKHlSngJXDWda', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 06:19:13', '2020-02-25 06:19:13', NULL, 1),
(78, 'fawzia Mohammed', 'Mohammed', '11111111', 'compddstar2002@yahoo.com', NULL, '$2y$10$cT.xRzzwuQbG7OWGmmBwke5W71fLAQ0JqBkH7//a1gRr8Cw.yXhau', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 06:30:52', '2020-02-25 06:30:52', NULL, 1),
(79, 'fawzia Mohammed', 'Mohammed', '11111111', 'compdtestr2002@yahoo.com', '2020-02-26 22:00:00', '$2y$10$eqsD/vx9qIYDxwxkPkBqo.1m4wQaqUb.3v/KgrPBy.FtPMGtQ.zke', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'XdLRyKTEcfMMY9gkeIxQ4xunXji18aCw1dSGXouyllkWGqVIF1JoyaQrvMCd', '2020-02-25 17:22:09', '2020-02-25 17:22:09', NULL, 1),
(83, 'fawzia Mohammed', 'Mohammed', '7686866566', 'ffffff@yahoo.com', NULL, '$2y$10$XpBD4xTHmTrLofiyLXxsyOf/2ISVkR6GtQNwI.POa/WC8FDdBgMia', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-26 15:00:37', '2020-02-26 15:00:37', NULL, 1),
(84, 'fawzia Mohammed', 'Mohammed', '878987808080', 'dodo@test.com', NULL, '$2y$10$BlcI26DH7sNLDqI..LcOYuJvdk02gE0fN7LEGl463MlVBhS./NmNW', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-26 15:04:15', '2020-02-26 15:04:15', NULL, 1),
(85, 'fawzia Mohammed', 'Mohammed', '878987808080', 'lolo@test.com', '2020-02-11 22:00:00', '$2y$10$4JkqnwXLbdx0v9HRAnol4OnMDBspYDvwcXe007NI93HfTW7.VOaSO', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'cd9T7NNemE2dWHboe40yEOHDYE2eMtZaIqUjYlGG1eudqXutrpltZ0BEHksK', '2020-02-26 15:13:18', '2020-02-26 15:13:18', NULL, 1),
(87, 'fawzia Mohammed', 'Mohammed', '01006922590', 'moh@yahoo.com', '2020-02-25 22:00:00', '$2y$10$2Du./jG7YBoXo2yuUovBDuDsyfwqMYpgSIUt2TIsBJ4YysZdtk/lm', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'O2AIrYrVrk8s3PQ4Jnei6Qowi8enQo7Xqcwru8hPBGRuxOSR84W48mkIIQ2G', '2020-02-26 15:24:14', '2020-02-26 15:24:14', NULL, 1),
(88, 'fawzia Mohammed', 'Mohammed', '01006922590', 'ah@yahoo.com', '2020-03-25 22:00:00', '$2y$10$MK80TWWdzHmHijOc32HV4uAPs1MpR8woChO4bwkQmbKw8vCTDzXm.', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'QjqesW6iEaJ1LSquO4rn8itjhWV3Wh8nFAJsnmpgsTh67AzqCtptYO6Sxjbh', '2020-02-29 23:48:21', '2020-02-29 23:48:21', NULL, 1),
(89, 'fawzia Mohammed', 'Mohammed', '878987808080', 'me@yahoo.com', '2020-03-24 22:00:00', '$2y$10$dF8WS8dAaJQIeFnfDUReg..AtbWrZo6bNZ9sXCR69v8GTEzSB1OJ6', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'IR6a1cQT6Dd5vCwfqwsT5dtu5UslxIGBSZiR6UQv9GAjAZCWM7RsJGm5mdi0', '2020-03-01 00:27:17', '2020-03-01 00:27:17', NULL, 1),
(90, 'fawzia Mohammed', 'Mohammed', '01006922590', 'jana@yahoo.com', '2020-03-25 22:00:00', '$2y$10$CAdSy8RYyOuMkJbHqqt9G.2kkdBfO374vv2TjedmFXc6a7DjqcuF6', NULL, NULL, 0, 'store', NULL, NULL, NULL, NULL, NULL, 'Z3GriXaIxtMBCdnqwEZ6uFFximEfsh5GqDI0fz5YwnhxhJA0AJmGlIiH8CY3', '2020-03-07 14:42:27', '2020-03-07 14:42:27', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_membership`
--

CREATE TABLE `user_membership` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `membership_id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `created` date NOT NULL,
  `expire_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_membership`
--

INSERT INTO `user_membership` (`id`, `user_id`, `membership_id`, `price`, `created`, `expire_at`, `created_at`, `updated_at`) VALUES
(4, 57, 22, 0.00, '0000-00-00', '0000-00-00', '2020-01-31 06:17:35', '2020-01-31 06:17:35'),
(5, 58, 22, 0.00, '0000-00-00', '0000-00-00', '2020-01-31 06:19:28', '2020-01-31 06:19:28'),
(15, 71, 24, 40.00, '0000-00-00', '0000-00-00', '2020-02-09 06:27:30', '2020-02-09 06:27:30'),
(16, 74, 24, 40.00, '0000-00-00', '0000-00-00', '2020-02-09 18:30:34', '2020-02-09 18:30:34'),
(17, 75, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-11 21:51:33', '2020-02-11 21:51:33'),
(18, 76, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-16 06:06:50', '2020-02-16 06:06:50'),
(19, 77, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-25 06:19:14', '2020-02-25 06:19:14'),
(20, 78, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-25 06:30:52', '2020-02-25 06:30:52'),
(21, 79, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-25 17:22:10', '2020-02-25 17:22:10'),
(22, 85, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-26 15:13:18', '2020-02-26 15:13:18'),
(23, 87, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-26 15:24:14', '2020-02-26 15:24:14'),
(24, 88, 22, 0.00, '0000-00-00', '0000-00-00', '2020-02-29 23:48:22', '2020-02-29 23:48:22'),
(25, 89, 22, 0.00, '0000-00-00', '0000-00-00', '2020-03-01 00:27:17', '2020-03-01 00:27:17'),
(26, 90, 22, 0.00, '0000-00-00', '0000-00-00', '2020-03-07 14:42:27', '2020-03-07 14:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rating_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `approve` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip`, `store_id`, `created_at`, `updated_at`, `country`) VALUES
(1, '::1', 3, '2020-01-13 14:59:05', '2020-01-13 14:59:05', NULL),
(3, '::1', 17, '2020-01-25 12:42:50', '2020-01-25 12:42:50', NULL),
(4, '::1', 18, '2020-03-07 14:52:23', '2020-03-07 14:52:23', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_options_perms`
-- (See below for the actual view)
--
CREATE TABLE `vw_options_perms` (
`id` int(10) unsigned
,`perm_id` int(10) unsigned
,`option_id` int(10) unsigned
,`name` varchar(191)
,`title` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_options_without_perm`
-- (See below for the actual view)
--
CREATE TABLE `vw_options_without_perm` (
`id` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`option_id` int(10) unsigned
,`title` varchar(100)
,`lang_id` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_perms_without_options`
-- (See below for the actual view)
--
CREATE TABLE `vw_perms_without_options` (
`id` int(10) unsigned
,`name` varchar(191)
,`guard_name` varchar(191)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_stores`
-- (See below for the actual view)
--
CREATE TABLE `vw_stores` (
`id` int(10) unsigned
,`name` varchar(191)
,`lastname` varchar(191)
,`phone` varchar(15)
,`email` varchar(191)
,`email_verified_at` timestamp
,`password` varchar(191)
,`provider` varchar(191)
,`provider_id` varchar(191)
,`ticket_agent` tinyint(4)
,`guard` varchar(191)
,`country_id` int(11)
,`image` varchar(191)
,`address` text
,`code` int(10)
,`pin_code` int(10)
,`remember_token` varchar(100)
,`created_at` timestamp
,`updated_at` timestamp
,`store_id` int(10) unsigned
,`is_active` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_perms`
-- (See below for the actual view)
--
CREATE TABLE `vw_user_perms` (
`id` int(10) unsigned
,`email` varchar(191)
,`permission_id` int(10) unsigned
,`name` varchar(191)
,`guard_name` varchar(191)
);

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `websockets_statistics_entries`
--

INSERT INTO `websockets_statistics_entries` (`id`, `app_id`, `peak_connection_count`, `websocket_message_count`, `api_message_count`, `created_at`, `updated_at`) VALUES
(1, '123', 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_banners_data`
--

CREATE TABLE `_banners_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banner_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_banners_data`
--

INSERT INTO `_banners_data` (`id`, `name`, `description`, `lang_id`, `source_id`, `created_at`, `updated_at`, `banner_id`) VALUES
(1, 'dddddddddd', '<p>eeeeeeee</p>', 1, NULL, '2019-12-29 20:26:07', '2019-12-29 20:26:07', 1);

-- --------------------------------------------------------

--
-- Structure for view `vw_options_perms`
--
DROP TABLE IF EXISTS `vw_options_perms`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fz`@`localhost` SQL SECURITY DEFINER VIEW `vw_options_perms`  AS  select `membership_option_perms`.`id` AS `id`,`membership_option_perms`.`perm_id` AS `perm_id`,`membership_option_perms`.`option_id` AS `option_id`,`permissions`.`name` AS `name`,`membership_options_data`.`title` AS `title` from ((`membership_option_perms` join `permissions` on((`membership_option_perms`.`perm_id` = `permissions`.`id`))) join `membership_options_data` on((`membership_option_perms`.`option_id` = `membership_options_data`.`option_id`))) where (`membership_options_data`.`lang_id` = 2) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_options_without_perm`
--
DROP TABLE IF EXISTS `vw_options_without_perm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fz`@`localhost` SQL SECURITY DEFINER VIEW `vw_options_without_perm`  AS  select `membership_options_data`.`id` AS `id`,`membership_options_data`.`created_at` AS `created_at`,`membership_options_data`.`updated_at` AS `updated_at`,`membership_options_data`.`option_id` AS `option_id`,`membership_options_data`.`title` AS `title`,`membership_options_data`.`lang_id` AS `lang_id` from `membership_options_data` where (not(`membership_options_data`.`option_id` in (select `membership_option_perms`.`option_id` from `membership_option_perms`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_perms_without_options`
--
DROP TABLE IF EXISTS `vw_perms_without_options`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fz`@`localhost` SQL SECURITY DEFINER VIEW `vw_perms_without_options`  AS  select `permissions`.`id` AS `id`,`permissions`.`name` AS `name`,`permissions`.`guard_name` AS `guard_name`,`permissions`.`created_at` AS `created_at`,`permissions`.`updated_at` AS `updated_at` from `permissions` where (not(`permissions`.`id` in (select `membership_option_perms`.`perm_id` from `membership_option_perms`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_stores`
--
DROP TABLE IF EXISTS `vw_stores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fz`@`localhost` SQL SECURITY DEFINER VIEW `vw_stores`  AS  select `users`.`id` AS `id`,`users`.`name` AS `name`,`users`.`lastname` AS `lastname`,`users`.`phone` AS `phone`,`users`.`email` AS `email`,`users`.`email_verified_at` AS `email_verified_at`,`users`.`password` AS `password`,`users`.`provider` AS `provider`,`users`.`provider_id` AS `provider_id`,`users`.`ticket_agent` AS `ticket_agent`,`users`.`guard` AS `guard`,`users`.`country_id` AS `country_id`,`users`.`image` AS `image`,`users`.`address` AS `address`,`users`.`code` AS `code`,`users`.`pin_code` AS `pin_code`,`users`.`remember_token` AS `remember_token`,`users`.`created_at` AS `created_at`,`users`.`updated_at` AS `updated_at`,`users`.`store_id` AS `store_id`,`users`.`is_active` AS `is_active` from (`store_users` join `users` on((`store_users`.`user_id` = `users`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_user_perms`
--
DROP TABLE IF EXISTS `vw_user_perms`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fz`@`localhost` SQL SECURITY DEFINER VIEW `vw_user_perms`  AS  select `users`.`id` AS `id`,`users`.`email` AS `email`,`model_has_permissions`.`permission_id` AS `permission_id`,`permissions`.`name` AS `name`,`permissions`.`guard_name` AS `guard_name` from ((`users` join `model_has_permissions` on((`users`.`id` = `model_has_permissions`.`model_id`))) join `permissions` on((`permissions`.`id` = `model_has_permissions`.`permission_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abandoned_carts`
--
ALTER TABLE `abandoned_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_store_id_foreign` (`store_id`),
  ADD KEY `articles_category_id_foreign` (`category_id`);

--
-- Indexes for table `articles_data`
--
ALTER TABLE `articles_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_data_article_id_foreign` (`article_id`),
  ADD KEY `articles_data_lang_id_foreign` (`lang_id`),
  ADD KEY `articles_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_category_store_id_foreign` (`store_id`);

--
-- Indexes for table `article_category_data`
--
ALTER TABLE `article_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_category_data_category_id_foreign` (`category_id`),
  ADD KEY `article_category_data_lang_id_foreign` (`lang_id`),
  ADD KEY `article_category_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_transfers_store_id_foreign` (`store_id`),
  ADD KEY `bank_transfers_lang_id_foreign` (`lang_id`),
  ADD KEY `bank_transfers_source_id_foreign` (`source_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_store_id_foreign` (`store_id`);

--
-- Indexes for table `banners_data`
--
ALTER TABLE `banners_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_data_banner_id_foreign` (`banner_id`),
  ADD KEY `banners_data_lang_id_foreign` (`lang_id`),
  ADD KEY `banners_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_lang_id_foreign` (`lang_id`),
  ADD KEY `brands_source_id_foreign` (`source_id`),
  ADD KEY `brands_store_id_foreign` (`store_id`);

--
-- Indexes for table `brands_data`
--
ALTER TABLE `brands_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_data_brand_id_foreign` (`brand_id`),
  ADD KEY `brands_data_lang_id_foreign` (`lang_id`),
  ADD KEY `brands_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_store_id_foreign` (`store_id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_language_id_foreign` (`lang_id`),
  ADD KEY `categories_source_id_foreign` (`source_id`);

--
-- Indexes for table `categories_products`
--
ALTER TABLE `categories_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_products_product_id_foreign` (`product_id`),
  ADD KEY `categories_products_category_id_foreign` (`category_id`);

--
-- Indexes for table `celebrates`
--
ALTER TABLE `celebrates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `celebrates_store_id_foreign` (`store_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `cities_shipping_options`
--
ALTER TABLE `cities_shipping_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_shipping_options_shipping_option_id_foreign` (`shipping_option_id`),
  ADD KEY `cities_shipping_options_city_id_foreign` (`city_id`);

--
-- Indexes for table `city_datas`
--
ALTER TABLE `city_datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`products_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_country_id_foreign` (`country_id`),
  ADD KEY `contacts_ibfk_1` (`store_id`);

--
-- Indexes for table `content_sections`
--
ALTER TABLE `content_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `content_sections_data`
--
ALTER TABLE `content_sections_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_sections_data_section_id_foreign` (`section_id`),
  ADD KEY `content_sections_data_lang_id_foreign` (`lang_id`),
  ADD KEY `content_sections_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_sections_products_content_section_id_foreign` (`content_section_id`),
  ADD KEY `content_sections_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `content_section_banners`
--
ALTER TABLE `content_section_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_section_banners_content_section_id_foreign` (`content_section_id`),
  ADD KEY `content_section_banners_banner_id_foreign` (`banner_id`);

--
-- Indexes for table `content_section_products`
--
ALTER TABLE `content_section_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `content_section_titles`
--
ALTER TABLE `content_section_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `content_section_titles_ibfk_2` (`section_id`);

--
-- Indexes for table `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries_data`
--
ALTER TABLE `countries_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_lang_id_foreign` (`lang_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_lang_id_foreign` (`lang_id`),
  ADD KEY `currencies_source_id_foreign` (`source_id`),
  ADD KEY `currencies_store_id_foreign` (`store_id`);

--
-- Indexes for table `currency_data`
--
ALTER TABLE `currency_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency_data_lang_id_foreign` (`lang_id`),
  ADD KEY `currency_data_currency_id_foreign` (`currency_id`),
  ADD KEY `currency_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `custom_design_options`
--
ALTER TABLE `custom_design_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_design_options_store_id_foreign` (`store_id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_codes_store_id_foreign` (`store_id`),
  ADD KEY `discount_codes_lang_id_foreign` (`lang_id`),
  ADD KEY `discount_codes_source_id_foreign` (`source_id`);

--
-- Indexes for table `discount_codes_data`
--
ALTER TABLE `discount_codes_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_codes_data_lang_id_foreign` (`lang_id`),
  ADD KEY `discount_codes_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `discount_codes_items`
--
ALTER TABLE `discount_codes_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_codes_items_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `discount_codes_target`
--
ALTER TABLE `discount_codes_target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_codes_target_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_store_id_foreign` (`store_id`),
  ADD KEY `email_user_id_foreign` (`user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`favoriteable_id`,`favoriteable_type`),
  ADD KEY `favorites_favoriteable_type_favoriteable_id_index` (`favoriteable_type`,`favoriteable_id`),
  ADD KEY `favorites_user_id_index` (`user_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `features_ibfk_1` (`product_id`);

--
-- Indexes for table `features_data`
--
ALTER TABLE `features_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `features_data_ibfk_1` (`feature_id`),
  ADD KEY `source_id` (`source_id`);

--
-- Indexes for table `feature_options`
--
ALTER TABLE `feature_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_options_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `feature_options_data`
--
ALTER TABLE `feature_options_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `feature_option_id` (`feature_option_id`);

--
-- Indexes for table `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `footers_lang_id_foreign` (`lang_id`),
  ADD KEY `footers_source_id_foreign` (`source_id`),
  ADD KEY `footers_store_id_foreign` (`store_id`),
  ADD KEY `footers_category_id_foreign` (`category_id`);

--
-- Indexes for table `footer_category`
--
ALTER TABLE `footer_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `footer_category_lang_id_foreign` (`lang_id`),
  ADD KEY `footer_category_source_id_foreign` (`source_id`),
  ADD KEY `footer_category_store_id_foreign` (`store_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_store_id_foreign` (`store_id`);

--
-- Indexes for table `groups_users`
--
ALTER TABLE `groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_users_group_id_foreign` (`group_id`),
  ADD KEY `groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lock_domain`
--
ALTER TABLE `lock_domain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketing_store_id_foreign` (`store_id`);

--
-- Indexes for table `marketing_users`
--
ALTER TABLE `marketing_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marketing_users_marketing_id_foreign` (`marketing_id`),
  ADD KEY `marketing_users_store_id_foreign` (`store_id`);

--
-- Indexes for table `master_samples`
--
ALTER TABLE `master_samples`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_samples_store_id_foreign` (`store_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberships_data`
--
ALTER TABLE `memberships_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberships_lang_id_foreign` (`lang_id`),
  ADD KEY `memberships_source_id_foreign` (`source_id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- Indexes for table `membership_options`
--
ALTER TABLE `membership_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_options_option_id_foreign` (`option_id`),
  ADD KEY `membership_options_ibfk_1` (`membership_id`);

--
-- Indexes for table `membership_options_category`
--
ALTER TABLE `membership_options_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_options_category_data`
--
ALTER TABLE `membership_options_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_options_category_data_categoty_id_foreign` (`category_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `membership_options_data`
--
ALTER TABLE `membership_options_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_options_data_option_id_foreign` (`option_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `membership_options_master`
--
ALTER TABLE `membership_options_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_options_master_categoty_id_foreign` (`category_id`);

--
-- Indexes for table `membership_option_perms`
--
ALTER TABLE `membership_option_perms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_option_perms_option_id_foreign` (`option_id`),
  ADD KEY `membership_option_perms_perm_id_foreign` (`perm_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ibfk_1` (`from`),
  ADD KEY `messages_ibfk_2` (`to`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_store_id_foreign` (`store_id`),
  ADD KEY `orders_shipping_option_id_foreign` (`shipping_option_id`),
  ADD KEY `orders_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `order_feature_options`
--
ALTER TABLE `order_feature_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_feature_options_order_id_foreign` (`order_id`),
  ADD KEY `order_feature_options_feature_option_id_foreign` (`feature_option_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_product_items`
--
ALTER TABLE `order_product_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_items_order_product_id_foreign` (`order_product_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status_datas`
--
ALTER TABLE `order_status_datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_datas_status_id_foreign` (`status_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `order_tracks`
--
ALTER TABLE `order_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_tracks_order_id_foreign` (`order_id`),
  ADD KEY `order_tracks_status_id_foreign` (`status_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_store_id_foreign` (`store_id`);

--
-- Indexes for table `pages_data`
--
ALTER TABLE `pages_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_data_page_id_foreign` (`page_id`),
  ADD KEY `pages_data_lang_id_foreign` (`lang_id`),
  ADD KEY `pages_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pending_orders`
--
ALTER TABLE `pending_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_data`
--
ALTER TABLE `permission_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_data_lang_id_foreign` (`lang_id`),
  ADD KEY `permission_data_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_store_id_foreign` (`store_id`),
  ADD KEY `products_product_type_foreign` (`product_type`);

--
-- Indexes for table `product_cards`
--
ALTER TABLE `product_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_cards_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_foreign` (`product_id`),
  ADD KEY `product_details_lang_id_foreign` (`lang_id`),
  ADD KEY `product_details_source_id_foreign` (`source_id`);

--
-- Indexes for table `product_digitals`
--
ALTER TABLE `product_digitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_digitals_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_donations`
--
ALTER TABLE `product_donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_donations_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_features_product_id_foreign` (`product_id`),
  ADD KEY `product_features_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_photos_product_id_foreign` (`product_id`),
  ADD KEY `product_photos_lang_id_foreign` (`lang_id`),
  ADD KEY `product_photos_source_id_foreign` (`source_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_types_store_id_foreign` (`store_id`),
  ADD KEY `product_types_type_code_foreign` (`type_code`);

--
-- Indexes for table `product_types_code`
--
ALTER TABLE `product_types_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types_code_data`
--
ALTER TABLE `product_types_code_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_types_cod_data_product_types_cod_id_foreign` (`product_types_cod_id`),
  ADD KEY `product_types_cod_data_lang_id_foreign` (`lang_id`),
  ADD KEY `product_types_cod_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `product_types_data`
--
ALTER TABLE `product_types_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_types_data_product_types_id_foreign` (`product_types_id`),
  ADD KEY `product_types_data_lang_id_foreign` (`lang_id`),
  ADD KEY `product_types_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_product_id_foreign` (`product_id`),
  ADD KEY `store_id` (`store_id`);

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
-- Indexes for table `role_store`
--
ALTER TABLE `role_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_store_role_id_foreign` (`role_id`),
  ADD KEY `role_store_store_id_foreign` (`store_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_store_id_foreign` (`store_id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `settings_data`
--
ALTER TABLE `settings_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_lang_id_foreign` (`lang_id`),
  ADD KEY `settings_source_id_foreign` (`source_id`),
  ADD KEY `settings_data_ibfk_2` (`setting_id`);

--
-- Indexes for table `shippings_address`
--
ALTER TABLE `shippings_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_address_store_id_foreign` (`store_id`),
  ADD KEY `shippings_address_country_id_foreign` (`country_id`),
  ADD KEY `shippings_address_city_id_foreign` (`city_id`),
  ADD KEY `shippings_address_order_id_foreign` (`order_id`);

--
-- Indexes for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_companies_store_id_foreign` (`store_id`),
  ADD KEY `shipping_companies_lang_id_foreign` (`lang_id`),
  ADD KEY `shipping_companies_source_id_foreign` (`source_id`);

--
-- Indexes for table `shipping_options`
--
ALTER TABLE `shipping_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_options_store_id_foreign` (`store_id`),
  ADD KEY `shipping_options_source_id_foreign` (`source_id`),
  ADD KEY `shipping_options_country_id_foreign` (`country_id`),
  ADD KEY `shipping_options_company_id_foreign` (`company_id`),
  ADD KEY `shipping_options_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `shipping_require`
--
ALTER TABLE `shipping_require`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_require_data`
--
ALTER TABLE `shipping_require_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_types`
--
ALTER TABLE `shipping_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_types_store_id_foreign` (`store_id`),
  ADD KEY `shipping_types_shipping_option_id_foreign` (`shipping_option_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_store_id_foreign` (`store_id`);

--
-- Indexes for table `sliders_data`
--
ALTER TABLE `sliders_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_data_slider_id_foreign` (`slider_id`),
  ADD KEY `sliders_data_lang_id_foreign` (`lang_id`),
  ADD KEY `sliders_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_store_id_foreign` (`store_id`),
  ADD KEY `sms_user_id_foreign` (`user_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_lang_id_foreign` (`lang_id`),
  ADD KEY `stores_source_id_foreign` (`source_id`),
  ADD KEY `stores_owner_id_foreign` (`owner_id`),
  ADD KEY `stores_membership_id_foreign` (`membership_id`);

--
-- Indexes for table `store_currencies`
--
ALTER TABLE `store_currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_currencies_store_id_foreign` (`store_id`),
  ADD KEY `store_currencies_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `store_homepages`
--
ALTER TABLE `store_homepages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_homepages_category_id_foreign` (`category_id`),
  ADD KEY `store_homepages_store_id_foreign` (`store_id`);

--
-- Indexes for table `store_languages`
--
ALTER TABLE `store_languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_languages_store_id_foreign` (`store_id`),
  ADD KEY `store_languages_language_id_foreign` (`language_id`);

--
-- Indexes for table `store_payments`
--
ALTER TABLE `store_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_users`
--
ALTER TABLE `store_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_users_user_id_foreign` (`user_id`),
  ADD KEY `store_users_store_id_foreign` (`store_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_data`
--
ALTER TABLE `template_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_data_lang_id_foreign` (`lang_id`),
  ADD KEY `template_data_template_id_foreign` (`template_id`),
  ADD KEY `template_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_admin_id_foreign` (`admin_id`),
  ADD KEY `tickets_agent_id_foreign` (`agent_id`),
  ADD KEY `tickets_category_id_foreign` (`category_id`),
  ADD KEY `tickets_priority_id_foreign` (`priority_id`),
  ADD KEY `tickets_lang_id_foreign` (`lang_id`),
  ADD KEY `tickets_source_id_foreign` (`source_id`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_categories_lang_id_foreign` (`lang_id`),
  ADD KEY `ticket_categories_source_id_foreign` (`source_id`);

--
-- Indexes for table `ticket_category_users`
--
ALTER TABLE `ticket_category_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_category_users_category_id_foreign` (`category_id`),
  ADD KEY `ticket_category_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_comments_admin_id_foreign` (`admin_id`),
  ADD KEY `ticket_comments_user_id_foreign` (`user_id`),
  ADD KEY `ticket_comments_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_priorities_lang_id_foreign` (`lang_id`),
  ADD KEY `ticket_priorities_source_id_foreign` (`source_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `transactions_lang_id_foreign` (`lang_id`),
  ADD KEY `transactions_source_id_foreign` (`source_id`),
  ADD KEY `transactions_type_id_foreign` (`type_id`),
  ADD KEY `transactions_bank_id_foreign` (`bank_id`),
  ADD KEY `transactions_store_id_foreign` (`store_id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_types_lang_id_foreign` (`lang_id`),
  ADD KEY `transaction_types_source_id_foreign` (`source_id`),
  ADD KEY `transaction_types_store_id_foreign` (`store_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_store_id_foreign` (`store_id`);

--
-- Indexes for table `user_membership`
--
ALTER TABLE `user_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_membership_user_id_foreign` (`user_id`),
  ADD KEY `user_membership_membership_id_foreign` (`membership_id`);

--
-- Indexes for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rating_user_id_foreign` (`user_id`),
  ADD KEY `user_rating_rating_id_foreign` (`rating_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_store_id_foreign` (`store_id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_banners_data`
--
ALTER TABLE `_banners_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_lang_id_foreign` (`lang_id`),
  ADD KEY `banners_source_id_foreign` (`source_id`),
  ADD KEY `banners_data_ibfk_2` (`banner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abandoned_carts`
--
ALTER TABLE `abandoned_carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `articles_data`
--
ALTER TABLE `articles_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `article_category_data`
--
ALTER TABLE `article_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `banners_data`
--
ALTER TABLE `banners_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brands_data`
--
ALTER TABLE `brands_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;
--
-- AUTO_INCREMENT for table `categories_products`
--
ALTER TABLE `categories_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `celebrates`
--
ALTER TABLE `celebrates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;
--
-- AUTO_INCREMENT for table `cities_shipping_options`
--
ALTER TABLE `cities_shipping_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city_datas`
--
ALTER TABLE `city_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `content_sections`
--
ALTER TABLE `content_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `content_sections_data`
--
ALTER TABLE `content_sections_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `content_section_banners`
--
ALTER TABLE `content_section_banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `content_section_products`
--
ALTER TABLE `content_section_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content_section_titles`
--
ALTER TABLE `content_section_titles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `countries_data`
--
ALTER TABLE `countries_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currency_data`
--
ALTER TABLE `currency_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_design_options`
--
ALTER TABLE `custom_design_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `discount_codes_data`
--
ALTER TABLE `discount_codes_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discount_codes_items`
--
ALTER TABLE `discount_codes_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `discount_codes_target`
--
ALTER TABLE `discount_codes_target`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `features_data`
--
ALTER TABLE `features_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `feature_options`
--
ALTER TABLE `feature_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `feature_options_data`
--
ALTER TABLE `feature_options_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `footers`
--
ALTER TABLE `footers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `footer_category`
--
ALTER TABLE `footer_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups_users`
--
ALTER TABLE `groups_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lock_domain`
--
ALTER TABLE `lock_domain`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `marketing`
--
ALTER TABLE `marketing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marketing_users`
--
ALTER TABLE `marketing_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_samples`
--
ALTER TABLE `master_samples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `memberships_data`
--
ALTER TABLE `memberships_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `membership_options`
--
ALTER TABLE `membership_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;
--
-- AUTO_INCREMENT for table `membership_options_category`
--
ALTER TABLE `membership_options_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `membership_options_category_data`
--
ALTER TABLE `membership_options_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `membership_options_data`
--
ALTER TABLE `membership_options_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `membership_options_master`
--
ALTER TABLE `membership_options_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `membership_option_perms`
--
ALTER TABLE `membership_option_perms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_feature_options`
--
ALTER TABLE `order_feature_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_product_items`
--
ALTER TABLE `order_product_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_status_datas`
--
ALTER TABLE `order_status_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_tracks`
--
ALTER TABLE `order_tracks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pages_data`
--
ALTER TABLE `pages_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pending_orders`
--
ALTER TABLE `pending_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT for table `permission_data`
--
ALTER TABLE `permission_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=549;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `product_cards`
--
ALTER TABLE `product_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `product_digitals`
--
ALTER TABLE `product_digitals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_donations`
--
ALTER TABLE `product_donations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `product_types_code`
--
ALTER TABLE `product_types_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_types_code_data`
--
ALTER TABLE `product_types_code_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_types_data`
--
ALTER TABLE `product_types_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `role_store`
--
ALTER TABLE `role_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `settings_data`
--
ALTER TABLE `settings_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `shippings_address`
--
ALTER TABLE `shippings_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `shipping_options`
--
ALTER TABLE `shipping_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_require`
--
ALTER TABLE `shipping_require`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_require_data`
--
ALTER TABLE `shipping_require_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_types`
--
ALTER TABLE `shipping_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sliders_data`
--
ALTER TABLE `sliders_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `store_currencies`
--
ALTER TABLE `store_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_homepages`
--
ALTER TABLE `store_homepages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store_languages`
--
ALTER TABLE `store_languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_payments`
--
ALTER TABLE `store_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_users`
--
ALTER TABLE `store_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `template_data`
--
ALTER TABLE `template_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ticket_category_users`
--
ALTER TABLE `ticket_category_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `user_membership`
--
ALTER TABLE `user_membership`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `_banners_data`
--
ALTER TABLE `_banners_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `abandoned_carts`
--
ALTER TABLE `abandoned_carts`
  ADD CONSTRAINT `abandoned_carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `abandoned_carts_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `abandoned_carts_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles_data`
--
ALTER TABLE `articles_data`
  ADD CONSTRAINT `articles_data_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `articles_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_category_data`
--
ALTER TABLE `article_category_data`
  ADD CONSTRAINT `article_category_data_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_category_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_category_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `article_category_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD CONSTRAINT `bank_transfers_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_transfers_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `bank_transfers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_transfers_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banners_data`
--
ALTER TABLE `banners_data`
  ADD CONSTRAINT `banners_data_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banners_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banners_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `banners_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brands_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brands_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brands_data`
--
ALTER TABLE `brands_data`
  ADD CONSTRAINT `brands_data_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brands_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `brands_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `brands_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_language_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `categories_products`
--
ALTER TABLE `categories_products`
  ADD CONSTRAINT `categories_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `celebrates`
--
ALTER TABLE `celebrates`
  ADD CONSTRAINT `celebrates_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities_shipping_options`
--
ALTER TABLE `cities_shipping_options`
  ADD CONSTRAINT `cities_shipping_options_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cities_shipping_options_shipping_option_id_foreign` FOREIGN KEY (`shipping_option_id`) REFERENCES `shipping_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city_datas`
--
ALTER TABLE `city_datas`
  ADD CONSTRAINT `city_datas_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `city_datas_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries_data` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_sections`
--
ALTER TABLE `content_sections`
  ADD CONSTRAINT `content_sections_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `content_sections_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `content_sections_data`
--
ALTER TABLE `content_sections_data`
  ADD CONSTRAINT `content_sections_data_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `content_sections_data_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `content_sections_products`
--
ALTER TABLE `content_sections_products`
  ADD CONSTRAINT `content_sections_products_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_sections_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_section_banners`
--
ALTER TABLE `content_section_banners`
  ADD CONSTRAINT `content_section_banners_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_section_banners_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_section_products`
--
ALTER TABLE `content_section_products`
  ADD CONSTRAINT `content_section_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `content_section_products_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `content_section_titles`
--
ALTER TABLE `content_section_titles`
  ADD CONSTRAINT `content_section_titles_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `content_section_titles_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `countries_data`
--
ALTER TABLE `countries_data`
  ADD CONSTRAINT `countries_data_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `countries_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `currencies_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `currencies_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `currency_data`
--
ALTER TABLE `currency_data`
  ADD CONSTRAINT `currency_data_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `currency_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `currency_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `currency_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custom_design_options`
--
ALTER TABLE `custom_design_options`
  ADD CONSTRAINT `custom_design_options_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD CONSTRAINT `discount_codes_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discount_codes_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `discount_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discount_codes_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount_codes_data`
--
ALTER TABLE `discount_codes_data`
  ADD CONSTRAINT `discount_codes_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `store_languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discount_codes_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `discount_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount_codes_items`
--
ALTER TABLE `discount_codes_items`
  ADD CONSTRAINT `discount_codes_items_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discount_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discount_codes_target`
--
ALTER TABLE `discount_codes_target`
  ADD CONSTRAINT `discount_codes_target_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discount_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `email_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `features_data`
--
ALTER TABLE `features_data`
  ADD CONSTRAINT `features_data_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `features_data_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `features_data_ibfk_3` FOREIGN KEY (`source_id`) REFERENCES `features_data` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_options`
--
ALTER TABLE `feature_options`
  ADD CONSTRAINT `feature_options_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_options_data`
--
ALTER TABLE `feature_options_data`
  ADD CONSTRAINT `feature_options_data_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `feature_options_data_ibfk_3` FOREIGN KEY (`feature_option_id`) REFERENCES `feature_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `footers`
--
ALTER TABLE `footers`
  ADD CONSTRAINT `footers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `footer_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `footers_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `footers_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `footers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `footers_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `footer_category`
--
ALTER TABLE `footer_category`
  ADD CONSTRAINT `footer_category_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `footer_category_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `footer_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `footer_category_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups_users`
--
ALTER TABLE `groups_users`
  ADD CONSTRAINT `groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marketing`
--
ALTER TABLE `marketing`
  ADD CONSTRAINT `marketing_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marketing_users`
--
ALTER TABLE `marketing_users`
  ADD CONSTRAINT `marketing_users_marketing_id_foreign` FOREIGN KEY (`marketing_id`) REFERENCES `marketing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marketing_users_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_samples`
--
ALTER TABLE `master_samples`
  ADD CONSTRAINT `master_samples_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership_options`
--
ALTER TABLE `membership_options`
  ADD CONSTRAINT `membership_options_ibfk_1` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `membership_options_category_data`
--
ALTER TABLE `membership_options_category_data`
  ADD CONSTRAINT `membership_options_category_data_categoty_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `membership_options_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membership_options_category_data_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `membership_options_data`
--
ALTER TABLE `membership_options_data`
  ADD CONSTRAINT `membership_options_data_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `membership_options_data_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `membership_options_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership_options_master`
--
ALTER TABLE `membership_options_master`
  ADD CONSTRAINT `membership_options_master_categoty_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `membership_options_category` (`id`);

--
-- Constraints for table `membership_option_perms`
--
ALTER TABLE `membership_option_perms`
  ADD CONSTRAINT `membership_option_perms_ibfk_1` FOREIGN KEY (`perm_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `membership_option_perms_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `membership_options_master` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `orders_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discount_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_shipping_option_id_foreign` FOREIGN KEY (`shipping_option_id`) REFERENCES `shipping_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_feature_options`
--
ALTER TABLE `order_feature_options`
  ADD CONSTRAINT `order_feature_options_feature_option_id_foreign` FOREIGN KEY (`feature_option_id`) REFERENCES `order_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_feature_options_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product_items`
--
ALTER TABLE `order_product_items`
  ADD CONSTRAINT `order_product_items_order_product_id_foreign` FOREIGN KEY (`order_product_id`) REFERENCES `order_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_status_datas`
--
ALTER TABLE `order_status_datas`
  ADD CONSTRAINT `order_status_datas_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `order_status_datas_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_tracks`
--
ALTER TABLE `order_tracks`
  ADD CONSTRAINT `order_tracks_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_tracks_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages_data`
--
ALTER TABLE `pages_data`
  ADD CONSTRAINT `pages_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pages_data_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pages_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `pages_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_data`
--
ALTER TABLE `permission_data`
  ADD CONSTRAINT `permission_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_data_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `permission_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_type_foreign` FOREIGN KEY (`product_type`) REFERENCES `product_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_cards`
--
ALTER TABLE `product_cards`
  ADD CONSTRAINT `product_cards_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `product_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_digitals`
--
ALTER TABLE `product_digitals`
  ADD CONSTRAINT `product_digitals_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_donations`
--
ALTER TABLE `product_donations`
  ADD CONSTRAINT `product_donations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_features`
--
ALTER TABLE `product_features`
  ADD CONSTRAINT `product_features_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_features_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD CONSTRAINT `product_photos_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_photos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_photos_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `product_photos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_types`
--
ALTER TABLE `product_types`
  ADD CONSTRAINT `product_types_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_types_type_code_foreign` FOREIGN KEY (`type_code`) REFERENCES `product_types_code` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_types_code_data`
--
ALTER TABLE `product_types_code_data`
  ADD CONSTRAINT `product_types_cod_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_types_cod_data_product_types_cod_id_foreign` FOREIGN KEY (`product_types_cod_id`) REFERENCES `product_types_code` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_types_cod_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `product_types_code_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_types_data`
--
ALTER TABLE `product_types_data`
  ADD CONSTRAINT `product_types_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_types_data_product_types_id_foreign` FOREIGN KEY (`product_types_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_types_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `product_types_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`),
  ADD CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_store`
--
ALTER TABLE `role_store`
  ADD CONSTRAINT `role_store_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_store_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`),
  ADD CONSTRAINT `settings_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `settings_data`
--
ALTER TABLE `settings_data`
  ADD CONSTRAINT `settings_data_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `settings_data_ibfk_2` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings_address`
--
ALTER TABLE `shippings_address`
  ADD CONSTRAINT `shippings_address_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shippings_address_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries_data` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shippings_address_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shippings_address_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping_companies`
--
ALTER TABLE `shipping_companies`
  ADD CONSTRAINT `shipping_companies_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `store_languages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_companies_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `shipping_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_companies_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping_options`
--
ALTER TABLE `shipping_options`
  ADD CONSTRAINT `shipping_options_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `shipping_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_options_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_options_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `store_languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_options_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `shipping_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_options_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping_types`
--
ALTER TABLE `shipping_types`
  ADD CONSTRAINT `shipping_types_shipping_option_id_foreign` FOREIGN KEY (`shipping_option_id`) REFERENCES `shipping_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_types_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sliders_data`
--
ALTER TABLE `sliders_data`
  ADD CONSTRAINT `sliders_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sliders_data_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sliders_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `banners_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sms`
--
ALTER TABLE `sms`
  ADD CONSTRAINT `sms_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stores_membership_id_foreign` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stores_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stores_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_currencies`
--
ALTER TABLE `store_currencies`
  ADD CONSTRAINT `store_currencies_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `store_currencies_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_homepages`
--
ALTER TABLE `store_homepages`
  ADD CONSTRAINT `store_homepages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `store_homepages_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_languages`
--
ALTER TABLE `store_languages`
  ADD CONSTRAINT `store_languages_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `store_languages_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_users`
--
ALTER TABLE `store_users`
  ADD CONSTRAINT `store_users_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `store_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_data`
--
ALTER TABLE `template_data`
  ADD CONSTRAINT `template_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `template_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `template_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `template_data_template_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `ticket_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `ticket_priorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD CONSTRAINT `ticket_categories_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_categories_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `ticket_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_category_users`
--
ALTER TABLE `ticket_category_users`
  ADD CONSTRAINT `ticket_category_users_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `ticket_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_category_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD CONSTRAINT `ticket_comments_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  ADD CONSTRAINT `ticket_priorities_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_priorities_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `ticket_priorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank_transfers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `store_languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `transaction_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD CONSTRAINT `transaction_types_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_types_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `transaction_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_types_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_membership`
--
ALTER TABLE `user_membership`
  ADD CONSTRAINT `user_membership_membership_id_foreign` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_membership_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD CONSTRAINT `user_rating_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`),
  ADD CONSTRAINT `user_rating_rating_id_foreign` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rating_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_banners_data`
--
ALTER TABLE `_banners_data`
  ADD CONSTRAINT `_banners_data_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `_banners_data_ibfk_2` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
