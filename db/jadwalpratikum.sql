-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 05:54 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwalpratikum`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` int(20) NOT NULL,
  `aktivitas` enum('add','edit','password','reset') NOT NULL,
  `jadwalPratikum` varchar(5) NOT NULL,
  `target` char(8) NOT NULL,
  `penggunaNim` char(8) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `aktivitas`, `jadwalPratikum`, `target`, `penggunaNim`, `waktu`) VALUES
(1, 'add', '47', '', '11216043', '2021-01-06 11:36:11'),
(2, 'edit', '47', '', '11216043', '2021-01-06 11:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(2) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ket` text NOT NULL,
  `status` enum('active','nonactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nama`, `ket`, `status`) VALUES
(1, 'Hardware Support', 'wkwk', 'active'),
(2, 'Software Support', 'ak', 'active'),
(3, 'Programmer Engineering', 'gampang bener sih', 'active'),
(7, 'Design Graphics', 'wlwldsadsa', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(2) NOT NULL,
  `nama` char(100) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `warna`, `ket`) VALUES
(1, 'Teknologi Informasi', '', 'IT'),
(2, 'Ekonomi', '', ''),
(3, 'Teknik', '', ''),
(4, 'Hukum', '', ''),
(5, 'Keguruan dan Ilmu Pendidikan', '', ''),
(6, 'Program Vokasi Diploma 3', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `textIndex` text NOT NULL,
  `textDashboard` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`textIndex`, `textDashboard`) VALUES
('Breaking news: Our website is so much easier to use (and look at)! Pre-Review for BETA ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalpratikum`
--

CREATE TABLE `jadwalpratikum` (
  `id` int(10) NOT NULL,
  `ruanganId` int(3) NOT NULL,
  `jurusanId` int(5) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `mataKuliah` varchar(150) NOT NULL,
  `namaDosen` varchar(150) NOT NULL,
  `penggunaNim` char(8) NOT NULL,
  `tglJadwal` datetime NOT NULL,
  `lastUpdate` datetime NOT NULL,
  `status` enum('Menunggu','Berlangsung','Selesai','Tidak Hadir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(5) NOT NULL,
  `nama` char(100) NOT NULL,
  `fakultasId` int(2) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `fakultasId`, `ket`) VALUES
(8, 'Teknik Informatika', 1, 'Programmer'),
(9, 'Sistem Informasi', 1, 'Analis'),
(10, 'Sistem Komputer', 1, 'Hardware'),
(11, 'Akutansi', 2, ''),
(12, 'Manajemen', 2, ''),
(13, 'Teknik Kimia', 3, ''),
(14, 'Teknik Industri', 3, ''),
(15, 'Teknik Sipil', 3, ''),
(16, 'Ilmu Hukum', 4, ''),
(17, 'Pendidikan Matematika', 5, ''),
(18, 'Keuangan dan Perbankan', 6, ''),
(19, 'Manajemen Perusahaan', 6, ''),
(20, 'Akutansi', 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(3) NOT NULL,
  `nim` char(8) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `kataSandi` varchar(50) NOT NULL,
  `level` enum('administrator','staff') NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `alamat` text,
  `status` enum('active','nonactive') NOT NULL,
  `lastSignIn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nim`, `nama`, `jk`, `kataSandi`, `level`, `divisi`, `alamat`, `status`, `lastSignIn`) VALUES
(1, '1', 'Admin', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'administrator', '0', '', 'active', '2021-01-06 11:43:52'),
(2, '11216043', 'Rudi Hikmatullah ', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Programmer Engineering', 'Cilegon, Indonesia', 'active', '2021-01-06 11:35:51'),
(3, '11216091', 'Hudan', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Downloader wkwk', 'Warnasari, Cilegon-INDONESIA', 'active', '2017-12-02 10:18:40'),
(4, '11216046', 'Neng', 'P', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Software Support', 'Kramat, Kabupaten Serang-Banten', 'nonactive', '2017-11-15 09:28:41'),
(5, '11216022', 'Nadira', 'P', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Design Graphics', 'Esa Unggul', 'nonactive', '2017-11-29 15:08:34'),
(6, '11215065', 'Fiorent', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Software Support', 'Serang', 'active', '2017-11-27 19:16:35'),
(7, '11215215', 'Imam', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'masa ga ada', 'Pandeglang', 'active', '0000-00-00 00:00:00'),
(8, '11213342', 'Bayu', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Hardware Support', 'Jln. Raya Serang', 'active', '2017-11-29 15:08:41'),
(9, '11214312', 'Ila', 'P', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Hardware Support', 'Warnasari, Cilegon', 'active', '2017-12-02 09:59:56'),
(10, '11214376', 'Angga', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Programmer Engineering', 'UNSERA', 'nonactive', '2017-12-12 16:56:06'),
(11, '11221001', 'COVID19', 'L', 'bc1870d39c36af1196934338b1c16dc9e6c5d057', 'staff', 'Software Support', 'Pandemic', 'active', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(3) NOT NULL,
  `nama` char(50) NOT NULL,
  `namaLainnya` varchar(100) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama`, `namaLainnya`, `ket`) VALUES
(1, 'LG.001', 'LAB-1', 'Support Desain'),
(2, 'LG.002', 'LAB-2', 'Support Programming'),
(3, 'LG.003', 'LAB-3', 'Support etc'),
(4, 'LG.004', 'LAB-4', 'Tes'),
(5, 'LG.005', 'LAB-5', 'lkdsa'),
(6, 'LG.006', 'LAB-HDS', 'Hardware');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwalPratikum` (`jadwalPratikum`),
  ADD KEY `penggunaNim` (`penggunaNim`),
  ADD KEY `target` (`target`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `jadwalpratikum`
--
ALTER TABLE `jadwalpratikum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruanganId` (`ruanganId`),
  ADD KEY `jurusanId` (`jurusanId`),
  ADD KEY `penggunaNim` (`penggunaNim`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultasId` (`fakultasId`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `idDivision` (`divisi`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwalpratikum`
--
ALTER TABLE `jadwalpratikum`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `aktivitas_ibfk_2` FOREIGN KEY (`penggunaNim`) REFERENCES `pengguna` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwalpratikum`
--
ALTER TABLE `jadwalpratikum`
  ADD CONSTRAINT `jadwalpratikum_ibfk_2` FOREIGN KEY (`ruanganId`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwalpratikum_ibfk_3` FOREIGN KEY (`penggunaNim`) REFERENCES `pengguna` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwalpratikum_ibfk_4` FOREIGN KEY (`jurusanId`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`fakultasId`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
