-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 11:50 PM
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
-- Table structure for table `regsosek2022_entrian`
--

CREATE TABLE `regsosek2022_entrian` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dok_clean` int(11) NOT NULL,
  `dok_warning` int(11) NOT NULL,
  `dok_error` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regsosek2022_entrian`
--

INSERT INTO `regsosek2022_entrian` (`id`, `email`, `dok_clean`, `dok_warning`, `dok_error`, `total`, `tanggal`) VALUES
(1, 'melinsitorus54@gmail.com', 786, 66, 0, 852, '0000-00-00 00:00:00'),
(2, 'rottur.simangunsong@gmail.com', 687, 89, 67, 843, '0000-00-00 00:00:00'),
(3, 'mirandapasaribu06@gmail.com', 718, 88, 13, 819, '0000-00-00 00:00:00'),
(4, 'simbolon87@gmail.com', 663, 37, 111, 811, '0000-00-00 00:00:00'),
(5, 'rivanihutapea39@gmail.com', 539, 97, 163, 799, '0000-00-00 00:00:00'),
(6, 'dutinovitaas@gmail.com', 595, 113, 88, 796, '0000-00-00 00:00:00'),
(7, 'napitupulujuni75@gmail.com', 666, 53, 50, 769, '0000-00-00 00:00:00'),
(8, 'yuyunaritonang01@gmail.com', 583, 107, 60, 750, '0000-00-00 00:00:00'),
(9, 'gracesimatupang193@mail.com', 548, 77, 79, 704, '0000-00-00 00:00:00'),
(10, 'nathanaelrajagukguk5@gmail.com', 551, 70, 71, 692, '0000-00-00 00:00:00'),
(11, 'windasimangunsong18@gmail.com', 502, 147, 31, 680, '0000-00-00 00:00:00'),
(12, 'asm34686@gmail.com', 503, 104, 57, 664, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regsosek2022_entrian`
--
ALTER TABLE `regsosek2022_entrian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `regsosek2022_entrian`
--
ALTER TABLE `regsosek2022_entrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
