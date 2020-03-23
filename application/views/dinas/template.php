<?
defined('SYSPATH') or die('No direct script access.');

?>
<div class="box">    
    <div class="box-body">
        <div class="box-header">
          <h4>Template Naskah Dinas</h4>
        </div>
        <table width="100%" class="table table-striped table-bordered">
              <thead>
                <tr>
                    <th width="6%" bgcolor="#D6D6D6" class="text-center">No</th>
                    <th width="94%" align="left" bgcolor="#D6D6D6">Name</th>
                </tr>
              </thead>   
              <tbody>
				<?
				$config	= Kohana::$config->load('arsip');
				$dir_doc = $config->get('config_dir_doc');
				$sys = strtoupper(PHP_OS);	 
				if(substr($sys,0,3) == "WIN"){
					$separator = "\\";
				}
				else {
					$separator = "/";
				}
				
                foreach($results as $template) {
					?>
                    <tr>
                        <td align="center"><? echo $i; ?></td>
                        <td align="left"><? echo "<a data-fancybox data-type='ajax' id='".$template->id."' data-src='".URL::base()."dinas/template/edit/".$template->id."'>".$template->name."</a>"; ?></td>
                    </tr>
                    
					<?
					$i++;
                }
                ?>
                <tr>
                  <td colspan="2"><? if($num_rows==0) {echo "";} else {echo $page_links;} ?>
                    <div class="btn-right">
                    <a data-fancybox data-type="ajax" class="btn btn-primary pull-right" data-src="<? echo URL::base().'dinas/template/new'; ?>">Tambah Data</a>
                    <a data-fancybox data-type="ajax" class="btn btn-danger pull-right" data-src="<? echo URL::base()."dinas/template/search"; ?>">Cari Data</a>
                    <a class="btn btn-warning pull-right"href="<? echo URL::base()."dinas/template"; ?>">Reset</a>
                    </div></td>
                </tr>
              </tbody>
            </table>
            
      </div>
	</div>
</div>
