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

-- Dumping structure for table base-template.bank
CREATE TABLE IF NOT EXISTS `bank` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table base-template.bank: ~18 rows (approximately)
INSERT INTO `bank` (`id`, `nama_bank`, `created_at`, `updated_at`) VALUES
	(1, 'BANK RAKYAT INDONESIA', NULL, NULL),
	(2, 'BANK MANDIRI', NULL, NULL),
	(3, 'BANK NEGARA INDONESIA', NULL, NULL),
	(4, 'BANK TABUNGAN NEGARA', NULL, NULL),
	(5, 'BANK DANAMON INDONESIA', NULL, NULL),
	(6, 'BANK PERMATA', NULL, NULL),
	(7, 'BANK CENTRAL ASIA', NULL, NULL),
	(8, 'BANK MAYBANK INDONESIA', NULL, NULL),
	(9, 'BANK CIMB NIAGA', NULL, NULL),
	(10, 'BANK UOB INDONESIA', NULL, NULL),
	(11, 'BANK OCBC NISP', NULL, NULL),
	(12, 'BANK MAYAPADA INTERNATIONAL', NULL, NULL),
	(13, 'BANK MEGA', NULL, NULL),
	(14, 'BANK KEB HANA INDONESIA', NULL, NULL),
	(15, 'BANK JAGO', NULL, NULL),
	(16, 'BANK SYARIAH INDONESIA', NULL, NULL),
	(17, 'BANK BCA SYARIAH', NULL, NULL),
	(18, 'BANK MEGA SYARIAH', NULL, NULL);

-- Dumping structure for table base-template.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table base-template.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_resets_table', 1),
	(2, '2020_12_17_055226_create_roles_table', 1),
	(3, '2020_12_17_055308_create_permissions_table', 1),
	(4, '2020_12_17_060416_create_role_permissions_pivot_table', 1),
	(5, '2023_07_06_064426_create_bank_table', 1),
	(6, '2023_07_23_092357_create_users_table', 1),
	(7, '2023_07_23_093046_add_relationship_fields_to_users_table', 1);

-- Dumping structure for table base-template.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table base-template.password_resets: ~0 rows (approximately)

-- Dumping structure for table base-template.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table base-template.permissions: ~21 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'dashboard.index', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(2, 'users.index', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(3, 'users.edit', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(4, 'users.delete', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(5, 'users.create', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(6, 'users.show', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(7, 'roles.index', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(8, 'roles.edit', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(9, 'roles.delete', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(10, 'roles.create', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(11, 'roles.show', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(12, 'home.index', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(13, 'permissions.index', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(14, 'permissions.edit', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(15, 'permissions.delete', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(16, 'permissions.create', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(17, 'layout.empty.index', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(18, 'bank.index', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(19, 'bank.edit', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(20, 'bank.show', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(21, 'bank.delete', '2023-08-03 20:35:45', '2023-08-03 20:35:45');

-- Dumping structure for table base-template.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table base-template.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `title`, `short_code`, `created_at`, `updated_at`) VALUES
	(1, 'Superadmin', 'Superadmin', '2023-08-03 20:35:45', '2023-08-03 20:35:45'),
	(2, 'User', 'User', '2023-08-03 20:35:45', '2023-08-03 20:35:45');

-- Dumping structure for table base-template.role_permissions
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table base-template.role_permissions: ~27 rows (approximately)
INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(1, 10),
	(1, 11),
	(1, 12),
	(1, 13),
	(1, 14),
	(1, 15),
	(1, 16),
	(1, 17),
	(1, 18),
	(1, 19),
	(1, 20),
	(1, 21),
	(2, 12),
	(2, 17),
	(2, 18),
	(2, 19),
	(2, 20),
	(2, 21);

-- Dumping structure for table base-template.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table base-template.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role_id`, `no_hp`, `created_at`, `updated_at`, `remember_token`) VALUES
	(1, 'Superadmin', 'Superadmin', 'Superadmin@admin.com', NULL, '$2y$10$8JaI8VEP6v0GthucusvU6eFMiajuxLjTz4vM9h4SQCvmOomyytHR2', 1, '08558955539', '2023-08-03 20:35:46', '2023-08-03 20:35:46', NULL),
	(2, 'User', 'User', 'user@user.com', NULL, '$2y$10$0GlNAQcJd0sTxAkBUlF6JuqgQTtpZFDpbqp4YaliK1Il/wgz4cizO', 2, '08558955539', '2023-08-03 20:35:46', '2023-08-03 20:35:46', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
