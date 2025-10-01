<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title><?= $title; ?></title>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>">
<link rel="shortcut icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>">

<!-- Global stylesheets -->
<link href="<?= base_url(); ?>/assets/limitless/global-assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/components.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/colors.min.css" rel="stylesheet" type="text/css" />


<?php if ($_SERVER['HTTP_HOST'] != '192.10.10.205') : ?>
<link href="<?= base_url(); ?>/assets/fonts/inter/inter.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/fonts/poppins/poppins.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/fonts/caveat/caveat.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/fonts/montserrat/montserrat.css" rel="stylesheet">
<?php else : ?>
<link href="<?= base_url(); ?>/assets/fonts/poppins/poppins-on.css" rel="stylesheet">

<?php endif; ?>
<link href="<?= base_url(); ?>/assets/lindox/css/lindox.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/lindox/css/main.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->


<style>
    .sidebar-user-material .sidebar-user-material-body {
        background: url('<?= base_url(); ?>/assets/limitless/global-assets/images/backgrounds/user_bg3.jpg') center center no-repeat;
        background-size: cover;
    }
*, body {
    	font-family: "Poppins", sans-serif;
    }

  .form-control::placeholder {
    color: #999;
    opacity: 1;
  text-transform:capitalize;}
</style>

<!-- Core JS files -->
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/loaders/blockui.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/ripple.min.js"></script>
<!-- /core JS files -->

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/jgrowl.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/noty.min.js"></script>

<!-- Theme JS files -->
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/styling/uniform.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/assets-layout-2/js/app.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/login.js"></script>

<script src="<?= base_url(); ?>/assets/jquery-mask/jquery.mask.min.js"></script>

<!-- /theme JS files -->
<script>
    var NotyJgrowl = function() {
        var _componentNoty = function() {
            if (typeof Noty == 'undefined') {
                console.warn('Warning - noty.min.js is not loaded.');
                return;
            }

            Noty.overrideDefaults({
                theme: 'limitless',
                layout: 'topRight',
                type: 'alert',
                timeout: 2500
            });

            var mText = $('#notif').data('text');
            var mType = $('#notif').data('type');

            if (mText) {
                new Noty({
                    layout: 'bottomCenter',
                    text: mText,
                    type: mType
                }).show();
            }
        }
        return {
            init: function() {
                _componentNoty();
                _componentJgrowl();
            }
        }
    }();

    document.addEventListener('DOMContentLoaded', function() {
        NotyJgrowl.init();
    });
</script>