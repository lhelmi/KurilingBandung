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
                            <li>
                                <a href="#">Admin</a>
                            </li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Form<small><i class="ace-icon fa fa-angle-double-right"></i> Admin</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="form-group">
                                <label for="varchar">Username</label>
                                
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                                <?php echo form_error('username') ?>
                            </div>

                    	    <div class="form-group">
                                <label for="varchar">NIP</label>
                                <input type="text" class="form-control" name="NIP" id="NIP" placeholder="NIP" value="<?php echo $NIP; ?>" onkeypress="return isNumberKey(event)" />
                                <?php echo form_error('NIP') ?>
                            </div>

                            <div class="form-group">
                                <label for="varchar">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                                <?php echo form_error('nama') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="varchar">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password"  />
                                <?php echo form_error('password') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="autosize-transition form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat" style="resize: horizontal; height: 92px;"><?php echo $alamat; ?></textarea>
                                <?php echo form_error('alamat') ?>
                            </div>
                            
                    	    <div class="form-group">
                                <label for="enum">Jenis Kelamin </label>
                                
                                <select name="jk" class="form-control">
                                    <option value="">Pilih</option>
                                    <option <?= $jk=='L' ? $selected='selected' : $selected=''?> value="<?= $jk=='L' ? 'L' : 'L' ?>">Laki-Laki</option>
                                    <option <?= $jk=='P' ? $selected='selected' : $selected=''?> value="<?= $jk=='P' ? 'P' : 'P' ?>">Perempuan</option>
                                </select>
                                <?php echo form_error('jk') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="varchar">Email </label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                                <?php echo form_error('email') ?>
                            </div>
                    	    <div class="form-group">
                                <label for="varchar">No Telp </label>
                                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" onkeypress="return isNumberKey(event)"/>
                                <?php echo form_error('no_telp') ?>
                            </div>
                    	    <input type="hidden" name="level" value="<?php echo $level='1'; ?>" /> 
                    	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    	    <a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a>
                	   </form>
                       
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('lib/footer')?>
    </body>
</html>
<script type="text/javascript">
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>