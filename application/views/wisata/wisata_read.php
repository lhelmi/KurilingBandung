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
                            <li class="active">Pemilik Wisata</li>
                        </ul><!-- /.breadcrumb -->
                    </div>

                    <div class="page-header">
                        <h1><?php echo $nama_wisata; ?></h1>  
                    </div><!-- /.page-header -->
                    
                    <div class="container">
                    	<div class="row">
                    		<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div>
									<ul class="ace-thumbnails clearfix">
										 <?php $no=1; foreach ($gambar as $key => $value){ ?>
										 	<?php if ($value->id_wisata==$id_wisata){ ?>
										<li>
											<a href="<?php echo base_url('./upload/wisata/'. $value->nama_gambar);?>" data-rel="colorbox">
												<img width="150" height="150" alt="150x150" src="<?php echo base_url('./upload/wisata/'. $value->nama_gambar);?>" />
												<div class="text">
													<div class="inner">Photo <?php echo $no++; ?></div>
												</div>
											</a>

											<div class="tools tools-right">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>

												</a>

												<!-- <a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a> -->
											</div>
										</li>
										<?php } } ?>
									</ul>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
                        <div class="row col-xs-12">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <br>
                                        <table class="table">
										    <tr><td>Alamat</td><td><?php echo $alamat_wisata; ?></td></tr>
										    <tr><td>Kota</td><td><?php echo $id_kota; ?></td></tr>
										    <tr><td>Kecamatan</td><td><?php echo $id_kec; ?></td></tr>
										    <tr><td>Kelurahan</td><td><?php echo $id_kel; ?></td></tr>
										    <tr><td>Lat</td><td><?php echo $lat; ?></td></tr>
										    <tr><td>Lng</td><td><?php echo $lng; ?></td></tr>
										    <tr><td>NIK</td><td><?php echo $NIK; ?></td></tr>
										    <tr><td>Tiket Dewasa</td><td><?php echo 'Rp '. number_format($tiket_dewasa,2,',','.'); ?></td></tr>
										    <tr><td>Tiket Anak</td><td><?php echo 'Rp '. number_format($tiket_anak,2,',','.'); ?></td></tr>
										</table>
			                            <table class="table table-bordered">
			                                 <tr>
			                                      <th width="50%">Nama Fasilitas</th>
			                                      <th width="50%">Harga</th>
			                                 </tr>
			                                <?php foreach ($fasilitas as $key => $val) {
			                                    if ($val->id_wisata==$id_wisata){ ?>
			                                 <tr>
			                                    <td style="padding-left: 10%">
			                                    	<?php echo $val->nama_fasilitas; ?>
			                                    </td>
			                                    <td align="right">
			                                        <?php echo 'Rp '. number_format($val->harga_fasilitas,2,',','.'); ?>
			                                    </td>
			                                   </tr>
			                                <?php } } ?>
                                		</table>
                                		<a href="<?php echo site_url('wisata') ?>" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php $this->load->view('lib/footer')?>

    </body> 
</html>
<script type="text/javascript">
			jQuery(function($) {
	var $overflow = '';
	var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
	
	
	$(document).one('ajaxloadstart.page', function(e) {
		$('#colorbox, #cboxOverlay').remove();
   });
})
</script>
