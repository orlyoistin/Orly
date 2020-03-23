<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#sotk_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"paging":false,
		"searching":false,
		"ajax":{
			url :"<? echo URL::base()."dinas/sotk/data"; ?>",
			type: "post"
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0]},
    	]
	});
});
</script>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>SOTK</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="sotk_table">
            <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="95%" align="left">Jabatan</th>
              </tr>
            </thead>
        </table><br>   
        <a data-fancybox data-type="ajax" class="btn btn-warning" data-src="<? echo URL::base().'dinas/sotk/new/'.$skpd_id; ?>">Tambah Data</a> 
	</div>
</div>