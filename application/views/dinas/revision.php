<?
defined('SYSPATH') or die('No direct script access.');
?>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>History Naskah</h4>
    </div>
    <div class="box-body">
      <table width="100%" class="table table-striped table-bordered" id="masuk_table">
          <thead>
            <tr>
            	<th width="5%" align="center" class="text-center">No</th>
            	<th width="11%">Tanggal</th>
                <th width="20%">Dari</th>
                <th width="26%">Kepada</th>
                <th width="29%">Catatan</th>
                <th width="9%" align="center" class="text-center">Status</th>
            </tr>
          </thead>
          	<?
			$i = 1;
			foreach($revisions as $r) {
				$tanggal = new DateTime($r->created);
				
				$dari = ORM::factory('Sotk',$r->dari);
				$kepada = ORM::factory('Sotk',$r->kepada);
				
				$dari_name = $dari->name;
				$kepada_name = $kepada->name;
				
				if($r->dari == 0) {
					$dari_name = "Admin Dinas";
				}
				if($r->kepada == 0) {
					$kepada_name = "Admin Dinas";
				}
				?>
				<tr>
					<td align="center" class="text-center"><? echo $i; ?></td>
					<td align="left"><? echo strtoupper($tanggal->format('d M Y H.i')); ?></td>
					<td align="left"><? echo $dari_name; ?></td>
					<td align="left"><? echo $kepada_name; ?></td>
					<td align="left"><? echo $r->catatan; ?></td>
					<td align="center" class="text-center"><? echo $r->mastersurat->name; ?></td>
				</tr>
				<?
				$i++;
			}
			?>
        </table>
    </div>
</div>