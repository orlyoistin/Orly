<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#naskah_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."struktural/naskah/data"; ?>",
			type: "post"
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,1,2,5,7]},
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
      <h4>Naskah Dinas</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-striped table-bordered" id="naskah_table">
          <thead>
            <tr>
                <th width="4%" class="text-center">No</th>
                <th width="5%" align="center" class="text-center">Action</th>
                <th width="7%" align="center" class="text-center">Tanggal</th>
                <th width="14%" align="left">Nomor</th>
                <th width="25%" align="left">Perihal</th>
                <th width="9%" align="center" class="text-center">Jenis</th>
                <th width="27%" align="left">Posisi Terakhir</th>
                <th width="9%" align="center" class="text-center">Status</th>
            </tr>
          </thead>
	  </table>
	</div>
</div>