-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Des 2019 pada 08.04
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hrd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `idjabatan` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `honor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`idjabatan`, `jabatan`, `honor`) VALUES
(1, 'Staff HRD', 2900002),
(7, 'Staff Produksi', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` int(11) NOT NULL,
  `nama` varchar(22) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jkelamin` varchar(20) NOT NULL,
  `lulusan` varchar(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `idjabatan` int(11) NOT NULL,
  `input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `nama`, `alamat`, `jkelamin`, `lulusan`, `foto`, `idjabatan`, `input`) VALUES
(11, 'Misha', 'Bogor', 'Wanita', 'STM', '', 1, '2019-11-28 12:07:43'),
(12, 'lkjlk', 'kljlk', 'Pria', 'SMA', '30f676ec3b0213ca7ca7b259e2e603bf47d45df1.png', 3, '2019-11-28 13:03:08'),
(15, ';lk', 'l;k;', 'Pria', '', 'img_20191212_140210.jpg', 1, '2019-12-12 13:02:10'),
(16, 'l;k', ';k;lk;', 'Pria', '', 'img_20191212_141141.jpg', 1, '2019-12-12 13:10:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `email`) VALUES
('ku', '098f6bcd4621d373cade4e832627b4f6', 'ui@iu.co'),
('test', '098f6bcd4621d373cade4e832627b4f6', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`idjabatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `idjabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idpegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
