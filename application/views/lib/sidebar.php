<div id="sidebar" class="sidebar responsive ace-save-state">
	<script type="text/javascript">
		try{ace.settings.loadState('sidebar')}catch(e){}
	</script>

	

	<ul class="nav nav-list">
		<?php if ($this->session->userdata('is_admin')!==FALSE) {?>
		<li class="<?php echo $this->uri->segment(1)==='dashboard' ? 'active' : '' ; ?>">
			<a href="<?php echo site_url('dashboard')?>">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Dashboard </span>
			</a>
			<b class="arrow"></b>
		</li>
		
		<?php if ($this->session->userdata('level')=='0') { ?>
		<li class="<?php echo $this->uri->segment(1)==='admin' ? 'active' : '' ; ?>">
			<a href="<?php echo site_url('admin')?>">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text"> Admin </span>
			</a>
			<b class="arrow"></b>
		</li>
		

		<li class="<?php echo $this->uri->segment(1)==='kota' ? 'active' : '' ; ?>">
			<a href="<?php echo site_url('kota')?>">
				<i class="menu-icon fa fa-table"></i>
				<span class="menu-text"> Kota </span>
			</a>
			<b class="arrow"></b>
		</li>
		<?php } ?>
		<li class="<?php echo $this->uri->segment(1)==='kecamatan' ? 'active' : '' ; ?>">
			<a href="<?php echo site_url('kecamatan')?>">
				<i class="menu-icon fa fa-table"></i>
				<span class="menu-text">Kecamatan</span>
			</a>
			<b class="arrow"></b>
		</li>

		<li class="<?php echo $this->uri->segment(1)==='kelurahan' ? 'active' : '' ; ?>">
			<a href="<?php echo site_url('kelurahan')?>">
				<i class="menu-icon fa fa-table"></i>
				<span class="menu-text">Kelurahan</span>
			</a>
			<b class="arrow"></b>
		</li>
		
		<li class="<?php echo $this->uri->segment(1)==='pemilik' ? 'active' : '' ; ?>">
			<a href="<?php echo site_url('pemilik')?>">
				<i class="menu-icon fa fa-users"></i>
				<span class="menu-text">Pemilik Wisata</span>
			</a>
			<b class="arrow"></b>
		</li>
		<?php } ?>

		<?php if ($this->session->userdata('is_admin')==false) { ?>
			<li class="<?php echo $this->uri->segment(1)==='wisata' ? 'active' : '' ; ?>">
				<a href="<?php echo site_url('Kurilingbandung')?>">
					<i class="menu-icon fa fa-plane"></i>
					<span class="menu-text">Tempat Wisata</span>
				</a>
				<b class="arrow"></b>
			</li>
		<?php }else{ ?>
			<li class="<?php echo $this->uri->segment(1)==='wisata' ? 'active' : '' ; ?>">
				<a href="<?php echo site_url('wisata')?>">
					<i class="menu-icon fa fa-plane"></i>
					<span class="menu-text">Tempat Wisata</span>
				</a>
				<b class="arrow"></b>
			</li>
		<?php } ?>

	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
	<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>