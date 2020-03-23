<?
defined('SYSPATH') or die('No direct script access.');
?>
<table width="100%" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th width="6%" bgcolor="#D6D6D6" class="text-center">No</th>
        <th width="42%" align="left" bgcolor="#D6D6D6">Nama Jabatan</th>
        <th width="40%" align="left" bgcolor="#D6D6D6" class="text-center">Nama Pejabat</th>
        <th width="12%" bgcolor="#D6D6D6" class="text-center">Level</th>
      </tr>
    </thead>
    <tbody>
    <?
    $i = 1;
    foreach($results as $var) {
        $sotk = ORM::factory('Sotk',$var);
        ?>
        <tr>
            <td align="center"><? echo $i; ?></td>
            <td align="left"><? echo "<a data-fancybox data-type='ajax' id='".$sotk->id."' data-src='".URL::base()."dinas/sotk/edit/".$sotk->id."'>".str_repeat("&nbsp;",$sotk->level*8).$sotk->name."</a>"; ?></td>
            <td align="left"><? echo $sotk->pejabat; ?></td>
            <td align="center"><? echo $sotk->level; ?></td>
        </tr>
        
        <?
        $i++;
    }
    ?>
    </tbody>
    <tr>
      <td colspan="4" align="center"><a data-fancybox data-type="ajax" class="btn btn-primary pull-right" data-src="<? echo URL::base()."dinas/sotk/new"; ?>">Tambah Data</a></td>
    </tr>
</table> 