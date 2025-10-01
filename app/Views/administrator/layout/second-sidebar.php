<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">
    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Navigation -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title fw-300">
                    <a data-toggle="collapse" class="text-default" href="#collapsible-control-right-group1">Navigasi Komponen</a>
                </h6>
            </div>
            <div class="card-body p-0 border-top">
                <ul class="nav nav-sidebar mb-2">
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/administrator/komponen/umum" class="nav-link <?= is_active(['umum'], 3); ?>">
                            <i class="icon-grid6 fs-13 p-t-1 p-r-5"></i>
                            Komponen Umum
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/administrator/komponen/soal" class="nav-link <?= is_active(['soal'], 3); ?>">
                            <i class="icon-books"></i>
                            <span>
                                Komponen Soal
                                <span class="d-block font-weight-normal text-muted fw-300 fs-12">Data Mata Uji & Kelompok Soal</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>/administrator/komponen/lainnya" class="nav-link <?= is_active(['lainnya'], 3); ?>">
                            <i class="icon-menu p-r-2"></i>
                            <span>
                                Komponen Lainnya
                                <span class="d-block font-weight-normal text-muted fw-300 fs-12">Data Ruangan, Berita Acara & Prodi</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, ut dolor? Temporibus dicta atque sapiente at itaque.
            </div>
        </div>
        <!-- /navigation -->

    </div>
    <!-- /sidebar content -->
</div>