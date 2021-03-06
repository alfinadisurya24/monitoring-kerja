<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Monitoring Pekerjaan</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #B0BEC5;
            background-repeat: no-repeat
        }

        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 0px
        }

        .card2 {
            margin: 0px 40px
        }

        .logo {
            width: 200px;
            height: 100px;
            margin-top: 20px;
            margin-left: 35px
        }

        .image {
            width: 360px;
            height: 280px
        }

        .border-line {
            border-right: 1px solid #EEEEEE
        }

        .facebook {
            background-color: #3b5998;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .twitter {
            background-color: #1DA1F2;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .linkedin {
            background-color: #2867B2;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .line {
            height: 1px;
            width: 45%;
            background-color: #E0E0E0;
            margin-top: 10px
        }

        .or {
            width: 10%;
            font-weight: bold
        }

        .text-sm {
            font-size: 14px !important
        }

        ::placeholder {
            color: #BDBDBD;
            opacity: 1;
            font-weight: 300
        }

        :-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        ::-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        input,
        textarea {
            padding: 10px 12px 10px 12px;
            border: 1px solid lightgrey;
            border-radius: 2px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            font-size: 14px;
            letter-spacing: 1px
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #304FFE;
            outline-width: 0
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        a {
            color: inherit;
            cursor: pointer
        }

        .btn-blue {
            background-color: #1A237E;
            width: 150px;
            color: #fff;
            border-radius: 2px
        }

        .btn-blue:hover {
            background-color: #000;
            cursor: pointer
        }

        .bg-blue {
            color: #fff;
            background-color: #1A237E
        }

        .image {
            width: 300px;
            height: 220px
        }

        .border-line {
            border-right: none
        }

        .card2 {
            border-top: 1px solid #EEEEEE !important;
            margin: 0px 15px
        }
        
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

</head>

<body>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex pt-5">
                <div class="col-lg-6 pt-5">
                    <div class="card1 pt-5 pb-5">
                        <!-- <div class="row"> <img src="https://i.imgur.com/CXQmsmF.png" class="logo"> </div> -->
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img
                                src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row border-bottom px-3 mb-4">
                            <h2>Register</h2>
                        </div>
                        <div class="row px-3"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Nama Depan</h6>
                            </label> <input class="mb-4" type="text" name="namaDepan" id="namaDepan"
                                placeholder="* nama depan"> </div>
                        <div class="row px-3"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Nama Belakang</h6>
                            </label> <input class="mb-4" type="text" name="namaBelakang" id="namaBelakang"
                                placeholder="* nama belakang"> </div>
                        <div class="row px-3"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Email Address</h6>
                            </label> <input class="mb-4" type="text" name="emailRegis" id="emailRegis"
                                placeholder="* email"> </div>
                        <div class="row px-3 mb-4"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Password</h6>
                            </label> <input type="password" name="passRegis" id="passRegis" placeholder="* password"> </div>
                        <div class="row px-3 mb-4"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Confirm Password</h6>
                            </label> <input type="password" name="passConfirm" id="passConfirm" placeholder="* confirm password"> </div>
                        <!-- <div class="row px-3 mb-4"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Role</h6>
                            </label>
                            <select class="form-control" name="role" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div> -->
                        <!-- <div class="row px-3 mb-4">
                            <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                        </div> -->
                        <h5 class="text-danger" id="regisFailed"></h5>
                        <div class="row mb-3 px-3"> 
                            <button type="submit" class="btn btn-blue text-center" id="btn-register">Register</button> </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights
                        reserved.</small>
                    <!-- <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div> -->
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            // register
            $('#btn-register').on('click', function () {
                if ($('#namaDepan').val() == '' || $('#namaBelakang').val() == '' || $('#emailRegis').val() == '' || $('#passRegis').val() == '' || $('#passConfirm').val() == '') {
                    $('#regisFailed').text('* form tidak boleh kosong');
                }else if($('#passRegis').val().length < 8){
                    $('#regisFailed').text('* password minimal 8 karakter');
                }else{
                    $.ajax({
                        type: "GET",
                        url: "<?= base_url('main/getEmailUser') ?>",
                        data: "",
                        dataType: "JSON",
                        success: function (response) {
                            if (jQuery.inArray($('#emailRegis').val() ,response) != -1) {
                                $('#regisFailed').text('* Email sudah digunakan, silahkan gunakan email lain untuk mendaftar');
                            }else{
                                if ($('#passRegis').val() == $('#passConfirm').val()) {
                                    $.ajax({
                                        type: "POST",
                                        url: "<?= base_url('main/register') ?>",
                                        data: {
                                            namaDepan 		: $('#namaDepan').val(),
                                            namaBelakang 	: $('#namaBelakang').val(),
                                            emailRegis 		: $('#emailRegis').val(),
                                            passRegis 		: $('#passRegis').val(),
                                            passConfirm 	: $('#passConfirm').val(),
                                        },
                                        dataType: "JSON",
                                        beforeSend: function () {  
                                            $('#btn-register').text('Harap tunggu . . .');
                                        },
                                        complete: function () {  
                                            $('#btn-register').text('Register');
                                        },
                                        success: function (response) {
                                            alert('Registrasi Sukses');
                                            window.location.href= "/";
                                        }
                                    });
                                }else{
                                    $('#regisFailed').text('* Password tidak cocok');
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>