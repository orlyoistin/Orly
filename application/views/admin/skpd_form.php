<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'savedata','table_id'=>'skpd_table'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<script>
$(function() {
	$("#skpd_id").select2({
		width: "95%",
		placeholder: "Pilih Distribusi TU"
	});	
});
</script>
<div class="box box-solid box-info" style="width:800px">        
    <div class="box-header">
      <h4>OPD / SKPD</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-condensed">
            <tr>
              <td valign="top">Kode</td>
              <td valign="top"><?php echo Form::input('kode',$form['kode'],array('id' => 'kode','size'=>'20')); 
                        if(isset($error['kode'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['kode']."</div>";
                        } ?></td>
        </tr>
            <tr>
              <td width="15%" valign="top">Nama</td>
              <td width="85%" valign="top"><?php echo Form::input('name',$form['name'],array('id' => 'name','size'=>'60')); 
                        if(isset($error['name'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$error['name']."</div>";
                        } ?></td>
        </tr>
            <tr>
                <td valign="top">Alamat</td>
                <td valign="top"><?php echo Form::textarea('alamat',Arr::get($form, 'alamat'),array('id' => 'alamat','rows'=>'3','cols'=>'60')); ?></td>
        </tr>
            <tr>
              <td valign="top">Distribusi TU</td>
              <td valign="top"><?php echo Form::select('skpd_id[]',$skpd_list,Arr::get($form, 'skpd_id'),array('id'=>'skpd_id','multiple'=>'multiple')); ?></td>
        </tr>
            <tr>
                <td valign="top">&nbsp;</td>
            <td valign="top"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
                    if(isset($id) && Auth::instance()->get_user()->jabatan_id == 1) {
                        echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
                    }?></td>	
        </tr>
      </table>
  </div>
</div>
<?php echo Form::close() ?>
