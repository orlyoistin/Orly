<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#user_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."admin/user/data"; ?>", // json datasource
			type: "post"
		},
		"aoColumnDefs": [
      		{"sClass": "text-center", "aTargets": [0,4,5]},
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
      <h4>User</h4>
    </div>    
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="user_table">
            <thead>
                <tr>
                    <th width="5%" align="center" class="text-center">No</th>
                    <th width="11%" align="left">Username</th>
                    <th width="17%" align="left">Nama</th>
                    <th width="44%" align="left">OPD / SOTK</th>
                    <!--th align="left">SOTK</th!-->
                    <th width="14%" align="left">Role</th>
                    <th width="9%" align="left">Kode</th>
                </tr>
            </thead>
        </table>
        <a class="btn btn-warning" href="<? echo URL::base().'admin/user/new'; ?>">Tambah Data</a>   
	</div>
</div>