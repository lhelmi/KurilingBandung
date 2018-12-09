<?php
	
	$this->load->model('Wisata_model');

	if ($this->session->userdata('is_admin')!==FALSE) {
		if ($this->session->userdata('level')=='0') { ?>

		<script src="<?php echo base_url('assets/template/back')?>/js/mapwilayah.js"></script>

<?php
	}elseif ($this->session->userdata('level')=='1') {
		if ($this->session->userdata('NIP')=='10116270') { ?>
			<script src="<?php echo base_url('assets/template/back')?>/js/mapkabbandung.js"></script>
<?php
		}elseif($this->session->userdata('NIP')=='10116271'){ ?>
			<script src="<?php echo base_url('assets/template/back')?>/js/mapbandungbarat.js"></script>		
<?php
		}elseif($this->session->userdata('NIP')=='10116272'){ ?>
			<script src="<?php echo base_url('assets/template/back')?>/js/mapkotabandung.js"></script>		
<?php
		}elseif($this->session->userdata('NIP')=='10116273'){ ?>
			<script src="<?php echo base_url('assets/template/back')?>/js/mapcimahi.js"></script>		
<?php
		}
	}

	}else{ ?>
	<script src="<?php echo base_url('assets/template/back')?>/js/mapwilayah.js"></script>
<?php
	}

?>