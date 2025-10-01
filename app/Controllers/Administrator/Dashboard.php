<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
    }

    public function index()
    {
        remove_sess('type');
    
        $data   = [
            'title'   => 'Dashboard - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content' => 'administrator/content/dashboard/dashboard',
            'page'    => 'dashboard',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/administrator',
            'sett'       => $this->settMod->sett()
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/administrator');
    }
}
