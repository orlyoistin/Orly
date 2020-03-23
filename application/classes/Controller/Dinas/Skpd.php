<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dinas_Skpd extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
			
	public function action_index() {				
		$this->template->content = View::factory('dinas/skpd');
	}
	
	public function action_new() {
		$this->auto_render = false;
		
		echo View::factory('dinas/skpd_form')
			->bind('errors',$error)
			->set('form',$this->getField('Skpd'))										
			->set('url',URL::base().'dinas/skpd/create')
			->set('submit_value',"Tambah Data")
			->set('skpd_list',$this->getList('Skpd','name'));
	}
	
	
	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$skpd = ORM::factory('Skpd',$id);
		
		$form = array();
		$fields = ORM::factory('Skpd')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $skpd->$column;
		}
		
		$arrDistribution = array();
		$x_distribution = explode(",",$skpd->distribution);
		foreach($x_distribution as $d) {
			array_push($arrDistribution, $d);
		}	
		$form['skpd_id'] = $arrDistribution;
		
		echo View::factory('dinas/skpd_form')
			->bind('errors',$errors)
			->set('form',$form)
			->set('url',URL::base().'dinas/skpd/update/'.$id)
			->set('submit_value',"Update Data")
			->set('id',$id)
			->set('skpd_list',$this->getList('Skpd','name'));
	}	

	public function action_create() {
		$this->auto_render = false;
		try {
			/*$distribution = "";
			foreach($_POST['skpd_id'] as $s) {
				$distribution .= $s.",";
			}*/
			
			//$_POST['distribution'] = substr_replace($distribution,"",-1);
			$skpd = ORM::factory('Skpd')->create_skpd($_POST, array_keys($this->getField('Skpd')));		
			
			DB::update('skpds')->set(array('distribution' => $skpd->id))->where('id', '=', $skpd->id)->execute();
			
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
								
			echo View::factory('dinas/skpd_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/skpd/create')
				->set('submit_value',"Tambah Data")
				->set('skpd_list',$this->getList('Skpd','name'));
		}
	}
	
	public function action_update() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		$skpd = ORM::factory('Skpd',$id);
		
		try {
			if(isset($_POST['delete'])) {
				$skpd->delete($id);
			}
			else {				
				$distribution = "";
				foreach($_POST['skpd_id'] as $s) {
					$distribution .= $s.",";
				}
				$_POST['distribution'] = substr_replace($distribution,"",-1);
				
				$skpd->update_skpd($_POST, array_keys($this->getField('Skpd')));								
			}
			
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$view = View::factory('dinas/skpd_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/skpd/update/'.$id)
				->set('submit_value',"Update Data")
				->set('id',$id)
				->set('skpd_list',$this->getList('Skpd','name'));
				
			echo $view;				
		}
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewskpds = ORM::factory('Viewskpd');
		
		if(Auth::instance()->get_user()->jabatan_id == 2) {
			$viewskpds = $viewskpds
				->where('id','=',Auth::instance()->get_user()->skpd_id);
		}
		
		$total_data = $viewskpds->reset(FALSE)->count_all();

		$viewskpds = $viewskpds
			->where('name','LIKE','%'.$_REQUEST['search']['value'].'%');
		
		$total_filtered = $viewskpds->reset(FALSE)->count_all();
		
		$viewskpds = $viewskpds
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->find_all();				
		
		$arrData = array();
		$i = 1;
		foreach($viewskpds as $viewskpd) {
			$skpd = ORM::factory('Skpd',$viewskpd->id);
			
			$distribution = "";
			$x_distribution = explode(",",$skpd->distribution);
			foreach($x_distribution as $d) {
				$distribution .= ORM::factory('Skpd',$d)->name."<br \>";
			}
			$distribution = substr_replace($distribution,"",-6);
			
			$arrData[] = array(
				$i + $_REQUEST['start'],
				"<a title='SOTK' class='btn btn-warning btn-xs' href='".URL::base()."dinas/sotk/index/".$skpd->id."'><i class='fa fa-sitemap'></i></a>",
				$skpd->kode,
				"<a data-fancybox data-type='ajax' data-src='".URL::base()."dinas/skpd/edit/".$skpd->id."'>".$skpd->name."</a>",
				$distribution
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