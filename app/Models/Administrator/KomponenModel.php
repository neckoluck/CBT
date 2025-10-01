<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;

class KomponenModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult($tabel)
    {
        if (in_array($tabel, ['tb_ruangan', 'vw_prodi', 'vw_mata_uji', 'tb_berita_acara', 'tb_poltek'])) :
            $params = ['status_data' => 0];
            $bind   = 'WHERE status_data = :status_data:';

        else :
            $params = '';
            $bind   = '';

            if ($tabel == 'vw_kelompok_soal') :
                $bind  = 'WHERE status_data = 0 ORDER BY kelompok_soal ASC';

            endif;

        endif;

        $sql    = "SELECT * FROM $tabel $bind";
        $query  = conn()->query($sql, $params)->getResultArray();

        return $query;
    }

    public function getInsert($data)
    {
        if ($data['aksi'] == 'act-ruangan') :
            $params1 = ['nama_ruangan' => $data['ruangan']];
            $sql1    = $this->baseMod->getBy('tb_ruangan', 'nama_ruangan = :nama_ruangan: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-21';

            $params = ['nama_ruangan' => $data['ruangan'], 'slug_nama_ruangan' => slug($data['ruangan']), 'kapasitas' => $data['kapasitas']];
            $sql    = "INSERT INTO tb_ruangan VALUES ('', :nama_ruangan:, :slug_nama_ruangan:, :kapasitas:, 0)";
            $query  = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'act-berita') :
            $params1 = ['berita_acara' => $data['berita_acara']];
            $sql1    = $this->baseMod->getBy('tb_berita_acara', 'berita_acara = :berita_acara: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-8';

            $params = ['berita_acara' => $data['berita_acara'], 'slug_berita_acara' => randMix(20)];
            $sql    = "INSERT INTO tb_berita_acara VALUES ('', :berita_acara:, :slug_berita_acara:, 0)";
            $query  = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'act-poli') :
            $params1 = ['kd_poltek' => $data['kd_poltek'], 'nama_poltek' => $data['nama_poltek']];
            $sql1    = $this->baseMod->getBy('tb_poltek', 'kd_poltek = :kd_poltek: AND nama_poltek = :nama_poltek: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-8';

            $params = ['kd_poltek' => $data['kd_poltek'], 'nama_poltek' => $data['nama_poltek'], 'slug_nama_poltek' => slug($data['nama_poltek'])];
            $sql    = "INSERT INTO tb_poltek VALUES ('', :kd_poltek:, :nama_poltek:, :slug_nama_poltek:, 0)";
            $query  = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'act-prodi') :
            $params1 = ['id_bidang' => $data['id_bidang'], 'nama_prodi' => $data['prodi']];
            $sql1    = $this->baseMod->getBy('tb_prodi', 'id_bidang = :id_bidang: AND nama_prodi = :nama_prodi: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-22';

            $params = ['id_bidang' => $data['id_bidang'], 'nama_prodi' => $data['prodi'], 'slug_nama_prodi' => randMix(20)];
            $sql    = "INSERT INTO tb_prodi VALUES ('', :id_bidang:, :nama_prodi:, :slug_nama_prodi:, 0)";
            $query  = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'act-matauji') :
            $params1 = ['id_bidang' => $data['id_bidang'], 'mata_uji' => $data['mata_uji']];
            $sql1    = $this->baseMod->getBy('tb_mata_uji', 'id_bidang = :id_bidang: AND mata_uji = :mata_uji: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 > 0) return '1-20';

            $params  = ['id_bidang' => $data['id_bidang'], 'mata_uji' => $data['mata_uji'], 'slug_mata_uji' => randMix(20)];
            $sql     = "INSERT INTO tb_mata_uji VALUES ('', :id_bidang:, :mata_uji:, :slug_mata_uji:, 0)";
            $query   = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'act-kelompoksoal') :

            $kesol   = $data['abjad'] . '-' . $data['number'];
            $params1 = ['kelompok_soal' => $kesol];
            $sql1    = $this->baseMod->getBy('tb_kelompok_soal', 'kelompok_soal = :kelompok_soal: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 > 0) return '1-19';

            $params  = ['id_bidang' => $data['idbidang'], 'kelompok_soal' => $kesol, 'slug_kelompok_soal' => randMix(20), 'tahun' => $data['tahun'], 'jumlah_soal' => $data['jumlah_soal'], 'durasi' => $data['durasi']];
            $sql     = "INSERT INTO tb_kelompok_soal VALUES ('', :id_bidang:, :kelompok_soal:, :slug_kelompok_soal:, :tahun:, :jumlah_soal:, :durasi:, 0)";
            $query   = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        else :
            return '1-0';

        endif;
    }

    public function getUpdate($data)
    {
        if ($data['aksi'] == 'act-umum') :

            $file = $data['namaFile'];

            if ($file->getError() == 4) :
                $namaFile = $data['sett']['logo_instansi'];

            else :
                if ($data['sett']['logo_instansi'] !== 'default.jpg') unlink('uploads/pic-other/' . $data['sett']['logo_instansi']);
                $namaFile = $file->getRandomName();
                $file->move('uploads/pic-other/', $namaFile);

            endif;

            $params  = ['nama_instansi' => $data['nama_instansi'], 'url_website' => $data['url_website'], 'logo_instansi' => $namaFile, 'id_komponen' => $data['sett']['id_komponen']];
            $sql     = "UPDATE tb_komponen SET nama_instansi = :nama_instansi:, url_website = :url_website:, logo_instansi = :logo_instansi: WHERE id_komponen = :id_komponen:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'act-ruangan') :

            $params1 = ['nama_ruangan' => $data['ruangan'], 'id_ruangan' => $data['id_ruangan']];
            $sql1    = $this->baseMod->getBy('tb_ruangan', 'id_ruangan != :id_ruangan: AND nama_ruangan = :nama_ruangan: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-21';

            $params  = ['nama_ruangan' => $data['ruangan'], 'slug_nama_ruangan' => slug($data['ruangan']), 'kapasitas' => $data['kapasitas'], 'id_ruangan' => $data['id_ruangan']];
            $sql     = "UPDATE tb_ruangan SET nama_ruangan = :nama_ruangan:, slug_nama_ruangan = :slug_nama_ruangan:, kapasitas = :kapasitas: WHERE id_ruangan = :id_ruangan:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'act-berita') :

            $params1 = ['berita_acara' => $data['berita_acara'], 'id_berita_acara' => $data['id_berita_acara']];
            $sql1    = $this->baseMod->getBy('tb_berita_acara', 'id_berita_acara != :id_berita_acara: AND berita_acara = :berita_acara: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-8';

            $params  = ['berita_acara' => $data['berita_acara'], 'id_berita_acara' => $data['id_berita_acara']];
            $sql     = "UPDATE tb_berita_acara SET berita_acara = :berita_acara: WHERE id_berita_acara = :id_berita_acara:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'act-poli') :
            $params1 = ['kd_poltek' => $data['kd_poltek'], 'nama_poltek' => $data['nama_poltek'], 'id_poltek' => $data['id_poltek']];
            $sql1    = $this->baseMod->getBy('tb_poltek', 'id_poltek != :id_poltek: AND kd_poltek = :kd_poltek: AND nama_poltek = :nama_poltek: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-8';

            $params  = ['kd_poltek' => $data['kd_poltek'], 'nama_poltek' => $data['nama_poltek'], 'id_poltek' => $data['id_poltek']];
            $sql     = "UPDATE tb_poltek SET kd_poltek = :kd_poltek:, nama_poltek = :nama_poltek: WHERE id_poltek = :id_poltek:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'act-prodi') :
            $params1 = ['id_bidang' => $data['id_bidang'], 'nama_prodi' => $data['prodi'], 'id_prodi' => $data['id_prodi']];
            $sql1    = $this->baseMod->getBy('tb_prodi', 'id_prodi != :id_prodi: AND id_bidang = :id_bidang: AND nama_prodi = :nama_prodi: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1) return '1-22';

            $params = ['id_bidang' => $data['id_bidang'], 'prodi' => $data['prodi'], 'slug_nama_prodi' => slug($data['prodi']), 'id_prodi' => $data['id_prodi']];
            $sql    = "UPDATE tb_prodi SET id_bidang = :id_bidang:, nama_prodi = :prodi:, slug_nama_prodi = :slug_nama_prodi: WHERE id_prodi = :id_prodi:";
            $query  = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'act-matauji') :

            $params1 = ['id_bidang' => $data['id_bidang'], 'mata_uji' => $data['mata_uji'], 'id_mata_uji' => $data['id_mata_uji']];
            $sql1    = $this->baseMod->getBy('tb_mata_uji', 'id_mata_uji != :id_mata_uji: AND id_bidang = :id_bidang: AND mata_uji = :mata_uji: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 > 0) return '1-20';

            $params  = ['id_bidang' => $data['id_bidang'], 'mata_uji' => $data['mata_uji'], 'id_mata_uji' => $data['id_mata_uji']];
            $sql     = "UPDATE tb_mata_uji SET id_bidang = :id_bidang:, mata_uji = :mata_uji: WHERE id_mata_uji = :id_mata_uji:";
            $query   = conn()->query($sql, $params);
            $message = '1-2';

            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'act-kelompoksoal') :
            $kesol   = $data['abjad'] . '-' . $data['number'];
            $params1 = ['kelompok_soal' => $kesol, 'id_kelompok_soal' => $data['id_kelompok_soal']];
            $sql1    = $this->baseMod->getBy('tb_kelompok_soal', 'kelompok_soal = :kelompok_soal: AND id_kelompok_soal != :id_kelompok_soal: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 > 0) return '1-19';

            $params  = ['id_bidang' => $data['idbidang'], 'kelompok_soal' => $kesol, 'tahun' => $data['tahun'], 'jumlah_soal' => $data['jumlah_soal'], 'durasi' => $data['durasi'], 'id_kelompok_soal' => $data['id_kelompok_soal']];
            $sql     = "UPDATE tb_kelompok_soal SET id_bidang = :id_bidang:, kelompok_soal = :kelompok_soal:, tahun = :tahun:, jumlah_soal = :jumlah_soal:, durasi = :durasi: WHERE id_kelompok_soal = :id_kelompok_soal:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        else :
            return '1-0';

        endif;
    }


    public function getDelete($data)
    {
        if ($data['aksi'] == 'act-ruangan') :
            $params  = ['id_ruangan' => $data['id_ruangan']];
            $sql     = "UPDATE tb_ruangan SET status_data = 1 WHERE id_ruangan = :id_ruangan:";
            $query   = conn()->query($sql, $params);

            $message = '1-3';
            if ($query == true) $message = '0-3';

            return $message;

        elseif ($data['aksi'] == 'act-berita') :
            $params  = ['id_berita_acara' => $data['id_berita_acara']];
            $sql     = "UPDATE tb_berita_acara SET status_data = 1 WHERE id_berita_acara = :id_berita_acara:";
            $query   = conn()->query($sql, $params);

            $message = '1-3';
            if ($query == true) $message = '0-3';

            return $message;

        elseif ($data['aksi'] == 'act-poli') :
            $params  = ['id_poltek' => $data['id_poltek']];
            $sql     = "UPDATE tb_poltek SET status_data = 1 WHERE id_poltek = :id_poltek:";
            $query   = conn()->query($sql, $params);

            $message = '1-3';
            if ($query == true) $message = '0-3';

            return $message;

        elseif ($data['aksi'] == 'act-prodi') :
            $params  = ['id_prodi' => $data['id_prodi']];
            $sql     = "UPDATE tb_prodi SET status_data = 1 WHERE id_prodi = :id_prodi:";
            $query   = conn()->query($sql, $params);

            $message = '1-3';
            if ($query == true) $message = '0-3';

            return $message;

        elseif ($data['aksi'] == 'act-matauji') :
            $params  = ['id_mata_uji' => $data['id_mata_uji']];
            $sql     = "UPDATE tb_mata_uji SET status_data = 1 WHERE id_mata_uji = :id_mata_uji:";
            $query   = conn()->query($sql, $params);

            $message = '1-3';
            if ($query == true) $message = '0-3';

            return $message;

        elseif ($data['aksi'] == 'act-kelompoksoal') :
            $params  = ['id_kelompok_soal' => $data['id_kelompok_soal']];
            $sql     = "UPDATE tb_kelompok_soal SET status_data = 1 WHERE id_kelompok_soal = :id_kelompok_soal:";
            $query   = conn()->query($sql, $params);

            $message = '1-3';
            if ($query == true) $message = '0-3';

            return $message;

        else :
            return '1-0';

        endif;
    }
}
