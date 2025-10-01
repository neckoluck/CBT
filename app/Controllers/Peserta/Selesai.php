<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\Peserta\BaseModel;
use App\Models\Peserta\SelesaiModel;

class Selesai extends BaseController
{
    public function __construct()
    {
        $this->baseMod  = new BaseModel;
        $this->selesMod = new SelesaiModel;
    }

    public function index($slug = null)
    {
        if (empty(session()->get('pin'))) return redirect()->back();

        $user   = $this->baseMod->sess(session()->get('id'));

        if ($user['selesai_ujian'] == null) return redirect()->back();

        $title     = "selesai";
        if ($slug != null) $title = "waktu habis";

        $sett   = $this->settMod->sett();
		$skor   = $this->baseMod->getId('vw_skor', 'id_peserta', session()->get('id'));
        $data   = [
            'title'      => ucwords($title) . ' - CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'peserta/content/selesai/selesai',
            'page'       => 'selesai',
            'breadcrumb' => null,
            'user'       => $user,
            'sett'       => $sett,
            'section'    => $title,
            'skor'       =>
            [
                'kpu'    => $skor['kpu'],
                'ppu'    => $skor['ppu'],
                'kmbm'   => $skor['kmbm'],
                'pk'     => $skor['pk'],
            	'litind' => $skor['litind'],
            	'liting' => $skor['liting'],
            	'pm'     => $skor['pm'],
            ]
        ];

        echo view('peserta/_blank', $data);
        echo view('peserta/template', $data);
    }
}
