<div class="navbar navbar-expand-md navbar-dark bg-primary-800">
    <div class="navbar-brand wmin-200">
        <a href="#" class="d-inline-block">
            <span class="text-light ls-1">
                <div class="fs-10 lh-1-0 fw-300">COMPUTER BASED TEST</div>
                <div class="fs-15 p-t-0 m-t-0 lh-1-0">
                    <span class="fw-700">POLITEKNIK NEGERI KUPANG</span>
                </div>
            </span>
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <span class="navbar-text ml-md-3 mr-md-auto">
            <span class="badge bg-light shadow-1 text-primary-800"><?= strtoupper(is_staf($user['status_staf'])); ?></span>
        </span>

        <span class="navbar-text ml-md-3 ml-2 mr-2 fs-12 fw-300">
            <span class="badge badge-mark border-orange-300 mr-2"></span>
            Selamat <?= getRegards(getTime()); ?>, <?= ucwords(current(explode(' ', $user['nama_staf']))); ?>.
        </span>

        <ul class="navbar-nav">


            <li class="nav-item">
                <a href="<?= base_url(); ?>" target="_blank" class="navbar-nav-link">
                    <i class="icon-earth"></i>
                    <span class="d-md-none ml-2 fs-12 fw-500">WEBSITE</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#md-logout" data-toggle="modal" class="navbar-nav-link">
                    <i class="icon-switch2"></i>
                    <span class="d-md-none ml-2 fs-12 fw-500">KELUAR</span>
                </a>
            </li>
        </ul>
    </div>
</div>