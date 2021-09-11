<div class="header">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- Logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                <!-- Logo icon -->
                <!-- <b><img src="<3?= base_url('assets/images/pln.png') ?>" alt="pln" class="dark-logo w-10" /></b> -->
                <!--End Logo icon -->
                <!-- Logo text -->
                <h3 class="text-dark"><img src="<?= base_url('assets/images/pln.png') ?>" alt="pln" class="dark-logo w-20" /></h3>
            </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse">
            <!-- toggle and nav items -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            </ul>
            <!-- User profile and search -->
            <ul class="navbar-nav my-lg-0">
                <!-- Profile -->
                <li class="nav-item dropdown">
                    <!-- <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?#= base_url('assets/images/users/5.jpg') ?>" alt="user" class="profile-pic" /></a> -->
                    <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= ucfirst($_SESSION['username'])?> <i class="fa fa-user border rounded-circle p-2"></i></a>
                    <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                        <ul class="dropdown-user">
                            <li class="pl-3">
                                <h5 class="text-primary font-weight-bold"> Hi, <?= ucfirst($_SESSION['username'])?> </h5>
                            </li>
                            <!-- <li><a href="#"><i class="ti-user"></i> Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="#"><i class="ti-settings"></i> Setting</a></li> -->
                            <li class="mt-2">
                                <?= form_open('main/logout')?>
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fa fa-power-off"></i> Logout
                                </button>
                                <?= form_close()?>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>