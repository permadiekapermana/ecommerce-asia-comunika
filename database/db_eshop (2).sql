-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2020 at 07:44 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `blokir` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `blokir`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Hamzah Maulana', 'hamzah@asiakomunika.com', '08238923848', 'N'),
('nizar', 'bf93e5f003e40c3fba44e512aecd3cdc', 'nizar', 'nizar@asiacomunika.com', '082183479014', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id_bank` varchar(11) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  `pemilik` varchar(40) NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id_bank`, `bank`, `no_rek`, `pemilik`, `gambar`) VALUES
('BANK.000001', 'Cimb Niaga', '8918291289', 'Toko Asia Comunika', '43fd679219150a6e3469a3689f58719e8e.png'),
('BANK.000002', 'BCA (Bank Central Asia)', '9879986888', 'Toko Asia Comunika', '87bca-1.jpg'),
('BANK.000003', 'Bank Mandiri', '7817281721', 'Toko Asia Comunika', '39download.png'),
('BANK.000004', 'Bank Permata', '727382738', 'Toko Asia Comunika', '97dW0P9A-e_400x400.jpg'),
('BANK.000005', 'BTPN / Jenius', '2412423411', 'Toko Asia Comunika', '21Screenshot_26.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(11) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
('KTGR.000001', 'Smartphone'),
('KTGR.000002', 'Powerbank'),
('KTGR.000003', 'Headset / Earphone '),
('KTGR.000004', 'Softcase / Silikon'),
('KTGR.000005', 'Charger / USB');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` varchar(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `username`, `id_produk`, `jumlah`) VALUES
('CART.000001', 'febri', 'PROD.000001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `id_komplain` varchar(11) NOT NULL,
  `no_invoice` varchar(30) NOT NULL,
  `jenis_komplain` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `bukti_komplain` varchar(255) NOT NULL,
  `u_pembeli` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL,
  `solusi` varchar(255) DEFAULT NULL,
  `keterangan2` varchar(255) DEFAULT NULL,
  `u_admin` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komplain`
--

INSERT INTO `komplain` (`id_komplain`, `no_invoice`, `jenis_komplain`, `keterangan`, `bukti_komplain`, `u_pembeli`, `status`, `solusi`, `keterangan2`, `u_admin`) VALUES
('COMP.000001', 'INV20200630000000022', 'Barang belum sampai', 'p', '84IMG_20191106_101610_175.jpg', 'amran', 'Selesai', NULL, NULL, NULL),
('COMP.000002', 'INV20200630000000024', 'Produk tidak sesuai dengan deskripsi', 'refund dong', '50IMG_20191106_101610_175.jpg', 'amran', 'Selesai', 'Follow up pihak ekspedisi', 'silahkan cek pihak ekspedisi', NULL),
('COMP.000003', 'INV20200630000000024', 'Pesanan tidak lengkap', 'asaxadad', '38BCA.jpg', 'ali', 'Selesai', 'Follow up pihak ekspedisi', 'silahkan cek pihak ekspedisi', NULL),
('COMP.000004', 'INV20200701000000028', 'Barang belum sampai', 'kenapa', '29mandiri.jpg', 'amran', 'Selesai', 'Follow up pihak ekspedisi', 'tunggu dulu mas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konfirm_bayar`
--

CREATE TABLE `konfirm_bayar` (
  `no_invoice` varchar(30) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `id_bank` varchar(11) NOT NULL,
  `bank_asal` varchar(30) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirm_bayar`
--

INSERT INTO `konfirm_bayar` (`no_invoice`, `tgl_bayar`, `id_bank`, `bank_asal`, `nama_pemilik`, `jumlah`, `bukti_transfer`) VALUES
('INV20200417000000002', '2020-04-17', 'BANK.000001', 'BCA', 'Abah', 3209000, '32a53f2073-126e-4151-86e4-f66649d5d898.jpg'),
('INV20200531000000014', '2020-06-01', 'BANK.000002', 'BNI (Bank Negara Indonesia) - ', 'abah', 2525000, '73128059_9c5fba09-ddb3-4a05-935c-0c8d61c4e50b.jpg'),
('INV20200601000000017', '2020-06-01', 'BANK.000001', 'BCA (Bank Central Asia) 348562', 'abah', 250000, '23128059_9c5fba09-ddb3-4a05-935c-0c8d61c4e50b.jpg'),
('INV20200531000000012', '2020-06-01', 'BANK.000001', 'Cimb Niaga', 'Abah', 4000000, '53128059_9c5fba09-ddb3-4a05-935c-0c8d61c4e50b.jpg'),
('INV20200602000000018', '2020-06-02', 'BANK.000002', 'BCA (Bank Central Asia) - 2345', 'Amran', 18721541, '5128059_9c5fba09-ddb3-4a05-935c-0c8d61c4e50b.jpg'),
('INV20200629000000021', '2020-06-29', 'BANK.000001', 'CIMB Niaga ', 'Amran', 2500000, '41cimb.jpeg'),
('INV20200630000000022', '2020-06-30', 'BANK.000001', 'BNI (Bank Negara Indonesia) - ', 'ahmad kelani', 2240000, '57cimb.jpeg'),
('INV20200630000000026', '2020-06-30', 'BANK.000001', 'BNI (Bank Negara Indonesia) - ', 'aaaa', 2500000, '83bni.jpg'),
('INV20200630000000024', '2020-06-30', 'BANK.000001', 'as', '1', 1000, '48arsitekturmenu.png'),
('INV20200701000000028', '2020-07-01', 'BANK.000002', 'BNI (Bank Negara Indonesia) - ', 'amran', 2500000, '6BCA.jpg'),
('INV20200706000000029', '2020-07-06', 'BANK.000001', 'BCA (Bank Central Asia) 348562', 'abah', 2211000, '76BCA.jpg'),
('INV20200708000000030', '2020-07-08', 'BANK.000002', 'BCA (Bank Central Asia) 348562', 'abah', 2330000, '49bni.jpg'),
('INV20200720000000031', '2020-07-20', 'BANK.000002', 'BNI (Bank Negara Indonesia) - ', 'abah', 3599000, '48bni.jpg'),
('INV20200721000000032', '2020-07-21', 'BANK.000001', 'BNI (Bank Negara Indonesia) - ', 'abah', 2599000, '68bni.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` varchar(11) NOT NULL,
  `id_provinsi` varchar(11) NOT NULL,
  `kota` varchar(40) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `id_provinsi`, `kota`, `ongkir`) VALUES
('KOTA.000001', 'PROV.000001', 'Kota Cirebon', 12000),
('KOTA.000003', 'PROV.000002', 'Kota Brebes', 13000),
('KOTA.000004', 'PROV.000002', 'Kabupaten Brebes', 13000),
('KOTA.000005', 'PROV.000001', 'Kota Bandung', 12000),
('KOTA.000007', 'PROV.000004', 'Kota Aceh', 25000),
('KOTA.000008', 'PROV.000024', 'Kota Medan', 34000),
('KOTA.000009', 'PROV.000006', 'Kota Padang', 33000),
('KOTA.000010', 'PROV.000007', 'Kota Pekanbaru', 33000),
('KOTA.000011', 'PROV.000008', 'Kota Batam', 32000),
('KOTA.000012', 'PROV.000009', 'Kota Jambi', 27000),
('KOTA.000013', 'PROV.000010', 'Kota Bengkulu', 40000),
('KOTA.000014', 'PROV.000023', 'Kota Palembang', 32000),
('KOTA.000015', 'PROV.000012', 'Kota Bandar Lampung', 20000),
('KOTA.000016', 'PROV.000013', 'Tangerang', 12000),
('KOTA.000017', 'PROV.000014', 'DKI Jakarta', 11000),
('KOTA.000018', 'PROV.000015', 'Kota Yogyakarta', 16000),
('KOTA.000019', 'PROV.000003', 'Kota Surabaya', 19000),
('KOTA.000020', 'PROV.000016', 'Kota Denpasar', 24000),
('KOTA.000021', 'PROV.000018', 'Kota Pontianak', 44000),
('KOTA.000022', 'PROV.000019', 'Kota Banjarmasin', 41000),
('KOTA.000023', 'PROV.000020', 'Kota Palangka Raya', 42000),
('KOTA.000024', 'PROV.000021', 'Kota Samarinda', 55000),
('KOTA.000025', 'PROV.000004', 'Kota Langsa', 47000),
('KOTA.000026', 'PROV.000004', 'Kota Lhokseumawe', 47000),
('KOTA.000027', 'PROV.000004', 'Kota Sabang', 47000),
('KOTA.000028', 'PROV.000004', 'Kota Subulussalam', 47000),
('KOTA.000029', 'PROV.000005', 'Kota Binjai', 39000),
('KOTA.000030', 'PROV.000006', 'Kota BukitTinggi', 38000),
('KOTA.000031', 'PROV.000007', 'Dumai', 33000),
('KOTA.000032', 'PROV.000008', 'Kota TanjungPinang', 38000),
('KOTA.000033', 'PROV.000009', 'Kota SungaiPenuh', 32000),
('KOTA.000034', 'PROV.000011', 'Kota Lubuklinggau', 29000),
('KOTA.000035', 'PROV.000012', 'Kota Metro', 26000),
('KOTA.000036', 'PROV.000013', 'Kota Cilegon', 14000),
('KOTA.000037', 'PROV.000013', 'Kota Serang', 14000),
('KOTA.000038', 'PROV.000001', 'Kota banjar', 12000),
('KOTA.000039', 'PROV.000001', 'Kota Bekasi', 12000),
('KOTA.000040', 'PROV.000001', 'Kota Bogor', 12000),
('KOTA.000041', 'PROV.000001', 'Kota Cimahi', 12000),
('KOTA.000042', 'PROV.000001', 'Kota Sukabumi', 12000),
('KOTA.000043', 'PROV.000001', 'Kota Tasikmalaya', 12000),
('KOTA.000044', 'PROV.000001', 'Kota Depok', 12000),
('KOTA.000045', 'PROV.000014', 'Kota Jakarta Selatan', 11000),
('KOTA.000046', 'PROV.000014', 'Kota Jakarta Barat', 11000),
('KOTA.000047', 'PROV.000014', 'Kota Jakarta Timur', 11000),
('KOTA.000048', 'PROV.000014', 'Kota Jakarta Pusat', 11000),
('KOTA.000049', 'PROV.000014', 'Kota Jakarta Utara', 11000),
('KOTA.000050', 'PROV.000002', 'Kota Magelang', 13000),
('KOTA.000051', 'PROV.000002', 'Kota Pekalongan', 20000),
('KOTA.000052', 'PROV.000002', 'Kota Salatiga', 20000),
('KOTA.000053', 'PROV.000002', 'Kota Semarang', 16000),
('KOTA.000054', 'PROV.000002', 'Kota Tegal', 16000),
('KOTA.000055', 'PROV.000003', 'Kota Blitar', 25000),
('KOTA.000056', 'PROV.000003', 'Kota Kediri', 21000),
('KOTA.000057', 'PROV.000003', 'Kota Malang', 21000),
('KOTA.000058', 'PROV.000003', 'Kota Madiun', 21000),
('KOTA.000059', 'PROV.000017', 'Kota Bima', 44000),
('KOTA.000060', 'PROV.000017', 'Kota Mataram', 38000),
('KOTA.000061', 'PROV.000018', 'Kota Singkawang', 50000),
('KOTA.000062', 'PROV.000019', 'Kota banjarbaru', 41000),
('KOTA.000063', 'PROV.000001', 'Kabupaten Bandung Barat', 12000),
('KOTA.000064', 'PROV.000001', 'Kabupaten Bekasi', 12000),
('KOTA.000065', 'PROV.000001', 'Kabupaten Bogor', 12000),
('KOTA.000066', 'PROV.000001', 'Kabupaten Ciamis', 12000),
('KOTA.000067', 'PROV.000001', 'Kabupaten Cianjur', 12000),
('KOTA.000068', 'PROV.000001', 'Kabupaten Garut', 12000),
('KOTA.000069', 'PROV.000001', 'Kabupaten Majalengka', 12000),
('KOTA.000070', 'PROV.000001', 'Kabupaten Indramayu', 12000),
('KOTA.000071', 'PROV.000001', 'Kabupaten Karawang', 12000),
('KOTA.000072', 'PROV.000001', 'Kabupaten Kuningan', 12000),
('KOTA.000073', 'PROV.000001', 'Kabupaten Pangandaran', 12000),
('KOTA.000074', 'PROV.000001', 'Kabupaten Purwakarta', 12000),
('KOTA.000075', 'PROV.000001', 'Kabupaten Subang', 12000),
('KOTA.000076', 'PROV.000001', 'Kabupaten Sukabumi', 12000),
('KOTA.000077', 'PROV.000001', 'Kabupaten Sumedang', 12000),
('KOTA.000078', 'PROV.000001', 'Kabupaten Tasikmalaya', 12000),
('KOTA.000079', 'PROV.000001', 'Kabupaten Cirebon', 12000),
('KOTA.000080', 'PROV.000001', 'Kabupaten Bandung', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id_merek` varchar(11) NOT NULL,
  `merek` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id_merek`, `merek`) VALUES
('MERK.000001', 'Xiaomi'),
('MERK.000002', 'Samsung'),
('MERK.000003', 'Realme'),
('MERK.000004', 'Oppo'),
('MERK.000005', 'Headset Universal'),
('MERK.000006', 'Power Bank'),
('MERK.000007', 'Softcase / Silikon'),
('MERK.000009', 'Oppo Charger'),
('MERK.000010', 'Xiaomi Charger '),
('MERK.000011', 'Realme Charger'),
('MERK.000012', 'Samsung Charger'),
('MERK.000013', 'Uneed Charger'),
('MERK.000014', 'Vivan Charger'),
('MERK.000015', 'Hippo Charger'),
('MERK.000016', 'Robot Charger');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `no_invoice` varchar(30) NOT NULL,
  `status_order` varchar(100) NOT NULL,
  `tgl_order` date NOT NULL,
  `total_tagihan` int(15) NOT NULL,
  `jam_order` time NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `metode_bayar` varchar(20) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `no_resi` varchar(100) DEFAULT NULL,
  `u_pembeli` varchar(30) NOT NULL,
  `u_toko` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`no_invoice`, `status_order`, `tgl_order`, `total_tagihan`, `jam_order`, `tgl_bayar`, `metode_bayar`, `latitude`, `longitude`, `no_resi`, `u_pembeli`, `u_toko`) VALUES
('INV20200417000000001', 'Ditolak', '2020-04-17', 524000, '20:31:16', NULL, 'Transfer', '', '', NULL, 'abah', 'admin'),
('INV20200417000000002', 'Selesai', '2020-04-17', 4424000, '21:00:26', '2020-04-17', 'Transfer', '', '', '00998', 'abah', 'admin'),
('INV20200417000000003', 'Selesai', '2020-04-17', 3825000, '21:01:41', '2020-04-18', 'COD', '', '', '', 'abah', 'admin'),
('INV20200417000000004', 'Ditolak', '2020-04-17', 2525000, '22:23:25', NULL, 'COD', '', '', '', 'abah', NULL),
('INV20200417000000005', 'Ditolak', '2020-04-17', 5025000, '23:22:26', NULL, 'COD', '', '', '', 'abah', NULL),
('INV20200418000000006', 'Selesai', '2020-04-18', 2525000, '00:26:26', '2020-04-19', 'COD', '', '', NULL, 'abah', NULL),
('INV20200418000000007', 'Dibatalkan', '2020-04-18', 4424000, '09:50:34', NULL, 'Transfer', '', '', NULL, 'abah', NULL),
('INV20200422000000008', 'Ditolak', '2020-04-22', 524000, '19:12:08', NULL, 'Transfer', '', '', NULL, 'abah', 'admin'),
('INV20200511000000009', 'Ditolak', '2020-05-11', 6325000, '20:55:57', NULL, 'COD', '', '', '', 'abah', NULL),
('INV20200518000000010', 'Selesai', '2020-05-18', 2525000, '21:56:37', '2020-05-30', 'COD', '', '', '', 'abah', 'admin'),
('INV20200531000000011', 'Selesai', '2020-05-31', 3825000, '15:42:08', '2020-06-01', 'COD', '', '', '', 'abah', 'admin'),
('INV20200531000000012', 'Selesai', '2020-05-31', 2525000, '15:43:17', '2020-06-01', 'Transfer', '', '', 'afg321abs', 'abah', 'admin'),
('INV20200531000000013', 'Selesai', '2020-05-31', 2525000, '15:43:58', '2020-06-01', 'COD', '', '', 'afg321abs', 'abah', 'admin'),
('INV20200531000000014', 'Selesai', '2020-05-31', 2224000, '15:48:11', '2020-06-01', 'Transfer', '', '', 'afg321abs', 'abah', 'admin'),
('INV20200531000000015', 'Ditolak', '2020-05-31', 3825000, '22:56:44', NULL, 'Transfer', '', '', NULL, 'febri', 'admin'),
('INV20200601000000016', 'Ditolak', '2020-06-01', 2525000, '01:55:33', NULL, 'COD', '', '', '', 'abah', NULL),
('INV20200601000000017', 'Selesai', '2020-06-01', 275000, '03:51:03', '2020-06-01', 'Transfer', '', '', '5bejk321', 'abah', 'admin'),
('INV20200602000000018', 'Selesai', '2020-06-02', 18721541, '22:37:18', '2020-06-02', 'Transfer', '', '', 'acb432d', 'amran', NULL),
('INV20200603000000019', 'Ditolak', '2020-06-03', 3825000, '00:42:40', NULL, 'Transfer', '', '', NULL, 'amran', 'admin'),
('INV20200603000000020', 'Selesai', '2020-06-03', 3825000, '01:34:19', '2020-06-03', 'COD', '', '', '', 'abah', 'admin'),
('INV20200629000000021', 'Selesai', '2020-06-29', 2224000, '02:23:45', '2020-06-29', 'Transfer', '', '', '1234r3w', 'amran', NULL),
('INV20200630000000022', 'Selesai', '2020-06-30', 2224000, '09:46:03', '2020-06-30', 'Transfer', '', '', 'a123fd', 'kelani', NULL),
('INV20200630000000023', 'Ditolak', '2020-06-30', 3524000, '11:48:00', NULL, 'COD', '', '', '', 'amran', NULL),
('INV20200630000000024', 'Selesai', '2020-06-30', 2525000, '11:50:27', '2020-06-30', 'Transfer', '', '', '00998', 'amran', 'admin'),
('INV20200630000000025', 'Ditolak', '2020-06-30', 2525000, '12:27:31', NULL, 'Transfer', '', '', NULL, 'amran', 'admin'),
('INV20200630000000026', 'Ditolak', '2020-06-30', 2525000, '12:32:42', '2020-06-30', 'Transfer', '', '', '', 'amran', NULL),
('INV20200701000000027', 'Dibatalkan', '2020-07-01', 2525000, '22:56:40', NULL, 'Transfer', '', '', NULL, 'amran', NULL),
('INV20200701000000028', 'Selesai', '2020-07-01', 3825000, '22:59:29', '2020-07-01', 'Transfer', '', '', '123sder', 'amran', NULL),
('INV20200706000000029', 'Selesai', '2020-07-06', 2211000, '01:00:43', '2020-07-06', 'Transfer', '', '', 'afg321abs', 'abah', 'admin'),
('INV20200708000000030', 'Selesai', '2020-07-08', 2512000, '00:36:50', '2020-07-08', 'Transfer', '', '', 'afg321abs', 'abah', 'admin'),
('INV20200720000000031', 'Selesai', '2020-07-20', 3611000, '02:56:47', '2020-07-20', 'Transfer', '', '', 'a123fd', 'abah', 'admin'),
('INV20200721000000032', 'Sedang Dikirim', '2020-07-21', 2512000, '08:56:53', '2020-07-21', 'Transfer', '', '', 'a123fd', 'abah', NULL),
('INV20200724000000033', 'Sedang Diproses', '2020-07-24', 3911000, '01:13:08', NULL, 'COD', '-6.706044269675817', '108.54948981475829', NULL, 'abah', NULL),
('INV20200724000000034', 'Sedang Diproses', '2020-07-24', 1691000, '13:26:27', NULL, 'COD', '-6.719938756036815', '108.53880389404296', NULL, 'abah', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `no_invoice` varchar(30) NOT NULL,
  `id_produk` varchar(11) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`no_invoice`, `id_produk`, `jumlah`) VALUES
('INV20200417000000001', 'PROD.000006', 1),
('INV20200417000000002', 'PROD.000007', 1),
('INV20200417000000003', 'PROD.000002', 1),
('INV20200417000000004', 'PROD.000001', 1),
('INV20200417000000005', 'PROD.000001', 2),
('INV20200418000000006', 'PROD.000001', 1),
('INV20200418000000007', 'PROD.000007', 1),
('INV20200422000000008', 'PROD.000006', 1),
('INV20200511000000009', 'PROD.000001', 1),
('INV20200511000000009', 'PROD.000002', 1),
('INV20200518000000010', 'PROD.000001', 1),
('INV20200531000000011', 'PROD.000002', 1),
('INV20200531000000012', 'PROD.000001', 1),
('INV20200531000000013', 'PROD.000001', 1),
('INV20200531000000014', 'PROD.000009', 1),
('INV20200531000000015', 'PROD.000002', 1),
('INV20200601000000016', 'PROD.000001', 1),
('INV20200601000000017', 'PROD.000005', 1),
('INV20200602000000018', 'PROD.000003', 1),
('INV20200603000000019', 'PROD.000002', 1),
('INV20200603000000020', 'PROD.000002', 1),
('INV20200629000000021', 'PROD.000029', 1),
('INV20200630000000022', 'PROD.000029', 1),
('INV20200630000000023', 'PROD.000004', 1),
('INV20200630000000024', 'PROD.000001', 1),
('INV20200630000000025', 'PROD.000001', 1),
('INV20200630000000026', 'PROD.000001', 1),
('INV20200701000000027', 'PROD.000001', 1),
('INV20200701000000028', 'PROD.000002', 1),
('INV20200706000000029', 'PROD.000029', 1),
('INV20200708000000030', 'PROD.000001', 1),
('INV20200720000000031', 'PROD.000003', 1),
('INV20200721000000032', 'PROD.000001', 1),
('INV20200724000000033', 'PROD.000002', 1),
('INV20200724000000034', 'PROD.000092', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(11) NOT NULL,
  `produk` varchar(40) NOT NULL,
  `id_kategori` varchar(11) NOT NULL,
  `id_merek` varchar(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(5) NOT NULL,
  `stok` int(5) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `produk`, `id_kategori`, `id_merek`, `harga`, `berat`, `stok`, `deskripsi`, `gambar`) VALUES
('PROD.000001', 'Xiaomi Redmi Note 8', 'KTGR.000001', 'MERK.000001', 2500000, 800, 87, 'Siaaaapppp kiriiimmmm !!!\r\nWARNA YANG TERSEDIA HITAM, BIRU DAN PUTIH \r\nGaransi Resmi Indonesia\r\n\r\nâ€¢Redmi Note 8\r\nLayar	6,3 inci, piksel 1080x2340 dan rasio 19,5:9\r\nBodi	Corning Gorilla Glass 5\r\nKamera	Kamera Utama: Quad Camera\r\n- 48MP bukaan f/1.8\r\n- 8MP bukaan f/2.2\r\n- 2MP bukaan f/2.4\r\n- 2MP bukaam f/2.4\r\nKamera Depan\r\n- 13MP bukaan f/2.0\r\nMemori\r\n- RAM 3/32\r\n- RAM 4/64\r\n- RAM 6/128\r\nDapat diperluas dengan microSD hingga 256GB\r\nProsesor - Qualcomm SDM665 Snapdragon 665\r\n- CPU: Octa-core (4x2.0 GHz Kryo 260 Gold & 4x1.8 GHz Kryo 260 Silver)\r\n- GPU: Adreno 610\r\nSistem - MIUI 10; \r\nOperasi - Android 9 Pie\r\nSlot	microSD hingga 256 GB\r\nFitur - Fingerprint \r\nLain - (rear-mounted), accelerometer, gyro, proximity, compass\r\nBaterai	4.000 mAh.', '71xiaomi-redmi-note-8-cosmic-purple.jpg'),
('PROD.000002', 'Realme XT ', 'KTGR.000001', 'MERK.000003', 3899000, 800, 78, 'NETWORK Technology\r\nGSM / HSPA / LTE\r\nLAUNCH Announced 2019, September\r\nStatus Available. Released 2019, September\r\nBODY Dimensions 158.7 x 75.2 x 8.6 mm (6.25 x 2.96 x 0.34 in)\r\nWeight 183 g (6.46 oz)\r\nBuild Front/back glass (Gorilla Glass 5), plastic frame\r\nSIM Dual SIM (Nano-SIM, dual stand-by)\r\nDISPLAY Type Super AMOLED capacitive touchscreen, 16M colors\r\nSize 6.4 inches, 100.5 cm2 (~84.3% screen-to-body ratio)\r\nResolution 1080 x 2340 pixels, 19.5:9 ratio (~403 ppi density)\r\nProtection Corning Gorilla Glass 5\r\nPLATFORM OS Android 9.0 (Pie), planned upgrade to Android 10.0; ColorOS 6\r\nChipset Qualcomm SDM712 Snapdragon 712 (10 nm)\r\nCPU Octa-core (2x2.3 GHz Kryo 360 Gold & 6x1.7 GHz Kryo 360 Silver)\r\nGPU Adreno 616\r\nMEMORY Card slot microSD, up to 256 GB (dedicated slot)\r\nInternal 64GB 4GB RAM, 64GB 6GB RAM, 128GB 8GB RAM\r\nUFS2.1\r\nMAIN CAMERA Quad 64 MP, f/1.8, (wide), 1/1.7\", 0.8Âµm, PDAF\r\n8 MP, f/2.3, 13mm (ultrawide), 1/4\", 1.12Âµm\r\n2 MP, f/2.4, 1/5\", 1.75Âµm (dedicated macro camera)\r\n2 MP, f/2.4, 1/5\", 1.75Âµm, depth sensor\r\nFeatures LED flash, HDR, panorama\r\nVideo 2160p@30fps, 1080p@30/60/120fps, 720p@960fps, gyro-EIS\r\nSELFIE CAMERA Single 16 MP, f/2.0, 1/3.1\", 1.0Âµm\r\nFeatures HDR, panorama\r\nVideo 1080p@30fps\r\nSOUND Loudspeaker Yes\r\n3.5mm jack Yes\r\nDolby Atmos\r\nCOMMS WLAN Wi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct, hotspot\r\nBluetooth 5.0, A2DP, LE\r\nGPS Yes, with A-GPS, GLONASS, GALILEO, BDS\r\nRadio FM radio\r\nUSB 2.0, Type-C 1.0 reversible connector\r\nFEATURES Sensors Fingerprint (under display, optical), accelerometer, gyro, proximity, compass\r\nBATTERY Non-removable Li-Po 4000 mAh battery\r\nCharging Fast battery charging 20W (VOOC Flash Charge 3.0)\r\nMISC Colors Pearl White, Pearl Blue\r\nModels RMX1921\r\nTESTS Performance Basemark OS II: 3585 / Basemark OS II 2.0: 3036\r\nBasemark X: 32519\r\nDisplay Contrast ratio: Infinite (nominal)\r\nCamera Photo / Video\r\nLoudspeaker Voice 68dB / Noise 74dB / Ring 89dB\r\nAudio quality Noise -92.2dB / Crosstalk -91.4dB ', '70realme-xt.jpg'),
('PROD.000003', 'Redmi Note 9 Pro', 'KTGR.000001', 'MERK.000001', 3599000, 800, 20, 'Xiaomi Redmi Note 9 Pro (Redmi Note 9 Pro Max) memiliki layar FHD+ 6,67 inci, Corning Gorilla Glass 5, kamera selfie 32MP, Quad-camera 64MP, Qualcomm Snapdragon 720G, baterai 5.020 mAh.\r\nRam : 6/128 GB', '63xiaomi-redmi-note-9-pro.jpg'),
('PROD.000004', 'Realme 6 Pro', 'KTGR.000001', 'MERK.000003', 4599000, 800, 64, 'Realme  6 Pro IndonesiaRealme  6 ProRealme  6 Pro fiturRealme  6 Pro spesifikasi\r\nRealme 6 Pro merupakan handphone HP dengan kapasitas 4300mAh dan layar 6.6\" yang dilengkapi dengan kamera belakang 64 + 12 + 8 + 2MP dengan tingkat densitas piksel sebesar 399ppi dan tampilan resolusi sebesar 1080 x 2400pixels. Dengan memori 8/128Gb, handphone HP ini memiliki prosesor Octa Core', '12realme-6-pro-1.jpg'),
('PROD.000005', 'Redmi Powerbank', 'KTGR.000002', 'MERK.000006', 250000, 800, 33, '100% Original Xiaomi Redmi\r\nReady Warna: White\r\n\r\nREDMI Powerbank 20000mAh - FAST CHARGING 18W\r\n\r\nPowerbank terbaru 20.000 mAH 18W\r\nPowerbank ini bisa di charge dengan MICRO USB atau USB TYPE C\r\nDan memiliki 2 output , sehingga memungkinkan user melakukan charger 2 hp dengan Fast Charging up to 18W\r\n\r\nSpesifikasi\r\nModel : PB200LZM\r\nCapacity : 74Wh 3.7V / 20.000 mAh\r\nInput : Micro USB / USB-C : 5V = 2.1A ... 9V = 2A Max .. 12V = 1.5A\r\nOutput : USB-A 5.1V = 2.4A / 9V = 2A Max / 12V = 1,5A Max ', '7205e6ff0d89e399aba9e31abc14da81f.jpg'),
('PROD.000006', 'Audio ATH-CK200BT', 'KTGR.000003', 'MERK.000005', 25000, 700, 43, 'The ATH-CK200BT in-ear headphones give you excellent wireless audio at a great price. The powerful 9 mm drivers deliver clear, vibrant audio from a BluetoothÂ® wireless signal, while the compact housings and interchangeable eartips (XS, S, M, L) provide good sound isolation and a comfortable, customizable fit.', '80a084992a9af70a3a97d600c4b621aea2.jpg'),
('PROD.000007', 'Samsung Galaxy A51', 'KTGR.000001', 'MERK.000002', 4299000, 800, 20, 'Harga Samsung Galaxy A51 dipatok dengan harga mulai dari Rp 4 jutaan. Spesifikasi Samsung Galaxy A51:\r\n\r\nâ€¢ Layar : 6.5 inci, 1080 x 2400 pixelsâ€¢ RAM : 6-8GBâ€¢ Memori Internal : 64/128 GB,â€¢ Kamera Depan : 32MPâ€¢ Kamera Belakang : Quad-camera, 48MP+12MP+5MP+5MPâ€¢ Kapasitas Baterai : 4000 mAh', '2a60a8e38b48c1f3f08911e9a3b28ff4a.jpg'),
('PROD.000008', 'Samsung A2 Core', 'KTGR.000001', 'MERK.000002', 1045000, 800, 25, 'Galaxy A2 Core berbasis Android Go, design bezel tebal, prosesor Exynos 7870 dipadukan RAM 1GB, berlayar 5\", baterai berkapasitas 2600 mAh.', '61samsung-galaxy-a2-core.jpg'),
('PROD.000009', 'Redmi Note 7 (4/64)', 'KTGR.000001', 'MERK.000001', 2199000, 1, 10, 'Redmi Note 7, hp pertama Redmi setelah menjadi sub-brand Xiaomi, berlayar FHD+ 6.3\", dual kamera belakang 48MP+5MP, kamera depan 13MP, baterai 4000 mAh', '17xiaomi-redmi-note-7-1.jpg'),
('PROD.000011', 'Xiaomi Redmi 8', 'KTGR.000001', 'MERK.000001', 1799000, 1, 6, 'Fitur\r\nQualcommÂ® Snapdragonâ„¢ 439\r\nCPU: Octa-core CPU, 12 nm FinFET, hingga 2.0 GHz. 8x ARM Cortex A53.\r\nGPU: QualcommÂ® Adrenoâ„¢ 505\r\n\r\n3GB + 32GB / 4GB + 64GB\r\nRAM: LPDDR3 933MHz\r\nROM: eMMC 5.1\r\n\r\nBaterai\r\n5000mAh(typ) / 4900mAh (min)\r\nMendukung Teknologi Quick Chargeâ„¢ 3.0 dan pengisian cepat 18W\r\nTermasuk pengisi daya 10W\r\nPort charging tipe-C\r\nBaterai tidak dapat dipindahkan\r\n\r\n', '45xiaomi-redmi-8-3.jpg'),
('PROD.000012', 'Redmi 7', 'KTGR.000001', 'MERK.000001', 1699000, 1, 10, 'MEMORY	Card slot	microSDXC (dedicated slot)\r\nInternal	16GB 2GB RAM, 32GB 2GB RAM, 32GB 3GB RAM, 64GB 3GB RAM, 64GB 4GB RAM eMMC 5.1\r\n\r\nBATTERY	 	Non-removable Li-Po 4000 mAh battery\r\nCharging	Charging 10W\r\n\r\nPLATFORM	OS	Android 9.0 Pie, upgradable to Android 10, MIUI 11\r\nChipset	Qualcomm SDM632 Snapdragon 632 (14 nm)\r\nCPU	Octa-core (4x1.8 GHz Kryo 250 Gold & 4x1.8 GHz Kryo 250 Silver)\r\nGPU	Adreno 506', '68xiaomi-redmi-7-.jpg'),
('PROD.000014', 'Redmi 8a', 'KTGR.000001', 'MERK.000001', 1449000, 1, 10, 'Fitur\r\nQualcommÂ® Snapdragonâ„¢ 439\r\nCPU: 12 nm FinFET, Hingga 2,0 GHz; 8x ARM Cortex A53, CPU Okta-core\r\nGPU: GPU QualcommÂ® Adrenoâ„¢ 505\r\n\r\n2GB+32GB\r\nRAM: LPDDR3 933 MHz\r\nROM: eMMC 5.1\r\n\r\nBaterai\r\n5000 mAh (typ)/4900 mAh (min)\r\nMendukung Teknologi Quick Charge TM 3.0 dan Fast Charge 18W (9V/2A)\r\nPengisi daya 10W (5V/2A) bawaan\r\nPort pengisian daya Tipe-C\r\n\r\nKamera\r\nKamera Belakang 12 MP\r\nKamera Belakang\r\nFokus otomatis deteksi fase\r\n\r\nHDR\r\nMode potret AI\r\nPengenalan wajah\r\nAI beatutify 4.0\r\nDeteksi kejadian AI\r\n\r\nKamera Depan\r\nKamera selfie 8 MP\r\nPiksel besar 1,12 Î¼m\r\nApertur f/2.0\r\n\r\nAI beautify 4.0\r\nMode potret AI\r\nHDR\r\nFlash layar\r\nTimer selfie\r\nPengenalan wajah', '59xiaomi-redmi-8a.jpg'),
('PROD.000016', 'Samsung Galaxy A30s', 'KTGR.000001', 'MERK.000002', 2899000, 1, 10, 'Design: 3D Glasstic\r\nDisplay:6.4â€³ HD+ (720x1560) + sAMOLED Infinity-V Display\r\nRear Camera: 25 MP (F1.7) / 5 MP / 8 MP (F2.2)\r\nFront Camera:16 MP (F2.0)\r\nProcessor: Exynos 7904(Dual 1.8 GHz + Hexa 1.6 GHz)\r\nRAM: 4GB, Internal Storage:64GB\r\nMicro SD: Up to 512GB\r\nBattery: 4000 mAh\r\nDimension: 158.5 x 74.7 x 7.8 mm\r\nOn-Screen Fingerprint\r\nC-type, Samsung Pay3)\r\nBixby\r\n15W Fast Charging', '66samsung-galaxy-a30s-1.jpg'),
('PROD.000018', 'Oppo A5', 'KTGR.000001', 'MERK.000004', 2195000, 1, 10, 'OPPO A5 2020 berlayar Sunlight Screen waterdrop notch HD+ 5\", quad kamera belakang dengan salah satu sensor mendukung 119Â° Ultra Wide lens, baterai 5.000 mAh mampu reverse charging, Qualcomm Snapdragon 665.', '53oppo-a5.jpg'),
('PROD.000019', 'Realme C2', 'KTGR.000001', 'MERK.000003', 1270000, 1, 10, 'Realme C2 adalah smartphone berlayar 6.1-inch dengan Gorilla Glass 3, ditenagai ColorOS 6 Lite, Android 9.0 (Pie), dan dilengkapi kamera 13MP + 2MP dengan kapasitas 80 fps slo-mo.', '95realme-c2.jpg'),
('PROD.000021', 'Realme 5i', 'KTGR.000001', 'MERK.000003', 2199000, 1, 10, 'DISPLAY	Type	IPS LCD capacitive touchscreen, 16M colors\r\nSize	6.52 inches, 102.6 cm2 (~83.2% screen-to-body ratio)\r\nResolution	720 x 1600 pixels, 20:9 ratio (~269 ppi density)\r\nProtection	Corning Gorilla Glass (unspecified)\r\n\r\nMEMORY	Card slot	microSDXC (dedicated slot)\r\nInternal	32GB 3GB RAM, 64GB 4GB RAM\r\n 	eMMC\r\n\r\nMAIN CAMERA	Quad	12 MP, f/1.8, (wide), 1/2.9\", 1.25Âµm, PDAF\r\n8 MP, f/2.3, 13mm (ultrawide)\r\n2 MP, f/2.4, (macro)\r\n2 MP, f/2.4, (depth)\r\nFeatures	LED flash, HDR, panorama\r\nVideo	4K@30fps, 1080p@30fps, gyro-EIS\r\n\r\nBATTERY	 	Non-removable Li-Po 5000 mAh battery\r\nCharging	Charging 10W', '25realme-5i.jpg'),
('PROD.000022', 'JBL T450bT', 'KTGR.000003', 'MERK.000005', 150000, 1, 35, ' JBL T450BT Pure Bass Sound Bluetooth On-Ear Headphones\r\nSKU800796470_ID-1128514858Jenis GaransiGaransi LokalModelBluetooth On-Ear HeadphonesBluetoothYes', '10T450BT-6.jpg'),
('PROD.000023', 'JBL 450 Black', 'KTGR.000003', 'MERK.000005', 100000, 1, 28, 'Deskripsi Headset Bando JBL XB-450apJBL XB450 Headphone & Headset Mobile Extra Bass\r\nHeadphone ini memiliki kualitas Power Stereo Extra Bass, dengan Jack audio stereo gold plated polated 4 yang dapat digunakan untuk semua jenis HP / smartphone android termasuk Ipod/ Iphone/ Ipad dan mampu menghasilkan kualitas suara ekstra jernih dan stereo bass di jamin puas karena kami telah mengujinya sebelumnya.\r\n', '90JBL 450.jfif'),
('PROD.000024', 'JBL T180A', 'KTGR.000003', 'MERK.000005', 20000, 1, 45, 'Headset Handsfree Earphone Universal JBL T180A In-Ear Earphone Headphones Stereo Hight Bass With Mic - For Android & iOS\r\nSuara seimbang antara kiri dan kanan serta mempunyai Bass.\r\nSangat nyaman ketika digunakan karena mempunyai bantalan yang empuk\r\nWarna yang sangar mengkilau membuat Headphone tersebut terlihat Elegant Dan Sporty\r\nRemote Control bisa untuk angkat telpon dan tutup telepon- play lagu dan pause maupun stop lagu\r\nCocok untuk semua HP Android dan iOS\r\nEnak digunakan untuk mendengarkan musik- dapat digunakan untuk telepon karena mendukung handsfree- memiliki bentuk dan warna yang keren serta mengkilap.', '31InkedJBL-T180A-Earphone-3-5-_LI.jpg'),
('PROD.000025', 'Robot RT130 ', 'KTGR.000002', 'MERK.000006', 152000, 1, 10, 'Merek Robot RT130 10000Mah ModelPowerbankTipe Inputkoneksi kabelFitur PowerbankFast ChargingJumlah Port 2 Jenis GaransiTidak Ada Garansi', '98robot.jfif'),
('PROD.000026', 'MI Powerbank', 'KTGR.000002', 'MERK.000006', 120000, 1, 10, 'produk dari Xiaomi Mi 18W Fast Charge Powerbank 3, Input Type C & Micro, Dual Output Type A, 10.000 mAh\r\nXiaomi Powerbank 3 hadir dengan kapasitas 10000mAh\r\nAnda dapat mencharge gadget Anda berulang kali tanpa perlu takut akan kehabisan daya, sangat praktis dan efisien\r\nTerdapat 2 buah port Output dan 2 buah port input yang berupa port Micro USB dan USB Type C.', '58MI xiomi.jpg'),
('PROD.000027', 'Oppo A37', 'KTGR.000001', 'MERK.000004', 1250000, 1, 10, 'Smartphone A37 atau disebut juga A37f/Neo 9 ini layar 5 inch dengan desain yang nyaman digenggam, berbasis ColorOS 3.0, based on Android 5.1, memiliki fitur kamera 8MP/ 5MP dengan bukaan Rear: f/2.2 Sec: f/2.4', '62oppo-a37.jpg'),
('PROD.000028', 'Oppo A52', 'KTGR.000001', 'MERK.000004', 2999000, 1, 10, 'Smartphone kelas menengah dari OPPO yang mengemas chipset Snapdragon 665, memiliki empat kamera di bagian belakang dengan sensor utama 12MP dan ditenagai oleh baterai 5.000 mAh.', '33oppo-a52.jpg'),
('PROD.000029', 'Samsung Galaxy A20s', 'KTGR.000001', 'MERK.000002', 2199000, 1, 10, 'Display: 6.5â€ HD+ 19:5:9 V-cut\r\nRear Camera: 13MP (F1.8)+5MP(F2.2)+8MP\r\nFront Camera: 8MP (F2.0)\r\nProcessor: SDM450 Octa 1.8GHz\r\nRAM: 3GB\r\nInternal Storage: 32GB\r\nBattery: 4000 mAh\r\nDimension: 163.31 x 77.52 x 8.0mm\r\nDesign: 3D Glasstic\r\nOthers: Fingerprint', '86samsung-galaxy-a20s.jpg'),
('PROD.000030', 'OPPO A92 8GB/128GB', 'KTGR.000001', 'MERK.000004', 4199000, 1, 30, 'Oppo A92 merupakan handphone HP dengan kapasitas 5000mAh dan layar 6.5\" yang dilengkapi dengan kamera belakang 48 + 8 + 2 + 2MP dengan tingkat densitas piksel sebesar 405ppi dan tampilan resolusi sebesar 1080 x 2400pixels. Dengan berat sebesar 192g, handphone HP ini memiliki prosesor Octa Core. Tanggal rilis untuk Oppo A92: Mei 2020.', '3oppo-a92-1.jpg'),
('PROD.000031', 'OPPO A9 8/128GB', 'KTGR.000001', 'MERK.000004', 3599000, 1, 30, 'Oppo A9 dengan spesifikasi :\r\nChipset: Qualcomm SDM665 Snapdragon 665 (11 nm)\r\nRAM: 4GB/8GB,\r\nMemori internal: 128GB,\r\nUkuran HP: 163.6 x 75.6 x 9.1 mm\r\nBerat HP: 195 gram\r\nUkuran layar: 6,5 inci, 720 x 1600 piksel ~270 ppi density\r\nKamera depan: 16MP, \r\nKamera belakang: Quad camera, 48MP+8MP+2MP+2MP\r\nBaterai: Li-Po 5000 mAh\r\nSpecial Feature Game Boost 2.0 dan Ultra Night Mode 2.0\r\nBuruaan sebelum kehabisan stok...', '53oppo-a9-2020-.jpg'),
('PROD.000032', 'OPPO A12 4/64GB', 'KTGR.000001', 'MERK.000004', 2199000, 1, 30, 'Oppo A12  dengan spesifikasi :\r\n\r\nUkuran Layar : 6.22 inci IPS LCD (720 x 1520 pixels)\r\nChipset : Mediatek MT6765 Helio P35 (12nm)\r\nOS : Android 9.0 (Pie)\r\nRAM: 3GB / 4GB\r\nMemori internal : 32GB / 64GB\r\nUkuran HP : 155.9 x 75.5 x 8.3 mm\r\nBerat HP : 165 g\r\nKamera depan : 5 MP, f/2.0\r\nKamera belakang : 13 MP, f/2.2 dan 2 MP, f/2.4 (depth)\r\nBaterai : Non-removable Li-Po 4230 mAh\r\nPilihan Warna : Blue dan Black\r\nTanggal Rilis : April 2020\r\nBuruan pesan sebelum kehabisan ...', '54oppo-a12.jpg'),
('PROD.000033', 'OPPO A1K', 'KTGR.000001', 'MERK.000004', 1699000, 1, 1, 'OPPO A1k berkapasitas baterai 4000 mAh yang mampu bertahan hingga 17 jam, layar waterdrop HD+ 6.1\" berlapis Corning Gorilla Glass, Ram/Memori 2/32Gb, ditenagai MediaTek MT6762R Helio P22...', '64oppo-a1k.jpg'),
('PROD.000034', 'OPPO A5s', 'KTGR.000001', 'MERK.000004', 1899000, 1, 30, 'OPPO A5s berbekal layar waterdrop HD+ 6.2\" dengan baterai berkapasitas 4230 mAh dapat bertahan 17 jam pemakaian normal, Memori internal 3/32Gb, fast charging 5V2A, fitur Game Space meningkatkan performa gaming.', '33oppo-a5s-2.jpg'),
('PROD.000035', 'OPPO A31', 'KTGR.000001', 'MERK.000004', 2599000, 1, 30, 'OPPO A31 2020 ini memiliki layar 6.5 inci dengan resolusi 720 x 1600 pixels, terdapat 3 kamera utama dengan 12MP + 2MP + 2MP, RAM 4GB, ROM 128GB dan baterai 4.230 mAh.', '25oppo-a31.jpg'),
('PROD.000036', 'OPPO RENO 3', 'KTGR.000001', 'MERK.000004', 4999000, 1, 30, 'Oppo Reno3 memiliki layar FHD + AMOLED 6,4 inci yang ditenagai oleh prosesor MediaTek Dimensity 1000L octa-core dan menjalankan Android Pie (ColorOS 7), baterai 4025mAh, quad kamera dengan rsolusi utama 64MP, kamera depan 32MP dan memori internal 8/128Gb...', '53oppo-reno3.jpg'),
('PROD.000037', 'OPPO RENO 2F', 'KTGR.000001', 'MERK.000004', 4999000, 1, 10, 'spesifikasi Oppo Reno 2F selengkapnya:\r\n\r\nLayar : 6,5 inci\r\nRAM : 8 GB\r\nMemori Internal : 128 GB\r\nKamera Depan : 32 MP\r\nKamera Belakang : 48 + 8 +2 + 2MP\r\nKapasitas Baterai : 4000 mAh', '56oppo-reno-2f.jpg'),
('PROD.000038', 'REALME 6', 'KTGR.000001', 'MERK.000003', 3499000, 1, 15, 'Realme 6 berlayar ultra smooth refresh rate 90Hz, FHD+ 6,5 inci. Kamera Depan 16MP, quad kamera belakang 64MP+8MP+2MP+2MP. Bertenaga MediaTek Helio G90T, baterai 4300mAh pengisian daya 100% dalam 15 menit, sensor sidik jari bagian samping perangkat. RAM : 4/128Gb.', '70realme-6..jpg'),
('PROD.000039', 'SAMSUNG GALAXY M10', 'KTGR.000001', 'MERK.000002', 1499000, 1, 20, '\r\nSamsung Galaxy M10 IndonesiaSamsung Galaxy M10Samsung Galaxy M10 fiturSamsung Galaxy M10 spesifikasiSamsung Galaxy M10 speks\r\nSamsung Galaxy M10 merupakan handphone HP dengan kapasitas 3400mAh dan layar 6.2\" yang dilengkapi dengan kamera belakang 13 + 5MP dengan tingkat densitas piksel sebesar 270ppi dan tampilan resolusi sebesar 720 x 1520pixels. Dengan berat sebesar 163g, handphone HP ini memiliki prosesor Octa Core. RAM : 2/16GB', '50samsung-galaxy-m10.jpg'),
('PROD.000040', 'SAMSUNG GALAXY A50S', 'KTGR.000001', 'MERK.000002', 3099000, 1, 20, 'Samsung Galaxy A50s merupakan handphone HP dengan kapasitas 4000mAh dan layar 6.4\" yang dilengkapi dengan kamera belakang 48 + 8 + 5MP dengan tingkat densitas piksel sebesar 403ppi dan tampilan resolusi sebesar 1080 x 2340pixels. Dengan berat sebesar 169g, handphone HP ini memiliki prosesor Octa Core. RAM : 4/64gb...', '86samsung-galaxy-a50s.jpg'),
('PROD.000041', 'JBL Z5 Universal', 'KTGR.000003', 'MERK.000005', 25000, 1, 40, 'Design yang simpel dan elegan dengan dua warna pilihan. Hitam berpaduan warna gold yang maskulin dan putih berpaduan warna gold yang cantik.\r\n\r\nPARAMETER\r\nDriver Unit: 9mm\r\nImpedance: 16 -+20%\r\nSensitivity: 40+4dB\r\nFerquency Response: 20Hz-20KHz\r\nDistosion factor: 5% @1 KHz 1mW\r\nVoltage: 4.5V\r\nRated Power: 3mW\r\n\r\nBuruan dipesan ....', '56JBL Z5 universal RP.25000.jpg'),
('PROD.000042', 'JBL C100si', 'KTGR.000003', 'MERK.000005', 15000, 1, 50, 'Dapatkan kualitas suara seperti yang Anda inginkan dengan JBL C100SI In-Ear Headphones with Mic - Compatible with Android & iOS. In-ear headphone ultra-ringan dengan kualitas suara khas JBL yang memukau siap memproduksi audio seperti aslinya baik dari perangkat Android maupun iOS.', '47JBL C1000SI Rp.25000.jpg'),
('PROD.000043', 'JBL T150 ', 'KTGR.000003', 'MERK.000005', 150000, 1, 25, 'Handsfree JBL T150 Suara bass ...\r\nHeadset canggih tanpa kabel dengan suara super nge BASS, nyaman saat digunakan dan tak repot lagi tanpa kabel yang mengganggu.\r\n\r\nCara Penggunaan :\r\nðŸŽ§ Sentuh salah satu earphone diatas tulisan JBL hingga lampu LED berkedip, \r\nðŸŽ§ Cari nama bluetooth TWS pada setting bluetooth di HP, kemudian di connectin.\r\nðŸŽ§ Setelah itu earphone yang kanan dan kiri akan connect ke HP dengan sendirinya.', '8Jbl T150 bluetot.jfif'),
('PROD.000044', 'Headset Samsung HS330 ', 'KTGR.000003', 'MERK.000005', 15000, 1, 35, 'Headset Samsung\r\n\r\nHeadset Samsung Original Dapat mendengarkan Music dengan suara yang baik , dan mudah di bawa kemana saja\r\n\r\nDengan Kualitas yang baik Headset Samsung ini Bisa untuk Menerima Telepon , Dan mendengarkan Music\r\n\r\nWarna : Hitam / putih\r\nPacking Plastik', '11samsung.jfif'),
('PROD.000045', 'Oppo headset R11', 'KTGR.000003', 'MERK.000005', 25000, 100, 45, 'Product Name: Handsfree OPPOOriginal Headset Earphone\r\n\r\nKualitas suara yang jernih, bagus, dan berkualitas\r\nStereo\r\nInput jack 3.5 mm\r\nKualitas suara yang jernih, bagus, dan berkualitas', '66Oppo headset R11 universal.jpeg'),
('PROD.000046', 'Oppo Headset MH130', 'KTGR.000003', 'MERK.000005', 30000, 250, 45, 'Headset OPPO Original Earphone Handsfree Universal\r\n\r\n\r\n\r\nOriginal Inner Earphones\r\n\r\nHgh quality Earphone For smart phones.\r\n\r\nStandard 3.5mm earphone plug fits all MP3 players with 3.5mm jack.\r\n\r\nWith the function of answer phone, listen to music for all XiaoMi phones. b\r\n\r\nCompatible With all smart phones with standard 3.5mm jack.', '28Oppo MH130.jfif'),
('PROD.000047', 'Oppo headset universal', 'KTGR.000003', 'MERK.000005', 15000, 1, 40, 'Deskripsi Headset OPPO Handsfree OPPO Earphone in Ear Bud Universal 3.5mm MURAH\r\nHandsfree / Earphone / Headset Universal 3.5mm label merk OPPO\r\n\r\n- Suara yg dihasilkan cukup nge~BASS ya, krn menggunakan ear bud sehingga kedap suara dr luar headset.\r\n\r\n~ Call answer button ON / OFF.\r\n\r\n- Support Microphone sehingga handsfree bisa digunakan utk Telepon / Mendegarkan Music.\r\n\r\n- Jack 3.5mm ~ Handsfree dapat digunakan utk berbagai macam perangkat HP / Smartphone Android / HP China / iOs.\r\n\r\n- Panjang Kabel = 120cm.', '98Oppo P6-02.jpg'),
('PROD.000048', 'Realme Buds  ', 'KTGR.000003', 'MERK.000005', 45000, 2, 50, 'Earphone dengan desain yang keren dan nyaman digunakan ini mampu menghasilkan suara yang nyaman untuk Anda dengarkan. Terdapat microphone sehingga Anda dapat menggunakan earphone ini untuk menjawab panggilan telepon langsung.', '65realme.jpg'),
('PROD.000049', 'Realme earphone R30', 'KTGR.000003', 'MERK.000005', 30000, 1, 45, 'Fitur Unggulan realme Earphone\r\n1. Rasakan bass nirwana dengan respon frekuensi yang lebih tinggi dan driver audio 11mm untuk nada kuat dan lebih kencang serta memberikan pengalaman media yang menyenangkan.\r\n2. Berdasarkan uji tes dibandingkan dengan earphone dengan driver standar 10mm.\r\n3. Fiber kevlar yang sangat kuat dan tidak mudah rusak akan melindungi kabel dari sobekan untuk daya tahan tingkat tinggi. Dengan lapisan anyaman akan memberikan kesan premium dan mencegah kabel jadi kusut.', '39Realme R30.jfif'),
('PROD.000050', 'Xiaomi earphone R11', 'KTGR.000003', 'MERK.000005', 45000, 1, 55, 'Kualitas bass bagus\r\nOriginal 100%\r\nStereo Sound\r\nKualitas suara jernih\r\nDesign Stylish\r\nKualitas bass bagus\r\nUniversal Smartphones', '92Xiaomi R11.jpeg'),
('PROD.000051', 'XIOMI Headset MH133', 'KTGR.000003', 'MERK.000005', 20000, 1, 45, 'Deskripsi :\r\n\r\nInput Jack 3.5mm\r\nHigh Quality\r\nDilengkapi Microphone untuk panggilan masuk & keluar\r\nDapat digunakan untuk semua Smartphone', '84Xiaomi Mh133.jpeg'),
('PROD.000052', 'Xiaomi headset Super Bass', 'KTGR.000003', 'MERK.000005', 20000, 1, 35, 'Headset dengan tampilan yang elegan dan membuat pengguna merasa nyaman ketika memakai, serta memiliki suara bass yang bagus...\r\n\r\nburuan pesan produk nya...', '49Headset_XIAOMI_Handsfree_XIAOMI_Earphone_Ear_Bud_Universal_3.jpg'),
('PROD.000053', 'Xiaomi Pb 10.000 Mah', 'KTGR.000002', 'MERK.000006', 130000, 1, 40, 'eskripsi powerbank xiaomi ori 100% 10.000 MAH + fastcharging\r\nKualitas original 100% ... pengisian ke hp super cepatttt karna di dukung fast charging . Jamin memuaskan barangnya', '70xiaomi 10000 mah.jfif'),
('PROD.000054', 'ViVAN Robot Rt7300', 'KTGR.000002', 'MERK.000006', 115000, 1, 35, 'Brand Robot\r\nModel RT7300\r\nCapacity 6600mAh\r\nBattery Lithium Ion\r\nInput 5V /2A\r\nOutput1 5V/2.1A\r\nOutput2 5V/1A\r\nRecycling Time 500 times\r\nCompatibility Suitable for a variety of mobile phones iPhone iPod iPad Tablet PC PDA Bluetooth headset and other digital products !\r\n', '47PB robot 6600.jfif'),
('PROD.000055', 'ROBOT Powerbank RT5800', 'KTGR.000002', 'MERK.000006', 85000, 1, 30, 'Detail produk dari ROBOT Powerbank RT5800 5200 mAh\r\nKapasitas : 5200mAh\r\nDilengkapi dengan lampu indikator\r\nTerdapat lampu pendeteksi uang palsu\r\nBahan ABS+PC tahan api\r\nMemiliki 8 fungsi perlindungan', '73xiaomi rt5800.jfif'),
('PROD.000056', 'Softcase Redmi Note 8', 'KTGR.000004', 'MERK.000007', 15000, 1, 55, 'Softacase Redmi Note 8 :\r\n\r\nMemiliki desain yang bagus saat dipasang pada handphone , dan mempunyai bahan yang lentur sehingga nyaman saat di genggam. dan melingdungi bodi handphone agar tidak kotor maupun terjaga saat terjadi benturan,,,,\r\n\r\nBuruaan dipesan produknya sebelum kehabisan.', '34case note 8.jpg'),
('PROD.000057', 'Silicon Note 8', 'KTGR.000004', 'MERK.000007', 15000, 1, 44, 'Softacase Redmi Note 8 :\r\n\r\nMemiliki desain yang bagus saat dipasang pada handphone , dan mempunyai bahan yang lentur sehingga nyaman saat di genggam. dan melingdungi bodi handphone agar tidak kotor maupun terjaga saat terjadi benturan,,,,\r\n\r\nBuruaan dipesan produknya sebelum kehabisan.', '71note 8 silikon halus.jpg'),
('PROD.000058', 'Note 8 softcase', 'KTGR.000004', 'MERK.000007', 15000, 1, 43, 'Softacase Redmi Note 8 :\r\n\r\nMemiliki desain yang bagus saat dipasang pada handphone , dan mempunyai bahan yang lentur sehingga nyaman saat di genggam. dan melingdungi bodi handphone agar tidak kotor maupun terjaga saat terjadi benturan,,,,\r\n\r\nBuruaan dipesan produknya sebelum kehabisan.', '79Screenshot (95).png'),
('PROD.000059', 'Note 8 silikon', 'KTGR.000004', 'MERK.000007', 10000, 1, 50, 'Silikon note 8 xiaomi dengan tampilan putih polos....\r\n\r\nburuan di pesann produk nya ,,,', '258 putih.png'),
('PROD.000060', 'Note 8 Pro Hitam', 'KTGR.000004', 'MERK.000007', 15000, 1, 45, 'segeraa di pesan softcase nya supaya handphone mu menjadi semakin terlihat menarik ...', '42note 8 pro hitam.jfif'),
('PROD.000061', 'Softcase Redmi note 8', 'KTGR.000004', 'MERK.000007', 15000, 1, 1, 'Dengan Tampilan penuh warna handphone akan semakin terlihat menarik ketika digunakan...\r\n\r\nburuaan dipesan produknya... ', '118 pro.png'),
('PROD.000062', 'Silikon Note 7 warna', 'KTGR.000004', 'MERK.000007', 15000, 1, 1, 'Dengan menggunakan pelindung handphone mu akan terjaga dan akan tampil semakin menarik .... dengan beberapa warna yang tersedia , bahan lembut yang digunakan akan membuat nyaman ketika di genggam .... ', '74note 7 warna wrni.jfif'),
('PROD.000063', 'softcase redmi note 7', 'KTGR.000004', 'MERK.000007', 10000, 1, 1, 'berfungsi untuk melindungi cassing handphone anda dan menambah kecantikan tampilan nya...\r\n\r\n', '4note 7 putih.jpg'),
('PROD.000064', 'Softcase Samsung A10s', 'KTGR.000004', 'MERK.000007', 15000, 1, 1, 'Segeraaa pesan untuk melindungi handphone anda ... softcase ini tersedia 2 warna yaitu putih dan hitam ...', '41a10s.jfif'),
('PROD.000065', 'Silikon Samsung A20s', 'KTGR.000004', 'MERK.000007', 10000, 1, 1, 'Bahan terbuat dr teknologi silikon terbaru, sehingga membuat case jadi :\r\n- Anti Oil / Anti Minyak, sehingga case tdk mudah kotor.\r\n- Elegant, body case yg slim / ramping membuat penampilan HP semakin mewah.\r\n- Anti Fingerprint, sidik jari tdk membekas / menempel pd case.\r\n- Flexible, case tdk akan terdapat bekas patahan walau dilipat / tergulung.\r\n-Anti Selip, bahan kombinasi antara Glossy & Doff, sehingga nyaman dipegang & pas di tangan serta tdk licin diletakkan di meja.\r\n- Hanya tersedia warna : BLACK SOLID (Hitam Pekat).', '69a20s black.jfif'),
('PROD.000066', 'Softcase Slim Oppo A3s', 'KTGR.000004', 'MERK.000007', 15000, 1, 45, 'Terbuat dari bahan karet polycarbonate premium\r\nMaterial softcase anti-slip memberikan ponsel pintar Anda lebih nyaman di genggaman\r\nFitur soft-touch karet pelapis yang halus dan lembut dengan bobot yang ringan dan design superslim\r\nkesan lebih mewah dan elegan', '17a3s.jfif'),
('PROD.000067', 'Soft Oppo Reno 3', 'KTGR.000004', 'MERK.000007', 10000, 1, 35, 'Terbuat dari bahan karet polycarbonate premium\r\nMaterial softcase anti-slip memberikan ponsel pintar Anda lebih nyaman di genggaman\r\nFitur soft-touch karet pelapis yang halus dan lembut dengan bobot yang ringan dan design superslim\r\nkesan lebih mewah dan elegan', '52reno 3.jfif'),
('PROD.000068', 'Case Realme C2', 'KTGR.000004', 'MERK.000007', 15000, 1, 1, 'Terbuat dari bahan karet polycarbonate premium\r\nMaterial softcase anti-slip memberikan ponsel pintar Anda lebih nyaman di genggaman\r\nFitur soft-touch karet pelapis yang halus dan lembut dengan bobot yang ringan dan design superslim\r\nkesan lebih mewah dan elegan', '24realme c2.jpg'),
('PROD.000069', 'Realme 5 silikon', 'KTGR.000004', 'MERK.000007', 15000, 1, 1, 'Terbuat dari bahan karet polycarbonate premium\r\nMaterial softcase anti-slip memberikan ponsel pintar Anda lebih nyaman di genggaman\r\nFitur soft-touch karet pelapis yang halus dan lembut dengan bobot yang ringan dan design superslim\r\nkesan lebih mewah dan elegan', '42realme 5.jfif'),
('PROD.000070', 'Softcase Realme 5 violet', 'KTGR.000004', 'MERK.000007', 15000, 1, 1, 'Terbuat dari bahan karet polycarbonate premium\r\nMaterial softcase anti-slip memberikan ponsel pintar Anda lebih nyaman di genggaman\r\nFitur soft-touch karet pelapis yang halus dan lembut dengan bobot yang ringan dan design superslim\r\nkesan lebih mewah dan elegan', '13realme 5 violet.jpg'),
('PROD.000071', 'Charger Xiaomi Type C 10W ', 'KTGR.000005', 'MERK.000010', 65000, 1, 67, 'Fitur Fast Charging (HP Harus mendukung fast charging)\r\nFast Charging adalah teknologi yang terdapat pada perangkat dan charger untuk mengatur pengisian baterai lebih cepat. Teknologi ini diterapkan pada sebuah perangkat seperti HP/Smartphone, Tablet, Laptop, Powerbank, dll. Untuk menjalankan fitur fast charging, perangkat serta charger harus saling mendukung.\r\n\r\nInput : 100-240V 50/60Hz\r\nOutput : 5V= 2,5 A - 9V=2 A - 12V = 1,5A\r\n', '16charger xiaomi type C.jpg'),
('PROD.000072', 'Kabel Data Xiaomi type C', 'KTGR.000005', 'MERK.000010', 20000, 1, 50, 'Deskripsi Kabel Data XIAOMI Type-C ORIGINAL ORI 100% Micro USB Cable Tipe C\r\nKabel Data Xiaomi USB Type-C 2.1 A Fast Charging Cable Data Original\r\n:: Kabel data Original 100% XIAOMI USB TYPE-C ::\r\n', '80USB xiaomi C.jpg'),
('PROD.000073', 'Charger Oppo Vooc Flash', 'KTGR.000005', 'MERK.000009', 60000, 1, 43, 'ORIGINAL OPPO\r\nSpesifikasi:\r\nâ€¢ Model : AK779GB\r\nâ€¢ DL 118 MICRO USB 7 PIN\r\nâ€¢ Input : 100-240V~50/60Hz , 0.6A\r\nâ€¢ Output : 5V / 4A\r\nâ€¢ VOOC Flash Charge (Pengisian Super Cepat)\r\n100% ORIGINAL\r\nOPPO F1 Plus\r\nâ€¢ OPPO R7\r\nâ€¢ OPPO R7s', '35Oppo VOOC.jpg'),
('PROD.000074', 'Samsung Fast Charger', 'KTGR.000005', 'MERK.000012', 65000, 1, 45, 'Fast Charging 2 Ampere Output for Compatibel Handphone.\r\nKepala Charger Original 100% Relatif Lebih Berat dan Berisi, Tidak Enteng seperti OEM / KW nya.\r\nPenggunaan Charger selain Original dapat membahayakan diri anda sendiri, HATI - HATI.\r\nOutput 5 Volt / 2A, digunakan utk charger Samsung S4 atau kompatibel lainnya.\r\nBisa digunakan Utk Charger Samsung tipe apapun dan Smartphone Merk Lainnya .\r\nWarna kabel putih, bisa digunakan sebagai kabel data.', '3samsung travel.jfif'),
('PROD.000075', 'Realme Fast Charging ', 'KTGR.000005', 'MERK.000011', 50000, 1, 55, 'Deskripsi Charger Realme Fast Charging 20W Adaptor+Kabel TypeC Android SuperVooc\r\nCHARGER REALME + KABEL MICRO\r\n\r\nWARNA\r\n*PUTIH\r\n\r\nVOOC FLASH CHARGING DEVICE\r\nPOWER SUPPLY UNIT\r\nC6200722A2016082\r\n\r\nMODEL : OP52CAED\r\nINPUT : 100-240V~50/60HZ 0.4A\r\nOUTPUT : 5V=2.0A. 10.0W\r\n\r\nVOOC FLASH CHARGING CABLE', '19Realme 20W.jpg'),
('PROD.000077', 'Samsung A10s', 'KTGR.000001', 'MERK.000002', 1799000, 700, 60, 'Display:6.2â€ HD+ (1,520 x 720) TFT\r\nRear Camera: 13 MP (F1.8) + 2 MP\r\nFront Camera: 8 MP (F2.0)\r\nProcessor: Quad 2.0 + Quad 1.5 GHz\r\nRAM: 2GB', '59samsung-galaxy-a10s.jpg'),
('PROD.000078', 'Charger Travel Adapter Samsung', 'KTGR.000005', 'MERK.000012', 25000, 1, 64, 'Spesifikasi :\r\n- Warna : Putih\r\n- Oryginal SEIN (cek hologram)\r\n- Oryginal 100% (cek hologram)\r\n- Output : 15W - 5V - 2A\r\n- Optimal Safely (baterai full, otomatis stop)\r\n- Superior Speed (charging lebih cepat)\r\n- USB 3.0 Compatible\r\n- Real Picture\r\n\r\nCocok juga untuk Samsung Galaxy S4, S3, Note 2, Note 4, Mega, Grand, E5, E7, J1, J2, J3, J5, J7, A3, A5, A7, A8, A9, Prime, Tab Series, dan tipe Samsung lainnya dengan port Micro-USB.\r\n', '96Screenshot (99).png'),
('PROD.000079', 'Travel Adapter samsung', 'KTGR.000005', 'MERK.000012', 26000, 1, 36, 'Samsung Travel Adpater Galaxy Young / Wonder / J1 ACE Merupakan charger berkualitas dari Samsung yang memiliki arus stabil dan sangat aman digunakan,namun sayang output dari charger ini kurang dari 2A sehingga waktu yang dibutuhkan mungkin sedikit lebih lama,namun dengan kualitas dari samsung maka Anda dapat mengandalkan charger ini sebagai pengisi daya handphone Anda,kabel USB yang lebih panjang memudahkan anda dalam mengisi dalamkeadaan yang jauh dari stop kontak,charger ini kompatible dengan semua smartphone yang menggunakan micro USB. Jika handphone Anda rusak maka membeli charger ini merupakan solusi terbaik untuk Anda.', '82J1 charger.jpg'),
('PROD.000080', 'Xiaomi Charger Tc Oc', 'KTGR.000005', 'MERK.000010', 30000, 1, 60, 'Dengan charger yang satu ini, kamu dapat mengisi daya smartphone kamu dengan cepat.', '82xiomi TC OC.jpg'),
('PROD.000081', 'Oppo charger Ak933', 'KTGR.000005', 'MERK.000009', 35000, 1, 43, 'support Device OPPO :\r\nF1s, F1s New, A39,A37,Neo7 dan tipe lainnya \r\n\r\nGunakanlah selalu charger original untuk mencharging gadget kesayangan kamu, dengan menggunakan charger original pengisian menjadi lebih cepat dan aman, jika kamu pengguna Hp OPPO Produk ini sangat cocok untuk pengganti charger Original kamu yg sudah rusak atau hialang.', '28Oppo travel 2A.jfif'),
('PROD.000082', 'UNEED Type C QC 3.0', 'KTGR.000005', 'MERK.000013', 55000, 1, 44, 'UNEED UCB34C â€“ BOLT III dengan teknologi pengisian daya cepat hingga maksimum 5A, dilengkapi dengan protocol quick charge dari beberapa Brand besar pada kabel (Quick Charge 3.0, Huawei FCP, VOOC Flash Charge, Dash Charge) menjadikan BOLT III sebagai salah satu Smart Cable terbaik yg ada di pasaran saat ini.\r\n', '98kabel.jfif'),
('PROD.000083', 'Charger UNEED 403', 'KTGR.000005', 'MERK.000013', 145000, 1, 35, 'SMART CHARGING\r\nDengan teknologi Smart Charging pengisian daya ke perangkat akan lebih cepat dan aman karena Teknologi Smart Charging dapat membaca kebutuhan daya dari perangkat dan akan menghantarkan daya tercepat sesuai kebutuhan dari perangkat anda, sehingga tidak akan terjadi kelebihan daya yg akan menyebabkan perangkat cepat rusak.\r\n', '15403 uneed.jfif'),
('PROD.000084', 'Vivan Power Oval', 'KTGR.000005', 'MERK.000014', 40000, 1, 43, 'Spesifikasi:\r\nBrand: Vivan\r\nModel: Power oval\r\nPort: Single USB\r\nInput: 100~240V/ 50~60Hz\r\nOutput: 5V 2A\r\nSuhu saat digunakan: 0-40 degrees Celsius\r\nKelembaban saat digunakan: 35-85% RH', '26vivan 1 slot.png'),
('PROD.000085', 'Vivan Kabel Data warna', 'KTGR.000005', 'MERK.000014', 20000, 1, 55, 'Specifications:\r\n\r\n1. Android MIC color flat cable\r\n\r\n2. Cable length 100CM.\r\n\r\n3. USB & MIC rubber paint.\r\n\r\n4. MIC terminal pin, TPE colored coat.\r\n\r\n5. MIC & USB terminal mold protection, stainless steel, nickel-plated.\r\n\r\n6. Enamelled copper core, overcurrent 2A.\r\n\r\n7. ROHS environmental protection.', '96vivan kabel.jpg'),
('PROD.000086', 'ADAPTER HIPPO UNION', 'KTGR.000005', 'MERK.000015', 30000, 100, 33, 'Hippo Adapter Union merupakan adapter charger smartphone dari Hippo yang hadir dengan 1 Port USB dengan total output 1A.\r\nDilengkapi dengan lampu LED di port USB nya. Menggunakan teknologi Auto Detect sehingga charger akan mencharger dan menyesuaikan arus listrik yang diperlukan oleh device.\r\n', '32Hippo adapter.jpg'),
('PROD.000087', 'Kabel Type C Hippo', 'KTGR.000005', 'MERK.000015', 15000, 100, 49, 'Hippo Teleport 2 Micro type-c adalah Inovasi terbaru USB Cable Charging tercepat yang pernah dibuat. Digunakan untuk mengisi daya Smartphone atau Tablet yang memiliki port Micro USB dengan konektor USB ke komputer Mac atau Windows PC.', '69kabel.jfif'),
('PROD.000088', 'Charger Robot RT-K5', 'KTGR.000005', 'MERK.000016', 30000, 100, 87, 'Merk = ROBOT\r\nTipe = RT-K5\r\nTotal Output = 2,1A\r\nMaterial = ABS + PC\r\nVoltage = 110 - 240V', '451.jfif'),
('PROD.000089', 'kabel robot RBM', 'KTGR.000005', 'MERK.000016', 10000, 100, 125, 'kabel robot merupakan kabel charger dengan kualitas terbaik\r\n\r\nSpefikasi kabel robot RBM\r\n\r\n- model kabel bulat\r\n- kemasan plastik vivan seperti di gambar.\r\n- bisa untuk semua HP yang menggunakan Micro USB seperti Blackberry, Samsung, HTC, Oppo, Advan, Evercross, Andromax dan beberapa type Gadget Keluaran Terbaru.\r\n', '6700.700_783a33649c7146509c27f14353d1b868.jpg'),
('PROD.000090', 'Redmi Note 8 Pro', 'KTGR.000001', 'MERK.000001', 3299000, 800, 68, 'NETWORK	Technology	GSM / HSPA / LTE\r\n\r\nBODY	       Dimensions	161.4 x 76.4 x 8.8 mm (6.35 x \r\n                                                3.01 x  0.35 in)\r\n                       Weight	        200 g (7.05 oz)\r\n                       Build	                Glass front (Gorilla Glass 5), \r\n                                                glass back (Gorilla Glass 5), \r\n                                                plastic frame\r\n                      SIM	                Hybrid Dual SIM (Nano-SIM, \r\n                                                dual stand-by)\r\nMEMORY	     Card slot	        microSDXC (uses shared SIM \r\n                                                slot)\r\n                     Internal	        64GB 6GB RAM, 128GB 6GB \r\n                                                RAM, 128GB 8GB RAM, 256GB \r\n                                                8GB RAM UFS 2.1\r\nBATTERY	 	                        Non-removable Li-Po 4500 \r\n                                                mAh battery\r\n                    Charging	        Fast charging 18W', '32xiaomi-redmi-note-8-pro-0.jpg'),
('PROD.000091', 'Samsung A20s', 'KTGR.000001', 'MERK.000002', 2199000, 800, 55, 'Display: 6.5â€ HD+ 19:5:9 V-cut\r\nRear Camera: 13MP (F1.8)+5MP(F2.2)+8MP\r\nFront Camera: 8MP (F2.0)\r\nProcessor: SDM450 Octa 1.8GHz\r\nRAM: 3GB\r\nInternal Storage: 32GB\r\nBattery: 4000 mAh\r\nDimension: 163.31 x 77.52 x 8.0mm\r\nDesign: 3D Glasstic\r\nOthers: Fingerprint', '30samsung-galaxy-a20s.jpg'),
('PROD.000092', 'Oppo A3s', 'KTGR.000001', 'MERK.000004', 1679000, 700, 67, 'OPPO A3s berlayar notch HD+ 6.2\" dengan dibenami Qualcomm Snapdragon 450, dual kamera belakang 13MP+2MP, kamera depan 8MP, baterai 4230 mAh.', '36oppo-a3s.jpg'),
('PROD.000093', 'REALME 5', 'KTGR.000001', 'MERK.000003', 2199000, 700, 77, 'Realme 5 berbekal layar mini-drop fullscreen LCD 6.5\", ditenagai Snapdragon 665, quad kamera belakang perangkat dan baterai 5000 mAh, Micro USB port.', '23realme-5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` varchar(11) NOT NULL,
  `provinsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `provinsi`) VALUES
('PROV.000001', 'Jawa Barat'),
('PROV.000002', 'Jawa Tengah'),
('PROV.000003', 'Jawa Timur'),
('PROV.000004', 'Aceh'),
('PROV.000005', 'Sumatera Utara'),
('PROV.000006', 'Sumatera Barat'),
('PROV.000007', 'Riau'),
('PROV.000008', 'Kepulauan Riau'),
('PROV.000009', 'Jambi'),
('PROV.000010', 'Bengkulu'),
('PROV.000011', 'Sumatera Selatan'),
('PROV.000012', 'Lampung'),
('PROV.000013', 'Banten'),
('PROV.000014', 'Daerah Khusus Ibukota (DKI)'),
('PROV.000015', 'Daerah Istimewah Yogyakarta (D'),
('PROV.000016', 'Bali'),
('PROV.000017', 'Nusa Tenggara Barat (NTB)'),
('PROV.000018', 'Kalimantan Barat'),
('PROV.000019', 'Kalimantan Selatan'),
('PROV.000020', 'Kalimantan Tengah'),
('PROV.000021', 'Kalimantan Timur'),
('PROV.000022', 'Kalimantan Utara'),
('PROV.000023', 'Sulawesi Selatan'),
('PROV.000024', 'Sulawesi Utara'),
('PROV.000025', 'Sulawesi Tengah'),
('PROV.000026', 'Sulawesi Barat');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id_rekomendasi` varchar(11) NOT NULL,
  `id_produk` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id_rekomendasi`, `id_produk`) VALUES
('RKMD.000002', 'PROD.000088'),
('RKMD.000001', 'PROD.000090');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_kota` varchar(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `blokir` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama_lengkap`, `email`, `no_hp`, `id_kota`, `alamat`, `blokir`) VALUES
('abah', 'd02c64cac131b02d62efd28bc8b3ee09', 'Abah', 'abah@gmail.com', '6285211873577', 'KOTA.000001', 'Watubelah', 'N'),
('ali', '86318e52f5ed4801abe1d13d509443de', 'ali', 'ali123@gmail.com', '089600765486', 'KOTA.000001', 'jl. pantura losari', 'N'),
('amran', '9e90a72db01c901457185fa773c35032', 'amran', 'amran@gmail.com', '6287730383362', 'KOTA.000003', 'Jalan raya Kota brebes.', 'N'),
('febri', '4689c75fd0935ff5818d62fd2083ed98', 'febri', 'febri@gmail.com', '089976124832', 'KOTA.000003', 'Jl.Pantura brebes, Desa brebes, blok masjid (dekat alun-alun)', 'N'),
('kelani', '1c46c3b97dddc470e9d8f304b61f05e3', 'Ahmad Kelani', 'kelani@gmail.com', '6281223205520', 'KOTA.000003', 'jln. raya brebes', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `username` (`username`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id_komplain`),
  ADD KEY `no_invoice` (`no_invoice`,`u_pembeli`,`u_admin`),
  ADD KEY `u_admin` (`u_admin`),
  ADD KEY `u_pembeli` (`u_pembeli`);

--
-- Indexes for table `konfirm_bayar`
--
ALTER TABLE `konfirm_bayar`
  ADD KEY `id_bank` (`id_bank`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`no_invoice`),
  ADD KEY `u_pembeli` (`u_pembeli`),
  ADD KEY `u_toko` (`u_toko`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`,`id_merek`),
  ADD KEY `id_merek` (`id_merek`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_kota` (`id_kota`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `komplain`
--
ALTER TABLE `komplain`
  ADD CONSTRAINT `komplain_ibfk_1` FOREIGN KEY (`no_invoice`) REFERENCES `orders` (`no_invoice`),
  ADD CONSTRAINT `komplain_ibfk_2` FOREIGN KEY (`u_admin`) REFERENCES `admin` (`username`),
  ADD CONSTRAINT `komplain_ibfk_3` FOREIGN KEY (`u_pembeli`) REFERENCES `user` (`username`);

--
-- Constraints for table `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`u_pembeli`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`u_toko`) REFERENCES `admin` (`username`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_merek`) REFERENCES `merek` (`id_merek`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
