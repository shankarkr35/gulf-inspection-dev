-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2024 at 10:56 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tradeai2_geo-technical`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `department` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(250) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1' COMMENT '1=>admin 2=>sub_admin',
  `permission` varchar(250) NOT NULL,
  `category` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `department`, `phone`, `password`, `address`, `user_type`, `permission`, `category`, `status`) VALUES
(2, 'Admin', 'admin@gmail.com', 7, '999999910', '123456', '', 1, '1,2,3,4,5,6,7', '', 1),
(5, 'Shankar Singh', 'shankar.wxit@gmail.com', 7, '788788887', '123456', '', 2, '', '', 1),
(6, 'Test Admin', 'test12@gmail.com', 7, '787878410', '123456', '', 2, '', '', 1),
(7, 'Demo test', 'shankar@gmail.com', 7, '789786410', '123456', '', 2, '', '', 1),
(8, 'Go', 'gametinkle@gmail.com', 5, 'g', '123456', '', 2, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `my_key` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL,
  `is_private_key` tinyint(1) NOT NULL,
  `ip_addresses` text COLLATE utf8_unicode_ci,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `my_key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'development101010102020203030', 0, 0, 0, NULL, '2021-10-13 09:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nameUrl` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `governorateSlug` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `nameUrl`, `governorateSlug`, `createdby`, `status`, `create_date`, `update_date`) VALUES
(2, 'Al Fintas', 'al-fintas', 'al-ahmadi', 2, 1, '2024-05-31 07:10:36', '2024-06-06 22:24:43'),
(4, 'Khaitan', 'khaitan', 'al-farwaniya', 2, 1, '2024-05-31 07:45:49', '2024-06-06 22:24:43'),
(13, 'hydrabad', 'hydrabad', 'andhra-pradesh', 0, 1, '2024-06-06 20:02:03', '2024-06-06 20:02:39'),
(14, 'Ranchi ', 'ranchi-', 'jharkhand-', 0, 1, '2024-06-06 20:02:03', '2024-06-06 20:02:39'),
(15, 'Begusaray', 'begusaray', 'bihar', 0, 1, '2024-06-06 20:02:03', '2024-06-06 20:02:39'),
(16, 'hazaribagh22', 'hazaribagh22', 'jharkhand-', 0, 1, '2024-06-06 20:02:39', '2024-06-06 20:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nameUrl` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `nameUrl`, `createdby`, `status`, `create_date`, `update_date`) VALUES
(9, 'Demo', 'demo', 2, 1, '2024-06-18 16:13:36', '2024-06-18 18:43:36'),
(10, 'TCS', 'tcs', 0, 1, '2024-08-12 17:20:38', '2024-08-12 17:20:38'),
(11, 'WXIT ', 'wxit-', 0, 1, '2024-08-12 17:20:38', '2024-08-12 17:20:38'),
(12, 'Wipro', 'wipro', 0, 1, '2024-08-12 17:20:38', '2024-08-12 17:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `name_ar`, `short_name`, `country_code`, `status`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(2, 'Albania ', '', 'AL', '+355', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Algeria ', '', 'DZ', '+213', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'American Samoa', '', 'AS', '+1-684', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Andorra, Principality of ', '', 'AD', '+376', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Angola', '', 'AO', '+244', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Anguilla ', '', 'AI', '+1-264', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Antarctica', '', 'AQ', '+672', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Antigua and Barbuda', '', 'AG', '+1-268', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Argentina ', '', 'AR', '+54', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Armenia', '', 'AM', '+374', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Aruba', '', 'AW', '+297', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Australia', '', 'AU', '+61', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Austria', '', 'AT', '+43', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Azerbaijan or Azerbaidjan (Former Azerbaijan Soviet Socialist Republic)', '', 'AZ', '+994', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Bahamas, Commonwealth of The', '', 'BS', '+1-242', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Bahrain, Kingdom of (Former Dilmun)', '', 'BH', '+973', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Bangladesh (Former East Pakistan)', '', 'BD', '+880', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Barbados ', '', 'BB', '+1-246', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Belarus (Former Belorussian [Byelorussian] Soviet Socialist Republic)', '', 'BY', '+375', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Belgium ', '', 'BE', '+32', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Belize (Former British Honduras)', '', 'BZ', '+501', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Benin (Former Dahomey)', '', 'BJ', '+229', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Bermuda ', '', 'BM', '+1-441', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Bhutan, Kingdom of', '', 'BT', '+975', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Bolivia ', '', 'BO', '+591', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Bosnia and Herzegovina ', '', 'BA', '+387', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Botswana (Former Bechuanaland)', '', 'BW', '+267', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Bouvet Island (Territory of Norway)', '', 'BV', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Brazil ', '', 'BR', '+55', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'British Indian Ocean Territory (BIOT)', '', 'IO', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Brunei (Negara Brunei Darussalam) ', '', 'BN', '+673', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Bulgaria ', '', 'BG', '+359', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Burkina Faso (Former Upper Volta)', '', 'BF', '+226', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Burundi (Former Urundi)', '', 'BI', '+257', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Cambodia, Kingdom of (Former Khmer Republic, Kampuchea Republic)', '', 'KH', '+855', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Cameroon (Former French Cameroon)', '', 'CM', '+237', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Canada ', '', 'CA', '+1', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Cape Verde ', '', 'CV', '+238', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cayman Islands ', '', 'KY', '+1-345', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Central African Republic ', '', 'CF', '+236', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Chad ', '', 'TD', '+235', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Chile ', '', 'CL', '+56', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'China ', '', 'CN', '+86', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Christmas Island ', '', 'CX', '+53', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Cocos (Keeling) Islands ', '', 'CC', '+61', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Colombia ', '', 'CO', '+57', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Comoros, Union of the ', '', 'KM', '+269', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Congo, Democratic Republic of the (Former Zaire) ', '', 'CD', '+243', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Congo, Republic of the', '', 'CG', '+242', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Cook Islands (Former Harvey Islands)', '', 'CK', '+682', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Costa Rica ', '', 'CR', '+506', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cote D\'Ivoire (Former Ivory Coast) ', '', 'CI', '+225', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Croatia (Hrvatska) ', '', 'HR', '+385', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Cuba ', '', 'CU', '+53', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Cyprus ', '', 'CY', '+357', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Czech Republic', '', 'CZ', '+420', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Czechoslavakia (Former) See CZ Czech Republic or Slovakia', '', 'CS', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Denmark ', '', 'DK', '+45', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Djibouti (Former French Territory of the Afars and Issas, French Somaliland)', '', 'DJ', '+253', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Dominica ', '', 'DM', '+1-767', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Dominican Republic ', '', 'DO', '+1-809 and +1-829? ', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'East Timor (Former Portuguese Timor)', '', 'TP', '+670', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Ecuador ', '', 'EC', '+593 ', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Egypt (Former United Arab Republic - with Syria)', '', 'EG', '+20', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'El Salvador ', '', 'SV', '+503', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Equatorial Guinea (Former Spanish Guinea)', '', 'GQ', '+240', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Eritrea (Former Eritrea Autonomous Region in Ethiopia)', '', 'ER', '+291', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Estonia (Former Estonian Soviet Socialist Republic)', '', 'EE', '+372', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Ethiopia (Former Abyssinia, Italian East Africa)', '', 'ET', '+251', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Falkland Islands (Islas Malvinas) ', '', 'FK', '+500', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Faroe Islands ', '', 'FO', '+298', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Fiji ', '', 'FJ', '+679', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'Finland ', '', 'FI', '+358', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'France ', '', 'FR', '+33', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'French Guiana or French Guyana ', '', 'GF', '+594', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'French Polynesia (Former French Colony of Oceania)', '', 'PF', '+689', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'French Southern Territories and Antarctic Lands ', '', 'TF', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Gabon (Gabonese Republic)', '', 'GA', '+241', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Gambia, The ', '', 'GM', '+220', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'Georgia (Former Georgian Soviet Socialist Republic)', '', 'GE', '+995', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Germany ', '', 'DE', '+49', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Ghana (Former Gold Coast)', '', 'GH', '+233', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Gibraltar ', '', 'GI', '+350', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Great Britain (United Kingdom) ', '', 'GB', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Greece ', '', 'GR', '+30', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Greenland ', '', 'GL', '+299', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Grenada ', '', 'GD', '+1-473', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Guadeloupe', '', 'GP', '+590', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Guam', '', 'GU', '+1-671', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Guatemala ', '', 'GT', '+502', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Guinea (Former French Guinea)', '', 'GN', '+224', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Guinea-Bissau (Former Portuguese Guinea)', '', 'GW', '+245', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Guyana (Former British Guiana)', '', 'GY', '+592', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Haiti ', '', 'HT', '+509', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Heard Island and McDonald Islands (Territory of Australia)', '', 'HM', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Holy See (Vatican City State)', '', 'VA', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Honduras ', '', 'HN', '+504', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'Hong Kong ', '', 'HK', '+852', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Hungary ', '', 'HU', '+36', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'Iceland ', '', 'IS', '+354', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'India ', '', 'IN', '+91', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Indonesia (Former Netherlands East Indies; Dutch East Indies)', '', 'ID', '+62', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Iran, Islamic Republic of', '', 'IR', '+98', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Iraq ', '', 'IQ', '+964', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Ireland ', '', 'IE', '+353', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Israel ', '', 'IL', '+972', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Italy ', '', 'IT', '+39', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Jamaica ', '', 'JM', '+1-876', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Japan ', '', 'JP', '+81', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Jordan (Former Transjordan)', '', 'JO', '+962', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Kazakstan or Kazakhstan (Former Kazakh Soviet Socialist Republic)', '', 'KZ', '+7', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Kenya (Former British East Africa)', '', 'KE', '+254', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'Kiribati (Pronounced keer-ree-bahss) (Former Gilbert Islands)', '', 'KI', '+686', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Korea, Democratic People\'s Republic of (North Korea)', '', 'KP', '+850', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Korea, Republic of (South Korea) ', '', 'KR', '+82', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Kuwait ', '', 'KW', '+965', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Kyrgyzstan (Kyrgyz Republic) (Former Kirghiz Soviet Socialist Republic)', '', 'KG', '+996', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Lao People\'s Democratic Republic (Laos)', '', 'LA', '+856', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Latvia (Former Latvian Soviet Socialist Republic)', '', 'LV', '+371', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Lebanon ', '', 'LB', '+961', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Lesotho (Former Basutoland)', '', 'LS', '+266', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Liberia ', '', 'LR', '+231', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Libya (Libyan Arab Jamahiriya)', '', 'LY', '+218', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Liechtenstein ', '', 'LI', '+423', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Lithuania (Former Lithuanian Soviet Socialist Republic)', '', 'LT', '+370', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Luxembourg ', '', 'LU', '+352', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Macau ', '', 'MO', '+853', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Macedonia, The Former Yugoslav Republic of', '', 'MK', '+389', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Madagascar (Former Malagasy Republic)', '', 'MG', '+261', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Malawi (Former British Central African Protectorate, Nyasaland)', '', 'MW', '+265', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Malaysia ', '', 'MY', '+60', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Maldives ', '', 'MV', '+960', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Mali (Former French Sudan and Sudanese Republic) ', '', 'ML', '+223', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Malta ', '', 'MT', '+356', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Marshall Islands (Former Marshall Islands District - Trust Territory of the Pacific Islands)', '', 'MH', '+692', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Martinique (French) ', '', 'MQ', '+596', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Mauritania ', '', 'MR', '+222', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Mauritius ', '', 'MU', '+230', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Mayotte (Territorial Collectivity of Mayotte)', '', 'YT', '+269', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Mexico ', '', 'MX', '+52', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Micronesia, Federated States of (Former Ponape, Truk, and Yap Districts - Trust Territory of the Pacific Islands)', '', 'FM', '+691', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Moldova, Republic of', '', 'MD', '+373', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Monaco, Principality of', '', 'MC', '+377', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'Mongolia (Former Outer Mongolia)', '', 'MN', '+976', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Montserrat ', '', 'MS', '+1-664', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Morocco ', '', 'MA', '+212', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Mozambique (Former Portuguese East Africa)', '', 'MZ', '+258', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Myanmar, Union of (Former Burma)', '', 'MM', '+95', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Namibia (Former German Southwest Africa, South-West Africa)', '', 'NA', '+264', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Nauru (Former Pleasant Island)', '', 'NR', '+674', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Nepal ', '', 'NP', '+977', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Netherlands ', '', 'NL', '+31', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Netherlands Antilles (Former Curacao and Dependencies)', '', 'AN', '+599', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'New Caledonia ', '', 'NC', '+687', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'New Zealand (Aotearoa) ', '', 'NZ', '+64', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Nicaragua ', '', 'NI', '+505', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'Niger ', '', 'NE', '+227', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'Nigeria ', '', 'NG', '+234', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Niue (Former Savage Island)', '', 'NU', '+683', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Norfolk Island ', '', 'NF', '+672', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Northern Mariana Islands (Former Mariana Islands District - Trust Territory of the Pacific Islands)', '', 'MP', '+1-670', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Norway ', '', 'NO', '+47', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Oman, Sultanate of (Former Muscat and Oman)', '', 'OM', '+968', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'Pakistan (Former West Pakistan)', '', 'PK', '+92', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Palau (Former Palau District - Trust Terriroty of the Pacific Islands)', '', 'PW', '+680', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Palestinian State (Proposed)', '', 'PS', '+970', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Panama ', '', 'PA', '+507', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Papua New Guinea (Former Territory of Papua and New Guinea)', '', 'PG', '+675', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Paraguay ', '', 'PY', '+595', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Peru ', '', 'PE', '+51', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Philippines ', '', 'PH', '+63', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Pitcairn Island', '', 'PN', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Poland ', '', 'PL', '+48', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Portugal ', '', 'PT', '+351', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Puerto Rico ', '', 'PR', '+1-787 or +1-939', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Qatar, State of ', 'قطر', 'QA', '+974 ', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Reunion (French) (Former Bourbon Island)', '', 'RE', '+262', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Romania ', '', 'RO', '+40', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Russia - USSR (Former Russian Empire, Union of Soviet Socialist Republics, Russian Soviet Federative Socialist Republic) Now RU - Russian Federation', '', 'SU', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Russian Federation ', '', 'RU', '+7', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Rwanda (Rwandese Republic) (Former Ruanda)', '', 'RW', '+250', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Saint Helena ', '', 'SH', '+290', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Saint Kitts and Nevis (Former Federation of Saint Christopher and Nevis)', '', 'KN', '+1-869', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Saint Lucia ', '', 'LC', '+1-758', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Saint Pierre and Miquelon ', '', 'PM', '+508', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Saint Vincent and the Grenadines ', '', 'VC', '+1-784', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Samoa (Former Western Samoa)', '', 'WS', '+685', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'San Marino ', '', 'SM', '+378', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Sao Tome and Principe ', '', 'ST', '+239', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Saudi Arabia ', '', 'SA', '+966', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Serbia, Republic of', '', 'RS', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'Senegal ', '', 'SN', '+221', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Seychelles ', '', 'SC', '+248', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Sierra Leone ', '', 'SL', '+232', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Singapore ', '', 'SG', '+65', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Slovakia', '', 'SK', '+421', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'Slovenia ', '', 'SI', '+386', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Solomon Islands (Former British Solomon Islands)', '', 'SB', '+677', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Somalia (Former Somali Republic, Somali Democratic Republic) ', '', 'SO', '+252', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'South Africa (Former Union of South Africa)', '', 'ZA', '+27', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'South Georgia and the South Sandwich Islands', '', 'GS', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Spain ', '', 'ES', '+34', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'Sri Lanka (Former Serendib, Ceylon) ', '', 'LK', '+94', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Sudan (Former Anglo-Egyptian Sudan) ', '', 'SD', '+249', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'Suriname (Former Netherlands Guiana, Dutch Guiana)', '', 'SR', '+597', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'Svalbard (Spitzbergen) and Jan Mayen Islands ', '', 'SJ', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'Swaziland, Kingdom of ', '', 'SZ', '+268', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Sweden ', '', 'SE', '+46', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Switzerland ', '', 'CH', '+41', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Syria (Syrian Arab Republic) (Former United Arab Republic - with Egypt)', '', 'SY', '+963', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Taiwan (Former Formosa)', '', 'TW', '+886', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Tajikistan (Former Tajik Soviet Socialist Republic)', '', 'TJ', '+992', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Tanzania, United Republic of (Former United Republic of Tanganyika and Zanzibar)', '', 'TZ', '+255', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Thailand (Former Siam)', '', 'TH', '+66', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Togo (Former French Togoland)', '', 'TG', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Tokelau ', '', 'TK', '+690', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Tonga, Kingdom of (Former Friendly Islands)', '', 'TO', '+676', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Trinidad and Tobago ', '', 'TT', '+1-868', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Tromelin Island ', '', 'TE', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Tunisia ', '', 'TN', '+216', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'Turkey ', '', 'TR', '+90', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Turkmenistan (Former Turkmen Soviet Socialist Republic)', '', 'TM', '+993', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'Turks and Caicos Islands ', '', 'TC', '+1-649', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'Tuvalu (Former Ellice Islands)', '', 'TV', '+688', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'Uganda, Republic of', '', 'UG', '+256', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'Ukraine (Former Ukrainian National Republic, Ukrainian State, Ukrainian Soviet Socialist Republic)', '', 'UA', '+380', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'United Arab Emirates (UAE)', '', 'AE', '+971', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'United Kingdom (Great Britain / UK)', '', 'GB', '+44', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'United States ', '', 'US', '+1', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'United States Minor Outlying Islands ', '', 'UM', '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Uruguay, Oriental Republic of (Former Banda Oriental, Cisplatine Province)', '', 'UY', '+598', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Uzbekistan (Former UZbek Soviet Socialist Republic)', '', 'UZ', '+998', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'Vanuatu (Former New Hebrides)', '', 'VU', '+678', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'Vatican City State (Holy See)', '', 'VA', '+418', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'Venezuela ', '', 'VE', '+58', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'Vietnam ', '', 'VN', '+84', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Virgin Islands, British ', '', 'VI', '+1-284', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Virgin Islands, United States', '', 'VQ', '+1-340', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `company` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(200) NOT NULL,
  `gender` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `login_type` int(11) NOT NULL COMMENT '0=Normal,1=Google,2=Facebook',
  `otp` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `access_token` text NOT NULL,
  `fcm_token` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `company`, `email`, `mobile_number`, `gender`, `password`, `image`, `login_type`, `otp`, `status`, `access_token`, `fcm_token`, `create_date`, `update_date`) VALUES
(1, 'Sanju Singh', 'wipro', 'sanju@gmail.com', '787878787', '', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, 1, '', '', '2024-08-12 18:16:40', '2024-08-12 18:16:40'),
(2, 'Rahul ', 'wipro', 'shankar@gmail.com', '78787811', '', '25f9e794323b453885f5181f1b624d0b', '', 0, 0, 0, '', '', '2024-08-12 18:16:40', '2024-08-12 18:16:40'),
(3, 'Anjani', 'wxit-', 'anjali@gmail.com', '78421222', '', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, 1, '', '', '2024-08-12 18:16:40', '2024-08-12 18:16:40'),
(4, 'Hell  client', 'tcs', 'client@gmail.com', '09006669961', '', 'e10adc3949ba59abbe56e057f20f883e', 'default-image.png', 0, 0, 0, '', '', '2024-08-14 12:53:53', '2024-08-14 12:53:53'),
(5, 'PK', 'demo', 'pk@gmail.com', '87897910', '', 'e10adc3949ba59abbe56e057f20f883e', 'default-image.png', 0, 0, 0, '', '', '2024-08-14 12:55:03', '2024-08-14 12:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nameUrl` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `nameUrl`, `createdby`, `status`, `create_date`, `update_date`) VALUES
(2, 'Al Ahmadi', 'al-ahmadi', 2, 1, '2024-05-31 07:10:36', '2024-06-07 07:12:08'),
(3, 'water dept', 'water-dept', 2, 1, '2024-05-31 07:11:34', '2024-06-07 07:12:08'),
(4, 'soil dept', 'soil-dept', 2, 1, '2024-06-04 08:27:34', '2024-06-07 07:12:08'),
(5, 'Petrol', 'petrol', 0, 1, '2024-06-07 04:42:41', '2024-06-07 04:42:41'),
(6, 'Water ', 'water-', 0, 1, '2024-06-07 04:42:41', '2024-06-07 04:42:41'),
(7, 'Food', 'food', 0, 1, '2024-06-07 04:42:41', '2024-06-07 04:42:41'),
(8, 'Fertilizer', 'fertilizer', 0, 1, '2024-06-07 04:42:41', '2024-06-07 04:42:41'),
(9, 'Demo', 'demo', 2, 1, '2024-06-18 16:13:36', '2024-06-18 18:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `governorates`
--

CREATE TABLE `governorates` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nameUrl` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `governorates`
--

INSERT INTO `governorates` (`id`, `name`, `nameUrl`, `createdby`, `status`, `create_date`, `update_date`) VALUES
(2, 'Al Ahmadi', 'al-ahmadi', 2, 1, '2024-05-31 07:10:36', '2024-06-06 19:26:05'),
(3, 'Al Farwaniya', 'al-farwaniya', 2, 1, '2024-05-31 07:11:34', '2024-06-06 21:55:08'),
(14, 'Andhra Pradesh', 'andhra-pradesh', 0, 1, '2024-06-06 20:00:54', '2024-06-06 20:00:54'),
(15, 'Jharkhand ', 'jharkhand-', 0, 1, '2024-06-06 20:00:54', '2024-06-06 20:00:54'),
(16, 'Bihar', 'bihar', 0, 1, '2024-06-06 20:00:54', '2024-06-06 20:00:54'),
(17, 'Up', 'up', 0, 1, '2024-06-06 20:00:54', '2024-06-06 20:00:54'),
(20, 'testing', 'testing', 2, 1, '2024-06-18 16:04:50', '2024-06-18 18:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 4, '', 'prashant.wxit@gmail.com', '12345678', 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2022-10-12 07:55:48'),
(2, 6, '', 'mitali.anomla@gmail.com', '7081613025', 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2022-10-12 07:55:48'),
(3, 4, '', 'prashant.wxit@gmail.com', '12345678', 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2022-10-12 07:55:48'),
(4, 4, '', 'prashant.wxit@gmail.com', '12345678', 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2022-10-12 07:55:49'),
(5, 3, '', 'shaan.kr35@gmail.com', '7717720892', 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2022-10-12 07:55:49'),
(6, 2, '', 'shaan.wxit@gmail.com', '7717720891', 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2022-10-12 07:55:49'),
(7, 1, '', 'shankar.wxit@gmail.com', '8051173156', 'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2022-10-12 07:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title_en` text NOT NULL,
  `title_ar` text NOT NULL,
  `page_url` text NOT NULL,
  `en_desc` longtext NOT NULL,
  `ar_desc` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title_en`, `title_ar`, `page_url`, `en_desc`, `ar_desc`, `status`) VALUES
(2, 'Term & Condition', 'الشروط و الأحكام', 'term-condition', '<p style=\"text-align: justify;\"><span style=\"text-align: left; font-size: 16pt; line-height: 107%;\">By downloading or using the App, these terms will automatically apply to\r\nyou – so you should ensure you read them carefully before using the App. You\r\nare not permitted to copy or modify the App, any part of the App, or our\r\nTrademarks in any way. You are not allowed to attempt to extract the source\r\ncode of the Application, and you should also not attempt to translate the\r\nApplication into other languages, or create derivative versions. The\r\napplication itself, and all trademarks, copyrights, database rights and other\r\nintellectual property rights related to it, are still owned by (</span><span lang=\"EN-GB\" segoe=\"\" ui\",\"sans-serif\";=\"\" color:black\"=\"\" style=\"text-align: left; font-size: 16pt; line-height: 107%;\">Laundry app</span><span style=\"text-align: left; font-size: 16pt; line-height: 107%;\">). The sole owner of the application and platform (</span><span lang=\"EN-GB\" segoe=\"\" ui\",\"sans-serif\";=\"\" color:black\"=\"\" style=\"text-align: left; font-size: 16pt; line-height: 107%;\">Laundry app</span><span style=\"text-align: left; font-size: 16pt; line-height: 107%;\">).</span></p><p style=\"text-align: justify;\"><span style=\"text-align: left; font-size: 16pt; line-height: 107%;\"><br></span><span style=\"text-align: left; font-size: 16pt; line-height: 107%;\">(</span><span lang=\"EN-GB\" segoe=\"\" ui\",=\"\" \"sans-serif\";=\"\" color:=\"\" black;\"=\"\" style=\"text-align: left; font-size: 16pt; line-height: 107%;\">Laundry app</span><span style=\"text-align: left; font-size: 16pt; line-height: 107%;\">) is\r\ncommitted to ensuring that the application is as useful and effective as\r\npossible. For this reason, we reserve the right to make changes to the App or\r\ncharge fees for its services, at any time and for any reason. We will never\r\ncharge you for the App or its Services without explaining to you exactly what\r\nyou are paying for.</span></p><p>\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\"><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:\r\nEN-US\">The </span><span lang=\"EN-GB\" style=\"font-size:16.0pt;line-height:107%;\r\nfont-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Laundry app</span><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:EN-US\"> application\r\nstores and processes the personal data you provide to us, in order to provide\r\nour service. It is your responsibility to keep your phone and app access\r\nsecure. Therefore, we recommend that you do not jailbreak or root your phone,\r\nwhich is the process of removing software restrictions and restrictions imposed\r\nby the official operating system of your device. It can make your phone\r\nvulnerable to malware/viruses/malware, compromising your phone\'s security\r\nfeatures, and may mean that the </span><span lang=\"EN-GB\" style=\"font-size:16.0pt;\r\nline-height:107%;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Laundry app</span><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:EN-US\"> app will not\r\nwork properly or at all.</span></p><p class=\"MsoNormal\"><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:EN-US\"></span></p><p class=\"MsoNormal\"><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:\r\nEN-US\">&nbsp; You should be aware that there\r\nare certain things for which </span><span lang=\"EN-GB\" style=\"font-size:16.0pt;\r\nline-height:107%;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Laundry app</span><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:EN-US\"> will not be\r\nresponsible. Some app functionality will require the app to have an active\r\ninternet connection. Connection can be via a Wi-Fi network, or provided by your\r\nmobile network provider, but </span><span lang=\"EN-GB\" style=\"font-size:16.0pt;\r\nline-height:107%;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Laundry app</span><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:EN-US\"> cannot take\r\nresponsibility for the application not working to its full functionality if you\r\ndo not have access to a Wi-Fi network, and you do not You have none of the\r\nallowed data left.<o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:EN-US\"><o:p><br></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:16.0pt;line-height:107%;mso-ansi-language:EN-US\"><o:p><br></o:p></span></p>', '<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:arial;mso-bidi-theme-font:=\"\" minor-bidi\"=\"\"><o:p>&nbsp;</o:p></span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">الأحكام والشروط</span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><o:p></o:p></span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">&nbsp;</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size: 14pt; line-height: 107%; font-family: Arial, \" sans-serif\";\"=\"\">من خلال تنزيل التطبيق أو استخدامه،\r\nسيتم تطبيق هذه الشروط عليك تلقائيًا - لذا يجب عليك التأكد من قراءتها بعناية قبل\r\nاستخدام التطبيق. لا يجوز لك نسخ أو تعديل التطبيق أو أي جزء من التطبيق أو\r\nعلاماتنا التجارية بأي شكل من الأشكال. لا يُسمح لك بمحاولة استخراج الكود المصدري\r\nللتطبيق، ويجب أيضًا عدم محاولة ترجمة التطبيق إلى لغات أخرى، أو إنشاء إصدارات\r\nمشتقة. لا يزال التطبيق نفسه وجميع العلامات التجارية وحقوق النشر وحقوق قاعدة\r\nالبيانات وحقوق الملكية الفكرية الأخرى المتعلقة به مملوكة لشركة</span><span dir=\"LTR\" style=\"font-size: 1rem;\"></span><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\"><span dir=\"LTR\"></span> (Laundryapp). </span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size: 14pt; line-height: 107%; font-family: Arial, \" sans-serif\";\"=\"\">المالك الوحيد للتطبيق والمنصة</span><span dir=\"LTR\" style=\"font-size: 1rem;\"></span><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\"><span dir=\"LTR\"></span> (Laundryapp).</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">تلتزم</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>\r\n(Laundryapp) </span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;\r\nline-height:107%;font-family:\" arial\",\"sans-serif\";mso-ascii-font-family:calibri;=\"\" mso-ascii-theme-font:minor-latin;mso-hansi-font-family:calibri;mso-hansi-theme-font:=\"\" minor-latin\"=\"\">بضمان أن يكون التطبيق مفيدًا وفعالًا قدر الإمكان. ولهذا السبب،\r\nنحتفظ بالحق في إجراء تغييرات على التطبيق أو فرض رسوم على خدماته، في أي وقت ولأي\r\nسبب. لن نقوم أبدًا بتحصيل رسوم منك مقابل التطبيق أو خدماته دون أن نوضح لك\r\nبالضبط ما تدفع مقابله</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.<o:p></o:p></span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">يقوم تطبيق</span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">Laundryapp</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">بتخزين ومعالجة البيانات الشخصية التي\r\nتقدمها لنا، من أجل تقديم خدماتنا. تقع على عاتقك مسؤولية الحفاظ على أمان الوصول\r\nإلى هاتفك وتطبيقك. لذلك، ننصحك بعدم عمل جيلبريك أو عمل روت لهاتفك، وهي عملية\r\nإزالة القيود والقيود البرمجية التي يفرضها نظام التشغيل الرسمي لجهازك. يمكن أن\r\nيجعل هاتفك عرضة للبرامج الضارة/الفيروسات/البرامج الضارة، مما يعرض ميزات أمان\r\nهاتفك للخطر، وقد يعني أن تطبيق</span><span lang=\"EN-GB\" style=\"font-size:14.0pt;\r\nline-height:107%\">Laundryapp</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:\r\n14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";mso-ascii-font-family:=\"\" calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:calibri;=\"\" mso-hansi-theme-font:minor-latin\"=\"\">لن يعمل بشكل صحيح أو لن يعمل على الإطلاق</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.<o:p></o:p></span></p><p style=\"text-align: right;\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">يجب أن تدرك أن هناك أشياء معينة لن\r\nتتحمل</span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">Laundryapp</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">مسؤوليتها. ستتطلب بعض وظائف التطبيق\r\nأن يكون لدى التطبيق اتصال نشط بالإنترنت. يمكن أن يتم الاتصال عبر شبكة</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span> Wi-Fi</span><span dir=\"RTL\"></span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\"><span dir=\"RTL\"></span>، أو يتم توفيره\r\nبواسطة موفر شبكة الهاتف المحمول الخاص بك، ولكن لا يمكن لـ</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\"><br></span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:arial;mso-bidi-theme-font:=\"\" minor-bidi\"=\"\"><o:p></o:p></span></p>', 1),
(3, 'Privacy Policy', ' سياسة الخصوصية', 'privacy-policy', '<h1 style=\"text-align: center;\"><span style=\"\" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\"=\"\"><font color=\"#000000\" data-darkreader-inline-color=\"\" style=\"--darkreader-inline-color: #e8e6e3;\"><b>Privacy Policy</b></font></span></h1><div style=\"border: 1pt solid rgb(229, 231, 235); padding: 0cm; --darkreader-inline-border-top: #363b3d; --darkreader-inline-border-right: #363b3d; --darkreader-inline-border-bottom: #363b3d; --darkreader-inline-border-left: #363b3d;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\">\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Pavilion built the Laundry&nbsp;</span><span style=\"font-size:14.0pt;\r\nfont-family:\" segoe=\"\" ui\",\"sans-serif\";color:black;mso-ansi-language:en-us\"=\"\">a</span><span lang=\"EN-GB\" style=\"font-size:14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";=\"\" color:black\"=\"\">pp as a Commercial app. This service is provided by Laundry and is\r\nintended for use as is.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">This page is used to\r\ninform visitors regarding our policies with the collection, use, and disclosure\r\nof personal information if anyone decided to use our service.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">If you choose to use\r\nour service, then you agree to the collection and use of information in\r\nrelation to this policy. The personal information that we collect is used for\r\nproviding and improving the service. We will not use or share your information\r\nwith anyone except as described in this privacy policy.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">The terms used in this\r\nprivacy policy have the same meanings as in our terms and conditions, which is\r\naccessible at(Laundryapp</span><span dir=\"RTL\"></span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\"><span dir=\"RTL\"></span>(</span><span lang=\"EN-GB\" style=\"font-size:14.0pt;font-family:\r\n\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">unless otherwise defined in this privacy\r\npolicy.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Information Collection\r\nand Use<o:p></o:p></span></h5>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">For a better\r\nexperience, while using our service, we may require you to provide us with\r\ncertain personally identifiable, information. The information that we request\r\nwill be retained by us and used as described in this privacy policy.<o:p></o:p></span></p>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">The app does use third\r\nparty services that may collect information used to identify you.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Log Data<o:p></o:p></span></h5>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">We want to inform you\r\nthat whenever you use our service, in a case of an error in the app we collect\r\ndata and information (through third party products) on your phone called log\r\ndata. This log data may include information such as your device internet\r\nprotocol IP address, device name, operating system version, the configuration\r\nof the app when utilizing our service, the time and date of your use of the\r\nservice, and other statistics.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Cookies<o:p></o:p></span></h5>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Cookies are files with\r\na small amount of data that are commonly used as anonymous unique identifiers.\r\nThese are sent to your browser from the websites that you visit and are sto on\r\nyour device\'s internal memory.</span></p><div style=\"border: 1pt solid rgb(229, 231, 235); padding: 0cm; --darkreader-inline-border-top: #363b3d; --darkreader-inline-border-right: #363b3d; --darkreader-inline-border-bottom: #363b3d; --darkreader-inline-border-left: #363b3d;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">This service does not\r\nuse these cookies explicitly. However, the app may use third party code and\r\nlibraries that use cookies to collect information and improve their services.\r\nYou have the option to either accept or refuse these cookies and know when a\r\ncookie is being sent to your device. If you choose to refuse our cookies, you\r\nmay not be able to use some portions of this service.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Service Providers<o:p></o:p></span></h5>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">We may employ\r\nthird-party companies and individuals due to the following reasons: To\r\nfacilitate our service To provide the service on our behalf To perform\r\nservice-related services or To assist us in analyzing how our service is used.\r\nWe want to inform users of this service that these third parties have access to\r\nyour personal information. The reason is to perform the tasks assigned to them\r\non our behalf. However, they are obligated not to disclose or use the\r\ninformation for any other purpose.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Security<o:p></o:p></span></h5>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">We value your trust in\r\nproviding us your personal information, thus we are striving to use\r\ncommercially acceptable means of protecting it. But remember that no method of\r\ntransmission over the internet, or method of electronic storage is 100% secure\r\nand reliable, and we cannot guarantee its absolute security.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Link To Other Sites<o:p></o:p></span></h5>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">This service may\r\ncontain links to other sites. If you click on a third-party link, you will be\r\ndirected to that site. Note that these external sites are not operated by us.\r\nTherefore, we strongly advise you to review the privacy policy of these\r\nwebsites. We have no control over and assume no responsibility for the content,\r\nprivacy policies, or practices of any third-party sites or services.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Children\'s Privacy<o:p></o:p></span></h5>\r\n\r\n<p style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">These services do not\r\naddress anyone under the age of 13. We do not knowingly collect personally identifiable\r\ninformation from children under 13. In the case we discover that a child under\r\n13 has provided us with personal information, we immediately delete this from\r\nour servers. If you are a parent or guardian and you are aware that your child\r\nhas provided us with personal information, please contact us so that we will be\r\nable to do necessary actions.<o:p></o:p></span></p>\r\n\r\n<h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span style=\"font-size: 14pt; color: inherit; font-family: inherit; --darkreader-inline-color: inherit;\" data-darkreader-inline-color=\"\">Changes to This Privacy\r\nPolicy</span><br></h5><h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\">We may update our\r\nprivacy policy from time to time. Thus, you are advised to review this page\r\nperiodically for any changes. We will notify you of any changes by posting the\r\nnew privacy policy on this page. These changes are effective immediately after\r\nthey are posted on this page.</h5>\r\n\r\n<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%;\r\nfont-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\">Close<o:p></o:p></span></p><h5 style=\"margin: 0cm 0cm 0.0001pt; border: none; padding: 0cm; --darkreader-inline-border-top: initial; --darkreader-inline-border-right: initial; --darkreader-inline-border-bottom: initial; --darkreader-inline-border-left: initial;\" data-darkreader-inline-border-top=\"\" data-darkreader-inline-border-right=\"\" data-darkreader-inline-border-bottom=\"\" data-darkreader-inline-border-left=\"\"><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;font-family:\" segoe=\"\" ui\",\"sans-serif\";color:black\"=\"\"><o:p></o:p></span></h5>\r\n\r\n</div>\r\n\r\n</div>', '<h1 style=\"text-align: right;\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;\r\nline-height:107%;font-family:\" arial\",\"sans-serif\";mso-ascii-font-family:calibri;=\"\" mso-ascii-theme-font:minor-latin;mso-fareast-font-family:calibri;mso-fareast-theme-font:=\"\" minor-latin;mso-hansi-font-family:calibri;mso-hansi-theme-font:minor-latin;=\"\" mso-bidi-theme-font:minor-bidi;mso-ansi-language:en-gb;mso-fareast-language:=\"\" en-us;mso-bidi-language:ar-sa\"=\"\">سياسة الخصوصية</span><br></h1><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">&nbsp;</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size: 14pt; line-height: 107%; font-family: Arial, \" sans-serif\";\"=\"\">تُستخدم هذه الصفحة لإبلاغ الزوار\r\nبخصوص سياساتنا من خلال جمع المعلومات الشخصية واستخدامها والكشف عنها إذا قرر أي\r\nشخص استخدام خدمتنا</span><span dir=\"LTR\" style=\"font-size: 1rem;\"></span><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\"><span dir=\"LTR\"></span>.</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">&nbsp;</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size: 14pt; line-height: 107%; font-family: Arial, \" sans-serif\";\"=\"\">إذا اخترت استخدام خدمتنا، فإنك توافق\r\nعلى جمع واستخدام المعلومات فيما يتعلق بهذه السياسة. يتم استخدام المعلومات\r\nالشخصية التي نجمعها لتوفير الخدمة وتحسينها. لن نستخدم معلوماتك أو نشاركها مع أي\r\nشخص باستثناء ما هو موضح في سياسة الخصوصية هذه</span><span dir=\"LTR\" style=\"font-size: 1rem;\"></span><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\"><span dir=\"LTR\"></span>.</span><span style=\"font-size: 14pt;\">&nbsp;</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">المصطلحات المستخدمة في سياسة الخصوصية\r\nهذه لها نفس المعاني كما في الشروط والأحكام الخاصة بنا، والتي يمكن الوصول إليها\r\nفي</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;\r\nfont-family:\" arial\",\"sans-serif\";mso-ascii-font-family:calibri;mso-ascii-theme-font:=\"\" minor-latin;mso-hansi-font-family:calibri;mso-hansi-theme-font:minor-latin;=\"\" mso-bidi-font-family:arial;mso-bidi-theme-font:minor-bidi\"=\"\">.(…)</span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">ما لم يتم تحديد خلاف ذلك في سياسة\r\nالخصوصية هذه</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;\r\nline-height:107%\"><span dir=\"LTR\"></span>.</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\">&nbsp;</span><span sans-serif\";=\"\" font-size:=\"\" 14pt;\"=\"\" style=\"font-size: 1rem;\">جمع المعلومات واستخدامها</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">للحصول على تجربة أفضل، أثناء استخدام\r\nخدمتنا، قد نطلب منك تزويدنا ببعض المعلومات الشخصية. سيتم الاحتفاظ بالمعلومات\r\nالتي نطلبها من قبلنا واستخدامها كما هو موضح في سياسة الخصوصية هذه</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size: 14pt; line-height: 107%; font-family: Arial, \" sans-serif\";\"=\"\">يستخدم التطبيق خدمات الطرف الثالث\r\nالتي قد تجمع المعلومات المستخدمة لتحديد هويتك</span><span dir=\"LTR\" style=\"font-size: 1rem;\"></span><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\"><span dir=\"LTR\"></span>.</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\">&nbsp;</span><span style=\"font-size: 14pt;\">تسجيل البيانات</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">نريد أن نعلمك أنه عندما تستخدم\r\nخدمتنا، في حالة حدوث خطأ في التطبيق، نقوم بجمع البيانات والمعلومات (من خلال\r\nمنتجات الطرف الثالث) على هاتفك تسمى بيانات السجل. قد تتضمن بيانات السجل هذه\r\nمعلومات مثل عنوان</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;line-height:107%\"><span dir=\"LTR\"></span> IP </span><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">لبروتوكول الإنترنت الخاص بجهازك، واسم\r\nالجهاز، وإصدار نظام التشغيل، وتكوين التطبيق عند استخدام خدمتنا، ووقت وتاريخ\r\nاستخدامك للخدمة، وإحصائيات أخرى</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.<o:p></o:p></span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">لا تستخدم هذه الخدمة ملفات تعريف\r\nالارتباط هذه بشكل صريح. ومع ذلك، قد يستخدم التطبيق تعليمات برمجية ومكتبات تابعة\r\nلجهة خارجية تستخدم ملفات تعريف الارتباط لجمع المعلومات وتحسين خدماتها. لديك\r\nخيار قبول أو رفض ملفات تعريف الارتباط هذه ومعرفة متى يتم إرسال ملف تعريف\r\nالارتباط إلى جهازك. إذا اخترت رفض ملفات تعريف الارتباط الخاصة بنا، فقد لا تتمكن\r\nمن استخدام بعض أجزاء هذه الخدمة</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.<o:p></o:p></span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size: 14pt; line-height: 107%;\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">&nbsp;</span><span style=\"font-size: 14pt;\">&nbsp;</span><span style=\"font-size: 14pt;\">مقدمي الخدمة</span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">قد نقوم بتوظيف شركات وأفراد خارجيين\r\nللأسباب التالية: لتسهيل خدمتنا لتقديم الخدمة نيابة عنا لأداء الخدمات المتعلقة\r\nبالخدمة أو لمساعدتنا في تحليل كيفية استخدام خدمتنا. نريد إبلاغ مستخدمي هذه\r\nالخدمة بأن هذه الأطراف الثالثة يمكنها الوصول إلى معلوماتك الشخصية. والسبب هو\r\nأداء المهام الموكلة إليهم نيابة عنا. ومع ذلك، فهم ملزمون بعدم الكشف عن\r\nالمعلومات أو استخدامها لأي غرض آخر</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span style=\"font-size: 14pt;\">حماية</span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">نحن نقدر ثقتك في تزويدنا بمعلوماتك\r\nالشخصية، وبالتالي فإننا نسعى جاهدين لاستخدام وسائل مقبولة تجاريًا لحمايتها. لكن\r\nتذكر أنه لا توجد طريقة نقل عب الإنترنت أو طريقة تخزين إلكترونية آمنة وموثوقة\r\nبنسبة 100%، ولا يمكننا ضمان أمانها المطلق</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">&nbsp;</span><span style=\"font-size: 14pt;\">رابط إلى مواقع أخرى</span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">قد تحتوي هذه الخدمة على روابط لمواقع\r\nأخرى. إذا قمت بالنقر فوق رابط جهة خارجية، فسيتم توجيهك إلى هذا الموقع. لاحظ أن\r\nهذه المواقع الخارجية لا يتم تشغيلها من قبلنا. ولذلك ننصحك بشدة بمراجعة سياسة\r\nالخصوصية الخاصة بهذه المواقع. ليس لدينا أي سيطرة ولا نتحمل أي مسؤولية عن\r\nالمحتوى أو سياسات الخصوصية أو الممارسات الخاصة بأي مواقع أو خدمات تابعة لجهات\r\nخارجية</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:14.0pt;\r\nline-height:107%\"><span dir=\"LTR\"></span>.</span><span style=\"font-family: Arial, \" sans-serif\";=\"\" font-size:=\"\" 14pt;\"=\"\">خصوصية الأطفال</span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">هذه الخدمات لا تستهدف أي شخص يقل عمره\r\nعن 13 عامًا. نحن لا نجمع معلومات التعريف الشخصية من الأطفال دون سن 13 عامًا عن\r\nعمد. وفي حالة اكتشافنا أن طفلًا أقل من 13 عامًا قد زودنا بمعلومات شخصية، فإننا\r\nنحذف هذه المعلومات على الفور من خوادمنا. إذا كنت أحد الوالدين أو الوصي وكنت على\r\nعلم بأن طفلك قد زودنا بمعلومات شخصية، فيرجى الاتصال بنا حتى نتمكن من اتخاذ\r\nالإجراءات اللازمة</span><span dir=\"LTR\"></span><span lang=\"EN-GB\" style=\"font-size:\r\n14.0pt;line-height:107%\"><span dir=\"LTR\"></span>.<o:p></o:p></span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">&nbsp;</span><span style=\"font-size: 14pt;\">التغييرات في سياسة الخصوصية هذه</span></p>\r\n\r\n<p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"AR-SA\" dir=\"RTL\" style=\"font-size:14.0pt;line-height:107%;font-family:\" arial\",\"sans-serif\";=\"\" mso-ascii-font-family:calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:=\"\" calibri;mso-hansi-theme-font:minor-latin\"=\"\">قد نقوم بتحديث سياسة الخصوصية الخاصة\r\nبنا من وقت لآخر. لذا ننصحك بمراجعة هذه الصفحة بشكل دوري لمعرفة أي تغييرات.\r\nوسنقوم بإعلامك بأي تغييرات عن طريق نشر سياسة الخصوصية الجديدة على هذه الصفحة.\r\nتسري هذه التغييرات فور نشرها على هذه الصفحة<o:p></o:p></span></p><p class=\"MsoNormal\" align=\"right\" style=\"text-align:right\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;\r\nline-height:107%\"><o:p></o:p></span></p>', 1),
(4, 'About Us', 'حول', 'about-us', '<p class=\"MsoNormal\"><span lang=\"EN-GB\" style=\"font-size:14.0pt;line-height:107%\">An\r\napplication for washing clothes and cloth items. This application provides\r\nwashing, ironing, and home delivery services without the need to go anywhere\r\nelse. Only through the application can you book an appointment in order for the\r\ndelivery to come to you and a list of the prices for washing your clothes will\r\nbe shown to you..<o:p></o:p></span></p>', '<p class=\"MsoNormal\" style=\"text-align: right;\"><span style=\"font-size: 14pt;\">تطبيق من اجل غسل الملابس و الاشياء\r\nالقماش&nbsp; هذا التطبيق يقدم خدمات الغسل و\r\nالكوي و توصيل للمنزل بدون الحاجة للذهاب الى اي مكان اخر فقط من خلال التطبيق\r\nتستطيع حجز موعد من اجل ان ياتيك التوصيل و تضهر لك لائحة باسعار غسيل ملابسك</span><br></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `read_ope` int(11) NOT NULL,
  `write_ope` int(11) NOT NULL,
  `delete_ope` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `module_id`, `read_ope`, `write_ope`, `delete_ope`) VALUES
(1, 3, 4, 1, 0, 0),
(2, 3, 5, 1, 0, 0),
(3, 3, 6, 1, 1, 1),
(4, 3, 1, 0, 0, 0),
(5, 2, 1, 1, 1, 1),
(6, 2, 2, 1, 1, 1),
(7, 2, 3, 1, 1, 1),
(8, 2, 4, 1, 1, 1),
(9, 2, 5, 1, 1, 1),
(10, 2, 6, 1, 1, 1),
(11, 3, 2, 1, 0, 0),
(12, 3, 3, 1, 1, 1),
(13, 4, 2, 1, 1, 1),
(14, 4, 6, 1, 1, 0),
(15, 4, 3, 1, 1, 0),
(16, 5, 4, 1, 1, 1),
(17, 5, 5, 1, 0, 0),
(18, 6, 1, 1, 0, 0),
(19, 6, 4, 1, 1, 1),
(20, 7, 1, 1, 1, 0),
(21, 7, 4, 1, 0, 0),
(22, 7, 5, 1, 1, 0),
(23, 7, 2, 1, 0, 0),
(24, 8, 7, 1, 1, 0),
(25, 8, 5, 1, 0, 0),
(26, 2, 7, 1, 1, 1),
(27, 5, 6, 1, 1, 1),
(28, 8, 6, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`id`, `name`, `url`, `image`, `create_date`, `update_date`) VALUES
(1, 'coffeeday', 'https://evolutiontechnologies.online/coffeeday/', 'coffeedayqrcode.png', '2022-04-24 03:28:47', '2022-04-24 03:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `company` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `report_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `report_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `governorateSlug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `address1` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `giico_job_ref` text COLLATE utf8_unicode_ci NOT NULL,
  `giico_job_serial` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `update_times` int(11) NOT NULL,
  `rev` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `client_ref_no` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `report_doc` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `client_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `qr_image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `qr_token` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `is_allow_feedback` int(11) NOT NULL,
  `is_report_check_mark` int(11) NOT NULL COMMENT '1=>user confidential,2=>download,3=>printable',
  `feedback` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_date` int(11) NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `company`, `report_date`, `expiry_date`, `client_id`, `report_title`, `governorateSlug`, `city_id`, `address1`, `address2`, `department_id`, `giico_job_ref`, `giico_job_serial`, `update_times`, `rev`, `client_ref_no`, `report_doc`, `client_email`, `qr_image`, `qr_token`, `country`, `is_allow_feedback`, `is_report_check_mark`, `feedback`, `status`, `create_date`, `createdby`) VALUES
(1, 'wxit-', '2024-08-16', '2024-11-14', 3, 'jhj', 'jharkhand-', 14, '5K/26A NIT Faridabad 121001, Haryana, (Delhi NCR), India 121001', '5K/26A NIT Faridabad 121001, Haryana, (Delhi NCR), India 121001', 7, 'GIICO-2024-000001', '000001', 0, '', 'Client879', 'reports_FFDDC7693420F4396FFADD8EB149130C.pdf', 'shankar.wxit@gmail.com', '16125630qrcode.png', '68702e142baf1dd810d2754bb84ab93a', 102, 1, 1, '', 1, 2024, 2);

-- --------------------------------------------------------

--
-- Table structure for table `report_history`
--

CREATE TABLE `report_history` (
  `id` int(11) NOT NULL,
  `report_title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `report_id` int(11) NOT NULL,
  `report_doc` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `giico_job_ref` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `update_times` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `feedback` text COLLATE utf8_unicode_ci NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_history`
--

INSERT INTO `report_history` (`id`, `report_title`, `report_id`, `report_doc`, `giico_job_ref`, `update_times`, `expiry_date`, `feedback`, `create_date`) VALUES
(1, 'jhj', 1, 'reports_FFDDC7693420F4396FFADD8EB149130C.pdf', 'GIICO-2024-000001', 0, '2024-11-14', '', '2024-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `signup_temp`
--

CREATE TABLE `signup_temp` (
  `id` bigint(20) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_type` int(11) NOT NULL COMMENT '0=Normal,1=Google,2=Facebook',
  `status` int(11) NOT NULL DEFAULT '0',
  `signup_otp` int(11) NOT NULL,
  `access_token` text NOT NULL,
  `fcm_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signup_temp`
--

INSERT INTO `signup_temp` (`id`, `customer_name`, `email`, `mobile_number`, `password`, `login_type`, `status`, `signup_otp`, `access_token`, `fcm_token`, `created_at`) VALUES
(2, 'Shankar', '', '7717720892', '', 0, 0, 1234, '', '', '2023-09-02 11:30:47'),
(3, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 16:16:54'),
(4, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 16:17:33'),
(5, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 16:40:05'),
(6, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 17:35:32'),
(7, 'alex', '', '8717288098', '', 0, 0, 1234, '', '', '2023-09-02 19:20:30'),
(8, 'anil', '', '89828838752', '', 0, 0, 1234, '', '', '2023-09-02 19:23:04'),
(9, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 19:26:45'),
(10, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 19:36:27'),
(11, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 20:08:36'),
(12, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 20:13:12'),
(13, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 20:32:56'),
(14, 'ghuj', '', '123456789', '', 0, 0, 1234, '', '', '2023-09-02 20:47:46'),
(15, 'ghjj', '', '12345667777', '', 0, 0, 1234, '', '', '2023-09-02 20:56:50'),
(16, 'hjghj', '', '25528842', '', 0, 0, 1234, '', '', '2023-09-02 20:59:25'),
(17, 'rtrtr', '', '56756363', '', 0, 0, 1234, '', '', '2023-09-02 21:01:58'),
(18, 'hjkhjkjhk', '', '525255255252', '', 0, 0, 1234, '', '', '2023-09-02 21:12:05'),
(19, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 21:16:46'),
(20, 'anil', '', '8717828098', '', 0, 0, 1234, '', '', '2023-09-02 21:19:27'),
(21, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-02 21:39:41'),
(22, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 15:24:54'),
(23, 'asaww', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 15:28:19'),
(24, 'ddad', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 15:29:47'),
(25, 'dgdgdggggd', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 15:30:29'),
(26, 'anilq', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 15:41:18'),
(27, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 15:55:18'),
(28, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 16:03:58'),
(29, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 17:39:53'),
(30, 'gfdg', '', '898275474', '', 0, 0, 1234, '', '', '2023-09-03 17:42:44'),
(31, 'kuggugu', '', '48986188', '', 0, 0, 1234, '', '', '2023-09-03 17:46:55'),
(32, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-03 17:56:37'),
(33, 'sfsfsf', '', '58253641', '', 0, 0, 1234, '', '', '2023-09-03 22:44:18'),
(34, 'mitali', '', '7081613025', '', 0, 0, 1234, '', '', '2023-09-04 00:21:54'),
(35, 'mitali', '', '7081613025', '', 0, 0, 1234, '', '', '2023-09-04 00:33:14'),
(36, 'anil', '', '8982838752', '', 0, 0, 1234, '', '', '2023-09-04 09:29:36'),
(37, 'test', '', '1234567890', '', 0, 0, 1234, '', '', '2023-09-04 10:20:57'),
(38, 'test', '', '123456789', '', 0, 0, 1234, '', '', '2023-09-04 10:33:27'),
(39, 'Test Dev', '', '123456789', '', 0, 0, 1234, '', '', '2023-09-04 10:39:57'),
(43, 'abdulaziz', '', '99417776', '', 0, 0, 1234, '', '', '2023-09-04 22:08:13'),
(44, 'Shankar', '', '7717720892', '', 0, 0, 1234, '', '', '2023-09-26 12:13:12'),
(48, 'Shankar', '', '7717720892', '', 0, 0, 1234, '', '', '2023-09-27 15:23:41'),
(49, 'faysal', '', '12345678', '', 0, 0, 1234, '', '', '2023-10-24 11:40:27'),
(50, 'faysal', '', '12345678', '', 0, 0, 1234, '', '', '2023-10-24 11:41:39'),
(52, 'gsia', '', '1677944', '', 0, 0, 1234, '', '', '2023-10-24 11:48:31'),
(53, 'gsia', '', '1677944', '', 0, 0, 1234, '', '', '2023-10-24 11:48:31'),
(54, 'falsh', '', '19784255', '', 0, 0, 1234, '', '', '2023-10-24 11:48:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `governorates`
--
ALTER TABLE `governorates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_history`
--
ALTER TABLE `report_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup_temp`
--
ALTER TABLE `signup_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `governorates`
--
ALTER TABLE `governorates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_history`
--
ALTER TABLE `report_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signup_temp`
--
ALTER TABLE `signup_temp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
