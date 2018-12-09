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
        <h2 style="margin-top:0px">Gambar Read</h2>
        <table class="table">
	    <tr><td>Nama Gambar</td><td><?php echo $nama_gambar; ?></td></tr>
	    <tr><td>Id Wisata</td><td><?php echo $id_wisata; ?></td></tr>
	    <tr><td>Is Delete</td><td><?php echo $is_delete; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('gambar') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>