<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#klasifikasi_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."admin/klasifikasi/data"; ?>", // json datasource
			type: "post"
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,1,3,4,5]},
    	]
	});
	
	$(".dataTables_filter input").unbind().bind("input", function(e) { 
        if(this.value.length >= 3 || e.keyCode == 13) {
            table.search(this.value).draw();
        }
        if(this.value == "") {
            table.search("").draw();
        }
        return;
    });
});
</script>
<div class="box box-solid box-info">
    <div class="box-header">
      <h4>Klasifikasi</h4>
    </div>    
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="klasifikasi_table">
            <thead>
            <tr>
              <th width="5%" align="center" class="text-center">No</th>
              <th width="8%" align="left">Kode</th>
              <th width="59%" align="left">Name</th>
              <th width="9%" align="center" class="text-center">Aktif</th>
              <th width="9%" align="center" class="text-center">Inaktif</th>
              <th width="10%" align="center" class="text-center">Keterangan</th>
              </tr>
            </thead>
        </table>
        <a class="btn btn-warning" data-fancybox data-type="ajax" data-src="<? echo URL::base().'admin/klasifikasi/new'; ?>">Tambah Data</a>   
      </div>
</div>