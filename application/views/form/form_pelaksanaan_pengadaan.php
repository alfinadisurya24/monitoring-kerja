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
                    <li class="breadcrumb-item active">Pelaksanaan Pengadaan</li>
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
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'hps' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#hps" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Hps</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'ba_aanwijzing' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#ba_aanwijzing" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Berita Acara Aanwijzing</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'cda' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#cda" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">CDA</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'perjanjian' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#perjanjian" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Perjanjian</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'jaminan_pelaksanaan_pemeliharaan' ? 'active' : '' ?> <?= $disabled == true ? "disabled" : "" ?>" data-toggle="tab" href="#jaminan_pelaksanaan_pemeliharaan" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Jaminan Pelaksanaan Pemeliharaan</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <!-- hps -->
                                <div class="tab-pane p-20 <?= $_GET['child'] == 'hps' ? 'active' : '' ?>" id="hps" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/hps/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $hps->id_hps ?>">
                                        <div class="form-group">
                                            <label>Upload File hps</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $hps->id_hps == null ? 'required' : '' ?>>
                                            <p><?= $hps->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $hps->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $hps->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $hps->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- berita acara aanwijzing -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'ba_aanwijzing' ? 'active' : '' ?>" id="ba_aanwijzing" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/ba_aanwijzing/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $ba_aanwijzing->id_ba_aanwijzing ?>">
                                        <div class="form-group">
                                            <label>Upload File Berita Acara Aanwijzing</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $ba_aanwijzing->id_ba_aanwijzing == null ? 'required' : '' ?>>
                                            <p><?= $ba_aanwijzing->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $ba_aanwijzing->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $ba_aanwijzing->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $ba_aanwijzing->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- cda -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'cda' ? 'active' : '' ?>" id="cda" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/cda/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $cda->id_cda ?>">
                                        <div class="form-group">
                                            <label>Upload File cda</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $cda->id_cda == null ? 'required' : '' ?>>
                                            <p><?= $cda->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $cda->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $cda->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $cda->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- perjanjian -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'perjanjian' ? 'active' : '' ?>" id="perjanjian" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/perjanjian/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $perjanjian->id_perjanjian ?>">
                                        <div class="form-group">
                                            <label>Upload File perjanjian</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $perjanjian->id_perjanjian == null ? 'required' : '' ?>>
                                            <p><?= $perjanjian->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $perjanjian->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $perjanjian->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $perjanjian->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- jaminan pelaksanaan pemeliharaan -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'jaminan_pelaksanaan_pemeliharaan' ? 'active' : '' ?>" id="jaminan_pelaksanaan_pemeliharaan" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/jaminan_pelaksanaan_pemeliharaan/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $jaminan_pelaksanaan_pemeliharaan->id_jaminan_pelaksanaan_pemeliharaan ?>">
                                        <div class="form-group">
                                            <label>Upload File Jaminan Pelaksanaan Pemeliharaan</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $jaminan_pelaksanaan_pemeliharaan->id_jaminan_pelaksanaan_pemeliharaan == null ? 'required' : '' ?>>
                                            <p><?= $jaminan_pelaksanaan_pemeliharaan->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $jaminan_pelaksanaan_pemeliharaan->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $jaminan_pelaksanaan_pemeliharaan->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $jaminan_pelaksanaan_pemeliharaan->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
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
