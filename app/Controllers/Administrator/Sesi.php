<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;
use App\Models\Administrator\SesiModel;

class Sesi extends BaseController
{

    public function __construct()
    {
        $this->baseMod  = new BaseModel;
        $this->sesiMod  = new SesiModel;
    }

    public function index($slug = null)
    {
        remove_sess('type');

        if ($slug != null) :
            $params  = ['slug' => $slug];
            $sql     = $this->baseMod->getBy('tb_sesi', 'slug_sesi = :slug: AND status_data = 0', $params);
            $count   = $this->baseMod->numRows($sql);

            if ($count == 0) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $upsesi = $this->baseMod->getRow($sql);
            $action = 'update';

        else :
            $upsesi = null;
            $action = 'insert';

        endif;

        $jadwal  = $this->sesiMod->getResult('tb_jadwal');
        $sesi    = $this->sesiMod->getResult('tb_sesi');

        $data    = [
            'title'      => 'Sesi - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/sesi/sesi',
            'baseUrl'    => base_url() . '/administrator',
            'page'       => 'data sesi',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'action'     =>
            [
                'others' => base_url() . '/administrator/sesi/' . $action,
                'delete' => base_url() . '/administrator/sesi/delete'
            ],
            'upsesi'     => $upsesi,
            'jadwals'    => $jadwal,
            'sesis'      => $sesi,
            'sett'       => $this->settMod->sett()
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function insert()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $data = [
            'sesi'             => $this->req->getVar('sesi'),
            'id_jadwal'        => $this->req->getVar('id_jadwal'),
            'id_kelompok_soal' => $this->req->getVar('id_kelompok_soal'),
            'tahun_angkatan'   => $this->req->getVar('tahun_angkatan'),
            'waktu'            => $this->req->getVar('waktu'),

        ];

        if ($this->valid->run($data, 'sesi')) :
            $message = $this->sesiMod->getInsert($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/sesi');

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

        $params = ['slug_sesi' => $this->req->getVar('slug')];
        $sql    = $this->baseMod->getBy('tb_sesi', 'slug_sesi = :slug_sesi: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count == 0) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $sesi = $this->baseMod->getRow($sql);
        $data = [
            'sesi'             => $this->req->getVar('sesi'),
            'id_jadwal'        => $this->req->getVar('id_jadwal'),
            'id_kelompok_soal' => $this->req->getVar('id_kelompok_soal'),
            'tahun_angkatan'   => $this->req->getVar('tahun_angkatan'),
            'waktu'            => $this->req->getVar('waktu'),
            'id_sesi'          => $sesi['id_sesi']
        ];

        if ($this->valid->run($data, 'sesi')) :
            $message = $this->sesiMod->getUpdate($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/sesi');

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
        $sql1    = $this->baseMod->getBy('tb_sesi', 'slug_sesi = :slug: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 == 0) return redirect()->back();

        $sesi    = $this->baseMod->getRow($sql1);
        $data    = ['id_sesi' => $sesi['id_sesi']];
        $message = $this->sesiMod->getDelete($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/sesi');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }
}
