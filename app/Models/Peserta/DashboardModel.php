<?php

namespace App\Models\Peserta;

use CodeIgniter\Model;
use App\Models\Peserta\BaseModel;

class DashboardModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getBy($id)
    {
        $params = ['id' => $id];
        $sql    = $this->baseMod->getBy('tb_ruangan_sesi', 'id_ruangan_sesi = :id: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count < 1) return '1-0';

        $sql1 = "SELECT ruses.*, ruangan.nama_ruangan, sesi.id_jadwal, sesi.sesi, sesi.tahun_angkatan, sesi.waktu, jadwal.jadwal, kesol.kelompok_soal, kesol.jumlah_soal, kesol.durasi, kesol.nama_bidang FROM vw_ruangan_sesi AS ruses INNER JOIN tb_sesi AS sesi ON ruses.id_sesi = sesi.id_sesi INNER JOIN tb_jadwal AS jadwal ON sesi.id_jadwal = jadwal.id_jadwal INNER JOIN tb_ruangan AS ruangan ON ruses.id_ruangan = ruangan.id_ruangan INNER JOIN vw_kelompok_soal AS kesol ON ruses.id_kelompok_soal = kesol.id_kelompok_soal WHERE id_ruangan_sesi = :id: AND ruses.status_data = 0";

        $query   = conn()->query($sql1, $params)->getRowArray();
        return $query;
    }

    public function getAccess($data)
    {
        $peserta = $this->baseMod->getId('tb_peserta', 'id_peserta', $data['id_peserta']);
        $ruses   = $this->baseMod->getId('tb_ruangan_sesi', 'id_ruangan_sesi', $peserta['id_ruangan_sesi']);

        if ($ruses['pin_sesi'] !== $data['pin_sesi']) return '1-34';

        return '0-35';
    }
}
