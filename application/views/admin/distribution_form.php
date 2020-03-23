<?
defined('SYSPATH') or die('No direct script access.');

$reload = "admin/disposisi/reload/".$masuk_id;
echo Form::open($url, array('class'=>'saveload','targetdata'=>$reload));
echo Form::hidden('masuk_id', $masuk_id);
?>
<script>
$(function() {
	var dates = $("#tanggal").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		showOn: "both",
		buttonImage: "<? echo URL::base(); ?>assets/images/calendar.gif",
		buttonImageOnly: true,
	});
	
	$("#sotk_id").select2({
		width: "100%",
		placeholder: "Pilih Tujuan Distribusi"
	});
	
	$("#prioritas").select2({
		width: "200px",
		placeholder: "Pilih Prioritas"
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
  <h4>Distribusi</h4>
</div>
<div class="box-body">
<table width="100%" class="table">
    <tr>
      <td width="14%" align="left" valign="top" bgcolor="#FFFFFF"><strong>Tanggal</strong></td>
      <td width="86%" valign="top" bgcolor="#FFFFFF"><?php echo Form::input('tanggal',Arr::get($form, 'tanggal'),array('id'=>'tanggal','size'=>'10')); 
                    if(isset($errors['tanggal'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
      <td align="left" valign="top" bgcolor="#FFFFFF"><strong>Kepada</strong></td>
      <td valign="top" bgcolor="#FFFFFF"><?php echo Form::select('sotk_id',$sotk_list,Arr::get($form, 'sotk_id'),array('id'=>'sotk_id')); 
                    if(isset($errors['sotk'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
      <td align="left" valign="baseline" bgcolor="#FFFFFF"><strong>Prioritas</strong></td>
      <td align="left" valign="baseline" bgcolor="#FFFFFF"><?php echo Form::select('prioritas',$prioritas_list,Arr::get($form, 'prioritas'),array('id'=>'prioritas')); 
                    if(isset($error['prioritas'])) {
                                echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            }?></td>
  </tr>
    <tr>
              <td align="left" bgcolor="#FFFFFF"><strong>Catatan</strong></td>
              <td valign="top" bgcolor="#FFFFFF"><?php echo Form::textarea('rekomendasi',Arr::get($form, 'rekomendasi'),array('id' => 'rekomendasi','rows'=>'2','cols'=>'75'));
                                if(isset($error['rekomendasi'])) {
                                    echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                }?></td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
        <td valign="top" bgcolor="#FFFFFF"><?php echo Form::submit('submit',$submit_value, array('class'=>'btn btn-primary btn-sm')); ?></td>	
    </tr>
</table>
</div>
<?php echo Form::close() ?>