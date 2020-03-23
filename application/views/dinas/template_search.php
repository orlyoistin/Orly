<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
?>
<div class="box-header">
  <h4>Template Naskah Dinas</h4>
</div>
<table width="100%" class="table">
    <tr>
      <td width="93%" valign="top" bgcolor="#F3F3F3"><?php echo Form::input('name','',array('id' => 'name','size'=>'100')); ?></td>
    </tr>
    <tr>
        <td bgcolor="#F3F3F3"><?php echo Form::submit('submit','Tampilkan Data', array('class'=>'btn btn-primary btn-sm')) ?></td>	
    </tr>
</table>
<?php echo Form::close() ?>