<!-- <div class="navbar navbar-expand-md navbar-dark bg-white shadow-0 border-bottom"> -->
<div class="navbar navbar-expand-md navbar-dark navbar-static bg-primary-800">
    <div class="navbar-brand wmin-0 mr-5">
        <a href="#" class="d-inline-block">
            <span class="text-light ls-1">
                <div class="fs-10 lh-1-0 fw-300">COMPUTER BASE TEST</div>
                <div class="fs-15 p-t-0 m-t-0 lh-1-0">
                    <span class="fw-700">POLITEKNIK NEGERI KUPANG</span>
                </div>
            </span>
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-menu7 c-000"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <span class="navbar-text ml-md-3 mr-md-auto">
            <span class="badge bg-light shadow-1 text-primary-800">SESI <?= $ruses['sesi']; ?> - BIDANG <?= strtoupper($ruses['nama_bidang']); ?></span>
        </span>
        <span class="navbar-text ml-md-3 ml-2 mr-2 fs-12 fw-300">
            <span class="badge badge-mark border-orange-300 mr-2"></span>
            Selamat <?= getRegards($time); ?>, <?= ucwords(current(explode(' ', $user['nama_peserta']))); ?>.
        </span>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" data-target="#md-info" data-toggle="modal" class="navbar-nav-link">
                    <i class="icon-info22"></i>
                </a>
            </li>
        </ul>
    </div>
</div>