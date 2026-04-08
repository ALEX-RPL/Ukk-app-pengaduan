-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2026 at 11:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_app_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspirasis`
--

CREATE TABLE `aspirasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nis_pelapor` varchar(255) DEFAULT NULL COMMENT 'NIS pelapor saat pelaporan',
  `kelas_pelapor` varchar(255) DEFAULT NULL COMMENT 'Kelas pelapor saat pelaporan',
  `kategori` enum('fasilitas','kebersihan','keamanan','lainnya') NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `lokasi` varchar(255) NOT NULL COMMENT 'Lokasi sarana yang diadukan',
  `gambar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array path gambar yang diupload' CHECK (json_valid(`gambar`)),
  `status` enum('pending','diproses','selesai','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aspirasis`
--

INSERT INTO `aspirasis` (`id`, `user_id`, `nis_pelapor`, `kelas_pelapor`, `kategori`, `judul`, `konten`, `lokasi`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2024001', 'TKJ 1', 'kebersihan', 'Kelas C5 Kotor Sekali', 'Kelas kotor sekali mungkin tidak di lakukan piket', 'C5', '[\"aspirasi\\/MVR6UCQMNVnRh8El2dQYUj6cogG7e2XUcd4zlSIW.jpg\"]', 'diproses', '2026-04-08 01:27:53', '2026-04-08 01:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_laporan`
--

CREATE TABLE `kategori_laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL COMMENT 'Nama kategori laporan',
  `slug` varchar(255) NOT NULL COMMENT 'Slug unik untuk kategori (contoh: fasilitas, kebersihan)',
  `ikon` varchar(255) DEFAULT NULL COMMENT 'Ikon untuk kategori (opsional)',
  `deskripsi` text DEFAULT NULL,
  `warna` varchar(255) NOT NULL DEFAULT 'blue' COMMENT 'Warna untuk badge kategori',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `urutan` int(11) NOT NULL DEFAULT 0 COMMENT 'Urutan tampilan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_laporan`
--

INSERT INTO `kategori_laporan` (`id`, `nama_kategori`, `slug`, `ikon`, `deskripsi`, `warna`, `is_active`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Fasilitas', 'fasilitas', '🏫', 'Laporan terkait fasilitas sekolah yang rusak, kurang memadai, atau perlu perbaikan', 'blue', 1, 1, '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(2, 'Kebersihan', 'kebersihan', '🧹', 'Laporan terkait kebersihan lingkungan sekolah, toilet, ruang kelas, dan area lainnya', 'green', 1, 2, '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(3, 'Keamanan', 'keamanan', '🔒', 'Laporan terkait keamanan dan keselamatan di lingkungan sekolah', 'red', 1, 3, '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(4, 'Lainnya', 'lainnya', '📝', 'Laporan lain yang tidak termasuk dalam kategori di atas', 'yellow', 1, 4, '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(5, 'Kelas', 'kelas', '👨🏼‍🏫', 'Laporan terkait Kejadian/Peristiwa di lingkungan kelas, dan area depan kelas', 'yellow', 1, 3, '2026-04-08 01:15:43', '2026-04-08 01:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL COMMENT 'Nama kelas (contoh: TKJ 1, RPL 1)',
  `tingkat` varchar(255) NOT NULL COMMENT 'Tingkat kelas (X, XI, XII)',
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'DPIB 1', 'X', 'Kelas X DPIB 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(2, 'SIJA 1', 'X', 'Kelas X SIJA 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(3, 'RPL 1', 'X', 'Kelas X RPL 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(4, 'RPL 2', 'X', 'Kelas X RPL 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(5, 'DKV 1', 'X', 'Kelas X DKV 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(6, 'DKV 2', 'X', 'Kelas X DKV 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(7, 'DKV 3', 'X', 'Kelas X DKV 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(8, 'DKV 4', 'X', 'Kelas X DKV 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(9, 'TKR 1', 'X', 'Kelas X TKR 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(10, 'TKR 2', 'X', 'Kelas X TKR 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(11, 'TKR 3', 'X', 'Kelas X TKR 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(12, 'TKR 4', 'X', 'Kelas X TKR 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(13, 'TSM 1', 'X', 'Kelas X TSM 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(14, 'TSM 2', 'X', 'Kelas X TSM 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(15, 'TSM 3', 'X', 'Kelas X TSM 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(16, 'TSM 4', 'X', 'Kelas X TSM 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(17, 'TKJ 1', 'X', 'Kelas X TKJ 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(18, 'TKJ 2', 'X', 'Kelas X TKJ 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(19, 'TKJ 3', 'X', 'Kelas X TKJ 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(20, 'TKJ 4', 'X', 'Kelas X TKJ 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(21, 'Animasi 1', 'X', 'Kelas X Animasi 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(22, 'Animasi 2', 'X', 'Kelas X Animasi 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(23, 'Animasi 3', 'X', 'Kelas X Animasi 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(24, 'Animasi 4', 'X', 'Kelas X Animasi 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(25, 'LPKC 1', 'X', 'Kelas X LPKC 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(26, 'LPKC 2', 'X', 'Kelas X LPKC 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(27, 'LPKC 3', 'X', 'Kelas X LPKC 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(28, 'LPKC 4', 'X', 'Kelas X LPKC 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(29, 'DPIB 1', 'XI', 'Kelas XI DPIB 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(30, 'SIJA 1', 'XI', 'Kelas XI SIJA 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(31, 'RPL 1', 'XI', 'Kelas XI RPL 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(32, 'RPL 2', 'XI', 'Kelas XI RPL 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(33, 'DKV 1', 'XI', 'Kelas XI DKV 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(34, 'DKV 2', 'XI', 'Kelas XI DKV 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(35, 'DKV 3', 'XI', 'Kelas XI DKV 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(36, 'DKV 4', 'XI', 'Kelas XI DKV 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(37, 'TKR 1', 'XI', 'Kelas XI TKR 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(38, 'TKR 2', 'XI', 'Kelas XI TKR 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(39, 'TKR 3', 'XI', 'Kelas XI TKR 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(40, 'TKR 4', 'XI', 'Kelas XI TKR 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(41, 'TSM 1', 'XI', 'Kelas XI TSM 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(42, 'TSM 2', 'XI', 'Kelas XI TSM 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(43, 'TSM 3', 'XI', 'Kelas XI TSM 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(44, 'TSM 4', 'XI', 'Kelas XI TSM 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(45, 'TKJ 1', 'XI', 'Kelas XI TKJ 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(46, 'TKJ 2', 'XI', 'Kelas XI TKJ 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(47, 'TKJ 3', 'XI', 'Kelas XI TKJ 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(48, 'TKJ 4', 'XI', 'Kelas XI TKJ 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(49, 'Animasi 1', 'XI', 'Kelas XI Animasi 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(50, 'Animasi 2', 'XI', 'Kelas XI Animasi 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(51, 'Animasi 3', 'XI', 'Kelas XI Animasi 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(52, 'Animasi 4', 'XI', 'Kelas XI Animasi 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(53, 'LPKC 1', 'XI', 'Kelas XI LPKC 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(54, 'LPKC 2', 'XI', 'Kelas XI LPKC 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(55, 'LPKC 3', 'XI', 'Kelas XI LPKC 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(56, 'LPKC 4', 'XI', 'Kelas XI LPKC 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(57, 'DPIB 1', 'XII', 'Kelas XII DPIB 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(58, 'SIJA 1', 'XII', 'Kelas XII SIJA 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(59, 'RPL 1', 'XII', 'Kelas XII RPL 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(60, 'RPL 2', 'XII', 'Kelas XII RPL 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(61, 'DKV 1', 'XII', 'Kelas XII DKV 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(62, 'DKV 2', 'XII', 'Kelas XII DKV 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(63, 'DKV 3', 'XII', 'Kelas XII DKV 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(64, 'DKV 4', 'XII', 'Kelas XII DKV 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(65, 'TKR 1', 'XII', 'Kelas XII TKR 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(66, 'TKR 2', 'XII', 'Kelas XII TKR 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(67, 'TKR 3', 'XII', 'Kelas XII TKR 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(68, 'TKR 4', 'XII', 'Kelas XII TKR 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(69, 'TSM 1', 'XII', 'Kelas XII TSM 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(70, 'TSM 2', 'XII', 'Kelas XII TSM 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(71, 'TSM 3', 'XII', 'Kelas XII TSM 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(72, 'TSM 4', 'XII', 'Kelas XII TSM 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(73, 'TKJ 1', 'XII', 'Kelas XII TKJ 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(74, 'TKJ 2', 'XII', 'Kelas XII TKJ 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(75, 'TKJ 3', 'XII', 'Kelas XII TKJ 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(76, 'TKJ 4', 'XII', 'Kelas XII TKJ 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(77, 'Animasi 1', 'XII', 'Kelas XII Animasi 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(78, 'Animasi 2', 'XII', 'Kelas XII Animasi 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(79, 'Animasi 3', 'XII', 'Kelas XII Animasi 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(80, 'Animasi 4', 'XII', 'Kelas XII Animasi 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(81, 'LPKC 1', 'XII', 'Kelas XII LPKC 1', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(82, 'LPKC 2', 'XII', 'Kelas XII LPKC 2', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(83, 'LPKC 3', 'XII', 'Kelas XII LPKC 3', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(84, 'LPKC 4', 'XII', 'Kelas XII LPKC 4', '2026-04-08 01:13:41', '2026-04-08 01:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

CREATE TABLE `kritik_saran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tipe` enum('kritik','saran') NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gambar`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kritik_saran`
--

INSERT INTO `kritik_saran` (`id`, `user_id`, `tipe`, `judul`, `pesan`, `lokasi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 2, 'kritik', 'Mungkin Lebih Bijak lagi kebijakan untuk siswa kelas 12', 'bisa memberikan kelongaran untuk siswa kelas 12 dan lebih mempersiapkan kelas 12 untuk bekerja', 'SMKN 11 MALANG', NULL, '2026-04-08 01:57:26', '2026-04-08 01:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_08_000001_create_aspirasis_table', 1),
(5, '2026_04_08_000002_create_responses_table', 1),
(6, '2026_04_08_035426_create_kritik_saran_table', 1),
(7, '2026_04_08_071136_create_kategori_table', 1),
(8, '2026_04_08_073817_remove_kategori_table', 1),
(9, '2026_04_08_073833_create_kategori_laporan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `aspirasi_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `response_text` text NOT NULL,
  `status_update` enum('diproses','selesai','ditolak') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `aspirasi_id`, `admin_id`, `response_text`, `status_update`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'akan ada konsekuensi untuk pengguna kelas kemarin', 'diproses', '2026-04-08 01:31:16', '2026-04-08 01:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BOo2x9vhoROWXvkZnatcdh439OKhQvSOzhvvdhSL', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIzNk41TUtCdGJCRjlvaTRkaHR0UGh2SDRNVzRpTGg1c2gyemh0SXBGIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3Npc3dhXC9rcml0aWstc2FyYW4iLCJyb3V0ZSI6InNpc3dhLmtyaXRpay1zYXJhbi5pbmRleCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=', 1775638893),
('cQtM2Jya1wCJBBoHwiB9r5BPNhczZlINb8g1Sq33', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJqdjNCZExFVGpZT20zT20xSGcxVHQyb1lralA3Um9pbDBOMDBtY2RoIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1775637378),
('gKHxcOf78f9QD9HEUIyo0Sr6cFAaJbwkhWnAFbdM', NULL, '127.0.0.1', 'Symfony', 'eyJfdG9rZW4iOiJHaGpiUDY0YUVrbXZrMGl4c0VpTFd1ODh6dmIwY1lGSUhwdjVqaFdwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1775636956);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nis` varchar(255) DEFAULT NULL COMMENT 'NIS untuk siswa, null untuk admin',
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','admin') NOT NULL DEFAULT 'siswa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nis`, `kelas_id`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sekolah', 'admin@sekolah.com', NULL, NULL, '$2y$12$lr60JgJ.RO354wUFyKbDyepOXNSOv4RIe8KXBBhPnNRvejrT62bQ.', 'admin', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(2, 'Ahmad Rizki', 'ahmad@student.com', '2024001', 17, '$2y$12$S/35SXNPxwd9yZEeuaze7ubqKhncOu77wJRx8rCkQinTY0IYflXZ.', 'siswa', '2026-04-08 01:13:41', '2026-04-08 01:13:41'),
(3, 'Siti Nurhaliza', 'siti@student.com', '2024002', 3, '$2y$12$22TqbqMY.fPbAW2gF0cWAewqazm/./S0jCX7.e.TuRSwacAphC6wK', 'siswa', '2026-04-08 01:13:42', '2026-04-08 01:13:42'),
(4, 'Budi Santoso', 'budi@student.com', '2024003', 5, '$2y$12$VjsKZmw81U8ASEqO6JSAfOJjQkMsvl9TU8zw3vfTtnQ6apPeQmeim', 'siswa', '2026-04-08 01:13:42', '2026-04-08 01:13:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aspirasis`
--
ALTER TABLE `aspirasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aspirasis_user_id_index` (`user_id`),
  ADD KEY `aspirasis_status_index` (`status`),
  ADD KEY `aspirasis_kategori_index` (`kategori`),
  ADD KEY `aspirasis_created_at_index` (`created_at`),
  ADD KEY `aspirasis_user_id_status_index` (`user_id`,`status`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_laporan`
--
ALTER TABLE `kategori_laporan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_laporan_slug_unique` (`slug`),
  ADD KEY `kategori_laporan_is_active_urutan_index` (`is_active`,`urutan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_nama_kelas_tingkat_index` (`nama_kelas`,`tingkat`);

--
-- Indexes for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kritik_saran_user_id_tipe_index` (`user_id`,`tipe`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_aspirasi_id_index` (`aspirasi_id`),
  ADD KEY `responses_admin_id_index` (`admin_id`),
  ADD KEY `responses_status_update_index` (`status_update`),
  ADD KEY `responses_created_at_index` (`created_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspirasis`
--
ALTER TABLE `aspirasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_laporan`
--
ALTER TABLE `kategori_laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasis`
--
ALTER TABLE `aspirasis`
  ADD CONSTRAINT `aspirasis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD CONSTRAINT `kritik_saran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_aspirasi_id_foreign` FOREIGN KEY (`aspirasi_id`) REFERENCES `aspirasis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
