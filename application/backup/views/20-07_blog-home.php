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
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/front/')?>css/bootstrap.min.css"> -->
</head>
<body>
<header id="header">
<div class="header-top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-6 col-6 header-top-left">
                <div class="header-social">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-6 header-top-right">
                <ul>
                    <li>
                        <a href="<?php echo site_url('Kurilingbandung/login') ?>" >Masuk</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Kurilingbandung/daftar') ?>">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container main-menu">
    <div class="row align-items-center justify-content-between d-flex">
        <div id="logo">
            <a href="<?php echo site_url('Kurilingbandung') ?>"><img src="<?php echo base_url('assets/front/')?>img/logo3.png" alt="" title=""/></a>
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
        </nav>
        <!-- #nav-menu-container --></div>
</div>
</header>
<!-- #header -->
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
                            <input type="text" name="q" placeholder="Ketik nama destinasi" class="form-control" style="opacity:0.6;color:black;">
                        <button type="submit" class="primary-btn text-uppercase text-center col-lg-6 col-md-6 col-sm-6 col-xs-3 aduh" align="center">
                        <i class="fa fa-search fa-1x" aria-hidden="true" style="padding-top:5px;"></i> Cari Sekarang </button></div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</section>
<!-- End banner Area -->
<!-- Start about-info Area -->
<!-- Start post-content Area -->
            <section class="post-content-area single-post-area col-lg-12">
                <div class="container">
                <div class="col-lg-10 offset-1">
                    <div class="row">
                        <div class="col-lg-7 posts-list vv"  >
                            <?php foreach ($wisata_data as $wisata){?>
                            <div class="single-post row">
                                <div class="col-lg-12 col-md-12 ">
                                    <div class="feature-img">
                                        <img class="img-fluid" src="<?php echo base_url('upload/wisata/')?><?php echo $wisata->nama_gambar; ?>" alt="">
                                    </div>
                                    <a class="posts-title" href="blog-single.html"><h3><?php echo $wisata->nama_wisata; ?></h3></a>
                                    <?php $string = strip_tags($wisata->alamat_wisata);

                                        if (strlen($string) > 50) {

                                            // truncate string
                                            $stringCut = substr($string, 0, 40);
                                            $endPoint = strrpos($stringCut, ' ');

                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                                            $string .= ' ...';
                                        }?>
                                    <span class="excert2"><i class="fa fa-map-marker fa-1x "></i> Alamat:  <?php echo $string;?></span>
                    
                                    <p class="excert2">
                                        
                                        <?php echo $wisata->deskripsi; ?>
                                        <!-- MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction. -->
                                    </p>
                                    <!-- <a href="blog-single.html"  style="">Detail</a> -->
                                    <?php echo anchor(site_url('Kurilingbandung/blog_single/'.$wisata->id_wisata),'Detail', 'class="btn btn-default btn-md btn-detail3"');  ?>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a href="#" class="page-link" aria-label="Previous">
                                            <span aria-hidden="true">
                                                <span class="lnr lnr-chevron-left"></span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a href="#" class="page-link">01</a></li>
                                    <li class="page-item"><a href="#" class="page-link">02</a></li>
                                    <li class="page-item"><a href="#" class="page-link">03</a></li>
                                    <li class="page-item"><a href="#" class="page-link">04</a></li>
                                    <li class="page-item"><a href="#" class="page-link">09</a></li>
                                    <li class="page-item">
                                        <a href="#" class="page-link" aria-label="Next">
                                            <span aria-hidden="true">
                                                <span class="lnr lnr-chevron-right"></span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </nav> -->

                            <?php echo $pagination ?>
                                            

                        </div>

                        <div class="col-lg-5 sidebar-widgets zz " >
                            <div class="widget-wrap col-lg-12 ">
                                <div class="single-sidebar-widget popular-post-widget ">
                                    <h5 class="popular-title">Destinasi Populer</h5>
                                    <div class="popular-post-list">

                                        <div class="single-post-list d-flex flex-row align-items-center">
                                            <div class="thumb">
                                                <img class="img-fluid" src="<?php echo base_url('assets/front/')?>img/blog/pp1.jpg" alt="">
                                            </div>
                                            <div class="details">
                                                <a href="blog-single.html"><h6>Space The Final Frontier</h6></a>
                                            </div>
                                        </div>
                                        <div class="single-post-list d-flex flex-row align-items-center">
                                            <div class="thumb">
                                                <img class="img-fluid" src="<?php echo base_url('assets/front/')?>img/blog/pp2.jpg" alt="">
                                            </div>
                                            <div class="details">
                                                <a href="blog-single.html"><h6>The Amazing Hubble</h6></a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>  
            </section>
            <!-- End post-content Area -->
<!-- End about-info Area -->
<!-- Start price Area -->
<!-- End price Area -->
<!-- Start other-issue Area -->
<!-- End other-issue Area -->
<!-- Start testimonial Area -->
<!-- End testimonial Area -->
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
             All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
    </div>
</div>
</footer>
<!-- End footer Area -->
<script src="<?php echo base_url('assets/front/')?>js/vendor/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url('assets/front/')?>js/popper.min.js"></script>
<script src="<?php echo base_url('assets/front/')?>js/vendor/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
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
</body>
</html>