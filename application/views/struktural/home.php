<? 
defined('SYSPATH') or die('No direct script access.'); 

$sql_distribusi = 
"SELECT count(id) AS n_distribusi FROM distributions WHERE sotk_id = '".Auth::instance()->get_user()->sotk_id."'";

$n_distribusi = DB::query(Database::SELECT, $sql_distribusi)->execute()->get('n_distribusi', 0);

$sql_disposisi = 
"SELECT count(id) AS n_disposisi FROM disposisis WHERE kepada = '".Auth::instance()->get_user()->sotk_id."'";

$n_disposisi = DB::query(Database::SELECT, $sql_disposisi)->execute()->get('n_disposisi', 0);
?>
<div class="row">
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><? echo number_format($n_distribusi,0,",","."); ?></h3>
      <p>Distribusi</p>
    </div>
    <div class="icon">
      <i class="fa fa-inbox"></i>
    </div>
    <a href="<? echo URL::base()."struktural/note/index/1"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-orange">
    <div class="inner">
      <h3><? echo number_format($n_disposisi,0,",","."); ?></h3>
      <p>Disposisi</p>
    </div>
    <div class="icon">
      <i class="fa fa-level-down"></i>
    </div>
    <a href="<? echo URL::base()."struktural/note/index/1"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<div class="col-lg-4 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-purple">
    <div class="inner">
      <h3>0</h3>
      <p>Verifikasi</p>
    </div>
    <div class="icon">
      <i class="fa fa-search-plus"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>