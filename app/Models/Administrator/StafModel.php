<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;


class StafModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getResult($status)
    {
        $params = ['status_akses' => $status, 'status_data' => 0];
        $sql    = "SELECT * FROM tb_staf WHERE status_staf = :status_akses: AND status_data = :status_data:";
        $query  = conn()->query($sql, $params)->getResultArray();

        return $query;
    }

    public function getInsert($data)
    {
        if ($data['aksi'] == 'in-staf') :

            $slug = slug($data['nama_staf']);
            $file = $data['namaFile'];

            if ($file->getError() == 4) :
                $namaFile = 'default.jpg';

            else :
                $namaFile = $file->getRandomName();
                $folder   = 'pengawas';

                if ($data['status_staf'] == 2) $folder = 'teknisi';
                $file->move('uploads/pic-user/' . $folder . '/', $namaFile);

            endif;

            $password = '';
            if ($data['status_staf'] == 1) $password = password_hash($data['password'], PASSWORD_DEFAULT);

            $params   =
                [
                    'nip_staf' => $data['nip_staf'], 
            		'nama_staf' => $data['nama_staf'], 
            		'slug_nama_staf' => $slug, 
            		'jk_staf' => $data['jk_staf'], 
            		// 'no_telp_staf' => $data['no_telp_staf'], 
            		'kata_sandi' => $password, 
            		'foto_staf' => $namaFile, 
            		'status_staf' => $data['status_staf'], 
            		'status_akses' => $data['status_akses'],
                ];
    
			# :no_telp_staf:, 
            $sql     = "INSERT INTO tb_staf VALUES ('', 
            										:nip_staf:, 
                                                    :nama_staf:, 
                                                    :slug_nama_staf:, 
                                                    :jk_staf:, 
                                                    NULL,
                                                    :kata_sandi:, 
                                                    :foto_staf:, 
                                                    NOW(), 
                                                    NOW(), 
                                                    :status_staf:, 
                                                    :status_akses:, 
                                                    0)";
            $query   = conn()->query($sql, $params);
            $message = '1-1';
            if ($query == true) $message = '0-1';

            return $message;

        endif;
    }

    public function getUpdate($data)
    {
        if ($data['aksi'] == 'up-keamanan') :

            $staf    = $this->baseMod->getId('tb_staf', 'id_staf', $data['id_staf']);

            if ($staf['status_staf'] == 2) return '1-0';

            $password = password_hash($data['newpassword'], PASSWORD_DEFAULT);
            $params   = ['kata_sandi' => $password, 'id_staf' => $data['id_staf']];
            $sql      = "UPDATE tb_staf SET kata_sandi = :kata_sandi:, update_at = NOW() WHERE id_staf = :id_staf:";
            $query    = conn()->query($sql, $params);
            $message  = '1-18';
            if ($query == true) $message = '0-18';

            return $message;

        elseif ($data['aksi'] == 'up-profil') :


            $slug = slug($data['nama_staf']);
            $file = $data['namaFile'];

            if ($file->getError() == 4) :
                $namaFile = $data['staf']['foto_staf'];

            else :
                $folder   = 'pengawas';

                if ($data['staf']['status_staf'] == 2) $folder = 'teknisi';
                if ($data['staf']['foto_staf'] !== 'default.jpg') unlink('uploads/pic-user/' . $folder . '/' . $data['staf']['foto_staf']);
                $namaFile = $file->getRandomName();

                $file->move('uploads/pic-user/' . $folder . '/', $namaFile);

            endif;

            $params   =
                [
                    'nip_staf' => $data['nip_staf'], 
            		'nama_staf' => $data['nama_staf'], 
            		'slug_nama_staf' => $slug, 
            		'jk_staf' => $data['jk_staf'], 
            		// 'no_telp_staf' => $data['no_telp_staf'], 
            		'foto_staf' => $namaFile, 
            		'status_akses' => $data['status_akses'], 
            		'id_staf' => $data['staf']['id_staf']
                ];
			
    		# no_telp_staf = :no_telp_staf:,
            $sql     = "UPDATE tb_staf SET 
            								nip_staf = :nip_staf:, 
                                            nama_staf = :nama_staf:, 
                                            slug_nama_staf = :slug_nama_staf:, 
                                            jk_staf = :jk_staf:, 
                                            no_telp_staf = NULL, 
                                            foto_staf = :foto_staf:, 
                                            update_at = 
                                            NOW(), 
                                            status_akses = :status_akses: 
                                            	WHERE 
                                                	id_staf = :id_staf:";
    
            $query   = conn()->query($sql, $params);
            $message = '1-2';
            if ($query == true) $message = '0-2';

            return $message;

        elseif ($data['aksi'] == 'up-akses') :
            $params  = ['status_akses' => $data['status'], 'id_staf' => $data['id_staf']];
            $sql     = "UPDATE tb_staf SET status_akses = :status_akses: WHERE id_staf = :id_staf:";
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

        $params  = ['id_staf' => $data['id_staf']];
        $sql     = "UPDATE tb_staf SET status_data = 1 WHERE id_staf = :id_staf:";
        $query   = conn()->query($sql, $params);
        $message = '1-3';
        if ($query == true) $message = '0-3';

        return $message;
    }
}
