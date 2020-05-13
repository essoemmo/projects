-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2020 at 03:27 PM
-- Server version: 10.2.30-MariaDB
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
-- Database: `joudacademy_master`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
