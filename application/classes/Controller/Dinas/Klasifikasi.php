<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dinas_Klasifikasi extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
			
	public function action_index() {
		$klasifikasi = ORM::factory('Klasifikasi');
		$arrFind = array('kode','name','keterangan_id');
		$this->getSearch($klasifikasi,$arrFind);

		$count = $klasifikasi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $klasifikasi
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->order_by('kode','ASC')
			->find_all();				
		
		$this->template->content = View::factory('dinas/klasifikasi')
			->bind('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->set('i', $pagination->offset+1)
			->bind('num_rows',$count)
			->bind('url',$url);
	}
	
	function action_reload() {
		$this->auto_render = false;		
		
		$klasifikasi = ORM::factory('Klasifikasi');
		$arrFind = array('kode','name','keterangan_id');
		$this->getSearch($klasifikasi,$arrFind);
		
		$count = $klasifikasi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
				
		$results = $klasifikasi
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->order_by('kode','ASC')
			->find_all();
							
		echo View::factory('dinas/klasifikasi_reload')
			->bind('results', $results)
			->bind('page_links', str_replace("reload","",$pagination->render('pagination/diggs')))
			->bind('i', $pagination->offset+1)
			->bind('url',$url)
			->bind('num_rows',$count);
	}
	
	public function action_new() {
		$this->auto_render = false;
		
		echo View::factory('dinas/klasifikasi_form')
			->bind('errors',$error)
			->set('form',$this->getField('Klasifikasi'))										
			->set('url',URL::base().'dinas/klasifikasi/create')
			->set('submit_value',"Tambah Data")
			->set('keterangan_list',$this->getList('Keterangan','name'));
	}
	
	
	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$klasifikasi = ORM::factory('Klasifikasi',$id);
		
		$form = array();
		$fields = ORM::factory('Klasifikasi')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $klasifikasi->$column;
		}
	
		echo View::factory('dinas/klasifikasi_form')
			->bind('errors',$errors)
			->set('form',$form)
			->set('url',URL::base().'dinas/klasifikasi/update/'.$id)
			->set('submit_value',"Update Data")
			->set('id',$id)
			->set('keterangan_list',$this->getList('Keterangan','name'));
	}	

	public function action_create() {
		$this->auto_render = false;
		try {
			$klasifikasi = ORM::factory('Klasifikasi')->create_klasifikasi($_POST, array_keys($this->getField('Klasifikasi')));		
			
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
								
			echo View::factory('dinas/klasifikasi_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/klasifikasi/create')
				->set('submit_value',"Tambah Data")
				->set('keterangan_list',$this->getList('Keterangan','name'));
		}
	}
	
	public function action_update() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		$klasifikasi = ORM::factory('Klasifikasi',$id);
		
		try {
			if(isset($_POST['delete'])) {
				$klasifikasi->delete($id);
			}
			else {				
				$klasifikasi->update_klasifikasi($_POST, array_keys($this->getField('Klasifikasi')));								
			}
			
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$view = View::factory('dinas/klasifikasi_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/klasifikasi/update/'.$id)
				->set('submit_value',"Update Data")
				->set('id',$id)
				->set('keterangan_list',$this->getList('Keterangan','name'));
				
			echo $view;				
		}
	}
	
	public function action_search() {
		$this->auto_render = false;

		echo View::factory('dinas/klasifikasi_search')
			->set('url',URL::base().'dinas/klasifikasi')
			->set('keterangan_list',$this->getList('Keterangan','name','Pilih Retensi'));										
	}
}
?>