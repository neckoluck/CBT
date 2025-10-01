<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Data Sesi & Jadwal
                </h6>
            </div>
            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th>Sesi</th>
                        <th>Jadwal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($sesis as $sesi) :

                        $jadwal = $baseMod->getId('tb_jadwal', 'id_jadwal', $sesi['id_jadwal']);

                        $no++; ?>
                        <tr class="">
                            <td width="1%"><?= $no; ?>.</td>
                            <td class="text-nowrap" width="1%">
                                <span class="fw-600">SESI <?= $sesi['sesi']; ?></span>
                                <div class="fw-300 fs-11"><?= $sesi['waktu']; ?> <span class="fs-11">(<?= strtoupper(getRegards($sesi['waktu'])); ?>)
                                    </span></div>
                            </td>
                            <td class="fw-500">
                                <div class="fs-12 fw-300">Tggl. Ujian</div>
                                <?= indoDate($jadwal['jadwal']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Form Sesi
                </h6>
            </div>
            <div class="card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, ut dolor? Temporibus dicta atque sapiente at itaque.
            </div>
            <?php $validation = session()->getFlashdata('validation'); ?>
            <form action="<?= $action['others']; ?>" method="POST">
                <?= csrf_field(); ?>
                <?php if ($upruses != null) : ?>
                    <input type="hidden" name="slug" value="<?= $upruses['slug_ruangan_sesi']; ?>">
                    <input type="hidden" name="aksi" value="up-ruses">

                <?php endif; ?>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label>Ruangan :</label>
                            <select data-placeholder="Pilih Ruangan" name="id_ruangan" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <?php foreach ($ruangs as $ruang) : ?>
                                    <?php if ($upruses != null) : ?>
                                        <?php if (old('id_ruangan')) : ?>
                                            <option value="<?= $ruang['id_ruangan']; ?>" <?= (old('id_ruangan') == $ruang['id_ruangan']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>RUANG. <?= strtoupper($ruang['nama_ruangan']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $ruang['id_ruangan']; ?>" <?= ($upruses['id_ruangan'] == $ruang['id_ruangan']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>RUANG. <?= strtoupper($ruang['nama_ruangan']); ?></option>

                                        <?php endif; ?>

                                    <?php else : ?>
                                        <option value="<?= $ruang['id_ruangan']; ?>" <?= (old('id_ruangan') == $ruang['id_ruangan']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>RUANG. <?= strtoupper($ruang['nama_ruangan']); ?></option>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($validation['id_ruangan'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_ruangan']); ?>.</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-3">
                            <label>Sesi :</label>
                            <select data-placeholder="Pilih Sesi" name="id_sesi" class="form-control select-icons select-search" data-fouc>
                                <option></option>

                                <?php foreach ($sesis as $ss) : ?>
                                    <?php if ($upruses != null) : ?>
                                        <?php if (old('id_sesi')) : ?>
                                            <option value="<?= $ss['id_sesi']; ?>" <?= (old('id_sesi') ==  $ss['id_sesi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>SESI <?= $ss['sesi']; ?> - <?= indoDate($ss['jadwal']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $ss['id_sesi']; ?>" <?= ($upruses['id_sesi'] ==  $ss['id_sesi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>SESI <?= $ss['sesi']; ?> - <?= indoDate($ss['jadwal']); ?></option>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="<?= $ss['id_sesi']; ?>" <?= (old('id_sesi') ==  $ss['id_sesi']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>>SESI <?= $ss['sesi']; ?> - <?= indoDate($ss['jadwal']); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </select>
                            <?php if (!empty($validation['id_sesi'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_sesi']); ?>.</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-3">
                            <label>Pengawas :</label>
                            <select data-placeholder="Pilih Pengawas" name="id_pengawas" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <?php foreach ($staf['pengawas'] as $pengawas) : ?>
                                    <?php if ($upruses != null) : ?>
                                        <?php if (old('id_pengawas')) : ?>
                                            <option value="<?= $pengawas['id_staf']; ?>" <?= (old('id_pengawas') == $pengawas['id_staf']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper(is_gender($pengawas['jk_staf']) . $pengawas['nama_staf']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $pengawas['id_staf']; ?>" <?= ($upruses['id_pengawas'] == $pengawas['id_staf']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper(is_gender($pengawas['jk_staf']) . $pengawas['nama_staf']); ?></option>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="<?= $pengawas['id_staf']; ?>" <?= (old('id_pengawas') == $pengawas['id_staf']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper(is_gender($pengawas['jk_staf']) . $pengawas['nama_staf']); ?></option>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($validation['id_pengawas'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_pengawas']); ?>.</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-3">
                            <label>Teknisi :</label>
                            <select data-placeholder="Pilih Teknisi" name="id_teknisi" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <?php foreach ($staf['teknisi'] as $teknisi) : ?>
                                    <?php if ($upruses != null) : ?>
                                        <?php if (old('id_teknisi')) : ?>
                                            <option value="<?= $teknisi['id_staf']; ?>" <?= (old('id_teknisi') == $teknisi['id_staf']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper(is_gender($teknisi['jk_staf']) . $teknisi['nama_staf']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $teknisi['id_staf']; ?>" <?= ($upruses['id_teknisi'] == $teknisi['id_staf']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper(is_gender($teknisi['jk_staf']) . $teknisi['nama_staf']); ?></option>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="<?= $teknisi['id_staf']; ?>" <?= (old('id_teknisi') == $teknisi['id_staf']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= strtoupper(is_gender($teknisi['jk_staf']) . $teknisi['nama_staf']); ?></option>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($validation['id_teknisi'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_teknisi']); ?>.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-3">
                            <label>Kelompok Soal :</label>
                            <select data-placeholder="Pilih Kelompok Soal" name="id_kelompok_soal" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <?php
                                foreach ($bidangs as $bidang) :
                                    $params3 = ['id_bidang' => $bidang['id_bidang'], 'status' => 0];
                                    $sql3    = $baseMod->getBy('tb_kelompok_soal', 'id_bidang = :id_bidang: AND status_data = :status: ORDER BY tahun ASC', $params3);
                                    $count   = $baseMod->numRows($sql3); ?>
                                    <?php if ($count > 0) : ?>
                                        <optgroup label="Bidang <?= ucwords($bidang['nama_bidang']); ?>">
                                            <?php
                                            $kesols = $baseMod->getRows($sql3);
                                            foreach ($kesols as $kesol) : ?>
                                                <?php if ($upruses != null) : ?>
                                                    <?php if (old('id_kelompok_soal')) : ?>
                                                        <option value="<?= $kesol['id_kelompok_soal']; ?>" <?= (old('id_kelompok_soal') == $kesol['id_kelompok_soal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($kesol['kelompok_soal']); ?></option>

                                                    <?php else : ?>
                                                        <option value="<?= $kesol['id_kelompok_soal']; ?>" <?= ($upruses['id_kelompok_soal'] == $kesol['id_kelompok_soal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($kesol['kelompok_soal']); ?></option>

                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <option value="<?= $kesol['id_kelompok_soal']; ?>" <?= (old('id_kelompok_soal') == $kesol['id_kelompok_soal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($kesol['kelompok_soal']); ?></option>

                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($validation['id_kelompok_soal'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_kelompok_soal']); ?>.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-active">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="fs-12"><span class="icon-notification2 fs-15 mr-1"></span> Form ini nanti akan diisi oleh Pengawas yang sudah ditentukan.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="form-row">
                                <div class="form-group col-lg-2">
                                    <label>Mulai Ujian :</label>
                                    <input type="text" class="form-control" autocomplete="off" id="anytime-time-1" placeholder="**Diisi Pengawas" disabled value="<?= old('waktu'); ?>">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>Selesai Ujian :</label>
                                    <input type="text" class="form-control" autocomplete="off" id="anytime-time-2" placeholder="**Diisi Pengawas" disabled value="<?= old('waktu'); ?>">
                                </div>
                                <div class="form-group col-8">
                                    <label>Catatan :</label>
                                    <input type="text" class="form-control" placeholder="**Diisi Pengawas" value="<?= old('catatan'); ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center">
                        <a href="<?= $actUrl; ?>" type="button" class="btn btn-link text-dark">Kembali</a>
                        <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>