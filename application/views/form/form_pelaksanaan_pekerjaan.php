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
                    <li class="breadcrumb-item active">Pelaksanaan Pekerjaan</li>
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
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'kick_off' ? 'active' : '' ?> disabled" data-toggle="tab" href="#kick_off" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Kick Off</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'spk' ? 'active' : '' ?> disabled" data-toggle="tab" href="#spk" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">SPK</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'spm' ? 'active' : '' ?> disabled" data-toggle="tab" href="#spm" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Surat penerimaan material</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'lpp' ? 'active' : '' ?> disabled" data-toggle="tab" href="#lpp" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Laporan pelaksanaan pekerjaan</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'nrpp' ? 'active' : '' ?> disabled" data-toggle="tab" href="#nrpp" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Notulen rapat progress pekerjaan </span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'ba_stp' ? 'active' : '' ?> disabled" data-toggle="tab" href="#ba_stp" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">BA serah terima pekerjaan</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'ba_pembayaran' ? 'active' : '' ?> disabled" data-toggle="tab" href="#ba_pembayaran" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">BA Pembayaran</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'ba_smp' ? 'active' : '' ?> disabled" data-toggle="tab" href="#ba_smp" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">BA selesai masa pemeliharaan </span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'ba_pemeriksaan' ? 'active' : '' ?> disabled" data-toggle="tab" href="#ba_pemeriksaan" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">BA Pemeriksaan</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'amandemen_perjanjian' ? 'active' : '' ?> disabled" data-toggle="tab" href="#amandemen_perjanjian" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Amandemen Perjanjian</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'ba_denda' ? 'active' : '' ?> disabled" data-toggle="tab" href="#ba_denda" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">BA Denda</span></a> </li>
                                <li class="nav-item"> <a class="nav-link <?= $_GET['child'] == 'dokumen_audit' ? 'active' : '' ?> disabled" data-toggle="tab" href="#dokumen_audit" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Dokumen Audit</span></a> </li>
    
                                </ul>
                            <div class="tab-content tabcontent-border">
                                <!-- kick_off -->
                                <div class="tab-pane p-20 <?= $_GET['child'] == 'kick_off' ? 'active' : '' ?>" id="kick_off" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/kick_off/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $kick_off->id_kick_off ?>">
                                        <div class="form-group">
                                            <label>Upload File kick_off</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $kick_off->id_kick_off == null ? 'required' : '' ?>>
                                            <p><?= $kick_off->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $kick_off->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $kick_off->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $kick_off->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- spk -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'spk' ? 'active' : '' ?>" id="spk" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/spk/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $spk->id_spk ?>">
                                        <div class="form-group">
                                            <label>Upload File spk</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $spk->id_spk == null ? 'required' : '' ?>>
                                            <p><?= $spk->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $spk->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $spk->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $spk->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- spm -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'spm' ? 'active' : '' ?>" id="spm" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/spm/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $spm->id_spm ?>">
                                        <div class="form-group">
                                            <label>Upload File Surat penerimaan material</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $spm->id_spm == null ? 'required' : '' ?>>
                                            <p><?= $spm->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $spm->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $spm->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $spm->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- lpp -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'lpp' ? 'active' : '' ?>" id="lpp" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/lpp/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $lpp->id_lpp ?>">
                                        <div class="form-group">
                                            <label>Upload File Laporan pelaksanaan pekerjaan</label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $lpp->id_lpp == null ? 'required' : '' ?>>
                                            <p><?= $lpp->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $lpp->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $lpp->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $lpp->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- nrpp -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'nrpp' ? 'active' : '' ?>" id="nrpp" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/nrpp/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $nrpp->id_nrpp ?>">
                                        <div class="form-group">
                                            <label>Upload File Notulen rapat progress pekerjaan </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $nrpp->id_nrpp == null ? 'required' : '' ?>>
                                            <p><?= $nrpp->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $nrpp->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $nrpp->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $nrpp->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- ba_stp -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'ba_stp' ? 'active' : '' ?>" id="ba_stp" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/ba_stp/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $ba_stp->id_ba_stp ?>">
                                        <div class="form-group">
                                            <label>Upload File BA serah terima pekerjaan </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $ba_stp->id_ba_stp == null ? 'required' : '' ?>>
                                            <p><?= $ba_stp->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $ba_stp->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $ba_stp->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $ba_stp->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- ba_pembayaran -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'ba_pembayaran' ? 'active' : '' ?>" id="ba_pembayaran" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/ba_pembayaran/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $ba_pembayaran->id_ba_pembayaran ?>">
                                        <div class="form-group">
                                            <label>Upload File BA Pembayaran </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $ba_pembayaran->id_ba_pembayaran == null ? 'required' : '' ?>>
                                            <p><?= $ba_pembayaran->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $ba_pembayaran->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $ba_pembayaran->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $ba_pembayaran->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- ba_smp -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'ba_smp' ? 'active' : '' ?>" id="ba_smp" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/ba_smp/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $ba_smp->id_ba_smp ?>">
                                        <div class="form-group">
                                            <label>Upload File BA selesai masa pemeliharaan </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $ba_smp->id_ba_smp == null ? 'required' : '' ?>>
                                            <p><?= $ba_smp->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $ba_smp->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $ba_smp->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $ba_smp->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- ba_pemeriksaan -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'ba_pemeriksaan' ? 'active' : '' ?>" id="ba_pemeriksaan" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/ba_pemeriksaan/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $ba_pemeriksaan->id_ba_pemeriksaan ?>">
                                        <div class="form-group">
                                            <label>Upload File BA Pemeriksaan </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $ba_pemeriksaan->id_ba_pemeriksaan == null ? 'required' : '' ?>>
                                            <p><?= $ba_pemeriksaan->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $ba_pemeriksaan->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $ba_pemeriksaan->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $ba_pemeriksaan->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- amandemen_perjanjian -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'amandemen_perjanjian' ? 'active' : '' ?>" id="amandemen_perjanjian" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/amandemen_perjanjian/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $amandemen_perjanjian->id_amandemen_perjanjian ?>">
                                        <div class="form-group">
                                            <label>Upload File Amandemen Perjanjian </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $amandemen_perjanjian->id_amandemen_perjanjian == null ? 'required' : '' ?>>
                                            <p><?= $amandemen_perjanjian->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $amandemen_perjanjian->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $amandemen_perjanjian->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $amandemen_perjanjian->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- ba_denda -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'ba_denda' ? 'active' : '' ?>" id="ba_denda" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/ba_denda/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $ba_denda->id_ba_denda ?>">
                                        <div class="form-group">
                                            <label>Upload File BA Denda </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $ba_denda->id_ba_denda == null ? 'required' : '' ?>>
                                            <p><?= $ba_denda->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $ba_denda->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $ba_denda->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $ba_denda->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary text-capitalize" type="submit">Next</button>
                                    <?= form_close(); ?>
                                </div>

                                <!-- dokumen_audit -->
                                <div class="tab-pane  p-20 <?= $_GET['child'] == 'dokumen_audit' ? 'active' : '' ?>" id="dokumen_audit" role="tabpanel">
                                    <?= form_open_multipart('main/tahapan_kerja/dokumen_audit/'.$field->id_pekerjaan);?>
                                        <input type="hidden" name="id" value="<?= $dokumen_audit->id_dokumen_audit ?>">
                                        <div class="form-group">
                                            <label>Upload File Dokumen Audit </label>
                                            <input type="file" class="form-control" name="upload" placeholder="* upload file" <?= $dokumen_audit->id_dokumen_audit == null ? 'required' : '' ?>>
                                            <p><?= $dokumen_audit->file_upload != null ? '<img src="/assets/images/pdf.png" width="50" alt="pdf">'.explode('/', $dokumen_audit->file_upload)[1] : '' ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Cek</label>
                                            <select class="form-control" name="upload_cek" required>
                                                <option value="0" <?= $dokumen_audit->upload_cek ? 'selected' : '' ?>>Belum dicek</option>
                                                <option value="1" <?= $dokumen_audit->upload_cek ? 'selected' : '' ?>>Sudah dicek</option>
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
