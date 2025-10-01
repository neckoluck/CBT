<?php

namespace App\Models\Peserta;

use CodeIgniter\Model;
use App\Models\Peserta\BaseModel;

class SelesaiModel extends Model
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }
}
