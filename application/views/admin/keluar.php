<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#keluar_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."admin/keluar/data"; ?>",
			type: "post"
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,1,2,3,4,7]},
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
});
</script>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>Surat Keluar</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="keluar_table">
          <thead>
              <tr>
                <th width="5%" align="center" class="text-center">No</th>
                <th width="10%" align="center" class="text-center">Action</th>
                <th width="8%" align="center">Urut</th>
                <th width="10%" align="center" class="text-center">Tanggal</th>
                <th width="15%" align="center">Nomor</th>
                <th width="23%" align="center">Kepada</th>
                <th width="22%" align="center">Isi</th>
                <th width="7%" align="center" class="text-center">OP</th>
            </tr>
          </thead>                
        </table>
        <a class="btn btn-warning" href="<? echo URL::base().'admin/keluar/new'; ?>">Tambah Data</a> 
	</div>
</div>