-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2019 at 09:14 AM
-- Server version: 10.2.27-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joudacademy_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(10) UNSIGNED NOT NULL,
  `personal_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_level` int(10) UNSIGNED DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `website` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `personal_id`, `education_level`, `address`, `user_id`, `country_id`, `grade`, `dob`, `gender`, `website`, `created_at`, `updated_at`) VALUES
(2, NULL, 2, 'cairo', 2, 3, 'student', NULL, NULL, 0, '2019-10-12 08:22:05', '2019-10-12 08:22:05'),
(3, NULL, 3, 'cairo', 3, 1, 'student', NULL, NULL, 0, '2019-10-12 10:05:18', '2019-10-12 10:05:18'),
(4, NULL, 2, NULL, 5, 1, 'master', NULL, NULL, 0, '2019-10-16 09:55:02', '2019-10-16 09:55:02'),
(5, NULL, 2, 'kanal elswis 49 St', 6, 1, 'ثانوي', NULL, NULL, 0, '2019-10-16 12:03:43', '2019-10-16 12:03:43'),
(7, NULL, 3, 'cairo', 9, 1, 'student', NULL, NULL, 0, '2019-10-17 06:47:24', '2019-10-17 06:47:24'),
(9, NULL, 5, 'cairo', 11, 1, 'student', NULL, NULL, 0, '2019-10-17 09:36:24', '2019-10-17 09:36:24'),
(10, NULL, 5, 'cairo', 12, 1, 'student', NULL, NULL, 0, '2019-10-17 09:38:15', '2019-10-17 09:38:15'),
(11, NULL, NULL, 'egypt', 13, 1, NULL, NULL, NULL, 0, '2019-10-17 09:43:13', '2019-10-17 09:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_course`
--

CREATE TABLE `applicant_course` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `applicant_id` int(10) UNSIGNED DEFAULT NULL,
  `cost` double(8,2) NOT NULL DEFAULT 0.00,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `created` date DEFAULT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cert_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_course_pendings`
--

CREATE TABLE `applicant_course_pendings` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `applicant_id` int(10) UNSIGNED NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `coupon_id` int(10) UNSIGNED DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality_id` int(10) UNSIGNED DEFAULT NULL,
  `holder_name` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicant_course_pendings`
--

INSERT INTO `applicant_course_pendings` (`id`, `course_id`, `applicant_id`, `cost`, `amount`, `coupon_id`, `is_paid`, `created`, `transaction_id`, `transaction_type`, `nationality_id`, `holder_name`, `created_at`, `updated_at`) VALUES
(8, 1, 5, 150.00, 1.00, NULL, 0, '2019-10-17 12:23:58', '1', '1', NULL, '1', '2019-10-17 10:23:58', '2019-10-17 10:23:58'),
(9, 1, 5, 150.00, 1.00, NULL, 0, '2019-10-18 00:48:54', '1', '1', NULL, '1', '2019-10-17 22:48:54', '2019-10-17 22:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_results`
--

CREATE TABLE `applicant_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `applicant_id` int(10) UNSIGNED DEFAULT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artcl_categories`
--

CREATE TABLE `artcl_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) DEFAULT 0,
  `img_url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artcl_categories`
--

INSERT INTO `artcl_categories` (`id`, `source_id`, `lang_id`, `title`, `published`, `img_url`, `created`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'article category 1', 1, '1.png', '2019-10-12', '2019-10-12 06:11:32', '2019-10-12 06:14:56'),
(8, NULL, 2, 'اخر الاخبار', 1, NULL, '2019-10-16', '2019-10-16 09:56:55', '2019-10-16 09:56:55'),
(9, NULL, 2, 'كيميا', 1, 'user7-128x128.jpg', '2019-10-16', '2019-10-16 09:57:13', '2019-10-16 18:24:26'),
(10, NULL, 2, 'طبي', 1, NULL, '2019-10-16', '2019-10-16 09:57:47', '2019-10-16 09:57:47'),
(11, NULL, 2, 'عام', 1, 'avatar5.png', '2019-10-16', '2019-10-16 17:49:37', '2019-10-16 17:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(1) DEFAULT 0,
  `created` date DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `img_url`, `content`, `published`, `created`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'article 1', 'Header-Image.png', '<p>article 1 english&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;</p>', 1, '2019-10-16', 1, NULL, '2019-10-12 06:15:34', '2019-10-16 16:44:48'),
(2, 9, 'إيبسوم إيبسوم إيبسوم', 'user6-128x128.jpg', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>\r\n\r\n<p>&nbsp;</p>', 1, '2019-12-31', 2, NULL, '2019-10-16 10:01:29', '2019-10-16 18:36:52'),
(3, 9, 'السياحة في جورجيا', '68528650_1847209798715909_3516711078706806784_n.jpg', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', 1, '2019-12-31', 2, NULL, '2019-10-16 10:02:28', '2019-10-16 10:02:28'),
(4, 10, 'السياحة في كاندي', 'cover.jpg', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>\r\n\r\n<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', 1, '2019-01-02', 2, NULL, '2019-10-16 10:03:46', '2019-10-16 10:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `category_id`, `article_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-10-12 06:15:34', '2019-10-12 06:15:34'),
(2, 9, 2, '2019-10-16 10:01:29', '2019-10-16 18:36:52'),
(3, 9, 3, '2019-10-16 10:02:28', '2019-10-16 10:02:28'),
(4, 10, 4, '2019-10-16 10:03:46', '2019-10-16 10:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `article_data`
--

CREATE TABLE `article_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_data`
--

INSERT INTO `article_data` (`id`, `source_id`, `lang_id`, `title`, `content`, `created`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'article 1', '<p>article 1 english&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;&nbsp;article 1 english&nbsp;</p>', '2019-10-16', '2019-10-12 06:15:34', '2019-10-12 06:15:34'),
(2, 2, 2, 'إيبسوم إيبسوم إيبسوم', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>\r\n\r\n<p>&nbsp;</p>', '2019-12-31', '2019-10-16 10:01:29', '2019-10-16 18:36:52'),
(3, 3, 2, 'السياحة في جورجيا', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', '2019-12-31', '2019-10-16 10:02:28', '2019-10-16 10:02:28'),
(4, 4, 2, 'السياحة في كاندي', '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>\r\n\r\n<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', '2019-01-02', '2019-10-16 10:03:46', '2019-10-16 10:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfers`
--

CREATE TABLE `bank_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `user_id`, `status`, `title`, `description`, `total`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 'paid', 'paid online', '100', 2, '2019-10-14 10:31:11', '2019-10-14 12:11:16'),
(2, 3, 2, 'tooo', 'tooo in house', '500', 2, '2019-10-14 10:48:49', '2019-10-14 10:48:49'),
(3, 5, 2, 'السياحة في جورجيا', 'asdasdsadasd', '50', 3, '2019-10-16 10:34:14', '2019-10-16 10:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `country_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 1, 1, NULL, '2019-10-16 17:41:30', '2019-10-16 17:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE `competition` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `exam_id` int(10) UNSIGNED DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`id`, `is_active`, `exam_id`, `created`, `start`, `end`) VALUES
(2, 1, 1, '2019-10-14 11:11:38', '2019-09-30', '2019-10-31'),
(3, 1, 2, '2019-10-16 11:15:09', '2019-10-10', '2019-10-20'),
(4, 1, 3, '2019-10-16 11:40:41', '2019-12-31', '2019-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `code`, `logo`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', '11', NULL, 1, NULL, '2019-10-10 08:37:58', '2019-10-10 08:37:58'),
(3, 'ksa', '56', '4.png', 2, NULL, '2019-10-12 06:18:50', '2019-10-12 06:18:50'),
(4, 'الامارات', '011', 'travveo- white.jpg', 2, NULL, '2019-10-16 09:52:01', '2019-10-16 09:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `countries_courses`
--

CREATE TABLE `countries_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries_courses`
--

INSERT INTO `countries_courses` (`id`, `country_id`, `course_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2019-10-13 06:53:18', '2019-10-13 06:53:18'),
(8, 1, 2, '2019-10-13 09:02:43', '2019-10-13 09:02:43'),
(9, 3, 2, '2019-10-13 09:02:43', '2019-10-13 09:02:43'),
(17, 1, 3, '2019-10-16 11:35:13', '2019-10-16 11:35:13'),
(18, 3, 3, '2019-10-16 11:35:13', '2019-10-16 11:35:13'),
(19, 1, 4, '2019-10-16 12:21:29', '2019-10-16 12:21:29'),
(20, 3, 4, '2019-10-16 12:21:29', '2019-10-16 12:21:29'),
(21, 4, 4, '2019-10-16 12:21:29', '2019-10-16 12:21:29'),
(22, 1, 5, '2019-10-17 03:48:16', '2019-10-17 03:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `in_company` tinyint(1) NOT NULL DEFAULT 0,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(8,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `user_id`, `currency_id`, `in_company`, `start_date`, `end_date`, `duration`, `img`, `video`, `cost`, `is_active`, `lang_id`, `source_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'vueJs', 1, 2, 0, '2019-09-30', '2019-12-31', '50', 'ayurveda-is-an-ancient-healing-art.png', 'mov_bbb.mp4', 150.00, 1, 1, NULL, '<p>vue js course</p>', NULL, NULL),
(2, 'python', 1, 2, 0, '2019-09-30', '2019-12-31', '150', 'UpComing-BigImage.png', 'mov_bbb.mp4', 500.00, 0, 1, NULL, '<p>python course</p>', NULL, NULL),
(3, 'السياحة في جورجيا', 1, 2, 0, '2019-09-15', '2020-12-01', '3', 'Screen Shot 2019-10-01 at 1.23.44 PM.png', NULL, 1000.00, 1, 2, NULL, '<p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم في صناعات المطابع ودور النشر. كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير في ستينيّات هذا القرن مع إصدار رقائق &quot;ليتراسيت&quot; (Letraset) البلاستيكية تحوي مقاطع من هذا النص، وعاد لينتشر مرة أخرى مؤخراَ مع ظهور برامج النشر الإلكتروني مثل &quot;ألدوس بايج مايكر&quot; (Aldus PageMaker) والتي حوت أيضاً على نسخ من نص لوريم إيبسوم.</p>', NULL, NULL),
(4, 'laravel', 1, 2, 0, '2019-10-31', '2019-12-31', '50', 'ayurveda-is-an-ancient-healing-art.png', 'mov_bbb.mp4', 150.00, 0, 1, NULL, '<p>laravel course</p>', NULL, NULL),
(5, 'ميكانيكا', 1, 3, 0, '2019-10-25', '2019-10-31', '14', 'user6-128x128.jpg', 'file_example_MP4_640_3MG.mp4', 700.00, 0, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_comments`
--

CREATE TABLE `course_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `approve` tinyint(1) DEFAULT 0,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_evaluations`
--

CREATE TABLE `course_evaluations` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicant_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_media`
--

CREATE TABLE `course_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `cost` decimal(8,2) DEFAULT 0.00,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_media`
--

INSERT INTO `course_media` (`id`, `course_id`, `currency_id`, `is_active`, `cost`, `img`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 100.00, 'Screen Shot 2019-10-09 at 9.34.30 AM.png', 'ترافيو كوم سكريبت.mp3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_media_data`
--

CREATE TABLE `course_media_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `media_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_media_data`
--

INSERT INTO `course_media_data` (`id`, `media_id`, `title`, `lang_id`, `source_id`, `description`, `created_at`, `updated_at`) VALUES
(5, 1, 'sdsd', 2, NULL, NULL, '2019-10-16 12:16:49', '2019-10-16 12:16:49'),
(6, 1, 'asdasd', 1, 5, '<p>sdasda</p>', '2019-10-16 12:16:49', '2019-10-16 12:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `course_media_tags`
--

CREATE TABLE `course_media_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_requests`
--

CREATE TABLE `course_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED NOT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_requests`
--

INSERT INTO `course_requests` (`id`, `user_id`, `title`, `description`, `response`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'laravel', 'laravel  course', 'thanks for your patient', 1, NULL, '2019-10-12 09:39:14', '2019-10-12 09:40:25'),
(2, 6, 'دوه تصميم', 'مطلوب دوره تصميم', NULL, 1, NULL, '2019-10-16 19:47:36', '2019-10-16 19:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `co_categories`
--

CREATE TABLE `co_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `co_categories`
--

INSERT INTO `co_categories` (`id`, `cat_name`, `parent_id`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(3, 'medicine', NULL, 1, NULL, '2019-10-10 08:39:47', '2019-10-10 08:39:47'),
(4, 'bio', 3, 1, NULL, '2019-10-10 08:40:03', '2019-10-10 08:40:03'),
(6, 'محاسبة', NULL, 2, NULL, '2019-10-16 10:22:34', '2019-10-16 10:22:34'),
(7, 'رياضه', NULL, 2, NULL, '2019-10-16 10:22:53', '2019-10-16 10:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `co_category_course`
--

CREATE TABLE `co_category_course` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `co_category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `co_category_course`
--

INSERT INTO `co_category_course` (`id`, `course_id`, `co_category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 3, 6, NULL, NULL),
(4, 4, 7, NULL, NULL),
(5, 5, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `title`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(2, 'EG', 1, NULL, '2019-10-10 08:37:00', '2019-10-10 08:37:00'),
(3, 'dollar', 1, NULL, '2019-10-16 09:34:35', '2019-10-16 09:34:35'),
(4, 'ج م', 2, NULL, '2019-10-16 09:34:51', '2019-10-16 17:17:55'),
(5, 'sar', 2, NULL, '2019-10-16 09:37:16', '2019-10-16 09:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Name',
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `created` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education_levels`
--

CREATE TABLE `education_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education_levels`
--

INSERT INTO `education_levels` (`id`, `title`, `country_id`, `lang_id`, `source_id`, `description`, `created_at`, `updated_at`) VALUES
(2, 'first level', 1, 1, NULL, 'errrrrrrrrr', '2019-10-10 08:41:23', '2019-10-10 08:41:23'),
(3, 'second level', 1, 1, NULL, 'ffffffffffff', '2019-10-10 08:41:42', '2019-10-10 08:41:42'),
(5, 'lستوي تعليمي ٥', 1, 2, NULL, 'يبسيبسيب', '2019-10-16 11:16:17', '2019-10-16 11:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `duration` smallint(6) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `type`, `type_id`, `duration`, `is_active`, `created`, `start`, `end`) VALUES
(1, 'course', 1, 50, 1, '2019-10-14 09:03:52', '2019-10-13', '2019-10-15'),
(2, 'course', 2, 50, 1, '2019-10-14 08:20:01', '2019-10-13', '2019-10-14'),
(3, 'course', 1, 3, 1, '2019-10-16 11:25:18', '2019-12-31', '2019-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `exam_data`
--

CREATE TABLE `exam_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_data`
--

INSERT INTO `exam_data` (`id`, `title`, `exam_id`, `description`, `lang_id`, `created_at`, `updated_at`) VALUES
(17, 'اختبار_1', 2, 'اختبار_1', 2, NULL, NULL),
(18, 'exam_1', 2, 'exam_1', 1, NULL, NULL),
(23, 'اختبار 1', 1, 'اختبار 1', 2, NULL, NULL),
(24, 'exam 1', 1, 'exam 1', 1, NULL, NULL),
(25, 'كراء السيارات بمراكش', 3, 'يبسيبسيب', 2, NULL, NULL),
(26, 'Car renting in Marrakech', 3, 'بلييبلبلبليب', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `score` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `title`, `exam_id`, `source_id`, `score`, `lang_id`, `created_at`, `updated_at`) VALUES
(21, 'تيست', 2, NULL, '10', 2, '2019-10-14 06:20:02', '2019-10-14 06:20:02'),
(22, 'test', 2, 21, '10', 1, '2019-10-14 06:20:02', '2019-10-14 06:20:02'),
(33, 'سؤال 1', 1, NULL, '5', 2, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(34, 'question 1', 1, 33, '5', 1, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(35, 'سؤال 2', 1, NULL, '10', 2, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(36, 'question 2', 1, 35, '10', 1, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(37, 'question 3', 1, NULL, '15', 2, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(38, 'question 3', 1, 37, '15', 1, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(39, 'question 4', 1, NULL, '20', 2, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(40, 'question 4', 1, 39, '20', 1, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(41, 'question 5', 1, NULL, '25', 2, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(42, 'question 5', 1, 41, '25', 1, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(43, 'question 6', 1, NULL, '15', 2, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(44, 'question 6', 1, 43, '15', 1, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(45, 'question 7', 1, NULL, '10', 2, '2019-10-14 07:05:28', '2019-10-14 07:05:28'),
(46, 'question 7', 1, 45, '10', 1, '2019-10-14 07:05:28', '2019-10-14 07:05:28');

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
(6, 'App\\Hr\\Course\\Course', 3, '2019-10-17 09:21:58', '2019-10-17 09:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `href` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(4) DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `lang_id`, `source_id`, `href`, `published`, `created`, `created_at`, `updated_at`) VALUES
(2, 'english gallery 1', 1, NULL, 'http://localhost/joud/public/admin/gallery/all', 1, '2019-10-10 11:34:54', '2019-10-10 09:34:54', '2019-10-10 09:34:54'),
(3, 'arabic gallary', 2, NULL, 'http://localhost/joud/public/admin/gallery/all', 1, '2019-10-12 07:54:24', '2019-10-12 05:54:24', '2019-10-12 05:54:24'),
(4, 'السياحة في كاندي', 2, NULL, 'https://www.moroccorent.net/', 1, '2019-10-16 12:30:22', '2019-10-16 10:30:22', '2019-10-16 10:30:22'),
(5, 'كراء السيارات في مكناس المغرب', 2, NULL, 'https://www.moroccorent.net/', 1, '2019-10-16 12:31:05', '2019-10-16 10:31:05', '2019-10-16 10:31:05');

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
(1, 'English', 'en', NULL, NULL, NULL, NULL),
(2, 'Arabic', 'ar', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL,
  `to_id` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` bigint(20) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_id`, `to_id`, `message`, `message_id`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'nice content but please activate my subscribion', NULL, '2019-10-17 10:21:11', '2019-10-12 09:41:09', '2019-10-17 10:21:11'),
(2, 3, 1, 'wowowowo', NULL, NULL, '2019-10-12 10:05:52', '2019-10-12 10:05:52'),
(3, 1, 3, 'thank you', 2, '2019-10-13 05:57:22', '2019-10-12 10:09:26', '2019-10-13 05:57:22'),
(4, 3, 1, 'approve please', 2, NULL, '2019-10-12 12:33:21', '2019-10-12 12:33:21'),
(5, 1, 3, 'gfgfdsfsdfsdfsdfsdf', 2, NULL, '2019-10-16 11:13:58', '2019-10-16 11:13:58'),
(6, 6, 1, 'مرحبك بك', NULL, NULL, '2019-10-16 19:51:50', '2019-10-16 19:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `messages_chat`
--

CREATE TABLE `messages_chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` int(10) UNSIGNED DEFAULT NULL,
  `to` int(10) UNSIGNED DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages_chat`
--

INSERT INTO `messages_chat` (`id`, `from`, `to`, `text`, `read`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'يؤؤسيؤ', 1, '2019-10-16 08:39:50', '2019-10-16 10:26:31'),
(2, 2, 1, 'لابللابل', 1, '2019-10-16 08:45:15', '2019-10-16 10:26:31'),
(3, 1, 2, 'hh', 0, '2019-10-16 08:54:03', '2019-10-16 08:54:03'),
(4, 1, 2, 'rthtgh', 0, '2019-10-16 08:54:29', '2019-10-16 08:54:29'),
(5, 1, 2, 'jkjkk', 0, '2019-10-16 08:54:47', '2019-10-16 08:54:47'),
(6, 2, 1, 'jhjhnj', 1, '2019-10-16 08:54:50', '2019-10-16 10:26:31'),
(7, 1, 2, 'bdfbd', 0, '2019-10-16 08:55:54', '2019-10-16 08:55:54'),
(8, 2, 1, 'bdfbdfb', 1, '2019-10-16 08:55:57', '2019-10-16 10:26:31'),
(9, 1, 2, 'dfdfbhd', 0, '2019-10-16 08:56:08', '2019-10-16 08:56:08'),
(10, 2, 1, 'vddfv', 1, '2019-10-16 08:56:10', '2019-10-16 10:26:31'),
(11, 1, 2, 'ؤ رؤللا', 0, '2019-10-16 08:56:37', '2019-10-16 08:56:37'),
(12, 2, 1, 'بسيسيس', 1, '2019-10-16 08:56:39', '2019-10-16 10:26:31'),
(13, 1, 2, 'لقفلبي', 0, '2019-10-16 08:59:44', '2019-10-16 08:59:44'),
(14, 2, 1, 'بليبلبيل', 1, '2019-10-16 08:59:50', '2019-10-16 10:26:31'),
(15, 1, 2, 'بيبل', 0, '2019-10-16 09:10:25', '2019-10-16 09:10:25'),
(16, 1, 2, 'يببسيسيب', 0, '2019-10-16 09:10:49', '2019-10-16 09:10:49'),
(17, 1, 6, 'هلا بك', 0, '2019-10-16 19:56:54', '2019-10-16 19:56:54');

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
(1, '2014_07_10_092724_create_languages_table', 1),
(2, '2014_07_10_092725_create_currencies_table', 1),
(3, '2014_07_24_142921_create_countries_table', 1),
(4, '2014_07_24_142922_create_cities_table', 1),
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(8, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(9, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(10, '2016_06_01_000004_create_oauth_clients_table', 1),
(11, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(12, '2019_04_24_112456_create_permission_tables', 1),
(13, '2019_05_12_132219_create_questions_table', 1),
(14, '2019_05_13_091350_descount_codes_table_create', 1),
(15, '2019_05_13_1152545_create_applicant_course_table', 1),
(16, '2019_05_13_1152555_create_applicants_table', 1),
(17, '2019_05_13_115255_create_co_categories_table', 1),
(18, '2019_05_13_115255_create_co_category_course_table', 1),
(20, '2019_05_13_115255_create_nationalities_table', 1),
(21, '2019_05_13_115255_create_trainers_table', 1),
(22, '2019_05_14_114739_applicant_result_table', 1),
(23, '2019_06_04_143612_create_course_evaluations_table', 1),
(24, '2019_06_10_104913_create_applicant_course_pendings_table', 1),
(25, '2019_06_10_104923_create_foreign_keys', 2),
(26, '2019_06_15_111448_create_bank_transfers_table', 2),
(27, '2019_08_08_111649_create_settings_table', 2),
(28, '2019_08_08_111649_create_sliders_table', 2),
(30, '2019_09_24_073408_create_course_media_table', 2),
(31, '2019_09_24_073408_create_course_media_tags_table', 2),
(32, '2019_09_24_073409_create_course_media_data_table', 2),
(33, '2019_09_25_082214_create_galleries_table', 2),
(34, '2019_09_25_103541_add_user_id_to_applicants_table', 2),
(35, '2019_09_25_104126_add_user_id_to_trainers_table', 2),
(36, '2019_09_28_1738591_create_articles_table', 2),
(37, '2019_09_28_1738592_create_artcl_categories_table', 2),
(38, '2019_09_28_1738593_create_article_category_table', 2),
(39, '2019_09_28_1738594_create_article_data_table', 2),
(40, '2019_09_28_1738595_add_article_foreign_key', 2),
(41, '2019_09_29_075242_create_course_requests_table', 2),
(42, '2019_09_29_122315_create_newsletters_table', 2),
(43, '2019_09_30_073501_create_favorites_table', 2),
(44, '2019_09_30_120937_create_ratings_table', 2),
(45, '2019_09_30_121924_add_course_rating_pivot_table', 2),
(46, '2019_10_02_135409_create_countries_courses_table', 3),
(47, '2019_10_03_082116_create_course_comments_table', 3),
(48, '2019_10_05_223023_create_messages_table', 3),
(49, '2019_10_07_110334_create_exams_table', 4),
(50, '2019_10_07_110336_create_exam_data_table', 5),
(51, '2019_10_07_111001_create_exam_questions_table', 5),
(52, '2019_10_07_111201_create_question_choices_table', 6),
(53, '2019_10_3_140519_create_contacts_table', 6),
(54, '2019_05_13_115255_create_courses_table', 7),
(56, '2019_10_13_134415_create_user_exams_table', 8),
(57, '2019_10_13_134459_create_user_exam_answers_table', 8),
(58, '2019_10_13_141110_create_orders_table', 9),
(59, '2019_10_13_141111_create_order_courses_table', 9),
(60, '2019_10_13_151204_create_transaction_types_table', 9),
(61, '2019_10_13_151205_create_transactions_table', 9),
(62, '2019_10_14_113849_create_competition_table', 9),
(64, '2019_10_14_114247_create_bills_table', 10),
(65, '2019_05_13_115730_create_education_level_table', 11),
(66, '2019_10_14_082909_create_price_settings_table', 11),
(67, '2019_10_15_095602_create_notifications_table', 11);

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
(1, 'App\\User', 1),
(2, 'App\\User', 1),
(3, 'App\\User', 1),
(4, 'App\\User', 1),
(5, 'App\\User', 1),
(6, 'App\\User', 1),
(7, 'App\\User', 1),
(8, 'App\\User', 1),
(9, 'App\\User', 1),
(10, 'App\\User', 1),
(11, 'App\\User', 1),
(24, 'App\\User', 1),
(25, 'App\\User', 1),
(26, 'App\\User', 1),
(27, 'App\\User', 1),
(28, 'App\\User', 1),
(29, 'App\\User', 1),
(30, 'App\\User', 1),
(31, 'App\\User', 1),
(32, 'App\\User', 1),
(63, 'App\\User', 1),
(64, 'App\\User', 1),
(65, 'App\\User', 1),
(66, 'App\\User', 1),
(67, 'App\\User', 1),
(68, 'App\\User', 1),
(69, 'App\\User', 1),
(70, 'App\\User', 1),
(71, 'App\\User', 1),
(72, 'App\\User', 1),
(73, 'App\\User', 1),
(74, 'App\\User', 1),
(75, 'App\\User', 1),
(76, 'App\\User', 1),
(77, 'App\\User', 1),
(78, 'App\\User', 1),
(79, 'App\\User', 1),
(80, 'App\\User', 1),
(91, 'App\\User', 1),
(92, 'App\\User', 1),
(93, 'App\\User', 1),
(94, 'App\\User', 1),
(95, 'App\\User', 1),
(96, 'App\\User', 1),
(97, 'App\\User', 1),
(101, 'App\\User', 1);

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
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(2, 'App\\User', 4),
(2, 'App\\User', 5),
(2, 'App\\User', 6),
(2, 'App\\User', 7),
(2, 'App\\User', 9),
(2, 'App\\User', 10),
(2, 'App\\User', 11),
(2, 'App\\User', 12),
(2, 'App\\User', 13),
(3, 'App\\User', 4),
(3, 'App\\User', 7),
(3, 'App\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin@phptravels.com', '2019-10-16 18:04:28', '2019-10-16 18:04:28'),
(2, 'dd@test.com', '2019-10-16 18:41:16', '2019-10-16 18:41:16');

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
('5e5aa153-b056-4c7a-918a-3091765c6a9a', 'App\\Notifications\\acceptTrainer', 'App\\User', 1, '{\"admin\":1,\"first_name\":\"Teacher\",\"last_name\":\"Mohammed\"}', NULL, '2019-10-17 04:32:03', '2019-10-17 04:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_courses`
--

CREATE TABLE `order_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `type` enum('course','media') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Permission-Add', 'web', 'إضافة صلاحية', '2019-10-10 08:34:15', '2019-10-10 08:34:15'),
(2, 'Permission-Edit', 'web', 'تعديل صلاحية', '2019-10-10 08:34:15', '2019-10-10 08:34:15'),
(3, 'Permission-Delete', 'web', 'حذف صلاحية', '2019-10-10 08:34:16', '2019-10-10 08:34:16'),
(4, 'Role-Add', 'web', 'اضافه مجموعه مستخدمين', '2019-10-10 08:34:16', '2019-10-10 08:34:16'),
(5, 'Role-Edit', 'web', 'تعديل مجموعه مستخدمين', '2019-10-10 08:34:16', '2019-10-10 08:34:16'),
(6, 'Role-Deletee', 'web', 'حذف مجموعه مستخدمين', '2019-10-10 08:34:16', '2019-10-10 08:34:16'),
(7, 'Role-Delete', 'web', NULL, '2019-10-10 08:34:16', '2019-10-10 08:34:16'),
(8, 'Show-Adminpanel', 'web', 'عرض لوحة التحكم', '2019-10-10 08:34:16', '2019-10-10 08:34:16'),
(9, 'User-Add', 'web', 'اضافه مستخدم', '2019-10-10 08:34:16', '2019-10-10 08:34:16'),
(10, 'User-Edit', 'web', 'تعديل مستخدم', '2019-10-10 08:34:17', '2019-10-10 08:34:17'),
(11, 'User-Delete', 'web', 'حذف مستخدم', '2019-10-10 08:34:17', '2019-10-10 08:34:17'),
(24, 'Trainer-Add', 'web', 'اضافه مدرب', '2019-10-10 08:34:17', '2019-10-10 08:34:17'),
(25, 'Trainer-Edit', 'web', 'تعديل مدرب', '2019-10-10 08:34:17', '2019-10-10 08:34:17'),
(26, 'Trainer-Delete', 'web', 'حذف مدرب', '2019-10-10 08:34:18', '2019-10-10 08:34:18'),
(27, 'Course-Add', 'web', 'اضافه دورة تدريبيه', '2019-10-10 08:34:18', '2019-10-10 08:34:18'),
(28, 'Course-Edit', 'web', 'تعديل دورة تدريبيه', '2019-10-10 08:34:18', '2019-10-10 08:34:18'),
(29, 'Course-Delete', 'web', 'حذف دورة تدريبية', '2019-10-10 08:34:18', '2019-10-10 08:34:18'),
(30, 'CourseCategory-Add', 'web', 'إضافة قسم للدورة التدريبية', '2019-10-10 08:34:18', '2019-10-10 08:34:18'),
(31, 'CourseCategory-Edit', 'web', 'تعديل قسم للدورة التدريبية', '2019-10-10 08:34:19', '2019-10-10 08:34:19'),
(32, 'CourseCategory-Delete', 'web', 'حذف قسم للدورة التدريبية', '2019-10-10 08:34:19', '2019-10-10 08:34:19'),
(63, 'Applicant-Add', 'web', 'إضاف متدرب', '2019-10-10 08:34:23', '2019-10-10 08:34:23'),
(64, 'Applicant-Edit', 'web', 'تعديل متدرب', '2019-10-10 08:34:23', '2019-10-10 08:34:23'),
(65, 'Applicant-Delete', 'web', 'حذف متدرب', '2019-10-10 08:34:23', '2019-10-10 08:34:23'),
(66, 'City-Add', 'web', 'إضافة مدينة', '2019-10-10 08:34:24', '2019-10-10 08:34:24'),
(67, 'City-Edit', 'web', 'تعديل مدينة', '2019-10-10 08:34:24', '2019-10-10 08:34:24'),
(68, 'City-Delete', 'web', 'حذف مدينة', '2019-10-10 08:34:24', '2019-10-10 08:34:24'),
(69, 'Country-Add', 'web', 'إضافة دولة', '2019-10-10 08:34:24', '2019-10-10 08:34:24'),
(70, 'Country-Edit', 'web', 'تعديل دولة', '2019-10-10 08:34:24', '2019-10-10 08:34:24'),
(71, 'Course-Video', 'web', 'إضافة فديو', '2019-10-10 08:34:25', '2019-10-10 08:34:25'),
(72, 'ApplicantPending-Add', 'web', 'إضافة طلب متدرب لكورس', '2019-10-10 08:34:25', '2019-10-10 08:34:25'),
(73, 'ApplicantPending-Delete', 'web', 'حذف طلب متدرب لكورس', '2019-10-10 08:34:25', '2019-10-10 08:34:25'),
(74, 'Article-Add', 'web', 'إضافة مقال', '2019-10-10 08:34:25', '2019-10-10 08:34:25'),
(75, 'Article-Edit', 'web', 'تعديل مقال', '2019-10-10 08:34:25', '2019-10-10 08:34:25'),
(76, 'Article-Delete', 'web', 'حذف مقال', '2019-10-10 08:34:25', '2019-10-10 08:34:25'),
(77, 'ArticleCategory-Add', 'web', 'إضافة قسم للمقال', '2019-10-10 08:34:25', '2019-10-10 08:34:25'),
(78, 'ArticleCategory-Edit', 'web', 'تعديل قسم للمقال', '2019-10-10 08:34:26', '2019-10-10 08:34:26'),
(79, 'ArticleCategory-Delete', 'web', 'حذف قسم للمقال', '2019-10-10 08:34:26', '2019-10-10 08:34:26'),
(80, 'NewsLetters-Add', 'web', 'إضافة عضو للنشرة الإخبارية', '2019-10-10 08:34:26', '2019-10-10 08:34:26'),
(91, 'NewsLetters-Edit', 'web', 'تعديل عضو للنشرة الإخبارية', '2019-10-10 08:34:26', '2019-10-10 08:34:26'),
(92, 'NewsLetters-Delete', 'web', 'حذف عضو للنشرة الإخبارية', '2019-10-10 08:34:26', '2019-10-10 08:34:26'),
(93, 'CourseComments-Show', 'web', 'عرض تعليق للدورة التدريبية', '2019-10-10 08:34:26', '2019-10-10 08:34:26'),
(94, 'CourseComments-Delete', 'web', 'حذف تعليق للدورة التدريبية', '2019-10-10 08:34:26', '2019-10-10 08:34:26'),
(95, 'Gallery-Add', 'web', ' اضافه جاليري ', '2019-10-10 08:34:27', '2019-10-10 08:34:27'),
(96, 'Gallery-Edit', 'web', 'تعديل  جاليري ', '2019-10-10 08:34:27', '2019-10-10 08:34:27'),
(97, 'Gallery-Delete', 'web', 'حذف جاليري ', '2019-10-10 08:34:27', '2019-10-10 08:34:27'),
(101, 'course-activation', 'web', NULL, '2019-10-13 08:54:34', '2019-10-13 08:54:34'),
(102, 'BankTransfer-Add', 'web', ' اضافه بنك ', '2019-10-10 06:34:20', '2019-10-17 04:47:23'),
(103, 'BankTransfer-Edit', 'web', 'تعديل  بنك ', '2019-10-10 06:34:21', '2019-10-17 04:47:23'),
(104, 'BankTransfer-Delete', 'web', 'حذف بنك ', '2019-10-10 06:34:21', '2019-10-17 04:47:23'),
(105, 'TransactionType-Add', 'web', 'إضافة نوع معاملة', '2019-10-10 06:34:21', '2019-10-17 04:47:23'),
(106, 'TransactionType-Edit', 'web', 'تعديل نوع معاملة', '2019-10-10 06:34:21', '2019-10-17 04:47:23'),
(107, 'TransactionType-Delete', 'web', 'حذف نوع معاملة', '2019-10-10 06:34:21', '2019-10-17 04:47:24'),
(108, 'Transactions-Show', 'web', 'إظهار العمليات المالية', '2019-10-10 06:34:22', '2019-10-17 04:47:24'),
(109, 'Course-Exam-Add', 'web', 'إضافة إختبار للدورة', '2019-10-10 06:34:22', '2019-10-17 04:47:24'),
(110, 'Course-Exam-Edit', 'web', 'تعديل إختبار للدورة', '2019-10-10 06:34:22', '2019-10-17 04:47:24'),
(111, 'Course-Exam-Delete', 'web', 'حذف إختبار للدورة', '2019-10-10 06:34:22', '2019-10-17 04:47:24'),
(112, 'Competition-Add', 'web', 'إضافة مسابقة', '2019-10-10 06:34:22', '2019-10-17 04:47:24'),
(113, 'Competition-Edit', 'web', 'تعديل مسابقة', '2019-10-10 06:34:22', '2019-10-17 04:47:24'),
(114, 'Competition-Delete', 'web', 'حذف مسابقة', '2019-10-10 06:34:23', '2019-10-17 04:47:24'),
(115, 'Bill-Add', 'web', 'إضافة فاتورة', '2019-10-10 06:34:23', '2019-10-17 04:47:24'),
(116, 'Bill-Edit', 'web', 'تعديل فاتورة', '2019-10-10 06:34:23', '2019-10-17 04:47:24'),
(117, 'Bill-Delete', 'web', 'حذف فاتورة', '2019-10-10 06:34:23', '2019-10-17 04:47:25'),
(118, 'Settings-Add', 'web', 'إضافة إعدادات', '2019-10-10 06:34:23', '2019-10-17 04:47:25'),
(119, 'Settings-Edit', 'web', 'تعديل إعدادات', '2019-10-10 06:34:23', '2019-10-17 04:47:25'),
(120, 'Settings-Delete', 'web', 'حذف إعدادات', '2019-10-10 06:34:24', '2019-10-17 04:47:25'),
(121, 'Rating-Show', 'web', 'عرض التقييم', '2019-10-10 06:34:24', '2019-10-17 04:47:25'),
(122, 'Rating-Delete', 'web', 'حذف التقييم', '2019-10-10 06:34:24', '2019-10-17 04:47:25'),
(123, 'EducationLevel-Add', 'web', 'إضافة مستوي تعليمي', '2019-10-10 06:34:24', '2019-10-17 04:47:25'),
(124, 'EducationLevel-Edit', 'web', 'تعديل مستوي تعليمي', '2019-10-10 06:34:24', '2019-10-17 04:47:25'),
(125, 'EducationLevel-Delete', 'web', 'حذف مستوي تعليمي', '2019-10-10 06:34:25', '2019-10-17 04:47:25'),
(126, 'Contact-Show', 'web', 'إظهار الرسالة', '2019-10-10 06:34:25', '2019-10-17 04:49:59'),
(127, 'Contact-Delete', 'web', 'حذف الرسالة', '2019-10-10 06:34:25', '2019-10-17 04:49:59'),
(128, 'Currency-Add', 'web', NULL, '2019-10-12 05:47:06', '2019-10-12 05:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `price_settings`
--

CREATE TABLE `price_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `type` enum('net','perc') COLLATE utf8mb4_unicode_ci DEFAULT 'net',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_settings`
--

INSERT INTO `price_settings` (`id`, `price`, `type`, `created_at`, `updated_at`) VALUES
(1, 2.00, 'net', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_multi` tinyint(1) NOT NULL DEFAULT 0,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'course',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_choices`
--

CREATE TABLE `question_choices` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `is_answer` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_choices`
--

INSERT INTO `question_choices` (`id`, `title`, `question_id`, `lang_id`, `is_answer`, `created_at`, `updated_at`) VALUES
(8, 'true', 21, 2, 1, '2019-10-14 06:20:25', '2019-10-14 06:20:25'),
(9, 'true', 33, 2, 1, '2019-10-14 07:05:34', '2019-10-14 07:05:34'),
(10, 'false', 35, 2, 2, '2019-10-14 07:05:36', '2019-10-14 07:05:36'),
(11, 'true', 37, 2, 1, '2019-10-14 07:05:38', '2019-10-14 07:05:38'),
(12, 'false', 39, 2, 2, '2019-10-14 07:05:41', '2019-10-14 07:05:41'),
(13, 'true', 41, 2, 1, '2019-10-14 07:05:43', '2019-10-14 07:05:43'),
(14, 'true', 43, 2, 1, '2019-10-14 07:05:45', '2019-10-14 07:05:45'),
(15, 'false', 45, 2, 2, '2019-10-14 07:05:47', '2019-10-14 07:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `course_id`, `rating`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, '2019-10-16 09:01:03', '2019-10-16 09:01:03'),
(3, 3, NULL, '2019-10-16 13:50:04', '2019-10-16 13:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `is_system`) VALUES
(1, 'super-admin', 'web', '2019-10-10 08:34:15', '2019-10-10 08:34:15', 0),
(2, 'registered-users', 'web', '2019-10-10 08:34:27', '2019-10-10 08:34:27', 1),
(3, 'trainer', 'web', '2019-10-10 09:11:27', '2019-10-10 09:11:27', 0);

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
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(91, 1),
(92, 1),
(93, 1),
(93, 3),
(94, 1),
(94, 3),
(95, 1),
(96, 1),
(97, 1),
(101, 1);

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
  `youtube_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `logo`, `facebook_url`, `instagram_url`, `youtube_url`, `twitter_url`, `phone1`, `phone2`, `work_time`, `address`, `lang_id`, `source_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'logo.png', NULL, NULL, NULL, NULL, '878979879878', NULL, NULL, NULL, 1, NULL, '2019-10-12 05:53:09', '2019-10-16 16:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `gender` enum('Female','Male') COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `gender`, `skills`, `created`, `created_at`, `updated_at`, `user_id`, `country_id`, `address`, `department`, `degree`) VALUES
(1, 'Female', NULL, NULL, '2019-10-13 07:34:01', '2019-10-13 07:34:01', 4, 1, 'cairo', NULL, NULL),
(2, 'Female', NULL, NULL, '2019-10-17 04:32:03', '2019-10-17 04:32:03', 8, 1, 'egypt', NULL, NULL);

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
  `total` double(8,2) DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `discount_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_cvc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_expire` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int(10) UNSIGNED DEFAULT NULL,
  `source_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `type`, `is_admin`, `is_active`, `mobile`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `country_id`) VALUES
(1, 'admin', 'admin', NULL, 'admin@admin.com', NULL, 1, 1, NULL, NULL, NULL, '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', 'XxM5GFwpu08UfaRJN9dUZh4flxvns0oNTF2Fgh8QaXWtdT8vF7ZN4GQ71XS8', '2019-10-10 08:34:15', '2019-10-10 08:34:15', 0),
(2, NULL, 'user', 'one', 'user_one@joud.com', 'applicant', 0, 1, '01156382044', 'darth-vader.png', NULL, '$2y$10$FKXeGwpZXOQzVQeuGixD6eP2TE0L5pjBWVS5AGeL0da5CTLiL9Scu', '1y523aP9yRgMwdb3hS551f1viYrqAMwTVZEgOZnkYmfxFlGqIQgDUj2EiDEj', '2019-10-12 08:22:05', '2019-10-12 08:22:05', 0),
(3, NULL, 'user', 'two', 'user_two@joud.com', 'applicant', 0, 1, '012345678900', 'student.png', NULL, '$2y$10$IEuLR2pHRuhHPjd4bOReX.903Nuh6b5oaEmDC5cXp46E.cWGAPese', 'HtKAFrpP8oaOANuniWbZrmrk1kO7Pk9YhANjN7jVAu6JSejMXmawQyK45ydY', '2019-10-12 10:05:18', '2019-10-12 10:05:18', 0),
(4, NULL, 'teacher', 'one', 'teacher_one@joud.com', 'trainer', 0, 1, '0123658163694', 'darth-vader.png', NULL, '$2y$10$tRuxdlmdPcbLGlTBVR54vONoz9EaaUJ85IQCJKCX.gvlQzQ6auImu', 'KU6iCAHvBoikohnSeANSRmgkLAZUpHhyosamxoBuXYX1UkCK16MuYPY1SjNc', '2019-10-13 07:34:01', '2019-10-13 08:48:21', 0),
(5, NULL, 'Ibrahim', 'el refaey', 'ibrahim_elrefaey@hotmail.com', 'applicant', 0, 1, '00201017100093', NULL, NULL, '$2y$10$0vpZAp2FpCgE8HT84aK6cOUZvhQssthKwnzFw06ZEjX2wpeO125Ym', '96SEVhAY77OuAZ2WDJBXAKJ9uUFnsvJF04HHVNxreajsOfPJvcBjZSuRwfxi', '2019-10-16 09:55:02', '2019-10-16 09:55:02', 0),
(6, NULL, 'ahmed', 'moahmed', 'ea2@hotmail.com', 'applicant', 0, 1, '+201005851101', '68528650_1847209798715909_3516711078706806784_n.jpg', NULL, '$2y$10$OwXJAzUSImRpVjdoZC0EAeEkTuxCLBiy1hr5z2F.ia2fArr1XzK7m', 'CNjZCYOkRAtzpDg389EQDZBOEgWyHcuZPBrZZG01J1F5iV3MlSNgW77LppOo', '2019-10-16 12:03:43', '2019-10-16 12:03:43', 0),
(8, NULL, 'Teacher', 'Mohammed', 'teacher@yahoo.com', 'trainer', 0, 1, '4353464565757', NULL, NULL, '$2y$10$kCfihXXIrKb9AyyktOSOLOL5RxS/ukBnLQn98udiLtf8.w7cg1L3W', 'XFmrvjHXdSy6lfr77JRKvQowtl1BjvgaG18l2b4AOgZuNww6R6IErOMENKO1', '2019-10-17 04:32:02', '2019-10-17 10:20:33', 0),
(9, NULL, 'user', 'three', 'user_three@joud.com', 'applicant', 0, 1, '01658715486', 'darth-vader.png', NULL, '$2y$10$nWlLJGeQGjDJn1LZis/O9e2h7D7kqQagHQNvUdg5Bq87g0GEbgG3y', 'T7dXOyz9sWWXq9EZxlQmzsD8eg8TmyteSCpOfkATuKvX2FYacAvOkaHD3HBH', '2019-10-17 06:47:24', '2019-10-17 06:47:24', 0),
(11, NULL, 'user', 'four', 'user_four@joud.com', 'applicant', 0, 1, '14568336411', 'darth-vader.png', NULL, '$2y$10$u6kX5LZB1VY5oQfHIqT6IuYIPp6OimWPh8.3Sy4g5Sce1d7uBN1zK', 'dxSroddUz4gWR7e02yp9ftPoTnvqPKzRj1ueuu7ssVDAvNmAoDZZbuamWR1p', '2019-10-17 09:36:24', '2019-10-17 09:36:24', 0),
(12, NULL, 'mohamed', 'ahmed', 'mohamed_ahmed@gmail.com', 'applicant', 0, 1, '1564915181518', 'darth-vader.png', NULL, '$2y$10$lfEXC9GwrK2OP.3a9KuMxOc0e5SjflfzV5g2dpvtub7oGMn.xlur6', 'SlaNBxD8D9z442kUQSMtfXVYLW9e8eNu1FHKBDNQfYrfyJNORSYr0FBqupp3', '2019-10-17 09:38:15', '2019-10-17 09:38:15', 0),
(13, NULL, 'fawzia', 'Mohammed', 'computerstar2002@yahoo.com', 'applicant', 0, 1, '56456567567777', 'user2-160x160.jpg', NULL, '$2y$10$ncR0FlWOuyzV47s3rAlNHe3URXoOuIp6C1avBsOmxHiD.kohc9oIu', 'gbXLJpysnEDUmoskme58x7LvV0DjT9KFr2MuTS06wCeq0SclN26eQZoGohsK', '2019-10-17 09:43:13', '2019-10-17 09:43:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_exams`
--

CREATE TABLE `user_exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `score` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_exams`
--

INSERT INTO `user_exams` (`id`, `exam_id`, `user_id`, `score`, `created`) VALUES
(1, 1, 2, '60', '2019-10-14 10:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_answers`
--

CREATE TABLE `user_exam_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_exam_id` int(10) UNSIGNED DEFAULT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `answer_id` int(10) UNSIGNED DEFAULT NULL,
  `score` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_answer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_exam_answers`
--

INSERT INTO `user_exam_answers` (`id`, `user_exam_id`, `question_id`, `answer_id`, `score`, `created`, `is_answer`) VALUES
(1, 1, 33, 9, '5', '2019-10-14 09:36:19', 1),
(2, 1, 35, 10, '0', '2019-10-14 09:36:19', 1),
(3, 1, 37, 11, '0', '2019-10-14 09:36:19', 2),
(4, 1, 39, 12, '0', '2019-10-14 09:36:19', 1),
(5, 1, 41, 13, '0', '2019-10-14 09:36:19', 2),
(6, 1, 43, 14, '15', '2019-10-14 09:36:19', 1),
(7, 1, 45, 15, '10', '2019-10-14 09:36:20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rating_id` int(10) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_rating`
--

INSERT INTO `user_rating` (`id`, `user_id`, `rating_id`, `rating`, `comment`, `approve`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 4, 'nice', 1, NULL, '2019-10-10 12:35:41'),
(2, 2, 2, 4, NULL, 0, NULL, NULL),
(3, 1, 3, 5, NULL, 0, NULL, NULL),
(4, 6, 2, 5, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_applicants`
-- (See below for the actual view)
--
CREATE TABLE `vw_applicants` (
`id` int(10) unsigned
,`first_name` varchar(100)
,`last_name` varchar(100)
,`email` varchar(191)
,`is_admin` tinyint(1)
,`type` varchar(10)
,`is_active` tinyint(1)
,`image` varchar(191)
,`mobile` varchar(191)
,`email_verified_at` timestamp
,`password` varchar(191)
,`remember_token` varchar(100)
,`created_at` timestamp
,`updated_at` timestamp
,`roles_name` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_course_exams`
-- (See below for the actual view)
--
CREATE TABLE `vw_course_exams` (
`id` int(10) unsigned
,`course_id` int(10) unsigned
,`is_active` tinyint(1)
,`lang_id` int(10) unsigned
,`title` varchar(191)
,`description` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_media_exams`
-- (See below for the actual view)
--
CREATE TABLE `vw_media_exams` (
`id` int(10) unsigned
,`media_id` int(10) unsigned
,`is_active` tinyint(1)
,`lang_id` int(10) unsigned
,`title` varchar(191)
,`description` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_trainers`
-- (See below for the actual view)
--
CREATE TABLE `vw_trainers` (
`id` int(10) unsigned
,`first_name` varchar(100)
,`last_name` varchar(100)
,`email` varchar(191)
,`is_admin` tinyint(1)
,`type` varchar(10)
,`is_active` tinyint(1)
,`image` varchar(191)
,`mobile` varchar(191)
,`email_verified_at` timestamp
,`password` varchar(191)
,`remember_token` varchar(100)
,`created_at` timestamp
,`updated_at` timestamp
,`roles_name` varchar(191)
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
(10, '123', 0, 4, 1, '2019-10-16 08:31:42', '2019-10-16 08:31:42'),
(11, '123', 0, 3, 1, '2019-10-16 08:32:42', '2019-10-16 08:32:42'),
(12, '123', 0, 4, 1, '2019-10-16 08:33:42', '2019-10-16 08:33:42'),
(13, '123', 0, 4, 1, '2019-10-16 08:34:42', '2019-10-16 08:34:42'),
(14, '123', 3, 4, 0, '2019-10-16 08:52:28', '2019-10-16 08:52:28'),
(15, '123', 3, 7, 1, '2019-10-16 08:54:18', '2019-10-16 08:54:18'),
(16, '123', 2, 6, 4, '2019-10-16 08:55:19', '2019-10-16 08:55:19'),
(17, '123', 3, 7, 5, '2019-10-16 08:56:19', '2019-10-16 08:56:19'),
(18, '123', 3, 7, 3, '2019-10-16 08:57:19', '2019-10-16 08:57:19'),
(19, '123', 3, 9, 1, '2019-10-16 08:58:19', '2019-10-16 08:58:19'),
(20, '123', 3, 9, 1, '2019-10-16 08:59:19', '2019-10-16 08:59:19'),
(21, '123', 3, 5, 3, '2019-10-16 09:00:19', '2019-10-16 09:00:19'),
(22, '123', 3, 9, 1, '2019-10-16 09:01:19', '2019-10-16 09:01:19'),
(23, '123', 3, 7, 1, '2019-10-16 09:02:19', '2019-10-16 09:02:19'),
(24, '123', 3, 8, 1, '2019-10-16 09:03:19', '2019-10-16 09:03:19'),
(25, '123', 3, 6, 1, '2019-10-16 09:04:19', '2019-10-16 09:04:19'),
(26, '123', 3, 8, 0, '2019-10-16 10:26:34', '2019-10-16 10:26:34'),
(27, '123', 3, 6, 1, '2019-10-16 10:27:34', '2019-10-16 10:27:34'),
(28, '123', 3, 6, 1, '2019-10-16 10:28:34', '2019-10-16 10:28:34'),
(29, '123', 3, 6, 1, '2019-10-16 10:29:34', '2019-10-16 10:29:34'),
(30, '123', 3, 6, 1, '2019-10-16 10:30:34', '2019-10-16 10:30:34'),
(31, '123', 3, 6, 1, '2019-10-16 10:31:34', '2019-10-16 10:31:34'),
(32, '123', 3, 6, 1, '2019-10-16 10:32:34', '2019-10-16 10:32:34'),
(33, '123', 3, 5, 1, '2019-10-16 10:33:34', '2019-10-16 10:33:34'),
(34, '123', 3, 6, 1, '2019-10-16 10:34:34', '2019-10-16 10:34:34'),
(35, '123', 3, 6, 1, '2019-10-16 10:35:34', '2019-10-16 10:35:34'),
(36, '123', 3, 6, 1, '2019-10-16 10:36:34', '2019-10-16 10:36:34'),
(37, '123', 3, 6, 1, '2019-10-16 10:37:34', '2019-10-16 10:37:34'),
(38, '123', 3, 6, 1, '2019-10-16 10:38:34', '2019-10-16 10:38:34'),
(39, '123', 3, 6, 1, '2019-10-16 10:39:34', '2019-10-16 10:39:34'),
(40, '123', 3, 6, 1, '2019-10-16 10:40:34', '2019-10-16 10:40:34'),
(41, '123', 3, 6, 1, '2019-10-16 10:41:34', '2019-10-16 10:41:34'),
(42, '123', 3, 6, 1, '2019-10-16 10:42:34', '2019-10-16 10:42:34'),
(43, '123', 3, 6, 1, '2019-10-16 10:43:34', '2019-10-16 10:43:34'),
(44, '123', 3, 6, 1, '2019-10-16 10:44:34', '2019-10-16 10:44:34'),
(45, '123', 3, 6, 1, '2019-10-16 10:45:34', '2019-10-16 10:45:34'),
(46, '123', 3, 5, 1, '2019-10-16 10:46:34', '2019-10-16 10:46:34'),
(47, '123', 3, 6, 1, '2019-10-16 10:47:34', '2019-10-16 10:47:34'),
(48, '123', 8, 5, 1, '2019-10-16 10:48:34', '2019-10-16 10:48:34'),
(49, '123', 3, 7, 1, '2019-10-16 10:49:34', '2019-10-16 10:49:34'),
(50, '123', 3, 8, 1, '2019-10-16 10:50:34', '2019-10-16 10:50:34'),
(51, '123', 3, 8, 1, '2019-10-16 10:51:34', '2019-10-16 10:51:34'),
(52, '123', 3, 8, 1, '2019-10-16 10:52:34', '2019-10-16 10:52:34'),
(53, '123', 3, 8, 1, '2019-10-16 10:53:34', '2019-10-16 10:53:34'),
(54, '123', 3, 7, 1, '2019-10-16 10:54:34', '2019-10-16 10:54:34'),
(55, '123', 3, 8, 1, '2019-10-16 10:55:34', '2019-10-16 10:55:34'),
(56, '123', 3, 6, 1, '2019-10-16 10:56:34', '2019-10-16 10:56:34'),
(57, '123', 3, 6, 1, '2019-10-16 10:57:34', '2019-10-16 10:57:34'),
(58, '123', 3, 6, 1, '2019-10-16 10:58:34', '2019-10-16 10:58:34'),
(59, '123', 3, 6, 1, '2019-10-16 10:59:34', '2019-10-16 10:59:34'),
(60, '123', 3, 6, 1, '2019-10-16 11:00:34', '2019-10-16 11:00:34'),
(61, '123', 3, 6, 1, '2019-10-16 11:01:34', '2019-10-16 11:01:34'),
(62, '123', 3, 6, 1, '2019-10-16 11:02:34', '2019-10-16 11:02:34'),
(63, '123', 3, 5, 1, '2019-10-16 11:03:35', '2019-10-16 11:03:35'),
(64, '123', 3, 6, 1, '2019-10-16 11:04:34', '2019-10-16 11:04:34'),
(65, '123', 3, 6, 1, '2019-10-16 11:05:34', '2019-10-16 11:05:34'),
(66, '123', 3, 6, 1, '2019-10-16 11:06:34', '2019-10-16 11:06:34'),
(67, '123', 3, 6, 1, '2019-10-16 11:07:34', '2019-10-16 11:07:34'),
(68, '123', 3, 6, 1, '2019-10-16 11:08:34', '2019-10-16 11:08:34'),
(69, '123', 3, 6, 1, '2019-10-16 11:09:34', '2019-10-16 11:09:34'),
(70, '123', 3, 6, 1, '2019-10-16 11:10:34', '2019-10-16 11:10:34'),
(71, '123', 3, 6, 1, '2019-10-16 11:11:34', '2019-10-16 11:11:34'),
(72, '123', 3, 6, 1, '2019-10-16 11:12:34', '2019-10-16 11:12:34'),
(73, '123', 3, 6, 1, '2019-10-16 11:13:35', '2019-10-16 11:13:35'),
(74, '123', 3, 6, 1, '2019-10-16 11:14:34', '2019-10-16 11:14:34'),
(75, '123', 3, 6, 1, '2019-10-16 11:15:35', '2019-10-16 11:15:35'),
(76, '123', 3, 6, 1, '2019-10-16 11:16:35', '2019-10-16 11:16:35'),
(77, '123', 3, 6, 1, '2019-10-16 11:17:35', '2019-10-16 11:17:35'),
(78, '123', 3, 5, 1, '2019-10-16 11:18:35', '2019-10-16 11:18:35'),
(79, '123', 3, 6, 1, '2019-10-16 11:19:35', '2019-10-16 11:19:35'),
(80, '123', 3, 6, 1, '2019-10-16 11:20:35', '2019-10-16 11:20:35'),
(81, '123', 3, 6, 1, '2019-10-16 11:21:35', '2019-10-16 11:21:35'),
(82, '123', 3, 6, 1, '2019-10-16 11:22:35', '2019-10-16 11:22:35'),
(83, '123', 3, 6, 1, '2019-10-16 11:23:35', '2019-10-16 11:23:35'),
(84, '123', 3, 6, 1, '2019-10-16 11:24:35', '2019-10-16 11:24:35'),
(85, '123', 3, 6, 1, '2019-10-16 11:25:35', '2019-10-16 11:25:35'),
(86, '123', 3, 6, 1, '2019-10-16 11:26:35', '2019-10-16 11:26:35'),
(87, '123', 3, 6, 1, '2019-10-16 11:27:35', '2019-10-16 11:27:35'),
(88, '123', 3, 6, 1, '2019-10-16 11:28:35', '2019-10-16 11:28:35'),
(89, '123', 3, 6, 1, '2019-10-16 11:29:35', '2019-10-16 11:29:35'),
(90, '123', 3, 6, 1, '2019-10-16 11:30:35', '2019-10-16 11:30:35'),
(91, '123', 3, 6, 1, '2019-10-16 11:31:35', '2019-10-16 11:31:35'),
(92, '123', 3, 6, 1, '2019-10-16 11:32:35', '2019-10-16 11:32:35'),
(93, '123', 3, 5, 1, '2019-10-16 11:33:35', '2019-10-16 11:33:35'),
(94, '123', 3, 6, 1, '2019-10-16 11:34:35', '2019-10-16 11:34:35'),
(95, '123', 3, 6, 1, '2019-10-16 11:35:35', '2019-10-16 11:35:35'),
(96, '123', 3, 6, 1, '2019-10-16 11:36:35', '2019-10-16 11:36:35'),
(97, '123', 3, 5, 1, '2019-10-16 11:37:35', '2019-10-16 11:37:35'),
(98, '123', 3, 6, 1, '2019-10-16 11:38:35', '2019-10-16 11:38:35'),
(99, '123', 3, 6, 1, '2019-10-16 11:39:35', '2019-10-16 11:39:35'),
(100, '123', 3, 6, 1, '2019-10-16 11:40:35', '2019-10-16 11:40:35'),
(101, '123', 3, 6, 1, '2019-10-16 11:41:35', '2019-10-16 11:41:35'),
(102, '123', 3, 6, 1, '2019-10-16 11:42:35', '2019-10-16 11:42:35'),
(103, '123', 3, 6, 1, '2019-10-16 11:43:35', '2019-10-16 11:43:35'),
(104, '123', 3, 6, 1, '2019-10-16 11:44:35', '2019-10-16 11:44:35'),
(105, '123', 3, 6, 1, '2019-10-16 11:45:35', '2019-10-16 11:45:35'),
(106, '123', 3, 6, 1, '2019-10-16 11:46:35', '2019-10-16 11:46:35'),
(107, '123', 3, 5, 1, '2019-10-16 11:47:35', '2019-10-16 11:47:35'),
(108, '123', 3, 6, 1, '2019-10-16 11:48:35', '2019-10-16 11:48:35'),
(109, '123', 3, 6, 1, '2019-10-16 11:49:35', '2019-10-16 11:49:35'),
(110, '123', 4, 6, 1, '2019-10-16 11:50:35', '2019-10-16 11:50:35'),
(111, '123', 3, 6, 1, '2019-10-16 11:51:35', '2019-10-16 11:51:35'),
(112, '123', 3, 6, 1, '2019-10-16 11:52:35', '2019-10-16 11:52:35'),
(113, '123', 5, 6, 1, '2019-10-16 11:53:35', '2019-10-16 11:53:35'),
(114, '123', 3, 7, 1, '2019-10-16 11:54:35', '2019-10-16 11:54:35'),
(115, '123', 3, 7, 1, '2019-10-16 11:55:35', '2019-10-16 11:55:35'),
(116, '123', 3, 10, 1, '2019-10-16 11:56:35', '2019-10-16 11:56:35'),
(117, '123', 3, 8, 1, '2019-10-16 11:57:35', '2019-10-16 11:57:35'),
(118, '123', 3, 8, 1, '2019-10-16 11:58:35', '2019-10-16 11:58:35'),
(119, '123', 3, 8, 1, '2019-10-16 11:59:35', '2019-10-16 11:59:35'),
(120, '123', 3, 8, 1, '2019-10-16 12:00:35', '2019-10-16 12:00:35'),
(121, '123', 3, 8, 1, '2019-10-16 12:01:35', '2019-10-16 12:01:35'),
(122, '123', 3, 8, 1, '2019-10-16 12:02:35', '2019-10-16 12:02:35'),
(123, '123', 3, 6, 1, '2019-10-16 12:03:35', '2019-10-16 12:03:35'),
(124, '123', 3, 8, 1, '2019-10-16 12:04:35', '2019-10-16 12:04:35'),
(125, '123', 3, 8, 1, '2019-10-16 12:05:35', '2019-10-16 12:05:35'),
(126, '123', 3, 7, 1, '2019-10-16 12:06:35', '2019-10-16 12:06:35'),
(127, '123', 3, 8, 1, '2019-10-16 12:07:35', '2019-10-16 12:07:35'),
(128, '123', 3, 8, 1, '2019-10-16 12:08:35', '2019-10-16 12:08:35'),
(129, '123', 3, 8, 1, '2019-10-16 12:09:35', '2019-10-16 12:09:35'),
(130, '123', 3, 7, 1, '2019-10-16 12:10:35', '2019-10-16 12:10:35'),
(131, '123', 3, 8, 1, '2019-10-16 12:11:35', '2019-10-16 12:11:35'),
(132, '123', 3, 8, 1, '2019-10-16 12:12:35', '2019-10-16 12:12:35'),
(133, '123', 3, 8, 1, '2019-10-16 12:13:35', '2019-10-16 12:13:35'),
(134, '123', 3, 8, 1, '2019-10-16 12:14:35', '2019-10-16 12:14:35'),
(135, '123', 3, 8, 1, '2019-10-16 12:15:35', '2019-10-16 12:15:35'),
(136, '123', 3, 8, 1, '2019-10-16 12:16:35', '2019-10-16 12:16:35'),
(137, '123', 3, 8, 1, '2019-10-16 12:17:35', '2019-10-16 12:17:35'),
(138, '123', 3, 7, 1, '2019-10-16 12:18:35', '2019-10-16 12:18:35'),
(139, '123', 3, 8, 1, '2019-10-16 12:19:35', '2019-10-16 12:19:35'),
(140, '123', 3, 8, 1, '2019-10-16 12:20:35', '2019-10-16 12:20:35'),
(141, '123', 3, 7, 1, '2019-10-16 12:21:35', '2019-10-16 12:21:35'),
(142, '123', 3, 8, 1, '2019-10-16 12:22:35', '2019-10-16 12:22:35'),
(143, '123', 3, 8, 1, '2019-10-16 12:23:35', '2019-10-16 12:23:35'),
(144, '123', 3, 8, 1, '2019-10-16 12:24:35', '2019-10-16 12:24:35'),
(145, '123', 3, 7, 1, '2019-10-16 12:25:35', '2019-10-16 12:25:35'),
(146, '123', 3, 8, 1, '2019-10-16 12:26:35', '2019-10-16 12:26:35'),
(147, '123', 3, 8, 1, '2019-10-16 12:27:35', '2019-10-16 12:27:35'),
(148, '123', 3, 8, 1, '2019-10-16 12:28:35', '2019-10-16 12:28:35'),
(149, '123', 3, 8, 1, '2019-10-16 12:29:35', '2019-10-16 12:29:35'),
(150, '123', 3, 8, 1, '2019-10-16 12:30:35', '2019-10-16 12:30:35'),
(151, '123', 3, 8, 1, '2019-10-16 12:31:35', '2019-10-16 12:31:35'),
(152, '123', 3, 8, 1, '2019-10-16 12:32:35', '2019-10-16 12:32:35'),
(153, '123', 3, 8, 1, '2019-10-16 12:33:35', '2019-10-16 12:33:35'),
(154, '123', 3, 7, 1, '2019-10-16 12:34:35', '2019-10-16 12:34:35'),
(155, '123', 3, 8, 1, '2019-10-16 12:35:35', '2019-10-16 12:35:35'),
(156, '123', 3, 8, 1, '2019-10-16 12:36:35', '2019-10-16 12:36:35'),
(157, '123', 3, 7, 1, '2019-10-16 12:37:35', '2019-10-16 12:37:35'),
(158, '123', 3, 8, 1, '2019-10-16 12:38:35', '2019-10-16 12:38:35'),
(159, '123', 3, 8, 1, '2019-10-16 12:39:35', '2019-10-16 12:39:35'),
(160, '123', 3, 7, 1, '2019-10-16 12:40:35', '2019-10-16 12:40:35'),
(161, '123', 3, 8, 1, '2019-10-16 12:41:35', '2019-10-16 12:41:35'),
(162, '123', 3, 8, 1, '2019-10-16 12:42:35', '2019-10-16 12:42:35'),
(163, '123', 3, 8, 1, '2019-10-16 12:43:35', '2019-10-16 12:43:35'),
(164, '123', 3, 8, 1, '2019-10-16 12:44:35', '2019-10-16 12:44:35'),
(165, '123', 3, 8, 1, '2019-10-16 12:45:35', '2019-10-16 12:45:35'),
(166, '123', 3, 8, 1, '2019-10-16 12:46:35', '2019-10-16 12:46:35'),
(167, '123', 3, 8, 1, '2019-10-16 12:47:35', '2019-10-16 12:47:35'),
(168, '123', 3, 8, 1, '2019-10-16 12:48:35', '2019-10-16 12:48:35'),
(169, '123', 3, 7, 1, '2019-10-16 12:49:35', '2019-10-16 12:49:35'),
(170, '123', 3, 8, 1, '2019-10-16 12:50:35', '2019-10-16 12:50:35'),
(171, '123', 3, 8, 1, '2019-10-16 12:51:35', '2019-10-16 12:51:35'),
(172, '123', 3, 7, 1, '2019-10-16 12:52:35', '2019-10-16 12:52:35'),
(173, '123', 3, 8, 1, '2019-10-16 12:53:35', '2019-10-16 12:53:35'),
(174, '123', 3, 8, 1, '2019-10-16 12:54:35', '2019-10-16 12:54:35'),
(175, '123', 3, 7, 1, '2019-10-16 12:55:35', '2019-10-16 12:55:35'),
(176, '123', 3, 8, 1, '2019-10-16 12:56:35', '2019-10-16 12:56:35'),
(177, '123', 3, 8, 1, '2019-10-16 12:57:35', '2019-10-16 12:57:35'),
(178, '123', 3, 8, 1, '2019-10-16 12:58:35', '2019-10-16 12:58:35'),
(179, '123', 3, 8, 1, '2019-10-16 12:59:35', '2019-10-16 12:59:35'),
(180, '123', 3, 8, 1, '2019-10-16 13:00:35', '2019-10-16 13:00:35'),
(181, '123', 3, 8, 1, '2019-10-16 13:01:35', '2019-10-16 13:01:35'),
(182, '123', 3, 8, 1, '2019-10-16 13:02:35', '2019-10-16 13:02:35'),
(183, '123', 3, 8, 1, '2019-10-16 13:03:35', '2019-10-16 13:03:35'),
(184, '123', 3, 8, 1, '2019-10-16 13:04:35', '2019-10-16 13:04:35'),
(185, '123', 3, 7, 1, '2019-10-16 13:05:35', '2019-10-16 13:05:35'),
(186, '123', 3, 8, 1, '2019-10-16 13:06:35', '2019-10-16 13:06:35'),
(187, '123', 3, 7, 1, '2019-10-16 13:07:35', '2019-10-16 13:07:35'),
(188, '123', 3, 8, 1, '2019-10-16 13:08:35', '2019-10-16 13:08:35'),
(189, '123', 3, 8, 1, '2019-10-16 13:09:35', '2019-10-16 13:09:35'),
(190, '123', 3, 6, 1, '2019-10-16 13:10:35', '2019-10-16 13:10:35'),
(191, '123', 3, 8, 1, '2019-10-16 13:11:35', '2019-10-16 13:11:35'),
(192, '123', 3, 8, 1, '2019-10-16 13:12:35', '2019-10-16 13:12:35'),
(193, '123', 3, 8, 1, '2019-10-16 13:13:35', '2019-10-16 13:13:35'),
(194, '123', 3, 6, 1, '2019-10-16 13:14:35', '2019-10-16 13:14:35'),
(195, '123', 3, 6, 1, '2019-10-16 13:15:35', '2019-10-16 13:15:35'),
(196, '123', 3, 6, 1, '2019-10-16 13:16:35', '2019-10-16 13:16:35'),
(197, '123', 3, 6, 1, '2019-10-16 13:17:35', '2019-10-16 13:17:35'),
(198, '123', 3, 6, 1, '2019-10-16 13:18:35', '2019-10-16 13:18:35'),
(199, '123', 3, 6, 1, '2019-10-16 13:19:35', '2019-10-16 13:19:35'),
(200, '123', 3, 5, 1, '2019-10-16 13:20:35', '2019-10-16 13:20:35'),
(201, '123', 3, 6, 1, '2019-10-16 13:21:35', '2019-10-16 13:21:35'),
(202, '123', 3, 6, 1, '2019-10-16 13:22:35', '2019-10-16 13:22:35'),
(203, '123', 3, 6, 1, '2019-10-16 13:23:35', '2019-10-16 13:23:35'),
(204, '123', 3, 6, 1, '2019-10-16 13:24:35', '2019-10-16 13:24:35'),
(205, '123', 3, 4, 1, '2019-10-16 13:25:35', '2019-10-16 13:25:35'),
(206, '123', 3, 6, 1, '2019-10-16 13:26:35', '2019-10-16 13:26:35'),
(207, '123', 3, 6, 1, '2019-10-16 13:27:35', '2019-10-16 13:27:35'),
(208, '123', 3, 6, 1, '2019-10-16 13:28:35', '2019-10-16 13:28:35'),
(209, '123', 3, 6, 1, '2019-10-16 13:29:35', '2019-10-16 13:29:35'),
(210, '123', 3, 6, 1, '2019-10-16 13:30:35', '2019-10-16 13:30:35'),
(211, '123', 3, 6, 1, '2019-10-16 13:31:35', '2019-10-16 13:31:35'),
(212, '123', 3, 6, 1, '2019-10-16 13:32:35', '2019-10-16 13:32:35'),
(213, '123', 3, 6, 1, '2019-10-16 13:33:35', '2019-10-16 13:33:35'),
(214, '123', 3, 6, 1, '2019-10-16 13:34:35', '2019-10-16 13:34:35'),
(215, '123', 3, 6, 1, '2019-10-16 13:35:35', '2019-10-16 13:35:35'),
(216, '123', 3, 5, 1, '2019-10-16 13:36:35', '2019-10-16 13:36:35'),
(217, '123', 3, 6, 1, '2019-10-16 13:37:35', '2019-10-16 13:37:35'),
(218, '123', 3, 6, 1, '2019-10-16 13:38:35', '2019-10-16 13:38:35'),
(219, '123', 3, 6, 1, '2019-10-16 13:39:35', '2019-10-16 13:39:35'),
(220, '123', 3, 5, 1, '2019-10-16 13:40:35', '2019-10-16 13:40:35'),
(221, '123', 3, 5, 1, '2019-10-16 13:41:35', '2019-10-16 13:41:35'),
(222, '123', 3, 6, 1, '2019-10-16 13:42:35', '2019-10-16 13:42:35'),
(223, '123', 1, 2, 1, '2019-10-16 13:43:35', '2019-10-16 13:43:35'),
(224, '123', 1, 2, 1, '2019-10-16 13:44:35', '2019-10-16 13:44:35'),
(225, '123', 1, 1, 1, '2019-10-16 13:45:35', '2019-10-16 13:45:35'),
(226, '123', 1, 2, 1, '2019-10-16 13:46:35', '2019-10-16 13:46:35'),
(227, '123', 1, 2, 1, '2019-10-16 13:47:35', '2019-10-16 13:47:35'),
(228, '123', 1, 2, 1, '2019-10-16 13:48:35', '2019-10-16 13:48:35'),
(229, '123', 1, 2, 1, '2019-10-16 13:49:35', '2019-10-16 13:49:35'),
(230, '123', 1, 2, 1, '2019-10-16 13:50:35', '2019-10-16 13:50:35'),
(231, '123', 1, 2, 1, '2019-10-16 13:51:35', '2019-10-16 13:51:35'),
(232, '123', 1, 2, 1, '2019-10-16 13:52:35', '2019-10-16 13:52:35'),
(233, '123', 1, 2, 1, '2019-10-16 13:53:35', '2019-10-16 13:53:35'),
(234, '123', 1, 2, 1, '2019-10-16 13:54:35', '2019-10-16 13:54:35'),
(235, '123', 1, 2, 1, '2019-10-16 13:55:35', '2019-10-16 13:55:35'),
(236, '123', 1, 2, 1, '2019-10-16 13:56:35', '2019-10-16 13:56:35'),
(237, '123', 1, 2, 1, '2019-10-16 13:57:35', '2019-10-16 13:57:35'),
(238, '123', 1, 2, 1, '2019-10-16 13:58:35', '2019-10-16 13:58:35'),
(239, '123', 1, 2, 1, '2019-10-16 13:59:35', '2019-10-16 13:59:35'),
(240, '123', 1, 1, 1, '2019-10-16 14:00:35', '2019-10-16 14:00:35'),
(241, '123', 1, 2, 1, '2019-10-16 14:01:35', '2019-10-16 14:01:35'),
(242, '123', 1, 2, 1, '2019-10-16 14:02:35', '2019-10-16 14:02:35'),
(243, '123', 1, 2, 1, '2019-10-16 14:03:35', '2019-10-16 14:03:35'),
(244, '123', 1, 2, 1, '2019-10-16 14:04:35', '2019-10-16 14:04:35'),
(245, '123', 1, 2, 1, '2019-10-16 14:05:35', '2019-10-16 14:05:35'),
(246, '123', 1, 2, 1, '2019-10-16 14:06:35', '2019-10-16 14:06:35'),
(247, '123', 1, 2, 1, '2019-10-16 14:07:36', '2019-10-16 14:07:36'),
(248, '123', 1, 2, 1, '2019-10-16 14:08:35', '2019-10-16 14:08:35'),
(249, '123', 1, 2, 1, '2019-10-16 14:09:36', '2019-10-16 14:09:36'),
(250, '123', 1, 2, 1, '2019-10-16 14:10:36', '2019-10-16 14:10:36'),
(251, '123', 1, 2, 1, '2019-10-16 14:11:36', '2019-10-16 14:11:36'),
(252, '123', 1, 2, 1, '2019-10-16 14:12:36', '2019-10-16 14:12:36'),
(253, '123', 1, 2, 1, '2019-10-16 14:13:36', '2019-10-16 14:13:36'),
(254, '123', 1, 2, 1, '2019-10-16 14:14:36', '2019-10-16 14:14:36'),
(255, '123', 1, 2, 1, '2019-10-16 14:15:36', '2019-10-16 14:15:36'),
(256, '123', 1, 1, 1, '2019-10-16 14:16:36', '2019-10-16 14:16:36'),
(257, '123', 1, 2, 1, '2019-10-16 14:17:36', '2019-10-16 14:17:36'),
(258, '123', 1, 2, 1, '2019-10-16 14:18:36', '2019-10-16 14:18:36'),
(259, '123', 1, 2, 1, '2019-10-16 14:19:36', '2019-10-16 14:19:36'),
(260, '123', 1, 2, 1, '2019-10-16 14:20:36', '2019-10-16 14:20:36'),
(261, '123', 1, 2, 1, '2019-10-16 14:21:36', '2019-10-16 14:21:36'),
(262, '123', 1, 2, 1, '2019-10-16 14:22:36', '2019-10-16 14:22:36'),
(263, '123', 1, 2, 1, '2019-10-16 14:23:36', '2019-10-16 14:23:36'),
(264, '123', 1, 2, 1, '2019-10-16 14:24:36', '2019-10-16 14:24:36'),
(265, '123', 1, 2, 1, '2019-10-16 14:25:36', '2019-10-16 14:25:36'),
(266, '123', 1, 2, 1, '2019-10-16 14:26:36', '2019-10-16 14:26:36'),
(267, '123', 1, 2, 1, '2019-10-16 14:27:36', '2019-10-16 14:27:36'),
(268, '123', 1, 2, 1, '2019-10-16 14:28:36', '2019-10-16 14:28:36'),
(269, '123', 1, 2, 1, '2019-10-16 14:29:36', '2019-10-16 14:29:36'),
(270, '123', 1, 2, 1, '2019-10-16 14:30:36', '2019-10-16 14:30:36'),
(271, '123', 1, 2, 1, '2019-10-16 14:31:36', '2019-10-16 14:31:36'),
(272, '123', 1, 0, 1, '2019-10-16 14:32:36', '2019-10-16 14:32:36'),
(273, '123', 0, 0, 1, '2019-10-16 14:33:36', '2019-10-16 14:33:36'),
(274, '123', 0, 0, 1, '2019-10-16 14:34:36', '2019-10-16 14:34:36'),
(275, '123', 0, 0, 1, '2019-10-16 14:35:36', '2019-10-16 14:35:36'),
(276, '123', 0, 0, 1, '2019-10-16 14:36:36', '2019-10-16 14:36:36'),
(277, '123', 0, 0, 1, '2019-10-16 14:37:36', '2019-10-16 14:37:36'),
(278, '123', 0, 0, 1, '2019-10-16 14:38:36', '2019-10-16 14:38:36'),
(279, '123', 0, 0, 1, '2019-10-16 14:39:36', '2019-10-16 14:39:36'),
(280, '123', 0, 0, 1, '2019-10-16 14:40:36', '2019-10-16 14:40:36'),
(281, '123', 0, 0, 1, '2019-10-16 14:41:36', '2019-10-16 14:41:36'),
(282, '123', 0, 0, 1, '2019-10-16 14:42:36', '2019-10-16 14:42:36'),
(283, '123', 0, 0, 1, '2019-10-16 14:43:36', '2019-10-16 14:43:36'),
(284, '123', 0, 0, 1, '2019-10-16 14:44:36', '2019-10-16 14:44:36'),
(285, '123', 0, 0, 1, '2019-10-16 14:45:36', '2019-10-16 14:45:36'),
(286, '123', 0, 0, 1, '2019-10-16 14:46:36', '2019-10-16 14:46:36'),
(287, '123', 0, 0, 1, '2019-10-16 14:47:36', '2019-10-16 14:47:36'),
(288, '123', 0, 0, 1, '2019-10-16 14:48:36', '2019-10-16 14:48:36'),
(289, '123', 0, 0, 1, '2019-10-16 14:49:36', '2019-10-16 14:49:36'),
(290, '123', 0, 0, 1, '2019-10-16 14:50:36', '2019-10-16 14:50:36'),
(291, '123', 0, 0, 1, '2019-10-16 14:51:36', '2019-10-16 14:51:36'),
(292, '123', 0, 0, 1, '2019-10-16 14:52:36', '2019-10-16 14:52:36'),
(293, '123', 0, 0, 1, '2019-10-16 14:53:37', '2019-10-16 14:53:37'),
(294, '123', 0, 0, 1, '2019-10-16 14:54:37', '2019-10-16 14:54:37'),
(295, '123', 0, 0, 1, '2019-10-16 14:55:37', '2019-10-16 14:55:37'),
(296, '123', 0, 0, 1, '2019-10-16 14:56:37', '2019-10-16 14:56:37'),
(297, '123', 0, 0, 1, '2019-10-16 14:57:37', '2019-10-16 14:57:37'),
(298, '123', 0, 0, 1, '2019-10-16 14:58:37', '2019-10-16 14:58:37'),
(299, '123', 0, 0, 1, '2019-10-16 14:59:37', '2019-10-16 14:59:37'),
(300, '123', 0, 0, 1, '2019-10-16 15:00:37', '2019-10-16 15:00:37'),
(301, '123', 0, 0, 1, '2019-10-16 15:01:37', '2019-10-16 15:01:37'),
(302, '123', 0, 0, 1, '2019-10-16 15:02:37', '2019-10-16 15:02:37'),
(303, '123', 0, 0, 1, '2019-10-16 15:03:37', '2019-10-16 15:03:37'),
(304, '123', 0, 0, 1, '2019-10-16 15:04:37', '2019-10-16 15:04:37'),
(305, '123', 0, 0, 1, '2019-10-16 15:05:37', '2019-10-16 15:05:37'),
(306, '123', 0, 0, 1, '2019-10-16 15:06:37', '2019-10-16 15:06:37'),
(307, '123', 0, 0, 1, '2019-10-16 15:07:37', '2019-10-16 15:07:37'),
(308, '123', 0, 0, 1, '2019-10-16 15:08:37', '2019-10-16 15:08:37'),
(309, '123', 0, 0, 1, '2019-10-16 15:09:37', '2019-10-16 15:09:37'),
(310, '123', 0, 0, 1, '2019-10-16 15:10:37', '2019-10-16 15:10:37'),
(311, '123', 0, 0, 1, '2019-10-16 15:11:37', '2019-10-16 15:11:37'),
(312, '123', 0, 0, 1, '2019-10-16 15:12:37', '2019-10-16 15:12:37'),
(313, '123', 0, 0, 1, '2019-10-16 15:13:37', '2019-10-16 15:13:37'),
(314, '123', 0, 0, 1, '2019-10-16 15:14:37', '2019-10-16 15:14:37'),
(315, '123', 0, 0, 1, '2019-10-16 15:15:37', '2019-10-16 15:15:37'),
(316, '123', 0, 0, 1, '2019-10-16 15:16:37', '2019-10-16 15:16:37'),
(317, '123', 0, 0, 1, '2019-10-16 15:17:37', '2019-10-16 15:17:37'),
(318, '123', 0, 0, 1, '2019-10-16 15:18:38', '2019-10-16 15:18:38'),
(319, '123', 0, 0, 1, '2019-10-16 15:19:38', '2019-10-16 15:19:38'),
(320, '123', 0, 0, 1, '2019-10-16 15:20:38', '2019-10-16 15:20:38'),
(321, '123', 0, 0, 1, '2019-10-16 15:21:38', '2019-10-16 15:21:38'),
(322, '123', 0, 0, 1, '2019-10-16 15:22:38', '2019-10-16 15:22:38'),
(323, '123', 0, 0, 1, '2019-10-16 15:23:38', '2019-10-16 15:23:38'),
(324, '123', 0, 0, 1, '2019-10-16 15:24:38', '2019-10-16 15:24:38'),
(325, '123', 0, 0, 1, '2019-10-16 15:25:38', '2019-10-16 15:25:38'),
(326, '123', 0, 0, 1, '2019-10-16 15:26:38', '2019-10-16 15:26:38'),
(327, '123', 0, 0, 1, '2019-10-16 15:27:38', '2019-10-16 15:27:38'),
(328, '123', 0, 0, 1, '2019-10-16 15:28:38', '2019-10-16 15:28:38'),
(329, '123', 0, 0, 1, '2019-10-16 15:29:38', '2019-10-16 15:29:38'),
(330, '123', 0, 0, 1, '2019-10-16 15:30:38', '2019-10-16 15:30:38'),
(331, '123', 0, 0, 1, '2019-10-16 15:31:38', '2019-10-16 15:31:38'),
(332, '123', 0, 0, 1, '2019-10-16 15:32:38', '2019-10-16 15:32:38'),
(333, '123', 0, 0, 1, '2019-10-16 15:33:38', '2019-10-16 15:33:38'),
(334, '123', 0, 0, 1, '2019-10-16 15:34:38', '2019-10-16 15:34:38'),
(335, '123', 0, 0, 1, '2019-10-16 15:35:38', '2019-10-16 15:35:38'),
(336, '123', 0, 0, 1, '2019-10-16 15:36:38', '2019-10-16 15:36:38'),
(337, '123', 0, 0, 1, '2019-10-16 15:37:38', '2019-10-16 15:37:38'),
(338, '123', 0, 0, 1, '2019-10-16 15:38:38', '2019-10-16 15:38:38'),
(339, '123', 0, 0, 1, '2019-10-16 15:39:39', '2019-10-16 15:39:39'),
(340, '123', 0, 0, 1, '2019-10-16 15:40:39', '2019-10-16 15:40:39'),
(341, '123', 0, 0, 1, '2019-10-16 15:41:39', '2019-10-16 15:41:39'),
(342, '123', 0, 0, 1, '2019-10-16 15:42:39', '2019-10-16 15:42:39'),
(343, '123', 0, 0, 1, '2019-10-16 15:43:39', '2019-10-16 15:43:39'),
(344, '123', 0, 0, 1, '2019-10-16 15:44:39', '2019-10-16 15:44:39'),
(345, '123', 0, 0, 1, '2019-10-16 15:45:39', '2019-10-16 15:45:39'),
(346, '123', 0, 0, 1, '2019-10-16 15:46:39', '2019-10-16 15:46:39'),
(347, '123', 0, 0, 1, '2019-10-16 15:47:39', '2019-10-16 15:47:39'),
(348, '123', 0, 0, 1, '2019-10-16 15:48:39', '2019-10-16 15:48:39'),
(349, '123', 0, 0, 1, '2019-10-16 15:49:39', '2019-10-16 15:49:39'),
(350, '123', 0, 0, 1, '2019-10-16 15:50:39', '2019-10-16 15:50:39'),
(351, '123', 0, 0, 1, '2019-10-16 15:51:39', '2019-10-16 15:51:39'),
(352, '123', 0, 0, 1, '2019-10-16 15:52:39', '2019-10-16 15:52:39'),
(353, '123', 0, 0, 1, '2019-10-16 15:53:39', '2019-10-16 15:53:39'),
(354, '123', 0, 0, 1, '2019-10-16 15:54:39', '2019-10-16 15:54:39'),
(355, '123', 0, 0, 1, '2019-10-16 15:55:39', '2019-10-16 15:55:39'),
(356, '123', 0, 0, 1, '2019-10-16 15:56:39', '2019-10-16 15:56:39'),
(357, '123', 0, 0, 1, '2019-10-16 15:57:39', '2019-10-16 15:57:39'),
(358, '123', 0, 0, 1, '2019-10-16 15:58:39', '2019-10-16 15:58:39'),
(359, '123', 0, 0, 1, '2019-10-16 15:59:39', '2019-10-16 15:59:39'),
(360, '123', 0, 0, 1, '2019-10-16 16:00:39', '2019-10-16 16:00:39'),
(361, '123', 0, 0, 1, '2019-10-16 16:01:39', '2019-10-16 16:01:39'),
(362, '123', 0, 0, 1, '2019-10-16 16:02:39', '2019-10-16 16:02:39'),
(363, '123', 0, 0, 1, '2019-10-16 16:03:39', '2019-10-16 16:03:39'),
(364, '123', 0, 0, 1, '2019-10-16 16:04:39', '2019-10-16 16:04:39'),
(365, '123', 0, 0, 1, '2019-10-16 16:05:39', '2019-10-16 16:05:39'),
(366, '123', 0, 0, 1, '2019-10-16 16:06:39', '2019-10-16 16:06:39'),
(367, '123', 0, 0, 1, '2019-10-16 16:07:39', '2019-10-16 16:07:39'),
(368, '123', 0, 0, 1, '2019-10-16 16:08:39', '2019-10-16 16:08:39'),
(369, '123', 0, 0, 1, '2019-10-16 16:09:40', '2019-10-16 16:09:40'),
(370, '123', 0, 0, 1, '2019-10-16 16:10:40', '2019-10-16 16:10:40'),
(371, '123', 0, 0, 1, '2019-10-16 16:11:40', '2019-10-16 16:11:40'),
(372, '123', 0, 0, 1, '2019-10-16 16:12:40', '2019-10-16 16:12:40'),
(373, '123', 0, 0, 1, '2019-10-16 16:13:40', '2019-10-16 16:13:40'),
(374, '123', 0, 0, 1, '2019-10-16 16:14:40', '2019-10-16 16:14:40'),
(375, '123', 0, 0, 1, '2019-10-16 16:15:40', '2019-10-16 16:15:40'),
(376, '123', 0, 0, 1, '2019-10-16 16:16:40', '2019-10-16 16:16:40'),
(377, '123', 0, 0, 1, '2019-10-16 16:17:40', '2019-10-16 16:17:40'),
(378, '123', 0, 0, 1, '2019-10-16 16:18:40', '2019-10-16 16:18:40'),
(379, '123', 0, 0, 1, '2019-10-16 16:19:40', '2019-10-16 16:19:40'),
(380, '123', 0, 0, 1, '2019-10-16 16:20:40', '2019-10-16 16:20:40'),
(381, '123', 0, 0, 1, '2019-10-16 16:21:40', '2019-10-16 16:21:40'),
(382, '123', 0, 0, 1, '2019-10-16 16:22:40', '2019-10-16 16:22:40'),
(383, '123', 0, 0, 1, '2019-10-16 16:23:40', '2019-10-16 16:23:40'),
(384, '123', 0, 0, 1, '2019-10-16 16:24:40', '2019-10-16 16:24:40'),
(385, '123', 0, 0, 1, '2019-10-16 16:25:40', '2019-10-16 16:25:40'),
(386, '123', 0, 0, 1, '2019-10-16 16:26:40', '2019-10-16 16:26:40'),
(387, '123', 0, 0, 1, '2019-10-16 16:27:40', '2019-10-16 16:27:40'),
(388, '123', 0, 0, 1, '2019-10-16 16:28:40', '2019-10-16 16:28:40'),
(389, '123', 0, 0, 1, '2019-10-16 16:29:40', '2019-10-16 16:29:40'),
(390, '123', 0, 0, 1, '2019-10-16 16:30:40', '2019-10-16 16:30:40'),
(391, '123', 0, 0, 1, '2019-10-16 16:31:40', '2019-10-16 16:31:40'),
(392, '123', 0, 0, 1, '2019-10-16 16:32:40', '2019-10-16 16:32:40'),
(393, '123', 0, 0, 1, '2019-10-16 16:33:40', '2019-10-16 16:33:40'),
(394, '123', 0, 0, 1, '2019-10-16 16:34:40', '2019-10-16 16:34:40'),
(395, '123', 0, 0, 1, '2019-10-16 16:35:40', '2019-10-16 16:35:40'),
(396, '123', 0, 0, 1, '2019-10-16 16:36:40', '2019-10-16 16:36:40'),
(397, '123', 0, 0, 1, '2019-10-16 16:37:41', '2019-10-16 16:37:41'),
(398, '123', 0, 0, 1, '2019-10-16 16:38:40', '2019-10-16 16:38:40'),
(399, '123', 0, 0, 1, '2019-10-16 16:39:41', '2019-10-16 16:39:41'),
(400, '123', 0, 0, 1, '2019-10-16 16:40:41', '2019-10-16 16:40:41'),
(401, '123', 0, 0, 1, '2019-10-16 16:41:41', '2019-10-16 16:41:41'),
(402, '123', 0, 0, 1, '2019-10-16 16:42:41', '2019-10-16 16:42:41'),
(403, '123', 0, 0, 1, '2019-10-16 16:43:41', '2019-10-16 16:43:41'),
(404, '123', 0, 0, 1, '2019-10-16 16:44:41', '2019-10-16 16:44:41'),
(405, '123', 0, 0, 1, '2019-10-16 16:45:41', '2019-10-16 16:45:41'),
(406, '123', 0, 0, 1, '2019-10-16 16:46:41', '2019-10-16 16:46:41'),
(407, '123', 0, 0, 1, '2019-10-16 16:47:41', '2019-10-16 16:47:41'),
(408, '123', 0, 0, 1, '2019-10-16 16:48:41', '2019-10-16 16:48:41'),
(409, '123', 0, 0, 1, '2019-10-16 16:49:41', '2019-10-16 16:49:41'),
(410, '123', 0, 0, 1, '2019-10-16 16:50:41', '2019-10-16 16:50:41'),
(411, '123', 0, 0, 1, '2019-10-16 16:51:41', '2019-10-16 16:51:41'),
(412, '123', 0, 0, 1, '2019-10-16 16:52:41', '2019-10-16 16:52:41'),
(413, '123', 0, 0, 1, '2019-10-16 16:53:41', '2019-10-16 16:53:41'),
(414, '123', 0, 0, 1, '2019-10-16 16:54:41', '2019-10-16 16:54:41'),
(415, '123', 0, 0, 1, '2019-10-16 16:55:41', '2019-10-16 16:55:41'),
(416, '123', 0, 0, 1, '2019-10-16 16:56:41', '2019-10-16 16:56:41'),
(417, '123', 0, 0, 1, '2019-10-16 16:57:41', '2019-10-16 16:57:41'),
(418, '123', 0, 0, 1, '2019-10-16 16:58:41', '2019-10-16 16:58:41'),
(419, '123', 0, 0, 1, '2019-10-16 16:59:41', '2019-10-16 16:59:41'),
(420, '123', 0, 0, 1, '2019-10-16 17:00:41', '2019-10-16 17:00:41'),
(421, '123', 0, 0, 1, '2019-10-16 17:01:41', '2019-10-16 17:01:41'),
(422, '123', 0, 0, 1, '2019-10-16 17:02:41', '2019-10-16 17:02:41'),
(423, '123', 0, 0, 1, '2019-10-16 17:03:41', '2019-10-16 17:03:41'),
(424, '123', 0, 0, 1, '2019-10-16 17:04:41', '2019-10-16 17:04:41'),
(425, '123', 0, 0, 1, '2019-10-16 17:05:42', '2019-10-16 17:05:42'),
(426, '123', 0, 0, 1, '2019-10-16 17:06:41', '2019-10-16 17:06:41'),
(427, '123', 0, 0, 1, '2019-10-16 17:07:41', '2019-10-16 17:07:41'),
(428, '123', 0, 0, 1, '2019-10-16 17:08:42', '2019-10-16 17:08:42'),
(429, '123', 0, 0, 1, '2019-10-16 17:09:42', '2019-10-16 17:09:42'),
(430, '123', 0, 0, 1, '2019-10-16 17:10:42', '2019-10-16 17:10:42'),
(431, '123', 0, 0, 1, '2019-10-16 17:11:42', '2019-10-16 17:11:42'),
(432, '123', 0, 0, 1, '2019-10-16 17:12:42', '2019-10-16 17:12:42'),
(433, '123', 0, 0, 1, '2019-10-16 17:13:42', '2019-10-16 17:13:42'),
(434, '123', 0, 0, 1, '2019-10-16 17:14:42', '2019-10-16 17:14:42'),
(435, '123', 0, 0, 1, '2019-10-16 17:15:42', '2019-10-16 17:15:42'),
(436, '123', 0, 0, 1, '2019-10-16 17:16:42', '2019-10-16 17:16:42'),
(437, '123', 0, 0, 1, '2019-10-16 17:17:42', '2019-10-16 17:17:42'),
(438, '123', 0, 0, 1, '2019-10-16 17:18:42', '2019-10-16 17:18:42'),
(439, '123', 0, 0, 1, '2019-10-16 17:19:42', '2019-10-16 17:19:42'),
(440, '123', 0, 0, 1, '2019-10-16 17:20:42', '2019-10-16 17:20:42'),
(441, '123', 0, 0, 1, '2019-10-16 17:21:42', '2019-10-16 17:21:42'),
(442, '123', 0, 0, 1, '2019-10-16 17:22:42', '2019-10-16 17:22:42'),
(443, '123', 0, 0, 1, '2019-10-16 17:23:42', '2019-10-16 17:23:42'),
(444, '123', 0, 0, 1, '2019-10-16 17:24:42', '2019-10-16 17:24:42'),
(445, '123', 0, 0, 1, '2019-10-16 17:25:42', '2019-10-16 17:25:42'),
(446, '123', 0, 0, 1, '2019-10-16 17:26:42', '2019-10-16 17:26:42'),
(447, '123', 0, 0, 1, '2019-10-16 17:27:42', '2019-10-16 17:27:42'),
(448, '123', 0, 0, 1, '2019-10-16 17:28:42', '2019-10-16 17:28:42'),
(449, '123', 0, 0, 1, '2019-10-16 17:29:42', '2019-10-16 17:29:42'),
(450, '123', 0, 0, 1, '2019-10-16 17:30:42', '2019-10-16 17:30:42'),
(451, '123', 0, 0, 1, '2019-10-16 17:31:42', '2019-10-16 17:31:42'),
(452, '123', 0, 0, 1, '2019-10-16 17:32:42', '2019-10-16 17:32:42'),
(453, '123', 0, 0, 1, '2019-10-16 17:33:43', '2019-10-16 17:33:43'),
(454, '123', 0, 0, 1, '2019-10-16 17:34:43', '2019-10-16 17:34:43'),
(455, '123', 0, 0, 1, '2019-10-16 17:35:43', '2019-10-16 17:35:43'),
(456, '123', 0, 0, 1, '2019-10-16 17:36:43', '2019-10-16 17:36:43'),
(457, '123', 0, 0, 1, '2019-10-16 17:37:43', '2019-10-16 17:37:43'),
(458, '123', 0, 0, 1, '2019-10-16 17:38:43', '2019-10-16 17:38:43'),
(459, '123', 0, 0, 1, '2019-10-16 17:39:43', '2019-10-16 17:39:43'),
(460, '123', 0, 0, 1, '2019-10-16 17:40:43', '2019-10-16 17:40:43'),
(461, '123', 0, 0, 1, '2019-10-16 17:41:43', '2019-10-16 17:41:43'),
(462, '123', 0, 0, 1, '2019-10-16 17:42:43', '2019-10-16 17:42:43'),
(463, '123', 0, 0, 1, '2019-10-16 17:43:43', '2019-10-16 17:43:43'),
(464, '123', 0, 0, 1, '2019-10-16 17:44:43', '2019-10-16 17:44:43'),
(465, '123', 0, 0, 1, '2019-10-16 17:45:43', '2019-10-16 17:45:43'),
(466, '123', 0, 0, 1, '2019-10-16 17:46:43', '2019-10-16 17:46:43'),
(467, '123', 0, 0, 1, '2019-10-16 17:47:43', '2019-10-16 17:47:43'),
(468, '123', 0, 0, 1, '2019-10-16 17:48:43', '2019-10-16 17:48:43'),
(469, '123', 0, 0, 1, '2019-10-16 17:49:43', '2019-10-16 17:49:43'),
(470, '123', 0, 0, 1, '2019-10-16 17:50:43', '2019-10-16 17:50:43'),
(471, '123', 0, 0, 1, '2019-10-16 17:51:43', '2019-10-16 17:51:43'),
(472, '123', 0, 0, 1, '2019-10-16 17:52:43', '2019-10-16 17:52:43'),
(473, '123', 0, 0, 1, '2019-10-16 17:53:43', '2019-10-16 17:53:43'),
(474, '123', 0, 0, 1, '2019-10-16 17:54:43', '2019-10-16 17:54:43'),
(475, '123', 0, 0, 1, '2019-10-16 17:55:43', '2019-10-16 17:55:43'),
(476, '123', 0, 0, 1, '2019-10-16 17:56:43', '2019-10-16 17:56:43'),
(477, '123', 0, 0, 1, '2019-10-16 17:57:43', '2019-10-16 17:57:43'),
(478, '123', 0, 0, 1, '2019-10-16 17:58:44', '2019-10-16 17:58:44'),
(479, '123', 0, 0, 1, '2019-10-16 17:59:44', '2019-10-16 17:59:44'),
(480, '123', 0, 0, 1, '2019-10-16 18:00:44', '2019-10-16 18:00:44'),
(481, '123', 0, 0, 1, '2019-10-16 18:01:44', '2019-10-16 18:01:44'),
(482, '123', 0, 0, 1, '2019-10-16 18:02:44', '2019-10-16 18:02:44'),
(483, '123', 0, 0, 1, '2019-10-16 18:03:44', '2019-10-16 18:03:44'),
(484, '123', 0, 0, 1, '2019-10-16 18:04:44', '2019-10-16 18:04:44'),
(485, '123', 0, 0, 1, '2019-10-16 18:05:44', '2019-10-16 18:05:44'),
(486, '123', 0, 0, 1, '2019-10-16 18:06:44', '2019-10-16 18:06:44'),
(487, '123', 0, 0, 1, '2019-10-16 18:07:44', '2019-10-16 18:07:44'),
(488, '123', 0, 0, 1, '2019-10-16 18:08:44', '2019-10-16 18:08:44'),
(489, '123', 0, 0, 1, '2019-10-16 18:09:44', '2019-10-16 18:09:44'),
(490, '123', 0, 0, 1, '2019-10-16 18:10:44', '2019-10-16 18:10:44'),
(491, '123', 0, 0, 1, '2019-10-16 18:11:44', '2019-10-16 18:11:44'),
(492, '123', 0, 0, 1, '2019-10-16 18:12:44', '2019-10-16 18:12:44'),
(493, '123', 0, 0, 1, '2019-10-16 18:13:44', '2019-10-16 18:13:44'),
(494, '123', 0, 0, 1, '2019-10-16 18:14:44', '2019-10-16 18:14:44'),
(495, '123', 0, 0, 1, '2019-10-16 18:15:44', '2019-10-16 18:15:44'),
(496, '123', 0, 0, 1, '2019-10-16 18:16:44', '2019-10-16 18:16:44'),
(497, '123', 0, 0, 1, '2019-10-16 18:17:44', '2019-10-16 18:17:44'),
(498, '123', 0, 0, 1, '2019-10-16 18:18:44', '2019-10-16 18:18:44'),
(499, '123', 0, 0, 1, '2019-10-16 18:19:44', '2019-10-16 18:19:44'),
(500, '123', 0, 0, 1, '2019-10-16 18:20:44', '2019-10-16 18:20:44'),
(501, '123', 0, 0, 1, '2019-10-16 18:21:44', '2019-10-16 18:21:44'),
(502, '123', 0, 0, 1, '2019-10-16 18:22:44', '2019-10-16 18:22:44'),
(503, '123', 0, 0, 1, '2019-10-16 18:23:44', '2019-10-16 18:23:44'),
(504, '123', 0, 0, 1, '2019-10-16 18:24:44', '2019-10-16 18:24:44'),
(505, '123', 0, 0, 1, '2019-10-16 18:25:45', '2019-10-16 18:25:45'),
(506, '123', 0, 0, 1, '2019-10-16 18:26:45', '2019-10-16 18:26:45'),
(507, '123', 0, 0, 1, '2019-10-16 18:27:45', '2019-10-16 18:27:45'),
(508, '123', 0, 0, 1, '2019-10-16 18:28:45', '2019-10-16 18:28:45'),
(509, '123', 0, 0, 1, '2019-10-16 18:29:45', '2019-10-16 18:29:45'),
(510, '123', 0, 0, 1, '2019-10-16 18:30:45', '2019-10-16 18:30:45'),
(511, '123', 0, 0, 1, '2019-10-16 18:31:45', '2019-10-16 18:31:45'),
(512, '123', 0, 0, 1, '2019-10-16 18:32:45', '2019-10-16 18:32:45'),
(513, '123', 0, 0, 1, '2019-10-16 18:33:45', '2019-10-16 18:33:45'),
(514, '123', 0, 0, 1, '2019-10-16 18:34:45', '2019-10-16 18:34:45'),
(515, '123', 0, 0, 1, '2019-10-16 18:35:45', '2019-10-16 18:35:45'),
(516, '123', 0, 0, 1, '2019-10-16 18:36:45', '2019-10-16 18:36:45'),
(517, '123', 0, 0, 1, '2019-10-16 18:37:45', '2019-10-16 18:37:45'),
(518, '123', 0, 0, 1, '2019-10-16 18:38:45', '2019-10-16 18:38:45'),
(519, '123', 0, 0, 1, '2019-10-16 18:39:45', '2019-10-16 18:39:45'),
(520, '123', 0, 0, 1, '2019-10-16 18:40:45', '2019-10-16 18:40:45'),
(521, '123', 0, 0, 1, '2019-10-16 18:41:45', '2019-10-16 18:41:45'),
(522, '123', 0, 0, 1, '2019-10-16 18:42:45', '2019-10-16 18:42:45'),
(523, '123', 0, 0, 1, '2019-10-16 18:43:45', '2019-10-16 18:43:45'),
(524, '123', 0, 0, 1, '2019-10-16 18:44:45', '2019-10-16 18:44:45'),
(525, '123', 0, 0, 1, '2019-10-16 18:45:45', '2019-10-16 18:45:45'),
(526, '123', 0, 0, 1, '2019-10-16 18:46:45', '2019-10-16 18:46:45'),
(527, '123', 0, 0, 1, '2019-10-16 18:47:45', '2019-10-16 18:47:45'),
(528, '123', 0, 0, 1, '2019-10-16 18:48:45', '2019-10-16 18:48:45'),
(529, '123', 0, 0, 1, '2019-10-16 18:49:45', '2019-10-16 18:49:45'),
(530, '123', 0, 0, 1, '2019-10-16 18:50:45', '2019-10-16 18:50:45'),
(531, '123', 0, 0, 1, '2019-10-16 18:51:46', '2019-10-16 18:51:46'),
(532, '123', 0, 0, 1, '2019-10-16 18:52:46', '2019-10-16 18:52:46'),
(533, '123', 0, 0, 1, '2019-10-16 18:53:46', '2019-10-16 18:53:46'),
(534, '123', 0, 0, 1, '2019-10-16 18:54:46', '2019-10-16 18:54:46'),
(535, '123', 0, 0, 1, '2019-10-16 18:55:46', '2019-10-16 18:55:46'),
(536, '123', 0, 0, 1, '2019-10-16 18:56:46', '2019-10-16 18:56:46'),
(537, '123', 0, 0, 1, '2019-10-16 18:57:46', '2019-10-16 18:57:46'),
(538, '123', 0, 0, 1, '2019-10-16 18:58:46', '2019-10-16 18:58:46'),
(539, '123', 0, 0, 1, '2019-10-16 18:59:46', '2019-10-16 18:59:46'),
(540, '123', 0, 0, 1, '2019-10-16 19:00:46', '2019-10-16 19:00:46'),
(541, '123', 0, 0, 1, '2019-10-16 19:01:46', '2019-10-16 19:01:46'),
(542, '123', 0, 0, 1, '2019-10-16 19:02:46', '2019-10-16 19:02:46'),
(543, '123', 0, 0, 1, '2019-10-16 19:03:46', '2019-10-16 19:03:46'),
(544, '123', 0, 0, 1, '2019-10-16 19:04:46', '2019-10-16 19:04:46'),
(545, '123', 0, 0, 1, '2019-10-16 19:05:46', '2019-10-16 19:05:46'),
(546, '123', 0, 0, 1, '2019-10-16 19:06:46', '2019-10-16 19:06:46'),
(547, '123', 0, 0, 1, '2019-10-16 19:07:46', '2019-10-16 19:07:46'),
(548, '123', 0, 0, 1, '2019-10-16 19:08:46', '2019-10-16 19:08:46'),
(549, '123', 0, 0, 1, '2019-10-16 19:09:46', '2019-10-16 19:09:46'),
(550, '123', 0, 0, 1, '2019-10-16 19:10:46', '2019-10-16 19:10:46'),
(551, '123', 0, 0, 1, '2019-10-16 19:11:46', '2019-10-16 19:11:46'),
(552, '123', 0, 0, 1, '2019-10-16 19:12:46', '2019-10-16 19:12:46'),
(553, '123', 0, 0, 1, '2019-10-16 19:13:46', '2019-10-16 19:13:46'),
(554, '123', 0, 0, 1, '2019-10-16 19:14:46', '2019-10-16 19:14:46'),
(555, '123', 0, 0, 1, '2019-10-16 19:15:46', '2019-10-16 19:15:46'),
(556, '123', 0, 0, 1, '2019-10-16 19:16:46', '2019-10-16 19:16:46'),
(557, '123', 0, 0, 1, '2019-10-16 19:17:47', '2019-10-16 19:17:47'),
(558, '123', 0, 0, 1, '2019-10-16 19:18:47', '2019-10-16 19:18:47'),
(559, '123', 0, 0, 1, '2019-10-16 19:19:47', '2019-10-16 19:19:47'),
(560, '123', 0, 0, 1, '2019-10-16 19:20:47', '2019-10-16 19:20:47'),
(561, '123', 0, 0, 1, '2019-10-16 19:21:47', '2019-10-16 19:21:47'),
(562, '123', 0, 0, 1, '2019-10-16 19:22:47', '2019-10-16 19:22:47'),
(563, '123', 0, 0, 1, '2019-10-16 19:23:47', '2019-10-16 19:23:47'),
(564, '123', 0, 0, 1, '2019-10-16 19:24:47', '2019-10-16 19:24:47'),
(565, '123', 0, 0, 1, '2019-10-16 19:25:47', '2019-10-16 19:25:47'),
(566, '123', 0, 0, 1, '2019-10-16 19:26:47', '2019-10-16 19:26:47'),
(567, '123', 0, 0, 1, '2019-10-16 19:27:47', '2019-10-16 19:27:47'),
(568, '123', 0, 0, 1, '2019-10-16 19:28:47', '2019-10-16 19:28:47'),
(569, '123', 0, 0, 1, '2019-10-16 19:29:47', '2019-10-16 19:29:47'),
(570, '123', 0, 0, 1, '2019-10-16 19:30:47', '2019-10-16 19:30:47'),
(571, '123', 0, 0, 1, '2019-10-16 19:31:47', '2019-10-16 19:31:47'),
(572, '123', 0, 0, 1, '2019-10-16 19:32:47', '2019-10-16 19:32:47'),
(573, '123', 0, 0, 1, '2019-10-16 19:33:47', '2019-10-16 19:33:47'),
(574, '123', 0, 0, 1, '2019-10-16 19:34:47', '2019-10-16 19:34:47'),
(575, '123', 0, 0, 1, '2019-10-16 19:35:47', '2019-10-16 19:35:47'),
(576, '123', 0, 0, 1, '2019-10-16 19:36:47', '2019-10-16 19:36:47'),
(577, '123', 0, 0, 1, '2019-10-16 19:37:47', '2019-10-16 19:37:47'),
(578, '123', 0, 0, 1, '2019-10-16 19:38:47', '2019-10-16 19:38:47'),
(579, '123', 0, 0, 1, '2019-10-16 19:39:47', '2019-10-16 19:39:47'),
(580, '123', 0, 0, 1, '2019-10-16 19:40:47', '2019-10-16 19:40:47'),
(581, '123', 0, 0, 1, '2019-10-16 19:41:47', '2019-10-16 19:41:47'),
(582, '123', 0, 0, 1, '2019-10-16 19:42:47', '2019-10-16 19:42:47'),
(583, '123', 0, 0, 1, '2019-10-16 19:43:47', '2019-10-16 19:43:47'),
(584, '123', 0, 0, 1, '2019-10-16 19:44:47', '2019-10-16 19:44:47'),
(585, '123', 0, 0, 1, '2019-10-16 19:45:47', '2019-10-16 19:45:47'),
(586, '123', 0, 0, 1, '2019-10-16 19:46:48', '2019-10-16 19:46:48'),
(587, '123', 0, 0, 1, '2019-10-16 19:47:48', '2019-10-16 19:47:48'),
(588, '123', 0, 0, 1, '2019-10-16 19:48:48', '2019-10-16 19:48:48'),
(589, '123', 0, 0, 1, '2019-10-16 19:49:48', '2019-10-16 19:49:48'),
(590, '123', 0, 0, 1, '2019-10-16 19:50:48', '2019-10-16 19:50:48'),
(591, '123', 0, 0, 1, '2019-10-16 19:51:48', '2019-10-16 19:51:48'),
(592, '123', 0, 0, 1, '2019-10-16 19:52:48', '2019-10-16 19:52:48'),
(593, '123', 0, 0, 1, '2019-10-16 19:53:48', '2019-10-16 19:53:48'),
(594, '123', 0, 0, 1, '2019-10-16 19:54:48', '2019-10-16 19:54:48'),
(595, '123', 0, 0, 1, '2019-10-16 19:55:48', '2019-10-16 19:55:48'),
(596, '123', 0, 0, 1, '2019-10-16 19:56:48', '2019-10-16 19:56:48'),
(597, '123', 0, 0, 2, '2019-10-16 19:57:48', '2019-10-16 19:57:48'),
(598, '123', 0, 0, 1, '2019-10-16 19:58:48', '2019-10-16 19:58:48'),
(599, '123', 0, 0, 1, '2019-10-16 19:59:48', '2019-10-16 19:59:48'),
(600, '123', 0, 0, 1, '2019-10-16 20:00:48', '2019-10-16 20:00:48'),
(601, '123', 0, 0, 1, '2019-10-16 20:01:48', '2019-10-16 20:01:48'),
(602, '123', 0, 0, 1, '2019-10-16 20:02:48', '2019-10-16 20:02:48'),
(603, '123', 0, 0, 1, '2019-10-16 20:03:48', '2019-10-16 20:03:48'),
(604, '123', 0, 0, 1, '2019-10-16 20:04:48', '2019-10-16 20:04:48'),
(605, '123', 0, 0, 1, '2019-10-16 20:05:48', '2019-10-16 20:05:48'),
(606, '123', 0, 0, 1, '2019-10-16 20:06:48', '2019-10-16 20:06:48'),
(607, '123', 0, 0, 1, '2019-10-16 20:07:48', '2019-10-16 20:07:48'),
(608, '123', 0, 0, 1, '2019-10-16 20:08:48', '2019-10-16 20:08:48'),
(609, '123', 0, 0, 1, '2019-10-16 20:09:48', '2019-10-16 20:09:48'),
(610, '123', 0, 0, 1, '2019-10-16 20:10:48', '2019-10-16 20:10:48'),
(611, '123', 0, 0, 1, '2019-10-16 20:11:49', '2019-10-16 20:11:49'),
(612, '123', 0, 0, 1, '2019-10-16 20:12:49', '2019-10-16 20:12:49'),
(613, '123', 0, 0, 1, '2019-10-16 20:13:49', '2019-10-16 20:13:49'),
(614, '123', 0, 0, 1, '2019-10-16 20:14:49', '2019-10-16 20:14:49'),
(615, '123', 0, 0, 1, '2019-10-16 20:15:49', '2019-10-16 20:15:49'),
(616, '123', 0, 0, 1, '2019-10-16 20:16:49', '2019-10-16 20:16:49'),
(617, '123', 0, 0, 1, '2019-10-16 20:17:49', '2019-10-16 20:17:49'),
(618, '123', 0, 0, 1, '2019-10-16 20:18:49', '2019-10-16 20:18:49'),
(619, '123', 0, 0, 1, '2019-10-16 20:19:49', '2019-10-16 20:19:49'),
(620, '123', 0, 0, 1, '2019-10-16 20:20:49', '2019-10-16 20:20:49'),
(621, '123', 0, 0, 1, '2019-10-16 20:21:49', '2019-10-16 20:21:49'),
(622, '123', 0, 0, 1, '2019-10-16 20:22:49', '2019-10-16 20:22:49'),
(623, '123', 0, 0, 1, '2019-10-16 20:23:49', '2019-10-16 20:23:49'),
(624, '123', 0, 0, 1, '2019-10-16 20:24:49', '2019-10-16 20:24:49'),
(625, '123', 0, 0, 1, '2019-10-16 20:25:49', '2019-10-16 20:25:49'),
(626, '123', 0, 0, 1, '2019-10-16 20:26:49', '2019-10-16 20:26:49'),
(627, '123', 0, 0, 1, '2019-10-16 20:27:49', '2019-10-16 20:27:49'),
(628, '123', 0, 0, 1, '2019-10-16 20:28:49', '2019-10-16 20:28:49'),
(629, '123', 0, 0, 1, '2019-10-16 20:29:49', '2019-10-16 20:29:49');

-- --------------------------------------------------------

--
-- Structure for view `vw_applicants`
--
DROP TABLE IF EXISTS `vw_applicants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`joudacademy`@`localhost` SQL SECURITY DEFINER VIEW `vw_applicants`  AS  select `users`.`id` AS `id`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`email` AS `email`,`users`.`is_admin` AS `is_admin`,`users`.`type` AS `type`,`users`.`is_active` AS `is_active`,`users`.`image` AS `image`,`users`.`mobile` AS `mobile`,`users`.`email_verified_at` AS `email_verified_at`,`users`.`password` AS `password`,`users`.`remember_token` AS `remember_token`,`users`.`created_at` AS `created_at`,`users`.`updated_at` AS `updated_at`,`roles`.`name` AS `roles_name` from ((`users` left join `model_has_roles` on(`users`.`id` = `model_has_roles`.`model_id`)) join `roles` on(`roles`.`id` = `model_has_roles`.`role_id`)) where `roles`.`name` = 'registered-users' ;

-- --------------------------------------------------------

--
-- Structure for view `vw_course_exams`
--
DROP TABLE IF EXISTS `vw_course_exams`;

CREATE ALGORITHM=UNDEFINED DEFINER=`joudacademy`@`localhost` SQL SECURITY DEFINER VIEW `vw_course_exams`  AS  select `exams`.`id` AS `id`,`exams`.`type_id` AS `course_id`,`exams`.`is_active` AS `is_active`,`exam_data`.`lang_id` AS `lang_id`,`exam_data`.`title` AS `title`,`exam_data`.`description` AS `description` from ((`exams` left join `exam_data` on(`exam_data`.`exam_id` = `exam_data`.`exam_id`)) left join `courses` on(`courses`.`id` = `exams`.`type_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_media_exams`
--
DROP TABLE IF EXISTS `vw_media_exams`;

CREATE ALGORITHM=UNDEFINED DEFINER=`joudacademy`@`localhost` SQL SECURITY DEFINER VIEW `vw_media_exams`  AS  select `exams`.`id` AS `id`,`exams`.`type_id` AS `media_id`,`exams`.`is_active` AS `is_active`,`exam_data`.`lang_id` AS `lang_id`,`exam_data`.`title` AS `title`,`exam_data`.`description` AS `description` from ((`exams` left join `exam_data` on(`exam_data`.`exam_id` = `exam_data`.`exam_id`)) left join `course_media` on(`course_media`.`id` = `exams`.`type_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_trainers`
--
DROP TABLE IF EXISTS `vw_trainers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`joudacademy`@`localhost` SQL SECURITY DEFINER VIEW `vw_trainers`  AS  select `users`.`id` AS `id`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`email` AS `email`,`users`.`is_admin` AS `is_admin`,`users`.`type` AS `type`,`users`.`is_active` AS `is_active`,`users`.`image` AS `image`,`users`.`mobile` AS `mobile`,`users`.`email_verified_at` AS `email_verified_at`,`users`.`password` AS `password`,`users`.`remember_token` AS `remember_token`,`users`.`created_at` AS `created_at`,`users`.`updated_at` AS `updated_at`,`roles`.`name` AS `roles_name` from ((`users` left join `model_has_roles` on(`users`.`id` = `model_has_roles`.`model_id`)) join `roles` on(`roles`.`id` = `model_has_roles`.`role_id`)) where `roles`.`name` = 'trainer' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applicants_personal_id_unique` (`personal_id`),
  ADD KEY `applicants_user_id_foreign` (`user_id`),
  ADD KEY `applicants_country_id_foreign` (`country_id`),
  ADD KEY `applicants_education_level_foreign` (`education_level`);

--
-- Indexes for table `applicant_course`
--
ALTER TABLE `applicant_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_course_course_id_foreign` (`course_id`),
  ADD KEY `applicant_course_applicant_id_foreign` (`applicant_id`),
  ADD KEY `applicant_course_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `applicant_course_pendings`
--
ALTER TABLE `applicant_course_pendings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_course_pendings_course_id_foreign` (`course_id`),
  ADD KEY `applicant_course_pendings_applicant_id_foreign` (`applicant_id`),
  ADD KEY `applicant_course_pendings_coupon_id_foreign` (`coupon_id`),
  ADD KEY `applicant_course_pendings_nationality_id_foreign` (`nationality_id`);

--
-- Indexes for table `applicant_results`
--
ALTER TABLE `applicant_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_results_course_id_foreign` (`course_id`),
  ADD KEY `applicant_results_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `artcl_categories`
--
ALTER TABLE `artcl_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artcl_categories_source_id_foreign` (`source_id`),
  ADD KEY `artcl_categories_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_lang_id_foreign` (`lang_id`),
  ADD KEY `articles_source_id_foreign` (`source_id`),
  ADD KEY `articles_category_id_foreign` (`category_id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_category_category_id_foreign` (`category_id`),
  ADD KEY `article_category_article_id_foreign` (`article_id`);

--
-- Indexes for table `article_data`
--
ALTER TABLE `article_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_data_source_id_foreign` (`source_id`),
  ADD KEY `article_data_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_transfers_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_user_id_foreign` (`user_id`),
  ADD KEY `bills_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`),
  ADD KEY `cities_lang_id_foreign` (`lang_id`),
  ADD KEY `cities_source_id_foreign` (`source_id`);

--
-- Indexes for table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competition_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_lang_id_foreign` (`lang_id`),
  ADD KEY `countries_source_id_foreign` (`source_id`);

--
-- Indexes for table `countries_courses`
--
ALTER TABLE `countries_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_courses_country_id_foreign` (`country_id`),
  ADD KEY `countries_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_user_id_foreign` (`user_id`),
  ADD KEY `courses_currency_id_foreign` (`currency_id`),
  ADD KEY `courses_lang_id_foreign` (`lang_id`),
  ADD KEY `courses_source_id_foreign` (`source_id`);

--
-- Indexes for table `course_comments`
--
ALTER TABLE `course_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_comments_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_evaluations`
--
ALTER TABLE `course_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_evaluations_applicant_id_foreign` (`applicant_id`),
  ADD KEY `course_evaluations_course_id_foreign` (`course_id`),
  ADD KEY `course_evaluations_question_id_foreign` (`question_id`);

--
-- Indexes for table `course_media`
--
ALTER TABLE `course_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_media_course_id_foreign` (`course_id`),
  ADD KEY `course_media_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `course_media_data`
--
ALTER TABLE `course_media_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_media_data_media_id_foreign` (`media_id`),
  ADD KEY `course_media_data_lang_id_foreign` (`lang_id`),
  ADD KEY `course_media_data_source_id_foreign` (`source_id`);

--
-- Indexes for table `course_media_tags`
--
ALTER TABLE `course_media_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_media_tags_media_id_foreign` (`media_id`),
  ADD KEY `course_media_tags_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `course_requests`
--
ALTER TABLE `course_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_requests_user_id_foreign` (`user_id`),
  ADD KEY `course_requests_lang_id_foreign` (`lang_id`),
  ADD KEY `course_requests_source_id_foreign` (`source_id`);

--
-- Indexes for table `co_categories`
--
ALTER TABLE `co_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `co_categories_parent_id_foreign` (`parent_id`),
  ADD KEY `co_categories_lang_id_foreign` (`lang_id`),
  ADD KEY `co_categories_source_id_foreign` (`source_id`);

--
-- Indexes for table `co_category_course`
--
ALTER TABLE `co_category_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `co_category_course_course_id_foreign` (`course_id`),
  ADD KEY `co_category_course_co_category_id_foreign` (`co_category_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_lang_id_foreign` (`lang_id`),
  ADD KEY `currencies_source_id_foreign` (`source_id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `education_levels_country_id_foreign` (`country_id`),
  ADD KEY `education_levels_lang_id_foreign` (`lang_id`),
  ADD KEY `education_levels_source_id_foreign` (`source_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_data`
--
ALTER TABLE `exam_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_data_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_data_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_questions_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_questions_lang_id_foreign` (`lang_id`),
  ADD KEY `exam_questions_source_id_foreign` (`source_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`favoriteable_id`,`favoriteable_type`),
  ADD KEY `favorites_favoriteable_type_favoriteable_id_index` (`favoriteable_type`,`favoriteable_id`),
  ADD KEY `favorites_user_id_index` (`user_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_lang_id_foreign` (`lang_id`),
  ADD KEY `galleries_source_id_foreign` (`source_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_from_id_foreign` (`from_id`),
  ADD KEY `messages_to_id_foreign` (`to_id`);

--
-- Indexes for table `messages_chat`
--
ALTER TABLE `messages_chat`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_courses`
--
ALTER TABLE `order_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_courses_currency_id_foreign` (`currency_id`),
  ADD KEY `order_courses_order_id_foreign` (`order_id`);

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
-- Indexes for table `price_settings`
--
ALTER TABLE `price_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_choices_question_id_foreign` (`question_id`),
  ADD KEY `question_choices_lang_id_foreign` (`lang_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_course_id_foreign` (`course_id`);

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
  ADD KEY `settings_lang_id_foreign` (`lang_id`),
  ADD KEY `settings_source_id_foreign` (`source_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_lang_id_foreign` (`lang_id`),
  ADD KEY `sliders_source_id_foreign` (`source_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainers_user_id_foreign` (`user_id`),
  ADD KEY `trainers_country_id_foreign` (`country_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `transactions_type_id_foreign` (`type_id`),
  ADD KEY `transactions_bank_id_foreign` (`bank_id`),
  ADD KEY `transactions_currency_id_foreign` (`currency_id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_types_lang_id_foreign` (`lang_id`),
  ADD KEY `transaction_types_source_id_foreign` (`source_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_exams`
--
ALTER TABLE `user_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_exams_exam_id_foreign` (`exam_id`),
  ADD KEY `user_exams_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_exam_answers`
--
ALTER TABLE `user_exam_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_exam_answers_question_id_foreign` (`question_id`),
  ADD KEY `user_exam_answers_answer_id_foreign` (`answer_id`),
  ADD KEY `user_exam_answers_exam_id_foreign` (`user_exam_id`);

--
-- Indexes for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rating_user_id_foreign` (`user_id`),
  ADD KEY `user_rating_rating_id_foreign` (`rating_id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `applicant_course`
--
ALTER TABLE `applicant_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applicant_course_pendings`
--
ALTER TABLE `applicant_course_pendings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `applicant_results`
--
ALTER TABLE `applicant_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artcl_categories`
--
ALTER TABLE `artcl_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `article_data`
--
ALTER TABLE `article_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries_courses`
--
ALTER TABLE `countries_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_comments`
--
ALTER TABLE `course_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_evaluations`
--
ALTER TABLE `course_evaluations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_media`
--
ALTER TABLE `course_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_media_data`
--
ALTER TABLE `course_media_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_media_tags`
--
ALTER TABLE `course_media_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_requests`
--
ALTER TABLE `course_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `co_categories`
--
ALTER TABLE `co_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `co_category_course`
--
ALTER TABLE `co_category_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education_levels`
--
ALTER TABLE `education_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_data`
--
ALTER TABLE `exam_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages_chat`
--
ALTER TABLE `messages_chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_courses`
--
ALTER TABLE `order_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `price_settings`
--
ALTER TABLE `price_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_choices`
--
ALTER TABLE `question_choices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_exams`
--
ALTER TABLE `user_exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_exam_answers`
--
ALTER TABLE `user_exam_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=630;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `ap_ed_lvl_fk` FOREIGN KEY (`education_level`) REFERENCES `education_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicants_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applicant_course`
--
ALTER TABLE `applicant_course`
  ADD CONSTRAINT `applicant_course_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`),
  ADD CONSTRAINT `applicant_course_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `discount_codes` (`id`),
  ADD CONSTRAINT `applicant_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `applicant_course_pendings`
--
ALTER TABLE `applicant_course_pendings`
  ADD CONSTRAINT `applicant_course_pendings_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_course_pendings_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `discount_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_course_pendings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_course_pendings_nationality_id_foreign` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applicant_results`
--
ALTER TABLE `applicant_results`
  ADD CONSTRAINT `applicant_results_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applicant_results_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artcl_categories`
--
ALTER TABLE `artcl_categories`
  ADD CONSTRAINT `artcl_categories_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artcl_categories_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `artcl_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `artcl_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_data`
--
ALTER TABLE `article_data`
  ADD CONSTRAINT `article_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD CONSTRAINT `bank_transfers_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `cities_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cities_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `competition`
--
ALTER TABLE `competition`
  ADD CONSTRAINT `competition_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`);

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `countries_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `countries_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `countries_courses`
--
ALTER TABLE `countries_courses`
  ADD CONSTRAINT `countries_courses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `countries_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_comments`
--
ALTER TABLE `course_comments`
  ADD CONSTRAINT `course_comments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_evaluations`
--
ALTER TABLE `course_evaluations`
  ADD CONSTRAINT `course_evaluations_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_evaluations_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_evaluations_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_media`
--
ALTER TABLE `course_media`
  ADD CONSTRAINT `course_media_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_media_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_media_data`
--
ALTER TABLE `course_media_data`
  ADD CONSTRAINT `course_media_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_media_data_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `course_media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_media_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `course_media_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_media_tags`
--
ALTER TABLE `course_media_tags`
  ADD CONSTRAINT `course_media_tags_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_media_tags_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `course_media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_requests`
--
ALTER TABLE `course_requests`
  ADD CONSTRAINT `course_requests_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_requests_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `course_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `co_categories`
--
ALTER TABLE `co_categories`
  ADD CONSTRAINT `co_categories_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `co_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `co_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `co_categories_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `co_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `co_category_course`
--
ALTER TABLE `co_category_course`
  ADD CONSTRAINT `co_category_course_co_category_id_foreign` FOREIGN KEY (`co_category_id`) REFERENCES `co_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `co_category_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `currencies_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD CONSTRAINT `education_levels_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `education_levels_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `education_levels_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `education_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_data`
--
ALTER TABLE `exam_data`
  ADD CONSTRAINT `exam_data_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_questions_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_questions_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `exam_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `galleries_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_courses`
--
ALTER TABLE `order_courses`
  ADD CONSTRAINT `order_courses_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_courses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD CONSTRAINT `question_choices_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_choices_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `exam_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `rating_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
