<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\Peserta\BaseModel;
use App\Models\Peserta\DashboardModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->baseMod = new BaseModel;
        $this->dashMod = new DashboardModel;
    }

    public function index()
    {
        $user   = $this->baseMod->sess(session()->get('id'));

        if ($user['status_sess'] == 0) :
            session()->destroy();
            session()->setFlashdata('message', '1-31');
            return redirect()->to('/auth');

        endif;

        if (!is_null($user['sisa_waktu']) && !is_null($user['mulai_ujian'])) :
            if (!is_null($user['selesai_ujian'])) :
                return redirect()->back();

            else :
                return redirect()->to('/peserta/soal');

            endif;

        endif;

        $ruses  = $this->dashMod->getBy($user['id_ruangan_sesi']);

        $parmas = ['id_kelompok_soal' => $ruses['id_kelompok_soal']];
        $sql    = $this->baseMod->getBy('tb_soal', 'id_kelompok_soal = :id_kelompok_soal: AND status_soal = 1 AND status_data = 0', $parmas);
        $count  = $this->baseMod->numRows($sql);

        $data   = [
            'title'      => 'Petunjuk - CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'peserta/content/dashboard/dashboard',
            'page'       => 'dashboard',
            'breadcrumb' => null,
            'user'       => $user,
            'req'        => $this->req,
            'baseMod'    => $this->baseMod,
            'baseUrl'    => base_url() . '/peserta',
            'sett'       => $this->settMod->sett(),
            'ruses'      => $ruses,
            'time'       => $this->time->toTimeString(),
            'jumsoal'    => $count,
            'action'     => base_url() . '/peserta/dashboard/access',
        ];

        echo view('peserta/_blank', $data);
        echo view('peserta/template', $data);
    }

    public function access()
    {
        if (empty($this->req->getPost())) return redirect()->back();

        $data =
            [
                'id_peserta' => session()->get('id'),
                'pin_sesi'   => $this->req->getVar('pin_sesi')
            ];

        if ($this->valid->run($data, 'token')) :
            $message = $this->dashMod->getAccess($data);
            if (current(explode('-', $message)) == 0) :
                session()->set(['pin' => $this->req->getVar('pin_sesi')]);
                session()->setFlashdata('message', $message);
                return redirect()->to('/peserta/soal');

            else :
                session()->setFlashdata('message', $message);
                return redirect()->back()->withInput();

            endif;

        else :
            return redirect()->back()->withInput()->with('validation', $this->valid->getErrors());

        endif;
    }

    public function logout()
    {
        $user  = $this->baseMod->sess(session()->get('id'));
        if (is_null($user['selesai_ujian'])) return redirect()->to('/peserta/soal');

        session()->destroy();
        return redirect()->to('/auth');
    }
}
