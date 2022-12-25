-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 11:51 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bps1206`
--

-- --------------------------------------------------------

--
-- Table structure for table `regsosek2022_absensi`
--

CREATE TABLE `regsosek2022_absensi` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `datang` varchar(8) NOT NULL,
  `pulang` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regsosek2022_absensi`
--

INSERT INTO `regsosek2022_absensi` (`id`, `email`, `tanggal`, `datang`, `pulang`) VALUES
(18, 'gracesimatupang193@mail.com', '2022-12-22', '09:30:00', '16:00:00'),
(21, 'asm34686@gmail.com', '2022-12-22', '09:00:00', NULL),
(32, 'yuyunaritonang01@gmail.com', '2022-12-22', '09:00:00', '16:30:00'),
(34, 'simbolon87@gmail.com', '2022-12-22', '09:00:00', '16:25:00'),
(35, 'gracesimatupang193@mail.com', '2022-12-23', '08:30:00', '16:30:00'),
(36, 'yuyunaritonang01@gmail.com', '2022-12-23', '08:32:00', '16:30:00'),
(37, 'simbolon87@gmail.com', '2022-12-23', '09:54:00', '16:23:00'),
(38, 'melinsitorus54@gmail.com', '2022-12-23', '09:00:00', '16:24:00'),
(39, 'rottur.simangunsong@gmail.com', '2022-12-23', '10:00:00', '16:24:00'),
(40, 'napitupulujuni75@gmail.com', '2022-12-23', '08:30:00', '16:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regsosek2022_absensi`
--
ALTER TABLE `regsosek2022_absensi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regsosek2022_absensi`
--
ALTER TABLE `regsosek2022_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
