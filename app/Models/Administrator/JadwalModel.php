<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;

class JadwalModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult($tabel)
    {
        if (in_array($tabel, ['tb_jadwal'])) :
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
        $slug    = randMix(20);
        $jadwal  = date('Y') . '-' . $data['bln'] . '-' . $data['tggl'];

        $params1 = ['jadwal' => $jadwal];
        $sql1    = $this->baseMod->getBy('tb_jadwal', 'jadwal = :jadwal: AND status_data = 0', $params1);
        $count   = $this->baseMod->numRows($sql1);

        if ($count > 0) return '1-8';

        $params  = ['jadwal' => $jadwal, 'slug_jadwal' => $slug];
        $sql     = "INSERT INTO tb_jadwal VALUES ('', :jadwal:, :slug_jadwal:, 0)";
        $query   = conn()->query($sql, $params);

        $message = '1-1';
        if ($query == true) $message = '0-1';

        return $message;
    }

    public function getUpdate($data)
    {
        $pisah   = explode('-', $data['jadwal']);
        $jadwal  = $pisah[0] . '-' . $data['bln'] . '-' . $data['tggl'];

        $params1 = ['jadwal' => $jadwal, 'id_jadwal' => $data['id_jadwal']];
        $sql1    = $this->baseMod->getBy('tb_jadwal', 'id_jadwal != :id_jadwal: AND jadwal = :jadwal: AND status_data = 0', $params1);
        $count   = $this->baseMod->numRows($sql1);

        if ($count > 0) return '1-8';

        $params  = ['jadwal' => $jadwal, 'id_jadwal' => $data['id_jadwal']];
        $sql     = "UPDATE tb_jadwal SET jadwal = :jadwal: WHERE id_jadwal = :id_jadwal:";
        $query   = conn()->query($sql, $params);

        $message = '1-2';
        if ($query == true) $message = '0-2';

        return $message;
    }

    public function getDelete($data)
    {
        $params  = ['id_jadwal' => $data['id_jadwal']];
        $sql     = "UPDATE tb_jadwal SET status_data = 1 WHERE id_jadwal = :id_jadwal:";
        $query   = conn()->query($sql, $params);

        $message = '1-3';
        if ($query == true) $message = '0-3';

        return $message;
    }
}
