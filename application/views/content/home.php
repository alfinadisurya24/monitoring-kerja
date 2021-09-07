<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary"><?= $header ?></h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
<div class="row position-relative">

    <div class="col-md-6">
        <div class="card bg-primary p-20">
            <div class="media widget-ten">
                <div class="media-left meida media-middle">
                    <span><i class="ti-bag f-s-40"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white"><?= $jumlah_pekerjaan ?></h2>
                    <p class="m-b-0">Jumlah Seluruh Pekerjaan</p>
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
                    <span><i class="fa fa-percent f-s-40"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2 class="color-white"><?= (($sukses)/4) * 100 ?>%</h2>
                    <p class="m-b-0">Pesentase pekerjaan selesai hari ini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container-fluid">
        <div class="row"> -->
    <!-- Pie Chart -->
    <!-- <div class="col-4">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Progress Tahapan Pekerjaan</h4>
                        </div>
                    </div>
                    <input type="hidden" id="belum_sratus" value="<?#= $belum_sratus?>">
                    <input type="hidden" id="sratus_persen" value="<?#= $sratus_persen ?>">
                    <div class="panel-body">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-md text-danger ml-auto pdf" style="background-color:white;border:solid 1px red;"
                    href="<?=base_url()?>main/generatePdf"><i class="fa fa-file"></i> Download Pekerjaan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="my-tables">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Pekerjaan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show-data">
                            <?php
                            $i = 1; 
                            foreach ($getData as $key => $value) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td class="text-dark"><?= $value->pekerjaan ?></td>
                                <td class="text-dark"><?= tanggal_indo($value->tanggal) ?></td>
                                <td class="text-dark"><?= $value->jam ?></td>
                                <td>
                                    <?php if ($value->status != null && $value->status != '') { ?>
                                    <span
                                        class="label label-<?= $value->status == 'selesai' ? 'success' : 'danger' ?> font-weight-bold p-2"><?= ucwords($value->status) ?></span>
                                    <?php } ?>
                                </td>
                                <td class="text-dark"><?= $value->keterangan ?></td>
                                <!-- <td class="text-dark">
                                        <?#php
                                        #$progress = $value->tahapan_1 + $value->tahapan_2 + $value->tahapan_3 + $value->tahapan_4 + $value->tahapan_5 + $value->tahapan_6;
                                        #if ($progress == 100) { ?>
                                            <div class="bg-success border-rounded text-center pt-1 pb-1 pl-2 pr-2">
                                                <strong>Completed</strong> (<?#= $progress ?>%)
                                            </div>
                                        <?#php }else{ ?>
                                            <div class="bg-warning border-rounded text-center pt-1 pb-1 pl-2 pr-2">
                                                <strong>On Progress</strong> (<?#= $progress ?>%)
                                            </div>
                                        <?#php } ?>
                                    </td> -->
                                <td>
                                    <button class="btn btn-success btn-sm m-1 detail"
                                        data-id="<?= $value->id ?>" data-base="<?= base_url(); ?>">Detail</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal delete -->
<div id="modal-detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Detail</h3>
            </div>                                            
            <div class="modal-body">
                <div class="row">
                    <div class="col-5 col-md-3">
                        Pekerjaan
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="pekerjaan"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Tanggal
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="tanggal"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Jam
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="jam"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Status
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="status"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Keterangan
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="keterangan"></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <p>PDF :</p>
                        <div id="pdf"></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <p>Foto :</p>
                        <div class="row" id="fotos"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="window.location.reload();">Close</button>
            </div> 
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // show modal delete data
        $(".detail").click(function (e) {
            e.preventDefault();
            $("#modal-detail").modal('show');
            $.ajax({
                type: "GET",
                url: $(this).data("base")+'main/detailJson/'+$(this).data("id"),
                data: {},
                dataType: "JSON",
                success: function (value) {
                    $("#pekerjaan").text(value.pekerjaan);
                    $("#tanggal").text(value.tanggal);
                    $("#jam").text(value.jam);
                    $("#status").text(value.status);
                    $("#keterangan").text(value.keterangan);
                    if (value.file_pdf != null) {
                        $("#pdf").html('<a href="<?= base_url()?>main/downloadPdf/'+value.file_pdf+'"><img src="/assets/images/pdf.png" width="50" alt="pdf">Download File PDF</a>');
                    }
                    var foto = (value.foto).split(';');
                    for (let index = 0; index < foto.length; index++) {
                        $("#fotos").append('<div class="col-6 col-md-4"><img class="img-fluid" src="<?= base_url()?>uploads/images/'+foto[index]+'" alt=""></div>');
                    }
                }
            });
        });
    });
</script>