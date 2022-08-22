-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 05:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

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
  `status_mutasi` int(1) NOT NULL,
  `status_aset` enum('Tersedia','Perlu Pengecekan','Dimusnahkan','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id_asset`, `nama_asset`, `harga_satuan`, `kode_lokasi`, `id_jenis_asset`, `id_kategori_asset`, `id_user`, `kondisi`, `tgl_input`, `satuan`, `umur_mulai`, `umur_akhir`, `status_mutasi`, `status_aset`) VALUES
('ASST_KTG-1_JNS-1_202208_0000000001', 'Meja', '1000000', 'LKS-2', 'JNS-1', 'KTG-1', 1, 'Sangat Bagus', '08/08/2022', 'Buah', '2022-08-08', '2023-08-08', 0, 'Tersedia'),
('ASST_KTG-1_JNS-1_202208_0000000002', 'Meja', '1000000', 'LKS-2', 'JNS-1', 'KTG-1', 1, 'Sangat Bagus', '08/08/2022', 'Buah', '2022-08-08', '2023-08-08', 0, 'Tersedia'),
('ASST_KTG-1_JNS-1_202208_0000000003', 'Meja', '1000000', 'LKS-1', 'JNS-1', 'KTG-1', 1, 'Sangat Bagus', '08/08/2022', 'Buah', '2022-08-08', '2023-08-08', 0, 'Tersedia');

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
  `nama_jenis` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_asset`
--

INSERT INTO `jenis_asset` (`id_jenis_asset`, `nama_jenis`) VALUES
('JNS-1', 'Gedung');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_asset`
--

CREATE TABLE `kategori_asset` (
  `id_kategori_asset` varchar(6) NOT NULL,
  `nama_kategori` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_asset`
--

INSERT INTO `kategori_asset` (`id_kategori_asset`, `nama_kategori`) VALUES
('KTG-1', 'Aset Bergerak'),
('KTG-2', 'Aset Tidak Bergerak');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `kode_lokasi` varchar(6) NOT NULL,
  `nama_lokasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`kode_lokasi`, `nama_lokasi`) VALUES
('LKS-1', 'Kelas 7A'),
('LKS-2', 'Kelas 7B');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(4) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `lokasi` varchar(6) NOT NULL,
  `penanggung_jawab` int(2) NOT NULL,
  `deskripsi` text NOT NULL,
  `status_mutasi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`id_mutasi`, `nama`, `lokasi`, `penanggung_jawab`, `deskripsi`, `status_mutasi`) VALUES
(1, 'Mutasi Pemindahan Meja', 'LKS-2', 1, 'Pemindahan meja dari kelas 7A ke 7B dilakukan karena jumlah meja dari masing-masing kelas tidak sesuai', 2);

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
(39, 'Pengajuan Mutasi', 'Ada pengajuan Mutasi', 'ASST_KTG-1_JNS-1_202208_0000000001', NULL, '2022-08-10 09:50:29', '2022-08-10 09:50:29'),
(40, 'Pengajuan Mutasi', 'Ada pengajuan Mutasi', 'ASST_KTG-1_JNS-1_202208_0000000002', NULL, '2022-08-10 09:50:29', '2022-08-10 09:50:29'),
(41, 'Persetujuan Mutasi', 'Pengajuan Mutasi Disetujui', 'ASST_KTG-1_JNS-1_202208_0000000001', NULL, '2022-08-10 09:50:46', '2022-08-10 09:50:46'),
(42, 'Persetujuan Mutasi', 'Pengajuan Mutasi Disetujui', 'ASST_KTG-1_JNS-1_202208_0000000002', NULL, '2022-08-10 09:50:46', '2022-08-10 09:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_mutasi`
--

CREATE TABLE `transaksi_mutasi` (
  `id_transaksi` int(4) NOT NULL,
  `id_mutasi` int(4) NOT NULL,
  `id_asset` varchar(40) CHARACTER SET latin1 NOT NULL,
  `kode_lokasi_sebelumnya` varchar(6) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_mutasi`
--

INSERT INTO `transaksi_mutasi` (`id_transaksi`, `id_mutasi`, `id_asset`, `kode_lokasi_sebelumnya`) VALUES
(105, 1, 'ASST_KTG-1_JNS-1_202208_0000000001', 'LKS-1'),
(106, 1, 'ASST_KTG-1_JNS-1_202208_0000000002', 'LKS-1');

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
(8, 'herman', 'Herman', '$2y$10$JlPOx1gAFJBms6z/PgWtCenxx1M1u08s9j9mxK.CY/ZebFmujG2BK', 'herman@gmail.com', '5555', 3, 'aktif', '2022-06-16 00:10:02', '2022-08-10 09:22:03');

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
  ADD PRIMARY KEY (`id_mutasi`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_mutasi`
--
ALTER TABLE `transaksi_mutasi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `transaksi_mutasi`
--
ALTER TABLE `transaksi_mutasi`
  MODIFY `id_transaksi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
