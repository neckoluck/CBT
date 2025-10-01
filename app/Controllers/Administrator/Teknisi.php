<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\StafModel;
use App\Models\Administrator\BaseModel;

class Teknisi extends BaseController
{

    public function __construct()
    {
        $this->stafMod = new StafModel;
        $this->baseMod = new BaseModel;
    }

    public function index()
    {
        remove_sess('type');

        $staf  = $this->stafMod->getResult(2);
        $data  = [
            'title'      => 'Teknisi - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/teknisi/teknisi',
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/teknisi/form-teknisi',
            'page'       => 'data administrator',
            'action'     =>
            [
                'delete' => base_url() . '/administrator/teknisi/delete',
                'akses'  => base_url() . '/administrator/teknisi/access',
            ],
            'breadcrumb' => null,
            'req'        => $this->req,
            'stafs'      => $staf,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett()
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function formteknisi($slug = null)
    {
        remove_sess('type');

        if ($slug != null) :
            $params  = ['slug' => $slug];
            $sql     = $this->baseMod->getBy('tb_staf', 'slug_nama_staf = :slug: AND status_data = 0', $params);
            $count   = $this->baseMod->numRows($sql);

            if ($count == 0) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $upadmin = $this->baseMod->getRow($sql);
            $action  = 'update';

        else :
            $upadmin = null;
            $action  = 'insert';

        endif;

        $data   = [
            'title'      => 'Teknisi - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/teknisi/form-teknisi',
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/teknisi',
            'page'       => 'form teknisi',
            'req'        => $this->req,
            'action'     => base_url() . '/administrator/teknisi/' . $action,
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/teknisi',
                'title_breadcrumb' => 'data teknisi'
            ],
            'upadmin'    => $upadmin,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett()
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function formkeamanan($slug)
    {
        remove_sess('type');

        $params  = ['slug' => $slug];
        $sql     = $this->baseMod->getBy('tb_staf', 'slug_nama_staf = :slug: AND status_data = 0', $params);
        $count   = $this->baseMod->numRows($sql);

        if ($count == 0) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;


        $upadmin = $this->baseMod->getRow($sql);
        $action  = 'update';

        $data   = [
            'title'      => 'Teknisi - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/teknisi/form-keamanan',
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/teknisi',
            'page'       => 'form keamanan',
            'req'        => $this->req,
            'action'     => base_url() . '/administrator/teknisi/' . $action,
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/teknisi',
                'title_breadcrumb' => 'data teknisi'
            ],
            'upadmin'    => $upadmin,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett()
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function insert()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $data =
            [
                'nama_staf'    => strtolower($this->req->getVar('nama_staf')),
                'nip_staf'     => $this->req->getVar('nip_staf'),
                'jk_staf'      => $this->req->getVar('jk_staf'),
                'no_telp_staf' => $this->req->getVar('no_telp_staf'),
                'namaFile'     => $this->req->getFile('namaFile'),
                'status_akses' => 1,
                'aksi'         => 'in-staf',
                'status_staf'  => 2

            ];

        if ($this->valid->run($data, 'profilstaf')) :

            $message = $this->stafMod->getInsert($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/teknisi');

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

        $params = ['slug' => $this->req->getVar('slug')];
        $sql    = $this->baseMod->getBy('tb_staf', 'slug_nama_staf = :slug: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count == 0) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $staf  = $this->baseMod->getRow($sql);

        if ($this->req->getVar('act') == 'up-profil') :

            $data  =
                [
                    'nama_staf'    => strtolower($this->req->getVar('nama_staf')),
                    'nip_staf'     => $this->req->getVar('nip_staf'),
                    'jk_staf'      => $this->req->getVar('jk_staf'),
                    'no_telp_staf' => $this->req->getVar('no_telp_staf'),
                    'namaFile'     => $this->req->getFile('namaFile'),
                    'status_akses' => 1,
                    'aksi'         => $this->req->getVar('act'),
                    'staf'        => $staf
                ];

            if ($this->valid->run($data, 'profilstaf')) :

                $message = $this->stafMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/teknisi');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());

            endif;

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

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
        $sql1    = $this->baseMod->getBy('tb_staf', 'slug_nama_staf = :slug: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 == 0) return redirect()->back();

        $staf   = $this->baseMod->getRow($sql1);
        $data    = ['id_staf' => $staf['id_staf'], 'status' => $staf['status_akses']];
        $message = $this->stafMod->getDelete($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/teknisi');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }
}
