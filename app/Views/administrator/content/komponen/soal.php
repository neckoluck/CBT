<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    <!-- Left sidebar component -->
    <?= view('administrator/layout/second-sidebar'); ?>
    <!-- /left sidebar component -->


    <!-- Right content -->
    <div class="w-100">
        <?php $validation = session()->getFlashdata('validation'); ?>
        <div class="row">
            <div class="col-4">
                <div class="card-group-control card-group-control-right">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title fw-300">
                                <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1">Data Mata Uji</a>
                            </h6>
                        </div>


                        <div id="collapsible-control-right-group1" class="collapse show">

                            <form action="<?= $action['others']; ?>" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="act" value="act-matauji">
                                <?php if ($upmaju != null) : ?>
                                    <input type="hidden" name="slug" value="<?= $upmaju['slug_mata_uji']; ?>">

                                <?php endif; ?>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-5">
                                            <label>Bidang :</label>
                                            <select data-placeholder="Pilih Bidang" name="id_bidang" class="form-control select-icons select-search" data-fouc>
                                                <option></option>
                                                <?php foreach ($bidangs as $bidang) : ?>
                                                    <?php if ($upmaju != null) : ?>
                                                        <?php if (old('id_bidang')) : ?>
                                                            <option value="<?= $bidang['id_bidang']; ?>" <?= (old('id_bidang') == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $bidang['id_bidang']; ?>" <?= ($upmaju['id_bidang'] == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

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
                                        <div class="form-group col-lg-7">
                                            <label>Mata Uji :</label>
                                            <?php if ($upmaju != null) : ?>
                                                <input type="text" class="form-control" autocomplete="off" name="mata_uji" placeholder="Masukan Nama Mata Uji" value="<?= (old('mata_uji') ? old('mata_uji') : ucwords($upmaju['mata_uji'])); ?>">

                                            <?php else : ?>
                                                <input type="text" class="form-control" autocomplete="off" name="mata_uji" placeholder="Masukan Nama Mata Uji" value="<?= old('mata_uji'); ?>">

                                            <?php endif; ?>
                                            <?php if (!empty($validation['mata_uji'])) : ?>
                                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['mata_uji']); ?>.</span>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <?php if ($upmaju != null) : ?>
                                            <a href="<?= $baseUrl; ?>/komponen/soal" type="button" class="btn btn-link text-dark">Kembali</a>
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
                                    <th>#</th>
                                    <th width="1%">Aksi</th>
                                    <th class="text-nowrap">Mata Uji</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($mataujis as $matauji) :
                                    $ctable = '';
                                    if ($upmaju != null) if ($matauji['id_mata_uji'] == $upmaju['id_mata_uji']) $ctable = 'table-warning';

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
                                                        <a href="<?= $baseUrl; ?>/komponen/soal/<?= $matauji['slug_mata_uji']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                                        <div class="dropdown-divider"></div>

                                                        <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($matauji['slug_mata_uji'] . '+act-matauji'); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-500 text-nowrap">
                                            <div class="fw-300 fs-12">Bidang <?= ucwords($matauji['nama_bidang']); ?></div>
                                            <?= ucwords($matauji['mata_uji']); ?>
                                        </td>
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
                                <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group2">Data Kelompok Soal</a>
                            </h6>
                        </div>


                        <div id="collapsible-control-right-group2" class="collapse show">

                            <form action="<?= $action['others']; ?>" method="POST">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="act" value="act-kelompoksoal">
                                <?php if ($upkesol != null) : ?>
                                    <input type="hidden" name="slug" value="<?= $upkesol['slug_kelompok_soal']; ?>">

                                <?php endif; ?>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label>Kelompok Soal :</label>
                                            <div class="form-row">
                                                <?php if ($upkesol != null) $pisah = explode('-', $upkesol['kelompok_soal']);  ?>
                                                <div class="form-group col-lg-6">
                                                    <select data-placeholder="Pilih Abjad" name="abjad" class="form-control select-icons select-search" data-fouc>
                                                        <option></option>
                                                        <?php foreach (range('a', 'z') as $abjad) : ?>
                                                            <?php if ($upkesol != null) : ?>
                                                                <?php if (old('abjad')) : ?>
                                                                    <option value="<?= $abjad; ?>" <?= (old('abjad') == $abjad) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($abjad); ?></option>

                                                                <?php else : ?>
                                                                    <option value="<?= $abjad; ?>" <?= ($pisah[0] == $abjad) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($abjad); ?></option>

                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <option value="<?= $abjad; ?>" <?= (old('abjad') == $abjad) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper($abjad); ?></option>

                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php if (!empty($validation['abjad'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['abjad']); ?>.</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <select data-placeholder="Pilih Nomer" name="number" class="form-control select-icons select-search" data-fouc>
                                                        <option></option>
                                                        <?php foreach (range(1, 10) as $num) : ?>
                                                            <?php if ($upkesol != null) : ?>
                                                                <?php if (old('abjad')) : ?>
                                                                    <option value="<?= $num; ?>" <?= (old('number') == $num) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $num; ?></option>

                                                                <?php else : ?>
                                                                    <option value="<?= $num; ?>" <?= ($pisah[1] == $num) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $num; ?></option>

                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <option value="<?= $num; ?>" <?= (old('number') == $num) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $num; ?></option>

                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php if (!empty($validation['number'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['number']); ?>.</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Bidang :</label>
                                            <select data-placeholder="Pilih Bidang" name="idbidang" class="form-control select-icons select-search" data-fouc>
                                                <option></option>
                                                <?php foreach ($bidangs as $bidang) : ?>
                                                    <?php if ($upkesol != null) : ?>
                                                        <?php if (old('idbidang')) : ?>
                                                            <option value="<?= $bidang['id_bidang']; ?>" <?= (old('idbidang') == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $bidang['id_bidang']; ?>" <?= ($upkesol['id_bidang'] == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <option value="<?= $bidang['id_bidang']; ?>" <?= (old('idbidang') == $bidang['id_bidang']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($bidang['nama_bidang']); ?></option>

                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                            </select>
                                            <?php if (!empty($validation['idbidang'])) : ?>
                                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['idbidang']); ?>.</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-3">
                                            <label>Tahun :</label>
                                            <select data-placeholder="Pilih Tahun" name="tahun" class="form-control select-icons select-search" data-fouc>
                                                <option></option>
                                                <?php for ($i = date('Y') - 3; $i <= date('Y'); $i++) : ?>
                                                    <?php if ($upkesol != null) : ?>
                                                        <?php if (old('tahun')) : ?>
                                                            <option value="<?= $i; ?>" <?= (old('tahun') == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $i; ?>" <?= ($upkesol['tahun'] == $i) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= $i; ?></option>

                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <option value="<?= $i; ?>" data-icon="dash"><?= $i; ?></option>

                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </select>
                                            <?php if (!empty($validation['tahun'])) : ?>
                                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['tahun']); ?>.</span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group col-lg-9">
                                            <div class="form-row">
                                                <div class="form-group col-lg-6">
                                                    <label>Jumlah Soal :</label>
                                                    <?php if ($upkesol != null) : ?>
                                                        <input type="text" class="form-control touchspin-vertical" autocomplete="off" name="jumlah_soal" placeholder="Masukan Jum. Soal" value="<?= (old('jumlah_soal') ? old('jumlah_soal') : ucwords($upkesol['jumlah_soal'])); ?>">

                                                    <?php else : ?>
                                                        <input type="text" class="form-control touchspin-vertical" autocomplete="off" name="jumlah_soal" placeholder="Masukan Jum. Soal" value="<?= old('jumlah_soal'); ?>">

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['jumlah_soal'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['jumlah_soal']); ?>.</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Durasi : <sup class="fs-11 fw-400 text-danger">**hitungan menit</sup></label>
                                                    <?php if ($upkesol != null) : ?>
                                                        <input type="text" class="form-control touchspin-vertical" autocomplete="off" name="durasi" placeholder="Masukan Durasi" value="<?= (old('durasi') ? old('durasi') : ucwords($upkesol['durasi'])); ?>">

                                                    <?php else : ?>
                                                        <input type="text" class="form-control touchspin-vertical" autocomplete="off" name="durasi" placeholder="Masukan Durasi" value="<?= old('durasi'); ?>">

                                                    <?php endif; ?>
                                                    <?php if (!empty($validation['durasi'])) : ?>
                                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['durasi']); ?>.</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <?php if ($upkesol != null) : ?>
                                            <a href="<?= $baseUrl; ?>/komponen/soal" type="button" class="btn btn-link text-dark">Kembali</a>
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
                                    <th>#</th>
                                    <th width="1%">Aksi</th>
                                    <th class="text-nowrap" colspan="2">Kelompok Soal - Bidang</th>
                                    <th width="1%">Durasi</th>
                                    <th width="1%" class="text-nowrap">Jum. Soal</th>
                                    <th width="1%">Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($kesols as $kesol) :
                                    $jum    = '-';
                                    $ctable = '';
                                    if ($upkesol != null) if ($kesol['id_kelompok_soal'] == $upkesol['id_kelompok_soal']) $ctable = 'table-warning';

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
                                                        <a href="<?= $baseUrl; ?>/komponen/soal/<?= $kesol['slug_kelompok_soal']; ?>" class="dropdown-item fs-11"><i class="icon-pencil7"></i> UBAH DATA</a>
                                                        <div class="dropdown-divider"></div>

                                                        <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($kesol['slug_kelompok_soal'] . '+act-kelompoksoal'); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-500 text-nowrap text-center" width="1%"><?= ucwords($kesol['kelompok_soal']); ?></td>
                                        <td>Bidang <?= ucwords($kesol['nama_bidang']); ?></td>
                                        <td class="fw-500 text-nowrap" width="1%"><?= $kesol['durasi']; ?> menit</td>
                                        <td class="text-center fw-500"><?= $kesol['jumlah_soal']; ?></td>
                                        <td class="text-center"><?= $kesol['tahun']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /right content -->

</div>
<!-- /inner container -->