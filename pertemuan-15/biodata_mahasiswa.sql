-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2026 at 02:46 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pwd2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata_mahasiswa`
--

CREATE TABLE `biodata_mahasiswa` (
  `cid` int(10) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `pasangan` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `nama_kakak` varchar(100) DEFAULT NULL,
  `nama_adik` varchar(100) DEFAULT NULL,
  `dcreated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata_mahasiswa`
--

INSERT INTO `biodata_mahasiswa` (`cid`, `nim`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `hobi`, `pasangan`, `pekerjaan`, `nama_orang_tua`, `nama_kakak`, `nama_adik`, `dcreated_at`) VALUES
(6, '2511500063', 'ekaaabaiop', 'pkpi', '2026-01-08', 'masak', 'adalah', 'bos', 'yanto', 'caca', 'eca', '2026-01-11 17:42:10'),
(7, '2511500063', 'galang', 'pangkalpinang', '2007-05-06', 'MASAK', 'MEI', 'nguli', 'arrr', 'babbb', 'kolllll', '2026-01-11 18:43:24'),
(8, '2511500041', 'Argya', 'Bandung', '2006-08-18', 'Bola', 'NO', 'Barista', 'SECRET', 'SECRET', 'SECRET', '2026-01-11 18:45:48'),
(9, '2511500063', 'gilang', 'toboali', '2007-06-27', 'Bola', 't', 'nguli', 'arrrr', 'babbb', 'kolllll', '2026-01-11 19:23:02'),
(10, '2511500063', 'galang', 'pangkalpinang', '2007-05-06', 'MASAK', 'MEI', 'Barista', 'SECRET', 'babbb', 'kolllll', '2026-01-12 09:45:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata_mahasiswa`
--
ALTER TABLE `biodata_mahasiswa`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata_mahasiswa`
--
ALTER TABLE `biodata_mahasiswa`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
