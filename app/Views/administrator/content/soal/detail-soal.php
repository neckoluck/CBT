<div class="row">
    <?php
    $bcolor  = 'warning';
    $status  = 'belum publis';
    $status2 = 'publis soal';
    $icon    = 'eye-blocked2';
    $icon2   = 'eye2';
    $aks     = 1;

    if ($soal['status_soal'] == 1) :
        $bcolor  = 'success';
        $status  = 'sudah publis';
        $status2 = 'batal publis';
        $icon    = 'eye2';
        $icon2   = 'eye-blocked2';
        $aks     = 0;

    endif; ?>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Detail Soal
                </h6>
            </div>
            <div class="card-body">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            </div>
            <div class="card-body">
                <div>
                    <span>
                        <label for="">Kelompok Soal</label>
                        <span class="d-block fw-500"><?= strtoupper($soal['kelompok_soal']); ?> - Bidang <?= ucwords($soal['nama_bidang_kelompok_soal']); ?></span>
                    </span>
                </div>
                <div class="mt-3">
                    <span>
                        <label for="">Mata Uji</label>
                        <span class="d-block fw-500"><?= ucwords($soal['mata_uji']); ?> - Bidang <?= ucwords($soal['nama_bidang_mata_uji']); ?></span>
                    </span>
                </div>

            </div>
            <div class="card-body">
                <a href="<?= $baseUrl; ?>/soal" type="button" class="btn btn-link text-dark">Kembali</a>
                <button type="button" data-toggle="modal" data-target="#md-publis" data-publish="<?= encode($soal['slug_soal'] . '+' .  $aks); ?>" data-status="<?= $aks; ?>" class="btn bg-teal btn-labeled btn-labeled-left btn-sm fs-11 md-publis"><b><i class="icon-<?= $icon2 ?>"></i></b> <?= strtoupper($status2); ?></button>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <div class="text-right">
                    <span>
                        <label class="mr-2">Status Soal :</label>
                        <span class="badge bg-<?= $bcolor; ?> pd-6 shadow-1 width-badge-2"><i class="icon-<?= $icon; ?> mr-1"></i> <?= strtoupper($status); ?></span>
                    </span>
                </div>
            </div>
            <div class="card-body ">
                <div class="">
                    <label for="" class="fw-500">Soal :</label>
                    <?php if (!empty($soal['posisi_gambar'])) : ?>
                        <?php if ($soal['posisi_gambar'] == 1) : ?>
                            <div class="text-center">
                                <img class="mb-3 question-img" src="<?= base_url(); ?>/uploads/pic-question/<?= $soal['gambar_soal']; ?>" alt="">
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div><?= $soal['soal_1']; ?></div>
                    <?php if (!empty($soal['posisi_gambar'])) : ?>
                        <?php if ($soal['posisi_gambar'] == 2) : ?>
                            <div class="text-center">
                                <img class="mb-3 question-img" src="<?= base_url(); ?>/uploads/pic-question/<?= $soal['gambar_soal']; ?>" alt="">
                            </div>
                            <?php if (!empty($soal['soal_2'])) : ?>
                                <div><?= $soal['soal_2']; ?></div>

                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($soal['posisi_gambar'] == 3) : ?>
                            <div class="text-center">
                                <img class="mb-3 question-img" src="<?= base_url(); ?>/uploads/pic-question/<?= $soal['gambar_soal']; ?>" alt="">
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php
                    $sql   = $baseMod->getBy('tb_opsi_jawaban', 'id_soal = :id_soal: ORDER BY opsi ASC', ['id_soal' => $soal['id_soal']]);
                    $count = $baseMod->numRows($sql); ?>
                    <?php
                    if ($count > 0) : ?>
                        <label for="" class="fw-500">Opsi Jawaban :</label>
                        <ul class="media-list">
                            <?php
                            foreach ($baseMod->getRows($sql) as $opsi) :
                                $badge = '';
                                if ($opsi['opsi'] == $soal['jawaban_benar']) $badge = 'bagde bg-success rd-5'; ?>

                                <li class="media">
                                    <div class="mr-3 align-self-center fw-500">
                                        <span class="<?= $badge; ?> pd-7"><?= strtoupper(number_to_str($opsi['opsi'])); ?></span>
                                    </div>

                                    <div class="media-body">
                                        <?= $opsi['jawaban']; ?>
                                        <?php if ($opsi['gambar'] != 'default.jpg') : ?>
                                            <div class="mt-1">
                                                <img class="answer-img" src="<?= base_url(); ?>/uploads/pic-answer/<?= $opsi['gambar']; ?>" alt="">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="mt-4 mb-3">
                        <label for="">Keterangan :</label>
                        <div><span class="bagde bg-success rd-5 fw-500 pd-6 fs-11">OPSI</span> merupakan opsi jawaban yang benar.</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <a href="<?= $baseUrl; ?>/soal/form-soal/<?= $soal['slug_soal']; ?>" type="button" class="btn bg-primary-400 btn-labeled btn-labeled-left btn-sm fs-11"><b><i class="icon-pencil7 fs-12"></i></b> UBAH SOAL</a>
                <a href="#" type="button" data-target="#md-delete" data-delete="<?= encode($soal['slug_soal'] . '+act-soal'); ?>" data-toggle="modal" class="btn bg-danger-400 btn-labeled btn-labeled-left btn-sm fs-11 md-delete"><b><i class="icon-trash fs-12"></i></b> HAPUS SOAL</a>
            </div>
        </div>
    </div>
</div>