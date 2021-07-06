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
                            <?php if($action == 'detail') { ?>
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                        <ul>
                                            <li>
                                                <h3>Nama Pekerjaan</h3>
                                                <h4><?= $field->nama_pekerjaan ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>Nomor Perjanjian</h3>
                                                <h4><?= $field->no_perjanjian ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>lokasi</h3>
                                                <h4><?= $field->lokasi ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>Kapasitas</h3>
                                                <h4><?= $field->kapasitas ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>Anggaran</h3>
                                                <h4><?= rupiah($field->anggaran) ?></h4>
                                                <br>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                        <ul>
                                            <li>
                                                <h3>Sumber</h3>
                                                <h4><?= $field->sumber_dana ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>Direksi</h3>
                                                <h4><?= $field->direksi_pekerjaan ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>Pelaksana</h3>
                                                <h4><?= $field->pelaksana ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>Start</h3>
                                                <h4><?= tanggal_indo($field->start_date) ?></h4>
                                                <br>
                                            </li>
                                            <li>
                                                <h3>Finish</h3>
                                                <h4><?= tanggal_indo($field->finish_date) ?></h4>
                                                <br>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <?php if ($_SESSION['role'] == "admin") {?>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mb-3">
                                            <h3 class="font-weight-bold">Tahapan Pekerjaan</h3>
                                            <?php if ($this->session->flashdata('message')) {?>
                                                <div class="alert alert-<?= $this->session->flashdata('alert');?>">
                                                <?= $this->session->flashdata('message');?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                            <a href="<?=base_url()?>main/tahapan_v/pengumpulan/<?=$field->id_pekerjaan?>?child=rab" class="btn btn-primary text-white w-100 font-weight-bold">Tahapan 1 <br> Pengumpulan <br> Data</a>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                            <a href="<?=base_url()?>main/tahapan_v/mro/<?=$field->id_pekerjaan?>?child=profile_risiko" class="btn btn-primary text-white w-100 font-weight-bold <?= empty($ba) && empty($tor) && empty($tug) && empty($justifikasi) && empty($rab) ? "disabled" : ""  ?>">Tahapan 2 <br> MRO (Manajemen Risiko) <br> Pengadaan</a>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                            <a href="<?=base_url()?>main/tahapan_v/perencanaan_pengadaan/<?=$field->id_pekerjaan?>?child=kkp" class="btn btn-primary text-white w-100 font-weight-bold <?= empty($ba) && empty($tor) && empty($tug) && empty($justifikasi) && empty($rab) ? "disabled" : ""  ?>">Tahapan 3 <br> Perencanaan <br> Pengadaan</a>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                            <a href="<?=base_url()?>main/tahapan_v/pelaksanaan_pengadaan/<?=$field->id_pekerjaan?>?child=hps" class="btn btn-primary text-white w-100 font-weight-bold <?= empty($ba) && empty($tor) && empty($tug) && empty($justifikasi) && empty($rab) ? "disabled" : ""  ?>">Tahapan 4 <br> Pelaksanaan <br> Pengadaan</a>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                            <a href="<?=base_url()?>main/tahapan_v/pelaksanaan_pekerjaan/<?=$field->id_pekerjaan?>?child=kick_off" class="btn btn-primary text-white w-100 font-weight-bold <?= empty($ba) && empty($tor) && empty($tug) && empty($justifikasi) && empty($rab) ? "disabled" : ""  ?>">Tahapan 5 <br> Pelaksanaan <br> Pekerjaan </a>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                            <a href="<?=base_url()?>main/tahapan_v/pembayaran/<?=$field->id_pekerjaan?>?child=pembayaran" class="btn btn-primary text-white w-100 font-weight-bold <?= empty($ba) && empty($tor) && empty($tug) && empty($justifikasi) && empty($rab) ? "disabled" : ""  ?>">Tahapan 6 <br> Pelaksanaan <br> Pembayaran</a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-4 mb-3">
                                        <h3 class="font-weight-bold">File Download</h3>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                        <?php if (!empty($ba)) { ?>
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">File Berita Acara</a>
                                        <?php } ?>
                                        <?php if (!empty($rab)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $rab->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File RAB </a>
                                        <?php } ?>
                                        <?php if (!empty($tor)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $tor->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File TOR </a>
                                        <?php } ?>
                                        <?php if (!empty($tug)) { ?>
                                            <br><br>                                  
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $tug->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File TUG </a>
                                        <?php } ?>
                                        <?php if (!empty($justifikasi)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $justifikasi->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Justifikasi </a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                        <?php if (!empty($profile_risiko)) { ?>
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $profile_risiko->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">File Profile Risiko</a>
                                        <?php } ?>
                                        <?php if (!empty($kajian_risiko)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $kajian_risiko->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Kajian Risiko </a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                        <?php if (!empty($kkp)) { ?>
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $kkp->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">File KKP</a>
                                        <?php } ?>
                                        <?php if (!empty($rks)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $rks->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File RKS </a>
                                        <?php } ?>
                                        <?php if (!empty($referensi_harga)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $referensi_harga->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Referensi Harga </a>
                                        <?php } ?>
                                        <?php if (!empty($hpe)) { ?>
                                            <br><br>                                  
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $hpe->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File HPE </a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                        <?php if (!empty($hps)) { ?>
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $hps->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">File HPS</a>
                                        <?php } ?>
                                        <?php if (!empty($ba_aanwijzing)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba_aanwijzing->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Berita Acara Aanwijzing </a>
                                        <?php } ?>
                                        <?php if (!empty($cda)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $cda->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File CDA </a>
                                        <?php } ?>
                                        <?php if (!empty($perjanjian)) { ?>
                                            <br><br>                                  
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $perjanjian->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Perjanjian </a>
                                        <?php } ?>
                                        <?php if (!empty($jaminan_pelaksanaan_pemeliharaan)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $jaminan_pelaksanaan_pemeliharaan->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Jaminan Pelaksanaan Pemeliharaan </a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                        <?php if (!empty($kick_off)) { ?>
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $kick_off->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">File Kick Off</a>
                                        <?php } ?>
                                        <?php if (!empty($ba_aanwijzing)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba_aanwijzing->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Berita Acara Aanwijzing </a>
                                        <?php } ?>
                                        <?php if (!empty($spk)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $spk->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File SPK </a>
                                        <?php } ?>
                                        <?php if (!empty($spm)) { ?>
                                            <br><br>                                  
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $spm->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Surat Penerimaan Material </a>
                                        <?php } ?>
                                        <?php if (!empty($lpp)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $lpp->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Laporan Pelaksanaan Pekerjaan </a>
                                        <?php } ?>
                                        <?php if (!empty($nrpp)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $nrpp->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">File Notulen Rapat Progress Pekerjaan </a>
                                        <?php } ?>
                                        <?php if (!empty($ba_stp)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba_stp->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Berita Acara Serah Terima Pekerjaan </a>
                                        <?php } ?>
                                        <?php if (!empty($ba_pembayaran)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba_pembayaran->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Berita Acara Pembayaran </a>
                                        <?php } ?>
                                        <?php if (!empty($ba_smp)) { ?>
                                            <br><br>                                  
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba_smp->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Berita Acara Selesai Masa Pemeliharaan </a>
                                        <?php } ?>
                                        <?php if (!empty($ba_pemeriksaan)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba_pemeriksaan->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Berita Acara Pemeriksaan </a>
                                        <?php } ?>
                                        <?php if (!empty($amandemen_perjanjian)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $amandemen_perjanjian->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Amandemen Perjanjian </a>
                                        <?php } ?>
                                        <?php if (!empty($ba_denda)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $ba_denda->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf">File Berita Acara Denda </a>
                                        <?php } ?>
                                        <?php if (!empty($dokumen_audit)) { ?>
                                            <br><br>                                   
                                            <a href="<?= base_url()?>main/downloadPdf/<?= $dokumen_audit->file_upload ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> File Dokumen Audit </a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                        <?php 
                                            if (!empty($pembayaran)) { 
                                                for ($i=1; $i < 12; $i++) { 
                                                    $file = 'file_upload'.$i;
                                                    if (file_exists('./assets/files/'.$pembayaran->$file) && $pembayaran->$file != NULL) {                                 
                                        ?> 
                                                        <a href="<?= base_url()?>main/downloadPdf/<?= $pembayaran->$file ?>"><img src="/assets/images/pdf.png" width="50" alt="pdf"> <br> File Pembayaran Tahap <?= $i ?> </a>
                                                        <br><br>
                                        <?php 
                                                    }
                                                }    
                                            } 
                                        ?>
                                    
                                    </div>
                                </div>
                            <?php } else{ ?>
                                <?php if ($this->session->flashdata('message')) {?>
                                    <div class="alert alert-<?= $this->session->flashdata('alert');?>">
                                    <?= $this->session->flashdata('message');?>
                                    </div>
                                <?php } ?>
                                <?= form_open_multipart('main/'.$action.'/'.$page.'');?>
                                    <input type="hidden" name="id" value="<?= $field->id_pekerjaan ?>">
                                    <div class="form-group">
                                        <label>Nama Pekerjaan</label>
                                        <input type="text" class="form-control" name="nama_pekerjaan" value="<?= $field->nama_pekerjaan ?>" placeholder="* nama pekerjaan" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Perjanjian</label>
                                        <input type="text" class="form-control" name="no_perjanjian" value="<?= $field->no_perjanjian ?>" placeholder="* nomor perjanjian" required>
                                    </div>
                                    <div class="form-group">
                                        <label>lokasi</label>
                                        <textarea name="lokasi" id="lokasi" class="form-control"  rows="5" required placeholder="* alamat" style="height:100px;"><?= $field->lokasi ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Kapasitas</label>
                                        <input type="number" class="form-control" name="kapasitas" value="<?= $field->kapasitas ?>" placeholder="* kapasitas" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Anggaran</label>
                                        <input type="text" class="form-control" name="anggaran" value="<?= $field->anggaran ?>" placeholder="* anggaran" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sumber Dana</label>
                                        <input type="text" class="form-control" name="sumber_dana" value="<?= $field->sumber_dana ?>" placeholder="* sumber dana" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Direksi Pekerjaan</label>
                                        <input type="text" class="form-control" name="direksi_pekerjaan" value="<?= $field->direksi_pekerjaan ?>" placeholder="* direksi pekerjaan" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pelaksana</label>
                                        <input type="text" class="form-control" name="pelaksana" value="<?= $field->pelaksana ?>" placeholder="* pelaksana" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="<?= $field->start_date ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Finish Date</label>
                                        <input type="date" class="form-control" name="finish_date" value="<?= $field->finish_date ?>" required>
                                    </div>
                                    <button class="btn btn-primary text-capitalize" type="submit"><?= $action ?></button>
                                <?= form_close(); ?>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
