-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 05:44 PM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `dikaiwmata`
--

CREATE TABLE `dikaiwmata` (
  `kwdikos` char(6) NOT NULL,
  `onoma` varchar(20) DEFAULT NULL,
  `prosvasi` set('dwmatia','pelates','krathseis','upaliloi','vardies','ekdromes','uphresies','dikaiwmata','stixeia sindesis') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dikaiwmata`
--

INSERT INTO `dikaiwmata` (`kwdikos`, `onoma`, `prosvasi`) VALUES
('EPISTA', 'Epistarhs', 'upaliloi,vardies'),
('MANAGE', 'Management', 'dwmatia,pelates,krathseis,upaliloi,vardies,ekdromes,uphresies'),
('SADMIN', 'Diaxirisths efarmogh', 'dwmatia,pelates,krathseis,upaliloi,vardies,ekdromes,uphresies,dikaiwmata'),
('UPODOX', 'Upodoxh', 'pelates,krathseis,upaliloi');

-- --------------------------------------------------------

--
-- Table structure for table `dwmatio`
--

CREATE TABLE `dwmatio` (
  `arithmos` int(3) NOT NULL,
  `arithmos_klinwn` tinyint(4) NOT NULL,
  `orofos` tinyint(4) NOT NULL,
  `topothesia` varchar(45) NOT NULL,
  `timi` double(6,2) NOT NULL,
  `katastash` enum('AVAILABLE','UNAVAILABLE','DIRTY') DEFAULT 'AVAILABLE',
  `kathariothta` enum('CLEAN','DIRTY') DEFAULT 'CLEAN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dwmatio`
--

INSERT INTO `dwmatio` (`arithmos`, `arithmos_klinwn`, `orofos`, `topothesia`, `timi`, `katastash`, `kathariothta`) VALUES
(1, 2, 1, 'Thea Sth Thalassa', 100.00, 'AVAILABLE', 'CLEAN'),
(20, 4, 3, 'Xwris mpalokoni', 250.00, 'AVAILABLE', 'CLEAN'),
(37, 5, 4, 'Me veranda', 400.00, 'AVAILABLE', 'CLEAN'),
(39, 5, 4, 'Me mpalkoni', 380.00, 'UNAVAILABLE', 'DIRTY'),
(69, 4, 3, 'Xwris mpalokoni', 250.00, 'AVAILABLE', 'CLEAN');

-- --------------------------------------------------------

--
-- Table structure for table `ekdromh`
--

CREATE TABLE `ekdromh` (
  `kwdikos` char(3) NOT NULL,
  `titlos` varchar(40) NOT NULL,
  `timi` double(6,2) NOT NULL,
  `diathsimothta` int(11) NOT NULL DEFAULT 0,
  `hmerominia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekdromh`
--

INSERT INTO `ekdromh` (`kwdikos`, `titlos`, `timi`, `diathsimothta`, `hmerominia`) VALUES
('001', 'Ekdromh ston Olumpo', 10.00, 100, '2023-10-11'),
('002', 'Ekdromh sthn Kavala', 5.00, 100, '2023-11-05'),
('003', 'Ekdromh sthn Thasso', 20.00, 30, '2023-12-19'),
('004', 'Ekdromh sthn oneiroupolh Dramas', 5.00, 150, '2024-01-10'),
('005', 'Ekdromh ston Langkada Thessalonikhs', 10.00, 100, '2024-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `evdomadiaio_programma`
--

CREATE TABLE `evdomadiaio_programma` (
  `ypallhlos_fk` char(9) NOT NULL,
  `vardia_fk` char(5) NOT NULL,
  `hmeromhnia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evdomadiaio_programma`
--

INSERT INTO `evdomadiaio_programma` (`ypallhlos_fk`, `vardia_fk`, `hmeromhnia`) VALUES
('241178090', '00001', '2023-12-08'),
('263673764', '00001', '2023-12-08'),
('402814700', '00001', '2023-12-08'),
('452766771', '00001', '2023-12-08'),
('452766771', '00004', '2023-12-08'),
('518558385', '00002', '2023-12-08'),
('557696476', '00001', '2023-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `krathsh`
--

CREATE TABLE `krathsh` (
  `dwmatio_fk` int(11) NOT NULL,
  `pelatis_fk` char(9) NOT NULL,
  `hmeromhnia_afikshs` date NOT NULL,
  `hmeromhnia_anaxwrishs` date NOT NULL,
  `katastash_krathshs` enum('ACCEPTED','PENDING','DENIED') DEFAULT 'PENDING',
  `poso` double(6,2) NOT NULL,
  `hmerominia_synallaghs` datetime NOT NULL,
  `katastash_synallaghs` enum('ACCEPTED','PENDING','CANCELED') DEFAULT 'PENDING',
  `tropos_plhrwmhs` enum('CASH','CARD') DEFAULT 'CASH'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `krathsh`
--

INSERT INTO `krathsh` (`dwmatio_fk`, `pelatis_fk`, `hmeromhnia_afikshs`, `hmeromhnia_anaxwrishs`, `katastash_krathshs`, `poso`, `hmerominia_synallaghs`, `katastash_synallaghs`, `tropos_plhrwmhs`) VALUES
(1, '607869957', '2023-01-02', '2023-01-03', 'ACCEPTED', 100.00, '2023-01-01 09:03:22', 'ACCEPTED', 'CARD'),
(1, '741852963', '2023-02-03', '2023-02-06', 'ACCEPTED', 300.00, '2023-01-02 19:03:55', 'ACCEPTED', 'CARD'),
(37, '987654321', '2023-06-10', '2023-06-20', 'ACCEPTED', 4000.00, '2023-06-01 02:03:22', 'ACCEPTED', 'CARD'),
(37, '987654321', '2023-06-21', '2023-06-22', 'ACCEPTED', 400.00, '2023-06-22 09:07:54', 'ACCEPTED', 'CASH'),
(39, '377309259', '2023-12-25', '2024-01-20', 'DENIED', 9500.00, '2023-12-24 12:22:32', 'ACCEPTED', 'CARD');

-- --------------------------------------------------------

--
-- Table structure for table `pelaths`
--

CREATE TABLE `pelaths` (
  `afm` varchar(9) NOT NULL,
  `onoma` varchar(20) NOT NULL,
  `epitheto` varchar(35) NOT NULL,
  `filo` enum('MALE','FEMALE','OTHER') DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `thlefono` char(10) NOT NULL,
  `hm_gennishs` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelaths`
--

INSERT INTO `pelaths` (`afm`, `onoma`, `epitheto`, `filo`, `email`, `thlefono`, `hm_gennishs`) VALUES
('377309259', 'Elsa', 'Papadopoulou', '', 'elpap@gmail.com', '6975058136', '1975-03-19'),
('607869957', 'Stavroula', 'Florou', '', 'stfloro@cs.ihu.gr', '6934517920', '2002-05-06'),
('741852963', 'Marios', 'Stefanidis', 'MALE', 'mastefa@cs.ihu.gr', '6958204838', '2001-12-01'),
('849640182', 'Giwrgos', 'Grigoriou', 'MALE', 'ggreg@gmail.com', '6999445476', '1978-05-07'),
('987654321', 'Alexandros', 'Puscasu', 'MALE', 'puscasu@cs.ihu.gr', '6998744580', '2002-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `stoixia_sundeshs`
--

CREATE TABLE `stoixia_sundeshs` (
  `kwdikos` char(3) NOT NULL,
  `onoma` varchar(25) DEFAULT NULL,
  `sinthimatiko` varchar(30) DEFAULT NULL,
  `ypallhlos_fk` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stoixia_sundeshs`
--

INSERT INTO `stoixia_sundeshs` (`kwdikos`, `onoma`, `sinthimatiko`, `ypallhlos_fk`) VALUES
('001', 'Alalexandrou80', '|q+0|S89b:QnP,3', '374084366'),
('002', 'Gewpan', '12345678', '263673764'),
('003', 'dhmdhm', '12061980', '402814700'),
('004', 'manager123', '12345678', '452766771'),
('005', 'odpap80', 'qwerty', '241178090');

-- --------------------------------------------------------

--
-- Table structure for table `symetexei`
--

CREATE TABLE `symetexei` (
  `pelaths_fk` char(9) NOT NULL,
  `ekdromh_fk` char(3) NOT NULL,
  `poso` double(6,2) NOT NULL,
  `hmerominia_synallaghs` datetime NOT NULL,
  `katastash_synallaghs` enum('ACCEPTED','PENDING','CANCELED') DEFAULT 'PENDING',
  `tropos_plhrwmhs` enum('CASH','CARD') DEFAULT 'CASH'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symetexei`
--

INSERT INTO `symetexei` (`pelaths_fk`, `ekdromh_fk`, `poso`, `hmerominia_synallaghs`, `katastash_synallaghs`, `tropos_plhrwmhs`) VALUES
('607869957', '004', 10.00, '2023-12-15 13:03:04', 'PENDING', 'CARD'),
('741852963', '004', 10.00, '2023-12-08 21:03:21', 'PENDING', 'CARD'),
('849640182', '001', 10.00, '2023-09-29 12:03:01', 'ACCEPTED', 'CASH'),
('849640182', '002', 5.00, '2023-11-04 15:45:22', 'ACCEPTED', 'CASH'),
('987654321', '004', 20.00, '2023-12-08 01:20:44', 'ACCEPTED', 'CARD');

-- --------------------------------------------------------

--
-- Table structure for table `vardia`
--

CREATE TABLE `vardia` (
  `kwdikos` char(5) NOT NULL,
  `wra_enarjhs` time NOT NULL,
  `wra_lhjhs` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vardia`
--

INSERT INTO `vardia` (`kwdikos`, `wra_enarjhs`, `wra_lhjhs`) VALUES
('00001', '07:00:00', '15:00:00'),
('00002', '15:00:00', '23:00:00'),
('00003', '23:00:00', '07:00:00'),
('00004', '15:00:00', '17:00:00'),
('00005', '07:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `xrhsh_yphresias`
--

CREATE TABLE `xrhsh_yphresias` (
  `pelatis_fk` char(9) NOT NULL,
  `yphresia_fk` char(4) NOT NULL,
  `hm_yphresias` datetime NOT NULL,
  `poso` double(6,2) NOT NULL,
  `hmerominia_synallaghs` datetime DEFAULT NULL,
  `katastash_synallaghs` enum('ACCEPTED','PENDING','CANCELED') DEFAULT 'PENDING',
  `tropos_plhrwmhs` enum('CASH','CARD') DEFAULT 'CASH'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xrhsh_yphresias`
--

INSERT INTO `xrhsh_yphresias` (`pelatis_fk`, `yphresia_fk`, `hm_yphresias`, `poso`, `hmerominia_synallaghs`, `katastash_synallaghs`, `tropos_plhrwmhs`) VALUES
('377309259', 'KEEU', '2023-12-25 16:20:05', 50.00, NULL, 'PENDING', 'CARD'),
('377309259', 'PAID', '2023-12-25 16:18:00', 5.00, '2023-12-25 17:18:00', 'CANCELED', 'CARD'),
('607869957', 'PLUN', '2023-06-23 19:03:22', 20.00, '2023-06-23 19:03:22', 'ACCEPTED', 'CASH'),
('741852963', 'PRWI', '2023-06-23 09:55:11', 8.00, '2023-06-23 09:55:11', 'ACCEPTED', 'CASH'),
('849640182', 'META', '2023-11-01 14:15:10', 35.00, '2023-11-01 14:15:10', 'ACCEPTED', 'CASH'),
('987654321', 'META', '2023-08-07 19:32:00', 35.00, '2023-08-07 22:05:00', 'ACCEPTED', 'CARD');

-- --------------------------------------------------------

--
-- Table structure for table `ypallhlos`
--

CREATE TABLE `ypallhlos` (
  `afm` char(9) NOT NULL,
  `onoma` varchar(20) NOT NULL,
  `epitheto` varchar(35) NOT NULL,
  `fylo` enum('MALE','FEMALE','OTHER') DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `thlefono` char(10) NOT NULL,
  `hm_gennisis` date NOT NULL,
  `misthos` decimal(5,2) NOT NULL,
  `yphresia_fk` char(4) DEFAULT NULL,
  `dikaiwmata_fk` char(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ypallhlos`
--

INSERT INTO `ypallhlos` (`afm`, `onoma`, `epitheto`, `fylo`, `email`, `thlefono`, `hm_gennisis`, `misthos`, `yphresia_fk`, `dikaiwmata_fk`) VALUES
('241178090', 'Odyseas', 'Papadopoulos', 'MALE', NULL, '6922758512', '1980-02-19', 800.00, 'PRWI', 'EPISTA'),
('263673764', 'Gewrgia', 'Panou', '', 'panougewrgia@gmail.com', '6966839914', '1990-08-23', 800.00, NULL, 'UPODOX'),
('374084366', ' Alexandros', 'Alexandrou', 'MALE', NULL, '6992946212', '1980-07-16', 999.99, NULL, 'SADMIN'),
('402814700', 'Dhmhtra', 'Dhmitriadou', '', 'ddhmitriadou@gmail.com', '6979738740', '1980-06-12', 950.00, NULL, 'MANAGE'),
('452766771', 'Alexandra', 'Floridou', '', 'afloridou@gmail.com', '6948000334', '1975-11-11', 950.00, NULL, 'MANAGE'),
('518558385', 'Athina', 'Tsintakh', '', 'athtsintakh@gmail.com', '6924595126', '2000-02-01', 700.00, 'PLUN', NULL),
('557696476', 'Xristina', 'Aleura', '', 'aleurax@gmail.com', '6906402044', '1995-02-15', 700.00, 'PLUN', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yphresia`
--

CREATE TABLE `yphresia` (
  `kwdikos` char(4) NOT NULL,
  `onoma` varchar(50) NOT NULL,
  `timi` double(5,2) NOT NULL,
  `diathesimotita` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yphresia`
--

INSERT INTO `yphresia` (`kwdikos`, `onoma`, `timi`, `diathesimotita`) VALUES
('KEEU', 'Kentro eueksias', 50.00, 300),
('META', 'Metafora aerodromiou', 35.00, 5),
('PAID', 'Paidotopos', 5.00, 100),
('PLUN', 'Plunthrio', 10.00, 20),
('PRWI', 'Prwino', 8.00, 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dikaiwmata`
--
ALTER TABLE `dikaiwmata`
  ADD PRIMARY KEY (`kwdikos`);

--
-- Indexes for table `dwmatio`
--
ALTER TABLE `dwmatio`
  ADD PRIMARY KEY (`arithmos`);

--
-- Indexes for table `ekdromh`
--
ALTER TABLE `ekdromh`
  ADD PRIMARY KEY (`kwdikos`);

--
-- Indexes for table `evdomadiaio_programma`
--
ALTER TABLE `evdomadiaio_programma`
  ADD PRIMARY KEY (`ypallhlos_fk`,`vardia_fk`,`hmeromhnia`),
  ADD KEY `vardia_fk` (`vardia_fk`);

--
-- Indexes for table `krathsh`
--
ALTER TABLE `krathsh`
  ADD PRIMARY KEY (`dwmatio_fk`,`pelatis_fk`,`hmeromhnia_afikshs`),
  ADD KEY `pelatis_fk` (`pelatis_fk`);

--
-- Indexes for table `pelaths`
--
ALTER TABLE `pelaths`
  ADD PRIMARY KEY (`afm`);

--
-- Indexes for table `stoixia_sundeshs`
--
ALTER TABLE `stoixia_sundeshs`
  ADD PRIMARY KEY (`kwdikos`),
  ADD UNIQUE KEY `ypallhlos_fk` (`ypallhlos_fk`);

--
-- Indexes for table `symetexei`
--
ALTER TABLE `symetexei`
  ADD PRIMARY KEY (`pelaths_fk`,`ekdromh_fk`),
  ADD KEY `ekdromh_fk` (`ekdromh_fk`);

--
-- Indexes for table `vardia`
--
ALTER TABLE `vardia`
  ADD PRIMARY KEY (`kwdikos`);

--
-- Indexes for table `xrhsh_yphresias`
--
ALTER TABLE `xrhsh_yphresias`
  ADD PRIMARY KEY (`pelatis_fk`,`yphresia_fk`,`hm_yphresias`),
  ADD KEY `yphresia_fk` (`yphresia_fk`);

--
-- Indexes for table `ypallhlos`
--
ALTER TABLE `ypallhlos`
  ADD PRIMARY KEY (`afm`),
  ADD KEY `yphresia_fk` (`yphresia_fk`),
  ADD KEY `dikaiwmata_fk` (`dikaiwmata_fk`);

--
-- Indexes for table `yphresia`
--
ALTER TABLE `yphresia`
  ADD PRIMARY KEY (`kwdikos`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evdomadiaio_programma`
--
ALTER TABLE `evdomadiaio_programma`
  ADD CONSTRAINT `evdomadiaio_programma_ibfk_1` FOREIGN KEY (`ypallhlos_fk`) REFERENCES `ypallhlos` (`afm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evdomadiaio_programma_ibfk_2` FOREIGN KEY (`vardia_fk`) REFERENCES `vardia` (`kwdikos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `krathsh`
--
ALTER TABLE `krathsh`
  ADD CONSTRAINT `krathsh_ibfk_1` FOREIGN KEY (`pelatis_fk`) REFERENCES `pelaths` (`afm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krathsh_ibfk_2` FOREIGN KEY (`dwmatio_fk`) REFERENCES `dwmatio` (`arithmos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stoixia_sundeshs`
--
ALTER TABLE `stoixia_sundeshs`
  ADD CONSTRAINT `stoixia_sundeshs_ibfk_1` FOREIGN KEY (`ypallhlos_fk`) REFERENCES `ypallhlos` (`afm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `symetexei`
--
ALTER TABLE `symetexei`
  ADD CONSTRAINT `symetexei_ibfk_1` FOREIGN KEY (`pelaths_fk`) REFERENCES `pelaths` (`afm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `symetexei_ibfk_2` FOREIGN KEY (`ekdromh_fk`) REFERENCES `ekdromh` (`kwdikos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `xrhsh_yphresias`
--
ALTER TABLE `xrhsh_yphresias`
  ADD CONSTRAINT `xrhsh_yphresias_ibfk_1` FOREIGN KEY (`pelatis_fk`) REFERENCES `pelaths` (`afm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `xrhsh_yphresias_ibfk_2` FOREIGN KEY (`yphresia_fk`) REFERENCES `yphresia` (`kwdikos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ypallhlos`
--
ALTER TABLE `ypallhlos`
  ADD CONSTRAINT `ypallhlos_ibfk_1` FOREIGN KEY (`yphresia_fk`) REFERENCES `yphresia` (`kwdikos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ypallhlos_ibfk_2` FOREIGN KEY (`dikaiwmata_fk`) REFERENCES `dikaiwmata` (`kwdikos`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
