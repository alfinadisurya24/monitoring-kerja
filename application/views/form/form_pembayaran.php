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
                    <li class="breadcrumb-item active">Pelaksanaan Pembayaran</li>
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
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'pembayaran_satu' ? 'active' : '' ?> disabled" data-toggle="tab" href="#pembayaran_satu" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Pembayaran</span></a> </li>
                                <!-- <li class="nav-item"> <a class="nav-link <?#= $_GET['child'] == 'kajian_risiko' ? 'active' : '' ?> disabled" data-toggle="tab" href="#kajian_risiko" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Kajian Risiko</span></a> </li> -->
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <!-- Pembayaran satu -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'pembayaran' ? 'active' : '' ?>" id="pembayaran" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/pembayaran/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $pembayaran->id_pembayaran ?>">
                                        <div class="form-group">
                                            <label>Upload File Pembayaran</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file">
                                            <!-- <p><?#= $pembayaran->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $pembayaran->file_upload)[1] : '' ?></p> -->
                                        </div>
                                        <div class="form-group">
                                            <label>Tahap Pembayaran</label>
                                            <select class="form-control" name="tahap" required>
                                                <option value="" disabled selected>pilih tahap pembayaran</option>
                                                <?php for ($i=1; $i < 12 ; $i++) { ?>
                                                    <option value="file_upload<?=$i?>">Pembayaran Tahap <?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $pembayaran->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $pembayaran->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
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
