<?
defined('SYSPATH') or die('No direct script access.');
$setting = ORM::factory('Setting')->find();

echo Form::open($url, array('enctype' => 'multipart/form-data'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<script>
$(function() {
	$("#skpd_id").jCombo("<? echo URL::base(); ?>dinas/base/skpd", {selected_value: '<? echo Arr::get($form, 'skpd_id'); ?>'});
	$("#sotk_id").jCombo("<? echo URL::base(); ?>dinas/base/sotk/?id=", {parent:"#skpd_id",selected_value: '<? echo Arr::get($form, 'sotk_id'); ?>'});

	$("select#skpd_id").select2({
		width: "75%",
		placeholder: "Pilih OPD"
	});
	
	$("select#sotk_id").select2({
		width: "75%",
		placeholder: "Pilih SOTK",
		allowClear: true
	});
});
</script>
<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>User</h4>
    </div>
	<div class="box-body">
      <table width="100%" class="table">
          <tr>
            <td width="14%" valign="top">Username</td>
            <td width="86%" valign="top"><?php echo Form::input('username',Arr::get($form, 'username'),array('id' => 'username','size'=>'50')); 
                        if(Arr::get($errors, 'username')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'username')."</div>";
                        }
                        ?></td>
        </tr>
          <tr>
            <td valign="top">Password</td>
            <td valign="top"><?php echo Form::password('password','',array('id' => 'password')); 
                        if(Arr::path($errors, '_external.password')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::path($errors, '_external.password')."</div>";
                        } ?></td>
        </tr>
          <tr>
            <td valign="top">Retype Password</td>
            <td valign="top"><?php echo Form::password('password_confirm','',array('id' => 'password_confirm')); 
                        if(Arr::path($errors, '_external.password_confirm')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::path($errors, '_external.password_confirm')."</div>";
                        } ?></td>
        </tr>
          <tr>
            <td valign="top">Nama</td>
            <td valign="top"><?php echo Form::input('name',Arr::get($form, 'name'),array('id' => 'name','size'=>'50')); 
                        if(Arr::get($errors, 'name')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'name')."</div>";
                        }
                        ?></td>
        </tr>
          <tr>
            <td valign="top">NIP</td>
            <td valign="top"><?php echo Form::input('nip',Arr::get($form, 'nip'),array('id' => 'nip','maxlength'=>'18','size'=>'25')); 
                        if(Arr::get($errors, 'nip')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'nip')."</div>";
                        }
                        ?></td>
        </tr>
          <tr>
            <td valign="top">Kode Pelaksana</td>
            <td valign="top"><?php echo Form::input('kode',Arr::get($form, 'kode'),array('id' => 'kode')); 
                        if(Arr::get($errors, 'kode')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'kode')."</div>";
                        }
                        ?></td>
        </tr>
          <tr>
            <td valign="top">E-mail</td>
            <td valign="top"><?php echo Form::input('email',Arr::get($form, 'email'),array('id' => 'email','size'=>'50')); 
                        if(Arr::get($errors, 'email')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'email')."</div>";
                        }
                        ?></td>
        </tr>
          <tr>
            <td valign="top">OPD</td>
            <td valign="top"><?php echo Form::select('skpd_id', array(), Arr::get($form, 'skpd_id'),array('id' => 'skpd_id'));
                        if(Arr::get($errors, 'skpd_id')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'skpd_id')."</div>";
                        }
                        ?></td>
        </tr>
          <tr>
            <td valign="top">SOTK</td>
            <td valign="top"><?php echo Form::select('sotk_id', array(), Arr::get($form, 'sotk_id'),array('id' => 'sotk_id'));
                if(Arr::get($errors, 'sotk_id')) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'sotk_id')."</div>";
                }
                ?></td>
        </tr>
          <!--tr>
            <td valign="top" bgcolor="#F3F3F3">TU</td>
            <td valign="top" bgcolor="#F3F3F3"><?php /*echo Form::select('tu_id', $tu_list, Arr::get($form, 'tu_id'),array('id' => 'tu_id'));
                if(Arr::get($errors, 'tu_id')) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'tu_id')."</div>";
                }*/
                ?></td>
          </tr!-->
          <tr>
            <td valign="top">Role</td>
            <td valign="top"><?php echo Form::select('jabatan_id', $jabatan_list, Arr::get($form, 'jabatan_id'),array('id' => 'jabatan_id'));
                        if(Arr::get($errors, 'jabatan_id')) {
                            echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'jabatan_id')."</div>";
                        }
                        ?></td>
        </tr>
          <?
            if(isset($id)) {
                if(is_file($dir.$separator.Arr::get($form, 'image'))) {
                    ?>
                  <tr id="image_upload">
                    <td>Foto User</td>
                    <td>
                    <?          
                      echo "<div class='image_show'>";
                      echo "  <img class='img-thumbnail' src='".URL::base()."assets/user/".Arr::get($form, 'image')."'>";
                      echo "  <div class='icon_delete_image'><a class='delete-image' href='".URL::base()."admin/user/delete/".$id."'><img src='".URL::base()."assets/images/delete.gif'></a></div>";
                      echo "</div>";
                      ?></td>
        </tr>
              <?
                }
            }
            ?>
          <tr>
            <td>Upload Foto</td>
            <td><? echo Form::file('image'); ?></td>
        </tr>
          <tr>
            <td valign="top">Status</td>
            <td valign="top"><?php echo Form::select('masterbool_id', $masterbool_list, Arr::get($form, 'masterbool_id'),array('id' => 'masterbool_id'));
                if(Arr::get($errors, 'masterbool_id')) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'masterbool_id')."</div>";
                }
                ?></td>
          </tr>
          <tr>
              <td>&nbsp;</td>
              <td><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
                    if(isset($id)) {
                        echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
                    }?></td>	
        </tr>
      </table>
  </div>
</div>
<?php echo Form::close() ?>
