<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Form Sesi
                </h6>
            </div>
            <?php $validation = session()->getFlashdata('validation'); ?>
            <form action="<?= $action['others']; ?>" method="POST">
                <?= csrf_field(); ?>
                <?php if ($upsesi != null) : ?>
                    <input type="hidden" name="slug" value="<?= $upsesi['slug_sesi']; ?>">

                <?php endif; ?>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label>Sesi :</label>
                            <select data-placeholder="Pilih Sesi" name="sesi" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <?php for ($i = 1; $i <= 50; $i++) : ?>
                                    <?php if ($upsesi != null) : ?>
                                        <?php if (old('sesi')) : ?>
                                            <option value="<?= $i; ?>" <?= (old('sesi') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Sesi <?= $i; ?></option>

                                        <?php else : ?>
                                            <option value="<?= $i; ?>" <?= ($upsesi['sesi'] == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Sesi <?= $i; ?></option>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="<?= $i; ?>" <?= (old('sesi') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>Sesi <?= $i; ?></option>

                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                            <?php if (!empty($validation['sesi'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['sesi']); ?>.</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-12">
                            <label>Jadwal :</label>
                            <select data-placeholder="Pilih Jadwal" name="id_jadwal" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <?php foreach ($jadwals as $jadwal) : ?>
                                    <?php if ($upsesi != null) : ?>
                                        <?php if (old('id_jadwal')) : ?>
                                            <option value="<?= $jadwal['id_jadwal']; ?>" <?= (old('id_jadwal') == $jadwal['id_jadwal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= indoDate($jadwal['jadwal']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $jadwal['id_jadwal']; ?>" <?= ($upsesi['id_jadwal'] == $jadwal['id_jadwal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= indoDate($jadwal['jadwal']); ?></option>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="<?= $jadwal['id_jadwal']; ?>" <?= (old('id_jadwal') == $jadwal['id_jadwal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= indoDate($jadwal['jadwal']); ?></option>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($validation['id_jadwal'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_jadwal']); ?>.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-row">

                        <!-- <div class="form-group col-lg-12"></div> -->
                        <div class="form-group col-lg-12">
                            <label>Waktu Sesi - Tahun Angkatan :</label>
                            <div class="form-row">
                                <div class="form-group col-6">

                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-alarm"></i></span>
                                        </span>
                                        <?php if ($upsesi != null) : ?>
                                            <input type="text" class="form-control" autocomplete="off" name="waktu" id="anytime-time-1" placeholder="00:00" value="<?= (old('waktu') ? old('waktu') : ucwords($upsesi['waktu'])); ?>">

                                        <?php else : ?>
                                            <input type="text" class="form-control" autocomplete="off" name="waktu" id="anytime-time-1" placeholder="00:00" value="<?= old('waktu'); ?>">

                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($validation['waktu'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['waktu']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-6">
                                    <select data-placeholder="Pilih Tahun" name="tahun_angkatan" class="form-control select-icons select-search" data-fouc>
                                        <option></option>

                                        <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++) : ?>
                                            <?php if ($upsesi != null) : ?>
                                                <?php if (old('tahun_angkatan')) : ?>
                                                    <option value="<?= $i; ?>" <?= (old('tahun_angkatan') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                                <?php else : ?>
                                                    <option value="<?= $i; ?>" <?= ($upsesi['tahun_angkatan'] == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                                <?php endif; ?>
                                            <?php else : ?>
                                                <option value="<?= $i; ?>" <?= (old('tahun_angkatan') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                    <?php if (!empty($validation['tahun_angkatan'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['tahun_angkatan']); ?>.</span>
                                    <?php endif; ?>
                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="text-right">
                        <?php if ($upsesi != null) : ?>
                            <a href="<?= $baseUrl; ?>/sesi" type="button" class="btn btn-link text-dark">Kembali</a>
                        <?php endif; ?>
                        <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Data Sesi
                </h6>
            </div>
            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">Aksi</th>
                        <th colspan="2">Sesi</th>
                        <th>Waktu</th>
                        <th class="text-nowrap">Tahun Angk.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($sesis as $sesi) :

                        $jadwal = $baseMod->getId('tb_jadwal', 'id_jadwal', $sesi['id_jadwal']);

                        $ctable = '';
                        if ($upsesi != null) if ($sesi['id_sesi'] == $upsesi['id_sesi']) $ctable = 'table-warning';

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
                                            <a href="<?= $baseUrl; ?>/sesi/<?= $sesi['slug_sesi']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                            <div class="dropdown-divider"></div>

                                            <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($sesi['slug_sesi']); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap" width="1%"><span class="fw-600">SESI <?= $sesi['sesi']; ?></span> <span class="fs-11">(<?= strtoupper(getRegards($sesi['waktu'])); ?>)</span></td>
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-300">Tggl. Ujian</div>
                                <?= indoDate($jadwal['jadwal']); ?>
                            </td>
                            <td width="1%" class="fw-500 text-center"><?= $sesi['waktu']; ?></td>
                            <td width="1%" class="fw-500 text-center"><?= $sesi['tahun_angkatan']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>