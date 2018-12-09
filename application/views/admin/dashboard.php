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
                        </ul><!-- /.breadcrumb -->
                    </div>
                    <div class="page-header">
                        <h1>Dashboard</h1>  
                    </div><!-- /.page-header -->
                    <div class="container">
<!---------------------------------------------------------------------------------------------------------------------------------- -->
<!---------------------------------------------------------------------------------------------------------------------------------- -->
                       <div class="col-md-4 text-center">
                            <div style="margin-top: 8px" id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="row col-xs-12">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="row">
                                    <div class="space-6"></div>
                                    <div class="col-sm-12 infobox-container">
                                        <h2>Data Wisata</h2>

                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="ace-icon fa fa-comments"></i>
                                            </div>

                                            <div class="infobox-data">
                                                <span class="infobox-data-number"><?php echo $Wisata_kab; ?></span>
                                                <div class="infobox-content">Kabupaten Bandung</div>
                                            </div>

                                            <!-- <div class="stat stat-success">8%</div> -->
                                        </div>

                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="ace-icon fa fa-comments"></i>
                                            </div>

                                            <div class="infobox-data">
                                                <span class="infobox-data-number"><?php echo $Wisata_barat; ?></span>
                                                <div class="infobox-content">Kab Bandung Barat</div>
                                            </div>

                                            <!-- <div class="stat stat-success">8%</div> -->
                                        </div>

                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="ace-icon fa fa-comments"></i>
                                            </div>

                                            <div class="infobox-data">
                                                <span class="infobox-data-number"><?php echo $Wisata_bandung; ?></span>
                                                <div class="infobox-content">Kota Bandung</div>
                                            </div>

                                            <!-- <div class="stat stat-success">8%</div> -->
                                        </div>

                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="ace-icon fa fa-comments"></i>
                                            </div>

                                            <div class="infobox-data">
                                                <span class="infobox-data-number"><?php echo $Wisata_cimahi; ?></span>
                                                <div class="infobox-content">Kota Cimahi</div>
                                            </div>

                                            <!-- <div class="stat stat-success">8%</div> -->
                                        </div>
                                        <div class="space-6"></div>
                                        
                                        <h2>Data Pemilik</h2>
                                        
                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="ace-icon fa fa-comments"></i>
                                            </div>

                                            <div class="infobox-data">
                                                <span class="infobox-data-number"><?php echo $Pemilik_total_reg; ?></span>
                                                <div class="infobox-content">Sudah Aktivasi</div>
                                            </div>

                                            <!-- <div class="stat stat-success">8%</div> -->
                                        </div>

                                        <div class="infobox infobox-green">
                                            <div class="infobox-icon">
                                                <i class="ace-icon fa fa-comments"></i>
                                            </div>

                                            <div class="infobox-data">
                                                <span class="infobox-data-number"><?php echo $Pemilik_total_nreg; ?></span>
                                                <div class="infobox-content">Belum Aktivasi</div>
                                            </div>

                                            <!-- <div class="stat stat-success">8%</div> -->
                                        </div>

                                        


                                </div><!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="<?php echo base_url('assets/template/back')?>/js/jquery-ui.custom.min.js"></script>
            <script src="<?php echo base_url('assets/template/back')?>/js/jquery.ui.touch-punch.min.js"></script>
            <script src="<?php echo base_url('assets/template/back')?>/js/jquery.easypiechart.min.js"></script>
            <script src="<?php echo base_url('assets/template/back')?>/js/jquery.sparkline.index.min.js"></script>
            <script src="<?php echo base_url('assets/template/back')?>/js/jquery.flot.min.js"></script>
            <script src="<?php echo base_url('assets/template/back')?>/js/jquery.flot.pie.min.js"></script>
            <script src="<?php echo base_url('assets/template/back')?>/js/jquery.flot.resize.min.js"></script>
            <script type="text/javascript">
            jQuery(function($) {
                $('.easy-pie-chart.percentage').each(function(){
                    var $box = $(this).closest('.infobox');
                    var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                    var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                    var size = parseInt($(this).data('size')) || 50;
                    $(this).easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: parseInt(size/10),
                        animate: ace.vars['old_ie'] ? false : 1000,
                        size: size
                    });
                })
            
                $('.sparkline').each(function(){
                    var $box = $(this).closest('.infobox');
                    var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                    $(this).sparkline('html',
                                     {
                                        tagValuesAttribute:'data-values',
                                        type: 'bar',
                                        barColor: barColor ,
                                        chartRangeMin:$(this).data('min') || 0
                                     });
                });
            
            
              //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
              //but sometimes it brings up errors with normal resize event handlers
              $.resize.throttleWindow = false;
            
             
            
            })
        </script>
        <?php $this->load->view('lib/footer')?>
    </body> 
</html>
