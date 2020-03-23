<? defined('SYSPATH') or die('No direct script access.'); 

$surat = ORM::factory('Keluar',$id);
$skpd = ORM::factory('Skpd',$surat->origin);

?>
<style>
body {
	margin:0;padding:0;
	font-family:Arial, Helvetica, sans-serif;
	width:16.5cm;
	height:10.5cm;
}
html,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,p,blockquote,th,td {
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
  padding: 10px 10px 10px 10px;
  border-style: solid solid solid solid;
  border-width: 1px;
  border-color: #000;
}
.title {
	font-family:Arial, Geneva, sans-serif;
	font-size:14px;
	width:98%;
	margin-left:auto;
	margin-right:auto;
}
.sub_title {
	font-family:Arial, Geneva, sans-serif;
	font-size:16px;
	font-weight:bold;
	width:98%;
	margin-left:auto;
	margin-right:auto;
}
</style>
<div class="title"><? echo ucwords(strtolower($skpd->name))." Provinsi Jawa Tengah"; ?></div>
<div class="sub_title">KARTU KENDALI SURAT KELUAR</div>
<br />
<table width="100%" cellpadding="10" cellspacing="0" align="center">
<tr>
    <td width="331" valign="top"><strong>Index :</strong><br /><? echo $surat->indeks; ?></td>
    <td width="408" valign="top"><strong>Kode :</strong><br />
    <? echo $surat->klasifikasi->kode; ?></td>
    <td width="168" valign="top"><strong>Nomor Urut :</strong><br />
    <? echo $surat->urut; ?></td>
</tr>
<tr>
  <td colspan="3" valign="top">Perihal :<br />
    <? echo $surat->perihal; ?></td>
</tr>
<tr>
  <td colspan="3" valign="top"><strong>Isi Ringkas :</strong><br />
    <? echo $surat->isi; ?></td>
</tr>
<tr>
  <td colspan="3" valign="top"><strong>Kepada :</strong><br /><? echo $surat->name; ?></td>
</tr>
<tr>
  <td valign="top"><strong>Pengolah :</strong><br />
    <? echo $surat->unit->name; ?></td>
  <td valign="top"><strong>Tanggal Surat :</strong><br />
    <? 
	$tanggal_surat = new DateTime($surat->tanggal_surat);
	echo $tanggal_surat->format("d-m-Y"); 
	?></td>
  <td valign="top"><strong>Lampiran</strong> :<br />
    <? echo $surat->jumlah." ".$surat->lampiran->name; ?></td>
</tr>
</table>