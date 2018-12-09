<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Login Page - Ace Admin</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/template/back')?>/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/template/back')?>/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo base_url('assets/template/back')?>/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo base_url('assets/template/back')?>/css/ace.min.css" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url('assets/template/back')?>/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        
                            <div class="center">
                                <h1>
                                    <i class="ace-icon fa fa-leaf green"></i>
                                    <span class="red">Ace</span>
                                    <span class="white" id="id-text2">Application</span>
                                </h1>
                                <h4 class="blue" id="id-company-text">&copy; Company Name</h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="signup-box" class="signup-box visible widget-box no-border" >
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header green lighter bigger">
                                                <i class="ace-icon fa fa-users blue"></i>
                                                New User Registration
                                            </h4>

                                            <div class="space-6"></div>
                                            <p> Enter your details to begin: </p>

                                            <?php echo form_open_multipart($action); ?>
                                                <fieldset>
                                                    <label class="block clearfix"><?php echo form_error('NIK') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" name="NIK" placeholder="NIK" value="<?php echo $NIK; ?>"/>
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('nama_pemilik') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" name="nama_pemilik" placeholder="Nama Lengkap" value="<?php echo $nama_pemilik; ?>" />
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('email_pemilik') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" name="email_pemilik" class="form-control" placeholder="Email" value="<?php echo $email_pemilik; ?>"/>
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('password') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>"/>
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>


                                                    <label class="block clearfix"><?php echo form_error('tmp_lahir') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name="tmp_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo $tmp_lahir; ?>" />
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('tgl_lahir') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="date" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $tgl_lahir; ?>"/>
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('jk_pemilik') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <select style="width: 100%" name="jk_pemilik">
                                                                <option value="">Jenis Kelamin</option>
                                                                <option value="L">Laki-Laki</option>
                                                                <option value="W">Perempuan</option>
                                                            </select>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('alamat_pemilik') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <textarea name="alamat_pemilik" placeholder="Alamat" style="width: 100%"><?php echo $alamat_pemilik; ?></textarea>
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('notelp_pemilik') ?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" name="notelp_pemilik" class="form-control" placeholder="No Telpon" value="<?php echo $notelp_pemilik; ?>"/>
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix"><?php echo form_error('file_ktp') ;?>
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="file" name="file_ktp" class="form-control" placeholder="Ktp" />
                                                            <i class="ace-icon fa fa-envelope"></i>
                                                        </span>
                                                    </label>
                                                    <?php echo $error; ?>
                                                    <div class="space-24"></div>

                                                    <div class="clearfix">
                                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                                            <i class="ace-icon fa fa-refresh"></i>
                                                            <span class="bigger-110">Reset</span>
                                                        </button>

                                                        <button type="submit" class="width-65 pull-right btn btn-sm btn-success">
                                                            <span class="bigger-110"><?php echo $button ?></span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>

                                        <div class="toolbar center">
                                            <div>
                                                <?php echo anchor(site_url('auth/login'),'<i class="ace-icon fa fa-arrow-left"></i> Back To Login</a>', 'class="back-to-login-link"'); ?>        
                                            </div>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.signup-box -->
                            </div><!-- /.position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->
    </body>
</html>
<!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="<?php echo base_url('assets/template/back')?>/js/jquery-2.1.4.min.js"></script>