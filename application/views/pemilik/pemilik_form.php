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
                        <h1>Form<small><i class="ace-icon fa fa-angle-double-right"></i> Pemilik Wisata</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
                        <h2 style="margin-top:0px">Pemilik <?php echo $button ?></h2>
                        <?php echo form_open_multipart($action); ?>
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">NIK</label>
                                <input type="text" class="form-control"  name="NIK" id="NIK" placeholder="NIK" value="<?php echo $NIK; ?>">
                                <?php echo form_error('NIK') ?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Nama Pemilik </label>
                                <input type="text" class="form-control"  name="nama_pemilik" id="nama_pemilik" placeholder="Nama" value="<?php echo $nama_pemilik; ?>">
                                <?php echo form_error('nama_pemilik') ?>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Tempat Lahir</label>
                                    <input type="text" class="form-control"  name="tmp_lahir" id="tmp_lahir" placeholder="tempat Lahir" value="<?php echo $tmp_lahir; ?>">
                                    <?php echo form_error('tmp_lahir') ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputAddress2">Tanggal Lahir</label>
                                    <div class="input-group">
                                        <input class="form-control date-picker" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir" value="<?php echo $tgl_lahir; ?>" id="id-date-picker-1" type="date" data-date-format="dd-mm-yyyy" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                                <?php echo form_error('tgl_lahir') ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Jenis Kelamin</label>
                                <select class="form-control" id="form-field-select-2" name="jk_pemilik">
                                    <option value="">Pilih</option>
                                    <option <?= $jk_pemilik=='L' ? $selected='selected' : $selected=''?> value="<?= $jk_pemilik=='L' ? 'L' : 'L' ?>">Laki-Laki</option>
                                    <option <?= $jk_pemilik=='P' ? $selected='selected' : $selected=''?> value="<?= $jk_pemilik=='P' ? 'P' : 'P' ?>">Perempuan</option>
                                </select>
                                <?php echo form_error('jk_pemilik') ?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Alamat</label>
                                <textarea class="form-control" rows="3" name="alamat_pemilik" id="alamat_pemilik" placeholder="Alamat "><?php echo $alamat_pemilik; ?></textarea>
                                <?php echo form_error('alamat_pemilik') ?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Password</label>
                                <input type="password" class="form-control"  name="password" id="password" placeholder="Password" >
                                <?php echo form_error('password') ?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Email</label>
                                <input type="text" class="form-control"  name="email_pemilik" id="Email" placeholder="email_pemilik" value="<?php echo $email_pemilik; ?>">
                                <?php echo form_error('email_pemilik') ?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputAddress2">No Telp</label>
                                <input type="text" class="form-control"  name="notelp_pemilik" id="No Telp" placeholder="notelp_pemilik" value="<?php echo $notelp_pemilik; ?>">
                                <?php echo form_error('notelp_pemilik') ?>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">File KTP</label>
                                <input type="file" onchange="tampilkanPreview(this,'preview')" class="form-control" name="file_ktp" id="file_ktp" placeholder="file_ktp" value="<?php echo $file_ktp; ?>">
                                    <?php if (!$file_ktp == '') {?>
                                        <img src="<?php echo base_url('./upload/owner/'. $file_ktp);?>" id="preview" width="180" height="200">

                                    <?php } ?>
                            </div>    
                            <?php echo $error; ?>
                            <?php echo form_error('file_ktp') ?>
                        </div>
                    	   <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                           <?php if ($this->session->userdata('is_admin')==FALSE) { ?>
                    	       <a href="<?php echo site_url('wisata') ?>" class="btn btn-default">Cancel</a>
                            <?php }else{ ?>
                                <a href="<?php echo site_url('pemilik') ?>" class="btn btn-default">Cancel</a>
                            <?php } ?>
	                   </form>
                     </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('lib/footer')?>
    </body>
</html>
<script type="text/javascript">
    function tampilkanPreview(gambar,idpreview){
//                membuat objek gambar
                var gb = gambar.files;
                
//                loop untuk merender gambar
                for (var i = 0; i < gb.length; i++){
//                    bikin variabel
                    var gbPreview = gb[i];
                    var imageType = /image.*/;
                    var preview=document.getElementById(idpreview);            
                    var reader = new FileReader();
                    
                    if (gbPreview.type.match(imageType)) {
//                        jika tipe data sesuai
                        preview.file = gbPreview;
                        reader.onload = (function(element) { 
                            return function(e) { 
                                element.src = e.target.result; 
                            }; 
                        })(preview);
 
    //                    membaca data URL gambar
                        reader.readAsDataURL(gbPreview);
                    }else{
//                        jika tipe data tidak sesuai
                        alert("Type file tidak sesuai. Khusus image.");
                    }
                   
                }    
            }
</script>