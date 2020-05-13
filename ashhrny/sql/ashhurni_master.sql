-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2020 at 12:06 PM
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
-- Database: `ashhurni_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_contents`
--

CREATE TABLE `account_contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_contents`
--

INSERT INTO `account_contents` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-01-29 07:46:45', '2020-01-29 07:46:45'),
(2, '2020-02-20 14:08:43', '2020-02-20 14:08:43'),
(3, '2020-02-25 07:39:54', '2020-02-25 07:39:54'),
(4, '2020-02-25 07:40:13', '2020-02-25 07:40:13'),
(5, '2020-02-25 07:40:39', '2020-02-25 07:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `account_contents_translations`
--

CREATE TABLE `account_contents_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_content_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_contents_translations`
--

INSERT INTO `account_contents_translations` (`id`, `title`, `account_content_id`, `locale`, `created_at`, `updated_at`) VALUES
(1, 'تجاري', 1, 'ar', '2020-01-29 07:46:45', '2020-01-29 07:46:45'),
(2, 'Commercial', 1, 'en', '2020-01-29 07:46:45', '2020-01-29 07:46:45'),
(3, 'شخصي', 2, 'ar', '2020-02-20 14:08:43', '2020-02-25 07:39:33'),
(4, 'Personal', 2, 'en', '2020-02-20 14:08:43', '2020-02-25 07:39:33'),
(5, 'تغطيات', 3, 'ar', '2020-02-25 07:39:54', '2020-02-25 07:39:54'),
(6, 'Coverages', 3, 'en', '2020-02-25 07:39:54', '2020-02-25 07:39:54'),
(7, 'اعلامي', 4, 'ar', '2020-02-25 07:40:13', '2020-02-25 07:40:13'),
(8, 'Notify me', 4, 'en', '2020-02-25 07:40:13', '2020-02-25 07:40:13'),
(9, 'تبادل نشر', 5, 'ar', '2020-02-25 07:40:39', '2020-02-25 07:40:39'),
(10, 'Post exchange', 5, 'en', '2020-02-25 07:40:39', '2020-02-25 07:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertise_type` enum('website','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertise_on` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisements_translations`
--

CREATE TABLE `advertisements_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advertisement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `image`, `code`, `created_at`, `updated_at`) VALUES
(1, '/uploads/banks/1/1582616056.jpg', '123456789123', '2020-01-29 07:45:50', '2020-02-25 07:34:16'),
(2, '/uploads/banks/2/1582616079.jpg', '22222555566666666', '2020-02-11 12:22:09', '2020-02-25 07:34:39');

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

--
-- Dumping data for table `banks_translations`
--

INSERT INTO `banks_translations` (`id`, `bank_id`, `title`, `locale`) VALUES
(1, 1, 'بنك البلاد', 'ar'),
(2, 1, 'bank albilad', 'en'),
(3, 2, 'مصرف الراجحي', 'ar'),
(4, 2, 'al raghe', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `main` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories_translations`
--

CREATE TABLE `blog_categories_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_category_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 1, '2020-01-29 07:44:54', '2020-01-29 07:44:54'),
(2, 2, '2020-01-29 07:45:05', '2020-01-29 07:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `cities_translations`
--

CREATE TABLE `cities_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities_translations`
--

INSERT INTO `cities_translations` (`id`, `title`, `city_id`, `locale`, `created_at`, `updated_at`) VALUES
(1, 'القاهرة', 1, 'ar', '2020-01-29 07:44:54', '2020-01-29 07:44:54'),
(2, 'Cairo', 1, 'en', '2020-01-29 07:44:54', '2020-01-29 07:44:54'),
(3, 'مكة', 2, 'ar', '2020-01-29 07:45:05', '2020-01-29 07:45:05'),
(4, 'Makka', 2, 'en', '2020-01-29 07:45:05', '2020-01-29 07:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_id` int(10) UNSIGNED DEFAULT NULL,
  `priority_id` int(10) UNSIGNED DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `content_section_advertisement`
--

CREATE TABLE `content_section_advertisement` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_section_id` int(10) UNSIGNED DEFAULT NULL,
  `advertisement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `logo`, `code`, `call_code`, `created_at`, `updated_at`) VALUES
(1, '/uploads/country/1/1580283872.png', 'EG', '+20', '2020-01-29 07:44:32', '2020-01-29 07:44:32'),
(2, '/uploads/country/2/1580283882.png', 'KSA', '+966', '2020-01-29 07:44:42', '2020-01-29 07:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `countries_translations`
--

CREATE TABLE `countries_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries_translations`
--

INSERT INTO `countries_translations` (`id`, `country_id`, `title`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'مصر', 'ar', '2020-01-29 07:44:32', '2020-01-29 07:44:32'),
(2, 1, 'Egypt', 'en', '2020-01-29 07:44:32', '2020-01-29 07:44:32'),
(3, 2, 'السعودية', 'ar', '2020-01-29 07:44:43', '2020-01-29 07:44:43'),
(4, 2, 'Saudi Arabia', 'en', '2020-01-29 07:44:43', '2020-01-29 07:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies_translation`
--

CREATE TABLE `currencies_translation` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'VerificationEmail', NULL, NULL),
(2, 'UserResetPassword', NULL, NULL),
(3, 'orderStatusApproved', NULL, NULL),
(4, 'orderStatusRefused', NULL, NULL),
(5, 'orderStatusWaiting', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates_data`
--

CREATE TABLE `email_templates_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_template_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates_data`
--

INSERT INTO `email_templates_data` (`id`, `from_email`, `email_template_id`, `created_at`, `updated_at`) VALUES
(1, 'support@ashhrni.com', 1, NULL, NULL),
(2, 'support@ashhrni.com', 2, NULL, NULL),
(3, 'support@ashhrni.com', 3, NULL, NULL),
(4, 'support@ashhrni.com', 4, NULL, NULL),
(5, 'support@ashhrni.com', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates_data_translations`
--

CREATE TABLE `email_templates_data_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `email_template_data_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates_data_translations`
--

INSERT INTO `email_templates_data_translations` (`id`, `email_template_data_id`, `subject`, `body`, `locale`) VALUES
(1, 1, 'التحقق من البريد الإلكتروني', '<p>مرحبًا بكم في الموقع {userFirstName} {userLastName} ،</p><p>معرف البريد الإلكتروني المسجل الخاص بك هو {userEmail} ، يرجى نسخ الكود أدناه للتحقق من حساب بريدك الإلكتروني</p><p>&nbsp;، رمز التحقق الخاص بك هو {code}</p>', 'ar'),
(2, 1, 'verfiy email', '<p>Welcome to the site {userFirstName} {userLastName},</p><p>Your registered email-id is {userEmail} , Please copy the below code to verify your email account,</p><p>Your verification Code is {code}</p>', 'en'),
(3, 2, 'استرجاع كلمة المرور', '<h2><strong>مرحبًا {userFirstName} {userLastName} ،</strong></h2></p>لقد طلبت مؤخرًا إعادة تعيين كلمة المرور لحساب {siteName} الخاص بك. استخدم الزر أدناه لإعادة ضبطه. إعادة تعيين كلمة المرور هذه صالحة فقط لمدة 24 ساعة.<p>', 'ar'),
(4, 2, 'reset your password', '<h2><strong>Hi {userFirstName} {userLastName},</strong></h2><p>You recently requested to reset your password for your {siteName} account. Use the button below to reset it. <strong>This password reset is only valid for the next 24 hours.</strong></p>', 'en'),
(5, 3, 'تمت الموافقة ع طلبك', '<p>تمت الموافقة ع طلبك {order}</p>', 'ar'),
(6, 3, 'order approved', '<p>order {order} approved</p>', 'en'),
(7, 4, 'تم رفض طلبك', '<p>تم رفض طلبك {order}</p>', 'ar'),
(8, 4, 'order refused', '<p>order {order} refused</p>', 'en'),
(9, 5, 'جاري مراجعة طلبك', '<p>جاري مراجعة طلبك {order}</p>', 'ar'),
(10, 5, 'Your order is being reviewed', '<p>Your order {order} is being reviewed</p>', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates_translations`
--

CREATE TABLE `email_templates_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_template_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates_translations`
--

INSERT INTO `email_templates_translations` (`id`, `title`, `description`, `email_template_id`, `locale`) VALUES
(1, 'Verification Email', 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write code {code} to write site name {siteName} to write order {order}', 1, 'en'),
(2, 'التحقق من البريد الإلكتروني', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة رمز {code} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 1, 'ar'),
(3, 'User Forget Password', 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}', 2, 'en'),
(4, 'نسيت كلمة المرور للمستخدم', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 2, 'ar'),
(5, 'تم الموافقة ع الطلب', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 3, 'ar'),
(6, 'Order Approved', 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}', 3, 'en'),
(7, 'تم رفض الطلب', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 4, 'ar'),
(8, 'order Refused', 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}', 4, 'en'),
(9, 'جاري مراجعة طلبك', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة البريد الإلكتروني {userEmail} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 5, 'ar'),
(10, 'Your order is being reviewed', 'help : to write username {userFirstName} {userLastName} to write email {userEmail} to write site name {siteName} to write order {order}', 5, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `featured_ads`
--

CREATE TABLE `featured_ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `place` enum('slider','featured') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `featured_ads`
--

INSERT INTO `featured_ads` (`id`, `place`, `price`, `created_at`, `updated_at`) VALUES
(1, 'slider', '3.00', '2020-01-29 07:47:18', '2020-01-29 07:47:18'),
(2, 'featured', '2.00', '2020-01-29 07:47:22', '2020-01-29 07:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `featured_ads_users`
--

CREATE TABLE `featured_ads_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `orderNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `featured_id` int(10) UNSIGNED DEFAULT NULL,
  `featured_type` enum('slider','featured') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `social_link_id` int(10) UNSIGNED DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footer_translations`
--

CREATE TABLE `footer_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `footer_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL,
  `to_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` bigint(20) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2019_08_28_140519_create_contacts_table', 1),
(3, '2019_11_20_081032_create_permission_tables', 1),
(4, '2019_11_21_072242_create_Social_links_table', 1),
(5, '2019_11_21_072242_create_blog_categories_table', 1),
(6, '2019_11_21_072242_create_blog_categories_translations_table', 1),
(7, '2019_11_21_072242_create_content_sections_table', 1),
(8, '2019_11_21_072242_create_content_sections_translations_table', 1),
(9, '2019_11_21_072242_create_countries_table', 1),
(10, '2019_11_21_072242_create_countries_translations_table', 1),
(11, '2019_11_21_072242_create_currencies_table', 1),
(12, '2019_11_21_072242_create_currencies_translation_table', 1),
(13, '2019_11_21_072242_create_languages_products_table', 1),
(14, '2019_11_21_072242_create_languages_table', 1),
(15, '2019_11_21_072242_create_languages_translations_table', 1),
(16, '2019_11_21_072242_create_phones_table', 1),
(17, '2019_11_21_072242_create_settings_table', 1),
(18, '2019_11_21_072242_create_settings_translations_table', 1),
(19, '2019_11_21_072242_create_site_languages_table', 1),
(20, '2019_11_21_072242_create_tags_table', 1),
(21, '2019_11_21_072243_create_cities_table', 1),
(22, '2019_11_21_072243_create_cities_translations_table', 1),
(23, '2019_11_21_072243_create_tag_translations_table', 1),
(24, '2019_11_21_072244_create_users_table', 1),
(25, '2019_11_21_072245_create_newsletters_table', 1),
(26, '2019_11_21_072245_create_sliders_table', 1),
(27, '2019_11_21_072245_create_sliders_translations_table', 1),
(28, '2019_11_22_0722521_create_blogs_table', 1),
(29, '2019_11_22_0722522_create_blog_translations_table', 1),
(30, '2019_11_25_181531_create_currency_convertor_table', 1),
(31, '2019_11_30_072242_create_blogs_tags_table', 1),
(32, '2019_12_02_105011_create_banks_table', 1),
(33, '2019_12_02_105210_create_banks_translations_table', 1),
(34, '2019_12_02_131359_create_orders_table', 1),
(35, '2019_12_02_131904_create_order_items_table', 1),
(36, '2019_12_02_132124_create_transactions_table', 1),
(37, '2019_12_15_125819_create_online_payment_table', 1),
(38, '2019_12_16_140110_create_account_contents_table', 1),
(39, '2019_12_16_140110_create_account_contents_translations_table', 1),
(40, '2019_12_16_140110_create_social_link_user_table', 1),
(41, '2019_12_16_140833_create_social_links_translations_table', 1),
(42, '2019_12_16_141849_create_advertisements_table', 1),
(43, '2019_12_16_142143_create_advertisements_translations_table', 1),
(44, '2019_12_17_070846_create_points_table', 1),
(45, '2019_12_17_070914_create_points_translations_table', 1),
(46, '2019_12_17_071347_create_point_user_table', 1),
(47, '2019_12_17_073030_create_content_section_advertisement_table', 1),
(48, '2019_12_18_110301_create_social_link_setting_table', 1),
(49, '2019_12_19_064132_create_slider_user_table', 1),
(50, '2019_12_19_082317_create_verify_users_table', 1),
(51, '2019_12_22_223023_create_messages_table', 1),
(52, '2019_12_23_114918_create_banners_table', 1),
(53, '2019_12_24_111855_create_featured_ads_table', 1),
(54, '2019_12_24_124824_create_featured_ads_users_table', 1),
(55, '2019_12_26_093928_create_social_advertisement_table', 1),
(56, '2019_12_26_095228_create_social_advertisement_user_table', 1),
(57, '2019_12_29_100236_create_ratings_table', 1),
(58, '2019_12_29_100358_create_ratings_translations_table', 1),
(59, '2019_12_29_100803_create_rating_user_table', 1),
(60, '2019_12_30_075757_create_files_table', 1),
(61, '2019_12_31_115351_create_footer_table', 1),
(62, '2019_12_31_115607_create_footer_translations_table', 1),
(63, '2020_01_19_155823_add_columns_to_users_table', 1),
(64, '2020_01_20_085523_create_users_settings_table', 1),
(65, '2020_01_20_121250_add_code_to_verify_users_table', 1),
(66, '2020_01_22_120954_add_content_to_social_link_user_table', 1),
(67, '2020_01_23_101831_add_zerofill_to_users_table', 1),
(68, '2020_01_25_221852_create_email_templates_table', 1),
(69, '2020_01_25_222942_create_email_templates_translations_table', 1),
(70, '2020_01_25_223218_create_email_templates_data_table', 1),
(71, '2020_01_25_224515_create_email_templates_data_translations_table', 1),
(72, '2020_01_28_082324_add_email_status_to_orders_table', 1),
(73, '2020_01_28_090419_create_notifications_table', 1),
(74, '2020_01_29_001929_create_notify_templates_table', 1),
(75, '2020_01_29_001937_create_notify_templates_translations_table', 1),
(76, '2020_01_29_001945_create_notify_templates_data_table', 1),
(77, '2020_01_29_001953_create_notify_templates_data_translations_table', 1),
(78, '2020_02_24_125301_create_send_users_table', 2);

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
(66, 'App\\Admin', 1),
(67, 'App\\Admin', 1),
(68, 'App\\Admin', 1),
(69, 'App\\Admin', 1),
(70, 'App\\Admin', 1),
(72, 'App\\Admin', 1),
(73, 'App\\Admin', 1),
(74, 'App\\Admin', 1),
(75, 'App\\Admin', 1),
(76, 'App\\Admin', 1),
(77, 'App\\Admin', 1),
(78, 'App\\Admin', 1),
(79, 'App\\Admin', 1),
(80, 'App\\Admin', 1),
(81, 'App\\Admin', 1),
(82, 'App\\Admin', 1),
(83, 'App\\Admin', 1),
(84, 'App\\Admin', 1),
(85, 'App\\Admin', 1),
(86, 'App\\Admin', 1),
(87, 'App\\Admin', 1);

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
(2, 'App\\User', 2),
(2, 'App\\User', 3),
(2, 'App\\User', 4),
(2, 'App\\User', 5),
(2, 'App\\User', 8),
(2, 'App\\User', 9),
(2, 'App\\User', 10),
(2, 'App\\User', 11),
(2, 'App\\User', 12),
(2, 'App\\User', 13),
(2, 'App\\User', 14),
(2, 'App\\User', 15),
(2, 'App\\User', 16),
(2, 'App\\User', 17),
(2, 'App\\User', 19),
(2, 'App\\User', 20),
(2, 'App\\User', 21);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('0fffccf2-b8e1-4137-b9eb-2fd12c5d139d', 'App\\Notifications\\SendUser', 'App\\User', 5, '{\"user\":5,\"body\":\"<p>test send notifications<\\/p>\"}', NULL, '2020-02-24 18:27:21', '2020-02-24 18:27:21'),
('1af4f8fe-7ff9-4602-9f8b-0ca95aa16315', 'App\\Notifications\\SendUser', 'App\\User', 10, '{\"user\":10,\"body\":\"<p>test send notifications<\\/p>\"}', NULL, '2020-02-24 18:27:21', '2020-02-24 18:27:21'),
('779b3e2e-1717-428e-8ed2-38ba0b6e583b', 'App\\Notifications\\SendUser', 'App\\User', 7, '{\"user\":7,\"body\":\"<p>test send notifications<\\/p>\"}', NULL, '2020-02-24 18:27:21', '2020-02-24 18:27:21'),
('90bb06ee-cbca-431a-b72e-d6a8df671ea0', 'App\\Notifications\\SendUser', 'App\\User', 5, '{\"user\":5,\"body\":\"<p>test send<\\/p>\"}', NULL, '2020-02-25 10:09:04', '2020-02-25 10:09:04'),
('9bb7b9ce-8cab-4b5d-ac5b-f14bd5012404', 'App\\Notifications\\SendUser', 'App\\User', 9, '{\"user\":9,\"body\":\"<p>test send notifications<\\/p>\"}', NULL, '2020-02-24 18:27:21', '2020-02-24 18:27:21'),
('a231ef86-e740-4279-a0a1-487abf264963', 'App\\Notifications\\SendUser', 'App\\User', 8, '{\"user\":8,\"body\":\"<p>test send notifications<\\/p>\"}', NULL, '2020-02-24 18:27:21', '2020-02-24 18:27:21'),
('b125ed6e-c245-4cfd-a9fe-8b46baa7cc95', 'App\\Notifications\\SendUser', 'App\\User', 18, '{\"user\":18,\"body\":\"<p>test send notifications<\\/p>\"}', '2020-02-24 18:27:32', '2020-02-24 18:27:21', '2020-02-24 18:27:32'),
('e7fcdab6-31c3-460b-8593-c5f9bc9ad0eb', 'App\\Notifications\\SendUser', 'App\\User', 6, '{\"user\":6,\"body\":\"<p>test send notifications<\\/p>\"}', NULL, '2020-02-24 18:27:21', '2020-02-24 18:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `notify_templates`
--

CREATE TABLE `notify_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_templates`
--

INSERT INTO `notify_templates` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, 'orderStatusApproved', NULL, NULL),
(2, 'orderStatusRefused', NULL, NULL),
(3, 'orderStatusWaiting', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notify_templates_data`
--

CREATE TABLE `notify_templates_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `notify_template_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_templates_data`
--

INSERT INTO `notify_templates_data` (`id`, `notify_template_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notify_templates_data_translations`
--

CREATE TABLE `notify_templates_data_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `notify_data_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_templates_data_translations`
--

INSERT INTO `notify_templates_data_translations` (`id`, `notify_data_id`, `subject`, `body`, `locale`) VALUES
(1, 1, 'تمت الموافقة ع طلبك', '<p>تمت الموافقة ع طلبك {order}</p>', 'ar'),
(2, 1, 'order approved', '<p>order approved {order}</p>', 'en'),
(3, 2, 'تم رفض طلبك', '<p>تم رفض طلبك {order}</p>', 'ar'),
(4, 2, 'order refused', '<p>order refused {order}</p>', 'en'),
(5, 3, 'جاري مراجعة طلبك', '<p>جاري مراجعة طلبك {order}</p>', 'ar'),
(6, 3, 'Your order is being reviewed', '<p>Your order is being reviewed {order}</p>', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `notify_templates_translations`
--

CREATE TABLE `notify_templates_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify_template_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_templates_translations`
--

INSERT INTO `notify_templates_translations` (`id`, `title`, `description`, `notify_template_id`, `locale`) VALUES
(1, 'تم الموافقة ع الطلب', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 1, 'ar'),
(2, 'Order Approved', 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}', 1, 'en'),
(3, 'تم رفض الطلب', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 2, 'ar'),
(4, 'order Refused', 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}', 2, 'en'),
(5, 'جاري مراجعة طلبك', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 3, 'ar'),
(6, 'Your order is being reviewed', 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}', 3, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `online_payment`
--

CREATE TABLE `online_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `open_ticket`
--

CREATE TABLE `open_ticket` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `open_ticket`
--

INSERT INTO `open_ticket` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-01-30 07:42:14', '2020-01-30 07:42:14'),
(2, '2020-01-30 07:54:05', '2020-01-30 07:54:05'),
(3, '2020-01-30 07:55:09', '2020-01-30 07:55:09'),
(4, '2020-01-30 07:57:46', '2020-01-30 07:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `open_ticket_translations`
--

CREATE TABLE `open_ticket_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `open_ticket_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `open_ticket_translations`
--

INSERT INTO `open_ticket_translations` (`id`, `open_ticket_id`, `title`, `description`, `locale`) VALUES
(3, 2, 'الحسابات و المبيعات', 'لاستفسارات ما قبل الشراء و ما يتعلّق بفواتير وحسابات العملاء .', 'ar'),
(4, 2, 'Accounts and sales', 'For pre-purchase inquiries and customer invoices and accounts.', 'en'),
(5, 3, 'تأكيد الدفع', 'لتأكيد عمليات دفع فواتير تجديد الخدمات، وفواتير الطلبات الجديدة حتّى يتمكن فريق العمل من تفعيل الطلبات .', 'ar'),
(6, 3, 'Confirm the payment', 'To confirm payments for service renewal bills and new order bills so that the team can activate orders.', 'en'),
(7, 4, 'الشكاوى و الإقتراحات', 'سنكون دائمًا في انتظار تواصلكم معنا، مرحبين بأي اقتراحات لتحسين مستوى الخدمة، ومتلقّين كافة الشكاوى بعين الإعتبار.', 'ar'),
(8, 4, 'Complaints and suggestions', 'We will always be waiting for your communication with us, welcome any suggestions to improve the level of service, and receive all complaints in consideration.', 'en');

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
  `email_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `orderNumber`, `status`, `total`, `email_status`, `created_at`, `updated_at`) VALUES
(7, 5, '2', 'wait', 54, 0, '2020-02-11 12:34:42', '2020-02-11 12:34:42'),
(8, 5, '3', 'wait', 54, 0, '2020-02-17 07:29:54', '2020-02-17 07:29:54');

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

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nabad.ksa@gmail.com', '$2y$10$9PqJpoXKrLH4Md8iWEMWUe1Ycg9qhzUopNCnALEiEtxh.G8/bbaAu', '2020-02-04 08:03:41'),
('nabad.ksa@gmail.com', '1368ffe459a2d555590ce254844d76d6e608fcc104321ae209be1f5ff1d1f457', '2020-02-04 08:03:41'),
('nadynaltwkhy60@gmail.com', '$2y$10$0zoq21uak/EiH.UPBeoybu4PG3xL3SLQSY93H8c.0OpuOre9bxqgq', '2020-02-11 11:01:58'),
('nadynaltwkhy60@gmail.com', '7bd1c45d45348464c7a5cc39b72fc64615d4ee8a394811351921fb6c90e6ade6', '2020-02-11 11:01:58');

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
(1, 'Permission-Add', 'admin', 'إضافة صلاحية', '2020-01-29 07:34:06', '2020-01-29 07:34:06'),
(2, 'Permission-Edit', 'admin', 'تعديل صلاحية', '2020-01-29 07:34:07', '2020-01-29 07:34:07'),
(3, 'Permission-Delete', 'admin', 'حذف صلاحية', '2020-01-29 07:34:07', '2020-01-29 07:34:07'),
(4, 'Role-Add', 'admin', 'اضافه مجموعه مستخدمين', '2020-01-29 07:34:08', '2020-01-29 07:34:08'),
(5, 'Role-Edit', 'admin', 'تعديل مجموعه مستخدمين', '2020-01-29 07:34:08', '2020-01-29 07:34:08'),
(6, 'Role-Delete', 'admin', 'حذف مجموعه مستخدمين', '2020-01-29 07:34:09', '2020-01-29 07:34:09'),
(7, 'Show-Adminpanel', 'admin', 'عرض لوحة التحكم', '2020-01-29 07:34:10', '2020-01-29 07:34:10'),
(8, 'AdminUser-Add', 'admin', 'اضافه ادمن', '2020-01-29 07:34:10', '2020-01-29 07:34:10'),
(9, 'AdminUser-Edit', 'admin', 'تعديل ادمن', '2020-01-29 07:34:10', '2020-01-29 07:34:10'),
(10, 'AdminUser-Delete', 'admin', 'حذف ادمن', '2020-01-29 07:34:10', '2020-01-29 07:34:10'),
(11, 'FrontUser-Create', 'admin', 'اضافه مستخدم', '2020-01-29 07:34:10', '2020-01-29 07:34:10'),
(12, 'FrontUser-Edit', 'admin', 'تعديل مستخدم', '2020-01-29 07:34:11', '2020-01-29 07:34:11'),
(13, 'FrontUser-Delete', 'admin', 'حذف مستخدم', '2020-01-29 07:34:11', '2020-01-29 07:34:11'),
(14, 'NewsLetter-Add', 'admin', 'إضافة مستخدم للنشرة الإخبارية', '2020-01-29 07:34:12', '2020-01-29 07:34:12'),
(15, 'SiteSetting-Add', 'admin', 'إضافة إعدادات الموقع', '2020-01-29 07:34:13', '2020-01-29 07:34:13'),
(16, 'SiteLanguage-Add', 'admin', 'إضافة لغة للموقع', '2020-01-29 07:34:14', '2020-01-29 07:34:14'),
(17, 'SiteLanguage-Edit', 'admin', 'تعديل لغة للموقع', '2020-01-29 07:34:15', '2020-01-29 07:34:15'),
(18, 'SiteLanguage-Delete', 'admin', 'حذف لغة للموقع', '2020-01-29 07:34:16', '2020-01-29 07:34:16'),
(19, 'Country-Add', 'admin', 'إضافة دولة', '2020-01-29 07:34:18', '2020-01-29 07:34:18'),
(20, 'Country-Edit', 'admin', 'تعديل دولة', '2020-01-29 07:34:18', '2020-01-29 07:34:18'),
(21, 'Country-Delete', 'admin', 'حذف دولة', '2020-01-29 07:34:21', '2020-01-29 07:34:21'),
(22, 'City-Add', 'admin', 'إضافة مدينة', '2020-01-29 07:34:22', '2020-01-29 07:34:22'),
(23, 'City-Edit', 'admin', 'تعديل مدينة', '2020-01-29 07:34:23', '2020-01-29 07:34:23'),
(24, 'City-Delete', 'admin', 'حذف مدينة', '2020-01-29 07:34:23', '2020-01-29 07:34:23'),
(25, 'Currency-Add', 'admin', 'إضافة عملة', '2020-01-29 07:34:23', '2020-01-29 07:34:23'),
(26, 'Currency-Edit', 'admin', 'تعديل عملة', '2020-01-29 07:34:23', '2020-01-29 07:34:23'),
(27, 'Currency-Delete', 'admin', 'حذف عملة', '2020-01-29 07:34:24', '2020-01-29 07:34:24'),
(31, 'Slider-Add', 'admin', 'إضافة سليدر', '2020-01-29 07:34:24', '2020-01-29 07:34:24'),
(32, 'Slider-Edit', 'admin', 'تعديل سليدر', '2020-01-29 07:34:24', '2020-01-29 07:34:24'),
(33, 'Slider-Delete', 'admin', 'حذف سليدر', '2020-01-29 07:34:24', '2020-01-29 07:34:24'),
(34, 'Tag-Add', 'admin', 'إضافة تاج', '2020-01-29 07:34:24', '2020-01-29 07:34:24'),
(35, 'Tag-Edit', 'admin', 'تعديل تاج', '2020-01-29 07:34:25', '2020-01-29 07:34:25'),
(36, 'Tag-Delete', 'admin', 'حذف تاج', '2020-01-29 07:34:25', '2020-01-29 07:34:25'),
(37, 'BlogCategory-Add', 'admin', 'إضافة قسم للمدونة', '2020-01-29 07:34:25', '2020-01-29 07:34:25'),
(38, 'BlogCategory-Edit', 'admin', 'تعديل قسم للمدونة', '2020-01-29 07:34:25', '2020-01-29 07:34:25'),
(39, 'BlogCategory-Delete', 'admin', 'حذف قسم للمدونة', '2020-01-29 07:34:25', '2020-01-29 07:34:25'),
(40, 'Blog-Add', 'admin', 'إضافة مدونة', '2020-01-29 07:34:26', '2020-01-29 07:34:26'),
(41, 'Blog-Edit', 'admin', 'تعديل مدونة', '2020-01-29 07:34:26', '2020-01-29 07:34:26'),
(42, 'Blog-Delete', 'admin', 'حذف مدونة', '2020-01-29 07:34:26', '2020-01-29 07:34:26'),
(43, 'Payment-Add', 'admin', 'إضافة وسيلة دفع', '2020-01-29 07:34:26', '2020-01-29 07:34:26'),
(44, 'Payment-Edit', 'admin', 'تعديل وسيلة دفع', '2020-01-29 07:34:27', '2020-01-29 07:34:27'),
(45, 'Payment-Delete', 'admin', 'حذف وسيلة دفع', '2020-01-29 07:34:27', '2020-01-29 07:34:27'),
(46, 'Order-Show', 'admin', 'عرض اوردر', '2020-01-29 07:34:27', '2020-01-29 07:34:27'),
(47, 'Order-Delete', 'admin', 'حذف اوردر', '2020-01-29 07:34:27', '2020-01-29 07:34:27'),
(48, 'Report-Show', 'admin', 'عرض التقرير', '2020-01-29 07:34:28', '2020-01-29 07:34:28'),
(49, 'Bank-Add', 'admin', 'إضافة بنك', '2020-01-29 07:34:28', '2020-01-29 07:34:28'),
(50, 'Bank-Edit', 'admin', 'تعديل بنك', '2020-01-29 07:34:28', '2020-01-29 07:34:28'),
(51, 'Bank-Delete', 'admin', 'حذف بنك', '2020-01-29 07:34:28', '2020-01-29 07:34:28'),
(52, 'Online-Payment', 'admin', 'الدفع الالكتروني', '2020-01-29 07:34:29', '2020-01-29 07:34:29'),
(53, 'ContentType-Add', 'admin', 'إضافة نوع محتوي', '2020-01-29 07:34:29', '2020-01-29 07:34:29'),
(54, 'ContentType-Edit', 'admin', 'تعديل نوع محتوي', '2020-01-29 07:34:29', '2020-01-29 07:34:29'),
(55, 'ContentType-Delete', 'admin', 'حذف نوع محتوي', '2020-01-29 07:34:29', '2020-01-29 07:34:29'),
(56, 'SocialLink-Add', 'admin', 'إضافة وسيلة إجتماعية', '2020-01-29 07:34:30', '2020-01-29 07:34:30'),
(57, 'SocialLink-Edit', 'admin', 'تعديل وسيلة إجتماعية', '2020-01-29 07:34:30', '2020-01-29 07:34:30'),
(58, 'SocialLink-Delete', 'admin', 'حذف وسيلة إجتماعية', '2020-01-29 07:34:30', '2020-01-29 07:34:30'),
(59, 'Point-Add', 'admin', 'إضافة نقاط', '2020-01-29 07:34:30', '2020-01-29 07:34:30'),
(60, 'Point-Edit', 'admin', 'تعديل نقاط', '2020-01-29 07:34:30', '2020-01-29 07:34:30'),
(61, 'Point-Delete', 'admin', 'حذف نقاط', '2020-01-29 07:34:30', '2020-01-29 07:34:30'),
(62, 'Slider-Add', 'admin', 'إضافة سلايدر', '2020-01-29 07:34:31', '2020-01-29 07:34:31'),
(63, 'Slider-Edit', 'admin', 'تعديل سلايدر', '2020-01-29 07:34:31', '2020-01-29 07:34:31'),
(64, 'Slider-Delete', 'admin', 'حذف سلايدر', '2020-01-29 07:34:31', '2020-01-29 07:34:31'),
(65, 'Banner-Add', 'admin', 'إضافة بانر', '2020-01-29 07:34:31', '2020-01-29 07:34:31'),
(66, 'Banner-Edit', 'admin', 'تعديل بانر', '2020-01-29 07:34:31', '2020-01-29 07:34:31'),
(67, 'Banner-Delete', 'admin', 'حذف بانر', '2020-01-29 07:34:31', '2020-01-29 07:34:31'),
(68, 'FeaturedAd-Add', 'admin', 'إضافة اعلان مميز', '2020-01-29 07:34:31', '2020-01-29 07:34:31'),
(69, 'FeaturedAd-Edit', 'admin', 'تعديل اعلان مميز', '2020-01-29 07:34:32', '2020-01-29 07:34:32'),
(70, 'FeaturedAd-Delete', 'admin', 'حذف اعلان مميز', '2020-01-29 07:34:32', '2020-01-29 07:34:32'),
(72, 'FeaturedUser-Show', 'admin', 'عرض الأعضاء المميزة', '2020-01-29 07:34:32', '2020-01-29 07:34:32'),
(73, 'FeaturedUser-Delete', 'admin', 'حذف عضو مميز', '2020-01-29 07:34:32', '2020-01-29 07:34:32'),
(74, 'SocialAdvert-Add', 'admin', 'إضافة اعلان سوشيال', '2020-01-29 07:34:32', '2020-01-29 07:34:32'),
(75, 'SocialAdvert-Edit', 'admin', 'تعديل اعلان سوشيال', '2020-01-29 07:34:33', '2020-01-29 07:34:33'),
(76, 'SocialAdvert-Delete', 'admin', 'حذف اعلان سوشيال', '2020-01-29 07:34:33', '2020-01-29 07:34:33'),
(77, 'RatingLevel-Add', 'admin', 'إضافة مستوي للتقييم', '2020-01-29 07:34:33', '2020-01-29 07:34:33'),
(78, 'RatingLevel-Edit', 'admin', 'تعديل مستوي للتقييم', '2020-01-29 07:34:33', '2020-01-29 07:34:33'),
(79, 'RatingLevel-Delete', 'admin', 'حذف مستوي للتقييم', '2020-01-29 07:34:33', '2020-01-29 07:34:33'),
(80, 'Footer-Add', 'admin', 'إضافة فوتر', '2020-01-29 07:34:33', '2020-01-29 07:34:33'),
(81, 'Footer-Edit', 'admin', 'تعديل فوتر', '2020-01-29 07:34:33', '2020-01-29 07:34:33'),
(82, 'Footer-Delete', 'admin', 'حذف فوتر', '2020-01-29 07:34:34', '2020-01-29 07:34:34'),
(83, 'UserSetting-Add', 'admin', 'اعدادات المستخدمين', '2020-01-29 07:34:34', '2020-01-29 07:34:34'),
(84, 'Contacts-Show', 'admin', 'الرسائل', '2020-01-29 07:34:34', '2020-01-29 07:34:34'),
(85, 'NotifySetup-Add', 'admin', 'اعدادات الاشعارات', '2020-01-29 07:34:34', '2020-01-29 07:34:34'),
(86, 'EmailSetup-Edit', 'admin', 'اعدادات الايميل', '2020-01-29 07:34:34', '2020-01-29 07:34:34'),
(87, 'NotifySetup-Edit', 'admin', 'اعدادات الاشعارات', '2020-01-29 07:34:34', '2020-01-29 07:34:34');

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
(7, '2020-02-11 13:05:49', '2020-02-11 13:05:49', '123456789', 1, 'App\\Models\\Setting');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` int(10) UNSIGNED NOT NULL,
  `points_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `points_number`, `code`, `created_at`, `updated_at`) VALUES
(1, '20', 'reg', NULL, NULL),
(2, '50', 'famous', NULL, NULL),
(3, '30', 'ourAccounts', NULL, NULL),
(4, '40', 'website', NULL, NULL),
(5, '10', 'addAccount', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `points_translations`
--

CREATE TABLE `points_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `point_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `points_translations`
--

INSERT INTO `points_translations` (`id`, `point_id`, `title`, `description`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'اكمال التسجيل', 'للحصول علي النقاط يجب اكمال التسجيل', 'ar', NULL, NULL),
(2, 1, 'registration completion', 'to get points complete register', 'en', NULL, NULL),
(3, 2, 'عمل اعلان مع المشاهير', 'عمل اعلان مع المشاهير', 'ar', NULL, NULL),
(4, 2, 'ad with celebrity', 'ad with celebrity', 'en', NULL, NULL),
(5, 3, 'اعلان مميز', 'اعلان مميز', 'ar', NULL, NULL),
(6, 3, 'featured ad', 'featured ad', 'en', NULL, NULL),
(7, 4, 'اعلان ع حساباتنا', 'اعلان ع حساباتنا', 'ar', NULL, NULL),
(8, 4, 'ad on our accounts', 'ad on our accounts', 'en', NULL, NULL),
(9, 5, 'اضافة حساب', 'اضافة حساب', 'ar', NULL, NULL),
(10, 5, 'add account', 'add account', 'en', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `point_user`
--

CREATE TABLE `point_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `point_id` int(10) UNSIGNED DEFAULT NULL,
  `point` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_user`
--

INSERT INTO `point_user` (`id`, `user_id`, `point_id`, `point`, `code`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '20', 'reg', '2020-01-29 14:51:29', '2020-01-29 14:51:29'),
(12, 8, 1, '20', 'reg', '2020-02-03 11:23:30', '2020-02-03 11:23:30'),
(13, 8, 5, '10', 'addAccount', '2020-02-03 11:24:03', '2020-02-03 11:24:03'),
(14, 10, 1, '20', 'reg', '2020-02-05 12:58:07', '2020-02-05 12:58:07'),
(15, 10, 5, '10', 'addAccount', '2020-02-05 13:36:50', '2020-02-05 13:36:50'),
(21, 5, 5, '10', 'addAccount', '2020-02-11 11:34:59', '2020-02-11 11:34:59'),
(22, 5, 5, '10', 'addAccount', '2020-02-11 11:34:59', '2020-02-11 11:34:59'),
(26, 5, 2, '50', 'famous', '2020-02-11 12:34:42', '2020-02-11 12:34:42'),
(27, 5, 2, '50', 'famous', '2020-02-17 07:29:54', '2020-02-17 07:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-01-30 10:05:51', '2020-01-30 10:05:51'),
(2, '2020-01-30 10:06:12', '2020-01-30 10:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `priorities_translations`
--

CREATE TABLE `priorities_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `priority_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities_translations`
--

INSERT INTO `priorities_translations` (`id`, `priority_id`, `title`, `locale`) VALUES
(1, 1, 'متوسط', 'ar'),
(2, 1, 'medium', 'en'),
(3, 2, 'عالي', 'ar'),
(4, 2, 'high', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-01-29 07:46:32', '2020-01-29 07:46:32'),
(2, '2020-02-25 07:38:11', '2020-02-25 07:38:11'),
(3, '2020-02-25 07:38:29', '2020-02-25 07:38:29'),
(4, '2020-02-25 07:38:54', '2020-02-25 07:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `ratings_translations`
--

CREATE TABLE `ratings_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `rating_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings_translations`
--

INSERT INTO `ratings_translations` (`id`, `rating_id`, `title`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'جيد', 'ar', '2020-01-29 07:46:32', '2020-01-29 07:46:32'),
(2, 1, 'good', 'en', '2020-01-29 07:46:32', '2020-01-29 07:46:32'),
(3, 2, 'جيد جداً', 'ar', '2020-02-25 07:38:11', '2020-02-25 07:38:11'),
(4, 2, 'very good', 'en', '2020-02-25 07:38:11', '2020-02-25 07:38:11'),
(5, 3, 'ممتاز', 'ar', '2020-02-25 07:38:29', '2020-02-25 07:38:29'),
(6, 3, 'Excellent', 'en', '2020-02-25 07:38:29', '2020-02-25 07:38:29'),
(7, 4, 'سيئ', 'ar', '2020-02-25 07:38:54', '2020-02-25 07:38:54'),
(8, 4, 'Bad', 'en', '2020-02-25 07:38:54', '2020-02-25 07:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `rating_user`
--

CREATE TABLE `rating_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rating_id` int(10) UNSIGNED DEFAULT NULL,
  `social_advertisement_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, 'super-admin', 'admin', '2020-01-29 07:34:07', '2020-01-29 07:34:07'),
(2, 'registered-users', 'web', '2020-01-29 07:34:35', '2020-01-29 07:34:35');

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
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(72, 1),
(73, 1),
(74, 1),
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
(87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `send_users`
--

CREATE TABLE `send_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('notify','email') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','sent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `email`, `report_email`, `logo`, `alt_logo`, `footer_logo`, `alt_footer_logo`) VALUES
(1, '2020-01-29 07:42:43', '2020-02-11 13:01:10', 'support@ashhrni.com', 'test@ashhrni.com', '/uploads/setting/1/By7dpCMlD4lJ2Y3HV1pFDIf4NCHMEt67LKqXjZJU.jpeg', 'ashhrny', '/uploads/setting/1/b9jOfonfj0X7Lr19lnn1nGG5pi3ZwUHY0RM0Nxcx.jpeg', 'ashhrny');

-- --------------------------------------------------------

--
-- Table structure for table `settings_translations`
--

CREATE TABLE `settings_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings_translations`
--

INSERT INTO `settings_translations` (`id`, `setting_id`, `title`, `address`, `meta_title`, `meta_description`, `meta_keywords`, `locale`) VALUES
(1, 1, 'اشهرني', 'السعودية', NULL, NULL, NULL, 'ar'),
(2, 1, 'Ashhrny', 'Saudi Arabia', NULL, NULL, NULL, 'en');

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
(1, '2020-01-29 07:41:26', '2020-01-29 07:41:26', 'Arabic', '/uploads/site_languages/1/1580283686.png', 'ar'),
(2, '2020-01-29 07:41:44', '2020-01-29 07:41:44', 'English', '/uploads/site_languages/2/1580283704.jpg', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `alt_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `user_id`, `sort`, `alt_image`, `publish`, `created_at`, `updated_at`) VALUES
(1, 10, 1, NULL, 1, '2020-02-11 12:45:42', '2020-02-20 14:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `sliders_translations`
--

CREATE TABLE `sliders_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `slider_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders_translations`
--

INSERT INTO `sliders_translations` (`id`, `slider_id`, `title`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'ar', '2020-02-11 12:45:42', '2020-02-11 12:45:42'),
(2, 1, NULL, 'en', '2020-02-11 12:45:42', '2020-02-11 12:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `slider_user`
--

CREATE TABLE `slider_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_advertisement`
--

CREATE TABLE `social_advertisement` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('website','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_advertisement`
--

INSERT INTO `social_advertisement` (`id`, `type`, `price`, `created_at`, `updated_at`) VALUES
(1, 'website', '2.00', '2020-01-29 07:47:30', '2020-01-29 07:47:30'),
(2, 'user', '3.00', '2020-01-29 07:47:35', '2020-01-29 07:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `social_advertisement_user`
--

CREATE TABLE `social_advertisement_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `orderNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `social_link_id` int(10) UNSIGNED DEFAULT NULL,
  `famous_id` int(10) UNSIGNED DEFAULT NULL,
  `account_type_id` int(10) UNSIGNED DEFAULT NULL,
  `advert_type` enum('website','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `price` decimal(8,2) DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_advertisement_user`
--

INSERT INTO `social_advertisement_user` (`id`, `orderNumber`, `user_id`, `social_link_id`, `famous_id`, `account_type_id`, `advert_type`, `file`, `content`, `publish`, `price`, `duration`, `total`, `from`, `to`, `created_at`, `updated_at`) VALUES
(7, '2', 5, 11, 8, 1, 'user', NULL, 'tgrerf34ewf', 0, '3.00', '18', '54.00', NULL, NULL, '2020-02-11 12:34:42', '2020-02-11 12:34:42'),
(8, '3', 5, 11, 8, 1, 'user', NULL, 'agfgfgsd', 0, '3.00', '18', '54.00', NULL, NULL, '2020-02-17 07:29:54', '2020-02-17 07:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'fa-facebook', '2020-01-29 07:46:17', '2020-01-29 07:46:17'),
(2, 'fa-snapchat', '2020-02-05 13:44:39', '2020-02-05 13:44:39'),
(3, 'fa-twitter', '2020-02-25 07:36:14', '2020-02-25 07:36:14'),
(4, 'fa-instagram', '2020-02-25 07:36:47', '2020-02-25 07:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `social_links_translations`
--

CREATE TABLE `social_links_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` int(10) UNSIGNED DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links_translations`
--

INSERT INTO `social_links_translations` (`id`, `title`, `social_id`, `locale`, `created_at`, `updated_at`) VALUES
(3, 'سناب شات', 2, 'ar', '2020-02-05 13:44:39', '2020-02-05 13:44:39'),
(4, 'snapchat', 2, 'en', '2020-02-05 13:44:39', '2020-02-05 13:44:39'),
(5, 'تويتر', 3, 'ar', '2020-02-25 07:36:14', '2020-02-25 07:36:14'),
(6, 'Twitter', 3, 'en', '2020-02-25 07:36:14', '2020-02-25 07:36:14'),
(7, 'انستقرام', 4, 'ar', '2020-02-25 07:36:47', '2020-02-25 07:36:47'),
(8, 'Instagram', 4, 'en', '2020-02-25 07:36:47', '2020-02-25 07:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `social_link_setting`
--

CREATE TABLE `social_link_setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_link_setting`
--

INSERT INTO `social_link_setting` (`id`, `title`, `url`, `icon`, `setting_id`, `created_at`, `updated_at`) VALUES
(25, 'facebook', 'www.facebook.com', 'fa-facebook', 1, '2020-02-11 13:05:49', '2020-02-11 13:05:49'),
(26, 'Instagram', 'www.instagram.com', 'fa-instagram', 1, '2020-02-11 13:05:49', '2020-02-11 13:05:49'),
(27, 'Twitter', 'http://twitter.com', 'fa-twitter', 1, '2020-02-11 13:05:49', '2020-02-11 13:05:49'),
(28, 'Youtube', 'www.youtube.com', 'fa-youtube', 1, '2020-02-11 13:05:49', '2020-02-11 13:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `social_link_user`
--

CREATE TABLE `social_link_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `social_id` int(10) UNSIGNED DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_link_user`
--

INSERT INTO `social_link_user` (`id`, `user_id`, `social_id`, `url`, `content`, `default`, `created_at`, `updated_at`) VALUES
(4, 8, 1, 'https://www.facebook.com/serv5groupcom', NULL, NULL, '2020-02-03 11:24:03', '2020-02-03 11:24:03'),
(5, 10, 1, 'https://www.facebook.com/', 'فيسبوك', 1, '2020-02-05 13:36:50', '2020-02-05 14:36:42'),
(11, 5, 1, 'https://www.facebook.com/profile.php?id=100043752016772', 'تجاري', NULL, '2020-02-11 11:34:59', '2020-02-11 11:34:59'),
(12, 5, 2, 'https://www.facebook.com/profile.php?id=100043752016772', 'تجاري', NULL, '2020-02-11 11:34:59', '2020-02-11 11:34:59'),
(14, 20, 2, 'https://www.snapchat.com/add/ksa.un', 'اخبار', NULL, '2020-02-25 08:00:47', '2020-02-25 08:05:03'),
(15, 20, 3, 'https://mobile.twitter.com/ashhrni', 'اخبار', 1, '2020-02-25 08:00:47', '2020-02-25 08:05:03'),
(16, 20, 4, 'https://www.instagram.com/ashhrni/', 'اخبار', NULL, '2020-02-25 08:00:47', '2020-02-25 08:04:23');

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
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `holder_expire` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `payment_type`, `status`, `bank_id`, `bank_transactions_num`, `total`, `image`, `currency`, `discount_code`, `holder_name`, `holder_card_number`, `holder_cvc`, `holder_expire`, `created_at`, `updated_at`) VALUES
(2, 7, 'bank', 'pending', 1, 'er5ferewss', NULL, '/uploads/payment/158142448248646.gif', NULL, NULL, 't54rerwe', NULL, NULL, NULL, '2020-02-11 12:34:42', '2020-02-11 12:34:42'),
(3, 8, 'bank', 'pending', 1, 'er5ferewss', NULL, '/uploads/payment/158192459449354.jpg', NULL, NULL, 't54rerwe', NULL, NULL, NULL, '2020-02-17 07:29:54', '2020-02-17 07:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `membership_number` int(11) UNSIGNED ZEROFILL NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `user_type` enum('normal','famous','admin') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `job_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `send_email` tinyint(1) NOT NULL DEFAULT 0,
  `send_sms` tinyint(1) NOT NULL DEFAULT 0,
  `identify_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identify_image` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `membership_number`, `first_name`, `last_name`, `email`, `email_verified_at`, `image`, `alt_image`, `guard`, `user_type`, `gender`, `job_type`, `status`, `send_email`, `send_sms`, `identify_number`, `identify_image`, `mobile`, `password`, `country_id`, `city_id`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 00000000000, 'admin', 'admin', 'admin@admin.com', NULL, NULL, NULL, 'admin', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, NULL, NULL, 'itl5T9Uc8GEqO4ViDrSEWAV9j750OBk9MTScs6JBNH0dzOnkY3rIV40fiLgm', '2020-01-29 07:34:07', '2020-01-29 07:34:07'),
(2, 00000000001, 'shaza', 'ahmed', 'shazaahmed266@yahoo.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$k.bzg6oU4SD.5LdHU0RJkeccaH7VRcB5B1BROmMebsA4o3LYVFNiK', NULL, NULL, NULL, NULL, NULL, '2020-01-29 11:22:54', '2020-01-29 11:22:54'),
(4, 00000000001, 'shaza', 'tarek', 'shaza7688@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$Q8JI4mi3U00yMu5MNxG9dODk84j30V7hyvoY9hKnWuSGlw6qHDg5K', NULL, NULL, NULL, NULL, NULL, '2020-01-29 14:40:09', '2020-01-29 14:40:09'),
(5, 00000000001, 'nadyn', 'eltawkhy', 'nadynaltwkhy60@gmail.com', '2020-01-29 14:46:51', '/uploads/profiles/5/P37c2EStNxLCQyGIB7n5e2ORMBatKzj0YOTv9swY.gif', 'nadyneltawkhy', 'web', 'normal', 'female', NULL, 1, 1, 0, NULL, NULL, '01212020076', '$2y$10$EfJRcuLfZ/B3GrWj3j2oWelDA5WLK1DiqGFY1ChuP7gtGTudFKdPG', 1, NULL, NULL, NULL, NULL, '2020-01-29 14:42:45', '2020-02-11 11:32:06'),
(8, 00000000004, 'ahmed', 'mohamed', 'serv5group.com@gmail.com', '2020-02-03 11:22:16', '/uploads/profiles/8/52KcVepskKNJKKKcZwM77JIEh1ydMVNJks9soIip.jpeg', 'ahmedmohamed', 'web', 'famous', 'male', NULL, 1, 0, 1, '675786879', '/uploads/profiles/8/1580729010.jpg', '6757897979', '$2y$10$LdAo3ITpNwExb6KtokVsaePJf5Mci/yBQ2jcPnn0dYPh7Q.0Mkc3K', 2, 2, NULL, NULL, NULL, '2020-02-03 11:21:34', '2020-02-03 11:23:30'),
(9, 00000000005, 'نبيل', 'الغامدي', 'nabad.ksa@gmail.com', '2020-02-11 08:36:40', NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$s1qBskDui/FMp1J1tz7OkO/4yhlzKDCAW6bbKOhtSb9HfBLsRRude', NULL, NULL, NULL, NULL, NULL, '2020-02-04 07:20:52', '2020-02-11 08:36:40'),
(10, 00000000005, 'ابرهيم', 'محمد', 'ibrahim_elrefaey@hotmail.com', '2020-02-05 12:56:45', '/uploads/profiles/10/hWFq4IN47d5XIMbdKtfAExLZu62Q0Th6uCB53qvx.png', 'ابرهيممحمد', 'web', 'normal', 'male', NULL, 1, 0, 0, NULL, NULL, '01017100093', '$2y$10$RmZdXwDyVArJtCwxph59DOMjVXzPQa5KMlQUY0gsgjDkIQS5PCZNi', 1, NULL, NULL, NULL, NULL, '2020-02-05 08:41:03', '2020-02-05 12:58:07'),
(11, 00000000005, 'ibrahim', 'refaey', 'ibrahim.elrefaey.01@gmaill.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$DdKAwH4hAM9tHQqxcy.I/eUOSxxzEIZbH1c47noJky0hriUIWAKyu', NULL, NULL, NULL, NULL, NULL, '2020-02-05 10:48:58', '2020-02-05 10:48:58'),
(14, 00000000006, 'الغامدي', 'الغامدي', 'tr0k7733@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$pk9cW1vXLR1mgMESX0wy9.Rz.sKnTcvbeWkKqvyYBqikJexfQBKr2', NULL, NULL, 'google', '109043198210981920435', NULL, '2020-02-06 19:53:03', '2020-02-06 21:26:13'),
(15, 00000000006, 'سيرف', 'فايف', 'serv5group.com@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$uBlZ2A38t9KENiNu4a2y0uxi.HGmimtfUUPwcCKclRnSUaVHRbZne', NULL, NULL, 'google', '108808848823598755467', NULL, '2020-02-09 09:16:09', '2020-02-09 09:16:09'),
(16, 00000000006, 'eme', 'sa', 'emecomsa@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$Gu0ZR/N8qeBxS5X/npNeU.tbVj4FufaR5acPYlLibv3xASR2kVWvC', NULL, NULL, 'google', '115099839760285612502', NULL, '2020-02-09 09:19:11', '2020-02-09 09:19:11'),
(17, 00000000006, 'saleh', 'alghamdi', 'ks7.un.sa@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$Gy4h9sZqNV5re6Je.neZ8uHLlISZnFe28OWD/IwxrChk/DsPUvhDK', NULL, NULL, NULL, NULL, NULL, '2020-02-11 08:26:40', '2020-02-11 08:26:40'),
(19, 00000000007, 'ندي', 'خالد', 'nadakhalledkhaleel@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$i0WcucW8gMmZqmTk2oWvquv9LOJcpyqdkyqY7cblt.8su/pm5WrIa', NULL, NULL, NULL, NULL, NULL, '2020-02-11 13:46:52', '2020-02-11 13:46:52'),
(20, 00000000006, 'saleh', 'alghamdi', 'ks8.un.sa@gmail.com', '2020-02-25 07:55:20', NULL, 'salehalghamdi', 'web', 'normal', 'male', NULL, 1, 1, 1, NULL, NULL, '0554043330', '$2y$10$FlJFG2FK2V4VItShgWbrN.QGHZHFQh6Z2MjwVrlz6a3hOsqFZwlli', 2, 2, NULL, NULL, NULL, '2020-02-25 07:52:55', '2020-02-25 07:57:36'),
(21, 00000000007, 'تركي', 'الغامدي', 'ashhurni@gmail.com', '2020-02-25 08:48:08', '/uploads/profiles/21/b0HD8TNgboK5tH4s73YzHWCbHABRNW0xVMoUdI4O.png', 'تركيالغامدي', 'web', NULL, 'male', NULL, 1, 1, 1, NULL, NULL, '0535442004', '$2y$10$W6hTx1y3rb6LDlkhk2zQJesOTczd1WrTZVTO/Keo2VyCR5W69C.Qi', 2, 2, NULL, NULL, 'SR7JpvfsuSyixD5QLMcgNHovi1d8exoicp6DeUSeeYgpXj6TBLWi4SHLqDdh', '2020-02-25 08:46:17', '2020-02-25 09:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `users_settings`
--

CREATE TABLE `users_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `send_email` tinyint(1) NOT NULL DEFAULT 0,
  `send_sms` tinyint(1) NOT NULL DEFAULT 0,
  `send_section` tinyint(1) NOT NULL DEFAULT 0,
  `normal_user_register` tinyint(1) NOT NULL DEFAULT 0,
  `famous_user_register` tinyint(1) NOT NULL DEFAULT 0,
  `register_section` tinyint(1) NOT NULL DEFAULT 0,
  `famous_section` tinyint(1) NOT NULL DEFAULT 0,
  `famous_ads_front` tinyint(1) NOT NULL DEFAULT 0,
  `famous_ads_menu` tinyint(1) NOT NULL DEFAULT 0,
  `identification_number` tinyint(1) NOT NULL DEFAULT 0,
  `identification_image` tinyint(1) NOT NULL DEFAULT 0,
  `myAccounts_menu` tinyint(1) NOT NULL DEFAULT 0,
  `myAds_menu` tinyint(1) NOT NULL DEFAULT 0,
  `featuredAd_menu` tinyint(1) NOT NULL DEFAULT 0,
  `AdInOurAccounts_menu` tinyint(1) NOT NULL DEFAULT 0,
  `myPoints_menu` tinyint(1) NOT NULL DEFAULT 0,
  `ticketOpen_menu` tinyint(1) NOT NULL DEFAULT 0,
  `contact_us` tinyint(1) NOT NULL DEFAULT 0,
  `points` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_settings`
--

INSERT INTO `users_settings` (`id`, `send_email`, `send_sms`, `send_section`, `normal_user_register`, `famous_user_register`, `register_section`, `famous_section`, `famous_ads_front`, `famous_ads_menu`, `identification_number`, `identification_image`, `myAccounts_menu`, `myAds_menu`, `featuredAd_menu`, `AdInOurAccounts_menu`, `myPoints_menu`, `ticketOpen_menu`, `contact_us`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, NULL, '2020-02-02 09:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_users`
--

INSERT INTO `verify_users` (`id`, `user_id`, `token`, `code`, `created_at`, `updated_at`) VALUES
(10, 3, 'b1550b23027dd19241389dabc5675695d49edcf2', '7350072', '2020-01-29 14:36:25', '2020-01-29 14:36:25'),
(11, 4, 'cacc38d15c9b64e3ad0cf418d3072f3dea1b9568', '6811894', '2020-01-29 14:40:10', '2020-01-29 14:40:10'),
(15, 5, 'd61d65895951e8d76fcc0748389b25011d181b64', '5353694', '2020-01-29 14:46:16', '2020-01-29 14:46:16'),
(16, 6, 'a78b02f5d084fe5046bad86f3e4f7f9d4c1450cb', '3615914', '2020-01-29 16:32:11', '2020-01-29 16:32:11'),
(18, 7, '2ebb88eab8fa4cd84f2fb2259c6991156376c566', '5271052', '2020-02-02 09:26:57', '2020-02-02 09:26:57'),
(19, 8, '4df8301a21a31fd89a2f3c7e560487f205705c3e', '5884058', '2020-02-03 11:21:35', '2020-02-03 11:21:35'),
(23, 9, '429e7e326d40439e595957c2378f368534dccacb', '5478688', '2020-02-04 08:02:19', '2020-02-04 08:02:19'),
(30, 11, '0ff723cab922103fec62c992ec4e71127348bf90', '1652684', '2020-02-05 12:49:55', '2020-02-05 12:49:55'),
(33, 10, 'b6b8b15bd8e47285a03fa80cc011e139f35abd52', '2056100', '2020-02-05 12:55:32', '2020-02-05 12:55:32'),
(36, 12, 'ac687ddb37db3b3f7e587f120aa11549fe51d873', '9048144', '2020-02-06 11:35:55', '2020-02-06 11:35:55'),
(38, 13, '89782e14910b14a29894615a94f5abd5afb73b15', '8050301', '2020-02-06 11:42:23', '2020-02-06 11:42:23'),
(40, 14, '20c684abad3ec40965717a2c909903ef91ff17b4', '9234598', '2020-02-06 21:23:38', '2020-02-06 21:23:38'),
(42, 16, '449669b8bc290febccdf63d82d00e3aeb76b9cf0', '', '2020-02-09 09:19:11', '2020-02-09 09:19:11'),
(43, 15, 'dbe2390b5657b018cbb300904d74fffe47814dc1', '5288951', '2020-02-09 10:31:49', '2020-02-09 10:31:49'),
(44, 17, 'dcf804fa7503b6128b9d61a980c5f0294b1cd220', '1321359', '2020-02-11 08:26:41', '2020-02-11 08:26:41'),
(46, 18, '6eeeec075e72c446f0ed7ee85647a90a22d364bf', '6062414', '2020-02-11 11:58:04', '2020-02-11 11:58:04'),
(47, 19, 'e0d32de6f7807da94674b29b8b6700744c46f694', '5960009', '2020-02-11 13:46:53', '2020-02-11 13:46:53'),
(49, 2, '2290177ea0258dda2f1cea5de5d57a0940807f9f', '4094098', '2020-02-17 07:20:05', '2020-02-17 07:20:05'),
(50, 20, '7d3b79da20601fc73304b7aa48411144e2b3e870', '8838', '2020-02-25 07:52:55', '2020-02-25 07:52:55'),
(53, 21, 'c337726e89188d70fd680749bd634cb46005a619', '1371', '2020-02-25 08:46:57', '2020-02-25 08:46:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_contents`
--
ALTER TABLE `account_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_contents_translations`
--
ALTER TABLE `account_contents_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_contents_translations_account_content_id_foreign` (`account_content_id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisements_advertise_on_foreign` (`advertise_on`);

--
-- Indexes for table `advertisements_translations`
--
ALTER TABLE `advertisements_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisements_translations_advertisement_id_foreign` (`advertisement_id`);

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
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `blogs_tags`
--
ALTER TABLE `blogs_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_tags_blog_id_foreign` (`blog_id`),
  ADD KEY `blogs_tags_tag_id_foreign` (`tag_id`);

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `cities_translations`
--
ALTER TABLE `cities_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_translations_city_id_foreign` (`city_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id_fk` (`ticket_id`),
  ADD KEY `priority_id_fk` (`priority_id`);

--
-- Indexes for table `content_sections`
--
ALTER TABLE `content_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_sections_translations`
--
ALTER TABLE `content_sections_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_sections_translations_content_section_id_foreign` (`content_section_id`);

--
-- Indexes for table `content_section_advertisement`
--
ALTER TABLE `content_section_advertisement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_section_advertisement_content_section_id_foreign` (`content_section_id`),
  ADD KEY `content_section_advertisement_advertisement_id_foreign` (`advertisement_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates_data`
--
ALTER TABLE `email_templates_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_templates_data_email_template_id_foreign` (`email_template_id`);

--
-- Indexes for table `email_templates_data_translations`
--
ALTER TABLE `email_templates_data_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_templates_data_translations_email_template_data_id_foreign` (`email_template_data_id`);

--
-- Indexes for table `email_templates_translations`
--
ALTER TABLE `email_templates_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_templates_translations_email_template_id_foreign` (`email_template_id`);

--
-- Indexes for table `featured_ads`
--
ALTER TABLE `featured_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_ads_users`
--
ALTER TABLE `featured_ads_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `featured_ads_users_user_id_foreign` (`user_id`),
  ADD KEY `featured_ads_users_featured_id_foreign` (`featured_id`),
  ADD KEY `featured_ads_users_social_link_id_foreign` (`social_link_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_translations`
--
ALTER TABLE `footer_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `footer_translations_footer_id_foreign` (`footer_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages_products`
--
ALTER TABLE `languages_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages_translations`
--
ALTER TABLE `languages_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `languages_translations_language_id_foreign` (`language_id`);

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
-- Indexes for table `notify_templates`
--
ALTER TABLE `notify_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_templates_data`
--
ALTER TABLE `notify_templates_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notify_templates_data_notify_template_id_foreign` (`notify_template_id`);

--
-- Indexes for table `notify_templates_data_translations`
--
ALTER TABLE `notify_templates_data_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notify_templates_data_translations_notify_data_id_foreign` (`notify_data_id`);

--
-- Indexes for table `notify_templates_translations`
--
ALTER TABLE `notify_templates_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notify_templates_translations_notify_template_id_foreign` (`notify_template_id`);

--
-- Indexes for table `online_payment`
--
ALTER TABLE `online_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_ticket`
--
ALTER TABLE `open_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_ticket_translations`
--
ALTER TABLE `open_ticket_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `open_ticket_translations_open_ticket_id_foreign` (`open_ticket_id`);

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
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points_translations`
--
ALTER TABLE `points_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `points_translations_point_id_foreign` (`point_id`);

--
-- Indexes for table `point_user`
--
ALTER TABLE `point_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_user_user_id_foreign` (`user_id`),
  ADD KEY `point_user_point_id_foreign` (`point_id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priorities_translations`
--
ALTER TABLE `priorities_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priorities_translations_priority_id_foreign` (`priority_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings_translations`
--
ALTER TABLE `ratings_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_translations_rating_id_foreign` (`rating_id`);

--
-- Indexes for table `rating_user`
--
ALTER TABLE `rating_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_user_user_id_foreign` (`user_id`),
  ADD KEY `rating_user_rating_id_foreign` (`rating_id`),
  ADD KEY `rating_user_social_advertisement_id_foreign` (`social_advertisement_id`);

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
-- Indexes for table `send_users`
--
ALTER TABLE `send_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_translations`
--
ALTER TABLE `settings_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_languages`
--
ALTER TABLE `site_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_translations_slider_id_foreign` (`slider_id`);

--
-- Indexes for table `slider_user`
--
ALTER TABLE `slider_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_advertisement`
--
ALTER TABLE `social_advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_advertisement_user`
--
ALTER TABLE `social_advertisement_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_advertisement_user_user_id_foreign` (`user_id`),
  ADD KEY `social_advertisement_user_famous_id_foreign` (`famous_id`),
  ADD KEY `social_advertisement_user_social_link_id_foreign` (`social_link_id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links_translations`
--
ALTER TABLE `social_links_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_links_translations_social_id_foreign` (`social_id`);

--
-- Indexes for table `social_link_setting`
--
ALTER TABLE `social_link_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_link_user`
--
ALTER TABLE `social_link_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_link_user_user_id_foreign` (`user_id`),
  ADD KEY `social_link_user_social_id_foreign` (`social_id`);

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
  ADD KEY `users_city_id_foreign` (`city_id`);

--
-- Indexes for table `users_settings`
--
ALTER TABLE `users_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_users`
--
ALTER TABLE `verify_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verify_users_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_contents`
--
ALTER TABLE `account_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_contents_translations`
--
ALTER TABLE `account_contents_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advertisements_translations`
--
ALTER TABLE `advertisements_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banks_translations`
--
ALTER TABLE `banks_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
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
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities_translations`
--
ALTER TABLE `cities_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `content_sections`
--
ALTER TABLE `content_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_sections_translations`
--
ALTER TABLE `content_sections_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_section_advertisement`
--
ALTER TABLE `content_section_advertisement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries_translations`
--
ALTER TABLE `countries_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies_translation`
--
ALTER TABLE `currencies_translation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency_convertor`
--
ALTER TABLE `currency_convertor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_templates_data`
--
ALTER TABLE `email_templates_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_templates_data_translations`
--
ALTER TABLE `email_templates_data_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `email_templates_translations`
--
ALTER TABLE `email_templates_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `featured_ads`
--
ALTER TABLE `featured_ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `featured_ads_users`
--
ALTER TABLE `featured_ads_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footer_translations`
--
ALTER TABLE `footer_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages_products`
--
ALTER TABLE `languages_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages_translations`
--
ALTER TABLE `languages_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_templates`
--
ALTER TABLE `notify_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notify_templates_data`
--
ALTER TABLE `notify_templates_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notify_templates_data_translations`
--
ALTER TABLE `notify_templates_data_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notify_templates_translations`
--
ALTER TABLE `notify_templates_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `online_payment`
--
ALTER TABLE `online_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `open_ticket`
--
ALTER TABLE `open_ticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `open_ticket_translations`
--
ALTER TABLE `open_ticket_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `points_translations`
--
ALTER TABLE `points_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `point_user`
--
ALTER TABLE `point_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `priorities_translations`
--
ALTER TABLE `priorities_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings_translations`
--
ALTER TABLE `ratings_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rating_user`
--
ALTER TABLE `rating_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `send_users`
--
ALTER TABLE `send_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider_user`
--
ALTER TABLE `slider_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_advertisement`
--
ALTER TABLE `social_advertisement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_advertisement_user`
--
ALTER TABLE `social_advertisement_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_links_translations`
--
ALTER TABLE `social_links_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_link_setting`
--
ALTER TABLE `social_link_setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `social_link_user`
--
ALTER TABLE `social_link_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users_settings`
--
ALTER TABLE `users_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `verify_users`
--
ALTER TABLE `verify_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_contents_translations`
--
ALTER TABLE `account_contents_translations`
  ADD CONSTRAINT `account_contents_translations_account_content_id_foreign` FOREIGN KEY (`account_content_id`) REFERENCES `account_contents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_advertise_on_foreign` FOREIGN KEY (`advertise_on`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advertisements_translations`
--
ALTER TABLE `advertisements_translations`
  ADD CONSTRAINT `advertisements_translations_advertisement_id_foreign` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities_translations`
--
ALTER TABLE `cities_translations`
  ADD CONSTRAINT `cities_translations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `priority_id_fk` FOREIGN KEY (`priority_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `ticket_id_fk` FOREIGN KEY (`ticket_id`) REFERENCES `open_ticket` (`id`);

--
-- Constraints for table `content_sections_translations`
--
ALTER TABLE `content_sections_translations`
  ADD CONSTRAINT `content_sections_translations_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content_section_advertisement`
--
ALTER TABLE `content_section_advertisement`
  ADD CONSTRAINT `content_section_advertisement_advertisement_id_foreign` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `content_section_advertisement_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `email_templates_data`
--
ALTER TABLE `email_templates_data`
  ADD CONSTRAINT `email_templates_data_email_template_id_foreign` FOREIGN KEY (`email_template_id`) REFERENCES `email_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email_templates_data_translations`
--
ALTER TABLE `email_templates_data_translations`
  ADD CONSTRAINT `email_templates_data_translations_email_template_data_id_foreign` FOREIGN KEY (`email_template_data_id`) REFERENCES `email_templates_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email_templates_translations`
--
ALTER TABLE `email_templates_translations`
  ADD CONSTRAINT `email_templates_translations_email_template_id_foreign` FOREIGN KEY (`email_template_id`) REFERENCES `email_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `featured_ads_users`
--
ALTER TABLE `featured_ads_users`
  ADD CONSTRAINT `featured_ads_users_featured_id_foreign` FOREIGN KEY (`featured_id`) REFERENCES `featured_ads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `featured_ads_users_social_link_id_foreign` FOREIGN KEY (`social_link_id`) REFERENCES `social_link_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `featured_ads_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `footer_translations`
--
ALTER TABLE `footer_translations`
  ADD CONSTRAINT `footer_translations_footer_id_foreign` FOREIGN KEY (`footer_id`) REFERENCES `footer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `languages_translations`
--
ALTER TABLE `languages_translations`
  ADD CONSTRAINT `languages_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `notify_templates_data`
--
ALTER TABLE `notify_templates_data`
  ADD CONSTRAINT `notify_templates_data_notify_template_id_foreign` FOREIGN KEY (`notify_template_id`) REFERENCES `notify_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notify_templates_data_translations`
--
ALTER TABLE `notify_templates_data_translations`
  ADD CONSTRAINT `notify_templates_data_translations_notify_data_id_foreign` FOREIGN KEY (`notify_data_id`) REFERENCES `notify_templates_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notify_templates_translations`
--
ALTER TABLE `notify_templates_translations`
  ADD CONSTRAINT `notify_templates_translations_notify_template_id_foreign` FOREIGN KEY (`notify_template_id`) REFERENCES `notify_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `open_ticket_translations`
--
ALTER TABLE `open_ticket_translations`
  ADD CONSTRAINT `open_ticket_translations_open_ticket_id_foreign` FOREIGN KEY (`open_ticket_id`) REFERENCES `open_ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `points_translations`
--
ALTER TABLE `points_translations`
  ADD CONSTRAINT `points_translations_point_id_foreign` FOREIGN KEY (`point_id`) REFERENCES `points` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `point_user`
--
ALTER TABLE `point_user`
  ADD CONSTRAINT `point_user_point_id_foreign` FOREIGN KEY (`point_id`) REFERENCES `points` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `point_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `priorities_translations`
--
ALTER TABLE `priorities_translations`
  ADD CONSTRAINT `priorities_translations_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings_translations`
--
ALTER TABLE `ratings_translations`
  ADD CONSTRAINT `ratings_translations_rating_id_foreign` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_user`
--
ALTER TABLE `rating_user`
  ADD CONSTRAINT `rating_user_rating_id_foreign` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_user_social_advertisement_id_foreign` FOREIGN KEY (`social_advertisement_id`) REFERENCES `social_advertisement_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `send_users`
--
ALTER TABLE `send_users`
  ADD CONSTRAINT `send_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sliders_translations`
--
ALTER TABLE `sliders_translations`
  ADD CONSTRAINT `sliders_translations_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_advertisement_user`
--
ALTER TABLE `social_advertisement_user`
  ADD CONSTRAINT `social_advertisement_user_famous_id_foreign` FOREIGN KEY (`famous_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `social_advertisement_user_social_link_id_foreign` FOREIGN KEY (`social_link_id`) REFERENCES `social_link_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `social_advertisement_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_links_translations`
--
ALTER TABLE `social_links_translations`
  ADD CONSTRAINT `social_links_translations_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_link_user`
--
ALTER TABLE `social_link_user`
  ADD CONSTRAINT `social_link_user_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `social_link_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
