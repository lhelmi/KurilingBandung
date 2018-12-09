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
                            <li class="active">Kecamatan</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Form<small><i class="ace-icon fa fa-angle-double-right"></i> Kecamatan</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
                        <form action="<?php echo $action; ?>" method="post">
                            
                            <?php if ($this->session->userdata('level')=='1') { ?>

                                <select class="form-control" name="id_kota" id="id_kota" style='display:none'>
                                    <?php foreach ($id_kota as $kota) {?>
                                        <option <?php echo $gid_kota == $kota->id_kota ? 'selected="selected"' : '' ?> 
                                            value="<?php echo $kota->id_kota ?>"><?php echo $kota->nama_kota ?></option>
                                    <?php } ?>
                                </select>

                            <?php }elseif ($this->session->userdata('level')=='0') { ?>

                            
                            <div class="form-group">
                                <label>Nama Kota</label>
                                <select class="form-control" name="id_kota" id="id_kota" >
                                    <option value="">Please Select</option>    
                                <?php foreach ($id_kota as $kota) {?>
                                    <option <?php echo $gid_kota == $kota->id_kota ? 'selected="selected"' : '' ?> value="<?php echo $kota->id_kota ?>"><?php echo $kota->nama_kota ?></option>
                                <?php } ?>
                                </select>
                                <?php echo form_error('id_kota') ?> 
                            </div>
                                
                            <?php } ?>

                    	    <div class="form-group">
                                <label for="varchar">Nama Kecamatan </label>
                                <input type="text" class="form-control" name="nama_kec" id="nama_kec" placeholder="Nama Kec" value="<?php echo $nama_kec; ?>" />
                                <?php echo form_error('nama_kec') ?>
                            </div>
                        
                            <input type="hidden" name="id_kec" value="<?php echo $id_kec; ?>" /> 
                            <input type="hidden" name="is_delete" value="0"/> 
                            

                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    	    <a href="<?php echo site_url('kecamatan') ?>" class="btn btn-default">Cancel</a>
                    	</form>
                     </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('lib/footer')?>
    </body>
</html>