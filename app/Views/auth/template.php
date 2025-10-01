<!DOCTYPE html>
<html lang="en">

<head>
<style>
	*, body {
    	font-family: "Poppins", sans-serif;
    }
</style>
    <?= view('auth/layout/head'); ?>

</head>

<body style="background: #fff">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">
                <?= view($content); ?>
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</body>
<?php

if (session()->getFlashdata('message')) :
    $msg   = session()->getFlashdata('message');
    $pisah = explode('-', $msg); ?>

    <span class="fw-300 text-center mt-0" id="notif" data-type="<?= is_notif(current($pisah))['notif']; ?>" data-text="<span class='fw-500'><?= is_notif(current($pisah))['pesan']; ?></span> - <?= ucfirst(set_message($msg)); ?>"></span class="fw-300 text-center">

<?php endif; ?>
<script>
    $(document).ready(function() {
        $('#show-password').click(function() {
            if ($(this).is(':checked')) {
                $('.show-password').attr('type', 'text');
            } else {
                $('.show-password').attr('type', 'password');
            }
        });

    });
</script>
<script>
$(document).ready(function() {
// 	$('#username').keypress(function(){
//     	// console.log('jadi');
//     	// var leng = $(this).val();
//     	// if(leng.length==5||leng.length==9){
//     	// $(this).val(leng+'-');
//     	// }    
//     	// //$(this).val($(this).val().replace(/(\d{5})\-?(\d{3})\-?(\d{5})/,'$1-$2-$3'));
    
    
// 	});
	$('#username').mask('00-000-00000');
 });
</script>
</html>