<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Naskah extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	function action_index(){							
		$naskah = ORM::factory('Naskah');
		
		if(!Auth::instance()->logged_in('backend')) {
			$naskah = $naskah->where('user_id','=',Auth::instance()->get_user()->id);
		}
		
		$arrFind = array('tanggal','template_id','nomor','description');		
		$this->getSearch($naskah,$arrFind);

		$count = $naskah->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $naskah->limit($pagination->items_per_page)->offset($pagination->offset)->order_by('tanggal','DESC')->find_all();				
		$this->template->content = View::factory('admin/naskah')
			->set('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->set('i', $pagination->offset+1)
			->set('url',URL::base().'admin/naskah')
			->set('submit_value','Cari')
			->bind('num_rows',$count);
	}
	
	public function action_new() {
		$this->template->content = View::factory('admin/naskah_form')
    		->set('form',$this->getField('Naskah'))
    		->set('url',URL::base().'admin/naskah/save')										
    		->set('submit_value','Tambah Data')
			->set('template_list',$this->getList('Template','name','Pilih Template'))
			->set('parent_list',Model::factory('Custom')->parent())
			->set('mastersurat_list',$this->getList('Mastersurat','name'));										
	}	

	public function action_edit() {
		$id = $this->request->param('id');

		$naskah = ORM::factory('Naskah',$id);
		
		$form = array();
		$fields = ORM::factory('Naskah')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $naskah->$column;
		}
		$dari_id = $naskah->dari;
		
		$arrKepada = array();
		$kepadas = $naskah->kepada->find_all();
		foreach($kepadas as $kepada) {
			array_push($arrKepada,$kepada->sotk_id);
		}		
		$form['kepada'] = $arrKepada;
		
		$arrTembusan = array();
		$tembusans = $naskah->tembusan->find_all();
		foreach($tembusans as $tembusan) {
			array_push($arrTembusan,$tembusan->sotk_id);
		}		
		$form['tembusan'] = $arrTembusan;
	
		$this->template->content = View::factory('admin/naskah_form')
			->bind('form',$form)
			->set('id',$id)
			->set('url',URL::base().'admin/naskah/update/'.$id)
			->set('submit_value','Update Data')
			->set('template_list',$this->getList('Template','name','Pilih Template'))
			->set('parent_list',Model::factory('Custom')->parent())
			->set('dari_id',$dari_id);										
	}
	
	public function action_save() {	
		try {
			$naskah = ORM::factory('Naskah');
			$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
			$_POST['created'] = date("Y-m-d H:i:s");
            $_POST['user_id'] = Auth::instance()->get_user()->id;
			$_POST['akses_sotk'] = "#".Auth::instance()->get_user()->sotk_id."#".$_POST['kepada']."#";
			
			$naskah->create_naskah($_POST, array_keys($this->getField('Naskah')));			
									
			$field = array('naskah_id', 'dari', 'kepada', 'tanggal', 'catatan', 'mastersurat_id', 'status_baca', 'created', 'user_id');
			$value = array($naskah->id, Auth::instance()->get_user()->sotk_id, $_POST['kepada'], date("Y-m-d H:i:s"), 'Mohon verifikasi', $_POST['mastersurat_id'], 1, date("Y-m-d H:i:s"), Auth::instance()->get_user()->id);	
				
			DB::insert('revisions', $field)
				->values($value)
				->execute();
			
			HTTP::redirect(URL::base().'admin/naskah');			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$this->template->content = View::factory('admin/naskah_form')
				->bind('errors', $errors)
				->set('form', $_POST)
				->set('url',URL::base().'admin/naskah/save')
				->set('submit_value','Tambah Data')
				->set('template_list',$this->getList('Template','name','Pilih Template'))
				->set('parent_list',Model::factory('Custom')->parent());
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
				$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;	
				$_POST['user_id'] = Auth::instance()->get_user()->id;
							
				$naskah->update_naskah($_POST, array_keys($this->getField('Naskah')));
				
				DB::delete('kepadas')->where('naskah_id', '=', $naskah->id)->execute();
				DB::delete('tembusans')->where('naskah_id', '=', $naskah->id)->execute();
								
				// Kepada			
				foreach($_POST['kepada'] as $kepada) {
					DB::insert('kepadas', array('naskah_id', 'sotk_id'))
						->values(array($naskah->id, $kepada))
						->execute();
				}
				
				if(isset($_POST['tembusan'])) {
					foreach($_POST['tembusan'] as $tembusan) {
						DB::insert('tembusans', array('naskah_id', 'sotk_id'))
							->values(array($naskah->id, $tembusan))
							->execute();
					}
				}
			}
			HTTP::redirect(URL::base().'admin/naskah');
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('admin/naskah_form')
				->bind('form',$form)
				->set('id',$id)
				->set('url',URL::base().'admin/naskah/update/'.$id)
				->set('submit_value','Update Data')
				->set('template_list',$this->getList('Template','name','Pilih Template'))
				->set('parent_list',Model::factory('Custom')->parent());	
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
		
		echo View::factory('admin/naskah_view')
			->bind('naskah',$naskah);
	}
	
	public function action_template() {	
		$this->auto_render = false;
		
		$template = ORM::factory('Template',$_POST['template_id']);
		echo $template->description;
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewnaskahs = ORM::factory('Viewnaskah')
			->where('akses_sotk','LIKE','%#'.Auth::instance()->get_user()->sotk_id.'#%');
		
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
						
			$arrData[] = array(
				$i + $_REQUEST['start'],
				"<a class='btn btn-primary btn-xs' href='".URL::base().'admin/revision/index/'.$viewnaskah->id."' title='Revision'><i class='fa fa-sort-amount-asc'></i></a>",
			    $tanggal->format("d-m-Y"),
				$viewnaskah->nomor,
				$viewnaskah->perihal,
				$viewnaskah->template_name,
				'',
				$viewnaskah->mastersurat_name
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