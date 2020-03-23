<? 
defined('SYSPATH') or die('No direct script access.'); 


$sql_masuk = 
"SELECT 
(SELECT COUNT(id) FROM masuks WHERE skpd_id = ".Auth::instance()->get_user()->skpd_id.") AS n_masuk, 
(SELECT COUNT(id) FROM keluars WHERE skpd_id = ".Auth::instance()->get_user()->skpd_id.") AS n_keluar,
(SELECT COUNT(id) FROM instansis WHERE skpd_id = ".Auth::instance()->get_user()->skpd_id.") AS n_instansi,
(SELECT COUNT(id) FROM naskahs WHERE skpd_id = ".Auth::instance()->get_user()->skpd_id.") AS n_naskah";

$masuk = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_masuk', 0);
$keluar = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_keluar', 0);
$instansi = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_instansi', 0);
$naskah = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_naskah', 0);
?>
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><? echo number_format($masuk,0,",","."); ?></h3>
      <p>Surat Masuk</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="<? echo URL::base()."dinas/masuk"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3><? echo number_format($keluar,0,",","."); ?></h3>
      <p>Surat Keluar</p>
    </div>
    <div class="icon">
      <i class="ion ion-stats-bars"></i>
    </div>
    <a href="<? echo URL::base()."dinas/keluar"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><? echo number_format($instansi,0,",","."); ?></h3>
      <p>Arsip Inaktif</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
    <a href="<? echo URL::base()."dinas/inaktif"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div><!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3><? echo number_format($naskah,0,",","."); ?></h3>
      <p>Naskah Dinas</p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div><!-- ./col -->
</div><!-- /.row -->
<!-- Main row --><!-- /.row (main row) -->
