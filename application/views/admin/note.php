<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
?>
<div class="table_title">User Notes</div>
<div id="reload">
<div class="table">
	<table width="100%" border="0" cellpadding="5" cellspacing="1">
		<thead>
		<tr>
			<th width="6%" align="center" bgcolor="#D6D6D6">No</th>
			<th width="5%" align="center" bgcolor="#D6D6D6">Action</th>
			<th width="8%" align="center" bgcolor="#D6D6D6">Tanggal</th>
			<th width="10%" align="center" bgcolor="#D6D6D6">Tanggal Surat</th>
			<th width="18%" align="left" bgcolor="#D6D6D6">Nomor Surat</th>
			<th width="20%" align="left" bgcolor="#D6D6D6">Dari</th>
			<th width="22%" align="left" bgcolor="#D6D6D6">Perihal</th>
			<th width="11%" align="left" bgcolor="#D6D6D6">Status</th>
		  </tr>
		</thead>
		<?
		foreach($results as $note) {
			?>
			<tr bgcolor="#F3F3F3">
				<td align="center"><? echo $i; ?></td>
				<td align="center"><span class="icon_d"><? echo "<a href='".URL::base()."disposisi/?masuk_id=".$note->disposisi->masuk->id."&read_id=".$note->id."'>R</a>"; ?></span></td>
				<td align="center"><? echo $note->tanggal; ?></td>
				<td align="center"><? echo $note->disposisi->masuk->tanggal_surat; ?></td>
				<td align="left"><? echo "<a href='".URL::base()."disposisi/?masuk_id=".$note->disposisi->masuk->id."&read_id=".$note->id."'>".$note->disposisi->masuk->nomor; ?></td>
				<td align="left"><? echo $note->disposisi->masuk->name; ?></td>
				<td align="left"><? echo $note->disposisi->masuk->perihal; ?></td>
				<td align="left"><? echo $note->read->read; ?></td>
			</tr>
			<?
			$i++;
		}
		?>
			<tr bgcolor="#F3F3F3">
				<td align="center"><? echo Form::submit('submit',$submit_value,array('class'=>'button')); ?></td>
				<td align="center">&nbsp;</td>
				<td align="center"><? echo Form::input('tanggal','',array('id' => 'tanggal','size'=>'10')); ?></td>
				<td>&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td align="left">&nbsp;</td>
				<td align="left"><? echo Form::select('read_id',$read_list,''); ?></td>
			</tr>
			<tr bgcolor="#F3F3F3">
			  <td colspan="8" align="center"><? if($num_rows==0) {echo "<span class='na'>Note : Data tidak ditemukan</span>";} else {echo $page_links;} ?></td>
	  </tr>
	</table>
</div>
</div>
<?
echo Form::close()
?>