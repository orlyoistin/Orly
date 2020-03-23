<? defined('SYSPATH') or die('No direct script access.'); ?>
<table width="100%" class="table table-striped table-bordered">
    <thead>
    <tr>
      <th width="5%" align="center" class="text-center">No</th>
      <th width="8%" align="left">Kode</th>
      <th width="59%" align="left">Name</th>
      <th width="9%" align="center" class="text-center">Aktif</th>
      <th width="9%" align="center" class="text-center">Inaktif</th>
      <th width="10%" align="center" class="text-center">Keterangan</th>
      </tr>
    </thead>
    <?
    foreach($results as $klasifikasi) {
        ?>
        <tr bgcolor="#F3F3F3">
            <td align="center"><? echo $i; ?></td>
            <td><? echo "<a id='".$klasifikasi->id."' data-fancybox data-type='ajax' data-src='".URL::base()."admin/klasifikasi/edit/".$klasifikasi->id."'>".$klasifikasi->kode."</a>"; ?></td>
            <td><? echo $klasifikasi->name; ?></td>
            <td align="center"><? echo $klasifikasi->aktif; ?></td>
            <td align="center"><? echo $klasifikasi->inaktif; ?></td>
            <td align="center"><? echo $klasifikasi->keterangan->kode; ?></td>
        </tr>
        <?
        $i++;
    }
    ?>
        <tr>
          <td colspan="6">
            <? if($num_rows==0) {echo "<span class='na'>Note : Data tidak ditemukan</span>";} else {echo $page_links;} ?>
            <div class="btn-right">
            <a class="btn btn-primary pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base().'admin/klasifikasi/new'; ?>">Tambah Data</a>
            <a class="btn btn-danger pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base()."admin/klasifikasi/search"; ?>">Cari Data</a>
            <a class="btn btn-warning pull-right"href="<? echo URL::base()."admin/klasifikasi"; ?>">Reset</a>
            </div></td>
        </tr>
</table>
