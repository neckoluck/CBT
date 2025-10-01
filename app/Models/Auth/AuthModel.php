<?php

namespace App\Models\Auth;

use App\Models\Auth\BaseModel;

use CodeIgniter\Model;

class AuthModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getLogin($data)
    {
        $username  = $data['username'];
        $password  = $data['password'];

        $params    = ['no_pendaftaran' => $username];
        $sql1      = $this->baseMod->getBy('vw_peserta', 'no_pendaftaran = :no_pendaftaran: AND status_data = 0', $params);
        $count1    = $this->baseMod->numRows($sql1);

        if ($count1 > 0) :
            $peserta = $this->baseMod->getRow($sql1);
            $role    = 3;
            $id      = $peserta['id_peserta'];
            $status  = $peserta['status_peserta'];
            $sandi   = $peserta['kata_sandi'];

            $sql2    = $this->baseMod->getBy('tb_ruangan_sesi', 'id_ruangan_sesi = :id_ruangan_sesi: AND status_data = 0', ['id_ruangan_sesi' => $peserta['id_ruangan_sesi']]);
            $count2  = $this->baseMod->numRows($sql2);

            if ($count2 < 1) return '1-26';

            $ruses   = $this->baseMod->getRow($sql2);

            if ($ruses['status_ruangan_sesi'] == 0) return '1-27';

            if ($peserta["sisa_waktu"] == null) :
                $sisawaktu = 0;

            else :
                $sisawaktu = $peserta["sisa_waktu"];

            endif;

            if (!is_null($peserta['ip_kom'])) if ($peserta['ip_kom'] != $data['ip_kom']) return '1-32';

            if ($peserta['status_sess'] == 1) return '1-30';

            if ($status == 3 || !is_null($peserta['selesai_ujian'])) return '1-29';


        endif;

        if ($count1 < 1) return '1-13';

        // if (password_verify($password, $sandi)) :
    	if ($password == $sandi) :

            $params = ['ip' => $data['ip_kom'], 'status' => 1, 'id' => $id];
            $sql    = "UPDATE tb_peserta SET ip_kom = :ip:, status_sess = :status: WHERE id_peserta = :id:";

            conn()->query($sql, $params);

			$data   = ['log' => true, 'id' => $id, 'role' => $role, 'sisawaktu' => $sisawaktu];     		
            // $data   = ['log' => true, 'id' => $id, 'role' => $role, 'sisawaktu' => $sisawaktu, 'expire' => time()];
            return $data;

        else :
            return '1-10';

        endif;
    }
}
