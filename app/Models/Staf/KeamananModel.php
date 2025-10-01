<?php

namespace App\Models\Staf;

use CodeIgniter\Model;


class KeamananModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function getUpdate($data)
    {

        $staf = $this->baseMod->getId('tb_staf', 'id_staf', $data['id_staf']);
        if (password_verify($data['oldpassword'], $staf['kata_sandi'])) :

            $password = password_hash($data['newpassword'], PASSWORD_DEFAULT);
            $params   = ['kata_sandi' => $password, 'id_staf' => $data['id_staf']];
            $sql      = "UPDATE tb_staf SET kata_sandi = :kata_sandi:, update_at = NOW() WHERE id_staf = :id_staf:";
            $query    = conn()->query($sql, $params);
            $message  = '1-18';

            if ($query == true) :
                $message = '0-18';

            endif;

        else :
            $message = '1-10';

        endif;

        return $message;
    }
}
