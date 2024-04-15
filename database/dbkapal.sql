-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 03:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkapal`
--

-- --------------------------------------------------------

--
-- Table structure for table `kapal`
--

CREATE TABLE `kapal` (
  `id_kapal` varchar(5) NOT NULL,
  `rute` varchar(100) NOT NULL,
  `plb_asal` varchar(50) NOT NULL,
  `plb_tujuan` varchar(50) NOT NULL,
  `tgl_brgkt` date NOT NULL,
  `waktu_brgkt` time NOT NULL,
  `estimasi` varchar(25) NOT NULL,
  `kapasitas` int(15) NOT NULL,
  `harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kapal`
--

INSERT INTO `kapal` (`id_kapal`, `rute`, `plb_asal`, `plb_tujuan`, `tgl_brgkt`, `waktu_brgkt`, `estimasi`, `kapasitas`, `harga`) VALUES
('KP001', 'Labuan Bajo (Flores) - Pulau Komodo', 'Pelabuhan Labuan Bajo, Flores', 'Pelabuhan Pulau Komodo', '2024-04-20', '14:35:00', '5 Jam', 70, 15000),
('KP002', 'Penyeberangan Bali - Gili Trawangan', 'Pelabuhan Serangan, Bali', 'Pelabuhan Gili Trawangan, Lombok', '2024-04-30', '14:00:00', '4 Jam', 2, 300000),
('KP003', 'Mudik Lebaran', 'Pelabuhan Semayang', 'Pelabuhan Tanjung Perak', '2024-04-05', '23:12:00', '1 hari', 50, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` varchar(5) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `id_kapal` varchar(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `total_harga` int(15) NOT NULL,
  `status` varchar(25) NOT NULL,
  `waktu_byr` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_user`, `id_kapal`, `jumlah`, `total_harga`, `status`, `waktu_byr`) VALUES
('TX001', 'US003', 'KP002', 1, 300000, 'Berhasil', '2024-04-04'),
('TX002', 'US003', 'KP002', 3, 900000, 'Berhasil', '2024-04-04'),
('TX003', 'US004', 'KP002', 1, 300000, 'Berhasil', '2024-04-04'),
('TX004', 'US004', 'KP001', 4, 60, 'Berhasil', '2024-04-04'),
('TX005', 'US004', 'KP001', 1, 15000, 'Berhasil', '2024-04-04'),
('TX006', 'US004', 'KP001', 10, 150000, 'Berhasil', '2024-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(5) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL DEFAULT 'user',
  `saldo` int(25) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `saldo`) VALUES
('US001', 'Admin1', 'admin', '123', 'admin', 0),
('US003', 'Siti', 'siti', '123', 'user', 150000),
('US005', 'Super Admin', 'superadmin', '123', 'superadmin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kapal`
--
ALTER TABLE `kapal`
  ADD PRIMARY KEY (`id_kapal`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
