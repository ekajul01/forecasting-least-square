-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2022 at 05:09 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forecasting_least_square`
--

-- --------------------------------------------------------

--
-- Table structure for table `harga_emas`
--

CREATE TABLE `harga_emas` (
  `id` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_emas`
--

INSERT INTO `harga_emas` (`id`, `tanggal`, `harga`) VALUES
(1, '01 Nov 2022', 936000),
(2, '02 Nov 2022', 944000),
(3, '03 Nov 2022', 939000),
(4, '04 Nov 2022', 939000),
(5, '05 Nov 2022', 954000),
(6, '06 Nov 2022', 954000),
(7, '07 Nov 2022', 951000),
(8, '08 Nov 2022', 950000),
(9, '09 Nov 2022', 961000),
(10, '10 Nov 2022', 959000),
(11, '11 Nov 2022', 974000),
(12, '12 Nov 2022', 972000),
(13, '13 Nov 2022', 972000),
(14, '14 Nov 2022', 970000),
(15, '15 Nov 2022', 973000),
(16, '16 Nov 2022', 981000),
(17, '17 Nov 2022', 981000),
(18, '18 Nov 2022', 980000),
(19, '19 Nov 2022', 978000),
(20, '20 Nov 2022', 978000),
(21, '21 Nov 2022', 978000),
(22, '22 Nov 2022', 975000),
(23, '23 Nov 2022', 977000),
(24, '24 Nov 2022', 981000),
(25, '25 Nov 2022', 980000),
(26, '26 Nov 2022', 981000),
(27, '27 Nov 2022', 981000),
(28, '28 Nov 2022', 979000),
(29, '29 Nov 2022', 977000),
(30, '30 Nov 2022', 981000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `notelp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `alamat`, `notelp`) VALUES
('admin', 'qwerty123', 'eka', 'gresik', '089987654321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harga_emas`
--
ALTER TABLE `harga_emas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harga_emas`
--
ALTER TABLE `harga_emas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
