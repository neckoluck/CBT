<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\Staf\BaseModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function index()
    {
        $data   = [
            'title'      => 'Dashboard - Staf CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'staf/content/dashboard/dashboard',
            'page'       => 'dashboard',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/staf',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett()
        ];

        echo view('staf/_blank', $data);
        echo view('staf/template', $data);
    }

    public function logout()
    {
        $this->baseMod->getAccess(session()->get('id'));

        session()->destroy();
        return redirect()->to('/auth/staf');
    }
}
