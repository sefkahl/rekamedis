-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Nov 2026 pada 12.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rm_datapasien`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kegunaan` varchar(230) NOT NULL,
  `jenis_obat` enum('Tablet','Kapsul','Sirup') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_obat`
--

INSERT INTO `tbl_obat` (`id`, `nama`, `kegunaan`, `jenis_obat`) VALUES
(45, 'Allopurinol', 'Menurunkan kadar asam urat tinggi dalam darah', 'Tablet'),
(46, 'Ranitidine', 'Mengatasi gejala sakit mag dan nyeri ulu hati', 'Tablet'),
(47, 'Lactulose Sirup', 'Mengatasi sembelit kronis dan melunakkan tinja', 'Sirup'),
(48, 'Piroxicam', 'Meredakan nyeri sendi akibat asam urat atau rematik', 'Kapsul'),
(49, 'Captopril', 'Menurunkan tekanan darah tinggi secara cepat', 'Tablet'),
(50, 'Bisoltussin Sirup', 'Meredakan batuk kering dan melegakan tenggorokan', 'Sirup'),
(51, 'Methylprednisolone', 'Mengobati penyakit autoimun dan radang sendi', 'Tablet'),
(52, 'Diclofenac Sodium', 'Meredakan nyeri sendi kronis dan pegal linu', 'Tablet'),
(53, 'Siladex Sirup', 'Meredakan batuk berdahak dan mempermudah pengeluaran lendir', 'Sirup'),
(54, 'Antalgin', 'Meredakan nyeri hebat dan sakit kepala', 'Tablet'),
(55, 'Neurobion', 'Mengatasi kebas, kesemutan, dan kerusakan saraf', 'Tablet'),
(56, ' Woods Cough Syrup', 'Meredakan batuk berdahak dan melegakan napas', 'Sirup'),
(57, 'Glimepiride', 'Mengontrol kadar gula darah penderita diabetes tipe 2', 'Tablet'),
(58, 'Ketoconazole', 'Mengobati infeksi jamur sistemik pada tubuh', 'Tablet'),
(59, 'Ambroxol Sirup', 'Mengencerkan dahak pada penyakit saluran pernapasan', 'Sirup'),
(60, 'Domperidone', 'Meredakan mual, muntah, dan gangguan pencernaan', 'Tablet'),
(61, 'Azithromycin', 'Mengobati infeksi paru-paru dan infeksi kelamin', 'Kapsul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` enum('p','w') NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id`, `nama`, `nik`, `tgl_lahir`, `gender`, `telepon`, `alamat`) VALUES
('260716010101', 'Ahmad Hidayat', '3171010101950002', '1995-01-12', 'p', '081234567890', 'Jl. Merdeka No. 10, Jakarta'),
('260716010102', 'Siti Aminah', '3171024203980002', '1998-02-02', 'w', '081345678901', 'Jl. Mawar No. 4, Bogor'),
('260716010103', 'Budi Santoso', '3273031506900003', '1990-06-15', 'p', '081456789012', 'Jl. Diponegoro No. 22, Bandung'),
('260716010104', 'Dewi Lestari', '3273045208940004', '1994-08-12', 'w', '081567890123', 'Jl. Anggrek No. 15, Sukabumi'),
('260716010105', 'Eko Prasetyo', '3578052011880005', '1988-11-20', 'p', '081678901234', 'Jl. Pahlawan No. 8, Surabaya'),
('260716010106', 'Farida Utami', '3578066504970006', '1997-04-25', 'w', '081789012345', 'Jl. Melati No. 30, Malang'),
('260716010107', 'Guntur Wibowo', '3374071010920007', '1992-10-10', 'p', '081890123456', 'Jl. Gajah Mada No. 12, Semarang'),
('260716010108', 'Hany Handayani', '3374085112960008', '1996-12-11', 'w', '081901234567', 'Jl. Kenanga No. 7, Surakarta'),
('260716010109', 'Irfan Hakim', '3471090505930009', '1993-05-05', 'p', '082112345678', 'Jl. Malioboro No. 50, Yogyakarta'),
('260716010110', 'Joko Widodo', '1271101708850010', '1985-08-17', 'p', '082223456789', 'Jl. Sisingamangaraja No. 88, Medan'),
('260716010111', 'Kartika Sari', '1271114909990011', '1999-09-09', 'w', '082334567890', 'Jl. Gatot Subroto No. 14, Deli Serdang'),
('260716010112', 'Lukman Hakim', '6472120303910012', '1991-03-03', 'p', '085245678901', 'Jl. Mulawarman No. 21, Samarinda'),
('260716010113', 'Megaawati Putri', '7371136102950013', '1995-02-21', 'w', '085356789012', 'Jl. Sultan Hasanuddin No. 5, Makassar'),
('260716010114', 'Naufal Rizqi', '5171142512960014', '1996-12-25', 'p', '085667890123', 'Jl. Ngurah Rai No. 9, Denpasar'),
('260716010115', 'Olivia Putri', '1471154407940015', '1994-07-04', 'w', '085778901234', 'Jl. Jenderal Sudirman No. 40, Pekanbaru'),
('260716010116', 'Putra Perkasa', '1671161811900016', '1990-11-18', 'p', '085889012345', 'Jl. Ampera No. 11, Palembang'),
('260716010117', 'Qori Qoriah', '1871175204930017', '1993-04-12', 'w', '087790123456', 'Jl. Raden Intan No. 67, Bandar Lampung'),
('260716010118', 'Rian Hidayat', '6371180901920018', '1992-01-09', 'p', '087801234567', 'Jl. Ahmad Yani No. 3, Banjarmasin'),
('260716010119', 'Sinta Bella', '3171196106970019', '1997-06-21', 'w', '089512345678', 'Jl. Hayam Wuruk No. 89, Jakarta Pusat'),
('260716010120', 'Taufik Hidayat', '3273202410910020', '1991-10-24', 'p', '089623456789', 'Jl. Asia Afrika No. 100, Bandung'),
('260716011424', 'sandika gali', '3171010101953432', '2026-07-11', 'p', '085746378275', 'kecamatan medan timur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rekamedis`
--

CREATE TABLE `tbl_rekamedis` (
  `no_rm` varchar(17) NOT NULL,
  `tgl_rm` date NOT NULL,
  `id_pasien` varchar(20) DEFAULT NULL,
  `keluhan` text NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `diagnosa` text NOT NULL,
  `obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_rekamedis`
--

INSERT INTO `tbl_rekamedis` (`no_rm`, `tgl_rm`, `id_pasien`, `keluhan`, `id_dokter`, `diagnosa`, `obat`) VALUES
('RM-001-160726', '2026-07-16', '260716010101', 'sakit demam', 161, 'types', 'Ranitidine, Lactulose Sirup');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `jabatan` enum('1','2','3') NOT NULL COMMENT '1=administrator,\r\n2=petugas, 3=dokter',
  `alamat` varchar(200) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `jabatan`, `alamat`, `gambar`) VALUES
(154, 'admin', 'admin', '$2a$12$U1aTW6/rGzEZ3oOJLTmT7.cz4AzdwlPK753ssULrLonEp3gS89DjC', '1', 'medan', '1782898626-images.jpeg'),
(161, 'andika', 'andika pratama', '$2y$10$1gb/ft.Xt0CqV0SXY85qLeO8.hyoznqs/52aADIMDxsqx7dfCegBm', '3', 'medan brayan', '1783351441-kali-hack.jpg'),
(163, 'dokter2', 'dokter2', '$2y$10$vT.aZLFkZB0.lU20ZL9CteQlYNr0RESjGgCiDvQPMApZSxPEZ5lNu', '3', 'medan', '1784211698-images.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_rekamedis`
--
ALTER TABLE `tbl_rekamedis`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `tbl_rekamedis_ibfk_1` (`id_pasien`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_obat`
--
ALTER TABLE `tbl_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_rekamedis`
--
ALTER TABLE `tbl_rekamedis`
  ADD CONSTRAINT `tbl_rekamedis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tbl_pasien` (`id`),
  ADD CONSTRAINT `tbl_rekamedis_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `tbl_user` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
