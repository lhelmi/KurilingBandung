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
        <h2 style="margin-top:0px">Kelurahan Read</h2>
        <table class="table">
	    <tr><td>Id Kec</td><td><?php echo $id_kec; ?></td></tr>
	    <tr><td>Nama Kel</td><td><?php echo $nama_kel; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('kelurahan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>