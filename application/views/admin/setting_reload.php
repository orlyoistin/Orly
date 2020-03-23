<? defined('SYSPATH') or die('No direct script access.'); ?>
<div class="table">
	<table width="100%" border="0" cellspacing="1" cellpadding="5">
		<thead>
		<tr>
			<th width="4%" align="center" bgcolor="#D6D6D6">No</th>
			<th width="6%" align="center" bgcolor="#D6D6D6">Edit</th>
			<th width="6%" align="center" bgcolor="#D6D6D6">Status</th>
			<th width="15%" align="left" bgcolor="#D6D6D6">Title</th>
			<th width="13%" align="left" bgcolor="#D6D6D6">E-mail Address</th>
		  <th width="18%" align="left" bgcolor="#D6D6D6">Facebook Page</th>
			<th width="14%" align="center" bgcolor="#D6D6D6">Facebook Status</th>
			<th width="15%" align="center" bgcolor="#D6D6D6">Background Color</th>
			<th width="15%" align="center" bgcolor="#D6D6D6">Background Image</th>
		  </tr>
		</thead>
		<?
		foreach($results as $setting) {
			?>
			<tr bgcolor="#F3F3F3">
				<td align="center"><? echo $i; ?></td>
				<td align="center"><? echo "<a id='".$setting->id."' class='conbtn' href='".URL::base()."setting/edit/".$setting->id."'><img src='".URL::base()."assets/images/edit.gif' /></a>"; ?></td>
				<td align="center"><? echo $setting->status; ?></td>
				<td><? echo $setting->title; ?></td>
				<td><? echo $setting->email; ?></td>
			  <td><? echo $setting->fb; ?></td>
				<td align="center"><? echo $setting->fb_status; ?></td>
				<td align="center"><? echo $setting->bg_color; ?></td>
				<td align="center"><? echo $setting->bg_image; ?></td>
			</tr>
			<?
			$i++;
		}
		?>
			<tr bgcolor="#F3F3F3">
				<td colspan="10"><? if($num_rows==0) {echo "<span class='na'>Note : Data tidak ditemukan</span>";} else {echo $page_links;} ?></td>
			</tr>
	</table>
</div>