<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Jabatan extends Controller_Dinas_Backend {
	public $auth_required = array('login','jabatan');

	private $form = array(
		'name'	=> '',
		'id'	=> '',
	);

	function action_index(){		
		$jabatan = ORM::factory('Jabatan');
		
		$this->template->content = View::factory('jabatan')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('num_rows',$count);
			
		$count = $jabatan->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $jabatan->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();				
		$page_links = $pagination->render();
		$i=$pagination->offset+1;
		$submit_value = "Cari";
	}
	
	function action_reload() {
		$this->auto_render = false;
		
		$view = View::factory('jabatan_reload')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('num_rows',$count);

		$jabatan = ORM::factory('Jabatan');
		$count = $jabatan->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $jabatan->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();				
		$page_links = str_replace("reload","",$pagination->render());
		$i=$pagination->offset+1;
		$submit_value = "Cari";
		
		echo $view;
		exit;
	}

	public function action_new() {
		$this->auto_render = false;

		$view = View::factory('frm_jabatan');
		$view->form = $this->form;
		$view->id="";
		$view->errors="";
		$view->url = URL::base().'jabatan/save';
		$view->title ="Add Jabatan";
		$view->submit_value = "Add Jabatan";
		echo $view;
	}
	
	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$jabatan = ORM::factory('Jabatan')->where("id","=",$id)->find();
		$form = array(
			'name'			=> $jabatan->name,
			'id'			=> $id,
		);
	
		$view = View::factory('frm_jabatan');
		$view->form = $form;
		$view->errors="";
		$view->url = URL::base().'jabatan/update/'.$id;
		$view->id = $id;
		$view->title ="Edit Jabatan";
		$view->submit_value = "Update Jabatan";			
		
		echo $view;
	}	
	
	public function action_save() {	
		$this->auto_render = false;
		
		try {
			$jabatan = ORM::factory('Jabatan');
			$jabatan->create_jabatan($_POST, array_keys($this->form));
			
			$jabatan = ORM::factory('Jabatan',mysql_insert_id());
			if(isset($_POST['role'])) {
				$jabatan->add('roles',$_POST['role']);
			}
			
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$view = View::factory('frm_jabatan')
				->bind('errors', $errors)
				->bind('form', $_POST);
			
			$view->id = "";	
			$view->url = URL::base().'jabatan/save';
			$view->title ="New Jabatan";
			$view->submit_value = "Add Jabatan";
			echo $view;
		}
	}
	
	public function action_update() {	
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$users = ORM::factory('User')->where('jabatan_id','=',$id)->find_all();
		
		try {
			$jabatan = ORM::factory('Jabatan',$id);
			if(isset($_POST['delete'])==1) {
				foreach($users as $user) {
					$user->remove('roles', $user->roles->find_all());
				}				
				$jabatan->delete($id);
			}
			else {
				$jabatan->update_jabatan($_POST, array_keys($this->form));
				
				if(isset($_POST['role'])) {
					foreach($jabatan->roles->find_all() as $jrole) {
						$jabatan->remove('roles', $jrole);
					}
					$jabatan->add('roles',$_POST['role']);
					
					foreach($users as $user) {
						foreach($user->roles->find_all() as $urole) {
							$user->remove('roles', $urole);
						}
						$user->add('roles',$_POST['role']);
					}
				}
				else {
					foreach($jabatan->roles->find_all() as $jrole) {
						$jabatan->remove('roles', $jrole);
					}					
					foreach($users as $user) {
						foreach($user->roles->find_all() as $urole) {
							$user->remove('roles', $urole);
						}
					}
				}
			}
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$view = View::factory('frm_jabatan')
				->bind('errors', $errors)
				->bind('form', $_POST);
			
			$view->id = $id;	
			$view->url = URL::base().'jabatan/update/'.$id;
			$view->title ="New Kode Transaksi";
			$view->submit_value = "Add Kode Transaksi";
			echo $view;
		}
	}
}
?>