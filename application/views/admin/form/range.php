<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary"><?= $header ?></h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/main/index/reange">Data Range Tanggal Pendaftaran</a></li>
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
                            <?= form_open_multipart('main/'.$action.'/'.$page.'');?>
                                <input type="hidden" name="id" value="<?= $field->id ?>">
                                <div class="form-group">
                                    <label>Tanggal Awal</label>
                                    <input type="date" class="form-control" name="tanggal_awal" value="<?= $field->tanggal_awal ?>"  required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" class="form-control" name="tanggal_akhir" value="<?= $field->tanggal_akhir ?>"  required>
                                </div>
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
