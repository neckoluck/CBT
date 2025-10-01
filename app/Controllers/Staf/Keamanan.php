<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\Staf\BaseModel;
use App\Models\Staf\KeamananModel;

class Keamanan extends BaseController
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->amanMod = new KeamananModel;
    }

    public function index()
    {
        $data   = [
            'title'      => 'Dashboard - Staf CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'staf/content/staf/keamanan',
            'page'       => 'atur keamanan',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/staf',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'action'     => base_url() . '/staf/keamanan/update',
            'sett'       => $this->settMod->sett()
        ];

        echo view('staf/_blank', $data);
        echo view('staf/template', $data);
    }

    public function update()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $data = [
            'oldpassword'      => $this->req->getVar('oldpassword'),
            'newpassword'      => $this->req->getVar('newpassword'),
            'cnewpassword'     => $this->req->getVar('cnewpassword'),
            'id_staf'          => session()->get('id')
        ];

        if ($this->valid->run($data, 'stafaman') !== false) :

            $message = $this->amanMod->getUpdate($data);
            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->back();

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back()->withInput();

            endif;

        else :
            return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

        endif;
    }
}
