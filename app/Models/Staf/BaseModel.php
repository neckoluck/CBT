<?php

namespace App\Models\Staf;

use CodeIgniter\Model;

class BaseModel extends Model
{
    public function sess($id)
    {
        $params = ['id_staf' => $id];
        $sql    = "SELECT * FROM tb_staf WHERE id_staf = :id_staf: AND status_staf = 1";
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

    public function getAccess($id)
    {
        $params = ['status_akses' => 1, 'id_staf' => $id];
        $sql    = "UPDATE tb_staf SET status_akses = :status_akses: WHERE id_staf = :id_staf:";
        conn()->query($sql, $params);
    }
}
