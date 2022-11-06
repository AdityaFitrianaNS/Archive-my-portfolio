-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Agu 2022 pada 03.33
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_animedit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anime_user`
--

CREATE TABLE `anime_user` (
  `id_anime` int(10) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `musim` varchar(16) DEFAULT NULL,
  `studio` varchar(50) DEFAULT NULL,
  `posted_by` varchar(50) DEFAULT NULL,
  `date_posted` timestamp NULL DEFAULT current_timestamp(),
  `sinopsis` text DEFAULT NULL,
  `id_user` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anime_user`
--

INSERT INTO `anime_user` (`id_anime`, `gambar`, `judul`, `musim`, `studio`, `posted_by`, `date_posted`, `sinopsis`, `id_user`) VALUES
(9, '62f8cfb698f7c.png', 'Rust', 'Fall', 'Rust', 'r', '2022-08-14 10:34:30', 'AKLJASKLDJ\r\n ', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `foto`, `first_name`, `last_name`, `email`, `username`, `password`, `date_created`) VALUES
(6, '62de256c05360.png', 'r', 'r', 'w@gmail.com', 'r', '$2y$10$FV590OMxv5RQ9fvpJ8/j3O4TsvWTlAwlw8J4x4lJn9PvAtMBsVKNG', '2022-07-25 05:09:00'),
(7, '62f8d224b8703.png', 'rust', 'rust', 'rust@gmail.com', 'rust', '$2y$10$SH8PLjhrBGA9wqzysrtzwuZblwVPHHp5WQuHEw84rghKPbZSCpAvq', '2022-08-14 10:44:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `waifu_user`
--

CREATE TABLE `waifu_user` (
  `id_waifu` int(10) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `anime` varchar(50) DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `posted_by` varchar(50) DEFAULT NULL,
  `date_posted` timestamp NULL DEFAULT current_timestamp(),
  `deskripsi` text DEFAULT NULL,
  `id_user` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waifu_user`
--

INSERT INTO `waifu_user` (`id_waifu`, `gambar`, `nama`, `anime`, `gender`, `posted_by`, `date_posted`, `deskripsi`, `id_user`) VALUES
(8, '62f8cf9dc7a9d.png', 'Rust', 'Rust', 'Male', 'r', '2022-08-14 10:34:05', ' sasadsad', 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anime_user`
--
ALTER TABLE `anime_user`
  ADD PRIMARY KEY (`id_anime`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `waifu_user`
--
ALTER TABLE `waifu_user`
  ADD PRIMARY KEY (`id_waifu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anime_user`
--
ALTER TABLE `anime_user`
  MODIFY `id_anime` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `waifu_user`
--
ALTER TABLE `waifu_user`
  MODIFY `id_waifu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
