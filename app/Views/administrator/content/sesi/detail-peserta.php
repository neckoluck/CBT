<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title fw-300">
                    Jawaban
                </h6>
                <div class="header-elements">
                    <a href="<?= $baseUrl; ?>/ruangan-sesi/detail-ruangan-sesi/<?= $ruses['slug_ruangan_sesi']; ?>" class="btn btn-light btn-labeled btn-labeled-left shadow-1 btn-sm"><b><i class="icon-arrow-left22"></i></b> KEMBALI</a>
                </div>
            </div>
            <?php if (count($hasil) > 1) : ?>
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th class="text-nowrap fs-11 table-active">JAWABAN BENAR</th>
                        <td class="table-active">:</td>
                        <td class="table-active fs-11 fw-500"><?= count($hasil); ?></td>
                        <?php foreach ($hasil as $jawaban) : ?>
                            <td class="fw-400 fs-11 table-active"><?= number_to_str($jawaban['jawaban_benar']); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr class="">
                        <th class="text-nowrap fs-11 table-active">JAWABAN PESERTA</th>
                        <td class="table-active">:</td>
                        <td class="table-active fs-11 fw-500"><?= $skor['totaljawab']; ?></td>
                        <?php
                        foreach ($hasil as $jawaban_peserta) :
                            if ($jawaban_peserta['bobot'] == 'benar') :
                                $clss = 'table-success';

                            elseif ($jawaban_peserta['bobot'] == 'salah') :
                                $clss = 'table-danger';

                            else :
                                $clss = 'table-active';

                            endif; ?>
                            <td class="fw-400 fs-11 <?= $clss; ?>"><?= number_to_str($jawaban_peserta['jawaban']); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th class="text-nowrap fs-11 table-active">SKOR</th>
                        <td class="table-active">:</td>
                        <th class="table-active" colspan="<?= count($hasil) + 1; ?>"><?= $skor['totalskor']; ?></th>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    <!-- Left sidebar component -->
    <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">
        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Navigation -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid rounded-circle img-border" src="<?= base_url(); ?>/uploads/pic-user/peserta/default.jpg" width="100" height="100" alt="">
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="fw-500" colspan="2">
                                <div class="fw-300 fs-12">Nama Peserta :</div>
                                <?= strtoupper($peserta['nama_peserta']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-500" colspan="2">
                                <div class="fw-300 fs-12">No. Pendaftaran - NIK :</div>
                                <?= $peserta['no_pendaftaran'] . ' - ' . $peserta['nik_peserta']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-500">
                                <div class="fw-300 fs-12">Sesi/Ruangan :</div>
                                <?= $ruses['sesi'] . ' / ' . $ruses['nama_ruangan']; ?>
                            </td>
                            <td class="fw-500">
                                <div class="fw-300 fs-12">Bidang :</div>
                                <?= ucwords($ruses['nama_bidang']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if ($ruses['status_ruangan_sesi'] != 2) :  ?>
                    <?php $validation = session()->getFlashdata('validation'); ?>
                    <form action="<?= $action['reset']; ?>" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="slug" value="<?= $peserta['slug_nama_peserta']; ?>">
                        <div class="card-body border-top-0 table-warning p-b-0 p-t-13">
                            <div class="media">
                                <div class="mr-2">
                                    <input type="checkbox" id="sisa" name="reset-sw" value="<?= encode('reset-sw'); ?>" class="form-check-input-styled" data-fouc>
                                </div>

                                <label for="sisa" class="media-body fs-11 text-uppercase fw-400 hov-pointer">
                                    Reset Waktu Ujian
                                    <div class="fs-9 c-444 fw-600">mereset waktu selesai ujian.</div>
                                </label>
                            </div>
                        </div>
                        <div class="card-body p-b-10 p-t-13">
                            <div class="media">
                                <div class="mr-2">
                                    <input type="checkbox" id="ip" name="reset-ip" value="<?= encode('reset-ip'); ?>" class="form-check-input-styled" data-fouc>
                                </div>

                                <label for="ip" class="media-body fs-11 text-uppercase fw-400 hov-pointer">
                                    Reset IP Komputer
                                    <div class="fs-9 c-444 fw-600">Jika peserta pindah workstation</div>
                                </label>
                            </div>
                        </div>
                        <div class="card-body p-b-10 p-t-15">

                            <div class="media">
                                <div class="mr-2">
                                    <input type="checkbox" name="reset-kp" value="<?= encode('reset-kp'); ?>" id="koneksi" class="form-check-input-styled<?= !empty($validation['reset-kp']) ? '-danger' : ''; ?>" data-fouc>
                                </div>

                                <label for="koneksi" class="media-body fs-11 fw-400 hov-pointer">
                                    <span class="text-uppercase">
                                        Reset Koneksi
                                        <div class="fs-9 c-444 fw-600">centang jika ingin mereset pilihan lain</div>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-warning btn-labeled btn-block btn-labeled-left shadow-1 btn-sm"><b><i class="icon-reset"></i></b> RESET</button>
                        </div>
                    </form>
            		<?php if ($peserta['status_peserta'] != 0 && is_null($peserta['mulai_ujian'])) : ?>
                        <div class="card-body">
                            <button type="button" data-target="#md-restore" data-toggle="modal" class="btn btn-danger btn-labeled btn-block btn-labeled-left shadow-1 btn-sm"><b><i class="icon-history"></i></b> SET ULANG</button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <!-- /navigation -->
        </div>
        <!-- /sidebar content -->
    </div>
    <!-- /left sidebar component -->


    <!-- Right content -->
    <div class="w-100">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="fw-500">
                                    <div class="fs-12 fw-300">IP Komputer :</div>
                                    <?= empty($peserta['ip_kom']) ? '-' : $peserta['ip_kom']; ?>
                                </td>
                                <td class="fw-500">
                                    <div class="fs-12 fw-300">Status Koneksi :</div>
                                    <span class="badge bg-<?= $badge2['color']; ?> pd-5 width-badge-2 shadow-1"><i class="icon-circle-small"></i> <?= strtoupper($badge2['msg']); ?></span>
                                </td>
                                <td class="fw-500">
                                    <div class="fs-12 fw-300">Status Peserta :</div>
                                    <span class="badge bg-<?= is_status('peserta', $peserta['status_peserta'])['color']; ?> pd-5 width-badge-2 shadow-1"><i class="icon-<?= is_status('peserta', $peserta['status_peserta'])['icon']; ?>"></i> <?= strtoupper(is_status('peserta', $peserta['status_peserta'])['mssg']); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-500">
                                    <div class="fs-12 fw-300">Waktu Mulai :</div>
                                    PUKUL. <?= is_null($peserta['mulai_ujian']) ? '-' : $peserta['mulai_ujian']; ?>
                                </td>
                                <td class="fw-500">
                                    <div class="fs-12 fw-300">Waktu Selesai :</div>
                                    PUKUL. <?= is_null($peserta['selesai_ujian']) ? '-' : $peserta['selesai_ujian']; ?>
                                </td>
                                <td class="fw-500">
                                    <div class="fs-12 fw-300">Waktu Berjalan :</div>
                                    <?= is_null($peserta['sisa_waktu']) ? '-' : decimalToTime($peserta['sisa_waktu'] / 60); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-header bg-white">
                        <h6 class="card-title fw-300">
                            Berita Acara
                        </h6>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($baup as $ba) :
                                $no++;
                                $sql   = $baseMod->getBy('tb_baup', 'id_peserta = :id_peserta: AND id_berita_acara = :id_berita_acara:', ['id_peserta' => $peserta['id_peserta'], 'id_berita_acara' => $ba['id_berita_acara']]);
                                $count = $baseMod->numRows($sql);
                                $query = $baseMod->getRow($sql);

                                $status = 'dash fs-10';
                                if (!is_null($query)) $status = 'check2'; ?>
                                <tr>
                                    <td width="1%"><?= $no; ?>.</td>
                                    <td class="fs-11"><?= strtoupper($ba['berita_acara']); ?></td>
                                    <td class="text-center" width="1%"><i class="icon-<?= $status; ?>"></i></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="fw-500">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /right content -->

</div>
<!-- /inner container -->