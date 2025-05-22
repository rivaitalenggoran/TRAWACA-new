-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 07:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trwca`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id_aplikasi` int(255) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL,
  `link_aplikasi` varchar(255) NOT NULL,
  `disable` tinyint(1) NOT NULL,
  `jenis_aplikasi` enum('purwarupa','non-purwarupa') NOT NULL DEFAULT 'purwarupa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id_aplikasi`, `nama_aplikasi`, `link_aplikasi`, `disable`, `jenis_aplikasi`) VALUES
(16, 'OCR Cakra', 'https://trawaca.id/ocrjawa', 0, 'non-purwarupa'),
(17, 'Anotasi Aksara Jawa', 'https://trawaca.id/anotasi', 0, 'non-purwarupa'),
(18, 'Belajar Aksara Jawa', 'https://trawaca.id/sinau', 0, 'non-purwarupa'),
(19, 'Diagram Sankey Naskah Jawa', 'https://trawaca.id/asankey.php', 0, 'non-purwarupa'),
(20, 'Pisahkan Ilustrasi Naskah', 'https://trawaca.id/hapusgbr', 0, 'purwarupa');

-- --------------------------------------------------------

--
-- Table structure for table `bahasa`
--

CREATE TABLE `bahasa` (
  `id_bahasa` int(255) NOT NULL,
  `nama_bahasa` varchar(255) NOT NULL,
  `link_bahasa` varchar(255) NOT NULL,
  `disable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahasa`
--

INSERT INTO `bahasa` (`id_bahasa`, `nama_bahasa`, `link_bahasa`, `disable`) VALUES
(7, 'Indonesia', 'beranda.php?lang=id', 0),
(8, 'English', 'beranda.php?lang=en', 0),
(9, 'Jawa', 'beranda.php?lang=jw', 0);

-- --------------------------------------------------------

--
-- Table structure for table `beranda_header`
--

CREATE TABLE `beranda_header` (
  `id_header` int(11) NOT NULL,
  `nama_header` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beranda_header`
--

INSERT INTO `beranda_header` (`id_header`, `nama_header`) VALUES
(30, 'header_1'),
(31, 'header_2'),
(32, 'header_3'),
(33, 'header_4'),
(34, 'header_5'),
(35, 'header_6'),
(36, 'header_7'),
(37, 'header_8');

-- --------------------------------------------------------

--
-- Table structure for table `beranda_header_bahasa`
--

CREATE TABLE `beranda_header_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_header` int(11) NOT NULL,
  `kode_bahasa` varchar(10) NOT NULL,
  `header` varchar(255) NOT NULL,
  `sub_header` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beranda_header_bahasa`
--

INSERT INTO `beranda_header_bahasa` (`id_bahasa`, `id_header`, `kode_bahasa`, `header`, `sub_header`) VALUES
(44, 30, 'id', 'Selamat Datang di Situs Web TRAWACA', 'TRAWACA adalah sebuah tim yang peduli pada pelestarian budaya Indonesia, dengan fokus utama pada Aksara Jawa. Anda dapat berpartisipasi pada kegiatan-kegiatan TRAWACA, dengan mengikuti tautan yang tersedia pada halaman ini.'),
(45, 31, 'id', 'TENTANG TRAWACA', 'TRAWACA merupakan akronim dari Transliterasi Aksara Jawa Duta Wacana. Selain itu dalam bahasa Jawa, \"trawaca\" juga memiliki makna \"jelas, terbaca\".\r\nSecara nyata, TRAWACA adalah sebuah tim penelitian yang terbentuk sejak tahun 2016 dan bernaung di bawah Fakultas Teknologi Informasi, Universitas Kristen Duta Wacana Yogyakarta. Tim ini terbentuk atas rasa peduli terhadap Bahasa Jawa dan bahasa-bahasa daerah lainnya di Indonesia yang pakemnya telah tergerus oleh zaman serta budaya masa kini, diiringi dengan niat menerapkan ilmu yang dimiliki di bidang Teknologi Informasi untuk membantu pelestarian budaya Indonesia.\r\nTRAWACA memilih bidang Digital Humanities sebagai lingkup penelitiannya, dengan cita-cita melakukan digitalisasi teks pada manuskrip-manuskrip aksara Jawa dan menyimpannya dalam wujud teks digital - tidak hanya dalam bentuk citra - baik dalam aksara Jawa maupun aksara Latin.'),
(46, 32, 'id', 'Tim TRAWACA', ''),
(47, 33, 'id', 'Peneliti Utama', ''),
(48, 34, 'id', 'Kontributor', ''),
(49, 35, 'id', 'Kontak Kami', ''),
(50, 36, 'id', 'Kegiatan dan Luaran TRAWACA', ''),
(51, 37, 'id', 'Sahabat TRAWACA', '');

-- --------------------------------------------------------

--
-- Table structure for table `karya_peneliti`
--

CREATE TABLE `karya_peneliti` (
  `id_karya` int(11) NOT NULL,
  `id_peneliti` int(11) NOT NULL,
  `tahun_pengerjaan_karya` year(4) NOT NULL,
  `tautan_karya` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karya_peneliti_bahasa`
--

CREATE TABLE `karya_peneliti_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_karya` int(11) DEFAULT NULL,
  `kode_bahasa` varchar(10) NOT NULL,
  `nama_karya` varchar(255) NOT NULL,
  `deskripsi_karya` text DEFAULT NULL,
  `nama_tautan_karya` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_luaran`
--

CREATE TABLE `kegiatan_luaran` (
  `id_kegiatan` int(11) NOT NULL,
  `gambar_kegiatan_luaran` varchar(255) DEFAULT NULL,
  `waktu_kegiatan_luaran` varchar(255) DEFAULT NULL,
  `link_kegiatan_luaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan_luaran`
--

INSERT INTO `kegiatan_luaran` (`id_kegiatan`, `gambar_kegiatan_luaran`, `waktu_kegiatan_luaran`, `link_kegiatan_luaran`) VALUES
(26, 'uploads/richBrian.png', '2019 - sekarang', 'www.google.com'),
(27, NULL, '2012 - sekarang', 'link kegiatan'),
(28, NULL, '2022', 'link link'),
(29, 'uploads/SUB-LOGO-FINAL.png', '2019 - 2022', 'link link link');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_luaran_bahasa`
--

CREATE TABLE `kegiatan_luaran_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `kode_bahasa` varchar(10) DEFAULT NULL,
  `nama_kegiatan_luaran` varchar(255) DEFAULT NULL,
  `deskripsi_kegiatan_luaran` text DEFAULT NULL,
  `nama_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan_luaran_bahasa`
--

INSERT INTO `kegiatan_luaran_bahasa` (`id_bahasa`, `id_kegiatan`, `kode_bahasa`, `nama_kegiatan_luaran`, `deskripsi_kegiatan_luaran`, `nama_link`) VALUES
(33, 26, 'id', 'Kegiatan trawaca', 'ini desc kegiatan trwc', 'www.google.com'),
(34, 27, 'id', 'jasdg', 'asd', 'www.www.www'),
(35, 28, 'id', 'asddf', 'ddfas', 'www.com.google'),
(36, 29, 'id', 'jokowi keren', 'prabowo ', 'ganjar.pranowo.korup');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_trawaca`
--

CREATE TABLE `kontak_trawaca` (
  `id_kontak` int(11) NOT NULL,
  `nama_kontak` varchar(255) NOT NULL,
  `link_kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontributor`
--

CREATE TABLE `kontributor` (
  `id_kontributor` int(11) NOT NULL,
  `nama_kontributor` varchar(255) NOT NULL,
  `semester_kontributor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minat_peneliti`
--

CREATE TABLE `minat_peneliti` (
  `id_minat` int(11) NOT NULL,
  `id_peneliti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minat_peneliti_bahasa`
--

CREATE TABLE `minat_peneliti_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_minat` int(11) DEFAULT NULL,
  `kode_bahasa` varchar(10) DEFAULT NULL,
  `nama_minat` varchar(255) DEFAULT NULL,
  `subtopik_minat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `navigasi`
--

CREATE TABLE `navigasi` (
  `id` int(50) NOT NULL,
  `nama_header` varchar(50) NOT NULL,
  `kode_bahasa` varchar(50) NOT NULL,
  `header` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigasi`
--

INSERT INTO `navigasi` (`id`, `nama_header`, `kode_bahasa`, `header`) VALUES
(1, 'navigasi_beranda', 'id', 'Beranda'),
(2, 'navigasi_publikasi', 'id', 'Publikasi'),
(3, 'navigasi_aplikasi', 'id', 'Aplikasi'),
(4, 'navigasi_bahasa', 'id', 'Bahasa'),
(5, 'navigasi_beranda', 'en', 'Home'),
(6, 'navigasi_publikasi', 'en', 'Publications'),
(7, 'navigasi_aplikasi', 'en', 'Tools'),
(8, 'navigasi_bahasa', 'en', 'Language'),
(9, 'navigasi_beranda', 'jw', 'Kaca Ngajeng'),
(10, 'navigasi_publikasi', 'jw', 'Naskah Penelitian'),
(11, 'navigasi_aplikasi', 'jw', 'Aplikasi'),
(12, 'navigasi_bahasa', 'jw', 'Basa');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan_peneliti`
--

CREATE TABLE `pekerjaan_peneliti` (
  `id_pekerjaan` int(11) NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan_peneliti_bahasa`
--

CREATE TABLE `pekerjaan_peneliti_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `kode_bahasa` varchar(10) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `waktu_pekerjaan` varchar(100) NOT NULL,
  `keterangan_tambahan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_peneliti`
--

CREATE TABLE `pendidikan_peneliti` (
  `id_pendidikan` int(11) NOT NULL,
  `id_peneliti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_peneliti_bahasa`
--

CREATE TABLE `pendidikan_peneliti_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `kode_bahasa` varchar(10) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `gelar` varchar(100) NOT NULL,
  `fakultas` varchar(255) DEFAULT NULL,
  `tugas_akhir` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil_peneliti`
--

CREATE TABLE `profil_peneliti` (
  `id_peneliti` int(11) NOT NULL,
  `nama_peneliti` varchar(100) NOT NULL,
  `email_peneliti` varchar(100) NOT NULL,
  `keterangan_tambahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_peneliti`
--

INSERT INTO `profil_peneliti` (`id_peneliti`, `nama_peneliti`, `email_peneliti`, `keterangan_tambahan`) VALUES
(1, 'Aditya Wikan Mahastama, S.Kom, MCS', ' mahas[at]staff.ukdw.ac.id', 'SINTA ID: 6018557<br>\r\nPublons/WoS ID: ABA-1824-2021'),
(2, 'Dr. phil. Lucia D. Krisnawati, S.S, M.A', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `profil_peneliti_bahasa`
--

CREATE TABLE `profil_peneliti_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_peneliti` int(11) NOT NULL,
  `kode_bahasa` varchar(10) NOT NULL,
  `bidang_minat` text NOT NULL,
  `institusi_peneliti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_peneliti_bahasa`
--

INSERT INTO `profil_peneliti_bahasa` (`id_bahasa`, `id_peneliti`, `kode_bahasa`, `bidang_minat`, `institusi_peneliti`) VALUES
(1, 1, 'id', 'Pengolahan Citra Digital, OCR, Sistem Cerdas, Kecerdasan Buatan untuk Game', 'Universitas Kristen Duta Wacana<br>Fakultas Teknologi Informasi<br>Program Studi Informatikaaaa'),
(2, 2, 'id', 'Pemrosesan Bahasa Natural, Pembelajaran Mesin, Deep Learning, OCR, Sistem Cerdas, Kecerdasan Buatan untuk Game', 'Universitas Kristen Duta Wacana<br>\r\nFakultas Teknologi Informasi<br>\r\nProgram Studi Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `profil_peneliti_header`
--

CREATE TABLE `profil_peneliti_header` (
  `id_header` int(50) NOT NULL,
  `nama_header` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_peneliti_header`
--

INSERT INTO `profil_peneliti_header` (`id_header`, `nama_header`) VALUES
(24, 'header_1'),
(25, 'header_2'),
(26, 'header_3'),
(27, 'header_4'),
(28, 'header_5'),
(29, 'header_6'),
(30, 'header_7'),
(31, 'header_8');

-- --------------------------------------------------------

--
-- Table structure for table `profil_peneliti_header_bahasa`
--

CREATE TABLE `profil_peneliti_header_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_header` int(11) DEFAULT NULL,
  `kode_bahasa` varchar(10) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `sub_header` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_peneliti_header_bahasa`
--

INSERT INTO `profil_peneliti_header_bahasa` (`id_bahasa`, `id_header`, `kode_bahasa`, `header`, `sub_header`) VALUES
(13, 24, 'id', 'Profil Peneliti', ''),
(14, 25, 'id', 'Curriculum Vitae', ''),
(15, 26, 'id', 'Pendidikan', ''),
(16, 27, 'id', 'Pekerjaan', ''),
(17, 28, 'id', 'Minat', ''),
(18, 29, 'id', 'Karya', ''),
(19, 30, 'id', 'Publikasi Penelitian Trawaca', ''),
(20, 31, 'id', 'Publikasi Penelitian Lainnya', '');

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_bersama_child`
--

CREATE TABLE `publikasi_bersama_child` (
  `id_publikasi_bersama_child` int(11) NOT NULL,
  `id_publikasi_bersama_parent` int(11) DEFAULT NULL,
  `id_peneliti` int(11) DEFAULT NULL,
  `nama_peneliti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_bersama_parent`
--

CREATE TABLE `publikasi_bersama_parent` (
  `id_publikasi_bersama_parent` int(11) NOT NULL,
  `tahun_publikasi` year(4) DEFAULT NULL,
  `nama_publikasi` varchar(255) DEFAULT NULL,
  `hari_tanggal_publikasi` date DEFAULT NULL,
  `tempat_publikasi` varchar(255) DEFAULT NULL,
  `tautan_publikasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_peneliti_header`
--

CREATE TABLE `publikasi_peneliti_header` (
  `id_header` int(255) NOT NULL,
  `nama_header` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publikasi_peneliti_header`
--

INSERT INTO `publikasi_peneliti_header` (`id_header`, `nama_header`) VALUES
(18, 'header_1'),
(19, 'header_2');

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_peneliti_header_bahasa`
--

CREATE TABLE `publikasi_peneliti_header_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_header` int(11) DEFAULT NULL,
  `kode_bahasa` varchar(10) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `sub_header` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publikasi_peneliti_header_bahasa`
--

INSERT INTO `publikasi_peneliti_header_bahasa` (`id_bahasa`, `id_header`, `kode_bahasa`, `header`, `sub_header`) VALUES
(23, 18, 'id', 'Publikasi Penelitian Trawaca', 'Tautan Artikel'),
(24, 19, 'id', 'Profil Peneliti', '');

-- --------------------------------------------------------

--
-- Table structure for table `publikasi_peneliti_individu`
--

CREATE TABLE `publikasi_peneliti_individu` (
  `id_publikasi` int(11) NOT NULL,
  `id_peneliti` int(11) DEFAULT NULL,
  `tahun_publikasi` year(4) NOT NULL,
  `nama_publikasi` varchar(255) NOT NULL,
  `nama_peneliti` varchar(255) NOT NULL,
  `hari_tanggal_publikasi` date NOT NULL,
  `tempat_publikasi` varchar(255) NOT NULL,
  `tautan_publikasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publikasi_peneliti_individu`
--

INSERT INTO `publikasi_peneliti_individu` (`id_publikasi`, `id_peneliti`, `tahun_publikasi`, `nama_publikasi`, `nama_peneliti`, `hari_tanggal_publikasi`, `tempat_publikasi`, `tautan_publikasi`) VALUES
(10, 1, '2018', 'Publikasi Mahas', 'Mahas', '2018-06-06', 'Rumah Mahas', 'Tautan Mahas');

-- --------------------------------------------------------

--
-- Table structure for table `sahabat_trawaca`
--

CREATE TABLE `sahabat_trawaca` (
  `id_sahabat` int(11) NOT NULL,
  `nama_sahabat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sahabat_trawaca`
--

INSERT INTO `sahabat_trawaca` (`id_sahabat`, `nama_sahabat`) VALUES
(15, 'Rivai');

-- --------------------------------------------------------

--
-- Table structure for table `sahabat_trawaca_bahasa`
--

CREATE TABLE `sahabat_trawaca_bahasa` (
  `id_bahasa` int(11) NOT NULL,
  `id_sahabat` int(11) DEFAULT NULL,
  `kode_bahasa` varchar(255) NOT NULL,
  `nama_waktu_kerjasama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sahabat_trawaca_bahasa`
--

INSERT INTO `sahabat_trawaca_bahasa` (`id_bahasa`, `id_sahabat`, `kode_bahasa`, `nama_waktu_kerjasama`) VALUES
(22, 15, 'id', '2020 - Sekarang');

-- --------------------------------------------------------

--
-- Table structure for table `tautan_peneliti`
--

CREATE TABLE `tautan_peneliti` (
  `id_tautan` int(11) NOT NULL,
  `id_peneliti` int(11) DEFAULT NULL,
  `nama_tautan` varchar(255) NOT NULL,
  `link_tautan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tautan_peneliti`
--

INSERT INTO `tautan_peneliti` (`id_tautan`, `id_peneliti`, `nama_tautan`, `link_tautan`) VALUES
(2, 2, 'Google Scholar', 'https://scholar.google.co.id/citations?user=KJrpljUAAAAJ&hl=en');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','peneliti') NOT NULL DEFAULT 'peneliti',
  `id_peneliti` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `id_peneliti`) VALUES
(1, 'mintra', '$2y$12$gnJiROoYhF5IyD4jMY0x8ePnna2z4au.Hc90eRyrs7clJZ82N3nhG', 'admin', NULL),
(2, 'mahas', '$2y$12$UOejJRTtADKzjIvZ2zAZ4uJkK9LtMs5VHt.43x4DQlJJgv97gAg0q', 'peneliti', 1),
(3, 'lucia', '$2y$12$0UrmCX79liUKm5Sp6gZ9IuI3R7Fi5ZhDW1F5mvPNoKGryCMtgP3CG', 'peneliti', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id_aplikasi`);

--
-- Indexes for table `bahasa`
--
ALTER TABLE `bahasa`
  ADD PRIMARY KEY (`id_bahasa`);

--
-- Indexes for table `beranda_header`
--
ALTER TABLE `beranda_header`
  ADD PRIMARY KEY (`id_header`);

--
-- Indexes for table `beranda_header_bahasa`
--
ALTER TABLE `beranda_header_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `id_header` (`id_header`);

--
-- Indexes for table `karya_peneliti`
--
ALTER TABLE `karya_peneliti`
  ADD PRIMARY KEY (`id_karya`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `karya_peneliti_bahasa`
--
ALTER TABLE `karya_peneliti_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `id_karya` (`id_karya`);

--
-- Indexes for table `kegiatan_luaran`
--
ALTER TABLE `kegiatan_luaran`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `kegiatan_luaran_bahasa`
--
ALTER TABLE `kegiatan_luaran_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `kegiatan_luaran_bahasa_ibfk_1` (`id_kegiatan`);

--
-- Indexes for table `kontak_trawaca`
--
ALTER TABLE `kontak_trawaca`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `kontributor`
--
ALTER TABLE `kontributor`
  ADD PRIMARY KEY (`id_kontributor`);

--
-- Indexes for table `minat_peneliti`
--
ALTER TABLE `minat_peneliti`
  ADD PRIMARY KEY (`id_minat`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `minat_peneliti_bahasa`
--
ALTER TABLE `minat_peneliti_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `id_minat` (`id_minat`);

--
-- Indexes for table `navigasi`
--
ALTER TABLE `navigasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekerjaan_peneliti`
--
ALTER TABLE `pekerjaan_peneliti`
  ADD PRIMARY KEY (`id_pekerjaan`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `pekerjaan_peneliti_bahasa`
--
ALTER TABLE `pekerjaan_peneliti_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `id_pekerjaan` (`id_pekerjaan`);

--
-- Indexes for table `pendidikan_peneliti`
--
ALTER TABLE `pendidikan_peneliti`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `pendidikan_peneliti_bahasa`
--
ALTER TABLE `pendidikan_peneliti_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `id_pendidikan` (`id_pendidikan`);

--
-- Indexes for table `profil_peneliti`
--
ALTER TABLE `profil_peneliti`
  ADD PRIMARY KEY (`id_peneliti`);

--
-- Indexes for table `profil_peneliti_bahasa`
--
ALTER TABLE `profil_peneliti_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `profil_peneliti_bahasa_ibfk_1` (`id_peneliti`);

--
-- Indexes for table `profil_peneliti_header`
--
ALTER TABLE `profil_peneliti_header`
  ADD PRIMARY KEY (`id_header`);

--
-- Indexes for table `profil_peneliti_header_bahasa`
--
ALTER TABLE `profil_peneliti_header_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `id_header` (`id_header`);

--
-- Indexes for table `publikasi_bersama_child`
--
ALTER TABLE `publikasi_bersama_child`
  ADD PRIMARY KEY (`id_publikasi_bersama_child`),
  ADD KEY `id_publikasi_bersama_parent` (`id_publikasi_bersama_parent`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `publikasi_bersama_parent`
--
ALTER TABLE `publikasi_bersama_parent`
  ADD PRIMARY KEY (`id_publikasi_bersama_parent`);

--
-- Indexes for table `publikasi_peneliti_header`
--
ALTER TABLE `publikasi_peneliti_header`
  ADD PRIMARY KEY (`id_header`);

--
-- Indexes for table `publikasi_peneliti_header_bahasa`
--
ALTER TABLE `publikasi_peneliti_header_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `publikasi_peneliti_header_bahasa_ibfk_1` (`id_header`);

--
-- Indexes for table `publikasi_peneliti_individu`
--
ALTER TABLE `publikasi_peneliti_individu`
  ADD PRIMARY KEY (`id_publikasi`),
  ADD KEY `id_peneliti` (`id_peneliti`);

--
-- Indexes for table `sahabat_trawaca`
--
ALTER TABLE `sahabat_trawaca`
  ADD PRIMARY KEY (`id_sahabat`);

--
-- Indexes for table `sahabat_trawaca_bahasa`
--
ALTER TABLE `sahabat_trawaca_bahasa`
  ADD PRIMARY KEY (`id_bahasa`),
  ADD KEY `id_sahabat` (`id_sahabat`);

--
-- Indexes for table `tautan_peneliti`
--
ALTER TABLE `tautan_peneliti`
  ADD PRIMARY KEY (`id_tautan`),
  ADD KEY `id_peneliti` (`id_peneliti`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_peneliti` (`id_peneliti`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id_aplikasi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bahasa`
--
ALTER TABLE `bahasa`
  MODIFY `id_bahasa` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `beranda_header`
--
ALTER TABLE `beranda_header`
  MODIFY `id_header` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `beranda_header_bahasa`
--
ALTER TABLE `beranda_header_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `karya_peneliti`
--
ALTER TABLE `karya_peneliti`
  MODIFY `id_karya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `karya_peneliti_bahasa`
--
ALTER TABLE `karya_peneliti_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kegiatan_luaran`
--
ALTER TABLE `kegiatan_luaran`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kegiatan_luaran_bahasa`
--
ALTER TABLE `kegiatan_luaran_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kontak_trawaca`
--
ALTER TABLE `kontak_trawaca`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kontributor`
--
ALTER TABLE `kontributor`
  MODIFY `id_kontributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `minat_peneliti`
--
ALTER TABLE `minat_peneliti`
  MODIFY `id_minat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `minat_peneliti_bahasa`
--
ALTER TABLE `minat_peneliti_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `navigasi`
--
ALTER TABLE `navigasi`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pekerjaan_peneliti`
--
ALTER TABLE `pekerjaan_peneliti`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pekerjaan_peneliti_bahasa`
--
ALTER TABLE `pekerjaan_peneliti_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pendidikan_peneliti`
--
ALTER TABLE `pendidikan_peneliti`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pendidikan_peneliti_bahasa`
--
ALTER TABLE `pendidikan_peneliti_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profil_peneliti`
--
ALTER TABLE `profil_peneliti`
  MODIFY `id_peneliti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `profil_peneliti_bahasa`
--
ALTER TABLE `profil_peneliti_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `profil_peneliti_header`
--
ALTER TABLE `profil_peneliti_header`
  MODIFY `id_header` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `profil_peneliti_header_bahasa`
--
ALTER TABLE `profil_peneliti_header_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `publikasi_bersama_child`
--
ALTER TABLE `publikasi_bersama_child`
  MODIFY `id_publikasi_bersama_child` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `publikasi_bersama_parent`
--
ALTER TABLE `publikasi_bersama_parent`
  MODIFY `id_publikasi_bersama_parent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `publikasi_peneliti_header`
--
ALTER TABLE `publikasi_peneliti_header`
  MODIFY `id_header` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `publikasi_peneliti_header_bahasa`
--
ALTER TABLE `publikasi_peneliti_header_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `publikasi_peneliti_individu`
--
ALTER TABLE `publikasi_peneliti_individu`
  MODIFY `id_publikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sahabat_trawaca`
--
ALTER TABLE `sahabat_trawaca`
  MODIFY `id_sahabat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sahabat_trawaca_bahasa`
--
ALTER TABLE `sahabat_trawaca_bahasa`
  MODIFY `id_bahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tautan_peneliti`
--
ALTER TABLE `tautan_peneliti`
  MODIFY `id_tautan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beranda_header_bahasa`
--
ALTER TABLE `beranda_header_bahasa`
  ADD CONSTRAINT `beranda_header_bahasa_ibfk_1` FOREIGN KEY (`id_header`) REFERENCES `beranda_header` (`id_header`) ON DELETE CASCADE;

--
-- Constraints for table `karya_peneliti`
--
ALTER TABLE `karya_peneliti`
  ADD CONSTRAINT `karya_peneliti_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE;

--
-- Constraints for table `karya_peneliti_bahasa`
--
ALTER TABLE `karya_peneliti_bahasa`
  ADD CONSTRAINT `karya_peneliti_bahasa_ibfk_1` FOREIGN KEY (`id_karya`) REFERENCES `karya_peneliti` (`id_karya`) ON DELETE CASCADE;

--
-- Constraints for table `kegiatan_luaran_bahasa`
--
ALTER TABLE `kegiatan_luaran_bahasa`
  ADD CONSTRAINT `kegiatan_luaran_bahasa_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan_luaran` (`id_kegiatan`) ON DELETE CASCADE;

--
-- Constraints for table `minat_peneliti`
--
ALTER TABLE `minat_peneliti`
  ADD CONSTRAINT `minat_peneliti_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE;

--
-- Constraints for table `minat_peneliti_bahasa`
--
ALTER TABLE `minat_peneliti_bahasa`
  ADD CONSTRAINT `minat_peneliti_bahasa_ibfk_1` FOREIGN KEY (`id_minat`) REFERENCES `minat_peneliti` (`id_minat`) ON DELETE CASCADE;

--
-- Constraints for table `pekerjaan_peneliti`
--
ALTER TABLE `pekerjaan_peneliti`
  ADD CONSTRAINT `pekerjaan_peneliti_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE;

--
-- Constraints for table `pekerjaan_peneliti_bahasa`
--
ALTER TABLE `pekerjaan_peneliti_bahasa`
  ADD CONSTRAINT `pekerjaan_peneliti_bahasa_ibfk_1` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan_peneliti` (`id_pekerjaan`) ON DELETE CASCADE;

--
-- Constraints for table `pendidikan_peneliti`
--
ALTER TABLE `pendidikan_peneliti`
  ADD CONSTRAINT `pendidikan_peneliti_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE;

--
-- Constraints for table `pendidikan_peneliti_bahasa`
--
ALTER TABLE `pendidikan_peneliti_bahasa`
  ADD CONSTRAINT `pendidikan_peneliti_bahasa_ibfk_1` FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan_peneliti` (`id_pendidikan`) ON DELETE CASCADE;

--
-- Constraints for table `profil_peneliti_bahasa`
--
ALTER TABLE `profil_peneliti_bahasa`
  ADD CONSTRAINT `profil_peneliti_bahasa_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE;

--
-- Constraints for table `profil_peneliti_header_bahasa`
--
ALTER TABLE `profil_peneliti_header_bahasa`
  ADD CONSTRAINT `profil_peneliti_header_bahasa_ibfk_1` FOREIGN KEY (`id_header`) REFERENCES `profil_peneliti_header` (`id_header`);

--
-- Constraints for table `publikasi_bersama_child`
--
ALTER TABLE `publikasi_bersama_child`
  ADD CONSTRAINT `publikasi_bersama_child_ibfk_1` FOREIGN KEY (`id_publikasi_bersama_parent`) REFERENCES `publikasi_bersama_parent` (`id_publikasi_bersama_parent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publikasi_bersama_child_ibfk_2` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publikasi_peneliti_header_bahasa`
--
ALTER TABLE `publikasi_peneliti_header_bahasa`
  ADD CONSTRAINT `publikasi_peneliti_header_bahasa_ibfk_1` FOREIGN KEY (`id_header`) REFERENCES `publikasi_peneliti_header` (`id_header`) ON DELETE CASCADE;

--
-- Constraints for table `publikasi_peneliti_individu`
--
ALTER TABLE `publikasi_peneliti_individu`
  ADD CONSTRAINT `publikasi_peneliti_individu_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE;

--
-- Constraints for table `sahabat_trawaca_bahasa`
--
ALTER TABLE `sahabat_trawaca_bahasa`
  ADD CONSTRAINT `sahabat_trawaca_bahasa_ibfk_1` FOREIGN KEY (`id_sahabat`) REFERENCES `sahabat_trawaca` (`id_sahabat`) ON DELETE CASCADE;

--
-- Constraints for table `tautan_peneliti`
--
ALTER TABLE `tautan_peneliti`
  ADD CONSTRAINT `tautan_peneliti_ibfk_1` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_peneliti` FOREIGN KEY (`id_peneliti`) REFERENCES `profil_peneliti` (`id_peneliti`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
