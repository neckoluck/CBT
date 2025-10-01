<?php

namespace App\Models\Administrator;

use CodeIgniter\Model;

class BaseModel extends Model
{
    public function sess($id)
    {
        $params = ['id_administrator' => $id];
        $sql    = "SELECT * FROM tb_administrator WHERE id_administrator = :id_administrator:";
        $query  = conn()->query($sql, $params)->getRowArray();

        return $query;
    }

    public function getId(string $table, string $key, string $value)
    {
        $params = [$key => $value];
        $sql    = "SELECT * FROM $table WHERE $key = :" . $key . ":";
        $query  = conn()->query($sql, $params)->getRowArray();

        return $query;
    }

    public function getBy($table, $bind = "", $params = [])
    {
        $params = $params;

        $syn    = "";
        if (!empty($bind)) $syn = "WHERE";

        $sql    = "SELECT * FROM $table $syn $bind";
        $query  = conn()->query($sql, $params);

        return $query;
    }

    public function numRows($query)
    {
        return $query->getNumRows();
    }

    public function getRow($query)
    {
        return $query->getRowArray();
    }

    public function getRows($query)
    {
        return $query->getResultArray();
    }
}
