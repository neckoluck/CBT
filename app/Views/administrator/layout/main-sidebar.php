<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md bg-primary-800">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center bg-primary-800">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigasi Menu
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">
        <?php
        $collapse = "";
        $navlink1 = "";
        $navlink2 = "";

        if ($page == "form administrator" || $page == "form keamanan admin") :
            if ($upadmin != null) :
                $slug_admin     = $upadmin['slug_nama_administrator'];
                if ($slug_admin == $user['slug_nama_administrator']) :
                    $collapse   = is_active(['administrator'], 4);
                    $navlink1   = is_active(['form-administrator'], 3);
                    $navlink2   = is_active(['form-keamanan'], 3);

                endif;
            endif;

        endif; ?>
        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="<?= base_url(); ?>/uploads/pic-user/administrator/<?= $user['foto_administrator']; ?>" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white fw-500 fs-12 text-shadow-dark"><?= strtoupper($user['nama_administrator']); ?></h6>
                    <span class="fw-300 fs-11 text-white text-shadow-dark">NIP. <?= (empty($user['nip_administrator'])) ? '-' : is_nip($user['nip_administrator']); ?></span>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle fw-300 fs-12" data-toggle="collapse"><span>Navigasi Akun</span></a>
                </div>
            </div>
            <div class="collapse <?= $collapse; ?>" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="<?= $baseUrl; ?>/administrator/form-administrator/<?= $user['slug_nama_administrator']; ?>" class="nav-link <?= $navlink1; ?>">
                            <i class="icon-user-plus"></i>
                            <span>Atur Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $baseUrl; ?>/administrator/form-keamanan/<?= $user['slug_nama_administrator']; ?>" class="nav-link <?= $navlink2; ?>">
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


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs fw-500 fs-11">NAVIGASI UMUM</div> <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/administrator/dashboard" class="nav-link <?= is_active(['dashboard', '']); ?>">
                        <i class="icon-home4"></i>
                        <span>
                            Dashboard
                            <span class="d-block opacity-50 fw-300 fs-12">Beranda Admin CBT <?= strtoupper(is_abbreviation($sett['nama_instansi'])); ?></span>
                        </span>
                    </a>
                </li>
                <li class="nav-item"><a href="<?= base_url(); ?>/administrator/soal" class="nav-link <?= is_active(['soal']); ?>"><i class="icon-archive"></i> <span>Soal CBT</span></a></li>
                <li class="nav-item nav-item-submenu <?= is_active(['pengawas', 'teknisi', 'peserta'], 1); ?>">
                    <a href="#" class="nav-link "><i class="icon-users"></i>
                        <span>
                            Pengguna CBT
                            <span class="d-block opacity-50 fw-300 fs-12">Data Staf & Peserta</span>
                        </span>
                    </a>

                    <ul class="nav nav-group-sub" data-submenu-title="Pengguna CBT">
                        <li class="nav-item"><a href="<?= base_url(); ?>/administrator/pengawas" class="nav-link <?= is_active(['pengawas']); ?>">Data Pengawas</a></li>
                        <li class="nav-item"><a href="<?= base_url(); ?>/administrator/teknisi" class="nav-link <?= is_active(['teknisi']); ?>">Data Teknisi</a></li>
                        <li class="nav-item"><a href="<?= base_url(); ?>/administrator/peserta" class="nav-link <?= is_active(['peserta']); ?>">Data Peserta</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/administrator/jadwal" class="nav-link <?= is_active(['jadwal']); ?>">
                        <i class="icon-calendar3"></i>
                        <span>
                            Jadwal

                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu <?= is_active(['sesi', 'ruangan-sesi'], 1); ?>">
                    <a href="#" class="nav-link "><i class="icon-bell3"></i>
                        <span>
                            Sesi
                            <span class="d-block opacity-50 fw-300 fs-12">Data Sesi & Ruang Sesi</span>
                        </span>
                    </a>

                    <ul class="nav nav-group-sub" data-submenu-title="Sesi">
                        <li class="nav-item"><a href="<?= base_url(); ?>/administrator/sesi" class="nav-link <?= is_active(['sesi']); ?>">Data Sesi</a></li>
                        <li class="nav-item"><a href="<?= base_url(); ?>/administrator/ruangan-sesi" class="nav-link <?= is_active(['ruangan-sesi']); ?>">Data Ruangan Sesi</a></li>
                    </ul>
                </li>

                <!-- /main -->

                <!-- Layout -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs fw-500 fs-11">NAVIGASI LAINNYA</div> <i class="icon-menu" title="Layout options"></i>
                </li>
                <li class="nav-item nav-item-submenu <?= is_active(['rekapan-peserta'], 1); ?>">
                    <a href="#" class="nav-link "><i class="icon-archive"></i>
                        <span>
                            Rekapan
                        </span>
                    </a>

                    <ul class="nav nav-group-sub" data-submenu-title="Rekapan">
                        <li class="nav-item"><a href="<?= base_url(); ?>/administrator/rekapan-peserta" class="nav-link <?= is_active(['rekapan-peserta']); ?>">Rekapan Data Peserta</a></li>
                        <!-- <li class="nav-item"><a href="<?= base_url(); ?>/administrator/rekapan-ruangan-sesi" class="nav-link <?= is_active(['rekapan-ruangan-sesi']); ?>">Rekapan Data Ruangan Sesi</a></li> -->
                    </ul>
                </li>

                <li class="nav-item"><a href="<?= base_url(); ?>/administrator/administrator" class="nav-link <?= is_active(['administrator']); ?>"><i class="icon-user-tie"></i> <span>Administrator</span></a></li>
                <li class="nav-item"><a href="<?= base_url(); ?>/administrator/komponen/umum" class="nav-link <?= is_active(['komponen']); ?>"><i class="icon-equalizer4"></i>
                        <span>
                            Komponen
                            <span class="d-block opacity-50 fw-300 fs-12">Data Pendukung Sistem CBT</span>
                        </span>
                    </a>
                </li>

                <!-- /layout -->

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>