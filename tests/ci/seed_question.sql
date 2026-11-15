-- CI-ONLY SYNTHETIC EXAM DATA. Requires schema_only.sql, seed_smoke.sql, seed_login.sql.
-- Do not import historical CBT data or real participant records.
-- Synthetic active invigilator/technician enable the room/session reporting view.
INSERT INTO tb_staf
(id_staf,nip_staf,nama_staf,slug_nama_staf,jk_staf,no_telp_staf,kata_sandi,foto_staf,created_at,update_at,status_staf,status_akses,status_data)
VALUES
(1,'000000000000000001','CI Test Proctor','ci-test-proctor','l','0000000000','','default.jpg',NOW(),NOW(),1,1,0),
(2,'000000000000000002','CI Test Technician','ci-test-technician','p','0000000000','','default.jpg',NOW(),NOW(),2,1,0);

INSERT INTO tb_has_ruangan_sesi (id_has_ruangan_sesi,id_ruangan_sesi,id_staf)
VALUES (1,1,1),(2,1,2);

INSERT INTO tb_mata_uji (id_mata_uji,id_bidang,mata_uji,slug_mata_uji,status_data)
VALUES (1,1,'CI Synthetic Exam Subject','ci-subject',0);

INSERT INTO tb_soal
(id_soal,id_kelompok_soal,id_mata_uji,slug_soal,soal_1,soal_2,posisi_gambar,gambar_soal,jawaban_benar,status_soal,status_data)
VALUES
(1,1,1,'ci-question-one','<p>CI_Synthetic_Question_2026: What is 2 + 2?</p>','','','default.jpg',4,1,0);

INSERT INTO tb_opsi_jawaban
(id_opsi_jawaban,id_soal,opsi,jawaban,gambar)
VALUES
(1,1,1,'<p>1</p>','default.jpg'),
(2,1,2,'<p>2</p>','default.jpg'),
(3,1,3,'<p>3</p>','default.jpg'),
(4,1,4,'<p>4</p>','default.jpg'),
(5,1,5,'<p>5</p>','default.jpg');

-- All data above are fictional. Confirm application views resolve the question.
SELECT COUNT(*) AS ci_question_view_rows FROM vw_soal WHERE id_soal=1;
SELECT COUNT(*) AS ci_room_view_rows FROM vw_ruangan_sesi WHERE id_ruangan_sesi=1;
