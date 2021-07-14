<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary"><?= $header ?></h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
<div class="row position-relative">

    <div class="col-12" style="height: 200px;width: 100%;overflow:auto;">
        <?php if (!empty($per_minggu)) { ?>
            <?php foreach ($per_minggu as $key => $value) { ?>
                <?php 
                    $progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                    if ($progress == 100) { continue; } 
                ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Harap lengkapi dokumen dengan nama pekerjaan <?= $value->nama_pekerjaan  ?> karena sudah melewati H-7 !</strong>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if (!empty($per_bulan)) { ?>
            <?php foreach ($per_bulan as $key => $value) { ?>
                <?php 
                    $progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                    if ($progress == 100) { continue; } 
                ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Harap lengkapi dokumen dengan nama pekerjaan <?= $value->nama_pekerjaan  ?> karena sudah melewati H-1 Bulan !</strong>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if (!empty($per_3bulan)) { ?>
            <?php foreach ($per_3bulan as $key => $value) { ?>
                <?php 
                    $progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                    if ($progress == 100) { continue; } 
                ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Harap lengkapi dokumen dengan nama pekerjaan <?= $value->nama_pekerjaan  ?> karena sudah melewati H-3 Bulan !</strong>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if (!empty($per_6bulan)) { ?>
            <?php foreach ($per_6bulan as $key => $value) { ?>
                <?php 
                    $progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                    if ($progress == 100) { continue; } 
                ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Harap lengkapi dokumen dengan nama pekerjaan <?= $value->nama_pekerjaan  ?> karena sudah melewati H-6 Bulan !</strong>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if (!empty($per_tahun)) { ?>
            <?php foreach ($per_tahun as $key => $value) { ?>
                <?php 
                    $progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                    if ($progress == 100) { continue; } 
                ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Harap lengkapi dokumen dengan nama pekerjaan <?= $value->nama_pekerjaan  ?> karena sudah melewati H-1 Tahun !</strong>
                </div>
            <?php } ?>
        <?php } ?>
    </div>


    <div class="col-md-6">
        <div class="card bg-primary p-20">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="ti-bag f-s-40"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white"><?= $pekerjaan ?></h2>
                    <p class="m-b-0">Pekerjaan</p>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-3">
        <div class="card bg-pink p-20">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="ti-comment f-s-40"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white">278</h2>
                    <p class="m-b-0">user</p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-md-6">
        <div class="card bg-success p-20">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-users f-s-40"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white"><?= $user ?></h2>
                    <p class="m-b-0">User</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Pie Chart -->
            <div class="col-4">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Progress Tahapan Pekerjaan</h4>
                        </div>
                    </div>
                    <input type="hidden" id="belum_sratus" value="<?= $belum_sratus?>">
                    <input type="hidden" id="sratus_persen" value="<?= $sratus_persen ?>">
                    <div class="panel-body">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="col-md-3">
        <div class="card bg-danger p-20">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="ti-location-pin f-s-40"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white">278</h2>
                    <p class="m-b-0">Total Visitor</p>
                </div>
            </div>
        </div>
    </div> -->
</div>