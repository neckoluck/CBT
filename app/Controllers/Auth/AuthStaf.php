<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\_AuthModel;
use App\Models\Auth\BaseModel;

class AuthStaf extends BaseController
{
    protected $loginMod;

    protected $request;

    public function __construct()
    {
        $this->baseMod  = new BaseModel;
        $this->_authMod = new _AuthModel;
    }

    public function index()
    {
        $data = [
            'title'      => 'CBT - ' . ucwords($this->settMod->sett()['nama_instansi']),
            'icon'       => 'archive',
            'status'     => 'staf',
            'action'     => base_url() . '/auth/staf/login',
            'content'    => 'auth/content/auth-panitia',
            'sett'       => $this->settMod->sett()
        ];

        echo view('auth/_blank', $data);
        echo view('auth/template', $data);
    }

    public function login()
    {
        $data = [
            'username'  => htmlspecialchars($this->req->getVar('username')),
            'password'  => htmlspecialchars($this->req->getVar('password')),
            'cpassword' => htmlspecialchars($this->req->getVar('cpassword'))
        ];

        if ($this->valid->run($data, 'login1') !== false) :
            $result = $this->_authMod->getLogin($data);

            if (is_array($result)) :

                session()->set($result);
                return redirect()->to('/staf');

            else :
                $message = $result;
                session()->setFlashdata('message', $message);
                return redirect()->to('/auth/staf')->withInput()->with('validation', $this->valid->getErrors());

            endif;

        else :
            return redirect()->to('/auth/staf')->withInput()->with('validation', $this->valid->getErrors());

        endif;
    }
}
