<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#berkas_table").DataTable({
		"scrollX": true,
		"info":false,
		"serverSide": true,
		"processing": true,
		"responsive": true,
		"ajax":{
			url :"<? echo URL::base()."dinas/berkas/data"; ?>",
			type: "post",
			data: function(data) {
				data.from = $('#tanggal_surat_start').val();
				data.to = $('#tanggal_surat_end').val();
				data.name = $('#name').val();
				data.urut = $('#urut').val();
				data.nomor = $('#nomor').val();
				data.klasifikasi_id = $('#klasifikasi_id').val();
				data.sotk_id = $('#sotk_id').val();
				data.isi = $('#isi').val();
				data.guna_id = $('#guna_id').val();
				data.media_id = $('#media_id').val();
				data.tingkat_id = $('#tingkat_id').val();	
				data.tipe = $('#tipe').val();
			}
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,1,2,5,6,7,8,]},
    	]
	});
	
	$(".dataTables_filter input").unbind().bind("keyup", function(e) { 
        if(e.keyCode == 13) {
            table.search(this.value).draw();
        }
        if(this.value == "") {
            table.search("").draw();
        }
        return;
    });
	
	$('body').on('click', '#berkas_search_submit', function (e) {
		e.preventDefault();
		$.fancybox.close();
		table.ajax.reload();
	});
});
</script>
<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>Pemberkasan</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="berkas_table">
            <thead>
            <tr>
                <th width="5%" align="center" class="text-center">No</th>
                <th width="7%" align="left">Klasifikasi</th>
                <th width="9%" align="center" class="text-center">Tanggal</th>
                <th width="13%" align="left">Nomor</th>
                <th width="27%" align="left">Isi Informasi</th>
                <th width="7%" align="center" class="text-center">Jenis</th>
                <th width="5%" align="center" class="text-center">Aktif</th>
                <th width="6%" align="center" class="text-center">Inaktif</th>
                <th width="6%" align="center" class="text-center">Retensi</th>
                <th width="15%" align="left">Unit Pengolah</th>
              </tr>
            </thead>                
         </table>
         <a data-fancybox data-type="ajax" class="btn btn-info" data-src="<? echo URL::base().'dinas/berkas/search'; ?>">Cari / Cetak</a>
      </div>
	</div>
</div>