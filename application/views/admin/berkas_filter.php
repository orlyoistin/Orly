<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url,array('method' => 'get', 'target'=>'_blank'));
?>
<script>
$(function() {
	var dates = $("#tanggal_surat_start, #tanggal_surat_end").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		changeMonth: 'true',
		changeYear: 'true',
	});
	
	$("select#skpd_id").select2({
		width: "100%",
		placeholder: "Pilih OPD"
	});
	
	$("select#klasifikasi_id").select2({
		width: "100%",
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
  <h4>Pemberkasan</h4>
</div>
<table width="100%" class="table">
    <tr>
      <td width="153" bgcolor="#F3F3F3">Tanggal Surat</td>
      <td width="510" bgcolor="#F3F3F3"><?php echo Form::input('tanggal_surat_start','',array('id'=>'tanggal_surat_start','size'=>'10'))."&nbsp;s/d&nbsp;".Form::input('tanggal_surat_end','',array('id'=>'tanggal_surat_end','size'=>'10')); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">OPD</td>
      <td bgcolor="#F3F3F3"><?php echo Form::select('skpd_id',$skpd_list,'',array('id'=>'skpd_id')); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Nomor Urut</td>
      <td bgcolor="#F3F3F3"><?php echo Form::input('urut','',array('size'=>'10')); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Nomor Surat</td>
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
      <td bgcolor="#F3F3F3">Tipe</td>
      <td bgcolor="#F3F3F3"><?php echo Form::select('tipe',$tipe_list,''); ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Keterangan Retensi</td>
      <td bgcolor="#F3F3F3"><?php echo Form::select('keterangan_id',$keterangan_list,''); ?></td>
    </tr>
    <tr>
        <td bgcolor="#F3F3F3">&nbsp;</td>
        <td bgcolor="#F3F3F3"><? echo Form::submit('submit','Tampilkan Data', array('class'=>'btn btn-primary btn-sm')); ?></td>	
    </tr>
</table>
<?php echo Form::close() ?>