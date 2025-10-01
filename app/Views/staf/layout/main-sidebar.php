<div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Main sidebar</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body card-img-top">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="<?= base_url(); ?>/uploads/pic-user/pengawas/<?= $user['foto_staf']; ?>" class="img-fluid rounded-circle shadow-2 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white fw-500 fs-12 text-shadow-dark"><?= strtoupper($user['nama_staf']); ?></h6>
                    <span class="fw-300 fs-11 text-white text-shadow-dark">NIP. <?= (empty($user['nip_staf'])) ? '-' : is_nip($user['nip_staf']); ?></span>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle fw-300 fs-12" data-toggle="collapse"><span>Navigasi Akun</span></a>
                </div>
            </div>

            <div class="collapse <?= is_active(['keamanan'], 4); ?>" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/staf/keamanan" class="nav-link <?= is_active(['keamanan']); ?>">
                            <i class="icon-user-lock"></i>
                            <span>Atur Keamanan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#md-logout" data-toggle="modal" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Navigation -->
        <div class="card card-sidebar-mobile">


            <div class="card-body p-0 mt-3">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <!-- Main -->
                    <li class="nav-item-header pt-0 mt-0">
                        <div class="text-uppercase font-size-xs line-height-xs fw-600 fs-11">NAVIGASI UMUM</div> <i class="icon-menu" title="Main"></i>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/staf/dashboard" class="nav-link <?= is_active(['dashboard', '']); ?>">
                            <i class="icon-home4"></i>
                            <span>
                                Dashboard
                                <span class="d-block font-weight-normal opacity-50 fw-600">Beranda <?= ucwords(is_staf($user['status_staf'])); ?> CBT <?= strtoupper(is_abbreviation($sett['nama_instansi'])); ?></span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/staf/ruangan-sesi" class="nav-link <?= is_active(['ruangan-sesi']); ?>">
                            <i class="icon-office"></i>
                            <span>
                                Ruang Sesi
                            </span>
                        </a>
                    </li>
                    <!-- /main -->

                    <!-- Layout -->
                    <!-- <li class="nav-item-header pt-0 mt-0">
                        <div class="text-uppercase font-size-xs line-height-xs fw-500 fs-11">NAVIGASI LAINNYA</div> <i class="icon-menu" title="Main"></i>
                    </li> -->


                </ul>
            </div>
        </div>
        <!-- /navigation -->

    </div>
    <!-- /sidebar content -->

</div>