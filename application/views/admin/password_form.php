<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'save'));
?>
<div class="box-header">
  <h4>Change Password</h4>
</div>
<table width="400" cellpadding="5" cellspacing="1" class="table">
    <tr>
      <td width="132" valign="baseline" bgcolor="#F3F3F3">Password</td>
      <td width="243" valign="baseline" bgcolor="#F3F3F3"><?php echo Form::password('password',$form['password'],array('id' => 'password')); 
                if(Arr::path($errors, '_external.password')) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::path($errors, '_external.password')."</div>";
                } ?></td>
    </tr>
    <tr>
      <td valign="baseline" bgcolor="#F3F3F3">Retype Password</td>
      <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::password('password_confirm',$form['password_confirm'],array('id' => 'password_confirm')); 
               if(Arr::path($errors, '_external.password_confirm')) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::path($errors, '_external.password_confirm')."</div>";
                } ?></td>
    </tr>
    <tr>
        <td valign="baseline" bgcolor="#F3F3F3">&nbsp;</td>
        <td valign="baseline" bgcolor="#F3F3F3"><?php echo Form::submit('submit',$submit_value, array('class'=>'btn btn-primary btn-sm')) ?></td>	
    </tr>
</table>
<?php echo Form::close() ?>
