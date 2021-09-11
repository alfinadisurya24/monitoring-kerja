<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary"><?= $header ?></h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Pendaftaran</li>
                </ol>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if ($this->session->flashdata('message')) {?>
                            <div class="alert alert-<?= $this->session->flashdata('alert');?>">
                                <?= $this->session->flashdata('message');?>
                            </div>
                            <?php } ?>
                            <!-- <a class="btn btn-md btn-primary ml-auto"
                                href="<?#=base_url()?>main/proses/pekerjaan/create"><i class="fa fa-plus"></i>
                                Create</a> -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="my-tables">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nomor Urut</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Email</th>
                                            <th>Nomor Handphone</th>
                                            <th>Alamat</th>
                                            <th>Pengecekan Data</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-data">
                                        <?php
                                        $i = 1; 
                                        foreach ($getData as $key => $value) { ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td class="text-dark"><?= $value->nomor_urut ?></td>
                                                <td class="text-dark"><?= $value->nama ?></td>
                                                <td class="text-dark"><?= $value->nik ?></td>
                                                <td class="text-dark"><?= $value->jenis_kelamin ?></td>
                                                <td class="text-dark"><?= $value->email ?></td>
                                                <td class="text-dark"><?= $value->hp ?></td>
                                                <td class="text-dark"><?= $value->alamat ?></td>
                                                <td>
                                                    <?php if ($value->cek_status != null && $value->cek_status != '') { ?>
                                                        <span class="label label-<?= $value->cek_status == 'sudah' ? 'success' : 'danger' ?> font-weight-bold p-2"><?= ucwords($value->cek_status) ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url()?>main/proses/pendaftaran/update/<?=$value->id?>"
                                                        class="btn btn-info btn-sm editData m-1">Update</a>
                                                    <!-- <button class="btn btn-danger btn-sm m-1 deleteData"
                                                        data-id="<?#= $value->id ?>">Delete</button> -->
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
        </div>
    </section>

</div>

<!-- modal delete -->
<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ?</p>
                <?= form_open('main/delete/'.$page);?>
                <input type="hidden" name="id" id="id">
                <div class="btn-group float-right" role="group" aria-label="Button group">
                    <button class="btn btn-primary mr-2" type="submit">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                </div>
                <?= form_close(); ?>
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
                        Nomor Urut
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="nomor_urut"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Nama Lengkap
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="nama"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        NIK
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="nik"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Jenis Kelamin
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="jensi_kelamin"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Email
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="email"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Nomor Handphone
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="hp"></span>
                    </div>
                    <div class="col-5 col-md-3">
                        Alamat
                    </div>
                    <div class="col-7 col-md-9">
                        : <span id="alamat"></span>
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

<input type="text" value="<?= base_url()?>" id="base" hidden>

<script>
    $(document).ready(function () {
        // show modal delete data
        $(".deleteData").click(function (e) {
            e.preventDefault();
            $("#modal-delete").modal('show');
            $("#id").val($(this).data("id"));
        });

        $(".detail").click(function (e) {
            e.preventDefault();
            $("#modal-detail").modal('show');
            $.ajax({
                type: "GET",
                url: $(this).data("base")+'main/detailJson/'+$(this).data("id"),
                data: {},
                dataType: "JSON",
                success: function (value) {
                    $("#nomor_urut").text(value.nomor_urut);
                    $("#nama").text(value.nama);
                    $("#nik").text(value.nik);
                    $("#jensi_kelamin").text(value.jensi_kelamin);
                    $("#email").text(value.email);
                    $("#hp").text(value.hp);
                    $("#alamat").text(value.alamat);
                    var foto = (value.foto).split(';');
                    for (let index = 0; index < foto.length; index++) {
                        $("#fotos").append('<div class="col-12 col-md-6"><img class="img-fluid" src="<?= base_url()?>uploads/images/'+foto[index]+'" alt=""></div>');
                    }
                }
            });
        });
    });
</script>