-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 12:39 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen_user`
--

CREATE TABLE `absen_user` (
  `idAbsen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `PeriodeAbsen` date NOT NULL,
  `TotalAbsen` int(11) NOT NULL,
  `QtyHariKerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen_user`
--

INSERT INTO `absen_user` (`idAbsen`, `id_user`, `PeriodeAbsen`, `TotalAbsen`, `QtyHariKerja`) VALUES
(1, 5, '2022-05-28', 19, 20),
(2, 13, '2022-05-26', 18, 20),
(3, 10, '2022-05-26', 19, 20),
(5, 5, '2022-06-11', 19, 20),
(6, 6, '2022-06-10', 20, 20),
(7, 118, '2022-06-11', 20, 20),
(8, 13, '2022-06-16', 18, 20),
(9, 11, '2022-06-16', 17, 20);

-- --------------------------------------------------------

--
-- Table structure for table `anak_user`
--

CREATE TABLE `anak_user` (
  `id_anak` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `NamaAnak` varchar(128) NOT NULL,
  `HubunganAnak` varchar(128) NOT NULL,
  `TempatLahirAnak` varchar(72) NOT NULL,
  `TanggalLahirAnak` date NOT NULL,
  `PendidikanAnak` varchar(8) NOT NULL,
  `PekerjaanAnak` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anak_user`
--

INSERT INTO `anak_user` (`id_anak`, `id_user`, `NamaAnak`, `HubunganAnak`, `TempatLahirAnak`, `TanggalLahirAnak`, `PendidikanAnak`, `PekerjaanAnak`) VALUES
(1, 7, 'Desi Wirdasari', 'Anak Kandung', 'Jakarta', '2012-05-14', 'SD', 'Pelajar'),
(2, 8, 'Ani Susanti', 'anak kandung', 'tegal', '1970-05-18', 'S2', 'Dokter'),
(3, 9, 'Bambang Saputra', 'Anak kandung', 'yogyakarta', '2000-05-24', 'SD', 'Pelajar'),
(4, 10, 'Iwan Gunawan', 'Anak Kandung', 'Bogor', '2001-06-27', 'SD', 'Pelajar'),
(5, 11, 'Bagus Pamungkas', 'Anak Kandung', 'Bekasi', '2002-05-23', 'SD', 'Pelajar'),
(6, 13, 'Daniel ', 'Anak kandung', 'Bekasi', '2004-05-24', 'SD', 'Pelajar'),
(7, 14, 'Marwani', 'Anak kandung', 'Bekasi', '1980-05-17', 'S1', 'Pengusaha'),
(8, 15, 'Risyad Syaqi', 'Anak Kandung', 'Bogor', '2005-02-26', 'SMA', 'Karyawan Swasta'),
(9, 15, 'Muamar aryanto', 'Anak Kandung', 'Bogor', '2005-02-20', 'SMA', 'Pelajar');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_departemen` int(11) NOT NULL,
  `nama_departemen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`) VALUES
(1, 'Administrasi'),
(2, 'IT'),
(3, 'Akunting'),
(4, 'Produksi');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `idGaji` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `StatusApproval` varchar(72) DEFAULT NULL,
  `PeriodeApproval` date DEFAULT NULL,
  `HrdSignature` varchar(255) DEFAULT NULL,
  `ManagerSignature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`idGaji`, `id_user`, `StatusApproval`, `PeriodeApproval`, `HrdSignature`, `ManagerSignature`) VALUES
(3, 6, 'Approved', '2022-06-28', 'hrd.png', 'manager.png'),
(4, 7, 'Approved', '2022-06-28', 'hrd.png', 'manager.png'),
(77, 9, 'Need to Approve', '2022-05-28', '-', '-'),
(78, 1, 'Need to Approve', '2022-06-28', '-', '-'),
(79, 2, 'Need to Approve', '2022-06-28', '-', '-'),
(80, 3, 'Need to Approve', '2022-06-28', '-', '-'),
(81, 4, 'Need to Approve', '2022-06-28', '-', '-'),
(82, 5, 'Need to Approve', '2022-06-28', '-', '-'),
(83, 9, 'Need to Approve', '2022-06-28', '-', '-'),
(84, 10, 'Need to Approve', '2022-06-28', '-', '-'),
(85, 11, 'Need to Approve', '2022-06-28', '-', '-'),
(86, 13, 'Need to Approve', '2022-06-28', '-', '-'),
(87, 14, 'Need to Approve', '2022-06-28', '-', '-'),
(88, 15, 'Need to Approve', '2022-06-28', '-', '-'),
(89, 117, 'Need to Approve', '2022-06-28', '-', '-'),
(90, 118, 'Need to Approve', '2022-06-28', '-', '-'),
(91, 119, 'Need to Approve', '2022-06-28', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `lembur_user`
--

CREATE TABLE `lembur_user` (
  `idLembur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `TglLembur` date NOT NULL,
  `PoinLembur` int(11) NOT NULL,
  `KepentinganLembur` varchar(255) NOT NULL,
  `CostPerPoinLembur` int(11) NOT NULL,
  `TotalCostLembur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lembur_user`
--

INSERT INTO `lembur_user` (`idLembur`, `id_user`, `TglLembur`, `PoinLembur`, `KepentinganLembur`, `CostPerPoinLembur`, `TotalCostLembur`) VALUES
(1, 5, '2022-05-19', 6, 'Melanjutkan pekerjaan', 20000, 120000),
(2, 5, '2022-05-17', 4, 'Melanjutkan Pekerjaan', 20000, 80000),
(3, 6, '2022-05-17', 4, 'Melanjutkan Pekerjaan', 20000, 80000),
(4, 6, '2022-05-23', 6, 'Melanjutkan Pekerjaan', 20000, 120000),
(5, 10, '2022-05-24', 4, 'Melanjutkan pekerjaan.', 20000, 80000),
(6, 10, '2022-05-17', 6, 'Meanjutkan Pekerjaan', 20000, 120000),
(7, 10, '2022-05-23', 2, 'Melanjutkan Pekerjaan.', 20000, 40000),
(8, 5, '2022-06-08', 8, 'Melanjutkan pekerjaan', 20000, 160000),
(9, 5, '2022-06-01', 10, '-', 20000, 200000),
(10, 5, '2022-06-11', 8, 'Melanjutkan Pekerjaan', 20000, 160000),
(11, 6, '2022-06-03', 10, 'Melanjutkan Pekerjaan', 20000, 200000),
(12, 6, '2022-06-10', 8, 'Audit ISO 27001', 40000, 320000),
(13, 6, '2022-06-08', 10, 'Memperisapkan Audit ISO', 20000, 200000),
(14, 118, '2022-06-03', 10, 'Melanjutkan pekerjaan', 20000, 200000),
(15, 118, '2022-06-08', 8, '', 20000, 160000),
(16, 7, '2022-06-09', 8, 'Melanjutkan Pekerjaan', 20000, 160000),
(17, 7, '2022-06-12', 10, 'Melanjutkan Pekerjaan', 20000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `performance_user`
--

CREATE TABLE `performance_user` (
  `idPerform` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ScorePerform` int(11) NOT NULL,
  `QtyBonusPerform` int(11) NOT NULL,
  `PerformPeriode` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `performance_user`
--

INSERT INTO `performance_user` (`idPerform`, `id_user`, `ScorePerform`, `QtyBonusPerform`, `PerformPeriode`) VALUES
(1, 5, 80, 250000, '2022-06-12'),
(3, 118, 78, 280000, '2022-06-28'),
(5, 6, 90, 500000, '2022-06-28'),
(6, 15, 80, 350000, '2022-06-28'),
(7, 9, 70, 200000, '2022-06-28'),
(8, 11, 95, 600000, '2022-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `suami_istri_user`
--

CREATE TABLE `suami_istri_user` (
  `idSuamiIstri` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `NamaSuamiIstri` varchar(128) NOT NULL,
  `nikSuamiIstri` varchar(64) NOT NULL,
  `noTelpSuamiIstri` varchar(64) NOT NULL,
  `TempatLahirSuamiIstri` varchar(64) NOT NULL,
  `TglLahirSuamiIstri` date NOT NULL,
  `HubunganSuamiIstri` varchar(32) NOT NULL,
  `PendidikanSuamiIstri` varchar(16) NOT NULL,
  `PekerjaanSuamiIstri` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suami_istri_user`
--

INSERT INTO `suami_istri_user` (`idSuamiIstri`, `id_user`, `NamaSuamiIstri`, `nikSuamiIstri`, `noTelpSuamiIstri`, `TempatLahirSuamiIstri`, `TglLahirSuamiIstri`, `HubunganSuamiIstri`, `PendidikanSuamiIstri`, `PekerjaanSuamiIstri`) VALUES
(1, 5, 'Jessica Isabel Rowling Arantes', '3276116707930044', '0812767226663', 'Porto, Portugal', '1993-07-27', 'Istri', 'S1', 'Model'),
(2, 6, 'Sophie Rundle', '3274216204001001', '', 'High Wycombe, Great Britain', '2000-04-22', 'Istri', 'SMA', 'Aktris'),
(4, 8, 'Hanifah Kusnandar', '2366024809960277', '', 'Jakarta', '1996-09-08', 'Istri', 'S1', 'Pegawai Swasta'),
(5, 7, 'Yuni Alfida', '4421994305960055', '', 'Jombang', '1996-05-03', 'Istri', 'S1', 'Bidan'),
(6, 8, 'azarah nurani', '1077195205900210', '', 'surabaya', '1990-05-12', 'Istri', 'SMK', 'Wiraswasta'),
(7, 9, 'Ani Sulisaswati', '5376095905970064', '', 'Bogor', '1997-05-19', 'Istri', 'SMA', 'ibu rumah tangga'),
(8, 10, 'Nita Ramadhani', '1001997004950021', '', 'Bandung', '1995-04-30', 'Istri', 'S1', 'Bidan'),
(9, 11, 'Mammudah', '1277046405980088', '', 'Tasikmalaya', '1998-05-24', 'Istri', 'S1', 'Wirausaha'),
(10, 13, 'Indri Herwati', '3277095105990019', '', 'Cikarang', '1999-05-11', 'Istri', 'SMA', 'Ibu Rumah Tangga'),
(11, 14, 'Karina Anjani', '3275086405762001', '', 'Bekasi', '1976-05-24', 'Istri', 'S1', 'Pegawai Bank'),
(12, 15, 'Marpuah', '3275086203810032', '0821767488333', 'Cibitung', '1981-03-22', 'Istri', 'S1', 'Perawat'),
(13, 117, 'Isnaini Hasanah', '3276034109800108', '0821866538655', 'Magelang', '1980-01-09', 'Istri', 'SMA', 'Ibu Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `thr_user`
--

CREATE TABLE `thr_user` (
  `idTHR` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `PeriodeTHR` date NOT NULL,
  `QtyTHR` int(11) NOT NULL,
  `StatusApprovalTHR` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thr_user`
--

INSERT INTO `thr_user` (`idTHR`, `id_user`, `PeriodeTHR`, `QtyTHR`, `StatusApprovalTHR`) VALUES
(1, 6, '2022-04-28', 15000000, 'Approved'),
(32, 1, '2022-06-19', 3800000, 'Approved'),
(33, 2, '2022-06-19', 12000000, 'Approved'),
(34, 3, '0000-00-00', 120000000, 'Need to Approve'),
(35, 4, '0000-00-00', 120000000, 'Need to Approve'),
(36, 5, '0000-00-00', 120000000, 'Need to Approve'),
(37, 6, '2022-06-19', 15000000, 'Approved'),
(38, 7, '0000-00-00', 8000000, 'Need to Approve'),
(39, 9, '2022-06-19', 9500000, 'Approved'),
(40, 10, '2022-06-19', 10000000, 'Approved'),
(41, 11, '0000-00-00', 10000000, 'Need to Approve'),
(42, 13, '0000-00-00', 6500000, 'Need to Approve'),
(43, 14, '0000-00-00', 8000000, 'Need to Approve'),
(44, 15, '0000-00-00', 5000000, 'Need to Approve'),
(45, 117, '0000-00-00', 9000000, 'Need to Approve'),
(46, 118, '0000-00-00', 7000000, 'Need to Approve'),
(47, 119, '0000-00-00', 12000000, 'Need to Approve');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangantetap`
--

CREATE TABLE `tunjangantetap` (
  `idTunjanganTetap` int(11) NOT NULL,
  `JenisTunjangan` varchar(64) NOT NULL,
  `KelasTunjangan` varchar(16) NOT NULL,
  `QtyTunjangan` int(11) NOT NULL,
  `PeriodeTunjangan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tunjangantetap`
--

INSERT INTO `tunjangantetap` (`idTunjanganTetap`, `JenisTunjangan`, `KelasTunjangan`, `QtyTunjangan`, `PeriodeTunjangan`) VALUES
(1, 'Tunjangan Kesehatan', 'Kelas 3', 250000, '2022-04-28'),
(2, 'Tunjangan Kesehatan', 'Kelas 2', 500000, '2022-04-28'),
(3, 'Tunjangan Kesehatan', 'Kelas 1', 1000000, '2022-04-28'),
(4, 'Tunjangan Hari Tua', 'Kelas 3', 300000, '2022-04-28'),
(5, 'Tunjangan Hari Tua', 'Kelas 2', 600000, '2022-04-28'),
(6, 'Tunjangan Hari Tua', 'Kelas 1', 1200000, '2022-04-28'),
(7, 'Tunjangan Jabatan', 'Kelas 3', 500000, '2022-04-28'),
(8, 'Tunjangan Jabatan', 'Kelas 2', 1000000, '2022-04-28'),
(9, 'Tunjangan Jabatan', 'Kelas 1', 3000000, '2022-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(72) DEFAULT NULL,
  `status` varchar(48) DEFAULT NULL,
  `no_telepon` varchar(14) DEFAULT NULL,
  `nama_bank` varchar(64) DEFAULT NULL,
  `no_rekening` varchar(16) DEFAULT NULL,
  `jabatan` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `npwp` varchar(128) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `GajiPokok` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `password`, `nama`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `email`, `status`, `no_telepon`, `nama_bank`, `no_rekening`, `jabatan`, `posisi`, `npwp`, `tgl_masuk`, `GajiPokok`, `foto`) VALUES
(1, 17191163, 'ebe0277f735b6115ea03986eb550fe59', 'Natasya Danastri', 'Wanita', '2001-01-02', 'Perum. Bintara, Kota Bekasi.', 'tasya@mail.com', 'working', '081287656662', 'BRI', '075576687976', 'Magang', 'Departemen IT', '05.102.222.0-039.000', '2022-04-01', 3800000, '-'),
(2, 17191176, 'c49dd03326a19e4ffd687af9abe94dee', 'Julia Ananda Lestari', 'Wanita', '2001-01-01', 'Pondok Ungu, Bekasi Utara, Kota Bekasi.', 'julia@mail.com', 'working', '083297667636', 'BRI', '766762553892', 'HRD', 'Departemen Administrasi', '05.002.211.2-760.000', '2020-01-04', 12000000, 'julia.jpg'),
(3, 17191206, 'b3ed37a6a86b936ad4b5eae34e6908f2', 'Ananda Akram Syahrastani', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Manager', 'Departemen IT', '', '2015-10-02', 120000000, '-'),
(4, 17191223, '973c1a22c444795b3aad76927f87e823', 'Khofifah Indar Parawansa', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Manager', 'Departemen Administrasi', '', '2018-04-01', 120000000, '-'),
(5, 17191309, '40cd4d9cd98dc8631dc91dc04b83289d', 'Andi Saputra', 'Pria', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Manager', 'Departemen Produksi', '09.254.294.3-407.000', '2020-02-03', 120000000, '-'),
(6, 17191345, '828bb09ceaed0f23d1951cadbd0c945c', 'Difa Afnan Ramadhan', 'Pria', '2001-01-01', 'Narogong, Bekasi Kota.', 'difaafnan@mail.com', 'working', '08333333333', 'BCA', '01166831344', 'Staff', 'Departemen IT', '09.264.344.0-519.000', '2018-04-05', 15000000, '-'),
(7, 1111, 'b59c67bf196a4758191e42f76670ceba', 'Budiman Hartanto', 'Pria', '1960-04-20', 'Jalan Cenderawasi No. 914, Kelurahan Margahayu, Bekasi Timur', 'budimian@mail.com', 'working', '08972124444', 'BCA', '01389656379', 'operator', 'Produksi', '04.104.224.0-191.000', '2020-01-11', 8000000, '-'),
(9, 3333, '2be9bd7a3434f7038ca27d1918de58bd', 'Sabini', 'Pria', '1996-12-22', 'Jalan Raden 9 No.22, Desa Karang Mungkur, Kabupaten Bekasi', 'sabini@mail.com', 'working', '0899772566881', 'BCA', '017522773733', 'Staff', 'Produksi', '02.293.720.0-206.000', '2016-04-05', 9500000, '-'),
(10, 4444, 'dbc4d84bfcfe2284ba11beffb853a8c4', 'Arthur Shelby', 'Pria', '1993-11-28', 'Jalan Senapan Kecil 3 No. 10, Kelurahan Bekasi Jaya, Bekasi Timur.', 'arthur@mail.com', 'working', '0876554726814', 'BRI', '2338663887112', 'Staff', 'Maintenance', '03.173.876.0-100.000', '2018-04-04', 10000000, '-'),
(11, 5555, '6074c6aa3488f3c2dddff2a7ca821aab', 'Tommy Shelby', 'Pria', '1997-11-30', 'Jalan Pariaman No 2-9, Kota Bekasi.', 'tommy@mail.com', 'working', '085587311773', 'BRI', '8653572665621', 'Staff', 'Maintenance', '03.183.996.0-130.000', '2019-04-03', 10000000, '-'),
(13, 17192202, '8e66621e9399dbd215ab2f45035bdad4', 'boby devano', 'Pria', '1998-07-12', 'Jalan Krisnamukti 9 No.9 RT005/002, Kapubaten Bekasi.', 'boby@mail.com', 'working', '089720630922', 'BRI', '7653697667311', 'operator', 'produksi', '06.209.102.3-200.000', '2020-03-03', 6500000, '-'),
(14, 17192203, 'dfe1791753988fb38bc92c40f0a07340', 'carli septian', 'Pria', '1973-04-27', 'Jalan Hisbul Waton 1 No.16, Cikarang Barat, Kabupaten Bekasi', 'carli@mail.com', 'working', '083922683781', 'BRI', '2212365377113', 'operator ', 'produksi', '02.251.209.5-050.000', '2019-11-27', 8000000, '-'),
(15, 17192204, 'dcd9c2bf0d242fa959b4ee42f957acf0', 'derry aryanto', 'Pria', '1979-01-26', 'Jalan Mangga Kemuning No.2, Cibitung, Kab. Bekasi.', 'derry@mail.com', 'working', '081185386688', 'BRI', '0755358165771', 'operator', 'produksi', '07.912.111.0-012.000', '2022-02-07', 5000000, '-'),
(117, 17230188, '6e4a1b8d89fb31c7c5fbfa1030b8e578', 'Mahendra Setiawan', 'Pria', '1980-05-05', 'Jalan Ismail Marzuki No. 39 RT005/RW002, Cikarang Barat.', 'mahendra@mail.com', 'working', '0821667836383', 'BNI', '081116536837', 'Staff', 'Administrasi', '06.237.122.0-520.000', '2022-05-14', 9000000, 'mahendra.jpg'),
(118, 17226541, '27eb29dd1580e5d1fd92c0afc7dd53ec', 'Adam Satrio', 'Pria', '1997-01-01', 'Jalan Angger No. 20 Perum. Villa Mutiara Gading 2, Kabupaten Bekasi.', 'adam@mail.com', 'working', '089644552220', 'BRI', '7755277256117661', 'Operator', 'Produksi', '03.182.829.1-270.000', '2022-05-14', 7000000, 'adam.jpg'),
(119, 2177531, '75dfb46fe49a6634554db35591ffed89', 'Handy Septiadji', 'Pria', '2022-06-07', 'Jalan Keramat 3 No. 219 kelurahan duren jaya bekasi timur', 'handysept2121@gmail.com', 'working', '082166251982', 'BNI', '0811546372', 'Staff', 'Akunting', '01.625.122-000', '2022-06-20', 12000000, 'tuanku_imam_bonjol.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_phk`
--

CREATE TABLE `user_phk` (
  `idPHK` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `TglPHK` date NOT NULL,
  `QtyCutiUser` int(11) NOT NULL,
  `QtyPesangonUser` int(11) NOT NULL,
  `QtyUPHUser` int(11) NOT NULL,
  `QtyUPMKUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen_user`
--
ALTER TABLE `absen_user`
  ADD PRIMARY KEY (`idAbsen`);

--
-- Indexes for table `anak_user`
--
ALTER TABLE `anak_user`
  ADD PRIMARY KEY (`id_anak`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`idGaji`);

--
-- Indexes for table `lembur_user`
--
ALTER TABLE `lembur_user`
  ADD PRIMARY KEY (`idLembur`);

--
-- Indexes for table `performance_user`
--
ALTER TABLE `performance_user`
  ADD PRIMARY KEY (`idPerform`);

--
-- Indexes for table `suami_istri_user`
--
ALTER TABLE `suami_istri_user`
  ADD PRIMARY KEY (`idSuamiIstri`);

--
-- Indexes for table `thr_user`
--
ALTER TABLE `thr_user`
  ADD PRIMARY KEY (`idTHR`);

--
-- Indexes for table `tunjangantetap`
--
ALTER TABLE `tunjangantetap`
  ADD PRIMARY KEY (`idTunjanganTetap`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_phk`
--
ALTER TABLE `user_phk`
  ADD PRIMARY KEY (`idPHK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen_user`
--
ALTER TABLE `absen_user`
  MODIFY `idAbsen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `anak_user`
--
ALTER TABLE `anak_user`
  MODIFY `id_anak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id_departemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `idGaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `lembur_user`
--
ALTER TABLE `lembur_user`
  MODIFY `idLembur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `performance_user`
--
ALTER TABLE `performance_user`
  MODIFY `idPerform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suami_istri_user`
--
ALTER TABLE `suami_istri_user`
  MODIFY `idSuamiIstri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `thr_user`
--
ALTER TABLE `thr_user`
  MODIFY `idTHR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tunjangantetap`
--
ALTER TABLE `tunjangantetap`
  MODIFY `idTunjanganTetap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `user_phk`
--
ALTER TABLE `user_phk`
  MODIFY `idPHK` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
