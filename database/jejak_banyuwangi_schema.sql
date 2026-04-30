-- MySQL Full Database Schema and Data for Jejak Banyuwangi
-- Generated from Laravel Migrations and current database state

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- 1. Table structure for table `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', '2026-04-29 13:14:29', '$2y$12$O9itO5P0J8d.qL/9mB1pIuX.qO5vL8vB1/9mB1pIuX.qO5vL8vB1', '2026-04-29 13:14:30', '2026-04-29 13:14:30'),
(2, 'Test User', 'test@example.com', 'user', '2026-04-29 13:14:30', '$2y$12$O9itO5P0J8d.qL/9mB1pIuX.qO5vL8vB1/9mB1pIuX.qO5vL8vB1', '2026-04-29 13:14:30', '2026-04-29 13:14:30');

-- --------------------------------------------------------
-- 2. Table structure for table `packages`
-- --------------------------------------------------------

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `itinerary` json DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `available_from` date DEFAULT NULL,
  `available_until` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `packages` (`id`, `name`, `destination`, `price`, `image`, `description`, `itinerary`, `is_popular`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'De Djawatan', 'Banyuwangi', 200000.00, 'DeDjawatan_Card.jpg', 'Hutan legendaris dengan pepohonan trembesi raksasa yang diselimuti paku tanduk rusa, menciptakan suasana magis layaknya hutan di film Lord of the Rings.', '["08.00 - Meeting Point", "09.00 - Explore Forest", "11.00 - Photo Session", "12.00 - Lunch Break"]', 1, '2026-05-01', '2026-05-10', '2026-04-29 13:14:31', '2026-04-29 13:33:54'),
(2, 'Kawah Ijen', 'Banyuwangi', 250000.00, 'Ijen_card.webp', 'Saksikan fenomena api biru yang langka dan danau asam berwarna toska yang memukau dari puncak gunung berapi yang aktif ini.', '["00.30 - Start Trekking", "02.00 - Blue Fire", "04.00 - Sunrise", "06.00 - Lake View"]', 1, '2026-05-05', '2026-05-15', '2026-04-29 13:14:31', '2026-04-29 13:33:54'),
(3, 'Pulau Merah', 'Banyuwangi', 150000.00, 'PulauMerah_Card.jpg', 'Nikmati sunset terbaik di Banyuwangi dengan latar belakang bukit setinggi 200 meter yang memiliki tanah berwarna merah yang unik.', '["14.00 - Arrival", "15.00 - Beach Activities", "17.30 - Sunset Viewing", "19.00 - Farewell"]', 1, '2026-05-10', '2026-05-20', '2026-04-29 13:14:31', '2026-04-29 13:33:54');

-- --------------------------------------------------------
-- 3. Table structure for table `transactions`
-- --------------------------------------------------------

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `pax_count` int(11) NOT NULL DEFAULT 1,
  `payment_method` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `amount` decimal(15,2) NOT NULL,
  `travel_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_package_id_foreign` (`package_id`),
  CONSTRAINT `transactions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 4. Table structure for table `tickets`
-- --------------------------------------------------------

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_code` varchar(255) NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tickets_ticket_code_unique` (`ticket_code`),
  KEY `tickets_transaction_id_foreign` (`transaction_id`),
  CONSTRAINT `tickets_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 5. Standard Laravel Infrastructure Tables
-- --------------------------------------------------------

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;
