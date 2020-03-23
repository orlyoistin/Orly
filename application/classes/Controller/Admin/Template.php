<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Template extends Controller_Admin_Backend {
	public $auth_required = array('login','root');
	
	function action_index(){							
		$template = ORM::factory('Template');
		
		$arrFind = array('name','description');
		$this->getSearch($template,$arrFind);

		$count = $template->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> 18,
			'auto_hide'			=> FALSE,
		));
		
		$results = $template->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();	
			
		$this->template->content = View::factory('admin/template')
			->set('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->set('i', $pagination->offset+1)
			->set('url',URL::base().'admin/template')
			->set('submit_value','Cari')
			->bind('num_rows',$count);
	}
	
	public function action_new() {
		$this->auto_render = false;
		echo View::factory('admin/template_form')
			->set('form',$this->getField("template"))
			->set('url',URL::base().'admin/template/save')										
			->set('submit_value','Tambah Data');										
	}	

	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');

		$template = ORM::factory('Template',$id);
		
		$form = array();
		$fields = ORM::factory('Template')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $template->$column;
		}
	
		echo View::factory('admin/template_form')
			->bind('form',$form)
			->set('id',$id)
			->set('url',URL::base().'admin/template/update/'.$id)
			->set('submit_value','Update Data');										
	}
	
	public function action_save() {	
		try {
			$template = ORM::factory('Template');
			$_POST['date'] = date("Y-m-d H:i:s");
			$template->create_template($_POST, array_keys($this->getField('Template')));
			
			HTTP::redirect(URL::base().'admin/template');			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$this->template->content = View::factory('admin/template_form')
				->bind('errors', $errors)
				->set('form', $_POST)
				->set('url',URL::base().'admin/template/save')
				->set('submit_value','Tambah Data');
		}
	}
		
	public function action_update() {	
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		try {
			$template= ORM::factory('Template',$id);
			if(isset($_POST['delete'])==1) {
				$template->delete($id);
			}
			else {
				$template->update_template($_POST, array_keys($this->getField('Template')));
			}
			HTTP::redirect(URL::base().'admin/template');
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('admin/template_form')
				->bind('form',$form)
				->set('id',$id)
				->set('url',URL::base().'admin/template/update/'.$id)
				->set('submit_value','Update Data');	
		}
	}	
	
	public function action_search() {
		$this->auto_render = false;

		echo View::factory('admin/template_search')
			->set('url',URL::base().'admin/template');										
	}
}
?>