<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    <!-- Left sidebar component -->
    <?= view('administrator/layout/second-sidebar'); ?>
    <!-- /left sidebar component -->


    <!-- Right content -->
    <div class="w-100">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1"><?= ucwords($page); ?></a>
                </h6>
            </div>
            <?php $validation = session()->getFlashdata('validation'); ?>
            <form action="<?= $action; ?>" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="act" value="act-umum">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-6 col-lg-6 col-xl-6">
                            <label>Nama Instansi :</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Instansi" name="nama_instansi" value="<?= old('nama_instansi') ? old('nama_instansi') : ucwords($sett['nama_instansi']); ?>">
                            <?php if (!empty($validation['nama_instansi'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['nama_instansi']); ?>.</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-lg-6 col-xl-6">
                            <label>Website Instansi :</label>
                            <input type="text" class="form-control" placeholder="Masukan Url Website" name="url_website" value="<?= old('url_website') ? old('url_website') : strtolower($sett['url_website']); ?>">
                            <?php if (!empty($validation['url_website'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['url_website']); ?>.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                   <div class="form-row">
                        <div class="form-group col-12">
                            <label>Logo :</label>
                            <div class="media mt-0">
                                <div class="mr-3">
                                    <a href="#">
                                        <img src="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>" width="60" height="60" class="img-border preview-img">
                                    </a>
                                </div>

                                <div class="media-body">
                                    <input type="file" class="form-input-styled btn-upload" id="namaFile" name="namaFile" onchange="previewImg()" data-fouc>
                                    <span class="form-text text-muted  fw-300 ">Ekstensi : PNG - Ukuran Maks. 1MB</span>
                                </div>
                            </div>
                            <?php if (!empty($validation['namaFile'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile']); ?>.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <div class="d-flex justify-content-start align-items-center">
                        <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /right content -->

</div>
<!-- /inner container -->