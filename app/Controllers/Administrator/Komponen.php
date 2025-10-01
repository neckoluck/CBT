<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;
use App\Models\Administrator\KomponenModel;

class Komponen extends BaseController
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->kompMod = new KomponenModel;
    }

    public function index()
    {
        remove_sess('type');

        $data   = [
            'title'      => 'Komponen - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/komponen/umum',
            'page'       => 'komponen umum',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseUrl'    => base_url() . '/administrator',
            'breadcrumb' => null,
            'sett'       => $this->settMod->sett(),
            'action'     => base_url() . '/administrator/komponen/umum/update',
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function soal($slug = null)
    {
        remove_sess('type');

        if ($slug != null) :
            $params  = ['slug' => $slug];
            $sql1    = $this->baseMod->getBy('tb_mata_uji', 'slug_mata_uji= :slug: AND status_data = 0', $params);
            $count1  = $this->baseMod->numRows($sql1);

            $sql2    = $this->baseMod->getBy('tb_kelompok_soal', 'slug_kelompok_soal = :slug: AND status_data = 0', $params);
            $count2  = $this->baseMod->numRows($sql2);

            if ($count1 > 0) :
                $upmaju  = $this->baseMod->getRow($sql1);
                $upkesol = null;

            endif;

            if ($count2 > 0) :
                $upkesol = $this->baseMod->getRow($sql2);
                $upmaju  = null;

            endif;

            if ($count1 == 0 && $count2 == 0) :
                session()->setFlashdata('message', '1-0');
                return redirect()->to('/administrator/komponen/soal');

            endif;

            $action  = 'update';

        else :
            $action  = 'insert';
            $upmaju  = null;
            $upkesol = null;

        endif;

        $bidang  = $this->kompMod->getResult('tb_bidang');
        $matauji = $this->kompMod->getResult('vw_mata_uji');

        $kesol   = $this->kompMod->getResult('vw_kelompok_soal');

        $data    = [
            'title'      => 'Komponen - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/komponen/soal',
            'page'       => 'komponen soal',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseUrl'    => base_url() . '/administrator',
            'action'     =>
            [
                'others' => base_url() . '/administrator/komponen/soal/' . $action,
                'delete' => base_url() . '/administrator/komponen/soal/delete'
            ],
            'breadcrumb' => null,
            'upmaju'     => $upmaju,
            'upkesol'    => $upkesol,
            'bidangs'    => $bidang,
            'mataujis'   => $matauji,
            'kesols'     => $kesol,
            'sett'       => $this->settMod->sett(),
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function lainnya($slug = null)
    {
        remove_sess('type');

        if ($slug != null) :
            $params  = ['slug' => $slug];
            $sql1    = $this->baseMod->getBy('tb_ruangan', 'slug_nama_ruangan = :slug: AND status_data = 0', $params);
            $count1  = $this->baseMod->numRows($sql1);

            $sql2    = $this->baseMod->getBy('tb_prodi', 'slug_nama_prodi = :slug: AND status_data = 0', $params);
            $count2  = $this->baseMod->numRows($sql2);

            $sql3    = $this->baseMod->getBy('tb_berita_acara', 'slug_berita_acara = :slug: AND status_data = 0', $params);
            $count3  = $this->baseMod->numRows($sql3);

            $sql4    = $this->baseMod->getBy('tb_poltek', 'slug_nama_poltek = :slug: AND status_data = 0', $params);
            $count4  = $this->baseMod->numRows($sql4);

            if ($count1 > 0) :
                $upruang  = $this->baseMod->getRow($sql1);
                $upprodi  = null;
                $upberita = null;
                $uppoli   = null;

            endif;

            if ($count2 > 0) :
                $upprodi  = $this->baseMod->getRow($sql2);
                $upruang  = null;
                $upberita = null;
                $uppoli   = null;

            endif;

            if ($count3 > 0) :
                $upberita = $this->baseMod->getRow($sql3);
                $upruang  = null;
                $upprodi  = null;
                $uppoli   = null;

            endif;

            if ($count4 > 0) :
                $uppoli   = $this->baseMod->getRow($sql4);
                $upruang  = null;
                $upprodi  = null;
                $upberita = null;

            endif;

            if ($count1 == 0 && $count2 == 0 && $count3 == 0 && $count4 == 0) :
                session()->setFlashdata('message', '1-0');
                return redirect()->to('/administrator/komponen/lainnya');

            endif;

            $action  = 'update';

        else :
            $upprodi  = null;
            $upruang  = null;
            $upberita = null;
            $uppoli   = null;
            $action   = 'insert';

        endif;

        $ruang  = $this->kompMod->getResult('tb_ruangan');
        $bidang = $this->kompMod->getResult('tb_bidang');
        $berita = $this->kompMod->getResult('tb_berita_acara');
        $prodi  = $this->kompMod->getResult('vw_prodi');
        $poli   = $this->kompMod->getResult('tb_poltek');

        $data   = [
            'title'      => 'Komponen - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/komponen/lainnya',
            'baseUrl'    => base_url() . '/administrator',
            'page'       => 'data lainnya',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'action'     =>
            [
                'others' => base_url() . '/administrator/komponen/lainnya/' . $action,
                'delete' => base_url() . '/administrator/komponen/lainnya/delete'
            ],
            'ruangs'     => $ruang,
            'upruang'    => $upruang,
            'upprodi'    => $upprodi,
            'upberita'   => $upberita,
            'uppoli'     => $uppoli,
            'bidangs'    => $bidang,
            'prodis'     => $prodi,
            'polis'      => $poli,
            'beritas'    => $berita,
            'sett'       => $this->settMod->sett(),
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function insert()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if ($this->req->getVar('act') == 'act-ruangan') :

            $data = [
                'ruangan'   => strtolower($this->req->getVar('ruangan')),
                'kapasitas' => $this->req->getVar('kapasitas'),
                'aksi'      => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'ruang')) :
                $message = $this->kompMod->getInsert($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-prodi') :
            $data = [
                'id_bidang' => $this->req->getVar('id_bidang'),
                'prodi'     => strtolower($this->req->getVar('prodi')),
                'aksi'      => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'prodi')) :
                $message = $this->kompMod->getInsert($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-matauji') :
            $data = [
                'id_bidang' => $this->req->getVar('id_bidang'),
                'mata_uji'  => strtolower($this->req->getVar('mata_uji')),
                'aksi'      => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'matauji')) :
                $message = $this->kompMod->getInsert($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/soal');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-kelompoksoal') :
            $data = [
                'idbidang'      => $this->req->getVar('idbidang'),
                'abjad'         => strtolower($this->req->getVar('abjad')),
                'number'        => $this->req->getVar('number'),
                'tahun'         => $this->req->getVar('tahun'),
                'durasi'        => $this->req->getVar('durasi'),
                'jumlah_soal'   => $this->req->getVar('jumlah_soal'),
                'aksi'          => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'kesol')) :
                $message = $this->kompMod->getInsert($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/soal');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-berita') :

            $data = [
                'berita_acara'   => strtolower($this->req->getVar('berita_acara')),
                'aksi'           => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'berita')) :
                $message = $this->kompMod->getInsert($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-poli') :

            $data = [
                'kd_poltek'   => $this->req->getVar('kd_poltek'),
                'nama_poltek' => strtolower($this->req->getVar('nama_poltek')),
                'aksi'        => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'poli')) :
                $message = $this->kompMod->getInsert($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        else :

            session()->setFlashdata('message', '1-0');
            return redirect()->back()->withInput();

        endif;
    }

    public function update()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if ($this->req->getVar('act') == 'act-umum') :

            $sett = $this->settMod->sett();
            $data = [
                'nama_instansi' => strtolower($this->req->getVar('nama_instansi')),
                'url_website'   => strtolower($this->req->getVar('url_website')),
                'namaFile'      => $this->req->getFile('namaFile'),
                'sett'          => $this->settMod->sett(),
                'aksi'          => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'komponen')) :
                $message = $this->kompMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/umum');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-ruangan') :

            $params = ['slug' => $this->req->getVar('slug')];
            $sql    = $this->baseMod->getBy('tb_ruangan', 'slug_nama_ruangan = :slug: AND status_data = 0', $params);
            $count  = $this->baseMod->numRows($sql);

            if ($count < 1) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $ruang  = $this->baseMod->getRow($sql);
            $data   = [
                'ruangan'    => strtolower($this->req->getVar('ruangan')),
                'kapasitas'  => $this->req->getVar('kapasitas'),
                'id_ruangan' => $ruang['id_ruangan'],
                'aksi'       => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'ruang')) :
                $message = $this->kompMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;


        elseif ($this->req->getVar('act') == 'act-berita') :

            $params = ['slug' => $this->req->getVar('slug')];
            $sql    = $this->baseMod->getBy('tb_berita_acara', 'slug_berita_acara = :slug: AND status_data = 0', $params);
            $count  = $this->baseMod->numRows($sql);

            if ($count < 1) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $ruang  = $this->baseMod->getRow($sql);
            $data   = [
                'berita_acara'    => strtolower($this->req->getVar('berita_acara')),
                'id_berita_acara' => $ruang['id_berita_acara'],
                'aksi'            => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'berita')) :
                $message = $this->kompMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;


        elseif ($this->req->getVar('act') == 'act-poli') :

            $params = ['slug' => $this->req->getVar('slug')];
            $sql    = $this->baseMod->getBy('tb_poltek', 'slug_nama_poltek = :slug: AND status_data = 0', $params);
            $count  = $this->baseMod->numRows($sql);

            if ($count < 1) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $poltek = $this->baseMod->getRow($sql);
            $data   = [
                'kd_poltek'   => $this->req->getVar('kd_poltek'),
                'nama_poltek' => strtolower($this->req->getVar('nama_poltek')),
                'id_poltek'   => $poltek['id_poltek'],
                'aksi'        => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'poli')) :
                $message = $this->kompMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-prodi') :

            $params = ['slug' => $this->req->getVar('slug')];
            $sql    = $this->baseMod->getBy('tb_prodi', 'slug_nama_prodi = :slug: AND status_data = 0', $params);
            $count  = $this->baseMod->numRows($sql);

            if ($count < 1) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $prodi = $this->baseMod->getRow($sql);
            $data  = [
                'prodi'     => strtolower($this->req->getVar('prodi')),
                'id_bidang' => $this->req->getVar('id_bidang'),
                'id_prodi'  => $prodi['id_prodi'],
                'aksi'      => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'prodi')) :
                $message = $this->kompMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/lainnya');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-matauji') :

            $params = ['slug' => $this->req->getVar('slug')];
            $sql    = $this->baseMod->getBy('tb_mata_uji', 'slug_mata_uji = :slug: AND status_data = 0', $params);
            $count  = $this->baseMod->numRows($sql);

            if ($count < 1) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $maju = $this->baseMod->getRow($sql);
            $data = [
                'mata_uji'    => strtolower($this->req->getVar('mata_uji')),
                'id_bidang'   => $this->req->getVar('id_bidang'),
                'id_mata_uji' => $maju['id_mata_uji'],
                'aksi'        => $this->req->getVar('act')
            ];

            if ($this->valid->run($data, 'matauji')) :
                $message = $this->kompMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/soal');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('act') == 'act-kelompoksoal') :

            $params = ['slug' => $this->req->getVar('slug')];
            $sql    = $this->baseMod->getBy('tb_kelompok_soal', 'slug_kelompok_soal = :slug: AND status_data = 0', $params);
            $count  = $this->baseMod->numRows($sql);

            if ($count < 1) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

            $kesol = $this->baseMod->getRow($sql);
            $data  = [
                'abjad'            => strtolower($this->req->getVar('abjad')),
                'number'           => $this->req->getVar('number'),
                'tahun'            => $this->req->getVar('tahun'),
                'durasi'           => $this->req->getVar('durasi'),
                'jumlah_soal'      => $this->req->getVar('jumlah_soal'),
                'idbidang'         => $this->req->getVar('idbidang'),
                'aksi'             => $this->req->getVar('act'),
                'id_kelompok_soal' => $kesol['id_kelompok_soal']
            ];

            if ($this->valid->run($data, 'kesol')) :
                $message = $this->kompMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/komponen/soal');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back()->withInput();

        endif;
    }

    public function delete()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $pisah   = explode('+', decode($this->req->getVar('encode')));
        $params1 = ['slug' => current($pisah)];

        if (!in_array(end($pisah), ['act-ruangan', 'act-prodi', 'act-matauji', 'act-kelompoksoal', 'act-berita', 'act-poli'])) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        if (end($pisah) == 'act-berita') :
            $sql1    = $this->baseMod->getBy('tb_berita_acara', 'slug_berita_acara = :slug: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0) return redirect()->back();

            $ruang   = $this->baseMod->getRow($sql1);
            $data    = ['id_berita_acara' => $ruang['id_berita_acara'], 'aksi' => end($pisah)];
            $pTarget = '/administrator/komponen/lainnya';


        elseif (end($pisah) == 'act-poli') :
            $sql1    = $this->baseMod->getBy('tb_poltek', 'slug_nama_poltek = :slug: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0) return redirect()->back();

            $poltek  = $this->baseMod->getRow($sql1);
            $data    = ['id_poltek' => $poltek['id_poltek'], 'aksi' => end($pisah)];
            $pTarget = '/administrator/komponen/lainnya';

        elseif (end($pisah) == 'act-ruangan') :
            $sql1    = $this->baseMod->getBy('tb_ruangan', 'slug_nama_ruangan = :slug: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0) return redirect()->back();

            $ruang   = $this->baseMod->getRow($sql1);
            $data    = ['id_ruangan' => $ruang['id_ruangan'], 'aksi' => end($pisah)];
            $pTarget = '/administrator/komponen/lainnya';

        elseif (end($pisah) == 'act-prodi') :
            $sql1    = $this->baseMod->getBy('tb_prodi', 'slug_nama_prodi = :slug: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0) return redirect()->back();

            $prodi   = $this->baseMod->getRow($sql1);
            $data    = ['id_prodi' => $prodi['id_prodi'], 'aksi' => end($pisah)];
            $pTarget = '/administrator/komponen/lainnya';

        elseif (end($pisah) == 'act-matauji') :
            $sql1    = $this->baseMod->getBy('tb_mata_uji', 'slug_mata_uji = :slug: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0) return redirect()->back();

            $maju    = $this->baseMod->getRow($sql1);
            $data    = ['id_mata_uji' => $maju['id_mata_uji'], 'aksi' => end($pisah)];
            $pTarget = '/administrator/komponen/soal';

        elseif (end($pisah) == 'act-kelompoksoal') :
            $sql1    = $this->baseMod->getBy('tb_kelompok_soal', 'slug_kelompok_soal = :slug: AND status_data = 0', $params1);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 == 0) return redirect()->back();

            $kesol   = $this->baseMod->getRow($sql1);
            $data    = ['id_kelompok_soal' => $kesol['id_kelompok_soal'], 'aksi' => end($pisah)];
            $pTarget = '/administrator/komponen/soal';

        endif;

        $message  = $this->kompMod->getDelete($data);

        session()->setFlashdata('message', $message);
        return redirect()->to($pTarget);
    }
}
