-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Nov 2020 pada 00.23
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujian_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(8) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `no_hp`, `email`) VALUES
('A001', 'Septian Wahyudi Rahman', '085961545691', 'codelingker@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bank_soal`
--

CREATE TABLE `tb_bank_soal` (
  `kode_soal` varchar(10) NOT NULL,
  `soal` text NOT NULL,
  `j_a` text NOT NULL,
  `j_b` text NOT NULL,
  `j_c` text NOT NULL,
  `j_d` text NOT NULL,
  `jawaban_benar` varchar(1) NOT NULL,
  `status_soal` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bank_soal`
--

INSERT INTO `tb_bank_soal` (`kode_soal`, `soal`, `j_a`, `j_b`, `j_c`, `j_d`, `jawaban_benar`, `status_soal`) VALUES
('S0001', '1 + 1 = ...', '2', '4', '6', '8', 'A', 1),
('S0002', '2 + 1 = ...', '2', '3', '4', '5', 'B', 1),
('S0003', '1 / 1 = ...', '4', '3', '2', '1', 'D', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban_peserta`
--

CREATE TABLE `tb_jawaban_peserta` (
  `id_jawaban` int(11) NOT NULL,
  `kode_ujian` varchar(10) NOT NULL,
  `kode_soal` varchar(8) NOT NULL,
  `jawaban_peserta` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jawaban_peserta`
--

INSERT INTO `tb_jawaban_peserta` (`id_jawaban`, `kode_ujian`, `kode_soal`, `jawaban_peserta`) VALUES
(1, 'US00001', 'S0001', 'A'),
(2, 'US00001', 'S0002', 'B'),
(3, 'US00001', 'S0003', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('Admin','Peserta') NOT NULL DEFAULT 'Peserta'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_login`
--

INSERT INTO `tb_login` (`id_login`, `id_user`, `email`, `password`, `level`) VALUES
(1, 'A001', 'admin', 'admin', 'Admin'),
(9, 'P0001', 'codelingker@gmail.com', '123', 'Peserta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` varchar(8) NOT NULL,
  `nama_peserta` varchar(30) NOT NULL,
  `email_peserta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `nama_peserta`, `email_peserta`) VALUES
('P0001', 'Septian', 'codelingker@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_soal_ujian`
--

CREATE TABLE `tb_soal_ujian` (
  `id_ujian` int(11) NOT NULL,
  `kode_soal` varchar(8) NOT NULL,
  `kode_token` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_soal_ujian`
--

INSERT INTO `tb_soal_ujian` (`id_ujian`, `kode_soal`, `kode_token`) VALUES
(1, 'S0003', 'caAcDE7'),
(2, 'S0002', 'caAcDE7'),
(3, 'S0001', 'caAcDE7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_token_master`
--

CREATE TABLE `tb_token_master` (
  `id_token` int(11) NOT NULL,
  `kode_token` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_token_master`
--

INSERT INTO `tb_token_master` (`id_token`, `kode_token`) VALUES
(1, 'caAcDE7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ujian_selesai`
--

CREATE TABLE `tb_ujian_selesai` (
  `kode_ujian` varchar(10) NOT NULL,
  `id_peserta` varchar(8) NOT NULL,
  `kode_token` varchar(10) NOT NULL,
  `total_nilai` varchar(5) NOT NULL,
  `tgl_submit_jawaban` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ujian_selesai`
--

INSERT INTO `tb_ujian_selesai` (`kode_ujian`, `id_peserta`, `kode_token`, `total_nilai`, `tgl_submit_jawaban`) VALUES
('US00001', 'P0001', 'caAcDE7', '66.7', '2020-11-29 05:15:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_bank_soal`
--
ALTER TABLE `tb_bank_soal`
  ADD PRIMARY KEY (`kode_soal`);

--
-- Indeks untuk tabel `tb_jawaban_peserta`
--
ALTER TABLE `tb_jawaban_peserta`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indeks untuk tabel `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indeks untuk tabel `tb_token_master`
--
ALTER TABLE `tb_token_master`
  ADD PRIMARY KEY (`id_token`);

--
-- Indeks untuk tabel `tb_ujian_selesai`
--
ALTER TABLE `tb_ujian_selesai`
  ADD PRIMARY KEY (`kode_ujian`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban_peserta`
--
ALTER TABLE `tb_jawaban_peserta`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_token_master`
--
ALTER TABLE `tb_token_master`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
