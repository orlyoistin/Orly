<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url, array('enctype' => 'multipart/form-data'));
if(isset($id)) {
	echo Form::hidden('id', $id);
}
?>
<script>
$(function() {
	var dates = $("#tgl, #tgl_surat").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		showOn: "both",
		changeMonth: 'true',
		changeYear: 'true',
		buttonImage: "<? echo URL::base(); ?>assets/images/calendar.gif",
		buttonImageOnly: true,
		onSelect: function( selectedDate ) {
			var option = this.id == "tgl_surat" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});

	$("select#kepada").select2({
		width: "75%",
	});
	
	$("select#klasifikasi_id").select2({
		width: "75%",
		placeholder: "Pilih Klasifikasi"
	});
	
	$(document).on('change', 'select#kepada', function() {
		$.ajax ({
			type: 'POST',
			url: '<? echo URL::base()."base/skpd"; ?>',
			data: $(this).serializeArray(),
			success: function(result) {
				$('#name').val(result);
			}
		}); 
	});	

});
</script>
<style>
.ui-datepicker-trigger {
	margin-left:5px;
	margin-bottom: -2px;
}
</style>

<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>Surat Keluar</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table">
            <tr>
              <td width="17%" align="right" valign="baseline"><strong>Kepada</strong></td>
              <td width="83%" valign="baseline"><?php echo Form::select('kepada',$skpd_list,Arr::get($form, 'kepada'),array('id'=>'kepada')); 
                                    if(isset($error['skpd_id'])) {
                                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                    }?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline">&nbsp;</td>
              <td valign="baseline"><? echo Form::input('name',Arr::get($form, 'name'),array('id'=>'name','size'=>'75'));
                                    if(isset($error['name'])) {
                                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                    }?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Tanggal Surat</strong></td>
              <td valign="middle"><?php echo Form::input('tanggal_surat',Arr::get($form, 'tanggal_surat'),array('id'=>'tgl_surat','size'=>'10')); 
                        if(isset($error['tanggal_surat'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Tanggal kirim</strong></td>
              <td valign="middle"><?php echo Form::input('tanggal',Arr::get($form, 'tanggal'),array('id'=>'tgl','size'=>'10')); 
                        if(isset($error['tanggal'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td valign="top"><?
                        $surats = ORM::factory('Keluar')
                            ->where('skpd_id','=',Auth::instance()->get_user()->skpd->id)
                            ->where(DB::expr('YEAR(tanggal_surat)'),'=',date("Y"))
                            ->order_by('id','DESC')
                            ->find();
                        echo "Nomor urut terakhir : ".$surats->urut."<br>Tahun : ".substr($surats->tanggal,0,4);
                        ?></td>
            </tr>
            <tr>
              <td align="right"><strong>Nomor Urut</strong></td>
              <td valign="top"><? echo Form::input('urut',Arr::get($form, 'urut'),array('id'=>'urut','size'=>'20')); 
                        if(isset($error['urut'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }
                        ?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Nomor Surat</strong></td>
              <td valign="middle"><?php echo Form::input('nomor',Arr::get($form, 'nomor')); 
                        if(isset($error['nomor'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Perihal</strong></td>
              <td valign="middle"><?php echo Form::input('perihal',Arr::get($form, 'perihal'),array('size'=>'50')); 
                        if(isset($error['perihal'])) {
                            echo " <img src='".URL::base()."assets/images/error12.gif'>";
                        }?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Kode Klasifikasi</strong></td>
              <td valign="middle"><?php echo Form::select('klasifikasi_id',$klasifikasi_list,Arr::get($form, 'klasifikasi_id'),array('id'=>'klasifikasi_id')); 
                                    if(isset($error['klasifikasi_id'])) {
                                        echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                    }?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Isi surat</strong></td>
              <td valign="middle"><?php echo Form::textarea('isi',Arr::get($form, 'isi'),array('id' => 'isi','rows'=>'3','cols'=>'60'));
                                if(isset($error['isi'])) {
                                    echo " <img src='".URL::base()."assets/images/error12.gif'>";
                                }?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Indeks</strong></td>
              <td valign="middle"><?php echo Form::input('indeks',Arr::get($form, 'indeks'),array('size'=>'50')); ?></td>
            </tr>
            <tr>
              <td align="right" valign="middle"><strong>Unit Pengolah</strong></td>
              <td align="left" valign="middle"><?php echo Form::select('sotk_id', $sotk_list, Arr::get($form, 'sotk_id'),array('id' => 'sotk_id'));
                if(isset($error['sotk_id'])) {
                    echo "<div class='error_form'><img src='".URL::base()."assets/images/error12.gif'>".Arr::get($errors, 'sotk_id')."</div>";
                }
                ?></td>
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
              <td align="right" valign="middle"><strong>Lampiran</strong></td>
              <td align="left" valign="middle"><?php echo Form::input('jumlah',Arr::get($form, 'jumlah'),array('size'=>'5')); ?> <? echo Form::select('lampiran_id',$lampiran_list,Arr::get($form, 'lampiran_id')); ?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Copy Digital</strong></td>
              <td valign="baseline"><? echo $file; ?></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><strong>Upload</strong></td>
              <td valign="baseline"><? echo Form::file('file'); ?></td>
            </tr>
            <tr>
              <td valign="middle">&nbsp;</td>
              <td valign="middle"><?php echo "<div class='submit_option'>".Form::submit('submit',$submit_value,array('class'=>'btn btn-primary btn-sm'))."</div>"; 
												if(isset($id)) {
													echo "<div class='delete_option'><div class='delete_input'>".Form::checkbox('delete', '1', FALSE)."</div><div class='delete_text'> Hapus data ini</div></div>";
												}
												?></td>
            </tr>
        </table>
	</div>
</div>
<?php echo Form::close() ?>