<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url,array('target'=>'_blank'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
echo Form::hidden('lanjut', '1');
?>
<script>
$(function() {
	var dates = $( "#tgl, #tgl1" ).datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		showOn: "both",
		changeMonth: 'true',
		changeYear: 'true',
		buttonImage: "<? echo URL::base(); ?>assets/images/calendar.gif",
		buttonImageOnly: true,
	});
	
	$("select#klasifikasi_id").select2({
		width: "75%",
		placeholder: "Pilih Klasifikasi"
	});
});
</script>
<style>
.ui-datepicker-trigger {
	margin-left:5px;
	margin-bottom: -2px;
}
</style>

<div class="box box-solid box-info">        
  <div class="box-header">
      <h4>Arsip Inaktif</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-condensed">
            <tr>
              <td width="191">Rentang waktu Tanggal Surat</td>
              <td width="471"><?php echo Form::select('bulan_start',$bulan_list,'')." ".Form::input('tahun_start','',array('size'=>'5','maxlength'=>'4'))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;s/d&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".Form::select('bulan_end',$bulan_list,'')." ".Form::input('tahun_end','',array('size'=>'5','maxlength'=>'4')); ?></td>
        </tr>
            <tr>
              <td>Keterangan Retensi</td>
              <td><?php echo Form::select('keterangan_id',$keterangan_list,''); ?></td>
        </tr>
            <tr>
              <td align="left" valign="baseline">Kode Klasifikasi</td>
              <td valign="baseline"><?php echo Form::select('klasifikasi_id',$klasifikasi_list,Arr::get($form, 'klasifikasi_id'),array('id'=>'klasifikasi_id')); 
                                                    if(isset($error['klasifikasi_id'])) {
                                                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                                    }?></td>
        </tr>
            <tr>
              <td valign="top">Isi surat</td>
              <td valign="top"><?php echo Form::textarea('isi','',array('id' => 'isi','rows'=>'3','cols'=>'60')); ?></td>
        </tr>
            <tr>
              <td>Nilai Guna</td>
              <td><?php echo Form::select('guna_id',$guna_list,''); ?></td>
        </tr>
            <tr>
              <td>Media</td>
              <td><?php echo Form::select('media_id',$media_list,''); ?></td>
        </tr>
            <tr>
          <td>Tingkat Perkembangan</td>
          <td><?php echo Form::select('tingkat_id',$tingkat_list,''); ?></td>
        </tr>
            <tr>
                <td>&nbsp;</td>
                <td><?php echo Form::submit('submit','Cetak Data', array('class'=>'btn btn-primary btn-sm')); ?></td>	
        </tr>
      </table>
  </div>
</div>
<?php echo Form::close() ?>
