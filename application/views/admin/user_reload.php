<?
defined('SYSPATH') or die('No direct script access.');
?>
<table width="100%" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="5%" align="center" class="text-center">No</th>
            <th width="13%" align="left">Username</th>
            <th width="14%" align="left">Nama</th>
            <th width="15%" align="left">NIP</th>
            <th width="18%" align="left">OPD / Dinas</th>
            <th width="6%" align="left">Kode</th>
            <th width="17%" align="left">SOTK</th>
            <th width="12%" align="left">Jabatan</th>
        </tr>
    </thead>   
    <tbody>
    <?
    foreach($results as $user) {
    ?>
    <tr>
        <td align="center"><? echo $i; ?></td>
        <td><? echo "<a id='".$user->id."' data-fancybox data-type='ajax' data-src='".URL::base()."admin/user/edit/".$user->id."'>".$user->username."</a>"; ?></td>
        <td><? echo $user->name; ?></td>
        <td align="left"><? echo $user->nip; ?></td>
        <td align="left"><? echo $user->skpd->name; ?></td>
        <td align="left"><? echo $user->kode; ?></td>
        <td align="left"><? echo $user->sotk->name; ?></td>
        <td align="left"><? echo ucfirst($user->jabatan->name); ?></td>
    </tr>
    <?
    $i++;
    }
    ?>
    </tbody>
    <tr>
        <td colspan="8">
        <? if($num_rows==0) {echo "<span class='na'>Note : Data tidak ditemukan</span>";} else {echo $page_links;} ?>
        <div class="btn-right">
        <a class="btn btn-primary pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base().'admin/user/new'; ?>">Tambah Data</a>
        <a class="btn btn-danger pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base()."admin/user/search"; ?>">Cari Data</a>
        <a class="btn btn-warning pull-right"href="<? echo URL::base()."admin/user"; ?>">Reset</a>
        </div></td>
    </tr>
</table>