<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="<?#= base_url( 'assets/image/png')?>" sizes="16x16" href="<?#= base_url( 'assets/images/favicon.png')?>"> -->
    <title><?=$title?></title>

    <link href="<?= base_url( 'assets/css/lib/chartist/chartist.min.css')?>" rel="stylesheet">
	<link href="<?= base_url( 'assets/css/lib/owl.carousel.min.css')?>" rel="stylesheet" />
    <link href="<?= base_url( 'assets/css/lib/owl.theme.default.min.css')?>" rel="stylesheet" />
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url( 'assets/css/lib/bootstrap/bootstrap.min.css')?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url( 'assets/css/helper.css')?>" rel="stylesheet">
    <link href="<?= base_url( 'assets/css/style.css')?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.2/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.2/datatables.min.css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- All Jquery -->
    <script src="<?= base_url( 'assets/js/lib/jquery/jquery.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.2/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.2/datatables.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url( 'assets/js/lib/bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?= base_url( 'assets/js/lib/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url( 'assets/js/jquery.slimscroll.js') ?>"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url( 'assets/js/sidebarmenu.js') ?>"></script>
    <!--stickey kit -->
    <script src="<?= base_url( 'assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js') ?>"></script>


    <!-- <script src="<?#= base_url( 'assets/js/lib/datamap/d3.min.js') ?>"></script>
    <script src="<?#= base_url( 'assets/js/lib/datamap/topojson.js') ?>"></script>
    <script src="<?#= base_url( 'assets/js/lib/datamap/datamaps.world.min.js') ?>"></script>
    <script src="<?#= base_url( 'assets/js/lib/datamap/datamap-init.js') ?>"></script>

    <script src="<?#= base_url( 'assets/js/lib/weather/jquery.simpleWeather.min.js') ?>"></script>
    <script src="<?#= base_url( 'assets/js/lib/weather/weather-init.js') ?>"></script> -->
    <script src="<?= base_url( 'assets/js/lib/owl-carousel/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url( 'assets/js/lib/owl-carousel/owl.carousel-init.js') ?>"></script>


    <!-- <script src="<?#= base_url( 'assets/js/lib/chartist/chartist.min.js') ?>"></script>
    <script src="<?#= base_url( 'assets/js/lib/chartist/chartist-plugin-tooltip.min.js') ?>"></script>
    <script src="<?#= base_url( 'assets/js/lib/chartist/chartist-init.js') ?>"></script> -->

    <script src="<?= base_url( 'assets/js/lib/chart-js/Chart.bundle.js') ?>"></script>
    <script src="<?= base_url( 'assets/js/lib/chart-js/chartjs-init.js') ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url( 'assets/js/custom.min.js') ?>"></script>

</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">

        <!-- header header  -->
            <?php $this->load->view('layout/navbar'); ?>
        <!-- End header header -->

        <!-- Left Sidebar  -->
            <?php $this->load->view('layout/sidebar'); ?>
        <!-- End Left Sidebar  -->

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                    <?php $this->load->view($section); ?>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->

            <!-- footer -->
            <footer class="footer"> © 2021 All rights reserved</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    
    <script src="<?= base_url( 'assets/js/custom.min.js') ?>"></script>

    <script>
    $(document).ready(function () {
        // datatables
        $("#my-tables").DataTable();
    });
    </script>

</body>

</html>