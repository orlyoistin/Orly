<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('class'=>'savedata'));

if(isset($id)) {
	echo Form::hidden('id', $id);
}
echo Form::hidden('skpd_id', $skpd->id);
?>
<script>
$(function() {
	$("#sotk_id").select2({
		width: "100%",
		placeholder: "Pilih SOTK"
	});	
});
</script>
<div class="box box-solid box-info" style="width:800px">        
    <div class="box-header">
      <h4>SOTK</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-condensed">
            <tr>
              <td width="20%" valign="baseline">Nama Jabatan</td>
              <td width="80%" valign="baseline"><?php echo Form::textarea('name',Arr::get($form, 'name'),array('id' => 'name','cols'=>'75','rows'=>'2')); 
                        if(isset($errors['name'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['name']."</div>";
                        }?></td>
        </tr>
            <tr>
              <td valign="baseline">Nama Pejabat</td>
              <td valign="baseline"><?php echo Form::textarea('pejabat',Arr::get($form, 'pejabat'),array('id' => 'pejabat','cols'=>'75','rows'=>'2')); 
                        if(isset($errors['pejabat'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['pejabat']."</div>";
                        }?></td>
        </tr>
            <tr>
              <td valign="baseline">NIP</td>
              <td valign="baseline"><?php echo Form::input('nip',Arr::get($form, 'nip'),array('id' => 'nip','size'=>'20', 'maxlength'=>'18')); 
                        if(isset($errors['nip'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['nip']."</div>";
                        }?></td>
        </tr>
            <tr>
              <td valign="baseline">Eselon</td>
              <td valign="baseline"><?php echo Form::input('eselon',Arr::get($form, 'eselon'),array('id' => 'eselon','size'=>'5', 'maxlength'=>'2')); 
                        if(isset($errors['eselon'])) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".$errors['eselon']."</div>";
                        }?></td>
        </tr>
            <tr>
              <td valign="baseline">Sekretaris</td>
              <td valign="baseline"><?php echo Form::select('masterbool_id',$masterbool_list,Arr::get($form, 'masterbool_id')); ?></td>
        </tr>
            <tr>
              <td valign="baseline">Parent</td>
              <td valign="baseline"><?php echo Form::select('parent_id',$parent_list,Arr::get($form, 'parent_id')); ?></td>
        </tr>
            <tr>
              <td valign="baseline">&nbsp;</td>
              <td valign="baseline"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
                    if(isset($id)) {
                        echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
                    }?></td>
        </tr>
      </table>
  </div>
</div>
<?php echo Form::close() ?>