<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">Atur Keamanan</h6>
            </div>
            <?php $validation = session()->getFlashdata('validation'); ?>
            <form action="<?= $action; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6 col-lg-3">
                                    <label>NIP / ID Pengguna :</label>
                                    <input type="text" class="form-control" autocomplete="off" disabled value="<?= $user['nip_staf']; ?>">

                                </div>
                                <div class="form-group col-12 col-sm-6 col-lg-3">
                                    <label>Kata Sandi Lama :</label>
                                    <input type="password" class="form-control show-oldpassword" autocomplete="off" name="oldpassword" placeholder="Masukan Kata Sandi Lama" value="<?= old('oldpassword'); ?>">
                                    <?php if (!empty($validation['oldpassword'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['oldpassword']); ?>.</span>
                                    <?php endif; ?>
                                    <div class="form-group d-flex align-items-center mt-2">
                                        <div class="form-check mb-0">
                                            <label class="form-check-label fw-300 fs-12">
                                                <input type="checkbox" name="remember" class="form-input-styled" id="show-oldpassword" data-fouc />
                                                Tampilkan kata sandi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-lg-3">
                                    <label>Kata Sandi Baru :</label>
                                    <input type="password" class="form-control show-newpassword" autocomplete="off" name="newpassword" placeholder="Masukan Kata Sandi Baru" value="<?= old('newpassword'); ?>">
                                    <?php if (!empty($validation['newpassword'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['newpassword']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-lg-3">
                                    <label>Ulang Kata Sandi Baru :</label>
                                    <input type="password" class="form-control show-newpassword" autocomplete="off" name="cnewpassword" placeholder="Masukan Ulang Kata Sandi Baru" value="<?= old('cnewpassword'); ?>">
                                    <?php if (!empty($validation['cnewpassword'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['cnewpassword']); ?>.</span>
                                    <?php endif; ?>
                                    <div class="form-group d-flex align-items-center mt-2">
                                        <div class="form-check mb-0">
                                            <label class="form-check-label fw-300 fs-12">
                                                <input type="checkbox" name="remember" class="form-input-styled" id="show-newpassword" data-fouc />
                                                Tampilkan kata sandi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <div class="d-flex justify-content-start align-items-center">
                        <a href="<?= $baseUrl; ?>" type="button" class="btn btn-link text-dark">Kembali</a>
                        <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>