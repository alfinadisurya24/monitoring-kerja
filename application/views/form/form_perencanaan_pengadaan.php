<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary"><?= $header ?></h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/main/index/data-pekerjaan">Data Pekerjaan</a></li>
                    <li class="breadcrumb-item active">Perencanaan Pengadaan</li>
                </ol>
            </div>
        </div>

        <div class="section-body">
            <!-- <p class="section-lead">
              Examples for showing pagination to indicate a series of related content exists across multiple pages.
            </p> -->
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <!-- <div class="card-header">
                            <a href="<?#= base_url()?>main/proses/data-pekerjaan/detail/<?=$field->id_pekerjaan?>" class="btn btn-primary">back</a>
                        </div> -->
                        <div class="card-body">
                            <?php if ($this->session->flashdata('message')) {?>
                                <div class="alert alert-<?= $this->session->flashdata('alert');?>">
                                <?= $this->session->flashdata('message');?>
                                </div>
                            <?php } ?>
                            
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'kkp' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#kkp" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Kkp</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'rks' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#rks" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Rks</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'referensi_harga' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#referensi_harga" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Referensi Harga</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'hpe' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#hpe" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Hpe</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <!-- kkp -->
                                <div class="tab-pane p-20 <?= $_GET['child'] == 'kkp' ? 'active' : '' ?>" id="kkp" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/kkp/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $kkp->id_kkp ?>">
                                        <div class="form-group">
                                            <label>Upload File Kkp</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $kkp->id_kkp == null ? 'required' : '' ?>>
                                            <p><?= $kkp->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $kkp->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $kkp->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $kkp->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- rks -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'rks' ? 'active' : '' ?>" id="rks" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/rks/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $rks->id_rks ?>">
                                        <div class="form-group">
                                            <label>Upload File Rks</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $rks->id_rks == null ? 'required' : '' ?>>
                                            <p><?= $rks->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $rks->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $rks->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $rks->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Submit</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- referensi harga -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'referensi_harga' ? 'active' : '' ?>" id="referensi_harga" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/referensi_harga/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $referensi_harga->id_referensi_harga ?>">
                                        <div class="form-group">
                                            <label>Upload File Referensi Harga</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $referensi_harga->id_referensi_harga == null ? 'required' : '' ?>>
                                            <p><?= $referensi_harga->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $referensi_harga->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $referensi_harga->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $referensi_harga->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Submit</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- hpe -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'hpe' ? 'active' : '' ?>" id="hpe" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/hpe/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $hpe->id_hpe ?>">
                                        <div class="form-group">
                                            <label>Upload File hpe</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $hpe->id_hpe == null ? 'required' : '' ?>>
                                            <p><?= $hpe->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $hpe->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $hpe->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $hpe->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Submit</button>
                                    <?= form_close(); ?>
                                </div>

                            </div>
                            
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
