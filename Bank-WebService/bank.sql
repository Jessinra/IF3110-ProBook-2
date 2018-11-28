-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 08:05 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `Nama` text NOT NULL,
  `Nomor_kartu` varchar(12) NOT NULL,
  `saldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`Nama`, `Nomor_kartu`, `saldo`) VALUES
('Nicholas Wijaya', '2147483647', 539703),
('toko', '123123123123', 2125.9),
('Ayrton', '123456789123', -1078.4);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `cardId` varchar(12) NOT NULL,
  `tokenKey` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `nomor_pengirim` int(11) NOT NULL,
  `nomor_penerima` int(11) NOT NULL,
  `jumlah` float NOT NULL DEFAULT '0',
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`nomor_pengirim`, `nomor_penerima`, `jumlah`, `waktu`) VALUES
(917361823, 2147483647, 10000, '2018-11-21 20:29:21'),
(2147483647, 2147483647, 26.96, '2018-11-22 23:21:00'),
(2147483647, 2147483647, 269.6, '2018-11-22 23:21:58'),
(2147483647, 2147483647, 269.6, '2018-11-22 23:24:09'),
(2147483647, 2147483647, -2, '2018-11-23 09:57:10'),
(2147483647, 2147483647, 106.868, '2018-11-23 10:12:08'),
(2147483647, 2147483647, 106.868, '2018-11-23 10:18:58'),
(2147483647, 2147483647, 269.6, '2018-11-26 18:21:47'),
(2147483647, 2147483647, 269.6, '2018-11-26 18:22:44'),
(2147483647, 2147483647, 269.6, '2018-11-26 18:31:27'),
(2147483647, 2147483647, 269.6, '2018-11-26 18:32:32'),
(2147483647, 2147483647, 269.6, '2018-11-26 18:35:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`cardId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
