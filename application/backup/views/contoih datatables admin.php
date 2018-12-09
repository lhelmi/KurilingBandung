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
                            <li class="active">Admin</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Tables<small><i class="ace-icon fa fa-angle-double-right"></i> Data Admin</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                        <div class="row col-md-6">
                            
                        </div>
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                        <div class="row col-xs-12">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="header smaller lighter blue">
                                            <h3><?php echo anchor(site_url('admin/create'),'Tambah', 'class="btn btn-primary"'); ?></h3>
                                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                        </div>

                                        <div class="clearfix">
                                            <div class="pull-right tableTools-container"></div>
                                        </div>
                                        <div class="table-header">
                                            Results for "Latest Registered Domains"
                                        </div>

                                        <!-- div.table-responsive -->

                                        <!-- div.dataTables_borderWrap -->
                                        <div>
                                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th class="hidden-480">Username</th>

                                                        <th>
                                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                                            Alamat
                                                        </th>
                                                        <th class="hidden-480">Jenis Kelamin</th>
                                                        <th>Email</th>
                                                        <th>No Telp</th>
                                                        <th>Level</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach ($admin_data as $admin){ ?>
                                                    <tr>
                                                        <td width="80px"><?php echo ++$start ?></td>
                                                        <td><?php echo $admin->nama ?></td>
                                                        <td><?php echo $admin->username ?></td>
                                                        <td><?php echo $admin->alamat ?></td>
                                                        <td><?php echo $admin->jk ?></td>
                                                        <td><?php echo $admin->email ?></td>
                                                        <td><?php echo $admin->no_telp ?></td>
                                                        <td><?php echo $admin->level ?></td>

                                                        <td>
                                                            <div class="hidden-sm hidden-xs action-buttons">
                                                                <?php
                                                                    echo anchor(site_url('admin/update/'.$admin->NIP),"<i class='ace-icon fa fa-pencil bigger-130'></i>"); 

                                                                    echo anchor(site_url('admin/delete/'.$admin->NIP),"<i class='ace-icon fa fa-trash-o bigger-130'></i>",'class="red" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
            </div>
        </div>
        
    <?php $this->load->view('lib/footer')?>
    
</body> 
</html>
