<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary"><?= $header ?></h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
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
                        <!-- <div class="card-header"> -->
                            <!-- Form -->
                        <!-- </div> -->
                        <div class="card-body">
                            <?php if ($this->session->flashdata('message')) {?>
                                <div class="alert alert-<?= $this->session->flashdata('alert');?>">
                                <?= $this->session->flashdata('message');?>
                                </div>
                            <?php } ?>
                            <?= form_open_multipart('main/'.$action.'/'.$page.'');?>
                                <input type="hidden" name="id" value="<?= $field->id_rab ?>">
                                <div class="form-group">
                                    <label>Nomor Rab</label>
                                    <input type="number" class="form-control" name="no_rab" value="<?= $field->no_rab ?>" placeholder="* nomor rab" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?= $field->tanggal ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Nilai Rab</label>
                                    <input type="text" class="form-control" name="nilai_rab" value="<?= $field->nilai_rab ?>" placeholder="* nilai rab" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload File RAB</label>
                                    <input type="file" class="form-control" name="rab_upload" placeholder="* upload file" <?= $action == 'create' ? 'required' : '' ?>>
                                </div>
                                <div class="form-group">
                                    <label>Upload Cek</label>
                                    <select class="form-control" name="upload_cek" required>
                                        <option value="0">Belum dicek</option>
                                        <option value="1">Sudah dicek</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary text-capitalize" type="submit"><?= $action ?></button>
                            <?= form_close(); ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
