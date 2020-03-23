<?
defined('SYSPATH') or die('No direct script access.');
?>
<script type="text/javascript">
$(document).ready(function() {
	table = $("#note_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."struktural/note/data/".$status; ?>",
			type: "post"
		},
		"aoColumnDefs": [
      		//{"sClass": "text-center", "aTargets": [0]},
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
	
	$('body').on('click', '.read', function (e) {
		e.preventDefault();
		var table_id = $(this).attr('table_id');
		var jenis = $(this).attr('jenis');
		var data_id = $(this).attr('data_id');
		var note_id = jenis + '/' + data_id;
		
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: "<? echo URL::base()."struktural/note/read/"; ?>" + note_id,
			data	: $(this).serializeArray(),
			success: function(data) {
				if(data=="success") {
					table.ajax.reload(null,false);
				}
			}
		});
		
		return false;
	});
});
</script>
<div class="box box-solid box-primary">    
    <div class="box-header">
      <h4><? echo $title; ?></h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="note_table">
            <thead>
                <tr>
                    <th align="center">&nbsp;</th>
                </tr>
            </thead>
        </table>
	</div>
</div>