<?
defined('SYSPATH') or die('No direct script access.');

?>
<div class="box box-solid box-info">        
    <div class="box-header">
      <h4>Template Naskah</h4>
    </div>
    <div class="box-body">
        <table width="100%" class="table table-striped table-bordered">
              <thead>
                <tr>
                    <th width="6%" class="text-center">No</th>
                    <th width="94%" align="left">Name</th>
                </tr>
              </thead>   
              <tbody>
				<?
                foreach($results as $template) {
					?>
                    <tr>
                        <td align="center"><? echo $i; ?></td>
                        <td align="left"><? echo "<a id='".$template->id."' data-fancybox data-type='ajax' data-src='".URL::base()."admin/template/edit/".$template->id."'>".$template->name."</a>"; ?></td>
                    </tr>
                    
					<?
					$i++;
                }
                ?>
                <tr>
                  <td colspan="2"><? if($num_rows==0) {echo "";} else {echo $page_links;} ?>
                    <div class="btn-right">
                    <a class="btn btn-primary pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base().'admin/template/new'; ?>">Tambah Data</a>
                    <a class="btn btn-danger pull-right" data-fancybox data-type="ajax" data-src="<? echo URL::base()."admin/template/search"; ?>">Cari Data</a>
                    <a class="btn btn-warning pull-right"href="<? echo URL::base()."admin/template"; ?>">Reset</a>
                    </div></td>
                </tr>
              </tbody>
            </table>
            
  </div>
	</div>
</div>
