
USE `shopthethao`;

CREATE TABLE IF NOT EXISTS `product_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) NOT NULL,
  `note` varchar(100) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) unsigned NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `old_unit_price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  `note` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_products_product_groups` (`group_id`),
  CONSTRAINT `FK_products_product_groups` FOREIGN KEY (`group_id`) REFERENCES `product_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `enable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `bills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bills_users` (`user_id`),
  CONSTRAINT `FK_bills_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cart` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `bill_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_bill_id_foreign` (`bill_id`),
  KEY `FK_cart_products` (`product_id`),
  CONSTRAINT `FK_cart_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `cart_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contacts` (
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `note` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

INSERT INTO `product_groups` (`id`, `group_name`, `note`, `enable`, `created_at`, `updated_at`) VALUES
	(1, 'Giày Đá Banh', 'Giày đá bóng chất lượng cao cho nhiều mục đích sử dụng.', 1, '2024-12-03 07:20:30', '2024-12-03 07:20:33'),
	(2, 'Quần áo bóng đá', 'Quần áo bóng đá chất lượng cao', 1, '2024-12-03 07:20:31', '2024-12-18 05:05:05'),
	(3, 'Găng tay bóng đá', 'Găng tay thủ môn cho chuyên nghiệp và luyện tập.', 1, '2024-12-03 07:20:32', '2024-12-03 07:20:35'),
	(4, 'Balo', 'Balo bền bỉ cho thể thao và sử dụng hàng ngày.', 1, '2024-12-03 07:20:33', '2024-12-18 04:42:03');

INSERT INTO `products` (`id`, `group_id`, `product_name`, `description`, `quantity`, `unit_price`, `old_unit_price`, `image`, `enable`, `note`, `created_at`, `updated_at`) VALUES
	(1, 2, 'ÁO BÓNG ĐÁ CHÍNH HÃNG TOTTENHAM HOTSPUR SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8794-101-S', 6, 1990000, 1990000, 'aoTOT.png', 1, '', '2024-12-02 23:24:34', '2024-12-18 04:47:28'),
	(2, 2, 'ÁO BÓNG ĐÁ CHÍNH HÃNG ENGLAND SÂN KHÁCH EURO 2024', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FJ4272-573-S', 10, 1990000, 1990000, 'aoHL.png', 0, ' ', '2024-12-02 23:24:36', '2024-12-17 08:04:33'),
	(3, 2, 'ÁO BÓNG ĐÁ CHÍNH HÃNG LIVERPOOL SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8798-688-S', 6, 1990000, 2589000, 'image-removebg-preview (5).png', 1, ' ', '2024-12-02 23:24:36', '2024-12-02 23:24:50'),
	(4, 1, 'GIÀY ĐÁ BANH PUMA FUTURE 7 MATCH TT VOL. UP - WHITE-LUMINOUS BLUE-POISON PINK-FIZZY MELON-BLUEMAZING', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 108075-01-39', 99, 2030000, 2259000, 'image-removebg-preview.png', 1, '', '2024-12-02 23:24:39', '2024-12-02 23:24:51'),
	(5, 2, 'ÁO BÓNG ĐÁ CHÍNH HÃNG PARIS SAINT GERMAIN SÂN NHÀ 2024/25', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FN8795-411-S', 10, 1990000, 2589000, 'image-removebg-preview (6).png', 1, ' ', '2024-12-02 23:24:37', '2024-12-02 23:24:51'),
	(6, 1, 'GIÀY ĐÁ BANH PUMA ULTRA 5 PRO CAGE TT FORMULA - LAPIS LAZULI/PUMA WHITE/SUNSET GLOW 107889-01', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 107889-01-39', 10, 2789000, 3099000, 'image-removebg(1).png', 1, ' ', '2024-12-02 23:24:38', '2024-12-02 23:24:53'),
	(7, 1, 'GIÀY ĐÁ BANH PUMA FUTURE 7 PRO CAGE TT FORMULA - BLUEMAZING/PUMA WHITE/ELECTRIC PEPPERMINT', 'Nhà cung cấp: PUMA\r\n\r\nSKU: 107937-01-39', 10, 2789000, 3099000, 'image-removebg-1asd(1).png', 1, ' ', '2024-12-02 23:24:43', '2024-12-02 23:24:52'),
	(8, 1, 'GIÀY ĐÁ BÓNG ADIDAS F50 MESSI LEAGUE TF TRIUNFO DORADO - GOLD METALLIC/FOOTWEAR WHITE/CORE BLACK IG9', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IG9282-39', 9, 1950000, 2400000, 'asd.png', 1, ' ', '2024-12-02 23:24:39', '2024-12-02 23:24:54'),
	(9, 1, 'GIÀY ĐÁ BÓNG ADIDAS F50 LEAGUE TF DARK SPARK - CORE BLACK/IRON METAL/GOLD METALLIC IF1337', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IF1337-39', 9, 1950000, 2400000, 'asdasd.png', 1, ' ', '2024-12-02 23:24:41', '2024-12-02 23:24:55'),
	(10, 1, 'GIÀY ĐÁ BÓNG MIZUNO ALPHA ELITE TF MUGEN - LASER BLUE/WHITE/GOLD P1GD246227', 'Nhà cung cấp: MIZUNO\r\n\r\nSKU: P1GD246227-39', 10, 3850000, 4300000, 'mi1.png', 1, ' ', '2024-12-02 23:24:42', '2024-12-02 23:24:54'),
	(11, 1, 'GIÀY ĐÁ BÓNG ZOCKER WINNER ENERGY - RED/YELLOW SNS-008-RED', 'Nhà cung cấp: ZOCKER\r\n\r\nSKU: SNS-008-Red-38', 10, 659000, 659000, 'zke1.png', 1, ' ', '2024-12-02 23:24:40', '2024-12-02 23:24:56'),
	(12, 1, 'GIÀY ĐÁ BÓNG NMS SPIDER - GREEN NEON/WHITE', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: SPI500-38', 10, 559000, 659000, 'nm1.png', 1, ' ', '2024-12-02 23:24:39', '2024-12-02 23:24:55'),
	(13, 1, 'GIÀY ĐÁ BÓNG NMS SPIDER - AQUA BLUE/WHITE', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: SPI300-38', 10, 559000, 659000, 'nm3.png', 1, ' ', '2024-12-02 23:24:45', '2024-12-02 23:24:56'),
	(14, 4, 'BALO NEYMARSPORT FOOTBALL BACKPACK 2024', 'Nhà cung cấp: NEYMARSPORT\r\n\r\nSKU: NMSBA24-BL', 10, 249, 249, 'balo1.png', 1, ' ', '2024-12-02 23:24:44', '2024-12-02 23:24:57'),
	(15, 3, 'GĂNG TAY THỦ MÔN NIKE GOALKEEPER GLOVES MATCH MAD BRILLIANCE - BLACK/SUNSET PULSE FJ4862-014', 'Nhà cung cấp: NIKE\r\n\r\nSKU: FJ4862-014-6', 10, 809000, 809000, 'gang1.png', 1, ' ', '2024-12-02 23:24:46', '2024-12-02 23:24:57'),
	(16, 3, 'GĂNG TAY THỦ MÔN ADIDAS GOALKEEPER GLOVES PREDATOR TRAINING MARINERUSH - BRIGHT ROYAL/WHITE', 'Nhà cung cấp: ADIDAS\r\n\r\nSKU: IA0876-7', 10, 790000, 790000, 'gang2.png', 1, ' ', '2024-12-02 23:24:46', '2024-12-02 23:24:58'),
	(17, 4, 'TÚI GYMSACK KAMITO TA11 WONCUP', 'Nhà cung cấp: KAMITO\r\n\r\nSKU: KMPTUI220140', 9, 2000, 31500, '064d1a5e47124d2a.png', 1, ' ', '2024-12-02 23:24:47', '2024-12-02 23:24:58');

INSERT INTO `users` (`id`, `username`, `fullname`, `phone`, `email`, `password`, `address`, `role`, `enable`, `created_at`, `updated_at`) VALUES
	(1, 'thien', 'Thien2', '0123456', 'thien@gmail.com', '$2y$12$0E6zh0WyHamL4BEamphLzuwc8eHCG/J84POiegacoUwBrxjN0XJ2O', 'phu yen', 'admin', 1, '2024-12-04 05:01:01', '2024-12-06 07:12:01');
