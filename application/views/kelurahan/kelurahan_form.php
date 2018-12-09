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
                            <li class="active">Kelurahan</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Form<small><i class="ace-icon fa fa-angle-double-right"></i> Kelurahan</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
                        <form action="<?php echo $action; ?>" method="post">
                            
                            <div class="form-group">
                                <label>Nama Kota</label>
                                    <select class="form-control" name="id_kota" id="id_kota">
                                        <?php if ($this->session->userdata('level')=='0') { ?>
                                            <option value="">Please Select</option>
                                        <?php } ?>
                                        <?php foreach ($id_kota as $kota) { ?>
                                        <option <?php echo $gid_kota == $kota->id_kota ? 'selected="selected"' : '' ?> 
                                            value="<?php echo $kota->id_kota ?>"><?php echo $kota->nama_kota ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('id_kota') ?>
                            </div>
                            <div class="form-group">
                                <label for="int">Nama Kecamatan</label>
                                <select class="form-control" name="id_kec" id="id_kec">
                                    <option value="">Please Select</option>
                                        <?php foreach ($id_kec as $kec) { ?>
                                            <option <?php echo $gid_kec == $kec->id_kec ? 'selected="selected"' : '' ?> class="<?php echo $kec->id_kota ?>" value="<?php echo $kec->id_kec ?>"><?php echo $kec->nama_kec ?></option>
                                        <?php } ?>
                                </select>
                                <?php echo form_error('id_kec') ?>
                            </div>

                	       <div class="form-group">
                                <label for="varchar">Nama Kelurahan </label>
                                <input type="text" class="form-control" name="nama_kel" id="nama_kel" placeholder="Nama Kel" value="<?php echo $nama_kel; ?>" />
                                <?php echo form_error('nama_kel') ?>
                            </div>
                           
                    	    <input type="hidden" name="id_kel" value="<?php echo $id_kel; ?>" /> 
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    	    <a href="<?php echo site_url('kelurahan') ?>" class="btn btn-default">Cancel</a>
	                   </form>
                     </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('lib/footer')?>
    </body>
</html>
<script>
    $("#id_kec").chained("#id_kota"); // disini kita hubungkan kota dengan provinsi
            
</script>