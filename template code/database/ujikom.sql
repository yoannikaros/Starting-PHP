-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2023 pada 12.18
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `id_data` int(111) NOT NULL,
  `name` text NOT NULL,
  `des` text NOT NULL,
  `photos` text NOT NULL,
  `id_users` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`id_data`, `name`, `des`, `photos`, `id_users`) VALUES
(3, 'Yoan Nikaros', 'asdasd', 'uploads/logo.png', 0),
(4, 'Jurnal Review2.pdf', 'asd', 'uploads/20130226_093406.JPG', 0),
(5, 'Jurnal pake banget', 'aaaaaaaaaaaa', '../tambah/uploads/pasfoto.jpg', 1),
(8, 'Yoan Nikaros', 'asdasd', 'uploads/pasfoto-removebg-preview.png', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` text NOT NULL,
  `foto` text NOT NULL,
  `status` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `name`, `foto`, `status`, `email`, `pass`) VALUES
(1, 'Yoan Nikaros', 'logo.png', 'admin', 'yoannikaros29@gmail.com', '$2y$10$6roUn84OyLY1Q3Xgoyd3X.iwArtPmJFdNwCzOmItjgFdEMlNJVx8G'),
(4, 'Yoan Nikaros', '', 'user', 'yoannikaros@gmail.com', '$2y$10$j..798zHCgJUtP92ZvZNhOmyIriqFS9dIhjnXg5V..77r1vxjVKry');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `id_data` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
