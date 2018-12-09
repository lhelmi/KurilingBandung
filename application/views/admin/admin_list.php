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
                        
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                        <!-- <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-xs-12">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                <div class="clearfix">
                                    <div class="pull-right tableTools-container"></div>
                                </div>
                                <div class="table-header">
                                    <?php echo anchor(site_url('admin/create'),'Tambah Admin', 'class="white"'); ?>
                                </div>

                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Alamat</th>
                                                <th>Jk</th>
                                                <th>Email</th>
                                                <th>No Telp</th>
                                                <th>Level</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no=1; foreach ($admin_data as $admin){ ?>
                                            <tr>
                                                <td class="center"><?php echo $no++ ?></td>
                                                <td><?php echo $admin->nama ?></td>
                                                <td><?php echo $admin->username ?></td>
                                                <td class="hidden-480"><?php echo $admin->alamat ?></td>
                                                <td><?php echo $admin->jk ?></td>
                                                <td class="hidden-480"><?php echo $admin->email ?></td>
                                                <td><?php echo $admin->no_telp ?></td>
                                                <td><?php echo $admin->level=='0' ? 'Super Admin' : 'Admin' ?></td>
                                                <td align="center">
                                                    <div class="hidden-sm hidden-xs action-buttons">
                                                        <?php
                                                            // echo anchor(site_url('admin/update/'.$admin->NIP),'<i class="ace-icon fa fa-pencil bigger-130"></i>', 'class="green"'); 
                                                            // echo ' | '; 
                                                            echo anchor(site_url('admin/delete/'.$admin->NIP),'<i class="ace-icon fa fa-trash-o bigger-130"></i>',' class="red" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                                        ?>
                                                        <!-- <a class="green" href="#">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                        </a> -->

                                                        <!-- <a class="red" href="#">
                                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                        </a> -->
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