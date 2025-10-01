<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;
use App\Models\Administrator\SoalModel;

class Soal extends BaseController
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->soalMod = new SoalModel;
    }

    public function index()
    {
        remove_sess('type');

        $soal   = $this->soalMod->getResult('vw_soal');
        $bidang = $this->soalMod->getResult('tb_bidang');
        $data   = [
            'title'      => 'Soal - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/soal/soal',
            'page'       => 'data soal',
            'breadcrumb' => null,
            'action'     => base_url() . '/administrator/soal/set-question',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => 'md-question',
            'sett'       => $this->settMod->sett(),
            'soals'      => $soal,
            'bidangs'    => $bidang,
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function formsoal($slug = null)
    {
        if ($slug != null) :
            remove_sess('type');

            $action = 'update';
            $upsoal = $this->soalMod->getBy($slug);
            $type   = null;

            $id     = [$upsoal['id_kelompok_soal']];

        else :
            if (empty(session()->get('type'))) return redirect()->to('/administrator/soal');

            $id     = explode('-', decode(session()->get('type')));
            $sql1   = $this->baseMod->getBy('vw_kelompok_soal', 'id_kelompok_soal = :id: AND status_data = 0', ['id' => $id[0]]);
            $count1 = $this->baseMod->numRows($sql1);

            $sql2   = $this->baseMod->getBy('vw_mata_uji', 'id_mata_uji = :id: AND status_data = 0', ['id' => $id[1]]);
            $count2 = $this->baseMod->numRows($sql2);

            if ($count1 < 1) return redirect()->to('/administrator/soal');
            if ($count2 < 1) return redirect()->to('/administrator/soal');

            $kesol  = $this->baseMod->getRow($sql1);
            $maju   = $this->baseMod->getRow($sql2);

            $type   = [
                'kelompok_soal'        => $kesol['kelompok_soal'],
                'bidang_kelompok_soal' => $kesol['nama_bidang'],
                'mata_uji'             => $maju['mata_uji'],
                'bidang_mata_uji'      => $maju['nama_bidang']
            ];

            $action = 'insert';
            $upsoal = null;

        endif;

        $bidang = $this->soalMod->getResult('tb_bidang');

        $slq1   = $this->baseMod->getBy('vw_kelompok_soal', 'status_data = :status: ORDER BY kelompok_soal ASC',  ['status' => 0]);
        $kesol1 = $this->baseMod->getRows($slq1);

        $slq2   = $this->baseMod->getBy('vw_kelompok_soal', 'id_kelompok_soal = :id: AND status_data = :status:',  ['id' => $id[0], 'status' => 0]);
        $kesol2 = $this->baseMod->getRow($slq2);

        $sql3   = $this->baseMod->getBy('tb_soal', 'id_kelompok_soal = :id: AND status_data = 0', ['id' => $kesol2['id_kelompok_soal']]);
        $soal   = $this->baseMod->numRows($sql3);

        $data   = [
            'title'      => 'Soal - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/soal/form-soal',
            'page'       => 'form soal',
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/soal',
                'title_breadcrumb' => 'data soal'
            ],
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/soal',
            'action'     =>
            [
                'others' => base_url() . '/administrator/soal/' . $action,
                'delete' => base_url() . '/administrator/soal/delete'
            ],
            'sett'       => $this->settMod->sett(),
            'bidangs'    => $bidang,
            'upsoal'     => $upsoal,
            'type'       => $type,
            'kesol1'     => $kesol1,
            'kesol2'     => $kesol2,
            'jumsoal'    => $soal
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function detailsoal($slug)
    {
        remove_sess('type');

        if (empty($slug)) return redirect()->back();

        $sql   = $this->baseMod->getBy('vw_soal', 'slug_soal = :slug_soal: AND status_data = 0', ['slug_soal' => $slug]);
        $count = $this->baseMod->numRows($sql);

        if ($count == 0) return redirect()->back();

        $soal  = $this->baseMod->getRow($sql);
        $data  = [
            'title'      => 'Soal - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/soal/detail-soal',
            'page'       => 'detail soal',
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/soal',
                'title_breadcrumb' => 'data soal'
            ],
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => 'md-question',
            'action'     =>
            [
                'publis' => base_url() . '/administrator/soal/publish',
                'delete' => base_url() . '/administrator/soal/delete'
            ],
            'sett'       => $this->settMod->sett(),
            'soal'       => $soal,
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function setquestion()
    {
        $data = [
            'id_kelompok_soal' => $this->req->getVar('id_kelompok_soal'),
            'id_mata_uji'      => $this->req->getVar('id_mata_uji')
        ];

        if ($this->valid->run($data, 'setquestion')) :

            $settype = ['type' => encode($this->req->getVar('id_kelompok_soal') . '-' . $this->req->getVar('id_mata_uji'))];

            session()->set($settype);
            return redirect()->to('/administrator/soal/form-soal');

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;
    }

    public function insert()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $id   = explode('-', decode(session()->get('type')));

        $slq2   = $this->baseMod->getBy('vw_kelompok_soal', 'id_kelompok_soal = :id: AND status_data = :status:',  ['id' => $id[0], 'status' => 0]);
        $kesol2 = $this->baseMod->getRow($slq2);

        $sql3   = $this->baseMod->getBy('tb_soal', 'id_kelompok_soal = :id: AND status_data = 0', ['id' => $kesol2['id_kelompok_soal']]);
        $soal   = $this->baseMod->numRows($sql3);

        if ($soal >= $kesol2['jumlah_soal']) :
            session()->setFlashdata('message', '1-37');
            return redirect()->back();

        endif;

        $data =
            [
                'id_kelompok_soal' => $id[0],
                'id_mata_uji'      => $id[1],
                'soal_1'           => $this->req->getVar('soal_1'),
                'posisi_gambar'    => $this->req->getVar('posisi_gambar'),
                'namaFile'         => $this->req->getFile('namaFile'),
                'namaFile1'        => $this->req->getFile('namaFile1'),
                'namaFile2'        => $this->req->getFile('namaFile2'),
                'namaFile3'        => $this->req->getFile('namaFile3'),
                'namaFile4'        => $this->req->getFile('namaFile4'),
                'namaFile5'        => $this->req->getFile('namaFile5'),
                'soal_2'           => $this->req->getVar('soal_2'),
                'jawaban_1'        => $this->req->getVar('jawaban_1'),
                'jawaban_2'        => $this->req->getVar('jawaban_2'),
                'jawaban_3'        => $this->req->getVar('jawaban_3'),
                'jawaban_4'        => $this->req->getVar('jawaban_4'),
                'jawaban_5'        => $this->req->getVar('jawaban_5'),
                'opsi'             => $this->req->getVar('opsi')

            ];

        if ($this->valid->run($data, 'soal')) :
            $message = $this->soalMod->getInsert($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/soal/form-soal');

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

        $sql   = $this->baseMod->getBy('tb_soal', 'slug_soal = :slug: AND status_data = 0', ['slug' => $this->req->getVar('slug')]);
        $count = $this->baseMod->numRows($sql);

        if ($count < 1) return redirect()->back();

        $soal  = $this->baseMod->getRow($sql);
        $data  =
            [
                'id_kelompok_soal' => $this->req->getVar('id_kelompok_soal'),
                'id_mata_uji'      => $this->req->getVar('id_mata_uji'),
                'soal_1'           => $this->req->getVar('soal_1'),
                'posisi_gambar'    => $this->req->getVar('posisi_gambar'),
                'namaFile'         => $this->req->getFile('namaFile'),
                'namaFile1'        => $this->req->getFile('namaFile1'),
                'namaFile2'        => $this->req->getFile('namaFile2'),
                'namaFile3'        => $this->req->getFile('namaFile3'),
                'namaFile4'        => $this->req->getFile('namaFile4'),
                'namaFile5'        => $this->req->getFile('namaFile5'),
                'soal_2'           => $this->req->getVar('soal_2'),
                'jawaban_1'        => $this->req->getVar('jawaban_1'),
                'jawaban_2'        => $this->req->getVar('jawaban_2'),
                'jawaban_3'        => $this->req->getVar('jawaban_3'),
                'jawaban_4'        => $this->req->getVar('jawaban_4'),
                'jawaban_5'        => $this->req->getVar('jawaban_5'),
                'opsi'             => $this->req->getVar('opsi'),
                'id_soal'          => $soal['id_soal']

            ];

        if ($this->valid->run($data, 'soal')) :
            $message = $this->soalMod->getUpdate($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/soal/detail-soal/' . $soal['slug_soal']);

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back()->withInput();

            endif;

        else :
            return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

        endif;
    }

    public function publish()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $pisah   = explode('+', decode($this->req->getVar('encode')));
        $params  = ['slug' => current($pisah)];
        $sql     = $this->baseMod->getBy('tb_soal', 'slug_soal = :slug: AND status_data = 0', $params);
        $count   = $this->baseMod->numRows($sql);
        if ($count < 1) return '1-0';

        $soal    = $this->baseMod->getRow($sql);
        $data    = ['id_soal' => $soal['id_soal'], 'status_soal' => end($pisah)];
        $message = $this->soalMod->getPublish($data);

        session()->setFlashdata('message', $message);
        return redirect()->back();
    }

    public function delete()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $pisah   = explode('+', decode($this->req->getVar('encode')));
        $params1 = ['id' => current($pisah)];

        if (!in_array(end($pisah), ['act-soal', 'act-imgsoal', 'act-imgopsi'])) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        if (end($pisah) == 'act-soal') :
            $sql1    = $this->baseMod->getBy('tb_soal', 'slug_soal = :id: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0)   return redirect()->back();
            $soal    = $this->baseMod->getRow($sql1);

            $slug    = $soal['slug_soal'];
            $act     = end($pisah);
            $data    = ['id_soal' => $soal['id_soal'], 'act' => $act];
            $target  = '/administrator/soal/';

        elseif (end($pisah) == 'act-imgsoal') :
            $sql1    = $this->baseMod->getBy('tb_soal', 'id_soal = :id: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0)   return redirect()->back();
            $soal    = $this->baseMod->getRow($sql1);
            $slug    = $soal['slug_soal'];
            $act     = end($pisah);
            $data    = ['id_soal' => $soal['id_soal'], 'gambar_soal' => $soal['gambar_soal'], 'act' => $act];
            $target  = '/administrator/soal/form-soal/' . $slug;

        else :
            $sql1    = $this->baseMod->getBy('tb_opsi_jawaban', 'id_opsi_jawaban = :id:', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0) return redirect()->back();

            $opsi    = $this->baseMod->getRow($sql1);

            $sql2    = $this->baseMod->getBy('tb_soal', 'id_soal = :id:', ['id' => $opsi['id_soal']]);
            $soal    = $this->baseMod->getRow($sql2);
            $slug    = $soal['slug_soal'];
            $act     = end($pisah);
            $data    = ['id_opsi_jawaban' => $opsi['id_opsi_jawaban'], 'gambar' => $opsi['gambar'], 'act' => $act];
            $target  = '/administrator/soal/form-soal/' . $slug;

        endif;

        $message = $this->soalMod->getDelete($data);

        session()->setFlashdata('message', $message);
        return redirect()->to($target);
    }
}
