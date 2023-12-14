-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 14, 2023 at 08:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kursus_`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'apaya', 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(255) DEFAULT NULL,
  `no_rek` varchar(255) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`, `no_rek`, `atas_nama`) VALUES
(1, 'BCA', '5431-1235-5321-5423', 'Bistir'),
(2, 'BRI', '1235-6890-0876-5421', 'Bistir');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instruktur`
--

CREATE TABLE `tbl_instruktur` (
  `id_instruktur` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `username_instr` varchar(50) DEFAULT NULL,
  `email_instr` varchar(50) DEFAULT NULL,
  `TTL` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `JK` enum('Male','Female') DEFAULT NULL,
  `honor` varchar(100) DEFAULT NULL,
  `image_instr` varchar(256) DEFAULT NULL,
  `deskripsi_instr` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_instruktur`
--

INSERT INTO `tbl_instruktur` (`id_instruktur`, `id_user`, `username_instr`, `email_instr`, `TTL`, `no_telp`, `JK`, `honor`, `image_instr`, `deskripsi_instr`) VALUES
(12, 30, 'Robert', 'rahmat@gmail.com', '1997-04-04', '0812', 'Male', '50000', 'img1652808201.jpg', 'sudah berpengalaman selama 12 tahun'),
(16, 31, 'Budi R', 'budi@gmail.com', '1990-12-08', '08121211212', 'Male', '50000', 'img1702457278.jpg', 'halooo saya budi, semoga hari anda menyenangkan...');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_user_peserta` int(11) DEFAULT NULL,
  `id_user_instruktur` int(11) DEFAULT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `id_instruktur` int(11) DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `kode_jadwal` varchar(255) DEFAULT NULL,
  `tgl_jadwal` varchar(255) DEFAULT NULL,
  `tgl_latihan` varchar(255) DEFAULT NULL,
  `jam_latihan` varchar(255) DEFAULT NULL,
  `total_bayar` varchar(255) DEFAULT NULL,
  `atas_nama` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `no_rek` varchar(255) DEFAULT NULL,
  `status_jadwal` int(11) DEFAULT NULL,
  `status_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_user_peserta`, `id_user_instruktur`, `id_peserta`, `id_instruktur`, `id_paket`, `kode_jadwal`, `tgl_jadwal`, `tgl_latihan`, `jam_latihan`, `total_bayar`, `atas_nama`, `bank`, `bukti_bayar`, `no_rek`, `status_jadwal`, `status_bayar`) VALUES
(35, 58, 30, 12, 12, 7, '20220621HJDIQ', '2022-06-21', '2022-06-30', '14:00 - 16:00', '550000', 'gracia', 'BCA', 'img1702395466.JPG', '12-1239312812012-1231', 2, 1),
(46, 67, 31, 42, 16, 8, '20231212VQ9FH', '2023-12-12', '2023-12-20', '14:00 - 16:00', '550000', 'shani gracia', 'BNI', 'img1702395691.JPG', '12-9721-912812-1231', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kantor`
--

CREATE TABLE `tbl_kantor` (
  `id_kantor` int(11) NOT NULL,
  `alamat` varchar(123) DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kantor`
--

INSERT INTO `tbl_kantor` (`id_kantor`, `alamat`, `no_telp`, `deskripsi`, `image`) VALUES
(1, 'Jln.Cut Mutia No.1', '081290909876', 'BISTIR merupakan aplikasi pendaftaran online kursus mobil', 'img1654355600.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobil`
--

CREATE TABLE `tbl_mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(255) DEFAULT NULL,
  `jenis_mobil` int(11) DEFAULT NULL,
  `no_plat` varchar(50) DEFAULT NULL,
  `no_mesin` varchar(50) DEFAULT NULL,
  `deskripsi_mobil` varchar(256) DEFAULT NULL,
  `image_mobil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`id_mobil`, `nama_mobil`, `jenis_mobil`, `no_plat`, `no_mesin`, `deskripsi_mobil`, `image_mobil`) VALUES
(5, 'Avanza ', 1, 'BM 3249 ADS', 'FDSGSD43', 'Heiiiiiii', 'img1702314562.jpg'),
(6, 'Daihatsu Xenia', 1, 'B 1289 KLO', 'JLKFSDAIO094', '', 'img1652809502.jpg'),
(7, 'Suzuki Ertiga', 2, 'B 9208 UIT', 'LKASI097213', 'Mobil siap digunakan', 'img1652809712.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id_paket` int(11) NOT NULL,
  `id_mobil` int(11) DEFAULT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `byk_pertemuan` varchar(100) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `deskripsi_paket` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`id_paket`, `id_mobil`, `nama_paket`, `byk_pertemuan`, `harga`, `deskripsi_paket`, `image`) VALUES
(7, 7, 'Paket 1', '8 Pertemuan', '450000', 'Paket ini terdiri dari 8 pertemuan  selamat datang di website kami\r\n', 'img1655181291.jpg'),
(8, 6, 'Paket 2 ', '10 Pertemuan', '550000', 'Paket ini terdiri dari 10 pertemuan', 'img1655181304.jpg'),
(9, 5, 'Paket 3', '12 Pertemuan', '650000', 'Paket ini terdiri dari 12 pertemuan', 'img1655181315.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peserta`
--

CREATE TABLE `tbl_peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `username_peserta` varchar(20) DEFAULT NULL,
  `email_peserta` varchar(50) DEFAULT NULL,
  `TTL` varchar(256) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `JK` enum('Male','Female') DEFAULT NULL,
  `image_peserta` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_peserta`
--

INSERT INTO `tbl_peserta` (`id_peserta`, `id_user`, `username_peserta`, `email_peserta`, `TTL`, `alamat`, `no_telp`, `JK`, `image_peserta`) VALUES
(12, 58, 'Halim cakra', 'halim@gmail.com', 'bekasi, 02-02-2002', 'bekasi', '0812', 'Male', 'img1702281949.png'),
(34, NULL, 'Markus', 'markus@gmail.com', '1999-12-12', 'bekasi', '081212127812', 'Male', 'img1656061369.jpeg'),
(42, 67, 'Feri Test', 'akun3@gmail.com', '2023-12-18', 'pku', '0812', 'Male', 'img1702364595.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rinci_jadwal`
--

CREATE TABLE `tbl_rinci_jadwal` (
  `id_rinci` int(11) NOT NULL,
  `kode_jadwal` varchar(255) DEFAULT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rinci_jadwal`
--

INSERT INTO `tbl_rinci_jadwal` (`id_rinci`, `kode_jadwal`, `id_peserta`, `id_paket`) VALUES
(39, '20220621HJDIQ', 18, 7),
(42, 'SDADF2342', 1, 3),
(45, '20231212VQ9FH', 42, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `level_user` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `image`, `password`, `is_active`, `level_user`, `date_created`) VALUES
(1, 'Admin', 'admin@gmail.com', 'img1702540507.jpeg', '12345', 1, 1, 1653383944),
(30, 'Robert', 'robert@gmail.com', 'img1655182053.jpg', '12345', 1, 3, 1653377981),
(31, 'Budi', 'budi@gmail.com', 'img1702457230.jpg', 'inipassword', 1, 3, NULL),
(53, 'Berhasil aSd', 'sunah@gmail.com', 'img1702263160.png', '12345', 1, 1, 1701934179),
(54, 'sunah', 'sunah12@gmail.com', 'default.jpg', '12345', 1, 2, 1701934342),
(58, 'feri', 'jayabendera@gmail.com', 'default.jpg', '12345', 1, 2, 1701935799),
(62, 'Feri R', 'feryr@gmail.com', 'img1702264634.jpeg', 'inipassbaru', 1, 1, 1702263748),
(67, 'Feri ', 'akun3@gmail.com', 'img1702456998.jpeg', '12345', 1, 2, 1702354648);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tbl_instruktur`
--
ALTER TABLE `tbl_instruktur`
  ADD PRIMARY KEY (`id_instruktur`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `tbl_kantor`
--
ALTER TABLE `tbl_kantor`
  ADD PRIMARY KEY (`id_kantor`);

--
-- Indexes for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `tbl_rinci_jadwal`
--
ALTER TABLE `tbl_rinci_jadwal`
  ADD PRIMARY KEY (`id_rinci`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_instruktur`
--
ALTER TABLE `tbl_instruktur`
  MODIFY `id_instruktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_kantor`
--
ALTER TABLE `tbl_kantor`
  MODIFY `id_kantor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_rinci_jadwal`
--
ALTER TABLE `tbl_rinci_jadwal`
  MODIFY `id_rinci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
