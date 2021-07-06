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
                    <li class="breadcrumb-item active">Pengumpulan Data</li>
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
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'rab' ? 'active' : '' ?> <?= $rab->file_upload == null ? "disabled" : "" ?>" data-toggle="tab" href="#rab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Rab</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'tor' ? 'active' : '' ?> <?= $tor->file_upload == null ? "disabled" : "" ?>" data-toggle="tab" href="#tor" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Tor</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'tug' ? 'active' : '' ?> <?= $tug->file_upload == null ? "disabled" : "" ?>" data-toggle="tab" href="#tug" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Tug</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'justifikasi' ? 'active' : '' ?> <?= $justifikasi->file_upload == null ? "disabled" : "" ?>" data-toggle="tab" href="#justifikasi" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Justifikasi</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'ba' ? 'active' : '' ?> <?= $ba->file_upload == null ? "disabled" : "" ?>" data-toggle="tab" href="#ba" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Berita Acara</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <!-- rab -->
                                <div class="tab-pane p-20 <?= $_GET['child'] == 'rab' ? 'active' : '' ?>" id="rab" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/rab/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $rab->id_rab ?>">
                                        <div class="form-group">
                                            <label>Nomor Rab</label>
                                            <input type="number" class="form-control" name="no" value="<?= $rab->no_rab ?>" placeholder="* nomor rab" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= $rab->tanggal ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nilai Rab</label>
                                            <input type="text" class="form-control" name="nilai" value="<?= $rab->nilai_rab ?>" placeholder="* nilai rab" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload File Rab</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $rab->id_rab == null ? 'required' : '' ?>>
                                            <p><?= $rab->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $rab->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $rab->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $rab->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- tor -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'tor' ? 'active' : '' ?>" id="tor" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/tor/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $tor->id_tor ?>">
                                        <div class="form-group">
                                            <label>Nomor Tor</label>
                                            <input type="number" class="form-control" name="no" value="<?= $tor->no_tor ?>" placeholder="* nomor tor" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= $tor->tanggal ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Durasi Pekerjaan</label>
                                            <input type="text" class="form-control" name="durasi_pekerjaan" value="<?= $tor->durasi_pekerjaan ?>" placeholder="* durasi pekerjaan" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload File Tor</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $tor->id_tor == null ? 'required' : '' ?>>
                                            <p><?= $tor->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $tor->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $tor->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $tor->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- tug -->
                                <div class="tab-pane p-20 <?= $_GET['child'] == 'tug' ? 'active' : '' ?>" id="tug" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/tug/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $tug->id_tug ?>">
                                        <div class="form-group">
                                            <label>Nomor Tug</label>
                                            <input type="number" class="form-control" name="no" value="<?= $tug->no_tug ?>" placeholder="* nomor tug" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= $tug->tanggal ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload File Tug</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $tug->id_tug == null ? 'required' : '' ?>>
                                            <p><?= $tug->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $tug->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $tug->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $tug->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- justifikasi -->
                                <div class="tab-pane p-20 <?= $_GET['child'] == 'justifikasi' ? 'active' : '' ?>" id="justifikasi" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/justifikasi/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $justifikasi->id_justifikasi ?>">
                                        <div class="form-group">
                                            <label>Jasa</label>
                                            <input type="text" class="form-control" name="jasa" value="<?= $justifikasi->jasa ?>" placeholder="* jasa" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload File Justifikasi</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $justifikasi->id_justifikasi == null ? 'required' : '' ?>>
                                            <p><?= $justifikasi->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $justifikasi->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $justifikasi->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $justifikasi->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- ba -->
                                <div class="tab-pane p-20 <?= $_GET['child'] == 'ba' ? 'active' : '' ?>" id="ba" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/ba/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $ba->id_ba ?>">
                                        <div class="form-group">
                                            <label>Nomor Berita Acara</label>
                                            <input type="number" class="form-control" name="no" value="<?= $ba->no_ba ?>" placeholder="* nomor berita acara" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= $ba->tanggal ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload File Berita Acara</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $ba->id_ba == null ? 'required' : '' ?>>
                                            <p><?= $ba->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $ba->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $ba->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $ba->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
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
