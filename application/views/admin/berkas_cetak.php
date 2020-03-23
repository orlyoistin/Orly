<? defined('SYSPATH') or die('No direct script access.'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

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
	background-color: #ededed;
	font-weight:bold;
}

table td {
	padding: 4px 3px 4px 5px;
	border: 1px solid #d0d0d0;
}
.title {
	font-family:Tahoma,Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:bold;
	margin-bottom:20px
}
.title1 {	font-family:Arial, Geneva, sans-serif;
	font-size:14px;
}
.sub_title {	font-family:Arial, Geneva, sans-serif;
	font-size:16px;
	font-weight:bold;
}
</style>
</head>
<body>
<div class="title">
 	<div class="title1"><? echo ucwords(strtolower(Auth::instance()->get_user()->skpd->name)); ?></div>
    <div class="sub_title">DAFTAR SURAT MASUK & KELUAR</div>
</div>
<table width="100%" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th align="center" class="text-center">No</th>
        <th align="center" class="text-center">Urut</th>
        <th align="left">Klasifikasi</th>
        <th align="center" class="text-center">Tanggal Surat</th>
        <th align="left">Nomor Surat</th>
        <th align="left">Isi Informasi</th>
        <th align="center" class="text-center">Jenis</th>
        <th align="center" class="text-center">Aktif</th>
        <th align="center" class="text-center">Inaktif</th>
        <th align="center" class="text-center">Retensi</th>
        <!--th align="left">Unit Pengolah</th!-->
      </tr>
    </thead>
    <?          
	$i = 1;          
    foreach($results as $aktif) {
        $tanggal = new DateTime($aktif->tanggal_surat);
        ?>
        <tr>
            <td align="center"><? echo $i; ?></td>
            <td align="center"><? echo $aktif->urut; ?></td>
            <td align="left"><? echo $aktif->kode; ?></td>
            <td align="center"><? echo $tanggal->format("d-m-Y"); ?></td>
            <td align="left"><? echo $aktif->nomor; ?></td>
            <td align="left"><? echo $aktif->isi; ?></td>
            <td align="center"><? echo $aktif->tipe; ?></td>
            <td align="center"><? echo $aktif->tahun_aktif; ?></td>
            <td align="center"><? echo $aktif->tahun_inaktif; ?></td>
            <td align="center"><? echo $aktif->keterangan_name; ?></td>
            <!--td align="left"><? //echo $aktif->sotk_name; ?></td!-->
        </tr>
        <?
        $i++;
    }
    ?>
</table></body>
</html>