<!-- Basic modal -->
<div id="md-logout" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda yakin ingin keluar ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
                <a href="<?= base_url(); ?>/staf/logout" class="btn bg-primary">Ya</a>
            </div>
        </div>
    </div>
</div>
<!-- /basic modal -->

<?php if ($page == 'detail ruangan sesi') : ?>
    <!-- Basic modal -->

    <!-- Basic modal -->
    <div id="md-pin" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-body text-center pd-200">
                    <div class="">
                        <div class="fs-50 fw-800">PIN SESI</div>
                        <span class="fs-200 fw-800"><?= $ruses['pin_sesi']; ?></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->

    <div id="md-wmulai" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= $action['others']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="aksi" value="up-wmulai">
                <input type="hidden" name="slug" value="<?= $ruses['slug_ruangan_sesi']; ?>">
                <div class="modal-content">
                    <div class="modal-body table-<?= is_null($ruses['mulai_ujian']) ? 'warning' : 'primary' ?>">

                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="#" class="text-teal mr-md-3 align-self-md-center mb-3 mb-md-0">
                                <i class="icon-<?= is_null($ruses['mulai_ujian']) ? 'minus3' : 'check2' ?> text-<?= is_null($ruses['mulai_ujian']) ? 'warning' : 'primary' ?>-400 border-<?= is_null($ruses['mulai_ujian']) ? 'warning' : 'primary' ?>-400 border-1 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <?php if (is_null($ruses['mulai_ujian'])) : ?>
                                    <div class="media-title fs-14 fw-500">Belum Diisi.</div>
                                    <span class="fw-300">Harap mengisi waktu mulai ujian.</span>

                                <?php else : ?>
                                    <div class="media-title fs-14 fw-500">Sudah Diisi.</div>
                                    <span class="fw-300">Waktu mulai ujian sudah diisi (masih bisa diubah).</span>

                                <?php endif; ?>
                            </div>

                        </div>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Waktu Mulai Ujian</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="anytime-time-1" placeholder="00:00" name="waktu_mulai" value="<?= $ruses['mulai_ujian']; ?>" />
                                <div class="fw-300 text-muted">Jangan dikosongkan.</div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-sm bg-primary">Simpan</button>
                            <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="md-wselesai" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= $action['others']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="aksi" value="up-wselesai">
                <input type="hidden" name="slug" value="<?= $ruses['slug_ruangan_sesi']; ?>">
                <div class="modal-content">
                    <div class="modal-body table-<?= is_null($ruses['selesai_ujian']) ? 'warning' : 'primary' ?>">

                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="#" class="text-teal mr-md-3 align-self-md-center mb-3 mb-md-0">
                                <i class="icon-<?= is_null($ruses['mulai_ujian']) ? 'minus3' : 'check2' ?> text-<?= is_null($ruses['selesai_ujian']) ? 'warning' : 'primary' ?>-400 border-<?= is_null($ruses['selesai_ujian']) ? 'warning' : 'primary' ?>-400 border-1 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <?php if (is_null($ruses['selesai_ujian'])) : ?>
                                    <div class="media-title fs-14 fw-500">Belum Diisi.</div>
                                    <span class="fw-300">Harap mengisi waktu selesai ujian.</span>

                                <?php else : ?>
                                    <div class="media-title fs-14 fw-500">Sudah Diisi.</div>
                                    <span class="fw-300">Waktu selesai ujian sudah diisi (masih bisa diubah).</span>

                                <?php endif; ?>
                            </div>

                        </div>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Waktu Selesai Ujian</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="anytime-time-2" placeholder="00:00" name="waktu_selesai" value="<?= $ruses['selesai_ujian']; ?>" />
                                <div class="fw-300 text-muted">Jangan dikosongkan.</div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-sm bg-primary">Simpan</button>
                            <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="md-catatan" class="modal fade" tabindex="-1">
        <form action="<?= $action['others']; ?>" method="POST">
            <?= csrf_field(); ?>
            <input type="hidden" name="aksi" value="up-catatan">
            <input type="hidden" name="slug" value="<?= $ruses['slug_ruangan_sesi']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body table-<?= empty($ruses['catatan']) ? 'warning' : 'primary' ?>">

                        <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                            <a href="#" class="text-teal mr-md-3 align-self-md-center mb-3 mb-md-0">
                                <i class="icon-<?= empty($ruses['catatan']) ? 'minus3' : 'check2' ?> text-<?= empty($ruses['catatan']) ? 'warning' : 'primary' ?>-400 border-<?= empty($ruses['catatan']) ? 'warning' : 'primary' ?>-400 border-1 rounded-round p-2"></i>
                            </a>

                            <div class="media-body text-center text-md-left">
                                <?php if (empty($ruses['catatan'])) : ?>
                                    <div class="media-title fs-14 fw-500">Belum Diisi.</div>
                                    <span class="fw-300">Harap mengisi catatan (informasikan hal - hal yang berlangsung ketika ujain).</span>

                                <?php else : ?>
                                    <div class="media-title fs-14 fw-500">Sudah Diisi.</div>
                                    <span class="fw-300">Catatan sudah diisi (masih bisa diubah).</span>

                                <?php endif; ?>
                            </div>

                        </div>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Catatan</label>
                            <div class="col-lg-10">
                                <textarea type="text" class="form-control" name="catatan" placeholder="Masukan catatan"><?= $ruses['catatan']; ?></textarea>
                                <div class="fw-300 text-muted">Jangan dikosongkan.</div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-sm bg-primary">Simpan</button>
                            <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="md-reset" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action['access']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="fw-500">
                                    <div class="fw-300 fs-12">Nama Peserta :</div>
                                    <span id="nama1" class="fw-500 text-uppercase"></span>
                                </td>
                                <td class="fw-500">
                                    <div class="fw-300 fs-12"> No. Pendaftaran - NIK :</div>
                                    <span id="no-pendaftaran1" class="fw-500"></span> - <span id="nik1" class="fw-500"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-body table-warning border-bottom">
                        <div class="fs-12 fw-500">Silahkan mereset IP Komputer peserta ini jika peserta ini akan berpindah ke workstation lain !.</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="encode1" name="encode">
                        Apakah Anda yakin akan mereset IP Komputer peserta ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->

    <!-- Basic modal -->
    <div id="md-disconnect" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action['access']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="fw-500">
                                    <div class="fw-300 fs-12">Nama Peserta :</div>
                                    <span id="nama2" class="fw-500 text-uppercase"></span>
                                </td>
                                <td class="fw-500">
                                    <div class="fw-300 fs-12"> No. Pendaftaran - NIK :</div>
                                    <span id="no-pendaftaran2" class="fw-500"></span> - <span id="nik2" class="fw-500"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-body table-warning border-bottom">
                        <div class="fs-12 fw-500">Jika memutuskan koneksi peserta, maka peserta ini masih dapat melanjutkan kembali ujiannya dengan sisa waktu yang tersisa dan jawaban yang sudah dijawab otomatis tersimpan ke sistem !.</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="encode2" name="encode">
                        Apakah Anda yakin akan memutuskan koneksi peserta ini ?
                        <div class="mt-2">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="2" name="status" id="custom_radio_stacked_checked1" checked>
                                <label class="custom-control-label fs-13 fw-400" for="custom_radio_stacked_checked1">Dengan alasan pindah workstation</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="3" name="status" id="custom_radio_stacked_checked2">
                                <label class="custom-control-label fs-13 fw-400" for="custom_radio_stacked_checked2">Dengan alasan dikeluarkan</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="6" name="status" id="custom_radio_stacked_checked3">
                                <label class="custom-control-label fs-13 fw-400" for="custom_radio_stacked_checked3">Dengan alasan gangguan lainnya</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>