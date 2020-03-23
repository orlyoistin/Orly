<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url,array('target' => '_blank'));
?>
<script>
$(function() {
	var dates = $("#tanggal_surat_start, #tanggal_surat_end").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		changeMonth: 'true',
		changeYear: 'true',
	});
	
	$("select#skpd_id").select2({
		width: "100%",
		placeholder: "Pilih OPD"
	});
	
	$("select#klasifikasi_id").select2({
		width: "100%",
		placeholder: "Pilih Klasifikasi"
	});
});
</script>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>Surat Masuk</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-condensed">
            <tr>
              <td width="153">Tanggal Surat</td>
              <td width="510"><?php echo Form::input('tanggal_surat_start','',array('id'=>'tanggal_surat_start','size'=>'10'))."&nbsp;s/d&nbsp;".Form::input('tanggal_surat_end','',array('id'=>'tanggal_surat_end','size'=>'10')); ?></td>
        </tr>
            <tr>
              <td>Dari</td>
              <td><? echo Form::input('name','',array('id'=>'name','size'=>'75')); ?></td>
        </tr>
            <tr>
              <td>Nomor Urut</td>
              <td><?php echo Form::input('urut','',array('id'=>'urut','size'=>'10')); ?></td>
        </tr>
            <tr>
              <td>Nomor surat</td>
              <td><?php echo Form::input('nomor','',array('id'=>'nomor')); ?></td>
        </tr>
            <tr>
              <td>Kode Klasifikasi</td>
              <td><?php echo Form::select('klasifikasi_id',$klasifikasi_list,'',array('id'=>'klasifikasi_id')); ?></td>
        </tr>
            <tr>
              <td valign="top">Unit Pengolah</td>
              <td valign="top"><?php echo Form::select('sotk_id', $sotk_list, '',array('id' => 'sotk_id'));
                        ?></td>
        </tr>
            <tr>
              <td valign="top">Isi surat</td>
              <td valign="top"><?php echo Form::textarea('isi','',array('id' => 'isi','rows'=>'2','cols'=>'60')); ?></td>
        </tr>
            <tr>
              <td>Nilai Guna</td>
              <td><?php echo Form::select('guna_id',$guna_list,'',array('id'=>'guna_id')); ?></td>
        </tr>
            <tr>
              <td>Media</td>
              <td><?php echo Form::select('media_id',$media_list,'',array('id'=>'media_id')); ?></td>
        </tr>
            <tr>
              <td>Tingkat Perkembangan</td>
              <td><?php echo Form::select('tingkat_id',$tingkat_list,'',array('id'=>'tingkat_id')); ?></td>
        </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
				<? 
				echo Form::submit('submit','Tampilkan Data', array('id' => 'masuk_search_submit', 'class'=>'btn btn-primary btn-sm'))."&nbsp;"; 
				echo Form::submit('submit','Cetak', array('id' => 'masuk_cetak', 'class'=>'btn btn-success btn-sm', 'target'=>'_blank'));
				?></td>	
        </tr>
      </table>
  </div>
</div>
<?php echo Form::close() ?>