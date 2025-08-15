-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2025 pada 07.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ksp-lanal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formulir_pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_bayar` decimal(12,2) NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `sisa_pembayaran` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`id`, `formulir_pengajuan_id`, `tanggal`, `jumlah_bayar`, `angsuran_ke`, `sisa_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-08-29', 417000.00, 1, 9583000.00, '2025-07-28 21:12:32', '2025-07-28 21:12:32'),
(2, 2, '2025-07-31', 208000.00, 1, 4792000.00, '2025-07-28 22:31:59', '2025-07-28 22:31:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `formulir_pengajuans`
--

CREATE TABLE `formulir_pengajuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `data_lengkap_json` text NOT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `formulir_pengajuans`
--

INSERT INTO `formulir_pengajuans` (`id`, `user_id`, `data_lengkap_json`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, '{\"jabatan\":\"bintara\",\"slip_gaji_path\":\"slip_gaji\\/FfMJPVFR09AzikY0lIL2DmkOUGY7BYLdHncyBllk.jpg\",\"jumlah_pinjaman\":\"10000000\",\"tenor\":\"24\",\"keperluan\":\"Biaya Pengobatan Istri\",\"bunga\":\"1.00\"}', 'disetujui', '2025-07-28 18:54:05', '2025-07-28 19:14:45'),
(2, 8, '{\"jabatan\":\"tamtama\",\"slip_gaji_path\":\"slip_gaji\\/IQR7f5LkNFLnOiYT1GOeNjjcDki05PP5SWE6Cgsx.jpg\",\"jumlah_pinjaman\":\"5000000\",\"tenor\":\"24\",\"keperluan\":\"Biaya Pendidikan Anak\",\"bunga\":\"1.00\"}', 'disetujui', '2025-07-28 22:31:14', '2025-07-28 22:31:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_laporan_keuangans`
--

CREATE TABLE `jenis_laporan_keuangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_simpanans`
--

CREATE TABLE `jenis_simpanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_simpanans`
--

INSERT INTO `jenis_simpanans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Simpanan Pokok', NULL, NULL),
(2, 'Simpanan Wajib', NULL, NULL),
(3, 'Simpanan Sukarela', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_keuangans`
--

CREATE TABLE `laporan_keuangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_07_15_041011_create_roles_table', 1),
(5, '2025_07_15_041114_create_pangkats_table', 1),
(6, '2025_07_15_041303_create_users_table', 1),
(7, '2025_07_15_041502_create_jenis_simpanans_table', 1),
(8, '2025_07_15_041623_create_jenis_laporan_keuangans_table', 1),
(9, '2025_07_15_041758_create_simpanans_table', 1),
(10, '2025_07_15_041909_create_slip_gajis_table', 1),
(11, '2025_07_15_042054_create_pinjamans_table', 1),
(12, '2025_07_15_042241_create_angsuran_table', 1),
(13, '2025_07_15_042322_create_laporan_keuangans_table', 1),
(14, '2025_07_15_042422_create_formulir_pengajuans_table', 1),
(15, '2025_07_17_084505_add_file_path_to_slip_gajis_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkats`
--

CREATE TABLE `pangkats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `maksimal_pinjaman` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pangkats`
--

INSERT INTO `pangkats` (`id`, `nama`, `maksimal_pinjaman`, `created_at`, `updated_at`) VALUES
(1, 'Tamtama', 10000000, NULL, NULL),
(2, 'Bintara', 15000000, NULL, NULL),
(3, 'Perwira', 20000000, NULL, NULL),
(4, 'Letkol', 25000000, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjamans`
--

CREATE TABLE `pinjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `jumlah` decimal(12,2) NOT NULL,
  `status` enum('pending','disetujui','ditolak','dicairkan','lunas') NOT NULL,
  `tenor` int(11) NOT NULL,
  `bunga` decimal(5,2) NOT NULL,
  `slip_gaji_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pinjamans`
--

INSERT INTO `pinjamans` (`id`, `anggota_id`, `tanggal_pengajuan`, `jumlah`, `status`, `tenor`, `bunga`, `slip_gaji_id`, `created_at`, `updated_at`) VALUES
(5, 8, '2025-07-01', 5000000.00, 'lunas', 5, 2.00, 7, '2025-07-28 05:24:13', '2025-07-28 06:26:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'staff', NULL, NULL),
(2, 'kepala koperasi', NULL, NULL),
(3, 'anggota', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanans`
--

CREATE TABLE `simpanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` decimal(12,2) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_simpanan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `simpanans`
--

INSERT INTO `simpanans` (`id`, `user_id`, `jumlah`, `tanggal`, `jenis_simpanan_id`, `created_at`, `updated_at`) VALUES
(1, 8, 1000000.00, '2025-07-28', 2, '2025-07-28 00:51:51', '2025-07-28 00:51:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slip_gajis`
--

CREATE TABLE `slip_gajis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `nominal` decimal(12,2) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `slip_gajis`
--

INSERT INTO `slip_gajis` (`id`, `user_id`, `bulan`, `nominal`, `file_path`, `created_at`, `updated_at`) VALUES
(7, 8, '2025-07-04', 4500000.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `pangkat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `pangkat_id`, `created_at`, `updated_at`) VALUES
(6, 'staff.lanal', '$2y$12$VRK/2lUBn9Pb1AEM3OH6cOQ.Pi.h8a7gbuSNgNcE2a3YJ8cZcgTc6', 1, 2, NULL, NULL),
(7, 'kepala.kop', '$2y$12$0Etxr/QOhRK2oE1nhyVDvOpzwm3XzFX74D/nMyyRL3KEs62pSoJau', 2, 4, NULL, NULL),
(8, 'agustina', '$2y$12$X/cuvT5sbVOtJoxZuo7aSudRNWdY8.jMuOGhDLhy5tsDJAjCigohe', 3, 1, NULL, NULL),
(9, 'bintara01', '$2y$12$Bur0p2FM.e5y7uQKXpjs2ODma/lA2CUW3Lx6rTn0caNOf8PpJGQnm', 3, 2, NULL, NULL),
(10, 'letkol.slamet', '$2y$12$4fo3lifCNfRwfS0QaFC23u/mWWaWnUVE/7vxx/cHeN2SZ6GoHf9DG', 3, 4, NULL, NULL),
(11, 'fahmi', '$2y$12$SoAag6nzpc/15zpjOSrhxuX0UI80RJeqMtu1sDA.frkHkjUD2oLQS', 3, 1, '2025-07-28 18:21:00', '2025-07-28 18:22:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `angsuran_formulir_pengajuan_id_foreign` (`formulir_pengajuan_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `formulir_pengajuans`
--
ALTER TABLE `formulir_pengajuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulir_pengajuans_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `jenis_laporan_keuangans`
--
ALTER TABLE `jenis_laporan_keuangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_simpanans`
--
ALTER TABLE `jenis_simpanans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_keuangans`
--
ALTER TABLE `laporan_keuangans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_keuangans_user_id_foreign` (`user_id`),
  ADD KEY `laporan_keuangans_jenis_foreign` (`jenis`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pangkats`
--
ALTER TABLE `pangkats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pinjamans`
--
ALTER TABLE `pinjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjamans_anggota_id_foreign` (`anggota_id`),
  ADD KEY `pinjamans_slip_gaji_id_foreign` (`slip_gaji_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanans`
--
ALTER TABLE `simpanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `simpanans_user_id_foreign` (`user_id`),
  ADD KEY `simpanans_jenis_simpanan_id_foreign` (`jenis_simpanan_id`);

--
-- Indeks untuk tabel `slip_gajis`
--
ALTER TABLE `slip_gajis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slip_gajis_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_pangkat_id_foreign` (`pangkat_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `formulir_pengajuans`
--
ALTER TABLE `formulir_pengajuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_laporan_keuangans`
--
ALTER TABLE `jenis_laporan_keuangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_simpanans`
--
ALTER TABLE `jenis_simpanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `laporan_keuangans`
--
ALTER TABLE `laporan_keuangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pangkats`
--
ALTER TABLE `pangkats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pinjamans`
--
ALTER TABLE `pinjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `simpanans`
--
ALTER TABLE `simpanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `slip_gajis`
--
ALTER TABLE `slip_gajis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_formulir_pengajuan_id_foreign` FOREIGN KEY (`formulir_pengajuan_id`) REFERENCES `formulir_pengajuans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `formulir_pengajuans`
--
ALTER TABLE `formulir_pengajuans`
  ADD CONSTRAINT `formulir_pengajuans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_keuangans`
--
ALTER TABLE `laporan_keuangans`
  ADD CONSTRAINT `laporan_keuangans_jenis_foreign` FOREIGN KEY (`jenis`) REFERENCES `jenis_laporan_keuangans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_keuangans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjamans`
--
ALTER TABLE `pinjamans`
  ADD CONSTRAINT `pinjamans_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pinjamans_slip_gaji_id_foreign` FOREIGN KEY (`slip_gaji_id`) REFERENCES `slip_gajis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `simpanans`
--
ALTER TABLE `simpanans`
  ADD CONSTRAINT `simpanans_jenis_simpanan_id_foreign` FOREIGN KEY (`jenis_simpanan_id`) REFERENCES `jenis_simpanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `simpanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `slip_gajis`
--
ALTER TABLE `slip_gajis`
  ADD CONSTRAINT `slip_gajis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_pangkat_id_foreign` FOREIGN KEY (`pangkat_id`) REFERENCES `pangkats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
