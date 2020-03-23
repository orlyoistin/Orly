<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'savedata','targetdata'=>'admin/klasifikasi/reload'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<div class="box box-solid box-info" style="width:800px">        
    <div class="box-header">
      <h4>Klasifikasi</h4>
    </div>
    <div class="box-body">
<table width="100%" class="table">
<tr>
  <td width="9%" valign="top">Kode</td>
  <td width="91%" valign="top"><?php echo Form::input('kode',$form['kode'],array('id' => 'kode','size'=>'8','maxlength'=>'8')); 
            if(isset($error['kode'])) {
                echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['kode']."</div>";
            } ?></td>
</tr>
<tr>
    <td valign="top">Name</td>
    <td valign="top"><?php echo Form::input('name',$form['name'],array('id' => 'name','size'=>'100')); 
            if(isset($error['name'])) {
                echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['name']."</div>";
            } ?></td>
</tr>
<tr>
  <td valign="top">Aktif</td>
  <td valign="top"><?php echo Form::input('aktif',$form['aktif'],array('id' => 'aktif','size'=>'5')); 
				if(isset($error['aktif'])) {
              		echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['aktif']."</div>";
                }?></td>
</tr>
<tr>
  <td valign="top">Inaktif</td>
  <td valign="top"><?php echo Form::input('inaktif',$form['inaktif'],array('id' => 'inaktif','size'=>'5')); ?></td>
</tr>
<tr>
  <td valign="top">Keterangan</td>
  <td valign="top"><?php echo Form::select('keterangan_id',$keterangan_list,Arr::get($form, 'keterangan_id')); 
                                if(isset($error['keterangan_id'])) {
                                    echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                }?></td>
</tr>
<tr>
    <td valign="top">&nbsp;</td>
<td valign="top"><? echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
									if(isset($id)) {
									echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
									}
									?></td>	
    </tr>
</table>
</div>
</div>
<?php echo Form::close() ?>
