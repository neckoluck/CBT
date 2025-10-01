<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\Staf\BaseModel;
use App\Models\Staf\RuanganSesiModel;

class RuanganSesi extends BaseController
{
    public function __construct()
    {
        $this->baseMod  = new BaseModel;
        $this->ruangMod = new RuanganSesiModel;
    }

    public function index()
    {
        $ruses  = $this->ruangMod->getJoin(2, 'ruses.id_pengawas = :id_staf:', ['id_staf' => session()->get('id')]);

        $data   = [
            'title'      => 'Ruangan Sesi - Staf CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'staf/content/sesi/ruangan-sesi',
            'page'       => 'data ruangan sesi',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/staf',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett(),
            'rusess'     => $ruses
        ];

        echo view('staf/_blank', $data);
        echo view('staf/template', $data);
    }

    public function detailruangansesi($slug)
    {
        if ($slug == null) return redirect()->back();

        $ruses   = $this->ruangMod->getJoin(2, 'ruses.slug_ruangan_sesi = :slug:', ['slug' => $slug]);

        if (count($ruses) < 1) return redirect()->back();

        if ($ruses[0]['status_ruangan_sesi'] < 1  || $ruses[0]['status_ruangan_sesi'] == 2) return redirect()->back();

        $sql1    = $this->baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0', ['id' => $ruses[0]['id_ruangan_sesi']]);
        $sql2    = $this->baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0 AND status_peserta != 0 AND status_peserta != 5', ['id' => $ruses[0]['id_ruangan_sesi']]);

        $peserta = $this->baseMod->getRows($sql1);
        $hadir   = $this->baseMod->getRows($sql2);

        $pisah1  = [0 => '', 1 => ''];
        $pisah2  = [0 => '', 1 => ''];

        if ($ruses[0]['mulai_ujian']) $pisah1  = explode(':', $ruses[0]['mulai_ujian']);
        if ($ruses[0]['selesai_ujian']) $pisah2  = explode(':', $ruses[0]['selesai_ujian']);

        $pengawas = $this->baseMod->getId('tb_staf', 'id_staf', $ruses[0]['id_pengawas']);
        $teknisi  = $this->baseMod->getId('tb_staf', 'id_staf', $ruses[0]['id_teknisi']);

        $data     = [
            'title'      => 'Detail Ruangan Sesi - Staf CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'staf/content/sesi/detail-ruangan-sesi',
            'page'       => 'detail ruangan sesi',
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/staf/ruangan-sesi',
                'title_breadcrumb' => 'data ruangan sesi'
            ],
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/staf',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett(),
            'pesertas'   => $peserta,
            'ruses'      => $ruses[0],
            'waktu'      =>
            [
                'mulai'  => $pisah1,
                'seles'  => $pisah2
            ],
            'action'     =>
            [
                'others'     => base_url() . '/staf/ruangan-sesi/update',
                'read'       => base_url() . '/staf/ruangan-sesi/read',
                'access'     => base_url() . '/staf/ruangan-sesi/access',
            ],
            'peserta'    =>
            [
                'total'  => $this->baseMod->numRows($sql1),
                'hadir'  => $this->baseMod->numRows($sql2)
            ],
            'staf'       =>
            [
                'pengawas' => $pengawas,
                'teknisi'  => $teknisi
            ]
        ];

        echo view('staf/_blank', $data);
        echo view('staf/template', $data);
    }

    public function beritaacara($slug)
    {
        if ($slug == null) return redirect()->back();

        $sql     = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug:', ['slug' => $slug]);
        $count   = $this->baseMod->numRows($sql);

        if ($count < 1) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql);
        $ruses   = $this->ruangMod->getJoin(2, 'ruses.id_ruangan_sesi = :id:', ['id' => $peserta['id_ruangan_sesi']]);

        if (count($ruses) < 1) return redirect()->back();

        if ($ruses[0]['status_ruangan_sesi'] < 1 || $ruses[0]['status_ruangan_sesi'] == 2) return redirect()->back();

        $sql1    = $this->baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0', ['id' => $ruses[0]['id_ruangan_sesi']]);
        $sql2    = $this->baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0 AND status_peserta != 0', ['id' => $ruses[0]['id_ruangan_sesi']]);

        $pisah1  = [0 => '', 1 => ''];
        $pisah2  = [0 => '', 1 => ''];

        if ($ruses[0]['mulai_ujian']) $pisah1  = explode(':', $ruses[0]['mulai_ujian']);
        if ($ruses[0]['selesai_ujian']) $pisah2  = explode(':', $ruses[0]['selesai_ujian']);

        $sql1    = $this->baseMod->getBy('tb_berita_acara', 'status_data = :status:', ['status' => 0]);
        $berita  = $this->baseMod->getRows($sql1);

        $data    = [
            'title'      => 'Detail Ruangan Sesi - Staf CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'staf/content/sesi/berita-acara',
            'page'       => 'form berita acara ujian',
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/staf/ruangan-sesi',
                'title_breadcrumb' => 'data ruangan sesi'
            ],
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/staf',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett(),
            'ruses'      => $ruses[0],
            'peserta'    =>
            [
                'total'     => $this->baseMod->numRows($sql1),
                'hadir'     => $this->baseMod->numRows($sql2),
                'peserta'   => $peserta
            ],
            'waktu'      =>
            [
                'mulai'  => $pisah1,
                'seles'  => $pisah2
            ],
            'action'     =>
            [
                'setbaup'    => base_url() . '/staf/ruangan-sesi/insert',
                'others'     => base_url() . '/staf/ruangan-sesi/update',
                'read'       => base_url() . '/staf/ruangan-sesi/read',
                'access'     => base_url() . '/staf/ruangan-sesi/access',
            ],
            'beritas'    => $berita,
        ];

        echo view('staf/_blank', $data);
        echo view('staf/template', $data);
    }

    public function update()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $ruses   = $this->ruangMod->getJoin(2, 'ruses.slug_ruangan_sesi = :slug:', ['slug' => $this->req->getVar('slug')]);
        if (count($ruses) < 1) return redirect()->back();

        if ($this->req->getVar('aksi') == 'up-wmulai') :
            $valid  = $this->validate([
                'waktu_mulai'     =>
                [
                    'rules'  => 'required|trim',
                    'errors' =>
                    [
                        'required'   => 'harap isi bidang ini',
                    ]
                ]
            ]);

            if ($valid) :

                $data      = [
                    'waktu_mulai'     => $this->req->getVar('waktu_mulai'),
                    'id_ruangan_sesi' => $ruses[0]['id_ruangan_sesi'],
                    'aksi'            => 'up-wmulai'
                ];

                $message   = $this->ruangMod->getUpdate($data);

                session()->setFlashdata('message', $message);
                return redirect()->back();

            else :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

        elseif ($this->req->getVar('aksi') == 'up-wselesai') :
            $valid  = $this->validate([
                'waktu_selesai' =>
                [
                    'rules'  => 'required|trim',
                    'errors' =>
                    [
                        'required'   => 'harap isi bidang ini',
                    ]
                ]
            ]);

            if ($valid) :

                $data      = [
                    'waktu_selesai'   => $this->req->getVar('waktu_selesai'),
                    'id_ruangan_sesi' => $ruses[0]['id_ruangan_sesi'],
                    'aksi'            => 'up-wselesai'
                ];

                $message   = $this->ruangMod->getUpdate($data);

                session()->setFlashdata('message', $message);
                return redirect()->back();

            else :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

        elseif ($this->req->getVar('aksi') == 'up-catatan') :

            $valid  = $this->validate([
                'catatan'     =>
                [
                    'rules'  => 'required|trim',
                    'errors' =>
                    [
                        'required'   => 'harap isi bidang ini',
                    ]
                ]
            ]);

            if ($valid) :

                $data      = [
                    'catatan'         => $this->req->getVar('catatan'),
                    'id_ruangan_sesi' => $ruses[0]['id_ruangan_sesi'],
                    'aksi'            => 'up-catatan'
                ];

                $message   = $this->ruangMod->getUpdate($data);

                session()->setFlashdata('message', $message);
                return redirect()->back();

            else :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

        else :

            return redirect()->back();

        endif;
    }

    public function read()
    {
        if (empty($this->req->getPost())) return redirect()->back();
        $pisah   = explode('+', decode($this->req->getPost('encode')));
        $sql     = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug: AND status_data = 0', ['slug' => current($pisah)]);
        $peserta = $this->baseMod->getRow($sql);

        echo json_encode($peserta);
    }

    public function access()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $pisah   = explode('+', decode($this->req->getVar('encode')));
        $params1 = ['slug' => current($pisah)];

        if (!in_array(end($pisah), ['up-reset', 'up-disconnect'])) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $sql1    = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 < 1) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql1);
		
    	/**
        if ($peserta['status_peserta'] == 3 || $peserta['status_peserta'] == 5) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;
		**/
    
        $params1 = ['id_ruangan_sesi' => $peserta['id_ruangan_sesi']];
        $sql1    = $this->baseMod->getBy('tb_ruangan_sesi', 'id_ruangan_sesi = :id_ruangan_sesi: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 < 1) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $ruses   = $this->baseMod->getRow($sql1);

        if (!is_null($ruses['selesai_ujian'])) :
            if ($peserta['status_peserta'] == 3) :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

        endif;
    
    	if ($peserta['status_peserta'] == 5) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;
    
        $array1  =
            [
                'id_peserta' => $peserta['id_peserta'],
                'aksi'       => end($pisah),
            ];

        $data    = $array1;

        if (end($pisah) == 'up-disconnect') :
            $array2 = ['status' => $this->req->getVar('status')];
            $data   = array_merge($array1, $array2);

        endif;

        $message    = $this->ruangMod->getAccess($data);

        session()->setFlashdata('message', $message);
        return redirect()->back();
    }

    public function insert()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $sql1    = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug: AND status_data = 0', ['slug' => $this->req->getVar('slug')]);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 < 1) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql1);

        $data =
            [
                'id_peserta'  => $peserta['id_peserta'],
                'baup'        => $this->req->getVar('baup'),
                'id_pengawas' => session()->get('id')
            ];

        $message    = $this->ruangMod->getInsert($data);

        session()->setFlashdata('message', $message);
        return redirect()->back();
    }
}
