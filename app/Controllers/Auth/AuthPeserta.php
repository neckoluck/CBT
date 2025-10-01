<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

use App\Models\Auth\AuthModel;
use App\Models\Auth\BaseModel;

class AuthPeserta extends BaseController
{
    protected $loginMod;

    protected $request;

    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->authMod = new AuthModel;
    }

    public function index()
    {
        $data = [
            'title'      => 'CBT - ' . ucwords($this->settMod->sett()['nama_instansi']),
            'icon'       => 'archive',
            'action'     => base_url() . '/auth/login',
            'content'    => 'auth/content/auth-peserta',
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
            'cpassword' => htmlspecialchars($this->req->getVar('cpassword')),
            'ip_kom'    => $this->req->getIPAddress()
        ];

        if ($this->valid->run($data, 'login1') !== false) :
            $result = $this->authMod->getLogin($data);

            if (is_array($result)) :

                $pageTarget = 'peserta';

                session()->set($result);
                return redirect()->to('/auth' . $pageTarget);

            else :
                $message = $result;
                session()->setFlashdata('message', $message);
                return redirect()->to('/auth')->withInput()->with('validation', $this->valid->getErrors());

            endif;

        else :
            return redirect()->to('/auth')->withInput()->with('validation', $this->valid->getErrors());

        endif;
    }
}
