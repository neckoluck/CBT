<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;
use App\Models\Administrator\RuanganSesiModel;

class RuanganSesi extends BaseController
{
    public function __construct()
    {
        $this->baseMod  = new BaseModel;
        $this->ruangMod = new RuanganSesiModel;
    }

    public function index()
    {
        remove_sess('type');


        $ruses  = $this->ruangMod->getJoin(2);

        $data   = [
            'title'      => 'Ruangan Sesi - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/sesi/ruangan-sesi',
            'page'       => 'data ruangan sesi',
            'breadcrumb' => null,
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'action'     =>
            [
                'delete' => base_url() . '/administrator/ruangan-sesi/delete',
                'others' => base_url() . '/administrator/ruangan-sesi/status',
                'lock'   => base_url() . '/administrator/ruangan-sesi/lock',
                'unlock' => base_url() . '/administrator/ruangan-sesi/unlock',
            ],
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/ruangan-sesi/form-ruangan-sesi',
            'sett'       => $this->settMod->sett(),
            'rusess'     => $ruses,
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function formruangansesi($slug = null)
    {
        remove_sess('type');

        if ($slug != null) :
            $upruses  = $this->ruangMod->getBy($slug);
            $action   = 'update';

            if ($upruses == '1-0') :
                session()->setFlashdata('message', $upruses);
                return redirect()->to('/administrator/ruangan-sesi');

            endif;

        /*
                if ($upruses['mulai_ujian'] != null) :
                    return redirect()->back();
                    
                endif;
            */

        else :
            $upruses  = null;
            $action   = 'insert';

        endif;

        $sesi     = $this->ruangMod->getJoin(1);
        $ruangan  = $this->ruangMod->getResult('tb_ruangan');

        $sql1     = $this->baseMod->getBy('tb_staf', 'status_staf = :status_staf: AND status_data = 0', ['status_staf' => 1]);
        $pengawas = $this->baseMod->getRows($sql1);

        $sql2     = $this->baseMod->getBy('tb_staf', 'status_staf = :status_staf: AND status_data = 0', ['status_staf' => 2]);
        $teknisi  = $this->baseMod->getRows($sql2);

        $bidang   = $this->ruangMod->getResult('tb_bidang');
        $params3  = ['status' => 0];
        $sql3     = $this->baseMod->getBy('tb_kelompok_soal', 'status_data = :status: AND status_data = 0 ORDER BY tahun ASC', $params3);
        $kesol    = $this->baseMod->getRows($sql3);

        $data     = [
            'title'      => 'Ruangan Sesi - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/sesi/form-ruangan-sesi',
            'page'       => 'form ruangan sesi',
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/ruangan-sesi',
                'title_breadcrumb' => 'data ruangan sesi'
            ],
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'ruangMod'   => $this->ruangMod,
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/ruangan-sesi',
            'sett'       => $this->settMod->sett(),
            'action'     =>
            [
                'others' => base_url() . '/administrator/ruangan-sesi/' . $action,
            ],
            'sesis'      => $sesi,
            'staf'       =>
            [
                'pengawas' => $pengawas,
                'teknisi'  => $teknisi
            ],
            'ruangs'     => $ruangan,
            'upruses'    => $upruses,
            'bidangs'    => $bidang,
            'kesols'     => $kesol,

        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function detailruangansesi($slug)
    {
        remove_sess('type');

        if ($slug == null) return redirect()->back();
        $ruses    = $this->ruangMod->getJoin(2, 'ruses.slug_ruangan_sesi = :slug:', ['slug' => $slug]);

        if (count($ruses) < 1) return redirect()->back();

        $sql1    = $this->baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0', ['id' => $ruses[0]['id_ruangan_sesi']]);
        $sql2    = $this->baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0 AND status_peserta != 0 AND status_peserta != 5', ['id' => $ruses[0]['id_ruangan_sesi']]);

        $peserta = $this->baseMod->getRows($sql1);

        $sql11   = $this->baseMod->getBy('tb_peserta', 'id_bidang = :id_bidang: AND id_ruangan_sesi IS NULL AND status_data = 0', ['id_bidang' => $ruses[0]['id_bidang']]);
        $query11 = $this->baseMod->numRows($sql11);

        $sql12   = $this->baseMod->getBy('tb_peserta', 'id_bidang = :id_bidang: AND id_ruangan_sesi = :id_ruangan_sesi: AND status_data = 0', ['id_bidang' => $ruses[0]['id_bidang'], 'id_ruangan_sesi' => $ruses[0]['id_ruangan_sesi']]);
        $query12 = $this->baseMod->numRows($sql12);
        $ruang   = $this->baseMod->getId('tb_ruangan', 'id_ruangan', $ruses[0]['id_ruangan']);

        $pengawas = $this->baseMod->getId('tb_staf', 'id_staf', $ruses[0]['id_pengawas']);
        $teknisi  = $this->baseMod->getId('tb_staf', 'id_staf', $ruses[0]['id_teknisi']);

        $data     = [
            'title'      => 'Ruangan Sesi - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/sesi/detail-ruangan-sesi',
            'page'       => 'detail ruangan sesi',
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/ruangan-sesi',
                'title_breadcrumb' => 'data ruangan sesi'
            ],
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'ruangMod'   => $this->ruangMod,
            'baseUrl'    => base_url() . '/administrator',
            'actUrl'     => base_url() . '/administrator/ruangan-sesi',
            'sett'       => $this->settMod->sett(),
            'action'     =>
            [
                'others' => base_url() . '/administrator/ruangan-sesi/update',
                'delete' => base_url() . '/administrator/ruangan-sesi/kick',
            ],
            'pesertas'   => $peserta,
            'ruses'      => $ruses[0],
            'peserta'    =>
            [
                'total'     => $this->baseMod->numRows($sql1),
                'hadir'     => $this->baseMod->numRows($sql2),
                'jum_belum' => $query11,
                'jum_sudah' => $query12,
                'kapasitas' => $ruang['kapasitas']
            ],
            'staf'       =>
            [
                'pengawas' => $pengawas,
                'teknisi'  => $teknisi
            ]

        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function detailpeserta($slug)
    {
        remove_sess('type');

        if ($slug == null) return redirect()->back();

        $sql     = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug:', ['slug' => $slug]);
        $count   = $this->baseMod->numRows($sql);

        if ($count < 1) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql);
        $ruses   = $this->ruangMod->getJoin(2, 'ruses.id_ruangan_sesi = :id:', ['id' => $peserta['id_ruangan_sesi']]);


        if (count($ruses) < 1) return redirect()->back();

        $sql1   = $this->baseMod->getBy('vw_hasil', 'id_peserta = :id:', ['id' => $peserta['id_peserta']]);
        $query1 = $this->baseMod->getRows($sql1);

        $sql2   = $this->baseMod->getBy('vw_hasil', 'id_peserta = :id_peserta: AND bobot = :bobot:', ['id_peserta' => $peserta['id_peserta'], 'bobot' => 'salah']);

        $sql3   = $this->baseMod->getBy('vw_hasil', 'id_peserta = :id_peserta: AND bobot = :bobot:', ['id_peserta' => $peserta['id_peserta'], 'bobot' => 'benar']);
        $count3 = $this->baseMod->numRows($sql3);


        $count2 = $this->baseMod->numRows($sql2);

        $jawab  = $count3 + $count2;
        $skor   = ($count3 * $this->settMod->sett()['bobot_1']) - $count2;

        $baup   = $this->ruangMod->getResult('tb_berita_acara');

        $pengawas = $this->baseMod->getId('tb_staf', 'id_staf', $ruses[0]['id_pengawas']);
        $teknisi  = $this->baseMod->getId('tb_staf', 'id_staf', $ruses[0]['id_teknisi']);

        if ($peserta['status_peserta'] == 1) :
            $msg    = 'sedang ujian';
            $cbadge = 'info';
            $icon   = 'arrow-up5';

        elseif ($peserta['status_peserta'] == 2) :
            $msg    = 'pindah pc';
            $cbadge = 'warning';
            $icon   = 'arrow-down5';

        elseif ($peserta['status_peserta'] == 3) :
            $msg    = 'selesai ujian';
            $cbadge = 'primary';
            $icon   = 'check2';

        elseif ($peserta['status_peserta'] == 4) :
            $msg    = 'gangguan';
            $cbadge = 'warning';
            $icon   = 'arrow-down5';

        else :
            if (is_null($peserta['mulai_ujian'])) :
                $msg    = 'belum ujian';
                $cbadge = 'danger';
                $icon   = 'arrow-down5';

            else :
                $msg    = 'tidak hadir';
                $cbadge = 'warning';
                $icon   = 'dash';

            endif;

        endif;

        $stssess    = 'sedang offline';
        $csess      = 'light op-0-7';

        if ($peserta['status_sess'] == 1) :
            $stssess    = 'sedang online';
            $csess      = 'success';

        endif;

        $data     = [
            'title'      => 'Detail Peserta - Staf CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'administrator/content/sesi/detail-peserta',
            'page'       => 'Detail Peserta',
            'breadcrumb' =>
            [
                'url_breadcrumb'   => base_url() . '/administrator/ruangan-sesi',
                'title_breadcrumb' => 'data ruangan sesi'
            ],
            'user'       => $this->baseMod->sess(session()->get('id')),
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/administrator',
            'user'       => $this->baseMod->sess(session()->get('id')),
            'sett'       => $this->settMod->sett(),
            'ruses'      => $ruses[0],
            'action'     =>
            [
                'reset'   => base_url() . '/administrator/ruangan-sesi/reset',
            	'restore' => base_url() . '/administrator/ruangan-sesi/restore',
            ],
            'hasil'      => $query1,
            'peserta'    => $peserta,
            'skor'       =>
            [
                'totalskor'  => $skor,
                'totaljawab' => $jawab
            ],
            'baup'       => $baup,
            'staf'       =>
            [
                'pengawas' => $pengawas,
                'teknisi'  => $teknisi
            ],
            'badge1'      =>
            [
                'icon'   => $icon,
                'color'  => $cbadge,
                'msg'    => $msg
            ],
            'badge2'      =>
            [
                'color'  => $csess,
                'msg'    => $stssess
            ]
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function insert()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $data = [
            'id_ruangan'        => $this->req->getVar('id_ruangan'),
            'id_kelompok_soal'  => $this->req->getVar('id_kelompok_soal'),
            'id_sesi'           => $this->req->getVar('id_sesi'),
            'id_pengawas'       => $this->req->getVar('id_pengawas'),
            'id_teknisi'        => $this->req->getVar('id_teknisi'),
        ];

        if ($this->valid->run($data, 'ruses')) :
            $message = $this->ruangMod->getInsert($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/ruangan-sesi');

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
        $ruses    = $this->ruangMod->getJoin(2, 'ruses.slug_ruangan_sesi = :slug:', ['slug' => $this->req->getVar('slug')])[0];

        if (count($ruses) < 1) return redirect()->back();

        $resus  = $ruses;

        if ($this->req->getVar('aksi') == 'up-ruses') :

            $data   = [
                'id_ruangan'       => $this->req->getVar('id_ruangan'),
                'id_kelompok_soal' => $this->req->getVar('id_kelompok_soal'),
                'id_sesi'          => $this->req->getVar('id_sesi'),
                'id_pengawas'      => $this->req->getVar('id_pengawas'),
                'id_teknisi'       => $this->req->getVar('id_teknisi'),
                'slug'             => $this->req->getVar('slug'),
                'id_ruangan_sesi'  => $resus['id_ruangan_sesi'],
                'idpengawas'       => $resus['id_pengawas'],
                'idteknisi'        => $resus['id_teknisi'],
                'aksi'             => 'up-ruangan'
            ];

            if ($this->valid->run($data, 'ruses')) :
                $message = $this->ruangMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->to('/administrator/ruangan-sesi');

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

            endif;

        elseif ($this->req->getVar('aksi') == 'up-peserta') :

            $data    =
                [
                    'jumlah_peserta'  => $this->req->getVar('jumlah_peserta'),
                    'id_bidang'       => $ruses['id_bidang'],
                    'id_ruangan_sesi' => $ruses['id_ruangan_sesi'],
                    'aksi'            => 'up-peserta'
                ];

            if ($this->valid->run($data, 'ruangpeserta')) :
                $message = $this->ruangMod->getUpdate($data);

                if (current(explode('-', $message)) == 0) :
                    session()->setFlashdata('message', $message);
                    return redirect()->back();

                else :
                    session()->setFlashdata('message', $message);
                    return redirect()->back()->withInput();

                endif;

            else :
                session()->setFlashdata('message', '1-0');
                return redirect()->back();

            endif;

        else :
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
        $sql1    = $this->baseMod->getBy('tb_ruangan_sesi', 'slug_ruangan_sesi = :slug: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 < 1) return redirect()->back();

        $ruses   = $this->baseMod->getRow($sql1);
        $data    = ['id_ruangan_sesi' => $ruses['id_ruangan_sesi']];
        $message = $this->ruangMod->getDelete($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/ruangan-sesi');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }

    public function kick()
    {
        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $slug    = decode($this->req->getVar('encode'));
        $params1 = ['slug' => $slug];
        $sql1    = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug: AND status_data = 0', $params1);
        $count1  = $this->baseMod->numRows($sql1);

        if ($count1 < 1) return redirect()->back();

        $ruses   = $this->baseMod->getRow($sql1);
        $data    = ['id_peserta' => $ruses['id_peserta']];
        $message = $this->ruangMod->getKick($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }

    public function status()
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
        $sql    = $this->baseMod->getBy('tb_ruangan_sesi', 'slug_ruangan_sesi = :slug: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count < 1) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $admin     = $this->baseMod->getRow($sql);

        if ($pisah[1] == 'up-ruses') :
            $data     = ['slug' => $pisah[0], 'aksi' => $pisah[1], 'status' => $pisah[2], 'id_ruangan_sesi' => $admin['id_ruangan_sesi']];
            $message  = $this->ruangMod->getUpdate($data);

            if (current(explode('-', $message)) == 0) :
                session()->setFlashdata('message', $message);
                return redirect()->to('/administrator/ruangan-sesi');

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back();

            endif;

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;
    }

    public function reset()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if ($this->req->getVar('slug') == null) return redirect()->back();

        $sql     = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug:', ['slug' => $this->req->getVar('slug')]);
        $count   = $this->baseMod->numRows($sql);

        if ($count < 1) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql);
    
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
    	
		/** tambahan **/     	
    	if ($peserta['status_sess'] == 0 && $peserta['status_peserta'] == 0) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;
    	/** /tambahan **/

        $status1 = decode($this->req->getVar('reset-sw'));
        if ($status1 != 'reset-sw') $status1 = '';


        $status3 = decode($this->req->getVar('reset-kp'));
        if ($status3 != 'reset-kp') $status3 = '';

        $status4 = decode($this->req->getVar('reset-ip'));
        if ($status4 != 'reset-ip') $status4 = '';

        $data =
            [
                'reset-sw'   => $status1,
                'reset-kp'   => $status3,
                'reset-ip'   => $status4,
                'id_peserta' => $peserta['id_peserta'],
                'aksi'       => 'up-reset'
            ];

        if ($this->valid->run($data, 'reset')) :
            $message = $this->ruangMod->getUpdate($data);
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/ruangan-sesi/detail-peserta/' . $this->req->getVar('slug'));

        else :
            session()->setFlashdata('message', '1-0');
            return redirect()->back()->with('validation', $this->valid->getErrors());

        endif;
    }

    public function lock()
    {
        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $pisah  = explode('+', decode($this->req->getVar('encode')));
        $params = ['slug' => current($pisah)];
        $sql    = $this->baseMod->getBy('vw_ruangan_sesi', 'slug_ruangan_sesi = :slug: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count < 1) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $ruses  = $this->baseMod->getRow($sql);

        $data   =
            [
                'id_ruangan_sesi' => $ruses['id_ruangan_sesi'],
                'id_pengawas'     => $ruses['id_pengawas'],
                'waktu_selesai'   => $this->time->toTimeString(),
                'aksi'            => 'up-lock'
            ];

        $message  = $this->ruangMod->getUpdate($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/ruangan-sesi');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }

    public function unlock()
    {
        if (empty($this->req->getVar('encode'))) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $pisah  = explode('+', decode($this->req->getVar('encode')));
        $params = ['slug' => current($pisah)];
        $sql    = $this->baseMod->getBy('vw_ruangan_sesi', 'slug_ruangan_sesi = :slug: AND status_data = 0', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count < 1) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $ruses  = $this->baseMod->getRow($sql);

        $data   =
            [
                'id_ruangan_sesi' => $ruses['id_ruangan_sesi'],
                'id_pengawas'     => $ruses['id_pengawas'],
                'aksi'            => 'up-unlock'
            ];

        $message  = $this->ruangMod->getUpdate($data);

        if (current(explode('-', $message)) == 0) :
            session()->setFlashdata('message', $message);
            return redirect()->to('/administrator/ruangan-sesi');

        else :
            session()->setFlashdata('message', $message);
            return redirect()->back();

        endif;
    }

    public function restore()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        if ($this->req->getVar('slug') == null) return redirect()->back();

        $sql     = $this->baseMod->getBy('tb_peserta', 'slug_nama_peserta = :slug:', ['slug' => $this->req->getVar('slug')]);
        $count   = $this->baseMod->numRows($sql);

        if ($count < 1) return redirect()->back();

        $peserta = $this->baseMod->getRow($sql);

        if (!is_null($peserta['mulai_ujian'])) :
            session()->setFlashdata('message', '1-0');
            return redirect()->back();

        endif;

        $data =
            [
                'id_peserta' => $peserta['id_peserta'],
                'aksi'       => 'up-restore'
            ];

        $message = $this->ruangMod->getUpdate($data);
        session()->setFlashdata('message', $message);
        return redirect()->to('/administrator/ruangan-sesi/detail-peserta/' . $this->req->getVar('slug'));
    }
}
