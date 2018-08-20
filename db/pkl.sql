-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2018 at 09:11 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `Nik` varchar(16) NOT NULL,
  `Nama_Lengkap` varchar(60) NOT NULL,
  `Tempat_Lahir` varchar(20) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Pekerjaan` varchar(50) NOT NULL,
  `Alamat` varchar(60) NOT NULL,
  `Rt` int(3) NOT NULL,
  `Rw` int(3) NOT NULL,
  `Kelurahan` varchar(20) NOT NULL,
  `Kabupaten/Kota` varchar(30) NOT NULL,
  `Provinsi` varchar(30) NOT NULL,
  `picture` varchar(80) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `goldar` varchar(3) NOT NULL,
  `Jenis_Kelamin` varchar(12) NOT NULL,
  `agama` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`Nik`, `Nama_Lengkap`, `Tempat_Lahir`, `Tanggal_Lahir`, `Status`, `Pekerjaan`, `Alamat`, `Rt`, `Rw`, `Kelurahan`, `Kabupaten/Kota`, `Provinsi`, `picture`, `goldar`, `Jenis_Kelamin`, `agama`) VALUES
('7676767', 'Arief Nur Abdullah', 'Surabaya', '1997-05-07', 'BELUM KAWIN', 'Belum / Tidak Bekerja', 'Jl. Jenggolo 4 no 53', 6, 6, 'Pucang', 'Sidoarjo', 'Jawa Timur', '../uploads/Biospray.jpg', 'O', 'Laki-laki', 'ISLAM');

-- --------------------------------------------------------

--
-- Table structure for table `user/login`
--

CREATE TABLE `user/login` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Status` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user/login`
--

INSERT INTO `user/login` (`Username`, `Password`, `Status`) VALUES
('arief', '123456', 'Admin'),
('petugas', 'petugas', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD UNIQUE KEY `Nik` (`Nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
