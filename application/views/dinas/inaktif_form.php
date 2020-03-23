<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('enctype' => 'multipart/form-data'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
echo Form::hidden('instansi_id', Arr::get($form, 'instansi_id'), array('id'=>'instansi_id'));
?>
<script>
$(function() {
	$("select#klasifikasi_id").select2({
		width: "75%",
		placeholder: "Pilih Klasifikasi"
	});	
	
	$('#klasifikasi_id').on('change', function() {
		var klasifikasi_id = this.value;
		var tahun = $('#tahun').val();
		$.ajax({
			type		: "POST",
			cache		: false,
			url			: '<? echo URL::base()."dinas/inaktif/retensi"; ?>',
			data		: 'klasifikasi_id=' + klasifikasi_id + '&tahun=' + tahun,
			dataType	: "text",
			success: function(data) {
				var obj = jQuery.parseJSON(data);
					
				$("#ra").val(obj.ra);
				$("#ri").val(obj.ri);
				$("#ta").val(obj.ta);
				$("#ti").val(obj.ti);
				$("#k").val(obj.k);
			}
		});
	});
});
</script>

<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>Arsip Inaktif</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table">
          <tr>
            <td width="19%" align="right" valign="middle"><strong>Bulan / Tahun</strong></td>
            <td width="81%" valign="middle"><?php echo Form::select('bulan',$bulan_list,Arr::get($form, 'bulan'))." ".Form::input('tahun',Arr::get($form, 'tahun'),array('id'=>'tahun','size'=>'5')); 
                        if(isset($error['tanggal'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Kode Pelaksana</strong></td>
            <td valign="middle">
                      <? echo Form::input('pelaksana',Arr::get($form, 'pelaksana'),array('id'=>'pelaksana','size'=>'10')); 
                        if(isset($error['pelaksana'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Hasil</strong></td>
            <td valign="middle"><?php echo Form::input('hasil',Arr::get($form, 'hasil')); 
                        if(isset($error['hasil'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
          </tr>
          <tr>
            <td align="right" valign="baseline"><strong>Kode Klasifikasi</strong></td>
            <td valign="baseline"><?php echo Form::select('klasifikasi_id',$klasifikasi_list,Arr::get($form, 'klasifikasi_id'),array('id'=>'klasifikasi_id')); 
                                    if(isset($error['klasifikasi_id'])) {
                                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                    }?></td>
          </tr>
          <tr>
            <td align="right" valign="middle">&nbsp;</td>
            <td valign="middle">Tahun Aktif : <? echo Form::input('ra',Arr::get($form, 'ra'),array('id' => 'ra','size'=>'1','readonly'=>'')); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tahun Inaktif : <? echo Form::input('ri',Arr::get($form, 'ri'),array('id' => 'ri','size'=>'1','readonly'=>'')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <? //echo Form::input('ta',Arr::get($form, 'ta'),array('id' => 'ta','size'=>'2','readonly'=>'')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tahun : <? echo Form::input('ti',Arr::get($form, 'ti'),array('id' => 'ti','size'=>'2','readonly'=>'')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Retensi JRA :&nbsp;<?php echo Form::select('keterangan_id',$keterangan_list,Arr::get($form, 'keterangan_id'),array('id'=>'k')); 
                            ?></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Isi Informasi</strong></td>
            <td valign="middle"><?php echo Form::textarea('isi',Arr::get($form, 'isi'),array('id' => 'isi','rows'=>'3','cols'=>'60'));
                        if(isset($error['isi'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Nilai Guna</strong></td>
            <td align="left" valign="middle"><?php echo Form::select('guna_id',$guna_list,Arr::get($form, 'guna_id')); 
                            if(isset($error['guna_id'])) {
                                echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            }?></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Media</strong></td>
            <td align="left" valign="middle"><?php echo Form::select('media_id',$media_list,Arr::get($form, 'media_id')); 
                            if(isset($error['media_id'])) {
                                echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            }?></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Tingkat Pekembangan</strong></td>
            <td align="left" valign="middle"><?php echo Form::select('tingkat_id',$tingkat_list,Arr::get($form, 'tingkat_id')); 
                            if(isset($error['tingkat_id'])) {
                                echo " <img src='".URL::base()."assets/images/error12.gif'>";
                            }?></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Jumlah</strong></td>
            <td align="left" valign="middle"><?php echo Form::input('jumlah',Arr::get($form, 'jumlah'),array('size'=>'5')); ?><? echo Form::select('lampiran_id',$lampiran_list,Arr::get($form, 'lampiran_id')); ?></td>
          </tr>
          <tr>
            <td colspan="2" align="right" valign="baseline" height="10px"></td>
          </tr>
          <tr>
            <td align="right" valign="baseline"><strong>Lokasi Simpan</strong></td>
            <td valign="baseline">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="baseline">Rak / Roll Opact</td>
            <td valign="baseline"><?php echo Form::input('rak',Arr::get($form, 'rak'),array('size'=>'15')); ?></td>
          </tr>
          <tr>
            <td align="right" valign="baseline">Box</td>
            <td valign="baseline"><? echo Form::input('box',Arr::get($form, 'box'),array('size'=>'15')); ?></td>
          </tr>
          <tr>
            <td colspan="2" align="right" valign="baseline" height="10px"></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><strong>Copy Digital</strong></td>
            <td valign="middle"><? echo $file; ?></td>
          </tr>
          <tr>
            <td align="right" valign="top"><strong>Upload</strong></td>
            <td valign="middle"><? echo Form::file('file'); ?></td>
          </tr>
          <tr>
            <td valign="middle">&nbsp;</td>
            <td valign="middle"><? 
                            echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
                            if(isset($id)) {
								echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
							}
                            ?></td>
          </tr>
      </table>
	</div>
</div>
<?php echo Form::close() ?>