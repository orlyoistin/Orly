<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
?>
<div class="box-header">
  <h4>User</h4>
</div>
<table width="100%" class="table">
    <tr>
      <td width="9%" valign="baseline">Username</td>
      <td width="91%" valign="baseline"><?php echo Form::input('username','',array('id' => 'username','size'=>'50')); ?></td>
    </tr>
    <tr>
      <td valign="baseline">Name</td>
      <td valign="baseline"><?php echo Form::input('name','',array('id' => 'name','size'=>'75')); ?></td>
    </tr>
   <tr>
       <td valign="baseline">&nbsp;</td>
       <td valign="baseline"><?php echo "<div class='submit_option'>".Form::submit('submit','Tampilkan Data',array('class'=>'btn btn-primary btn-sm'))."</div>"; ?></td>	
    </tr>
</table>
<?php echo Form::close(); ?>
