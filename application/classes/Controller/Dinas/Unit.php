<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Unit extends Controller_Dinas_Backend {
	public $auth_required = array('login','unit');
	
	private $form = array(
		'kode' 			=> '',
		'name' 			=> '',
		'skpd_id' 		=> '',
		'id'			=> '',
	);
 
	function action_index(){		
		$arrSession = array('kode','name');
		
		if(isset($_GET['s'])) {
			if($_GET['s']) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
		}
		
		if(isset($_POST)) {
			foreach($_POST as $key=>$var) {
				Session::instance()->set($key, $var);
			}
		}
					
		$unit = ORM::factory('Unit');
		
		if(isset($_GET['skpd_id'])) {
			$unit->where('skpd_id','=',$_GET['skpd_id']);
			$url = URL::base().'unit/?s=1&skpd_id='.$_GET['skpd_id'];
		}
		else {
			$url = URL::base().'unit/?s=1';
		}
		
		foreach($arrSession as $var) {
			if(Session::instance()->get($var, NULL)=="") {
				Session::instance()->delete($var);
			}
			else {
				$unit->where($var,"LIKE","%".Session::instance()->get($var, NULL)."%");
			}
		}
						
		$this->template->content = View::factory('unit')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('skpd_kode',$skpd_kode)
			->bind('skpd_name',$skpd_name)
			->bind('skpd_alamat',$skpd_alamat)
			->bind('num_rows',$count);
			
		$count = $unit->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$skpd = ORM::factory('Skpd')->where('id','=',$_GET['skpd_id'])->find();
		
		$results 		= $unit->order_by('kode','ASC')->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();				
		$page_links		= $pagination->render();
		$i				= $pagination->offset+1;
		//$url 			= URL::base().'unit';
		$submit_value 	= "Cari";
		$skpd_kode		= $skpd->kode;
		$skpd_name		= $skpd->name;
		$skpd_alamat	= $skpd->alamat;
	}
	
	function action_reload() {
		$this->auto_render = false;

		$view = View::factory('unit_reload')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count);
			
		$unit = ORM::factory('Unit')->where('skpd_id','=',$_GET['skpd_id']);
		$count = $unit->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $unit->order_by('kode','ASC')->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();				
		$page_links = str_replace("reload","",$pagination->render());
		$page_links = str_replace("/?","?",$page_links);
		$i=$pagination->offset+1;
		$url = URL::base().'unit';
		$submit_value = "Cari";

		echo $view;
		exit;
	}
	
	public function action_new() {
		$this->auto_render = false;

		$view 				= View::factory('frm_unit');
		$view->form 		= $this->form;
		$view->id			= "";
		$view->skpd_id 		= $_GET['skpd_id'];
		$view->errors		= "";
		$view->url 			= URL::base().'unit/save';
		$view->title 		= "Add Unit";
		$view->submit_value = "Add Unit";
		echo $view;
	}
	

	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');

		$unit = ORM::factory('Unit')->where("id","=",$id)->find();
		$form = array(
			'kode' 				=> $unit->kode,
			'name' 				=> $unit->name,
			'skpd_id' 			=> $unit->skpd_id,
			'id'				=> $id,
		);
	
		$view 				= View::factory('frm_unit');
		$view->form			= $form;
		$view->url 			= URL::base().'unit/update/'.$id;
		$view->id 			= $id;
		$view->skpd_id 		= $unit->skpd_id;
		$view->title 		= "Edit Unit";
		$view->submit_value	= "Update Unit";
		
		echo $view;
	}
	
	public function action_save() {	
		$this->auto_render = false;
		
		try {
			$unit = ORM::factory('Unit');
			$unit->create_unit($_POST, array_keys($this->form));
						
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$view = View::factory('frm_unit')
				->bind('error', $errors)
				->bind('form', $_POST);
			
			$view->id 			= "";	
			$view->url 			= URL::base().'unit/save';
			$view->title 		= "New Unit";
			$view->submit_value	= "Add Unit";
			$view->skpd_id 		= $_POST['skpd_id'];
			
			echo $view;
		}
	}
	
	public function action_update() {	
		$this->auto_render = false;
		$id = $this->request->param('id');

		try {
			$unit = ORM::factory('Unit',$id);
			if(isset($_POST['delete'])==1) {
				$unit->delete($id);
			}
			else {
				$unit->update_unit($_POST, array_keys($this->form));
			}
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$view = View::factory('frm_unit')
				->bind('error', $errors)
				->bind('form', $_POST);
			
			$view->id = $id;	
			$view->url = URL::base().'unit/update/'.$id;
			$view->title ="Edit Unit";
			$view->submit_value = "Update Unit";
			
			echo $view;
		}
	}
}
?>