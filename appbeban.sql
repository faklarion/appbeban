-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Jul 2024 pada 07.10
-- Versi server: 8.0.30
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appbeban`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int NOT NULL,
  `id_user_level` int NOT NULL,
  `id_menu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(31, 1, 10),
(32, 2, 10),
(33, 3, 10),
(34, 4, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'data pengajuan', 'tbl_pengajuan', 'fa fa-check', 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengajuan`
--

CREATE TABLE `tbl_pengajuan` (
  `id_pengajuan` int NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `berkas` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`id_pengajuan`, `perihal`, `tanggal_pengajuan`, `berkas`, `status`, `catatan`, `keterangan`) VALUES
(4, 'Festival Musik', '2024-06-11', 'logo_zed2.png', 10, 'Sudah di acc di erzap', ''),
(5, 'Beban', '2024-06-24', 'IMG_6757.jpeg', 10, 'test', ''),
(6, 'test', '2024-06-24', 'IMG-20240624-WA0010.jpg', 10, 'Mantab', ''),
(7, 'test juli', '2024-07-08', 'Yuta_Okkotsu_29.jpg', 10, 'oke', 'test'),
(8, 'test agustussss', '2024-07-31', 'apple-iphone-se-2020.jpg', 4, 'oke gas', 'test'),
(9, 'test agustussss 2', '2024-07-31', 'apple-iphone-se-2022.jpg', 1, 'Baru di Input', 'sdadsa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_update`
--

CREATE TABLE `tbl_update` (
  `id_update` int NOT NULL,
  `id_pengajuan` int NOT NULL,
  `tanggal_update` datetime NOT NULL,
  `status` int NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_update`
--

INSERT INTO `tbl_update` (`id_update`, `id_pengajuan`, `tanggal_update`, `status`, `catatan`) VALUES
(1, 7, '2024-07-08 12:10:04', 1, ''),
(2, 7, '2024-07-08 12:26:11', 4, ''),
(3, 7, '2024-07-08 12:30:31', 7, ''),
(4, 7, '2024-07-08 12:32:16', 10, ''),
(5, 6, '2024-07-18 10:16:33', 10, 'Mantab'),
(6, 8, '2024-07-31 14:54:12', 1, 'Baru di Input'),
(7, 8, '2024-07-31 14:55:41', 4, 'oke gas'),
(8, 9, '2024-07-31 14:56:07', 1, 'Baru di Input');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'Admin Erzap', 'admin@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y'),
(2, 'GM Smartphone', 'gmsyihab@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 2, 'y'),
(3, 'CEO Zed', 'ceo@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 3, 'y'),
(4, 'Manager Keuangan', 'keuangan@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 4, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'GM Smartphone'),
(3, 'CEO'),
(4, 'Manager Keuangan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tbl_update`
--
ALTER TABLE `tbl_update`
  ADD PRIMARY KEY (`id_update`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  MODIFY `id_pengajuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_update`
--
ALTER TABLE `tbl_update`
  MODIFY `id_update` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
