<?
defined('SYSPATH') or die('No direct script access.');
?>
<div class="box">    
    <div class="box-body">
      <div class="box-header">
          <h4>Pemberkasan</h4>
        </div>
        	<table width="100%" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th width="5%" align="center" class="text-center">No</th>
                    <th width="6%" align="center" class="text-center">Urut</th>
                    <th width="6%" align="left">Klasifikasi</th>
                    <th width="8%" align="center" class="text-center">Tanggal Surat</th>
                    <th width="8%" align="left">Nomor Surat</th>
                    <th width="33%" align="left">Isi Informasi</th>
                    <th width="6%" align="center" class="text-center">Jenis</th>
                    <th width="4%" align="center" class="text-center">Aktif</th>
                    <th width="5%" align="center" class="text-center">Inaktif</th>
                    <th width="5%" align="center" class="text-center">Retensi</th>
                  </tr>
                </thead>
                <?                    
                foreach($results as $aktif) {
                    $tanggal = new DateTime($aktif->tanggal_surat);
                    ?>
                    <tr>
                        <td align="center"><? echo $i; ?></td>
                        <td align="center"><? echo $aktif->urut; ?></td>
                        <td align="left"><? echo $aktif->kode; ?></td>
                        <td align="center"><? echo $tanggal->format("d-m-Y"); ?></td>
                        <td align="left"><? echo $aktif->nomor; ?></td>
                        <td align="left"><? echo $aktif->isi; ?></td>
                        <td align="center"><? echo $aktif->tipe_name; ?></td>
                        <td align="center"><? echo $aktif->tahun_aktif; ?></td>
                        <td align="center"><? echo $aktif->tahun_inaktif; ?></td>
                        <td align="center"><? echo $aktif->keterangan_kode; ?></td>
                    </tr>
                    <?
                    $i++;
                }
                ?>
                <tr>
              <td colspan="10">
                <? if($num_rows==0) {echo "";} else {echo $page_links;} ?>
                <div class="btn-right">
                <a class="btn btn-danger pull-right" data-fancybox data-type='ajax' data-src="<? echo URL::base()."admin/berkas/search"; ?>">Cari Data</a>
                <a class="btn btn-warning pull-right"href="<? echo URL::base()."admin/berkas"; ?>">Reset</a>                
                <a class="btn btn-info pull-right" data-fancybox data-type='ajax' data-src="<? echo URL::base()."admin/berkas/filter"; ?>">Cetak</a>
                </div></td>
            </tr>
         </table>
      </div>
	</div>
</div>