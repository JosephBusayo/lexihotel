-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table lexishotel.amenities
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.amenities: ~4 rows (approximately)
INSERT IGNORE INTO `amenities` (`id`, `uid`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(1, '6344f61565f44', 'Free Wifi', 'free-wifi', 'no-image', 1, '2022-10-11 03:50:29', '2022-10-11 03:50:29'),
	(2, '6344f6320c0a2', 'Pets Allowed', 'pets-allowed', 'no-image', 1, '2022-10-11 03:50:58', '2022-10-11 03:50:58'),
	(3, '6344f67d29ef8', 'Non Smoking Rooms', 'non-smoking-rooms', 'no-image', 1, '2022-10-11 03:52:13', '2022-10-11 03:52:13'),
	(4, '6344f6998e423', 'Tea/Coffee Maker in All Room', 'teacoffee-maker-in-all-rooms', 'no-image', 1, '2022-10-11 03:52:41', '2022-10-13 23:07:09');

-- Dumping structure for table lexishotel.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_night` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `checkout_time` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_time` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.bookings: ~5 rows (approximately)
INSERT IGNORE INTO `bookings` (`id`, `uid`, `per_night`, `checkin`, `checkout`, `amount`, `room_id`, `trx`, `customer_id`, `booking_option`, `payment_type`, `duration`, `status`, `created_at`, `updated_at`, `user_id`, `cancel_reason`, `checkout_time`, `checkin_time`) VALUES
	(41, '645006cd10fbf', '20000', '2023-05-01', '2023-05-03', '40000', '4', '9OAOFX11NZ', '21', 'checkin', 'cash,pos', '2', 1, '2023-05-01 18:37:01', '2023-05-01 18:37:01', '5', NULL, NULL, '2023-05-01 19:37:01'),
	(42, '64500bea8b731', '5000', '2023-05-01', '2023-05-09', '35000', '5', 'QQDCV9HQYA', '22', 'checkin', 'transfer,cash,pos', '8', 4, '2023-05-01 18:58:50', '2023-05-01 19:00:52', '5', 'testing', NULL, '2023-05-01 19:58:50'),
	(43, '64500dc0e7250', '5000', '2023-05-02', '2023-05-10', '40000', '6', 'EO3EM33VPR', '27', 'reserved', 'cash', '8', 2, '2023-05-01 19:06:40', '2023-05-01 19:06:40', '5', NULL, NULL, '2023-05-01 20:06:40'),
	(44, '656a803d0811d', '5000', '2023-10-25', '2023-10-28', '15000', '5', 'X5RYWJFE56', '20', 'checkin', 'cash', '3', 1, '2023-12-02 00:54:21', '2023-12-02 00:54:21', '5', NULL, NULL, NULL),
	(45, '656e0cac2ff88', '5000', '2023-10-25', '2023-10-27', '10000', '1', 'FQUS2KGUG4', '21', 'checkin', 'transfer', '2', 1, '2023-10-25 01:09:58', '2023-12-04 17:30:20', '5', NULL, NULL, NULL);

-- Dumping structure for table lexishotel.buildings
CREATE TABLE IF NOT EXISTS `buildings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.buildings: ~0 rows (approximately)
INSERT IGNORE INTO `buildings` (`id`, `uid`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(3, '634830ff48e35', 'Lexispos', 1, '2022-10-13 14:38:39', '2022-10-13 14:38:39');

-- Dumping structure for table lexishotel.business_days
CREATE TABLE IF NOT EXISTS `business_days` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `current_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.business_days: ~0 rows (approximately)
INSERT IGNORE INTO `business_days` (`id`, `current_date`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
	(1, '2023-10-25 01:09:58', '1', 1, '2023-10-27 21:30:57', '2023-10-28 00:09:58');

-- Dumping structure for table lexishotel.cashes
CREATE TABLE IF NOT EXISTS `cashes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.cashes: ~0 rows (approximately)

-- Dumping structure for table lexishotel.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.categories: ~4 rows (approximately)
INSERT IGNORE INTO `categories` (`id`, `uid`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`, `price`) VALUES
	(4, '6344eb5644833', 'Suite', 'suite', 'no-image', 1, '2022-10-11 03:04:38', '2022-10-12 15:36:47', '5000'),
	(5, '6346ed36d077c', 'vip', 'vip', 'no-image', 1, '2022-10-12 15:37:10', '2022-10-12 15:37:10', '15000'),
	(6, '6346ed59ba504', 'Test', 'test', 'no-image', 0, '2022-10-12 15:37:45', '2022-10-12 15:37:45', '2000'),
	(7, '63472293e95c4', 'vvip', 'vvip', 'no-image', 1, '2022-10-12 19:24:51', '2022-10-12 19:24:51', '20000');

-- Dumping structure for table lexishotel.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.customers: ~10 rows (approximately)
INSERT IGNORE INTO `customers` (`id`, `uid`, `name`, `mobile`, `address`, `status`, `created_at`, `updated_at`) VALUES
	(18, '64234f42c57e7', 'Demola Alaofin', '+2349035355945', 'Gadson', 0, '2023-03-28 19:34:10', '2023-03-28 19:34:10'),
	(19, '64235318b3d06', 'Erik Joshua', '09055225552', NULL, 0, '2023-03-28 19:50:32', '2023-03-28 19:50:32'),
	(20, '643fae931f542', 'Damilola', '911', NULL, 0, '2023-04-19 08:04:19', '2023-04-19 08:04:19'),
	(21, '643fb2841363b', 'Damilola Ololade', '24478776666', NULL, 0, '2023-04-19 08:21:08', '2023-04-19 08:21:08'),
	(22, '643fb3f06b816', 'dwcsaddfcsafas', '24478776666', NULL, 0, '2023-04-19 08:27:12', '2023-04-19 08:27:12'),
	(23, '643fb7c4e359a', 'dwcsaddfcsafaset', '911', NULL, 0, '2023-04-19 08:43:32', '2023-04-19 08:43:32'),
	(24, '643fbe737d63a', 'vhmjfj', '911', NULL, 0, '2023-04-19 09:12:03', '2023-04-19 09:12:03'),
	(25, '644c396621b55', 'Demola', '24478776666', 'Gadson', 0, '2023-04-28 21:23:50', '2023-04-28 21:23:50'),
	(26, '645004ff0788f', 'vbsw5y3esg', '911', NULL, 0, '2023-05-01 18:29:19', '2023-05-01 18:29:19'),
	(27, '64500dc0a17a3', 'David', '14253645', NULL, 0, '2023-05-01 19:06:40', '2023-05-01 19:06:40');

-- Dumping structure for table lexishotel.debts
CREATE TABLE IF NOT EXISTS `debts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_cleared` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cleared_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cleared` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.debts: ~3 rows (approximately)
INSERT IGNORE INTO `debts` (`id`, `uid`, `amount`, `tracking_no`, `user_id`, `customer_id`, `amount_paid`, `date_cleared`, `cleared_by`, `cleared`, `created_at`, `updated_at`) VALUES
	(17, '645006ccb326e', '40000', '9OAOFX11NZ', '5', '21', '25000', '2023-05-01 18:37:01', NULL, 0, '2023-05-01 18:37:00', '2023-05-01 18:37:01'),
	(18, '64500bea340f4', '35000', 'QQDCV9HQYA', '5', '22', '30000', '2023-05-01 18:58:50', NULL, 0, '2023-05-01 18:58:50', '2023-05-01 18:58:50'),
	(19, '64500dc077bda', '40000', 'EO3EM33VPR', '5', '27', '35000', '2023-05-01 19:06:40', NULL, 0, '2023-05-01 19:06:40', '2023-05-01 19:06:40');

-- Dumping structure for table lexishotel.discounts
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.discounts: ~0 rows (approximately)
INSERT IGNORE INTO `discounts` (`id`, `uid`, `amount`, `tracking_no`, `user_id`, `customer_id`, `created_at`, `updated_at`) VALUES
	(23, '64500bea804d2', '5000', 'QQDCV9HQYA', '5', '22', '2023-05-01 18:58:50', '2023-05-01 18:58:50');

-- Dumping structure for table lexishotel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table lexishotel.floors
CREATE TABLE IF NOT EXISTS `floors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.floors: ~2 rows (approximately)
INSERT IGNORE INTO `floors` (`id`, `uid`, `name`, `building_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, '634807ab6aada', 'floor 1', '3', 1, '2022-10-13 11:42:19', '2022-10-13 23:06:36'),
	(4, '6348313a674d0', 'Floor 2', '3', 1, '2022-10-13 14:39:38', '2022-10-13 14:39:38');

-- Dumping structure for table lexishotel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.migrations: ~27 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_08_29_141315_create_warehouses_table', 1),
	(6, '2022_08_31_005836_create_products_table', 1),
	(7, '2022_08_31_234915_create_transactions_table', 1),
	(8, '2022_10_11_012613_create_categories_table', 2),
	(9, '2022_10_11_042559_create_amenities_table', 3),
	(10, '2022_10_11_052840_create_permission_tables', 4),
	(11, '2022_10_11_163600_add_username_to_users_table', 5),
	(12, '2022_10_12_150117_create_rooms_table', 6),
	(13, '2022_10_12_163029_add_price_to_categories_table', 7),
	(14, '2022_10_13_114135_create_buildings_table', 8),
	(15, '2022_10_13_114655_create_floors_table', 8),
	(16, '2022_10_13_125215_add_room_to_rooms_table', 9),
	(17, '2022_10_17_084537_add_intercom_mobile_to_rooms_table', 10),
	(18, '2022_10_19_110318_create_bookings_table', 11),
	(19, '2022_10_19_111108_create_customers_table', 11),
	(20, '2022_10_19_111543_create_payments_table', 11),
	(21, '2022_10_19_123208_add_is_booked_to_rooms_table', 12),
	(22, '2022_10_21_195743_create_system_details_table', 13),
	(23, '2023_02_14_125637_create_discounts_table', 14),
	(24, '2023_02_14_131335_create_debts_table', 15),
	(25, '2023_02_14_131841_create_pos_table', 16),
	(26, '2023_02_14_131926_create_cashes_table', 16),
	(27, '2023_02_14_132012_create_transfers_table', 16),
	(28, '2023_10_27_214518_create_business_days_table', 17);

-- Dumping structure for table lexishotel.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table lexishotel.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.model_has_roles: ~5 rows (approximately)
INSERT IGNORE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 5),
	(1, 'App\\Models\\User', 6),
	(1, 'App\\Models\\User', 7);

-- Dumping structure for table lexishotel.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.password_resets: ~0 rows (approximately)

-- Dumping structure for table lexishotel.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.payments: ~15 rows (approximately)
INSERT IGNORE INTO `payments` (`id`, `uid`, `name`, `trx`, `amount`, `booking_id`, `customer_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
	(100, '645006cd1eda6', 'pos', '645006cd10fbf', '10000', '41', '21', '5', 0, '2023-05-01 18:37:01', '2023-05-01 18:37:01'),
	(101, '645006cd3eff1', 'cash', '645006cd10fbf', '15000', '41', '21', '5', 0, '2023-05-01 18:37:01', '2023-05-01 18:37:01'),
	(102, '645006cd517e5', 'transfer', '645006cd10fbf', '0', '41', '21', '5', 0, '2023-05-01 18:37:01', '2023-05-01 18:37:01'),
	(103, '64500beaaeaf3', 'pos', '64500bea8b731', '10000', '42', '22', '5', 0, '2023-05-01 18:58:50', '2023-05-01 18:58:50'),
	(104, '64500beadd240', 'cash', '64500bea8b731', '10000', '42', '22', '5', 0, '2023-05-01 18:58:51', '2023-05-01 18:58:51'),
	(105, '64500beb26d48', 'transfer', '64500bea8b731', '10000', '42', '22', '5', 0, '2023-05-01 18:58:51', '2023-05-01 18:58:51'),
	(106, '64500dc10e9cc', 'pos', '64500dc0e7250', '0', '43', '27', '5', 0, '2023-05-01 19:06:41', '2023-05-01 19:06:41'),
	(107, '64500dc13aee4', 'cash', '64500dc0e7250', '35000', '43', '27', '5', 0, '2023-05-01 19:06:41', '2023-05-01 19:06:41'),
	(108, '64500dc1589c5', 'transfer', '64500dc0e7250', '0', '43', '27', '5', 0, '2023-05-01 19:06:41', '2023-05-01 19:06:41'),
	(109, '656a803d0e653', 'pos', '656a803d0811d', '0', '44', '20', '5', 0, '2023-12-02 00:54:21', '2023-12-02 00:54:21'),
	(110, '656a803d14cf2', 'cash', '656a803d0811d', '15000', '44', '20', '5', 0, '2023-12-02 00:54:21', '2023-12-02 00:54:21'),
	(111, '656a803d1769e', 'transfer', '656a803d0811d', '0', '44', '20', '5', 0, '2023-12-02 00:54:21', '2023-12-02 00:54:21'),
	(112, '656e0cac34eb3', 'pos', '656e0cac2ff88', '0', '45', '21', '5', 0, '2023-12-04 17:30:20', '2023-12-04 17:30:20'),
	(113, '656e0cac37fa8', 'cash', '656e0cac2ff88', '0', '45', '21', '5', 0, '2023-12-04 17:30:20', '2023-12-04 17:30:20'),
	(114, '656e0cac3b3ee', 'transfer', '656e0cac2ff88', '10000', '45', '21', '5', 0, '2023-12-04 17:30:20', '2023-12-04 17:30:20');

-- Dumping structure for table lexishotel.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.permissions: ~46 rows (approximately)
INSERT IGNORE INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'create category', 'web', '2022-10-11 12:36:23', '2022-10-11 12:36:23'),
	(2, 'edit category', 'web', '2022-10-11 12:36:23', '2022-10-11 12:36:23'),
	(3, 'delete category', 'web', '2022-10-11 12:36:23', '2022-10-11 12:36:23'),
	(4, 'create amenity', 'web', '2022-10-11 12:36:23', '2022-10-11 12:36:23'),
	(5, 'edit amenity', 'web', '2022-10-11 12:36:23', '2022-10-11 12:36:23'),
	(6, 'delete amenity', 'web', '2022-10-11 12:36:24', '2022-10-11 12:36:24'),
	(7, 'building-read', 'web', '2023-03-09 08:16:18', '2023-03-09 08:16:18'),
	(8, 'building-create', 'web', '2023-03-09 08:16:18', '2023-03-09 08:16:18'),
	(9, 'building-edit', 'web', '2023-03-09 08:16:18', '2023-03-09 08:16:18'),
	(10, 'building-delete', 'web', '2023-03-09 08:16:18', '2023-03-09 08:16:18'),
	(11, 'floor-read', 'web', '2023-03-09 08:16:18', '2023-03-09 08:16:18'),
	(12, 'floor-create', 'web', '2023-03-09 08:16:18', '2023-03-09 08:16:18'),
	(13, 'floor-edit', 'web', '2023-03-09 08:16:18', '2023-03-09 08:16:18'),
	(14, 'floor-delete', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(15, 'category-read', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(16, 'category-create', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(17, 'category-edit', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(18, 'category-delete', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(19, 'amenity-read', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(20, 'amenity-create', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(21, 'amenity-edit', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(22, 'amenity-delete', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(23, 'room-read', 'web', '2023-03-09 08:16:19', '2023-03-09 08:16:19'),
	(24, 'room-edit', 'web', '2023-03-09 08:16:20', '2023-03-09 08:16:20'),
	(25, 'room-create', 'web', '2023-03-09 08:16:20', '2023-03-09 08:16:20'),
	(26, 'room-delete', 'web', '2023-03-09 08:16:42', '2023-03-09 08:16:42'),
	(27, 'frontdesk-read', 'web', '2023-03-09 08:16:42', '2023-03-09 08:16:42'),
	(28, 'frontdesk-book', 'web', '2023-03-09 08:16:42', '2023-03-09 08:16:42'),
	(29, 'booking', 'web', '2023-03-09 08:16:42', '2023-03-09 08:16:42'),
	(30, 'discount-report', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(31, 'debt-report', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(32, 'cancel-report', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(33, 'reserve-report', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(34, 'vacant-report', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(35, 'user-read', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(36, 'user-create', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(37, 'user-edit', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(38, 'user-delete', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(39, 'roles-read', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(40, 'roles-edit', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(41, 'roles-delete', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(42, 'roles-create', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(43, 'system-read', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(44, 'system-edit', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(45, 'dashboard', 'web', '2023-03-09 08:16:43', '2023-03-09 08:16:43'),
	(46, 'print-receipt', 'web', '2023-03-09 08:16:44', '2023-03-09 08:16:44');

-- Dumping structure for table lexishotel.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table lexishotel.pos
CREATE TABLE IF NOT EXISTS `pos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.pos: ~0 rows (approximately)

-- Dumping structure for table lexishotel.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '10',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.products: ~0 rows (approximately)

-- Dumping structure for table lexishotel.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.roles: ~2 rows (approximately)
INSERT IGNORE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2022-10-11 12:36:22', '2022-10-11 12:36:22'),
	(2, 'cashier', 'web', '2022-10-11 13:51:03', '2022-10-11 13:51:03');

-- Dumping structure for table lexishotel.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.role_has_permissions: ~48 rows (approximately)
INSERT IGNORE INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
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
	(4, 2),
	(5, 2);

-- Dumping structure for table lexishotel.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amenities` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `building_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intercom_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_booked` tinyint(1) NOT NULL DEFAULT '0',
  `is_clean` tinyint(1) NOT NULL DEFAULT '1',
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.rooms: ~7 rows (approximately)
INSERT IGNORE INTO `rooms` (`id`, `uid`, `name`, `category_id`, `image`, `amenities`, `price`, `description`, `status`, `user_id`, `created_at`, `updated_at`, `building_id`, `floor_id`, `intercom_mobile`, `is_booked`, `is_clean`, `is_available`) VALUES
	(1, '6346e7dd91f49', 'Room 1', '4', NULL, '["3","1"]', '5000', 'This is very good', 1, '5', '2022-10-12 15:14:21', '2023-12-04 17:30:20', '3', '4', NULL, 1, 1, 0),
	(2, '6346f381e24bd', 'Room 67', '5', '6346f8413ded41665595457.png', '["3","2","1"]', '15000', NULL, 1, '5', '2022-10-12 16:04:01', '2023-02-14 13:12:29', '3', '4', NULL, 0, 1, 1),
	(3, '6346fa0d06c55', 'Room 21', '4', NULL, '["3","1"]', '5000', NULL, 1, '5', '2022-10-12 16:31:57', '2023-05-01 10:05:58', '3', '4', NULL, 0, 1, 1),
	(4, '634724ea3f9ba', 'Room 5', '7', NULL, '["3","2","1"]', '20000', NULL, 1, '5', '2022-10-12 19:34:50', '2023-05-01 18:37:01', '3', '1', NULL, 1, 1, 0),
	(5, '63480d152686f', 'Room 105', '4', NULL, '["4","3","1"]', '5000', 'test 1', 1, '5', '2022-10-13 12:05:25', '2023-12-02 00:54:21', '3', '1', NULL, 1, 1, 0),
	(6, '6348a88a4b44b', 'Room 112', '4', NULL, '["4","2","1"]', '5000', NULL, 1, '5', '2022-10-13 23:08:42', '2023-05-01 19:06:41', '3', '1', NULL, 2, 1, 1),
	(7, '634d1ae16eb1d', 'Room 3', '7', NULL, '["4","3","2","1"]', '20000', NULL, 1, '7', '2022-10-17 08:05:37', '2022-10-26 19:46:03', '3', '4', '09035355945', 0, 1, 1);

-- Dumping structure for table lexishotel.system_details
CREATE TABLE IF NOT EXISTS `system_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.system_details: ~0 rows (approximately)
INSERT IGNORE INTO `system_details` (`id`, `uid`, `name`, `mobile`, `logo`, `checkout_time`, `created_at`, `updated_at`) VALUES
	(1, '63f6c6e71182f', 'Lexispos', '09055225552', '63f6c6e70826b1677117159.png', '14:51', '2023-02-23 00:52:39', '2023-02-23 00:52:39');

-- Dumping structure for table lexishotel.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.transactions: ~0 rows (approximately)

-- Dumping structure for table lexishotel.transfers
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.transfers: ~0 rows (approximately)

-- Dumping structure for table lexishotel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.users: ~4 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `uid`, `name`, `gender`, `is_admin`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `username`, `image`) VALUES
	(1, '63440d8c5d22a', 'Ashleigh Donnelly', 'made', 1, 'jordy.roob@example.org', '2022-10-10 11:18:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'pdpRPM0R72ngZY4WVV8J4g2rC0HjjikyTl8ny0teE9Q0UNKSDdpG5K8GYR2M', '2022-10-10 11:18:20', '2022-10-12 13:29:20', 'boss', '6346cea3f21931665584803.jpg'),
	(5, '6346bf9ee6667', 'Demola Alaofin', NULL, 1, 'wapmastaz7@gmail.com', NULL, '$2y$10$dWQeE54lKzYSiopfB3Srtu0e2fKhwMtFHHkgxaB4qtmIeND.piEYC', 1, NULL, '2022-10-12 12:22:38', '2022-10-12 12:22:38', 'gm', '6346bf9d65a571665580957.png'),
	(6, '634725cf61e56', 'Test', NULL, 1, 'test@gmail.com', NULL, '$2y$10$WE4k5u0rAU73NXSlkInRD.I2x.qPCHG5B2XpypWsAVqXkES6/VdhG', 1, NULL, '2022-10-12 19:38:39', '2022-10-12 19:38:39', 'gm', NULL),
	(7, '6348ad12414d0', 'James Bond', NULL, 1, NULL, NULL, '$2y$10$oARSoXUY9peI2Jxst0glUeX7/7Q.6XF2JDVxaP3uNQfUIDltrG47W', 1, NULL, '2022-10-13 23:28:02', '2022-10-13 23:28:02', 'james007', NULL);

-- Dumping structure for table lexishotel.warehouses
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lexishotel.warehouses: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
