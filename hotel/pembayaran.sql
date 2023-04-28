-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 05:03 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pemesanan` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(45) CHARACTER SET utf8 NOT NULL,
  `total_inap` int(10) NOT NULL,
  `harga_kamar` int(20) NOT NULL,
  `harga_tambahan` int(100) NOT NULL,
  `pajak` float NOT NULL,
  `total_harga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pemesanan`, `nama`, `total_inap`, `harga_kamar`, `harga_tambahan`, `pajak`, `total_harga`) VALUES
('LM202303250001', 'Standart Room', 2, 350000, 45000, 74500, 819500),
('LM202303250002', 'Moderate Room', 2, 700000, 45000, 144500, 1589500),
('LM202303250003', 'Mas Room', 3, 750000, 50000, 230000, 2530000),
('LM202303250004', 'Standart Room', 2, 350000, 45000, 74500, 819500),
('LM202303250005', 'Mas Room', 5, 550000, 50000, 280000, 3080000),
('LM202303250006', 'Mas Room', 2, 750000, 45000, 154500, 1699500),
('LM202303250007', 'Moderate Room', 5, 650000, 45000, 329500, 3624500),
('LM202303250008', 'Standart Room', 1, 350000, 45000, 39500, 434500),
('LM202303250009', 'Standart Room', 0, 550000, 45000, 4500, 49500),
('LM202303250010', 'Standart Room', 2, 350000, 15000, 71500, 786500),
('LM202303260011', 'Moderate Room', 1, 700000, 45000, 74500, 819500),
('LM202303280001', 'Standart Room', 1, 0, 0, 0, 0),
('LM202304030002', 'Mas Lux Family Room A1', 11, 0, 45000, 4500, 49500),
('LM202304050005', 'Mas Lux Room', 2, 350000, 0, 70000, 770000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pemesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
