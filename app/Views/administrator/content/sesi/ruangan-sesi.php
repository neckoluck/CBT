<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1"><?= ucwords($page); ?></a>
                </h6>
            </div>
            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" width="1%">#</th>
                        <th colspan="2" rowspan="2">Aksi</th>
                        <th colspan="3" rowspan="2">Ruangan - Sesi</th>

                        <th rowspan="2" colspan="2" width="1%" class="text-nowrap">Bidang - Kelompok Soal</th>
                        <th colspan="2" rowspan="2" class="text-center">Staf Pengurus Ruangan</th>
                        <th colspan="2" class="text-center" width="1%">Jumlah</th>
                        <th colspan="2" rowspan="2" class="text-nowrap">Waktu Ujian</th>
                        <th rowspan="2" width="1%" class="text-nowrap">PIN Sesi</th>
                    </tr>
                    <tr>
                        <th class="text-center text-nowrap" width="1%">Hadir</th>
                        <th class="text-center text-nowrap" width="1%">Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($rusess as $ruses) :

                        $pengawas = $baseMod->getId('tb_staf', 'id_staf', $ruses['id_pengawas']);
                        $teknisi  = $baseMod->getId('tb_staf', 'id_staf', $ruses['id_teknisi']);

                        $sql1     = $baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0', ['id' => $ruses['id_ruangan_sesi']]);
                        $sql2     = $baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0 AND status_peserta != 0 AND status_peserta != 5', ['id' => $ruses['id_ruangan_sesi']]);

                        $count1   = $baseMod->numRows($sql1);
                        $count2   = $baseMod->numRows($sql2);


                        if ($ruses['status_ruangan_sesi'] != 0) :
                            $icon = 'dash';
                            $sts  = 'Nonaktifkan';
                            $bg   = 'warning';
                            $aks  = 0;

                        else :
                            $icon = 'check2';
                            $sts  = 'Aktifkan';
                            $bg   = 'success';
                            $aks  = 1;

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
                                            <a href="<?= $baseUrl; ?>/ruangan-sesi/detail-ruangan-sesi/<?= $ruses['slug_ruangan_sesi']; ?>" class="dropdown-item fs-11"><i class="icon-eye8"></i> DETAIL</a>
                                            <a href="<?= $baseUrl; ?>/ruangan-sesi/form-ruangan-sesi/<?= $ruses['slug_ruangan_sesi']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                            <?php if ($ruses['mulai_ujian'] == null) : ?>
                                                <div class="dropdown-divider"></div>
                                                <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($ruses['slug_ruangan_sesi']); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center" width="5%">
                                <div class="d-flex">
                                    <?php if ($ruses['status_ruangan_sesi'] != 2) : ?>
                                        <?php if ($ruses['mulai_ujian'] == null) : ?>
                                            <button type="button" data-toggle="modal" data-target="#md-ruses" data-status="<?= $aks; ?>" data-access="<?= encode($ruses['slug_ruangan_sesi'] . '+up-ruses+' . $aks); ?>" class="btn bg-<?= $bg; ?>-400 btn-sm shadow-1 m2 md-ruses" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'><?= $sts; ?> sesi<span>"><i class="icon-<?= $icon; ?>"></i></button>

                                        <?php else : ?>
                                            <button type="button" data-toggle="modal" data-target="#md-lock" data-lock="<?= encode($ruses['slug_ruangan_sesi'] . '+up-lock'); ?>" class="btn bg-slate btn-sm shadow-1 m2 md-lock" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'>Kunci sesi<span>"><i class="icon-unlocked2"></i></button>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <button type="button" data-toggle="modal" data-target="#md-unlock" data-unlock="<?= encode($ruses['slug_ruangan_sesi'] . '+up-unlock'); ?>" class="btn bg-light btn-sm shadow-1 m2 md-unlock" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'>Buka sesi<span>"><i class="icon-lock5"></i></button>

                                    <?php endif; ?>
                                </div>
                            </td>
                        	<td class="fw-500 text-nowrap" width="1%">
                                SESI <?= $ruses['sesi']; ?>
                                <div class="fw-300 fs-12"><?= $ruses['waktu']; ?> <span class="fs-11">(<?= strtoupper(getRegards($ruses['waktu'])); ?>)
                                    </span></div>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                RUANG. <?= strtoupper($ruses['nama_ruangan']); ?>

                            </td>
                            
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-12 fw-300">Tggl Ujian.</div>
                                <?= indoDate($ruses['jadwal']); ?>
                            </td>

                            <td class="text-nowrap" width="1%">Bidang <?= ucwords($ruses['nama_bidang']); ?></td>
                            <td class="text-nowrap text-center fw-500" width="1%"><?= strtoupper($ruses['kelompok_soal']); ?></td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-12 fw-300">Pengawas</div>
                                <?= strtoupper(is_gender($pengawas['jk_staf']) . $pengawas['nama_staf']); ?>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-12 fw-300">Teknisi</div>
                                <?= strtoupper(is_gender($teknisi['jk_staf']) . $teknisi['nama_staf']); ?>
                            </td>
                            <td class="text-center"><?= $count2; ?></td>
                            <td class="text-center"><?= $count1; ?></td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <?php if ($ruses['mulai_ujian'] != null) : ?>
                                    <div class="fs-12 fw-300">Mulai Ujian</div>
                                    <?= $ruses['mulai_ujian']; ?>
                                <?php else : ?>
                                    <div class="text-center">-</div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <?php if ($ruses['selesai_ujian'] != null) : ?>
                                    <div class="fs-12 fw-300">Selesai Ujian</div>
                                    <?= $ruses['selesai_ujian']; ?>
                                <?php else : ?>
                                    <div class="text-center">-</div>
                                <?php endif; ?>
                            </td>
                            <!-- <td class="text-normal">
                                <?php if (strlen($ruses['catatan']) <= 20) : ?>
                                    <?= empty($ruses['catatan']) ? '<div class="text-center">-</div>' : ucfirst($ruses['catatan']); ?>

                                <?php else : ?>
                                    <?= substr(ucfirst($ruses['catatan']), 0, 20); ?>.[..]
                                    <a href="#md-read" class="md-read" data-toggle="modal" data-notes="<?= ucfirst($ruses['catatan']); ?>">Baca Selanjutnya..</a>

                                <?php endif; ?>
                            </td> -->
                            <td class="text-nowrap text-center" width="1%"><?= $ruses['pin_sesi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>