<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);

if(isset($id)) {
	echo Form::hidden('id', $id);
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
			url			: '<? echo URL::base()."dinas/naskah/template"; ?>',
			data		: 'template_id=' + template_id,
			dataType	: "text",
			success: function(data) {
				CKEDITOR.instances.description.setData(data);
			}
		});
	});
	
	$('#mastersurat_id').select2({
		width:'100'
	});
	
	$('#template_id').select2({
		width:'500'
	});
	
	$('#kepada').select2({
		width:'800'
	});
});
</script>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>Naskah Dinas</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-condensed">
            <tr>
              <td valign="baseline">Template</td>
              <td valign="baseline"><?php echo Form::select('template_id',$template_list,Arr::get($form, 'template_id'),array('id'=>'template_id')); 
                                if(isset($errors['template_id'])) {
                                    echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                }?></td>
          </tr>
            <tr>
              <td width="11%" valign="baseline">Nomor</td>
              <td width="89%" valign="baseline"><?php echo Form::input('nomor',Arr::get($form, 'nomor'),array('id' => 'nomor','size'=>'30')); 
                        if(isset($errors['nomor'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['nomor']."</div>";
                        }?></td>
          </tr>
            <tr>
                  <td valign="baseline">Tanggal</td>
                  <td valign="baseline"><?php echo Form::input('tanggal',Arr::get($form, 'tanggal'),array('id'=>'tanggal','size'=>'10')); 
                        if(isset($errors['tanggal'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['tanggal']."</div>";
                        }?></td>
          </tr>
            <tr>
              <td valign="baseline">Perihal</td>
              <td valign="baseline"><?php echo Form::input('perihal',Arr::get($form, 'perihal'),array('id' => 'perihal','size'=>'100')); 
                        if(isset($errors['perihal'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['perihal']."</div>";
                        }?></td>
          </tr>
            <tr>
              <td valign="baseline">Diajukan kepada</td>
              <td valign="baseline"><?php echo Form::select('kepada',$parent_list,Arr::get($form, 'kepada'),array('id'=>'kepada')); ?></td>
            </tr>
            <tr>
              <td valign="top">Catatan</td>
              <td valign="baseline"><?php echo Form::textarea('catatan',Arr::get($form, 'catatan'),array('id' => 'catatan','cols'=>'100','rows'=>'3')); 
                        if(isset($errors['catatan'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['catatan']."</div>";
                        }?></td>
            </tr>
            <tr>
              <td valign="top">Status</td>
              <td valign="baseline"><?php echo Form::select('mastersurat_id',$mastersurat_list,Arr::get($form, 'mastersurat_id'),array('id'=>'mastersurat_id')); ?></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="baseline"><?php echo Form::textarea('description',Arr::get($form, 'description'),array('id' => 'description','cols'=>'100','rows'=>'50')); 
                        if(isset($errors['description'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['description']."</div>";
                        }?></td>
          </tr>
            <tr>
              <td valign="baseline">&nbsp;</td>
              <td valign="baseline"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
                    if(isset($id)) {
                        echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
                    }?></td>
          </tr>
      </table>
  </div>
</div>
<? echo Form::close() ?>
<script>
CKEDITOR.replace('description', {
	height: 500,
	extraPlugins: 'tableresize'
});
</script>
