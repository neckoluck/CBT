<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    <!-- Left sidebar component -->
    <?= view('administrator/layout/second-sidebar'); ?>
    <!-- /left sidebar component -->


    <!-- Right content -->
    <div class="w-100">
        <?php $validation = session()->getFlashdata('validation'); ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card-group-control card-group-control-right">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title fw-300">
                                        <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1">Data Ruangan</a>
                                    </h6>
                                </div>


                                <div id="collapsible-control-right-group1" class="collapse show">

                                    <form action="<?= $action['others']; ?>" method="POST">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="act" value="act-ruangan">
                                        <?php if ($upruang != null) : ?>
                                            <input type="hidden" name="slug" value="<?= $upruang['slug_nama_ruangan']; ?>">

                                        <?php endif; ?>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <label>Ruangan : <sup class="fs-11 fw-400 text-danger">**tanpa kata ruangan.</sup></label>
                                                    <?php if ($upruang != null) : ?>
                                                        <input type="text" class="form-control" autocomplete="off" name="ruangan" placeholder="Masukan Nama Ruangan" value="<?= (old('ruangan') ? old('ruangan') : ucwords($upruang['nama_ruangan'])); ?>">

                                                    <?php else : ?>
                                                        <input type="text" class="form-control" autocomplete="off" name="ruangan" placeholder="Masukan Nama Ruangan" value="<?= old('ruangan'); ?>">

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['ruangan'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['ruangan']); ?>.</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6">
                                                    <label>Kapasitas :</label>
                                                    <?php if ($upruang != null) : ?>
                                                        <input type="text" class="form-control touchspin-vertical" autocomplete="off" name="kapasitas" placeholder="Masukan Kapasitas Ruangan" value="<?= (old('kapasitas') ? old('kapasitas') : $upruang['kapasitas']); ?>">

                                                    <?php else : ?>
                                                        <input type="text" class="form-control touchspin-vertical" autocomplete="off" name="kapasitas" placeholder="Masukan Kapasitas Ruangan" value="<?= old('kapasitas'); ?>">

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['kapasitas'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['kapasitas']); ?>.</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <?php if ($upruang != null) : ?>
                                                    <a href="<?= $baseUrl; ?>/komponen/lainnya" type="button" class="btn btn-link text-dark">Kembali</a>
                                                <?php endif; ?>
                                                <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="border-bottom"></div>
                                <table class="table datatable-basic table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th>Aksi</th>
                                            <th>Ruangan</th>
                                            <th>Kapasitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($ruangs as $ruang) :

                                            $status = 'belum terpakai';
                                            $cbadge = 'danger';

                                            $ctable = '';
                                            if ($upruang != null) if ($ruang['id_ruangan'] == $upruang['id_ruangan']) $ctable = 'table-warning';

                                            $no++; ?>
                                            <tr class="<?= $ctable; ?>">
                                                <td width="1%"><?= $no; ?>.</td>
                                                <td width="1%" class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left">
                                                                <a href="<?= $baseUrl; ?>/komponen/lainnya/<?= $ruang['slug_nama_ruangan']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                                                <div class="dropdown-divider"></div>

                                                                <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($ruang['slug_nama_ruangan'] . '+act-ruangan'); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    Ruang. <?= ucwords($ruang['nama_ruangan']); ?>
                                                </td>
                                                <td class="fw-500"><?= $ruang['kapasitas']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card-group-control card-group-control-right">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title fw-300">
                                        <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group2">Data Prodi</a>
                                    </h6>
                                </div>


                                <div id="collapsible-control-right-group2" class="collapse show">
                                    <form action="<?= $action['others']; ?>" method="POST">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="act" value="act-prodi">
                                        <?php if ($upprodi != null) : ?>
                                            <input type="hidden" name="slug" value="<?= $upprodi['slug_nama_prodi']; ?>">

                                        <?php endif; ?>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label>Bidang :</label>
                                                    <select data-placeholder="Pilih Bidang" name="id_bidang" class="form-control select-icons select-search" data-fouc>
                                                        <option></option>
                                                        <?php foreach ($bidangs as $bidang) : ?>
                                                            <?php if ($upprodi != null) : ?>
                                                                <?php if (old('id_bidang')) : ?>
                                                                    <option value="<?= $bidang['id_bidang']; ?>" <?= (old('id_bidang') == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

                                                                <?php else : ?>
                                                                    <option value="<?= $bidang['id_bidang']; ?>" <?= ($upprodi['id_bidang'] == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <option value="<?= $bidang['id_bidang']; ?>" <?= (old('id_bidang') == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

                                                            <?php endif; ?>

                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php if (!empty($validation['id_bidang'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_bidang']); ?>.</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Program Studi :</label>
                                                    <?php if ($upprodi != null) : ?>
                                                        <input type="text" class="form-control" autocomplete="off" name="prodi" placeholder="Masukan Nama Program Studi" value="<?= (old('prodi') ? old('prodi') : ucwords($upprodi['nama_prodi'])); ?>">

                                                    <?php else : ?>
                                                        <input type="text" class="form-control" autocomplete="off" name="prodi" placeholder="Masukan Nama Program Studi" value="<?= old('prodi'); ?>">

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['prodi'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['prodi']); ?>.</span>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <?php if ($upprodi != null) : ?>
                                                    <a href="<?= $baseUrl; ?>/komponen/lainnya" type="button" class="btn btn-link text-dark">Kembali</a>
                                                <?php endif; ?>
                                                <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="border-bottom"></div>
                                <table class="table datatable-basic table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th>Aksi</th>
                                            <th>Program Studi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($prodis as $prodi) :

                                            $jum    = '-';
                                            $ctable = '';
                                            if ($upprodi != null) if ($prodi['id_prodi'] == $upprodi['id_prodi']) $ctable = 'table-warning';

                                            $no++; ?>
                                            <tr class="<?= $ctable; ?>">
                                                <td width="1%"><?= $no; ?>.</td>
                                                <td width="1%" class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left">
                                                                <a href="<?= $baseUrl; ?>/komponen/lainnya/<?= $prodi['slug_nama_prodi']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                                                <div class="dropdown-divider"></div>

                                                                <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($prodi['slug_nama_prodi'] . '+act-prodi'); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="fw-500">
                                                    <div class="fs-12 fw-300">Bidang <?= ucwords($prodi['nama_bidang']); ?></div>
                                                    <?= ucwords($prodi['nama_prodi']); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card-group-control card-group-control-right">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title fw-300">
                                        <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group3">Data Berita Acara</a>
                                    </h6>
                                </div>


                                <div id="collapsible-control-right-group3" class="collapse show">
                                    <form action="<?= $action['others']; ?>" method="POST">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="act" value="act-berita">
                                        <?php if ($upberita != null) : ?>
                                            <input type="hidden" name="slug" value="<?= $upberita['slug_berita_acara']; ?>">

                                        <?php endif; ?>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <label>Berita Acara :</label>
                                                    <?php if ($upberita != null) : ?>
                                                        <textarea type="text" class="form-control" autocomplete="off" name="berita_acara" placeholder="Masukan Berita Acara"><?= (old('berita_acara') ? old('berita_acara') : ucfirst($upberita['berita_acara'])); ?></textarea>

                                                    <?php else : ?>
                                                        <textarea type="text" class="form-control" autocomplete="off" name="berita_acara" placeholder="Masukan Berita Acara"><?= old('berita_acara'); ?></textarea>

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['berita_acara'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['berita_acara']); ?>.</span>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <?php if ($upberita != null) : ?>
                                                    <a href="<?= $baseUrl; ?>/komponen/lainnya" type="button" class="btn btn-link text-dark">Kembali</a>
                                                <?php endif; ?>
                                                <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="border-bottom"></div>
                                <table class="table datatable-basic table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th>Aksi</th>
                                            <th>Berita Acara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($beritas as $berita) :

                                            $jum    = '-';
                                            $ctable = '';
                                            if ($upberita != null) if ($berita['id_berita_acara'] == $upberita['id_berita_acara']) $ctable = 'table-warning';

                                            $no++; ?>
                                            <tr class="<?= $ctable; ?>">
                                                <td width="1%"><?= $no; ?>.</td>
                                                <td width="1%" class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left">
                                                                <a href="<?= $baseUrl; ?>/komponen/lainnya/<?= $berita['slug_berita_acara']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                                                <div class="dropdown-divider"></div>

                                                                <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($berita['slug_berita_acara'] . '+act-berita'); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= ucfirst($berita['berita_acara']); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card-group-control card-group-control-right">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title fw-300">
                                        <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group4">Data Politeknik</a>
                                    </h6>
                                </div>


                                <div id="collapsible-control-right-group4" class="collapse show">
                                    <form action="<?= $action['others']; ?>" method="POST">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="act" value="act-poli">
                                        <?php if ($uppoli != null) : ?>
                                            <input type="hidden" name="slug" value="<?= $uppoli['slug_nama_poltek']; ?>">

                                        <?php endif; ?>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-lg-3">
                                                    <label>Kode Politeknik :</label>
                                                    <?php if ($uppoli != null) : ?>
                                                        <input type="tel" class="form-control" name="kd_poltek" placeholder="Masukan Kode Poltek" value="<?= old('kd_poltek') ? old('kd_poltek') : $uppoli['kd_poltek']; ?>">

                                                    <?php else : ?>
                                                        <input type="tel" class="form-control" name="kd_poltek" placeholder="Masukan Kode Poltek" value="<?= old('kd_poltek'); ?>">

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['kd_poltek'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['kd_poltek']); ?>.</span>
                                                    <?php endif; ?>

                                                </div>
                                                <div class="form-group col-lg-9">
                                                    <label>Nama Politeknik :</label>
                                                    <?php if ($uppoli != null) : ?>
                                                        <input type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Poltikenik" name="nama_poltek" value="<?= old('nama_poltek') ? old('nama_poltek') : strtoupper($uppoli['nama_poltek']); ?>">

                                                    <?php else : ?>
                                                        <input type="text" class="form-control" autocomplete="off" placeholder="Masukan Nama Poltikenik" name="nama_poltek" value="<?= old('nama_poltek'); ?>">

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['nama_poltek'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['nama_poltek']); ?>.</span>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <?php if ($uppoli != null) : ?>
                                                    <a href="<?= $baseUrl; ?>/komponen/lainnya" type="button" class="btn btn-link text-dark">Kembali</a>
                                                <?php endif; ?>
                                                <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="border-bottom"></div>
                                <table class="table datatable-basic table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th>Aksi</th>
                                            <th>Nama Politeknik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($polis as $poli) :

                                            $jum    = '-';
                                            $ctable = '';
                                            if ($uppoli != null) if ($poli['id_poltek'] == $uppoli['id_poltek']) $ctable = 'table-warning';

                                            $no++; ?>
                                            <tr class="<?= $ctable; ?>">
                                                <td width="1%"><?= $no; ?>.</td>
                                                <td width="1%" class="text-center">
                                                    <div class="list-icons">
                                                        <div class="dropdown">
                                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-left">
                                                                <a href="<?= $baseUrl; ?>/komponen/lainnya/<?= $poli['slug_nama_poltek']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                                                <div class="dropdown-divider"></div>

                                                                <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($poli['slug_nama_poltek'] . '+act-poli'); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="fs-12 fw-300">KODE. <?= $poli['kd_poltek']; ?></div>
                                                    <?= strtoupper($poli['nama_poltek']); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /right content -->

</div>
<!-- /inner container -->