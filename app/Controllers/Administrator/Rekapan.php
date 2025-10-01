<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\BaseModel;
use App\Models\Administrator\RekapanModel;
// use Dompdf\Dompdf;

class Rekapan extends BaseController
{
    public function __construct()
    {
        $this->baseMod  = new BaseModel;
        $this->rekapMod = new RekapanModel;
        // $this->dompdf   = new Dompdf();
    }

    public function index($currentslug = null, $endslug = null)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        $segment   = $this->req->uri->getSegments();
        unset($segment[0], $segment[1]);

        $exporturi = '';
        if (!empty(join("/", $segment))) $exporturi = '/' . join("/", $segment);

        $bidang    = $this->rekapMod->getResult('tb_bidang');
        $prodi     = $this->rekapMod->getResult('tb_prodi');



        if ($currentslug != null) :
            $sql1     = $this->baseMod->getBy('tb_bidang', 'slug_nama_bidang = :slug:', ['slug' => $currentslug]);
            $count1   = $this->baseMod->numRows($sql1);

            if ($count1 > 0) :
                $query   = $this->baseMod->getRow($sql1);
                $key1    = 'id_bidang';
                $value1  = $query['id_bidang'];

            endif;

            $count2 = 0;
            if (decode($currentslug) != '') :
                $enkripslug = explode('+', decode($currentslug));

                if (count($enkripslug) == 2) :
                    $pisah4 = explode('-', $enkripslug[0]);
                    $prodi1 = end($pisah4);

                    $pisah3 = explode('-', end($enkripslug));
                    $prodi2 = end($pisah3);

                    $bind33   = 'id_prodi = :prodi_pertama: OR id_prodi = :prodi_kedua:';
                    $array33  = ['prodi_pertama' => $prodi1, 'prodi_kedua' => $prodi2];
                    $params33 = $array33;

                else :
                    $pisah4 = explode('-', $enkripslug[0]);
                    $value2 = end($pisah4);

                    $key33   = 'prodi_pertama';
                    if ($pisah4[0] == 2) $key33 = 'prodi_kedua';

                    $bind33   = "id_prodi = :$key33:";
                    $array33  = ["$key33" => $value2];
                    $params33 = $array33;

                endif;

                $sql2    = $this->baseMod->getBy('tb_prodi', "status_data = 0 AND $bind33", $params33);
                $count2  = $this->baseMod->numRows($sql2);
                $pisah1  = $enkripslug;
                $array1  = [];
                $bind    = '';

            else :
                $pisah1  = explode('+', decode($endslug));
                $bind    = "$key1 = :id: AND ";
                $array1  = ['id' => $value1];
                $params  = $array1;

            endif;

            if ($count1 < 1 && $count2 < 1) return redirect()->back();

            if (!empty(current($pisah1))) :
                if (count($pisah1) == 2) :
                    $pisah2 = explode('-', $pisah1[0]);
                    $prodi1 = end($pisah2);

                    $pisah3 = explode('-', end($pisah1));
                    $prodi2 = end($pisah3);

                    $bind  .= 'prodi_pertama = :prodi_pertama: AND prodi_kedua = :prodi_kedua: AND ';
                    $array2 = ['prodi_pertama' => $prodi1, 'prodi_kedua' => $prodi2];
                    $params = array_merge($array1, $array2);

                else :
                    $pisah2 = explode('-', $pisah1[0]);
                    $value2 = end($pisah2);

                    $key2    = 'prodi_pertama';
                    if ($pisah2[0] == 2) $key2 = 'prodi_kedua';

                    $bind  .= "$key2 = :$key2: AND ";
                    $array2 = ["$key2" => $value2];
                    $params = array_merge($array1, $array2);

                endif;

            else :
                $bind  .= "$key1 = :id: AND ";

            endif;

        else :
            $bind   = '';
            $params = '';

        endif;

        $peserta = $this->rekapMod->getJoin($bind, $params);
        $data    = [
            'title'       => 'Rekapan Peserta - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'     => 'administrator/content/rekapan/rekapan-peserta',
            'page'        => $this->request->uri->getSegment(1) !== 'rekapan-peserta' ? 'data rekapan peserta' : $this->request->uri->getSegment(1),
            'breadcrumb'  => null,
            'user'        => $this->baseMod->sess(session()->get('id')),
            'req'         => $this->req,
            'baseMod'     => $this->baseMod,
            'action'      => $this->request->uri->getSegment(1) !== 'rekapan-peserta' ? base_url() . '/administrator/rekapan-peserta/filter' : base_url() . '/rekapan-peserta/filter',
            'baseUrl'     => $this->request->uri->getSegment(1) !== 'rekapan-peserta' ? base_url() . '/administrator' : base_url(),
            'sett'        => $this->settMod->sett(),
            'pesertas'    => $peserta,
            'bidangs'     => $bidang,
            'currentslug' => $currentslug,
            'endslug'     => $endslug,
            'prodis'      => $prodi,
            'export'      => $exporturi,
        ];

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }

    public function filter()
    {
        $currentslug   = $this->req->getVar('slug');
        $pilih_pertama = '';
        if ($this->req->getVar('pilihan_pertama')) $pilih_pertama = '1-' . $this->req->getVar('pilihan_pertama');

        $pilih_kedua = '';
        if ($this->req->getVar('pilihan_kedua')) $pilih_kedua = '2-' . $this->req->getVar('pilihan_kedua');

        $plus    = '';

        if (!empty($pilih_pertama) && !empty($pilih_kedua)) $plus = '+';
        if (!empty($currentslug) && (decode($currentslug) == '')) :
            $sql1    = $this->baseMod->getBy('tb_bidang', 'slug_nama_bidang = :slug:', ['slug' => $this->req->getVar('slug')]);
            $count1  = $this->baseMod->numRows($sql1);

            if ($count1 < 1) return redirect()->back();


        endif;


        if ($pilih_pertama != null) :
            $sql     = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id:', ['id' => $pilih_pertama]);
            $count   = $this->baseMod->numRows($sql);

            if ($count < 1) return redirect()->back();

        endif;


        if ($pilih_kedua != null) :
            $sql2    = $this->baseMod->getBy('tb_prodi', 'id_prodi = :id:', ['id' => $pilih_kedua]);
            $count2  = $this->baseMod->numRows($sql2);

            if ($count2 < 1) return redirect()->back();
        endif;

        $params  = $pilih_pertama . $plus . $pilih_kedua;
	
    	if ($this->request->uri->getSegment(1) == 'rekapan-peserta') :
    		$redirect = '/rekapan-peserta/';
    
    	else :
    		$redirect = '/administrator/rekapan-peserta/';
    
    	endif;

        if (!empty($currentslug) && decode($currentslug) == '') :
            return redirect()->to($redirect . $currentslug . '/' . encode($params));

        else :
            return redirect()->to($redirect . encode($params));

        endif;
    }

    public function exportexcel($currentslug = null, $endslug = null)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        if ($currentslug != null) :
            $sql1     = $this->baseMod->getBy('tb_bidang', 'slug_nama_bidang = :slug:', ['slug' => $currentslug]);
            $count1   = $this->baseMod->numRows($sql1);

            if ($count1 > 0) :
                $query   = $this->baseMod->getRow($sql1);
                $key1    = 'id_bidang';
                $value1  = $query['id_bidang'];

            endif;

            $count2 = 0;
            if (decode($currentslug) != '') :
                $enkripslug = explode('+', decode($currentslug));

                if (count($enkripslug) == 2) :
                    $pisah4 = explode('-', $enkripslug[0]);
                    $prodi1 = end($pisah4);

                    $pisah3 = explode('-', end($enkripslug));
                    $prodi2 = end($pisah3);

                    $bind33   = 'id_prodi = :prodi_pertama: OR id_prodi = :prodi_kedua:';
                    $array33  = ['prodi_pertama' => $prodi1, 'prodi_kedua' => $prodi2];
                    $params33 = $array33;

                else :
                    $pisah4 = explode('-', $enkripslug[0]);
                    $value2 = end($pisah4);

                    $key33   = 'prodi_pertama';
                    if ($pisah4[0] == 2) $key33 = 'prodi_kedua';

                    $bind33   = "id_prodi = :$key33:";
                    $array33  = ["$key33" => $value2];
                    $params33 = $array33;

                endif;

                $sql2    = $this->baseMod->getBy('tb_prodi', "status_data = 0 AND $bind33", $params33);
                $count2  = $this->baseMod->numRows($sql2);
                $pisah1  = $enkripslug;
                $array1  = [];
                $bind    = '';

            else :
                $pisah1  = explode('+', decode($endslug));
                $bind    = "$key1 = :id: AND ";
                $array1  = ['id' => $value1];
                $params  = $array1;

            endif;

            if ($count1 < 1 && $count2 < 1) return redirect()->back();

            if (!empty(current($pisah1))) :
                if (count($pisah1) == 2) :
                    $pisah2 = explode('-', $pisah1[0]);
                    $prodi1 = end($pisah2);

                    $pisah3 = explode('-', end($pisah1));
                    $prodi2 = end($pisah3);

                    $bind  .= 'prodi_pertama = :prodi_pertama: AND prodi_kedua = :prodi_kedua: AND ';
                    $array2 = ['prodi_pertama' => $prodi1, 'prodi_kedua' => $prodi2];
                    $params = array_merge($array1, $array2);

                else :
                    $pisah2 = explode('-', $pisah1[0]);
                    $value2 = end($pisah2);

                    $key2    = 'prodi_pertama';
                    if ($pisah2[0] == 2) $key2 = 'prodi_kedua';

                    $bind  .= "$key2 = :$key2: AND ";
                    $array2 = ["$key2" => $value2];
                    $params = array_merge($array1, $array2);

                endif;

            else :
                $bind  .= "$key1 = :id: AND ";

            endif;

        else :
            $bind   = '';
            $params = '';

        endif;

        $peserta = $this->rekapMod->getJoin($bind, $params);
        $export  = 'excel-peserta';

        $data    = [
            'title'       => 'Export Excel - Administrator CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'     => 'administrator/content/export/' . $export,
            'page'        => 'export',
            'breadcrumb'  => null,
            'user'        => $this->baseMod->sess(session()->get('id')),
            'req'         => $this->req,
            'baseMod'     => $this->baseMod,
            'sett'        => $this->settMod->sett(),
            'pesertas'    => $peserta,
            'currentslug' => $currentslug,
            'endslug'     => $endslug,
        ];


        header("Content-type: application/vnc-ms-excel");
        header("Content-Disposition: attachment; filename=" . randMix(40) . ".xls");
        header("Pragma: no-cache");
        header("Expire: 0");

        echo view('administrator/_blank', $data);
        echo view('administrator/template', $data);
    }
}
