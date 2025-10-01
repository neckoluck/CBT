<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title">
            <?php if ($page == 'dashboard') : ?>
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span> - Hi, <?= ucwords(current(explode(' ', $user['nama_administrator']))); ?></h4>

            <?php else : ?>
                <?php
                $pisah = explode(' ', $page); ?>
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?= ucwords(join(' ', explode('-', $req->uri->getSegment(2)))); ?></span> - <?= ucwords($page); ?></h4>

            <?php endif; ?>
            <div class="d-flex">
                <div class="breadcrumb">
                    <?php if ($page == 'dashboard') : ?>
                        <span class="breadcrumb-item fw-300 c-444">Administrator Sistem CBT <span class="fw-500"><?= ucwords($sett['nama_instansi']); ?></span> - <?= date('Y'); ?></span>

                    <?php else : ?>
                        <a href="<?= $baseUrl; ?>" class="breadcrumb-item"> Dashboard</a>
                        <?php if ($breadcrumb != null) : ?>
                            <a href="<?= $breadcrumb['url_breadcrumb']; ?>" class="breadcrumb-item"><?= ucwords($breadcrumb['title_breadcrumb']); ?></a>

                        <?php endif; ?>

                        <span class="breadcrumb-item fw-400 active"><?= ucwords($page); ?></span>
                    <?php endif; ?>


                </div>
                <?php if ($page !== 'dashboard') : ?>
                    <?php if (!empty($actUrl)) : ?>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>

        <?php if ($page !== 'dashboard') : ?>

            <?php if (!empty($actUrl)) : ?>
                <div class="header-elements d-none text-center text-md-left mb-3 mb-md-0">
                    <div class="btn-group shadow-3">
                        <?php if (current($pisah) == 'data') : ?>
                            <?php if ($page !== 'data soal') : ?>
                                <button type="button" class="btn bg-warning-400 active"><i class="icon-table"></i></button>
                                <a href="<?= $actUrl; ?>" class="btn bg-warning-400"><i class="icon-plus3 mr-2"></i> Tambah Data</a>

                            <?php else : ?>
                                <button type="button" class="btn bg-warning-400 active"><i class="icon-table"></i></button>
                                <button type="button" data-target="#<?= $actUrl; ?>" data-toggle="modal" class="btn bg-warning-400"><i class="icon-plus3 mr-2"></i> Tambah Data</button>

                            <?php endif; ?>
                        <?php elseif (current($pisah) == 'form') : ?>
                            <button type="button" class="btn bg-warning-400 active"><i class="icon-plus3"></i></button>
                            <a href="<?= $actUrl; ?>" class="btn bg-warning-400"><i class="icon-table mr-2"></i> Tampil Data</a>

                        <?php else : ?>

                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>