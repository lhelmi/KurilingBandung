<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Daftar</title>
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
                <form action="<?php echo $action; ?>" method="post" class="login100-form validate-form">
                    <span class="login100-form-title p-b-64">
                        Account Login
                    </span>
                    <?php echo $this->session->userdata('message'); ?>
                    <?php echo form_error('username') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-40 col-12" data-validate="Type user name">
                        <input id="first-name" class="input100" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <?php echo form_error('password') ?>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-80 col-12" data-validate="Type password">
                        <input class="input100" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                        <span class="focus-input100"></span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            <?php echo $button ?>
                        </button>
                    </div>

                    <div class="w-full text-center p-t-27 p-b-50">
                        <span class="txt1">
                            Lupa
                        </span>

                        <a href="<?php echo site_url('Kurilingbandung/lupa_password') ?>" class="txt2">
                            password?
                        </a>
                    </div>

                    <div class="w-full text-center">
                        <a href="<?php echo site_url('Kurilingbandung/daftar') ?>" class="txt3">
                            Daftar
                        </a>
                         <a href="<?php echo site_url('Kurilingbandung') ?>" class="txt3">
                            / Kembali
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
    <script src="<?php echo base_url('assets/front/')?>vendor/select2/select2.min.js"></script>
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