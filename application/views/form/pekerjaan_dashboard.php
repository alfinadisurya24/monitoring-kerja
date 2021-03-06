<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary"><?= $header ?></h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/main/index/pekerjaan">Pekerjaan</a></li>
                    <li class="breadcrumb-item active"><?= ucfirst($action) ?></li>
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
                        <!-- <div class="card-header"> -->
                            <!-- Form -->
                        <!-- </div> -->
                        <div class="card-body">
                            <?php if ($this->session->flashdata('message')) {?>
                                <div class="alert alert-<?= $this->session->flashdata('alert');?>">
                                <?= $this->session->flashdata('message');?>
                                </div>
                            <?php } ?>
                            <?= form_open_multipart('main/updateDashboard/'.$page);?>
                                <input type="hidden" name="id" value="<?= $field->id ?>">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan" value="<?= $field->pekerjaan ?>" placeholder="* pekerjaan" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?= $field->tanggal ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jam</label>
                                    <input type="time" class="form-control" name="jam" value="<?= $field->jam ?>" placeholder="* jam" required>
                                </div>
                                <?php if ($action == 'update') {?>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" class="form-control" name="status">
                                            <option value="tidak selesai" <?= $field->status == 'tidak selesai' ? 'selected' : '' ?>>Tidak Selesai</option>
                                            <option value="selesai" <?= $field->status == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control"  rows="5" placeholder="* keterangan" style="height:100px;"><?= $field->keterangan ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload</label>
                                        <input type="file" class="form-control" name="imagesUpload[]" multiple/>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-1 col-lg-1">
                                                <small>Gambar Sebelumnya :</small>
                                            </div>
                                            <?php 
                                            $gambar = explode(';', $field->foto);
                                            for ($i=0; $i < count($gambar) ; $i++) { ?>
                                                <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                                                    <img class="img-fluid" src="<?= base_url('uploads/images/'. $gambar[$i]) ?>" alt="<?= $gambar[$i] ?>">
                                                </div>
                                            <?php } ?>
                                        </div>				
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Upload File PDF</label>
                                        <input type="file" class="form-control" name="uploadPdf" placeholder="* upload file" >
                                        <?php if (!empty($field->file_pdf)) { ?>
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $field->file_pdf ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">Download File PDF</a>
                                        <?php } ?>
                                    </div> 
                                <?php } ?>
                                <br>
                                <button class="btn btn-primary text-capitalize" type="submit"><?= $action ?></button>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
