<div class="card-group-control card-group-control-right">
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title fw-300"><?= ucfirst($page); ?></h6>
            <?php if (is_null($uppeserta)) : ?>
                <div class="header-elements">
                    <div class="btn-group shadow-1">
                        <button type="button" <?= ($uppeserta != null) ? 'nopointer' : ''; ?> data-target="#<?= !empty(session()->get('arrypeserta')) ? 'md-vwimport' : 'md-import'; ?>" data-toggle="modal" class="btn bg-primary-700 btn-block">Import Excel</button>
                        <button type="button" <?= ($uppeserta != null) ? 'nopointer' : ''; ?> class="btn bg-primary-700 active nopointer"><i class="icon-import"></i></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php $valid = session()->getFlashdata('validation'); ?>
        <form action="<?= $action['others']; ?>" method="POST">
            <?= csrf_field(); ?>
            <input type="hidden" name="aksi" value="in-peserta">
            <?php if ($uppeserta != null) : ?>
                <input type="hidden" name="slug" value="<?= $uppeserta['slug_nama_peserta']; ?>">
            <?php endif; ?>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-lg-2">
                        <label for="">No. Pendaftaran :</label>
                        <?php if ($uppeserta != null) : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan No. Pendaftaran" value="<?= old('no_pendaftaran') ? old('no_pendaftaran') : $uppeserta['no_pendaftaran']; ?>" name="no_pendaftaran">

                        <?php else : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan No. Pendaftaran" value="<?= old('no_pendaftaran'); ?>" name="no_pendaftaran">

                        <?php endif; ?>
                        <span class="text-muted fw-300 fs-11">No. Pendaftaran akan dijadikan sebagai Username</span>
                        <?php if (!empty($valid['no_pendaftaran'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['no_pendaftaran']); ?>.</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="">NIK :</label>
                        <?php if ($uppeserta != null) : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan NIK" name="nik_peserta" value="<?= old('nik_peserta') ? old('nik_peserta') : $uppeserta['nik_peserta']; ?>">

                        <?php else : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan NIK" name="nik_peserta" value="<?= old('nik_peserta'); ?>">

                        <?php endif; ?>

                        <span class="text-muted fw-300 fs-11">NIK akan dijadikan sebagai Password</span>
                        <?php if (!empty($valid['nik_peserta'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['nik_peserta']); ?>.</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="">NISN :</label>
                        <?php if ($uppeserta != null) : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan NISN" value="<?= old('nisn_peserta') ? old('nisn_peserta') : $uppeserta['nisn_peserta']; ?>" name="nisn_peserta">

                        <?php else : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan NISN" value="<?= old('nisn_peserta'); ?>" name="nisn_peserta">

                        <?php endif ?>
                        <?php if (!empty($valid['nisn_peserta'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['nisn_peserta']); ?>.</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="">Nama Peserta :</label>
                        <?php if ($uppeserta != null) : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Peserta" value="<?= old('nama_peserta') ? old('nama_peserta') : strtoupper($uppeserta['nama_peserta']); ?>" name="nama_peserta">

                        <?php else : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Peserta" value="<?= old('nama_peserta'); ?>" name="nama_peserta">

                        <?php endif; ?>
                        <?php if (!empty($valid['nama_peserta'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['nama_peserta']); ?>.</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="">Jenis Kelamin :</label>
                        <div class="form-row mt-2">
                            <div class="form-group col-6">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <?php if ($uppeserta != null) : ?>
                                            <?php if (old('jk_peserta')) : ?>
                                                <input type="radio" class="form-check-input-styled" name="jk_peserta" value="l" data-fouc <?= (old('jk_peserta') == 'l') ? 'checked' : 'checked'; ?>>

                                            <?php else : ?>
                                                <input type="radio" class="form-check-input-styled" name="jk_peserta" value="l" data-fouc <?= ($uppeserta['jk_peserta'] == 'l') ? 'checked' : 'checked'; ?>>

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="radio" class="form-check-input-styled" name="jk_peserta" value="l" data-fouc <?= (old('jk_peserta') == 'l') ? 'checked' : 'checked'; ?>>

                                        <?php endif; ?>
                                        Laki - Laki
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <?php if ($uppeserta != null) : ?>
                                            <?php if (old('jk_peserta')) : ?>
                                                <input type="radio" class="form-check-input-styled" name="jk_peserta" value="p" data-fouc <?= (old('jk_peserta') == 'p') ? 'checked' : ''; ?>>

                                            <?php else : ?>
                                                <input type="radio" class="form-check-input-styled" name="jk_peserta" value="p" data-fouc <?= ($uppeserta['jk_peserta'] == 'p') ? 'checked' : ''; ?>>

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="radio" class="form-check-input-styled" name="jk_peserta" value="p" data-fouc <?= (old('jk_peserta') == 'p') ? 'checked' : ''; ?>>

                                        <?php endif; ?>
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($valid['jk_peserta'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['jk_peserta']); ?>.</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        <label for="">Politeknik Pilihan Pertama</label>
                        <select data-placeholder="Pilih Prodi Pilihan Pertama" name="id_poltek1" class="form-control select-search select-icons" data-fouc>
                            <option></option>
                            <?php foreach ($poltek as $poltek1) : ?>
                                <?php if ($uppeserta != null) : ?>
                                    <?php if (old('id_poltek1')) : ?>
                                        <option value="<?= $poltek1['id_poltek']; ?>" <?= (old('id_poltek1') == $poltek1['id_poltek']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($poltek1['nama_poltek']); ?></option>

                                    <?php else : ?>
                                        <option value="<?= $poltek1['id_poltek']; ?>" <?= ($uppeserta['poltek_pertama'] == $poltek1['id_poltek']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($poltek1['nama_poltek']); ?></option>

                                    <?php endif; ?>
                                <?php else : ?>
                                    <option value="<?= $poltek1['id_poltek']; ?>" <?= (old('id_poltek1') == $poltek1['id_poltek']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($poltek1['nama_poltek']); ?></option>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($valid['id_poltek1'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['id_poltek1']); ?>.</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="">Prodi Pilihan Pertama</label>
                        <select data-placeholder="Pilih Prodi Pilihan Pertama" name="id_prodi1" class="form-control select-search select-icons" data-fouc>
                            <option></option>
                            <?php foreach ($prodi as $prodi1) : ?>
                                <?php if ($uppeserta != null) : ?>
                                    <?php if (old('id_prodi1')) : ?>
                                        <option value="<?= $prodi1['id_prodi']; ?>" <?= (old('id_prodi1') == $prodi1['id_prodi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($prodi1['nama_prodi']); ?></option>

                                    <?php else : ?>
                                        <option value="<?= $prodi1['id_prodi']; ?>" <?= ($uppeserta['prodi_pertama'] == $prodi1['id_prodi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($prodi1['nama_prodi']); ?></option>

                                    <?php endif; ?>
                                <?php else : ?>
                                    <option value="<?= $prodi1['id_prodi']; ?>" <?= (old('id_prodi1') == $prodi1['id_prodi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($prodi1['nama_prodi']); ?></option>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($valid['id_prodi1'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['id_prodi1']); ?>.</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="">Politeknik Pilihan Kedua</label>
                        <select data-placeholder="Pilih Prodi Pilihan Kedua" name="id_poltek2" class="form-control select-search select-icons" data-fouc>
                            <option></option>
                            <?php if ($uppeserta != null) : ?>
                                <?php if ($uppeserta['poltek_kedua'] == null) : ?>
                                    <?php if (old('id_poltek2')) : ?>
                                        <option value="null" <?= (old('id_poltek2') == null) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Tidak Ada</option>
                                    <?php else : ?>
                                        <option value="null" <?= ($uppeserta['poltek_kedua'] == null) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Tidak Ada</option>

                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <option value="null" <?= old('id_poltek2') ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Tidak Ada</option>

                            <?php endif; ?>
                            <?php foreach ($poltek as $poltek2) : ?>
                                <?php if ($uppeserta != null) : ?>
                                    <?php if ($uppeserta['poltek_kedua'] != null) : ?>
                                        <?php if (old('id_poltek2')) : ?>
                                            <option value="<?= $poltek2['id_poltek']; ?>" <?= (old('id_poltek2') == $poltek2['id_poltek']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($poltek2['nama_poltek']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $poltek2['id_poltek']; ?>" <?= ($uppeserta['poltek_kedua'] == $poltek2['id_poltek']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($poltek2['nama_poltek']); ?></option>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <option value="<?= $poltek2['id_poltek']; ?>" <?= (old('id_poltek2') == $poltek2['id_poltek']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($poltek2['nama_poltek']); ?></option>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($valid['id_poltek2'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['id_poltek1']); ?>.</span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="">Prodi Pilihan Kedua</label>
                        <select data-placeholder="Pilih Prodi Pilihan Kedua" name="id_prodi2" class="form-control select-icons select-search" data-fouc>
                            <option></option>
                            <?php if ($uppeserta != null) : ?>
                                <?php if ($uppeserta['prodi_kedua'] == null) : ?>
                                    <?php if (old('id_prodi2')) : ?>
                                        <option value="null" <?= (old('id_prodi2') == null) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Tidak Ada</option>
                                    <?php else : ?>
                                        <option value="null" <?= ($uppeserta['prodi_kedua'] == null) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Tidak Ada</option>

                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <option value="null" <?= old('id_prodi2') ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Tidak Ada</option>

                            <?php endif; ?>

                            <?php foreach ($prodi as $prodi2) : ?>
                                <?php if ($uppeserta != null) : ?>
                                    <?php if ($uppeserta['prodi_kedua'] != null) : ?>
                                        <?php if (old('id_prodi2')) : ?>
                                            <option value="<?= $prodi2['id_prodi']; ?>" <?= (old('id_prodi2') == $prodi2['id_prodi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($prodi2['nama_prodi']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $prodi2['id_prodi']; ?>" <?= ($uppeserta['prodi_kedua'] == $prodi2['id_prodi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($prodi2['nama_prodi']); ?></option>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <option value="<?= $prodi2['id_prodi']; ?>" <?= (old('id_prodi2') == $prodi2['id_prodi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($prodi2['nama_prodi']); ?></option>

                                <?php endif; ?>
                            <?php endforeach; ?>

                        </select>
                        <?php if (!empty($valid['id_prodi2'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['id_prodi2']); ?>.</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-2">
                        <label for="">No. Telp :</label>
                        <?php if ($uppeserta != null) : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan No. Telp" value="<?= old('no_telp_peserta') ? old('no_telp_peserta') : $uppeserta['no_telp_peserta']; ?>" name="no_telp_peserta">

                        <?php else : ?>
                            <input type="text" class="form-control" autocomplete="off" placeholder="Masukan No. Telp" value="<?= old('no_telp_peserta'); ?>" name="no_telp_peserta">

                        <?php endif; ?>
                        <?php if (!empty($valid['no_telp_peserta'])) : ?>
                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($valid['no_telp_peserta']); ?>.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body mt-2">
                <div class="d-flex justify-content-start align-items-center">
                    <a href="<?= $actUrl; ?>" type="button" class="btn btn-link text-dark">Kembali</a>
                    <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>