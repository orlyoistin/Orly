<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<? echo URL::base(); ?>assets/templates/logo/logo.png">

    <title>SIKD Kutai Barat</title>

    <!-- Bootstrap core CSS -->
    <link href="<? echo URL::base(); ?>assets/templates/css/bootstrap.min.css" rel="stylesheet">
    <link href="<? echo URL::base(); ?>assets/templates/css/new.css" rel="stylesheet">
    <link href="<? echo URL::base(); ?>assets/templates/css/animate.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <script src="<? echo URL::base(); ?>assets/templates/js/jquery.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/templates/js/bootstrap.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/templates/js/wow.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/templates/js/smooth-scroll.js"></script>
    <script>
      new WOW().init();
      smoothScroll.init();
    </script>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img class="img-responsive" src="<? echo URL::base(); ?>assets/templates/logo/logo.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#beranda" data-scroll>Beranda</a></li>
            <li><a href="#apps" data-scroll>Aplikasi</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="beranda" id="beranda">
      <div class="container marketing">
        <div class="row featurette">
          <div class="col-lg-7 col-sm-12 col-xs-12">
            <h2 class="featurette-heading beranda-title wow fadeInDown">Sistem Informasi Kearsipan Daerah</span></h2>
            <p class="beranda-text wow fadeInDown">SIKD dibangun untuk mendukung Pengelolaan Arsip dalam rangka memberikan informasi yang autentik dan utuh oleh Kabupaten Kutai Barat dalam upaya mendukung Sistem Kearsipan Daerah dan merupakan kelanjutan dari Sistem Kearsipan Nasional</p>
          </div>
        </div>
      </div>
    </div>
   <!--  <div class="aplikasi" id="aplikasi">
      <div class="container marketing">
        <div class="row">
          <div class="col-lg-12 wow bounceInRight">
            <h2 class="head" style="font-size: 40px;">Aplikasi</h2>
          </div>
        </div>
      </div>
    </div> -->
    <div class="apps" id="apps">
      <div class="container marketing">
        <div class="row">
          <div class="col-sm-2 col-md-2"></div>
          <div class="col-sm-4 col-md-4 animate-box wow bounceInLeft animated">
            <div class="thumbnail">
              <img src="<? echo URL::base(); ?>assets/templates/logo/logo.png" alt="...">
              <div class="caption">
                <center><h2><a href="<? echo URL::base()."register/login"; ?>">SKD</a></h2></center>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4 animate-box wow bounceInRight animated">
            <div class="thumbnail">
              <img src="<? echo URL::base(); ?>assets/templates/logo/logo.png" alt="...">
              <div class="caption">
                <center><h2><a href="<? echo URL::base()."statis"; ?>">Arsip Statis</a></h2></center>
              </div>
            </div>
          </div>
          <div class="col-sm-2 col-md-2"></div> 
      </div>
    </div>
    <div class="appss" style="min-height: 150px;padding-top:75px;">
      <div class="container marketing">
        <div class="row">
          <div class="col-md-12 wow fadeInDown">
            <center><h2 style="font-family: jenis5;color:#08e136;padding-top:0px;">Pemerintah Kabupaten Kutai Barat<br>Dinas Kearsipan Dan Perpustakaan</h2>
            </center>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>