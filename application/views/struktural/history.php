<?
defined('SYSPATH') or die('No direct script access.');

$tanggal_surat = new DateTime($masuk->tanggal_surat);
$tanggal_diteruskan = new DateTime($masuk->tanggal_diteruskan);
?>
<div style="width:800px">
<div class="box box-solid box-info">    
    <div class="box-header">
      <h4>History</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th width="8%" align="center" class="text-center"><i class="fa fa-eye" ></i></th>
                <th width="11%" align="center" class="text-center">Tanggal</th>
                <th width="11%" align="center" class="text-center">Jenis</th>
                <th width="21%" align="left">Dari</th>
                <th width="22%" align="left">Kepada</th>
                <th width="27%" align="left">Isi</th>
              </tr>
            </thead>
            <?
            $i = 1;
            foreach($notes as $note) {
				$created = new DateTime($note->created);
				
				$status = "<font color='red'><i class='fa fa-question'></i></font>";
				if($note->status == 2) {
					$status = "<font color='blue'><i class='fa fa-check-square-o' text-blue></i></font>";
				}
                ?>
                <tr bgcolor="#F3F3F3">
                  <td align="center"><? echo $status; ?></td>
                  <td align="center"><? echo $created->format('d-m-Y'); ?></td>
                  <td align="center"><? echo $note->jenis_name ?></td>
                  <td align="left"><? echo $note->dari_name; ?></td>
                  <td align="left"><? echo $note->kepada_name; ?></td>
                  <td align="left"><? echo $note->note; ?></td>
                </tr>
                <?
                $i++;
            }
            ?>
          </table>
    </div>
</div>
</div>