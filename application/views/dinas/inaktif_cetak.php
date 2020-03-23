<? 
defined('SYSPATH') or die('No direct script access.'); 
$setting = ORM::factory('Setting',1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $setting->title; ?></title>

<style>
html,body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,p,blockquote,th,td {
	margin:0;padding:0;
	font-family:Arial, Helvetica, sans-serif;
}
img,body,html{border:0;}
address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}
ol,ul {list-style:none;}caption,q:before,q:after{content:'';}

table {
  width: 100%;
  font-size: 11px;
  font-family: arial;
  border-collapse: collapse;
}

table th {
  padding: 4px 3px 4px 5px;
  border: 1px solid #d0d0d0;
  border-left-color: #eee;
  background-color: #ededed;
  font-weight:bold;
}

table td {
  padding: 4px 3px 4px 5px;
  border-style: none solid solid;
  border-width: 1px;
  border-color: #ededed;
}
.title {
	font-family:Tahoma,Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	margin-bottom:20px
}
.sub_title {
	font-family:Arial, Geneva, sans-serif;
	font-size:16px;
	font-weight:bold;
}
.title1 {font-family:Arial, Geneva, sans-serif;
	font-size:14px;
}
</style>
</head>
<div class="sub_title"><? echo ucwords(strtolower(Auth::instance()->get_user()->skpd->name)); ?></div><BR />
<div class="sub_title">DAFTAR ARSIP INAKTIF</div>
<div class="title"><? echo "Kode Lembaga : ".$instansi->kode; ?></div>
<table width="100%" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <th width="5%" rowspan="2" align="center">No Def.</th>
        <th width="13%" rowspan="2" align="left">Masalah</th>
      	<th width="32%" rowspan="2" align="left">Kode<br />Uraian Masalah</th>
      	<th width="6%" rowspan="2" align="center">Kurun<br />
      Waktu</th>
   	    <th colspan="2" align="center">Retensi</th>
      	<th width="5%" rowspan="2" align="center">Jml<br />Retensi</th>
      	<th width="5%" rowspan="2" align="center">Tahun<br />Retensi</th>
      	<th width="8%" rowspan="2" align="center">Nilai<br />Guna</th>
      	<th width="9%" rowspan="2" align="center">Tingkat<br />
      	  Perkemb.</th>
      	<th width="6%" rowspan="2" align="center">Pelaks<br />Hasil</th>
   	  </tr>
    <tr>
        <th width="6%">Aktif</th>
      	<th width="5%">Inaktif</th>
   	  </tr>
    </thead>
    <?
    $i=1;		
    foreach($results as $surat) {
		$user = ORM::factory('User',$surat->pelaksana);
        ?>
        <tr>
            <td align="center"><? echo $i; ?></td>
            <td align="left"><? echo $surat->klasifikasi_name; ?></td>
            <td align="left"><? echo $surat->klasifikasi_kode; ?><br /><? echo $surat->isi; ?></td>
            <td align="center"><? echo $surat->bulan." / ".$surat->tahun; ?></td>
          <td align="center"><? echo $surat->ra; ?></td>
            <td align="center"><? echo $surat->ri; ?></td>
            <td align="center"><? echo $surat->ra + $surat->ri; ?></td>
            <td align="center"><? echo $surat->ra + $surat->ri + $surat->tahun; ?></td>
            <td align="center"><? echo $surat->guna_name; ?></td>
            <td align="center"><? echo $surat->tingkat_name; ?></td>
            <td align="center"><? echo $surat->pelaksana."<br>".$surat->hasil; ?></td>
        </tr>
        <?
        $i++;
    }
    ?>
</table>
</body>
</html>