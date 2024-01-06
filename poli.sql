-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 08:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poli`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `id_jadwal` int(11) UNSIGNED NOT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `tanggal`) VALUES
(2, 4, 5, 'dszafzdfazfzfd', 1, '2024-01-05'),
(4, 1, 5, 'qwetyuqwe', 2, '2024-01-05'),
(6, 2, 6, 'asasasasdasdasfasd', 1, '2024-01-05'),
(8, 2, 5, 'qwertyu', 3, '2024-01-05'),
(10, 1, 6, 'trewsddddddd', 2, '2024-01-05'),
(12, 4, 5, 'uyttyytytytytyty', 4, '2024-01-05'),
(14, 1, 5, 'dggdgfdgdfgddfgdggd', 5, '2024-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_periksa` int(11) UNSIGNED NOT NULL,
  `id_obat` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(23, 20, 63),
(24, 20, 75),
(25, 21, 10),
(26, 21, 11),
(27, 21, 12);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `id_poli` int(11) UNSIGNED NOT NULL,
  `nip` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`, `nip`, `password`) VALUES
(19, 'Dr Hilmi', 'Hadipolo', '089776726434', 6, '2002300502', '$2y$10$12nYQDinTj2dZijpvxAfPueECGtqb2fluVhDU.fDHzn0doeKpQozK'),
(21, 'Dr Adit', 'Semarang', '089776726404', 7, '3009003002990004', '$2y$10$wXCQWOGvv/J9wYVq84/AjOn3OiS9ZDNvIHftLETW1qzRWcTKTozKO'),
(22, 'Dr Susanto', 'Semarang', '089776726433', 8, '200031010002', '$2y$10$jfboR46sZTLvTG8iUKv8wux1ClONSjNkfJkQiPcBR2gQb5vEYrH0u');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(4, 21, 'Selasa', '13:00:00', '15:00:00'),
(5, 19, 'Senin', '12:00:00', '15:00:00'),
(6, 19, 'Rabu', '09:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(9, 'Albendazol tablet 400mg', 'Kotak 5 x 6 tablet', 16470),
(10, 'Alopurinol tablet 100mg', 'Kotak 10 x 10 tablet', 17820),
(11, 'Alopurinol tablet 300mg', 'Kotak 3 x 10 tablet', 9923),
(12, 'Alprazolam tablet 0,5 mg', 'Kotak 10 x 10 tablet', 78975),
(13, 'Alprazolam tablet 1 mg', 'Kotak 10 x 10 tablet', 121500),
(14, 'Ibuprofen tablet 400 mg', 'Kotak 10 x 10 tablet', 27680),
(15, 'Ambroxol tablet 30 mg', 'Kotak 10 x 10 tablet', 16884),
(16, 'Amilorida tablet 5 mg (HCl)', 'Kotak 10 x 10 tablet', 11906),
(17, 'Aminofilin tablet 150 mg', 'Botol 1000 tablet', 58757),
(18, 'Amlodipin tablet 10 mg', 'Kotak 3 x 10 tablet', 68580),
(19, 'Amoksisilin kapsul 250 mg', 'Kotak 10 x 10 kapsul', 38799),
(20, 'Ampisilin kaplet 250 mg', 'Kotak 10 x 10 kaplet', 36315),
(21, 'Betahistin Mesilat tablet 6 mg', 'Kotak 3 x 10 tablet', 37422),
(22, 'Bisoprolol tablet 5 mg', 'Kotak 3 x 10 tablet', 94028),
(23, 'Cetirizine tablet 10 mg', 'Kotak 3 x 10 tablet', 13365),
(24, 'Cisapride tablet 10 mg', 'Kotak 10 x 10 tablet', 183398),
(25, 'Dapson tablet 100 mg', 'Botol 1000 tablet', 42525),
(26, 'Diazepam tablet 2 mg', 'Botol 100 tablet', 4307),
(27, 'Diazepam tablet 2 mg', 'Botol 1000 tablet', 42822),
(28, 'Efedrin tablet 25 mg (HCl)', 'Botol 250 tablet', 17300),
(29, 'Eritromisin kapsul 250 mg', 'Kotak 10 x 10 tablet', 68040),
(30, 'Etoposid kapsul 100 mg', 'Botol 10 kapsul', 94238),
(31, 'Famotidine tablet 40 mg', 'Kotak 5 x 10 tablet', 11948),
(32, 'Fenilbutason tablet 200 mg', 'Kotak 15 x 10 tablet', 19643),
(33, 'Fenobarbital tablet 30 mg', 'Kotak 10 x 10 tablet', 8762),
(34, 'Gemfibrozil kapsul 300 mg', 'Kotak 12 x 10 kapsul', 47115),
(35, 'Glimepiride tablet 1 mg', 'Kotak 5 x 10 tablet', 51305),
(36, 'Gliquidon tablet 30 mg', 'Kotak 10 x 10 tablet', 87114),
(37, 'Haloperidol tablet 5 mg', 'Kotak 10 x 10 tablet', 16509),
(38, 'Haloperidol tablet 2 mg', 'Kotak 10 x 10 tablet', 12859),
(39, 'Hidroklorotiazida tablet 25 mg', 'Botol 1000 tablet', 49005),
(40, 'Indometasin kapsul 25 mg', 'Kotak 10 x 10 tablet', 5347),
(42, 'Itrakonazol kapsul 100 mg', 'Kotak 3 x 10 kapsul', 58482),
(43, 'Kalium Diklofenak tablet 25 mg', 'Kotak 5 x 10 tablet', 26382),
(44, 'Kalsium Karbonat tablet 500 mg', 'Botol 100 tablet', 5835),
(45, 'Kaptopril tablet 25 mg', 'Kotak 6 x 10 tablet', 11613),
(46, 'Levamisol tablet 50 mg', 'Botol 25 tablet', 3983),
(47, 'Levofloksasin tablet 500 mg', 'Kotak 5 x 10 tablet', 77873),
(48, 'Linkomisin kapsul 500 mg', 'Kotak 5 x 10 tablet', 43875),
(49, 'Mebendazol tablet 100 mg', 'Kotak 5 x 6 tablet', 8775),
(50, 'Meloksikam tablet 15 mg', 'Kotak 5 x 10 tablet', 80933),
(51, 'Metformin HCl tablet 500 mg', 'Kotak 10 x 10 tablet', 24503),
(52, 'Natrium Bikarbonat tablet 500 mg', 'Botol 1000 tablet', 19305),
(53, 'Natrium Diklofenak tablet 50 mg', 'Kotak 5 x 10 tablet', 14693),
(54, 'Nevirapin tablet 200 mg', 'Botol 60 tablet', 211613),
(55, 'Ofloxacin tablet 200 mg', 'Kotak 5 x 10 tablet', 39832),
(56, 'Omeprazol kapsul 20 mg', 'Botol 7 kapsul', 7271),
(57, 'Oseltamivir 75 mg', 'Kotak 10', 175500),
(58, 'Papaverin tablet 40 mg', 'Botol 1000 tablet', 134325),
(59, 'Parasetamol tablet 500 mg', 'Kotak 10 x 10 tablet', 14175),
(60, 'Perfenazin tablet 4 mg (HCl)', 'Botol 100 tablet', 7425),
(61, 'Ranitidin tablet 150 mg', 'Kotak 3 x 10 tablet', 8910),
(62, 'Reserpin tablet 0,25 mg', 'Botol 1000 tablet', 118800),
(63, 'Risperidon tablet 1 mg', 'Kotak 5 x 10 tablet', 126968),
(64, 'Sefadroksil kapsul 250 mg', 'Kotak 3 x 10 kapsul', 18025),
(65, 'Sefadroksil kapsul 500 mg', 'Kotak 10 x 10 kapsul', 113400),
(66, 'Sefaklor kapsul 500 mg', 'Kotak 3 x 10 kapsul', 88455),
(67, 'Tamoksifen tablet 20 mg', 'Botol 30 tablet', 52838),
(68, 'Teofilin tablet 150 mg', 'Kotak 10 x 10 tablet', 7339),
(69, 'Tetrasiklin kapsul 250 mg', 'Kotak 10 x 10 tablet', 18900),
(70, 'Valproat tablet 150 mg', 'Botol 50 tablet', 15922),
(71, 'Verapamil tablet 80 mg (HCl)', 'Kotak 10 x 10 tablet', 47540),
(72, 'Vitamin B Kompleks tablet', 'Botol 1000 tablet', 29970),
(73, 'Zidovudin 300 mg + Lamivudine 150 mg', 'Botol 60 tablet', 252450),
(74, 'Zidovudin tablet 100 mg', 'Botol 60 tablet', 76849),
(75, 'Zinc tablet 20 mg', 'Kotak 10 x 10 tablet', 64125);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
(1, 'Sasuke', 'Konoha', '3319060105020002', '08986788890', '202312-001'),
(2, 'Yagami', 'Jepang', '3320406010001', '089776726434', '202312-002'),
(3, 'Rahmat', 'Kudus', '331906050030002', '087654765456', '202401-001'),
(4, 'gustina', 'Hadipolo', '34343434343', '089776726434', '202401-002');

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_daftar_poli` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(20, 4, '2024-01-06 05:44:29', 'diminum 3x sehari', 341093),
(21, 2, '2024-01-06 08:14:03', 'asaa', 256718);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(6, 'Umum', 'Poliklinik Umum'),
(7, 'Jantung', 'Poli Spesialis Jantung'),
(8, 'Mata', 'Poli Mata');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'hilmi', 'hilmi', '$2y$10$gVw.JJWXZmxWDE0Pk8QwX.pVSP0j2f2EWWlhTA3vCisFgXw3Ns3KS', 1),
(2, 'admin111111', 'admin1', '$2y$10$uUDY/Bnfto9Q6W1AYQPcxe1wrOMkwufso3XqxULQfn9rt8eKXEstW', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pasien_daftar_poli` (`id_pasien`),
  ADD KEY `fk_jadwal_daftar_poli` (`id_jadwal`);

--
-- Indexes for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_periksa_periksa` (`id_periksa`),
  ADD KEY `fk_detail_periksa_obat` (`id_obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dokter_poli` (`id_poli`);

--
-- Indexes for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwal_dokter` (`id_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_periksa_daftar_poli` (`id_daftar_poli`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `fk_jadwal_daftar_poli` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`),
  ADD CONSTRAINT `fk_pasien_daftar_poli` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`);

--
-- Constraints for table `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `fk_detail_periksa_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `fk_detail_periksa_periksa` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`);

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dokter_poli` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`);

--
-- Constraints for table `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `fk_jadwal_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `fk_periksa_daftar_poli` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
