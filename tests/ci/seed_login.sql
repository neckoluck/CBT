-- CI-ONLY SYNTHETIC LOGIN FIXTURES. Run after schema_only.sql and seed_smoke.sql.
-- All identities and credentials below are fictitious. DO NOT import production data.
-- WARNING: Current AuthModel.php compares passwords as plaintext. These CI fixtures
-- are compatible with that legacy implementation only. Fix authentication in production.
INSERT INTO tb_bidang (id_bidang,nama_bidang,slug_nama_bidang)
VALUES (1,'CI Synthetic','ci-synthetic');

INSERT INTO tb_poltek (id_poltek,kd_poltek,nama_poltek,slug_nama_poltek,status_data)
VALUES (1,'000000','CI Test Polytechnic','ci-test-polytechnic',0);

INSERT INTO tb_prodi (id_prodi,id_bidang,nama_prodi,slug_nama_prodi,status_data)
VALUES (1,1,'CI Program','ci-program',0);

INSERT INTO tb_ruangan (id_ruangan,nama_ruangan,slug_nama_ruangan,kapasitas,status_data)
VALUES (1,'CI Test Room','ci-test-room',30,0);

INSERT INTO tb_jadwal (id_jadwal,jadwal,slug_jadwal,status_data)
VALUES (1,CURRENT_DATE(),'ci-date',0);

INSERT INTO tb_sesi (id_sesi,id_jadwal,sesi,slug_sesi,tahun_angkatan,waktu,status_data)
VALUES (1,1,1,'ci-session',YEAR(CURRENT_DATE()),'08:00:00',0);

INSERT INTO tb_kelompok_soal
(id_kelompok_soal,id_bidang,kelompok_soal,slug_kelompok_soal,tahun,jumlah_soal,durasi,status_data)
VALUES (1,1,'CI Test Group','ci-test-group',YEAR(CURRENT_DATE()),1,60,0);

INSERT INTO tb_ruangan_sesi
(id_ruangan_sesi,id_sesi,id_ruangan,id_kelompok_soal,slug_ruangan_sesi,jumlah_peserta,jumlah_hadir,mulai_ujian,selesai_ujian,pin_sesi,catatan,status_ruangan_sesi,status_data)
VALUES (1,1,1,1,'ci-room-session',1,0,'08:00:00',NULL,'123456','CI test only',1,0);

INSERT INTO tb_peserta
(id_peserta,id_bidang,id_ruangan_sesi,nik_peserta,nisn_peserta,no_pendaftaran,nama_peserta,slug_nama_peserta,jk_peserta,no_telp_peserta,kata_sandi,ip_kom,mulai_ujian,selesai_ujian,sisa_waktu,status_peserta,status_sess,status_data)
VALUES
(1,1,1,'0000000000000000','0000000000','9000000001','CI Test Participant','ci-test-participant','l','0000000000','CBTTestOnly2026',NULL,NULL,NULL,0,4,0,0);

-- vw_peserta is an INNER JOIN with tb_has_peserta and tb_bidang.
INSERT INTO tb_has_peserta
(id_has_peserta,id_peserta,id_poltek,id_prodi,status_has_peserta)
VALUES (1,1,1,1,1);

-- Verify that the database view used by AuthModel::getLogin returns a row.
SELECT COUNT(*) AS synthetic_login_records
FROM vw_peserta WHERE no_pendaftaran = '9000000001';
