<div class="page-header page-header-light shadow-0 border-bottom">
    <!-- <div class="page-header"> -->
    <div class="page-header-content">
        <div class="page-title">
            <div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
                <div class="mr-md-3 mb-2 mb-md-0">
                    <a href="#" class="profile-thumb">
                        <img src="<?= base_url(); ?>/uploads/pic-other/default.jpg" class="img-border rounded-circle shadow-0" height="20" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h3 class="fw-600 mt-0 c-444"><span class="letter-icon-title"><?= strtoupper($user["nama_peserta"]); ?></span></h3>
                    <span class="d-block text-uppercase fw-300 fs-13">NIK. <?= strtoupper($user["nik_peserta"]); ?> - NO. UJIAN. <?= $user["no_pendaftaran"]; ?></span>
					<?php if ($user["nik_peserta"] == '3276024303050021') : ?>
                    <?php endif; ?>
                </div>
                <div class="ml-md-3 mt-2 mt-md-0 mr-md-3">
                    <?php if ($page == 'dashboard') : ?>
                        <ul class="list-inline list-inline-condensed mb-0">
                            <li class="list-inline-item">
                                <?php $validation = session()->getFlashdata('validation'); ?>
                                <form action="<?= $action; ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="input-group">
                                    	
                                        <input type="tel" name="pin_sesi" autofocus autocomplete="off" value="<?= old('pin_sesi'); ?>" class="form-control text-center fw-800 fs-18 c-444 <?= !empty($validation['pin_sesi']) ? 'is-invalid' : ''; ?>" maxlength="6" placeholder="PIN SESI">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn bg-warning-400 btn-lg rd-3 p-l-25 p-r-25 p-t-11 p-b-11 fs-15 fw-800 shadow-2"><i class="icon-file-text mr-2"></i> Mulai Ujian</button>
                                        </span>
                                    </div>
                                	<span class="form-text text-muted text-left fw-300 fs-12 c-444">**Masukan PIN Sesi disini.</span>
                                </form>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php if ($page == 'soal') : ?>
                        <div id="timer"></div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>