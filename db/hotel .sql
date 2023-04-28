-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 12:03 PM
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
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(5) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `username`) VALUES
(1, 'owner'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `nama` varchar(45) NOT NULL,
  `Noktp` varchar(200) NOT NULL,
  `Notelp` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`nama`, `Noktp`, `Notelp`) VALUES
('revangga', '1208120940219828', '082312391248');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pemesanan` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nama_kamar` varchar(45) CHARACTER SET utf8 NOT NULL,
  `tgl_check_in` date NOT NULL,
  `tgl_check_out` date NOT NULL,
  `total_inap` int(11) NOT NULL,
  `harga_kamar` int(20) NOT NULL,
  `item_tambahan` varchar(45) CHARACTER SET utf8 NOT NULL,
  `harga_tambahan` int(100) NOT NULL,
  `sub_total` int(100) NOT NULL,
  `diskon` float NOT NULL,
  `pajak` float NOT NULL,
  `total_harga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pemesanan`, `nama_kamar`, `tgl_check_in`, `tgl_check_out`, `total_inap`, `harga_kamar`, `item_tambahan`, `harga_tambahan`, `sub_total`, `diskon`, `pajak`, `total_harga`) VALUES
('LM202304140001', 'Mas Lux Family Room A1', '2023-04-14', '2023-04-15', 1, 600000, 'Bed (1) - Rp50000, Selimut (1) - Rp45000, Ban', 110000, 710000, 177500, 53250, 585750);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `Noktp` varchar(50) NOT NULL,
  `kode_pemesanan` varchar(45) NOT NULL,
  `nama_kamar` varchar(255) NOT NULL,
  `tgl_check_in` date NOT NULL,
  `tgl_check_out` date NOT NULL,
  `total_inap` int(10) NOT NULL,
  `jenis_hari` varchar(255) NOT NULL,
  `harga_kamar` int(20) NOT NULL,
  `item_tambahan` varchar(45) CHARACTER SET utf8 NOT NULL,
  `harga_tambahan` int(100) NOT NULL,
  `sub_total` int(100) NOT NULL,
  `diskon` float NOT NULL,
  `pajak` float NOT NULL,
  `total_harga` int(255) NOT NULL,
  `waktu_order` datetime NOT NULL DEFAULT current_timestamp(),
  `proses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`Noktp`, `kode_pemesanan`, `nama_kamar`, `tgl_check_in`, `tgl_check_out`, `total_inap`, `jenis_hari`, `harga_kamar`, `item_tambahan`, `harga_tambahan`, `sub_total`, `diskon`, `pajak`, `total_harga`, `waktu_order`, `proses`) VALUES
('1208120940219828', 'LM202304140001', 'Mas Lux Family Room A1', '2023-04-14', '2023-04-15', 1, 'Hari Biasa', 600000, 'Bed (1) - Rp50000, Selimut (1) - Rp45000, Ban', 110000, 710000, 177500, 53250, 585750, '2023-04-14 16:59:51', 'SELESAI');

-- --------------------------------------------------------

--
-- Table structure for table `stok_kamar`
--

CREATE TABLE `stok_kamar` (
  `nama_kamar` varchar(255) NOT NULL,
  `stok` double NOT NULL,
  `kamar_gambar` varchar(255) NOT NULL,
  `biasa` int(50) NOT NULL,
  `besar` int(50) NOT NULL,
  `akhir_pekan` int(50) NOT NULL,
  `tahun_baru` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_kamar`
--

INSERT INTO `stok_kamar` (`nama_kamar`, `stok`, `kamar_gambar`, `biasa`, `besar`, `akhir_pekan`, `tahun_baru`) VALUES
('Mas Lux Family Room A1', 1, 'k01.jpg', 600000, 1000000, 1100000, 2200000),
('Mas Lux Family Room A2', 1, 'k02.jpg', 450000, 1200000, 900000, 1400000),
('Mas Lux Family Room A3', 1, 'k03.jpg', 500000, 1800000, 1000000, 2000000),
('Mas Lux Room', 5, 'k04.jpg', 350000, 950000, 650000, 950000),
('Mas Room', 3, 'k05.jpg', 300000, 750000, 550000, 800000),
('Moderate Room', 8, 'k01.jpg', 250000, 650000, 450000, 700000),
('Standart Room', 9, 'k02.jpg', 150000, 350000, 250000, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `tambahan`
--

CREATE TABLE `tambahan` (
  `id_tambahan` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(45) CHARACTER SET utf8 NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tambahan`
--

INSERT INTO `tambahan` (`id_tambahan`, `nama`, `harga`) VALUES
('B01', 'Bed', 50000),
('B02', 'Selimut', 45000),
('B03', 'Bantal', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tbldiskon`
--

CREATE TABLE `tbldiskon` (
  `id` varchar(10) NOT NULL,
  `diskon` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbldiskon`
--

INSERT INTO `tbldiskon` (`id`, `diskon`) VALUES
('D01', 10),
('D02', 15),
('D03', 20),
('D04', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe_kamar` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nama_kamar` varchar(45) NOT NULL,
  `jenis_hari` varchar(45) NOT NULL,
  `Harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe_kamar`, `nama_kamar`, `jenis_hari`, `Harga`) VALUES
('LMB01', 'Standart Room', 'Biasa', 150000),
('LMB02', 'Moderate Room', 'Biasa', 250000),
('LMB03', 'Mas Room', 'Biasa', 300000),
('LMB04', 'Mas Lux Room', 'Biasa', 350000),
('LMBA1', 'Mas Lux Family Room A1', 'Biasa', 600000),
('LMBA2', 'Mas Lux Family Room A2', 'Biasa', 450000),
('LMBA3', 'Mas Lux Family Room A3', 'Biasa', 500000),
('LMBE01', 'Standart Room', 'Besar', 350000),
('LMBE02', 'Moderate Room', 'Besar', 650000),
('LMBE03', 'Mas Room', 'Besar', 750000),
('LMBE04', 'Mas Lux Room', 'Besar', 950000),
('LMBEA1', 'Mas Lux Family Room A1', 'Besar', 1000000),
('LMBEA2', 'Mas Lux Family Room A2', 'Besar', 1200000),
('LMBEA3', 'Mas Lux Family Room A3', 'Besar', 1800000),
('LMTB01', 'Standart Room', 'Tahun_baru', 400000),
('LMTB02', 'Moderate Room', 'Tahun_baru', 700000),
('LMTB03', 'Mas Room', 'Tahun_baru', 800000),
('LMTB04', 'Mas Lux Room', 'Tahun_baru', 950000),
('LMTBA1', 'Mas Lux Family Room A1', 'Tahun_baru', 2200000),
('LMTBA2', 'Mas Lux Family Room A2', 'Tahun_baru', 1400000),
('LMTBA3', 'Mas Lux Family Room A3', 'Tahun_baru', 2000000),
('LMW01', 'Standart Room', 'Weekend', 250000),
('LMW02', 'Moderate Room', 'Weekend', 450000),
('LMW03', 'Mas Room', 'Weekend', 550000),
('LMW04', 'Mas Lux Room', 'Weekend', 650000),
('LMWA1', 'Mas Lux Family Room A1', 'Weekend', 1100000),
('LMWA2', 'Mas Lux Family Room A2', 'Weekend', 900000),
('LMWA3', 'Mas Lux Family Room A3', 'Weekend', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `id_level`) VALUES
(1, 'owner', '12345678', 1),
(2, 'admin', 'admin', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`Noktp`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`kode_pemesanan`),
  ADD KEY `Noktp` (`Noktp`);

--
-- Indexes for table `stok_kamar`
--
ALTER TABLE `stok_kamar`
  ADD PRIMARY KEY (`nama_kamar`);

--
-- Indexes for table `tambahan`
--
ALTER TABLE `tambahan`
  ADD PRIMARY KEY (`id_tambahan`);

--
-- Indexes for table `tbldiskon`
--
ALTER TABLE `tbldiskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id_tipe_kamar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
