<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<div class="box-header">
  <h4>Arsip Inaktif</h4>
</div>
<table width="100%" class="table">
<tr>
  <td valign="top" bgcolor="#F3F3F3">Kode</td>
  <td valign="top" bgcolor="#F3F3F3"><?php echo Form::input('kode','',array('id' => 'kode','size'=>'8','maxlength'=>'8')); ?></td>
</tr>
<tr>
    <td width="91" valign="top" bgcolor="#F3F3F3">Nama</td>
    <td width="532" valign="top" bgcolor="#F3F3F3"><?php echo Form::input('name','',array('id' => 'name','size'=>'60')); ?></td>
</tr>
<tr>
  <td valign="top" bgcolor="#F3F3F3">Status</td>
  <td valign="top" bgcolor="#F3F3F3"><?php echo Form::select('status_id',$status_list,''); ?></td>
</tr>
<tr>
    <td valign="top" bgcolor="#F3F3F3">&nbsp;</td>
<td valign="top" bgcolor="#F3F3F3"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
            if(isset($id)) {
                echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
            }?></td>	
    </tr>
</table>
<?php echo Form::close() ?>