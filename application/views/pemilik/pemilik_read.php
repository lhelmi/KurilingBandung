<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('lib/head')?>
    <body class="no-skin">
        <?php $this->load->view('lib/navbar')?>
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>
            <?php $this->load->view('lib/sidebar')?>
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Home</a>
                            </li>
                            <li class="active">Pemilik Wisata</li>
                        </ul><!-- /.breadcrumb -->
                    </div>

                    <div class="page-header">
                        <h1>Data<small><i class="ace-icon fa fa-angle-double-right"></i>Pemilik Wisata</small></h1>  
                    </div><!-- /.page-header -->
                    
                    <div class="container">
                        <div class="row col-xs-12">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <br>
                                        <table class="table">
                                    	    <tr><td>Nama Pemilik</td><td><?php echo $nama_pemilik; ?></td><td rowspan="8"><img src="<?php echo base_url('./upload/owner/'. $file_ktp);?>"></td></tr>
                                    	    <tr><td>TTL</td><td><?php echo $tmp_lahir .', '. $tgl_lahir; ?></td><td></td></tr>
                                    	    <tr><td>Jenis Kelamin</td><td><?php echo $jk_pemilik; ?></td><td></td></tr>
                                    	    <tr><td>Alamat</td><td><?php echo $alamat_pemilik; ?></td><td></td></tr>
                                    	    <tr><td>Email</td><td><?php echo $email_pemilik; ?></td><td></td></tr>
                                    	    <tr><td>Notelp</td><td><?php echo $notelp_pemilik; ?></td><td></td></tr>
                                    	    <tr><td>Status</td><td><?php echo $is_active == '1' ? 'Aktif' : 'Tidak Aktif' ?></td><td></td></tr>
                                    	    <tr><td></td><td><a href="<?php echo site_url('pemilik') ?>" class="btn btn-default">Cancel</a></td><td></td></tr>
                                    	</table>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php $this->load->view('lib/footer')?>
    </body> 
</html>
