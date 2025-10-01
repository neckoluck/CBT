<!DOCTYPE html>
<html lang="en">

<?php if ($page != "export") : ?>

    <head>
        <?= view('administrator/layout/head'); ?>

    </head>
	
	<?php if ($page !== "rekapan-peserta") : ?>
     <body class="<?= in_array($page, ['data ruangan sesi', 'detail ruangan sesi', 'Detail Peserta', 'data rekapan peserta']) ? 'sidebar-xs' : ''; ?>">
		
        <!-- Main navbar -->
        <?= view('administrator/layout/main-navbar'); ?>

        <!-- /main navbar -->


        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <?= view('administrator/layout/main-sidebar'); ?>

            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <?= view('administrator/layout/page-header'); ?>

                <!-- /page header -->


                <!-- Content area -->
                <div class="content pt-0">
                    <?= view($content); ?>
                </div>
                <!-- /content area -->

                <!-- Footer -->
                <?= view('administrator/layout/footer'); ?>
                <!-- /footer -->

                <?= view('administrator/layout/modal'); ?>

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </body>
    <?= view('administrator/layout/foot'); ?>
    <?php else : ?>
    	 <body>
    	<div class="container-fluid px-5 py-5">
    		<div class="row">
    			<div class="col-lg-12">
    				<?= view($content); ?>
    			</div>
    		</div>
    	</div>
    	<?= view('administrator/layout/modal'); ?>
     </body>
    
    <?php endif; ?>
<?php else : ?>

    <head>

    </head>

    <body>
        <?= view($content); ?>
    </body>

<?php endif; ?>

</html>