<?
defined('SYSPATH') or die('No direct script access.');
?>
<table width="100%" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th width="5%" bgcolor="#D6D6D6" class="text-center">No</th>
        <th width="95%" align="left" bgcolor="#D6D6D6">Jabatan</th>
      </tr>
    </thead>
    <tbody>
    <?
    $i = 1;
    $prefix = "";
    foreach($sotks as $var) {
        if($var) {
			$sotk = ORM::factory('Sotk',$var);
			$prefix = 0;
			if($sotk->level >= 0) { 
				$prefix = str_repeat("&nbsp;",($sotk->level-1)*5);
			}
			?>
			<tr>
				<td align="center"><? echo $i; ?></td>
				<td align="left"><? echo "<a id='".$sotk->id."' data-fancybox data-type='ajax' data-src='".URL::base()."admin/sotk/edit/".$sotk->id."'>".$prefix.$sotk->name."</a><br>".$prefix.$sotk->pejabat."<br>".$prefix.$sotk->nip; ?></td>
			</tr>
			
			<?
			$i++;
		}
    }
    ?>
    </tbody>
</table>
<a class="btn btn-warning" data-fancybox data-type="ajax" data-src="<? echo URL::base().'admin/sotk/new/'.$skpd->id; ?>">Tambah Data</a>