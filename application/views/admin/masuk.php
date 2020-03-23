<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#masuk_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."admin/masuk/data"; ?>",
			type: "post"
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,1,2,6]},
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
      <h4>Surat Masuk</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="masuk_table">
          <thead>
            <tr>
            	<th width="6%" align="center" class="text-center">No</th>
                <th width="9%" align="center" class="text-center">Action</th>
                <th width="9%" align="center" class="text-center">Tanggal</th>
                <th width="12%" align="center">Nomor</th>
                <th width="23%">Dari</th>
                <th width="32%" align="center">Isi</th>
                <th width="9%" align="center" class="text-center">OP</th>
            </tr>
          </thead>   
        </table>
        <a class="btn btn-warning" href="<? echo URL::base().'admin/masuk/new'; ?>">Tambah Data</a>
  	</div>
</div>