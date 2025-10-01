<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <?php if (is_null($ruses['mulai_ujian']) || is_null($ruses['selesai_ujian']) || empty($ruses['catatan'])) : ?>
                <div class="card-body bg-warning border-top ">

                    <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                        <a href="#" class="text-light mr-md-3 align-self-md-center mb-3 mb-md-0">
                            <i class="icon-notification2 text-light border-light border-1 rounded-round p-2"></i>
                        </a>

                        <div class="media-body text-center text-md-left">
                            <div class="media-title fs-14 fw-500">Harap Diisi !</div>
                            <span class="fw-300">Mohon untuk mengisi beberapa form seperti <strong>Waktu Mulai</strong>, <strong>Waktu Selesai</strong> dan <strong>Catatan</strong> sebagai infomasi tambahan dengan cara klik tombol <span class="badge bg-primary pd-6 shadow-1"><i class="icon-pencil fs-11"></i></span> untuk memasukan informasi yang ingin diisi.</span>
                        </div>

                    </div>

                </div>
            <?php endif; ?>
            <div class="card-header">
                <h6 class="card-title fw-300">
                    <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1"><?= ucwords($page); ?></a>
                </h6>
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
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-300">Jumlah Hadir :</div>
                                <?= is_empty($peserta['hadir']); ?>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-300">Jumlah Peserta :</div>
                                <?= is_empty($peserta['total']); ?>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <div class="d-flex">
                                    <div>
                                        <div class="fs-12 fw-300">Waktu Mulai :</div>
                                        <?= is_empty($ruses['mulai_ujian']); ?>
                                    </div>
                                    <div class="ml-auto">
                                        <button class="btn btn-sm bg-primary shadow-1 m2 pd-6" data-target="#md-wmulai" data-toggle="modal" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'>Ubah<span>"><i class="icon-pencil fs-11"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <div class="d-flex">
                                    <div>
                                        <div class="fs-12 fw-300">Waktu Selesai :</div>
                                        <?= is_empty($ruses['selesai_ujian']); ?>
                                    </div>
                                    <div class="ml-auto">
                                        <button class="btn btn-sm bg-primary shadow-1 m2 pd-6" data-target="#md-wselesai" data-toggle="modal" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'>Ubah<span>"><i class="icon-pencil fs-11"></i></button>
                                    </div>
                                </div>
                            </td>

                            <td class="fw-400" colspan="2">
                                <div class="d-flex">
                                    <div>
                                        <div class="fs-12 fw-300">Catatan :</div>
                                        <?= ucfirst(is_empty($ruses['catatan'])); ?>
                                    </div>
                                    <div class="ml-auto">
                                        <button class="btn btn-sm bg-primary shadow-1 m2 pd-6" data-target="#md-catatan" data-toggle="modal" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'>Ubah<span>"><i class="icon-pencil fs-11"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th colspan="2" width="1%">Aksi</th>

                        <th colspan="2">Nama Peserta</th>
                        <th class="text-center" width="1%">JK</th>
                        <th width="1%" class="text-nowrap">IP Komputer</th>
                        <th width="1%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($pesertas as $peserta) :

                        $prodi1 = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_pertama']);

                        $nama2  = null;
                        if ($peserta['prodi_kedua'] != null) :
                            $prodi2 = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_kedua']);
                            $nama2  = $prodi2['nama_prodi'];

                        endif;

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

                        $stssess    = 'offline';
                        $csess      = 'light op-0-7';
                        $stsid      = 0;

                        if ($peserta['status_sess'] == 1) :
                            $stssess    = 'online';
                            $csess      = 'success';
                            $stsid      = 1;

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
                                            <a href="<?= $baseUrl; ?>/ruangan-sesi/berita-acara/<?= $peserta['slug_nama_peserta']; ?>" class="dropdown-item fs-11"><i class=" icon-profile"></i> BAUP</a>
											<?php if ($peserta['status_sess'] == 1 || $peserta['status_peserta'] > 0) : ?>
                                            	<div class="dropdown-divider"></div>
                                            	<a href="#" data-toggle="modal" data-target="#md-disconnect" data-encode="<?= encode($peserta['slug_nama_peserta'] . '+up-disconnect'); ?>" class="dropdown-item fs-11 md-disconnect"><i class="icon-switch2"></i> DISCONNECT</a>

	                                            <a href="#" data-toggle="modal" data-target="#md-reset" data-encode="<?= encode($peserta['slug_nama_peserta'] . '+up-reset'); ?>" class="dropdown-item fs-11 md-reset"><i class="icon-reset"></i> RESET IP</a>
											<?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td class="text-center" width="1%">
                                <span class="badge bg-<?= $csess; ?> pd-6 shadow-1 width-badge"><i class="icon-circle-small"></i> <?= strtoupper($stssess); ?></span>
                            </td>


                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-10 fw-400">NO. PENDAFTARAN</div>
                                <?= $peserta['no_pendaftaran']; ?>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <?= strtoupper($peserta['nama_peserta']); ?>
                                <div class="fs-11 fw-400">NIK. <?= $peserta['nik_peserta']; ?> - NISN. <?= $peserta['nisn_peserta']; ?></div>
                            </td>
                            <td class="fw-500 text-center"><?= strtoupper($peserta['jk_peserta']); ?></td>
                            <td class="text-nowrap" width="1%">
                                <?= $peserta['ip_kom']; ?>
                            </td>
                            <td class="text-center" width="1%">
                                <div class="badge bg-<?= is_status('peserta', $peserta['status_peserta'])['color']; ?> pd-6 shadow-1 width-badge-2"><i class="icon-<?= is_status('peserta', $peserta['status_peserta'])['icon']; ?>"></i> <?= strtoupper(is_status('peserta', $peserta['status_peserta'])['mssg']); ?></div>
                            </td>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>