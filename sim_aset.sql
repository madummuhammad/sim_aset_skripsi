-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 05:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim_aset`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id_asset` varchar(40) NOT NULL,
  `nama_asset` varchar(20) DEFAULT NULL,
  `harga_satuan` varchar(10) NOT NULL,
  `kode_lokasi` varchar(6) DEFAULT NULL,
  `id_jenis_asset` varchar(6) DEFAULT NULL,
  `id_kategori_asset` varchar(6) DEFAULT NULL,
  `id_user` int(3) NOT NULL,
  `kondisi` enum('Sangat Bagus','Bagus','Cukup Bagus','Buruk') NOT NULL,
  `tgl_input` varchar(10) NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `umur_mulai` varchar(10) NOT NULL,
  `umur_akhir` varchar(10) NOT NULL,
  `status_aset` enum('Tersedia','Perlu Pengecekan','Dimusnahkan','Proses Mutasi','Proses Pemusnahan') NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id_asset`, `nama_asset`, `harga_satuan`, `kode_lokasi`, `id_jenis_asset`, `id_kategori_asset`, `id_user`, `kondisi`, `tgl_input`, `satuan`, `umur_mulai`, `umur_akhir`, `status_aset`, `updated_at`, `created_at`, `deleted_at`) VALUES
('ASST_KTG-2_JNS-1_202209_0000000001', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Proses Pemusnahan', '2022-09-09 02:16:13', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000002', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Proses Pemusnahan', '2022-09-09 02:16:18', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000003', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-09 02:02:14', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000004', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000005', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000006', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000007', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000008', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000009', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000010', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000011', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000012', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000013', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000014', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000015', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000016', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000017', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000018', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000019', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL),
('ASST_KTG-2_JNS-1_202209_0000000020', 'Meja', '25000', 'LKS-1', 'JNS-1', 'KTG-2', 1, 'Sangat Bagus', '09/09/2022', 'Buah', '2022-09-09', '2025-09-09', 'Tersedia', '2022-09-08 20:15:39', '2022-09-08 20:15:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_hak_akses` int(3) NOT NULL,
  `nama_hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_hak_akses`, `nama_hak_akses`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Kepala Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_asset`
--

CREATE TABLE `jenis_asset` (
  `id_jenis_asset` varchar(6) NOT NULL,
  `nama_jenis` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_asset`
--

INSERT INTO `jenis_asset` (`id_jenis_asset`, `nama_jenis`, `updated_at`, `created_at`, `deleted_at`) VALUES
('JNS-1', 'Gedung', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_asset`
--

CREATE TABLE `kategori_asset` (
  `id_kategori_asset` varchar(6) NOT NULL,
  `nama_kategori` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_asset`
--

INSERT INTO `kategori_asset` (`id_kategori_asset`, `nama_kategori`, `updated_at`, `created_at`, `deleted_at`) VALUES
('KTG-1', 'Aset Bergerak', '2022-08-28 10:05:15', NULL, NULL),
('KTG-2', 'Aset Tidak Bergerak', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `kode_lokasi` varchar(6) NOT NULL,
  `nama_lokasi` varchar(20) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`kode_lokasi`, `nama_lokasi`, `updated_at`, `created_at`, `deleted_at`) VALUES
('LKS-1', 'Kelas 7A', '2022-08-28 10:28:00', NULL, NULL),
('LKS-2', 'Kelas 7B', NULL, NULL, NULL),
('LKS-3', 'Kelas 7C', '2022-08-29 19:05:52', '2022-08-29 19:05:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(4) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `kode_lokasi` varchar(6) NOT NULL,
  `penanggung_jawab` int(2) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_mutasi` enum('Proses Mutasi','Proses Pengajuan','Sudah Disetujui') NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(100) NOT NULL,
  `jenis_notifikasi` enum('Pengecekan Kondisi','Pengajuan Mutasi','Pengajuan Pemusnahan','Persetujuan Mutasi','Persetujuan Pemusnahan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_asset` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `jenis_notifikasi`, `keterangan`, `id_asset`, `read_at`, `created_at`, `updated_at`) VALUES
(122, 'Pengajuan Mutasi', 'Ada pengajuan Mutasi', 'ASST_KTG-1_JNS-1_202208_0000000003', '2022-08-29 22:58:15', '2022-08-29 19:40:38', '2022-08-29 19:40:38'),
(123, 'Persetujuan Mutasi', 'Pengajuan Mutasi Disetujui', 'ASST_KTG-1_JNS-1_202208_0000000003', '2022-08-29 20:47:28', '2022-08-29 19:42:11', '2022-08-29 19:42:11'),
(124, 'Persetujuan Mutasi', 'Pengajuan Mutasi Disetujui', 'ASST_KTG-1_JNS-1_202208_0000000003', '2022-09-09 02:18:11', '2022-08-29 22:58:54', '2022-08-29 22:58:54'),
(125, 'Pengajuan Pemusnahan', 'Ada pengajuan pemusnahan', 'ASST_KTG-2_JNS-1_202209_0000000001', '2022-09-09 02:18:47', '2022-09-09 02:17:41', '2022-09-09 02:17:41'),
(126, 'Pengajuan Pemusnahan', 'Ada pengajuan pemusnahan', 'ASST_KTG-2_JNS-1_202209_0000000002', '2022-09-09 02:18:43', '2022-09-09 02:17:41', '2022-09-09 02:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahan`
--

CREATE TABLE `pemusnahan` (
  `id_pemusnahan` int(4) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `penanggung_jawab` int(2) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_pemusnahan` enum('Proses Pemusnahan','Proses Pengajuan','Sudah Disetujui') NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemusnahan`
--

INSERT INTO `pemusnahan` (`id_pemusnahan`, `nama`, `penanggung_jawab`, `deskripsi`, `status_pemusnahan`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Muhammad Madum', 1, 'asdfasdf', 'Proses Pengajuan', '2022-09-09 02:17:41', '2022-09-09 02:16:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_mutasi`
--

CREATE TABLE `transaksi_mutasi` (
  `id_transaksi` int(4) NOT NULL,
  `id_mutasi` int(4) NOT NULL,
  `id_asset` varchar(40) CHARACTER SET latin1 NOT NULL,
  `kode_lokasi_sebelumnya` varchar(6) CHARACTER SET latin1 NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pemusnahan`
--

CREATE TABLE `transaksi_pemusnahan` (
  `id_transaksi` int(4) NOT NULL,
  `id_pemusnahan` int(4) NOT NULL,
  `id_asset` varchar(40) CHARACTER SET latin1 NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_pemusnahan`
--

INSERT INTO `transaksi_pemusnahan` (`id_transaksi`, `id_pemusnahan`, `id_asset`, `updated_at`, `created_at`, `deleted_at`) VALUES
(8, 1, 'ASST_KTG-2_JNS-1_202209_0000000001', '2022-09-09 02:16:13', '2022-09-09 02:16:13', NULL),
(9, 1, 'ASST_KTG-2_JNS-1_202209_0000000002', '2022-09-09 02:16:18', '2022-09-09 02:16:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(2) NOT NULL,
  `username` varchar(10) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `id_hak_akses` int(3) NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama_user`, `password`, `email`, `telepon`, `id_hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(1, 'makdum', 'Muhammad Madum', '$2a$12$3i6.dlEFgVuReB7a17n1MexdEfDcbnugIDFvKzjEbiQnBm4c4WCVW', 'superadmin@gmail.com', '082135276133', 1, 'aktif', '2017-04-01 08:15:15', '2022-07-08 01:57:25'),
(7, 'aku', 'Aku', '$2y$10$SgTKdA26I1h1og/ozKIvnu4IoRyqbjQFgIQoDyHB48R8S9eZ3IoTK', 'aku@gmail.com', '456456', 2, 'aktif', '2022-06-15 11:32:51', '2022-07-08 01:57:12'),
(8, 'herman', 'Herman', '$2y$10$JlPOx1gAFJBms6z/PgWtCenxx1M1u08s9j9mxK.CY/ZebFmujG2BK', 'herman@gmail.com', '5555', 3, 'aktif', '2022-06-16 00:10:02', '2022-08-10 09:22:03'),
(9, 'kepsek', 'Kepsek', '$2y$10$FuWYjsc.x7ygcVaQGcSb9ejOuSv8dbT.3R6rEyuXeBWmGcj581.aq', 'kepsek@gmail.com', '89898', 3, 'aktif', '2022-08-23 09:31:48', '2022-08-23 09:31:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id_asset`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`);

--
-- Indexes for table `jenis_asset`
--
ALTER TABLE `jenis_asset`
  ADD PRIMARY KEY (`id_jenis_asset`);

--
-- Indexes for table `kategori_asset`
--
ALTER TABLE `kategori_asset`
  ADD PRIMARY KEY (`id_kategori_asset`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`kode_lokasi`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `fk_users` (`penanggung_jawab`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  ADD PRIMARY KEY (`id_pemusnahan`),
  ADD KEY `fk_users` (`penanggung_jawab`);

--
-- Indexes for table `transaksi_mutasi`
--
ALTER TABLE `transaksi_mutasi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_pemusnahan`
--
ALTER TABLE `transaksi_pemusnahan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_hak_akses` (`id_hak_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_hak_akses` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  MODIFY `id_pemusnahan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_mutasi`
--
ALTER TABLE `transaksi_mutasi`
  MODIFY `id_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `transaksi_pemusnahan`
--
ALTER TABLE `transaksi_pemusnahan`
  MODIFY `id_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`penanggung_jawab`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_hak_akses` FOREIGN KEY (`id_hak_akses`) REFERENCES `hak_akses` (`id_hak_akses`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
