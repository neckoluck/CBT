<div class="row mt-4 mb-5">
    <div class="col-lg-10">
        <?= csrf_field(); ?>
        <div class="question-pos">
            <?php foreach ($soal['soal'] as $sl) :  ?>
                <label for="" class="fw-500 fs-15">Soal - <?= ucwords($sl['mata_uji']); ?> :</label>
                <ol class="fs-15" start="<?= $req; ?>">
                    <li class="p-l-0">
                        <?php if (!empty($sl['posisi_gambar'])) : ?>
                            <?php if ($sl['posisi_gambar'] == 1) : ?>
                                <div class="text-center">
                                    <img class="mb-3 question-img" src="<?= base_url(); ?>/uploads/pic-question/<?= $sl['gambar_soal']; ?>" alt="">
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="fs-15"><?= $sl['soal_1']; ?></div>
                        <?php if (!empty($sl['posisi_gambar'])) : ?>
                            <?php if ($sl['posisi_gambar'] == 2) : ?>
                                <div class="text-center">
                                    <img class="mb-3 question-img" src="<?= base_url(); ?>/uploads/pic-question/<?= $sl['gambar_soal']; ?>" alt="">
                                </div>
                                <?php if (!empty($sl['soal_2'])) : ?>
                                    <div class="fs-15"><?= $sl['soal_2']; ?></div>

                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($sl['posisi_gambar'] == 3) : ?>
                                <div class="text-center">
                                    <img class="mb-3 question-img" src="<?= base_url(); ?>/uploads/pic-question/<?= $sl['gambar_soal']; ?>" alt="">
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </li>
                </ol>
                <label for="" class="fw-500 fs-15 mt-2 mb-2">Opsi Jawaban :</label>
                <ol class="list fs-15 mr-3" type="A">
                    <?php
                    $sql   = $baseMod->getBy('tb_opsi_jawaban', 'id_soal = :id_soal: ORDER BY opsi ASC', ['id_soal' => $sl['id_soal']]);
                    $count = $baseMod->numRows($sql);
                    $no    = 0;
                    foreach ($baseMod->getRows($sql) as $opsi) :
                        $no++; ?>
                        <li class="mb-3">
                            <div class="custom-control custom-radio custom-control-inline ml-2">
                                <input type="radio" class="custom-control-input" name="jawaban" value="<?= encode($opsi['opsi'] . '-' . $sl['id_jawaban']); ?>" id="custom_radio_inline_unchecked_<?= $no; ?>" <?= ($sl['jawaban'] == $opsi['opsi']) ? 'checked' : '' ?>>
                                <label class="custom-control-label fs-15 fw-400" for="custom_radio_inline_unchecked_<?= $no; ?>">
                                    <?= $opsi["jawaban"]; ?>
                                    <?php if ($opsi['gambar'] != 'default.jpg') : ?>
                                        <div class="mt-1">
                                            <img class="answer-img" src="<?= base_url(); ?>/uploads/pic-answer/<?= $opsi['gambar']; ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                </label>
                            </div>

                        </li>
                    <?php endforeach; ?>
                </ol>


            <?php endforeach; ?>

            <div class="d-flex justify-content-between mt-4">
                <?php if ($soal['halaktif'] > 1) : ?>
                    <div class="">
                        <a href="<?= $baseUrl; ?>/soal/<?= $soal['halaktif'] - 1; ?>" class="btn btn-light btn-lg fs-12 shadow-1"><span class="icon-circle-left2 mr-2 "></span> KEMBALI</a>
                    </div>
                <?php endif; ?>
                <?php if ($soal['halaktif'] < $soal['jumhal']) : ?>
                    <div class="">
                        <a href="<?= $baseUrl; ?>/soal/<?= $soal['halaktif'] + 1; ?>" class="btn bg-slate btn-lg fs-12 shadow-1 ml-2">BERIKUT <span class="icon-circle-right2 ml-2"></span></a>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
         <!--   
         <div class="row finish">
             <div class="col-lg">
                 <div class="pd-5 p-t-0">
                     <button type="button" data-toggle="modal" data-target="#md-finish" class="btn bg-warning-400 btn-block shadow-3 fw-600 fs-15">SELESAI UJIAN <span class="icon-paperplane ml-2"></span></button>
                 </div>
             </div>
        </div>
        Actions -->
        <div class="action-question-button mt-3">
            <div class="row no-gutters">
                <?php
                $i = 0;
                foreach ($soal['jawab'] as $jb) :
                    $i++;

                    $cl = "";
                    if ($i == $req) $cl = "bg-slate-400";
                    if ($jb['jawaban'] != null) :

                        $cl = "bg-blue-400";
                        if ($i == $req) $cl = "bg-blue-600";

                    endif; ?>

                    <div class="col-3">
                        <div class="m-1">

                            <a href="<?= $baseUrl; ?>/soal/<?= $i; ?>" type="button" class="btn btn-light btn-block shadow-1 <?= $cl; ?>">
                                <span><?= $i; ?></span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg">
                <label for="" class="d-block fw-400">Keterangan : </label>
                <div class="mt-1">
                    <div class="media">
                        <div class="mr-3 nopointer">
                            <button type="button" class="btn btn-light shadow-1">
                                <span class="pd-1"></span>
                            </button>
                        </div>

                        <div class="media-body align-self-center">
                            <span class="fs-12">Soal tidak aktif dan belum dijawab.</span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="media">
                        <div class="mr-3 nopointer">
                            <button type="button" class="btn btn-light shadow-1 bg-slate-400">
                                <span class="pd-1"></span>
                            </button>
                        </div>

                        <div class="media-body align-self-center">
                            <span class="fs-12">Soal aktif.</span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="media">
                        <div class="mr-3 nopointer">
                            <button type="button" class="btn btn-light shadow-1 bg-blue-400">
                                <span class="pd-1"></span>
                            </button>
                        </div>

                        <div class="media-body align-self-center">
                            <span class="fs-12">Soal sudah dijawab.</span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="media">
                        <div class="mr-3 nopointer">
                            <button type="button" class="btn btn-light shadow-1 bg-blue-600">
                                <span class="pd-1"></span>
                            </button>
                        </div>

                        <div class="media-body align-self-center">
                            <span class="fs-12">Soal aktif dan sudah dijawab.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /actions -->
    </div>
</div>