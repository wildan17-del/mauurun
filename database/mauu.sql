-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.4.3 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk mauu
CREATE DATABASE IF NOT EXISTS `mauu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mauu`;

-- membuang struktur untuk table mauu.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.cache: ~0 rows (lebih kurang)

-- membuang struktur untuk table mauu.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.cache_locks: ~0 rows (lebih kurang)

-- membuang struktur untuk table mauu.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon_persen` decimal(5,2) NOT NULL,
  `maks_potongan` bigint unsigned DEFAULT NULL,
  `min_belanja` bigint unsigned NOT NULL DEFAULT '0',
  `kuota` int unsigned DEFAULT NULL,
  `kuota_terpakai` int unsigned NOT NULL DEFAULT '0',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_kode_unique` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.coupons: ~2 rows (lebih kurang)
INSERT INTO `coupons` (`id`, `kode`, `nama`, `diskon_persen`, `maks_potongan`, `min_belanja`, `kuota`, `kuota_terpakai`, `tanggal_mulai`, `tanggal_berakhir`, `aktif`, `created_at`, `updated_at`) VALUES
	(1, 'W10', 'Diskon 100%', 100.00, 30000, 20000, 2, 2, '2024-01-02', '2028-12-05', 1, '2026-07-15 04:31:43', '2026-07-15 04:35:48'),
	(2, 'jk12', 'Diskon 100%', 100.00, 100000, 10000, 5, 1, '2026-07-21', '2026-07-26', 1, '2026-07-22 00:27:25', '2026-07-22 00:30:35');

-- membuang struktur untuk table mauu.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_event` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_event` enum('3K','5K','10K','Half Maraton','Full Maraton') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `kota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint unsigned NOT NULL DEFAULT '0',
  `kuota` int unsigned NOT NULL DEFAULT '0',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_jenis_event_index` (`jenis_event`),
  KEY `events_kota_index` (`kota`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.events: ~13 rows (lebih kurang)
INSERT INTO `events` (`id`, `nama_event`, `jenis_event`, `tanggal`, `kota`, `harga`, `kuota`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
	(1, 'Grow Run 2026', 'Full Maraton', '2026-02-15', 'Yogyakarta', 200000, 1999, 'Benefit: Jersey, BIB Number, Medal, Refreshment, Water Station, Doorprize.', 'events/TaG3Cd7GJi5mKdGJArFi0BTvYYukbdIY0e0TnsgV.jpg', '2026-07-06 14:08:48', '2026-07-07 14:23:56'),
	(2, 'H Run 2026', '5K', '2026-05-28', 'Temanggung', 100000, 498, 'Benefit: Jersey, BIB Number, Medal, Refreshment, Water Station, Doorprize.', 'events/KF6oy3B1IGeBAzdgV3NUZe2VhehMOkcE6MbkpZrZ.jpg', '2026-07-06 14:08:48', '2026-07-22 00:29:48'),
	(3, 'Trail Run', '10K', '2026-07-08', 'Yogyakarta', 500000, 5000, 'Sehat Jasmani dan Rohani', 'events/tSQoO6ZuAW4aT5eGww6ros3LWtFktCefVylZ19xO.jpg', '2026-07-06 14:08:48', '2026-07-15 03:32:10'),
	(4, 'Ramadhan Run 26', '3K', '2026-02-08', 'Probolinggo', 400000, 497, 'Benefit: Jersey, BIB Number, Medal, Refreshment, Water Station, Doorprize.', 'events/uMUZQUE4MxqzFRKLkT21WQKdwzY9K1Ga5l5nazb9.jpg', '2026-07-06 14:08:48', '2026-07-30 15:40:57'),
	(5, 'Temanggung Run weekeend 26', '5K', '2026-12-04', 'Temanggung', 30000, 199, 'sehat', 'events/gUDgHt9N9jAQ4UV7q0bb6G4CP8VH0fvgUKwajbaU.jpg', '2026-07-06 15:24:09', '2026-07-15 03:31:50'),
	(6, 'RunCrew 26', 'Full Maraton', '2026-12-06', 'Magelang', 200000, 5000, 'Sehat sekali', 'events/16lZ74DQD7ufR0wi7qG1f3gvuvXBGiz0oi2nnTRb.jpg', '2026-07-07 14:34:52', '2026-07-07 14:34:52'),
	(8, 'Merbabu Run 27', 'Half Maraton', '2027-12-07', 'Magelang', 350000, 450, 'Sehat Walafiat', 'events/aYE9TkbHSRwsa5V3XohKmn33GGECBSwD5GS4iRoS.jpg', '2026-07-08 03:01:40', '2026-07-08 03:01:40'),
	(10, 'Andong Trail Run', '10K', '2027-12-23', 'Magelang', 200000, 150, 'Sehat', 'events/JXCDpXiE9Qt3on5pKx14w8NSZQ4gRGJPPsEwX2xO.jpg', '2026-07-08 03:03:57', '2026-07-08 03:03:57'),
	(11, 'Solo Raya Run', '3K', '2027-12-06', 'Solo', 350000, 1500, 'sehat sekali', 'events/y1Y6POcE9fvUgMI8SPE1zRf8cfEylDcfqKxzRfmk.jpg', '2026-07-15 03:29:26', '2026-07-15 03:29:26'),
	(12, 'YAMAHA RUN', '3K', '2026-11-29', 'Yogyakarta', 40000, 0, NULL, 'events/A0HfZbJdufJNiMjozH2ij0qOAEHkrsFnJL2JgLtZ.jpg', '2026-07-21 15:40:02', '2026-07-22 00:48:28'),
	(13, 'MGLS Run 26', 'Full Maraton', '2026-08-06', 'Magelang', 200000, 300, 'Jersey, Medali', 'events/EmCiD9t1w8Ofk0Jp3WwLRmdTQCzoQYORsvMBFwU3.jpg', '2026-07-22 00:15:19', '2026-07-22 00:46:03'),
	(14, 'wf', '3K', '2026-07-23', 'Yogyakarta', 12340000, 1, 'fdewf', 'events/GtTYEwZQRzEv6XZr7BScCOeOxJQ7kuaf5RzXafCp.jpg', '2026-07-22 00:23:47', '2026-07-22 00:46:27'),
	(15, 'wonosobo run', 'Half Maraton', '2026-07-23', 'Wonosobo', 200000, 300, NULL, NULL, '2026-07-22 04:34:25', '2026-07-22 04:34:25');

-- membuang struktur untuk table mauu.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.migrations: ~4 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2026_07_07_122317_add_gambar_to_events_table', 1),
	(2, '2026_07_07_130000_add_confirmed_to_registrations_table', 2),
	(3, '2026_07_15_000000_create_coupons_table', 3),
	(4, '2026_07_22_000001_add_nik_to_users_table', 4);

-- membuang struktur untuk table mauu.registrations
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `event_id` bigint unsigned NOT NULL,
  `nama_lengkap` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran_jersey` enum('S','M','L','XL','XXL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kupon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `potongan_harga` bigint unsigned NOT NULL DEFAULT '0',
  `harga_akhir` bigint unsigned NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registrations_user_id_event_id_unique` (`user_id`,`event_id`),
  KEY `registrations_event_id_foreign` (`event_id`),
  CONSTRAINT `registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.registrations: ~8 rows (lebih kurang)
INSERT INTO `registrations` (`id`, `user_id`, `event_id`, `nama_lengkap`, `email`, `no_hp`, `jenis_kelamin`, `ukuran_jersey`, `kode_kupon`, `potongan_harga`, `harga_akhir`, `confirmed`, `confirmed_at`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 'Muh Wildan', 'admin@maurun.com', '124234324', 'Laki-Laki', 'L', 'D-10', 10000, 190000, 1, '2026-07-08 01:19:04', '2026-07-07 14:23:56', '2026-07-08 01:19:04'),
	(2, 4, 5, 'Ahmad', 'idan@gmail.com', '3247983247', 'Laki-Laki', 'XL', 'D-10', 10000, 20000, 1, '2026-07-07 15:14:57', '2026-07-07 14:37:20', '2026-07-07 15:14:57'),
	(3, 4, 2, 'Ahmad', 'idan@gmail.com', '0', 'Perempuan', 'L', 'W10', 30000, 70000, 1, '2026-07-08 01:23:19', '2026-07-07 15:03:04', '2026-07-15 04:35:48'),
	(4, 4, 4, 'idannnnn', 'idant@gmail.com', '0124397', 'Laki-Laki', 'L', 'W10', 30000, 370000, 0, NULL, '2026-07-15 04:35:08', '2026-07-15 04:35:08'),
	(5, 4, 12, 'Ahmad', 'idan@gmail.com', '3247983247', 'Laki-Laki', 'L', NULL, 0, 40000, 1, '2026-07-21 15:42:26', '2026-07-21 15:41:08', '2026-07-21 15:42:26'),
	(6, 6, 2, 'Ahmad', 'admin@maurun.com', '3247983247', 'Perempuan', 'M', 'JK12', 100000, 0, 0, NULL, '2026-07-22 00:29:48', '2026-07-22 00:31:59'),
	(7, 7, 4, 'yusuf', 'wildansteam19@gmail.com', '4325634645', 'Laki-Laki', 'L', NULL, 0, 400000, 1, '2026-07-22 00:39:07', '2026-07-22 00:37:23', '2026-07-22 00:39:07'),
	(8, 8, 4, 'wildan steam', 'wildansteam18@gmail.com', '098341293', 'Laki-Laki', 'L', NULL, 0, 400000, 0, NULL, '2026-07-30 15:40:57', '2026-07-30 15:40:57');

-- membuang struktur untuk table mauu.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.sessions: ~6 rows (lebih kurang)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('GVO7J15kTAZ2USfVYh2mVb6eHNohMKLWZE7sEAPX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEVwUUJpakdLT3lvcUJFTGJBOFVpYnVLZFNjamV1em54ZENQdlNiayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785424756),
	('M2cD1sHcuAzCn5sFekDoDsoYwzBMTDgT0awHOCzC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaWNPanYxYWROSjhvMDhtd1pQeloyaHQ0cWpLYXA5Q2VSWGtqcXFjZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785426143),
	('R9gATqkbOYgiO7m53BBX6psemaPHn5k7I8wv8cTY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQUlaMndkWER3bmY0V0VLQThTTlpkVWdLc3BMeDFXenRxckZ4VXByaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785425462),
	('yfF8iOO2X2rlYF68YCqtgVJCwuLjJwayqbvx9jVu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic3FCU3k5Q3JxRkFaMHYxOVB4YlI1NDRERlhEQWpxQkNyQmVTZlVMTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo3OiJ3ZWxjb21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1785426232),
	('z18GNmxF9dZE9R85Xke4s4ThBB7oMhuoExBlpKWh', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidHloWGp5TllEU1NYOVM3WEdrZnlZN2VpNFc0bUNxeDYwdWtuQXJiMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1785425882),
	('Z2L35fgVPm61ukRunNCRYEfIY2ogkLIXc7yIGOtG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZTIySlVsQk1lQXZIMDgyd1FXTUhtWVhxUUxEZEdVblJKWkk2TVdqaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785430229);

-- membuang struktur untuk table mauu.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','peserta') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peserta',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_nik_unique` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel mauu.users: ~8 rows (lebih kurang)
INSERT INTO `users` (`id`, `username`, `password`, `nik`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '$2y$12$HZZ5QfzDQsZ/vatdyNczN.z6Cq0lKwoJcoMWZe.b7V58gNJQ/U03e', NULL, 'admin', 'skWvpHnqAQ5QoUT4QyU0saSMGy1mfFxBkuM93C43r8HFtlDdP5mmzgFcR6FC', '2026-07-06 14:08:03', '2026-07-06 15:23:16'),
	(2, 'peserta1', '$2y$12$yE.LqgjGb43nao8HQHPNGOeoSdGcXtaqAkx3lwJXkNDQAgCaGvoGO', NULL, 'peserta', NULL, '2026-07-06 14:08:03', '2026-07-06 15:22:34'),
	(3, 'wily', '$2y$12$nPW58XGx1nCoUgoPgm6i0.1vFC7A5IBmjehCNqfSt6dSm4W03ws7O', NULL, 'peserta', NULL, '2026-07-06 15:28:18', '2026-07-06 15:28:18'),
	(4, 'idant', '$2y$12$9rOHGEVFs1SdqKzGDdB.se7iTusuaOikDYryPWXKIAbaXcwAA3OUS', NULL, 'peserta', 'KmOsspWol5qkZpIyYiogmGqU15jYgFgXcdJzcJ14lmUn7b7JJWSlMsPSIG3U', '2026-07-07 05:20:44', '2026-07-07 05:20:44'),
	(5, 'tiancok', '$2y$12$LIbo0m8o5p0JvKM1x9XXse4gLl4x38Zq.ZIWxrnsmcYHnMhG7ToQS', NULL, 'peserta', NULL, '2026-07-21 15:41:46', '2026-07-21 15:41:46'),
	(6, 'ahmad', '$2y$12$3dvbtOa2H5uCgveZFF8ImuPEaoxtrpPstM201dB3yaoBJXLxAySPq', NULL, 'peserta', NULL, '2026-07-22 00:28:32', '2026-07-22 00:28:32'),
	(7, 'yusuf', '$2y$12$SZJqQcT5Ysi/3HTV5VCPPOlqrh0k1Ml3oosiTHWvjyWmjAG3IdHZS', '3323031704050002', 'peserta', NULL, '2026-07-22 00:36:53', '2026-07-22 00:36:53'),
	(8, 'wildan', '$2y$12$xDzusM9j4ei0LkprnSNKcO.rHYTTYWGCsv2KukFbbDx/IqWnUXG8K', '3218652567382635', 'peserta', NULL, '2026-07-30 15:39:14', '2026-07-30 15:39:14');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
