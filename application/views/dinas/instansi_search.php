<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
?>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>Arsip Inaktif</h4>
    </div>
    <div class="box-body">
<table width="100%" class="table table-condensed">
<tr>
  <td valign="top">Kode</td>
  <td valign="top"><?php echo Form::input('kode','',array('id' => 'kode','size'=>'8','maxlength'=>'8')); ?></td>
</tr>
<tr>
    <td width="91" valign="top">Nama</td>
    <td width="532" valign="top"><?php echo Form::input('name','',array('id' => 'name','size'=>'60')); ?></td>
</tr>
<tr>
  <td valign="top">Status</td>
  <td valign="top"><?php echo Form::select('masterbool_id',$masterbool_list,''); ?></td>
</tr>
<tr>
    <td valign="top">&nbsp;</td>
<td valign="top"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('id'=>'instansi_search_submit','class'=>'btn btn-primary btn-sm'))."</div>"; ?></td>	
    </tr>
</table>
</div>
</div>
<?php echo Form::close() ?>