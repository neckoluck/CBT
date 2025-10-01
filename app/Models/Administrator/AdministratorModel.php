<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;
use App\Models\Administrator\BaseModel;

class AdministratorModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult()
    {
        $params = ['status_data' => 0];
        $sql    = "SELECT * FROM tb_administrator WHERE status_data = :status_data:";
        $query  = conn()->query($sql, $params)->getResultArray();

        return $query;
    }

    public function getInsert($data)
    {
        if ($data['aksi'] == 'in-admin') :

            $params1 = ['nip_administrator' => $data['nip_administrator']];
            $sql1    = $this->baseMod->getBy('tb_administrator', 'nip_administrator = :nip_administrator: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            $params2 = ['no_telp_administrator' => $data['no_telp_administrator']];
            $sql2    = $this->baseMod->getBy('tb_administrator', 'no_telp_administrator = :no_telp_administrator: AND status_data = 0', $params2);
            $count2  = $this->baseMod->numRows($sql2);

            if ($count1 > 0) return '1-23';
            if ($count2 > 0) return '1-24';

            $slug    = slug($data['nama_administrator']);
            $file    = $data['namaFile'];

            if ($file->getError() == 4) :
                $namaFile = 'default.jpg';

            else :
                $namaFile = $file->getRandomName();
                $file->move('uploads/pic-user/administrator/', $namaFile);

            endif;

            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $params   =
                [
                    'nip_administrator' => $data['nip_administrator'], 'nama_administrator' => $data['nama_administrator'], 'slug_nama_administrator' => $slug, 'jk_administrator' => $data['jk_administrator'], 'no_telp_administrator' => $data['no_telp_administrator'], 'kata_sandi' => $password, 'foto_administrator' => $namaFile, 'status_akses' => $data['status_akses'],
                ];

            $sql     = "INSERT INTO tb_administrator VALUES ('', :nip_administrator:, :nama_administrator:, :slug_nama_administrator:, :jk_administrator:, :no_telp_administrator:, :kata_sandi:, :foto_administrator:, NOW(), NOW(), :status_akses:, 0)";
            $query   = conn()->query($sql, $params);

            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;


        endif;
    }

    public function getUpdate($data)
    {
        if ($data['aksi'] == 'up-keamanan') :
            $password = password_hash($data['newpassword'], PASSWORD_DEFAULT);
            $params   = ['kata_sandi' => $password, 'id_administrator' => $data['id_administrator']];
            $sql      = "UPDATE tb_administrator SET kata_sandi = :kata_sandi:, update_at = NOW() WHERE id_administrator = :id_administrator:";
            $query    = conn()->query($sql, $params);
            $message  = '1-18';
            if ($query == true) $message = '0-18';

            return $message;

        elseif ($data['aksi'] == 'up-profil') :
            $params1 = ['nip_administrator' => $data['nip_administrator'], 'id_administrator' => $data['admin']['id_administrator']];
            $sql1    = $this->baseMod->getBy('tb_administrator', 'id_administrator != :id_administrator: AND nip_administrator = :nip_administrator: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            $params2 = ['no_telp_administrator' => $data['no_telp_administrator'], 'id_administrator' => $data['admin']['id_administrator']];
            $sql2    = $this->baseMod->getBy('tb_administrator', 'id_administrator != :id_administrator: AND no_telp_administrator = :no_telp_administrator: AND status_data = 0', $params2);
            $count2  = $this->baseMod->numRows($sql2);

            if ($count1 > 0) return '1-23';
            if ($count2 > 0) return '1-24';

            $slug = slug($data['nama_administrator']);
            $file = $data['namaFile'];

            if ($file->getError() == 4) :
                $namaFile = $data['admin']['foto_administrator'];

            else :
                if ($data['admin']['foto_administrator'] !== 'default.jpg') unlink('uploads/pic-user/administrator/' . $data['admin']['foto_administrator']);
                $namaFile = $file->getRandomName();
                $file->move('uploads/pic-user/administrator/', $namaFile);

            endif;

            $params   =
                [
                    'nip_administrator' => $data['nip_administrator'], 'nama_administrator' => $data['nama_administrator'], 'slug_nama_administrator' => $slug, 'jk_administrator' => $data['jk_administrator'], 'no_telp_administrator' => $data['no_telp_administrator'], 'foto_administrator' => $namaFile, 'status_akses' => $data['status_akses'], 'id_administrator' => $data['admin']['id_administrator']
                ];

            $sql     = "UPDATE tb_administrator SET nip_administrator = :nip_administrator:, nama_administrator = :nama_administrator:, slug_nama_administrator = :slug_nama_administrator:, jk_administrator = :jk_administrator:, no_telp_administrator = :no_telp_administrator:, foto_administrator = :foto_administrator:, update_at = NOW(), status_akses = :status_akses: WHERE id_administrator = :id_administrator:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'up-akses') :
            $params  = ['status_akses' => $data['status'], 'id_administrator' => $data['id_administrator']];
            $sql     = "UPDATE tb_administrator SET status_akses = :status_akses: WHERE id_administrator = :id_administrator:";
            $query   = conn()->query($sql, $params);

            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        else :
            return '1-0';

        endif;
    }

    public function getDelete($data)
    {

        if ($data['status'] == 0) return '1-16';

        $params  = ['id_administrator' => $data['id_administrator']];
        $sql     = "UPDATE tb_administrator SET status_data = 1 WHERE id_administrator = :id_administrator:";
        $query   = conn()->query($sql, $params);

        $message = '1-3';
        if ($query == true) $message = '0-3';

        return $message;
    }
}
