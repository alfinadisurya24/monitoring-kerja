<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav mt-3">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="<?= $this->uri->segment('3') == '' ? 'active' : '' ?>"><a href=" <?=base_url() ?>main">Dashboard</a></li>
                <!-- <li class="<?#= $this->uri->segment('3') == 'pengumpulan' ? 'active' : '' ?>"><a href="/main/pengumpulan">Pengumpulan Data</a></li> -->
                <li class="<?= $this->uri->segment('3') == 'pendaftaran' ? 'active' : '' ?>"><a href="<?=base_url() ?>main/index/pendaftaran">Pendaftaran</a></li>
                <!-- <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard <span class="label label-rouded label-primary pull-right">2</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="index.html">Ecommerce </a></li>
                        <li><a href="index1.html">Analytics </a></li>
                    </ul>
                </li> -->
                <li class="<?= $this->uri->segment('3') == 'user' ? 'active' : '' ?>"><a href="<?=base_url() ?>main/index/user">User</a></li>
                <li class="<?= $this->uri->segment('3') == 'range' ? 'active' : '' ?>"><a href="<?=base_url() ?>main/index/range">Range Pendaftaran</a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>