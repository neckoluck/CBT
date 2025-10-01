<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;
use App\Models\Administrator\JadwalModel;

class Jadwal extends BaseController
{
    public function __construct()
    {
        $this->baseMod   = new BaseModel;
        $this->jadwalMod = new JadwalModel;
    }

    public function index($slug = null)
    {
        remove_sess('type');

        if ($slug != null) :
            $params  = ['slug' => $slug];
            $sql     = $this->baseMod->getBy('tb_jadwal', 'slug_jadwal = :slug: AND status_data = 0', $params);
            $count   = $this->baseMod->numRows($sql);

            if ($count < 1) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $upjadwal = $this->baseMod->getRow($sql);
            $action   = 'update';

        else :
            $upjadwal = null;
            $action   = 'insert';

        endif;

        $bidang = $this->jadwalMod->getResult('tb_bidang');
        $jadwal = $this->jadwalMod->getResult('tb_jadwal');
        $data   = [
            'title'      => 'Jadwal - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/jadwal/jadwal',
            'page'       => 'data jadwal',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseUrl'    => base_url() . '/administrator',
            'breadcrumb' => null,
            'bidangs'    => $bidang,
            'action'     =>
            [
                'others' => base_url() . '/administrator/jadwal/' . $action,
                'delete' => base_url() . '/administrator/jadwal/delete'
            ],
            'upjadwal'   => $upjadwal,
            'jadwals'    => $jadwal,
            'baseMod'    => $this->baseMod,
            'sett'       => $this->settMod->sett()
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function insert()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $data = [
            'id_bidang' => $this->req->getVar('id_bidang'),
            'tggl'      => $this->req->getVar('tggl'),
            'bln'       => $this->req->getVar('bln')
        ];

        if ($this->valid->run($data, 'jadwal')) :
            $message = $this->jadwalMod->getInsert($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/jadwal');

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back()->withInput();

            endif;

        else :
            return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

        endif;
    }

    public function update()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $params = ['slug_jadwal' => $this->req->getVar('slug')];
        $sql    = $this->baseMod->getBy('tb_jadwal', 'slug_jadwal = :slug_jadwal: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count < 1) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $jadwal = $this->baseMod->getRow($sql);
        $data   = [
            'id_bidang' => $this->req->getVar('id_bidang'),
            'tggl'      => $this->req->getVar('tggl'),
            'bln'       => $this->req->getVar('bln'),
            'id_jadwal' => $jadwal['id_jadwal'],
            'jadwal'    => $jadwal['jadwal'],
        ];

        if ($this->valid->run($data, 'jadwal')) :
            $message = $this->jadwalMod->getUpdate($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/jadwal');

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back()->withInput();

            endif;

        else :
            return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

        endif;
    }

    public function delete()
    {
        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $slug    = decode($this->req->getVar('encode'));
        $params1 = ['slug' => $slug];
        $sql1    = $this->baseMod->getBy('tb_jadwal', 'slug_jadwal = :slug: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 < 1) return redirect()->back();

        $jadwal  = $this->baseMod->getRow($sql1);
        $data    = ['id_jadwal' => $jadwal['id_jadwal']];
        $message = $this->jadwalMod->getDelete($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/jadwal');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }
}
