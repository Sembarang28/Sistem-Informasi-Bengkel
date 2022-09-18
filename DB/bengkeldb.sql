-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 08:44 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkeldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` char(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `alamat`, `telepon`) VALUES
('AD1', 'Naruto', 'ADMIN', 'ADMIN09876!@#$%', 'Jl. Konoha', '08127214170');

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `id_montir` char(255) NOT NULL,
  `nama_montir` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `montir`
--

INSERT INTO `montir` (`id_montir`, `nama_montir`, `alamat`, `telepon`) VALUES
('MO1', 'Jack', 'Jl. Azalea', '082272141797'),
('MO2', 'Cloud', 'Midgar', '082272141799'),
('MO3', 'Ris Rio', 'Mugello', '091000999777');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username`, `password`, `alamat`, `telepon`) VALUES
('PL1', 'Asep Surasep', 'Asep77', 'Asep77!@#', 'Jl. Merdeka', '081772211470'),
('PL2', 'Jono Superjon', 'Jon88', 'Jono88!@#', 'Jl. Kemerdekaan', '081772211471');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` char(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `nama`, `username`, `password`) VALUES
('PM1', 'Sasuke', 'sasuke', 'sasuke888'),
('PM2', 'Naruto', 'Naruto', 'naruto');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_service` char(10) NOT NULL,
  `id_pelanggan` char(255) NOT NULL,
  `id_montir` char(255) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `nama_montir` varchar(255) NOT NULL,
  `plat_kendaraan` char(8) NOT NULL,
  `jenis_kendaraan` enum('Mobil','Motor') NOT NULL,
  `masalah` text NOT NULL,
  `service` text NOT NULL,
  `harga` int(11) NOT NULL,
  `bukti_bayar` text NOT NULL,
  `status` enum('Pemesanan','Dalam Pengerjaan','Pembayaran','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id_service`, `id_pelanggan`, `id_montir`, `tanggal`, `nama_pelanggan`, `nama_montir`, `plat_kendaraan`, `jenis_kendaraan`, `masalah`, `service`, `harga`, `bukti_bayar`, `status`) VALUES
('SR1', 'PL1', 'MO1', '2022-05-28', 'Asep Surasep', 'Jack', 'DD2828DT', 'Motor', 'Ban Bocor', 'Ganti Ban', 300000, '6295932f42b0c.', 'Pemesanan'),
('SR2', 'PL2', 'MO2', '2022-05-29', 'Jon Superjon', 'Cloud', 'DD2929DT', 'Mobil', 'Tidak bisa di stater', 'Ganti aki', 200000, '', 'Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE `sparepart` (
  `id_sparepart` char(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int(10) UNSIGNED NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`id_sparepart`, `nama_barang`, `stok`, `harga`) VALUES
('SP1', 'Aki', 100, 100000),
('SP2', 'Ban Motor', 100, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(10) NOT NULL,
  `id_pelanggan` char(255) NOT NULL,
  `id_sparepart` char(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `bukti_bayar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_sparepart`, `nama_pelanggan`, `nama_barang`, `qty`, `harga`, `bukti_bayar`) VALUES
('TR1', 'PL1', 'SP1', 'Asep Surasep', 'Aki', 1, 100000, ''),
('TR2', 'PL2', 'SP2', 'Jono Superjon', 'Ban Motor', 1, 200000, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
  ADD PRIMARY KEY (`id_montir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_montir` (`id_montir`);

--
-- Indexes for table `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_sparepart` (`id_sparepart`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`id_montir`) REFERENCES `montir` (`id_montir`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_sparepart`) REFERENCES `sparepart` (`id_sparepart`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
