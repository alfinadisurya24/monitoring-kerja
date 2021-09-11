<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Pendaftaran Vaksin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="<?#= base_url( 'assets/front/img/favicon.png')?>" rel="icon"> -->
    <!-- <link href="<?#= base_url( 'assets/front/img/apple-touch-icon.png')?>" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url( 'assets/front/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url( 'assets/front/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url( 'assets/front/css/style.css')?>" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header-detail" class="d-flex align-items-center">
        <div class="container d-flex flex-column align-items-center">

        </div>
    </header><!-- End #header -->

    <main id="main">

        <!-- ======= Contact Us Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="row">

                    <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                            <div class="row">
                                <?php if (!$this->session->flashdata('message')) {?>
                                    <h1>Maaf, laman tidak tersedia</h1>
                                    <h6>
                                        <a class="text text-primary bg-light py-2 px-3" href="<?= base_url(); ?>">Kembali ke home</a>
                                    </h6>
                                <?php }else{?>
                                    <h1>Pendaftaran vaksin Anda Berhasil</h1>
                                    <h6>
                                        <a class="text text-primary bg-light py-2 px-3" href="<?= base_url(); ?>">Kembali ke home</a>
                                    </h6>
                                    <hr>
                                    <h3 class="mb-4">Nomor Urut Antrian <?= $this->session->flashdata('data')['nomor_urut'] ?></h3>
                                    
                                    <div class="col-12 col-md-3">
                                        <h4>&#8226; Nama Lengkap :</h4>
                                    </div>
                                    <div class="col-12 col-md-9 ps-5">
                                        <h4><?= $this->session->flashdata('data')['nama'] ?></h4>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <h4>&#8226; NIK :</h4>
                                    </div>
                                    <div class="col-12 col-md-9 ps-5">
                                        <h4><?= $this->session->flashdata('data')['nik'] ?></h4>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <h4>&#8226; Jenis Kelamin :</h4>
                                    </div>
                                    <div class="col-12 col-md-9 ps-5">
                                        <h4><?= $this->session->flashdata('data')['jenis_kelamin'] ?></h4>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <h4>&#8226; Email :</h4>
                                    </div>
                                    <div class="col-12 col-md-9 ps-5">
                                        <h4><?= $this->session->flashdata('data')['email'] ?></h4>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <h4>&#8226; Nomor Handphone :</h4>
                                    </div>
                                    <div class="col-12 col-md-9 ps-5">
                                        <h4><?= $this->session->flashdata('data')['hp'] ?></h4>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <h4>&#8226; Alamat :</h4>
                                    </div>
                                    <div class="col-12 col-md-9 ps-5">
                                        <h4><?= $this->session->flashdata('data')['alamat'] ?></h4>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <h4>&#8226; Foto KTP/KK :</h4>
                                    </div>
                                    <div class="col-12 col-md-9 ps-md-5">
                                        <div class="row">
                                            <?php 
                                            $gambar = explode(';', $this->session->flashdata('data')['foto']);
                                            for ($i=0; $i < count($gambar) ; $i++) { ?>
                                                <div class="col-12 col-md-3">
                                                    <img class="img-fluid" src="<?= base_url('uploads/images/'. $gambar[$i]) ?>" alt="<?= $gambar[$i] ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <a class="btn btn-light text-danger mt-4" href="<?= base_url()?>front/generatePdf/<?= $this->session->flashdata('data')['nik'] ?>" style="border: 2px solid red;" href="">Cetak PDF antrian</a>
                                    
                                <?php } ?>
                            </div>
                    </div>

                </div>
            </div>
        </section><!-- End Contact Us Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                2021&copy; Copyright <strong><span></span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>
    <!-- End #footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Vendor JS Files -->
    <script src=" <?= base_url( 'assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src=" <?= base_url( 'assets/front/vendor/php-email-form/validate.js') ?>"></script>

    <!-- Template Main JS File -->
    <script src=" <?= base_url( 'assets/front/js/main.js') ?>"></script>

</body>

</html>