<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;

class SesiModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult($tabel)
    {
        if (in_array($tabel, ['tb_sesi', 'tb_jadwal'])) :
            $bind   = 'WHERE status_data = :status_data:';
            $params = ['status_data' => 0];

        else :
            $bind   = '';
            $params = '';

        endif;

        $sql    = "SELECT * FROM $tabel $bind";
        $query  = conn()->query($sql, $params)->getResultArray();

        return $query;
    }

    public function getInsert($data)
    {

        $params1 = ['sesi' => $data['sesi'], 'tahun_angkatan' => $data['tahun_angkatan'], 'id_jadwal' => $data['id_jadwal']];
        $sql1    = $this->baseMod->getBy('tb_sesi', 'sesi = :sesi: AND tahun_angkatan = :tahun_angkatan: AND id_jadwal = :id_jadwal: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 > 0) return '1-8';

        $slug    = randMix(20);
        $params  = ['id_jadwal' => $data['id_jadwal'], 'sesi' => $data['sesi'], 'slug_sesi' => $slug, 'tahun_angkatan' => $data['tahun_angkatan'], 'waktu' => $data['waktu']];
        $sql     = "INSERT INTO tb_sesi VALUES ('', :id_jadwal:, :sesi:, :slug_sesi:, :tahun_angkatan:, :waktu:, 0)";
        $query   = conn()->query($sql, $params);

        $message = '1-1';
        if ($query == true) $message = '0-1';

        return $message;
    }

    public function getUpdate($data)
    {
        $params1 = ['id_sesi' => $data['id_sesi'], 'sesi' => $data['sesi'], 'tahun_angkatan' => $data['tahun_angkatan'], 'id_jadwal' => $data['id_jadwal']];
        $sql1    = $this->baseMod->getBy('tb_sesi', 'id_sesi != :id_sesi: AND sesi = :sesi: AND tahun_angkatan = :tahun_angkatan: AND id_jadwal = :id_jadwal: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 > 0) return '1-8';

        $params = ['id_jadwal' => $data['id_jadwal'], 'sesi' => $data['sesi'], 'tahun_angkatan' => $data['tahun_angkatan'], 'waktu' => $data['waktu'], 'id_sesi' => $data['id_sesi']];

        $sql    = "UPDATE tb_sesi SET id_jadwal = :id_jadwal:, sesi = :sesi:, tahun_angkatan = :tahun_angkatan:, waktu = :waktu: WHERE id_sesi = :id_sesi:";
        $query   = conn()->query($sql, $params);

        $message = '1-2';
        if ($query == true) $message = '0-2';

        return $message;
    }

    public function getDelete($data)
    {
        $params  = ['id_sesi' => $data['id_sesi']];
        $sql     = "UPDATE tb_sesi SET status_data = 1 WHERE id_sesi = :id_sesi:";
        $query   = conn()->query($sql, $params);

        $message = '1-3';
        if ($query == true) $message = '0-3';

        return $message;
    }
}
