-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 06 Nov 2019 pada 21.50
-- Versi Server: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miss`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `photo` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `user_id`, `nama`, `kode`, `gender`, `alamat`, `hp`, `photo`, `created`, `updated`) VALUES
(3, 13, 'Indah Purnamasari', 'A', 0, 'Bangsri', '081', 0, '2019-10-26 11:39:45', '2019-10-26 11:39:45'),
(4, 14, 'Triana', 'AZ', 0, '-', '089', 0, '2019-10-26 11:40:15', '2019-10-26 11:40:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_has_mapel`
--

CREATE TABLE `guru_has_mapel` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru_has_mapel`
--

INSERT INTO `guru_has_mapel` (`id`, `id_guru`, `id_mapel`, `id_kelas`) VALUES
(3, 3, 4, 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama`) VALUES
(11, 'X AKL 1'),
(12, 'X AKL 2'),
(4, 'X BDP 1'),
(5, 'X BDP 2'),
(6, 'X OTKP 1'),
(7, 'X OTKP 2'),
(8, 'X OTKP 3'),
(1, 'X RPL 1'),
(2, 'X RPL 2'),
(9, 'X TBSM 1'),
(10, 'X TBSM 2'),
(22, 'XI AKL 1'),
(23, 'XI AKL 2'),
(15, 'XI BDP 1'),
(16, 'XI BDP 2'),
(19, 'XI OTKP 1'),
(20, 'XI OTKP 2'),
(21, 'XI OTKP 3'),
(13, 'XI RPL 1'),
(14, 'XI RPL 2'),
(17, 'XI TBSM 1'),
(18, 'XI TBSM 2'),
(31, 'XII AKL 1'),
(32, 'XII AKL 2'),
(29, 'XII BDP 1'),
(30, 'XII BDP 2'),
(24, 'XII OTKP 1'),
(25, 'XII OTKP 2'),
(26, 'XII OTKP 3'),
(27, 'XII RPL 1'),
(28, 'XII RPL 2'),
(33, 'XII TBSM 1'),
(34, 'XII TBSM 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `nama`) VALUES
(2, 'Pendidikan Agama Islam'),
(3, 'Ppkn'),
(4, 'Matematika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) NOT NULL,
  `th_ajaran_id` int(11) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `tmpt_lhr` varchar(255) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `user_id`, `kelas_id`, `th_ajaran_id`, `angkatan`, `nama`, `nis`, `nisn`, `gender`, `photo`, `tmpt_lhr`, `tgl_lhr`, `alamat`) VALUES
(6, 11, 11, 1, 1, 'Bagus Prods', '1111', '1113', 1, '-', 'jepara', '2019-10-24', 'Dermolo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `th_ajaran`
--

CREATE TABLE `th_ajaran` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `th_ajaran`
--

INSERT INTO `th_ajaran` (`id`, `title`) VALUES
(1, '2017-2018'),
(2, '2018-2019'),
(3, '2019-2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `token`, `active`, `created`, `updated`) VALUES
(1, 'root', '$2y$10$C3zyhmbvnu7vD0DS.xjJT.RMTOp4oTDEV9/7UFljdIz.bOBsX6NPG', 'iwan@gmail.com', '', 0, '2019-09-25 20:42:39', '2019-09-26 02:32:42'),
(2, 'aw', '$2y$10$C3zyhmbvnu7vD0DS.xjJT.RMTOp4oTDEV9/7UFljdIz.bOBsX6NPG', 'iwansafr@gmail.com', '', 0, '2019-09-25 22:17:18', '2019-09-25 22:17:18'),
(11, '1113', '$2y$10$mdyEO6VkQ8zwBTa2X7XTxetUuO.R7cpLeSHkhBNiaQbSfojMoX7si', '-', '', 0, '2019-10-24 22:19:51', '2019-10-24 22:20:33'),
(13, 'A', '$2y$10$mp/7rcNAAxmeTWJPZYQGdeXGdilc7ftjEwO9IHsqXZpVBjfeblj7C', '-', '', 0, '2019-10-26 11:39:45', '2019-10-26 11:39:45'),
(14, 'AZ', '$2y$10$IljZwLD2dPxdpTiuhQqiFOaXECK5XzCqgcdmOkz2CDr8TM1mkbLnq', '-', '', 0, '2019-10-26 11:40:15', '2019-10-26 11:40:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_has_role`
--

CREATE TABLE `user_has_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_has_role`
--

INSERT INTO `user_has_role` (`id`, `user_id`, `user_role_id`) VALUES
(3, 2, 3),
(36, 1, 3),
(37, 1, 1),
(38, 1, 2),
(47, 11, 4),
(49, 13, 3),
(50, 14, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `level` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `title`, `description`, `level`, `created`, `updated`) VALUES
(1, 'admin', 'user untuk admin', 1, '2019-09-25 18:53:20', '2019-09-25 18:53:20'),
(2, 'petugas', 'user untuk petugas', 2, '2019-09-25 18:54:19', '2019-09-25 19:28:51'),
(3, 'guru', 'akun untuk guru', 10, '2019-09-25 22:16:47', '2019-09-25 22:16:47'),
(4, 'siswa', 'akun untuk siswa', 15, '2019-10-08 13:10:46', '2019-10-08 13:10:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `guru_has_mapel`
--
ALTER TABLE `guru_has_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `th_ajaran_id` (`th_ajaran_id`),
  ADD KEY `angkatan` (`angkatan`);

--
-- Indexes for table `th_ajaran`
--
ALTER TABLE `th_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `guru_has_mapel`
--
ALTER TABLE `guru_has_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `th_ajaran`
--
ALTER TABLE `th_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_has_role`
--
ALTER TABLE `user_has_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`th_ajaran_id`) REFERENCES `th_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_4` FOREIGN KEY (`angkatan`) REFERENCES `th_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_has_role`
--
ALTER TABLE `user_has_role`
  ADD CONSTRAINT `user_has_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_role_ibfk_2` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
