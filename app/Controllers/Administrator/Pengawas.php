<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\StafModel;
use App\Models\Administrator\BaseModel;

class Pengawas extends BaseController
{

    public function __construct()
    {
        $this->stafMod = new StafModel;
        $this->baseMod = new BaseModel;
    }

    public function index()
    {
        remove_sess('type');

        $staf  = $this->stafMod->getResult(1);
        $data  = [
            'title'      => 'Pengawas - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/pengawas/pengawas',
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/pengawas/form-pengawas',
            'page'       => 'data administrator',
            'action'     =>
            [
                'delete' => base_url() . '/administrator/pengawas/delete',
                'akses'  => base_url() . '/administrator/pengawas/access',
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

    public function formpengawas($slug = null)
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
            'title'      => 'Pengawas - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/pengawas/form-pengawas',
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/pengawas',
            'page'       => 'form pengawas',
            'req'        => $this->req,
            'action'     => base_url() . '/administrator/pengawas/' . $action,
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/pengawas',
                'title_breadcrumb' => 'data pengawas'
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
            'title'      => 'Pengawas - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/pengawas/form-keamanan',
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/pengawas',
            'page'       => 'form keamanan',
            'req'        => $this->req,
            'action'     => base_url() . '/administrator/pengawas/' . $action,
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/pengawas',
                'title_breadcrumb' => 'data pengawas'
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

        $status_akses = 0;
        if ($this->req->getVar('status_akses') == null) $status_akses = 1;

        $data =
            [
                'nama_staf'    => strtolower($this->req->getVar('nama_staf')),
                'nip_staf'     => $this->req->getVar('nip_staf'),
                'jk_staf'      => $this->req->getVar('jk_staf'),
                // 'no_telp_staf' => $this->req->getVar('no_telp_staf'),
                'password'     => $this->req->getVar('password'),
                'cpassword'    => $this->req->getVar('cpassword'),
                'namaFile'     => $this->req->getFile('namaFile'),
                'status_akses' => $status_akses,
                'aksi'         => 'in-staf',
                'status_staf'  => 1

            ];

        if ($this->valid->run($data, 'staf') !== false) :
            $message = $this->stafMod->getInsert($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/pengawas');

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back()->withInput();

            endif;

        else :
            session()->setFlashdata('message', '');
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

        if ($this->req->getVar('act') == 'up-keamanan') :

            $data = [
                'newpassword'      => $this->req->getVar('newpassword'),
                'cnewpassword'     => $this->req->getVar('cnewpassword'),
                'id_staf' => $staf['id_staf'],
                'aksi'             => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'aman') !== false) :

                $message = $this->stafMod->getUpdate($data);
                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/pengawas');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;


        elseif ($this->req->getVar('act') == 'up-profil') :

            $akses = 0;
            if ($this->request->getVar('status_akses') == null) $akses = 1;

            $data  =
                [
                    'nama_staf'    => strtolower($this->req->getVar('nama_staf')),
                    'nip_staf'     => $this->req->getVar('nip_staf'),
                    'jk_staf'      => $this->req->getVar('jk_staf'),
                    // 'no_telp_staf' => $this->req->getVar('no_telp_staf'),
                    'namaFile'     => $this->req->getFile('namaFile'),
                    'status_akses' => $akses,
                    'aksi'         => $this->req->getVar('act'),
                    'staf'        => $staf
                ];


            if ($this->valid->run($data, 'profilstaf')) :

                $message = $this->stafMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/pengawas');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                session()->setFlashdata('message', '');
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

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
            return redirect()->to('/administrator/pengawas');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }

    public function access()
    {
        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $pisah = explode('+', decode($this->req->getVar('encode')));

        if (!in_array($pisah[2], [0, 1])) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $params = ['slug' => $pisah[0]];
        $sql    = $this->baseMod->getBy('tb_staf', 'slug_nama_staf = :slug: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count == 0) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $staf     = $this->baseMod->getRow($sql);

        if ($pisah[1] == 'up-akses') :
            $data     = ['slug' => $pisah[0], 'aksi' => $pisah[1], 'status' => $pisah[2], 'id_staf' => $staf['id_staf']];
            $message  = $this->stafMod->getUpdate($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/pengawas');

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back();

            endif;

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;
    }
}
