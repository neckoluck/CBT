<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;
use App\Models\Administrator\PesertaModel;

class Peserta extends BaseController
{
    public function __construct()
    {
        $this->baseMod    = new BaseModel;
        $this->pesertaMod = new PesertaModel;
    }

    public function index()
    {
        remove_sess('type');

        $peserta = $this->pesertaMod->getResult('vw_peserta');
        $data    = [
            'title'      => 'Peserta - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/peserta/peserta',
            'page'       => 'data peserta',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/peserta/form-peserta',
            'sett'       => $this->settMod->sett(),
            'pesertas'   => $peserta,
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function formpeserta($slug = null)
    {
        remove_sess('type');
    
    	// $csc = session()->remove('arrypeserta');
    	// dd(session()->remove('arrypeserta'));

        if ($slug != null) :
            $action    = 'update';
            $sql       = $this->baseMod->getBy('vw_peserta', 'slug_nama_peserta = :slug: AND status_data = 0', ['slug' => $slug]);
            $count     = $this->baseMod->numRows($sql);

            if ($count < 1) return redirect()->back();

            $uppeserta = $this->baseMod->getRow($sql);


        else :
            $action    = 'insert';
            $uppeserta = null;

        endif;

        $peserta = null;
        if (!empty(session()->get('arrypeserta'))) $peserta = session()->get('arrypeserta');

        $prodi   = $this->pesertaMod->getResult('vw_prodi');
        $poltek  = $this->pesertaMod->getResult('tb_poltek');
        $data    = [
            'title'      => 'Peserta - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/peserta/form-peserta',
            'page'       => 'form peserta',
            'action'     =>
            [
                'insert' => base_url() . '/administrator/peserta/insert',
                'import' => base_url() . '/administrator/peserta/import',
                'delete' => base_url() . '/administrator/peserta/delete',
                'others' => base_url() . '/administrator/peserta/' . $action,
            ],
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/peserta',
            'sett'       => $this->settMod->sett(),
            'prodi'      => $prodi,
            'uppeserta'  => $uppeserta,
            'poltek'     => $poltek,
            'pesertas'   => $peserta
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function importulang()
    {
        if (!empty(session()->get('arrypeserta'))) :
            remove_sess('arrypeserta');

        endif;

        return redirect()->to('/administrator/peserta/form-peserta');
    }

    public function import()
    {
        $data = [
            'namaFile' => $this->req->getFile('namaFile')
        ];

        if ($this->valid->run($data, 'import')) :
            $message = $this->pesertaMod->getImport($data);
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/peserta/form-peserta');

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;
    }

    public function insert()
    {
        if ($this->req->getVar('aksi') == "in-peserta") :

            if (!empty(session()->get('arrypeserta'))) :
                remove_sess('arrypeserta');

            endif;

            $data = [
                'nik_peserta'     => $this->req->getVar('nik_peserta'),
                'no_pendaftaran'  => $this->req->getVar('no_pendaftaran'),
                'nisn_peserta'    => $this->req->getVar('nisn_peserta'),
                'nama_peserta'    => $this->req->getVar('nama_peserta'),
                'jk_peserta'      => $this->req->getVar('jk_peserta'),
                'id_poltek1'      => $this->req->getVar('id_poltek1'),
                'id_prodi1'       => $this->req->getVar('id_prodi1'),
                'id_poltek2'      => $this->req->getVar('id_poltek2'),
                'id_prodi2'       => $this->req->getVar('id_prodi2'),
                'no_telp_peserta' => $this->req->getVar('no_telp_peserta'),
                'aksi'            => 'in-peserta'
            ];

            if ($this->valid->run($data, 'peserta')) :
                $message = $this->pesertaMod->getInsert($data);
                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/peserta');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('aksi') == "in-import") :

            if (!empty(session()->get('arrypeserta'))) :

                $data    = [
                    'peserta' => session()->get('arrypeserta'),
                    'aksi'    => 'in-import'
                ];

                $message = $this->pesertaMod->getInsert($data);

                if (!empty(session()->get('arrypeserta'))) :
                    remove_sess('arrypeserta');

                endif;

                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/peserta');

            else :
                session()->setFlashdata('message', '1-1');
                return redirect()->back();

            endif;

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back()->withInput();

        endif;
    }

    public function update()
    {
        $sql     = $this->baseMod->getBy('vw_peserta', 'slug_nama_peserta = :slug: AND status_data = 0', ['slug' => $this->req->getVar('slug')]);
        $count   = $this->baseMod->numRows($sql);

        if ($count < 1) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql);

        $data = [
            'nik_peserta'     => $this->req->getVar('nik_peserta'),
            'no_pendaftaran'  => $this->req->getVar('no_pendaftaran'),
            'nisn_peserta'    => $this->req->getVar('nisn_peserta'),
            'nama_peserta'    => $this->req->getVar('nama_peserta'),
            'jk_peserta'      => $this->req->getVar('jk_peserta'),
            'id_poltek1'      => $this->req->getVar('id_poltek1'),
            'id_prodi1'       => $this->req->getVar('id_prodi1'),
            'id_poltek2'      => $this->req->getVar('id_poltek2'),
            'id_prodi2'       => $this->req->getVar('id_prodi2'),
            'no_telp_peserta' => $this->req->getVar('no_telp_peserta'),
            'id_peserta'      => $peserta['id_peserta']
        ];

        if ($this->valid->run($data, 'peserta')) :
            $message = $this->pesertaMod->getUpdate($data);
            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/peserta');

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
        $sql1    = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 == 0) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql1);
        $data    = ['id_peserta' => $peserta['id_peserta']];
        $message = $this->pesertaMod->getDelete($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/peserta');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }
}
