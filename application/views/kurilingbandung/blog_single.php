<!DOCTYPE html>
    <html lang="zxx" class="no-js">
    <head>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="shortcut icon" href="img/fav.png">
        <!-- Author Meta -->
        <meta name="author" content="colorlib">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <title>Travel</title>
        <style type="text/css">
            #map {
        height: 400px;
        width: 450px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
        </style>

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
            <!--
            CSS
            ============================================= -->
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/linearicons.css">
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/font-awesome.min.css">
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/bootstrap.css">
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/magnific-popup.css">
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/jquery-ui.css">                
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/nice-select.css">                          
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/animate.min.css">
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/owl.carousel.css">             
            <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/main.css">
    </head>
    <body>  
        <header id="header">
            <div class="header-top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-6 col-6 header-top-left">
                            <div class="header-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>          
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 header-top-right">
                            <ul><?php if ($this->session->userdata('logged')) { ?>
                                    <li>
                                        <a href="<?php echo site_url('Wisata') ?>" >Owner</a>
                                    </li>
                                <?php }else{ ?>
                                    <li>
                                        <a href="<?php echo site_url('Kurilingbandung/login') ?>" >Masuk</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('Kurilingbandung/daftar') ?>">Daftar</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>                              
                </div>
            </div>
            <div class="container main-menu">
                <div class="row align-items-center justify-content-between d-flex">
                  <div id="logo">
                    <a href="<?php echo site_url('Kurilingbandung') ?>"><img src="<?php echo base_url('assets/front/')?>img/logo3.png" alt="" title="" /></a>
                  </div>
                  <nav id="nav-menu-container">
                   <ul class="nav-menu">
                        <li>
                            <a href="<?php echo site_url('Kurilingbandung') ?>">Beranda</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('Kurilingbandung/about') ?>">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('Kurilingbandung/contact') ?>">Kontak</a>
                        </li>
                    </ul>
                  </nav><!-- #nav-menu-container -->                                  
                </div>
            </div>
        </header><!-- #header -->

        <!-- start banner Area -->
        <section class="relative about-banner">
            <div class="overlay overlay-bg"></div>
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="about-content col-lg-8">
                        <p class="text-white text-center">
                             Cari destinasi wisata di Bandung yang seru dengan cepat dan mudah di sini !<br>Temukan Destinasi terbaik yang anda inginkan.</p>
                        <form class="text-center" action="<?php echo site_url('Kurilingbandung/blog_home'); ?>">
                           <div class="form-group text-center cari ">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6 text-center">
                                        <input type="text" name="q" placeholder="Ketik nama destinasi / pilih Kota, Kabupaten dan Kecamatan" class="form-control" style="opacity:0.7;color:black;">
                                        <br>
                                        <div class="row filter col-10 offset-1" >
                                            <div class="col-lg-4 re">
                                                <select class="form-control  filterdaerah" name="qkot" id="id_kota">
                                                    <option value="">Kota</option>
                                                       <?php foreach ($id_kota as $kota) { ?>
                                                            <option <?php echo $gid_kota == $kota->id_kota ? 'selected="selected"' : '' ?> value="<?php echo $kota->id_kota ?>"><?php echo $kota->nama_kota ?></option>
                                                        <?php } ?>
                                                </select>

                                            </div>

                                            <div class="col-lg-4 re">
                                                <select class="form-control filterdaerah" name="qkec" id="id_kec">
                                                    <option value="">Kecamatan</option>
                                                        <?php foreach ($id_kec as $kec) { ?>
                                                            <!--di sini kita tambahkan class berisi id provinsi-->
                                                            <option <?php echo $gid_kec == $kec->id_kec ? 'selected="selected"' : '' ?> class="<?php echo $kec->id_kota ?>" value="<?php echo $kec->id_kec ?>"><?php echo $kec->nama_kec ?></option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 re">
                                                <select class="form-control filterdaerah" name="qkel" id="id_kel">
                                                    <option value="">Kelurahan</option>
                                                        <?php foreach ($id_kel as $kel) { ?>
                                                            <!--di sini kita tambahkan class berisi id kota-->
                                                            <option <?php echo $gid_kel == $kel->id_kel ? 'selected="selected"' : '' ?> class="<?php echo $kel->id_kec ?>" value="<?php echo $kel->id_kel ?>"><?php echo $kel->nama_kel ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="primary-btn text-uppercase text-center col-lg-6 col-md-6 col-sm-6 col-xs-3 aduh" align="center"><i class="fa fa-search fa-1x" aria-hidden="true" style="padding-top:5px;"></i> Cari Sekarang</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <!-- End banner Area -->
    <!-- Start post-content Area -->
    <section class="post-content-area single-post-area">
        <div class="container">
        	<div class="row">
        		<div class="col-lg-7 posts-list">
        			<div class="single-post2 row">
        				<div class="col-lg-12">
        					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          			           	<div class="carousel-inner">
                                  	<?php $i=0; foreach ($gambar as $key => $value): ?>
                                		<?php if ($value->id_wisata==$id_wisata){ ?>
                                			<?php $i++; ?>
                                			<div class="<?php echo $i == '1' ? 'carousel-item active' : 'carousel-item' ?>">
                                		      <img class="d-block w-100" src="<?php echo base_url('upload/wisata/')?><?php echo $value->nama_gambar; ?>" alt="Photo ke <?= $i ?>">
                                		    </div>
                                    	<?php } ?>
                                	<?php endforeach ?>
                                    <ol class="carousel-indicators">
                                        <?php for ($x=0; $x < $i ; $x++) {  ?>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $x ?>" class="<?php echo $x == '0' ? 'active' : '' ?>"></li>
                                        <?php } ?>
                                    </ol>
                                </div>
                                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" style="padding-bottom:30px;">
    				        <div class="row">
                                <div class="col-lg-8 ">
            					   <h3 class="mt-25 mb-20  title"><?php echo $nama_wisata; ?></h3>
            					   <span class="mt-20 mb-20"><i class="fa fa-map-marker fa-1x" style="padding-right:5px"></i>  <?php echo $alamat_wisata; ?></span>
            					   <!--<h5 class="mt-20 mb-20"><i class="fa fa-clock-o fa-1x"></i>Jam Buka/Tutup:12.00-14.00</h3>-->
            					</div>
    					   </div>
                            <p class="excert text-justify">
    						  <?php echo $deskripsi; ?>
    					    </p>

                            <div class="text-left">
                                <h6>Harga Tiket</h6>
                                <table style="margin-top:10px">
                                    <tr>
                                        <td>Dewasa</td>
                                        <td width="20px"></td>
                                        <td>Rp. <?= $tiket_dewasa  ?>/ Org</td>
                                    </tr>

                                    <tr>
                                        <td>Anak</td>
                                        <td></td>
                                        <td>Rp. <?= $tiket_anak ?>/ Org</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div class="col-lg-12">
                            					<table class="table table-bordered" >
                              <thead class="tabelhead">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Nama Fasilitas</th>
                                  <th scope="col">Harga</th>
                                </tr>
                              </thead>
                              <tbody>
                              	<?php $no=1; foreach ($fasilitas as $key => $val) { ?>
                              		<?php if ($val->id_wisata==$id_wisata){ ?>
                                        <?php if ($val->nama_fasilitas == '' and $val->harga_fasilitas == '0') { ?>
                                            <td colspan="3" align="center">Wisata ini Belum Ada Fasilitas</td>
                                        <?php }else{ ?>
                                        <tr>
                                          <th scope="row"><?= $val->nama_fasilitas == '' ? '' : $no++ ?></th>
                                          <td><?= $val->nama_fasilitas == '' ? '' : $val->nama_fasilitas; ?></td>
                                          <td><?= $val->harga_fasilitas == '0' ? '': $val->harga_fasilitas; ?></td>
                                        </tr>    
                                        <?php } ?>
                            		    
                            		<?php } ?>
                            	<?php } ?>
                              </tbody>
                            </table>
                            </div>
    				    </div>
                    </div>
                </div>
                <div class="col-lg-4 sidebar-widgets">
                    <div id="map"></div>
                        <div class="widget-wrap col-lg-12 ">
                            <div class="single-sidebar-widget popular-post-widget ">
                                <h5 class="popular-title">Destinasi Populer</h5>
                                <div class="popular-post-list">
                                    <?php foreach ($Kurilingbandung_data as $populer){?>
                                    <div class="single-post-list d-flex flex-row align-items-center"><!--benerin single -->
                                        <div class="col-5">
                                            <div class="thumb">
                                                <img class="img-fluid" src="<?php echo base_url('upload/wisata/')?><?php echo $populer->nama_gambar; ?>" alt="">
                                            </div>
                                        </div>

                                        <div class="details">
                                            <h6>
                                            <?php echo anchor(site_url('Kurilingbandung/blog_single/'.$populer->id_wisata),$populer->nama_wisata);  ?></h6>
                                            <i class="fa fa-map-marker fa-1x alt"></i><span><?php echo $populer->alamat; ?></span>
                                        </div>

                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
    	       </div>
        </div>
    </section>
<!-- End post-content Area -->
<!-- start footer Area -->
        <footer class="footer-area section-gap">
        <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Tentang Kami</h6>
                    <p>
                         Kurilingbandung adalah perusahaan teknologi terkemuka di Indonesia yang menyediakan layanan pencarian destinasi wisata sekitaran daerah Bandung.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Link Navigasi</h6>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="<?php echo site_url('Kurilingbandung') ?>">Beranda</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('Kurilingbandung/about') ?>">Tentang Kami</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('Kurilingbandung/contact') ?>">Kontak</a>
                                </li>
                            </ul>
                        </div>
                        <!--<div class="col">
                            <ul>
                                <li>
                                    <a href="#">Team</a>
                                </li>
                                <li>
                                    <a href="#">Pricing</a>
                                </li>
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Follow</h6>
                    <div class="row">
                        <div class="col medsos">
                            <ul>
                                <li>
                                    <i class="fa fa-twitter"></i><a href="#">Twitter</a>
                                </li>
                                <li>
                                    <i class="fa fa-facebook"></i><a href="#">Facebook</a>
                                </li>
                                <li>
                                    <i class="fa fa-instagram"></i><a href="#">Instagram</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--
                    <div id="mc_embed_signup">
                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscription relative">
                            <div class="input-group d-flex flex-row">
                                <input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
                                <button class="btn bb-btn"><span class="lnr lnr-location"></span></button>
                            </div>
                            <div class="mt-10 info"></div>
                        </form>
                    </div>-->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget mail-chimp">
                    <h6 class="mb-20">Galeri</h6>
                    <ul class="instafeed d-flex flex-wrap">
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i1.jpg" alt="">
                        </li>
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i2.jpg" alt="">
                        </li>
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i3.jpg" alt="">
                        </li>
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i4.jpg" alt="">
                        </li>
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i5.jpg" alt="">
                        </li>
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i6.jpg" alt="">
                        </li>
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i7.jpg" alt="">
                        </li>
                        <li>
                            <img src="<?php echo base_url('assets/front/')?>img/i8.jpg" alt="">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between align-items-center">
            <p class="col-lg-8 col-sm-12 footer-text m-0">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 Copyright &copy;
                <script>document.write(new Date().getFullYear());</script>
                 All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i>  by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            
        </div>
        </div>
        </footer>
        <!-- End footer Area -->
        <script src="<?php echo base_url('assets/front/')?>js/vendor/jquery-2.2.4.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/popper.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/vendor/bootstrap.min.js"></script>

        <script src="<?php echo base_url('assets/front/')?>js/jquery-ui.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/easing.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/hoverIntent.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/superfish.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/jquery.ajaxchimp.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/jquery.nice-select.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/mail-script.js"></script>
        <script src="<?php echo base_url('assets/front/')?>js/main.js"></script>
        <script src="<?php echo base_url('assets/template/back')?>/js/jquery.chained.min.js"></script>
        <script type="text/javascript">
                $("#id_kec").chained("#id_kota"); // disini kita hubungkan kota dengan provinsi
                $("#id_kel").chained("#id_kec"); // disini kita hubungkan kecamatan dengan kota
            </script>
        <script>

          function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 15,
              center: {lat: <?php echo $lat;  ?>, lng: <?php echo $lng; ?>}
            });

            // Create an array of alphabetical characters used to label the markers.
            var labels = [
            	<?php foreach ($clustering as $key => $valueeex) { ?>
            	'<?php echo $valueeex->nama_wisata ?>',
            	<?php } ?>
            ]

            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            var markers = locations.map(function(location, i) {
              return new google.maps.Marker({
                position: location,
                label: labels[i % labels.length]
              });
            });

            // Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
          }
          var locations = [
          <?php foreach ($clustering as $key => $valueee) { ?>
            {lat: <?php echo $valueee->lat; ?>,  lng: <?php echo $valueee->lng; ?>},
        <?php } ?>
          ]
        </script>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
        </script>

        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAW87wcDUt1FFR8Cb8lasBUeh-yqLq9sIg&callback=initMap">
        </script>


</body>
</html>