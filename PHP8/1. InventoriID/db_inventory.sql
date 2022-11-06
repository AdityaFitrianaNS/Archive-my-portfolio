-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 02:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(4) NOT NULL,
  `kd_barang` varchar(16) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kd_barang`, `nama`, `jenis`, `tanggal_input`) VALUES
(7, '21312', 'asdasd', 'sad', '2022-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_keluar`
--

CREATE TABLE `tb_barang_keluar` (
  `id_barang_keluar` int(4) NOT NULL,
  `kd_barang` varchar(16) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang_keluar`
--

INSERT INTO `tb_barang_keluar` (`id_barang_keluar`, `kd_barang`, `nama`, `jenis`, `tanggal_keluar`) VALUES
(4, 'as', 'asd', 'asd', '2022-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_masuk`
--

CREATE TABLE `tb_barang_masuk` (
  `id_barang_masuk` int(4) NOT NULL,
  `kd_barang` varchar(16) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang_masuk`
--

INSERT INTO `tb_barang_masuk` (`id_barang_masuk`, `kd_barang`, `nama`, `jenis`, `tanggal_masuk`) VALUES
(3, '23', 'asd', 'sad', '2022-06-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indexes for table `tb_barang_masuk`
--
ALTER TABLE `tb_barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  MODIFY `id_barang_keluar` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_barang_masuk`
--
ALTER TABLE `tb_barang_masuk`
  MODIFY `id_barang_masuk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
