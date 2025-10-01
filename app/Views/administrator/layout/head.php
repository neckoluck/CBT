<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?= $title; ?></title>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>">
<link rel="shortcut icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>/uploads/pic-other/<?= $sett['logo_instansi']; ?>">

<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/global-assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/layout.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/components.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/limitless/assets-layout-2/css/colors.min.css" rel="stylesheet" type="text/css">
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
<style>
    .sidebar-user-material .sidebar-user-material-body {
        background: url('<?= base_url(); ?>/assets/limitless/global-assets/images/backgrounds/user_bg.jpg') center center no-repeat;
        background-size: cover;
    }
	*, body {
    	font-family: "Poppins", sans-serif;
    }
</style>

<!-- Core JS files -->
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/loaders/blockui.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/slinky.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/ripple.min.js"></script>

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

<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/pickers/daterangepicker.js"></script>


<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/pickers/anytime.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/pickers/pickadate/picker.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/pickers/pickadate/picker.date.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/pickers/pickadate/picker.time.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/pickers/pickadate/legacy.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/visualization/d3/d3.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/styling/switchery.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/styling/switch.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/selects/select2.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/jgrowl.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/noty.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/inputs/touchspin.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/extensions/jquery_ui/touch.min.js"></script>


<script src="<?= base_url(); ?>/assets/limitless/assets-layout-2/js/app.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/editor_ckeditor.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/dashboard.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/datatables_basic.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/form_checkboxes_radios.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/form_select2.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/form_layouts.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/components_popups.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/components_modals.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/form_input_groups.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/components_collapsible.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/picker_date.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/demo_pages/datatables_extension_buttons_init.js"></script>
<!-- /theme JS files -->
<script>
    function previewImg() {
        const img = document.querySelector('#namaFile');
        const btnUpload = document.querySelector('.btn-upload');
        const imgPreview = document.querySelector('.preview-img');

        btnUpload.textContent = img.files[0].name;

        const fileImg = new FileReader();
        fileImg.readAsDataURL(img.files[0]);

        fileImg.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php
if ($page == 'form peserta') : ?>
    <?php if (!empty(session()->get('arrypeserta'))) : ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#md-vwimport').modal('show');
            });
        </script>
    <?php endif; ?>
<?php endif; ?>

<?php
if ($page == 'form soal') : ?>
    <script>
        $(function() {
            $('.md-imgdelete').on('click', function() {
                const encode = $(this).data('delete');
                $('#deletes').val(encode);
            });
        });
    </script>

    <?php for ($i = 1; $i <= 5; $i++) : ?>
        <script>
            function previewImg<?= $i; ?>() {
                const img = document.querySelector('#namaFile<?= $i; ?>');
                const btnUpload = document.querySelector('.btn-upload<?= $i; ?>');
                const imgPreview = document.querySelector('.preview-img<?= $i; ?>');

                btnUpload.textContent = img.files[0].name;

                const fileImg = new FileReader();
                fileImg.readAsDataURL(img.files[0]);

                fileImg.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            }
        </script>

        <script>
            $(function() {
                $('.md-imgdelete<?= $i ?>').on('click', function() {
                    const encode1 = $(this).data('delete');
                    $('#delete<?= $i; ?>').val(encode1);
                });
            });
        </script>
<?php
    endfor;
endif; ?>

<?php if (!empty($action)) : ?>
    <script>
        $(function() {
            $('.md-delete').on('click', function() {
                const encode = $(this).data('delete');
                $('#delete').val(encode);
            });
        });
    </script>
<?php endif; ?>

<script>
    $(function() {
        $('.md-akses').on('click', function() {
            const status = $(this).data('status');
            const encode = $(this).data('access');

            if (status == 1) {
                $('#message').html('Apakah Anda yakin ingin <span class="fw-500">menonaktifkan</span> akses staf ini ?');
            } else {
                $('#message').html('Apakah Anda yakin ingin <span class="fw-500">mengaktifkan</span> akses staf ini ?');
            }

            $('#access').val(encode);
        });

    });
</script>

<script>
    $(function() {
        $('.md-ruses').on('click', function() {
            const status = $(this).data('status');
            const encode = $(this).data('access');

            if (status == 0) {
                $('#message').html('Apakah Anda yakin ingin <span class="fw-500">menonaktifkan</span> ruangan sesi ini ?');
            } else {
                $('#message').html('Apakah Anda yakin ingin <span class="fw-500">mengaktifkan</span> ruangan sesi ini ?');
            }

            $('#access').val(encode);
        });

    });
</script>

<script>
    $(function() {
        $('.md-publis').on('click', function() {
            const status = $(this).data('status');
            const encode = $(this).data('publish');

            if (status == 1) {
                $('#message').html('Apakah Anda yakin kalau soal sudah siap <span class="fw-500">dipublis</span> ?');
            } else {
                $('#message').html('Apakah Anda yakin untuk tidak <span class="fw-500">mempublis</span> soal ini ?');
            }

            $('#publish').val(encode);
        });

    });
</script>

<script>
    $(function() {
        $('.md-lock').on('click', function() {
            const encode = $(this).data('lock');

            $('#lock').val(encode);
        });

    });
</script>

<script>
    $(function() {
        $('.md-unlock').on('click', function() {
            const encode = $(this).data('unlock');

            $('#unlock').val(encode);
        });

    });
</script>

<script>
    $(function() {
        $('.md-read').on('click', function() {
            const notes = $(this).data('notes');

            console.log(notes);

            $('#notes').html(notes);

        });

    });
</script>