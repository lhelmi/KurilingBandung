<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('lib/head')?>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyAKcW-QdLtI9yZoKOK1j2V-gZaErXnJNWU&libraries=places"></script>
    
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
                            <li class="active">Wisata</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Form<small><i class="ace-icon fa fa-angle-double-right"></i> Wisata</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
                        <form action="<?php echo $action; ?>"  enctype="multipart/form-data" method="post">

                            <div class="col-xs-12">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Lokasi</h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <div>
                                                <div id="maps" style="width: 100%; height: 320px;" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.span -->

                        

                    	    <div class="form-group">
                                <label for="varchar">Nama Wisata</label>
                                <input type="text" class="form-control" name="nama_wisata" id="nama_wisata" placeholder="Nama Wisata" value="<?php echo $nama_wisata; ?>" />
                                 <?php echo form_error('nama_wisata') ?>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea  name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea>
                                 <?php echo form_error('deskripsi') ?>
                            </div>

                            <div class="form-group">
                            <label for="varchar">Kota </label>
                    	    <select class="form-control" name="id_kota" id="id_kota">
                            <?php if ($this->session->userdata('level')!=='1'): ?>
                                <option value="">Please Select</option>    
                            <?php endif ?>
                            <?php
                            foreach ($id_kota as $kota) {
                                ?>
                                <option <?php echo $gid_kota == $kota->id_kota ? 'selected="selected"' : '' ?> 
                                    value="<?php echo $kota->id_kota ?>"><?php echo $kota->nama_kota ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error('id_kota') ?>
                            </div>
                            
                    	    <div class="form-group">
                                <label for="int">Kecamatan </label>
                                
                                <select class="form-control" name="id_kec" id="id_kec">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($id_kec as $kec) {
                                ?>
                                <!--di sini kita tambahkan class berisi id provinsi-->
                                <option <?php echo $gid_kec == $kec->id_kec ? 'selected="selected"' : '' ?> 
                                    class="<?php echo $kec->id_kota ?>" value="<?php echo $kec->id_kec ?>"><?php echo $kec->nama_kec ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error('id_kec') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="int">Kelurahan </label>
                                <select class="form-control" name="id_kel" id="id_kel">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($id_kel as $kel) {
                                ?>
                                <!--di sini kita tambahkan class berisi id kota-->
                                <option <?php echo $gid_kel == $kel->id_kel ? 'selected="selected"' : '' ?>  
                                    class="<?php echo $kel->id_kec ?>" value="<?php echo $kel->id_kel ?>"><?php echo $kel->nama_kel ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error('id_kel') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="alamat_wisata">Alamat Wisata </label>
                                <textarea  name="alamat_wisata"  onchange="cari_alamat()" class="form-control" rows="3" id="alamat_wisata" placeholder="Alamat Wisata"><?php echo $alamat_wisata; ?></textarea>
                            <?php echo form_error('alamat_wisata') ?>
                            </div>
                            
                            <div class="form-group">
                                <label for="float">latitude</label>
                                <input type="text"  name="lat" readonly class="form-control" id="lat" placeholder="Lat" value="<?php echo $lat; ?>" />
                                 <?php echo form_error('lat') ?>
                            </div>

                            <div class="form-group">
                                <label for="float">longitude </label>
                                <input type="text" name="lng" readonly class="form-control" id="lng" placeholder="Lng" value="<?php echo $lng; ?>" />
                                <?php echo form_error('lng') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="int">Tiket Dewasa</label>
                                <input type="text" name="tiket_dewasa" class="form-control" id="tiket_dewasa" placeholder="Tiket Dewasa" value="<?php echo $tiket_dewasa; ?>" />
                                 <?php echo form_error('tiket_dewasa') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="int">Tiket Anak </label>
                                <input type="text" name="tiket_anak" class="form-control" id="tiket_anak" placeholder="Tiket Anak" value="<?php echo $tiket_anak; ?>" />
                                <?php echo form_error('tiket_anak') ?>
                            </div>
                            <?php if ($this->session->userdata('is_admin')!==FALSE) { ?>
                                <div class="form-group">
                                    <label for="varchar">NIK </label>
                                    <select name="NIK" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php foreach ($NIK as $key => $val) {
                                            
                                                if ($val->NIK==$gNIK){ 
                                                    $select="selected='true'";
                                                }else{
                                                    $select='';
                                                }
                                            ?>
                                                <option value="<?= $val->NIK ?>" <?= $select; ?> ><?php echo $val->nama_pemilik ?></option>
                                                
                                            <?php } ?>
                                    </select>
                                    <?php echo form_error('NIK') ?>
                                </div>
                            <?php }else{ ?>
                                <input type="hidden" name="NIK" value="<?php echo $this->session->userdata('username'); ?>" />     
                            <?php } ?> 
                            
                            <div class="form-group">
                                <label for="varchar">
                                    Upload Foto
                                </label>
                                <table class="table table-bordered">
                                     <tr>
                                          <th width="30%">Gambar</th>
                                          <th width="10%"></th>
                                          <th width="10%"></th>
                                     </tr>
                                <?php foreach ($gambar as $key => $value): ?>
                                    <?php if ($value->id_wisata==$id_wisata){ ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="id_gambar1[]" value="<?=  $value->id_gambar;?>">
                                            <img src="<?php echo base_url('./upload/wisata/'. $value->nama_gambar);?>" width="180" height="200" id="preview[<?=$key?>]">
                                        </td>
                                        <td>
                                            <?php echo anchor(site_url('gambar/delete/'.$value->id_gambar),'Delete', 'class="btn btn-danger", onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?> 
                                        </td>
                                        <td>
                                            <label class="ace-file-input"><input name="nama_gambar1[]" onchange="tampilkanPreview(this,'preview[<?=$key?>]')" type="file" id="id-input-file-2"><span class="ace-file-container" data-title="Choose"><span class="ace-file-name" data-title="Ganti Foto"><i class=" ace-icon fa fa-upload"></i></span></span><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>
                                        </td>
                                    
                                    <?php } ?>
                                <?php endforeach ?>
                                    </tr>
                                </table>
                                <div class="col-xs-12">
                                    <input multiple="" name="nama_gambar[]" type="file" id="id-input-file-3" />
                                </div>
                                <?php echo form_error('nama_gambar') ?>
                            </div>
                            <?php echo $error; ?>
                            <div class="form-group">
                                <label for="varchar">
                                    Fasilitas
                                </label>
                                <table class="table table-bordered" id="dynamic_field">
                                     <tr>
                                          <th width="30%">Nama Fasilitas</th>
                                          <th width="10%">Harga</th>
                                          <th width="5%"></th>
                                     </tr>
                                    <?php foreach ($fasilitas as $key => $val) {
                                        if ($val->id_wisata==$id_wisata){ ?>
                                     <tr>
                                        <td>
                                            <input type="hidden" value="<?= $val->id_fasilitas ?>" class="form-control" name="id_fasilitas1[]" placeholder="Nama Fasilitas">
                                            <input type="text" value="<?= $val->nama_fasilitas ?>" class="form-control" name="nama_fasilitas1[]" placeholder="Nama Fasilitas">
                                        </td>
                                        <td>
                                            <input value="<?= $val->harga_fasilitas ?>" class="form-control" name="harga_fasilitas1[]" placeholder="Harga">
                                        </td>
                                        <td>
                                            <?php echo anchor(site_url('fasilitas/delete/'.$val->id_fasilitas),'Delete', 'class="btn btn-danger", onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
                                        </td>
                                    <?php } } ?>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="nama_fasilitas[]" placeholder="Nama Fasilitas">
                                                <?php echo form_error('nama_fasilitas') ?> <br>
                                            </td>
                                            <td>
                                                <input class="form-control" name="harga_fasilitas[]" placeholder="Harga">
                                                <?php echo form_error('harga_fasilitas') ?>
                                            </td>
                                            <td>
                                                <button type="button" name="add" id="add" class="btn btn-primary">Tambah</button>
                                            </td>
                                        </tr>
                                    </tr>
                                </table>
                            </div>  

<!-------------------------------------------------------------------------------------------------------------------------------------->
<script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"> <td><input type="text" class="form-control" name="nama_fasilitas[]" placeholder="Nama Fasilitas"></td><td><input class="form-control" name="harga_fasilitas[]" placeholder="Harga"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });  
 </script>
<!-------------------------------------------------------------------------------------------------------------------------------------->                            <input type="hidden" name="id_wisata" value="<?php echo $id_wisata; ?>" /> 
                    	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    	    <a href="<?php echo site_url('wisata') ?>" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('lib/footer')?>
        <?php $this->load->view('lib/mapwilayahvalid')?>
    </body>
</html>
<script type="text/javascript">
    $('#id-input-file-3').ace_file_input({
        style: 'well',
        btn_choose: 'Drop files here or click to choose',
        btn_change: null,
        no_icon: 'ace-icon fa fa-cloud-upload',
        droppable: true,
        thumbnail: 'small'
        //large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
            //Check an example below
            //or examples/file-upload.html
            return true;
        }*/
        /**,before_remove : function() {
            return true;
        }*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
        }

    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
    function tampilkanPreview(gambar,idpreview){

                var gb = gambar.files;
                

                for (var i = 0; i < gb.length; i++){

                    var gbPreview = gb[i];
                    var imageType = /image.*/;
                    var preview=document.getElementById(idpreview);            
                    var reader = new FileReader();
                    
                    if (gbPreview.type.match(imageType)) {

                        preview.file = gbPreview;
                        reader.onload = (function(element) { 
                            return function(e) { 
                                element.src = e.target.result; 
                            }; 
                        })(preview);
 

                        reader.readAsDataURL(gbPreview);
                    }else{

                        alert("Type file tidak sesuai. Khusus image.");
                    }
                   
                }    
            }
$("#id_kec").chained("#id_kota"); // disini kita hubungkan kota dengan provinsi
$("#id_kel").chained("#id_kec"); // disini kita hubungkan kecamatan dengan kota
</script>