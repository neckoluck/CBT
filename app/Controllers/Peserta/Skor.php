<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Models\Peserta\BaseModel;
use CodeIgniter\HTTP\Response;

class Skor extends BaseController
{

	public function __construct()
    {
        $this->baseMod  = new BaseModel;
    }

    public function index()
    {    
    	$sett   = $this->settMod->sett();
	
    	if (is_null($sett['sesi'])) return redirect()->to('/auth');
    	
    	$sesi   = $this->baseMod->getId('tb_sesi', 'id_sesi', $sett['sesi']);
    	$data   = [
            'title'      => ucwords('Live Skor') . ' - CBT ' . ucwords($this->settMod->sett()['nama_instansi']),
            'content'    => 'peserta/content/skor/skor',
            'page'       => 'live-skor',
            'breadcrumb' => null,
        	'sett'       => $sett,
        	'scoreRoute' => base_url() . '/skor/load-data',
        	'sesi'       => $sesi,
        	'sss'        => is_null($sett['sesi']) ? false : true,
        ];
    
        echo view('peserta/_blank', $data);
        echo view('peserta/template', $data);
    }

	public function load()
    {
    	date_default_timezone_set('Asia/Jakarta');
    
    	$sett   = $this->settMod->sett();
    	$params = ['id_sesi' => $sett['sesi']];
        $sql    = $this->baseMod->getBy('vw_skor', 'id_sesi = :id_sesi:', $params);
        $count  = $this->baseMod->numRows($sql);
    
    	$rows   = $this->baseMod->getRows($sql);
    	$no 	= 0;
    	$body   = '';
    	$sesi   = $this->baseMod->getId('tb_sesi', 'id_sesi', $sett['sesi']);
    	$jadwal = $this->baseMod->getId('tb_jadwal', 'id_jadwal', $sesi['id_jadwal']);
    	$waktu  =  explode('-', $jadwal['jadwal']);
    
    	$head   = '<td class="fs-12 fw-500 text-nowrap">
						Live Score CBT Politeknik Negeri Kupang ' . date('Y') . '
						<span class="d-block fw-400 fs-11">Tanggal. ' . $waktu[2] . '/' . $waktu[1] . '/' . $waktu[0] . '</span>
				   </td>
                   <td class="fs-12 fw-400 text-nowrap">
						sesi - jam:
						<span class="d-block fw-600">SESI ' . $sesi['sesi'] . ' - ' . $sesi['waktu'] . ' - Selesai</span>
				   </td>';
    
       	foreach ($rows as $row) :
			$no++;
    		$body .= '<tr class="fs-11">
                     	<td style="width:0px" class="fw-500">' . $no . '.</td>
                        <td class="text-nowrap fw-500" style="width:0px">' . strtoupper($row['no_pendaftaran']) . '</td>
                       	<td class="text-nowrap text-uppercase fw-500">' . strtoupper($row['nama_peserta']) . '</td>
                        <td style="width:0px" class="fw-500 text-center">' . (is_null($row['kpu'])? 0 : $row['kpu']) . '</td>
                        <td style="width:0px" class="fw-500 text-center">' . (is_null($row['ppu'])? 0 : $row['ppu']) . '</td>
                        <td style="width:0px" class="fw-500 text-center">' . (is_null($row['kmbm'])? 0 : $row['kmbm']) . '</td>
                        <td style="width:0px" class="fw-500 text-center">' . (is_null($row['pk'])? 0 : $row['pk']) . '</td>
                        <td style="width:0px" class="fw-500 text-center">' . (is_null($row['litind'])? 0 : $row['litind']) . '</td>
                        <td style="width:0px" class="fw-500 text-center">' . (is_null($row['liting'])? 0 : $row['liting']) . '</td>
                        <td style="width:0px" class="fw-500 text-center">' . (is_null($row['pm'])? 0 : $row['pm']) . '</td>
                     </tr>';
    
    	endforeach;    	
    
    	$data = [
        	'status' => true,
            'body'   => $body,
        	'head'   => $head,
        	'countt' => $count
        ];
    
    	$this->response->setContentType('application/json');
    	return $this->response->setJSON($data);
    	
    }
}
