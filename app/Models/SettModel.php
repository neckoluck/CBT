<?php

namespace App\Models;

use CodeIgniter\Model;

class SettModel extends Model
{
    public function sett()
    {
        $params = ['id_komponen' => 1];
        $sql    = "SELECT * FROM tb_komponen WHERE id_komponen = :id_komponen:";
        $query  = conn()->query($sql, $params)->getRowArray();

        return $query;
    }
}
