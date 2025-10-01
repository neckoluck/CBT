<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?= $title; ?></title>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>">
<link rel="shortcut icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>">

<!-- Global stylesheets -->
<link href="<?= base_url(); ?>/assets/limitless/global-assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-3/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-3/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-3/css/layout.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-3/css/components.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-3/css/colors.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/lindox/css/lindox.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/lindox/css/main.css" rel="stylesheet" type="text/css">

<?php if ($_SERVER['HTTP_HOST'] != '192.10.10.205') : ?>
<link href="<?= base_url(); ?>/assets/fonts/inter/inter.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/fonts/poppins/poppins.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/fonts/caveat/caveat.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/fonts/montserrat/montserrat.css" rel="stylesheet">
<?php else : ?>
<link href="<?= base_url(); ?>/assets/fonts/poppins/poppins-on.css" rel="stylesheet">

<?php endif; ?>
<!-- /global stylesheets -->



<?php if ($page != 'live-skor') : ?>
<!-- Core JS files -->
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/loaders/blockui.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/slinky.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/ripple.min.js"></script>
<!-- /core JS files -->

<script id="MathJax-script" async src="<?= base_url(); ?>/assets/lindox/js/mathjax/mathjax.min.js"></script>
<script>
    MathJax = {
        tex: {
            inlineMath: [
                ['$', '$'],
                ['\\(', '\\)']
            ]
        },
        svg: {
            fontCache: 'global'
        }
    };
</script>

<!-- Theme JS files -->
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/visualization/d3/d3.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/styling/switchery.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/pickers/daterangepicker.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/styling/switch.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/jgrowl.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/noty.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/inputs/touchspin.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/extensions/jquery_ui/touch.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/assets-layout-4/js/app.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/form_checkboxes_radios.js"></script>
<!-- /theme JS files -->
<?php endif; ?>

<?php if ($page == 'selesai') : ?>
    <script type="text/javascript">
        window.setTimeout(function() {
            window.location.href = "<?= base_url() ?>/peserta/logout";

        }, 100000);
    </script>
<?php endif; ?>



<?php if ($page == 'soal') : ?>
    <script type="text/javascript">
        $(document).ready(function() {

            function leftFillNum(num, targetLength) {
                return num.toString().padStart(targetLength, 0);
            }

            var detik = <?= $waktu['detik']; ?>;
            var menit = <?= $waktu['menit']; ?>;
            var jam = <?= $waktu['jam']; ?>;

            function hitung() {
                setTimeout(hitung, 1000);

                $('#timer').html(
                    '<div class="d-flex justify-content-center text-center"><div class="timer-number font-weight-light">' + leftFillNum(jam, 2) + '<span class="d-block font-size-base mt-2">Jam</span></div><div class="timer-dots mx-1">:</div><div class="timer-number font-weight-light">' + leftFillNum(menit, 2) + '<span class="d-block font-size-base mt-2">Menit</span></div><div class="timer-dots mx-1">:</div><div class="timer-number font-weight-light">' + leftFillNum(detik, 2) + ' <span class="d-block font-size-base mt-2">Detik</span></div></div>'
                );

                detik--;

                if (detik < 1) {
                    detik = 59;
                    menit--;

                    if (menit < 0) {
                        menit = 59;
                        jam--;

                        if (jam < 0) {
                            clearInterval(hitung);
                            window.location.href = "<?= base_url() ?>/peserta/soal/waktuhabis";
                        }
                    }
                }
            }

            hitung();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var jawaban = $(this).val();
                $.ajax({
                    url: "<?= $action['others']; ?>",
                    method: "POST",
                    data: {
                        jawaban: jawaban
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
<?php endif; ?>