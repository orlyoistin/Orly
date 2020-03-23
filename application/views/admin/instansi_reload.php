<? defined('SYSPATH') or die('No direct script access.'); ?>

<table width="100%" class="table table-striped table-bordered">
  <thead>
     <tr>
        <th width="5%" align="center" bgcolor="#D6D6D6" class="text-center">No</th>
        <th width="9%" align="center" bgcolor="#D6D6D6" class="text-center">Action</th>
        <th width="10%" align="center" bgcolor="#D6D6D6" class="text-center">Kode</th>
        <th width="20%" align="left" bgcolor="#D6D6D6">Nama</th>
        <th width="28%" align="left" bgcolor="#D6D6D6">OPD / Dinas</th>
        <th width="15%" align="center" bgcolor="#D6D6D6" class="text-center">n Arsip</th>
        <th width="13%" align="center" bgcolor="#D6D6D6" class="text-center">Status</th>
    </tr>
  </thead>   
  <tbody>
    <?
    foreach($results as $instansi) {
        $jumlah = ORM::factory('Inaktif')->where('instansi_id','=',$instansi->id)->count_all();					
        
        $view = "<a href='".URL::base()."admin/inaktif/view/".$instansi->id."'><button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-th' aria-hidden='true'></span></button></a>";
        
        if($instansi->status_id == 2) {
            $view .= " <a data-fancybox data-type='ajax' data-src='".URL::base()."admin/inaktif/filter/".$instansi->id."'><button type='button' class='btn btn-info btn-sm'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></button></a>";
        }
        ?>
        <tr bgcolor="#F3F3F3">
            <td align="center"><? echo $i; ?></td>
            <td align="center"><? echo $view; ?></td>
            <td align="center"><? echo "<a data-fancybox data-type='ajax' data-src='".URL::base()."admin/instansi/edit/".$instansi->id."'>".$instansi->kode."</a>"; ?></td>
            <td><? echo $instansi->name; ?></td>
            <td><? echo $instansi->skpd->name; ?></td>
            <td align="center"><? echo $jumlah; ?></td>
            <td align="center"><? echo $instansi->status->status; ?></td>
        </tr>
        <?
        $i++;
    }
    ?>
  </tbody>
    <tr>
      <td colspan="10">
        <? if($num_rows==0) {echo "";} else {echo $page_links;} ?>
        <div class="btn-right">
        <a class="btn btn-primary pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base().'admin/instansi/new'; ?>">Tambah Data</a>
        <a class="btn btn-danger pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base()."admin/instansi/search"; ?>">Cari Data</a>
        <a class="btn btn-warning pull-right"href="<? echo URL::base()."admin/inaktif"; ?>">Reset</a>
        </div></td>
    </tr>              
</table>