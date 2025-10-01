<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Data Soal
                </h6>
            </div>
            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">Aksi</th>
                        <th class="text-nowrap">Kelompok Soal</th>
                        <th>Mata Uji</th>
                        <th>Soal Tes</th>
                        <th>Status Soal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($soals as $soal) :
                        $bcolor  = 'warning';
                        $status  = 'belum publis';
                        $icon    = 'eye-blocked2';
                        $aks     = 1;

                        if ($soal['status_soal'] == 1) :
                            $bcolor  = 'success';
                            $status  = 'sudah publis';
                            $icon    = 'eye2';
                            $aks     = 0;

                        endif;

                        $no++; ?>
                        <tr>
                            <td width="1%"><?= $no; ?>.</td>
                            <td width="1%" class="text-center">
                                <a href="<?= $baseUrl; ?>/soal/detail-soal/<?= $soal['slug_soal']; ?>" type="button" class="btn bg-slate btn-sm" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'>Cek soal<span>"><i class="icon-eye8"></i></a>

                            </td>

                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-300">Bidang <?= ucwords($soal['nama_bidang_kelompok_soal']); ?></div>
                                <?= strtoupper($soal['kelompok_soal']); ?>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-300">Bidang <?= ucwords($soal['nama_bidang_mata_uji']); ?></div>
                                <?= strtoupper($soal['mata_uji']); ?>
                            </td>
                            <td>
                                <div class="fs-12 fw-500">Soal Paragraf Pertama :</div>
                                <?= $soal['soal_1']; ?>

                                <?php if (!empty($soal['soal_2'])) : ?>
                                    <div class="fs-12 fw-500">Soal Paragraf Kedua :</div>
                                    <?= $soal['soal_2']; ?>

                                <?php endif; ?>
                            </td>
                            <td width="1%">
                                <span class="badge bg-<?= $bcolor; ?> pd-6 shadow-1 width-badge-2"><i class="icon-<?= $icon; ?> mr-1"></i> <?= strtoupper($status); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>