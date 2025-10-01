<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;
use VARIANT;

class PesertaModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult($tabel)
    {
        if (in_array($tabel, ['vw_peserta', 'vw_prodi'])) :
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
        if ($data['aksi'] == 'in-peserta') :
            $params  = ['nik_peserta' => $data['nik_peserta'], 'no_pendaftaran' => $data['no_pendaftaran']];
            $sql     = $this->baseMod->getBy('tb_peserta', 'nik_peserta = :nik_peserta: AND no_pendaftaran = :no_pendaftaran: AND status_data = 0', $params);
            $count   = $this->baseMod->numRows($sql);
            if ($count > 0) return '1-8';

            $password = password_hash($data['nik_peserta'], PASSWORD_DEFAULT);

            /* CEK BIDANG DARI 2 PRODI PILIHAN */
            $idprodi1 = intval($data['id_prodi1']);
            $idprodi2 = intval($data['id_prodi2']);

            $sql01    = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi1]);
            $prodi1   = $this->baseMod->getRow($sql01);
            $bidang1  = $prodi1['id_bidang'];

            $bidang2  = null;
            if (!empty($idprodi2)) :
                $sql02   = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi2]);
                $prodi2  = $this->baseMod->getRow($sql02);
                $bidang2 = $prodi2['id_bidang'];

            endif;

            if ($bidang1 == $bidang2 || $bidang2 == null) :
                $id_bidang = $bidang1;

            elseif ($bidang1 != $bidang2 || $bidang2 != null) :
                $sql03     = $this->baseMod->getBy('tb_bidang', 'id_bidang != :id_bidang1: AND id_bidang != :id_bidang2:', ['id_bidang1' => $bidang1, 'id_bidang2' => $bidang2]);
                $bidang    = $this->baseMod->getRow($sql03);
                $id_bidang = $bidang['id_bidang'];

            else :
                $id_bidang = null;

            endif;
            /* /CEK BIDANG DARI 2 PRODI PILIHAN */

            $params1  = ['id_bidang' => $id_bidang, 'nik_peserta' => $data['nik_peserta'], 'nisn_peserta' => $data['nisn_peserta'], 'no_pendaftaran' => $data['no_pendaftaran'], 'nama_peserta' => strtolower($data['nama_peserta']), 'slug_nama_peserta' => slug($data['nama_peserta']), 'jk_peserta' => strtolower($data['jk_peserta']), 'no_telp_peserta' => $data['no_telp_peserta'], 'kata_sandi' => $password];

            $sql1     = "INSERT INTO tb_peserta VALUES ('', :id_bidang:, null, :nik_peserta:, :nisn_peserta:, :no_pendaftaran:, :nama_peserta:, :slug_nama_peserta:, :jk_peserta:, :no_telp_peserta:, :kata_sandi:, null, null, null, null, 0, 0, 0)";
            $query1   = conn()->query($sql1, $params1);

            if ($query1 != true) return '1-1';

            $idpeserta = conn()->insertID();
            $sql2      = "INSERT INTO tb_has_peserta VALUES ('', :id_peserta:, :id_poltek:, :id_prodi:, :status:)";
            $params2   = ['id_peserta' => $idpeserta, 'id_poltek' => $data['id_poltek1'], 'id_prodi' => $idprodi1, 'status' => 1];
            $query2    = conn()->query($sql2, $params2);

            if (!empty($idprodi2) && !empty($data['id_poltek2'])) :
                $params3 = ['id_peserta' => $idpeserta, 'id_poltek' => $data['id_poltek2'], 'id_prodi' => $idprodi2, 'status' => 2];
                $query3  = conn()->query($sql2, $params3);

            endif;

            $message = '1-1';
            if (in_array(true, [$query1, $query2])) :
                $message = '0-1';

            endif;

        elseif ($data['aksi'] == 'in-import') :

            $bool = [];
            foreach ($data['peserta'] as $data) :
                $prms      = ['no_pendaftaran' => $data['no_pendaftaran'], 'nik_peserta' => $data['nik_peserta']];
                $sqls      = $this->baseMod->getBy('tb_peserta', 'no_pendaftaran = :no_pendaftaran: OR nik_peserta = :nik_peserta: AND status_data = 0', $prms);
                $counts    = $this->baseMod->numRows($sqls);

                if ($counts < 1) :
                    $nik       = clean_char($data['nik_peserta']);
                    $password  = password_hash($nik, PASSWORD_DEFAULT);

                    $idprodi1  = intval($data['id_prodi1']);
                    $idprodi2  = intval($data['id_prodi2']);

                    $sql01     = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi1]);
                    $prodi1    = $this->baseMod->getRow($sql01);
                    $bidang1   = $prodi1['id_bidang'];

                    $bidang2   = null;
                    if (!empty($idprodi2)) :
                        $sql02   = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi2]);
                        $prodi2  = $this->baseMod->getRow($sql02);
                        $bidang2 = $prodi2['id_bidang'];

                    endif;

                    if ($bidang1 == $bidang2 || $bidang2 == null) :
                        $id_bidang = $bidang1;

                    elseif ($bidang1 != $bidang2 || $bidang2 != null) :
                        $sql03     = $this->baseMod->getBy('tb_bidang', 'id_bidang != :id_bidang1: AND id_bidang != :id_bidang2:', ['id_bidang1' => $bidang1, 'id_bidang2' => $bidang2]);
                        $bidang    = $this->baseMod->getRow($sql03);
                        $id_bidang = $bidang['id_bidang'];

                    else :
                        $id_bidang = null;

                    endif;

                    $params    = [
                        'id_bidang' => $id_bidang, 'id_ruangan_sesi' => $data['id_ruangan_sesi'], 'nik_peserta' => clean_char($nik), 'nisn_peserta' => clean_char($data['nisn_peserta']), 'no_pendaftaran' => clean_char($data['no_pendaftaran']), 'nama_peserta' => strtolower($data['nama_peserta']), 'slug_nama_peserta' => slug($data['nama_peserta']), 'jk_peserta' => $data['jk_peserta'], 'no_telp_peserta' => clean_char($data['no_telp']), 'kata_sandi' => $password
                    ];

                    $sql       = "INSERT INTO tb_peserta VALUES ('', :id_bidang:, :id_ruangan_sesi:, :nik_peserta:, :nisn_peserta:, :no_pendaftaran:,:nama_peserta:, :slug_nama_peserta:, :jk_peserta:, :no_telp_peserta:, :kata_sandi:, null, null, null, null, 0, 0, 0)";
                    $query     = conn()->query($sql, $params);
                    $idpeserta = conn()->insertID();

                    if ($query != true) return '1-1';

                    $idpoltek1 = null;
                    $sql11     = $this->baseMod->getBy('tb_poltek', 'kd_poltek = :kd_poltek:', ['kd_poltek' => $data['poltek1']]);
                    $counts11  = $this->baseMod->numRows($sql11);

                    if ($counts11 > 0) :
                        $poltek1   = $this->baseMod->getRow($sql11);
                        $idpoltek1 = $poltek1['id_poltek'];

                    endif;


                    $sql1      = "INSERT INTO tb_has_peserta VALUES ('', :id_peserta:, :id_poltek:, :id_prodi:, :status:)";
                    $params1   = ['id_peserta' => $idpeserta, 'id_poltek' => clean_char($idpoltek1), 'id_prodi' => $idprodi1, 'status' => 1];
                    $query1    = conn()->query($sql1, $params1);

                    if (!empty($idprodi2) && !empty($data['poltek2'])) :

                        $idpoltek2 = null;
                        $sql12     = $this->baseMod->getBy('tb_poltek', 'kd_poltek = :kd_poltek:', ['kd_poltek' => $data['poltek2']]);
                        $counts12  = $this->baseMod->numRows($sql12);

                        if ($counts12 > 0) :
                            $poltek2   = $this->baseMod->getRow($sql12);
                            $idpoltek2 = $poltek2['id_poltek'];

                        endif;

                        $params2 = ['id_peserta' => $idpeserta, 'id_poltek' => clean_char($idpoltek2), 'id_prodi' => $idprodi2, 'status' => 2];
                        $query2  = conn()->query($sql1, $params2);

                    endif;

                    $bool[]      = $query1;

                endif;


            endforeach;

            $message = '1-1';
            if (in_array(true, $bool)) :
                $message = '0-1';

            endif;

        else :
            $message = '1-0';

        endif;

        return $message;
    }

    public function getUpdate($data)
    {
        $params   = ['id_peserta' => $data['id_peserta'], 'nik_peserta' => $data['nik_peserta'], 'no_pendaftaran' => $data['no_pendaftaran']];
        $sql      = $this->baseMod->getBy('tb_peserta', 'id_peserta != :id_peserta: AND nik_peserta = :nik_peserta: AND no_pendaftaran = :no_pendaftaran: AND status_data = 0', $params);
        $count    = $this->baseMod->numRows($sql);
        if ($count > 0) return '1-8';

        $peserta  = $this->baseMod->getId('vw_peserta', 'id_peserta', $data['id_peserta']);

        $prodiQ1  = $this->baseMod->getBy('tb_has_peserta', 'id_poltek = :id_poltek1: AND id_prodi = :id_prodi1: AND id_peserta = :id_peserta: AND status_has_peserta = 1', ['id_poltek1' => $peserta['poltek_pertama'], 'id_prodi1' => $peserta['prodi_pertama'], 'id_peserta' => $data['id_peserta']]);
        $prodi1   = $this->baseMod->getRow($prodiQ1);

        $params3  = ['id_poltek1' => $data['id_poltek1'], 'id_prodi1' => $data['id_prodi1'], 'id_has_peserta' => $prodi1['id_has_peserta']];
        $sql3     = "UPDATE tb_has_peserta SET id_poltek = :id_poltek1:, id_prodi = :id_prodi1: WHERE id_has_peserta = :id_has_peserta:";
        $query3   = conn()->query($sql3, $params3);


        if ($peserta['prodi_kedua'] != null) :
            $prodiQ2  = $this->baseMod->getBy('tb_has_peserta', 'id_poltek = :id_poltek2: AND id_prodi = :id_prodi2: AND id_peserta = :id_peserta: AND status_has_peserta = 2', ['id_poltek2' => $peserta['poltek_kedua'], 'id_prodi2' => $peserta['prodi_kedua'], 'id_peserta' => $data['id_peserta']]);
            $prodi2   = $this->baseMod->getRow($prodiQ2);

            $params4  = ['id_poltek2' => $data['id_poltek2'], 'id_prodi2' => $data['id_prodi2'], 'id_has_peserta' => $prodi2['id_has_peserta']];

            $sql4     = "UPDATE tb_has_peserta SET id_poltek = :id_poltek2:, id_prodi = :id_prodi2: WHERE id_has_peserta = :id_has_peserta:";
            $query4   = conn()->query($sql4, $params4);

        endif;

        /* CEK BIDANG DARI 2 PRODI PILIHAN */
        $idprodi1 = intval($data['id_prodi1']);
        $idprodi2 = intval($data['id_prodi2']);
        $peserta1 = $this->baseMod->getId('vw_peserta', 'id_peserta', $data['id_peserta']);

        $sql01    = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi1]);
        $prodi1   = $this->baseMod->getRow($sql01);
        $bidang1  = $prodi1['id_bidang'];
        $bidang2  = null;

        if (!empty($idprodi2)) :
            $sql02   = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi2]);
            $prodi2  = $this->baseMod->getRow($sql02);
            $bidang2 = $prodi2['id_bidang'];

        endif;

        if ($bidang1 == $bidang2 || $bidang2 == null) :
            $id_bidang = $bidang1;

        elseif ($bidang1 != $bidang2 || $bidang2 != null) :
            $sql03     = $this->baseMod->getBy('tb_bidang', 'id_bidang != :id_bidang1: AND id_bidang != :id_bidang2:', ['id_bidang1' => $bidang1, 'id_bidang2' => $bidang2]);
            $bidang    = $this->baseMod->getRow($sql03);
            $id_bidang = $bidang['id_bidang'];

        else :
            $id_bidang = null;

        endif;
        /* /CEK BIDANG DARI 2 PRODI PILIHAN */

        $password = password_hash($data['nik_peserta'], PASSWORD_DEFAULT);
        $params1  = ['id_bidang' => $id_bidang, 'nik_peserta' => $data['nik_peserta'], 'nisn_peserta' => $data['nisn_peserta'], 'no_pendaftaran' => $data['no_pendaftaran'], 'nama_peserta' => strtolower($data['nama_peserta']), 'slug_nama_peserta' => slug($data['nama_peserta']), 'jk_peserta' => strtolower($data['jk_peserta']), 'no_telp_peserta' => $data['no_telp_peserta'], 'kata_sandi' => $password, 'id_peserta' => $data['id_peserta']];


        $sql1     = "UPDATE tb_peserta SET id_bidang = :id_bidang:, nik_peserta = :nik_peserta:, nisn_peserta = :nisn_peserta:, no_pendaftaran = :no_pendaftaran:, nama_peserta = :nama_peserta:, slug_nama_peserta = :slug_nama_peserta:, jk_peserta = :jk_peserta:, no_telp_peserta = :no_telp_peserta:, kata_sandi = :kata_sandi: WHERE id_peserta = :id_peserta:";

        $query1   = conn()->query($sql1, $params1);

        $message = '1-2';
        if (in_array(true, [$query1, $query3])) $message = '0-2';

        return $message;
    }

    public function getImport($data)
    {
        $file    = $data['namaFile'];
        $ext     = $file->guessExtension();

        $rander  = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        if ($ext == 'xls') $rander  = new \PhpOffice\PhpSpreadsheet\Reader\Xls();

        /* diganti
        $sheet   = $rander->load($file);
        $data    = $sheet->getActiveSheet()->toArray();

        $peserta = [];
        foreach ($data as $d => $row) :
            if ($d == 0) :
                continue;

            endif;

            $peserta[]  = [
                'no_pendaftaran' => $row[1], 'nik_peserta' => $row[2], 'nisn_peserta' => $row[3], 'nama_peserta' => $row[4], 'jk_peserta' => $row[5], 'poltek1' => $row[6], 'id_prodi1' => $row[7], 'poltek2' => $row[8], 'id_prodi2' => $row[9], 'no_telp' => $row[10], 'id_ruangan_sesi' => $row[11]
            ];

        endforeach;
		/** /diganti **/


        /** tambahan **/
        $sheet   = $rander->load($file);
        $peserta = [];

        $i = 0;
        foreach ($sheet->getAllSheets() as $s) :

            foreach ($sheet->setActiveSheetIndex($i)->toArray() as $d => $row) :
                if ($d == 0) :
                    continue;

                endif;

                if (!in_array(null, [$row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[10], $row[11]])) :
                    $peserta[]  = [
                        'no_pendaftaran' => clean_char($row[1]), 'nik_peserta' => clean_char($row[2]), 'nisn_peserta' => clean_char($row[3]), 'nama_peserta' => $row[4], 'jk_peserta' => clean_char($row[5]), 'poltek1' => clean_char($row[6]), 'id_prodi1' => clean_char($row[7]), 'poltek2' => clean_char($row[8]), 'id_prodi2' => clean_char($row[9]), 'no_telp' => clean_char($row[10]), 'id_ruangan_sesi' => clean_char($row[11])
                    ];

                endif;

            endforeach;
            $i++;

        endforeach;
        /** /tambahan **/

        session()->set(['arrypeserta' => $peserta]);

        if (!empty(session()->get('arrypeserta'))) :
            $message = '0-41';

        else :
            $message = '1-41';

        endif;

        /* pindah 
        $bool = [];
        foreach ($peserta as $data) :
            $prms      = ['no_pendaftaran' => $data['no_pendaftaran'], 'nik_peserta' => $data['nik_peserta']];
            $sqls      = $this->baseMod->getBy('tb_peserta', 'no_pendaftaran = :no_pendaftaran: OR nik_peserta = :nik_peserta: AND status_data = 0', $prms);
            $counts    = $this->baseMod->numRows($sqls);

            if ($counts < 1) :
                $nik       = clean_char($data['nik_peserta']);
                $password  = password_hash($nik, PASSWORD_DEFAULT);

                $idprodi1  = intval($data['id_prodi1']);
                $idprodi2  = intval($data['id_prodi2']);

                $sql01     = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi1]);
                $prodi1    = $this->baseMod->getRow($sql01);
                $bidang1   = $prodi1['id_bidang'];

                $bidang2   = null;
                if (!empty($idprodi2)) :
                    $sql02   = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id_prodi: AND status_data = 0', ['id_prodi' => $idprodi2]);
                    $prodi2  = $this->baseMod->getRow($sql02);
                    $bidang2 = $prodi2['id_bidang'];

                endif;

                if ($bidang1 == $bidang2 || $bidang2 == null) :
                    $id_bidang = $bidang1;

                elseif ($bidang1 != $bidang2 || $bidang2 != null) :
                    $sql03     = $this->baseMod->getBy('tb_bidang', 'id_bidang != :id_bidang1: AND id_bidang != :id_bidang2:', ['id_bidang1' => $bidang1, 'id_bidang2' => $bidang2]);
                    $bidang    = $this->baseMod->getRow($sql03);
                    $id_bidang = $bidang['id_bidang'];

                else :
                    $id_bidang = null;

                endif;

                $params    = [
                    'id_bidang' => $id_bidang, 'id_ruangan_sesi' => $data['id_ruangan_sesi'], 'nik_peserta' => clean_char($nik), 'nisn_peserta' => clean_char($data['nisn_peserta']), 'no_pendaftaran' => clean_char($data['no_pendaftaran']), 'nama_peserta' => strtolower($data['nama_peserta']), 'slug_nama_peserta' => slug($data['nama_peserta']), 'jk_peserta' => $data['jk_peserta'], 'no_telp_peserta' => clean_char($data['no_telp']), 'kata_sandi' => $password
                ];

                $sql       = "INSERT INTO tb_peserta VALUES ('', :id_bidang:, :id_ruangan_sesi:, :nik_peserta:, :nisn_peserta:, :no_pendaftaran:,:nama_peserta:, :slug_nama_peserta:, :jk_peserta:, :no_telp_peserta:, :kata_sandi:, null, null, null, null, 0, 0, 0)";
                $query     = conn()->query($sql, $params);
                $idpeserta = conn()->insertID();

                if ($query != true) return '1-1';

                $idpoltek1 = null;
                $sql11     = $this->baseMod->getBy('tb_poltek', 'kd_poltek = :kd_poltek:', ['kd_poltek' => $data['poltek1']]);
                $counts11  = $this->baseMod->numRows($sql11);

                if ($counts11 > 0) :
                    $poltek1   = $this->baseMod->getRow($sql11);
                    $idpoltek1 = $poltek1['id_poltek'];

                endif;


                $sql1      = "INSERT INTO tb_has_peserta VALUES ('', :id_peserta:, :id_poltek:, :id_prodi:, :status:)";
                $params1   = ['id_peserta' => $idpeserta, 'id_poltek' => clean_char($idpoltek1), 'id_prodi' => $idprodi1, 'status' => 1];
                $query1    = conn()->query($sql1, $params1);

                if (!empty($idprodi2) && !empty($data['poltek2'])) :

                    $idpoltek2 = null;
                    $sql12     = $this->baseMod->getBy('tb_poltek', 'kd_poltek = :kd_poltek:', ['kd_poltek' => $data['poltek2']]);
                    $counts12  = $this->baseMod->numRows($sql12);

                    if ($counts12 > 0) :
                        $poltek2   = $this->baseMod->getRow($sql12);
                        $idpoltek2 = $poltek2['id_poltek'];

                    endif;

                    $params2 = ['id_peserta' => $idpeserta, 'id_poltek' => clean_char($idpoltek2), 'id_prodi' => $idprodi2, 'status' => 2];
                    $query2  = conn()->query($sql1, $params2);

                endif;

                $bool[]      = $query1;

            endif;


        endforeach;

        $message = '1-1';
        if (in_array(true, $bool)) $message = '0-1';

        /** /pindah **/

        return $message;
    }

    public function getDelete($data)
    {
        $params  = ['id_peserta' => $data['id_peserta']];
        $sql     = "UPDATE tb_peserta SET status_data = 1 WHERE id_peserta = :id_peserta:";
        $query   = conn()->query($sql, $params);

        $message = '1-3';
        if ($query == true) $message = '0-3';

        return $message;
    }
}
