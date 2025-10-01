<div class="row">
    <div class="col-lg-12">
        <div class="card">
			<?php if ($page !== 'rekapan-peserta') : ?>
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title fw-300">
                    <?= ucwords($page); ?>
                </h6>
                <div class="header-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-labeled btn-labeled-left dropdown-toggle shadow-1" data-toggle="dropdown"><b><i class="icon-upload"></i></b> Export</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= $baseUrl; ?>/export-excel<?= $export; ?>" target="_blank" class="dropdown-item"><i class="icon-file-excel"></i> EXCEL</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="card-body">
                <div class="row">
                    <?php
                    if ($currentslug != null) :
                        $slug  = $currentslug;
                        if ($endslug != null) $slug = $endslug;

                        $namabidang     = 'semua bidang';
                        if (decode($slug) == '') :
                            $bidang     = $baseMod->getId('tb_bidang', 'slug_nama_bidang', $slug);
                            $namabidang = 'bidang ' . $bidang['nama_bidang'];

                        endif;

                        $prodi_pertama  = 'tampil acak.';
                        $prodi_kedua    = 'tampil acak.';

                        if (decode($slug) != '') :
                            $enkripslug = explode('+', decode($slug));

                            if (count($enkripslug) == 2) :
                                $pisah4  = explode('-', $enkripslug[0]);
                                $prodis1 = end($pisah4);

                                $prodii1       = $baseMod->getId('vw_prodi', 'id_prodi', $prodis1);
                                $prodi_pertama = $prodii1['nama_prodi'];

                                $pisah3  = explode('-', end($enkripslug));
                                $prodis2 = end($pisah3);

                                $prodii2     = $baseMod->getId('vw_prodi', 'id_prodi', $prodis2);
                                $prodi_kedua = $prodii2['nama_prodi'];
                                $bind        = "id_bidang != :bidang1: AND id_bidang != :bidang2:";

                                if ($prodii1['id_bidang'] == $prodii2['id_bidang']) $bind  = "id_bidang = :bidang1:";

                                $sql         = $baseMod->getBy('tb_bidang', "$bind", ['bidang1' => $prodii1['id_bidang'], 'bidang2' => $prodii2['id_bidang']]);
                                $bidang      = $baseMod->getRow($sql);
                                $namabidang  = 'bidang ' . $bidang['nama_bidang'];



                            else :
                                $pisah4 = explode('-', $enkripslug[0]);
                                $value2 = end($pisah4);

                                if ($pisah4[0] == 2) :
                                    $prodii2     = $baseMod->getId('vw_prodi', 'id_prodi', $value2);
                                    $prodi_kedua = $prodii2['nama_prodi'];
                                    $namabidang  = 'bidang ' . $prodii2['nama_bidang'];

                                else :
                                    $prodii1       = $baseMod->getId('vw_prodi', 'id_prodi', $value2);
                                    $prodi_pertama = $prodii1['nama_prodi'];
                                    $namabidang    = 'bidang ' . $prodii1['nama_bidang'];

                                endif;

                            endif;

                        endif;


                    ?>
                        <div class="col-lg-6 pos-title-rekap">
                            <h6 class="fw-700"><u><?= strtoupper($namabidang); ?></u> :</h6>
                            <div class="d-flex">
                                <div class="fw-500 mr-3">
                                    <div class="fw-300 fs-12">Prodi Pilihan Pertama :</div>
                                    <?= ucwords($prodi_pertama); ?>
                                </div>
                                <div class="fw-500">
                                    <div class="fw-300 fs-12">Prodi Pilihan Kedua :</div>
                                    <?= ucwords($prodi_kedua); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-lg-<?= ($currentslug != null) ? '6' : '12'; ?> pos-btn-rekap">
                        <div class="btn-group">
                            <button type="button" class="btn bg-slate-400 btn-labeled btn-labeled-right shadow-1" data-toggle="modal" data-target="#md-filter"><b><i class="icon-filter3"></i></b> Filter</button>
                        </div>
                        <div class="btn-group">

                            <form action="<?= $baseUrl; ?>/rekapan-peserta" method="GET">
                                <button type="button" class="btn bg-slate-400 btn-labeled btn-labeled-left dropdown-toggle shadow-1" data-toggle="dropdown"><b><i class="icon-gallery"></i></b> Pilih Bidang</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php
                                    foreach ($bidangs as $bidang) : ?>
                                        <a href="<?= $baseUrl; ?>/rekapan-peserta/<?= $bidang['slug_nama_bidang']; ?>" class="dropdown-item <?= ($currentslug == $bidang['slug_nama_bidang']) ? 'active' : ''; ?>"><i class="icon-dash fs-12"></i> Bidang <?= ucwords($bidang['nama_bidang']); ?></a>
                                    <?php endforeach; ?>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= $baseUrl; ?>/rekapan" class="dropdown-item"><i class="icon-dash fs-12"></i> Semua</a>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" width="1%">#</th>
                        <th rowspan="2" colspan="2">Nama Peserta</th>
                        <th rowspan="2" class="text-center" width="1%">JK</th>
                    	<th colspan="5" width="1%"  class="text-center">Tes Skolastik</th>
                        <th colspan="4" width="1%"  class="text-center">Tes Literasi</th>
                        <th rowspan="2" width="1%" class="text-nowrap">Total Akhir</th>
                        <th colspan="2" class="text-center" width="1%">Program Studi Pilihan</th>
                        <th rowspan="2" width="1%">Bidang</th>
                        
                    </tr>
                    <tr>
                        <th class="text-nowrap text-center" witdh="1%">KPU</th>
                        <th class="text-nowrap text-center" witdh="1%">PPU</th>
                        <th class="text-nowrap text-center" witdh="1%">KMBM</th>
                        <th class="text-nowrap text-center" witdh="1%">PK</th>
                        <th class="text-nowrap text-center" witdh="1%">Total</th>
                                    
                        <th class="text-nowrap text-center" witdh="1%">LIT IND</th>
                        <th class="text-nowrap text-center" witdh="1%">LIT ING</th>
                        <th class="text-nowrap text-center" witdh="1%">PM</th>
                        <th class="text-nowrap text-center" witdh="1%">Total</th>
                        
                        <th class="text-nowrap" witdh="1%">Pilihan Pertama</th>
                        <th class="text-nowrap" witdh="1%">Pilihan Kedua</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($pesertas as $peserta) :

                        $prodi1    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_pertama']);
                        $poltek1   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_pertama']);
						$nilai1    = ($peserta['kpu'] + $peserta['ppu'] + $peserta['kmbm'] + $peserta['pk']) * (6.5);
						$nilai2    = ($peserta['litind'] + $peserta['liting'] + $peserta['pm']) * (8);
						$total     = $nilai1 + $nilai2;

						/***
						if ($prodi1['id_bidang'] == 2) :
							$nilai1 = (0.25 * $peserta['kpu']) + (0.25 * $peserta['ppu']) + (0.25 * $peserta['kmbm']) + (0.25 * $peserta['pk']) + (0.25 * $peserta['litind']) + (0.25 * $peserta['liting']) + (0.25 * $peserta['pm']);
						else :
							$nilai1 = (0.20 * $peserta['kpu']) + (0.20 * $peserta['ppu']) + (0.20 * $peserta['kmbm']) + (0.20 * $peserta['pk']) + (0.20 * $peserta['litind']) + (0.20 * $peserta['liting']) + (0.35 * $peserta['pm']);

						endif;
                        **/

                        $nmprodi2  = null;
                        $nmpoltek2 = null;	
                        if ($peserta['prodi_kedua'] != null) :
                            $prodi2    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_kedua']);
                            $poltek2   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_kedua']);
							
							
							/***
                        	if ($prodi2['id_bidang'] == 2) :
                            	$nilai2 = (0.25 * $peserta['kpu']) + (0.25 * $peserta['ppu']) + (0.25 * $peserta['kmbm']) + (0.25 * $peserta['pk']) + (0.25 * $peserta['litind']) + (0.25 * $peserta['liting']) + (0.25 * $peserta['pm']);
                        	else :
                            	$nilai2 = (0.20 * $peserta['kpu']) + (0.20 * $peserta['ppu']) + (0.20 * $peserta['kmbm']) + (0.20 * $peserta['pk']) + (0.20 * $peserta['litind']) + (0.20 * $peserta['liting']) + (0.35 * $peserta['pm']);

	                        endif;
                            **/

                            $nmprodi2  = $prodi2['nama_prodi'];
                            $nmpoltek2 = $poltek2['nama_poltek'];

                        endif;

                        $clss1 = '';
                        $clss2 = '';

                        $slug  = $currentslug;
                        if ($endslug != null) $slug = $endslug;

                        if (decode($slug) != '') :
                            $enkripslug = explode('+', decode($slug));

                            if (count($enkripslug) == 2) :
                                $pisah4  = explode('-', $enkripslug[0]);
                                $prodis1 = end($pisah4);

                                $pisah3  = explode('-', end($enkripslug));
                                $prodis2 = end($pisah3);

                                if ($prodis1 == $peserta['prodi_pertama']) $clss1 = 'table-danger';
                                if ($prodis2 == $peserta['prodi_kedua']) :
                                    $clss2 = 'table-warning';

                                endif;

                            else :
                                $pisah4 = explode('-', $enkripslug[0]);
                                $value2 = end($pisah4);

                                $key2    = 'prodi_pertama';
                                if ($pisah4[0] == 2) :
                                    if ($value2 == $peserta['prodi_kedua']) :
                                        $clss2 = 'table-warning';

                                    endif;

                                else :
                                    if ($value2 == $peserta['prodi_pertama']) :
                                        $clss1 = 'table-danger';

                                    endif;

                                endif;

                            endif;

                        endif;


                        $no++; ?>
                        <tr>
                            <td width="1%"><?= $no; ?>.</td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-10 fw-400">NO. PENDAFTARAN</div>
                                <?= $peserta['no_pendaftaran']; ?>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <?= strtoupper($peserta['nama_peserta']); ?>
                                <div class="fs-11 fw-400">NIK. <?= $peserta['nik_peserta']; ?> - NISN. <?= $peserta['nisn_peserta']; ?></div>
                            </td>
                            <td class="fw-500 text-center"><?= strtoupper($peserta['jk_peserta']); ?></td>
							<td class="fw-500 text-center" width="1%"><?= $peserta['kpu']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['ppu']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['kmbm']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['pk']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $nilai1; ?></td>
                            
							<td class="fw-500 text-center" width="1%"><?= $peserta['litind']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['liting']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $peserta['pm']; ?></td>
                            <td class="fw-500 text-center" width="1%"><?= $nilai2; ?></td>
                            <td class="fw-800 text-center fs-14" width="1%"><?= $total; ?></td>

                            <td class="fw-500 text-nowrap <?= $clss1; ?>">
                                <div class="fs-11 fw-400"><?= strtoupper($poltek1['nama_poltek']); ?></div>
                                <?= ucwords($prodi1['nama_prodi']); ?>
                            </td>
                            
                            <td class="fw-500 text-nowrap <?= $clss2; ?>">
                                <?php if ($nmprodi2 != null) : ?>
                                    <div class="fs-11 fw-400"><?= strtoupper($poltek2['nama_poltek']); ?></div>
                                    <?= ucwords($nmprodi2); ?>
                                <?php else : ?>
                                    <div class="text-center">-</div>
                                <?php endif; ?>
                            </td>
                           
                            <td class="fw-500 text-nowrap">Bidang <?= ucwords($peserta['nama_bidang']); ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>