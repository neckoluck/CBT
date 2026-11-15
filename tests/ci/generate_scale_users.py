#!/usr/bin/env python3
"""Generate synthetic CI user rows 2..N, default seed_login.sql creates user #1.
This program never reads production or historical CBT data.
"""
import sys
count = int(sys.argv[1])
if not 2 <= count <= 500:
    raise SystemExit('CI scale-up user count must be 2..500')
participants=[]
associations=[]
for i in range(2,count+1):
    username = f'9{i:09d}'   # 10 characters, compatible with tb_peserta.no_pendaftaran
    nik = f'8{i:015d}'
    participants.append('(' + ','.join([
       str(i),'1','1',f"'{nik}'",f"'{i:010d}'",f"'{username}'",
       f"'CI Synthetic Participant {i}'",f"'ci-synthetic-{i}'", "'l'","'0000000000'",
       "'CBTTestOnly2026'",'NULL','NULL','NULL','0','4','0','0']) + ')')
    associations.append(f'({i},{i},1,1,1)')
print('INSERT INTO tb_peserta (id_peserta,id_bidang,id_ruangan_sesi,nik_peserta,nisn_peserta,no_pendaftaran,nama_peserta,slug_nama_peserta,jk_peserta,no_telp_peserta,kata_sandi,ip_kom,mulai_ujian,selesai_ujian,sisa_waktu,status_peserta,status_sess,status_data) VALUES')
print(',\n'.join(participants)+';')
print('INSERT INTO tb_has_peserta (id_has_peserta,id_peserta,id_poltek,id_prodi,status_has_peserta) VALUES')
print(',\n'.join(associations)+';')
print(f'UPDATE tb_ruangan SET kapasitas={count} WHERE id_ruangan=1;')
print(f'UPDATE tb_ruangan_sesi SET jumlah_peserta={count} WHERE id_ruangan_sesi=1;')
