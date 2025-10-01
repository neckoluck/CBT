<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Jumlah Soal
                </h6>
            </div>
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr class="table-active">
                        <td colspan="2">
                            <span class="fw-500">Jumlah Soal yang diupload / Jumlah Soal yang ditentukan</span> dari setiap kelompok soal.
                        </td>
                    </tr>
                    <?php
                    foreach ($kesol1 as $ksl) :
                        $sql   = $baseMod->getBy('tb_soal', 'id_kelompok_soal = :id: AND status_data = 0', ['id' => $ksl['id_kelompok_soal']]);
                        $count = $baseMod->numRows($sql);

                        $pas   = "";
                        if ($count >= $ksl['jumlah_soal']) $pas = "table-danger"; ?>
                        <tr class="<?= $pas; ?>">
                            <td class="fw-500">
                                <div class="fs-12 fw-300">Bidang <?= ucwords($ksl['nama_bidang']); ?></div>
                                <?= strtoupper($ksl['kelompok_soal']); ?>
                            </td>
                            <td class="text-nowrap" width="1%"><?= $count; ?>/<?= $ksl['jumlah_soal']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Petunjuk Penulisan Rumus
                </h6>
            </div>
            <div class="card-body">
                Format inline dibuat dengan menempatkan notasi atau rumus matematika ditengah tanda dollar <strong>$</strong>. Contoh penulisan dengan tampilan inline adalah :
                <div class="ml-3 mt-2 mb-2">$<samp>\lim_{x \to 0}f(x)=1</samp>$</div>
                <p>hasilnya adalah :</p>
                <span class="ml-3">\(\lim_{x \to 0}f(x)=1.\)</span>
            </div>
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th class="fw-500" colspan="2">
                            Beberapa Contoh Penulisan :
                        </th>
                    </tr>
                    <tr class="table-active">
                        <th>Sumber Kode</th>
                        <th class="text-nowrap">Tampilan Web</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$<samp>x+y</samp>$</td>
                        <td class="text-center">$x+y$</td>
                    </tr>
                    <tr>
                        <td>$<samp>x \times y</samp>$</td>
                        <td class="text-center">$x \times y$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Pecahan</td>
                    </tr>
                    <tr>
                        <td>$<samp>x/y</samp>$</td>
                        <td class="text-center">$x/y$</td>
                    </tr>
                    <tr>
                        <td>$<samp>\frac {x}{y}</samp>$</td>
                        <td class="text-center">$\frac {x}{y}$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Pangkat</td>
                    </tr>
                    <tr>
                        <td>$<samp>x^{2}</samp>$</td>
                        <td class="text-center">$x^{2}$</td>
                    </tr>
                    <tr>
                        <td>$<samp>x^{-2}</samp>$</td>
                        <td class="text-center">$x^{-2}$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Akar</td>
                    </tr>
                    <tr>
                        <td>$<samp>\sqrt[x]{y}</samp>$</td>
                        <td class="text-center">$\sqrt[x]{y}$</td>
                    </tr>
                    <tr>
                        <td>$<samp>\sqrt{\sqrt{x}}</samp>$</td>
                        <td class="text-center">$\sqrt{\sqrt{x}}$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Tanda Kurung</td>
                    </tr>
                    <tr>
                        <td>$<samp>(x)</samp>$</td>
                        <td class="text-center">$(x)$</td>
                    </tr>
                    <tr>
                        <td>$<samp>\left[ \frac{1}{(x \times y)} \right]</samp>$</td>
                        <td class="text-center">$\left[ \frac{1}{(x \times y)} \right]$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Bar & Hat</td>
                    </tr>
                    <tr>
                        <td>$<samp>\bar x</samp>$</td>
                        <td class="text-center">$\bar x$</td>
                    </tr>
                    <tr>
                        <td>$<samp>\hat y</samp>$</td>
                        <td class="text-center">$\hat y$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Integral</td>
                    </tr>
                    <tr>
                        <td>$<samp>\int \limits_{-\infty }^{\infty }{f(x)} \, dx</samp>$</td>
                        <td class="text-center">$\int \limits_{-\infty }^{\infty }{f(x)} \, dx$</td>
                    </tr>
                    <tr>
                        <td>$<samp>F(x) \Bigr|_{-\infty}^{\infty}</samp>$</td>
                        <td class="text-center">$F(x) \Bigr|_{-\infty}^{\infty}$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Sigma & Pi</td>
                    </tr>
                    <tr>
                        <td>$<samp>\sum \limits_{i=1}^{n} {x_i}</samp>$</td>
                        <td class="text-center">$\sum \limits_{i=1}^{n} {x_i}$</td>
                    </tr>
                    <tr>
                        <td>$<samp>\prod\limits_{i=1}^n{x_i}</samp>$</td>
                        <td class="text-center">$\prod\limits_{i=1}^n{x_i}$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Permutasi & Kombinasi</td>
                    </tr>
                    <tr>
                        <td>$<samp>^nP_k</samp>$</td>
                        <td class="text-center">$^nP_k$</td>
                    </tr>
                    <tr>
                        <td>$<samp>^nC_k</samp>$</td>
                        <td class="text-center">$^nC_k$</td>
                    </tr>
                    <tr class="table-active">
                        <td class="fw-500" colspan="2">Vektor & Matriks</td>
                    </tr>
                    <tr>
                        <td>$<samp>\left( \begin{matrix}<samp>y_1 \\y_2 \\\vdots \\y_n </samp>\\\end{matrix} \right)</samp>$</td>
                        <td class="text-center">$\left( \begin{matrix} y_1 \\y_2 \\\vdots \\y_n \\\end{matrix} \right)$</td>
                    </tr>
                    <tr>
                        <td>$<samp>\left( \begin{matrix}<samp>1 & x_1 \\1 & x_2 \\\vdots & \vdots \\1 & x_n\</samp>end{matrix} \right)</samp>$</td>
                        <td class="text-center">$\left( \begin{matrix} 1 & x_1 \\1 & x_2 \\\vdots & \vdots \\1 & x_n\end{matrix} \right)$</td>
                    </tr>
                </tbody>
            </table>
            <div class="card-body">
                Jika rumus yang mau diikuti lumayan sulit, Admin dapat menggunakan software <a href="https://mathpix.com/" target="_blank">Mathpix Snipping Tools</a>.
                <p class="mt-2">Software ini dapat mempermudah dalam penulisan rumus yang sulit dan ingin diterjemahkan dalam kode LaTex.</p> Cukup dengan melakukan snipping pada rumus yang ingin di terjemahkan dan hasil terjemahan rumus ke kode LaTex dapat langsung di copy kedalam text editor
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    Form Soal
                </h6>
            </div>
            <div class="card-body">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corporis ipsum sed aut obcaecati quaerat, cum ipsa tenetur soluta eligendi beatae, sequi commodi ut cupiditate reiciendis? Ipsum odit numquam sunt iure.
            </div>
            <?php $validation = session()->getFlashdata('validation'); ?>
            <form action="<?= $action['others']; ?>" method="POST" enctype="multipart/form-data">
                <?php if ($upsoal != null) : ?>
                    <input type="hidden" name="slug" value="<?= $upsoal['slug_soal']; ?>">
                <?php endif; ?>
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-row">
                        <?php if ($upsoal == null) : ?>
                            <div class="form-group col-3">
                                <label>Kelompok Soal : </label>
                                <p class="fw-500"><?= strtoupper($type['kelompok_soal']); ?> (Bidang <?= ucwords($type['bidang_kelompok_soal']); ?>)</p>
                            </div>
                            <div class="form-group col-3">
                                <label>Mata Uji :</label>
                                <p class="fw-500"><?= ucwords($type['mata_uji']); ?> (Bidang <?= ucwords($type['bidang_mata_uji']); ?>)</p>
                            </div>
                        <?php else : ?>
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
                                                    <?php if ($upsoal != null) : ?>
                                                        <?php if (old('id_kelompok_soal')) : ?>
                                                            <option value="<?= $kesol['id_kelompok_soal']; ?>" <?= (old('id_kelompok_soal') == $kesol['id_kelompok_soal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($kesol['kelompok_soal']); ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $kesol['id_kelompok_soal']; ?>" <?= ($upsoal['id_kelompok_soal'] == $kesol['id_kelompok_soal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($kesol['kelompok_soal']); ?></option>

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

                            <div class="form-group col-3">
                                <label>Mata Uji :</label>
                                <select data-placeholder="Pilih Mata Uji" name="id_mata_uji" class="form-control select-icons select-search" data-fouc>
                                    <option></option>
                                    <?php
                                    foreach ($bidangs as $bidang) :
                                        $params3 = ['id_bidang' => $bidang['id_bidang'], 'status' => 0];
                                        $sql3    = $baseMod->getBy('tb_mata_uji', 'id_bidang = :id_bidang: AND status_data = :status:', $params3);
                                        $count   = $baseMod->numRows($sql3); ?>

                                        <?php if ($count > 0) : ?>
                                            <optgroup label="Bidang <?= ucwords($bidang['nama_bidang']); ?>">
                                                <?php
                                                $majus = $baseMod->getRows($sql3);
                                                foreach ($majus as $maju) : ?>
                                                    <?php if ($upsoal != null) : ?>
                                                        <?php if (old('id_mata_uji')) : ?>
                                                            <option value="<?= $maju['id_mata_uji']; ?>" <?= (old('id_mata_uji') == $maju['id_mata_uji']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($maju['mata_uji']); ?></option>

                                                        <?php else : ?>
                                                            <option value="<?= $maju['id_mata_uji']; ?>" <?= ($upsoal['id_mata_uji'] == $maju['id_mata_uji']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($maju['mata_uji']); ?></option>

                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <option value="<?= $maju['id_mata_uji']; ?>" <?= (old('id_mata_uji') == $maju['id_mata_uji']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($maju['mata_uji']); ?></option>

                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($validation['id_mata_uji'])) : ?>
                                    <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_mata_uji']); ?>.</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="">Soal Tes (Paragraf Pertama) :</label>
                            <?php if ($upsoal != null) : ?>
                                <textarea id="editor-full-a" rows="3" cols="3" name="soal_1"><?= (old('soal_1')) ? old('soal_1') : $upsoal['soal_1']; ?></textarea>

                            <?php else : ?>
                                <textarea id="editor-full-a" rows="3" cols="3" name="soal_1"><?= old('soal_1'); ?></textarea>

                            <?php endif; ?>
                            <?php if (!empty($validation['soal_1'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['soal_1']); ?>.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card-body table-active">

                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="fs-12"><span class="icon-notification2 fs-15 mr-1"></span> Kosongkan form ini jika soal tidak disertai gambar & jika ada kesalahan dalam penginputan soal atau ingin melakukan perubahan pada soal yang disertai gambar, harap klik tombol <strong class="badge bg-slate shadow-1 fw-600 fs-11 ml-1 mr-1"><i class="icon-eye8"></i></strong> untuk memeriksa kembali gambar yang diunggah.</div>
                        </div>
                        <div class="form-group col-3">
                            <label>Posisi Gambar :</label>
                            <select data-placeholder="Pilih Posisi Gambar" name="posisi_gambar" class="form-control select-icons select-search" data-fouc>
                                <option></option>
                                <?php foreach (is_position() as $pos) : ?>
                                    <?php if ($upsoal != null) : ?>
                                        <?php if (old('posisi_gambar')) : ?>
                                            <option value="<?= $pos['id']; ?>" <?= (old('posisi_gambar') == $pos['id']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($pos['status']); ?></option>

                                        <?php else : ?>
                                            <option value="<?= $pos['id']; ?>" <?= ($upsoal['posisi_gambar'] == $pos['id']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($pos['status']); ?></option>

                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="<?= $pos['id']; ?>" <?= (old('posisi_gambar') == $pos['id']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($pos['status']); ?></option>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($validation['posisi_gambar'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['posisi_gambar']); ?>.</span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-9">
                            <label for="">Unggah Gambar :</label>
                            <div class="input-group">
                                <input type="file" id="namaFile" name="namaFile" class="form-input-styled mr-1 btn-upload" onchange="previewImg()" data-fouc>
                                <div class="btn-group p-l-2">
                                    <button type="button" class="btn bg-slate" data-target="#md-imgview" data-toggle="modal"><span class="icon-eye8"></span></button>
                                    <?php if ($upsoal != null) : ?>
                                        <?php if ($upsoal['gambar_soal'] !== 'default.jpg') : ?>
                                            <a href="#" data-delete="<?= encode($upsoal['id_soal'] . '+act-imgsoal'); ?>" class="btn btn-danger md-imgdelete" data-target="#md-imgdelete" data-toggle="modal" type="button"><span class="icon-trash"></span></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="form-text text-muted fw-300">Ekstensi : JPG, JPEG - Ukuran Maks. 1MB</span>
                            <?php if (!empty($validation['namaFile'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile']); ?>.</span>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="">Soal Tes (Paragraf Kedua) :</label>
                            <div class="fs-12 mb-3"><span class="icon-info22 fs-15 mr-1"></span> Diisi jika posisi gambar berada ditengah</div>
                            <?php if ($upsoal != null) : ?>
                                <textarea id="editor-full-b" rows="3" cols="3" name="soal_2"><?= old('soal_2') ? old('soal_2') : $upsoal['soal_2']; ?></textarea>

                            <?php else : ?>
                                <textarea id="editor-full-b" rows="3" cols="3" name="soal_2"><?= old('soal_2'); ?></textarea>

                            <?php endif; ?>
                            <?php if (!empty($validation['soal_2'])) : ?>
                                <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['soal_2']); ?>.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="">Opsi Jawaban :</label>
                            <div class="fs-12 mb-3"><span class="icon-notification2 fs-15 mr-1"></span> Jika ada kesalahan dalam penginputan jawaban atau ingin melakukan perubahan pada jawaban yang disertai gambar, harap klik 5 tombol <strong class="badge bg-slate shadow-1 fw-600 fs-11 ml-1 mr-1"><i class="icon-eye8"></i></strong> untuk memeriksa kembali gambar yang diunggah.</div>
                            <div class="form-row">
                                <div class="form-group col-12">

                                    <div class="custom-control custom-control-right custom-radio custom-control-inline">
                                        <?php if ($upsoal != null) : ?>
                                            <?php if (old('opsi')) : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="1" id="custom_radio_inline_right_checked-1" <?= (old('opsi') == 1) ? 'checked' : ''; ?>>

                                            <?php else : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="1" id="custom_radio_inline_right_checked-1" <?= ($upsoal['jawaban_benar'] == 1) ? 'checked' : ''; ?>>

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="radio" class="custom-control-input" name="opsi" value="1" id="custom_radio_inline_right_checked-1" <?= (old('opsi') == 1) ? 'checked' : ''; ?>>

                                        <?php endif; ?>
                                        <label class="custom-control-label position-static" for="custom_radio_inline_right_checked-1">A. Jika opsi ini benar klik radio button <span class="icon-point-right fs-12"></span></label>
                                    </div>
                                    <?php if (!empty($validation['opsi'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['opsi']); ?>.</span>
                                    <?php endif; ?>

                                    <div class="mt-3"></div>

                                    <label class="mb-2 fw-500">Opsi Jawaban Teks :</label>
                                    <?php if ($upsoal != null) : ?>
                                        <textarea name="jawaban_1" id="editor-full-1" rows="3" cols="3"><?= old('jawaban_1') ? old('jawaban_1') : $upsoal['jawaban_1']; ?></textarea>

                                    <?php else : ?>
                                        <textarea name="jawaban_1" id="editor-full-1" rows="3" cols="3"><?= old('jawaban_1'); ?></textarea>

                                    <?php endif; ?>

                                    <?php if (!empty($validation['jawaban_1'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['jawaban_1']); ?>.</span>
                                    <?php endif; ?>

                                    <label class=" mt-4 mb-2 fw-500">Opsi Jawaban Gambar :</label>
                                    <div class="input-group">
                                        <input type="file" id="namaFile1" name="namaFile1" class="form-input-styled btn-upload1" onchange="previewImg1()" data-fouc>
                                        <div class="btn-group p-l-2">
                                            <button type="button" class="btn bg-slate" data-target="#md-imgview1" data-toggle="modal"><span class="icon-eye8"></span></button>
                                            <?php if ($upsoal != null) : ?>
                                                <?php if ($upsoal['gambar_1'] !== 'default.jpg') : ?>
                                                    <a href="#" data-delete="<?= encode($upsoal['id_opsi_1'] . '+act-imgopsi'); ?>" class="btn btn-danger md-imgdelete1" data-target="#md-imgdelete1" data-toggle="modal" type="button"><span class="icon-trash"></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted fw-300">Ekstensi : JPG, JPEG - Ukuran Maks. 1MB</span>
                                    <?php if (!empty($validation['namaFile1'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile1']); ?>.</span>
                                    <?php endif; ?>

                                    <hr class="mt-4">
                                </div>
                                <div class="form-group col-12">

                                    <div class="custom-control custom-control-right custom-radio custom-control-inline">
                                        <?php if ($upsoal != null) : ?>
                                            <?php if (old('opsi')) : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="2" id="custom_radio_inline_right_checked-2" <?= (old('opsi') == 2) ? 'checked' : ''; ?>>

                                            <?php else : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="2" id="custom_radio_inline_right_checked-2" <?= ($upsoal['jawaban_benar'] == 2) ? 'checked' : ''; ?>>

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="radio" class="custom-control-input" name="opsi" value="2" id="custom_radio_inline_right_checked-2" <?= (old('opsi') == 2) ? 'checked' : ''; ?>>

                                        <?php endif; ?>
                                        <label class="custom-control-label position-static" for="custom_radio_inline_right_checked-2">B. Jika opsi ini benar klik radio button <span class="icon-point-right fs-12"></span></label>
                                    </div>
                                    <?php if (!empty($validation['opsi'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['opsi']); ?>.</span>
                                    <?php endif; ?>

                                    <div class="mt-3"></div>

                                    <label class="mb-2 fw-500">Opsi Jawaban Teks :</label>
                                    <?php if ($upsoal != null) : ?>
                                        <textarea name="jawaban_2" id="editor-full-2" rows="3" cols="3"><?= old('jawaban_2') ? old('jawaban_2') : $upsoal['jawaban_2']; ?></textarea>

                                    <?php else : ?>
                                        <textarea name="jawaban_2" id="editor-full-2" rows="3" cols="3"><?= old('jawaban_2'); ?></textarea>

                                    <?php endif; ?>
                                    <?php if (!empty($validation['jawaban_2'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['jawaban_2']); ?>.</span>
                                    <?php endif; ?>

                                    <label class=" mt-4 mb-2 fw-500">Opsi Jawaban Gambar :</label>
                                    <div class="input-group">
                                        <input type="file" id="namaFile2" name="namaFile2" class="form-input-styled btn-upload2" onchange="previewImg2()" data-fouc>
                                        <div class="btn-group p-l-2">
                                            <button type="button" class="btn bg-slate" data-target="#md-imgview2" data-toggle="modal"><span class="icon-eye8"></span></button>
                                            <?php if ($upsoal != null) : ?>
                                                <?php if ($upsoal['gambar_2'] !== 'default.jpg') : ?>
                                                    <a href="#" data-delete="<?= encode($upsoal['id_opsi_2'] . '+act-imgopsi'); ?>" class="btn btn-danger md-imgdelete2" data-target="#md-imgdelete2" data-toggle="modal" type="button"><span class="icon-trash"></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted fw-300">Ekstensi : JPG, JPEG - Ukuran Maks. 1MB</span>
                                    <?php if (!empty($validation['namaFile2'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile2']); ?>.</span>
                                    <?php endif; ?>
                                    <hr class="mt-4">
                                </div>
                                <div class="form-group col-12">

                                    <div class="custom-control custom-control-right custom-radio custom-control-inline">
                                        <?php if ($upsoal != null) : ?>
                                            <?php if (old('opsi')) : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="3" id="custom_radio_inline_right_checked-3" <?= (old('opsi') == 3) ? 'checked' : ''; ?>>

                                            <?php else : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="3" id="custom_radio_inline_right_checked-3" <?= ($upsoal['jawaban_benar'] == 3) ? 'checked' : ''; ?>>

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="radio" class="custom-control-input" name="opsi" value="3" id="custom_radio_inline_right_checked-3" <?= (old('opsi') == 3) ? 'checked' : ''; ?>>

                                        <?php endif; ?>
                                        <label class="custom-control-label position-static" for="custom_radio_inline_right_checked-3">C. Jika opsi ini benar klik radio button <span class="icon-point-right fs-12"></span></label>
                                    </div>
                                    <?php if (!empty($validation['opsi'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['opsi']); ?>.</span>
                                    <?php endif; ?>

                                    <div class="mt-3"></div>

                                    <label class="mb-2 fw-500">Opsi Jawaban Teks :</label>
                                    <?php if ($upsoal != null) : ?>
                                        <textarea name="jawaban_3" id="editor-full-3" rows="3" cols="3"><?= old('jawaban_3') ? old('jawaban_3') : $upsoal['jawaban_3']; ?></textarea>

                                    <?php else : ?>
                                        <textarea name="jawaban_3" id="editor-full-3" rows="3" cols="3"><?= old('jawaban_3'); ?></textarea>

                                    <?php endif; ?>
                                    <?php if (!empty($validation['jawaban_3'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['jawaban_3']); ?>.</span>
                                    <?php endif; ?>

                                    <label class=" mt-4 mb-2 fw-500">Opsi Jawaban Gambar :</label>
                                    <div class="input-group">
                                        <input type="file" id="namaFile3" name="namaFile3" class="form-input-styled btn-upload3" onchange="previewImg3()" data-fouc>
                                        <div class="btn-group p-l-2">
                                            <button type="button" class="btn bg-slate" data-target="#md-imgview3" data-toggle="modal"><span class="icon-eye8"></span></button>
                                            <?php if ($upsoal != null) : ?>
                                                <?php if ($upsoal['gambar_3'] !== 'default.jpg') : ?>
                                                    <a href="#" data-delete="<?= encode($upsoal['id_opsi_3'] . '+act-imgopsi'); ?>" class="btn btn-danger md-imgdelete3" data-target="#md-imgdelete3" data-toggle="modal" type="button"><span class="icon-trash"></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted fw-300">Ekstensi : JPG, JPEG - Ukuran Maks. 1MB</span>
                                    <?php if (!empty($validation['namaFile3'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile3']); ?>.</span>
                                    <?php endif; ?>
                                    <hr class="mt-4">
                                </div>
                                <div class="form-group col-12">

                                    <div class="custom-control custom-control-right custom-radio custom-control-inline">
                                        <?php if ($upsoal != null) : ?>
                                            <?php if (old('opsi')) : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="4" id="custom_radio_inline_right_checked-4" <?= (old('opsi') == 4) ? 'checked' : ''; ?>>

                                            <?php else : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="4" id="custom_radio_inline_right_checked-4" <?= ($upsoal['jawaban_benar'] == 4) ? 'checked' : ''; ?>>

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="radio" class="custom-control-input" name="opsi" value="4" id="custom_radio_inline_right_checked-4" <?= (old('opsi') == 4) ? 'checked' : ''; ?>>

                                        <?php endif; ?>
                                        <label class="custom-control-label position-static" for="custom_radio_inline_right_checked-4">D. Jika opsi ini benar klik radio button <span class="icon-point-right fs-12"></span></label>
                                    </div>
                                    <?php if (!empty($validation['opsi'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['opsi']); ?>.</span>
                                    <?php endif; ?>

                                    <div class="mt-3"></div>

                                    <label class="mb-2 fw-500">Opsi Jawaban Teks :</label>
                                    <?php if ($upsoal != null) : ?>
                                        <textarea name="jawaban_4" id="editor-full-4" rows="3" cols="3"><?= old('jawaban_4') ? old('jawaban_4') : $upsoal['jawaban_4']; ?></textarea>

                                    <?php else : ?>
                                        <textarea name="jawaban_4" id="editor-full-4" rows="3" cols="3"><?= old('jawaban_4'); ?></textarea>

                                    <?php endif; ?>
                                    <?php if (!empty($validation['jawaban_4'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['jawaban_4']); ?>.</span>
                                    <?php endif; ?>

                                    <label class=" mt-4 mb-2 fw-500">Opsi Jawaban Gambar :</label>
                                    <div class="input-group">
                                        <input type="file" id="namaFile4" name="namaFile4" class="form-input-styled btn-upload4" onchange="previewImg4()" data-fouc>
                                        <div class="btn-group p-l-2">
                                            <button type="button" class="btn bg-slate" data-target="#md-imgview4" data-toggle="modal"><span class="icon-eye8"></span></button>
                                            <?php if ($upsoal != null) : ?>
                                                <?php if ($upsoal['gambar_4'] !== 'default.jpg') : ?>
                                                    <a href="#" data-delete="<?= encode($upsoal['id_opsi_4'] . '+act-imgopsi'); ?>" class="btn btn-danger md-imgdelete4" data-target="#md-imgdelete4" data-toggle="modal" type="button"><span class="icon-trash"></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted fw-300">Ekstensi : JPG, JPEG - Ukuran Maks. 1MB</span>
                                    <?php if (!empty($validation['namaFile4'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile4']); ?>.</span>
                                    <?php endif; ?>
                                    <hr class="mt-4">
                                </div>
                                <div class="form-group col-12">

                                    <div class="custom-control custom-control-right custom-radio custom-control-inline">
                                        <?php if ($upsoal != null) : ?>
                                            <?php if (old('opsi')) : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="5" id="custom_radio_inline_right_checked-5" <?= (old('opsi') == 5) ? 'checked' : ''; ?>>

                                            <?php else : ?>
                                                <input type="radio" class="custom-control-input" name="opsi" value="5" id="custom_radio_inline_right_checked-5" <?= ($upsoal['jawaban_benar'] == 5) ? 'checked' : ''; ?>>

                                            <?php endif; ?>
                                        <?php else : ?>
                                            <input type="radio" class="custom-control-input" name="opsi" value="5" id="custom_radio_inline_right_checked-5" <?= (old('opsi') == 5) ? 'checked' : ''; ?>>

                                        <?php endif; ?>
                                        <label class="custom-control-label position-static" for="custom_radio_inline_right_checked-5">E. Jika opsi ini benar klik radio button <span class="icon-point-right fs-12"></span></label>
                                    </div>
                                    <?php if (!empty($validation['opsi'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['opsi']); ?>.</span>
                                    <?php endif; ?>

                                    <div class="mt-3"></div>

                                    <label class="mb-2 fw-500">Opsi Jawaban Teks :</label>
                                    <?php if ($upsoal != null) : ?>
                                        <textarea name="jawaban_5" id="editor-full-5" rows="3" cols="3"><?= old('jawaban_5') ? old('jawaban_5') : $upsoal['jawaban_5']; ?></textarea>

                                    <?php else : ?>
                                        <textarea name="jawaban_5" id="editor-full-5" rows="3" cols="3"><?= old('jawaban_5'); ?></textarea>

                                    <?php endif; ?>
                                    <?php if (!empty($validation['jawaban_5'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['jawaban_5']); ?>.</span>
                                    <?php endif; ?>

                                    <label class=" mt-4 mb-2 fw-500">Opsi Jawaban Gambar :</label>
                                    <div class="input-group">
                                        <input type="file" id="namaFile5" name="namaFile5" class="form-input-styled btn-upload5" onchange="previewImg5()" data-fouc>
                                        <div class="btn-group p-l-2">
                                            <button type="button" class="btn bg-slate" data-target="#md-imgview5" data-toggle="modal"><span class="icon-eye8"></span></button>
                                            <?php if ($upsoal != null) : ?>
                                                <?php if ($upsoal['gambar_5'] !== 'default.jpg') : ?>
                                                    <a href="#" data-delete="<?= encode($upsoal['id_opsi_5'] . '+act-imgopsi'); ?>" class="btn btn-danger md-imgdelete5" data-target="#md-imgdelete5" data-toggle="modal" type="button"><span class="icon-trash"></span></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted fw-300">Ekstensi : JPG, JPEG - Ukuran Maks. 1MB</span>
                                    <?php if (!empty($validation['namaFile5'])) : ?>
                                        <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['namaFile5']); ?>.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <?php if ($upsoal != null) : ?>
                        <div class="d-flex justify-content-start align-items-center">
                            <a href="<?= $actUrl; ?>" type="button" class="btn btn-link text-dark">Kembali</a>
                            <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    <?php else : ?>
                        <?php if ($jumsoal < $kesol2['jumlah_soal']) : ?>
                            <div class="d-flex justify-content-start align-items-center">
                                <a href="<?= $actUrl; ?>" type="button" class="btn btn-link text-dark">Kembali</a>
                                <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                            </div>
                        <?php else : ?>
                            <div class="d-flex justify-content-start align-items-center">
                                <a href="<?= $actUrl; ?>" type="button" class="btn btn-link text-dark">Kembali</a>
                                <button type="button" disabled class="btn bg-light ml-3 shadow-1">Disabled <i class="icon-blocked ml-2"></i></button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>