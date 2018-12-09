<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/front/')?>images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/')?>css/mainlogin.css">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                
                <form class="login100-form validate-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <span class="login100-form-title p-b-34">
                        Registrasi
                    </span>
                    
                    <?php echo form_error('NIK') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
                        <input class="input100" type="text" value="<?php echo $NIK; ?>" name="NIK" placeholder="NIK">
                        <span class="focus-input100"></span>
                    </div>
                    
                    <?php echo form_error('nama_pemilik') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
                        <input class="input100" type="text" name="nama_pemilik" placeholder="Nama" value="<?php echo $nama_pemilik; ?>">
                        <span class="focus-input100"></span>
                    </div>
                    
                    <?php echo form_error('tmp_lahir') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12" data-validate="Type password">
                        <input class="input100" type="text" name="tmp_lahir" placeholder="Tempat Lahir" value="<?php echo $tmp_lahir; ?>" >
                        <span class="focus-input100"></span>
                    </div>

                    <?php echo form_error('tgl_lahir') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
                        <input class="input100" type="date" name="tgl_lahir" placeholder="tanggal lahir" value="<?php echo $tgl_lahir; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <?php echo form_error('jk_pemilik') ?>
                    <div class="form-group col-12">
                        <div class="row">
                            <select style="width: 100%" name="jk_pemilik" class="form-control col-12" id="tgl">
                                <option value="">Jenis Kelamin</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <?php echo form_error('alamat_pemilik') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
                        <label for="exampleFormControlTextarea1"></label>
                         <textarea class="input100" id="exampleFormControlTextarea1" rows="5" name="alamat_pemilik" placeholder="Alamat"><?php echo $alamat_pemilik; ?></textarea>
                        <span class="focus-input100" ></span>
                    </div>

                    <?php echo form_error('password') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12" data-validate="Type password">
                        <input class="input100" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <?php echo form_error('email_pemilik') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12" data-validate="Type email">
                        <input class="input100" type="email" name="email_pemilik" placeholder="Email" value="<?php echo $email_pemilik; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <?php echo form_error('notelp_pemilik') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20 col-12">
                        <input class="input100" type="tlp" name="notelp_pemilik" placeholder="No. Tlp" value="<?php echo $notelp_pemilik; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <?php echo form_error('file_ktp') ?>
                    <?php echo $error; ?>
                    <div class="form-group m-b-20 ">
                    <label for="exampleInputFile">Silahkan Upload image scan KTP anda</label><br>
                    <label for="exampleInputFile">Pilih File Gamabr :</label>
                    <input type="file" name="file_ktp" class="form-control-file col-8 offset-2" id="exampleInputFile" > 
                    </div>
                    


                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            <?php echo $button; ?>
                        </button>
                    </div>

                    

                    <div class="w-full text-center" style="margin-top:60px">
                        <a href="<?php echo site_url('Kurilingbandung/login') ?>" class="txt3">
                            Masuk
                        </a>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
    
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/front/')?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/front/')?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/front/')?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url('assets/front/')?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/front/')?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url('assets/front/')?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/front/')?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/front/')?>js/main.js"></script>

</body>
</html>