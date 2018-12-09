
<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<?php if ($this->session->userdata('is_admin')==FALSE) { ?>
						<a href="<?php echo site_url('wisata') ?>" class="navbar-brand">	
					<?php }else{ ?>
					<a href="<?php echo site_url('dashboard') ?>" class="navbar-brand">
					<?php } ?>
						<small>
							<i class="glyphicon glyphicon-road"></i>
							Kuriling Bandung
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<?php if ($this->session->userdata('is_admin')!==FALSE) { ?>
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important"><?php echo $this->Notif_model->totoal_all_notif(); ?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									<?php echo $this->Notif_model->totoal_all_notif(); ?> Notifications
								</li>
								<?php
									$this->load->model('Notif_model');
									foreach ($this->Notif_model->get_all_notif() as $data) { ?>
								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												<?php echo $data->nama_pemilik; ?>
											</a>
										</li>
									</ul>
								</li>
								<?php } ?>

								<li class="dropdown-footer">
									<a href="<?php echo site_url('Pemilik') ?>">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<?php } ?>
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url('assets/template/back')?>/images/avatars/avatar2.png" alt="Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php
										if ($this->session->userdata('is_admin')!==FALSE) {
											echo $this->session->userdata('username');
										}else{
											echo $this->session->userdata('Nama');
										}
										
									?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<?php
										if ($this->session->userdata('is_admin')!==FALSE) {
											echo anchor(site_url('admin/update/'.$this->session->userdata('NIP')), '<i class="ace-icon fa fa-user"></i> Profile'); 
										}else{
											echo anchor(site_url('pemilik/update/'.$this->session->userdata('username')), '<i class="ace-icon fa fa-user"></i> Profile'); 
										}
										
									?>
								</li>

								<li class="divider"></li>

								<li>
									<?php if ($this->session->userdata('is_admin')!==FALSE) { ?>
											<a href="<?= site_url('auth/adminlogout') ?>">
									<?php }else{ ?>
											<a href="<?= site_url('auth/logout') ?>">
									<?php } ?>
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>