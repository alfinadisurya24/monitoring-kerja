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
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?= $field->username ?>" placeholder="* Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Perbarui PIN</label> <small>* Nilai pin harus tediri dari 6 angka</small>
                                    <input type="password" class="form-control" name="pin" placeholder="* pin" maxlength="6" pattern="[0-9]{6}">
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi PIN</label>
                                    <input type="password" class="form-control" name="pin_confirm" placeholder="* konfirmasi pin" maxlength="6" pattern="[0-9]{6}">
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
