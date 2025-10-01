<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;

class RuanganSesiModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult($tabel)
    {
        if (in_array($tabel, ['tb_sesi', 'tb_ruangan', 'tb_berita_acara'])) :
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
            $sql = "SELECT ruses.*, ruangan.nama_ruangan, sesi.id_jadwal, sesi.sesi, sesi.tahun_angkatan, sesi.waktu, jadwal.jadwal, kesol.id_bidang, kesol.kelompok_soal, kesol.jumlah_soal, kesol.nama_bidang FROM vw_ruangan_sesi AS ruses INNER JOIN tb_sesi AS sesi ON ruses.id_sesi = sesi.id_sesi INNER JOIN tb_jadwal AS jadwal ON sesi.id_jadwal = jadwal.id_jadwal INNER JOIN tb_ruangan AS ruangan ON ruses.id_ruangan = ruangan.id_ruangan INNER JOIN vw_kelompok_soal AS kesol ON ruses.id_kelompok_soal = kesol.id_kelompok_soal WHERE ruses.status_data = 0 $bind ORDER BY sesi.sesi ASC, ruangan.nama_ruangan ASC, jadwal.jadwal ASC, sesi.waktu ASC";

        endif;

        $query = conn()->query($sql, $params)->getResultArray();
        return $query;
    }

    public function getInsert($data)
    {
        $params = ['id_sesi' => $data['id_sesi'], 'id_ruangan' => $data['id_ruangan'], 'id_kelompok_soal' => $data['id_kelompok_soal'], 'id_pengawas' => $data['id_pengawas'], 'id_teknisi' => $data['id_teknisi']];
        $sql    = $this->baseMod->getBy('vw_ruangan_sesi', 'id_sesi = :id_sesi: AND id_ruangan = :id_ruangan: AND id_kelompok_soal = :id_kelompok_soal: AND id_pengawas = :id_pengawas: AND id_teknisi = :id_teknisi:', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count > 0) return '1-8';

        $slug    = randMix(20);
        $pin     = randNum(6);

        $params1 = ['id_sesi' => $data['id_sesi'], 'id_ruangan' => $data['id_ruangan'], 'id_kelompok_soal' => $data['id_kelompok_soal'], 'slug' => $slug, 'pin' => $pin];
        $sql1    = "INSERT INTO tb_ruangan_sesi VALUES ('', :id_sesi:, :id_ruangan:, :id_kelompok_soal:, :slug:, '', '', null, null, :pin:, '', 0, 0)";
        $query   = conn()->query($sql1, $params1);

        if ($query != true) return '1-1';

        $id_rs   = conn()->insertID();

        $prm1    = ['id_ruangan_sesi' => $id_rs, 'id_staf' => $data['id_pengawas']];
        $prm2    = ['id_ruangan_sesi' => $id_rs, 'id_staf' => $data['id_teknisi']];

        $sql2    = "INSERT INTO tb_has_ruangan_sesi VALUES ('', :id_ruangan_sesi:, :id_staf:)";
        $que1    = conn()->query($sql2, $prm1);
        $que2    = conn()->query($sql2, $prm2);

        $message = '1-1';
        if (in_array(true, [$que1, $que2])) $message = '0-1';

        return $message;
    }

    public function getUpdate($data)
    {
        if ($data['aksi'] == 'up-ruses') :

            $ruses  = $this->baseMod->getId('vw_ruangan_sesi', 'id_ruangan_sesi', $data['id_ruangan_sesi']);

            if ($data['status'] == 1) :
                $slq2   = $this->baseMod->getBy('vw_kelompok_soal', 'id_kelompok_soal = :id: AND status_data = :status:',  ['id' => $ruses['id_kelompok_soal'], 'status' => 0]);
                $kesol2 = $this->baseMod->getRow($slq2);

                $sql3   = $this->baseMod->getBy('tb_soal', 'id_kelompok_soal = :id: AND status_data = 0', ['id' => $kesol2['id_kelompok_soal']]);
                $soal   = $this->baseMod->numRows($sql3);

                if ($soal < $kesol2['jumlah_soal']) return '1-38';

            endif;

    		$sts     = 1;
    		if ($data['status'] == 1) $sts = 0;
    
            $params1 = ['status' => $sts, 'id' => $ruses['id_pengawas']];
            $sql1    = "UPDATE tb_staf SET status_akses = :status: WHERE id_staf = :id:";
            $query1  = conn()->query($sql1, $params1);

            $params  = ['status_ruangan_sesi' => $data['status'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql     = "UPDATE tb_ruangan_sesi SET status_ruangan_sesi = :status_ruangan_sesi: WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'up-peserta') :


            $params3  = ['id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql3     = "SELECT ruses.*, ruangan.nama_ruangan, sesi.id_jadwal, sesi.sesi, sesi.tahun_angkatan, sesi.waktu, jadwal.jadwal, kesol.id_bidang, kesol.kelompok_soal, kesol.nama_bidang FROM vw_ruangan_sesi AS ruses INNER JOIN tb_sesi AS sesi ON ruses.id_sesi = sesi.id_sesi INNER JOIN tb_jadwal AS jadwal ON sesi.id_jadwal = jadwal.id_jadwal INNER JOIN tb_ruangan AS ruangan ON ruses.id_ruangan = ruangan.id_ruangan INNER JOIN vw_kelompok_soal AS kesol ON ruses.id_kelompok_soal = kesol.id_kelompok_soal WHERE ruses.status_data = 0 AND ruses.id_ruangan_sesi = :id_ruangan_sesi:";
            $query3   = conn()->query($sql3, $params3)->getRowArray();

            $sql2     = $this->baseMod->getBy('tb_peserta', 'id_bidang = :id_bidang: AND id_ruangan_sesi = :id_ruangan_sesi: AND status_data = 0', ['id_bidang' => $data['id_bidang'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']]);

            $counts2  = $this->baseMod->numRows($sql2);

            $ruang    = $this->baseMod->getId('tb_ruangan', 'id_ruangan', $query3['id_ruangan']);

            if ($counts2 >= $ruang['kapasitas']) return '1-36';

            $sql      = $this->baseMod->getBy('tb_peserta', 'id_bidang = :id_bidang: AND id_ruangan_sesi IS NULL AND status_data = 0', ['id_bidang' => $data['id_bidang']]);
            $counts   = $this->baseMod->numRows($sql);

            if ($data['jumlah_peserta'] > $counts) return '1-33';

            $query    = $this->baseMod->getRows($sql);

            $bool   = [];
            foreach ($query as $peserta) :

                $params1 = ['id_ruangan_sesi' => $data['id_ruangan_sesi'], 'id_peserta' => $peserta['id_peserta']];
                $sql1    = "UPDATE tb_peserta SET id_ruangan_sesi = :id_ruangan_sesi: WHERE id_peserta = :id_peserta:";
                $query1  = conn()->query($sql1, $params1);
                $bool[]  = $query1;

            endforeach;

            $message = '1-1';
            if (in_array(true, $bool)) $message = '0-1';

            return $message;

        elseif ($data['aksi'] == 'up-reset') :
            $currentBind = "";
            $arry        = ['status_sess' => 0];
            if (!empty($data['reset-sw'])) :
                $endbind = 'status_sess = :status_sess:';

            else :
                $endbind = 'status_peserta = 4, status_sess = :status_sess:';

            endif;

            $arry1       = [];
            if (!empty($data['reset-ip'])) :
                $arry1        = ['ip_kom' => null];
                $currentBind .= 'ip_kom = :ip_kom:, ';

            endif;

            $arry2       = [];
            if (!empty($data['reset-sw'])) :
                $arry2        = ['selesai_ujian' => null, 'status_peserta' => 4];
                $currentBind .= 'selesai_ujian = :selesai_ujian:, status_peserta = :status_peserta:, ';

            endif;

            $params = array_merge($arry1, $arry2, $arry);

            $sql    = "UPDATE tb_peserta SET $currentBind $endbind WHERE id_peserta = " . $data['id_peserta'];
            $query  = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;
    
       	elseif ($data['aksi'] == 'up-restore') :

            $params  = ['status_peserta' => 0];
            $sql     = "UPDATE tb_peserta SET status_peserta = :status_peserta: WHERE id_peserta = " . $data['id_peserta'];
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'up-lock') :
            $sql1    = $this->baseMod->getBy('tb_staf', 'id_staf = :id_pengawas: AND status_data = 0', ['id_pengawas' => $data['id_pengawas']]);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 < 1) return '1-0';

            $params2 = ['id_pengawas' => $data['id_pengawas']];
            $sql2    = "UPDATE tb_staf SET status_akses = 1 WHERE id_staf = :id_pengawas:";
            $query2  = conn()->query($sql2, $params2);

            $sql3    = $this->baseMod->getBy('tb_peserta', 'id_ruangan_sesi = :id_ruangan_sesi: AND status_data = 0', ['id_ruangan_sesi' => $data['id_ruangan_sesi']]);
            $query3  = $this->baseMod->getRows($sql3);

            foreach ($query3 as $pikut) :

                $status  = 5;
                $suji    = null;

                if ($pikut['status_peserta'] > 0) :
                    $status  = 3;
                    $suji    = $data['waktu_selesai'];

                endif;

                $params4 = ['ip_kom' => null, 'selesai_ujian' => $suji, 'status_peserta' => $status, 'status_sess' => 0, 'id_peserta' => $pikut['id_peserta'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
                $sql4    = "UPDATE tb_peserta SET ip_kom = :ip_kom:, selesai_ujian = :selesai_ujian:, status_peserta = :status_peserta:, status_sess = :status_sess: WHERE id_peserta = :id_peserta: AND id_ruangan_sesi = :id_ruangan_sesi:";

                conn()->query($sql4, $params4);

            endforeach;

            $params6 = ['id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql6    = $this->baseMod->getBy('tb_ruangan_sesi', 'id_ruangan_sesi = :id_ruangan_sesi: AND status_data = 0', $params6);
            $query6  = $this->baseMod->getRow($sql6);

            $wseles  = $query6['selesai_ujian'];
            if (is_null($query6['selesai_ujian'])) $wseles = $data['waktu_selesai'];

            $params5 = ['selesai_ujian' => $wseles, 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql5    = "UPDATE tb_ruangan_sesi SET selesai_ujian = :selesai_ujian:, status_ruangan_sesi = 2 WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query5  = conn()->query($sql5, $params5);

            $message = '1-2';
            if ($query2 == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'up-unlock') :
            $sql1    = $this->baseMod->getBy('tb_staf', 'id_staf = :id_pengawas: AND status_data = 0', ['id_pengawas' => $data['id_pengawas']]);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 < 1) return '1-0';

            $params2 = ['id_pengawas' => $data['id_pengawas']];
            $sql2    = "UPDATE tb_staf SET status_akses = 0 WHERE id_staf = :id_pengawas:";
            $query2  = conn()->query($sql2, $params2);

            $params5 = ['id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql5    = "UPDATE tb_ruangan_sesi SET status_ruangan_sesi = 1 WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query5  = conn()->query($sql5, $params5);

            $message = '1-2';
            if ($query2 == true) $message = '0-2';

            return $message;

        else :

            $pengawas = $this->baseMod->getBy('tb_has_ruangan_sesi', 'id_ruangan_sesi  = :id_ruangan_sesi: AND id_staf = :id_staf:', ['id_ruangan_sesi' => $data['id_ruangan_sesi'], 'id_staf' => $data['idpengawas']]);
            $pngws    = $this->baseMod->getRow($pengawas);

            $prm1     = ['id_staf' => $data['id_pengawas'], 'id_has_ruangan_sesi' => $pngws['id_has_ruangan_sesi']];

            $teknisi  = $this->baseMod->getBy('tb_has_ruangan_sesi', 'id_ruangan_sesi  = :id_ruangan_sesi: AND id_staf = :id_staf:', ['id_ruangan_sesi' => $data['id_ruangan_sesi'], 'id_staf' => $data['idteknisi']]);
            $tknsi    = $this->baseMod->getRow($teknisi);
            $prm2     = ['id_staf' => $data['id_teknisi'], 'id_has_ruangan_sesi' => $tknsi['id_has_ruangan_sesi']];

            $params   = ['id_sesi' => $data['id_sesi'], 'id_ruangan' => $data['id_ruangan'], 'id_kelompok_soal' => $data['id_kelompok_soal'], 'id_pengawas' => $data['id_pengawas'], 'id_teknisi' => $data['id_teknisi'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql      = $this->baseMod->getBy('vw_ruangan_sesi', 'id_ruangan_sesi != :id_ruangan_sesi: AND id_sesi = :id_sesi: AND id_kelompok_soal = :id_kelompok_soal: AND id_ruangan = :id_ruangan: AND id_pengawas = :id_pengawas: AND id_teknisi = :id_teknisi:', $params);
            $count    = $this->baseMod->numRows($sql);

            if ($count > 0) return '1-8';

            $params1  = ['id_sesi' => $data['id_sesi'], 'id_ruangan' => $data['id_ruangan'], 'id_kelompok_soal' => $data['id_kelompok_soal'], 'id_ruangan_sesi' => $data['id_ruangan_sesi']];
            $sql1     = "UPDATE tb_ruangan_sesi SET id_sesi = :id_sesi:, id_ruangan = :id_ruangan:, id_kelompok_soal = :id_kelompok_soal: WHERE id_ruangan_sesi = :id_ruangan_sesi:";
            $query1   = conn()->query($sql1, $params1);

            $sql2     = "UPDATE tb_has_ruangan_sesi SET id_staf = :id_staf: WHERE id_has_ruangan_sesi = :id_has_ruangan_sesi:";
            $que1     = conn()->query($sql2, $prm1);
            $que2     = conn()->query($sql2, $prm2);

            $message = '1-2';
            if (in_array(true, [$query1, $que1, $que2])) $message = '0-2';

            return $message;

        endif;
    }

    public function getDelete($data)
    {
        $params  = ['id_ruangan_sesi' => $data['id_ruangan_sesi']];
        $sql     = "UPDATE tb_ruangan_sesi SET status_data = 1 WHERE id_ruangan_sesi = :id_ruangan_sesi:";
        $query   = conn()->query($sql, $params);

        $message = '1-3';
        if ($query == true) $message = '0-3';

        return $message;
    }

    public function getKick($data)
    {
        $params  = ['id_peserta' => $data['id_peserta']];
        $sql     = "UPDATE tb_peserta SET id_ruangan_sesi = null WHERE id_peserta = :id_peserta:";
        $query   = conn()->query($sql, $params);

        $message = '1-3';
        if ($query == true) $message = '0-3';

        return $message;
    }
}
