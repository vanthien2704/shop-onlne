-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for shopthethao
CREATE DATABASE IF NOT EXISTS `shopthethao` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `shopthethao`;

-- Dumping structure for table shopthethao.apply
CREATE TABLE IF NOT EXISTS `apply` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `content` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_apply_users` (`user_id`),
  CONSTRAINT `FK_apply_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shopthethao.apply: ~0 rows (approximately)
DELETE FROM `apply`;

-- Dumping structure for table shopthethao.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table shopthethao.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table shopthethao.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `FK_comment_products` (`product_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shopthethao.comment: ~0 rows (approximately)
DELETE FROM `comment`;

-- Dumping structure for table shopthethao.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;

-- Dumping structure for table shopthethao.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `payment` int(1) unsigned NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bills_users` (`user_id`),
  CONSTRAINT `FK_order_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.order: ~0 rows (approximately)
DELETE FROM `order`;

-- Dumping structure for table shopthethao.order_detail
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cart_products` (`product_id`),
  KEY `cart_bill_id_foreign` (`order_id`) USING BTREE,
  CONSTRAINT `FK_order_orderdetail_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `FK_orderdetail_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.order_detail: ~0 rows (approximately)
DELETE FROM `order_detail`;

-- Dumping structure for table shopthethao.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `old_unit_price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  `note` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_products_product_groups` (`group_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_products_product_groups` FOREIGN KEY (`group_id`) REFERENCES `product_groups` (`id`),
  CONSTRAINT `FK_products_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.products: ~17 rows (approximately)
DELETE FROM `products`;
INSERT INTO `products` (`id`, `group_id`, `user_id`, `product_name`, `description`, `quantity`, `unit_price`, `old_unit_price`, `image`, `enable`, `note`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'ÁO BÓNG ĐÁ CHÍNH HÃNG TOTTENHAM HOTSPUR SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8794-101-S', 5, 1990000, 1990000, 'aoTOT.png', 1, '', '2024-12-02 16:24:34', '2025-05-15 06:09:45'),
	(2, 2, 1, 'ÁO BÓNG ĐÁ CHÍNH HÃNG ENGLAND SÂN KHÁCH EURO 2024', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FJ4272-573-S', 10, 1990000, 1990000, 'aoHL.png', 0, ' ', '2024-12-02 16:24:36', '2024-12-17 01:04:33'),
	(3, 2, 1, 'ÁO BÓNG ĐÁ CHÍNH HÃNG LIVERPOOL SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8798-688-S', 6, 1990000, 2589000, 'image-removebg-preview (5).png', 1, ' ', '2024-12-02 16:24:36', '2024-12-02 16:24:50'),
	(4, 1, 1, 'GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 108075-01-39', 99, 2030000, 2259000, 'image-removebg-preview.png', 1, '', '2024-12-02 16:24:39', '2024-12-02 16:24:51'),
	(5, 2, 1, 'ÁO BÓNG ĐÁ CHÍNH HÃNG PARIS SAINT GERMAIN SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8795-411-S', 10, 1990000, 2589000, 'image-removebg-preview (6).png', 1, ' ', '2024-12-02 16:24:37', '2024-12-02 16:24:51'),
	(6, 1, 1, 'GIÀY ĐÁ BANH PUMA ULTRA 5 PRO CAGE TT FORMULA - LAPIS LAZULI/PUMA WHITE/SUNSET GLOW 107889-01', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 107889-01-39', 10, 2789000, 3099000, 'image-removebg(1).png', 1, ' ', '2024-12-02 16:24:38', '2024-12-02 16:24:53'),
	(7, 1, 1, 'GIÀY ĐÁ BANH PUMA FUTURE 7 PRO CAGE TT FORMULA - BLUEMAZING/PUMA WHITE/ELECTRIC PEPPERMINT', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 107937-01-39', 10, 2789000, 3099000, 'image-removebg-1asd(1).png', 1, ' ', '2024-12-02 16:24:43', '2024-12-02 16:24:52'),
	(8, 1, 1, 'GIÀY ĐÁ BÓNG ADIDAS F50 MESSI LEAGUE TF TRIUNFO DORADO - GOLD METALLIC/FOOTWEAR WHITE/CORE BLACK IG9', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IG9282-39', 9, 1950000, 2400000, 'asd.png', 1, ' ', '2024-12-02 16:24:39', '2024-12-02 16:24:54'),
	(9, 1, 1, 'GIÀY ĐÁ BÓNG ADIDAS F50 LEAGUE TF DARK SPARK - CORE BLACK/IRON METAL/GOLD METALLIC IF1337', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IF1337-39', 9, 1950000, 2400000, 'asdasd.png', 1, ' ', '2024-12-02 16:24:41', '2024-12-02 16:24:55'),
	(10, 1, 1, 'GIÀY ĐÁ BÓNG MIZUNO ALPHA ELITE TF MUGEN - LASER BLUE/WHITE/GOLD P1GD246227', 'Nhà cung cấp: MIZUNO\r\n\r\nSKU: P1GD246227-39', 10, 3850000, 4300000, 'mi1.png', 1, ' ', '2024-12-02 16:24:42', '2024-12-02 16:24:54'),
	(11, 1, 1, 'GIÀY ĐÁ BÓNG ZOCKER WINNER ENERGY - RED/YELLOW SNS-008-RED', 'Nhà cung cấp: ZOCKER\r\n\r\nSKU: SNS-008-Red-38', 10, 659000, 659000, 'zke1.png', 1, ' ', '2024-12-02 16:24:40', '2024-12-02 16:24:56'),
	(12, 1, 1, 'GIÀY ĐÁ BÓNG NMS SPIDER - GREEN NEON/WHITE', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: SPI500-38', 10, 559000, 659000, 'nm1.png', 1, ' ', '2024-12-02 16:24:39', '2024-12-02 16:24:55'),
	(13, 1, 3, 'GIÀY ĐÁ BÓNG NMS SPIDER - AQUA BLUE/WHITE', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: SPI300-38', 9, 559000, 659000, 'nm3.png', 1, ' ', '2024-12-02 16:24:45', '2025-05-15 06:09:45'),
	(14, 4, 3, 'BALO NEYMARSPORT FOOTBALL BACKPACK 2024', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: NMSBA24-BL', 10, 249, 249, 'balo1.png', 1, ' ', '2024-12-02 16:24:44', '2024-12-02 16:24:57'),
	(15, 3, 3, 'GĂNG TAY THỦ MÔN NIKE GOALKEEPER GLOVES MATCH MAD BRILLIANCE - BLACK/SUNSET PULSE FJ4862-014', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FJ4862-014-6', 10, 809000, 809000, 'gang1.png', 1, ' ', '2024-12-02 16:24:46', '2024-12-02 16:24:57'),
	(16, 3, 3, 'GĂNG TAY THỦ MÔN ADIDAS GOALKEEPER GLOVES PREDATOR TRAINING MARINERUSH - BRIGHT ROYAL/WHITE', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IA0876-7', 10, 790000, 790000, 'gang2.png', 1, ' ', '2024-12-02 16:24:46', '2024-12-02 16:24:58'),
	(17, 4, 3, 'TÚI GYMSACK KAMITO TA11 WONCUP', 'Nhà cung cấp: KAMITO\r\n\r\nSKU: KMPTUI220140', 9, 2000, 31500, '064d1a5e47124d2a.png', 1, '', '2024-12-02 16:24:47', '2025-05-14 15:35:18');

-- Dumping structure for table shopthethao.product_groups
CREATE TABLE IF NOT EXISTS `product_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.product_groups: ~8 rows (approximately)
DELETE FROM `product_groups`;
INSERT INTO `product_groups` (`id`, `group_name`, `note`, `enable`) VALUES
	(1, 'Thời trang', '', 1),
	(2, 'Đồ gia dụng', '', 1),
	(3, 'Điện tử & Công nghệ', '', 1),
	(4, 'Nhà cửa & Đời sống', '', 1),
	(5, 'Sức khỏe & Làm đẹp', '', 1),
	(6, 'Thực phẩm & Đồ uống', '', 1),
	(7, 'Sách, Văn phòng phẩm & Quà tặng', '', 1),
	(8, 'Thể thao & Dã ngoại', '', 1);

-- Dumping structure for table shopthethao.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shopthethao.role: ~3 rows (approximately)
DELETE FROM `role`;
INSERT INTO `role` (`id`, `rolename`) VALUES
	(1, 'User'),
	(2, 'Supplier'),
	(3, 'Admin');

-- Dumping structure for table shopthethao.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.sessions: ~17 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('2YoAViWwIsh700BUK714QEheaMhHd5BP0YrmoqwC', NULL, '185.218.86.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibXJoRFB2U1dGZlhQQmZIbExWd1pyemp0MEFyMEJnUkFsNGFBaHM4ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747294119),
	('38Rs1y7RtbS4JF7YL3QxQrvyETP6LduY02ki6gXl', NULL, '154.81.156.54', 'curl/7.81.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTm9aZHJ5VkI0S25Nam5oNWlCamJhdHVITm5VVHlwdEpicHRNU0VLdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8yNy43OS4zNi4xNTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747289387),
	('3kJs5VKVc1F6jn0WgTwHi3IkHhbT1u3o3M2edyX3', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTHNIa1dXNVNCMFJHN1ZCaEdsYUVBY09PYWJZc252VHNWbk53UHN3VSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747293793),
	('4NrqpYGlbGpVTHvQMm6N8hJOdKJXoudT4cykNaZb', NULL, '185.16.38.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaWM4YTRrM0t1bmlGQUF6Z2ZXZ0IxbWlNaHJ4bTdicFNNaDJIYWx6TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747290184),
	('9jkZLY3fg5Gk4taf2HMoJcYzqPLLgCN8N3ceOoVc', NULL, '185.16.38.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidE54Yk1SSDNpb21RaURJYWF5S0phczlaWGJBUHcxZ0RwSkNOcnZwdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747287320),
	('9ltWX54o91ZrMPssHrUdPjpQqMlmdSeCUjQYGUOA', NULL, '109.205.213.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWDVndGZETUN6TVVkQkxjNERFWFZQc1NCQUpLN1NCYllDTERPekFDeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747288032),
	('ci9tEcFF5VK4yQEbgNx2t70P5MGBOVkZNBb0J0u2', NULL, '212.107.12.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidEg4SzhwekNUdHVnaEJBcUx4cUdxOUV1SnlrOEdvdW82a0pXaXQ4eCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747293037),
	('dKCa8JXBmtOhYFyCHpEWpCBm7ks5I8hatRFSHvoW', NULL, '178.211.139.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVWhoSGFRNGJkaU1xU3FURlFSbFBsWFgxbDU1ejRiT203MDVkTkZabCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747288132),
	('gC7XPqd1zjR5bg5jqZkEudVt2funQPXKZYAgKGBw', NULL, '154.81.156.35', 'curl/7.81.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDZGZkVaUEh4NGlzbEx2ckRRN0pFa29hdjF6UjV0RGdtWmNaUnh3TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8yNy43OS4zNi4xNTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747288953),
	('m57J0SWRZwiGbUr3DUrClC3x4UVIdWxCjSZgcMHH', NULL, '154.81.156.54', 'curl/7.81.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHF6UVFuaEpZU0J6Y2VEM2F6cUNPdmxIdG1raDhGWGJJenczWnpXSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8yNy43OS4zNi4xNTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747294092),
	('OHhRE5ftSR6ddbhu0VYefWmt8sRR0bVL6SSYNOBR', NULL, '154.81.156.7', 'curl/7.81.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0JtNDgyVE1STHc3cU1rN0gzWmVqcThYQkUwMXI3bE9IVnZzTlQyViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8yNy43OS4zNi4xNTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747290897),
	('pOTDt7OiwCAOqnQX1NncR6mhEsO3NvBLaBPqdYJl', NULL, '178.211.139.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUXNrWm50NEdlNE5KbzczeGM0STFDV2NxSFJZcjhWZ0ZhMWt1d3JuQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747292244),
	('TdBEgUJrMiqrV4khuO6iZ87GtEzpfAsmQlRUlqDn', NULL, '44.220.188.28', 'Mozilla/5.0 (Windows NT 6.2;en-US) AppleWebKit/537.32.36 (KHTML, live Gecko) Chrome/53.0.3090.52 Safari/537.32', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWtwVnF5VDN1MUhQYUJWV3Nwb3ZiUHVITlZkd3ROQ1RtYU55RGN5UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8yNy43OS4zNi4xNTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747288331),
	('Uw3Je2JdWGtOO4XpAs4cdz8FASuYx0ShmlcJ9opQ', NULL, '185.16.38.107', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiV1IxSGZWbmE2OVJDdFk3QTA1dGVUNm1tNzhBV3M5eGtqa3FiQ3c0ciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747292825),
	('vz10TfPN6FwRQkDzIiMKoSYoMOrB0cgwqSquvSkh', NULL, '71.6.199.87', 'Mozilla/5.0 zgrab/0.x', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicDBLWEc1MXo3R09hd0RLeXU5TkxXbEFpSlVjMHdVeHJHYXBSWHhRNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8yNy43OS4zNi4xNTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747289321),
	('xQtXBENtYXJJMXMVU9dl2ElX8CF4eDrndh5KTD4N', NULL, '167.94.138.126', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW1GNGVxcE5ZT1QwTVZKUVFLS3BkWWdVV1FrbHdFcW1GQUFjeVpLSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8yNy43OS4zNi4xNTIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747287279),
	('zjg0BY3WgnpWfH5u0cH9yfoVtvAqYC7LRFQpMoPh', NULL, '185.218.84.178', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSmZWa3cyRThkOXJWY25mUWVqZE5jTGM1VVlmQWVPTmU0OENRbEUxTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747289607);

-- Dumping structure for table shopthethao.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_users_role` (`role_id`),
  CONSTRAINT `FK_users_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `fullname`, `phone`, `email`, `password`, `address`, `role_id`, `enable`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$12$rPMkLT5lRIH9A5q4zWUkyuhE2D1WK8ygpbM6js/iYJtmIP9D3ho.u', 'admin', 3, 1, '2024-12-03 22:01:01', '2025-05-15 06:47:02'),
	(3, 'ncc', 'ncc', 'ncc', 'ncc@gmail.com', '$2y$12$3VLggBNzhWMqFNNiIhpeWegGF5j03j715Df5ela4iiexml2FiAysy', 'ncc', 2, 1, '2025-05-14 16:03:40', '2025-05-15 06:46:55'),
	(4, 'user', 'user', '123456', 'user@gmail.com', '$2y$12$H/Qp6BdGgW3GNEkqevC4z.WQflLnkIMqiXo0gJkioR4K5ee9JADHW', 'user', 2, 1, '2025-05-15 05:46:54', '2025-05-15 07:20:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
