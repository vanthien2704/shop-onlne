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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shopthethao.apply: ~0 rows (approximately)
DELETE FROM `apply`;
INSERT INTO `apply` (`id`, `user_id`, `name`, `email`, `phone`, `content`, `date`, `status`) VALUES
	(3, 4, 'Nguyễn Văn A', 'user@gmail.com', '0123456', 'Ứng tuyển làm nhà cung cấp', '2025-05-15 14:08:20', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.order: ~0 rows (approximately)
DELETE FROM `order`;
INSERT INTO `order` (`id`, `name`, `address`, `phone`, `email`, `order_date`, `total`, `user_id`, `payment`, `status`, `created_at`, `updated_at`) VALUES
	(13, 'thien', 'phu yen', '0123456', 'thien@gmail.com', '2025-05-15', 1990000, 4, 0, 2, '2025-05-15 14:01:41', '2025-05-15 14:01:41');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopthethao.order_detail: ~0 rows (approximately)
DELETE FROM `order_detail`;
INSERT INTO `order_detail` (`id`, `product_id`, `unit_price`, `quantity`, `total_price`, `order_id`) VALUES
	(14, 1, 1990000, 1, 1990000, 13);

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
	(1, 8, 3, 'ÁO BÓNG ĐÁ CHÍNH HÃNG TOTTENHAM HOTSPUR SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8794-101-S', 5, 1990000, 1990000, 'aoTOT.png', 1, '', '2024-12-02 16:24:34', '2025-05-15 06:09:45'),
	(2, 8, 3, 'ÁO BÓNG ĐÁ CHÍNH HÃNG ENGLAND SÂN KHÁCH EURO 2024', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FJ4272-573-S', 10, 1990000, 1990000, 'aoHL.png', 1, ' ', '2024-12-02 16:24:36', '2024-12-17 01:04:33'),
	(3, 8, 3, 'ÁO BÓNG ĐÁ CHÍNH HÃNG LIVERPOOL SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8798-688-S', 6, 1990000, 2589000, 'image-removebg-preview (5).png', 1, ' ', '2024-12-02 16:24:36', '2024-12-02 16:24:50'),
	(4, 8, 3, 'GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 108075-01-39', 99, 2030000, 2259000, 'image-removebg-preview.png', 1, '', '2024-12-02 16:24:39', '2024-12-02 16:24:51'),
	(5, 8, 3, 'ÁO BÓNG ĐÁ CHÍNH HÃNG PARIS SAINT GERMAIN SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8795-411-S', 10, 1990000, 2589000, 'image-removebg-preview (6).png', 1, ' ', '2024-12-02 16:24:37', '2024-12-02 16:24:51'),
	(6, 8, 3, 'GIÀY ĐÁ BANH PUMA ULTRA 5 PRO CAGE TT FORMULA - LAPIS LAZULI/PUMA WHITE/SUNSET GLOW 107889-01', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 107889-01-39', 10, 2789000, 3099000, 'image-removebg(1).png', 1, ' ', '2024-12-02 16:24:38', '2024-12-02 16:24:53'),
	(7, 8, 3, 'GIÀY ĐÁ BANH PUMA FUTURE 7 PRO CAGE TT FORMULA - BLUEMAZING/PUMA WHITE/ELECTRIC PEPPERMINT', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 107937-01-39', 10, 2789000, 3099000, 'image-removebg-1asd(1).png', 1, ' ', '2024-12-02 16:24:43', '2024-12-02 16:24:52'),
	(8, 8, 3, 'GIÀY ĐÁ BÓNG ADIDAS F50 MESSI LEAGUE TF TRIUNFO DORADO - GOLD METALLIC/FOOTWEAR WHITE/CORE BLACK IG9', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IG9282-39', 9, 1950000, 2400000, 'asd.png', 1, ' ', '2024-12-02 16:24:39', '2024-12-02 16:24:54'),
	(9, 8, 3, 'GIÀY ĐÁ BÓNG ADIDAS F50 LEAGUE TF DARK SPARK - CORE BLACK/IRON METAL/GOLD METALLIC IF1337', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IF1337-39', 9, 1950000, 2400000, 'asdasd.png', 1, ' ', '2024-12-02 16:24:41', '2024-12-02 16:24:55'),
	(10, 8, 3, 'GIÀY ĐÁ BÓNG MIZUNO ALPHA ELITE TF MUGEN - LASER BLUE/WHITE/GOLD P1GD246227', 'Nhà cung cấp: MIZUNO\r\n\r\nSKU: P1GD246227-39', 10, 3850000, 4300000, 'mi1.png', 1, ' ', '2024-12-02 16:24:42', '2024-12-02 16:24:54'),
	(11, 8, 3, 'GIÀY ĐÁ BÓNG ZOCKER WINNER ENERGY - RED/YELLOW SNS-008-RED', 'Nhà cung cấp: ZOCKER\r\n\r\nSKU: SNS-008-Red-38', 10, 659000, 659000, 'zke1.png', 1, ' ', '2024-12-02 16:24:40', '2024-12-02 16:24:56'),
	(12, 8, 3, 'GIÀY ĐÁ BÓNG NMS SPIDER - GREEN NEON/WHITE', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: SPI500-38', 10, 559000, 659000, 'nm1.png', 1, ' ', '2024-12-02 16:24:39', '2024-12-02 16:24:55'),
	(13, 8, 3, 'GIÀY ĐÁ BÓNG NMS SPIDER - AQUA BLUE/WHITE', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: SPI300-38', 9, 559000, 659000, 'nm3.png', 1, ' ', '2024-12-02 16:24:45', '2025-05-15 06:09:45'),
	(14, 8, 3, 'BALO NEYMARSPORT FOOTBALL BACKPACK 2024', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: NMSBA24-BL', 10, 249, 249, 'balo1.png', 1, ' ', '2024-12-02 16:24:44', '2024-12-02 16:24:57'),
	(15, 8, 3, 'GĂNG TAY THỦ MÔN NIKE GOALKEEPER GLOVES MATCH MAD BRILLIANCE - BLACK/SUNSET PULSE FJ4862-014', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FJ4862-014-6', 10, 809000, 809000, 'gang1.png', 1, ' ', '2024-12-02 16:24:46', '2024-12-02 16:24:57'),
	(16, 8, 3, 'GĂNG TAY THỦ MÔN ADIDAS GOALKEEPER GLOVES PREDATOR TRAINING MARINERUSH - BRIGHT ROYAL/WHITE', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IA0876-7', 10, 790000, 790000, 'gang2.png', 1, ' ', '2024-12-02 16:24:46', '2024-12-02 16:24:58'),
	(17, 8, 3, 'TÚI GYMSACK KAMITO TA11 WONCUP', 'Nhà cung cấp: KAMITO\r\n\r\nSKU: KMPTUI220140', 9, 2000, 31500, '064d1a5e47124d2a.png', 1, '', '2024-12-02 16:24:47', '2025-05-14 15:35:18');

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

-- Dumping data for table shopthethao.role: ~2 rows (approximately)
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

-- Dumping data for table shopthethao.sessions: ~13 rows (approximately)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('23iCRaaOadqwQ6iFSrKZ2SMoIUukr4CpbKhn77Kz', NULL, '179.43.180.114', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiejF4TXVTN3BFemg4eEo5YXRjcFBFSklubDdTbm9keEVxb0EyN3JVTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747754981),
	('4Q27SSjS1y2AWcPY142DyCBVdoBxIKfoAGjRtJhr', NULL, '89.42.231.140', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiRzRtVXFVWXhjbHNwTTh6Q2phekRmNTFhTnY1MDZ3T0NhUldDTHJuaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747757855),
	('D6ZnwNbgQ9WwCrcNLQcZ633XIYCvyJtZ7Lc51Q6i', NULL, '204.76.203.206', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS1ZIT0FCVzd1ME40ZXhZYWVvNFQ2TVFYNHVBV2NxY0s3QjJHS3oyRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747755529),
	('dx0HU9l4ErlDGpJp8HOBoopXIl3HZBSwWye5Jz1s', NULL, '14.233.95.214', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWJmT0Y2YlliYjFBNnBjN2pTYmdxWk1NdlprSU45N3FRaUlBUGlXZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly92YW50aGllbi5kZG5zLm5ldCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747757810),
	('eJDyHx5uLx0lin3ZQQ32tnFPsyfwWQ1GhopQksQg', NULL, '204.76.203.206', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoic3pyQVVXMDFsNjM0RjExY0kwdnVHOTBORkhjWURCS25sa3Z1QnpYbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747753543),
	('KtxPkSeu3LfkiSfG1s8Zuckxb0fDmcUNN8a6Y2pM', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTUNva2RjZDFjRXEwZ0NjMUZRVDE0ZVVKV0QwRXcwazllRjJ3REY2aSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3QvYWRtaW4vYWNjb3VudCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1747759270),
	('mOJerPCGNTTFrJzO2dt3c4tNoUutRfuPYMhGpSx1', NULL, '204.76.203.212', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMmFva1ptWUc3R0hSaGx5aXNzQkxpMTY2QlFPWlNhM2hhUUdYZDhweSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747756532),
	('qHGAbgjdr7wEwMEydp9OewUZDe71lMvNI2Y3H361', NULL, '204.76.203.219', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTlV5VUp3Y1MyUWplU3BJZllBM2dnRnVidE9FeWhONVptUmU5RGg0YiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747755502),
	('RpRbUv6of6zUfc5jwv4wzcamBCauCu7gtwge4d4k', NULL, '204.76.203.219', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZ09ITFRlSVRBMzFNcnJ4VmhqdmRUdXRxSVc4bWV3bmpYVFhqSHl0TCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747754371),
	('S2bJcH6OZAGaYF5Dule738ZbELwCQ9iBkAzbx0Ho', NULL, '204.76.203.212', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieDAzb3l3dmJCNEllNnlIcWJEd3RBaVlzT1QyRXZMTFBYZFRJSnczSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747754936),
	('sI8aAqeuzNqlCXURMtkJdSC9uv5XPS3LwkDz2sf7', NULL, '178.211.139.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWU5pTW9xeGh0ZmZpdmlHd0pVWHFRNjBuek1kb2dPaTZwM0Q5V1pKNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747753477),
	('T1cBVCwCbZwC21QP0lrV2evSBXisPSWyUvyvToQJ', NULL, '212.107.12.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQjhwWENmNTVOWFVxcjFJZDB4bWxpZ01zdUJqZ3lyTUNZcjdpcm40ZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747756822),
	('y2oqUi0TqTfSrHt2O9WWUO3DPWihGh3mJ2Em4Cp6', NULL, '109.205.213.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36 Edg/90.0.818.46', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS0tFRFZlM2xpa1pmR2piTlFNcGpUdW95QnlnMmRTNGUySkw3QWZ5VCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747756662);

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
	(4, 'user', 'user', '123456', 'user@gmail.com', '$2y$12$H/Qp6BdGgW3GNEkqevC4z.WQflLnkIMqiXo0gJkioR4K5ee9JADHW', 'user', 1, 1, '2025-05-15 05:46:54', '2025-05-15 07:20:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
