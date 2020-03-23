<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
?>
<div class="box-header">
  <h4>Klasifikasi</h4>
</div>
<table width="100%" class="table">
<tr>
  <td width="9%" valign="top">Kode</td>
  <td width="91%" valign="top"><?php echo Form::input('kode','',array('id' => 'kode','size'=>'8','maxlength'=>'8')); ?></td>
</tr>
<tr>
    <td valign="top">Name</td>
    <td valign="top"><?php echo Form::input('name','',array('id' => 'name','size'=>'100')); ?></td>
</tr>
<tr>
  <td valign="top">Keterangan</td>
  <td valign="top"><?php echo Form::select('keterangan_id',$keterangan_list,''); ?></td>
</tr>
<tr>
    <td valign="top">&nbsp;</td>
<td valign="top"><? echo Form::submit('submit','Tampilkan Data', array('class'=>'btn btn-primary btn-sm')); ?></td>	
    </tr>
</table>
<?php echo Form::close() ?>
