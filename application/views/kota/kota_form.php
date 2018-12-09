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
                            <li class="active">Kota</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Form<small><i class="ace-icon fa fa-angle-double-right"></i> Kota</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
                        <form action="<?php echo $action; ?>" method="post">
                	    <div class="form-group">
                            <label for="varchar">Nama Kota</label>
                            <input type="text" class="form-control" name="nama_kota" id="nama_kota" placeholder="Nama Kota" value="<?php echo $nama_kota; ?>" />
                            <?php echo form_error('nama_kota') ?>
                        </div>
                	    <div class="form-group">
                            <label for="varchar">NIP</label>
                            <select name="NIP"  class="form-control">
                                <option value="">Pilih</option>
                                <?php foreach ($NIP as $key => $val) {
                                    
                                        if ($val->NIP==$gNIP){ 
                                            $select="selected='true'";
                                        }else{
                                            $select='';
                                        }
                                    ?>
                                        <option value="<?= $val->NIP ?>" <?= $select; ?> ><?php echo $val->nama ?></option>
                                        
                                    <?php } ?>
                            </select>
                            <?php echo form_error('NIP') ?>
                            
                        </div>
                	    <input type="hidden" name="id_kota" value="<?php echo $id_kota; ?>" /> 
                	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                	    <a href="<?php echo site_url('kota') ?>" class="btn btn-default">Cancel</a>
                	</form>
                     </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('lib/footer')?>
    </body>
</html>