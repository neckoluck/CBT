<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300"><?= ucfirst($page); ?></h6>
            </div>
            <?php $validation = session()->getFlashdata('validation'); ?>
            <form action="<?= $action; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?php if ($upadmin != null) : ?>
                    <input type="hidden" name="slug" value="<?= $upadmin['slug_nama_staf']; ?>">
                    <input type="hidden" name="act" value="up-profil">

                <?php endif; ?>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                                    <label>NIP :</label>
                                    <?php if ($upadmin != null) : ?>
                                        <input type="text" class="form-control" autocomplete="off" name="nip_staf" placeholder="Masukan NIP" value="<?= (old('nip_staf') ? old('nip_staf') : ucwords($upadmin['nip_staf'])); ?>">

                                    <?php else : ?>
                                        <input type="text" class="form-control" autocomplete="off" name="nip_staf" placeholder="Masukan NIP" value="<?= old('nip_staf'); ?>">

                                    <?php endif; ?>
                                    <?php if (!empty($validation['nip_staf'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['nip_staf']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-9 col-lg-9">
                                    <label>Nama Lengkap :</label>
                                    <?php if ($upadmin != null) : ?>
                                        <input type="text" class="form-control" autocomplete="off" name="nama_staf" placeholder="Masukan Nama Lengkap" value="<?= (old('nama_staf') ? old('nama_staf') : ucwords($upadmin['nama_staf'])); ?>">

                                    <?php else : ?>
                                        <input type="text" class="form-control" autocomplete="off" name="nama_staf" placeholder="Masukan Nama Lengkap" value="<?= old('nama_staf'); ?>">

                                    <?php endif; ?>
                                    <?php if (!empty($validation['nama_staf'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['nama_staf']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label class="clearfix">Jenis Kelamin :</label>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <?php if ($upadmin != null) : ?>
                                                        <?php if (old('jk_staf')) : ?>
                                                            <input type="radio" class="form-check-input-styled" name="jk_staf" value="l" data-fouc <?= (old('jk_staf') == 'l') ? 'checked' : 'checked'; ?>>

                                                        <?php else : ?>
                                                            <input type="radio" class="form-check-input-styled" name="jk_staf" value="l" data-fouc <?= ($upadmin['jk_staf'] == 'l') ? 'checked' : 'checked'; ?>>

                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <input type="radio" class="form-check-input-styled" name="jk_staf" value="l" data-fouc <?= (old('jk_staf') == 'l') ? 'checked' : 'checked'; ?>>

                                                    <?php endif; ?>
                                                    Laki - Laki
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <?php if ($upadmin != null) : ?>
                                                        <?php if (old('jk_staf')) : ?>
                                                            <input type="radio" class="form-check-input-styled" name="jk_staf" value="p" data-fouc <?= (old('jk_staf') == 'p') ? 'checked' : ''; ?>>

                                                        <?php else : ?>
                                                            <input type="radio" class="form-check-input-styled" name="jk_staf" value="p" data-fouc <?= ($upadmin['jk_staf'] == 'p') ? 'checked' : ''; ?>>

                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <input type="radio" class="form-check-input-styled" name="jk_staf" value="p" data-fouc <?= (old('jk_staf') == 'p') ? 'checked' : ''; ?>>

                                                    <?php endif; ?>
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!empty($validation['jk_staf'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['jk_staf']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <!--    
                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                    <label>No. Telp :</label>
                                    <?php if ($upadmin != null) : ?>
                                        <input type="text" class="form-control" autocomplete="off" name="no_telp_staf" placeholder="Masukan No. Telp" value="<?= (old('no_telp_staf') ? old('no_telp_staf') : $upadmin['no_telp_staf']); ?>">

                                    <?php else : ?>
                                        <input type="text" class="form-control" autocomplete="off" name="no_telp_staf" placeholder="Masukan No. Telp" value="<?= old('no_telp_staf'); ?>">

                                    <?php endif; ?>
                                    <?php if (!empty($validation['no_telp_staf'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['no_telp_staf']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                -->
                                <?php if ($upadmin == null) : ?>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <label>Kata Sandi :</label>
                                        <input type="text" class="form-control" autocomplete="off" name="password" placeholder="Masukan Kata Sandi" value="<?= old('password'); ?>">
                                        <?php if (!empty($validation['password'])) : ?>
                                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['password']); ?>.</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                        <label>Ulang Kata Sandi :</label>
                                        <input type="text" class="form-control" autocomplete="off" name="cpassword" placeholder="Masukan Ulang Kata Sandi" value="<?= old('cpassword'); ?>">
                                        <?php if (!empty($validation['cpassword'])) : ?>
                                            <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['cpassword']); ?>.</span>
                                        <?php endif; ?>
                                        <div class="form-group d-flex align-items-center mt-2">
                                            <div class="form-check mb-0">
                                                <label class="form-check-label fw-300">
                                                    <input type="checkbox" name="remember" class="form-input-styled" checked data-fouc />
                                                    Tampilkan sandi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                    <label>Unggah Foto :</label>
                                    <input type="file" class="form-input-styled btn-upload" id="namaFile" name="namaFile" onchange="previewImg()" data-fouc>
                                    <?php if (!empty($validation['namaFile'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                            <div class="text-center mt-3">
                                <a href="#">
                                    <?php if ($upadmin != null) : ?>
                                        <img src="<?= base_url(); ?>/uploads/pic-user/pengawas/<?= $upadmin['foto_staf']; ?>" width="100" height="100" class="rounded-round img-border preview-img" alt="">

                                    <?php else : ?>
                                        <img src="<?= base_url(); ?>/assets/limitless/global-assets/images/placeholders/placeholder.jpg" width="100" height="100" class="rounded-round img-border preview-img" alt="">

                                    <?php endif; ?>
                                </a>
                                <span class="form-text text-muted fw-300 mt-3">Ekstensi : JPG, JPEG - Ukuran Maks. 1MB</span>
                                <label class="mt-4">Status Akses :</label>
                                <div class="form-check form-check-switchery form-check-switchery-double">
                                    <label class="form-check-label">
                                        Nonaktif
                                        <?php if ($upadmin != null) : ?>
                                            <?php if (old('status_akses')) : ?>
                                                <input type="checkbox" name="status_akses" class="form-check-input-switchery check-input-switchery" <?= (!empty(old('status_akses'))) ? 'value="0" checked' : ''; ?> id="input-switchery" data-fouc>

                                            <?php else : ?>
                                                <input type="checkbox" name="status_akses" class="form-check-input-switchery check-input-switchery" <?= ($upadmin['status_akses'] == 0) ? 'value="' . $upadmin['status_akses'] . '" checked' : ''; ?> id="input-switchery" data-fouc>

                                            <?php endif; ?>

                                        <?php else : ?>
                                            <input type="checkbox" name="status_akses" class="form-check-input-switchery check-input-switchery" <?= (!empty(old('status_akses'))) ? 'value="0" checked' : ''; ?> id="input-switchery" data-fouc>

                                        <?php endif; ?>
                                        Aktif
                                    </label>
                                </div>
                            </div>
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
</div>