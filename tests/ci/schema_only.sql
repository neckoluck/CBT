-- CBT TEST SCHEMA ONLY - GENERATED FROM USER-PROVIDED db_cbt_pnk.sql
-- This contains TABLE/INDEX/AUTO_INCREMENT/VIEW definitions only.
-- NO historical INSERT data, participant records, staff records or credentials.
-- Use only with the isolated GitHub Actions database cbt_ci.
-- Views use SQL SECURITY INVOKER instead of the old root@localhost DEFINER.
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;


-- PHYSICAL TABLES
CREATE TABLE `tb_administrator` (
  `id_administrator` int(11) NOT NULL,
  `nip_administrator` varchar(18) NOT NULL,
  `nama_administrator` varchar(80) NOT NULL,
  `slug_nama_administrator` varchar(100) NOT NULL,
  `jk_administrator` enum('l','p') NOT NULL,
  `no_telp_administrator` varchar(15) NOT NULL,
  `kata_sandi` text NOT NULL,
  `foto_administrator` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `status_akses` tinyint(1) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_baup` (
  `id_baup` mediumint(9) NOT NULL,
  `id_berita_acara` tinyint(4) NOT NULL,
  `id_peserta` mediumint(9) NOT NULL,
  `id_staf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_berita_acara` (
  `id_berita_acara` tinyint(4) NOT NULL,
  `berita_acara` varchar(150) NOT NULL,
  `slug_berita_acara` varchar(20) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_bidang` (
  `id_bidang` tinyint(4) NOT NULL,
  `nama_bidang` varchar(80) NOT NULL,
  `slug_nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_has_peserta` (
  `id_has_peserta` int(11) NOT NULL,
  `id_peserta` mediumint(9) NOT NULL,
  `id_poltek` tinyint(4) DEFAULT NULL,
  `id_prodi` tinyint(4) NOT NULL,
  `status_has_peserta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_has_ruangan_sesi` (
  `id_has_ruangan_sesi` int(11) NOT NULL,
  `id_ruangan_sesi` smallint(6) NOT NULL,
  `id_staf` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_jadwal` (
  `id_jadwal` tinyint(4) NOT NULL,
  `jadwal` date NOT NULL,
  `slug_jadwal` varchar(20) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_soal` smallint(6) NOT NULL,
  `id_peserta` mediumint(9) NOT NULL,
  `jawaban` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_kelompok_soal` (
  `id_kelompok_soal` tinyint(4) NOT NULL,
  `id_bidang` tinyint(4) NOT NULL,
  `kelompok_soal` varchar(80) NOT NULL,
  `slug_kelompok_soal` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah_soal` smallint(6) NOT NULL,
  `durasi` smallint(6) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_komponen` (
  `id_komponen` tinyint(1) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `url_website` varchar(100) NOT NULL,
  `logo_instansi` varchar(40) NOT NULL,
  `bobot_1` varchar(2) NOT NULL,
  `bobot_2` varchar(2) NOT NULL,
  `bobot_3` varchar(2) NOT NULL,
  `status_auth` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_mata_uji` (
  `id_mata_uji` smallint(6) NOT NULL,
  `id_bidang` tinyint(4) NOT NULL,
  `mata_uji` varchar(80) NOT NULL,
  `slug_mata_uji` varchar(20) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_opsi_jawaban` (
  `id_opsi_jawaban` mediumint(9) NOT NULL,
  `id_soal` mediumint(9) NOT NULL,
  `opsi` smallint(6) NOT NULL,
  `jawaban` text NOT NULL,
  `gambar` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_peserta` (
  `id_peserta` mediumint(9) NOT NULL,
  `id_bidang` tinyint(4) DEFAULT NULL,
  `id_ruangan_sesi` int(11) DEFAULT NULL,
  `nik_peserta` varchar(16) NOT NULL,
  `nisn_peserta` varchar(30) NOT NULL,
  `no_pendaftaran` varchar(10) NOT NULL,
  `nama_peserta` varchar(80) NOT NULL,
  `slug_nama_peserta` varchar(100) NOT NULL,
  `jk_peserta` enum('l','p') NOT NULL,
  `no_telp_peserta` varchar(15) NOT NULL,
  `kata_sandi` text NOT NULL,
  `ip_kom` varchar(15) DEFAULT NULL,
  `mulai_ujian` time DEFAULT NULL,
  `selesai_ujian` time DEFAULT NULL,
  `sisa_waktu` int(11) DEFAULT NULL,
  `status_peserta` tinyint(1) NOT NULL,
  `status_sess` tinyint(1) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_poltek` (
  `id_poltek` tinyint(4) NOT NULL,
  `kd_poltek` varchar(6) NOT NULL,
  `nama_poltek` varchar(80) NOT NULL,
  `slug_nama_poltek` varchar(100) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_prodi` (
  `id_prodi` tinyint(4) NOT NULL,
  `id_bidang` tinyint(4) NOT NULL,
  `nama_prodi` varchar(80) NOT NULL,
  `slug_nama_prodi` varchar(100) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(80) NOT NULL,
  `slug_nama_ruangan` varchar(100) NOT NULL,
  `kapasitas` smallint(6) NOT NULL,
  `status_data` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_ruangan_sesi` (
  `id_ruangan_sesi` int(11) NOT NULL,
  `id_sesi` smallint(6) NOT NULL,
  `id_ruangan` tinyint(4) NOT NULL,
  `id_kelompok_soal` tinyint(4) NOT NULL,
  `slug_ruangan_sesi` varchar(20) NOT NULL,
  `jumlah_peserta` smallint(6) NOT NULL,
  `jumlah_hadir` smallint(6) NOT NULL,
  `mulai_ujian` time DEFAULT NULL,
  `selesai_ujian` time DEFAULT NULL,
  `pin_sesi` varchar(6) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status_ruangan_sesi` tinyint(1) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_sesi` (
  `id_sesi` smallint(6) NOT NULL,
  `id_jadwal` tinyint(4) NOT NULL,
  `sesi` tinyint(4) NOT NULL,
  `slug_sesi` varchar(20) NOT NULL,
  `tahun_angkatan` year(4) NOT NULL,
  `waktu` time NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_soal` (
  `id_soal` smallint(6) NOT NULL,
  `id_kelompok_soal` tinyint(4) NOT NULL,
  `id_mata_uji` tinyint(4) NOT NULL,
  `slug_soal` varchar(20) NOT NULL,
  `soal_1` text NOT NULL,
  `soal_2` text NOT NULL,
  `posisi_gambar` varchar(1) NOT NULL,
  `gambar_soal` varchar(40) NOT NULL,
  `jawaban_benar` tinyint(1) NOT NULL,
  `status_soal` tinyint(1) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_staf` (
  `id_staf` int(11) NOT NULL,
  `nip_staf` varchar(18) NOT NULL,
  `nama_staf` varchar(80) NOT NULL,
  `slug_nama_staf` varchar(100) NOT NULL,
  `jk_staf` enum('l','p') NOT NULL,
  `no_telp_staf` varchar(15) NOT NULL,
  `kata_sandi` text NOT NULL,
  `foto_staf` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `status_staf` tinyint(1) NOT NULL,
  `status_akses` tinyint(1) NOT NULL,
  `status_data` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- INDEXES AND AUTO_INCREMENT
ALTER TABLE `tb_administrator`
  ADD PRIMARY KEY (`id_administrator`);

ALTER TABLE `tb_baup`
  ADD PRIMARY KEY (`id_baup`);

ALTER TABLE `tb_berita_acara`
  ADD PRIMARY KEY (`id_berita_acara`);

ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`id_bidang`);

ALTER TABLE `tb_has_peserta`
  ADD PRIMARY KEY (`id_has_peserta`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_poltek` (`id_poltek`);

ALTER TABLE `tb_has_ruangan_sesi`
  ADD PRIMARY KEY (`id_has_ruangan_sesi`),
  ADD KEY `id_ruangan_sesi` (`id_ruangan_sesi`),
  ADD KEY `id_staf` (`id_staf`);

ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

ALTER TABLE `tb_kelompok_soal`
  ADD PRIMARY KEY (`id_kelompok_soal`),
  ADD KEY `id_bidang` (`id_bidang`);

ALTER TABLE `tb_komponen`
  ADD PRIMARY KEY (`id_komponen`);

ALTER TABLE `tb_mata_uji`
  ADD PRIMARY KEY (`id_mata_uji`),
  ADD KEY `id_bidang` (`id_bidang`);

ALTER TABLE `tb_opsi_jawaban`
  ADD PRIMARY KEY (`id_opsi_jawaban`),
  ADD KEY `id_soal` (`id_soal`);

ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_ruangan_sesi` (`id_ruangan_sesi`),
  ADD KEY `id_bidang` (`id_bidang`);

ALTER TABLE `tb_poltek`
  ADD PRIMARY KEY (`id_poltek`);

ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_bidang` (`id_bidang`);

ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

ALTER TABLE `tb_ruangan_sesi`
  ADD PRIMARY KEY (`id_ruangan_sesi`),
  ADD KEY `id_sesi` (`id_sesi`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_kelompok_soal` (`id_kelompok_soal`);

ALTER TABLE `tb_sesi`
  ADD PRIMARY KEY (`id_sesi`),
  ADD KEY `id_bidang` (`id_jadwal`);

ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_kelompok_soal` (`id_kelompok_soal`),
  ADD KEY `id_mata_uji` (`id_mata_uji`);

ALTER TABLE `tb_staf`
  ADD PRIMARY KEY (`id_staf`);

ALTER TABLE `tb_administrator`
  MODIFY `id_administrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `tb_baup`
  MODIFY `id_baup` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

ALTER TABLE `tb_berita_acara`
  MODIFY `id_berita_acara` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `tb_bidang`
  MODIFY `id_bidang` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tb_has_peserta`
  MODIFY `id_has_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=886;

ALTER TABLE `tb_has_ruangan_sesi`
  MODIFY `id_has_ruangan_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

ALTER TABLE `tb_jadwal`
  MODIFY `id_jadwal` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39411;

ALTER TABLE `tb_kelompok_soal`
  MODIFY `id_kelompok_soal` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tb_komponen`
  MODIFY `id_komponen` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tb_mata_uji`
  MODIFY `id_mata_uji` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `tb_opsi_jawaban`
  MODIFY `id_opsi_jawaban` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1746;

ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=618;

ALTER TABLE `tb_poltek`
  MODIFY `id_poltek` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `tb_prodi`
  MODIFY `id_prodi` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

ALTER TABLE `tb_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `tb_ruangan_sesi`
  MODIFY `id_ruangan_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

ALTER TABLE `tb_sesi`
  MODIFY `id_sesi` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `tb_soal`
  MODIFY `id_soal` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=372;

ALTER TABLE `tb_staf`
  MODIFY `id_staf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

-- DEPENDENCY-ORDERED VIEWS
CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_kelompok_soal`  AS SELECT `kesol`.`id_kelompok_soal` AS `id_kelompok_soal`, `kesol`.`id_bidang` AS `id_bidang`, `kesol`.`kelompok_soal` AS `kelompok_soal`, `kesol`.`slug_kelompok_soal` AS `slug_kelompok_soal`, `kesol`.`tahun` AS `tahun`, `kesol`.`jumlah_soal` AS `jumlah_soal`, `kesol`.`durasi` AS `durasi`, `kesol`.`status_data` AS `status_data`, `bidang`.`nama_bidang` AS `nama_bidang`, `bidang`.`slug_nama_bidang` AS `slug_nama_bidang` FROM (`tb_kelompok_soal` `kesol` join `tb_bidang` `bidang` on(`kesol`.`id_bidang` = `bidang`.`id_bidang`)) ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_mata_uji`  AS SELECT `maju`.`id_mata_uji` AS `id_mata_uji`, `maju`.`id_bidang` AS `id_bidang`, `maju`.`mata_uji` AS `mata_uji`, `maju`.`slug_mata_uji` AS `slug_mata_uji`, `maju`.`status_data` AS `status_data`, `bidang`.`nama_bidang` AS `nama_bidang`, `bidang`.`slug_nama_bidang` AS `slug_nama_bidang` FROM (`tb_mata_uji` `maju` join `tb_bidang` `bidang` on(`maju`.`id_bidang` = `bidang`.`id_bidang`)) ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_peserta`  AS SELECT `peserta`.`id_peserta` AS `id_peserta`, `peserta`.`id_bidang` AS `id_bidang`, `peserta`.`id_ruangan_sesi` AS `id_ruangan_sesi`, `peserta`.`nik_peserta` AS `nik_peserta`, `peserta`.`nisn_peserta` AS `nisn_peserta`, `peserta`.`no_pendaftaran` AS `no_pendaftaran`, `peserta`.`nama_peserta` AS `nama_peserta`, `peserta`.`slug_nama_peserta` AS `slug_nama_peserta`, `peserta`.`jk_peserta` AS `jk_peserta`, `peserta`.`no_telp_peserta` AS `no_telp_peserta`, `peserta`.`kata_sandi` AS `kata_sandi`, `peserta`.`ip_kom` AS `ip_kom`, `peserta`.`mulai_ujian` AS `mulai_ujian`, `peserta`.`selesai_ujian` AS `selesai_ujian`, `peserta`.`sisa_waktu` AS `sisa_waktu`, `peserta`.`status_peserta` AS `status_peserta`, `peserta`.`status_sess` AS `status_sess`, `peserta`.`status_data` AS `status_data`, max(case when `has`.`status_has_peserta` = 1 then `has`.`id_poltek` end) AS `poltek_pertama`, max(case when `has`.`status_has_peserta` = 1 then `has`.`id_prodi` end) AS `prodi_pertama`, max(case when `has`.`status_has_peserta` = 2 then `has`.`id_poltek` end) AS `poltek_kedua`, max(case when `has`.`status_has_peserta` = 2 then `has`.`id_prodi` end) AS `prodi_kedua`, `bidang`.`nama_bidang` AS `nama_bidang` FROM ((`tb_peserta` `peserta` join `tb_has_peserta` `has` on(`peserta`.`id_peserta` = `has`.`id_peserta`)) join `tb_bidang` `bidang` on(`peserta`.`id_bidang` = `bidang`.`id_bidang`)) GROUP BY `has`.`id_peserta` ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_prodi`  AS SELECT `prodi`.`id_prodi` AS `id_prodi`, `prodi`.`id_bidang` AS `id_bidang`, `prodi`.`nama_prodi` AS `nama_prodi`, `prodi`.`slug_nama_prodi` AS `slug_nama_prodi`, `prodi`.`status_data` AS `status_data`, `bidang`.`nama_bidang` AS `nama_bidang`, `bidang`.`slug_nama_bidang` AS `slug_nama_bidang` FROM (`tb_prodi` `prodi` join `tb_bidang` `bidang` on(`prodi`.`id_bidang` = `bidang`.`id_bidang`)) ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_ruangan_sesi`  AS SELECT `ruses`.`id_ruangan_sesi` AS `id_ruangan_sesi`, `ruses`.`id_sesi` AS `id_sesi`, `ruses`.`id_ruangan` AS `id_ruangan`, `ruses`.`id_kelompok_soal` AS `id_kelompok_soal`, `ruses`.`slug_ruangan_sesi` AS `slug_ruangan_sesi`, `ruses`.`jumlah_peserta` AS `jumlah_peserta`, `ruses`.`jumlah_hadir` AS `jumlah_hadir`, `ruses`.`mulai_ujian` AS `mulai_ujian`, `ruses`.`selesai_ujian` AS `selesai_ujian`, `ruses`.`pin_sesi` AS `pin_sesi`, `ruses`.`catatan` AS `catatan`, `ruses`.`status_ruangan_sesi` AS `status_ruangan_sesi`, `ruses`.`status_data` AS `status_data`, max(case when `staf`.`status_staf` = 1 then `staf`.`id_staf` end) AS `id_pengawas`, max(case when `staf`.`status_staf` = 2 then `staf`.`id_staf` end) AS `id_teknisi` FROM ((`tb_ruangan_sesi` `ruses` join `tb_has_ruangan_sesi` `has_ruses` on(`ruses`.`id_ruangan_sesi` = `has_ruses`.`id_ruangan_sesi`)) join `tb_staf` `staf` on(`has_ruses`.`id_staf` = `staf`.`id_staf`)) GROUP BY `ruses`.`id_ruangan_sesi` ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_soal`  AS SELECT `soal`.`id_soal` AS `id_soal`, `soal`.`id_kelompok_soal` AS `id_kelompok_soal`, `soal`.`id_mata_uji` AS `id_mata_uji`, `soal`.`slug_soal` AS `slug_soal`, `soal`.`soal_1` AS `soal_1`, `soal`.`soal_2` AS `soal_2`, `soal`.`posisi_gambar` AS `posisi_gambar`, `soal`.`gambar_soal` AS `gambar_soal`, `soal`.`jawaban_benar` AS `jawaban_benar`, `soal`.`status_soal` AS `status_soal`, `soal`.`status_data` AS `status_data`, max(case when `opsi`.`opsi` = 1 then `opsi`.`jawaban` end) AS `jawaban_1`, max(case when `opsi`.`opsi` = 2 then `opsi`.`jawaban` end) AS `jawaban_2`, max(case when `opsi`.`opsi` = 3 then `opsi`.`jawaban` end) AS `jawaban_3`, max(case when `opsi`.`opsi` = 4 then `opsi`.`jawaban` end) AS `jawaban_4`, max(case when `opsi`.`opsi` = 5 then `opsi`.`jawaban` end) AS `jawaban_5`, `kesol`.`kelompok_soal` AS `kelompok_soal`, `kesol`.`tahun` AS `tahun`, `kesol`.`nama_bidang` AS `nama_bidang_kelompok_soal`, `maju`.`mata_uji` AS `mata_uji`, `maju`.`nama_bidang` AS `nama_bidang_mata_uji` FROM (((`tb_soal` `soal` join `vw_kelompok_soal` `kesol` on(`soal`.`id_kelompok_soal` = `kesol`.`id_kelompok_soal`)) join `vw_mata_uji` `maju` on(`soal`.`id_mata_uji` = `maju`.`id_mata_uji`)) join `tb_opsi_jawaban` `opsi` on(`soal`.`id_soal` = `opsi`.`id_soal`)) GROUP BY `soal`.`id_soal` ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_jawaban`  AS SELECT `jawaban`.`id_jawaban` AS `id_jawaban`, `jawaban`.`id_soal` AS `id_soal`, `jawaban`.`id_peserta` AS `id_peserta`, `jawaban`.`jawaban` AS `jawaban`, `soal`.`id_kelompok_soal` AS `id_kelompok_soal`, `soal`.`id_mata_uji` AS `id_mata_uji`, `soal`.`slug_soal` AS `slug_soal`, `soal`.`soal_1` AS `soal_1`, `soal`.`soal_2` AS `soal_2`, `soal`.`posisi_gambar` AS `posisi_gambar`, `soal`.`gambar_soal` AS `gambar_soal`, `soal`.`jawaban_benar` AS `jawaban_benar`, `soal`.`status_soal` AS `status_soal`, `soal`.`status_data` AS `status_data`, `soal`.`kelompok_soal` AS `kelompok_soal`, `soal`.`tahun` AS `tahun`, `soal`.`nama_bidang_kelompok_soal` AS `nama_bidang_kelompok_soal`, `soal`.`mata_uji` AS `mata_uji`, `soal`.`nama_bidang_mata_uji` AS `nama_bidang_mata_uji` FROM (`tb_jawaban` `jawaban` join `vw_soal` `soal` on(`jawaban`.`id_soal` = `soal`.`id_soal`)) WHERE `soal`.`status_soal` = 1 AND `soal`.`status_data` = 0 ;

CREATE ALGORITHM=UNDEFINED SQL SECURITY INVOKER VIEW `vw_hasil`  AS SELECT `vw_jawaban`.`id_peserta` AS `id_peserta`, `vw_jawaban`.`jawaban` AS `jawaban`, `vw_jawaban`.`jawaban_benar` AS `jawaban_benar`, CASE WHEN `vw_jawaban`.`jawaban` = `vw_jawaban`.`jawaban_benar` THEN 'benar' WHEN `vw_jawaban`.`jawaban` <> `vw_jawaban`.`jawaban_benar` THEN 'salah' END AS `bobot` FROM `vw_jawaban` ;
SET FOREIGN_KEY_CHECKS=1;
