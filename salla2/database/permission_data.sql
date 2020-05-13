-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2020 at 09:50 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_data`
--
ALTER TABLE `permission_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_data_lang_id_foreign` (`lang_id`),
  ADD KEY `permission_data_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_data_source_id_foreign` (`source_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_data`
--
ALTER TABLE `permission_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=674;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_data`
--
ALTER TABLE `permission_data`
  ADD CONSTRAINT `permission_data_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_data_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_data_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `permission_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
