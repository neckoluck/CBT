<?php

namespace App\Models\Peserta;

use CodeIgniter\Model;
use App\Models\Peserta\BaseModel;
use CodeIgniter\I18n\Time;

class SoalModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->time    = new Time('now', 'Asia/Kuala_Lumpur', 'ID');
    }

    public function getInsert($data)
    {
        $id      = $data['id_peserta'];
        $params1 = ['id_kelompok_soal' => $data['id_kelompok_soal']];
        $sql1    = $this->baseMod->getBy('tb_soal', "id_kelompok_soal = :id_kelompok_soal: AND status_soal = 1 AND status_data = 0 ORDER BY id_mata_uji ASC, rand($id)", $params1);
        $query1  = $this->baseMod->getRows($sql1);

        foreach ($query1 as $soal) :
            $params2 = ['id_soal' => $soal['id_soal'], 'id_peserta' => $id];
            $sql2    = "INSERT INTO tb_jawaban VALUES ('', :id_soal:, :id_peserta:, null)";

            conn()->query($sql2, $params2);

        endforeach;

        $params3 = ['id_peserta' => $id];
        $sql3    = $this->baseMod->getBy('tb_peserta', 'id_peserta = :id_peserta:', $params3);
        $peserta = $this->baseMod->getRow($sql3);

        if ($peserta['mulai_ujian'] == null) :
            $params4 = ['mulai_ujian' => $this->time->toTimeString(), 'id_peserta' => $id];
            $sql4    = "UPDATE tb_peserta SET mulai_ujian = :mulai_ujian: WHERE id_peserta = :id_peserta:";

            conn()->query($sql4, $params4);

        endif;
    }

    public function getUpdate($data)
    {
        if ($data['aksi'] == 'up-sisawaktu') :
            $params1 = ['sisa_waktu' => $data['sisa_waktu'], 'id_peserta' => $data['id_peserta']];
            $sql1    = "UPDATE tb_peserta SET sisa_waktu = :sisa_waktu:, status_peserta = 1 WHERE id_peserta = :id_peserta:";

            conn()->query($sql1, $params1);

        elseif ($data['aksi'] == 'up-jawab') :
            $pisah   = explode('-', decode($data['jawaban']));
            $params1 = ['jawaban' => current($pisah), 'id_jawaban' => end($pisah)];
            $sql1    = "UPDATE tb_jawaban SET jawaban = :jawaban: WHERE id_jawaban = :id_jawaban:";
            $query1  = conn()->query($sql1, $params1);

            return true;

        elseif ($data['aksi'] == 'up-waktuhabis') :
            $params1 = ['waktu_selesai' => $data['waktu_selesai'], 'id_peserta' => $data['id_peserta']];
            $sql1    = "UPDATE tb_peserta SET ip_kom = null, selesai_ujian = :waktu_selesai:, status_peserta = 3, status_sess = 0 WHERE id_peserta = :id_peserta:";

            conn()->query($sql1, $params1);

            return true;

        endif;
    }
}
