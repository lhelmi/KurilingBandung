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
        <h2 style="margin-top:0px">Kecamatan Read</h2>
        <table class="table">
	    <tr><td>Id Kota</td><td><?php echo $id_kota; ?></td></tr>
	    <tr><td>Nama Kec</td><td><?php echo $nama_kec; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kecamatan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>