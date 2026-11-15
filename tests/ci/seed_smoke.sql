-- Synthetic data for HTTP smoke testing ONLY.
-- No original participant/staff data and no real login accounts.
INSERT INTO `tb_komponen`
(`id_komponen`,`nama_instansi`,`url_website`,`logo_instansi`,`bobot_1`,`bobot_2`,`bobot_3`,`status_auth`)
VALUES
(1,'CI Smoke Test','http://127.0.0.1:8080/','default.png','4','-1','0',0);
