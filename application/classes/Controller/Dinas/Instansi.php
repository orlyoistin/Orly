<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Instansi extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
	
	public function action_index() {
		$this->template->content = View::factory('dinas/instansi');	
	}
	
	public function action_new() {		
		$this->auto_render = false;
		echo View::factory('dinas/instansi_form')
			->bind('errors',$error)
			->bind('form',$form)
			->set('submit_value',"Tambah Data")	
			->set('url',URL::base().'dinas/instansi/save')
			->set('masterbool_list',$this->getList('Masterbool','status_inaktif'));
	}

	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		$instansi = ORM::factory('Instansi',$id);
		
		$form = array();
		$fields = ORM::factory('Instansi')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = strip_tags($instansi->$column);
		}

		echo View::factory('dinas/instansi_form')			
			->bind('form',$form)
			->set('submit_value',"Update Data")	
			->set('url',URL::base().'dinas/instansi/update/'.$id)
			->set('masterbool_list',$this->getList('Masterbool','status_inaktif'))
			->set('id',$id);
	}
	
	public function action_save() {	
		$this->auto_render = false;
		try {		
			$instansi = ORM::factory('Instansi');
			
			$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
			$_POST['user_id'] = Auth::instance()->get_user()->id;
			$_POST['updated'] = date("Y-m-d H:i:s");
				
			$instansi->create_instansi($_POST, array_keys($this->getField('Instansi')));

			echo "success";			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			echo View::factory('dinas/instansi_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/instansi/save')
				->set('masterbool_list',$this->getList('Masterbool','status_inaktif'));
		}
	}
	
	public function action_update() {
		$this->auto_render = false;	
		$id = $this->request->param('id');
		$instansi = ORM::factory('Instansi',$id);
		
		try {
			if(isset($_POST['delete'])) {				
				$instansi->delete($id);				
			}
			else {				
				$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
				$_POST['user_id'] = Auth::instance()->get_user()->id;
				$_POST['updated'] = date("Y-m-d H:i:s");

				$instansi->update_instansi($_POST, array_keys($this->getField('Instansi')));								
			}
			
			echo "success";			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	

			$this->template->content = View::factory('dinas/instansi_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/instansi/update/'.$id)
				->set('masterbool_list',$this->getList('Masterbool','status_inaktif'));
		}
	}
	
	public function action_search() {
		$this->auto_render = false;
		$id = $this->request->param('id');		
		
		$url = URL::base()."dinas/inaktif";
		$title ="Cari Arsip";
		$submit_value = "Tampilkan Data";
		
		echo View::factory('dinas/instansi_search')
			->bind('errors',$error)
			->bind('form',$form)
			->bind('url',$url)
			->bind('title',$title)
			->bind('submit_value',$submit_value)
			->set('masterbool_list',$this->getList('Masterbool','status_inaktif','Pilih Status'));
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewinstansis = ORM::factory('Viewinstansi')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		
		$total_data = $viewinstansis->reset(FALSE)->count_all();
		
		$arrFind = array(
			'name' => array('name','LIKE'),
			'kode' => array('kode','LIKE'),
			'skpd_id' => array('skpd_id','='),
			'masterbool_id' => array('masterbool_id','=')
		);
		
		foreach($arrFind as $f=>$v) {
			if(isset($_POST[$f])) {
				if($_POST[$f]) {
					$value = $_POST[$f];
					if($v[1] == "LIKE") {
						$value = "%".$_POST[$f]."%";
					}
					$viewinstansis = $viewinstansis->where($v[0],$v[1],$value);
				}
			}
		}
		
		if($_REQUEST['search']['value']) {
			$viewinstansis = $viewinstansis
				->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		}
		
		$total_filtered = $viewinstansis->reset(FALSE)->count_all();
		
		$viewinstansis = $viewinstansis
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('kode','ASC')
			->find_all();
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');
			
		$arrData = array();
		$i = 1;
		foreach($viewinstansis as $viewinstansi) {                
			$view = "<a href='".URL::base()."dinas/inaktif/index/".$viewinstansi->id."'><button type='button' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-th' aria-hidden='true'></span></button></a>";
			if($viewinstansi->masterbool_id == 2) {
				$view .= " <a data-fancybox data-type='ajax' data-src='".URL::base()."dinas/inaktif/filter/".$viewinstansi->id."'><button type='button' class='btn btn-info btn-xs'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></button></a>";
			}
				
			$arrData[] = array(
				$i + $_REQUEST['start'],
                $view,
			    "<a data-fancybox data-type='ajax' data-src='".URL::base()."dinas/instansi/edit/".$viewinstansi->id."'>".$viewinstansi->kode."</a>",			
				$viewinstansi->name,
				$viewinstansi->skpd_name,
                $viewinstansi->n_arsip,
				$viewinstansi->status_inaktif
			);
			
			$i++;
		}
		
		$json_data = array(
			"draw"            => intval($_REQUEST['draw'] ),    
			"recordsTotal"    => intval($total_data),  
			"recordsFiltered" => intval($total_filtered), 
			"data"            => $arrData
		);
		
		echo json_encode($json_data);
	}
}
?>