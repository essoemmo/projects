-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ashhrny
CREATE DATABASE IF NOT EXISTS `ashhrny` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `ashhrny`;

-- Dumping structure for table ashhrny.account_contents
CREATE TABLE IF NOT EXISTS `account_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.account_contents: ~2 rows (approximately)
DELETE FROM `account_contents`;
/*!40000 ALTER TABLE `account_contents` DISABLE KEYS */;
INSERT INTO `account_contents` (`id`, `created_at`, `updated_at`) VALUES
	(1, '2020-01-28 23:46:45', '2020-01-28 23:46:45'),
	(2, '2020-02-20 06:08:43', '2020-02-20 06:08:43');
/*!40000 ALTER TABLE `account_contents` ENABLE KEYS */;

-- Dumping structure for table ashhrny.account_contents_translations
CREATE TABLE IF NOT EXISTS `account_contents_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_content_id` int(10) unsigned DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_contents_translations_account_content_id_foreign` (`account_content_id`),
  CONSTRAINT `account_contents_translations_account_content_id_foreign` FOREIGN KEY (`account_content_id`) REFERENCES `account_contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.account_contents_translations: ~4 rows (approximately)
DELETE FROM `account_contents_translations`;
/*!40000 ALTER TABLE `account_contents_translations` DISABLE KEYS */;
INSERT INTO `account_contents_translations` (`id`, `title`, `account_content_id`, `locale`, `created_at`, `updated_at`) VALUES
	(1, 'تجاري', 1, 'ar', '2020-01-28 23:46:45', '2020-01-28 23:46:45'),
	(2, 'Commercial', 1, 'en', '2020-01-28 23:46:45', '2020-01-28 23:46:45'),
	(3, 'ترفيهي', 2, 'ar', '2020-02-20 06:08:43', '2020-02-20 06:08:43'),
	(4, 'entertainment', 2, 'en', '2020-02-20 06:08:43', '2020-02-20 06:08:43');
/*!40000 ALTER TABLE `account_contents_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.advertisements
CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertise_type` enum('website','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertise_on` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertisements_advertise_on_foreign` (`advertise_on`),
  CONSTRAINT `advertisements_advertise_on_foreign` FOREIGN KEY (`advertise_on`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.advertisements: ~0 rows (approximately)
DELETE FROM `advertisements`;
/*!40000 ALTER TABLE `advertisements` DISABLE KEYS */;
/*!40000 ALTER TABLE `advertisements` ENABLE KEYS */;

-- Dumping structure for table ashhrny.advertisements_translations
CREATE TABLE IF NOT EXISTS `advertisements_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertisement_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advertisements_translations_advertisement_id_foreign` (`advertisement_id`),
  CONSTRAINT `advertisements_translations_advertisement_id_foreign` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.advertisements_translations: ~0 rows (approximately)
DELETE FROM `advertisements_translations`;
/*!40000 ALTER TABLE `advertisements_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `advertisements_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.banks
CREATE TABLE IF NOT EXISTS `banks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.banks: ~2 rows (approximately)
DELETE FROM `banks`;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` (`id`, `image`, `code`, `created_at`, `updated_at`) VALUES
	(1, '/uploads/banks/1/1582522353.png', '2781247', '2020-01-28 23:45:50', '2020-02-24 07:32:33'),
	(2, NULL, '22222555566666666', '2020-02-11 04:22:09', '2020-02-11 04:22:09');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;

-- Dumping structure for table ashhrny.banks_translations
CREATE TABLE IF NOT EXISTS `banks_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banks_translations_bank_id_foreign` (`bank_id`),
  CONSTRAINT `banks_translations_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.banks_translations: ~4 rows (approximately)
DELETE FROM `banks_translations`;
/*!40000 ALTER TABLE `banks_translations` DISABLE KEYS */;
INSERT INTO `banks_translations` (`id`, `bank_id`, `title`, `locale`) VALUES
	(1, 1, 'البنك الاهلي', 'ar'),
	(2, 1, 'el ahly bank', 'en'),
	(3, 2, 'الراجحي', 'ar'),
	(4, 2, 'al raghe', 'en');
/*!40000 ALTER TABLE `banks_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort` tinyint(4) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.banners: ~0 rows (approximately)
DELETE FROM `banners`;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;

-- Dumping structure for table ashhrny.blogs
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_category_id_foreign` (`category_id`),
  CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.blogs: ~0 rows (approximately)
DELETE FROM `blogs`;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;

-- Dumping structure for table ashhrny.blogs_tags
CREATE TABLE IF NOT EXISTS `blogs_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL,
  `blog_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_tags_blog_id_foreign` (`blog_id`),
  KEY `blogs_tags_tag_id_foreign` (`tag_id`),
  CONSTRAINT `blogs_tags_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blogs_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.blogs_tags: ~0 rows (approximately)
DELETE FROM `blogs_tags`;
/*!40000 ALTER TABLE `blogs_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs_tags` ENABLE KEYS */;

-- Dumping structure for table ashhrny.blog_categories
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `main` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.blog_categories: ~0 rows (approximately)
DELETE FROM `blog_categories`;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;

-- Dumping structure for table ashhrny.blog_categories_translations
CREATE TABLE IF NOT EXISTS `blog_categories_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_categories_translations_blog_category_id_foreign` (`blog_category_id`),
  CONSTRAINT `blog_categories_translations_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.blog_categories_translations: ~0 rows (approximately)
DELETE FROM `blog_categories_translations`;
/*!40000 ALTER TABLE `blog_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_categories_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.blog_translations
CREATE TABLE IF NOT EXISTS `blog_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_translations_blog_id_foreign` (`blog_id`),
  CONSTRAINT `blog_translations_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.blog_translations: ~0 rows (approximately)
DELETE FROM `blog_translations`;
/*!40000 ALTER TABLE `blog_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_country_id_foreign` (`country_id`),
  CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.cities: ~2 rows (approximately)
DELETE FROM `cities`;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`id`, `country_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2020-01-28 23:44:54', '2020-01-28 23:44:54'),
	(2, 2, '2020-01-28 23:45:05', '2020-01-28 23:45:05');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Dumping structure for table ashhrny.cities_translations
CREATE TABLE IF NOT EXISTS `cities_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_translations_city_id_foreign` (`city_id`),
  CONSTRAINT `cities_translations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.cities_translations: ~4 rows (approximately)
DELETE FROM `cities_translations`;
/*!40000 ALTER TABLE `cities_translations` DISABLE KEYS */;
INSERT INTO `cities_translations` (`id`, `title`, `city_id`, `locale`, `created_at`, `updated_at`) VALUES
	(1, 'القاهرة', 1, 'ar', '2020-01-28 23:44:54', '2020-01-28 23:44:54'),
	(2, 'Cairo', 1, 'en', '2020-01-28 23:44:54', '2020-01-28 23:44:54'),
	(3, 'مكة', 2, 'ar', '2020-01-28 23:45:05', '2020-01-28 23:45:05'),
	(4, 'Makka', 2, 'en', '2020-01-28 23:45:05', '2020-01-28 23:45:05');
/*!40000 ALTER TABLE `cities_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_id` int(10) unsigned DEFAULT NULL,
  `priority_id` int(10) unsigned DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_ticket_id_foreign` (`ticket_id`),
  KEY `contacts_priority_id_foreign` (`priority_id`),
  CONSTRAINT `contacts_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contacts_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `open_ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.contacts: ~6 rows (approximately)
DELETE FROM `contacts`;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `ticket_id`, `priority_id`, `message`, `created_at`, `updated_at`) VALUES
	(1, 'صالح الغامدي', 'ashhrni1@gmail.com', NULL, NULL, NULL, NULL, '<p>السلام عليكم ورحمة الله وبركاته&nbsp;</p>', '2020-02-09 00:01:57', '2020-02-09 00:01:57'),
	(2, 'محمد', 'ks7.un.sa@gmail.com', NULL, NULL, NULL, NULL, '<p>التقديم متاح لجميع مدن المملكة&nbsp;</p>', '2020-02-09 00:36:23', '2020-02-09 00:36:23'),
	(3, 'تركي', 'tr0k7733@gmail.com', NULL, NULL, NULL, NULL, '<p>السلام عليكم ورحمة الله وبركاته&nbsp;</p>', '2020-02-09 22:10:17', '2020-02-09 22:10:17'),
	(5, 'يفلافثي', 'nadynaltwkhy60@gmail.com', NULL, NULL, NULL, NULL, '<p>y6trhytruytuytu</p>', '2020-02-16 23:30:59', '2020-02-16 23:30:59'),
	(6, 'user', 'user_one@user.com', NULL, NULL, NULL, NULL, '<p>فثسف سشيهتشسيخهتشيسهتشسهيتخشهتيس</p>', '2020-02-24 07:41:42', '2020-02-24 07:41:42'),
	(7, 'Ibrahim_el_monier', 'user_one@user.com', '015468546', 'oisdfjhsiod', 3, 1, '<p>lsdkfsdkfopsdfkopsdkfpsodfksd</p>', '2020-02-24 08:01:30', '2020-02-24 08:01:30');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Dumping structure for table ashhrny.content_sections
CREATE TABLE IF NOT EXISTS `content_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint(4) NOT NULL,
  `columns` tinyint(4) NOT NULL,
  `type` enum('home','footer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.content_sections: ~0 rows (approximately)
DELETE FROM `content_sections`;
/*!40000 ALTER TABLE `content_sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_sections` ENABLE KEYS */;

-- Dumping structure for table ashhrny.content_sections_translations
CREATE TABLE IF NOT EXISTS `content_sections_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_section_id` int(10) unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_sections_translations_content_section_id_foreign` (`content_section_id`),
  CONSTRAINT `content_sections_translations_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.content_sections_translations: ~0 rows (approximately)
DELETE FROM `content_sections_translations`;
/*!40000 ALTER TABLE `content_sections_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_sections_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.content_section_advertisement
CREATE TABLE IF NOT EXISTS `content_section_advertisement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_section_id` int(10) unsigned DEFAULT NULL,
  `advertisement_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_section_advertisement_content_section_id_foreign` (`content_section_id`),
  KEY `content_section_advertisement_advertisement_id_foreign` (`advertisement_id`),
  CONSTRAINT `content_section_advertisement_advertisement_id_foreign` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `content_section_advertisement_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.content_section_advertisement: ~0 rows (approximately)
DELETE FROM `content_section_advertisement`;
/*!40000 ALTER TABLE `content_section_advertisement` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_section_advertisement` ENABLE KEYS */;

-- Dumping structure for table ashhrny.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.countries: ~2 rows (approximately)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `logo`, `code`, `call_code`, `created_at`, `updated_at`) VALUES
	(1, '/uploads/country/1/1580283872.png', 'EG', '+20', '2020-01-28 23:44:32', '2020-01-28 23:44:32'),
	(2, '/uploads/country/2/1580283882.png', 'KSA', '+966', '2020-01-28 23:44:42', '2020-01-28 23:44:42');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping structure for table ashhrny.countries_translations
CREATE TABLE IF NOT EXISTS `countries_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_translations_country_id_foreign` (`country_id`),
  CONSTRAINT `countries_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.countries_translations: ~4 rows (approximately)
DELETE FROM `countries_translations`;
/*!40000 ALTER TABLE `countries_translations` DISABLE KEYS */;
INSERT INTO `countries_translations` (`id`, `country_id`, `title`, `locale`, `created_at`, `updated_at`) VALUES
	(1, 1, 'مصر', 'ar', '2020-01-28 23:44:32', '2020-01-28 23:44:32'),
	(2, 1, 'Egypt', 'en', '2020-01-28 23:44:32', '2020-01-28 23:44:32'),
	(3, 2, 'السعودية', 'ar', '2020-01-28 23:44:43', '2020-01-28 23:44:43'),
	(4, 2, 'Saudi Arabia', 'en', '2020-01-28 23:44:43', '2020-01-28 23:44:43');
/*!40000 ALTER TABLE `countries_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currencies_country_id_index` (`country_id`),
  CONSTRAINT `currencies_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.currencies: ~0 rows (approximately)
DELETE FROM `currencies`;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;

-- Dumping structure for table ashhrny.currencies_translation
CREATE TABLE IF NOT EXISTS `currencies_translation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` int(10) unsigned DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currencies_translation_currency_id_foreign` (`currency_id`),
  CONSTRAINT `currencies_translation_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.currencies_translation: ~0 rows (approximately)
DELETE FROM `currencies_translation`;
/*!40000 ALTER TABLE `currencies_translation` DISABLE KEYS */;
/*!40000 ALTER TABLE `currencies_translation` ENABLE KEYS */;

-- Dumping structure for table ashhrny.currency_convertor
CREATE TABLE IF NOT EXISTS `currency_convertor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.currency_convertor: ~0 rows (approximately)
DELETE FROM `currency_convertor`;
/*!40000 ALTER TABLE `currency_convertor` DISABLE KEYS */;
/*!40000 ALTER TABLE `currency_convertor` ENABLE KEYS */;

-- Dumping structure for table ashhrny.email_templates
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.email_templates: ~5 rows (approximately)
DELETE FROM `email_templates`;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` (`id`, `code`, `created_at`, `updated_at`) VALUES
	(1, 'VerificationEmail', NULL, NULL),
	(2, 'UserResetPassword', NULL, NULL),
	(3, 'orderStatusApproved', NULL, NULL),
	(4, 'orderStatusRefused', NULL, NULL),
	(5, 'orderStatusWaiting', NULL, NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;

-- Dumping structure for table ashhrny.email_templates_data
CREATE TABLE IF NOT EXISTS `email_templates_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_template_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_templates_data_email_template_id_foreign` (`email_template_id`),
  CONSTRAINT `email_templates_data_email_template_id_foreign` FOREIGN KEY (`email_template_id`) REFERENCES `email_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.email_templates_data: ~5 rows (approximately)
DELETE FROM `email_templates_data`;
/*!40000 ALTER TABLE `email_templates_data` DISABLE KEYS */;
INSERT INTO `email_templates_data` (`id`, `from_email`, `email_template_id`, `created_at`, `updated_at`) VALUES
	(1, 'support@ashhrni.com', 1, NULL, NULL),
	(2, 'support@ashhrni.com', 2, NULL, NULL),
	(3, 'support@ashhrni.com', 3, NULL, NULL),
	(4, 'support@ashhrni.com', 4, NULL, NULL),
	(5, 'support@ashhrni.com', 5, NULL, NULL);
/*!40000 ALTER TABLE `email_templates_data` ENABLE KEYS */;

-- Dumping structure for table ashhrny.email_templates_data_translations
CREATE TABLE IF NOT EXISTS `email_templates_data_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_template_data_id` int(10) unsigned NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_templates_data_translations_email_template_data_id_foreign` (`email_template_data_id`),
  CONSTRAINT `email_templates_data_translations_email_template_data_id_foreign` FOREIGN KEY (`email_template_data_id`) REFERENCES `email_templates_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.email_templates_data_translations: ~10 rows (approximately)
DELETE FROM `email_templates_data_translations`;
/*!40000 ALTER TABLE `email_templates_data_translations` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `email_templates_data_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.email_templates_translations
CREATE TABLE IF NOT EXISTS `email_templates_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_template_id` int(10) unsigned NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_templates_translations_email_template_id_foreign` (`email_template_id`),
  CONSTRAINT `email_templates_translations_email_template_id_foreign` FOREIGN KEY (`email_template_id`) REFERENCES `email_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.email_templates_translations: ~10 rows (approximately)
DELETE FROM `email_templates_translations`;
/*!40000 ALTER TABLE `email_templates_translations` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `email_templates_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.featured_ads
CREATE TABLE IF NOT EXISTS `featured_ads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place` enum('slider','featured') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.featured_ads: ~2 rows (approximately)
DELETE FROM `featured_ads`;
/*!40000 ALTER TABLE `featured_ads` DISABLE KEYS */;
INSERT INTO `featured_ads` (`id`, `place`, `price`, `created_at`, `updated_at`) VALUES
	(1, 'slider', 3.00, '2020-01-28 23:47:18', '2020-01-28 23:47:18'),
	(2, 'featured', 2.00, '2020-01-28 23:47:22', '2020-01-28 23:47:22');
/*!40000 ALTER TABLE `featured_ads` ENABLE KEYS */;

-- Dumping structure for table ashhrny.featured_ads_users
CREATE TABLE IF NOT EXISTS `featured_ads_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `featured_id` int(10) unsigned DEFAULT NULL,
  `featured_type` enum('slider','featured') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `social_link_id` int(10) unsigned DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `featured_ads_users_user_id_foreign` (`user_id`),
  KEY `featured_ads_users_featured_id_foreign` (`featured_id`),
  KEY `featured_ads_users_social_link_id_foreign` (`social_link_id`),
  CONSTRAINT `featured_ads_users_featured_id_foreign` FOREIGN KEY (`featured_id`) REFERENCES `featured_ads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `featured_ads_users_social_link_id_foreign` FOREIGN KEY (`social_link_id`) REFERENCES `social_link_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `featured_ads_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.featured_ads_users: ~0 rows (approximately)
DELETE FROM `featured_ads_users`;
/*!40000 ALTER TABLE `featured_ads_users` DISABLE KEYS */;
INSERT INTO `featured_ads_users` (`id`, `orderNumber`, `user_id`, `featured_id`, `featured_type`, `publish`, `social_link_id`, `duration`, `price`, `total`, `from`, `to`, `created_at`, `updated_at`) VALUES
	(1, '4', 21, 2, 'featured', 0, 14, '9', 2.00, 18.00, NULL, NULL, '2020-02-24 07:34:08', '2020-02-24 07:34:08');
/*!40000 ALTER TABLE `featured_ads_users` ENABLE KEYS */;

-- Dumping structure for table ashhrny.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main` tinyint(4) NOT NULL DEFAULT '0',
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileable_id` bigint(20) unsigned DEFAULT NULL,
  `fileable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.files: ~0 rows (approximately)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;

-- Dumping structure for table ashhrny.footer
CREATE TABLE IF NOT EXISTS `footer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.footer: ~0 rows (approximately)
DELETE FROM `footer`;
/*!40000 ALTER TABLE `footer` DISABLE KEYS */;
/*!40000 ALTER TABLE `footer` ENABLE KEYS */;

-- Dumping structure for table ashhrny.footer_translations
CREATE TABLE IF NOT EXISTS `footer_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `footer_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `footer_translations_footer_id_foreign` (`footer_id`),
  CONSTRAINT `footer_translations_footer_id_foreign` FOREIGN KEY (`footer_id`) REFERENCES `footer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.footer_translations: ~0 rows (approximately)
DELETE FROM `footer_translations`;
/*!40000 ALTER TABLE `footer_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `footer_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.languages: ~0 rows (approximately)
DELETE FROM `languages`;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;

-- Dumping structure for table ashhrny.languages_products
CREATE TABLE IF NOT EXISTS `languages_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.languages_products: ~0 rows (approximately)
DELETE FROM `languages_products`;
/*!40000 ALTER TABLE `languages_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `languages_products` ENABLE KEYS */;

-- Dumping structure for table ashhrny.languages_translations
CREATE TABLE IF NOT EXISTS `languages_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `languages_translations_language_id_foreign` (`language_id`),
  CONSTRAINT `languages_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.languages_translations: ~0 rows (approximately)
DELETE FROM `languages_translations`;
/*!40000 ALTER TABLE `languages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `languages_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) unsigned NOT NULL,
  `to_id` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` bigint(20) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_from_id_foreign` (`from_id`),
  KEY `messages_to_id_foreign` (`to_id`),
  CONSTRAINT `messages_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_to_id_foreign` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.messages: ~0 rows (approximately)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table ashhrny.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.migrations: ~77 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
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
	(78, '2020_02_24_074947_add_columns_to_contacts_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.model_has_permissions: ~83 rows (approximately)
DELETE FROM `model_has_permissions`;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table ashhrny.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.model_has_roles: ~18 rows (approximately)
DELETE FROM `model_has_roles`;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
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
	(2, 'App\\User', 14),
	(2, 'App\\User', 15),
	(2, 'App\\User', 16),
	(2, 'App\\User', 17),
	(2, 'App\\User', 19),
	(2, 'App\\User', 21),
	(2, 'App\\User', 22);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table ashhrny.newsletters
CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.newsletters: ~0 rows (approximately)
DELETE FROM `newsletters`;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;

-- Dumping structure for table ashhrny.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.notifications: ~0 rows (approximately)
DELETE FROM `notifications`;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
	('387eae47-8529-4941-877d-84c239f5ae46', 'App\\Notifications\\OpenTicketNotification', 'App\\User', 21, '{"user":21,"body":"test from contact"}', '2020-02-24 09:30:18', '2020-02-24 09:24:58', '2020-02-24 09:30:18');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table ashhrny.notify_templates
CREATE TABLE IF NOT EXISTS `notify_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.notify_templates: ~3 rows (approximately)
DELETE FROM `notify_templates`;
/*!40000 ALTER TABLE `notify_templates` DISABLE KEYS */;
INSERT INTO `notify_templates` (`id`, `code`, `created_at`, `updated_at`) VALUES
	(1, 'orderStatusApproved', NULL, NULL),
	(2, 'orderStatusRefused', NULL, NULL),
	(3, 'orderStatusWaiting', NULL, NULL);
/*!40000 ALTER TABLE `notify_templates` ENABLE KEYS */;

-- Dumping structure for table ashhrny.notify_templates_data
CREATE TABLE IF NOT EXISTS `notify_templates_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notify_template_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notify_templates_data_notify_template_id_foreign` (`notify_template_id`),
  CONSTRAINT `notify_templates_data_notify_template_id_foreign` FOREIGN KEY (`notify_template_id`) REFERENCES `notify_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.notify_templates_data: ~3 rows (approximately)
DELETE FROM `notify_templates_data`;
/*!40000 ALTER TABLE `notify_templates_data` DISABLE KEYS */;
INSERT INTO `notify_templates_data` (`id`, `notify_template_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL),
	(2, 2, NULL, NULL),
	(3, 3, NULL, NULL);
/*!40000 ALTER TABLE `notify_templates_data` ENABLE KEYS */;

-- Dumping structure for table ashhrny.notify_templates_data_translations
CREATE TABLE IF NOT EXISTS `notify_templates_data_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notify_data_id` int(10) unsigned NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notify_templates_data_translations_notify_data_id_foreign` (`notify_data_id`),
  CONSTRAINT `notify_templates_data_translations_notify_data_id_foreign` FOREIGN KEY (`notify_data_id`) REFERENCES `notify_templates_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.notify_templates_data_translations: ~6 rows (approximately)
DELETE FROM `notify_templates_data_translations`;
/*!40000 ALTER TABLE `notify_templates_data_translations` DISABLE KEYS */;
INSERT INTO `notify_templates_data_translations` (`id`, `notify_data_id`, `subject`, `body`, `locale`) VALUES
	(1, 1, 'تمت الموافقة ع طلبك', '<p>تمت الموافقة ع طلبك {order}</p>', 'ar'),
	(2, 1, 'order approved', '<p>order approved {order}</p>', 'en'),
	(3, 2, 'تم رفض طلبك', '<p>تم رفض طلبك {order}</p>', 'ar'),
	(4, 2, 'order refused', '<p>order refused {order}</p>', 'en'),
	(5, 3, 'جاري مراجعة طلبك', '<p>جاري مراجعة طلبك {order}</p>', 'ar'),
	(6, 3, 'Your order is being reviewed', '<p>Your order is being reviewed {order}</p>', 'en');
/*!40000 ALTER TABLE `notify_templates_data_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.notify_templates_translations
CREATE TABLE IF NOT EXISTS `notify_templates_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify_template_id` int(10) unsigned NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notify_templates_translations_notify_template_id_foreign` (`notify_template_id`),
  CONSTRAINT `notify_templates_translations_notify_template_id_foreign` FOREIGN KEY (`notify_template_id`) REFERENCES `notify_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.notify_templates_translations: ~6 rows (approximately)
DELETE FROM `notify_templates_translations`;
/*!40000 ALTER TABLE `notify_templates_translations` DISABLE KEYS */;
INSERT INTO `notify_templates_translations` (`id`, `title`, `description`, `notify_template_id`, `locale`) VALUES
	(1, 'تم الموافقة ع الطلب', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 1, 'ar'),
	(2, 'Order Approved', 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}', 1, 'en'),
	(3, 'تم رفض الطلب', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 2, 'ar'),
	(4, 'order Refused', 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}', 2, 'en'),
	(5, 'جاري مراجعة طلبك', 'مساعدة: لكتابة اسم المستخدم {userFirstName} {userLastName} لكتابة اسم الموقع {siteName} لكتابة اوردر {order}', 3, 'ar'),
	(6, 'Your order is being reviewed', 'help : to write username {userFirstName} {userLastName} to write site name {siteName} to write order {order}', 3, 'en');
/*!40000 ALTER TABLE `notify_templates_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.online_payment
CREATE TABLE IF NOT EXISTS `online_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.online_payment: ~0 rows (approximately)
DELETE FROM `online_payment`;
/*!40000 ALTER TABLE `online_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `online_payment` ENABLE KEYS */;

-- Dumping structure for table ashhrny.open_ticket
CREATE TABLE IF NOT EXISTS `open_ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.open_ticket: ~4 rows (approximately)
DELETE FROM `open_ticket`;
/*!40000 ALTER TABLE `open_ticket` DISABLE KEYS */;
INSERT INTO `open_ticket` (`id`, `created_at`, `updated_at`) VALUES
	(1, '2020-01-29 23:42:14', '2020-01-29 23:42:14'),
	(2, '2020-01-29 23:54:05', '2020-01-29 23:54:05'),
	(3, '2020-01-29 23:55:09', '2020-01-29 23:55:09'),
	(4, '2020-01-29 23:57:46', '2020-01-29 23:57:46');
/*!40000 ALTER TABLE `open_ticket` ENABLE KEYS */;

-- Dumping structure for table ashhrny.open_ticket_translations
CREATE TABLE IF NOT EXISTS `open_ticket_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `open_ticket_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `open_ticket_translations_open_ticket_id_foreign` (`open_ticket_id`),
  CONSTRAINT `open_ticket_translations_open_ticket_id_foreign` FOREIGN KEY (`open_ticket_id`) REFERENCES `open_ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.open_ticket_translations: ~6 rows (approximately)
DELETE FROM `open_ticket_translations`;
/*!40000 ALTER TABLE `open_ticket_translations` DISABLE KEYS */;
INSERT INTO `open_ticket_translations` (`id`, `open_ticket_id`, `title`, `description`, `locale`) VALUES
	(3, 2, 'الحسابات و المبيعات', 'لاستفسارات ما قبل الشراء و ما يتعلّق بفواتير وحسابات العملاء .', 'ar'),
	(4, 2, 'Accounts and sales', 'For pre-purchase inquiries and customer invoices and accounts.', 'en'),
	(5, 3, 'تأكيد الدفع', 'لتأكيد عمليات دفع فواتير تجديد الخدمات، وفواتير الطلبات الجديدة حتّى يتمكن فريق العمل من تفعيل الطلبات .', 'ar'),
	(6, 3, 'Confirm the payment', 'To confirm payments for service renewal bills and new order bills so that the team can activate orders.', 'en'),
	(7, 4, 'الشكاوى و الإقتراحات', 'سنكون دائمًا في انتظار تواصلكم معنا، مرحبين بأي اقتراحات لتحسين مستوى الخدمة، ومتلقّين كافة الشكاوى بعين الإعتبار.', 'ar'),
	(8, 4, 'Complaints and suggestions', 'We will always be waiting for your communication with us, welcome any suggestions to improve the level of service, and receive all complaints in consideration.', 'en');
/*!40000 ALTER TABLE `open_ticket_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `orderNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('wait','refused','accepted','shipped','complete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'wait',
  `total` double NOT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.orders: ~3 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `orderNumber`, `status`, `total`, `email_status`, `created_at`, `updated_at`) VALUES
	(7, 5, '2', 'wait', 54, 0, '2020-02-11 04:34:42', '2020-02-11 04:34:42'),
	(8, 5, '3', 'wait', 54, 0, '2020-02-16 23:29:54', '2020-02-16 23:29:54'),
	(9, 21, '4', 'wait', 18, 0, '2020-02-24 07:34:08', '2020-02-24 07:34:08');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table ashhrny.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.order_items: ~0 rows (approximately)
DELETE FROM `order_items`;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- Dumping structure for table ashhrny.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.password_resets: ~4 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('nabad.ksa@gmail.com', '$2y$10$9PqJpoXKrLH4Md8iWEMWUe1Ycg9qhzUopNCnALEiEtxh.G8/bbaAu', '2020-02-04 00:03:41'),
	('nabad.ksa@gmail.com', '1368ffe459a2d555590ce254844d76d6e608fcc104321ae209be1f5ff1d1f457', '2020-02-04 00:03:41'),
	('nadynaltwkhy60@gmail.com', '$2y$10$0zoq21uak/EiH.UPBeoybu4PG3xL3SLQSY93H8c.0OpuOre9bxqgq', '2020-02-11 03:01:58'),
	('nadynaltwkhy60@gmail.com', '7bd1c45d45348464c7a5cc39b72fc64615d4ee8a394811351921fb6c90e6ade6', '2020-02-11 03:01:58');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table ashhrny.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.permissions: ~83 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `desc`, `created_at`, `updated_at`) VALUES
	(1, 'Permission-Add', 'admin', 'إضافة صلاحية', '2020-01-28 23:34:06', '2020-01-28 23:34:06'),
	(2, 'Permission-Edit', 'admin', 'تعديل صلاحية', '2020-01-28 23:34:07', '2020-01-28 23:34:07'),
	(3, 'Permission-Delete', 'admin', 'حذف صلاحية', '2020-01-28 23:34:07', '2020-01-28 23:34:07'),
	(4, 'Role-Add', 'admin', 'اضافه مجموعه مستخدمين', '2020-01-28 23:34:08', '2020-01-28 23:34:08'),
	(5, 'Role-Edit', 'admin', 'تعديل مجموعه مستخدمين', '2020-01-28 23:34:08', '2020-01-28 23:34:08'),
	(6, 'Role-Delete', 'admin', 'حذف مجموعه مستخدمين', '2020-01-28 23:34:09', '2020-01-28 23:34:09'),
	(7, 'Show-Adminpanel', 'admin', 'عرض لوحة التحكم', '2020-01-28 23:34:10', '2020-01-28 23:34:10'),
	(8, 'AdminUser-Add', 'admin', 'اضافه ادمن', '2020-01-28 23:34:10', '2020-01-28 23:34:10'),
	(9, 'AdminUser-Edit', 'admin', 'تعديل ادمن', '2020-01-28 23:34:10', '2020-01-28 23:34:10'),
	(10, 'AdminUser-Delete', 'admin', 'حذف ادمن', '2020-01-28 23:34:10', '2020-01-28 23:34:10'),
	(11, 'FrontUser-Create', 'admin', 'اضافه مستخدم', '2020-01-28 23:34:10', '2020-01-28 23:34:10'),
	(12, 'FrontUser-Edit', 'admin', 'تعديل مستخدم', '2020-01-28 23:34:11', '2020-01-28 23:34:11'),
	(13, 'FrontUser-Delete', 'admin', 'حذف مستخدم', '2020-01-28 23:34:11', '2020-01-28 23:34:11'),
	(14, 'NewsLetter-Add', 'admin', 'إضافة مستخدم للنشرة الإخبارية', '2020-01-28 23:34:12', '2020-01-28 23:34:12'),
	(15, 'SiteSetting-Add', 'admin', 'إضافة إعدادات الموقع', '2020-01-28 23:34:13', '2020-01-28 23:34:13'),
	(16, 'SiteLanguage-Add', 'admin', 'إضافة لغة للموقع', '2020-01-28 23:34:14', '2020-01-28 23:34:14'),
	(17, 'SiteLanguage-Edit', 'admin', 'تعديل لغة للموقع', '2020-01-28 23:34:15', '2020-01-28 23:34:15'),
	(18, 'SiteLanguage-Delete', 'admin', 'حذف لغة للموقع', '2020-01-28 23:34:16', '2020-01-28 23:34:16'),
	(19, 'Country-Add', 'admin', 'إضافة دولة', '2020-01-28 23:34:18', '2020-01-28 23:34:18'),
	(20, 'Country-Edit', 'admin', 'تعديل دولة', '2020-01-28 23:34:18', '2020-01-28 23:34:18'),
	(21, 'Country-Delete', 'admin', 'حذف دولة', '2020-01-28 23:34:21', '2020-01-28 23:34:21'),
	(22, 'City-Add', 'admin', 'إضافة مدينة', '2020-01-28 23:34:22', '2020-01-28 23:34:22'),
	(23, 'City-Edit', 'admin', 'تعديل مدينة', '2020-01-28 23:34:23', '2020-01-28 23:34:23'),
	(24, 'City-Delete', 'admin', 'حذف مدينة', '2020-01-28 23:34:23', '2020-01-28 23:34:23'),
	(25, 'Currency-Add', 'admin', 'إضافة عملة', '2020-01-28 23:34:23', '2020-01-28 23:34:23'),
	(26, 'Currency-Edit', 'admin', 'تعديل عملة', '2020-01-28 23:34:23', '2020-01-28 23:34:23'),
	(27, 'Currency-Delete', 'admin', 'حذف عملة', '2020-01-28 23:34:24', '2020-01-28 23:34:24'),
	(31, 'Slider-Add', 'admin', 'إضافة سليدر', '2020-01-28 23:34:24', '2020-01-28 23:34:24'),
	(32, 'Slider-Edit', 'admin', 'تعديل سليدر', '2020-01-28 23:34:24', '2020-01-28 23:34:24'),
	(33, 'Slider-Delete', 'admin', 'حذف سليدر', '2020-01-28 23:34:24', '2020-01-28 23:34:24'),
	(34, 'Tag-Add', 'admin', 'إضافة تاج', '2020-01-28 23:34:24', '2020-01-28 23:34:24'),
	(35, 'Tag-Edit', 'admin', 'تعديل تاج', '2020-01-28 23:34:25', '2020-01-28 23:34:25'),
	(36, 'Tag-Delete', 'admin', 'حذف تاج', '2020-01-28 23:34:25', '2020-01-28 23:34:25'),
	(37, 'BlogCategory-Add', 'admin', 'إضافة قسم للمدونة', '2020-01-28 23:34:25', '2020-01-28 23:34:25'),
	(38, 'BlogCategory-Edit', 'admin', 'تعديل قسم للمدونة', '2020-01-28 23:34:25', '2020-01-28 23:34:25'),
	(39, 'BlogCategory-Delete', 'admin', 'حذف قسم للمدونة', '2020-01-28 23:34:25', '2020-01-28 23:34:25'),
	(40, 'Blog-Add', 'admin', 'إضافة مدونة', '2020-01-28 23:34:26', '2020-01-28 23:34:26'),
	(41, 'Blog-Edit', 'admin', 'تعديل مدونة', '2020-01-28 23:34:26', '2020-01-28 23:34:26'),
	(42, 'Blog-Delete', 'admin', 'حذف مدونة', '2020-01-28 23:34:26', '2020-01-28 23:34:26'),
	(43, 'Payment-Add', 'admin', 'إضافة وسيلة دفع', '2020-01-28 23:34:26', '2020-01-28 23:34:26'),
	(44, 'Payment-Edit', 'admin', 'تعديل وسيلة دفع', '2020-01-28 23:34:27', '2020-01-28 23:34:27'),
	(45, 'Payment-Delete', 'admin', 'حذف وسيلة دفع', '2020-01-28 23:34:27', '2020-01-28 23:34:27'),
	(46, 'Order-Show', 'admin', 'عرض اوردر', '2020-01-28 23:34:27', '2020-01-28 23:34:27'),
	(47, 'Order-Delete', 'admin', 'حذف اوردر', '2020-01-28 23:34:27', '2020-01-28 23:34:27'),
	(48, 'Report-Show', 'admin', 'عرض التقرير', '2020-01-28 23:34:28', '2020-01-28 23:34:28'),
	(49, 'Bank-Add', 'admin', 'إضافة بنك', '2020-01-28 23:34:28', '2020-01-28 23:34:28'),
	(50, 'Bank-Edit', 'admin', 'تعديل بنك', '2020-01-28 23:34:28', '2020-01-28 23:34:28'),
	(51, 'Bank-Delete', 'admin', 'حذف بنك', '2020-01-28 23:34:28', '2020-01-28 23:34:28'),
	(52, 'Online-Payment', 'admin', 'الدفع الالكتروني', '2020-01-28 23:34:29', '2020-01-28 23:34:29'),
	(53, 'ContentType-Add', 'admin', 'إضافة نوع محتوي', '2020-01-28 23:34:29', '2020-01-28 23:34:29'),
	(54, 'ContentType-Edit', 'admin', 'تعديل نوع محتوي', '2020-01-28 23:34:29', '2020-01-28 23:34:29'),
	(55, 'ContentType-Delete', 'admin', 'حذف نوع محتوي', '2020-01-28 23:34:29', '2020-01-28 23:34:29'),
	(56, 'SocialLink-Add', 'admin', 'إضافة وسيلة إجتماعية', '2020-01-28 23:34:30', '2020-01-28 23:34:30'),
	(57, 'SocialLink-Edit', 'admin', 'تعديل وسيلة إجتماعية', '2020-01-28 23:34:30', '2020-01-28 23:34:30'),
	(58, 'SocialLink-Delete', 'admin', 'حذف وسيلة إجتماعية', '2020-01-28 23:34:30', '2020-01-28 23:34:30'),
	(59, 'Point-Add', 'admin', 'إضافة نقاط', '2020-01-28 23:34:30', '2020-01-28 23:34:30'),
	(60, 'Point-Edit', 'admin', 'تعديل نقاط', '2020-01-28 23:34:30', '2020-01-28 23:34:30'),
	(61, 'Point-Delete', 'admin', 'حذف نقاط', '2020-01-28 23:34:30', '2020-01-28 23:34:30'),
	(62, 'Slider-Add', 'admin', 'إضافة سلايدر', '2020-01-28 23:34:31', '2020-01-28 23:34:31'),
	(63, 'Slider-Edit', 'admin', 'تعديل سلايدر', '2020-01-28 23:34:31', '2020-01-28 23:34:31'),
	(64, 'Slider-Delete', 'admin', 'حذف سلايدر', '2020-01-28 23:34:31', '2020-01-28 23:34:31'),
	(65, 'Banner-Add', 'admin', 'إضافة بانر', '2020-01-28 23:34:31', '2020-01-28 23:34:31'),
	(66, 'Banner-Edit', 'admin', 'تعديل بانر', '2020-01-28 23:34:31', '2020-01-28 23:34:31'),
	(67, 'Banner-Delete', 'admin', 'حذف بانر', '2020-01-28 23:34:31', '2020-01-28 23:34:31'),
	(68, 'FeaturedAd-Add', 'admin', 'إضافة اعلان مميز', '2020-01-28 23:34:31', '2020-01-28 23:34:31'),
	(69, 'FeaturedAd-Edit', 'admin', 'تعديل اعلان مميز', '2020-01-28 23:34:32', '2020-01-28 23:34:32'),
	(70, 'FeaturedAd-Delete', 'admin', 'حذف اعلان مميز', '2020-01-28 23:34:32', '2020-01-28 23:34:32'),
	(72, 'FeaturedUser-Show', 'admin', 'عرض الأعضاء المميزة', '2020-01-28 23:34:32', '2020-01-28 23:34:32'),
	(73, 'FeaturedUser-Delete', 'admin', 'حذف عضو مميز', '2020-01-28 23:34:32', '2020-01-28 23:34:32'),
	(74, 'SocialAdvert-Add', 'admin', 'إضافة اعلان سوشيال', '2020-01-28 23:34:32', '2020-01-28 23:34:32'),
	(75, 'SocialAdvert-Edit', 'admin', 'تعديل اعلان سوشيال', '2020-01-28 23:34:33', '2020-01-28 23:34:33'),
	(76, 'SocialAdvert-Delete', 'admin', 'حذف اعلان سوشيال', '2020-01-28 23:34:33', '2020-01-28 23:34:33'),
	(77, 'RatingLevel-Add', 'admin', 'إضافة مستوي للتقييم', '2020-01-28 23:34:33', '2020-01-28 23:34:33'),
	(78, 'RatingLevel-Edit', 'admin', 'تعديل مستوي للتقييم', '2020-01-28 23:34:33', '2020-01-28 23:34:33'),
	(79, 'RatingLevel-Delete', 'admin', 'حذف مستوي للتقييم', '2020-01-28 23:34:33', '2020-01-28 23:34:33'),
	(80, 'Footer-Add', 'admin', 'إضافة فوتر', '2020-01-28 23:34:33', '2020-01-28 23:34:33'),
	(81, 'Footer-Edit', 'admin', 'تعديل فوتر', '2020-01-28 23:34:33', '2020-01-28 23:34:33'),
	(82, 'Footer-Delete', 'admin', 'حذف فوتر', '2020-01-28 23:34:34', '2020-01-28 23:34:34'),
	(83, 'UserSetting-Add', 'admin', 'اعدادات المستخدمين', '2020-01-28 23:34:34', '2020-01-28 23:34:34'),
	(84, 'Contacts-Show', 'admin', 'الرسائل', '2020-01-28 23:34:34', '2020-01-28 23:34:34'),
	(85, 'NotifySetup-Add', 'admin', 'اعدادات الاشعارات', '2020-01-28 23:34:34', '2020-01-28 23:34:34'),
	(86, 'EmailSetup-Edit', 'admin', 'اعدادات الايميل', '2020-01-28 23:34:34', '2020-01-28 23:34:34'),
	(87, 'NotifySetup-Edit', 'admin', 'اعدادات الاشعارات', '2020-01-28 23:34:34', '2020-01-28 23:34:34');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table ashhrny.phones
CREATE TABLE IF NOT EXISTS `phones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneable_id` int(10) unsigned DEFAULT NULL,
  `phoneable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.phones: ~1 rows (approximately)
DELETE FROM `phones`;
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
INSERT INTO `phones` (`id`, `created_at`, `updated_at`, `phone`, `phoneable_id`, `phoneable_type`) VALUES
	(8, '2020-02-24 05:30:55', '2020-02-24 05:30:55', '123456789', 1, 'App\\Models\\Setting');
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;

-- Dumping structure for table ashhrny.points
CREATE TABLE IF NOT EXISTS `points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `points_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.points: ~5 rows (approximately)
DELETE FROM `points`;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
INSERT INTO `points` (`id`, `points_number`, `code`, `created_at`, `updated_at`) VALUES
	(1, '20', 'reg', NULL, NULL),
	(2, '50', 'famous', NULL, NULL),
	(3, '30', 'ourAccounts', NULL, NULL),
	(4, '40', 'website', NULL, NULL),
	(5, '10', 'addAccount', NULL, NULL);
/*!40000 ALTER TABLE `points` ENABLE KEYS */;

-- Dumping structure for table ashhrny.points_translations
CREATE TABLE IF NOT EXISTS `points_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `point_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `points_translations_point_id_foreign` (`point_id`),
  CONSTRAINT `points_translations_point_id_foreign` FOREIGN KEY (`point_id`) REFERENCES `points` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.points_translations: ~10 rows (approximately)
DELETE FROM `points_translations`;
/*!40000 ALTER TABLE `points_translations` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `points_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.point_user
CREATE TABLE IF NOT EXISTS `point_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `point_id` int(10) unsigned DEFAULT NULL,
  `point` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `point_user_user_id_foreign` (`user_id`),
  KEY `point_user_point_id_foreign` (`point_id`),
  CONSTRAINT `point_user_point_id_foreign` FOREIGN KEY (`point_id`) REFERENCES `points` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `point_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.point_user: ~14 rows (approximately)
DELETE FROM `point_user`;
/*!40000 ALTER TABLE `point_user` DISABLE KEYS */;
INSERT INTO `point_user` (`id`, `user_id`, `point_id`, `point`, `code`, `created_at`, `updated_at`) VALUES
	(1, 5, 1, '20', 'reg', '2020-01-29 06:51:29', '2020-01-29 06:51:29'),
	(2, 6, 1, '20', 'reg', '2020-01-29 08:37:52', '2020-01-29 08:37:52'),
	(4, 6, 5, '10', 'addAccount', '2020-01-29 08:42:21', '2020-01-29 08:42:21'),
	(7, 7, 1, '20', 'reg', '2020-02-02 01:36:10', '2020-02-02 01:36:10'),
	(8, 7, 5, '10', 'addAccount', '2020-02-02 01:37:33', '2020-02-02 01:37:33'),
	(14, 10, 1, '20', 'reg', '2020-02-05 04:58:07', '2020-02-05 04:58:07'),
	(15, 10, 5, '10', 'addAccount', '2020-02-05 05:36:50', '2020-02-05 05:36:50'),
	(21, 5, 5, '10', 'addAccount', '2020-02-11 03:34:59', '2020-02-11 03:34:59'),
	(22, 5, 5, '10', 'addAccount', '2020-02-11 03:34:59', '2020-02-11 03:34:59'),
	(26, 5, 2, '50', 'famous', '2020-02-11 04:34:42', '2020-02-11 04:34:42'),
	(27, 5, 2, '50', 'famous', '2020-02-16 23:29:54', '2020-02-16 23:29:54'),
	(28, 21, 1, '20', 'reg', '2020-02-24 06:13:27', '2020-02-24 06:13:27'),
	(29, 21, 5, '10', 'addAccount', '2020-02-24 06:14:40', '2020-02-24 06:14:40'),
	(30, 21, 4, '40', 'website', '2020-02-24 07:34:08', '2020-02-24 07:34:08');
/*!40000 ALTER TABLE `point_user` ENABLE KEYS */;

-- Dumping structure for table ashhrny.priorities
CREATE TABLE IF NOT EXISTS `priorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.priorities: ~2 rows (approximately)
DELETE FROM `priorities`;
/*!40000 ALTER TABLE `priorities` DISABLE KEYS */;
INSERT INTO `priorities` (`id`, `created_at`, `updated_at`) VALUES
	(1, '2020-01-30 02:05:51', '2020-01-30 02:05:51'),
	(2, '2020-01-30 02:06:12', '2020-01-30 02:06:12');
/*!40000 ALTER TABLE `priorities` ENABLE KEYS */;

-- Dumping structure for table ashhrny.priorities_translations
CREATE TABLE IF NOT EXISTS `priorities_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `priority_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `priorities_translations_priority_id_foreign` (`priority_id`),
  CONSTRAINT `priorities_translations_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.priorities_translations: ~4 rows (approximately)
DELETE FROM `priorities_translations`;
/*!40000 ALTER TABLE `priorities_translations` DISABLE KEYS */;
INSERT INTO `priorities_translations` (`id`, `priority_id`, `title`, `locale`) VALUES
	(1, 1, 'متوسط', 'ar'),
	(2, 1, 'medium', 'en'),
	(3, 2, 'عالي', 'ar'),
	(4, 2, 'high', 'en');
/*!40000 ALTER TABLE `priorities_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.ratings: ~0 rows (approximately)
DELETE FROM `ratings`;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` (`id`, `created_at`, `updated_at`) VALUES
	(1, '2020-01-28 23:46:32', '2020-01-28 23:46:32');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;

-- Dumping structure for table ashhrny.ratings_translations
CREATE TABLE IF NOT EXISTS `ratings_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rating_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_translations_rating_id_foreign` (`rating_id`),
  CONSTRAINT `ratings_translations_rating_id_foreign` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.ratings_translations: ~2 rows (approximately)
DELETE FROM `ratings_translations`;
/*!40000 ALTER TABLE `ratings_translations` DISABLE KEYS */;
INSERT INTO `ratings_translations` (`id`, `rating_id`, `title`, `locale`, `created_at`, `updated_at`) VALUES
	(1, 1, 'جيد', 'ar', '2020-01-28 23:46:32', '2020-01-28 23:46:32'),
	(2, 1, 'good', 'en', '2020-01-28 23:46:32', '2020-01-28 23:46:32');
/*!40000 ALTER TABLE `ratings_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.rating_user
CREATE TABLE IF NOT EXISTS `rating_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `rating_id` int(10) unsigned DEFAULT NULL,
  `social_advertisement_id` int(10) unsigned DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rating_user_user_id_foreign` (`user_id`),
  KEY `rating_user_rating_id_foreign` (`rating_id`),
  KEY `rating_user_social_advertisement_id_foreign` (`social_advertisement_id`),
  CONSTRAINT `rating_user_rating_id_foreign` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_user_social_advertisement_id_foreign` FOREIGN KEY (`social_advertisement_id`) REFERENCES `social_advertisement_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.rating_user: ~0 rows (approximately)
DELETE FROM `rating_user`;
/*!40000 ALTER TABLE `rating_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `rating_user` ENABLE KEYS */;

-- Dumping structure for table ashhrny.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.roles: ~2 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super-admin', 'admin', '2020-01-28 23:34:07', '2020-01-28 23:34:07'),
	(2, 'registered-users', 'web', '2020-01-28 23:34:35', '2020-01-28 23:34:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table ashhrny.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.role_has_permissions: ~80 rows (approximately)
DELETE FROM `role_has_permissions`;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table ashhrny.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.settings: ~0 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `email`, `report_email`, `logo`, `alt_logo`, `footer_logo`, `alt_footer_logo`) VALUES
	(1, '2020-01-28 23:42:43', '2020-02-24 05:30:55', 'support@ashhrni.com', 'test@ashhrni.com', '/uploads/setting/1/LQKu5gc0zrcU9Fu1FfO5s7em9UfBPvyGgZ7GGmKx.png', 'ashhrny', '/uploads/setting/1/LM7zE7ud21O6APcwrMLV0zQA8P4ve0v9FfRhZhXN.png', 'ashhrny');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table ashhrny.settings_translations
CREATE TABLE IF NOT EXISTS `settings_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.settings_translations: ~2 rows (approximately)
DELETE FROM `settings_translations`;
/*!40000 ALTER TABLE `settings_translations` DISABLE KEYS */;
INSERT INTO `settings_translations` (`id`, `setting_id`, `title`, `address`, `meta_title`, `meta_description`, `meta_keywords`, `locale`) VALUES
	(1, 1, 'اشهرني', 'السعودية', NULL, NULL, NULL, 'ar'),
	(2, 1, 'Ashhrny', 'Saudi Arabia', NULL, NULL, NULL, 'en');
/*!40000 ALTER TABLE `settings_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.site_languages
CREATE TABLE IF NOT EXISTS `site_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.site_languages: ~2 rows (approximately)
DELETE FROM `site_languages`;
/*!40000 ALTER TABLE `site_languages` DISABLE KEYS */;
INSERT INTO `site_languages` (`id`, `created_at`, `updated_at`, `title`, `flag`, `locale`) VALUES
	(1, '2020-01-28 23:41:26', '2020-01-28 23:41:26', 'Arabic', '/uploads/site_languages/1/1580283686.png', 'ar'),
	(2, '2020-01-28 23:41:44', '2020-01-28 23:41:44', 'English', '/uploads/site_languages/2/1580283704.jpg', 'en');
/*!40000 ALTER TABLE `site_languages` ENABLE KEYS */;

-- Dumping structure for table ashhrny.sliders
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `alt_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sliders_user_id_foreign` (`user_id`),
  CONSTRAINT `sliders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.sliders: ~0 rows (approximately)
DELETE FROM `sliders`;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` (`id`, `user_id`, `sort`, `alt_image`, `publish`, `created_at`, `updated_at`) VALUES
	(1, 10, 1, NULL, 1, '2020-02-11 04:45:42', '2020-02-20 06:32:44');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping structure for table ashhrny.sliders_translations
CREATE TABLE IF NOT EXISTS `sliders_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sliders_translations_slider_id_foreign` (`slider_id`),
  CONSTRAINT `sliders_translations_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.sliders_translations: ~2 rows (approximately)
DELETE FROM `sliders_translations`;
/*!40000 ALTER TABLE `sliders_translations` DISABLE KEYS */;
INSERT INTO `sliders_translations` (`id`, `slider_id`, `title`, `locale`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 'ar', '2020-02-11 04:45:42', '2020-02-11 04:45:42'),
	(2, 1, NULL, 'en', '2020-02-11 04:45:42', '2020-02-11 04:45:42');
/*!40000 ALTER TABLE `sliders_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.slider_user
CREATE TABLE IF NOT EXISTS `slider_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.slider_user: ~0 rows (approximately)
DELETE FROM `slider_user`;
/*!40000 ALTER TABLE `slider_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `slider_user` ENABLE KEYS */;

-- Dumping structure for table ashhrny.social_advertisement
CREATE TABLE IF NOT EXISTS `social_advertisement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('website','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.social_advertisement: ~2 rows (approximately)
DELETE FROM `social_advertisement`;
/*!40000 ALTER TABLE `social_advertisement` DISABLE KEYS */;
INSERT INTO `social_advertisement` (`id`, `type`, `price`, `created_at`, `updated_at`) VALUES
	(1, 'website', 2.00, '2020-01-28 23:47:30', '2020-01-28 23:47:30'),
	(2, 'user', 3.00, '2020-01-28 23:47:35', '2020-01-28 23:47:35');
/*!40000 ALTER TABLE `social_advertisement` ENABLE KEYS */;

-- Dumping structure for table ashhrny.social_advertisement_user
CREATE TABLE IF NOT EXISTS `social_advertisement_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderNumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `social_link_id` int(10) unsigned DEFAULT NULL,
  `famous_id` int(10) unsigned DEFAULT NULL,
  `account_type_id` int(10) unsigned DEFAULT NULL,
  `advert_type` enum('website','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `price` decimal(8,2) DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `from` datetime DEFAULT NULL,
  `to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_advertisement_user_user_id_foreign` (`user_id`),
  KEY `social_advertisement_user_famous_id_foreign` (`famous_id`),
  KEY `social_advertisement_user_social_link_id_foreign` (`social_link_id`),
  CONSTRAINT `social_advertisement_user_famous_id_foreign` FOREIGN KEY (`famous_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `social_advertisement_user_social_link_id_foreign` FOREIGN KEY (`social_link_id`) REFERENCES `social_link_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `social_advertisement_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.social_advertisement_user: ~3 rows (approximately)
DELETE FROM `social_advertisement_user`;
/*!40000 ALTER TABLE `social_advertisement_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_advertisement_user` ENABLE KEYS */;

-- Dumping structure for table ashhrny.social_links
CREATE TABLE IF NOT EXISTS `social_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.social_links: ~2 rows (approximately)
DELETE FROM `social_links`;
/*!40000 ALTER TABLE `social_links` DISABLE KEYS */;
INSERT INTO `social_links` (`id`, `icon`, `created_at`, `updated_at`) VALUES
	(1, 'fa-facebook', '2020-01-28 23:46:17', '2020-01-28 23:46:17'),
	(2, 'fa-snapchat', '2020-02-05 05:44:39', '2020-02-05 05:44:39');
/*!40000 ALTER TABLE `social_links` ENABLE KEYS */;

-- Dumping structure for table ashhrny.social_links_translations
CREATE TABLE IF NOT EXISTS `social_links_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` int(10) unsigned DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_links_translations_social_id_foreign` (`social_id`),
  CONSTRAINT `social_links_translations_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.social_links_translations: ~4 rows (approximately)
DELETE FROM `social_links_translations`;
/*!40000 ALTER TABLE `social_links_translations` DISABLE KEYS */;
INSERT INTO `social_links_translations` (`id`, `title`, `social_id`, `locale`, `created_at`, `updated_at`) VALUES
	(1, 'فيسبوك', 1, 'ar', '2020-01-28 23:46:17', '2020-01-28 23:46:17'),
	(2, 'facebook', 1, 'en', '2020-01-28 23:46:17', '2020-01-28 23:46:18'),
	(3, 'سناب شات', 2, 'ar', '2020-02-05 05:44:39', '2020-02-05 05:44:39'),
	(4, 'snapchat', 2, 'en', '2020-02-05 05:44:39', '2020-02-05 05:44:39');
/*!40000 ALTER TABLE `social_links_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.social_link_setting
CREATE TABLE IF NOT EXISTS `social_link_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.social_link_setting: ~4 rows (approximately)
DELETE FROM `social_link_setting`;
/*!40000 ALTER TABLE `social_link_setting` DISABLE KEYS */;
INSERT INTO `social_link_setting` (`id`, `title`, `url`, `icon`, `setting_id`, `created_at`, `updated_at`) VALUES
	(29, 'facebook', 'www.facebook.com', 'fa-facebook', 1, '2020-02-24 05:30:55', '2020-02-24 05:30:55'),
	(30, 'Instagram', 'www.instagram.com', 'fa-instagram', 1, '2020-02-24 05:30:55', '2020-02-24 05:30:55'),
	(31, 'Twitter', 'http://twitter.com', 'fa-twitter', 1, '2020-02-24 05:30:55', '2020-02-24 05:30:55'),
	(32, 'Youtube', 'www.youtube.com', 'fa-youtube', 1, '2020-02-24 05:30:55', '2020-02-24 05:30:55');
/*!40000 ALTER TABLE `social_link_setting` ENABLE KEYS */;

-- Dumping structure for table ashhrny.social_link_user
CREATE TABLE IF NOT EXISTS `social_link_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `social_id` int(10) unsigned DEFAULT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_link_user_user_id_foreign` (`user_id`),
  KEY `social_link_user_social_id_foreign` (`social_id`),
  CONSTRAINT `social_link_user_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `social_link_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.social_link_user: ~7 rows (approximately)
DELETE FROM `social_link_user`;
/*!40000 ALTER TABLE `social_link_user` DISABLE KEYS */;
INSERT INTO `social_link_user` (`id`, `user_id`, `social_id`, `url`, `content`, `default`, `created_at`, `updated_at`) VALUES
	(2, 6, 1, 'https://m.facebook.com/ashhrni?fref=nf&ref=wizard', 'اجتماعي', NULL, '2020-01-29 08:42:21', '2020-01-29 08:42:21'),
	(3, 7, 1, 'www.ashhrni.com', 'صصصصص', NULL, '2020-02-02 01:37:33', '2020-02-02 01:37:33'),
	(5, 10, 1, 'https://www.facebook.com/', 'فيسبوك', 1, '2020-02-05 05:36:50', '2020-02-05 06:36:42'),
	(11, 5, 1, 'https://www.facebook.com/profile.php?id=100043752016772', 'تجاري', NULL, '2020-02-11 03:34:59', '2020-02-11 03:34:59'),
	(12, 5, 2, 'https://www.facebook.com/profile.php?id=100043752016772', 'تجاري', NULL, '2020-02-11 03:34:59', '2020-02-11 03:34:59'),
	(14, 21, 1, 'http://www.facebook.com/', 'شخصي', 1, '2020-02-24 06:14:40', '2020-02-24 06:22:08');
/*!40000 ALTER TABLE `social_link_user` ENABLE KEYS */;

-- Dumping structure for table ashhrny.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.tags: ~0 rows (approximately)
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Dumping structure for table ashhrny.tag_translations
CREATE TABLE IF NOT EXISTS `tag_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_translations_tag_id_foreign` (`tag_id`),
  CONSTRAINT `tag_translations_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.tag_translations: ~0 rows (approximately)
DELETE FROM `tag_translations`;
/*!40000 ALTER TABLE `tag_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_translations` ENABLE KEYS */;

-- Dumping structure for table ashhrny.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','paid','refused') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_order_id_foreign` (`order_id`),
  KEY `transactions_bank_id_foreign` (`bank_id`),
  CONSTRAINT `transactions_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.transactions: ~3 rows (approximately)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `order_id`, `payment_type`, `status`, `bank_id`, `bank_transactions_num`, `total`, `image`, `currency`, `discount_code`, `holder_name`, `holder_card_number`, `holder_cvc`, `holder_expire`, `created_at`, `updated_at`) VALUES
	(2, 7, 'bank', 'pending', 1, 'er5ferewss', NULL, '/uploads/payment/158142448248646.gif', NULL, NULL, 't54rerwe', NULL, NULL, NULL, '2020-02-11 04:34:42', '2020-02-11 04:34:42'),
	(3, 8, 'bank', 'pending', 1, 'er5ferewss', NULL, '/uploads/payment/158192459449354.jpg', NULL, NULL, 't54rerwe', NULL, NULL, NULL, '2020-02-16 23:29:54', '2020-02-16 23:29:54'),
	(4, 9, 'bank', 'pending', 1, '15484', NULL, '/uploads/payment/158252244872396.png', NULL, NULL, 'test', NULL, NULL, NULL, '2020-02-24 07:34:08', '2020-02-24 07:34:08');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table ashhrny.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membership_number` int(11) unsigned zerofill NOT NULL,
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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `send_email` tinyint(1) NOT NULL DEFAULT '0',
  `send_sms` tinyint(1) NOT NULL DEFAULT '0',
  `identify_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identify_image` mediumtext COLLATE utf8mb4_unicode_ci,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_country_id_foreign` (`country_id`),
  KEY `users_city_id_foreign` (`city_id`),
  CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.users: ~16 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `membership_number`, `first_name`, `last_name`, `email`, `email_verified_at`, `image`, `alt_image`, `guard`, `user_type`, `gender`, `job_type`, `status`, `send_email`, `send_sms`, `identify_number`, `identify_image`, `mobile`, `password`, `country_id`, `city_id`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 00000000000, 'admin', 'admin', 'admin@admin.com', NULL, NULL, NULL, 'admin', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC', NULL, NULL, NULL, NULL, 'itl5T9Uc8GEqO4ViDrSEWAV9j750OBk9MTScs6JBNH0dzOnkY3rIV40fiLgm', '2020-01-28 23:34:07', '2020-01-28 23:34:07'),
	(2, 00000000001, 'shaza', 'ahmed', 'shazaahmed266@yahoo.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$k.bzg6oU4SD.5LdHU0RJkeccaH7VRcB5B1BROmMebsA4o3LYVFNiK', NULL, NULL, NULL, NULL, NULL, '2020-01-29 03:22:54', '2020-01-29 03:22:54'),
	(4, 00000000001, 'shaza', 'tarek', 'shaza7688@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$Q8JI4mi3U00yMu5MNxG9dODk84j30V7hyvoY9hKnWuSGlw6qHDg5K', NULL, NULL, NULL, NULL, NULL, '2020-01-29 06:40:09', '2020-01-29 06:40:09'),
	(5, 00000000001, 'nadyn', 'eltawkhy', 'nadynaltwkhy60@gmail.com', '2020-01-29 06:46:51', '/uploads/profiles/5/P37c2EStNxLCQyGIB7n5e2ORMBatKzj0YOTv9swY.gif', 'nadyneltawkhy', 'web', 'normal', 'female', NULL, 1, 1, 0, NULL, NULL, '01212020076', '$2y$10$EfJRcuLfZ/B3GrWj3j2oWelDA5WLK1DiqGFY1ChuP7gtGTudFKdPG', 1, NULL, NULL, NULL, NULL, '2020-01-29 06:42:45', '2020-02-11 03:32:06'),
	(6, 00000000002, 'تركي', 'الغامدي', 'tr0k7733@gmail.com', '2020-01-29 08:34:57', '/uploads/profiles/6/lHpGDu8Fe6wCQm5n5kAozPGC7gmDv2nzxcX5z2CA.png', 'تركيالغامدي', 'web', 'normal', 'male', NULL, 1, 1, 1, NULL, NULL, '554043330', '$2y$10$pk9cW1vXLR1mgMESX0wy9.Rz.sKnTcvbeWkKqvyYBqikJexfQBKr2', 2, 2, NULL, NULL, 'Ghc33XmbvxXkqSxx2xupTmLW55Plsd8lIPHjhslpPNZvomTWOn4KpigoB6qZ', '2020-01-29 08:32:11', '2020-02-06 13:26:13'),
	(7, 00000000003, 'saleh', 'alghamdi', 'ks8.un.sa@gmail.com', '2020-02-03 23:57:29', NULL, 'salehalghamdi', 'web', 'normal', 'male', NULL, 1, 1, 1, NULL, NULL, '554440101', '$2y$10$FDtDMmHWFbJRDn1utjy/6eA4ys2wg7ClJUvMXbecqvk2NTb7Z8Z.2', 2, NULL, NULL, NULL, 'iBz5lJG76Sw4f4umbCsr9D5RmMg6lUEm0pF5INI51L4hpfBLLcSGB2YN7dMm', '2020-02-02 01:14:40', '2020-02-03 23:57:29'),
	(9, 00000000005, 'نبيل', 'الغامدي', 'nabad.ksa@gmail.com', '2020-02-11 00:36:40', NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$s1qBskDui/FMp1J1tz7OkO/4yhlzKDCAW6bbKOhtSb9HfBLsRRude', NULL, NULL, NULL, NULL, NULL, '2020-02-03 23:20:52', '2020-02-11 00:36:40'),
	(10, 00000000005, 'ابرهيم', 'محمد', 'ibrahim_elrefaey@hotmail.com', '2020-02-05 04:56:45', '/uploads/profiles/10/hWFq4IN47d5XIMbdKtfAExLZu62Q0Th6uCB53qvx.png', 'ابرهيممحمد', 'web', 'normal', 'male', NULL, 1, 0, 0, NULL, NULL, '01017100093', '$2y$10$RmZdXwDyVArJtCwxph59DOMjVXzPQa5KMlQUY0gsgjDkIQS5PCZNi', 1, NULL, NULL, NULL, NULL, '2020-02-05 00:41:03', '2020-02-05 04:58:07'),
	(11, 00000000005, 'ibrahim', 'refaey', 'ibrahim.elrefaey.01@gmaill.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$DdKAwH4hAM9tHQqxcy.I/eUOSxxzEIZbH1c47noJky0hriUIWAKyu', NULL, NULL, NULL, NULL, NULL, '2020-02-05 02:48:58', '2020-02-05 02:48:58'),
	(14, 00000000006, 'الغامدي', 'الغامدي', 'tr0k7733@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$pk9cW1vXLR1mgMESX0wy9.Rz.sKnTcvbeWkKqvyYBqikJexfQBKr2', NULL, NULL, 'google', '109043198210981920435', NULL, '2020-02-06 11:53:03', '2020-02-06 13:26:13'),
	(15, 00000000006, 'سيرف', 'فايف', 'serv5group.com@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$uBlZ2A38t9KENiNu4a2y0uxi.HGmimtfUUPwcCKclRnSUaVHRbZne', NULL, NULL, 'google', '108808848823598755467', NULL, '2020-02-09 01:16:09', '2020-02-09 01:16:09'),
	(16, 00000000006, 'eme', 'sa', 'emecomsa@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$Gu0ZR/N8qeBxS5X/npNeU.tbVj4FufaR5acPYlLibv3xASR2kVWvC', NULL, NULL, 'google', '115099839760285612502', NULL, '2020-02-09 01:19:11', '2020-02-09 01:19:11'),
	(17, 00000000006, 'saleh', 'alghamdi', 'ks7.un.sa@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$Gy4h9sZqNV5re6Je.neZ8uHLlISZnFe28OWD/IwxrChk/DsPUvhDK', NULL, NULL, NULL, NULL, NULL, '2020-02-11 00:26:40', '2020-02-11 00:26:40'),
	(19, 00000000007, 'ندي', 'خالد', 'nadakhalledkhaleel@gmail.com', NULL, NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$i0WcucW8gMmZqmTk2oWvquv9LOJcpyqdkyqY7cblt.8su/pm5WrIa', NULL, NULL, NULL, NULL, NULL, '2020-02-11 05:46:52', '2020-02-11 05:46:52'),
	(21, 00000000007, 'user', 'one', 'user_one@user.com', '2020-02-24 05:45:47', NULL, 'userone', 'web', 'normal', 'male', NULL, 1, 0, 0, NULL, NULL, '123456789', '$2y$10$Q8T6heWwRmRWFkSRnW1HJ.6c3nb7ADJRv7CBcmrlT8ftbp6P3T7wy', 1, NULL, NULL, NULL, NULL, '2020-02-24 05:45:25', '2020-02-24 05:56:40'),
	(22, 00000000008, 'ibrahim', 'elmonier', 'elmonieribrahim@gmail.com', '2020-02-24 07:28:57', NULL, NULL, 'web', NULL, 'male', NULL, 1, 0, 0, NULL, NULL, NULL, '$2y$10$7lB6T6BAIIfp3LFLMl63puQ9pgRpA7GOGHUvSV3zIHp57MHmttQ2C', NULL, NULL, NULL, NULL, NULL, '2020-02-24 07:28:37', '2020-02-24 07:28:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table ashhrny.users_settings
CREATE TABLE IF NOT EXISTS `users_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send_email` tinyint(1) NOT NULL DEFAULT '0',
  `send_sms` tinyint(1) NOT NULL DEFAULT '0',
  `send_section` tinyint(1) NOT NULL DEFAULT '0',
  `normal_user_register` tinyint(1) NOT NULL DEFAULT '0',
  `famous_user_register` tinyint(1) NOT NULL DEFAULT '0',
  `register_section` tinyint(1) NOT NULL DEFAULT '0',
  `famous_section` tinyint(1) NOT NULL DEFAULT '0',
  `famous_ads_front` tinyint(1) NOT NULL DEFAULT '0',
  `famous_ads_menu` tinyint(1) NOT NULL DEFAULT '0',
  `identification_number` tinyint(1) NOT NULL DEFAULT '0',
  `identification_image` tinyint(1) NOT NULL DEFAULT '0',
  `myAccounts_menu` tinyint(1) NOT NULL DEFAULT '0',
  `myAds_menu` tinyint(1) NOT NULL DEFAULT '0',
  `featuredAd_menu` tinyint(1) NOT NULL DEFAULT '0',
  `AdInOurAccounts_menu` tinyint(1) NOT NULL DEFAULT '0',
  `myPoints_menu` tinyint(1) NOT NULL DEFAULT '0',
  `ticketOpen_menu` tinyint(1) NOT NULL DEFAULT '0',
  `contact_us` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.users_settings: ~0 rows (approximately)
DELETE FROM `users_settings`;
/*!40000 ALTER TABLE `users_settings` DISABLE KEYS */;
INSERT INTO `users_settings` (`id`, `send_email`, `send_sms`, `send_section`, `normal_user_register`, `famous_user_register`, `register_section`, `famous_section`, `famous_ads_front`, `famous_ads_menu`, `identification_number`, `identification_image`, `myAccounts_menu`, `myAds_menu`, `featuredAd_menu`, `AdInOurAccounts_menu`, `myPoints_menu`, `ticketOpen_menu`, `contact_us`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, NULL, '2020-02-02 01:09:41');
/*!40000 ALTER TABLE `users_settings` ENABLE KEYS */;

-- Dumping structure for table ashhrny.verify_users
CREATE TABLE IF NOT EXISTS `verify_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `verify_users_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ashhrny.verify_users: ~18 rows (approximately)
DELETE FROM `verify_users`;
/*!40000 ALTER TABLE `verify_users` DISABLE KEYS */;
INSERT INTO `verify_users` (`id`, `user_id`, `token`, `code`, `created_at`, `updated_at`) VALUES
	(10, 3, 'b1550b23027dd19241389dabc5675695d49edcf2', '7350072', '2020-01-29 06:36:25', '2020-01-29 06:36:25'),
	(11, 4, 'cacc38d15c9b64e3ad0cf418d3072f3dea1b9568', '6811894', '2020-01-29 06:40:10', '2020-01-29 06:40:10'),
	(15, 5, 'd61d65895951e8d76fcc0748389b25011d181b64', '5353694', '2020-01-29 06:46:16', '2020-01-29 06:46:16'),
	(16, 6, 'a78b02f5d084fe5046bad86f3e4f7f9d4c1450cb', '3615914', '2020-01-29 08:32:11', '2020-01-29 08:32:11'),
	(18, 7, '2ebb88eab8fa4cd84f2fb2259c6991156376c566', '5271052', '2020-02-02 01:26:57', '2020-02-02 01:26:57'),
	(19, 8, '4df8301a21a31fd89a2f3c7e560487f205705c3e', '5884058', '2020-02-03 03:21:35', '2020-02-03 03:21:35'),
	(23, 9, '429e7e326d40439e595957c2378f368534dccacb', '5478688', '2020-02-04 00:02:19', '2020-02-04 00:02:19'),
	(30, 11, '0ff723cab922103fec62c992ec4e71127348bf90', '1652684', '2020-02-05 04:49:55', '2020-02-05 04:49:55'),
	(33, 10, 'b6b8b15bd8e47285a03fa80cc011e139f35abd52', '2056100', '2020-02-05 04:55:32', '2020-02-05 04:55:32'),
	(36, 12, 'ac687ddb37db3b3f7e587f120aa11549fe51d873', '9048144', '2020-02-06 03:35:55', '2020-02-06 03:35:55'),
	(38, 13, '89782e14910b14a29894615a94f5abd5afb73b15', '8050301', '2020-02-06 03:42:23', '2020-02-06 03:42:23'),
	(40, 14, '20c684abad3ec40965717a2c909903ef91ff17b4', '9234598', '2020-02-06 13:23:38', '2020-02-06 13:23:38'),
	(42, 16, '449669b8bc290febccdf63d82d00e3aeb76b9cf0', '', '2020-02-09 01:19:11', '2020-02-09 01:19:11'),
	(43, 15, 'dbe2390b5657b018cbb300904d74fffe47814dc1', '5288951', '2020-02-09 02:31:49', '2020-02-09 02:31:49'),
	(44, 17, 'dcf804fa7503b6128b9d61a980c5f0294b1cd220', '1321359', '2020-02-11 00:26:41', '2020-02-11 00:26:41'),
	(46, 18, '6eeeec075e72c446f0ed7ee85647a90a22d364bf', '6062414', '2020-02-11 03:58:04', '2020-02-11 03:58:04'),
	(47, 19, 'e0d32de6f7807da94674b29b8b6700744c46f694', '5960009', '2020-02-11 05:46:53', '2020-02-11 05:46:53'),
	(49, 2, '2290177ea0258dda2f1cea5de5d57a0940807f9f', '4094098', '2020-02-16 23:20:05', '2020-02-16 23:20:05'),
	(50, 21, 'a050fd79d495e395a2d34be58b105001e7e75397', '9493881', '2020-02-24 05:45:26', '2020-02-24 05:45:26'),
	(51, 22, '6e47146c7aef7f07d0250b1cfe7d85cec13626da', '3552', '2020-02-24 07:28:37', '2020-02-24 07:28:37');
/*!40000 ALTER TABLE `verify_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
