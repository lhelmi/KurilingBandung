<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Gambar <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Gambar <?php echo form_error('nama_gambar') ?></label>
            <input type="text" class="form-control" name="nama_gambar" id="nama_gambar" placeholder="Nama Gambar" value="<?php echo $nama_gambar; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Wisata <?php echo form_error('id_wisata') ?></label>
            <input type="text" class="form-control" name="id_wisata" id="id_wisata" placeholder="Id Wisata" value="<?php echo $id_wisata; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Is Delete <?php echo form_error('is_delete') ?></label>
            <input type="text" class="form-control" name="is_delete" id="is_delete" placeholder="Is Delete" value="<?php echo $is_delete; ?>" />
        </div>
	    <input type="hidden" name="id_gambar" value="<?php echo $id_gambar; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('gambar') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>