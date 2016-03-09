-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2016 at 11:29 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ukk`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenisservice`
--

CREATE TABLE IF NOT EXISTS `jenisservice` (
  `IDJenisService` varchar(5) NOT NULL,
  `NmJenisService` varchar(50) NOT NULL,
  PRIMARY KEY (`IDJenisService`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `NIK` varchar(20) NOT NULL,
  `NmKaryawan` varchar(50) NOT NULL,
  `AlamatKaryawan` varchar(50) NOT NULL,
  `TelpKaryawan` varchar(20) NOT NULL,
  PRIMARY KEY (`NIK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`NIK`, `NmKaryawan`, `AlamatKaryawan`, `TelpKaryawan`) VALUES
('0', '', '', ''),
('1', 'admin', 'jl admin', '088888888');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
  `NoPlat` varchar(20) NOT NULL,
  `Nama Mobil` varchar(30) NOT NULL,
  `Tahun` varchar(4) NOT NULL,
  `TarifPerJam` int(11) NOT NULL,
  `StatusRental` varchar(1) NOT NULL,
  `IDType` int(5) NOT NULL,
  `KodeMerk` int(5) NOT NULL,
  `KodePemilik` varchar(20) NOT NULL,
  `Deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`NoPlat`),
  KEY `IDType` (`IDType`),
  KEY `KodeMerk` (`KodeMerk`),
  KEY `KodePemilik` (`KodePemilik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`NoPlat`, `Nama Mobil`, `Tahun`, `TarifPerJam`, `StatusRental`, `IDType`, `KodeMerk`, `KodePemilik`, `Deskripsi`) VALUES
('AE4321B', 'Faraday Zero 1', '2016', 200000, '1', 3, 3, '76282939192', 'Faraday Future Prototype'),
('N2010BE', 'Mercedes S-Class 2000', '2010', 130000, '0', 1, 1, '72838', 'holimoli'),
('N2010CE', 'Model 3', '2015', 70000, '1', 1, 2, '72838', 'Bercorak Kembang'),
('N2010DE', 'Model X', '2015', 140000, '1', 2, 2, '72838', 'Tesla SUV Model X'),
('N3928B', 'Mercedes E-Class 300', '2012', 100000, '1', 1, 1, '75726', 'fakfasfaf');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `UserName` varchar(10) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `TypeUser` varchar(10) NOT NULL,
  `NIK` varchar(10) NOT NULL,
  PRIMARY KEY (`UserName`),
  KEY `NIK` (`NIK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserName`, `Password`, `TypeUser`, `NIK`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'Admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `login_pelanggan`
--

CREATE TABLE IF NOT EXISTS `login_pelanggan` (
  `id_session` int(20) NOT NULL AUTO_INCREMENT,
  `NoKTP` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_session`),
  UNIQUE KEY `NoKTP_2` (`NoKTP`),
  KEY `NoKTP` (`NoKTP`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `login_pelanggan`
--

INSERT INTO `login_pelanggan` (`id_session`, `NoKTP`, `Username`, `Password`) VALUES
(1, 'KHSAUID789', 'bilal', '301fa1a42a5ccf979972d5917ca91b5a');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE IF NOT EXISTS `merk` (
  `KodeMerk` int(5) NOT NULL AUTO_INCREMENT,
  `NmMerk` varchar(20) NOT NULL,
  `Keterangan` text NOT NULL,
  PRIMARY KEY (`KodeMerk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`KodeMerk`, `NmMerk`, `Keterangan`) VALUES
(1, 'Mercedes', 'Mercedes'),
(2, 'Tesla Motor', ''),
(3, 'Faraday Future', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `NoKTP` varchar(20) NOT NULL,
  `NamaPel` varchar(50) NOT NULL,
  `AlamatPel` varchar(50) NOT NULL,
  `TelpPel` varchar(20) NOT NULL,
  PRIMARY KEY (`NoKTP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`NoKTP`, `NamaPel`, `AlamatPel`, `TelpPel`) VALUES
('KHSAUID789', 'Bilal Mahardika', 'jl. danau ranau', '088888');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE IF NOT EXISTS `pemilik` (
  `KodePemilik` varchar(20) NOT NULL,
  `NmPemilik` varchar(20) NOT NULL,
  `AlamatPemilik` varchar(50) NOT NULL,
  `TelpPemilik` varchar(20) NOT NULL,
  PRIMARY KEY (`KodePemilik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`KodePemilik`, `NmPemilik`, `AlamatPemilik`, `TelpPemilik`) VALUES
('72838', 'Martini', 'Danau Tambingan 20, Malang', '0812949111'),
('75726', 'Suryanto', 'Danau Kerinci 15, Malang', '0812947276361'),
('76282939192', 'Voelker', 'Danau Poso 16, Malang', '08193939211');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `KodeService` varchar(5) NOT NULL,
  `TglService` date NOT NULL,
  `BiayaService` int(11) NOT NULL,
  `NoPlat` varchar(20) NOT NULL,
  `IDJenisService` varchar(5) NOT NULL,
  PRIMARY KEY (`KodeService`),
  KEY `NoPlat` (`NoPlat`),
  KEY `IDJenisService` (`IDJenisService`)
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
  `NIK` varchar(20) NOT NULL,
  PRIMARY KEY (`NoSetoran`),
  KEY `NIK` (`NIK`),
  KEY `KodePemilik` (`KodePemilik`)
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
  `TarifPerJam` int(11) NOT NULL,
  PRIMARY KEY (`IDSopir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`IDSopir`, `NmSopir`, `AlamatSopir`, `TelpSopir`, `NoSIM`, `TarifPerJam`) VALUES
('SP000', 'Tidak Memakai Sopir', '', '', '', 0),
('SP001', 'Karmin', 'jl. danau ranau', '08888888', 'H31289UW1S1238', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksisewa`
--

CREATE TABLE IF NOT EXISTS `transaksisewa` (
  `NoTransaksi` varchar(8) NOT NULL,
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
  `NoPlat` varchar(20) NOT NULL,
  `total` varchar(30) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`NoTransaksi`),
  KEY `NoPlat` (`NoPlat`),
  KEY `IDSopir` (`IDSopir`),
  KEY `NIK` (`NIK`),
  KEY `NoKTP` (`NoKTP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksisewa`
--

INSERT INTO `transaksisewa` (`NoTransaksi`, `TglPesan`, `TglPinjam`, `JamPinjam`, `TglKembaliRencana`, `JamKembaliRencana`, `TglKembaliReal`, `JamKembaliReal`, `Denda`, `KilometerPinjam`, `KilometerKembali`, `BBMPinjam`, `BBMKembali`, `KondisiMobilPinjam`, `KondisiMobilKembali`, `Kerusakan`, `BiayaKerusakan`, `BiayaBBM`, `NoKTP`, `NIK`, `IDSopir`, `NoPlat`, `total`, `status`) VALUES
('TS0001', '2016-03-08', '2016-03-08', '00:00:00', '2016-03-08', '00:00:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP001', 'N3928B', '', 0),
('TS0002', '0000-00-00', '2016-03-12', '00:00:00', '2016-03-05', '00:00:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP001', 'N2010DE', '1000', 0),
('TS0003', '0000-00-00', '2016-03-03', '02:13:00', '2016-03-04', '02:13:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP001', 'N2010CE', '', 0),
('TS0004', '0000-00-00', '2016-03-10', '01:12:00', '2016-03-11', '15:21:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N2010DE', '', 0),
('TS0005', '0000-00-00', '2016-03-10', '02:31:00', '2016-03-11', '14:31:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP001', 'N2010CE', '', 0),
('TS0006', '0000-00-00', '2016-03-10', '02:31:00', '2016-03-11', '14:31:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N2010CE', '', 0),
('TS0007', '0000-00-00', '2016-03-08', '07:00:00', '2016-03-08', '12:00:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N2010DE', '', 0),
('TS0008', '0000-00-00', '2016-03-12', '13:12:00', '2016-03-15', '00:31:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N3928B', '', 0),
('TS0009', '0000-00-00', '2016-03-18', '23:21:00', '2016-03-22', '02:58:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N2010CE', '', 0),
('TS0010', '0000-00-00', '2016-03-10', '01:12:00', '2016-03-12', '02:13:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP001', 'N3928B', '', 0),
('TS0011', '0000-00-00', '2016-03-04', '01:21:00', '2016-03-26', '13:21:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N2010DE', '', 0),
('TS0012', '0000-00-00', '2016-03-03', '12:32:00', '2016-03-11', '14:13:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N2010DE', '', 0),
('TS0013', '0000-00-00', '2016-03-03', '15:12:00', '2016-03-12', '02:13:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N3928B', '0', 0),
('TS0014', '0000-00-00', '2016-03-05', '01:31:00', '2016-03-11', '14:12:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'AE4321B', '', 0),
('TS0015', '0000-00-00', '2016-03-03', '14:31:00', '2016-03-19', '02:31:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP000', 'N3928B', '1600000', 0),
('TS0016', '0000-00-00', '2016-03-09', '08:11:00', '2016-03-17', '00:21:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP001', 'AE4321B', '1640000', 0),
('TS0017', '2016-03-08', '2016-03-10', '03:12:00', '2016-03-12', '14:13:00', '0000-00-00', '00:00:00', 0, 0, 0, 0, 0, '', '', '', 0, 0, 'KHSAUID789', '0', 'SP001', 'N3928B', '240000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `IDType` int(5) NOT NULL AUTO_INCREMENT,
  `NmType` varchar(20) NOT NULL,
  `Keterangan` text NOT NULL,
  PRIMARY KEY (`IDType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`IDType`, `NmType`, `Keterangan`) VALUES
(1, 'Sedan', 'Sedan'),
(2, 'SUV', ''),
(3, 'Sport', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_ibfk_3` FOREIGN KEY (`KodePemilik`) REFERENCES `pemilik` (`KodePemilik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kendaraan_ibfk_4` FOREIGN KEY (`KodeMerk`) REFERENCES `merk` (`KodeMerk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kendaraan_ibfk_5` FOREIGN KEY (`IDType`) REFERENCES `type` (`IDType`) ON DELETE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`NIK`) REFERENCES `karyawan` (`NIK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_pelanggan`
--
ALTER TABLE `login_pelanggan`
  ADD CONSTRAINT `login_pelanggan_ibfk_1` FOREIGN KEY (`NoKTP`) REFERENCES `pelanggan` (`NoKTP`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
