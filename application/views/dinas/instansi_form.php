<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'savedata'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>Arsip Inaktif</h4>
    </div>
    <div class="box-body">
<table width="100%" class="table table-condensed">
<tr>
  <td valign="top">Kode</td>
  <td valign="top"><?php echo Form::input('kode',$form['kode'],array('id' => 'kode_instansi','size'=>'8','maxlength'=>'8')); 
            if(isset($error['kode'])) {
                echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['kode']."</div>";
            } ?></td>
</tr>
<tr>
    <td width="91" valign="top">Nama</td>
    <td width="532" valign="top"><?php echo Form::input('name',$form['name'],array('id' => 'name_instansi','size'=>'60')); 
            if(isset($error['name'])) {
                echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['name']."</div>";
            } ?></td>
</tr>
<tr>
  <td valign="top">Status</td>
  <td valign="top"><?php echo Form::select('masterbool_id',$masterbool_list,Arr::get($form, 'masterbool_id'),array('id'=>'masterbool_instansi')); ?></td>
</tr>
<tr>
    <td valign="top">&nbsp;</td>
<td valign="top"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
            if(isset($id)) {
                echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
            }?></td>	
    </tr>
</table>
</div>
<?php echo Form::close() ?>