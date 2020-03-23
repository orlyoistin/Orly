<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'savedata','targetdata'=>'struktural/note/reload/index/1','table_id'=>'note_table'));
echo Form::hidden('jenis', $jenis);
echo Form::hidden('data_id', $data_id);
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
		width: "90%",
		placeholder: "Pilih Tujuan Disposisi"
	});
	$("#wakil_id").select2({
		width: "30%",
		placeholder: "Pilih Perwakilan"
	});
	$("#prioritas").select2({
		width: "30%",
		placeholder: "Pilih Prioritas"
	});
	$("#masterdisposisi_id").select2({
		width: "200px",
		placeholder: "Pilih Template Disposisi"
	});
	
	$(document).on('change', 'select#masterdisposisi_id', function() {
		$.ajax ({
			type: 'POST',
			url: '<? echo URL::base()."base/disposisi"; ?>',
			data: $(this).serializeArray(),
			success: function(result) {
				$('#isi').val(result);
			}
		}); 
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
  <h4>Disposisi</h4>
    </div>
    <div class="box-body">
<table class="table" width="100%">
    <tr>
      <td width="9%" valign="top">Perwakilan<br>
      <?php echo Form::select('wakil_id',$wakil_list,Arr::get($form, 'wakil_id'),array('id'=>'wakil_id')); ?></td>
    </tr>
    <tr>
      <td valign="top">Kepada<br><?php echo Form::select('sotk[]',$sotk_list,Arr::get($form, 'sotk'),array('id'=>'sotk','multiple'=>'multiple')); 
                    if(isset($errors['sotk'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
      <td valign="top">Disposisi<br><?php echo Form::select('masterdisposisi_id',$masterdisposisi_list,Arr::get($form, 'masterdisposisi_id'),array('id'=>'masterdisposisi_id')); ?></td>
    </tr>
    <tr>
      <td valign="top">Isi<br><?php echo Form::textarea('isi',Arr::get($form, 'isi'),array('id' => 'isi','rows'=>'3','cols'=>'75')); 
                    if(isset($errors['isi'])) {
                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                    }?></td>
    </tr>
    <tr>
      <td valign="top">Prioritas<br>
      <?php echo Form::select('prioritas',$prioritas_list,Arr::get($form, 'prioritas'),array('id'=>'prioritas')); ?></td>
    </tr>
    <tr>
        <td valign="top"><?php echo Form::submit('submit',$submit_value, array('class'=>'btn btn-primary btn-sm')); ?></td>
    </tr>
</table>
<?php echo Form::close() ?>
</div>