<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;

class SoalModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult($tabel)
    {
        if (in_array($tabel, ['tb_mata_uji', 'vw_soal', 'vw_kelompok_soal'])) :
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
        $soal   = $this->baseMod->getId('tb_soal', 'slug_soal', $slug);
        $params = ['id_soal' => $soal['id_soal']];
        $sql    = "SELECT soal.*,  
                    MAX(CASE WHEN opsi.opsi = 1 THEN opsi.jawaban END) AS jawaban_1,
                    MAX(CASE WHEN opsi.opsi = 2 THEN opsi.jawaban END) AS jawaban_2,
                    MAX(CASE WHEN opsi.opsi = 3 THEN opsi.jawaban END) AS jawaban_3,
                    MAX(CASE WHEN opsi.opsi = 4 THEN opsi.jawaban END) AS jawaban_4,
                    MAX(CASE WHEN opsi.opsi = 5 THEN opsi.jawaban END) AS jawaban_5,
                    MAX(CASE WHEN opsi.opsi = 1 THEN opsi.gambar END) AS gambar_1,
                    MAX(CASE WHEN opsi.opsi = 2 THEN opsi.gambar END) AS gambar_2,
                    MAX(CASE WHEN opsi.opsi = 3 THEN opsi.gambar END) AS gambar_3,
                    MAX(CASE WHEN opsi.opsi = 4 THEN opsi.gambar END) AS gambar_4,
                    MAX(CASE WHEN opsi.opsi = 5 THEN opsi.gambar END) AS gambar_5,
                    MAX(CASE WHEN opsi.opsi = 1 THEN opsi.id_opsi_jawaban END) AS id_opsi_1,
                    MAX(CASE WHEN opsi.opsi = 2 THEN opsi.id_opsi_jawaban END) AS id_opsi_2,
                    MAX(CASE WHEN opsi.opsi = 3 THEN opsi.id_opsi_jawaban END) AS id_opsi_3,
                    MAX(CASE WHEN opsi.opsi = 4 THEN opsi.id_opsi_jawaban END) AS id_opsi_4,
                    MAX(CASE WHEN opsi.opsi = 5 THEN opsi.id_opsi_jawaban END) AS id_opsi_5,
                    kesol.kelompok_soal, 
                    kesol.nama_bidang 
                        AS nama_bidang_kesol, maju.mata_uji, 
                    maju.nama_bidang 
                        AS nama_bidang_mata_uji 
                            FROM tb_soal 
                                AS soal 
                                    INNER JOIN tb_opsi_jawaban 
                                        AS opsi 
                                            ON soal.id_soal = opsi.id_soal 
                                    INNER JOIN vw_kelompok_soal 
                                        AS kesol 
                                            ON soal.id_kelompok_soal = kesol.id_kelompok_soal 
                                    INNER JOIN vw_mata_uji 
                                        AS maju 
                                            ON soal.id_mata_uji = maju.id_mata_uji 
                                                WHERE soal.id_soal = :id_soal: AND soal.status_data = 0 
                                                    GROUP BY soal.id_soal";

        $query  = conn()->query($sql, $params)->getRowArray();
        return $query;
    }

    public function getInsert($data)
    {
        $file    = $data['namaFile'];
        $slug    = randMix(20);
        $params  = ['id_kelompok_soal' => $data['id_kelompok_soal'], 'id_mata_uji' => $data['id_mata_uji'], 'soal_1' => $data['soal_1'], 'soal_2' => $data['soal_2']];
        $sql     = $this->baseMod->getBy('tb_soal', 'id_kelompok_soal = :id_kelompok_soal: AND id_mata_uji = :id_mata_uji: AND soal_1 = :soal_1: AND soal_2 = :soal_2: AND status_data = 0', $params);
        $count   = $this->baseMod->numRows($sql);

        if ($count > 0) return '1-8';

        if ($file->getError() == 4) :
            $namaFile = 'default.jpg';

        else :
            $namaFile = $file->getRandomName();
            $file->move('uploads/pic-question/', $namaFile);

        endif;

        $params1 = ['id_kelompok_soal' => $data['id_kelompok_soal'], 'id_mata_uji' => $data['id_mata_uji'], 'slug_soal' => $slug, 'soal_1' => $data['soal_1'], 'soal_2' => $data['soal_2'], 'posisi_gambar' => $data['posisi_gambar'], 'gambar_soal' => $namaFile, 'jawaban_benar' => $data['opsi']];
        $sql1    = "INSERT INTO tb_soal VALUES ('', :id_kelompok_soal:, :id_mata_uji:, :slug_soal:, :soal_1:, :soal_2:, :posisi_gambar:, :gambar_soal:, :jawaban_benar:, 0, 0)";
        $query1  = conn()->query($sql1, $params1);
        $id_soal = conn()->insertID();

        if ($query1 != true) return '1-1';

        $file1   = $data['namaFile1'];
        if ($file1->getError() == 4) :
            $namaFile1 = 'default.jpg';

        else :
            $namaFile1 = $file1->getRandomName();
            $file1->move('uploads/pic-answer/', $namaFile1);

        endif;

        $file2   = $data['namaFile2'];
        if ($file2->getError() == 4) :
            $namaFile2 = 'default.jpg';

        else :
            $namaFile2 = $file2->getRandomName();
            $file2->move('uploads/pic-answer/', $namaFile2);

        endif;

        $file3   = $data['namaFile3'];
        if ($file3->getError() == 4) :
            $namaFile3 = 'default.jpg';

        else :
            $namaFile3 = $file3->getRandomName();
            $file3->move('uploads/pic-answer/', $namaFile3);

        endif;

        $file4   = $data['namaFile4'];
        if ($file4->getError() == 4) :
            $namaFile4 = 'default.jpg';

        else :
            $namaFile4 = $file4->getRandomName();
            $file4->move('uploads/pic-answer/', $namaFile4);

        endif;

        $file5   = $data['namaFile5'];
        if ($file5->getError() == 4) :
            $namaFile5 = 'default.jpg';

        else :
            $namaFile5 = $file5->getRandomName();
            $file5->move('uploads/pic-answer/', $namaFile5);

        endif;

        $prms1 = ['id_soal' => $id_soal, 'opsi' => 1, 'jawaban' => $data['jawaban_1'], 'gambar' => $namaFile1];
        $prms2 = ['id_soal' => $id_soal, 'opsi' => 2, 'jawaban' => $data['jawaban_2'], 'gambar' => $namaFile2];
        $prms3 = ['id_soal' => $id_soal, 'opsi' => 3, 'jawaban' => $data['jawaban_3'], 'gambar' => $namaFile3];
        $prms4 = ['id_soal' => $id_soal, 'opsi' => 4, 'jawaban' => $data['jawaban_4'], 'gambar' => $namaFile4];
        $prms5 = ['id_soal' => $id_soal, 'opsi' => 5, 'jawaban' => $data['jawaban_5'], 'gambar' => $namaFile5];
        $sql2  = "INSERT INTO tb_opsi_jawaban VALUES ('', :id_soal:, :opsi:, :jawaban:, :gambar:)";

        $que1    = conn()->query($sql2, $prms1);
        $que2    = conn()->query($sql2, $prms2);
        $que3    = conn()->query($sql2, $prms3);
        $que4    = conn()->query($sql2, $prms4);
        $que5    = conn()->query($sql2, $prms5);
        $message = '0-1';

        if (!in_array(true, [$que1, $que2, $que3, $que4, $que5])) :
            $params3 = ['id_soal' => $id_soal];
            $sql3    = "DELETE FROM tb_soal WHERE id_soal = :id_soal:";
            $query3  = conn()->query($sql3, $params3);
            $opsi    = $this->baseMod->getBy('tb_opsi_jawaban', 'id_soal = :id_soal:', ['id_soal' => $id_soal]);

            if ($this->baseMod->numRows($opsi) > 0) :
                $sql4   = "DELETE FROM tb_opsi_jawaban WHERE id_soal = :id_soal:";
                $query4 = conn()->query($sql4, $params3);

            endif;

            $message = '1-1';

        endif;

        return $message;
    }

    public function getUpdate($data)
    {
        $params = ['id_soal' => $data['id_soal']];
        $sql    = $this->baseMod->getBy('vw_soal', 'id_soal = :id_soal: AND status_data = 0', $params);

        if ($this->baseMod->numRows($sql) < 1) return '1-0';

        $params  = ['id_kelompok_soal' => $data['id_kelompok_soal'], 'id_mata_uji' => $data['id_mata_uji'], 'soal_1' => $data['soal_1'], 'soal_2' => $data['soal_2'], 'id_soal' => $data['id_soal']];
        $sql     = $this->baseMod->getBy('tb_soal', 'id_soal != :id_soal: AND id_kelompok_soal = :id_kelompok_soal: AND id_mata_uji = :id_mata_uji: AND soal_1 = :soal_1: AND soal_2 = :soal_2: AND status_data = 0', $params);

        $count   = $this->baseMod->numRows($sql);

        if ($count > 0) return '1-8';

        $query  = $this->baseMod->getRow($sql);
        $sql1   = "SELECT soal.*,  
                    MAX(CASE WHEN opsi.opsi = 1 THEN opsi.jawaban END) AS jawaban_1,
                    MAX(CASE WHEN opsi.opsi = 2 THEN opsi.jawaban END) AS jawaban_2,
                    MAX(CASE WHEN opsi.opsi = 3 THEN opsi.jawaban END) AS jawaban_3,
                    MAX(CASE WHEN opsi.opsi = 4 THEN opsi.jawaban END) AS jawaban_4,
                    MAX(CASE WHEN opsi.opsi = 5 THEN opsi.jawaban END) AS jawaban_5,
                    MAX(CASE WHEN opsi.opsi = 1 THEN opsi.gambar END) AS gambar_1,
                    MAX(CASE WHEN opsi.opsi = 2 THEN opsi.gambar END) AS gambar_2,
                    MAX(CASE WHEN opsi.opsi = 3 THEN opsi.gambar END) AS gambar_3,
                    MAX(CASE WHEN opsi.opsi = 4 THEN opsi.gambar END) AS gambar_4,
                    MAX(CASE WHEN opsi.opsi = 5 THEN opsi.gambar END) AS gambar_5,
                    MAX(CASE WHEN opsi.opsi = 1 THEN opsi.id_opsi_jawaban END) AS id_opsi_1,
                    MAX(CASE WHEN opsi.opsi = 2 THEN opsi.id_opsi_jawaban END) AS id_opsi_2,
                    MAX(CASE WHEN opsi.opsi = 3 THEN opsi.id_opsi_jawaban END) AS id_opsi_3,
                    MAX(CASE WHEN opsi.opsi = 4 THEN opsi.id_opsi_jawaban END) AS id_opsi_4,
                    MAX(CASE WHEN opsi.opsi = 5 THEN opsi.id_opsi_jawaban END) AS id_opsi_5,
                    kesol.kelompok_soal, 
                    kesol.nama_bidang 
                        AS nama_bidang_kesol, maju.mata_uji, 
                    maju.nama_bidang 
                        AS nama_bidang_mata_uji 
                            FROM tb_soal 
                                AS soal 
                                    INNER JOIN tb_opsi_jawaban 
                                        AS opsi 
                                            ON soal.id_soal = opsi.id_soal 
                                    INNER JOIN vw_kelompok_soal 
                                        AS kesol 
                                            ON soal.id_kelompok_soal = kesol.id_kelompok_soal 
                                    INNER JOIN vw_mata_uji 
                                        AS maju 
                                            ON soal.id_mata_uji = maju.id_mata_uji 
                                                WHERE soal.id_soal = :id_soal: 
                                                    GROUP BY soal.id_soal";

        $soal  = conn()->query($sql1, $params)->getRowArray();
        $file  = $data['namaFile'];

        if ($file->getError() == 4) :
            $namaFile = $soal['gambar_soal'];

        else :
            if ($soal['gambar_soal'] !== 'default.jpg') unlink('uploads/pic-question/' . $soal['gambar_soal']);
            $namaFile = $file->getRandomName();
            $file->move('uploads/pic-question/', $namaFile);

        endif;

        $params2 = ['id_kelompok_soal' => $data['id_kelompok_soal'], 'id_mata_uji' => $data['id_mata_uji'], 'soal_1' => $data['soal_1'], 'soal_2' => $data['soal_2'], 'posisi_gambar' => $data['posisi_gambar'], 'gambar_soal' => $namaFile, 'jawaban_benar' => $data['opsi'], 'id_soal' => $data['id_soal']];
        $sql2    = "UPDATE tb_soal SET id_kelompok_soal = :id_kelompok_soal:, id_mata_uji = :id_mata_uji:, soal_1 = :soal_1:, soal_2 = :soal_2:, posisi_gambar = :posisi_gambar:, gambar_soal = :gambar_soal:, jawaban_benar = :jawaban_benar: WHERE id_soal = :id_soal:";
        $query2  = conn()->query($sql2, $params2);
        $count2  = conn()->affectedRows($query2);

        $file1   = $data['namaFile1'];
        if ($file1->getError() == 4) :
            $namaFile1 = $soal['gambar_1'];

        else :
            if ($soal['gambar_1'] !== 'default.jpg') unlink('uploads/pic-question/' . $soal['gambar_1']);
            $namaFile1 = $file1->getRandomName();
            $file1->move('uploads/pic-answer/', $namaFile1);

        endif;

        $file2   = $data['namaFile2'];
        if ($file2->getError() == 4) :
            $namaFile2 = $soal['gambar_2'];

        else :
            if ($soal['gambar_2'] !== 'default.jpg') unlink('uploads/pic-question/' . $soal['gambar_2']);
            $namaFile2 = $file2->getRandomName();
            $file2->move('uploads/pic-answer/', $namaFile2);

        endif;

        $file3   = $data['namaFile3'];
        if ($file3->getError() == 4) :
            $namaFile3 = $soal['gambar_3'];

        else :
            if ($soal['gambar_3'] !== 'default.jpg') unlink('uploads/pic-question/' . $soal['gambar_3']);
            $namaFile3 = $file3->getRandomName();
            $file3->move('uploads/pic-answer/', $namaFile3);

        endif;

        $file4   = $data['namaFile4'];
        if ($file4->getError() == 4) :
            $namaFile4 = $soal['gambar_4'];

        else :
            if ($soal['gambar_4'] !== 'default.jpg') unlink('uploads/pic-question/' . $soal['gambar_4']);
            $namaFile4 = $file4->getRandomName();
            $file4->move('uploads/pic-answer/', $namaFile4);

        endif;

        $file5   = $data['namaFile5'];
        if ($file5->getError() == 4) :
            $namaFile5 = $soal['gambar_5'];

        else :
            if ($soal['gambar_5'] !== 'default.jpg') unlink('uploads/pic-question/' . $soal['gambar_5']);
            $namaFile5 = $file5->getRandomName();
            $file5->move('uploads/pic-answer/', $namaFile5);

        endif;


        $prms1 = ['opsi' => 1, 'jawaban' => $data['jawaban_1'], 'gambar' => $namaFile1, 'id_opsi' => $soal['id_opsi_1']];
        $prms2 = ['opsi' => 2, 'jawaban' => $data['jawaban_2'], 'gambar' => $namaFile2, 'id_opsi' => $soal['id_opsi_2']];
        $prms3 = ['opsi' => 3, 'jawaban' => $data['jawaban_3'], 'gambar' => $namaFile3, 'id_opsi' => $soal['id_opsi_3']];
        $prms4 = ['opsi' => 4, 'jawaban' => $data['jawaban_4'], 'gambar' => $namaFile4, 'id_opsi' => $soal['id_opsi_4']];
        $prms5 = ['opsi' => 5, 'jawaban' => $data['jawaban_5'], 'gambar' => $namaFile5, 'id_opsi' => $soal['id_opsi_5']];
        $sql2  = "UPDATE tb_opsi_jawaban SET opsi = :opsi:, jawaban = :jawaban:, gambar = :gambar: WHERE id_opsi_jawaban = :id_opsi:";

        $que1  = conn()->query($sql2, $prms1);
        $que2  = conn()->query($sql2, $prms2);
        $que3  = conn()->query($sql2, $prms3);
        $que4  = conn()->query($sql2, $prms4);
        $que5  = conn()->query($sql2, $prms5);

        $message = '1-2';
        if (in_array(true, [$que1, $que2, $que3, $que4, $que5])) $message = '0-2';

        return $message;
    }

    public function getDelete($data)
    {
        if ($data['act'] == 'act-soal') :
            $params  = ['id_soal' => $data['id_soal']];
            $sql     = "UPDATE tb_soal SET status_data = 1 WHERE id_soal = :id_soal:";
            $query   = conn()->query($sql, $params);
            $count   = conn()->affectedRows();

            $message = '1-3';
            if ($count > 0) $message = '0-3';

            return $message;

        elseif ($data['act'] == 'act-imgsoal') :
            if ($data['gambar_soal'] !== 'default.jpg') unlink('uploads/pic-question/' . $data['gambar_soal']);
            $params  = ['id_soal' => $data['id_soal']];
            $sql     = "UPDATE tb_soal SET soal_2 = '', posisi_gambar = '', gambar_soal = 'default.jpg' WHERE id_soal = :id_soal:";
            $query   = conn()->query($sql, $params);
            $message = '1-25';

            if ($query == true) $message = '0-25';

            return $message;

        elseif ($data['act'] == 'act-imgopsi') :

            if ($data['gambar'] !== 'default.jpg') unlink('uploads/pic-answer/' . $data['gambar']);

            $params  = ['id_opsi_jawaban' => $data['id_opsi_jawaban']];
            $sql     = "UPDATE tb_opsi_jawaban SET gambar = 'default.jpg' WHERE id_opsi_jawaban = :id_opsi_jawaban:";
            $query   = conn()->query($sql, $params);
            $message = '1-25';

            if ($query == true) $message = '0-25';

            return $message;


        else :
            return '1-0';

        endif;
    }

    public function getPublish($data)
    {
        $params  = ['status_soal' => $data['status_soal'], 'id_soal' => $data['id_soal']];
        $sql     = "UPDATE tb_soal SET status_soal = :status_soal: WHERE id_soal = :id_soal:";
        $query   = conn()->query($sql, $params);

        $message = '1-2';
        if ($query == true) $message = '0-2';
        return $message;
    }
}
