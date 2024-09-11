-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Sep 2024 pada 12.58
-- Versi server: 10.6.19-MariaDB
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gskstore_beban`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(31, 1, 10),
(32, 2, 10),
(33, 3, 10),
(34, 4, 10),
(35, 1, 11),
(36, 2, 11),
(37, 3, 11),
(38, 4, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(11, 'Laporan pengajuan', 'tbl_pengajuan/laporan', 'fa fa-archive', 0, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengajuan`
--

CREATE TABLE `tbl_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `berkas` text NOT NULL,
  `status` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_acc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`id_pengajuan`, `perihal`, `tanggal_pengajuan`, `berkas`, `status`, `catatan`, `keterangan`, `tanggal_acc`) VALUES
(13, 'Test Agustus', '2024-08-10', 'Screenshot_2024-07-26_153008.png', 10, 'done cek erzap', 'oke', '2024-08-10'),
(14, 'Beban Starlink', '2024-09-06', 'logo_soccotra1.png', 2, 'meraju', 'bulanan sdh dbmurahi', '2024-09-06'),
(15, 'Beban Transport', '2024-09-06', 'logo_soccotra.png', 1, 'Baru di Input', 'pertmax', '2024-09-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `id_update` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `tanggal_update` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_update`
--

INSERT INTO `tbl_update` (`id_update`, `id_pengajuan`, `tanggal_update`, `status`, `catatan`) VALUES
(23, 13, '2024-08-10 14:33:50', 1, 'Baru di Input'),
(24, 13, '2024-08-10 14:34:50', 4, 'oke acc'),
(25, 13, '2024-08-10 14:35:21', 7, 'lanjut pa fahmi'),
(26, 13, '2024-08-10 14:36:01', 10, 'done cek erzap'),
(27, 14, '2024-09-06 14:16:20', 1, 'Baru di Input'),
(28, 15, '2024-09-06 14:17:22', 1, 'Baru di Input'),
(29, 14, '2024-09-06 14:18:23', 4, 'ok'),
(30, 14, '2024-09-06 14:20:14', 6, 'kelarangan'),
(31, 14, '2024-09-06 14:24:30', 2, 'meraju');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_update`
--
ALTER TABLE `tbl_update`
  MODIFY `id_update` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
