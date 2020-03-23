<? 
defined('SYSPATH') or die('No direct script access.'); 


$sql_masuk = 
"SELECT 
(SELECT COUNT(id) FROM masuks) AS n_masuk, 
(SELECT COUNT(id) FROM keluars) AS n_keluar,
(SELECT COUNT(id) FROM instansis) AS n_instansi,
(SELECT COUNT(id) FROM naskahs) AS n_naskah";

$masuk = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_masuk', 0);
$keluar = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_keluar', 0);
$instansi = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_instansi', 0);
$naskah = DB::query(Database::SELECT, $sql_masuk)->execute()->get('n_naskah', 0);
?>
<div class="row">
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3><? echo number_format($masuk,0,",","."); ?></h3>
      <p>Surat Masuk</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="<? echo URL::base()."admin/masuk"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-green">
    <div class="inner">
      <h3><? echo number_format($keluar,0,",","."); ?></h3>
      <p>Surat Keluar</p>
    </div>
    <div class="icon">
      <i class="ion ion-stats-bars"></i>
    </div>
    <a href="<? echo URL::base()."admin/keluar"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><? echo number_format($instansi,0,",","."); ?></h3>
      <p>Arsip Inaktif</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
    <a href="<? echo URL::base()."admin/inaktif"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-red">
    <div class="inner">
      <h3><? echo number_format($naskah,0,",","."); ?></h3>
      <p>Naskah Dinas</p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
    <a href="<? echo URL::base()."admin/naskah"; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
</div>
<div class="row">
<!--section class="col-lg-12 connectedSortable">
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h4>Last 10 user online</h4>
    </div>    
    <div class="box-body">
      <ul class="todo-list">
        <?
		/*$users = ORM::factory('User')
			->where('last_login','>',0)
			->order_by('last_login','DESC')
			->limit(10)
			->find_all(); 
		
		foreach($users as $user) {
			$time = gmdate("Y-m-d H:i:s", $user->last_login);
			
			$date1=date_create($time);
			$date2=date_create(date("Y-m-d H:i:s"));
			$diff=date_diff($date1,$date2);
			?>
			<li>
			  <span class="handle">
				<i class="fa fa-ellipsis-v"></i>
				<i class="fa fa-ellipsis-v"></i>
			  </span>
			  <? echo "<span class='user_online'>".$user->name."</span> dari ".$user->skpd->name; ?>
			  <small class="label label-danger"><i class="fa fa-clock-o"></i> <? echo $diff->format("%i%a mins"); ?></small>
			</li>
			<?
		}*/
		?>
      </ul>
    </div>
  </div>	
</section!-->
</div>
