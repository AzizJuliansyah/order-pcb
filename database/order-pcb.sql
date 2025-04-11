-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Apr 2025 pada 18.31
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order-pcb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `jabatan` varchar(250) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role_id`, `jabatan`, `date_created`, `date_updated`) VALUES
(1, 1, 'Superadmin', '2025-04-11 13:35:06', '2025-04-11 13:35:06'),
(2, 2, 'Vendor Admin', '2025-04-11 13:35:06', '2025-04-11 13:35:06'),
(3, 3, 'Vendor Operator', '2025-04-11 13:35:06', '2025-04-11 13:35:06'),
(4, 4, 'Customer Service', '2025-04-11 13:35:06', '2025-04-11 13:35:06'),
(5, 5, 'Customer', '2025-04-11 13:35:06', '2025-04-11 13:35:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nomor` varchar(15) NOT NULL,
  `password` longtext NOT NULL,
  `foto` blob DEFAULT NULL,
  `provinsi` text DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `kecamatan` varchar(250) DEFAULT NULL,
  `kode_pos` int(11) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `tanggal_lahir` varchar(250) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `nomor`, `password`, `foto`, `provinsi`, `kota`, `kecamatan`, `kode_pos`, `alamat_lengkap`, `tanggal_lahir`, `role_id`, `is_active`, `date_created`, `date_updated`) VALUES
(1, 'Aziz Juliansyah ganteng', 'Bayubudikusuma2@gmail.com', '124121', '$2y$10$xdlvh9sWHFald8rPQn2leeQRDX5Hbei1DDTKcjoP/u1L7HSwGy2gq', NULL, NULL, NULL, '', 0, NULL, NULL, 5, 1, '2025-04-10 14:10:48', '2025-04-10 14:33:34'),
(2, 'Aziz Juliansyah ganteng', 'aziz@gmail.com', '085693204615', '$2y$10$Zc8GZWtiHsa0XZS/REus4.x4ANhtxnMAnfzKVbWAo.tqrey41MCSK', 0x7765625f6173736574732f696d616765732f757365725f70726f66696c652f757365725f325f313734343338363934322e706e67, 'Banten', 'Tangerang Selatan', 'Serpong Utara', 18620, 'Villa Mutiara Serpong Blok G2/3', '2006-07-11', 5, 1, '2025-04-10 15:07:50', '2025-04-11 15:55:42'),
(3, 'andika', 'instruktur@gmail.com', '124121', '$2y$10$CH52VCgh1hf7f3.juNj1J.6streZe9qQiaJpea8z9n.Lr9sl9gAcy', NULL, NULL, NULL, '', 0, NULL, NULL, 5, 1, '2025-04-10 15:31:35', '2025-04-10 15:31:35'),
(4, 'Nasi Goreng SE', 'admin@gmail.com', '085693204615', '$2y$10$CCPNBBIy366adGkZkRdoJ.thKS1fncbNkBzd/oefmxS2/SUc.jCHG', NULL, NULL, NULL, '', 0, NULL, NULL, 5, 1, '2025-04-10 15:33:20', '2025-04-10 15:33:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
