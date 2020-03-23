<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'save'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<div class="modal">
  <div class="table_title">WEB SETTING</div>
  <table width="611" cellpadding="5" cellspacing="1">
    <tr>
      <td width="104" valign="top" bgcolor="#F3F3F3">Status</td>
      <td width="482" valign="top" bgcolor="#F3F3F3"><?php echo Form::select('status_id',$status_list,Arr::get($form, 'status_id')); ?></td>
   	</tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">Title</td>
      <td valign="top" bgcolor="#F3F3F3"><?php echo Form::input('title',Arr::get($form, 'title'),array('id' => 'title','size'=>'75')); 
				if(Arr::get($errors, 'title')) {
              		echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'title')."</div>";
                } ?></td>
    </tr>
    <tr>
      <td valign="top" bgcolor="#F3F3F3">E-mail Address</td>
      <td valign="top" bgcolor="#F3F3F3"><?php echo Form::input('email',Arr::get($form, 'email'),array('id' => 'email','size'=>'75')); 
				if(Arr::get($errors, 'email')) {
              		echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'email')."</div>";
                } ?></td>
    </tr>
    <tr>
      <td bgcolor="#F3F3F3">Running Text</td>
      <td bgcolor="#F3F3F3"><?php echo Form::textarea('run',Arr::get($form, 'run'),array('id' => 'run','cols'=>'75','rows'=>'3'));
                if(Arr::get($errors, 'run')) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'run')."</div>";
                } ?></td>
    </tr>
    <tr>
    	<td bgcolor="#F3F3F3">&nbsp;</td>
    	<td bgcolor="#F3F3F3"><?php echo Form::submit('submit',$submit_value) ?></td>	
   	</tr>
  </table>
<?php echo Form::close() ?>
</div>