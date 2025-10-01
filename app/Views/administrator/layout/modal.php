<!-- Basic modal -->
<div id="md-logout" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda yakin ingin keluar ?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                <a href="<?= base_url(); ?>/administrator/logout" class="btn bg-primary">Ya</a>
            </div>
        </div>
    </div>
</div>
<!-- /basic modal -->


<?php if ($page == 'form peserta') :  ?>
    <?php if (!empty(session()->get('arrypeserta'))) : ?>
        <!-- Basic modal -->
        <div id="md-vwimport" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <form action="<?= $action['insert']; ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="aksi" value="in-import">
                        <div class="modal-body bg-primary-700">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="fw-600">Pengecekan Data :</h5>
                                    <span>Data yang diimport harus dicek kembali, jika ada kolum yang berisi (???) berarti ada kesalahan dalam data yang excel diimport dan jika ada kolum yang berisi (-) berarti data tersebut belum ada. Jika data sudah benar tekan tombol <span class="badge bg-warning">SIMPAN</span> untuk menyimpan data peserta yang diimport ke database. Jika ada kesalahan pada data yang diimport sebelumnya tekan tombol <span class="fw-500">IMPORT ULANG</span> untuk mengimport data baru yang sudah diperbaiki.</span>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center justify-content-center">
                                    <button type="submit" class="btn bg-warning shadow-1">Simpan</button>
                                    <a href="<?= $actUrl; ?>/import-ulang" type="button" class="btn btn-link text-light">Import Ulang</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table datatable-basic table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" width="1%">#</th>
                                <th rowspan="2" colspan="3">Ruangan - Sesi</th>
                                <th rowspan="2" colspan="2">Nama Peserta</th>
                                <th rowspan="2" class="text-center" width="1%">JK</th>
                                <th rowspan="2" colspan="2" width="1%" class="text-nowrap">Bidang - Kelompok Soal</th>
                                <th colspan="2" class="text-center" width="1%">Program Studi Pilihan</th>
                                <th rowspan="2" width="1%">Kontak</th>
                            </tr>
                            <tr>
                                <th class="text-nowrap" witdh="1%">Pilihan Pertama</th>
                                <th class="text-nowrap" witdh="1%">Pilihan Kedua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($pesertas as $peserta) :
                                $query1 = $baseMod->getBy('tb_ruangan_sesi', 'id_ruangan_sesi = :id_ruangan_sesi:', ['id_ruangan_sesi' => $peserta['id_ruangan_sesi']]);
                                $count1 = $baseMod->numRows($query1);

                                if ($count1 > 0) :
                                    $ruses   = $baseMod->getRow($query1);

                                    $query2  = $baseMod->getBy('tb_sesi', 'id_sesi = :id_sesi:', ['id_sesi' => $ruses['id_sesi']]);
                                    $count2  = $baseMod->numRows($query2);

                                    $sesi    = '???';
                                    if ($count2 > 0) :
                                        $sesi    = $baseMod->getRow($query2);

                                        $query4  = $baseMod->getBy('tb_jadwal', 'id_jadwal = :id_jadwal:', ['id_jadwal' => $sesi['id_jadwal']]);
                                        $count4  = $baseMod->numRows($query4);
                                        $jdwl    = '???';

                                        if ($count4 > 0) :
                                            $jadwal  = $baseMod->getRow($query4);
                                            $jdwl    = indoDate($jadwal['jadwal']);

                                        endif;

                                    endif;

                                    $query3  = $baseMod->getBy('tb_ruangan', 'id_ruangan = :id_ruangan:', ['id_ruangan' => $ruses['id_ruangan']]);
                                    $count3  = $baseMod->numRows($query3);

                                    $query5  = $baseMod->getBy('vw_kelompok_soal', 'id_kelompok_soal = :id_kelompok_soal:', ['id_kelompok_soal' => $ruses['id_kelompok_soal']]);
                                    $count5  = $baseMod->numRows($query5);

                                    $nmruang = '???';
                                    if ($count3 > 0) :
                                        $ruangan = $baseMod->getRow($query3);
                                        $nmruang = 'ruang ' . $ruangan['nama_ruangan'];

                                    endif;

                                    $nmkesol  = '???';
                                    $nmbidang = '???';
                                    if ($count5 > 0) :
                                        $kesol    = $baseMod->getRow($query5);
                                        $nmkesol  = $kesol['kelompok_soal'];
                                        $nmbidang = 'bidang ' . $kesol['nama_bidang'];

                                    endif;

                                endif;

                                $query6 = $baseMod->getBy('vw_prodi', 'id_prodi = :id_prodi:', ['id_prodi' => $peserta['id_prodi1']]);
                                $count6 = $baseMod->numRows($query6);

                                $query7 = $baseMod->getBy('tb_poltek', 'kd_poltek = :kd_poltek:', ['kd_poltek' => $peserta['poltek1']]);
                                $count7 = $baseMod->numRows($query7);

                                ($count6 > 0) ?  $prodi1  = $baseMod->getRow($query6) : $prodi1  = '???';
                                ($count7 > 0) ?  $poltek1 = $baseMod->getRow($query7) : $poltek1  = '???';

                                $nmprodi2  = null;
                                $nmpoltek2 = null;

                                if ($peserta['id_prodi2'] != null) :

                                    $query8    = $baseMod->getBy('vw_prodi', 'id_prodi = :id_prodi:', ['id_prodi' => $peserta['id_prodi2']]);
                                    $count8    = $baseMod->numRows($query8);
                                    $query9    = $baseMod->getBy('tb_poltek', 'kd_poltek = :kd_poltek:', ['kd_poltek' => $peserta['poltek2']]);
                                    $count9    = $baseMod->numRows($query9);

                                    $nmprodi2  = '???';
                                    $nmpoltek2 = '???';

                                    if ($count8 > 0) :
                                        $prodi2   = $baseMod->getRow($query8);
                                        $nmprodi2 = $prodi2['nama_prodi'];

                                    endif;

                                    if ($count9 > 0) :
                                        $poltek2   = $baseMod->getRow($query9);
                                        $nmpoltek2 = $poltek2['nama_poltek'];

                                    endif;

                                endif;

                                $no++; ?>
                                <tr>
                                    <td width="1%"><?= $no; ?>.</td>
                                    <td class="fw-500 text-nowrap" width="1%">
                                        <?php if ($count1 > 0) : ?>
                                            <?php if ($count2 > 0) : ?>
                                                SESI <?= $sesi['sesi']; ?>
                                                <div class="fw-300 fs-12"><?= $sesi['waktu']; ?> <span class="fs-11">(<?= strtoupper(getRegards($sesi['waktu'])); ?>)
                                                    </span></div>

                                            <?php else : ?>
                                                <div class="text-center fw-400">???</div>

                                            <?php endif; ?>

                                        <?php else : ?>
                                            <div class="text-center fw-400">???</div>

                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-500 text-nowrap" width="1%">
                                        <?php if ($count1 > 0) : ?>
                                            <?= strtoupper($nmruang); ?>

                                        <?php else : ?>
                                            <div class="text-center fw-400">???</div>

                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-500 text-nowrap" width="1%">
                                        <?php if ($count1 > 0) : ?>
                                            <div class="fs-12 fw-300">Tggl Ujian.</div>
                                            <?= $jdwl; ?>

                                        <?php else : ?>
                                            <div class="text-center fw-400">???</div>

                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-500 text-nowrap" width="1%">
                                        <div class="fs-10 fw-400">NO. PENDAFTARAN</div>
                                        <?= $peserta['no_pendaftaran']; ?>
                                    </td>
                                    <td class="fw-500 text-nowrap">
                                        <?= strtoupper($peserta['nama_peserta']); ?>
                                        <div class="fs-11 fw-400">NIK. <?= $peserta['nik_peserta']; ?> - NISN. <?= $peserta['nisn_peserta']; ?></div>
                                    </td>
                                    <td class="fw-500 text-center"><?= strtoupper($peserta['jk_peserta']); ?></td>
                                    <td class="text-nowrap" width="1%">
                                        <?php if ($count1 > 0) : ?>
                                            <?= ucwords($nmbidang); ?>

                                        <?php else : ?>
                                            <div class="text-center fw-400">???</div>

                                        <?php endif; ?>
                                    </td>
                                    <td class="text-nowrap text-center fw-500" width="1%">
                                        <?php if ($count1 > 0) : ?>
                                            <?= strtoupper($nmkesol); ?>

                                        <?php else : ?>
                                            <div class="text-center fw-400">???</div>

                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-500 text-nowrap">
                                        <div class="fs-11 fw-400"><?= strtoupper($poltek1['nama_poltek']); ?></div>
                                        <?= ucwords($prodi1['nama_prodi']); ?>
                                    </td>
                                    <td class="fw-500 text-nowrap">
                                        <?php if ($nmprodi2 != null) : ?>
                                            <div class="fs-11 fw-400"><?= strtoupper($poltek2['nama_poltek']); ?></div>
                                            <?= ucwords($nmprodi2); ?>

                                        <?php else : ?>
                                            <div class="text-center fw-400">???</div>

                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-500 text-nowrap">
                                        <div class="fs-12 fw-400">No. Telp :</div>
                                        <?= $peserta['no_telp']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /basic modal -->
    <?php endif; ?>

    <?php if (empty(session()->get('arrypeserta'))) : ?>
        <!-- Basic modal -->
        <div id="md-import" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= $action['import']; ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="modal-body table-warning">
                            <div class="fs-12 fw-400">Pastikan data yang mau diimport sudah benar. Klik <a href="<?= base_url(); ?>/uploads/file-other/template.xlsx">unduh</a> untuk mengunduh template excel yang digunakan untuk mengimport data.</div>
                            <span class="fw-500 text-danger fs-12">Jangan merubah template yang diunduh agar tidak terjadi kesalahan ketika mengimport data.</span>
                        </div>
                        <div class="modal-body border-top">
                            <div class="form-row">
                                <div class="form-group col-lg">
                                    <label>Import Excel :</label>
                                    <input type="file" class="form-input-styled" id="namaFile" name="namaFile" accept=".xls, .xlsx" data-fouc>
                                    <span class="form-text text-muted fw-300">Ekstensi : XLS, XLSX</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn bg-slate-400 ml-3 shadow-1">Import <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /basic modal -->
    <?php endif; ?>
<?php endif; ?>

<?php if ($page == 'data rekapan peserta' || $page == 'rekapan-peserta') :  ?>
    <div id="md-filter" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= $action; ?>" method="POST">
                <input type="hidden" name="slug" value="<?= ($currentslug != null) ? $currentslug : ''; ?>">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label class="d-block font-weight-semibold">Prodi Pilihan Pertama</label>
                                <select data-placeholder="Pilih Program Studi" name="pilihan_pertama" class="form-control select" data-fouc>
                                    <option></option>
                                    <?php foreach ($prodis as $prodi1) : ?>
                                        <option value="<?= $prodi1['id_prodi']; ?>" data-icon="dash"><?= ucwords($prodi1['nama_prodi']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label class="d-block font-weight-semibold">Prodi Pilihan Kedua</label>
                                <select data-placeholder="Pilih Program Studi" name="pilihan_kedua" class="form-control select" data-fouc>
                                    <option></option>
                                    <?php foreach ($prodis as $prodi2) : ?>
                                        <option value="<?= $prodi2['id_prodi']; ?>" data-icon="dash"><?= ucwords($prodi2['nama_prodi']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-slate">Filter <i class="icon-filter4 ml-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<?php if ($page == 'detail ruangan sesi') :  ?>
    <div id="md-setpeserta" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <form action="<?= $action['others']; ?>" method="POST">
                <input type="hidden" name="slug" value="<?= $ruses['slug_ruangan_sesi']; ?>">
                <input type="hidden" name="aksi" value="up-peserta">
                <div class="modal-content">
                    <div class="modal-body table-warning">
                        <div class="fs-12 fw-400">Jumlah Peserta dibawa merupakan <span class="fw-600">Jumlah Peserta <span class="fw-600">Bidang <?= ucwords($ruses['nama_bidang']); ?></span> tanpa ruangan / Jumlah Kursi Kosong</span> pada <span class="fw-600">Ruangan <?= $ruses['nama_ruangan']; ?></span>.</div>

                    </div>
                    <div class="modal-body border-top">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label>Jumlah Peserta</label>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <button class="btn btn-light" type="button"><?= $peserta['jum_belum']; ?>/<?= $peserta['kapasitas'] - $peserta['jum_sudah']; ?></button>
                                    </span>
                                    <input type="text" name="jumlah_peserta" placeholder="**30" class="form-control touchspin-vertical text-center">
                                </div>
                                <div class="fs-12 fw-300 text-muted mt-2">Tidak boleh melebihi jumlah peserta tanpa ruangan.</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn bg-primary">Tambah <i class="ml-2 icon-plus22"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<?php if (!empty($action['delete'])) :  ?>
    <!-- Basic modal -->
    <div id="md-delete" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action['delete']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="delete" name="encode">
                    <div class="modal-body">
                        Apakah Anda yakin ingin <span class="fw-500">menghapus</span> data ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>

<?php if (!empty($action['akses'])) :  ?>
    <!-- Basic modal -->
    <div id="md-akses" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action['akses']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="access" name="encode">

                    <div class="modal-body fw-400" id="message"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>

<?php if (!empty($action['publis'])) :  ?>
    <!-- Basic modal -->
    <div id="md-publis" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action['publis']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="publish" name="encode">

                    <div class="modal-body fw-400" id="message"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>

<?php if ($page == 'data ruangan sesi') : ?>
    <!-- Basic modal -->
    <div id="md-read" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="">Catatan :</label>
                    <div id="notes"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic modal -->

    <!-- Basic modal -->
    <div id="md-ruses" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action['others']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="access" name="encode">

                    <div class="modal-body fw-400" id="message"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->

    <!-- Basic modal -->
    <div id="md-lock" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body table-warning border-bottom">
                    <div class="fs-12 fw-500">Koneksi Pengawas dan Peserta yang masih terhubung akan diputuskan, peserta yang belum mengikuti ujian setelah waktu ujian berakhir akan dianggap tidak hadir.</div>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin <span class="fw-500">mengunci</span> sesi ini ?
                </div>
                <form action="<?= $action['lock']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="lock" name="encode">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->

    <!-- Basic modal -->
    <div id="md-unlock" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body table-warning border-bottom">
                    <div class="fs-12 fw-500">Koneksi Pengawas akan diaktifkan kembali dan pengawas juga dapat mengisi BAUP yang belum diisi jika sebelumnya ada peserta yang mengalami kendala, melakukan kesalahan atau hal lainnya dalam BUAP ketika peserta mengikuti ujian.</div>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin <span class="fw-500">membuka</span> sesi ini kembali ?
                </div>
                <form action="<?= $action['unlock']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="unlock" name="encode">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>

<?php if ($page == 'Detail Peserta') : ?>
    <!-- Basic modal -->
    <div id="md-restore" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body table-warning border-bottom">
                    <div class="fs-12 fw-500">Status harus di set ulang jika waktu mulai ujian belum ada tetapi status peserta berubah dari belum ujian ke status lain.</div>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin <span class="fw-500">mengembalikan</span> status peserta ini ke awal ?
                </div>
                <form action="<?= $action['restore']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $peserta['slug_nama_peserta']; ?>">
                    <input type="hidden" name="aksi" value="up-restore">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Set Ulang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>

<?php if ($page == 'data soal') : ?>
    <!-- Basic modal -->
    <div id="md-question" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action; ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <p class="fs-12 mb-3"><span class="icon-info22 fs-15 mr-1"></span> Tentukan kelompok soal dan mata uji terlebih dahaulu.</p>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Kelompok Soal :</label>
                                <select data-placeholder="Pilih Kelompok Soal" name="id_kelompok_soal" class="form-control select" data-fouc>
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
                                                    <option value="<?= $kesol['id_kelompok_soal']; ?>" <?= (old('id_kelompok_soal') == $kesol['id_kelompok_soal']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($kesol['kelompok_soal']); ?></option>

                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($validation['id_kelompok_soal'])) : ?>
                                    <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_kelompok_soal']); ?>.</span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-6">
                                <label>Mata Uji :</label>
                                <select data-placeholder="Pilih Mata Uji" name="id_mata_uji" class="form-control select" data-fouc>
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
                                                    <option value="<?= $maju['id_mata_uji']; ?>" <?= (old('id_mata_uji') == $maju['id_mata_uji']) ? 'data-icon="check2" selected' : 'data-icon="dash"'; ?>><?= ucwords($maju['mata_uji']); ?></option>

                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($validation['id_mata_uji'])) : ?>
                                    <span class="form-text text-danger fw-400 fs-12"><?= ucfirst($validation['id_mata_uji']); ?>.</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn bg-teal-400 ml-3 shadow-1">Buat Soal <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /basic modal -->
<?php endif; ?>

<?php if ($page == 'form soal') : ?>
    <div id="md-imgview" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php
                if ($upsoal != null) : ?>
                    <img src="<?= base_url(); ?>/uploads/pic-question/<?= $upsoal['gambar_soal']; ?>" height="450" class="preview-img">
                <?php else : ?>
                    <img src="<?= base_url(); ?>/uploads/pic-question/default.jpg" height="450" class="preview-img">

                <?php endif; ?>
                <div class="modal-body text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="md-imgdelete" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= $action['delete']; ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="deletes" name="encode">
                    <div class="modal-body">
                        Apakah Anda yakin ingin <span class="fw-500">menghapus</span> gambar dari soal ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn bg-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    for ($i = 1; $i <= 5; $i++) : ?>
        <div id="md-imgview<?= $i; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php
                    if ($upsoal != null) :
                        $field = 'gambar_' . $i; ?>
                        <img src="<?= base_url(); ?>/uploads/pic-answer/<?= $upsoal[$field]; ?>" height="450" class="preview-img<?= $i; ?>">

                    <?php else : ?>
                        <img src="<?= base_url(); ?>/uploads/pic-question/default.jpg" height="450" class="preview-img<?= $i; ?>">

                    <?php endif; ?>
                    <div class="modal-body text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="md-imgdelete<?= $i; ?>" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= $action['delete']; ?>" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" id="delete<?= $i; ?>" name="encode">
                        <div class="modal-body">
                            Apakah Anda yakin ingin <span class="fw-500">menghapus</span> gambar dari opsi ini ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn bg-primary">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    endfor; ?>

<?php endif; ?>