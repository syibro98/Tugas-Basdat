-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 01:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `10118052_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `Nip` varchar(10) NOT NULL,
  `Nama_dosen` varchar(30) NOT NULL,
  `matkul` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`Nip`, `Nama_dosen`, `matkul`) VALUES
('1011185258', 'Wage', 'Matematika'),
('1011185269', 'Budi Utomo', 'Kimia'),
('1234567890', 'Bamabng', 'Seni');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `Nim` varchar(8) NOT NULL,
  `Nama_mahasiswa` varchar(30) NOT NULL,
  `TTL` date NOT NULL,
  `JK` varchar(1) NOT NULL,
  `Alamat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`Nim`, `Nama_mahasiswa`, `TTL`, `JK`, `Alamat`) VALUES
('10857455', 'Budi', '2000-08-18', 'L', 'Ds.Sembadra Kab. Indramayu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perkuliahan`
--

CREATE TABLE `tb_perkuliahan` (
  `Nim` varchar(8) NOT NULL,
  `Nip` varchar(10) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `kelas` varchar(7) NOT NULL,
  `Nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_perkuliahan`
--

INSERT INTO `tb_perkuliahan` (`Nim`, `Nip`, `id_prodi`, `kelas`, `Nilai`) VALUES
('10857455', '1011185269', 895645, 'KImia', 80);

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id_prodi` int(11) NOT NULL,
  `Nama_prodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `Nama_prodi`) VALUES
(895645, 'Kmia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` enum('admin','mhs') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Dosen', 'admin', 'admin', 'admin'),
(2, 'Mahasiswa', 'mhs', 'mhs', 'mhs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`Nip`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`Nim`);

--
-- Indexes for table `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
  ADD KEY `frg_mahasiswa` (`Nim`),
  ADD KEY `frg_dosen` (`Nip`),
  ADD KEY `frg_prodi` (`id_prodi`);

--
-- Indexes for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
  ADD CONSTRAINT `frg_dosen` FOREIGN KEY (`Nip`) REFERENCES `tb_dosen` (`Nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frg_mahasiswa` FOREIGN KEY (`Nim`) REFERENCES `tb_mahasiswa` (`Nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frg_prodi` FOREIGN KEY (`id_prodi`) REFERENCES `tb_prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
