<div class="row">
    <div class="col-4">
        <div class="card-group-control card-group-control-right">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title fw-300">
                        <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1"><?= ucwords($page); ?></a>
                    </h6>
                </div>

                <div id="collapsible-control-right-group1" class="collapse show">
                    <?php $validation = session()->getFlashdata('validation'); ?>
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
                                    <a href="<?= $baseUrl; ?>/ruangan" type="button" class="btn btn-link text-dark">Kembali</a>
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
                            <th colspan="2">Aksi</th>
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
                                                <a href="<?= $baseUrl; ?>/ruangan/<?= $ruang['slug_nama_ruangan']; ?>" class="dropdown-item fs-11"><i class="icon-user-check"></i> UBAH DATA</a>
                                                <div class="dropdown-divider"></div>

                                                <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($ruang['slug_nama_ruangan'] . '+act-ruangan'); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $cbadge; ?> width-badge-1 pd-7 shadow-1"><?= strtoupper($status); ?></span>
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
    <div class="col-8">
        <div class="card-group-control card-group-control-right">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title fw-300">
                        <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group2"><?= ucwords($page); ?></a>
                    </h6>
                </div>

                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, ut dolor? Temporibus dicta atque sapiente at itaque, neque esse id optio sed eum, cum assumenda eveniet voluptates possimus.
                </div>
                <div id="collapsible-control-right-group2" class="collapse show">
                    <?php $validation = session()->getFlashdata('validation'); ?>
                    <form action="<?= $action['others']; ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                    <label>Sesi :</label>
                                    <select data-placeholder="Pilih Sesi" name="id_sesi" class="form-control select-icons" data-fouc>
                                        <option></option>
                                        <option data-icon="dash"></option>
                                    </select>
                                    <?php if (!empty($validation['id_sesi'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_sesi']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                    <label>Ruangan :</label>
                                    <select data-placeholder="Pilih Ruangan" name="id_ruangan" class="form-control select-icons" data-fouc>
                                        <option></option>
                                        <option data-icon="dash"></option>
                                    </select>
                                    <?php if (!empty($validation['id_ruangan'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_ruangan']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                    <label>Pengawas :</label>
                                    <select data-placeholder="Pilih Pengawas" name="id_pengawas" class="form-control select-icons" data-fouc>
                                        <option></option>
                                        <option data-icon="dash"></option>
                                    </select>
                                    <?php if (!empty($validation['id_pengawas'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_pengawas']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-3 col-lg-3">
                                    <label>Teknisi :</label>
                                    <select data-placeholder="Pilih Teknisi" name="id_teknisi" class="form-control select-icons" data-fouc>
                                        <option></option>
                                        <option data-icon="dash"></option>
                                    </select>
                                    <?php if (!empty($validation['id_teknisi'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_teknisi']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="text-right">
                                <!-- <a href="" type="button" class="btn btn-link text-dark">Kembali</a> -->
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
                            <th colspan="2">Aksi</th>
                            <th>Ruangan</th>
                            <th>Kapasitas</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>