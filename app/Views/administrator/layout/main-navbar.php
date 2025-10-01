<div class="navbar navbar-expand-md navbar-light navbar-static">

    <!-- Header with logos -->
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center bg-primary-800">
        <div class="navbar-brand navbar-brand-md">
            <a href="index.html" class="d-inline-block">
                <span class="text-light ls-1">
                    <div class="fs-10 lh-1-0 fw-300">COMPUTER BASE TEST</div>
                    <div class="fs-15 p-t-0 m-t-0 lh-1-0">
                        <span class="fw-700">POLITEKNIK NEGERI KUPANG</span>
                    </div>
                </span>
            </a>
        </div>

        <div class="navbar-brand navbar-brand-xs">
            <a href="index.html" class="d-inline-block">
                <img src="<?= base_url(); ?>/assets/limitless/global-assets/images/logo_icon_light.png" alt="">
            </a>
        </div>
    </div>
    <!-- /header with logos -->


    <!-- Mobile controls -->
    <div class="d-flex flex-1 d-md-none">
        <div class="navbar-brand mr-auto">
            <a href="#" class="d-inline-block">
                <span class="text-dark ls-1">
                    <div class="fs-10 lh-1-0 fw-300">COMPUTER BASE TEST</div>
                    <div class="fs-15 p-t-0 m-t-0 lh-1-0">
                        <span class="fw-700">POLITEKNIK NEGERI KUPANG</span>
                    </div>
                </span>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-component-toggle" type="button">
            <i class="icon-more"></i>
        </button>
    </div>
    <!-- /mobile controls -->


    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <span class="navbar-text ml-md-3 mr-md-auto">
            <span class="badge bg-warning-400 shadow-1">ADMINISTRATOR</span>
        </span>
        <span class="navbar-text ml-md-3 ml-2 mr-2 fs-12 fw-300">
            <span class="badge badge-mark border-orange-300 mr-2"></span>
            Selamat <?= getRegards(getTime()); ?>, <?= ucwords(current(explode(' ', $user['nama_administrator']))); ?>.
        </span>
        <ul class="navbar-nav">

            <li class="nav-item">
                <a href="#" target="_blank" class="navbar-nav-link">
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
    <!-- /navbar content -->

</div>