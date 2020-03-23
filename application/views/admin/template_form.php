<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('enctype' => 'multipart/form-data'));

if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>Template Naskah</h4>
    </div>
    <div class="box-body">
<table width="100%" class="table">
    <tr>
      <td width="8%" valign="baseline">Name</td>
      <td width="92%" valign="baseline"><?php echo Form::input('name',Arr::get($form, 'name'),array('id' => 'name','size'=>'100')); 
                if(isset($errors['name'])) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['name']."</div>";
                }?></td>
    </tr>
    <?
	if(isset($id)) {
		?>
		<?
	}
	?>
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
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
    </tr>
</table>
<?php echo Form::close() ?>
<script>
CKEDITOR.replace('description', {
	height: 500,
	width: 1000,
	extraPlugins: 'tableresize'
});
</script>
