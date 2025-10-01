<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    <?= ucwords($page); ?>
                </h6>
            </div>

            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" width="1%">#</th>
                        <th rowspan="2">Aksi</th>
                        <th rowspan="2" colspan="2">Nama Peserta</th>
                        <th rowspan="2" class="text-center" width="1%">JK</th>
                        <th colspan="2" class="text-center" width="1%">Program Studi Pilihan</th>
                        <th rowspan="2" width="1%">Bidang</th>
                        <th rowspan="2" width="1%">Kontak</th>
                        <th rowspan="2" width="1%">Status Peserta</th>
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

						if ($peserta['prodi_pertama']) :
$prodi1    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_pertama']);
$poltek1   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_pertama']);


						endif;
                        
                        

                        $nmprodi2  = null;
                        $nmpoltek2 = null;
                        if ($peserta['prodi_kedua'] != null) :
                            $prodi2    = $baseMod->getId('vw_prodi', 'id_prodi', $peserta['prodi_kedua']);
                            $poltek2   = $baseMod->getId('tb_poltek', 'id_poltek', $peserta['poltek_kedua']);

                            $nmprodi2  = $prodi2['nama_prodi'];
                            $nmpoltek2 = $poltek2['nama_poltek'];

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

                        $no++; ?>
                        <tr>
                            <td width="1%"><?= $no; ?>.</td>
                            <td width="1%" class="text-center">
                                <div class="list-icons <?= ($peserta['status_peserta'] == 0) ? '' : 'nopointer op-0-7'; ?>">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                            <?php if ($peserta['status_peserta'] == 0) : ?>
                                                <a href="<?= $baseUrl; ?>/peserta/form-peserta/<?= $peserta['slug_nama_peserta']; ?>" class="dropdown-item fs-11"><i class="icon-user-check"></i> UBAH DATA</a>

                                                <?php if (empty($peserta['id_ruangan_sesi'])) : ?>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($peserta['slug_nama_peserta']); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                </div>
                            </td>
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
                                 <?php if ($peserta['prodi_pertama']) : ?>
                                <div class="fs-11 fw-400"><?= strtoupper($poltek1['nama_poltek']); ?></div>
                                <?= ucwords($prodi1['nama_prodi']); ?>
                                 <?php else : ?>
                                 iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                                 <?php endif; ?>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <?php if ($nmprodi2 != null) : ?>
                                    <div class="fs-11 fw-400"><?= strtoupper($poltek2['nama_poltek']); ?></div>
                                    <?= ucwords($nmprodi2); ?>
                                <?php else : ?>
                                    <div class="text-center">-</div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-500 text-nowrap">BIDANG <?= strtoupper($peserta['nama_bidang']); ?></td>
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-400">No. Telp :</div>
                                <?= $peserta['no_telp_peserta']; ?>
                            </td>
                            <td class="text-center" width="5%">
                                <span class="badge bg-<?= is_status('peserta', $peserta['status_peserta'])['color']; ?> pd-6 shadow-1 width-badge-2"><i class="icon-<?= is_status('peserta', $peserta['status_peserta'])['icon']; ?> mr-1"></i> <?= strtoupper(is_status('peserta', $peserta['status_peserta'])['mssg']); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>