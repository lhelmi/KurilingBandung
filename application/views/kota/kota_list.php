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
                            <li class="active">Kota</li>
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Tables<small><i class="ace-icon fa fa-angle-double-right"></i> Data Kota</small></h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                        <div class="row col-md-12">
                            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                        </div>
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="clearfix">
                                    <div class="pull-right tableTools-container"></div>
                                </div>
                                <div class="table-header">
                                    <?php echo anchor(site_url('kota/create'),'Tambah Kota', 'class="white"'); ?>
                                </div>

                                <!-- div.table-responsive -->

                                <!-- div.dataTables_borderWrap -->
                                <div>
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kota</th>
                                                <th>NIP</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($kota_data as $kota){?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $kota->nama_kota ?></td>
                                                <td><?php echo $kota->NIP ?></td>
                                                <td>
                                                    <div class="hidden-sm hidden-xs action-buttons">
                                                    <?php 
                                                        echo anchor(site_url('kota/update/'.$kota->id_kota),'<i class="ace-icon fa fa-pencil bigger-130"></i>', 'class="green"'); 
                                                        echo ' | '; 
                                                        echo anchor(site_url('kota/delete/'.$kota->id_kota),'<i class="ace-icon fa fa-trash-o bigger-130"></i>',' class="red" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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