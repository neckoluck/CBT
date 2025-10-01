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

<style>
*, body {
    	font-family: "Poppins", sans-serif;
    }
    .sidebar-user-material .sidebar-user-material-body {
        background: url('<?= base_url(); ?>/assets/limitless/global-assets/images/backgrounds/user_bg.jpg') center center no-repeat;
        background-size: cover;
    }
</style>

<!-- Core JS files -->
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/loaders/blockui.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/slinky.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/ui/ripple.min.js"></script>

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
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/selects/select2.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/jgrowl.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/notifications/noty.min.js"></script>
<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/forms/inputs/touchspin.min.js"></script>

<script src="<?= base_url(); ?>/assets/limitless/global-assets/js/plugins/extensions/jquery_ui/touch.min.js"></script>


<script src="<?= base_url(); ?>/assets/limitless/assets-layout-3/js/app.js"></script>
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


<?php if ($page == 'data ruangan sesi') : ?>
    <script>
        $(function() {
            $('.md-read').on('click', function() {
                const notes = $(this).data('notes');

                console.log(notes);

                $('#notes').html(notes);

            });

        });
    </script>
<?php endif; ?>
<?php if ($page == 'detail ruangan sesi') : ?>
    <script>
        $(function() {
            $('.md-reset').on('click', function() {
                const encode = $(this).data('encode');

                $.ajax({
                    url: '<?= $action['read'] ?>',
                    data: {
                        encode: encode
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $('#nama1').html(data.nama_peserta);
                        $('#no-pendaftaran1').html(data.no_pendaftaran);
                        $('#nik1').html(data.nik_peserta);
                        $('#encode1').val(encode);
                    }

                });

            });
        });
    </script>

    <script>
        $(function() {
            $('.md-disconnect').on('click', function() {
                const encode = $(this).data('encode');

                $.ajax({
                    url: '<?= $action['read'] ?>',
                    data: {
                        encode: encode
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        $('#nama2').html(data.nama_peserta);
                        $('#no-pendaftaran2').html(data.no_pendaftaran);
                        $('#nik2').html(data.nik_peserta);
                        $('#encode2').val(encode);
                    }

                });

            });
        });
    </script>

<?php endif; ?>
<?php if ($page == 'atur keamanan') : ?>
    <script>
        $(document).ready(function() {
            $('#show-oldpassword').click(function() {
                if ($(this).is(':checked')) {
                    $('.show-oldpassword').attr('type', 'text');
                } else {
                    $('.show-oldpassword').attr('type', 'password');
                }
            });

        });

        $(document).ready(function() {
            $('#show-newpassword').click(function() {
                if ($(this).is(':checked')) {
                    $('.show-newpassword').attr('type', 'text');
                } else {
                    $('.show-newpassword').attr('type', 'password');
                }
            });

        });
    </script>

<?php endif; ?>