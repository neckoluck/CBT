<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title fw-300">
                    <?= ucwords($page); ?>
                </h6>
                <?php if (is_null($ruses['mulai_ujian'])) : ?>
                    <div class="header-elements">
                        <button type="button" data-target="#md-setpeserta" data-toggle="modal" class="btn bg-teal-400 btn-labeled btn-labeled-right shadow-1"><b><i class="icon-plus22"></i></b> TAMBAH PESERTA</button>
                    </div>
                <?php endif; ?>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-500" colspan="4">
                                <div class="fs-12 fw-300">Sesi/Ruangan :</div>
                                <?= $ruses['sesi'] . '/' . ucwords($ruses['nama_ruangan']); ?> - Bidang <?= ucwords($ruses['nama_bidang']); ?>
                            </td>
                            <td class="fw-500">
                                <div class="fs-12 fw-300">Nama Pengawas :</div>
                                <?= strtoupper(is_gender($staf['pengawas']['jk_staf']) . $staf['pengawas']['nama_staf']) ?>
                            </td>
                            <td class="fw-500">
                                <div class="fs-12 fw-300">Nama Teknisi :</div>
                                <?= strtoupper(is_gender($staf['teknisi']['jk_staf']) . $staf['teknisi']['nama_staf']) ?>
                            </td>
                        </tr>
                        <tr>

                            <td class="fw-500">
                                <div class="fs-12 fw-300">Jumlah Hadir :</div>
                                <?= is_empty($peserta['hadir']); ?>
                            </td>
                            <td class="fw-500">
                                <div class="fs-12 fw-300">Jumlah Peserta :</div>
                                <?= is_empty($peserta['total']); ?>
                            </td>
                            <td class="fw-500">
                                <div class="fs-12 fw-300">Waktu Mulai :</div>
                                <?= is_empty($ruses['mulai_ujian']); ?>
                            </td>
                            <td class="fw-500">
                                <div class="fs-12 fw-300">Waktu Selesai :</div>
                                <?= is_empty($ruses['selesai_ujian']); ?>
                            </td>
                            <td class="fw-400" colspan="2">
                                <div class="fs-12 fw-300">Catatan :</div>
                                <?= ucfirst(is_empty($ruses['catatan'])); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" width="1%">#</th>
                        <th rowspan="2" colspan="2">Aksi</th>
                        <th rowspan="2" width="1%">Skor</th>
                        <th rowspan="2" colspan="2">Nama Peserta</th>
                        <th rowspan="2" class="text-center" width="1%">JK</th>
                        <th colspan="2" class="text-center" width="1%">Program Studi Pilihan</th>
<!--                         <th rowspan="2" width="1%">Bidang</th> -->
                        <th rowspan="2" width="1%">Kontak</th>

                        <th rowspan="2" width="1%" class="text-nowrap">IP Komputer</th>
                        <th rowspan="2" width="1%">Status</th>
                    </tr>
                    <tr>
                        <th class="text-nowrap" witdh="1%">Pilihan Pertama</th>
                        <th class="text-nowrap" witdh="1%">Pilihan Kedua</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($pesertas as $peserta) :

                        $sql1   = $baseMod->getBy('vw_hasil', 'id_peserta = :id_peserta: AND bobot = :bobot:', ['id_peserta' => $peserta['id_peserta'], 'bobot' => 'benar']);
                        $count1 = $baseMod->numRows($sql1);

                        $sql2   = $baseMod->getBy('vw_hasil', 'id_peserta = :id_peserta: AND bobot = :bobot:', ['id_peserta' => $peserta['id_peserta'], 'bobot' => 'salah']);
                        $count2 = $baseMod->numRows($sql2);


                        $sql4   = $baseMod->getBy('tb_jawaban', 'id_peserta = :id_peserta:', ['id_peserta' => $peserta['id_peserta']]);
                        $count4 = $baseMod->numRows($sql4);

                        $jawab  = $count1 + $count2;
                     	$skor   = ($count1 * $sett['bobot_1']) + ($count2 * $sett['bobot_2']);
					// 	$skor   = $count1;

                        $prodi1    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_pertama']);
                        $poltek1   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_pertama']);

                        $nmprodi2  = null;
                        $nmpoltek2 = null;
                        if ($peserta['prodi_kedua'] != null) :
                            $prodi2    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_kedua']);
                            $poltek2   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_kedua']);

                            $nmprodi2  = $prodi2['nama_prodi'];
                            $nmpoltek2 = $poltek2['nama_poltek'];

                        endif;

                        $no++; ?>
                        <tr>
                            <td width="1%"><?= $no; ?>.</td>
                            <td width="1%" class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                            <a href="<?= $baseUrl; ?>/ruangan-sesi/detail-peserta/<?= $peserta['slug_nama_peserta']; ?>" class="dropdown-item fs-11"><i class="icon-eye8"></i> DETAIL</a>
                                            <?php if ($ruses['status_ruangan_sesi'] != 2) : ?>
                                                <?php if ($peserta['status_peserta'] == 0) : ?>
                                                    <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($peserta['slug_nama_peserta']); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-exit"></i> KELUARKAN</a>

                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td class="text-center" width="1%">
                                <span class="badge bg-<?= is_status('sess', $peserta['status_peserta'])['color']; ?> pd-6 shadow-1 width-badge"><i class="icon-circle-small"></i> <?= strtoupper(is_status('sess', $peserta['status_peserta'])['mssg']); ?></span>
                            </td>
                            <td class="fw-500 text-center"><?= $skor; ?></td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-10 fw-400">NO. PENDAFTARAN</div>
                                <?= $peserta['no_pendaftaran']; ?>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <?= strtoupper($peserta['nama_peserta']); ?>
                                <div class="fs-11 fw-400">NIK. <?= $peserta['nik_peserta']; ?> - NISN. <?= $peserta['nisn_peserta']; ?></div>
                            </td>
                            <td class="fw-500 text-center"><?= strtoupper($peserta['jk_peserta']); ?></td>

                            <td class="fw-500 text-nowrap">
                                <div class="fs-11 fw-400"><?= strtoupper($poltek1['nama_poltek']); ?></div>
                                <?= ucwords($prodi1['nama_prodi']); ?>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <?php if ($nmprodi2 != null) : ?>
                                    <div class="fs-11 fw-400"><?= strtoupper($poltek2['nama_poltek']); ?></div>
                                    <?= ucwords($nmprodi2); ?>
                                <?php else : ?>
                                    <div class="text-center">-</div>
                                <?php endif; ?>
                            </td>
<!--                             <td class="fw-500 text-nowrap">BIDANG <?= strtoupper($peserta['nama_bidang']); ?></td> -->
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-400">No. Telp :</div>
                                <?= $peserta['no_telp_peserta']; ?>
                            </td>
                            <td class="text-nowrap" width="1%">
                                <?= $peserta['ip_kom']; ?>
                            </td>
                            <td class="text-center" width="1%">
                                <div class="badge bg-<?= is_status('peserta', $peserta['status_peserta'])['color']; ?> pd-6 shadow-1 width-badge-2"><i class="icon-<?= is_status('peserta', $peserta['status_peserta'])['icon']; ?>"></i> <?= strtoupper(is_status('peserta', $peserta['status_peserta'])['mssg']); ?></div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>