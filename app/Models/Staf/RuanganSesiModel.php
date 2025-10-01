<?php

namespace App\Models\Staf;

use CodeIgniter\Model;
use App\Models\Staf\BaseModel;
use CodeIgniter\I18n\Time;

class RuanganSesiModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->time    = new Time('now', 'Asia/Kuala_Lumpur', 'ID');
    }

    public function getBy($slug)
    {
        $params = ['slug' => $slug];
        $sql    = $this->baseMod->getBy('tb_ruangan_sesi', 'slug_ruangan_sesi = :slug: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count < 1) return '1-0';

        $sql1    = "SELECT ruses.*, ruangan.nama_ruangan, sesi.id_jadwal, sesi.sesi, sesi.tahun_angkatan, sesi.waktu, jadwal.jadwal FROM vw_ruangan_sesi AS ruses INNER JOIN tb_sesi AS sesi ON ruses.id_sesi = sesi.id_sesi INNER JOIN tb_jadwal AS jadwal ON sesi.id_jadwal = jadwal.id_jadwal INNER JOIN tb_ruangan AS ruangan ON ruses.id_ruangan = ruangan.id_ruangan WHERE slug_ruangan_sesi = :slug: AND ruses.status_data = 0";

        $query   = conn()->query($sql1, $params)->getRowArray();
        return $query;
    }

    public function getJoin(int $int = 1, $bind = '', $params = [])
    {
        if ($int == 1) :
            if ($bind !== '') $bind = "AND $bind";
            $sql = "SELECT sesi.*, jadwal.jadwal, jadwal.status_data FROM tb_sesi AS sesi INNER JOIN tb_jadwal AS jadwal ON sesi.id_jadwal = jadwal.id_jadwal WHERE sesi.status_data = 0 AND jadwal.status_data = 0 $bind";

        else :
            if ($bind !== '') $bind = "AND $bind";
            $sql = "SELECT ruses.*, ruangan.nama_ruangan, sesi.id_jadwal, sesi.sesi, sesi.tahun_angkatan, sesi.waktu, jadwal.jadwal, kesol.kelompok_soal, kesol.nama_bidang FROM vw_ruangan_sesi AS ruses INNER JOIN tb_sesi AS sesi ON ruses.id_sesi = sesi.id_sesi INNER JOIN tb_jadwal AS jadwal ON sesi.id_jadwal = jadwal.id_jadwal INNER JOIN tb_ruangan AS ruangan ON ruses.id_ruangan = ruangan.id_ruangan INNER JOIN vw_kelompok_soal AS kesol ON ruses.id_kelompok_soal = kesol.id_kelompok_soal WHERE ruses.status_data = 0 $bind ORDER BY jadwal.jadwal ASC, sesi.waktu ASC";

        endif;

        $query = conn()->query($sql, $params)->getResultArray();
        return $query;
    }

    public function getUpdate($data)
    {
        if ($data['aksi'] == 'up-ruses') :
            $params  = ['status_ruangan_sesi' => $data['status'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql     = "UPDATE tb_ruangan_sesi SET status_ruangan_sesi = :status_ruangan_sesi: WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'up-wmulai') :

            $params = ['mulai_ujian' => $data['waktu_mulai'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];

            $sql    = "UPDATE tb_ruangan_sesi SET mulai_ujian = :mulai_ujian: WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query  = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'up-wselesai') :

            $params = ['selesai_ujian' => $data['waktu_selesai'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];

            $sql    = "UPDATE tb_ruangan_sesi SET selesai_ujian = :selesai_ujian: WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query  = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'up-catatan') :

            $params = ['catatan' => $data['catatan'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];

            $sql    = "UPDATE tb_ruangan_sesi SET catatan = :catatan: WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query  = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        else :
            $params = ['id_sesi' => $data['id_sesi'], 'id_ruangan' => $data['id_ruangan'], 'id_pengawas' => $data['id_pengawas'], 'id_teknisi' => $data['id_teknisi'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql    = $this->baseMod->getBy('vw_ruangan_sesi', 'id_ruangan_sesi != :id_ruangan_sesi: AND id_sesi = :id_sesi: AND id_ruangan = :id_ruangan: AND id_pengawas = :id_pengawas: AND id_teknisi = :id_teknisi:', $params);
            $count  = $this->baseMod->numRows($sql);

            if ($count > 0) return '1-8';

            $params1  = ['id_sesi' => $data['id_sesi'], 'id_ruangan' => $data['id_ruangan'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql1     = "UPDATE tb_ruangan_sesi SET id_sesi = :id_sesi:, id_ruangan = :id_ruangan: WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query1   = conn()->query($sql1, $params1);

            $pengawas = $this->baseMod->getId('tb_has_ruangan_sesi', 'id_staf', $data['idpengawas']);
            $prm1     = ['id_staf' => $data['id_pengawas'], 'id_has_ruangan_sesi' => $pengawas['id_has_ruangan_sesi']];

            $teknisi  = $this->baseMod->getId('tb_has_ruangan_sesi', 'id_staf', $data['idteknisi']);
            $prm2     = ['id_staf' => $data['id_teknisi'], 'id_has_ruangan_sesi' => $teknisi['id_has_ruangan_sesi']];

            $sql2     = "UPDATE tb_has_ruangan_sesi SET id_staf = :id_staf: WHERE id_has_ruangan_sesi = :id_has_ruangan_sesi:";
            $que1     = conn()->query($sql2, $prm1);
            $que2     = conn()->query($sql2, $prm2);

            $message = '1-2';
            if (in_array(true, [$query1, $que1, $que2])) $message = '0-2';

            return $message;

        endif;
    }

    public function getAccess($data)
    {
        if ($data['aksi'] == 'up-disconnect') :

            $peserta = $this->baseMod->getId('tb_peserta', 'id_peserta', $data['id_peserta']);
            if ($peserta['status_peserta'] == 4) return '1-40';

            $array1 = ['sts' => $data['status'], 'id' => $data['id_peserta']];
            $params = $array1;
            $time   = $this->time->toTimeString();
            $bind   = "status_peserta = :sts:, status_sess = 0";

            if ($data['status'] == 3) :
                $array2 = ['ip_kom' => null, 'selesai' => $time];
                $bind   = 'ip_kom = :ip_kom:, selesai_ujian = :selesai:, ' . $bind;

                $params = array_merge($array1, $array2);

            endif;

            $sql    = "UPDATE tb_peserta SET $bind WHERE id_peserta = :id:";
            $query  = conn()->query($sql, $params);

        else :

            $peserta = $this->baseMod->getId('tb_peserta', 'id_peserta', $data['id_peserta']);
            if ($peserta['status_sess'] != 0) return '1-39';

            $params  = ['id' => $data['id_peserta']];
            $sql     = "UPDATE tb_peserta SET ip_kom = null, status_peserta = 4 WHERE id_peserta = :id:";
            $query   = conn()->query($sql, $params);

        endif;

        $message = '1-2';
        if ($query != false) $message = '0-2';

        return $message;
    }

    public function getInsert($data)
    {
        $param1 = ['id_peserta' => $data['id_peserta']];
        $sql1   = $this->baseMod->getBy('tb_baup', 'id_peserta = :id_peserta:', $param1);
        $count1 = $this->baseMod->numRows($sql1);

        if ($count1 > 0) :
            $sql2   = "DELETE FROM tb_baup WHERE id_peserta = :id_peserta:";
            conn()->query($sql2, $param1);

        endif;

        $query  = [];
        foreach ($data['baup'] as $baup) :
            $params  = ['id_peserta' => $data['id_peserta'], 'id_pengawas' => $data['id_pengawas'], 'id_ba' => $baup];
            $sql     = "INSERT INTO tb_baup VALUES ('', :id_ba:, :id_peserta:, :id_pengawas:)";
            $query[] = conn()->query($sql, $params);

        endforeach;

        $message = '1-1';
        if (in_array(true, $query)) $message = '0-1';

        return $message;
    }
}
