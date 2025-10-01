<?php

namespace App\Models\Auth;

use App\Models\Auth\BaseModel;

use CodeIgniter\Model;

class _AuthModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getLogin($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $params    = ['username' => $username];
        $sql1      = $this->baseMod->getBy('tb_administrator', 'nip_administrator = :username:', $params);
        $count1    = $this->baseMod->numRows($sql1);
        if ($count1 > 0) :
            $admin = $this->baseMod->getRow($sql1);
            $role  = 1;
            $id    = $admin['id_administrator'];
            $akses = $admin['status_akses'];
            $sandi = $admin['kata_sandi'];

        endif;

        $params    = ['username' => $username, 'status_staf' => 1];
        $sql2      = $this->baseMod->getBy('tb_staf', 'nip_staf = :username: AND status_staf = :status_staf:', $params);
        $count2    = $this->baseMod->numRows($sql2);
        if ($count2 > 0) :
            $staf  = $this->baseMod->getRow($sql2);
            $role  = 2;
            $id    = $staf['id_staf'];
            $akses = $staf['status_akses'];
            $sandi = $staf['kata_sandi'];

            if ($akses == 1) return '1-11';

        endif;

        if ($count1 == 0 && $count2 == 0) return '1-12';

        if (password_verify($password, $sandi)) :
            $data = ['log' => true, 'id' => $id, 'role' => $role];
            return $data;

        else :
            return '1-10';

        endif;
    }
}
