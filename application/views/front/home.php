<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Vaksin</title>

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
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex flex-column align-items-center">

            <h1 class="mb-4">Pendaftaran Vaksin</h1>
            <!-- <h2>We're working hard to improve our website and we'll ready to launch after</h2> -->

            <h4>Cetak PDF nomor antrian vaksin</h4>
            <div id="notice"></div>
            <div class="subscribe">
                <div class="php-email-form">
                    <div class="subscribe-form">
                        <input class="form-control" type="text" id="nik_cetak" name="nik_cetak" placeholder="Masukan NIK . . ." required>
                        <a id="downloadPdf" type="submit">Cetak</a>
                    </div>
                </div>
            </div>

        </div>
    </header><!-- End #header -->

    <main id="main">
    
        <!-- ======= Contact Us Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="row">

                    <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <!-- <form action="<?#= base_url()?>front/create" method="post" role="form" class="php-email-form"> -->
                            <?php if ($this->session->flashdata('message')) {?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Pendaftaran Vaksin Anda <strong>Gagal!</strong> Silahkan mendaftar kembali.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>

                            <?php if (date('Y-m-d') > $range->tanggal_awal && date('Y-m-d') < $range->tanggal_akhir) {?>
                                <?= form_open_multipart('front/create', 'class="php-email-form"');?>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="Masukan Nama" required>
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control" name="nik" pattern="[0-9]"
                                            placeholder="Masukan NIK" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control"
                                            required="required">
                                            <option value="" disabled selected>pilih jenis kelamin</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label for="hp">Nomor Handphone</label>
                                        <input type="number" class="form-control" name="hp" pattern="[0-9]"
                                            placeholder="Masukan Nomor Handphone" required>
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukan Email" required>
                                    </div>
                                    <div class="form-group col-md-6 mt-3 mt-md-0">
                                        <label for="foto">Upload Foto KTP atau KK <small class="text-warning">( * bisa juga
                                                keduanya )</small></label>
                                        <input type="file" class="form-control" name="foto[]" multiple required>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="10" placeholder="Masukan Alamat"
                                        required></textarea>
                                </div>
                                <div class="text-center mt-3"> <button type="submit">Daftar Vaksin</button></div>
                                <?= form_close(); ?>
                            <?php }else{ ?>
                                <h2 class="text-center w-100">Maaf, pendaftaran vaksin sedang ditutup.</h2>
                            <?php } ?>
                    </div>

                </div>
                <div class="social-links text-center">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </section>
        <!-- End Contact Us Section -->

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Vendor JS Files -->
    <script src=" <?= base_url( 'assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Template Main JS File -->
    <script src=" <?= base_url( 'assets/front/js/main.js') ?>"></script>

    <input type="text" value="<?= base_url()?>" id="base" hidden>

    <script>
        $("#nik_cetak").keyup(function () {
            $("#downloadPdf").removeAttr("href");
            if (!$(this).val()) {
                $("#downloadPdf").removeAttr("href");
                $("#notice").html(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        +'Silahkan masukan NIK Anda untuk mencetak nomor antrian.'
                        +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                    +'</div>'
                );
            } else {
                $("#notice").text("");
                $("#downloadPdf").attr("href", $("#base").val()+"front/generatePdf/"+$(this).val());
            }  
        });
    </script>
</body>

</html>