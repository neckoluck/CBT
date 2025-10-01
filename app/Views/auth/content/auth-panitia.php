 <!-- Login card -->
 <?php $validation = session()->getFlashdata('validation'); ?>
 <form class="login-form" action="<?= $action; ?>" method="POST">
     <?= csrf_field(); ?>
     <div class="card mb-0 shadow-0">
         <div class="card-body">
              <div class="text-center mb-4 p-1 shadow-sm" style="border: 1px solid #ddd; border-radius: 35px">
                 <img src="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>" width="250" alt="" />
             </div>

             <div class="form-group text-center text-dark content-divider">
                 <span class="px-0"><span class="badge bg-light fs-12 shadow-1">Computer Based Test</span>
             </div>

             <div class="form-group form-group-feedback form-group-feedback-left mb-4">
                 <input type="text" class="form-control" autocomplete="off" placeholder="Contoh: 19940708202203****" name="username" value="<?= old('username'); ?>" />
                 <div class="form-control-feedback">
                     <i class="icon-user text-muted"></i>
                 </div>
                 <?php if (!empty($validation['username'])) : ?>
                     <span class="form-text text-danger fs-12"><?= ucfirst($validation['username']); ?>.</span>
                 <?php endif; ?>
             </div>

             <div class="form-group form-group-feedback form-group-feedback-left mb-4">
                 <input type="password" class="form-control show-password" autocomplete="off" placeholder="Contoh: sand123**" name="password" />
                 <div class="form-control-feedback">
                     <i class="icon-user-lock text-muted"></i>
                 </div>
                 <?php if (!empty($validation['password'])) : ?>
                     <span class="form-text text-danger fs-12"><?= ucfirst($validation['password']); ?>.</span>
                 <?php endif; ?>
             </div>


             <div class="form-group form-group-feedback form-group-feedback-left mb-4">
                 <input type="password" class="form-control show-password" autocomplete="off" placeholder="Contoh: sand123**" name="cpassword" />
                 <div class="form-control-feedback">
                     <i class="icon-user-lock text-muted"></i>
                 </div>
                 <?php if (!empty($validation['cpassword'])) : ?>
                     <span class="form-text text-danger fs-12"><?= ucfirst($validation['cpassword']); ?>.</span>
                 <?php endif; ?>
             </div>


             <div class="form-group d-flex align-items-center">
                 <div class="form-check mb-0">
                     <label class="form-check-label fn-inter">
                         <input type="checkbox" name="remember" id="show-password" class="form-input-styled" data-fouc />
                         <span class="fn-inter fw-400">Lihat kata sandi.</span>
                     </label>
                 </div>
             </div>

             <!-- <div class="form-group">
                 <div class="g-recaptcha" data-sitekey="6LeXLX8aAAAAAJ68L_KglgICt-AuhShuLSZnMnGT"></div>
             </div> -->

             <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-block btn-lg shadow-1">
                     Masuk
                 </button>
             </div>


             <span class="form-text text-center text-dark fn-inter fs-13 fw-500">
                 CBT <?= date('Y') ?> &copy; Politeknik Negeri Kupang
                 <span class="d-block fw-400 fs-10 mt-0">CREATED BY ICTPNKTEAM</span>
             </span>
         </div>
     </div>
 </form>
 <!-- /login card -->