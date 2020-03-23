<?
defined('SYSPATH') or die('No direct script access.');

$reload = "dinas/disposisi/reload/".$masuk_id;
echo Form::open($url, array('class'=>'savedata','targetdata'=>$reload));
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
	
	$("#sotk").select2({
		width: "100%",
		placeholder: "Pilih Tujuan Disposisi"
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
  <h4>Disposisi</h4>
</div>
<table width="100%" class="table">
    <tr>
      <td width="94" valign="top" bgcolor="#F3F3F3">Tanggal</td>
      <td width="433" valign="top" bgcolor="#F3F3F3"><?php echo Form::input('tanggal',Arr::get($form, 'tanggal'),array('id'=>'tanggal','size'=>'10')); 
                    if(isset($errors['tanggal'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">Perwakilan</td>
      <td valign="top" bgcolor="#F3F3F3"><?php echo Form::select('wakil_id',$wakil_list,Arr::get($form, 'wakil_id')); ?></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">Dari</td>
      <td valign="top" bgcolor="#F3F3F3"><?php echo Form::select('dari_id',$sotk_list,Arr::get($form, 'dari_id')); 
                    if(isset($errors['dari'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">Kepada</td>
      <td valign="top" bgcolor="#F3F3F3"><?php echo Form::select('sotk[]',$sotk_list,Arr::get($form, 'sotk'),array('id'=>'sotk','multiple'=>'multiple')); 
                    if(isset($errors['sotk'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">Isi</td>
      <td valign="top" bgcolor="#F3F3F3"><?php echo Form::textarea('isi',Arr::get($form, 'isi'),array('id' => 'isi','rows'=>'3','cols'=>'60')); 
                    if(isset($errors['isi'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#F3F3F3">&nbsp;</td>
        <td valign="top" bgcolor="#F3F3F3"><?php echo Form::submit('submit',$submit_value, array('class'=>'btn btn-primary btn-sm')); ?></td>	
    </tr>
</table>
<?php echo Form::close() ?>
