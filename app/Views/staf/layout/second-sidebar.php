<div class="card-group-control card-group-control-right">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title fw-300">
                <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1">Atur Ruangan Sesi</a>
            </h6>
        </div>
        <div class="card-body">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
        </div>
        <?php $validation = session()->getFlashdata('validation'); ?>
        <form action="<?= $action['others']; ?>" method="POST" class="<?= ($ruses['status_ruangan_sesi'] == 3) ? 'nopointer op-0-5' : ''; ?>">
            <input type="hidden" name="aksi" value="up-aturruses">
            <input type="hidden" name="slug" value="<?= $ruses['slug_ruangan_sesi']; ?>">
            <?= csrf_field(); ?>

            <div class="card-body border-top border-bottom">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label>Jum. Hadir : <span class="fw-500 ml-2"><?= $peserta['hadir']; ?> Peserta</span></label>
                        <input type="hidden" class="form-control" name="jumlah_hadir" value="<?= $peserta['hadir']; ?>">
                    </div>
                    <div class="form-group col-6">
                        <label>Jum. Peserta : <span class="fw-500 ml-2"><?= $peserta['total']; ?> Peserta</span></label>
                        <input type="hidden" class="form-control" name="jumlah_peserta" value="<?= $peserta['total']; ?>">
                    </div>
                    <div class="form-group col-12">
                        <span class="fs-12 fw-300 text-muted">Jumlah peserta dan jumlah kehadiran akan dihitung otomatis oleh sistem.</span>
                    </div>
                </div>
            </div>
            <div id="collapsible-control-right-group1" class="collapse <?= ($ruses['mulai_ujian'] != null and $ruses['selesai_ujian'] != null) ? '' : 'show'; ?>">
                <div class="card-body">

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>Mulai Ujian :</label>
                            <div class="input-group">
                                <input type="text" <?= ($ruses['status_ruangan_sesi'] == 3) ? 'disabled' : 'name="mulai1"'; ?> class="form-control text-center" maxlength="2" autocomplete="off" placeholder="Masukan Jam" value="<?= old('mulai1') ? old('mulai1') : $waktu['mulai'][0]; ?>">
                                <span class="input-group-prepend ml-3">
                                    <button class="btn btn-light" type="button">:</button>
                                </span>
                                <input type="text" <?= ($ruses['status_ruangan_sesi'] == 3) ? 'disabled' : 'name="mulai2"'; ?> class="form-control text-center" maxlength="2" autocomplete="off" placeholder="Masukan Menit" value="<?= old('mulai1') ? old('mulai1') : $waktu['mulai'][1]; ?>">
                            </div>
                            <div class="fs-12 fw-300 mt-2 text-muted">Contoh waktu mulai ujian = 07 : 00.</div>
                            <div class="d-flex">
                                <?php if (!empty($validation['mulai1'])) : ?>
                                    <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['mulai1']); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php endif; ?>
                                <?php if (!empty($validation['mulai2'])) : ?>
                                    <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['mulai2']); ?>.</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($ruses['mulai_ujian'] != null) : ?>
                    <div class="card-body border-bottom">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label>Selesai Ujian :</label>
                                <div class="input-group">
                                    <input type="text" <?= ($ruses['status_ruangan_sesi'] == 3) ? 'disabled' : 'name="selesai1"'; ?> class="form-control text-center" autocomplete="off" placeholder="Masukan Jam" value="<?= old('selesai1') ? old('selesai1') : $waktu['seles'][0]; ?>">
                                    <span class="input-group-prepend ml-3">
                                        <button class="btn btn-light" type="button">:</button>
                                    </span>
                                    <input type="text" <?= ($ruses['status_ruangan_sesi'] == 3) ? 'disabled' : 'name="selesai2"'; ?> class="form-control text-center" autocomplete="off" placeholder="Masukan Menit" value="<?= old('selesai2') ? old('selesai2') : $waktu['seles'][1]; ?>">
                                </div>
                                <div class="fs-12 fw-300 mt-2 text-muted">Contoh waktu mulai ujian = 09 : 45.</div>
                                <div class="d-flex">
                                    <?php if (!empty($validation['selesai1'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['selesai1']); ?>. </span>
                                    <?php endif; ?>
                                    <?php if (!empty($validation['selesai2'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"> <?= ucfirst($validation['selesai2']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($ruses['selesai_ujian'] != null) : ?>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>Catatan :</label>
                            <textarea type="text" <?= ($ruses['status_ruangan_sesi'] == 3) ? 'disabled' : 'name="catatan"'; ?> class="form-control" placeholder="Masukan Catatan"><?= old('catatan') ? old('catatan') : $ruses['catatan']; ?></textarea>
                            <?php if (!empty($validation['catatan'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['catatan']); ?>. </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-12">
                            <span class="fs-12 fw-300 text-muted">Klik <a data-toggle="collapse" href="#collapsible-control-right-group1" class="fw-500 text-muted"><u>Atur Ruangan Sesi</u></a> jika ingin mengubah waktu mulai ujian dan selesai ujian.</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($ruses['status_ruangan_sesi'] != 3) : ?>
                <div class="card-body m-t-0">
                    <button type="submit" class="btn bg-teal-400 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                </div>
            <?php endif; ?>

        </form>
        <?php if ($ruses['status_ruangan_sesi'] == 3) : ?>
            <div class="card-body table-warning border-top">
                <div class="form-group col-12 m-b-0">
                    <span>Data untuk sesi ujian ini <span class="fw-500">(Data Atur Ruangan Sesi & Data Baup Peserta)</span> sudah dikunci</span>.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>