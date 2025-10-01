<div class="page-header">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <?php if ($page == 'dashboard') : ?>
                    <span class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</span>
                <?php else : ?>
                    <a href="<?= $baseUrl; ?>" class="breadcrumb-item"> Dashboard</a>
                    <?php if ($breadcrumb != null) : ?>
                        <a href="<?= $breadcrumb['url_breadcrumb']; ?>" class="breadcrumb-item"><?= ucwords($breadcrumb['title_breadcrumb']); ?></a>

                    <?php endif; ?>

                    <span class="breadcrumb-item fw-400 active"><?= ucwords($page); ?></span>

                <?php endif; ?>
            </div>

            <!-- <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a> -->
        </div>

    </div>

    <div class="page-header-content header-elements-md-inline">
        <div class="page-title">
            <?php if ($page == 'dashboard') : ?>
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Dashboard</span> - Hi, <?= ucwords(current(explode(' ', $user['nama_staf']))); ?></h4>

            <?php else : ?>
                <?php
                $pisah = explode(' ', $page); ?>
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?= ucwords(join(' ', explode('-', $req->uri->getSegment(2)))); ?></span> - <?= ucwords($page); ?></h4>

            <?php endif; ?>
            <div class="d-flex">
                <div class="breadcrumb">
                    <span class="breadcrumb-item fw-300 c-444"><?= ucwords(is_staf($user['status_staf'])); ?> Sistem CBT <span class="fw-500"><?= ucwords($sett['nama_instansi']); ?></span> - <?= date('Y'); ?></span>
                </div>
            </div>
        </div>

        <?php if ($page == 'detail ruangan sesi') : ?>

            <div class="header-elements d-none text-center text-md-left mb-3 mb-md-0">
                <div class="btn-group shadow-3">
                    <button type="button" data-toggle="modal" data-target="#md-pin" class="btn bg-primary fw">Tampilkan PIN Sesi</button>
                    <button type="button" class="btn bg-primary active"><i class="icon-key"></i></button>


                </div>
            </div>

        <?php endif; ?>
    </div>
</div>