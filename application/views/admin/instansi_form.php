<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'savedata','targetdata'=>'admin/inaktif/reload'));
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
  <td valign="top" bgcolor="#F3F3F3"><?php echo Form::input('kode',$form['kode'],array('id' => 'kode','size'=>'8','maxlength'=>'8')); 
            if(isset($error['kode'])) {
                echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['kode']."</div>";
            } ?></td>
</tr>
<tr>
    <td width="91" valign="top" bgcolor="#F3F3F3">Nama</td>
    <td width="532" valign="top" bgcolor="#F3F3F3"><?php echo Form::input('name',$form['name'],array('id' => 'name','size'=>'60')); 
            if(isset($error['name'])) {
                echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['name']."</div>";
            } ?></td>
</tr>
<tr>
  <td valign="top" bgcolor="#F3F3F3">Status</td>
  <td valign="top" bgcolor="#F3F3F3"><?php echo Form::select('status_id',$status_list,Arr::get($form, 'status_id')); 
            if(isset($error['status_id'])) {
                echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['status_id']."</div>";
            }?></td>
</tr>
</table>
<?php echo Form::close() ?>