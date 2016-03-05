-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2016 at 04:35 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenisservice`
--

CREATE TABLE IF NOT EXISTS `jenisservice` (
  `IDJenisService` varchar(5) NOT NULL,
  `NmJenisService` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `NIK` varchar(20) NOT NULL,
  `NmKaryawan` varchar(50) NOT NULL,
  `AlamatKaryawan` varchar(50) NOT NULL,
  `TelpKaryawan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
  `NoPlat` varchar(20) NOT NULL,
  `Tahun` varchar(4) NOT NULL,
  `TarifPerJam` int(11) NOT NULL,
  `StatusRental` varchar(1) NOT NULL,
  `IDType` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `UserName` varchar(10) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `TypeUser` varchar(10) NOT NULL,
  `IDUser` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_pelanggan`
--

CREATE TABLE IF NOT EXISTS `login_pelanggan` (
  `id_session` varchar(20) NOT NULL,
  `NoKTP` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE IF NOT EXISTS `merk` (
  `KodeMerk` varchar(5) NOT NULL,
  `NmMerk` varchar(20) NOT NULL,
  `Keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `NoKTP` varchar(20) NOT NULL,
  `NamaPel` varchar(50) NOT NULL,
  `AlamatPel` varchar(50) NOT NULL,
  `TelpPel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE IF NOT EXISTS `pemilik` (
  `KodePemilik` varchar(5) NOT NULL,
  `NmPemilik` varchar(20) NOT NULL,
  `AlamatPemilik` varchar(50) NOT NULL,
  `TelpPemilik` varchar(20) NOT NULL,
  `NoPlat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `KodeService` varchar(5) NOT NULL,
  `TglService` date NOT NULL,
  `BiayaService` int(11) NOT NULL,
  `NoPlat` varchar(20) NOT NULL,
  `IDJenisService` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setoran`
--

CREATE TABLE IF NOT EXISTS `setoran` (
  `NoSetoran` varchar(5) NOT NULL,
  `TglSetoran` date NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `KodePemilik` varchar(5) NOT NULL,
  `NIK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE IF NOT EXISTS `sopir` (
  `IDSopir` varchar(5) NOT NULL,
  `NmSopir` varchar(20) NOT NULL,
  `AlamatSopir` varchar(50) NOT NULL,
  `TelpSopir` varchar(20) NOT NULL,
  `NoSIM` varchar(30) NOT NULL,
  `TarifPerJam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksisewa`
--

CREATE TABLE IF NOT EXISTS `transaksisewa` (
  `NoTransaksi` varchar(5) NOT NULL,
  `TglPesan` date NOT NULL,
  `TglPinjam` date NOT NULL,
  `JamPinjam` time NOT NULL,
  `TglKembaliRencana` date NOT NULL,
  `JamKembaliRencana` time NOT NULL,
  `TglKembaliReal` date NOT NULL,
  `JamKembaliReal` time NOT NULL,
  `Denda` int(11) NOT NULL,
  `KilometerPinjam` int(11) NOT NULL,
  `KilometerKembali` int(11) NOT NULL,
  `BBMPinjam` int(11) NOT NULL,
  `BBMKembali` int(11) NOT NULL,
  `KondisiMobilPinjam` varchar(50) NOT NULL,
  `KondisiMobilKembali` varchar(50) NOT NULL,
  `Kerusakan` varchar(225) NOT NULL,
  `BiayaKerusakan` int(11) NOT NULL,
  `BiayaBBM` int(11) NOT NULL,
  `NoKTP` varchar(20) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `IDSopir` varchar(5) NOT NULL,
  `NoPlat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `IDType` varchar(5) NOT NULL,
  `NmType` varchar(20) NOT NULL,
  `KodeMerk` varchar(5) NOT NULL,
  `Keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenisservice`
--
ALTER TABLE `jenisservice`
  ADD PRIMARY KEY (`IDJenisService`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`NIK`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`NoPlat`),
  ADD KEY `IDType` (`IDType`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UserName`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Indexes for table `login_pelanggan`
--
ALTER TABLE `login_pelanggan`
  ADD PRIMARY KEY (`id_session`),
  ADD UNIQUE KEY `NoKTP_2` (`NoKTP`),
  ADD KEY `NoKTP` (`NoKTP`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`KodeMerk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`NoKTP`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`KodePemilik`),
  ADD KEY `NoPlat` (`NoPlat`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`KodeService`),
  ADD KEY `NoPlat` (`NoPlat`),
  ADD KEY `IDJenisService` (`IDJenisService`);

--
-- Indexes for table `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`NoSetoran`),
  ADD KEY `NIK` (`NIK`),
  ADD KEY `KodePemilik` (`KodePemilik`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`IDSopir`);

--
-- Indexes for table `transaksisewa`
--
ALTER TABLE `transaksisewa`
  ADD PRIMARY KEY (`NoTransaksi`),
  ADD KEY `NoPlat` (`NoPlat`),
  ADD KEY `IDSopir` (`IDSopir`),
  ADD KEY `NIK` (`NIK`),
  ADD KEY `NoKTP` (`NoKTP`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`IDType`),
  ADD KEY `KodeMerk` (`KodeMerk`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_ibfk_1` FOREIGN KEY (`IDType`) REFERENCES `type` (`IDType`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_pelanggan`
--
ALTER TABLE `login_pelanggan`
  ADD CONSTRAINT `login_pelanggan_ibfk_1` FOREIGN KEY (`NoKTP`) REFERENCES `pelanggan` (`NoKTP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD CONSTRAINT `pemilik_ibfk_1` FOREIGN KEY (`NoPlat`) REFERENCES `kendaraan` (`NoPlat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`NoPlat`) REFERENCES `kendaraan` (`NoPlat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`IDJenisService`) REFERENCES `jenisservice` (`IDJenisService`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `setoran`
--
ALTER TABLE `setoran`
  ADD CONSTRAINT `setoran_ibfk_2` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setoran_ibfk_3` FOREIGN KEY (`KodePemilik`) REFERENCES `pemilik` (`KodePemilik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksisewa`
--
ALTER TABLE `transaksisewa`
  ADD CONSTRAINT `transaksisewa_ibfk_1` FOREIGN KEY (`NoKTP`) REFERENCES `pelanggan` (`NoKTP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksisewa_ibfk_2` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksisewa_ibfk_3` FOREIGN KEY (`IDSopir`) REFERENCES `sopir` (`IDSopir`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksisewa_ibfk_4` FOREIGN KEY (`NoPlat`) REFERENCES `kendaraan` (`NoPlat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `type_ibfk_1` FOREIGN KEY (`KodeMerk`) REFERENCES `merk` (`KodeMerk`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
