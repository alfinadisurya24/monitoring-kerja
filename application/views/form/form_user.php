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
                                <input type="hidden" name="id" value="<?= $field->id_user ?>">
                                <div class="form-group">
                                    <label>Nama Depan</label>
                                    <input type="text" class="form-control" name="nama_depan" value="<?= $field->nama_depan ?>" placeholder="* nama depan" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Belakang</label>
                                    <input type="text" class="form-control" name="nama_belakang" value="<?= $field->nama_belakang ?>" placeholder="* nama belakang" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $field->email ?>" placeholder="* email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="pass" placeholder="* password" <?= $action == 'create' ? 'required' : '' ?> >
                                </div>
                                <div class="form-group">
                                    <label for="role">Status</label>
                                    <select id="role" class="form-control" name="role" required>
                                    <?php if ($action == 'create') {?>
                                        <option value="" disabled selected>Pilih Status User</option>
                                    <?php } ?>
                                        <option value="admin" <?= $field->role == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="user" <?= $field->role == 'user' ? 'selected' : '' ?>>User</option>
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input id="verifikasi" class="form-check-input" type="checkbox" name="verifikasi" <?= $field->verifikasi == 1 ? 'checked' : '' ?>  value="true">
                                    <label for="verifikasi" class="form-check-label">Verifikasi</label>
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
