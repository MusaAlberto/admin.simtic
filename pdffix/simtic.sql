-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2018 at 04:43 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simtic`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_sidebar`
--

CREATE TABLE `menu_sidebar` (
  `kd_menu` int(10) UNSIGNED NOT NULL,
  `judul_menu` varchar(45) DEFAULT NULL,
  `link_menu` text,
  `icon_menu` varchar(100) DEFAULT NULL,
  `is_main_menu` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status_menu` varchar(20) NOT NULL DEFAULT '0',
  `level_menu` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_sidebar`
--

INSERT INTO `menu_sidebar` (`kd_menu`, `judul_menu`, `link_menu`, `icon_menu`, `is_main_menu`, `status_menu`, `level_menu`) VALUES
(1, 'Dashboard', 'dashboard', 'fa fa-dashboard', 0, 'active', 'all'),
(2, 'Master Data', '#', 'fa fa-briefcase', 0, '', 'all'),
(3, 'Pengawasan', 'pengawasan', 'fa fa-list-alt', 0, '', 'admin'),
(4, 'Hasil', 'hasil', 'fa fa-list-alt', 0, '', 'all'),
(5, 'Bank Soal Simulasi', '#', 'fa fa-list-alt', 0, '', 'dosen'),
(6, 'Bank Soal Ujian', '#', 'fa fa-list-alt', 0, '', 'dosen'),
(201, 'Dosen', 'dosen', '', 2, '', 'all'),
(202, 'Mahasiswa', 'mahasiswa', '', 2, '', 'all'),
(203, 'Umum', 'peserta_umum', '', 2, '', 'all'),
(204, 'Kategori', 'kategori', '', 2, '', 'dosen'),
(501, 'Simulasi Listening', 'simulasi_listening', '', 5, '', 'dosen'),
(502, 'Simulasi Reading', 'simulasi_reading', '', 5, '', 'dosen'),
(601, 'Ujian Listening', 'ujian_listening', '', 6, '', 'dosen'),
(602, 'Ujian Reading', 'ujian_reading', '', 6, '', 'dosen');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_audio`
--

CREATE TABLE `tabel_audio` (
  `id_audio` varchar(5) NOT NULL,
  `id_kategori_soal` varchar(5) NOT NULL,
  `audio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_audio`
--

INSERT INTO `tabel_audio` (`id_audio`, `id_kategori_soal`, `audio`) VALUES
('L0001', '', 'L0001.mp3'),
('L0002', '', 'L0002.mp3'),
('L0003', '', 'L0003.mp3'),
('L0004', '', 'http://localhost/admin.simtic/assets/soal_assets/audio/L00051.mp3'),
('L0005', '', 'http://localhost/admin.simtic/assets/soal_assets/audio/L00052.mp3'),
('L0006', '', 'http://localhost/admin.simtic/assets/soal_assets/audio/L00052.mp3'),
('L0007', '', 'http://localhost/admin.simtic/assets/soal_assets/audio/L0007.wma');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_dosen`
--

CREATE TABLE `tabel_dosen` (
  `id_dosen` varchar(6) NOT NULL,
  `kode_dosen` varchar(20) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status_dosen` varchar(1) NOT NULL,
  `level_user` enum('admin','dosen','superadmin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_dosen`
--

INSERT INTO `tabel_dosen` (`id_dosen`, `kode_dosen`, `nip`, `nama_dosen`, `alamat`, `no_hp`, `email`, `password`, `foto`, `status_dosen`, `level_user`) VALUES
('00001', 'D0001', '12837876182', 'Musa Aleee', 'Temanggung', '323', 'admin@gmail.com', 'darma123', '', 'A', 'admin'),
('00002', 'D0002', '2342342', 'Alberto', 'Semarang', 'jh', 'dosen@gmail.com', 'darma123', '', 'A', 'dosen'),
('00003', 'D0003', '24', 'sd', '', '890', 'manager@gmail.com', 'darma123', '', 'A', 'superadmin'),
('00004', 'D0004', '0', '', '', '', 'd@gmail.com', '1234', '', 'D', 'dosen'),
('00007', 'D0007', '0', '123', '', '', '', '', '', 'D', 'dosen'),
('00008', 'D0008', '0', '', '', '', 'q@f.v', 'qwerty', '', 'D', 'dosen'),
('00009', 'D0009', '0', '', '', '', 'anisa@gmail.com', '12345', '', 'D', 'dosen'),
('00010', 'D0010', '0', '', '', '', 'sdf@gmail.com', '123456', '', 'D', 'dosen'),
('00011', 'D0011', '234234', 'Musa', 'Semarang', '45645', 'musa@gmail.com', '123', 'musa', 'A', 'dosen'),
('00012', 'D0012', '43534', 'Pasha', 'Rembang', '987879', 'avd@g.com', '', '', 'A', 'dosen'),
('00013', 'D0013', '234256', 'Alberto', 'Temanggung', '089758937467', 'agj@gm.com', '123', '', 'D', 'dosen'),
('00014', 'D0014', '19890103', 'Eko', 'Semarang', '08975837010', 'eko@gmail.com', '123', '', 'D', 'dosen'),
('00015', 'D0015', '1928012380', 'Rudi', 'Semarang', '095878556786', 'rudi.rudi@gmail.com', '123', '', 'D', 'dosen'),
('00016', 'D0016', '444444', 'Alberto', 'Kab. Semarang', '123', 'hmm@gmail.com', '', '', 'D', 'dosen'),
('00017', 'D0017', '33415120', 'Septyan Nugroho', 'Waru Timur', '08956748326', 'septyan@gmail.com', '123', '', 'A', 'dosen'),
('00018', 'D0018', '196010131988031002', 'Parsumo Rahardjo', 'Semarang', '085849345743', 'parsumorahardjo@gmail.com', '123', '', 'A', 'dosen'),
('00019', 'D0019', '198987982', 'Dilanda', 'ds', '35434', 'afr@df.v', '202cb962ac59075b964b07152d234b70', '', 'A', 'dosen');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_grade`
--

CREATE TABLE `tabel_grade` (
  `id_grade` varchar(5) NOT NULL,
  `grade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_hasil`
--

CREATE TABLE `tabel_hasil` (
  `id_hasil` varchar(5) NOT NULL,
  `kode_auth` varchar(5) NOT NULL,
  `score_listening` int(3) NOT NULL,
  `score_reading` int(3) NOT NULL,
  `id_grade` varchar(5) NOT NULL,
  `tgl_tes` date NOT NULL,
  `jenis_tes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_hasil`
--

INSERT INTO `tabel_hasil` (`id_hasil`, `kode_auth`, `score_listening`, `score_reading`, `id_grade`, `tgl_tes`, `jenis_tes`) VALUES
('1', 'P0001', 320, 320, '', '2018-08-17', 'ujian'),
('3', 'P0003', 0, 0, '', '2018-08-22', ''),
('45', 'P0002', 0, 0, '', '2018-06-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jadwal`
--

CREATE TABLE `tabel_jadwal` (
  `id_jadwal` varchar(5) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tgl_tes` varchar(10) NOT NULL,
  `jam` varchar(8) NOT NULL,
  `kuota` int(2) NOT NULL,
  `status` varchar(1) NOT NULL,
  `nama_event` varchar(50) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_jadwal`
--

INSERT INTO `tabel_jadwal` (`id_jadwal`, `kelas`, `tgl_tes`, `jam`, `kuota`, `status`, `nama_event`, `nama_ruang`, `start`, `end`) VALUES
('00001', '', '', '', 0, '', 'hgfhg', 'hgfhgf', '2018-04-12 00:00:00', '2018-04-28 23:59:00'),
('00002', '', '', '', 12, '', 'Tes Online', 'UPT Bahasa Lab 1', '2018-04-27 05:18:00', '2018-04-27 05:18:00'),
('00003', '', '', '', 17, '', 'Tes', 'Lab 1', '2018-04-30 00:00:00', '2018-04-30 23:59:00'),
('00004', '', '', '', 20, '', 'Ujian Online', 'Lab. Bahasa 1', '2018-05-16 00:00:00', '2018-05-16 23:59:00'),
('00005', '', '', '', 15, '', 'Ujian', 'Lab.2', '2018-05-17 00:00:00', '2018-05-17 23:59:00'),
('00006', '', '', '', 12, '', 'sfd', 'sdfs', '2018-05-12 00:00:00', '2018-05-12 23:59:00'),
('00007', '', '', '', 20, '', 'Tes Online', 'lab 1', '2018-05-23 05:35:14', '2018-05-23 05:35:14'),
('00009', '', '', '', 20, '', 'tes TOEIC', 'Lab. Bahasa 1', '2018-08-17 00:00:00', '2018-08-17 23:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jurusan`
--

CREATE TABLE `tabel_jurusan` (
  `id_jurusan` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_jurusan`
--

INSERT INTO `tabel_jurusan` (`id_jurusan`, `nama`) VALUES
(1, 'Teknik Elektro'),
(2, 'Teknik Sipil'),
(3, 'Teknik Mesin'),
(4, 'Akuntansi'),
(5, 'Administrasi Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kategori`
--

CREATE TABLE `tabel_kategori` (
  `id_kategori` int(5) NOT NULL,
  `kode_kategori` varchar(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `jenis_soal` enum('Listening','Reading','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kategori`
--

INSERT INTO `tabel_kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`, `jenis_soal`) VALUES
(1, 'L01', 'Photo', 'Listening'),
(2, 'L02', 'Question-Response', 'Listening'),
(3, 'L03', 'Conversations', 'Listening'),
(4, 'L04', 'Short Talks', 'Listening'),
(5, 'R01', 'Incomplete Sentences', 'Reading'),
(6, 'R02', 'Error Recognition', 'Reading'),
(7, 'R03', 'Reading Comprehension', 'Reading');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_konversi_nilai`
--

CREATE TABLE `tabel_konversi_nilai` (
  `id_konversi` int(11) NOT NULL,
  `jmlh_benar` varchar(5) NOT NULL,
  `konv_listening` varchar(5) NOT NULL,
  `konv_reading` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_konversi_nilai`
--

INSERT INTO `tabel_konversi_nilai` (`id_konversi`, `jmlh_benar`, `konv_listening`, `konv_reading`) VALUES
(1, '0', '5', '5'),
(2, '1', '5', '5'),
(3, '2', '5', '5'),
(4, '3', '5', '5'),
(5, '4', '5', '5'),
(6, '5', '5', '5'),
(7, '6', '5', '5'),
(8, '7', '10', '5'),
(9, '8', '15', '5'),
(10, '9', '20', '5'),
(11, '10', '25', '5'),
(12, '11', '30', '5'),
(13, '12', '35', '5'),
(14, '13', '40', '5'),
(15, '14', '45', '5'),
(16, '15', '50', '5'),
(17, '16', '55', '10'),
(18, '17', '60', '15'),
(19, '18', '65', '20'),
(20, '19', '70', '25'),
(21, '20', '75', '30'),
(22, '21', '80', '35'),
(23, '22', '85', '40'),
(24, '23', '90', '45'),
(25, '24', '95', '50'),
(26, '25', '100', '60'),
(27, '26', '110', '65'),
(28, '27', '115', '70'),
(29, '28', '120', '80'),
(30, '29', '125', '85'),
(31, '30', '130', '90'),
(32, '31', '135', '95'),
(33, '32', '140', '100'),
(34, '33', '145', '110'),
(35, '34', '150', '115'),
(36, '35', '160', '120'),
(37, '36', '165', '125'),
(38, '37', '170', '130'),
(39, '38', '175', '140'),
(40, '39', '180', '145'),
(41, '40', '185', '150'),
(42, '41', '190', '160'),
(43, '42', '195', '165'),
(44, '43', '200', '170'),
(45, '44', '210', '175'),
(46, '45', '215', '180'),
(47, '46', '220', '190'),
(48, '47', '230', '195'),
(49, '48', '240', '200'),
(50, '49', '245', '210'),
(51, '50', '250', '215'),
(52, '51', '255', '220'),
(53, '52', '260', '225'),
(54, '53', '270', '230'),
(55, '54', '275', '235'),
(56, '55', '280', '240'),
(57, '56', '290', '250'),
(58, '57', '295', '255'),
(59, '58', '300', '260'),
(60, '59', '310', '265'),
(61, '60', '315', '270'),
(62, '61', '320', '280'),
(63, '62', '325', '285'),
(64, '63', '330', '290'),
(65, '64', '340', '300'),
(66, '65', '345', '305'),
(67, '66', '350', '310'),
(68, '67', '360', '320'),
(69, '68', '365', '325'),
(70, '69', '370', '330'),
(71, '70', '380', '335'),
(72, '71', '385', '340'),
(73, '72', '390', '350'),
(74, '73', '395', '355'),
(75, '74', '400', '360'),
(76, '75', '405', '365'),
(77, '76', '410', '370'),
(78, '77', '420', '380'),
(79, '78', '425', '385'),
(80, '79', '430', '390'),
(81, '80', '440', '395'),
(82, '81', '445', '400'),
(83, '82', '450', '405'),
(84, '83', '460', '410'),
(85, '84', '465', '415'),
(86, '85', '470', '420'),
(87, '86', '475', '425'),
(88, '87', '480', '430'),
(89, '88', '485', '435'),
(90, '89', '490', '445'),
(91, '90', '495', '450'),
(92, '91', '495', '455'),
(93, '92', '495', '465'),
(94, '93', '495', '470'),
(95, '94', '495', '480'),
(96, '95', '495', '485'),
(97, '96', '495', '490'),
(98, '97', '495', '495'),
(99, '98', '495', '495'),
(100, '99', '495', '495'),
(101, '100', '495', '495');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_peserta`
--

CREATE TABLE `tabel_peserta` (
  `id_peserta` varchar(5) NOT NULL,
  `kode_peserta` varchar(5) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `nama_institusi` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `level_user` enum('mahasiswa','umum') NOT NULL,
  `status_peserta` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_peserta`
--

INSERT INTO `tabel_peserta` (`id_peserta`, `kode_peserta`, `nama`, `kelas`, `nim`, `prodi`, `jurusan`, `nama_institusi`, `no_telp`, `alamat`, `foto`, `email`, `password`, `level_user`, `status_peserta`) VALUES
('00001', 'P0001', 'Musa', 'Ik3A', '3.34.15.0.16', '1', '1', 'Politeknik Negeri Semarang', '085878440411', '', 'Musa.jpg', 'musa@gmail.com', 'musa123', 'mahasiswa', 'A'),
('00002', 'P0002', 'Alberto P', '', '', '', '', 'Universitas Gajah Mada', '087664783888', 'Ungaran', '000416.jpg', 'albertopasha@gmail.com', '', 'umum', 'A'),
('00003', 'P0003', 'Ahmad', 'AK-2A', '123', '7', '2', 'sdf', '876', 'sdfsdf', '000403.jpg', 'a@b.n', '123', 'mahasiswa', 'A'),
('00004', 'P0004', '', '', '', '', '', '', '', '', '', 'map@gmail.com', 'qwerty', 'mahasiswa', 'A'),
('00005', 'P0005', '', '', '', '', '', '', '', '', '', 'musaalberto.gmail.com', 'qwerty', 'mahasiswa', 'A'),
('00006', 'P0006', '', '', '', '', '', '', '', '', '', 'bambang10@gmail.com', '123456', 'umum', 'D'),
('00007', 'P0007', '', '', '', '', '', '', '', '', '', 'purnomo@gmail.com', '123456', 'umum', 'D'),
('00008', 'P0008', '', '', '', '', '', '', '', '', '', 'd@gmail.com', '123456', 'mahasiswa', 'A'),
('00009', 'P0009', '', '', '', '', '', '', '', '', '', 'abi@gmail.com', '123456', 'umum', 'D'),
('00010', 'P0010', '', '', '', '', '', '', '', '', '', 'admin@gmail.com', '123', 'mahasiswa', 'D'),
('00011', 'P0011', '', '', '', '', '', '', '', '', '', '', '', 'mahasiswa', 'D'),
('00012', 'P0012', '', '', '', '', '', '', '', '', '', 'admin1@gmail.com', '123', 'mahasiswa', 'A'),
('00013', 'P0013', '', '', '', '1', '1', '', '', '', '', 'admin2@gmail.com', '123', 'mahasiswa', 'D'),
('00014', 'P0014', 'Bambang', 'KE-1A', '3.34.15.0.78', '1', '1', '', '083876476486', 'Jepara', '00014.jpg', 'a@dfd.com', '123', 'mahasiswa', 'A'),
('00015', 'P0015', '', '', '', '1', '1', '', '', '', '00015.jpg', 'admin77@gmail.com', '123', 'mahasiswa', 'D'),
('00016', 'P0016', 'Musa Alberto Pasha', 'IK-3A', '33415016', '1', '1', 'Politeknik Negeri Semarang', '', '', '00016.jpg', 'musaalbertopasha@gmail.com', 'musa123', 'mahasiswa', 'A'),
('00017', 'P0017', 'Pasha Alberto', 'IK-3A', '3.34.15.0.00', '1', '1', 'Politeknik Negeri Semarang', '085888674859', 'Semarang', '00017.jpg', 'pashaalberto@gmail.com', '123', 'mahasiswa', 'A'),
('00018', 'P0018', 'kjh', '', '', '', '', '123', '', 'hh@d.com', '', '', '', 'umum', 'D'),
('00019', 'P0019', 'kjh', '', '', '', '', '123', '000191.jpg', 'hh@d.com', '', '', '', 'umum', 'A'),
('00020', 'P0020', 'Sopo', '', '', '', '', 'kjh', '876', 'jhk', '000412.jpg', 'sas@f.v', '123', 'umum', 'A'),
('00021', 'P0021', 'kjh', '', '', '', '', '123', '000211.jpg', 'hh@d.com', '', '', '', 'umum', 'A'),
('00022', 'P0022', 'kjh', '', '', '', '', '', '', '', '000222.jpg', 'hh@d.com', '123', 'umum', 'D'),
('00023', 'P0023', 'Sopo', '', '', '', '', '', '', '', '', 'sdfs@f.c', '123', 'umum', 'D'),
('00024', 'P0024', 'sdf', '', '', '', '', '', '', '', '', 'dfg@d.com', '123', 'umum', 'D'),
('00025', 'P0025', 'werrtr', '', '', '', '', '', '', '', '', 'fgfg@ert.bm', '1234', 'umum', 'D'),
('00026', 'P0026', 'Alberto Pasha', 'sdf', 'sdfs', '21', '5', 'Politeknik Negeri Semarang', '434', 'sd', '', 'sdfs@kj.b', '123', 'mahasiswa', 'D'),
('00027', 'P0027', 'hhj', 'oj', '786', '1', '1', 'Politeknik Negeri Semarang', '987', 'kjh', '000272.jpg', 'asd@ewe.co', '1234', 'mahasiswa', 'D'),
('00028', 'P0028', 'jhgjhg', '', '', '', '', '', '', '', '00028.jpg', 'asdsdf@iu.com', '12345', 'umum', 'D'),
('00029', 'P0029', 'hgjhgjhg', '', '', '', '', '8768', 'kjhkh', 'iuyghj', '00029.jpg', 'hgfhagfs@kjh.com', '123456', 'umum', 'D'),
('00030', 'P0030', 'iuiuu', '', '', '', '', '9879', 'iuhiuh', 'iuhi', '', 'asdasjc@ijis.com', '123456', 'umum', 'D'),
('00032', 'P0032', 'hfhgf', '', '', '', '', 'gjh', '86', 'jg', '000322.jpg', 'asdy@uyt.com', '', 'umum', 'A'),
('00033', 'P0033', 'Alberto Pasha', '', '', '', '', 'Universitas Diponegoro', '08975837010', 'Parakan', '00033.jpg', 'albertopasha9@gmail.com', '123', 'umum', 'A'),
('00034', 'P0034', 'Ajid', 'IK-3B', '3.34.15.1.20', '1', '1', 'Politeknik Negeri Semarang', '089', 'Waru', '', 'gjghh@gmail.com', '123', 'mahasiswa', 'A'),
('00035', 'P0035', 'Septyan', 'IK-3A', '3.34.15.0.76', '1', '', 'Politeknik Negeri Semarang', '678', 'Semarang', '', 'dfgre@gmail.com', '123', 'mahasiswa', 'A'),
('00036', 'P0036', 'Septyan', 'IK-3A', '3.34.15.0.76', '8', '2', 'Politeknik Negeri Semarang', '87687', 'werwe', '', 'asdasd@fd.c', '123', 'mahasiswa', 'D'),
('00037', 'P0037', 'hgjhgjhg', 'IK-3A', '76', '4', '1', 'Politeknik Negeri Semarang', '567567', 'vhv', 'as2d@.vf', '', '', 'mahasiswa', 'D'),
('00038', 'P0038', 'wer', '', '', '', '', 'gdfg', '57', 'rte', '00038.jpg', 'wer@gm.b', '123', 'umum', 'D'),
('00039', 'P0039', 'erter', '', '', '', '', 'ty', '56', 'tyr', '', 'se@sfd.rt', '123', 'umum', 'D'),
('00040', 'P0040', 'Dwi', 'IK-3B', '3.34.15.0.887', '11', '3', 'Politeknik Negeri Semarang', '34533333', 'Semarang2', '00041.jpg', 'rizal@gmail.com', '123', 'mahasiswa', 'D'),
('00041', 'P0041', 'Alberto P', '', '', '', '', 'kl', '987', 'kjh', '', 's@gmail.com', '123', 'umum', 'D'),
('00042', 'P0042', 'Alberto Pasha', '', '', '', '', 'kjh', '877', 'hjg', '', 'albertopasha9@gmail.com', '123', 'umum', 'D'),
('00043', 'P0043', 'Alberto P', '', '', '', '', 'kjh', '', 'sdf', '', 'albertopasha9@gmail.com', '123', 'umum', 'D'),
('00044', 'P0044', 'Alberto P', '', '', '', '', 'lljkh', '876', 'fg', '', 'sas@gmail.com', '123', 'umum', 'D'),
('00045', 'P0045', 'Dian Ramadhan', 'IK-3A', '3.34.15.0.05', '1', '1', 'Politeknik Negeri Semarang', '083879586785', 'Manyong, Jepara', '00046.png', 'dianrama@gmail.com', '123', 'mahasiswa', 'D'),
('00046', 'P0046', 'Dian Rama', '', '', '', '', 'Universitas Dian Nuswantoro', '083869859683', 'Manyong, Jepara', '00047.png', 'ramadian@gmail.com', '123', 'umum', 'D'),
('00047', 'P0047', 'Bambang', '', '', '', '', 'uii', '23423', 'Malang', '000471.PNG', 'agdfg@dfd.com', '123', 'umum', 'A'),
('00048', 'P0048', 'jkajskdj', '', '', '', '', 'klj', '098', 'klj', 'http://localhost/admin.simtic/', 'asdasd@fd.cm', '123', 'umum', 'A'),
('00049', 'P0049', 'iuyuhk', '', '', '', '', 'oij', '87687', 'kjhkhi', '49', 'sfs@f.j', '123', 'umum', 'A'),
('00050', 'P0050', 'ererg', '', '', '', '', 'w4tw', '45', 'erw', 'http://localhost/admin.simtic/', 'werw@ew.d', '123', 'umum', 'A'),
('00051', 'P0051', 'wer', '', '', '', '', 'jij', '98799', 'kjnkj', 'http://localhost/admin.simtic/', 'sd@fs.b', '123', 'umum', 'A'),
('00052', 'P0052', 'yuytuyt', '', '', '', '', 'uyi', '7876876', 'hgjh', 'http://localhost/admin.simtic/00052.PNG', 'asd@nnk.v', '123', 'umum', 'A'),
('00053', 'P0053', ',jajhs', '', '', '', '', 'jjhkjh', '8768767', 'hhjh', 'http://localhost/admin.simtic/assets/user_image00053.PNG', 'rsdr@f.c', '123', 'umum', 'A'),
('00054', 'P0054', 'tuytutuyt', '', '', '', '', 'uytuy', '876', 'hgjh', 'http://localhost/admin.simtic/assets/user_image/000551.PNG', 'asdhgj@gd.z', '123', 'umum', 'A'),
('00055', 'P0055', 'Tatak', 'IK-3A', '3.34.15.0.22', '1', '1', 'Politeknik Negeri Semarang', '082240876886', 'Lahat, Lampung', 'http://localhost/admin.simtic/assets/user_image/00056.PNG', 'tatak@gmail.com', '123', 'mahasiswa', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_prodi`
--

CREATE TABLE `tabel_prodi` (
  `id_prodi` int(11) NOT NULL,
  `id_jurusan` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_prodi`
--

INSERT INTO `tabel_prodi` (`id_prodi`, `id_jurusan`, `nama`) VALUES
(1, 1, 'D3 - Teknik Informatika'),
(2, 1, 'D3 - Teknik Telekomunikasi'),
(3, 1, 'D3 - Teknik Elektronika'),
(4, 1, 'D3 - Teknik Listrik'),
(5, 1, 'D4 - Teknik Telekomunikasi'),
(6, 1, 'S2 - Teknik Telekomunikasi'),
(7, 2, 'D3 - Konstruksi Sipil'),
(8, 2, 'D3 - Konstruksi Gedung'),
(9, 2, 'D4 - Perancangan Jalan dan Jembatan'),
(10, 2, 'D4 - Teknik Perawatan dan Perbaikan Gedung'),
(11, 3, 'D3 - Teknik Konversi Energi'),
(12, 3, 'D3 - Teknik Mesin'),
(13, 3, 'D4 - Teknik Rekayasa Pembangkit Energi'),
(14, 3, 'D4 - Teknik Mesin Produksi dan Perawatan'),
(15, 4, 'D3 - Keuangan dan Perbankan'),
(16, 4, 'D3 - Akuntansi'),
(17, 4, 'D4 - Analis Keuangan'),
(18, 4, 'D4 - Perbankan Syariah'),
(19, 4, 'D4 - Akuntansi Manajerial'),
(20, 4, 'D4 - Komputerisasi Akuntansi'),
(21, 5, 'D3 - Manajemen Pemasaran'),
(22, 5, 'D3 - Administrasi Bisnis'),
(23, 5, 'D4 - Administrasi Bisnis Terapan'),
(24, 5, 'D4 - Manajemen Bisnis International');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_reg_tes`
--

CREATE TABLE `tabel_reg_tes` (
  `id_reg_tes` varchar(5) NOT NULL,
  `id_jadwal` varchar(5) NOT NULL,
  `tgl_reg` datetime NOT NULL,
  `kode_auth` varchar(5) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_reg_tes`
--

INSERT INTO `tabel_reg_tes` (`id_reg_tes`, `id_jadwal`, `tgl_reg`, `kode_auth`, `status`) VALUES
('0001', '00009', '2018-08-17 00:00:00', 'P0001', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_soal_listening`
--

CREATE TABLE `tabel_soal_listening` (
  `id_soal` varchar(5) NOT NULL,
  `id_audio` varchar(5) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `pertanyaan` varchar(250) NOT NULL,
  `pil_a` varchar(250) NOT NULL,
  `pil_b` varchar(250) NOT NULL,
  `pil_c` varchar(250) NOT NULL,
  `pil_d` varchar(250) NOT NULL,
  `kunci_jawab` varchar(250) NOT NULL,
  `tipe_soal` varchar(250) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_soal_listening`
--

INSERT INTO `tabel_soal_listening` (`id_soal`, `id_audio`, `gambar`, `pertanyaan`, `pil_a`, `pil_b`, `pil_c`, `pil_d`, `kunci_jawab`, `tipe_soal`, `kategori`, `status`) VALUES
('00001', 'L0001', '000012.PNG', 'wefwe', 'hgjh', 'jhg', 'jhg', 'jhg', 'B', '1', 'simulasi', 'A'),
('00002', 'L0002', 'http://loc', 'jhkjh', 'y', 'io', 'iu', 'kjh', 'A', '1', 'simulasi', 'A'),
('00003', 'L0003', 'http://localhost/admin.simtic/assets/soal_assets/image/000034.PNG', 'jhkjh', 'y', 'io', 'iu', 'kjh', 'A', '1', 'simulasi', 'A'),
('00004', 'L0004', 'http://localhost/admin.simtic/assets/soal_assets/image/000044.PNG', 'iyiuyi', 'yjhg', 'bm', 'hjj', 'jhgj', 'A', '1', 'simulasi', 'A'),
('00005', 'L0005', 'http://localhost/admin.simtic/assets/soal_assets/image/000056.PNG', '', 'A', 'B', 'C', 'D', 'B', '1', 'simulasi', 'A'),
('00006', 'L0006', 'http://localhost/admin.simtic/assets/soal_assets/image/000072.PNG', 'Mark your answer on your answer sheet', 'A', 'B', 'C', 'D', 'A', '2', 'ujian', 'A'),
('00007', 'L0007', 'http://localhost/admin.simtic/assets/soal_assets/image/000073.PNG', 'Mark your answer on your answer sheet', 'khkjh', 'iuy', 'iuyh', 'lhuiu', 'B', '2', 'ujian', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_soal_reading`
--

CREATE TABLE `tabel_soal_reading` (
  `id_soal` varchar(5) NOT NULL,
  `kode_soal` varchar(5) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `pertanyaan` varchar(250) NOT NULL,
  `pil_a` varchar(250) NOT NULL,
  `pil_b` varchar(250) NOT NULL,
  `pil_c` varchar(250) NOT NULL,
  `pil_d` varchar(250) NOT NULL,
  `kunci_jawab` varchar(250) NOT NULL,
  `tipe_soal` varchar(250) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_soal_reading`
--

INSERT INTO `tabel_soal_reading` (`id_soal`, `kode_soal`, `gambar`, `pertanyaan`, `pil_a`, `pil_b`, `pil_c`, `pil_d`, `kunci_jawab`, `tipe_soal`, `kategori`, `status`) VALUES
('00001', 'M0001', 'http://localhost/admin.simtic/assets/soal_assets/image/000085.PNG', '', 'A', 'B', 'C', 'D', 'C', 'R03', 'simulasi', 'A'),
('00002', 'M0002', '000023.PNG', '', 'ug', 'jhgy7', 're', '67', 'B', 'R02', 'simulasi', 'A'),
('00003', 'M0003', '000033.PNG', '', 'iouoiu', 'uytuy', 'ihugyh', '87y87', 'C', 'R02', 'simulasi', 'A'),
('00004', 'M0004', '000043.PNG', '', 'transferring', 'transfer', 'has transferred', 'transferable', 'C', 'R01', 'ujian', 'A'),
('00005', 'M0005', '000055.PNG', '', 'with', 'by', 'from', 'until', 'C', 'R01', 'ujian', 'A'),
('00006', 'R0006', '0000620.PNG', 'wer', 'ewe', '3', 'sdsd', 'ew', 'A', 'R01', 'simulasi', 'A'),
('00007', 'R0007', 'http://localhost/admin.simtic/assets/soal_assets/image/000086.PNG', '', 'A', 'B', 'C', 'D', 'C', 'R02', 'simulasi', 'A'),
('00008', 'R0008', '', '', 'werw', 'bfg', 'werasew', 'rdfd', 'C', 'R01', 'simulasi', 'A'),
('00009', 'R0009', 'http://localhost/admin.simtic/assets/soal_assets/image/000091.PNG', '', 'It', 'its', 'their', 'they', 'A', 'R01', 'ujian', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_sidebar`
--
ALTER TABLE `menu_sidebar`
  ADD PRIMARY KEY (`kd_menu`);

--
-- Indexes for table `tabel_audio`
--
ALTER TABLE `tabel_audio`
  ADD PRIMARY KEY (`id_audio`);

--
-- Indexes for table `tabel_dosen`
--
ALTER TABLE `tabel_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `tabel_grade`
--
ALTER TABLE `tabel_grade`
  ADD PRIMARY KEY (`id_grade`);

--
-- Indexes for table `tabel_hasil`
--
ALTER TABLE `tabel_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tabel_jadwal`
--
ALTER TABLE `tabel_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tabel_konversi_nilai`
--
ALTER TABLE `tabel_konversi_nilai`
  ADD PRIMARY KEY (`id_konversi`);

--
-- Indexes for table `tabel_peserta`
--
ALTER TABLE `tabel_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `jurusan` (`jurusan`),
  ADD KEY `prodi` (`prodi`);

--
-- Indexes for table `tabel_prodi`
--
ALTER TABLE `tabel_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `tabel_reg_tes`
--
ALTER TABLE `tabel_reg_tes`
  ADD PRIMARY KEY (`id_reg_tes`);

--
-- Indexes for table `tabel_soal_listening`
--
ALTER TABLE `tabel_soal_listening`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tabel_soal_reading`
--
ALTER TABLE `tabel_soal_reading`
  ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_sidebar`
--
ALTER TABLE `menu_sidebar`
  MODIFY `kd_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=603;
--
-- AUTO_INCREMENT for table `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  MODIFY `id_jurusan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tabel_konversi_nilai`
--
ALTER TABLE `tabel_konversi_nilai`
  MODIFY `id_konversi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `tabel_prodi`
--
ALTER TABLE `tabel_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_prodi`
--
ALTER TABLE `tabel_prodi`
  ADD CONSTRAINT `tabel_prodi_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `tabel_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
