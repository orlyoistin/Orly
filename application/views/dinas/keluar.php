<?
defined('SYSPATH') or die('No direct script access.');

$arrF = array(
	'tanggal_surat_start','tanggal_surat_end','name','urut','nomor','klasifikasi_id','sotk_id',
	'isi','guna','media','tingkat'
);

foreach($arrF as $f) {
	echo Form::hidden($f.'_data','',array('id'=>$f.'_data'));
}
?>
<script>
$(document).ready(function() {
    var table = $("#keluar_table").DataTable({
		"scrollX": true,
		"info":false,
		"serverSide": true,
		"processing": true,
		"responsive": true,
		"ajax":{
			url :"<? echo URL::base()."dinas/keluar/data"; ?>",
			type: "post",
			data: function(data) {
				data.from_data = $('#tanggal_surat_start_data').val();
				data.to_data = $('#tanggal_surat_end_data').val();
				data.name_data = $('#name_data').val();
				data.urut_data = $('#urut_data').val();
				data.nomor_data = $('#nomor_data').val();
				data.klasifikasi_id_data = $('#klasifikasi_id_data').val();
				data.sotk_id_data = $('#sotk_id_data').val();
				data.isi_data = $('#isi_data').val();
				data.guna_id_data = $('#guna_id_data').val();
				data.media_id_data = $('#media_id_data').val();
				data.tingkat_id_data = $('#tingkat_id_data').val();	
			}
		},
		"order": [[4, "desc"]],
		"columnDefs": [
			{"className": "text-center", "targets": [0,1,2,3,4]},
			{"searchable": false, "targets": [0,1]},
			{"sortable": false, "targets": [0,1,5,6,7]}
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
	
	$(".dataTables_scrollFootInner tfoot th").each(function() {
		var title = ['Tgl Terima','Tgl Surat', 'Urut', 'Nomor', 'Kepada', 'Isi'];
		var arrTitle = {'2':'Tgl Kirim', '3':'Tgl Surat', '4':'Urut', '5':'Nomor','6':'Kepada','7':'Isi'};
		var size = 15;
		
		for (var key in arrTitle) {
			if($(this).text() == arrTitle[key]) {
				if(key < 6 && key > 3) {
					size = 5;
				}
				else if(key < 4) {
					size = 9
				}
				
				var id = $(this).text().toLowerCase().replace(' ','_');
				
				$(this).html('<input size="' + size + '" data-column-index="' + key + '" class="filter" id="' + id + '" type="text" placeholder="' + $(this).text() + '" />' );
			}
		}
    });
	
	table.columns().every(function () {
		var out_val = this;
		
		$('input', this.footer()).on('keyup change', function (e) {
			var in_val = this;
			
			$('body').on('click', '#button_search_footer', function (e) {
				if (out_val.search() !== in_val.value) {
					out_val
					  .search(in_val.value)
					  .draw();
				}
			});
		});
	});
	
	$('#button_clear_footer').on('click', function () {
		$('#search').val('');
		$('.filter').val('');
		
		table.search('');
				
		$('.filter').each(function(){
			table.column($(this).data('columnIndex')).search('');
        });
		
		<? 
		foreach($arrF as $f) {
			?>
			$('#<? echo $f; ?>_data').val('');
			<?
		}
		?>
		
		table.draw();
	});
	
	$('body').on('click', '#keluar_search_submit', function (e) {
		e.preventDefault();
		
		$('#search').val('');
		$('.filter').val('');
		
		table.search('');
				
		$('.filter').each(function(){
			table.column($(this).data('columnIndex')).search('');
        });
		
		<? 
		foreach($arrF as $f) {
			?>
			$('#<? echo $f; ?>_data').val($('#<? echo $f; ?>').val());
			<?
		}
		?>
		
		$.fancybox.close();
		table.ajax.reload();
	});
	
	$("#tgl_terima, #tgl_surat").datepicker({
		dateFormat:'yy-mm-dd',
		changeMonth: 'true',
		changeYear: 'true',
	});
});
</script>
<style>
.dataTables_filter {display: none;}
</style>
<div class="box box-solid box-info">        
  <div class="box-header">
      <h4>Surat Keluar</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="keluar_table">
          <thead>
              <tr>
                <th width="5%" align="center" class="text-center">No</th>
                <th width="7%" align="center" class="text-center">Action</th>
                <th width="7%" align="center" class="text-center"><span class='fa fa-inbox' aria-hidden='true'></span></th>
                <th width="7%" align="center"><span class='fa fa-envelope-o' aria-hidden='true'></span></th>
                <th width="7%" align="center">Urut</th>
                <th width="14%" align="center">Nomor</th>
                <th width="24%" align="center">Kepada</th>
                <th width="29%" align="center">Isi</th>
            </tr>
          </thead>  
          <tfoot>
            <tr>
            	<th align="center" class="text-center"></th>
                <th align="center" class="text-center">
                <button class="btn btn-info btn-xs" type="button" id="button_clear_footer" title="Reset"><i class="glyphicon glyphicon-remove"></i></button>        
        		<button class="btn btn-warning btn-xs" type="button" id="button_search_footer" title="Search"><i class="glyphicon glyphicon-search"></i></button></th>
                <th align="center" class="text-center">Tgl Kirim</th>
                <th align="center">Tgl Surat</th>
                <th align="center">Urut</th>
                <th align="center">Nomor</th>
                <th>Kepada</th>
                <th align="center">Isi</th>
            </tr>
          </tfoot>                
        </table>
        <a class="btn btn-warning" href="<? echo URL::base().'dinas/keluar/new'; ?>">Tambah Data</a>
        <a data-fancybox data-type="ajax" class="btn btn-info" data-src="<? echo URL::base().'dinas/keluar/search'; ?>">Cari & Cetak</a>
	</div>
</div>
<?
echo Form::close();
?>