<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#instansi_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."dinas/instansi/data"; ?>",
			type: "post",
			data: function(data) {
				data.name = $('#name').val();
				data.kode = $('#kode').val();
				data.skpd_id = $('#skpd_id').val();	
			}
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,1,2,5,6]},
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
	
	$('body').on('click', '#instansi_search_submit', function (e) {
		e.preventDefault();
		$.fancybox.close();
		table.ajax.reload();
	});
});
</script>
<div class="box box-solid box-info">        
  <div class="box-header">
      <h4>Arsip Inaktif</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="instansi_table">
          <thead>
             <tr>
                <th width="5%" align="center" class="text-center">No</th>
                <th width="9%" align="center" class="text-center">Action</th>
                <th width="10%" align="center" class="text-center">Kode</th>
                <th width="20%" align="left">Nama</th>
                <th width="28%" align="left">OPD / Dinas</th>
                <th width="15%" align="center" class="text-center">n Arsip</th>
                <th width="13%" align="center" class="text-center">Status</th>
            </tr>
          </thead>                 
        </table>
        <a class="btn btn-warning" data-fancybox data-type="ajax" data-src="<? echo URL::base().'dinas/instansi/new'; ?>">Tambah Data</a>
        <a class="btn btn-info" data-fancybox data-type="ajax" data-src="<? echo URL::base().'dinas/instansi/search'; ?>">Cari</a>
  	</div>
</div>