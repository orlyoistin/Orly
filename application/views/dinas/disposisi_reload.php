<?
defined('SYSPATH') or die('No direct script access.');

$tanggal_surat = new DateTime($masuk->tanggal_surat);
$tanggal_diteruskan = new DateTime($masuk->tanggal_diteruskan);
?>
<div class="box box-solid box-primary">    
    <div class="box-header">
      <h4>Surat Masuk</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped">
            <tr>
                <td width="18%" valign="baseline">Nomor Surat</td>
                <td width="82%" valign="baseline"><? echo $masuk->nomor; ?></td>
          </tr>
            <tr>
                <td valign="baseline">Tanggal Surat</td>
                <td valign="baseline"><? echo $tanggal_surat->format("d-m-Y"); ?></td>
          </tr>
            <tr>
                <td valign="baseline">Dari</td>
                <td valign="baseline"><? echo $masuk->name; ?></td>
          </tr>
            <tr>
                <td valign="baseline">Perihal</td>
                <td valign="baseline"><? echo $masuk->perihal; ?></td>
          </tr>
            <tr>
                <td valign="baseline">Isi Informasi</td>
                <td valign="baseline"><? echo $masuk->isi; ?></td>
          </tr>
            <tr>
                <td valign="baseline">Nomor Pencatatan Kendali</td>
                <td valign="baseline"><? echo $masuk->klasifikasi." / ".$masuk->urut; ?></td>
          </tr>
            <tr>
                <td valign="baseline">Copy Digital</td>
                <td valign="baseline"><? echo $file; ?></td>
          </tr>
        </table>
  </div>
</div>

<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>Distribusi</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th width="4%" align="center" class="text-center">No</th>
            <th width="11%" align="center" class="text-center">Tanggal Disposisi</th>
            <th width="11%" align="center" class="text-center">Tanggal Kirim</th>
            <th width="9%" align="center" class="text-center">Interval</th>
            <th width="58%" align="left">Didistribusikan Kepada</th>
            <th width="7%" align="center" class="text-center">Status</th>
          </tr>
        </thead>
        <?
        $i = 1;
        foreach($distributions as $distribution) {
            if($distribution->masterbool_id == 1) {
                $b = "<a class='push btn btn-warning btn-xs' href='".URL::base().'admin/base/push/'.$distribution->sotk_id."'><i class='fa fa-clock-o'></i></a>";
            }
            else {
                $b = "<a class='btn btn-info btn-xs' href='#'><i class='fa fa-check'></i></a>";
            }
            
            $tanggal_diteruskan = new DateTime($distribution->tanggal);
            $created = new DateTime($distribution->created);
            $now = new DateTime(date("Y-m-d H:i:s"));
            
            $since_start = $created->diff($now);	
            $interval = $since_start->h." h ".$since_start->i." m ".$since_start->s." s";
            ?>
            <tr bgcolor="#F3F3F3">
              <td align="center"><? echo $i; ?></td>
              <td align="center"><? echo $tanggal_diteruskan->format("d-m-Y"); ?></td>
              <td align="center"><? echo $created->format("d-m-Y H:i:s"); ?></td>
              <td align="center"><? echo $interval; ?></td>
              <td align="left"><? echo $distribution->sotk->name; ?></td>
              <td align="center"><? echo $b; ?></td>
            </tr>
            <?
            $i++;
        }
        ?>
        <tr>
          <td height="30" colspan="7"><a class="btn btn-primary pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base()."dinas/distribution/new/".$masuk->id; ?>">Tambah Distribusi</a></td>
        </tr>
      </table>
    </div>
</div>

<div class="box box-solid box-danger">    
    <div class="box-header">
      <h4>Disposisi</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th width="5%" align="center" class="text-center">No</th>
            <th width="11%" align="center" class="text-center">Tanggal</th>
            <th width="23%" align="left">Dari</th>
            <th width="28%" align="left">Didisposisikan Kepada</th>
            <th width="33%" align="left">Isi Disposisi</th>
          </tr>
        </thead>
        <?
        $i = 1;
        foreach($disposisis as $disposisi) {
            $tanggal = new DateTime($disposisi->tanggal);
            ?>
            <tr bgcolor="#F3F3F3">
              <td align="center"><? echo $i; ?></td>
              <td align="center"><? echo $tanggal->format("d-m-Y"); ?></td>
              <td align="left"><? echo $disposisi->dari_name; ?></td>
              <td align="left"><? echo $disposisi->kepada_name; ?></td>
              <td align="left"><? echo $disposisi->isi; ?></td>
            </tr>
            <?
            $i++;
        }
        ?>
        <tr>
          <td height="30" colspan="6"><a target="_blank" class="btn btn-primary pull-right" href="<? echo URL::base()."dinas/disposisi/cetak/".$masuk->id; ?>">Cetak</a></td>
        </tr>
      </table>
    </div>
</div>