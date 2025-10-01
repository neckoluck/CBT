<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;
use App\Models\SettModel;

class RekapanModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->settMod = new SettModel;
    }

    public function getResult($tabel)
    {
        if (in_array($tabel, ['tb_prodi'])) :
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

    public function getJoin($bind = '', $params = '')
    {
        $benar = $this->settMod->sett()['bobot_1'];
        $salah = $this->settMod->sett()['bobot_2'];
    	/**

        $sql   = "SELECT p.*, hsl.nilai FROM vw_peserta p JOIN (SELECT h.id_peserta, SUM(h.skor) nilai FROM (SELECT j.id_peserta, j.id_soal, j.jawaban, s.jawaban_benar,
                    IF(j.jawaban = s.jawaban_benar, $benar, $salah) skor FROM tb_jawaban j JOIN tb_soal s ON j.id_soal = s.id_soal
                        WHERE j.jawaban is NOT null) h GROUP by h.id_peserta) hsl ON p.id_peserta = hsl.id_peserta WHERE $bind p.status_data = 0 ORDER BY nilai DESC";
 
   		**/
    	$sql   = "SELECT * FROM vw_rekapan WHERE $bind status_data = 0";

        $query = conn()->query($sql, $params)->getResultArray();

        return $query;
    }
}
