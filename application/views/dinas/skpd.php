<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
     table = $("#skpd_table").DataTable({
		"scrollX": true,
		"info":false,
		"serverSide": true,
		"processing": true,
		"responsive": true,
		"ajax":{
			url :"<? echo URL::base()."dinas/skpd/data"; ?>",
			type: "post"
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,1,2]},
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
      <h4>OPD</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="skpd_table">
            <thead>
            <tr>
              <th width="6%" align="center" class="text-center">No</th>
              <th width="7%" align="center" class="text-center">SOTK</th>
              <th width="9%" align="left">Kode</th>
              <th width="39%" align="left">OPD</th>
              <th width="39%" align="left">Distribusi TU</th>
              </tr>
            </thead>
        </table>
   	</div>
</div>