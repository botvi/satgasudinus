-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 11 Jul 2024 pada 17.12
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
-- Database: `appsatgas_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumens`
--

CREATE TABLE `dokumens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokumens`
--

INSERT INTO `dokumens` (`id`, `title`, `deskripsi`, `file`, `created_at`, `updated_at`) VALUES
(4, 'CONTOH DOKUMEN 1', 'CONTOH DOKUMEN 1 DESKRIPSI', '1720702087.docx', '2024-07-11 05:48:07', '2024-07-11 05:48:07'),
(5, 'CONTOH DOKUMEN 2', 'CONTOH DOKUMEN 2  DESKRIPSI', '1720703851.docx', '2024-07-11 06:17:31', '2024-07-11 06:17:31'),
(6, 'CONTOH DOKUMEN 3', 'CONTOH DOKUMEN 3 DESKRIPSI', '1720703927.docx', '2024-07-11 06:18:47', '2024-07-11 06:18:47'),
(7, 'CONTOH DOKUMEN 4', 'CONTOH DOKUMEN 4 DESKRIPSI', '1720703975.docx', '2024-07-11 06:19:35', '2024-07-11 06:19:35');

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
-- Struktur dari tabel `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `galeris`
--

INSERT INTO `galeris` (`id`, `gambar`, `created_at`, `updated_at`) VALUES
(2, '1720704148.jpg', '2024-07-11 05:49:59', '2024-07-11 06:22:28'),
(3, '1720704155.jpg', '2024-07-11 06:22:35', '2024-07-11 06:22:35'),
(4, '1720704162.jpg', '2024-07-11 06:22:42', '2024-07-11 06:22:42'),
(5, '1720704170.jpg', '2024-07-11 06:22:50', '2024-07-11 06:22:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `title`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(6, 'COBA KEGIATAN 1', 'COBA KEGIATAN 1 DESKRIPSI', '1720701845.jpg', '2024-07-11 05:44:05', '2024-07-11 05:44:05'),
(7, 'COBA KEGIATAN 2', 'COBA KEGIATAN 2 DESKRIPSI', '1720703668.jpg', '2024-07-11 06:14:28', '2024-07-11 06:14:42'),
(8, 'COBA KEGIATAN 3', 'COBA KEGIATAN 3 DESKRIPSI', '1720703698.jpg', '2024-07-11 06:14:58', '2024-07-11 06:14:58'),
(9, 'COBA KEGIATAN 4', 'COBA KEGIATAN 4 DESKRIPSI', '1720703723.jpg', '2024-07-11 06:15:17', '2024-07-11 06:15:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapors`
--

CREATE TABLE `lapors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_identitas` varchar(255) NOT NULL,
  `file_identitas` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_unit_kerja_fakultas_instansi` varchar(255) NOT NULL,
  `status_pelapor` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `nama_lengkap_terlapor` varchar(255) NOT NULL,
  `status_terlapor` varchar(255) NOT NULL,
  `no_hp_terlapor` varchar(255) NOT NULL,
  `peristiwa` text NOT NULL,
  `tanggal_peristiwa` date NOT NULL,
  `lokasi_peristiwa` varchar(255) NOT NULL,
  `kronologi_peristiwa` text NOT NULL,
  `file_bukti_tindakan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lapors`
--

INSERT INTO `lapors` (`id`, `nama_lengkap`, `nomor_identitas`, `file_identitas`, `alamat`, `no_hp`, `email`, `nama_unit_kerja_fakultas_instansi`, `status_pelapor`, `kategori`, `nama_lengkap_terlapor`, `status_terlapor`, `no_hp_terlapor`, `peristiwa`, `tanggal_peristiwa`, `lokasi_peristiwa`, `kronologi_peristiwa`, `file_bukti_tindakan`, `created_at`, `updated_at`) VALUES
(4, 'Yovi Ardiansyah', '12345678', '1720706515_identitas.png', 'Jl.Simpang Sapar, Sungai Langsat', '085156985623', 'younoob07mei@gmail.com', 'Fakultas Teknik', 'Mahasiswa', 'Korban', 'Zaki Ardian', 'Mahasiswa', '085156985623', 'SS', '2024-07-02', 'Kampus', 'eqeq', '1720706515_bukti.png', '2024-07-11 07:01:55', '2024-07-11 07:01:55'),
(5, 'sisfo Al Ma\'arif', 'dadad', '1720707917_identitas.png', 'Desa Air emas', '085156985623', 'almaarifhosting@gmail.com', 'dadadd', 'Mahasiswa', 'Korban', 'Zaki Ardian', 'Mahasiswa', '085156985623', 'awaw', '2024-07-15', 'Kampus', 'ada', '1720707917_bukti.png', '2024-07-11 07:25:17', '2024-07-11 07:25:17');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_10_140553_create_kegiatans_table', 1),
(6, '2024_07_10_140602_create_dokumens_table', 1),
(7, '2024_07_10_140608_create_galeris_table', 1),
(8, '2024_07_10_140614_create_lapors_table', 1),
(9, '2014_10_12_000000_create_users_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SATGAS UDINUS ADMIN', 'adminsatgasudinus', 'adminsatgasudinus@udinus.ac.id', NULL, '$2y$10$B9SsfeMMXEHZvz8sxWyIuOzeKhGDhZ.251hvvN9z4i1CE97BlK66a', NULL, '2024-07-11 06:34:16', '2024-07-11 06:34:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokumens`
--
ALTER TABLE `dokumens`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lapors`
--
ALTER TABLE `lapors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lapors`
--
ALTER TABLE `lapors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
