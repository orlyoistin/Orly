<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Sotk extends Controller_Admin_Backend {
	public $auth_required = array('login');
		
	function action_index(){	
		$skpd_id = $this->request->param('id');	
		
		if(Auth::instance()->get_user()->jabatan_id == 2) {
			$skpd_id = Auth::instance()->get_user()->skpd_id;
		}
		
		$this->template->content = View::factory('admin/sotk')
			->set('skpd_id',$skpd_id);
	}
	
	public function action_new() {
		$this->auto_render = false;
		$skpd_id = $this->request->param('id');	
		$skpd = ORM::factory('Skpd',$skpd_id);
		
		echo View::factory('admin/sotk_form')
    		->set('form',$this->getField("Sotk"))
    		->set('url',URL::base().'admin/sotk/save')										
    		->set('submit_value','Tambah Data')
			->set('skpd',$skpd)
			->set('parent_list',Model::factory('Custom')->parent_admin($skpd->id))
			->set('masterbool_list',$this->getList('Masterbool','name'));										
	}	

	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		$sotk = ORM::factory('Sotk',$id);	
		$skpd = ORM::factory('Skpd',$sotk->skpd_id);
		
		$form = array();
		$fields = ORM::factory('Sotk')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $sotk->$column;
		}
		$form['sotk_id'] = $sotk->parent_id;
	
		echo View::factory('admin/sotk_form')
			->bind('form',$form)
			->set('id',$id)
			->set('url',URL::base().'admin/sotk/update/'.$id)
			->set('submit_value','Update Data')
			->set('skpd',$skpd)
			->set('parent_list',Model::factory('Custom')->parent_admin($skpd->id))
			->set('masterbool_list',$this->getList('Masterbool','name'));										
	}
	
	public function action_save() {	
		$this->auto_render = false;
		$skpd = ORM::factory('Skpd',$_POST['skpd_id']);
		
		try {
			$sotk = ORM::factory('Sotk')
				->where('skpd_id','=',$skpd->id);
			
			$n = ORM::factory('Sotk')->count_all();
			if($n == 0) {
				$_POST['level'] = 1;
			}
			else {
				if($_POST['parent_id'] == 0) {
					$_POST['level'] = 1;
				}
				else {								
					$level = ORM::factory('Sotk')->where('id','=',$_POST['parent_id'])->find()->level;
					$_POST['level'] = $level + 1;
				}
			}
			$sotk->create_sotk($_POST, array_keys($this->getField('Sotk')));
			
			echo "success";		
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			print_r($errors);
				
			
			echo View::factory('admin/sotk_form')
				->bind('errors', $errors)
				->set('form', $_POST)
				->set('url',URL::base().'admin/sotk/save')
				->set('submit_value','Tambah Data')
				->set('parent_list',Model::factory('Custom')->parent_skpd())
				->set('masterbool_list',$this->getList('Masterbool','name'));
		}
	}
		
	public function action_update() {	
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		try {
			$sotk = ORM::factory('Sotk',$id);
			if(isset($_POST['delete'])==1) {
				$child = Model::factory('Custom')->getTreeData($id);
				$x_child = explode(",",$child);
				DB::delete('sotks')->where('id', 'IN', $x_child)->execute();				
				
				$sotk->delete($id);			
			}
			else {
				$n = ORM::factory('Sotk')->count_all();
				if($n == 0) {
					$_POST['level'] = 1;
				}
				else {
					if($_POST['parent_id']==0) {
						$_POST['level'] = 1;
					}
					else {
						$level = ORM::factory('Sotk')->where('id','=',$_POST['parent_id'])->find()->level;
						$_POST['level'] = $level + 1;
						$_POST['parent_id'] = $_POST['parent_id'];
					}
				}
				$sotk->update_sotk($_POST, array_keys($this->getField('Sotk')));
			}
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			echo View::factory('admin/sotk_form')
				->bind('form',$form)
				->set('id',$id)
				->set('url',URL::base().'admin/sotk/update/'.$id)
				->set('submit_value','Update Data')
				->set('parent_list',Model::factory('Custom')->parent_skpd())
				->set('masterbool_list',$this->getList('Masterbool','name'));
		}
	}
	
	function action_data() {
		$this->auto_render = false;
		$skpd_id = $this->request->param('id');
		
		if(Auth::instance()->get_user()->jabatan_id == 2) {
			$skpd_id = Auth::instance()->get_user()->skpd_id;
		}
		
		$xsotk = explode("#",substr_replace(Model::factory('Custom')->tree_skpd($skpd_id,0),"",-1));	
		$total_data = 0;
		$total_filtered = 0;
	
		$arrData = array();
		$i = 1;
		foreach($xsotk as $var) {
			if($var) {
				$sotk = ORM::factory('Sotk',$var);
				$prefix = 0;
				
				if($sotk->level >= 0) { 
					$prefix = str_repeat("&nbsp;",($sotk->level-1)*5);
				}
				
				$arrData[] = array(
					$i + $_REQUEST['start'],
					"<a id='".$sotk->id."' data-fancybox data-type='ajax' data-src='".URL::base()."admin/sotk/edit/".$sotk->id."'>".$prefix.$sotk->name."</a><br>".$prefix.$sotk->pejabat."<br>".$prefix.$sotk->nip 
				);
				$i++;
			}
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