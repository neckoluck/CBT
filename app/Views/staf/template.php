<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('staf/layout/head'); ?>

</head>

<body>

    <!-- Main navbar -->
    <?= view('staf/layout/main-navbar'); ?>
    <!-- /main navbar -->


    <!-- Page header -->
    <?= view('staf/layout/page-header'); ?>
    <!-- /page header -->


    <!-- Page content -->
    <div class="page-content pt-0">

        <!-- Main sidebar -->
        <?= view('staf/layout/main-sidebar'); ?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">
                <?= view($content); ?>

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->


    <!-- Footer -->
    <?= view('staf/layout/footer'); ?>
    <?= view('staf/layout/modal'); ?>
    <!-- /footer -->


</body>
<?= view('staf/layout/foot'); ?>

</html>