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
                        <th rowspan="2">Aksi</th>
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

                        $cls      = '';
                        if ($ruses['status_ruangan_sesi'] == 0)  $cls  = 'nopointer op-0-4';

                        $sql1     = $baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0', ['id' => $ruses['id_ruangan_sesi']]);
                        $sql2     = $baseMod->getBy('vw_peserta', 'id_ruangan_sesi = :id: AND status_data = 0 AND status_peserta != 0 AND status_peserta != 5', ['id' => $ruses['id_ruangan_sesi']]);
                        $total    = $baseMod->numRows($sql1);
                        $hadir    = $baseMod->numRows($sql2);


                        $no++; ?>
                        <tr class="<?= $cls; ?>">
                            <td width="1%"><?= $no; ?>.</td>
                            <td class="text-center" width="5%">
                                <?php if ($ruses['status_ruangan_sesi'] < 1) : ?>
                                    <button class="btn btn-light btn-sm m2 nopointer"><i class="icon-blocked"></i></button>

                                <?php else : ?>
                                    <?php if ($ruses['status_ruangan_sesi'] != 2) : ?>
                                        <a href="<?= $baseUrl; ?>/ruangan-sesi/detail-ruangan-sesi/<?= $ruses['slug_ruangan_sesi']; ?>" type="button" class="btn bg-slate-400 btn-sm m2 shadow-1" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'>Detail sesi<span>"><i class="icon-equalizer"></i></a>

                                    <?php else : ?>
                                        <button class="btn btn-light btn-sm m2 nopointer"><i class="icon-lock"></i></button>

                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                RUANG. <?= strtoupper($ruses['nama_ruangan']); ?>

                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                SESI <?= $ruses['sesi']; ?>
                                <div class="fw-300 fs-12"><?= $ruses['waktu']; ?> <span class="fs-11">(<?= strtoupper(getRegards($ruses['waktu'])); ?>)
                                    </span></div>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-12 fw-300">Tggl Ujian.</div>
                                <?= indoDate($ruses['jadwal']); ?>
                            </td>

                            <td class="text-nowrap text-center" width="1%">Bidang <?= ucwords($ruses['nama_bidang']); ?></td>
                            <td class="text-nowrap text-center fw-500" width="1%"><?= strtoupper($ruses['kelompok_soal']); ?></td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-12 fw-300">Pengawas</div>
                                <?= strtoupper(is_gender($pengawas['jk_staf']) . $pengawas['nama_staf']); ?>
                            </td>
                            <td class="fw-500 text-nowrap" width="1%">
                                <div class="fs-12 fw-300">Teknisi</div>
                                <?= strtoupper(is_gender($teknisi['jk_staf']) . $teknisi['nama_staf']); ?>
                            </td>
                            <td class="text-center"><?= $hadir; ?></td>
                            <td class="text-center"><?= $total; ?></td>
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
                            <td class="text-nowrap text-center" width="1%"><?= $ruses['pin_sesi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="card-body">
                <label for="">Keterangan :</label>
                <div class="media">
                    <div class="mr-3 nopointer">
                        <button class="btn btn-light btn-sm m2 nopointer shadow-1"><i class="icon-blocked"></i></button>
                    </div>

                    <div class="media-body align-self-center">
                        <span class="fs-12">Ruangan Sesi nonaktif. Hubungin Administrator untuk mengaktifkan Ruangan Sesi jika belum diaktifkan.</span>
                    </div>
                </div>
                <div class="media mt-0">
                    <div class="mr-3 nopointer">
                        <button class="btn btn-light btn-sm m2 nopointer shadow-1"><i class="icon-lock"></i></button>
                    </div>

                    <div class="media-body align-self-center">
                        <span class="fs-12">Ruangan Sesi dikunci. Hubungin Administrator untuk membuka kembali Ruangan Sesi jika sudah terkunci.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>