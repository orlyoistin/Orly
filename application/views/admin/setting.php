<?
defined('SYSPATH') or die('No direct script access.');

echo Form::open($url);
?>
<div class="table_title">Web Setting</div>
<div id="reload">
<div class="table">
	<table width="100%" border="0" cellpadding="5" cellspacing="1">
		<thead>
		<tr>
			<th width="6%" align="center" bgcolor="#D6D6D6">No</th>
			<th width="6%" align="center" bgcolor="#D6D6D6">Edit</th>
			<th width="13%" align="center" bgcolor="#D6D6D6">Status</th>
			<th width="34%" align="left" bgcolor="#D6D6D6">Title</th>
			<th width="41%" align="left" bgcolor="#D6D6D6">E-mail Address</th>
		  </tr>
		</thead>
		<?
		foreach($results as $setting) {
			?>
			<tr bgcolor="#F3F3F3">
				<td align="center"><? echo $i; ?></td>
				<td align="center"><? echo "<a id='".$setting->id."' class='conbtn' href='".URL::base()."admin/setting/edit/".$setting->id."'><img src='".URL::base()."assets/images/edit.gif' /></a>"; ?></td>
				<td align="center"><? echo $setting->status; ?></td>
				<td><? echo $setting->title; ?></td>
				<td><? echo $setting->email; ?></td>
		    </tr>
			<?
			$i++;
		}
		?>
			<tr bgcolor="#F3F3F3">
				<td colspan="6"><? if($num_rows==0) {echo "<span class='na'>Note : Data tidak ditemukan</span>";} else {echo $page_links;} ?></td>
			</tr>
	</table>
</div>
</div>
<?
echo Form::close()
?>