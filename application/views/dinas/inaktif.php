<?
defined('SYSPATH') or die('No direct script access.');
?>
<script>
$(document).ready(function() {
    table = $("#inaktif_table").DataTable({
		"info":false,
		"serverSide": true,
		"processing": true,
		"ajax":{
			url :"<? echo URL::base()."dinas/inaktif/data/".$instansi->id; ?>",
			type: "post",
			data: function(data) {
				data.pelaksana = $('#pelaksana').val();
			}
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
	
	$('body').on('click', '#keluar_search_submit', function (e) {
		e.preventDefault();
		$.fancybox.close();
		table.ajax.reload();
	});
});
</script>
<?
if($instansi->masterbool_id > 1) {
	echo "<div class='callout callout-danger'><h4><i class='icon fa fa-bullhorn'></i> Perhatian !</h4>Arsip Inaktif dengan Kode Lembaga <b>".$instansi->kode."</b> ini telah di Lock<br />
	Anda tidak dapat melakukan Penambahan atau Editing data</div>";
}
?>
<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>Arsip Inaktif</h4>
      <h4><? echo $instansi->kode." - ".$instansi->name; ?></h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered" id="inaktif_table">
          <thead>
              <tr>
                <th width="5%" align="center" class="text-center">No</th>
                <th width="10%" align="center" class="text-center">Action</th>
                <th width="9%" align="center" class="text-center">Pelaksana</th>
                <th width="9%" align="center" class="text-center">Hasil</th>
                <th width="15%" align="center" class="text-center">Bulan / Tahun</th>
                <th width="21%" align="left">Kode Lembaga</th>
                <th width="23%" align="left">Isi</th>
                <th width="8%" align="left" class="text-center">OP</th>
            </tr>
          </thead>    
        </table>
        <a class="btn btn-warning" href="<? echo URL::base().'dinas/inaktif/new/'.$instansi->id; ?>">Tambah Data</a>
	</div>
</div>