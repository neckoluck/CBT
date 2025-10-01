<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\Peserta\BaseModel;
use App\Models\Peserta\DashboardModel;
use App\Models\Peserta\SoalModel;


class Soal extends BaseController
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->soalMod = new SoalModel;
        $this->dashMod = new DashboardModel;
    }

    public function index($page = null)
    {

        $user   = $this->baseMod->sess(session()->get('id'));
        $ruses  = $this->dashMod->getBy($user['id_ruangan_sesi']);

        if ($user['status_sess'] == 0) :
            session()->destroy();
            session()->setFlashdata('message', '1-31');
            return redirect()->to('/auth');

        endif;

        /* tambahan */
        if ($user['selesai_ujian'] != null) return redirect()->back();

        if ($user['status_peserta'] == 4) :
            session()->set(['pin' => $ruses['pin_sesi']]);

        endif;

        if (empty(session()->get('pin'))) return redirect()->back();
        if (empty(session()->get('expire'))) session()->set(['expire' => time()]);;

        /* /tambahan */
    	
		/** diganti      	
    	if ($user['status_peserta'] == 4) :
            session()->set(['pin' => $ruses['pin_sesi']]);

        endif;

        if (empty(session()->get('pin'))) return redirect()->back();
        if ($user['selesai_ujian'] != null) return redirect()->back();
    
    	/** /diganti **/ 

        $params = ['id_peserta' => session()->get('id'), 'id_kelompok_soal' => $ruses['id_kelompok_soal']];
        $sql    = $this->baseMod->getBy('vw_jawaban', 'id_peserta = :id_peserta: AND id_kelompok_soal = :id_kelompok_soal:', $params);
        $count  = $this->baseMod->numRows($sql);

        if ($count < 1) :
            $data  = [
                'id_kelompok_soal' => $ruses['id_kelompok_soal'],
                'id_peserta'       => session()->get('id'),
            ];

            $this->soalMod->getInsert($data);

        endif;

        $berlalu = time() - session()->get('expire') + session()->get('sisawaktu');
        $arry    = [
            'sisa_waktu' => $berlalu,
            'id_peserta' => session()->get('id'),
            'aksi'       => 'up-sisawaktu'
        ];

        $this->soalMod->getUpdate($arry);

        $temp_waktu = ($ruses['durasi'] * 60) - $berlalu;


        $temp_menit = (int)($temp_waktu / 60);
        $temp_detik = $temp_waktu % 60;

        if ($temp_menit < 60) :
            $jam    = 0;
            $menit  = $temp_menit;
            $detik  = $temp_detik;

        else :
            $jam    = (int)($temp_menit / 60);
            $menit  = $temp_menit % 60;
            $detik  = $temp_detik;

        endif;

        $dataPerHal = 1;
        $sql1       = $this->baseMod->getBy('vw_jawaban', 'id_peserta = :id_peserta:', ['id_peserta' => session()->get('id')]);
        $jumData    = $this->baseMod->numRows($sql1);

        $jumHal     = ceil($jumData / $dataPerHal);
        $halAktif   = ($page != null) ? $page : 1;
        $awalData   = ($dataPerHal * $halAktif) - $dataPerHal;
        $sql2       = $this->baseMod->getBy("vw_jawaban", "id_peserta = :id_peserta: ORDER BY id_jawaban ASC LIMIT $awalData, $dataPerHal", ['id_peserta' => session()->get('id')]);
        $soal       = $this->baseMod->getRows($sql2);

        $sql3       = $this->baseMod->getBy('tb_jawaban', 'id_peserta = :id:', ['id' => session()->get('id')]);
        $query3     = $this->baseMod->getRows($sql3);

        if ($page > $jumData) return redirect()->back();

        $data       = [
            'title'      => 'Soal - CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'peserta/content/soal/soal',
            'page'       => 'soal',
            'breadcrumb' => null,
            'user'       => $user,
            'req'        => ($page == null) ? $page = 1 : $page,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/peserta',
            'sett'       => $this->settMod->sett(),
            'ruses'      => $ruses,
            'action'     =>
            [
                'others' => base_url() . '/peserta/soal/update',
                'finish' => base_url() . '/peserta/soal/selesaiujian',
            ],
            'waktu'      =>
            [
                'jam'    => $jam,
                'menit'  => $menit,
                'detik'  => $detik
            ],
            'time'       => $this->time->toTimeString(),
            'soal'       =>
            [
                'soal'      => $soal,
                'halaktif'  => $halAktif,
                'jumhal'    => $jumHal,
                'jumdata'   => $jumData,
                'jawab'     => $query3
            ]
        ];

        echo view('peserta/_blank', $data);
        echo view('peserta/template', $data);
    }

    public function waktuhabis()
    {
        if (empty(session()->get('pin'))) return redirect()->back();

        $user   = $this->baseMod->sess(session()->get('id'));
        if ($user['selesai_ujian'] != null) return redirect()->back();

        $data =
            [
                'id_peserta'    => session()->get('id'),
                'waktu_selesai' => $this->time->toTimeString(),
                'aksi'          => 'up-waktuhabis'
            ];

        $this->soalMod->getUpdate($data);

        return redirect()->to('/peserta/selesai/waktu-habis');
    }

    public function selesaiujian()
    {
        if (empty(session()->get('pin'))) return redirect()->back();

        $user   = $this->baseMod->sess(session()->get('id'));
        if ($user['selesai_ujian'] != null) return redirect()->back();

        $data =
            [
                'id_peserta'    => session()->get('id'),
                'waktu_selesai' => $this->time->toTimeString(),
                'aksi'          => 'up-waktuhabis'
            ];

        $this->soalMod->getUpdate($data);

        return redirect()->to('/peserta/selesai');
    }


    public function update()
    {
        if (empty(session()->get('pin'))) return redirect()->back();

        $user   = $this->baseMod->sess(session()->get('id'));
        if ($user['selesai_ujian'] != null) return redirect()->back();

        $data =
            [
                'jawaban' => $this->req->getPost('jawaban'),
                'aksi'    => 'up-jawab'
            ];

        $this->soalMod->getUpdate($data);
    }
}
