<?
defined('SYSPATH') or die('No direct script access.');
$setting = ORM::factory('Setting',1);
?>
<script>
$(function() {
	var dates = $( "#tanggal, #tanggal_surat" ).datepicker({
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
html,body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,p,blockquote,th,td {
	margin:0;padding:0;
	font-family:Arial, Helvetica, sans-serif;
}
img,body,html{border:0;}
address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}
ol,ul {list-style:none;}caption,q:before,q:after{content:'';}

table {
  width: 98%;
  font-size: 11px;
  font-family: arial;
  border-collapse: collapse;
}

table th {
  padding: 4px 3px 4px 5px;
  border: 1px solid #000;
  background-color: #ededed;
  font-weight:bold;
}

table td {
  padding: 4px 3px 4px 5px;
  border-style: solid solid solid solid;
  border-width: 1px;
  border-color: #000;
}
.title {
	font-family:Tahoma,Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	margin-bottom:20px;
	width:98%;
	margin-left:auto;
	margin-right:auto;
}
</style>

<div class="title">Lembar Disposisi<br />
  <? echo strtoupper($masuk->skpd->name); ?><br />
</div>
<table width="100%" cellspacing="0" cellpadding="5" align="center">
  <tr>
    <td width="22%">Nomor Surat</td>
    <td width="78%"><? echo $nomor; ?></td>
  </tr>
  <tr>
    <td>Tanggal Surat</td>
    <td><? echo $tanggal_surat; ?></td>
  </tr>
  <tr>
    <td>Dari</td>
    <td><? echo $skpd; ?></td>
  </tr>
  <tr>
    <td>Isi Informasi</td>
    <td><? echo $isi; ?></td>
  </tr>
  <tr>
    <td>Perihal</td>
    <td><? echo $perihal; ?></td>
  </tr>
  <tr>
    <td>Nomor Pencatatan Kendali</td>
    <td><? echo $klasifikasi; ?></td>
  </tr>
  <tr>
    <td>Diteruskan</td>
    <td><? echo $tanggal_diteruskan; ?></td>
  </tr>
</table><br />
  <div class="table">
	<table width="100%" border="1" cellpadding="5" cellspacing="0" align="center">
		<thead>
		<tr>
			<th width="4%" align="center">No</th>
			<th width="19%" align="left">Dari</th>
			<th width="20%" align="left">Diteruskan Kepada</th>
            <th width="23%" align="left">Isi Disposisi</th>
            <th width="18%" align="center">Tanggal &amp; Paraf</th>
            <th width="16%" align="center">Tanggal Penyelesaian</th>
		</tr>
		</thead>
		<?
		foreach($results as $disposisi) {
			?>
			<tr>
				<td align="center"><? echo $i; ?></td>
				<td align="left"><? echo $disposisi->dari_name; ?></td>
				<td align="left"><? echo $disposisi->kepada_name; ?></td>
				<td align="left"><? echo $disposisi->isi; ?></td>
				<td align="center"><? echo $disposisi->tanggal; ?></td>
				<td align="center">&nbsp;</td>
			</tr>
			<?
			$i++;
		}
		?>
	</table>
</div>
