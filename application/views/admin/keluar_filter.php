<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url,array('target'=>'_blank'));
?>
<script>
$(function() {
	var dates = $("#tanggal, #tanggal_surat_start, #tanggal_surat_end").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		changeMonth: 'true',
		changeYear: 'true',
	});
	
	$("select#skpd_id").select2({
		width: "75%",
		placeholder: "Pilih jika Pengirim dari OPD"
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

<div class="box-header">
  <h4>Surat Keluar</h4>
</div>
<table width="100%" class="table">
    <tr>
      <td width="153" bgcolor="#F3F3F3">Tanggal Surat</td>
      <td width="510" bgcolor="#F3F3F3"><?php echo Form::input('tanggal_surat_start','',array('id'=>'tanggal_surat_start','size'=>'10'))."&nbsp;s/d&nbsp;".Form::input('tanggal_surat_end','',array('id'=>'tanggal_surat_end','size'=>'10')); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Kepada</td>
      <td bgcolor="#F3F3F3"><? echo Form::input('name','',array('id'=>'name','size'=>'75')); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Nomor Urut</td>
      <td bgcolor="#F3F3F3"><?php echo Form::input('urut','',array('size'=>'10')); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Nomor surat</td>
      <td bgcolor="#F3F3F3"><?php echo Form::input('nomor',''); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Kode Klasifikasi</td>
      <td bgcolor="#F3F3F3"><?php echo Form::select('klasifikasi_id',$klasifikasi_list,'',array('id'=>'klasifikasi_id')); ?></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">Isi surat</td>
      <td valign="top" bgcolor="#F3F3F3"><?php echo Form::textarea('isi','',array('id' => 'isi','rows'=>'2','cols'=>'60')); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Nilai Guna</td>
      <td bgcolor="#F3F3F3"><?php echo Form::select('guna_id',$guna_list,''); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Media</td>
      <td bgcolor="#F3F3F3"><?php echo Form::select('media_id',$media_list,''); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Tingkat Perkembangan</td>
      <td bgcolor="#F3F3F3"><?php echo Form::select('tingkat_id',$tingkat_list,''); ?></td>
    </tr>
    <tr>
        <td bgcolor="#F3F3F3">&nbsp;</td>
        <td bgcolor="#F3F3F3"><?php echo Form::submit('submit','Cetak Data', array('class'=>'btn btn-primary btn-sm')) ?></td>	
    </tr>
</table>
<?php echo Form::close() ?>