<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1"><?= ucwords($page); ?></a>
                </h6>
            </div>

            <table class="table datatable-basic table-bordered">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th colspan="2">Aksi</th>
                        <th colspan="3">NIP - Nama Pengawas</th>
                        <th width="1%" class="text-center">JK</th>
                        <!-- <th>Kontak</th> -->
                        <th width="1%">Tggl Dibuat</th>
                        <th width="1%" class="text-nowrap">Perubahan Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($stafs as $staf) :
                        $no++;
                        if ($staf['status_akses'] != 0) :
                            $icon = 'user-lock';
                            $sts  = 'Akses nonaktif';
                            $bg   = 'warning';
                            $aks  = 0;

                        else :
                            $icon = 'user-check';
                            $sts  = 'Akses aktif';
                            $bg   = 'success';
                            $aks  = 1;

                        endif; ?>

                        <tr class="fs-12">
                            <td width="1%"><?= $no; ?>.</td>
                            <td width="1%" class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                            <a href="<?= $baseUrl; ?>/pengawas/form-pengawas/<?= $staf['slug_nama_staf']; ?>" class="dropdown-item fs-11"><i class="icon-user-check"></i> ATUR PROFIL</a>
                                            <a href="<?= $baseUrl; ?>/pengawas/form-keamanan/<?= $staf['slug_nama_staf']; ?>" class="dropdown-item fs-11"><i class="icon-user-lock"></i> ATUR KEAMANAN</a>
                                            <div class="dropdown-divider"></div>

                                            <a href="#md-delete" data-toggle="modal" data-delete="<?= encode($staf['slug_nama_staf']); ?>" class="dropdown-item fs-11 md-delete"><i class="icon-trash"></i> HAPUS DATA</a>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center" width="5%">
                                <button type="button" data-toggle="modal" data-target="#md-akses" data-status="<?= $aks; ?>" data-access="<?= encode($staf['slug_nama_staf'] . '+up-akses+' . $aks); ?>" class="btn bg-<?= $bg; ?>-400 btn-sm shadow-1 fw-400 m2 md-akses" data-popup="popover" data-placement="top" data-trigger="hover" data-html="true" data-content="<span class='fs-12 fw-300'><?= $sts; ?><span>"><i class="icon-<?= $icon; ?>"></i></button>
                            </td>
                            <td width="1%" class="text-center">
                                <?php if ($staf['foto_staf'] == 'default.jpg') : ?>
                                    <a href="#" class="btn bg-slate-400 btn-icon btn-lg rounded-circle">
                                        <span class="letter-icon fs-15 fw-500"></span>
                                    </a>
                                <?php else : ?>
                                    <img src="<?= base_url(); ?>/uploads/pic-user/pengawas/<?= $staf['foto_staf']; ?>" class="rounded-circle img-border" width="47" height="47" alt="">
                                <?php endif; ?>
                            </td>
                            <td width="1%">
                                <span class="fs-12 fw-300">NIP :</span>
                                <div class="fw-500"><?= $staf['nip_staf']; ?></div>
                            </td>
                            <td class="fw-500 text-nowrap">
                                <div class="fs-12 fw-300">Nama Lengkap :</div>
                                <span class="letter-icon-title"><?= strtoupper($staf['nama_staf']); ?></span>
                            </td>
                            <td width="1%" class="fw-500 text-center"><?= strtoupper($staf['jk_staf']); ?></td>
                            <!--    
                            <td>
                                <span class="fs-12 fw-300">No. Telp :</span>
                                <div class="fw-500"><?= $staf['no_telp_staf']; ?></div>
                            </td>
                            -->
                            <td width="1%" class="text-nowrap"><?= $staf['created_at']; ?></td>
                            <td width="1%" class="text-nowrap"><?= $staf['update_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>