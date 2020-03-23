<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url,array('method' => 'get'));
?>
<script>
$(function() {
	var dates = $("#date").datepicker({
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1
	});
});
</script>
<style>
.ui-datepicker-trigger {
	margin-left:5px;
	margin-bottom: -2px;
}
</style>

<div class="table_title">TEMBUSAN</div>
<div id="reload">
<div class="table">
	<table width="100%" class="table table-striped table-bordered table-condensed">
		<thead>
		<tr>
		  	<th width="4%" bgcolor="#D6D6D6" class="text-center">No</th>
		  	<th width="7%" align="center" bgcolor="#D6D6D6" class="text-center">Tanggal</th>
		  	<th width="12%" align="center" bgcolor="#D6D6D6" class="text-center">Nomor Surat</th>
		  	<th width="29%" align="left" bgcolor="#D6D6D6">Perihal</th>
		  	<th width="25%" align="left" bgcolor="#D6D6D6">Kepada</th>
		  	<th width="23%" align="left" bgcolor="#D6D6D6">Tembusan</th>
	  	  </tr>
		</thead>
        <tbody>
		<?
		foreach($results as $surat) {
			$tanggal = new DateTime($surat->tanggal);
			
			$kepadas = ORM::factory('Kepada')
				->where('surat_id','=',$surat->id)
				->find_all();
			
			$tujuan = "";
			foreach($kepadas as $kepada) {
				$tujuan .= $kepada->sotk->name."<br>";
			}
			
			$tembusans = ORM::factory('Tembusan')
				->where('surat_id','=',$surat->id)
				->find_all();
				
			$cc = "";
			foreach($tembusans as $tembusan) {
				$cc .= $tembusan->sotk->name."<br>";
			}
			?>
			<tr>
				<td align="center"><? echo $i; ?></td>
				<td align="center"><? echo $tanggal->format("d-m-Y"); ?></td>
				<td align="center"><? echo "<a data-fancybox data-type='ajax' data-src='".URL::base()."admin/surat/view/".$surat->id."'>".$surat->nomor."</a>"; ?></td>
				<td align="left"><? echo $surat->perihal; ?></td>
				<td align="left"><? echo $tujuan; ?></td>
				<td align="left"><? echo $cc; ?></td>
			</tr>
			<?
			$i++;
		}
		?>
        </tbody>
        <thead>
        <tr bgcolor="#D6D6D6">
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
        </thead>
        <tr>
            <td colspan="7"><? if($num_rows==0) {echo "<span class='na'>Note : Data tidak ditemukan</span>";} else {echo $page_links;} ?></td>
        </tr>
	</table>
</div>
</div>
<?
echo Form::close()
?>