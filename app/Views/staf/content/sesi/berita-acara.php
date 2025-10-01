<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1"><?= ucwords($page); ?></a>
                </h6>
            </div>


            <form action="<?= $action['setbaup']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $peserta['peserta']['slug_nama_peserta']; ?>">
                <table class="table table-bordered">
                    <tr class="table-active">
                        <td class="fw-500">
                            <div class="fs-12 fw-300">Nama Peserta :</div>
                            <span><?= strtoupper($peserta['peserta']['nama_peserta']); ?> - (<?= strtoupper($peserta['peserta']['jk_peserta']); ?>)</span>
                        </td>
                        <td class="fw-500">
                            <div class="fw-300 fs-12"> No. Pendaftaran - NIK :</div>
                            <span><?= strtoupper($peserta['peserta']['no_pendaftaran']) . ' - ' . $peserta['peserta']['nik_peserta']; ?></span>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered border-top-0">
                    <?php
                    $no = 0;
                    foreach ($beritas as $berita) :

                        $sql3    = $baseMod->getBy('tb_baup', 'id_berita_acara = :id: AND id_peserta = :id_peserta:', ['id' => $berita['id_berita_acara'], 'id_peserta' => $peserta['peserta']['id_peserta']]);
                        $baups   = $baseMod->getRow($sql3);

                        $checked = '';
                        $ctable  = '';
                        if ($baups != null) :
                            $ctable  = 'table-warning';
                            $checked = 'checked';

                        endif;

                        $no++; ?>
                        <tr class="<?= $ctable; ?>">
                            <td width="1%"><?= $no; ?>.</td>
                            <td>
                                <div class="media">
                                    <div class="media-body">
                                        <label class="form-check-label fw-500 fs-12" for="<?= $no; ?>">
                                            <div class="fw-300 fs-12">Keterangan :</div>
                                            <?= strtoupper($berita['berita_acara']); ?>
                                        </label>
                                    </div>

                                    <div class="ml-3 align-self-center">
                                        <input type="checkbox" name="baup[]" value="<?= $berita['id_berita_acara']; ?>" <?= $checked; ?> class="form-check-input-styled" id="<?= $no; ?>" data-fouc>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="card-body border-top-0">
                    <a href="<?= $baseUrl; ?>/ruangan-sesi/detail-ruangan-sesi/<?= $ruses['slug_ruangan_sesi']; ?>" type="button" class="btn btn-link text-dark">Kembali</a>
                    <button type="submit" class="btn bg-slate-400 shadow-1">Simpan <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>