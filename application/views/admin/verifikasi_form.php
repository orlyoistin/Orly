<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);

if(isset($id)) {
	echo Form::hidden('id', $id);
}
echo Form::hidden('dari', $dari_id);

$dari = ORM::factory('Sotk',$dari_id);
$origin = $dari->name;
if(!$dari->name) {
	$origin = "Administrator";
}
?>
<script>
$(function() {
	var dates = $("#tanggal").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		showOn: "both",
		changeMonth: 'true',
		changeYear: 'true',
		buttonImage: "<? echo URL::base(); ?>assets/images/calendar.gif",
		buttonImageOnly: true,
	});
	
	$('#template_id').on('change', function() {
		var template_id = this.value;
		$.ajax({
			type		: "POST",
			cache		: false,
			url			: '<? echo URL::base()."surat/template"; ?>',
			data		: 'template_id=' + template_id,
			dataType	: "text",
			success: function(data) {
				CKEDITOR.instances.description.setData(data);
			}
		});
	});
	
	$('#kepada').select2({
		width:'800'
	});
	
	$('#tembusan').select2({
		width:'800'
	});	
});
</script>
<style>
.ui-datepicker-trigger {
	margin-left:5px;
	margin-bottom: -2px;
}
</style>
<div class="table_title">VERIFIKASI</div>
<table width="100%" cellpadding="5" cellspacing="1">
    <tr>
      <td valign="baseline" bgcolor="#F3F3F3">Template</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::select('template_id',$template_list,Arr::get($form, 'template_id'),array('id'=>'template_id')); 
                        if(isset($errors['template_id'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
    </tr>
    <tr>
      <td width="11%" valign="baseline" bgcolor="#F3F3F3">Nomor</td>
      <td width="89%" valign="baseline" bgcolor="#F3F3F3"><?php echo Form::input('nomor',Arr::get($form, 'nomor'),array('id' => 'nomor','size'=>'30')); 
                if(isset($errors['nomor'])) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['nomor']."</div>";
                }?></td>
    </tr>
    <tr>
          <td valign="baseline" bgcolor="#F3F3F3">Tanggal Surat</td>
          <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::input('tanggal',Arr::get($form, 'tanggal'),array('id'=>'tanggal','size'=>'10')); 
                if(isset($errors['tanggal'])) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['tanggal']."</div>";
                }?></td>
  </tr>
    <tr>
      <td valign="baseline" bgcolor="#F3F3F3">Dari</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::input('origin',$origin,array('id' => 'origin','size'=>'100','readonly'=>'readonly')); 
                if(isset($errors['dari'])) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['dari']."</div>";
                }?></td>
    </tr>
    <tr>
          <td valign="baseline" bgcolor="#F3F3F3">Kepada</td>
          <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::select('kepada[]',$parent_list,Arr::get($form, 'kepada'),array('id'=>'kepada','multiple'=>'multiple')); ?></td>
  </tr>
    <tr>
      <td valign="baseline" bgcolor="#F3F3F3">Tembusan</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::select('tembusan[]',$parent_list,Arr::get($form, 'tembusan'),array('id'=>'tembusan','multiple'=>'multiple')); ?></td>
  </tr>
    <tr>
      <td valign="baseline" bgcolor="#F3F3F3">Perihal</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::input('perihal',Arr::get($form, 'perihal'),array('id' => 'perihal','size'=>'100')); 
                if(isset($errors['perihal'])) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['perihal']."</div>";
                }?></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">Isi Surat</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::textarea('description',Arr::get($form, 'description'),array('id' => 'description','cols'=>'100','rows'=>'50')); 
                if(isset($errors['description'])) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['description']."</div>";
                }?></td>
    </tr>
    <tr>
      <td valign="baseline" bgcolor="#F3F3F3">Verifikasi</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::select('bool_id',$bool_list,Arr::get($form, 'bool_id'),array('id'=>'bool_id')); 
                        if(isset($errors['bool_id'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
    </tr>
    <tr>
      <td valign="baseline" bgcolor="#F3F3F3">&nbsp;</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
            if(isset($id)) {
                echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
            }?></td>
    </tr>
</table>
<?php echo Form::close() ?>
<script>
CKEDITOR.replace('description', {
	height: 500,
	extraPlugins: 'tableresize'
});
</script>
