<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Naskah extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
	
	function action_index(){							
		$this->template->content = View::factory('dinas/naskah');
	}
	
	public function action_new() {
		$sotk = ORM::factory('Sotk',Auth::instance()->get_user()->sotk_id);		
		
		$dari_id = Auth::instance()->get_user()->sotk_id;
		if($sotk->level == 3) {
			$dari_id = ORM::factory('Sotk',$sotk->parent_id)->id;
		}
				
		$this->template->content = View::factory('dinas/naskah_form')
    		->set('form',$this->getField('Naskah'))
    		->set('url',URL::base().'dinas/naskah/save')										
    		->set('submit_value','Tambah Data')
			->set('template_list',$this->getList('Template','name','Pilih Template'))
			->set('parent_list',Model::factory('Custom')->parent_skpd())
			->set('dari_id',$dari_id)
			->set('mastersurat_list',$this->getList('Mastersurat','name'));										
	}	

	public function action_edit() {
		$id = $this->request->param('id');

		$naskah = ORM::factory('Naskah',$id);
		$revision = $naskah->revision
				->where('kepada','=',0)
				->find();
		
		$form = array();
		$fields = ORM::factory('Naskah')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $naskah->$column;
		}
		$form['kepada'] = $revision->dari;
		
		$dari_id = "";
	
		$this->template->content = View::factory('dinas/naskah_form')
			->bind('form',$form)
			->set('id',$id)
			->set('url',URL::base().'dinas/naskah/update/'.$id)
			->set('submit_value','Update Data')
			->set('template_list',$this->getList('Template','name','Pilih Template'))
			->set('parent_list',Model::factory('Custom')->parent_skpd())
			->set('dari_id',$dari_id)
			->set('mastersurat_list',$this->getList('Mastersurat','name'));										
	}
	
	public function action_save() {	
		try {
			$naskah = ORM::factory('Naskah');
			$_POST['created'] = date("Y-m-d H:i:s");
			$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
            $_POST['user_id'] = Auth::instance()->get_user()->id;
			$_POST['akses_sotk'] = "#".$_POST['kepada']."#";
					
			$naskah->create_naskah($_POST, array_keys($this->getField('Naskah')));			
			
			$field = array('naskah_id', 'dari', 'kepada', 'tanggal', 'catatan', 'mastersurat_id', 'status_baca', 'created', 'user_id');
			$value = array($naskah->id, Auth::instance()->get_user()->sotk_id, $_POST['kepada'], date("Y-m-d H:i:s"), 'Mohon verifikasi', $_POST['mastersurat_id'], 1, date("Y-m-d H:i:s"), Auth::instance()->get_user()->id);	
				
			DB::insert('revisions', $field)
				->values($value)
				->execute();
			
			HTTP::redirect(URL::base().'dinas/naskah');			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$this->template->content = View::factory('dinas/naskah_form')
				->bind('errors', $errors)
				->set('form', $_POST)
				->set('url',URL::base().'dinas/naskah/save')
				->set('submit_value','Tambah Data')
				->set('template_list',$this->getList('Template','name','Pilih Template'))
				->set('parent_list',Model::factory('Custom')->parent_skpd())
				->set('mastersurat_list',$this->getList('Mastersurat','name'));
		}
	}
		
	public function action_update() {	
		$this->auto_render = false;
		$id = $this->request->param('id');

		try {
			$config = Kohana::$config->load('configuration');
			$dir_icon = $config->get('dir_icon');
			
			$naskah = ORM::factory('Naskah',$id);
			
			if(isset($_POST['delete'])==1) {
				$naskah->delete($id);
			}
			else {
				$_POST['updated'] = date("Y-m-d H:i:s");
				$_POST['skpd_id'] = $naskah->skpd_id;	
				$_POST['user_id'] = $naskah->user_id;
							
				$naskah->update_naskah($_POST, array_keys($this->getField('Naskah')));
				
				$field = array('naskah_id', 'dari', 'kepada', 'tanggal', 'catatan', 'mastersurat_id', 'status_baca', 'created', 'user_id');
				$value = array($naskah->id, Auth::instance()->get_user()->sotk_id, $_POST['kepada'], date("Y-m-d H:i:s"), $_POST['catatan'], $_POST['mastersurat_id'], 1, date("Y-m-d H:i:s"), Auth::instance()->get_user()->id);	
					
				DB::insert('revisions', $field)
					->values($value)
					->execute();
			}
			HTTP::redirect(URL::base().'dinas/naskah');
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('dinas/naskah_form')
				->bind('form',$form)
				->set('id',$id)
				->set('url',URL::base().'dinas/naskah/update/'.$id)
				->set('submit_value','Update Data')
				->set('template_list',$this->getList('Template','name','Pilih Template'))
				->set('parent_list',Model::factory('Custom')->parent())
				->set('mastersurat_list',$this->getList('Mastersurat','name'));	
		}
	}
	
	public function action_view() {
		$this->auto_render = false;
		
		$id = $this->request->param('id');
		$naskah = ORM::factory('Naskah',$id);
		
		DB::update('kepadas')
			->set(array('status_baca' => 2))
			->where('naskah_id', '=', $naskah->id)
			->where('sotk_id', '=', Auth::instance()->get_user()->sotk_id)
			->execute();
		
		echo View::factory('dinas/naskah_view')
			->bind('naskah',$naskah);
	}
	
	public function action_template() {	
		$this->auto_render = false;
		
		$template = ORM::factory('Template',$_POST['template_id']);
		echo $template->description;
	}
	
	public function action_revision() {	
		$this->auto_render = false;
		$naskah_id = $this->request->param('id');
		
		$naskah = ORM::factory('Naskah',$naskah_id);
		$revisions = $naskah->revision->find_all();
		
		echo View::factory('dinas/revision')
			->bind('revisions',$revisions);
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewnaskahs = ORM::factory('Viewnaskah')
			->where('akses_sotk','LIKE','%#'.Auth::instance()->get_user()->sotk_id.'#%')
			->or_where('user_id','=',Auth::instance()->get_user()->id);
		
		$total_data = $viewnaskahs->reset(FALSE)->count_all();

		$viewnaskahs = $viewnaskahs
			->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		
		$total_filtered = $viewnaskahs->reset(FALSE)->count_all();
		
		$viewnaskahs = $viewnaskahs
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('tanggal','ASC')
			->find_all();
			
		$arrData = array();
		$i = 1;
		foreach($viewnaskahs as $viewnaskah) {
			$tanggal = new DateTime($viewnaskah->tanggal);
			
			$naskah = ORM::factory('Naskah',$viewnaskah->id);
			$revision = $naskah->revision
				->order_by('id','DESC')
				->find();	
			
			$sotk = ORM::factory('Sotk',$revision->kepada);	
						
			$arrData[] = array(
				$i + $_REQUEST['start'],
				"<a data-fancybox data-type='ajax' data-src='".URL::base()."dinas/naskah/revision/".$viewnaskah->id."' class='btn btn-primary btn-xs' title='Revision'><i class='fa fa-sort-amount-asc'></i></a>",
			    $tanggal->format("d-m-Y"),
				"<a href='".URL::base()."dinas/naskah/edit/".$viewnaskah->id."'>".$viewnaskah->nomor."</a>",
				$viewnaskah->perihal,
				$viewnaskah->template_name,
				$sotk->name,
				$revision->mastersurat->name
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