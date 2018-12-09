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
        <h2 style="margin-top:0px">Fasilitas <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Nama Fasilitas <?php echo form_error('nama_fasilitas') ?></label>
            <input type="text" class="form-control" name="nama_fasilitas" id="nama_fasilitas" placeholder="Nama Fasilitas" value="<?php echo $nama_fasilitas; ?>" />
        </div>


	    <div class="form-group">
            <label for="int">Harga Fasilitas <?php echo form_error('harga_fasilitas') ?></label>
            <input type="text" class="form-control" name="harga_fasilitas" id="harga_fasilitas" placeholder="Harga Fasilitas" value="<?php echo $harga_fasilitas; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Wisata <?php echo form_error('id_wisata') ?></label>
            <input type="text" class="form-control" name="id_wisata" id="id_wisata" placeholder="Id Wisata" value="<?php echo $id_wisata; ?>" />
        </div>
	    <input type="hidden" name="id_fasilitas" value="<?php echo $id_fasilitas; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('fasilitas') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>