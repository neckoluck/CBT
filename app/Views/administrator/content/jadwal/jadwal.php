<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Form Jadwal
                </h6>
            </div>
            <?php $validation = session()->getFlashdata('validation'); ?>
            <form action="<?= $action['others']; ?>" method="POST">
                <?= csrf_field(); ?>
                <?php
                if ($upjadwal != null) :
                    $pisah = explode('-', $upjadwal['jadwal']); ?>
                    <input type="hidden" name="slug" value="<?= $upjadwal['slug_jadwal']; ?>">

                <?php endif; ?>
                <div class="card-body">
                    <div class="form-row">
                        <!-- <div class="form-group col-12">
                            <label>Jalur :</label>
                            <select data-placeholder="Pilih Jalur" name="jalur" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <option data-icon="dash" value="sbmptn">Jalur SBMPTN</option>
                                <option data-icon="dash" value="mandiri">Jalur Mandiri</option>
                            </select>
                        </div> -->
                        <div class="form-group col-12">
                            <label>Jadwal :</label>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <select data-placeholder="Pilih Tanggal" name="tggl" class="form-control select-icons select-search" data-fouc>
                                        <option></option>
                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                            <?php if ($upjadwal != null) : ?>
                                                <?php if (old('tggl')) : ?>
                                                    <option value="<?= $i; ?>" <?= (old('tggl') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                                <?php else : ?>
                                                    <option value="<?= $i; ?>" <?= ($pisah[2] == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                                <?php endif; ?>
                                            <?php else : ?>
                                                <option value="<?= $i; ?>" <?= (old('tggl') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                    <?php if (!empty($validation['tggl'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['tggl']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-6">
                                    <select data-placeholder="Pilih Bulan" name="bln" class="form-control select-icons select-search" data-fouc>
                                        <option></option>
                                        <?php for ($i = 1; $i <= 12; $i++) : ?>

                                            <?php if ($upjadwal != null) : ?>
                                                <?php if (old('bln')) : ?>
                                                    <option value="<?= $i; ?>" <?= (old('bln') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= getMount($i); ?></option>

                                                <?php else : ?>
                                                    <option value="<?= $i; ?>" <?= ($pisah[1] == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= getMount($i); ?></option>

                                                <?php endif; ?>
                                            <?php else : ?>
                                                <option value="<?= $i; ?>" <?= (old('bln') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= getMount($i); ?></option>

                                            <?php endif; ?>

                                        <?php endfor; ?>
                                    </select>
                                    <?php if (!empty($validation['bln'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['bln']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-2">
                                    <input type="text" class="form-control text-center text-dark fw-500" disabled value="<?= ($upjadwal != null) ? $pisah[0] : date('Y'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <?php if ($upjadwal != null) : ?>
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
                    Data Jadwal
                </h6>
            </div>

            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">Aksi</th>
                        <th>Jadwal</th>
                        <th class="text-center text-nowrap" width="1%">Jum. Sesi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($jadwals as $jadwal) :

                        $sesi    = $baseMod->getBy('tb_sesi', 'id_jadwal = :id_jadwal: AND status_data = 0', ['id_jadwal' => $jadwal['id_jadwal']]);
                        $jumsesi = '-';
                        if ($baseMod->numRows($sesi) > 0) $jumsesi = $baseMod->numRows($sesi);

                        $jumpeserta = '-';
                        $ctable     = '';
                        if ($upjadwal != null) if ($jadwal['id_jadwal'] == $upjadwal['id_jadwal']) $ctable = 'table-warning';

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
                                            <a href="<?= $baseUrl; ?>/jadwal/<?= $jadwal['slug_jadwal']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                            <div class="dropdown-divider"></div>

                                            <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($jadwal['slug_jadwal']); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-300">Tggl. Ujian</div>
                                <?= indoDate($jadwal['jadwal']); ?>
                            </td>
                            <td class="fw-500 text-center"><?= $jumsesi; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>