<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
?>
<div class="table_title">Unit Pengolah Dinas / OPD</div>
<table width="100%" border="0" cellspacing="1" cellpadding="5">
  <tr>
    <td width="23%" bgcolor="#F3F3F3">Kode</td>
    <td width="77%" bgcolor="#F3F3F3"><? echo $skpd_kode; ?></td>
  </tr>
  <tr>
    <td bgcolor="#F3F3F3">Dinas / OPD</td>
    <td bgcolor="#F3F3F3"><? echo $skpd_name; ?></td>
  </tr>
</table><br />
<div class="table_title">Manage Unit Pengolah Dinas / OPD</div>
<div id="reload">
<div class="table">
	<table width="100%" border="0" cellspacing="1" cellpadding="5">
		<thead>
		<tr>
			<th width="6%" align="center" bgcolor="#D6D6D6">No</th>
			<th width="9%" align="center" bgcolor="#D6D6D6">Kode</th>
			<th width="85%" align="left" bgcolor="#D6D6D6">Nama</th>
		  </tr>
		</thead>
		<?
		foreach($results as $unit) {
			?>
			<tr bgcolor="#F3F3F3">
				<td align="center"><? echo $i; ?></td>
				<td align="center"><? echo "<a id='".$unit->id."' class='conbtn' href='".URL::base()."unit/edit/".$unit->id."'>".$unit->kode."</a>"; ?></td>
				<td><? echo $unit->name; ?></td>
			</tr>
			<?
			$i++;
		}
		?>
			<tr bgcolor="#F3F3F3">
				<td align="center"><? echo Form::submit('submit',$submit_value,array('class'=>'button')); ?></td>
				<td align="center"><? echo Form::input('kode','',array('id' => 'kode','size'=>'10')); ?></td>
				<td><? echo Form::input('name','',array('id' => 'name','size'=>'50')); ?></td>
			</tr>
			<tr bgcolor="#F3F3F3">
				<td colspan="4"><? if($num_rows==0) {echo "<span class='na'>Note : Data tidak ditemukan</span>";} else {echo $page_links;} ?>
				<span class="addbtn"><a class="conbtn" href="<? echo URL::base().'unit/new?skpd_id='.$_GET['skpd_id']; ?>">Add Unit Pengolah</a></span></td>
			</tr>
	</table>
</div>
</div>
<?
echo Form::close()
?>