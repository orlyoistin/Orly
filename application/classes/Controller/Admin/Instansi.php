<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Instansi extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	public function action_new() {		
		$this->auto_render = false;
		echo View::factory('admin/instansi_form')
			->bind('errors',$error)
			->bind('form',$form)
			->set('submit_value',"Tambah Data")	
			->set('url',URL::base().'admin/instansi/save')
			->set('status_list',$this->getList('Status','status'));
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

		echo View::factory('admin/instansi_form')			
			->bind('form',$form)
			->set('submit_value',"Update Data")	
			->set('url',URL::base().'admin/instansi/update/'.$id)
			->set('status_list',$this->getList('Status','status'))
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
			
			echo View::factory('admin/instansi_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/instansi/save')
				->set('status_list',$this->getList('Status','status'));
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

			$this->template->content = View::factory('admin/instansi_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/instansi/update/'.$id)
				->set('status_list',$this->getList('Status','status'));
		}
	}
	
	public function action_search() {
		$this->auto_render = false;
		$id = $this->request->param('id');		
		
		$url = URL::base()."admin/inaktif";
		$title ="Cari Arsip";
		$submit_value = "Tampilkan Data";
		
		echo View::factory('admin/instansi_search')
			->bind('errors',$error)
			->bind('form',$form)
			->bind('url',$url)
			->bind('title',$title)
			->bind('submit_value',$submit_value)
			->set('status_list',$this->getList('Status','status','Pilih Status'));
	}
}
?>