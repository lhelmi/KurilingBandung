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
                        <h1>Tables<small><i class="ace-icon fa fa-angle-double-right"></i> Data Pemilik Wisata</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">

                        <div class="row">
                            <div class="col-xs-12">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                <div class="clearfix">
                                    <div class="pull-right tableTools-container"></div>
                                </div>
                                <div class="table-header">
                                    <?php echo anchor(site_url('pemilik/create'),'Tambah Pemilik', 'class="white"'); ?> |

                                    <?php
                                        if ($this->uri->segment(2)==='not_active') {
                                            echo anchor(site_url("pemilik/index"),"Pemilik Sudah Aktif", "class='white' ");
                                        }else{
                                            echo anchor(site_url("pemilik/not_active"),"Pemilik Belum Aktif", "class='white' ");
                                        }
                                    ?>
                                </div>

                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Email Pemilik</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($pemilik_data as $pemilik){ ?>
                                                <tr>
                                        			<td width="80px"><?php echo $no++ ?></td>
                                                    <td><?php echo $pemilik->NIK ?></td>
                                        			<td><?php echo $pemilik->nama_pemilik ?></td>
                                        			<td><?php echo $pemilik->jk_pemilik ?></td>
                                        			<td><?php echo $pemilik->email_pemilik ?></td>
                                        			<td align="center">
                                                        <?php
                                                            if ($pemilik->is_Reg == '1') {
                                                                echo anchor(site_url('pemilik/active/'.$pemilik->NIK),$pemilik->is_active == '1' ? '<div class="btn btn-minier btn-white btn-success"><i class="ace-icon fa fa-check-square-o icon-only"></i> Aktif' : '<div class="btn btn-minier btn-white btn-success"><i class="glyphicon glyphicon-remove"></i> Belum Aktif'); 
                                                            }else{

                                                                echo '<button class="btn btn-xs btn-danger">
                                                                    <i class="ace-icon fa fa-times red2"></i>
                                                                        Belum Registrasi
                                                                </button>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="hidden-sm hidden-xs action-buttons">
                                        				<?php 
                                                            
                                                            echo anchor(site_url('pemilik/read/'.$pemilik->NIK),'<i class="ace-icon fa fa-eye bigger-130"></i>', 'class="blue"'); 
                                                            echo ' | '; 
                                            				echo anchor(site_url('pemilik/update/'.$pemilik->NIK),'<i class="ace-icon fa fa-pencil bigger-130"></i>', 'class="green"'); 
                                                            echo ' | '; 
                                                            echo anchor(site_url('pemilik/delete/'.$pemilik->NIK),'<i class="ace-icon fa fa-trash-o bigger-130"></i>',' class="red" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                            				?>
                                            			 </div>
                                                    </td>
                                                </tr>
                                            <?php } ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        <?php $this->load->view('lib/footer')?>
    </div>
</body> 
</html>